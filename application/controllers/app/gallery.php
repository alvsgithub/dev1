<?php
class Gallery extends Admin_Controller
{
    var $gallery_path;
    var $gallery_path_url;
    
    public function __construct ()
    {
        parent::__construct();
//        $this->load->model('gallery_m');
        $this->gallery_path = realpath(APPPATH . '../asset/gallery');
        $this->gallery_path_url = base_url() . 'asset/gallery/';
    }

    public function index ()
    {
        if($this->input->post('upload')){
            $this->do_upload_images();
        }
        
        $this->data['images'] = $this->get_images();
		
        // Load view
        $this->data['subview'] = 'app/gallery/index';
        $this->load->view('app/_layout_main', $this->data);
    }
}