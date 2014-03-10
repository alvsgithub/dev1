<div class="modal-header">
    <h4>Slider</h4>
</div>
<section_custom>
    
    <?php echo btn_add('app/slider/edit'); ?>
    
    <table id="example" class="table table-bordered table-hover table-condensed table-striped">
        <thead>
            <tr id="header1">
                <th>Caption</th>
                <th>Images</th>
                <th id="actions1">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($slider)): foreach($slider as $slide): ?>	
            <tr>
                <td><?php echo anchor('app/slider/edit/' . $slide->id, $slide->caption); ?></td>
                <td><?php echo $slide->images_link; ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/slider/edit/' . $slide->id); ?>
                    <?php echo btn_delete('app/slider/delete/' . $slide->id); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="3">We could not find any slider.</td>
            </tr>
            <?php endif; ?>	
        </tbody>
    </table>
    
</section_custom>