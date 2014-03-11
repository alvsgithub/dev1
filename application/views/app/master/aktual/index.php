<div class="modal-header">
    <h4>Data Aktual - Item : <?php echo $jenis; ?></h4>
</div>
<section_custom>
    <?php echo btn_add('app/item/edit'); ?>
    <table id="example" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr id="header1">
                <th>Kode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga Pagu</th>
                <th>Harga OE</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($item)): foreach($item as $it): ?>	
            <tr>
                <td><?php echo anchor('app/item/edit/' . $it->id, $it->kode); ?></td>
                <td><?php echo $it->nama; ?></td>
                <td><?php echo $it->satuan; ?></td>
                <td style="text-align: right;"><?php echo number_format($it->harga_pagu, 2, ',', '.'); ?></td>
                <td style="text-align: right;"><?php echo number_format($it->harga_oe, 2, ',', '.'); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/item/edit/' . $it->id); ?>
                    <?php echo btn_delete('app/item/delete/' . $it->id); ?>
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

<!-- @End Of File item/index.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->

