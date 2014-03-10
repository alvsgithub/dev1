<div class="modal-header">
    <h4><?php echo empty($kabkot->id) ? 'Add a new Kabupaten Kota' : 'Edit Kabupaten Kota : '.$kabkot->nama; ?></h4>
</div>
<section_custom>
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
    <table class="table">
	<tr>
            <td style="width: 10%">Nama</td>
            <td><?php echo form_input('nama', set_value('nama', $kabkot->nama)); ?></td>
	</tr>
    <tr>
            <td>Jenis</td>
            <td><?php echo form_dropdown('jenis', $options_jenis, $kabkot->jenis); ?></td>
	</tr>
    <tr>
            <td>Provinsi</td>
            <td><?php echo form_dropdown('id_provinsi', $options_provinsi, $kabkot->id_provinsi); ?></td>
	</tr>
	<tr>
            <td></td>
            <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
	</tr>
    </table>
<?php echo form_close();?>
</section_custom>
<script>
    $(function() {
        $('.datepicker').datepicker({ format : 'yyyy-mm-dd' });
    });
</script>