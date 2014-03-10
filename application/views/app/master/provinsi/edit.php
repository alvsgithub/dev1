<div class="modal-header">
    <h4><?php echo empty($provinsi->id) ? 'Add a new Provinsi' : 'Edit Provinsi : '.$provinsi->nama; ?></h4>
</div>
<section_custom>
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
    <table class="table">
	<tr>
            <td>Nama</td>
            <td><?php echo form_input('nama', set_value('nama', $provinsi->nama)); ?></td>
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