<?php
class Analisa_harga_M extends MY_Model
{
    protected $_table_name = 'analisa_harga';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'id_periode' => array(
            'field' => 'id_periode', 
            'label' => 'Periode', 
            'rules' => 'trim|required|xss_clean|integer'
        ),
        'kode' => array(
            'field' => 'kode', 
            'label' => 'Kode', 
            'rules' => 'trim|required|xss_clean'
        ),
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean'
        ),
        'satuan' => array(
            'field' => 'satuan', 
            'label' => 'Satuan',
            'rules' => 'trim|required|xss_clean'
        )
    );

    public function get_new(){
        $analisa_harga = new stdClass();
        $analisa_harga->id_periode = '';
        $analisa_harga->kode = '';
        $analisa_harga->nama = '';
        $analisa_harga->satuan = '';
        return $analisa_harga;
    }
    
    public function create()
	{
            return $this->db->insert('cek_pal_batas',array(
                'id_kawasan'=>$this->input->post('id_kawasan',true),
                'tgl'=>date('Y-m-d',strtotime($this->input->post('tgl',true))),
                'pal_batas_awal'=>$this->input->post('pal_batas_awal',true),
                'pal_batas_akhir'=>$this->input->post('pal_batas_akhir',true),
                'user_insert'=>$this->session->userdata('username'),
                'time_insert'=>date('Y-m-d H:i:s')
            ));
	}
    
}