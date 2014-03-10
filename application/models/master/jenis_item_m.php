<?php
class Jenis_item_M extends MY_Model
{
    protected $_table_name = 'jenis_item';
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
        'jenis' => array(
            'field' => 'jenis',
            'label' => 'Jenis Item',
            'rules' => 'trim|required|xss_clean'
        )
    );

    public function get_new(){
        $jenis_item = new stdClass();
        $jenis_item->kode = '';
        $jenis_item->jenis = '';
        return $jenis_item;
    }
    
}

/* @End Of File jenis_item_m.php */
/* @Created By : Muhammad Rizki A */