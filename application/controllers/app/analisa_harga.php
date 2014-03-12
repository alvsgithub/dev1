<?php
class Analisa_harga extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('master/item_m');
        $this->load->model('master/analisa_harga_m');
        $this->load->model('master/analisa_harga_detail_m');
    }
    
    public function anggaran ()
    {
        $this->data['jenis'] = 'Anggaran';
        $this->data['options_periode'] = $this->periode_m->get();
        $this->data['analisa_harga'] = $this->analisa_harga_m->get();  

		if(isset($_GET['analisa_harga'])){
			echo $this->analisa_harga_m->getJson();
		}else if(isset($_GET['analisa_harga_detail'])){
			echo $this->analisa_harga_detail_m->getJson('AND a.id_analisa = '.$_GET['analisa_harga_detail']);
		}else{		
			$this->data['subview'] = 'app/master/analisa_harga/index';
			$this->load->view('app/_layout_main', $this->data);
		}
        
    }
    
    public function aktual ()
    {
        $this->data['jenis'] = 'Aktual';
        $this->data['options_periode'] = $this->periode_m->get();
        $this->data['analisa_harga'] = $this->analisa_harga_m->get();
        $this->data['subview'] = 'app/master/analisa_harga/index';
        $this->load->view('app/_layout_main', $this->data);
    }
    
    public function create()
    {
        if(!isset($_POST))	
            show_404();

        $data = $this->analisa_harga_m->array_from_post(array(
                    'id_periode',
                    'kode',
                    'nama',
                    'satuan'
                ));
<<<<<<< HEAD
        if($this->analisa_harga_m->save($data)){ 
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'Data gagal dismpan!!!'));
        }
=======
		if($this->analisa_harga_m->save2($data)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'error'));
		}
>>>>>>> e6426b5be89c9388964bf83b24ee8f51e3533a1a
    }
    
    public function delete ($param)
    {
        $this->analisa_harga_m->delete($id);
        redirect('app/analisa_harga/index/');
    }
}