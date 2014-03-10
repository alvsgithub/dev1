<div class="modal-header">
    <h4>Provinsi</h4>
</div>
<section_custom>
    <?php echo btn_add('app/provinsi/edit'); ?>
    <table id="example" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr id="header1">
                <th>Nama Provinsi</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($provinsi)): foreach($provinsi as $prov): ?>	
            <tr>
                <td><?php echo anchor('app/provinsi/edit/' . $prov->id, $prov->nama); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/provinsi/edit/' . $prov->id); ?>
                    <?php echo btn_delete('app/provinsi/delete/' . $prov->id); ?>
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

