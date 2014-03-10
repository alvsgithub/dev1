<?php

class Provinsi extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/provinsi_m');
    }

    public function index ()
    {
        $this->data['provinsi'] = $this->provinsi_m->get(); // Fetch all provinsi with limit offset
        $this->data['subview'] = 'app/master/provinsi/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a tsl or set a new one
        if ($id) {
            $this->data['provinsi'] = $this->provinsi_m->get($id);
            count($this->data['provinsi']) || $this->data['errors'][] = 'provinsi could not be found';
        }
        else {
            $this->data['provinsi'] = $this->provinsi_m->get_new();
        }
        
        // Set up the form
        $rules = $this->provinsi_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->provinsi_m->array_from_post(array(
                        'nama'
                    ));
            $this->provinsi_m->save($data, $id);
            redirect('app/provinsi');
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/provinsi/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->provinsi_m->delete($id);
        redirect('app/provinsi');
    }

}
?>
