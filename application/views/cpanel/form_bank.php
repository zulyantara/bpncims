<?php
$valBankKode = (isset($query_edit)) ? $query_edit->bank_kode : set_value('txt_bank_kode');
$valBankKet = (isset($query_edit)) ? $query_edit->bank_ket : set_value('txt_bank_ket');

$attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_bank', 'id' => 'form_bank');
?>
<?php
echo form_open('cpanels/input_bank', $attr_form);
?>
    <div class="uk-form-row">
        <?php echo form_error('txt_bank_kode'); ?>
        <label for="txt_bank_kode" class="uk-form-label">Kode</label>
        <div class="uk-form-controls">
            <input type="text" placeholder="Kode" name="txt_bank_kode" id="txt_bank_kode" class="uk-form-width-medium" value="<?php echo $valBankKode; ?>" autofocus="autofocus">
        </div>
    </div>
    <div class="uk-form-row">
        <?php echo form_error('txt_bank_ket'); ?>
        <label for="txt_bank_ket" class="uk-form-label">Bank</label>
        <div class="uk-form-controls">
            <div class="uk-form-icon">
                <i class="uk-icon-building-o"></i>
                <input type="text" placeholder="Bank" name="txt_bank_ket" id="txt_bank_ket" class="uk-form-width-medium" value="<?php echo $valBankKet; ?>">
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
            <button class="uk-button uk-button-success" type="submit" name="btn_save_bank" value="save_bank">
                Simpan <i class="uk-icon-save"></i>
            </button>
            <?php
        }
        else
        {
            ?>
            <button class="uk-button uk-button-success" type="submit" name="btn_update_bank" value="update_bank">
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
        <th>Kode</th>
        <th>Bank</th>
        <th class="uk-text-center uk-text-option">Option</th>
    </tr>
    <?php
    if(isset($query_bank) AND is_array($query_bank))
    {
        $no = 1 + $this->uri->segment(3);
        foreach($query_bank as $row_bank)
        {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row_bank->bank_kode; ?></td>
                <td><?php echo $row_bank->bank_ket; ?></td>
                <td class="uk-text-center"><a href="<?php echo base_url("cpanels/form_edit_bank/".$row_bank->bank_kode); ?>" class="uk-button">Edit</a></td>
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