<?php

class Kabkot extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/kabkot_m');
        $this->load->model('master/provinsi_m');
    }

    public function index ()
    {
        $this->data['kabkot'] = $this->kabkot_m->get(); // Fetch all kabkot with limit offset
        $this->data['subview'] = 'app/master/kabkot/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a tsl or set a new one
        if ($id) {
            $this->data['kabkot'] = $this->kabkot_m->get($id);
            $this->data['options_jenis'] = array(
                'KABUPATEN' => 'KABUPATEN',
                'KOTA' => 'KOTA'
            );
            $this->data['options_provinsi'] = $this->provinsi_m->get_combobox(NULL, FALSE, 'id', 'nama');
            count($this->data['kabkot']) || $this->data['errors'][] = 'Kabupaten Kota could not be found';
        }
        else {
            $this->data['kabkot'] = $this->kabkot_m->get_new();
            $this->data['options_jenis'] = array(
                'KABUPATEN' => 'KABUPATEN',
                'KOTA' => 'KOTA'
            );
            $this->data['options_provinsi'] = $this->provinsi_m->get_combobox(NULL, FALSE, 'id', 'nama');
//            dump($this->data['options_provinsi']);
        }
        
        // Set up the form
        $rules = $this->kabkot_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->kabkot_m->array_from_post(array(
                        'nama',
                        'jenis',
                        'id_provinsi'
                    ));
            $this->kabkot_m->save($data, $id);
            redirect('app/kabkot');
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/kabkot/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->kabkot_m->delete($id);
        redirect('app/kabkot');
    }

}
?>
