<?php
class Dokumen_usulan_M extends MY_Model
{
    protected $_table_name = 'doc_usulan';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'id_usulan_detail' => array(
            'field' => 'id_usulan_detail', 
            'label' => 'Id_usulan_detail', 
            'rules' => 'trim|required|xss_clean'
        ),
        'link' => array(
            'field' => 'link', 
            'label' => 'Link', 
            'rules' => 'trim|required|xss_clean'
        ),
        'keterangan' => array(
            'field' => 'keterangan', 
            'label' => 'Keterangan',
            'rules' => 'trim|required|xss_clean'
        )
    );

    public function get_new(){
        $dokumen_usulan = new stdClass();
        $dokumen_usulan->id_usulan_detail = '';
        $dokumen_usulan->link = '';
        $dokumen_usulan->keterangan = '';
        return $dokumen_usulan;
    }
    
    public function getJson($where = NULL)
    {	
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : $this->_order_by;
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $offset = ($page-1) * $rows;

		$filter = isset($_POST['filter']) ? strval($_POST['filter']) : '';
		if($filter!='') {
			list($field, $value) = explode('|', $filter);
		    $filter = "AND upper(".$field.") like upper('%".$value."%')";
		}else{
		    $filter = '';
		}
		
        $result = array();
        $rowsd = array();
        $query = "
                SELECT * FROM ".$this->_table_name."
                WHERE ".$where." ".$filter;

        $result['total'] = $this->db->query($query)->num_rows();
        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
        $query_sort_order_limit_offset = $this->db->query($query);
        foreach ($query_sort_order_limit_offset->result() as $row)
        {
            array_push($rowsd, $row);
        }
        $result['rows'] = $rowsd;
        return json_encode($result);
    }
    
}