<div class="modal-header">
    <h4>Gallery</h4>
</div>
<section_custom>
    
    <?php if(count($errors)) : echo $errors; endif;?>

    <div id="upload">
        <?php echo form_open_multipart('app/gallery'); ?>
        <?php echo form_upload('userfile'); ?>
        <?php echo form_submit('upload', 'Upload'); ?>
        <?php echo form_close(); ?>
    </div>
    
    <div id="myWindow"></div>
	
    <div id="gallery">
        <?php if(isset($images) && count($images)):
            foreach($images as $image): ?>
        
            <div class="thumb thumbnail">
                <a href="<?php echo $image['url']; ?>">
                    <img src="<?php echo $image['thumb_url']; ?>" />
                </a>
                <a href="">delete</a>
            </div>
        
        <?php endforeach; else: ?>
                <div id="blank_gallery">Please Upload an Image</div>
        <?php endif; ?>
    </div>
    
</section_custom>

<script>
    
    function view(){
        $('#myWindow').window({
            width:600,height:400,modal:true
        });
    }
    
</script>

<style type="text/css">
    #gallery, #upload{
        border: 1px solid #ccc; 
        margin: 10px auto; 
        width: auto; 
        padding: 10px;
        position: relative;
    }
    #blank_gallery{
        font-wight: bold; 
        text-align: left;
    }
    .thumb{
        float: left;
        width: 150px;
        height: 100px;
        padding: 10px;
        margin: 10px;
        background-color: #ddd;
    }
    .thumb:hover{
        border: 1px solid #999;
    }
    img{
        border: 0;
    }
    #gallery:after{
        content: ".";
        visibility: hidden;
        display: block;
        clear: both;
        height: 0; 
    }
</style>