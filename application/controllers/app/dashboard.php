<?php 
class Dashboard extends Admin_Controller{
    
    public function __construct(){
        parent::__construct();
        
    }
    
    public function index() {
        
//        dump($this->data['menu']);
    	// Fetch recently modified articles
//    	$this->load->model('article_m');
//    	$this->db->order_by('modified desc');
//    	$this->db->limit(5);
//    	$this->data['recent_articles'] = $this->article_m->get();
    	
    	$this->data['subview'] = 'app/dashboard/index';
    	$this->load->view('app/_layout_main', $this->data);
    }
    
    public function modal() {
        
    	$this->load->view('app/_layout_modal', $this->data);
    }
    
}
?>