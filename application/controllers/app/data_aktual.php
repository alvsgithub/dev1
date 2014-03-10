<?php

class Data_aktual extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/item_anggaran_m');
        $this->load->model('master/periode_m');
        $this->load->model('master/satuan_item_m');
        $this->load->model('master/jenis_item_m');
    }

    public function index ($kode)
    {
        $this->data['item_anggaran'] = $this->item_anggaran_m->get_item_anggaran($kode); // Fetch all item anggaran with limit offset
        $this->data['subview'] = 'app/master/item_anggaran/index'; // Load view
        //dump($this->data['item_anggaran']);
        $this->load->view('app/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a tsl or set a new one
        if ($id) {
            $this->data['item_anggaran'] = $this->item_anggaran_m->get($id);
            $this->data['options_periode'] = $this->periode_m->get_combobox(NULL, FALSE, 'id', 'tahun');
            $this->data['options_satuan'] = $this->satuan_item_m->get_combobox(NULL, FALSE, 'kode', 'satuan');
            $this->data['options_jenis_item'] = $this->jenis_item_m->get_combobox(NULL, FALSE, 'kode', 'jenis');
            count($this->data['item_anggaran']) || $this->data['errors'][] = 'Item Aggaran could not be found';
        }
        else {
            $this->data['item_anggaran'] = $this->item_anggaran_m->get_new();
            $this->data['options_periode'] = $this->periode_m->get_combobox(NULL, FALSE, 'id', 'tahun');
            $this->data['options_satuan'] = $this->satuan_item_m->get_combobox(NULL, FALSE, 'kode', 'satuan');
            $this->data['options_jenis_item'] = $this->jenis_item_m->get_combobox(NULL, FALSE, 'kode', 'jenis');
        }
        
        // Set up the form
        $rules = $this->item_anggaran_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->item_anggaran_m->array_from_post(array(
                        'kode',
                        'id_periode',
                        'nama',
                        'kode_satuan',
                        'kode_jenis_item',
                        'harga_pagu',
                        'harga_oe'
                    ));
            $this->item_anggaran_m->save($data, $id);
            redirect('app/item_anggaran');
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/item_anggaran/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->item_anggaran_m->delete($id);
        redirect('app/item_anggaran');
    }

}

/* @End Of File item_anggaran.php */
/* @Created By : Muhammad Rizki A */

?>
