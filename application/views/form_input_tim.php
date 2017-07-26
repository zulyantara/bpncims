<?php
$nama_sekolah = $query_head->pendaftaran_h_nama_sekolah." ".$query_head->pendaftaran_h_kota_sekolah;
//$jml_transfer = $query_head->pendaftaran_h_jml_tim * 75000;
$jml_transfer = $jumlah_tim2 * 75000;

$valueNoRek = (isset($sql)) ? $sql->pendaftaran_tim_no_rek : set_value('txt_no_rek');
$valueAnRek = (isset($sql)) ? $sql->pendaftaran_tim_an_rek : set_value('txt_an_rek');
$valueJmlTransfer = (isset($sql)) ? $sql->pendaftaran_tim_jml_transfer : $jml_transfer;
$valueTglTransfer = (isset($sql)) ? $sql->pendaftaran_tim_tgl_transfer : set_value('txt_tgl_transfer');

$valueNamaTim = (isset($sql)) ? substr($sql->pendaftaran_tim_nama,3,2) : $nama_sekolah;

//$valueOptGender1 = (isset($sql) && $sql->pendaftaran_tim_gender == 1) ? 'selected="selected"' : set_select('opt_gender', 1);
//$valueOptGender2 = (isset($sql) && $sql->pendaftaran_tim_gender == 2) ? 'selected="selected"' : set_select('opt_gender', 2);

$valueBankPengirim = (isset($sql)) ? 'selected="selected"' : set_select('opt_bank_pengirim');

$jumlahTim = $query_head->pendaftaran_h_jml_tim;

if($jumlahTim <= $jumlah_tim1)
{
    $disabled = "disabled=\"disabled\"";
}
else
{
    $disabled = "";
}

$valPendaftaranHead = (isset($query_head)) ? $query_head->pendaftaran_h_kode : $this->input->post('txt_pendaftaran_kode');

