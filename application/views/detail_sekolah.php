<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
    <tr>
        <td class="uk-text-bold">Kode Pendaftaran</td>
        <td>: <?php echo $query_detail->pendaftaran_h_kode; ?></td>
        <td class="uk-text-bold">Nama Sekolah</td>
        <td>: <?php echo $query_detail->pendaftaran_h_nama_sekolah; ?></td>
    </tr>
    <tr>
        <td class="uk-text-bold">Jenjang Pendidikan</td>
        <td>: <?php echo $query_detail->jenjang_ket; ?></td>
        <td class="uk-text-bold">Kota Kompetisi</td>
        <td>: <?php echo $query_detail->kota_ket; ?></td>
    </tr>
    <tr>
        <td class="uk-text-bold">Alamat</td>
        <td>: <?php echo $query_detail->pendaftaran_h_alamat_sekolah; ?></td>
        <td class="uk-text-bold">No Telp Sekolah</td>
        <td>: <?php echo $query_detail->pendaftaran_h_telp_sekolah; ?></td>
    </tr>
    <tr>
        <td class="uk-text-bold">Nama Kepsek</td>
        <td>: <?php echo $query_detail->pendaftaran_h_nama_kepsek; ?></td>
        <td class="uk-text-bold">No Telp Kepsek</td>
        <td>: <?php echo $query_detail->pendaftaran_h_hp_kepsek; ?></td>
    </tr>
    <tr>
        <td class="uk-text-bold">Nama Pendamping</td>
        <td>: <?php echo $query_detail->pendaftaran_h_nama_pendamping; ?></td>
        <td class="uk-text-bold">No Telp Pendamping</td>
        <td>: <?php echo $query_detail->pendaftaran_h_hp_pendamping; ?></td>
    </tr>
    <tr>
        <td class="uk-text-bold">Email Pendamping</td>
        <td>: <?php echo $query_detail->pendaftaran_h_email; ?></td>
        <td class="uk-text-bold">Jumlah Tim</td>
        <td>: <?php echo $query_detail->pendaftaran_h_jml_tim; ?></td>
    </tr>
    <tr>
        <td class="uk-text-bold">Status</td>
        <td>: <?php echo ($query_detail->pendaftaran_h_isactive == 1) ? "Aktif" : "Tidak Aktif"; ?></td>
    </tr>
</table>
<button type="button" name="btn_refresh" id="btn_refresh" value="refresh" class="uk-button">Tutup</button>

<script type="text/javascript">
    $(document).ready(function(){
        $("#btn_refresh").click(function(){
            $("#list_data").hide();
        });
    });
</script>