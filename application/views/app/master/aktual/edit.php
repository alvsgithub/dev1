<div class="modal-header">
    <h4><?php echo empty($item->kode) ? 'Add a new Item' : 'Edit Item : '. $item->kode; ?></h4>
</div>
<section_custom>
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
    <table class="table">
	<tr>
            <td>Kode</td>
            <td><?php echo form_input('kode', set_value('kode', $item->kode)); ?></td>
	</tr>
	<tr>
            <td>Nama</td>
            <td><?php echo form_input('nama', set_value('nama', $item->nama)); ?></td>
	</tr>
	<tr>
            <td>Jenis</td>
            <td><?php echo form_dropdown('jenis', $options_jenis, $item->jenis); ?></td>
	</tr>
	<tr>
            <td>Satuan</td>
            <td><?php echo form_input('satuan', set_value('satuan', $item->satuan)); ?></td>
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