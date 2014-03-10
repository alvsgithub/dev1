<div class="modal-header">
    <h4><?php echo empty($satauan_item->kode) ? 'Add a new Satuan Item' : 'Edit Satuan : '. $satauan_item->satuan; ?></h4>
</div>
<section_custom>
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
    <table class="table">
	<tr>
            <td>Kode</td>
            <td><?php echo form_input('kode', set_value('kode', $satuan_item->kode)); ?></td>
	</tr>
    <tr>
            <td>Satuan</td>
            <td><?php echo form_input('satuan', set_value('satuan', $satuan_item->satuan)); ?></td>
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

<!-- @End Of File satuan_item/edit.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->