<div class="modal-header">
    <h4><?php echo empty($slider->id) ? 'Add a new slider' : 'Edit slider ' . $slider->id; ?></h4>
</div>
<section_custom>
<?php echo validation_errors(); ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td>Caption</td>
        <td><?php echo form_textarea('caption', set_value('caption', $slider->caption), 'placeHolder="Diskripsi atau tulisan pada gambar", style="width: 500px;height: 40px;"'); ?></td>
    </tr>
    <tr>
        <td>Images</td>
        <td><?php echo form_input('images_link', set_value('images_link', $slider->images_link), 'onClick="view();" readonly="true"'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>
</table>
<?php echo form_close();?>
</section_custom>
<div id="myWindow" c>
    <div id="gallery">
        <?php if(isset($images) && count($images)):
            foreach($images as $image): ?>
        
            <div class="thumb thumbnail">
                <a href="<?php echo $image['url']; ?>">
                    <img src="<?php echo $image['thumb_url']; ?>" />
                </a>
            </div>
        
        <?php endforeach; else: ?>
            <!--<div id="blank_gallery">Please Upload an Image</div>-->
        <?php endif; ?>
    </div>
</div>
<script>
    function tes(){
        alert('Tes');
    }
    
    function view(){
        $('#myWindow').window({
            width:600,height:400,modal:true
        });
    }
</script>

