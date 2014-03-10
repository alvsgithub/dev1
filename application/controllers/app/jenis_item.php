<?php

class Jenis_item extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/jenis_item_m');
    }

    public function index ()
    {
        $this->data['jenis_item'] = $this->jenis_item_m->get(); // Fetch all provinsi with limit offset
        $this->data['subview'] = 'app/master/jenis_item/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a tsl or set a new one
        if ($id) {
            $this->data['jenis_item'] = $this->jenis_item_m->get($id);
            count($this->data['jenis_item']) || $this->data['errors'][] = 'jenis_item could not be found';
        }
        else {
            $this->data['jenis_item'] = $this->jenis_item_m->get_new();
        }
        
        // Set up the form
        $rules = $this->jenis_item_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->jenis_item_m->array_from_post(array(
                        'kode',
                        'jenis'
                    ));
            $this->jenis_item_m->save($data, $id);
            redirect('app/jenis_item');
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/jenis_item/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->jenis_item_m->delete($id);
        redirect('app/jenis_item');
    }

}

/* @End Of File jenis_item.php */
/* @Created By : Muhammad Rizki A */

?>
