<?php

class Aktual extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/item_m');
    }

    public function upah ()
    {
        $this->data['item'] = $this->item_m->get_by("jenis = 'UPAH'"); // Fetch all provinsi with limit offset
        $this->data['jenis'] = 'UPAH';
        $this->data['subview'] = 'app/master/aktual/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }
    
    public function alat ()
    {
        $this->data['item'] = $this->item_m->get_by("jenis = 'ALAT'"); // Fetch all provinsi with limit offset
        $this->data['jenis'] = 'UPAH';
        $this->data['subview'] = 'app/master/aktual/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }
    
    public function satuan ()
    {
        $this->data['item'] = $this->item_m->get_by("jenis = 'SATUAN'"); // Fetch all provinsi with limit offset
        $this->data['jenis'] = 'UPAH';
        $this->data['subview'] = 'app/master/aktual/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }
    
    public function lumpsum ()
    {
        $this->data['item'] = $this->item_m->get_by("jenis = 'LUMPSUM'"); // Fetch all provinsi with limit offset
        $this->data['jenis'] = 'UPAH';
        $this->data['subview'] = 'app/master/aktual/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }
    
    public function edit ($id = NULL)
    {
        // Fetch a tsl or set a new one
        if ($id) {
            $this->data['item'] = $this->item_m->get($id);
            $this->data['options_locked'] = array(
                'Y' => 'Ya',
                'T' => 'Tidak'
            );
            $this->data['options_active'] = array(
                'Y' => 'Ya',
                'T' => 'Tidak'
            );
            count($this->data['item']) || $this->data['errors'][] = 'item could not be found';
        }
        else {
            $this->data['options_locked'] = array(
                'Y' => 'Ya',
                'T' => 'Tidak'
            );
            $this->data['options_active'] = array(
                'Y' => 'Ya',
                'T' => 'Tidak'
            );
            $this->data['item'] = $this->item_m->get_new();
        }
        
        // Set up the form
        $rules = $this->item_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->item_m->array_from_post(array(
                        'tahun',
                        'semester',
                        'locked',
                        'active'
                    ));
            $this->item_m->save($data, $id);
            redirect('app/item');
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/aktual/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->item_m->delete($id);
        redirect('app/aktual');
    }

}


?>
