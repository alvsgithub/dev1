<?php
class Admin_Controller extends MY_Controller
{
    protected $gallery_path;
    protected $gallery_path_url;
    
    function __construct ()
    {
        parent::__construct();
        $this->data['meta_title'] = config_item('site_name'); // 'My awesome CMS';
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('user_m');
        $this->load->model('menu_m');
        
        // Login check
        $exception_uris = array(
            'app/user/login', 
            'app/user/logout'
        );
        
        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if ($this->user_m->loggedin() == FALSE) {
                redirect('app/user/login');
            }else{
                $this->data['menu'] = $this->menu_m->get_nested_admin_menu();
                $link_allowed = $this->menu_m->get_allowed_link();
//                dump($link_allowed);
                $total_uri = $this->uri->total_segments();
                if($total_uri == 2)
                    if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2), $link_allowed) == false)
                        redirect('app/dashboard');
                else if($total_uri == 3)
                    if(in_array($this->uri->segment(1).'/'.$this->uri->segment(2).'/'.$this->uri->segment(3), $link_allowed) == false)
                        redirect('app/dashboard');
            }
        }
        
        $this->gallery_path = realpath(APPPATH . '../asset/gallery');
        $this->gallery_path_url = base_url() . 'asset/gallery/';
    }
    
    function do_upload_images(){
        $config = array(
            'allowed_types' => 'jpg|jpeg|png|gif',
            'upload_path' => $this->gallery_path,
            'max_size' => 2000,
            'max_width' => 1950,
            'max_height' => 1300
        );
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload())
        {
            $this->data['errors'] = $this->upload->display_errors();
        }else{
            $image_data = $this->upload->data();
		
            $config = array(
                'source_image' => $image_data['full_path'],
                'new_image' => $this->gallery_path . '/thumbs',
                'maintain_ration' => true,
                'width' => 150,
                'height' => 100
            );

            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
        }
    }
	
    public function get_images(){
        $files = scandir($this->gallery_path);
        $files = array_diff($files, array('.', '..', 'thumbs'));
        $images = array();

        foreach($files as $file){
            $images[] = array(
                'url' => $this->gallery_path_url . $file,
                'thumb_url' => $this->gallery_path_url . 'thumbs/' . $file
            );
        }

        return $images;
    }
}