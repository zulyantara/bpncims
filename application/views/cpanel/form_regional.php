<?php
$valRegionalKet = (isset($query_edit)) ? $query_edit->regional_ket : set_value('txt_regional_ket');

$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_regional', 'id' => 'form_regional');
?>
<?php
echo form_open('cpanels/input_regional', $attr_form);
?>
    <div class="uk-form-row">
        <?php echo form_error('txt_regional_ket'); ?>
        <label for="txt_regional_ket" class="uk-form-label">Regional</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-building-o"></i>
                <input type="text" placeholder="Nama Sekolah" name="txt_regional_ket" id="txt_regional_ket" class="uk-form-width-medium" value="<?php echo $valRegionalKet; ?>">
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
            <button class="uk-button uk-button-success" type="submit" name="btn_save_regional" value="save_regional">
                Simpan <i class="uk-icon-save"></i>
            </button>
            <?php
        }
        else
        {
            ?>
            <button class="uk-button uk-button-success" type="submit" name="btn_update_regional" value="update_regional">
                Simpan <i class="uk-icon-save"></i>
            </button>
            <?php
        }
        ?>
    </div>
<?php form_close(); ?>

<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th class="uk-text-center uk-text-no">No</th>
        <th>Regional</th>
        <th class="uk-text-center uk-text-option">Option</th>
    </tr>
    <?php
    if(isset($query_regional) AND is_array($query_regional))
    {
        $no = 1;
        foreach($query_regional as $row_regional)
        {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row_regional->regional_ket; ?></td>
                <td class="uk-text-center"><a href="<?php echo base_url("cpanels/form_edit_regional"); ?>" class="uk-button">Edit</a></td>
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