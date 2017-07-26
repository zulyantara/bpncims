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
                <th style="width: 5%;">No</th>
                <th style="width: 55%;">Nama Tim/Sekolah</th>
                <th style="width: 15%;text-align: center;">No Peserta</th>
                <th style="width: 5%;">Gender</th>
                <th style="width: 5%;">Tingkat</th>
            </tr>
            <?php
            if(is_array($sql_sekolah_aktif))
            {
                $no = 1;
                foreach($sql_sekolah_aktif as $row_sekolah_aktif)
                {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $row_sekolah_aktif->pendaftaran_tim_nama; ?></td>
                        <td style="text-align: center;"><?php echo $row_sekolah_aktif->pendaftaran_tim_noreg; ?></td>
                        <td><?php echo ($row_sekolah_aktif->pendaftaran_tim_gender == 1) ? "Laki - Laki" : "Perempuan"; ?></td>
                        <td><?php echo $row_sekolah_aktif->jenjang_ket; ?></td>
                    </tr>
                    <?php
                    $no++;
                }
            }
            else
            {
                ?>
                <tr>
                    <td colspan="7" align="center"><b>Daftar sekolah terdaftar kosong</b></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>