<?php

class Satuan_item extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/satuan_item_m');
    }

    public function index ()
    {
        $this->data['satuan_item'] = $this->satuan_item_m->get(); // Fetch all satuan item with limit offset
        $this->data['subview'] = 'app/master/satuan_item/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a tsl or set a new one
        if ($id) {
            $this->data['satuan_item'] = $this->satuan_item_m->get($id);
            count($this->data['satuan_item']) || $this->data['errors'][] = 'satauan item could not be found';
        }
        else {
            $this->data['satuan_item'] = $this->satuan_item_m->get_new();
        }
        
        // Set up the form
        $rules = $this->satuan_item_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->satuan_item_m->array_from_post(array(
                        'kode',
                        'satuan'
                    ));
            $this->satuan_item_m->save($data, $id);
            redirect('app/satuan_item');
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/satuan_item/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->satuan_item_m->delete($id);
        redirect('app/satuan_item');
    }

}

/* @End Of File satuan_item.php */
/* @Created By : Muhammad Rizki A */

?>
