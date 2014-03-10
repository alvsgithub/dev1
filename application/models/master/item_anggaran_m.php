<?php
class Item_anggaran_M extends MY_Model
{
    protected $_table_name = 'item_anggaran';
    protected $_primary_key = 'kode'; 
    protected $_order_by = 'kode';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'kode' => array(
            'field' => 'kode', 
            'label' => 'Kode', 
            'rules' => 'trim|required|xss_clean'
        ),
        'id_periode' => array(
            'field' => 'id_periode', 
            'label' => 'Periode', 
            'rules' => 'trim|required|integer'
        ),
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean'
        ),
        'kode_satuan' => array(
            'field' => 'kode_satuan', 
            'label' => 'Kode Satuan', 
            'rules' => 'trim|required'
        ),
        'kode_jenis_item' => array(
            'field' => 'kode_jenis_item', 
            'label' => 'Kode Jenis Item', 
            'rules' => 'trim|required'
        ),
        'harga_pagu' => array(
            'field' => 'harga_pagu', 
            'label' => 'Harga Pagu', 
            'rules' => 'trim|required|xss_clean'
        ),
        'harga_oe' => array(
            'field' => 'harga_oe', 
            'label' => 'Harga Oe', 
            'rules' => 'trim|required|xss_clean'
        )
    );
    
    //VIEW ITEM ANGGARAN DATA
<<<<<<< HEAD
    public function get_item_anggaran() {
=======
    public function get_item_anggaran($kode) {
>>>>>>> 936a5e48051dfe8562aba424e99b78a3f8c70c35
        $this->db->select('item_anggaran.*,periode.tahun,satuan_item.satuan,jenis_item.jenis');
        $this->db->from('item_anggaran');
        $this->db->join('periode', 'periode.id = item_anggaran.id_periode');
        $this->db->join('satuan_item', 'satuan_item.kode = item_anggaran.kode_satuan');
        $this->db->join('jenis_item', 'jenis_item.kode = item_anggaran.kode_jenis_item');
<<<<<<< HEAD
=======
        $this->db->where('kode_jenis',$kode);
>>>>>>> 936a5e48051dfe8562aba424e99b78a3f8c70c35
        $query = $this->db->get()->result();
        return $query;
    }

    public function get_new(){
        $item_anggaran = new stdClass();
        $item_anggaran->kode = '';
        $item_anggaran->id_periode = '';
        $item_anggaran->nama = '';
        $item_anggaran->kode_satuan = '';
        $item_anggaran->kode_jenis_item = '';
        $item_anggaran->harga_pagu = '';
        $item_anggaran->harga_oe = '';
        return $item_anggaran;
    }
    
}

/* @End Of File item_anggaran_m.php */
/* @Created By : Muhammad Rizki A */