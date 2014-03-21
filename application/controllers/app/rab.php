<?php
class Rab extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('master/item_m');
        $this->load->model('master/rab_m');
        $this->load->model('master/analisa_harga_detail_m');
    }
    
    public function index()
    {
        $this->data['jenis'] = 'Rab';
        $this->data['options_periode'] = $this->periode_m->get();

        if(isset($_GET['rab'])){
            echo $this->rab_m->getJson('a.id_periode = '.$_GET['rab']);
        }else{
            $this->data['subview'] = 'app/master/rab/index';
            $this->load->view('app/_layout_main', $this->data);
        }
        
    }
    
    public function create()
    {
        if(!isset($_POST))  
            show_404();

        $data = $this->rab_m->array_from_post(array(
                    'kode',
                    'nama',
                    'lokasi'
                ));

        $data['status'] = 'PEMBUATAN';
        $data['id_periode'] = $_GET['id_periode'];

        if($this->rab_m->save($data) == TRUE) {
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function update($id = null)
    {
        if(!isset($_POST))
            show_404();

        $data = $this->rab_m->array_from_post(array(
                    'kode',
                    'nama',
                    'lokasi'
                ));

        if($this->rab_m->save($data, $id) == TRUE) { 
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

        if($this->rab_m->delete($id)){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }
}