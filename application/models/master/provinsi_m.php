<?php
class Provinsi_M extends MY_Model
{
    protected $_table_name = 'provinsi';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
    protected $_logs = FALSE;
    public $rules = array(
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean'
        )
    );

    public function get_new(){
        $provinsi = new stdClass();
        $provinsi->id = '';
        $provinsi->nama = '';
        return $provinsi;
    }
    
}