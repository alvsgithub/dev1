<?php
class Usulan_M extends MY_Model
{
    protected $_table_name = 'usulan';
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
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean'
        ),
        'lokasi' => array(
            'field' => 'lokasi', 
            'label' => 'Lokasi',
            'rules' => 'trim|required|xss_clean'
        ),
        'id_periode' => array(
            'field' => 'id_periode', 
            'label' => 'Periode', 
            'rules' => 'trim|required|xss_clean|integer'
        )
    );

    public function get_new(){
        $rab = new stdClass();
        $rab->kode = '';
        $rab->nama = '';
        $rab->lokasi = '';
        $rab->id_periode = '';
        return $rab;
    }
    
    public function gen_new_kode(){
        return $this->db->query('SELECT fn_gen_kode_usulan() AS kode')->row()->kode;
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
                SELECT * FROM ".$this->_table_name." a 
                LEFT JOIN periode p ON p.id = a.id_periode
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