<?php
class Periode_M extends MY_Model
{
    protected $_table_name = 'periode';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'tahun' => array(
            'field' => 'tahun', 
            'label' => 'Tahun', 
            'rules' => 'trim|required|xss_clean'
        ),
        'semester' => array(
            'field' => 'semester', 
            'label' => 'Semester', 
            'rules' => 'trim|required|xss_clean'
        ),
        'locked' => array(
            'field' => 'locked', 
            'label' => 'Locked', 
            'rules' => 'trim|required'
        ),
        'active' => array(
            'field' => 'active', 
            'label' => 'Active',
            'rules' => 'trim|required'
        )
    );

    public function get_new(){
        $periode = new stdClass();
        $periode->tahun = '';
        $periode->semester = '';
        $periode->locked = '';
        $periode->active = '';
        return $periode;
    }
    
}

/* @End Of File periode_m.php */
/* @Created By : Muhammad Rizki A */