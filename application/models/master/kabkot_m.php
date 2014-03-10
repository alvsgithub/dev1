<?php
class Kabkot_M extends MY_Model
{
    protected $_table_name = 'kabupaten_kota';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
    protected $_logs = FALSE;
    public $rules = array(
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean'
        ), 
        'jenis' => array(
            'field' => 'jenis', 
            'label' => 'Jenis', 
            'rules' => 'trim|required'
        ),
        'id_provinsi' => array(
            'field' => 'id_provinsi', 
            'label' => 'Provinsi', 
            'rules' => 'trim|required|integer'
        )
    );

    public function get_new(){
        $kabkot = new stdClass();
        $kabkot->id = '';
        $kabkot->nama = '';
        $kabkot->jenis = '';       
        $kabkot->id_provinsi = '';
        return $kabkot;
    }
    
}