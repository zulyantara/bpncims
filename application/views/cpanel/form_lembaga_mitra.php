<?php
$valNamaSekolah = (isset($query_edit)) ? $query_edit->lm_nama_sekolah : set_value('txt_nama_sekolah');
$valAlamat = (isset($query_edit)) ? $query_edit->lm_alamat : set_value('txt_alamat');
$valTelp = (isset($query_edit)) ? $query_edit->lm_telp : set_value('txt_no_telp');
$valWebSite = (isset($query_edit)) ? $query_edit->lm_website : set_value('txt_website');

$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_lembaga_mitra', 'id' => 'form_lembaga_mitra');
?>
<?php
echo form_open('cpanels/input_lembaga_mitra', $attr_form);
?>
    <div class="uk-form-row">
        <?php echo form_error('txt_nama_sekolah'); ?>
        <label for="txt_nama_sekolah" class="uk-form-label">Nama Sekolah</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-building-o"></i>
                <input type="text" placeholder="Nama Sekolah" name="txt_nama_sekolah" id="txt_nama_sekolah" class="uk-form-width-large" value="<?php echo $valNamaSekolah; ?>" autofocus="autofocus">
            </div>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('opt_jenjang'); ?>
        <label for="opt_jenjang" class="uk-form-label">Jenjang Pendidikan</label>
        <div class="uk-form-controls">
            <select name="opt_jenjang" id="opt_jenjang">
                <option value="">Jenjang</option>
                <?php
                foreach($query_jenjang as $row_jenjang)
                {
                    ?>
                    <option value="<?php echo $row_jenjang->jenjang_id; ?>"><?php echo $row_jenjang->jenjang_ket; ?></option>
                    <?php
                }
                ?>
            </select>
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
        <label for="txt_no_telp" class="uk-form-label">No Telepon</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-phone-square"></i>
                <input type="text" placeholder="Nomor Telp" name="txt_no_telp" id="txt_no_telp" class="uk-form-width-medium" value="<?php echo $valTelp; ?>" title="Contoh: 02123456789" data-uk-tooltip>
            </div>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_website'); ?>
        <label for="txt_website" class="uk-form-label">Web Site</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-desktop"></i>
                <input type="text" placeholder="Web Site" name="txt_website" id="txt_website" class="uk-form-width-medium" value="<?php echo $valWebSite; ?>">
            </div>
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('opt_kota'); ?>
        <label for="opt_kota" class="uk-form-label">Regional</label>
        <div class="uk-form-controls">
            <select name="opt_kota" id="opt_kota">
                <option selected="selected" value="">Regional</option>
                <?php
                foreach($sql_kota as $row_regional)
                {
                    $valKota = (isset($query_edit)) ? $query_edit->pendaftaran_h_kota : "";
                    $setSelectKota = ($valKota == $row_regional->kota_no) ? "selected=\"selected\"" : set_select('opt_kota', $row_regional->regional_id);
                    ?>
                        <option value="<?php echo $row_regional->kota_no; ?>" <?php echo $setSelectKota; ?>>
                            <?php echo $row_regional->kota_no." | ".$row_regional->kota_ket; ?>
                        </option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <hr>
    <div class="uk-form-row">
        <button class="uk-button uk-button-primary" type="reset"><i class="uk-icon-file-text-o"></i> Reset</button>
        <?php
        if( ! isset($query_edit))
        {
            ?>
            <button class="uk-button uk-button-success" type="submit" name="btn_save_lm" value="save_lm">
                Simpan <i class="uk-icon-save"></i>
            </button>
            <?php
        }
        else
        {
            ?>
            <button class="uk-button uk-button-success" type="submit" name="btn_update_lm" value="update_lm">
                Simpan <i class="uk-icon-save"></i>
            </button>
            <?php
        }
        ?>
    </div>
<?php form_close(); ?>
<?php echo $links; ?>
<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th class="uk-text-center uk-text-no">No</th>
        <th>Nama Sekolah</th>
        <th>Web Site</th>
        <th>Regional</th>
        <th class="uk-text-center uk-text-option">Option</th>
    </tr>
    <?php
    if(isset($query_lm) AND is_array($query_lm))
    {
        $no = 1 + $this->uri->segment(3);
        foreach($query_lm as $row_lm)
        {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row_lm->lm_nama_sekolah; ?></td>
                <td><?php echo $row_lm->lm_website; ?></td>
                <td><?php echo $row_lm->kota_ket; ?></td>
                <td class="uk-text-center"><a href="<?php echo base_url("cpanels/form_edit_regional/".$row_lm->lm_id); ?>" class="uk-button">Edit</a></td>
            </tr>
            <?php
            $no++;
        }
    }
    else
    {
        ?>
        <td colspan="5" class="uk-text-center uk-text-bold">Data Kosong</td>
        <?php
    }
    ?>
</table>
<?php echo $links; ?>