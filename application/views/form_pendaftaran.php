<?php
if(isset($error))
{
    if(is_array($error))
    {
        echo "<pre>";print_r($error);echo "</pre>";
    }
    else
    {
        echo $error;
    }
}
//echo $kode_pendaftaran;
$valKodePendaftaran = (isset($kode_pendaftaran)) ? $kode_pendaftaran : set_value('txt_pendaftaran_kode');
$valNamaSekolah = (isset($query_edit)) ? $query_edit->pendaftaran_h_nama_sekolah : set_value('txt_nama_sekolah');
$valKotaSekolah = (isset($query_edit)) ? $query_edit->pendaftaran_h_kota_sekolah : set_value('txt_kota_sekolah');
$valAlamat = (isset($query_edit)) ? $query_edit->pendaftaran_h_alamat_sekolah : set_value('txt_alamat');
$valTelpSekolah = (isset($query_edit)) ? $query_edit->pendaftaran_h_telp_sekolah : set_value('txt_no_telp');
$valNamaKepSek = (isset($query_edit)) ? $query_edit->pendaftaran_h_nama_kepsek : set_value('txt_nama_kepsek');
$valNoHpKepSek = (isset($query_edit)) ? $query_edit->pendaftaran_h_hp_kepsek : set_value('txt_no_hp_kepsek');
$valNamaPendamping = (isset($query_edit)) ? $query_edit->pendaftaran_h_nama_pendamping : set_value('txt_nama_pendamping');
$valNoHpPendamping = (isset($query_edit)) ? $query_edit->pendaftaran_h_hp_pendamping : set_value('txt_no_hp_pendamping');
$valEmailPendamping = (isset($query_edit)) ? $query_edit->pendaftaran_h_email : set_value('txt_email_sekolah');

$jmlTim = array('1'=>'Rp. 75.000 [1 Tim]','2'=>'Rp. 150.000 [2 Tim]','3'=>'Rp. 225.000 [3 Tim]','4'=>'Rp. 300.000 [4 Tim]','5'=>'Rp. 375.000 [5 Tim]','6'=>'Rp. 450.000 [6 Tim]','7'=>'Rp. 525.000 [7 Tim]','8'=>'Rp. 600.000 [8 Tim]','9'=>'Rp. 675.000 [9 Tim]','10'=>'Rp. 750.000 [10 Tim]');

