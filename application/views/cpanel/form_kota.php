<?php
$valKotaKet = (isset($query_edit)) ? $query_edit->kota_ket : set_value('txt_kota_ket');

$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_kota', 'id' => 'form_kota');
?>
<?php
echo form_open('cpanels/input_kota', $attr_form);
?>
    <div class="uk-form-row">
        <?php echo form_error('txt_kota_ket'); ?>
        <label for="txt_kota_ket" class="uk-form-label">Kota</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-building-o"></i>
                <input type="text" placeholder="Kota" name="txt_kota_ket" id="txt_kota_ket" class="uk-form-width-medium" value="<?php echo $valKotaKet; ?>" autofocus="autofocus">
            </div>
        </div>
    </div>
    <hr>
    <div class="uk-form-row">
        <button class="uk-button uk-button-primary" type="reset"><i class="uk-icon-file-text-o"></i> Reset</button>
        <?php
        if( ! isset($query_edit))
        {
            ?>
            <button class="uk-button uk-button-success" type="submit" name="btn_save_kota" value="save_kota">
                Simpan <i class="uk-icon-save"></i>
            </button>
            <?php
        }
        else
        {
            ?>
            <button class="uk-button uk-button-success" type="submit" name="btn_update_kota" value="update_kota">
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
        <th>Kota</th>
        <th class="uk-text-center uk-text-option">Option</th>
    </tr>
    <?php
    if(isset($query_kota) AND is_array($query_kota))
    {
        $no = 1 + $this->uri->segment(3);
        foreach($query_kota as $row_kota)
        {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row_kota->kota_no." | ".$row_kota->kota_ket; ?></td>
                <td class="uk-text-center"><a href="<?php echo base_url("cpanels/form_edit_regional/".$row_kota->kota_no); ?>" class="uk-button">Edit</a></td>
            </tr>
            <?php
            $no++;
        }
    }
    else
    {
        ?>
        <td colspan="3" class="uk-text-center uk-text-bold">Data Kosong</td>
        <?php
    }
    ?>
</table>
<?php echo $links; ?>