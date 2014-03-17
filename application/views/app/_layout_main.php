<?php
    echo $this->load->view('app/components/page_head');
?>
<body class="easyui-layout">
    <div data-options="region:'north'" style="height:100px">
        <!--<div class="_logo">
            <a href="<?php //echo base_url();?>index.php/home"></a>
        </div>
         <div class="_title">
             <h2>Sistem Informasi Penyusunan RAB</h2>
            <p>PDAM Kota Malang</p>
        </div> -->
    </div>
    <div data-options="region:'center'">
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <a class="brand" style="width: 150px;" href="<?php echo site_url(); ?>">
                </a> 
                <?php 
                    echo get_menu_app($menu);
                ?>
                <div class="btn-group pull-right">
                    <button class="btn btn-primary">
                        <i class="icon-user icon-white"></i>
                            <?php echo $this->session->userdata('username'); ?>
                    </button>
                    <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('app/user/edit').'/'.$this->session->userdata('id'); ?>"><i class="icon-wrench"></i> Account</a></li>
                        <li><a href="<?php echo site_url('app/user/logout'); ?>"><i class="icon-off"></i> Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="easyui-layout" data-options="fit:true">
            <div data-options="region:'west',split:false,border:false,collapsible:false" title="Menu" style="width:200px">
                <div class="easyui-accordion" data-options="fit:true,border:false">
                    <?php echo get_left_menu_app($menu); ?>
                </div>
            </div>
            <div id="div-reg-center" data-options="region:'center',border:true">
                <!-- Main content -->
                <?php 
                    echo $this->load->view($subview); 
                    //echo var_dump($subview);
                ?>
            </div>
            <div data-options="region:'south',split:false,fit:true" style="height:40px;"></div>
        </div>
    </div>
    <div id="bg-footer" data-options="region:'south',split:false,fit:true" style="height:30px;">
        <center>Copyright © PDAM Kota Malang 2013</center>
    </div>
<?php echo $this->load->view('app/components/page_tail'); ?>   
