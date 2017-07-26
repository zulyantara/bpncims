<?php
$jns_kelamin = ($sql_tim->pendaftaran_tim_gender == 1) ? "Laki-Laki" : "Perempuan";

if(substr($sql_tim->pendaftaran_tim_noreg,2,1)==1)
{
    $kelas = "<option value=\"4\">4</option><option value=\"5\">5</option>";
}
elseif(substr($sql_tim->pendaftaran_tim_noreg,2,1)==2)
{
    $kelas = "<option value=\"7\">7</option><option value=\"8\">8</option>";
}
elseif(substr($sql_tim->pendaftaran_tim_noreg,2,1)==3)
{
    $kelas = "<option value=\"10\">10</option><option value=\"11\">11</option>";
}

$disabled = ($count_siswa >= 5) ? "disabled=\"disabled\"" : "";

$valBulan = array("01"=>"Januari","02"=>"Februari","03"=>"Maret","04"=>"April","05"=>"Mei","06"=>"Juni","07"=>"Juli","08"=>"Agustus","09"=>"September","10"=>"Oktober","11"=>"November","12"=>"Desember");
$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_input_siswa', 'id' => 'form_input_siswa');
echo form_open("pendaftaran/input_siswa/$tim_id/$pendaftaran_head_id->pendaftaran_h_id", $attr_form);
?>
    <input type="hidden" value="<?php echo $pendaftaran_head_id->pendaftaran_h_id; ?>" name="txt_pendaftaran_h_id" id="txt_pendaftaran_h_id">
    <input type="hidden" value="<?php echo $tim_id; ?>" name="txt_pendaftaran_tim_id" id="txt_pendaftaran_tim_id">
    <input type="hidden" value="<?php echo $sql_tim->pendaftaran_tim_gender; ?>" name="txt_jns_kelamin" id="txt_jns_kelamin">
    <div class="uk-form-row">
        <?php echo form_error('txt_nama'); ?>
        <label for="txt_nama" class="uk-form-label">Nama Lengkap</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_nama" id="txt_nama" placeholder="Nama Lengkap" class="uk-form-width-medium" autofocus="autofocus" <?php echo $disabled; ?>>
            <input type="text" name="txt_gender" id="txt_gender" class="uk-form-width-medium uk-form-blank" readonly="readonly" value="<?php echo $jns_kelamin; ?>">
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('opt_kelas'); ?>
        <label for="opt_kelas" class="uk-form-label">Kelas</label>
        <div class="uk-form-controls">
            <select name="opt_kelas" id="opt_kelas" <?php echo $disabled; ?>>
                <?php echo $kelas; ?>
            </select>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_tmp_lahir'); ?>
        <?php echo form_error('txt_tgl_lahir'); ?>
        <label for="txt_nama" class="uk-form-label">Tempat/Tanggal Lahir</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_tmp_lahir" id="txt_tmp_lahir" placeholder="Tempat Lahir" class="uk-form-width-medium" <?php echo $disabled; ?>>
            <!--<input type="text" name="txt_tgl_lahir" id="txt_tgl_lahir" placeholder="Tanggal Lahir" class="uk-form-width-medium">-->
            <select name="opt_bulan_lahir" id="opt_bulan_lahir" <?php echo $disabled; ?>>
                <option selected="selected">Bulan</option>
                <?php
                foreach($valBulan as $keyBulan=>$rowBulan)
                {
                    ?>
                    <option value="<?php echo $keyBulan; ?>"><?php echo $rowBulan; ?></option>
                    <?php
                }
                ?>
            </select>
            <input type="text" name="txt_tgl_lahir" id="txt_tgl_lahir" placeholder="Tgl" class="uk-form-width-mini" <?php echo $disabled; ?>>
            <input type="text" name="txt_thn_lahir" id="txt_thn_lahir" placeholder="Tahun" class="uk-form-width-small" <?php echo $disabled; ?>>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_alamat'); ?>
        <label for="txt_alamat" class="uk-form-label">Alamat Lengkap</label>
        <div class="uk-form-controls">
            <textarea name="txt_alamat" id="txt_alamat" class="uk-form-width-large" <?php echo $disabled; ?>></textarea>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('opt_agama'); ?>
        <label for="opt_agama" class="uk-form-label">Agama</label>
        <div class="uk-form-controls">
            <select name="opt_agama" id="opt_agama" <?php echo $disabled; ?>>
                <option value="1" selected="selected">Islam</option>
                <option value="0">Non Islam</option>
            </select>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_nama_ayah'); ?>
        <label for="txt_nama_ayah" class="uk-form-label">Nama & Pekerjaan Ayah</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_nama_ayah" id="txt_nama_ayah" placeholder="Nama Ayah" class="uk-form-width-medium" <?php echo $disabled; ?>>
            <input type="text" name="txt_pekerjaan_ayah" id="txt_pekerjaan_ayah" placeholder="Pekerjaan Ayah" class="uk-form-width-medium" <?php echo $disabled; ?>>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_nama_ibu'); ?>
        <?php echo form_error('txt_pekerjaan_ibu'); ?>
        <label for="txt_pekerjaan_ayah" class="uk-form-label">Nama & Pekerjaan Ibu</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_nama_ibu" id="txt_nama_ibu" placeholder="Nama Ibu" class="uk-form-width-medium" <?php echo $disabled; ?>>
            <input type="text" name="txt_pekerjaan_ibu" id="txt_pekerjaan_ibu" placeholder="Pekerjaan Ibu" class="uk-form-width-medium" <?php echo $disabled; ?>>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_telp_ortu'); ?>
        <?php echo form_error('txt_email_ortu'); ?>
        <label for="txt_telp_ortu" class="uk-form-label">No. Telepon & Email Ayah/Ibu</label>
        <div class="uk-form-controls">
            <input type="text" name="txt_telp_ortu" id="txt_telp_ortu" placeholder="No Telp Ayah/Ibu" class="uk-form-width-medium" <?php echo $disabled; ?>>
            <input type="text" name="txt_email_ortu" id="txt_email_ortu" placeholder="Email Ayah/Ibu" class="uk-form-width-medium" <?php echo $disabled; ?>>
        </div>
    </div>
    <hr>
    <div class="uk-form-row uk-grid">
        <div class="uk-width-1-2">
            <button class="uk-button uk-button-success uk-float-left" type="submit" name="btn_simpan" id="btn_simpan" value="Simpan" <?php echo $disabled; ?>>
                <i class="uk-icon-save"> Simpan</i>
            </button>
        </div>
        <div class="uk-width-1-2">
            <button class="uk-button uk-button-success uk-float-right" type="submit" name="btn_kembali" id="btn_kembali" value="Kembali">
                <i class="uk-icon-undo"> Input Tim Selanjutnya</i>
            </button>
        </div>
        <div class="uk-width-1-2">
            <?php echo ($count_siswa < 5) ? "<div class=\"uk-text-small\">* Silahkan input biodata siswa berikutnya</div>" : ""; ?>
        </div>
    </div>
