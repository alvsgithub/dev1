<?php
class Item_M extends MY_Model
{
    protected $_table_name = 'item';
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
        'jenis' => array(
            'field' => 'jenis', 
            'label' => 'Jenis', 
            'rules' => 'trim|required|xss_clean'
        ),
        'satuan' => array(
            'field' => 'satuan', 
            'label' => 'Satuan',
            'rules' => 'trim|required|xss_clean'
        ),
        'harga_pagu' => array(
            'field' => 'harga_pagu', 
            'label' => 'Harga Pagu',
            'rules' => 'trim|required|xss_clean|numeric'
        ),
        'harga_oe' => array(
            'field' => 'harga_oe', 
            'label' => 'Harga OE',
            'rules' => 'trim|required|xss_clean|numeric'
        )
    );

    public function get_new($jenis){
        $item = new stdClass();
        $item->id_periode = '';
        $item->kode = '';
        $item->nama = '';
        $item->jenis = $jenis;
        $item->satuan = '';
        $item->harga_pagu = '';
        $item->harga_oe = '';
        return $item;
    }
    
    public function get_item_by($jenis){
        $this->db->select('item.*, concat(periode.tahun,'.'0'.',periode.semester) as periode', FALSE);
        $this->db->from('item');
        $this->db->join('periode', 'periode.id = item.id_periode', 'left');
        $this->db->where('item.jenis', $jenis);
        return $this->db->get()->result();
    }
    
}

/* @End Of File item_m.php */
/* @Created By : Muhammad Rizki A */