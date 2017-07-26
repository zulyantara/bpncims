<?php
$pendaftaran_kode = (isset($query_pendaftaran)) ? $query_pendaftaran->pendaftaran_h_kode : "";
$pendaftaran_nama_sekolah = (isset($query_pendaftaran)) ? $query_pendaftaran->pendaftaran_h_nama_sekolah." ".$query_pendaftaran->pendaftaran_h_kota_sekolah : "";
$pendaftaran_kota_no = (isset($query_pendaftaran)) ? $query_pendaftaran->kota_ket: "";
$pendaftaran_kota = (isset($query_pendaftaran)) ? $query_pendaftaran->kota_ket: "";
$pendaftaran_jml_tim = (isset($query_pendaftaran)) ? $query_pendaftaran->pendaftaran_h_jml_tim : "";
$pendaftaran_jml_siswa = (isset($total_siswa)) ? $total_siswa: "";
$pendaftaran_jml_nonislam = (isset($total_nonislam)) ? $total_nonislam: "";
$pendaftaran_jml_transfer = (isset($query_pendaftaran)) ? $total_tim * 75000 : "";
$pendaftaran_tgl_transfer = (isset($query_pendaftaran)) ? $query_pendaftaran->pendaftaran_tim_tgl_transfer : "";
$pendaftaran_no_rekening = (isset($query_pendaftaran)) ? $query_pendaftaran->pendaftaran_tim_no_rek : "";
$pendaftaran_atas_nama = (isset($query_pendaftaran)) ? $query_pendaftaran->pendaftaran_tim_an_rek : "";
$pendaftaran_bank_transfer = (isset($query_pendaftaran)) ? $query_pendaftaran->bank_ket: "";



$label_kode = (isset($query_pendaftaran)) ? "<label for=\"txt_kode_pendaftaran\" class=\"uk-form-label\">Kode Pendaftaran</label>" : "";
$label_nama = (isset($query_pendaftaran)) ? "<label for=\"txt_nama_sekolah\" class=\"uk-form-label\">Nama Sekolah</label>" : "";
$label_kota = (isset($query_pendaftaran)) ? "<label for=\"txt_kota\" class=\"uk-form-label\">Kota Kompetisi</label>" : "";
$label_jml_tim_real = (isset($query_pendaftaran)) ? "<label for=\"txt_jml_tim\" class=\"uk-form-label\">Jumlah Tim Real</label>" : "";
$label_jml_tim_rencana = (isset($query_pendaftaran)) ? "<label for=\"txt_jml_tim\" class=\"uk-form-label\">Jumlah Tim Rencana</label>" : "";
$label_jml_siswa = (isset($total_siswa)) ? "<label for=\"txt_jml_siswa\" class=\"uk-form-label\">Jumlah Siswa</label>" : "";
$label_jml_nonislam = (isset($total_siswa)) ? "<label for=\"txt_jml_nonislam\" class=\"uk-form-label\">Jumlah Agama Non Islam</label>" : "";
$label_jml_transfer = (isset($query_pendaftaran)) ? "<label for=\"txt_jml_transfer\" class=\"uk-form-label\">Jumlah Transfer</label>" : "";
$label_tgl_transfer = (isset($query_pendaftaran)) ? "<label for=\"txt_tgl_transfer\" class=\"uk-form-label\">Tanggal Transfer</label>" : "";
$label_no_rekening = (isset($query_pendaftaran)) ? "<label for=\"txt_no_rekening\" class=\"uk-form-label\">No. Rekening</label>" : "";
$label_atas_nama = (isset($query_pendaftaran)) ? "<label for=\"txt_atas_nama\" class=\"uk-form-label\">Atas Nama</label>" : "";
$label_bank_transfer = (isset($query_pendaftaran)) ? "<label for=\"txt_bank_transfer\" class=\"uk-form-label\">Bank Transfer</label>" : "";

