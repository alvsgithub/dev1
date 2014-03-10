
<section_custom>
    <h4>Order pages</h4>
    <div class="alert alert-info">Drag to order pages and then click 'Save'</div>
    <div id="orderResult" style="border: 0px solid red;"></div>
    <input type="button" id="save" value="Save" class="btn btn-primary" />
</section_custom>

<script>
$(function() {
    $.post('<?php echo site_url('app/page/order_ajax'); ?>', {}, function(data){
        $('#orderResult').html(data);
    });

    $('#save').click(function(){
        oSortable = $('.sortable').nestedSortable('toArray');

        $('#orderResult').slideUp(function(){
                $.post('<?php echo site_url('app/page/order_ajax'); ?>', { sortable: oSortable }, function(data){
                        $('#orderResult').html(data);
                        $('#orderResult').slideDown();
                });
        });
    });
});
</script>