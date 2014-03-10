<div class="modal-header">
    <h4><?php echo empty($periode->id) ? 'Add a new Periode' : 'Edit Periode : '. $periode->tahun; ?></h4>
</div>
<section_custom>
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
    <table class="table">
	<tr>
            <td>Tahun</td>
            <td><?php echo form_input('tahun', set_value('tahun', $periode->tahun)); ?></td>
	</tr>
	<tr>
            <td>Semester</td>
            <td><?php echo form_input('semester', set_value('semester', $periode->semester)); ?></td>
	</tr>
	<tr>
            <td>Locked</td>
            <td><?php echo form_dropdown('locked', $options_locked, $periode->locked); ?></td>
	</tr>
	<tr>
            <td>Active</td>
            <td><?php echo form_dropdown('active', $options_active, $periode->active); ?></td>
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

<!-- @End Of File periode/edit.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->