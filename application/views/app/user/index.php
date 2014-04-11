
<section_custom>
    <div id="tbform">
        <b>Users</b>
        <span id="space"> &nbsp;&nbsp;&nbsp; </span>
        <?php echo btn_add('app/user/edit'); ?>
    </div>
    <table id="example" class="table table-bordered table-hover table-condensed table-striped">
        <thead>
            <tr id="header1">
                <th >Username</th>
                <th >Email</th>
                <th >Group</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if(count($users)): foreach ($users as $user): ?>
            <tr>
                <td><?php echo anchor('app/user/edit/' . $user->id, $user->username); ?></td>
                <td><?php echo $user->email; ?></td> 
                <td><?php echo $user->nama_group; ?></td> 
                <td id="actions1">
                    <?php echo btn_edit('app/user/edit/' . $user->id); ?>
                    <?php echo btn_delete('app/user/delete/' . $user->id); ?>
                </td>
                
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="4">We could not find any users.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
</section_custom>
