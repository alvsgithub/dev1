<?php $this->load->view('components/page_head'); ?>
<body>

<div class="container" style="border: 0px solid red;">
    
    <div id="_header">
        <div id="logo">
            <img src="<?php echo site_url("asset/images/logo_kehutanan_70.png"); ?>" alt="logo">
        </div>
        <div id="header_left">
            <div id="site_title">
                <h1>Konservasi Jenis<?php // echo anchor('', config_item('site_name')); ?></h1>
                <?php // echo $meta_title; ?>
            </div>
        </div>
    </div>
	
</div>

<div class="container" style="border: 0px solid ;">
    <div class="navbar navbar-inverse">
        <div class="navbar-inner">
            <!--<div class="container">-->
                <div class="nav-collapse collapse">
                        <?php //dump($menu);
                        echo get_menu($menu); 
                        ?>
                </div>
            <!--</div>-->
        </div>
    </div>
</div>

<div class="container" style="border: 0px solid orange;">
    <section id="carousel_container" style="border: 0px solid yellow;padding-top:0px;">
        <div class="row">
            <div class="span12">
                  <div id="artCarousel" class="carousel slide">
                      <ol class="carousel-indicators">
                            <li data-target="#artCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#artCarousel" data-slide-to="1"></li>
                            <li data-target="#artCarousel" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                            <div class="item active" style="border: 0px solid blue;">
                                <img src="<?php echo site_url("asset/images/maleo_bird.png"); ?>" width="950" alt="Model 1">
                                <div class="carousel-caption">
                                  <h4>Burung Maleo terancam punah</h4>
                                  <p>
                                        <a href="hhttp://www.antaranews.com/berita/413582/burung-maleo-terancam-punah" rel="nofollow">ANTARA News</a> - Asisten I Pemerintah Provinsi Sulawesi Barat mengatakan, burung Maleo makin sulit ditemukan di Kabupaten Mamuju Tengah (Mateng) Provinsi Sulbar, sehingga perlu segara dilakukan gerakan untuk melestarikannya.
                                  </p>
                                </div>
                            </div>
                            <div class="item"><a href="http://www.flashmo.com" target="_blank">
                                <img src="<?php echo site_url("asset/images/slide02.jpg"); ?>" width="950" alt="Model 2"></a>
                            </div>
                            <div class="item">
                                <img src="<?php echo site_url("asset/images/slide03.jpg"); ?>" width="950" alt="Model 3">
                            </div>
                      </div>
                      <a class="left carousel-control" href="#artCarousel" data-slide="prev">&lsaquo;</a> <a class="right carousel-control" href="#artCarousel" data-slide="next">&rsaquo;</a> 
                  </div>
            </div>
        </div>
    </section>
 </div>
 <div class="container content_page" style="border: 0px solid blue;">
    <?php $this->load->view('templates/' . $subview); ?>
 </div>
    
<div class="container">
    <div id="_footer">
    	
        <div class="footer_box">
            
            <h4>Navigation</h4>
            
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="contact.html" class="last">Contact Us</a></li>
            </ul>  

        </div>

        <div class="footer_box">
            
            <h4>Partners</h4>
            
            <ul>
                <li><a rel="nofollow" href="http://www.flashmo.com/page/1">Flash Templates</a></li>
                <li><a rel="nofollow" href="http://www.templatemo.com/page/1">Website Templates</a></li>
                <li><a href="http://www.koflash.com">Flash Websites</a></li>
                <li><a rel="nofollow" href="http://www.flashmo.com/store">Premium Themes</a></li>
            </ul>
            
        </div>

        <div class="footer_box last">
            
            <h4>About Us</h4>
            
            <p>
               Cras a volutpat lacus. Ut nisi metus, lobortis vel egestas at, 
               condimentum et purus. 
               Aliquam lectus tortor, vehicula molestie hendrerit non, aliquet nec tortor. 
               In et nibh dolor. 
               Quisque quis neque orci. 
               <a href="aboutus.html">More...</a>
            </p>
        
        </div>

        <div class="cleaner"></div>
        
    </div> <!-- endf -->

    <div id="_copyright">

        Copyright © 2014 <a href="#">Balai Besar KSDA Jawa Timur</a> | 
<!--        Designed by <a href="http://www.templatemo.com" rel="nofollow" target="_parent">Free CSS Templates</a> | -->
        <!--Validate <a href="http://validator.w3.org/check?uri=referer">XHTML</a> &amp;--> 
        <!--<a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>-->

    </div>
</div>
    
    <?php $this->load->view('components/page_tail');?>