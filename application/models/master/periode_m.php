<?php
class Periode_M extends MY_Model
{
    protected $_table_name = 'periode';
    protected $_primary_key = 'id';
    protected $_order_by = 'active';
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
            'rules' => 'trim|required|callback__active_only_one'
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
    
	public function get($id = NULL, $single = FALSE){
        if ($id != NULL) {
            //$filter = $this->_primary_filter;
            //$id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        }
        elseif($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }

        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by, 'DESC');
            $this->db->order_by('modified_time', 'DESC');
        }
        return $this->db->get($this->_table_name)->$method();
    }
	
}

/* @End Of File periode_m.php */
/* @Created By : Muhammad Rizki A */