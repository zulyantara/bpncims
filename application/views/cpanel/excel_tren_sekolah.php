<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=tren_pendaftar.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo APP_TITLE; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link href="<?php echo base_url(); ?>assets/uikit/css/uikit.gradient.min.css" rel="stylesheet">
    </head>
    <body>
        <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
            <tr>
                <th rowspan="2" style="width: 25%;">Kota</th>
                <th colspan="2" style="text-align: center;">SD</th>
                <th colspan="2" style="text-align: center;">SMP</th>
                <th colspan="2" style="text-align: center;">SMA</th>
            </tr>
            <tr>
                <th style="width: 10%;text-align: center;">&Sigma; Sekolah</th>
                <th style="width: 10%;text-align: center;">&Sigma; Tim</th>
                <th style="width: 10%;text-align: center;">&Sigma; Sekolah</th>
                <th style="width: 10%;text-align: center;">&Sigma; Tim</th>
                <th style="width: 10%;text-align: center;">&Sigma; Sekolah</th>
                <th style="width: 10%;text-align: center;">&Sigma; Tim</th>
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
    </body>
</html>