$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_pendaftaran_tim', 'id' => 'form_pendaftaran_tim');
echo form_open_multipart('pendaftaran/input_tim', $attr_form);
?>
<fieldset data-uk-margin>
    <legend>Input Data Pembayaran</legend>
    <input type="hidden" value="<?php echo $query_head->pendaftaran_h_id; ?>" name="txt_pendaftaran_h_id" id="txt_pendaftaran_h_id">
    <input type="hidden" value="<?php echo $valPendaftaranHead; ?>" name="txt_pendaftaran_kode" id="txt_pendaftaran_kode">
    <input type="hidden" value="<?php echo $jumlah_tim2; ?>" name="opt_jml_tim" id="opt_jml_tim">
    <div class="uk-form-row">
        <?php echo form_error('opt_bank_pengirim'); ?>
        <label for="opt_bank_pengirim" class="uk-form-label">Bank Pengirim</label>
        <div class="uk-form-controls">
            <select name="opt_bank_pengirim" id="opt_bank_pengirim" <?php echo $disabled; ?>>
                <option selected="selected" value="">Bank Pengirim</option>
                <?php
                foreach($query_bank as $row_bank)
                {
                    ?>
                    <option value="<?php echo $row_bank->bank_kode; ?>" <?php echo $valueBankPengirim; ?>><?php echo $row_bank->bank_ket; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_no_rek'); ?>
        <label for="txt_no_rek" class="uk-form-label">No Rekening Pengirim</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_no_rek" id="txt_no_rek" value="<?php echo $valueNoRek; ?>" class="uk-form-width-medium" autofocus="autofocus" <?php echo $disabled; ?>>
            <span class="uk-text-danger">Jika Bayar Tunai isikan dengan "TUNAI"</span>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_an_rek'); ?>
        <label for="txt_an_rek" class="uk-form-label">Rekening Atas Nama</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_an_rek" id="txt_an_rek" value="<?php echo $valueAnRek; ?>" class="uk-form-width-medium" <?php echo $disabled; ?>>
            <span class="uk-text-danger">Jika Bayar Tunai isikan dengan "Nama Penyetor"</span>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_jml_transfer'); ?>
        <label for="txt_jml_transfer" class="uk-form-label">Jumlah Transfer</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_jml_transfer" id="txt_jml_transfer" value="<?php echo $valueJmlTransfer; ?>" class="uk-form-width-medium" maxlength="6" disabled>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_tgl_transfer'); ?>
        <label for="txt_tgl_transfer" class="uk-form-label">Tanggal Transfer</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_tgl_transfer" id="txt_tgl_transfer" value="<?php echo $valueTglTransfer; ?>" class="uk-form-width-medium" <?php echo $disabled; ?>>
        </div>
    </div>
</fieldset>
<fieldset data-uk-margin>
    <legend>Input Data Tim</legend>
    <div class="uk-form-row">
        <?php echo form_error('txt_nama_tim'); ?>
        <label for="txt_nama_tim" class="uk-form-label">Nama Sekolah</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_nama_tim" id="txt_nama_tim" value="<?php echo $valueNamaTim; ?>" class="uk-form-width-large" readonly="readonly">
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('opt_gender'); ?>
        <label for="opt_gender" class="uk-form-label">Pilih Gender</label>
        <div class="uk-form-controls">
            <select name="opt_gender" id="opt_gender" <?php echo $disabled; ?>>
                <option selected="selected" value="">Pilih Gender</option>
                <option value="1">Laki-Laki</option>
                <option value="2">Perempuan</option>
            </select>
            <span class="uk-text-danger">Silahkan klik kembali untuk input tim selanjutnya</span>
        </div>
    </div>
    <hr>
    <div class="uk-form-row uk-grid">
        <div class="uk-width-1-2">
            <button class="uk-button uk-button-success uk-float-left" type="submit" name="btn_simpan" value="btn_simpan" <?php echo $disabled; ?>>
                <i class="uk-icon-save"> Simpan</i>
            </button>
        </div>
    </div>
</fieldset>
<?php form_close(); ?>

<hr>

<?php
?>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th style="width: 5%;">No</th>
        <th style="width: 45%;">Nama Tim</th>
        <th style="width: 10%;">Gender</th>
        <th style="width: 25%;">Biodata Siswa</th>
        <th style="width: 10%;">Hapus</th>
    </tr>
    <?php
    if(is_array($sql_tim))
    {
        $no = 1;
        foreach($sql_tim as $row_tim)
        {
            $gender = ($row_tim->pendaftaran_tim_gender == 1) ? "Laki-Laki" : "Perempuan";
            ?>
            <tr>
                <td>
                    <div class="uk-vertical-align">
                        <div class="uk-vertical-align-middle"><?php echo $no; ?></div>
                    </div>
                </td>
                <td>
                    <a href="<?php echo base_url("pendaftaran/form_input_siswa/$row_tim->pendaftaran_tim_id/$query_head->pendaftaran_h_id"); ?>" data-uk-tooltip title="Klik Nama Tim untuk Input Biodata Siswa"><?php echo $row_tim->pendaftaran_tim_nama; ?></a>
                </td>
                <td><?php echo $gender; ?></td>
                <td>
                    <a href="<?php echo base_url("pendaftaran/form_input_siswa/$row_tim->pendaftaran_tim_id/$query_head->pendaftaran_h_id"); ?>" class="uk-button uk-button-success">
                        <i class="uk-icon-edit"></i> Input Biodata Peserta
                    </a>
                </td>
                <td>
                    <a href="<?php echo base_url("pendaftaran/delete_tim/$row_tim->pendaftaran_tim_id/$query_head->pendaftaran_h_id"); ?>" class="uk-button uk-button-danger">
                        <i class="uk-icon-trash-o"></i>
                    </a>
                </td>
                </td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>
<?php
$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_pendaftaran_tim', 'id' => 'form_pendaftaran_tim');
echo form_open_multipart('pendaftaran/input_tim', $attr_form);
?>
    <hr>
    <div class="uk-form-row uk-grid">
        <div class="uk-width-1-2">
            <button class="uk-button uk-button-success" type="submit" name="btn_selesai" value="btn_selesai">
                <i class="uk-icon-thumbs-o-up"> Selesai</i>
            </button>
        </div>
    </div>
</fieldset>
<?php form_close(); ?>
