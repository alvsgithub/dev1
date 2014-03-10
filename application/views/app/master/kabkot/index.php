<div class="modal-header">
    <h4>Kabupaten Kota</h4>
</div>
<section_custom>
    <?php echo btn_add('app/kabkot/edit'); ?>
    
    <table id="example" class="table table-striped table-bordered table-condensed table-hover">
        <thead>
            <tr id="header1">
                <th>Nama</th>
                <th>Jenis</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        if(count($kabkot)): foreach($kabkot as $kk): ?>	
            <tr>
                <td><?php echo anchor('app/kabkot/edit/' . $kk->id, $kk->nama); ?></td>
                <td><?php echo $kk->jenis; ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/kabkot/edit/' . $kk->id); ?>
                    <?php echo btn_delete('app/kabkot/delete/' . $kk->id); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
                <tr>
                    <td colspan="3">We could not find any data.</td>
                </tr>
        <?php endif; ?>	
        </tbody>
    </table>

</section_custom>

