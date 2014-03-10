<div class="modal-header">
    <h3>Login</h3>
    <p>Please log in using your credentials</p>
    <div class="alert-error">
        <p><?php echo $this->session->flashdata('error'); ?></p>
    </div>
</div>
<div class="modal-body">
<?php // echo '<pre>' . print_r($this->session->userdata, TRUE) . '</pre>'; ?>

<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
    <table class="table">
        <tr>
            <td>Username</td>
            <td><?php echo form_input('username'); ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><?php echo form_password('password'); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo form_submit('submit', 'Log in', 'class="btn btn-primary"'); ?></td>
        </tr>
    </table>
<?php echo form_close(); ?>
</div>
