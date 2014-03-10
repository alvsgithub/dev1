<div class="modal-header">
    <h4>Satuan Item</h4>
</div>
<section_custom>
    <?php echo btn_add('app/satuan_item/edit'); ?>
    <table id="example" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr id="header1">
                <th>Kode</th>
                <th>Satuan Item</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($satuan_item)): foreach($satuan_item as $satuan): ?>	
            <tr>
                <td><?php echo anchor('app/satuan_item/edit/' . $satuan->kode, $satuan->kode); ?></td>
                <td><?php echo anchor('app/satuan_item/edit/' . $satuan->kode, $satuan->satuan); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/satuan_item/edit/' . $satuan->kode); ?>
                    <?php echo btn_delete('app/satuan_item/delete/' . $satuan->kode); ?>
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

<!-- @End Of File satuan_item/index.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->

