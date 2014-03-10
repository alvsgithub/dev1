<?php
class Satuan_item_m extends MY_Model
{
    protected $_table_name = 'satuan_item';
    protected $_primary_key = 'kode';
    protected $_order_by = 'kode';
    protected $_timestamps = FALSE;
    protected $_logs = FALSE;
    public $rules = array(
        'kode' => array(
            'field' => 'kode', 
            'label' => 'Kode', 
            'rules' => 'trim|required|xss_clean'
        ),
        'satuan' => array(
            'field' => 'satuan', 
            'label' => 'Satuan', 
            'rules' => 'trim|required|xss_clean'
        )
    );

    public function tes(){
        return true;
    }
    
    public function get_new(){
        $satuan_item = new stdClass();
        $satuan_item->kode = '';
        $satuan_item->satuan = '';
        return $satuan_item;
    }
    
}

/* @End Of File satuan_item_m.php */
/* @Created By : Muhammad Rizki A */