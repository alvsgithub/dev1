<div class="modal-header">
    <h4><?php echo empty($jenis_item->kode) ? 'Add a new Jenis Item' : 'Edit Jenis Item : '. $jenis_item->kode; ?></h4>
</div>
<section_custom>
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
    <table class="table">
	<tr>
            <td>Kode</td>
            <td><?php echo form_input('kode', set_value('kode', $jenis_item->kode)); ?></td>
	</tr>
    <tr>
            <td>Jenis Item</td>
            <td><?php echo form_input('jenis', set_value('jenis', $jenis_item->jenis)); ?></td>
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

<!-- @End Of File jenis_item/edit.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->