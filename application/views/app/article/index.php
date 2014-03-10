<div class="modal-header">
    <h4>News Articles</h4>
</div>
<section_custom> 
    <?php echo btn_add('app/article/edit'); ?>
    
    <table id="example" class="table table-bordered table-hover table-condensed table-striped">
        <thead>
            <tr id="header1">
                <th>Title</th>
                <th id="actions1">Pubdate</th>
                <th id="actions1">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($articles)): foreach($articles as $article): ?>	
            <tr>
                <td><?php echo anchor('app/article/edit/' . $article->id, $article->title); ?></td>
                <td id="actions1"><?php echo date("d-m-Y",strtotime($article->pubdate)); ?></td>
                <td id="actions1">
                    <?php echo btn_edit('app/article/edit/' . $article->id); ?>
                    <?php echo btn_delete('app/article/delete/' . $article->id); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">We could not find any articles.</td>
            </tr>
        <?php endif; ?>	
        </tbody>
    </table>
</section_custom>
