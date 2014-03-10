    <!-- Main content -->
    <div class="spanhome" style="border: 0px solid red;">
        <!-- <div class="row">
            
        </div> --> 
        <div class="row">
            
            <div class="spanhome"><?php if(isset($articles[0])) echo get_excerpt($articles[0]); ?></div>
            <div class="spanhome"><?php if(isset($articles[1])) echo get_excerpt($articles[1]); ?></div>
            <div class="spanhome"><?php if(isset($articles[2])) echo get_excerpt($articles[2]); ?></div>
            
        </div>
        
    </div>
 		
    <!-- Sidebar -->
	
    <div id="sidebar_wrapper" class="span3">

        <div id="sidebar_top"></div>

        <div id="sidebar">
            <h8>Recent news</h8>
            <?php echo anchor($news_archive_link, '+ News archive'); ?>
            <?php $articles = array_slice($articles, 3); ?>
            <?php echo article_links($articles); ?>
        </div>

        <div id="sidebar_bottom"></div>

    </div>