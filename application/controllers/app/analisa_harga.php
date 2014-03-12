<?php
class Analisa_harga extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('master/item_m');
        $this->load->model('master/analisa_harga_m');
    }
    
    public function anggaran ()
    {
        $this->data['jenis'] = 'Anggaran';
        $this->data['options_periode'] = $this->periode_m->get();
        $this->data['analisa_harga'] = $this->analisa_harga_m->get();        
        $this->data['subview'] = 'app/master/analisa_harga/index';
        $this->load->view('app/_layout_main', $this->data);
        
    }
    
    public function aktual ()
    {
        $this->data['jenis'] = 'Aktual';
        $this->data['options_periode'] = $this->periode_m->get();
        $this->data['analisa_harga'] = $this->analisa_harga_m->get();
        $this->data['subview'] = 'app/master/analisa_harga/index';
        $this->load->view('app/_layout_main', $this->data);
    }
    
    public function edit ($param = NULL)
    {
        list($jenis, $id) = explode('-', $param);
        if ($id != 'new') {
            $this->data['item'] = $this->item_m->get($id);
            $this->data['options_periode'] = $this->periode_m->get_combobox(NULL, FALSE, 'id', 'tahun,semester', NULL, FALSE);
//            dump($this->data['item']);
            count($this->data['item']) || $this->data['errors'][] = 'item could not be found';
        }
        else {
            $this->data['options_periode'] = $this->periode_m->get_combobox(NULL, FALSE, 'id', 'tahun,semester', NULL, FALSE);
            $this->data['item'] = $this->item_m->get_new($jenis);
        }
        
        // Set up the form
        $rules = $this->analisa_harga_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->item_m->array_from_post(array(
                        'id_periode',
                        'kode',
                        'nama',
                        'satuan',
                        'jenis',
                        'harga_pagu',
                        'harga_oe'
                    ));
            if($id=='new'){ $id = NULL; }
            $this->item_m->save($data, $id);
            redirect('app/aktual/index/'.$jenis);
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/aktual/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($param)
    {
        $this->analisa_harga_m->delete($id);
        redirect('app/analisa_harga/index/');
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
        if($this->analisa_harga_m->save($data)){   
            echo json_encode(array('success'=>true));
        }
    }
}