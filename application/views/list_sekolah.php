<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <th>No</th>
        <th>Nama Sekolah</th>
        <th>Kota</th>
        <th>Tingkat</th>
    </tr>
    <?php
    if(is_array($sql_pendaftaran))
    {
        $no = 1;
        foreach($sql_pendaftaran as $row_pendaftaran)
        {
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row_pendaftaran->pendaftaran_h_nama_sekolah; ?></td>
                <td><?php echo $row_pendaftaran->kota_ket; ?></td>
                <td><?php echo $row_pendaftaran->jenjang_ket; ?></td>
            </tr>
            <?php
            $no++;
        }
    }
    ?>
</table>