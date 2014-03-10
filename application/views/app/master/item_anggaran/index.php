<div class="modal-header">
    <h4>Item Anggaran</h4>
</div>
<section_custom>
    <?php echo btn_add('app/item_anggaran/edit'); ?>
    <table id="example" class="table table-striped table-bordered table-hover table-condensed">
        <thead>
            <tr id="header1">
                <th>Kode</th>
                <th>Periode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Jenis Item</th>
                <th>Harga Pagu</th>
                <th>Harga OE</th>
                <th id="actions1">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($item_anggaran)): foreach($item_anggaran as $item): ?>	
            <tr>
                <td><?php echo anchor('app/item_anggaran/edit/' . $item->kode, $item->kode); ?></td>
                <td><?php echo anchor('app/item_anggaran/edit/' . $item->tahun, $item->tahun); ?></td>
                <td><?php echo anchor('app/item_anggaran/edit/' . $item->kode, $item->nama); ?></td>
                <td><?php echo anchor('app/item_anggaran/edit/' . $item->satuan, $item->satuan); ?></td>
                <td><?php echo anchor('app/item_anggaran/edit/' . $item->jenis, $item->jenis); ?></td>
                <td style="text-align: right;"><?php echo anchor('app/item_anggaran/edit/' . $item->kode, $item->harga_pagu); ?></td>
                <td style="text-align: right;"><?php echo anchor('app/item_anggaran/edit/' . $item->kode, $item->harga_oe); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/item_anggaran/edit/' . $item->kode); ?>
                    <?php echo btn_delete('app/item_anggaran/delete/' . $item->kode); ?>
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

<!-- @End Of File item_anggaran/index.php */ -->
<!-- @Created By : Muhammad Rizki A */ -->

