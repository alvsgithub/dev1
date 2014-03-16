<div class="modal-header">
    <h4>Data Anggaran - Item : <?php echo $jenis; ?></h4>
</div>
<section_custom>
	
	<form id="form_import" method="post" action="<?php echo site_url('app/anggaran/run_import') ?>" enctype="multipart/form-data" role="form">
		<input type="hidden" id="periode" name="periode">
		<input type="file" id="import_browse" name="item" class="easyui-linkbutton" onChange="document.getElementById('periode').value = document.getElementById('id_periode').value;this.form.submit();"> <!--  -->
	</form>
	
        <span id="labelPeriode">Periode : </span>
		<select id="id_periode" name="id_periode" style="width: 100px;">
			<?php foreach($options_periode as $periode) { ?>
				<option value="<?php echo $periode->id; ?>"><?php echo $periode->tahun.'0'.$periode->semester; ?></option>
			<?php } ?>
		</select>
		<span id="space"> &nbsp;&nbsp;&nbsp; </span>
		<!-- <span id="space2"> &nbsp; </span> -->
		
    <?php echo btn_add('app/anggaran/edit/'.$jenis.'-new'); ?>    
    
    <table id="example" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr id="header1">
                <th>Kode</th>
<<<<<<< HEAD
                <th>Periode</th>
                <th style='display:none;'>Id Periode</th>
=======
                <th style="display:none;">ID Periode</th>
>>>>>>> 1228ed385a51e7be2da09771f21f889de0bce8d3
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga Pagu</th>
                <th>Harga OE</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($item)): foreach($item as $it): ?>	
            <tr>
                <td><?php echo anchor('app/anggaran/edit/' . $jenis .'-'. $it->id, $it->kode); ?></td>
<<<<<<< HEAD
                <td><?php echo $it->periode; ?></td>
                <td id='get_id_periode' style='display:none;'><?php echo $it->id_periode; ?></td>
=======
                <td style="display:none;"><?php echo $it->id_periode; ?></td>
>>>>>>> 1228ed385a51e7be2da09771f21f889de0bce8d3
                <td><?php echo $it->nama; ?></td>
                <td><?php echo $it->satuan; ?></td>
                <td style="text-align: right;"><?php echo number_format($it->harga_pagu, 2, ',', '.'); ?></td>
                <td style="text-align: right;"><?php echo number_format($it->harga_oe, 2, ',', '.'); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/anggaran/edit/' . $jenis .'-'. $it->id); ?>
                    <?php echo btn_delete('app/anggaran/delete/' . $jenis .'-'. $it->id); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
                <tr>
                    <td colspan="7">We could not find any data.</td>
                </tr>
        <?php endif; ?>	
        </tbody>
    </table>
<<<<<<< HEAD
    
    <form id="form_import" method="post" action="<?php echo site_url('app/anggaran/run_import') ?>" enctype="multipart/form-data" role="form">
        <td><input type="file" id="import" name="item"></td>
        <td><input type="hidden" id='post_id_periode' value="periode" name="periode"></td> 
        <td><input id="import_item" type="button" value="Import" name="save" /></td>         
    </form>

	<?php  // echo form_open_multipart('chapter') . "\n"; ?>
	<!-- <table>
	  <tr>
	  <td><input type="file" id="file_upload" name="userfile" size="20" /></td>
	  </tr>
	   <tr>
	   <td>&nbsp;</td>
	   <td valign="top" >
	   <?php // echo form_submit('submit', 'Upload'); ?></td>
	 </tr>
	</table>
	<?php // echo form_close(); ?>
	<?php
	// if ($this->session->flashdata('msg_excel')){
	?>
	<div class="msg"><?php// echo $this->session->flashdata('msg_excel'); ?></div>
	<?php // } ?>
	-->
</section_custom>
<script type="text/javascript">

    $('#import_item').click(function() {
        var txt = $('#get_id_periode').text();
        $("#post_id_periode").val(txt);
        $('#form_import').submit();
    });

=======
</section_custom>
<script>
	function import(){
		window.open('<?php echo site_url('app/anggaran/run_import') ?>';
	}
>>>>>>> 1228ed385a51e7be2da09771f21f889de0bce8d3
</script>

