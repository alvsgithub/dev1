<div class="modal-header">
    <h4><?php echo empty($user->id) ? 'Add a new user' : 'Edit user : ' . $user->username; ?></h4>
</div>
<div class="modal-body">
<div class="alert-error">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td style="width: 15%;">Username</td>
        <td><?php echo form_input('username', set_value('username', $user->username)); ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo form_input('email', set_value('email', $user->email), 'style="width:300px;"'); ?></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><?php echo form_password('password'); ?></td>
    </tr>
    <tr>
        <td>Confirm Password</td>
        <td><?php echo form_password('password_confirm'); ?></td>
    </tr>
    <tr>
        <td>Group</td>
        <td><?php echo form_dropdown('id_group', $options_group, $user->id_group); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>
</table>
<?php echo form_close(); ?>
</div>