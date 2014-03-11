<?php

class Anggaran extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('master/item_m');
    }

    public function index ($jenis = NULL)
    {
        $this->data['options_periode'] = $this->periode_m->get();
        $this->data['item'] = $this->item_m->get_item_by($jenis); // Fetch all provinsi with limit offset
        $this->data['jenis'] = $jenis;
        $this->data['subview'] = 'app/master/anggaran/index'; // Load view
//        dump($this->data['pagination']);
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
        $rules = $this->item_m->rules;
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
            redirect('app/anggaran/index/'.$jenis);
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/anggaran/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($param)
    {
        list($jenis, $id) = explode('-', $param);
        $this->item_m->delete($id);
        redirect('app/anggaran/index/'.$jenis);
    }

}


?>
