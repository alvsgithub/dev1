<div class="modal-header">
    <h4>Jenis Item</h4>
</div>
<section_custom>
    <?php echo btn_add('app/jenis_item/edit'); ?>
    <table id="example" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr id="header1">
                <th>Kode</th>
                <th>Jenis</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($jenis_item)): foreach($jenis_item as $jenis): ?>	
            <tr>
                <td><?php echo anchor('app/jenis_item/edit/' . $jenis->kode, $jenis->kode); ?></td>
                <td><?php echo anchor('app/jenis_item/edit/' . $jenis->kode, $jenis->jenis); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/jenis_item/edit/' . $jenis->kode); ?>
                    <?php echo btn_delete('app/jenis_item/delete/' . $jenis->kode); ?>
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

<!-- @End Of File jenis_item/index.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->

