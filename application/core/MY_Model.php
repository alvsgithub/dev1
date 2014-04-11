<?php
class MY_Model extends CI_Model {
	
    protected $_table_name = '';
    protected $_primary_key = '';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;
    protected $_logs = FALSE;
	
	
    function __construct() {
        parent::__construct();
    }
	
    public function array_from_post($fields){
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
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
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }
    
    public function get_ljoin($id = NULL, $single = FALSE, $tb_ljoin = NULL, $lc_fk = NULL, $rf_fk = NULL, $select = NULL, $where = NULL){
        if($select != NULL)
            $this->db->select($select);
        
        if($where != NULL)
            $this->db->where($where);
        
        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
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
            $this->db->order_by($this->_order_by);
        }
        $this->db->join($tb_ljoin.' as b', $this->_table_name.'.'.$lc_fk.'='.'b.'.$rf_fk, 'left');
        return $this->db->get($this->_table_name)->$method();
    }
    
    public function get_combobox($id = NULL, $single = FALSE, $value = 'id', $label = NULL, $where = NULL, $withNull = TRUE){
        $this->db->select($value);
        $this->db->select($label,FALSE);
        
        if ($where != NULL)
            $this->db->where($where);
        
        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        }
        elseif($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result_array';
        }

        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);
        } 
        
        if($withNull == TRUE) $options = array(0 => NULL);
        else $options = array();
        foreach ($this->db->get($this->_table_name)->$method() as $data){
            $labelEx = explode(',', $label);
            $view = '';
            foreach($labelEx as $l){ 
                $view .= $data[$l]. ' | ';
            }
            $options[$data[$value]] = $view;
        }
        return $options;
    }
	
    public function get_by($where, $single = FALSE){
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function save($data){

        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $data['created_time'] = $now;
        }
        
        // Set Logs
        if ($this->_logs == TRUE) {
            $data['created_by'] = $this->session->userdata('username');
        }
        
        //!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
        //$this->db->db_debug = FALSE;
        $this->db->set($data);
        if ($this->db->insert($this->_table_name)) {
           return TRUE;
        }else{
           return FALSE;
        }
        
    }

    public function update($data, $id){
        // Set timestamps
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $data['modified_time'] = $now;
        }
        
        // Set Logs
        if ($this->_logs == TRUE) {
            $data['modified_by'] = $this->session->userdata('username');
        }
        
        $this->db->set($data);
        $this->db->where($this->_primary_key, $id);
        if($this->db->update($this->_table_name)){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    public function delete($id){
        //$filter = $this->_primary_filter;
        //$id = $filter($id);

        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        if($this->db->delete($this->_table_name)){
            return true;
        }else{
            return false;
        }
    }
	
    public function getJson($where = NULL)
    {	
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : $this->_order_by;
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $offset = ($page-1) * $rows;

        $result = array();
        $rowsd = array();
        $query = "
                SELECT 
                    a.*
                FROM ".$this->_table_name." a
                WHERE 1 = 1 ".$where;
        $result['total'] = $this->db->query($query)->num_rows();
        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
        $query_sort_order_limit_offset = $this->db->query($query);
        foreach ($query_sort_order_limit_offset->result() as $row)
        {
            array_push($rowsd, $row);
        }
        $result['rows'] = $rowsd;
//        dump($result);
        return json_encode($result);
    }
    
    public function update_for_trigger($id, $data){
        $this->db->set($data);
        $this->db->where($this->_primary_key, $id);
        if($this->db->update($this->_table_name)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function delete_where($array_where){
        if (!$array_where) {
            return FALSE;
        }
        $this->db->where($array_where);
        $this->db->delete($this->_table_name);
    }
    
    public function delete_where_query($query){
        $this->db->query($query);
    }
    
    public function get_manual_where($table, $where = ""){
        $result = array();
        $query = "SELECT * FROM $table WHERE 1=1 $where";
        foreach ($this->db->query($query)->result() as $row)
        {
            $row->tgl = date("d-m-Y",strtotime($row->tgl));
            $result[] = $row;
        }
        return $result;
    }
	
}