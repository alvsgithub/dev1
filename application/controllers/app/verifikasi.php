<?php

class Verifikasi extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/verifikasi_m');
        $this->load->model('master/verifikasi_detail_m');
    }

    public function index ()
    {

        if(isset($_GET['verifikasi']) == true){
            echo $this->verifikasi_m->getJson();
        }else if(isset($_GET['detail_verifikasi']) == true){
            echo $this->verifikasi_detail_m->getJson($_GET['detail_verifikasi']);
        }else{      
            $this->data['subview'] = 'app/master/verifikasi';
            $this->load->view('app/_layout_main', $this->data);
        }
    }
}


?>