$attrFrmFilter= array('class' => 'uk-form', 'name' => 'form_filter', 'id' => 'form_filter');
echo form_open("cpanels/filter_sekolah", $attrFrmFilter);
?>
    <?php echo form_error('opt_sekolah'); ?>
    <select name="opt_sekolah" id="opt_sekolah" autofocus="autofocus">
        <option selected="selected" value="">Pilih Sekolah</option>
        <?php
        if(is_array($query_sekolah))
        {
            foreach($query_sekolah as $row_sekolah)
            {
                ?>
                <option value="<?php echo $row_sekolah->pendaftaran_h_id;?>" <?php echo set_select('opt_sekolah', $row_sekolah->pendaftaran_h_id); ?>><?php echo $row_sekolah->pendaftaran_h_nama_sekolah." ".$row_sekolah->pendaftaran_h_kota_sekolah." | ".$row_sekolah->jenjang_ket; ?></option>
                <?php
            }
        }
        ?>
    </select>
    <button class="uk-button" type="submit" name="btn_filter" value="btn_filter">Filter</button>
<?php echo form_close(); ?>

<hr>

<div data-uk-grid-margin="" class="uk-grid uk-grid-divider">
    <div class="uk-width-medium-1-1">
        <?php
        $attrFrmValidasi= array('class' => 'uk-form uk-form-stacked', 'name' => 'form_validasi', 'id' => 'form_validasi');
        echo form_open("cpanels/validasi_sekolah", $attrFrmValidasi);
        echo form_hidden('txt_kota_no', $pendaftaran_kota_no);
        ?>
            <div data-uk-grid-margin="" class="uk-grid">
                <div class="uk-width-medium-1-3">
                    <div class="uk-form-controls">
                        <?php echo $label_kode; ?>
                        <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Kode Pendaftaran" name="txt_kode_pendaftaran" id="txt_kode_pendaftaran" readonly="readonly" value="<?php echo $pendaftaran_kode; ?>">
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="uk-form-controls">
                        <?php echo $label_nama; ?>
                        <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Nama Sekolah" name="txt_nama_sekolah" id="txt_nama_sekolah" readonly="readonly" value="<?php echo $pendaftaran_nama_sekolah; ?>">
                    </div>
                </div>
                <div class="uk-width-medium-1-3">
                    <div class="uk-form-controls">
                        <?php echo $label_kota; ?>
                        <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Kota" name="txt_kota" id="txt_kota" readonly="readonly" value="<?php echo $pendaftaran_kota; ?>">
                    </div>
                </div>
                
                <?php
                if($this->session->userdata("username") == "cs1" OR $this->session->userdata("username") == "cs2" OR $this->session->userdata("username") == "cs3" OR $this->session->userdata("username") == "cs4" OR $this->session->userdata("username") == "admin" OR $this->session->userdata("username") == "kusmayadi")
                {
                    ?>
                    <div class="uk-width-medium-1-5">
                        <div class="uk-form-controls">
                            <?php echo $label_jml_tim_real; ?>
                            <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Jumlah Tim Real" name="txt_jml_tim_real" id="txt_jml_tim_real" readonly="readonly" value="<?php echo $total_tim; ?>">
                        </div>
                    </div>
                    <div class="uk-width-medium-1-4">
                        <div class="uk-form-controls">
                            <?php echo $label_jml_tim_rencana; ?>
                            <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Jumlah Tim Rencana" name="txt_jml_tim_rencana" id="txt_jml_tim_rencana" readonly="readonly" value="<?php echo $pendaftaran_jml_tim; ?>">
                        </div>
                    </div>
                    <div class="uk-width-medium-1-5">
                        <div class="uk-form-controls">
                            <?php echo $label_jml_siswa; ?>
                            <input type="text" class="uk-width-1-2 uk-form-blank" placeholder="Jumlah Siswa" name="txt_jml_siswa" id="txt_jml_siswa" readonly="readonly" value="<?php echo $pendaftaran_jml_siswa; ?>"><?php echo (isset($query_pendaftaran)) ? ($pendaftaran_jml_siswa > 0 OR isset($query_pendaftaran)) ? "<span class=\"uk-badge uk-badge-success\">Valid</span>" : "<span class=\"uk-badge uk-badge-danger\">Tidak Valid</span>" : ""; ?>
                        </div>
                    </div>
                    <div class="uk-width-medium-1-3">
                        <div class="uk-form-controls">
                            <?php echo $label_jml_nonislam; ?>
                            <input type="text" class="uk-width-1-2 uk-form-blank" placeholder="Jumlah Non Islam" name="txt_jml_nonislam" id="txt_jml_nonislam" readonly="readonly" value="<?php echo $pendaftaran_jml_nonislam; ?>"><?php echo (isset($query_pendaftaran)) ? ($pendaftaran_jml_nonislam == 0) ? "<span class=\"uk-badge uk-badge-success\">Valid</span>" : "<span class=\"uk-badge uk-badge-danger\">Tidak Valid</span>" : ""; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                
                <!-- Transferan -->
                <?php
                if($this->session->userdata("username") == "keu1" OR $this->session->userdata("username") == "keu2" OR $this->session->userdata("username") == "admin" OR $this->session->userdata("username") == "kusmayadi")
                {
                    ?>
                    <div class="uk-width-medium-1-4">
                        <div class="uk-form-controls">
                            <?php echo $label_jml_transfer; ?>
                            <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Jumlah Transfer" name="txt_jml_transfer" id="txt_jml_transfer" readonly="readonly" value="<?php echo $pendaftaran_jml_transfer; ?>">
                        </div>
                    </div>
                    <div class="uk-width-medium-1-4">
                        <div class="uk-form-controls">
                            <?php echo $label_tgl_transfer; ?>
                            <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Tanggal Transfer" name="txt_tgl_transfer" id="txt_tgl_transfer" readonly="readonly" value="<?php echo $pendaftaran_tgl_transfer; ?>">
                        </div>
                    </div>
                    <div class="uk-width-medium-1-4">
                        <div class="uk-form-controls">
                            <?php echo $label_bank_transfer; ?>
                            <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Bank Transfer" name="txt_bank_transfer" id="txt_bank_transfer" readonly="readonly" value="<?php echo $pendaftaran_bank_transfer; ?>">
                        </div>
                    </div>
                    <div class="uk-width-medium-1-4">
                        <div class="uk-form-controls">
                            <?php echo $label_no_rekening; ?>
                            <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="No. Rekening" name="txt_no_rekening" id="txt_tgl_transfer" readonly="readonly" value="<?php echo $pendaftaran_no_rekening; ?>">
                        </div>
                    </div>
                    <div class="uk-width-medium-1-4">
                        <div class="uk-form-controls">
                            <?php echo $label_atas_nama; ?>
                            <input type="text" class="uk-width-1-1 uk-form-blank" placeholder="Atas Nama" name="txt_atas_nama" id="txt_atas_nama" readonly="readonly" value="<?php echo $pendaftaran_atas_nama; ?>">
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!-- end transferan -->
                
                <div class="uk-width-medium-1-1">
                    <div class="uk-form-controls">
                        <label><input type="radio" name="rdo_valid" value="1"> Valid</label>
                        <label><input type="radio" name="rdo_valid" value="0"> Tidak Valid</label>
                    </div>
                </div>
                <div class="uk-width-medium-1-1">
                    <div class="uk-form-controls">
                        <button class="uk-button" type="submit" name="btn_proses" id="btn_proses" value="proses">Proses</button>
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
<hr>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th style="width: 5%;">No</th>
        <th style="width: 30%;">Nama Sekolah</th>
        <th style="width: 25%;">Kota</th>
        <th style="width: 15%;">No Peserta</th>
        <th style="width: 15%;">Total Siswa</th>
        <th style="width: 10%;">Hapus</th>
    </tr>
    <?php
    if(is_array($query_valid))
    {
        $no = 1;
        foreach($query_valid as $row_valid)
        {
            $head_id = $row_valid->pendaftaran_h_id;
            $sql_tim = $this->cpanel_model->get_tim_by_head_id($head_id);
            
            foreach($sql_tim as $key_tim => $row_tim)
            {
				$total_tim = $this->cpanel_model->count_siswa_by_tim($row_tim->pendaftaran_tim_id);
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row_valid->pendaftaran_h_nama_sekolah; ?></td>
                    <td><?php echo $row_valid->kota_ket; ?></td>
                    <td><?php echo $row_tim->pendaftaran_tim_noreg; ?></td>
                    <td><?php echo $total_tim; ?></td>
                    <td>
                        <!--<div class="uk-button-group">-->
                            <!--<a class="uk-button" href="<?php echo base_url("cpanel/edit_siswa"); ?>"><i class="uk-icon-edit"></i></a>-->
                            <a class="uk-button" href="<?php echo base_url("cpanel/delete_siswa"); ?>"><i class="uk-icon-trash-o"></i></a>
                        <!--</div>-->
                    </td>
                    </td>
                </tr>
                <?php
                $no++;
            }
        }
    }
    else
    {
        ?>
        <td class="uk-text-center uk-text-bold" colspan="7">Data Kosong</td>
        <?php
    }
    ?>
</table>
