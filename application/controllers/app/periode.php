<?php

class Periode extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
    }

    public function index ()
    {
        $this->data['periode'] = $this->periode_m->get(); // Fetch all provinsi with limit offset
        $this->data['subview'] = 'app/master/periode/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a tsl or set a new one
        if ($id) {
            $this->data['periode'] = $this->periode_m->get($id);
            $this->data['options_locked'] = array(
                'Y' => 'Ya',
                'T' => 'Tidak'
            );
            $this->data['options_active'] = array(
                'Y' => 'Ya',
                'T' => 'Tidak'
            );
            count($this->data['periode']) || $this->data['errors'][] = 'periode could not be found';
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
            $this->data['periode'] = $this->periode_m->get_new();
        }
        
        // Set up the form
        $rules = $this->periode_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->periode_m->array_from_post(array(
                        'tahun',
                        'semester',
                        'locked',
                        'active'
                    ));
            $this->periode_m->save($data, $id);
            redirect('app/periode');
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/periode/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->periode_m->delete($id);
        redirect('app/periode');
    }

}

/* @End Of File periode.php */
/* @Created By : Muhammad Rizki A */

?>
