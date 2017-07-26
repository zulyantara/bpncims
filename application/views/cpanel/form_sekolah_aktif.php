<?php
$attr_form_search = array('class' => 'uk-search', 'name' => 'form_search_sekolah', 'id' => 'form_search_sekolah', 'data-uk-search' => '');
echo form_open('cpanels/form_sekolah_aktif/'.$this->uri->segment(3), $attr_form_search);
?>
    <input class="uk-search-field" type="search" placeholder="Cari ..." name="txt_search" id="txt_search" title="Tekan Enter untuk mencari" data-uk-tooltip>
    <button class="uk-search-close" type="reset"></button>
<?php echo form_close(); ?>
<hr>
<?php
if($this->uri->segment(3)!="00")
{
    ?>
    <form action="<?php echo base_url("cpanels/form_sekolah_aktif"); ?>" method="post">
        <button name="btn_cetak_tim" id="btn_cetak_tim" class="uk-button uk-button-success" value="cetak_tim" type="submit">Download Tim</button>
        <button name="btn_cetak_siswa" id="btn_cetak_siswa" class="uk-button uk-button-success" value="cetak_siswa" type="submit">Download Siswa</button>
    </form>
    <?php
}
?>
<?php echo $links; ?>

<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th style="width: 5%;">No</th>
        <th style="width: 55%;">Nama Tim/Sekolah</th>
        <th style="width: 15%;text-align: center;">No Peserta</th>
        <th style="width: 5%;">Gender</th>
        <th style="width: 5%;">Tingkat</th>
        <th style="width: 15%;text-align: center;">Detail Siswa</th>
    </tr>
    <?php
    if(is_array($sql_sekolah_aktif))
    {
        $no = 1 + $this->uri->segment(4);
        foreach($sql_sekolah_aktif as $row_sekolah_aktif)
        {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row_sekolah_aktif->pendaftaran_tim_nama; ?></td>
                <td style="text-align: center;"><?php echo $row_sekolah_aktif->pendaftaran_tim_noreg; ?></td>
                <td><?php echo ($row_sekolah_aktif->pendaftaran_tim_gender == 1) ? "Laki - Laki" : "Perempuan"; ?></td>
                <td><?php echo $row_sekolah_aktif->jenjang_ket; ?></td>
                <td style="text-align: center;"><a href="<?php echo base_url("cpanels/form_detail_tim"); ?>" class="uk-button"><i class="uk-icon-users"></i></a></td>
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