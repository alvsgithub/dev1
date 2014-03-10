<div class="modal-header">
    <h4><?php echo empty($item_anggaran->kode) ? 'Add a new Item Anggaran' : 'Edit Item Anggaran : '. $item_anggaran->nama; ?></h4>
</div>
<section_custom>
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
    <table class="table">
	<tr>
        <td>Kode</td>
        <td><?php echo form_input('kode', set_value('kode', $item_anggaran->kode)); ?></td>
	</tr>
    <tr>
        <td>Periode</td>
        <td><?php echo form_dropdown('id_periode', $options_periode, $item_anggaran->id_periode); ?></td>
    </tr>
	<tr>
        <td>Nama Item</td>
        <td><?php echo form_input('nama', set_value('nama', $item_anggaran->nama)); ?></td>
	</tr>
	<tr>
        <td>Satuan</td>
        <td><?php echo form_dropdown('kode_satuan', $options_satuan, $item_anggaran->kode_satuan); ?></td>
	</tr>
	<tr>
        <td>Jenis Item</td>
        <td><?php echo form_dropdown('kode_jenis_item', $options_jenis_item, $item_anggaran->kode_jenis_item); ?></td>
	</tr>
	<tr>
        <td>Harga Pagu</td>
        <td><?php echo form_input('harga_pagu', set_value('harga_pagu', $item_anggaran->harga_pagu)); ?></td>
	</tr>
	<tr>
        <td>Harga OE</td>
        <td><?php echo form_input('harga_oe', set_value('harga_oe', $item_anggaran->harga_oe)); ?></td>
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

<!-- @End Of File item_anggaran/edit.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->