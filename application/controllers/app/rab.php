<?php
class Rab extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('master/item_m');
        $this->load->model('transaction/usulan_m');
        $this->load->model('transaction/usulan_detail_m');
        $this->load->model('transaction/tahapan_m');
    }
    
    public function index()
    {
        
        $this->data['options_periode'] = $this->periode_m->get();

        if(isset($_GET['rab'])){
            echo $this->usulan_m->getJson('a.id_periode = '.$_GET['rab']);
        }else if(isset($_GET['rab_detail'])){
            echo $this->usulan_detail_m->getJson('a.kode_usulan = \''.$_GET['rab_detail'].'\'');
        }else if(isset($_GET['tahapan'])){
			echo $this->tahapan_m->getJson('a.id_usulan_detail = \''.$_GET['tahapan'].'\'');
		}else{
            $this->data['subview'] = 'app/rab/index';
            $this->load->view('app/_layout_main', $this->data);
        }
        
    }
    
    public function create()
    {
        if(!isset($_POST))  
            show_404();

        $data = $this->usulan_m->array_from_post(array(
                    'nama',
                    'lokasi'
                ));

        $data['kode'] = $this->usulan_m->gen_new_kode();
        $data['status'] = 'PEMBUATAN';
        $data['id_periode'] = $_GET['id_periode'];

        if($this->usulan_m->save($data) == TRUE) {
            $data_detail = array(
                'versi' => '1',
                'kode_usulan' => $data['kode']
            );
            if($this->usulan_detail_m->save($data_detail) == TRUE){
                echo json_encode(array('success'=>true));
            }
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function update($id = null)
    {
        if(!isset($_POST))
            show_404();

        $data = $this->usulan_m->array_from_post(array(
                    'kode',
                    'nama',
                    'lokasi'
                ));

        if($this->usulan_m->save($data, $id) == TRUE) { 
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'Data gagal dismpan!!!'));
        }
    }
    
    public function delete($id = NULL)
    {
        if(!isset($_POST))
            show_404();

        $id = addslashes($_POST['id']);

        if($this->usulan_m->delete($id)){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }
	
	// TAHAPAN //
	public function createTahapan($id = NULL)
    {
        if(!isset($_POST))
            show_404();

        $data = $this->tahapan_m->array_from_post(array(
                    'no_urut',
                    'nama'
                ));
        $data['id_usulan_detail'] = $id;
        if($this->tahapan_m->save($data) == TRUE){
			echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }
}