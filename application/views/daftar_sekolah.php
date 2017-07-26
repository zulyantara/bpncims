<?php
$attr_form_search = array('class' => 'uk-search', 'name' => 'form_search_sekolah', 'id' => 'form_search_sekolah', 'data-uk-search' => '');
echo form_open('pendaftaran/cari_sekolah/'.$this->uri->segment(3), $attr_form_search);
?>
    <input class="uk-search-field" type="search" placeholder="Cari ..." name="txt_search" id="txt_search" title="Tekan Enter untuk mencari" data-uk-tooltip>
    <button class="uk-search-close" type="reset"></button>
<?php echo form_close(); ?>
<hr>

<?php echo $links; ?>

<div id="list_data"></div>

<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th style="width: 5%;">No</th>
        <th style="width: 55%;">Nama Sekolah</th>
        <th style="width: 20%;">Lokasi Kompetisi</th>
        <th style="width: 5%;">Tingkat</th>
        <th style="width: 10%; text-align: center;">Jumlah Tim</th>
        <th style="width: 10%; text-align: center;">Jumlah Siswa</th>
    </tr>
    <?php
    if(is_array($sql_pendaftaran))
    {
        $no = 1 + $this->uri->segment(4);
        foreach($sql_pendaftaran as $row_pendaftaran)
        {

            $jml_tim = $this->pendaftaran_model->count_tim($row_pendaftaran->pendaftaran_h_id);
            $jml_siswa = $this->pendaftaran_model->count_siswa($row_pendaftaran->pendaftaran_h_id);
            
            $badge_success = "<span class=\"uk-badge uk-badge-success\" style=\"float: right;\">Aktif</span>";
            $badge_warning = "<span class=\"uk-badge uk-badge-warning\" style=\"float: right;\">Belum Aktif</span>";
            $status = ($row_pendaftaran->pendaftaran_h_isactive === "1") ? $badge_success : $badge_warning;
            $classSuccess = ($row_pendaftaran->pendaftaran_h_isactive === "1") ? "uk-text-success" : "uk-text-warning";
            ?>
            <tr>
                <td><span class="<?php echo $classSuccess; ?>"><?php echo $no; ?></span></td>
                <td>
                    <?php
                    if($this->session->userdata('is_logged_in') OR $this->session->userdata('is_logged_in') == TRUE)
                    {
                        ?>
                        <a href="#" id="detail-sekolah" onclick="detailRec('<?php echo $row_pendaftaran->pendaftaran_h_id; ?>')" style="text-decoration: none;">
                        <?php
                    }
                    ?>
                        <span class="<?php echo $classSuccess; ?>">
                            <?php echo $row_pendaftaran->pendaftaran_h_nama_sekolah." ".$row_pendaftaran->pendaftaran_h_kota_sekolah; ?><?php echo $status; ?>
                        </span>
                    <?php
                    if($this->session->userdata('is_logged_in') OR $this->session->userdata('is_logged_in') == TRUE)
                    {
                        ?>
                        </a>
                        <?php
                    }
                    ?>
                </td>
                <td><span class="<?php echo $classSuccess; ?>"><?php echo $row_pendaftaran->kota_ket; ?></span></td>
                <td><span class="<?php echo $classSuccess; ?>"><?php echo $row_pendaftaran->jenjang_ket; ?></span></td>
                <td style="text-align: center;"><span class="<?php echo $classSuccess; ?>"><?php echo $jml_tim; ?></span></td>
                <td style="text-align: center;"><span class="<?php echo $classSuccess; ?>"><?php echo $jml_siswa; ?></span></td>
            </tr>
            <?php
            $no++;
        }
    }
    else
    {
        ?>
        <tr>
            <td colspan="7" align="center"><b>Daftar sekolah terdaftar kosong</b></td>
        </tr>
        <?php
    }
    ?>
</table>

<?php echo $links; ?>

<script type="text/javascript">
function detailRec(idrec){
    $("#list_data").show();
    vardata = "id_pendaftaran=" + idrec;
    $.ajax({
        url: "<?php echo base_url("pendaftaran/detail_sekolah"); ?>",
        type: "POST",
        data : vardata,
        success: function(data){
            $("#list_data").html(data);
        }
    });
}
</script>