<div class="modal-header">
    <h4>Pages</h4>
</div>
<section_custom>
    
    <?php echo btn_add('app/page/edit'); ?>
    
    <table id="example" class="table table-bordered table-hover table-condensed table-striped">
        <thead>
            <tr id="header1">
                <th>Title</th>
                <th>Parent</th>
                <th id="actions1">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($pages)): foreach($pages as $page): ?>	
            <tr>
                <td><?php echo anchor('app/page/edit/' . $page->id, $page->title); ?></td>
                <td><?php echo $page->parent_slug; ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/page/edit/' . $page->id); ?>
                    <?php echo btn_delete('app/page/delete/' . $page->id); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="3">We could not find any pages.</td>
            </tr>
            <?php endif; ?>	
        </tbody>
    </table>
    
</section_custom>