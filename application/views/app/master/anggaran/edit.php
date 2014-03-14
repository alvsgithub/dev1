<div class="modal-header">
    <h4><?php echo empty($item->kode) ? 'Add a new Item Anggaran - '.$item->jenis : 'Edit Item Anggaran - '.$item->jenis.' : '. $item->kode; ?></h4>
</div>
<section_custom>
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
    <table class="table table-condensed">
        <input name="jenis" value="<?php echo $item->jenis; ?>" type="hidden">
	<tr>
            <td style="width: 15%">Periode (Tahun Semester)</td>
            <td>
                <select name="id_periode">
                <?php foreach($options_periode as $periode) { ?>
                    <option value="<?php echo $periode->id; ?>"><?php echo $periode->tahun.'0'.$periode->semester; ?></option>
                <?php } ?>
                </select>
            </td>
	</tr>
	<tr>
            <td>Kode</td>
            <td><?php echo form_input('kode', set_value('kode', $item->kode)); ?></td>
	</tr>
	<tr>
            <td>Nama</td>
            <td><?php echo form_input('nama', set_value('nama', $item->nama)); ?></td>
	</tr>
	<tr>
            <td>Satuan</td>
            <td><?php echo form_input('satuan', set_value('satuan', $item->satuan)); ?></td>
	</tr>
	<tr>
            <td>Harga Pagu</td>
            <td><?php echo form_input('harga_pagu', set_value('harga_pagu', $item->harga_pagu), 'style="text-align:right"'); ?></td>
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