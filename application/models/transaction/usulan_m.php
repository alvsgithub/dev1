<?php
class Usulan_M extends MY_Model
{
    protected $_table_name = 'usulan';
    protected $_primary_key = 'kode';
    protected $_order_by = 'kode';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;
    
    public $rules = array(
        'id_periode' => array(
            'field' => 'id_periode', 
            'label' => 'Periode', 
            'rules' => 'trim|required|xss_clean|integer'
        ),
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean|max_length[250]'
        ),
        'lokasi' => array(
            'field' => 'lokasi', 
            'label' => 'Lokasi', 
            'rules' => 'trim|required|xss_clean|max_length[250]'
        )
    );
    
    public function gen_new_kode(){
        return $this->db->query('SELECT fn_gen_kode_usulan() AS kode')->row()->kode;
    }
    
    public function getJson($id_periode)
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
                SELECT 
                    a.kode, a.nama, a.lokasi, a.id_periode, a.position,
                    concat(a.status,' ',COALESCE((SELECT jabatan FROM transaction_role WHERE tabel = 'usulan' AND kode = a.kode AND level = a.position),'')) AS status
                FROM ".$this->_table_name." a 
                LEFT JOIN periode p ON p.id = a.id_periode
                WHERE a.id_periode = ".$id_periode." ".$filter;

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
    
    public function getJsonUsulanVerified($tahun)
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
            SELECT a.* 
            FROM ".$this->_table_name." a 
            LEFT JOIN periode b ON b.id = a.id_periode
            WHERE b.tahun = '$tahun' AND a.kode NOT IN (SELECT kode_rab FROM paket_detail) ".$filter;

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