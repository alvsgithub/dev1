<div class="modal-header">
    <h4><?php echo empty($group->id) ? 'Add a new Group' : 'Edit Group : '.$group->nama_group; ?></h4>
</div>
<div class="modal-body">
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
    <table class="table table-condensed">
        <tr>
            <td style="width: 10%;">Nama Group</td>
            <td><?php echo form_input('nama_group', set_value('nama_group', $group->nama_group)); ?></td>
        </tr>
        <tr>
            <td></td>
            <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
        </tr>
    </table>
<?php echo form_close();?>
</div>
<script>
    $(function() {
        $('.datepicker').datepicker({ format : 'dd-mm-yyyy' });
    });
</script>