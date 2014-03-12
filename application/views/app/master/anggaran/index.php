<div class="modal-header">
    <h4>Data Anggaran - Item : <?php echo $jenis; ?></h4>
</div>
<section_custom>

    <span id="labelPeriode">Periode : </span>
    <select id="id_periode" name="id_periode" style="width: 100px;">
        <?php foreach($options_periode as $periode) { ?>
            <option value="<?php echo $periode->tahun.'0'.$periode->semester; ?>"><?php echo $periode->tahun.'0'.$periode->semester; ?></option>
        <?php } ?>
    </select>
    <span id="space"> &nbsp;&nbsp;&nbsp; </span>
    <?php echo btn_add('app/anggaran/edit/'.$jenis.'-new'); ?>    
    
    <table id="example" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr id="header1">
                <th>Kode</th>
                <th style="display: none;">Periode</th>
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
                <td style="display: none;"><?php echo $it->periode; ?></td>
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
    
</section_custom>
<script>
</script>

