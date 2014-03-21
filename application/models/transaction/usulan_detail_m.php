<?php
class Usulan_detail_M extends MY_Model
{
    protected $_table_name = 'usulan_detail';
    protected $_primary_key = 'id';
    protected $_order_by = 'versi';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'versi' => array(
            'field' => 'kode', 
            'label' => 'Kode', 
            'rules' => 'trim|required|xss_clean'
        ),
        'kode_usulan' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean'
        )
    );
    
    public function getJson($where = NULL)
    {	
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : $this->_order_by;
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $offset = ($page-1) * $rows;
		
        $result = array();
        $rowsd = array();
        $query = "
                SELECT a.* FROM ".$this->_table_name." a 
                LEFT JOIN usulan b ON b.kode = a.kode_usulan
                LEFT JOIN periode p ON p.id = b.id_periode
                WHERE ".$where;

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