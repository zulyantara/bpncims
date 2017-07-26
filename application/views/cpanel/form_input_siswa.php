<script>
$(function() {
    $( "#txt_tgl_lahir" ).datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd-mm-yy"
    });
});
</script>
<button class="uk-button" data-uk-toggle="{target:'.my-id'}">Daftar Siswa</button>

<div class="my-id">
    <?php
    $attr_form = array('class' => 'uk-form uk-form-horizontal', 'name' => 'form_input_siswa', 'id' => 'form_input_siswa');
    echo form_open('cpanel/frm_input_siswa', $attr_form);
    ?>
        <div class="uk-form-row">
            <?php echo form_error('txt_nama'); ?>
            <label for="txt_no_register" class="uk-form-label">No Register</label>
            <div class="uk-form-controls">
                <input type="text" name="txt_no_register" id="txt_no_register" placeholder="No Register" class="uk-form-width-medium">
            </div>
        </div>
        <div class="uk-form-row">
            <?php echo form_error('txt_nama'); ?>
            <label for="txt_nama" class="uk-form-label">Nama Lengkap</label>
            <div class="uk-form-controls">
                <input type="text" name="txt_nama" id="txt_nama" placeholder="Nama Lengkap" class="uk-form-width-medium">
            </div>
        </div>
        <div class="uk-form-row">
            <?php echo form_error('txt_kelas'); ?>
            <label for="txt_kelas" class="uk-form-label">Kelas</label>
            <div class="uk-form-controls">
                <input type="text" name="txt_kelas" id="txt_kelas" placeholder="Kelas" class="uk-form-width-medium">
            </div>
        </div>
        <div class="uk-form-row">
            <?php echo form_error('txt_tmp_lahir'); ?>
            <?php echo form_error('txt_tgl_lahir'); ?>
            <label for="txt_nama" class="uk-form-label">Tempat/Tanggal Lahir</label>
            <div class="uk-form-controls">
                <input type="text" name="txt_tmp_lahir" id="txt_tmp_lahir" placeholder="Tempat Lahir" class="uk-form-width-medium">
                <input type="text" name="txt_tgl_lahir" id="txt_tgl_lahir" placeholder="Tanggal Lahir" class="uk-form-width-medium">
            </div>
        </div>
        <div class="uk-form-row">
            <label for="txt_jns_kelamin" class="uk-form-label">Jenis Kelamin</label>
            <div class="uk-form-controls">
                <input type="text" name="txt_jns_kelamin" id="txt_jns_kelamin" class="uk-form-width-medium">
            </div>
        </div>
        <div class="uk-form-row">
            <?php echo form_error('txt_alamat'); ?>
            <label for="txt_alamat" class="uk-form-label">Alamat</label>
            <div class="uk-form-controls">
                <textarea name="txt_alamat" id="txt_alamat"><?php echo set_value('txt_alamat'); ?></textarea>
            </div>
        </div>
        <div class="uk-form-row">
            <?php echo form_error('txt_nama_ayah'); ?>
            <label for="txt_nama_ayah" class="uk-form-label">Nama Ayah & Nama Ibu</label>
            <div class="uk-form-controls">
                <input type="text" name="txt_nama_ayah" id="txt_nama_ayah" placeholder="Nama Ayah" class="uk-form-width-medium">
                <input type="text" name="txt_nama_ibu" id="txt_nama_ibu" placeholder="Nama Ibu" class="uk-form-width-medium">
            </div>
        </div>
        <div class="uk-form-row">
            <?php echo form_error('txt_pekerjaan_ayah'); ?>
            <label for="txt_pekerjaan_ayah" class="uk-form-label">Pekerjaan Ayah & Ibu</label>
            <div class="uk-form-controls">
                <input type="text" name="txt_pekerjaan_ayah" id="txt_pekerjaan_ayah" placeholder="Pekerjaan Ayah" class="uk-form-width-medium">
                <input type="text" name="txt_pekerjaan_ibu" id="txt_pekerjaan_ibu" placeholder="Pekerjaan Ibu" class="uk-form-width-medium">
            </div>
        </div>
        <div class="uk-form-row">
            <?php echo form_error('txt_telp_ortu'); ?>
            <label for="txt_telp_ortu" class="uk-form-label">No. Telepon & Email Ayah/Ibu</label>
            <div class="uk-form-controls">
                <input type="text" name="txt_telp_ortu" id="txt_telp_ortu" placeholder="No Telp Ayah/Ibu" class="uk-form-width-medium">
                    <input type="text" name="txt_email_ortu" id="txt_email_ortu" placeholder="Email Ayah/Ibu" class="uk-form-width-medium">
            </div>
        </div>
        <div class="uk-form-row">
            <button class="uk-button uk-button-success" type="submit"><i class="uk-icon-save"> Simpan</i></button>
        </div>
    <?php form_close(); ?>
</div>

<hr>

<div class="my-id uk-hidden">
    <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
        <caption><i class="uk-icon-th-list"></i> List Siswa</caption>
        <tr>
            <th>No</th>
            <th>Nama Peserta</th>
            <th>Kelas</th>
            <th>Tempat/Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Alamat Siswa</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
        <?php
        if(is_array($sql_siswa))
        {
            $no = 1;
            foreach($sql_siswa as $row_siswa)
            {
                $gender = ($row_siswa->siswa_jns_kelamin == 1) ? "Ikhwan/Pria" : "Akhwat/Wanita";
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $row_siswa->siswa_nama; ?></td>
                    <td><?php echo $row_siswa->siswa_kelas; ?></td>
                    <td><?php echo $row_siswa->siswa_tmp_lahir; ?>/<?php echo $row_siswa->siswa_tgl_lahir; ?></td>
                    <td><?php echo $gender; ?></td>
                    <td><?php echo $row_siswa->siswa_alamat; ?></td>
                    <td><a href="<?php echo base_url("cpanel/edit_siswa"); ?>"><i class="uk-icon-edit"></i></a></td>
                    <td><a href="<?php echo base_url("cpanel/delete_siswa"); ?>"><i class="uk-icon-trash-o"></i></a></td>
                    </td>
                </tr>
                <?php
                $no++;
            }
        }
        ?>
    </table>
</div>