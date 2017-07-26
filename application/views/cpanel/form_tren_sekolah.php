<?php
$attrFrmFilter= array('class' => 'uk-form', 'name' => 'form_cetak', 'id' => 'form_cetak');
echo form_open("cpanels/form_tren_sekolah", $attrFrmFilter);
?>
    <button class="uk-button uk-button-danger" type="submit" name="btn_cetak_excel" value="cetak_excel">Cetak Excel</button>
<?php echo form_close(); ?>

<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th rowspan="2" style="width: 25%;">Kota</th>
        <th colspan="2" class="uk-text-center">SD</th>
        <th colspan="2" class="uk-text-center">SMP</th>
        <th colspan="2" class="uk-text-center">SMA</th>
    </tr>
    <tr>
        <th class="uk-text-center" style="width: 10%;">&Sigma; Sekolah</th>
        <th class="uk-text-center" style="width: 10%;">&Sigma; Tim</th>
        <th class="uk-text-center" style="width: 10%;">&Sigma; Sekolah</th>
        <th class="uk-text-center" style="width: 10%;">&Sigma; Tim</th>
        <th class="uk-text-center" style="width: 10%;">&Sigma; Sekolah</th>
        <th class="uk-text-center" style="width: 10%;">&Sigma; Tim</th>
    </tr>
    <?php
    $total_sd = 0;
    $total_tim_sd = 0;
    $total_smp = 0;
    $total_tim_smp = 0;
    $total_sma = 0;
    $total_tim_sma = 0;
    
    foreach($query_kota as $row_kota)
    {
        $jml_sd = $this->cpanel_model->jml_sd_by_kota($row_kota->kota_no);
        $jml_smp = $this->cpanel_model->jml_smp_by_kota($row_kota->kota_no);
        $jml_sma = $this->cpanel_model->jml_sma_by_kota($row_kota->kota_no);
        
        $jml_tim_sd = $this->cpanel_model->jml_tim_by_kota($row_kota->kota_no, 1);
        $jml_tim_smp = $this->cpanel_model->jml_tim_by_kota($row_kota->kota_no, 2);
        $jml_tim_sma = $this->cpanel_model->jml_tim_by_kota($row_kota->kota_no, 3);
        
        /*
        $jmlTimSd = ($jml_tim_sd->pendaftaran_h_jml_tim == "") ? 0 : $jml_tim_sd->pendaftaran_h_jml_tim;
        $jmlTimSmp = ($jml_tim_smp->pendaftaran_h_jml_tim == "") ? 0 : $jml_tim_smp->pendaftaran_h_jml_tim;
        $jmlTimSma = ($jml_tim_sma->pendaftaran_h_jml_tim == "") ? 0 : $jml_tim_sma->pendaftaran_h_jml_tim;
        */
        $jmlTimSd = ($jml_tim_sd == "") ? 0 : $jml_tim_sd;
        $jmlTimSmp = ($jml_tim_smp == "") ? 0 : $jml_tim_smp;
        $jmlTimSma = ($jml_tim_sma == "") ? 0 : $jml_tim_sma;
        ?>
            <tr>
                <td><?php echo $row_kota->kota_ket; ?></td>
                <td class="uk-text-center"><?php echo $jml_sd; ?></td>
                <td class="uk-text-center"><?php echo $jmlTimSd; ?></td>
                <td class="uk-text-center"><?php echo $jml_smp; ?></td>
                <td class="uk-text-center"><?php echo $jmlTimSmp; ?></td>
                <td class="uk-text-center"><?php echo $jml_sma; ?></td>
                <td class="uk-text-center"><?php echo $jmlTimSma; ?></td>
            </tr>
        <?php
        $total_sd = $total_sd + $jml_sd;
        $total_tim_sd = $total_tim_sd + $jml_tim_sd;
        
        $total_smp = $total_smp + $jml_smp;
        $total_tim_smp = $total_tim_smp + $jml_tim_smp;
        
        $total_sma = $total_sma + $jml_sma;
        $total_tim_sma = $total_tim_sma + $jml_tim_sma;
    }
    ?>
    <tr>
        <td><span class="uk-text-danger uk-text-bold">Total</span></td>
        <td class="uk-text-center"><span class="uk-text-danger"><?php echo $total_sd; ?></span></td>
        <td class="uk-text-center"><span class="uk-text-danger"><?php echo $total_tim_sd; ?></span></td>
        <td class="uk-text-center"><span class="uk-text-danger"><?php echo $total_smp; ?></span></td>
        <td class="uk-text-center"><span class="uk-text-danger"><?php echo $total_tim_smp; ?></span></td>
        <td class="uk-text-center"><span class="uk-text-danger"><?php echo $total_sma; ?></span></td>
        <td class="uk-text-center"><span class="uk-text-danger"><?php echo $total_tim_sma; ?></span></td>
    </tr>
</table>