$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_pendaftaran_head', 'id' => 'form_pendaftaran_head');
?>
<?php
echo form_open('pendaftaran/input_pendaftaran', $attr_form);
echo form_hidden('txt_pendaftaran_kode', $valKodePendaftaran);
?>
    <div class="uk-form-row">
        <?php echo form_error('txt_nama_sekolah'); ?>
        <?php echo form_error('txt_kota_sekolah'); ?>
        <label for="txt_nama_sekolah" class="uk-form-label">Nama Sekolah</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-building-o"></i>
                <input type="text" placeholder="Nama Sekolah" name="txt_nama_sekolah" id="txt_nama_sekolah" class="uk-form-width-medium" value="<?php echo $valNamaSekolah; ?>" title="Contoh: SDN 01, SMPN 01, SMAN 01 (tanpa nama kota)" data-uk-tooltip>
                <i class="uk-icon-map-marker"></i>
                <input type="text" placeholder="Kota Sekolah" name="txt_kota_sekolah" id="txt_kota_sekolah" class="uk-form-width-medium" value="<?php echo $valKotaSekolah; ?>" title="Contoh: Makassar, Surabaya, Bandung, Jakarta Timur ..." data-uk-tooltip>
            </div>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('opt_jenjang'); ?>
        <label for="opt_jenjang" class="uk-form-label">Jenjang Pendidikan</label>
        <div class="uk-form-controls">
            <select name="opt_jenjang" id="opt_jenjang">
                <option selected="selected" value="">Pilih Jenjang</option>
                <?php
                foreach($sql_jenjang as $row_jenjang)
                {
                    $valJenjang = (isset($query_edit)) ? $query_edit->pendaftaran_h_jenjang : "";
                    $setSelectJenjang = ($valJenjang == $row_jenjang->jenjang_id) ? "selected=\"selected\"" : set_select('opt_jenjang', $row_jenjang->jenjang_id);
                    ?>
                        <option value="<?php echo $row_jenjang->jenjang_id; ?>" <?php echo $setSelectJenjang; ?>>
                            <?php echo $row_jenjang->jenjang_ket; ?>
                        </option>
                    <?php
                }
                ?>
            </select><br>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_alamat'); ?>
        <label for="txt_alamat" class="uk-form-label">Alamat Lengkap</label>
        <div class="uk-form-controls">
            <textarea placeholder="Alamat Lengkap Sekolah" name="txt_alamat" id="txt_alamat" class="uk-form-width-large"><?php echo $valAlamat; ?></textarea>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_no_telp'); ?>
        <label for="txt_no_telp" class="uk-form-label">No Telepon Sekolah</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-phone-square"></i>
                <input type="text" placeholder="Nomor Telp" name="txt_no_telp" id="txt_no_telp" class="uk-form-width-medium" value="<?php echo $valTelpSekolah; ?>" title="Contoh: 02123456789" data-uk-tooltip>
            </div>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_nama_kepsek'); ?>
        <?php echo form_error('txt_no_hp_kepsek'); ?>
        <label for="txt_nama_pendamping" class="uk-form-label">Nama & No HP Kepala Sekolah</label>
        <div class="uk-form-controls">
            <input type="text" placeholder="Nama Kepala Sekolah" name="txt_nama_kepsek" id="txt_nama_kepsek" class="uk-form-width-medium" value="<?php echo $valNamaKepSek; ?>">
            <div class="uk-form-icon">
                <i class="uk-icon-phone-square"></i>
                <input type="text" placeholder="No HP Kepala Sekolah" name="txt_no_hp_kepsek" id="txt_no_hp_kepsek" class="uk-form-width-medium" value="<?php echo $valNoHpKepSek; ?>" title="Contoh: 08123456789" data-uk-tooltip>
            </div>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_nama_pendamping'); ?>
        <?php echo form_error('txt_no_hp_pendamping'); ?>
        <label for="txt_nama_pendamping" class="uk-form-label">Nama & HP Guru Pendamping</label>
        <div class="uk-form-controls">
            <input type="text" placeholder="Nama Pendamping" name="txt_nama_pendamping" id="txt_nama_pendamping" class="uk-form-width-medium" value="<?php echo $valNamaPendamping; ?>">
            <div class="uk-form-icon">
                <i class="uk-icon-phone-square"></i>
                <input type="text" placeholder="No HP Pendamping" name="txt_no_hp_pendamping" id="txt_no_hp_pendamping" class="uk-form-width-medium" value="<?php echo $valNoHpPendamping; ?>" title="Contoh: 08123456789" data-uk-tooltip>
            </div>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_email_sekolah'); ?>
        <label for="txt_email_sekolah" class="uk-form-label">Email Guru Pendamping</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-envelope-o"></i>
                <input type="text" placeholder="Email Pendamping/Sekolah" name="txt_email_sekolah" id="txt_email_sekolah" class="uk-form-width-large" value="<?php echo $valEmailPendamping; ?>">
            </div>
        </div>
    </div>
    
    <?php
    if( ! isset($query_edit))
    {
        ?>
        <div class="uk-form-row">
            <?php echo form_error('opt_jml_tim'); ?>
            <label for="opt_jml_tim" class="uk-form-label">Rencana Pembayaran</label>
            <div class="uk-form-controls">
                <select name="opt_jml_tim" id="opt_jml_tim">
                    <option selected="selected" value="">Rencana Pembayaran</option>
                    <?php
                    foreach($jmlTim as $keyJml => $rowJml)
                    {
                        ?>
                        <option value="<?php echo $keyJml; ?>" <?php echo set_select('opt_jml_tim', $keyJml); ?>><?php echo $rowJml; ?></option>
                        <?php
                    }
                    ?>
                </select>
                <!--<span class="uk-text-danger" id="ket_jml_tim"></span>-->
            </div>
        </div>
        <?php
    }
    ?>
    
    <div class="uk-form-row">
        <?php echo form_error('opt_kota'); ?>
        <label for="opt_kota" class="uk-form-label">Kota Kompetisi</label>
        <div class="uk-form-controls">
            <select name="opt_kota" id="opt_kota">
                <option selected="selected" value="">Kota Kompetisi</option>
                <?php
                foreach($sql_kota_aktif as $row_kota)
                {
                    $valKota = (isset($query_edit)) ? $query_edit->pendaftaran_h_kota : "";
                    $setSelectKota = ($valKota == $row_kota->kota_no) ? "selected=\"selected\"" : set_select('opt_kota', $row_kota->kota_no);
                    ?>
                        <option value="<?php echo $row_kota->kota_no; ?>" <?php echo $setSelectKota; ?>>
                            <?php echo $row_kota->kota_no." | ".$row_kota->kota_ket; ?>
                        </option>
                    <?php
                }
                ?>
            </select>
            <ul>
                <li><span class="uk-text-bold uk-text-small uk-text-danger">Khusus SMA hanya di: Jakarta Selatan (UAI), Depok (UI), Bogor (IPB) dan Bandung (ITB)</span></li>
                <li><span class="uk-text-bold uk-text-small uk-text-danger">Pendaftaran online untuk wilayah jabodetabek, bandung dan karawang telah ditutup, informasi lebih lanjut, silahkan hubungi sekretariat panitia</span></li>
            </ul>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_captcha'); ?>
        <label for="txt_captcha" class="uk-form-label">Tuliskan Angka di gambar</label>
        <div class="uk-form-controls">
            <?php echo $cap['image']; ?>
            <input type="text" name="txt_captcha" id="txt_captcha" placeholder="Captcha">
        </div>
    </div>
    <hr>
    <div class="uk-form-row">
        <?php
        if( ! isset($query_edit))
        {
            ?>
            <button class="uk-button uk-button-primary" type="submit" name="btn_simpan_pendaftaran" value="simpan_pendaftaran">
                <i class="uk-icon-file-text-o"></i> Simpan
            </button>
            <button class="uk-button uk-button-success" type="submit" name="btn_input_tim" value="input_tim">
                Selanjutnya <i class="uk-icon-arrow-circle-right"></i>
            </button>
            <?php
        }
        else
        {
            ?>
            <button class="uk-button uk-button-primary" type="submit" name="btn_simpan" value="simpan"><i class="uk-icon-file-text-o"></i> Simpan</button>
            <!--
            <button class="uk-button uk-button-success" type="submit" name="btn_update_tim" value="update_tim">
                Input Tim <i class="uk-icon-arrow-circle-right"></i>
            </button>
            -->
            <?php
        }
        ?>
    </div>
<?php form_close(); ?>

<script type="text/javascript">
$("#opt_jml_tim").change(function(){
    var str = "";
    $( "#opt_jml_tim option:selected" ).each(function() {
        str += $( this ).text();
    });
    $("#ket_jml_tim").text(str);
}).change();
</script>
