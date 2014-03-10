/**
 *   Page loaded in wait for the page  
 *
 * @author gxjiang
 * @date 2010/7/24
 *
 */
 
 //var _html = "<div id='loading' style='position:fixed;left:0;top:0;width:100%;height:100%;background:#000;opacity:0.8;filter:alpha(opacity=100);z-index:9999;color:#fff';font-size:25px;text-align:center;padding-top:300px;>Loading, please wait  ...</div></div>";
   var _html = "<div id='loading' style='position: fixed;top: 0;left: 0;background-color: #000;	opacity: 0.9;z-index: 99999999999;text-align: center;width: 100%;height: 100%;padding-top: 300px;font-size: 25px;color: #fff;'>Loading, please wait  ...</div>";
 
   
 window.onload = function(){  
    var _mask = document.getElementById('loading');  
    _mask.parentNode.removeChild(_mask);  
 };  
  
       
 document.write(_html); 
 