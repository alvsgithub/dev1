    <!-- Main content -->
    <div class="spanhome">
        <?php if($pagination): ?>
        <section class="pagination"><?php echo $pagination; ?></section>
        <?php endif; ?>
        <div class="row">
            <?php if (count($articles)): foreach ($articles as $article): ?>
            <article class="spanhome"><?php echo get_excerpt($article); ?><hr></article>
            <?php endforeach; endif; ?>
        </div>
    </div>

    <!-- Sidebar -->
    <div id="sidebar_wrapper" class="span4">

        <div id="sidebar_top"></div>

        <div id="sidebar">
            <h2>Recent news</h2>
            <?php $this->load->view('sidebar'); ?>
        </div>

        <div id="sidebar_bottom"></div>

    </div>