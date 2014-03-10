<div class="modal-header">
    <h4>Periode</h4>
</div>
<section_custom>
    <?php echo btn_add('app/periode/edit'); ?>
    <table id="example" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr id="header1">
                <th>Tahun</th>
                <th>Semester</th>
                <th>Locked</th>
                <th>Active</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($periode)): foreach($periode as $period): ?>	
            <tr>
                <td><?php echo anchor('app/periode/edit/' . $period->id, $period->tahun); ?></td>
                <td><?php echo anchor('app/periode/edit/' . $period->id, $period->semester); ?></td>
                <td><?php echo anchor('app/periode/edit/' . $period->id, $period->locked); ?></td>
                <td><?php echo anchor('app/periode/edit/' . $period->id, $period->active); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/periode/edit/' . $period->id); ?>
                    <?php echo btn_delete('app/periode/delete/' . $period->id); ?>
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

<!-- @End Of File periode/index.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->

