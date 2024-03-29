<section_custom>
    <div id="tbform">
        <b>Group</b>
        <span id="space"> &nbsp;&nbsp;&nbsp; </span>
        <?php echo btn_add('app/group/edit'); ?>
    </div>
    
    <table id="example" class="table table-bordered table-hover table-condensed table-striped">
        <thead>
            <tr id="header1">
                <th>Nama Group</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($groups)): foreach($groups as $g): ?>	
            <tr>
                <td><?php echo anchor('app/group/edit/' . $g->id, $g->nama_group); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/group/edit/' . $g->id); ?>
                    <?php echo btn_delete('app/group/delete/' . $g->id); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
                <tr>
                    <td colspan="2">We could not find any pages.</td>
                </tr>
        <?php endif; ?>	
        </tbody>
    </table>
    
</section_custom>

    