<?php form_close(); ?>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th>No</th>
        <th>Nama Peserta</th>
        <th>Kelas</th>
        <th>Tempat/Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Alamat Siswa</th>
        <th>Hapus</th>
    </tr>
    <?php
    if(is_array($sql_siswa))
    {
        $no = 1;
        foreach($sql_siswa as $row_siswa)
        {
            $gender = ($row_siswa->siswa_jns_kelamin == 1) ? "Laki-Laki" : "Perempuan";
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row_siswa->siswa_nama; ?></td>
                <td><?php echo $row_siswa->siswa_kelas; ?></td>
                <td><?php echo $row_siswa->siswa_tmp_lahir; ?>/<?php echo $row_siswa->siswa_tgl_lahir; ?></td>
                <td><?php echo $gender; ?></td>
                <td><?php echo $row_siswa->siswa_alamat; ?></td>
                <td>
                    <!--<div class="uk-button-group">-->
                        <!--<a href="<?php echo base_url("pendaftaran/form_edit_siswa/".$tim_id."/".$pendaftaran_head_id->pendaftaran_h_id."/".$row_siswa->siswa_id); ?>" class="uk-button uk-button-primary"><i class="uk-icon-edit"></i></a>-->
                        <a href="<?php echo base_url("pendaftaran/delete_siswa/".$tim_id."/".$pendaftaran_head_id->pendaftaran_h_id)."/".$row_siswa->siswa_id; ?>" class="uk-button uk-button-danger"><i class="uk-icon-trash-o"></i></a>
                    <!--</div>-->
                </td>
                </td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>