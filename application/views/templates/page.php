    <!-- Main content -->
    <div class="spanhome">
        <article>
            <h2><?php echo e($page->title); ?></h2>
            <?php echo $page->body; ?> 
        </article>
    </div>
 		
    <!-- Sidebar -->
    <div id="sidebar_wrapper" class="span3">
        <div id="sidebar_top"></div>
        <div id="sidebar">
            <h2>Recent news</h2>
            <?php $this->load->view('sidebar'); ?>
        </div>
        <div id="sidebar_bottom"></div>
    </div>