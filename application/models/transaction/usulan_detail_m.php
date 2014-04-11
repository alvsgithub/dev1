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
            'field' => 'versi', 
            'label' => 'Versi', 
            'rules' => 'trim|required|xss_clean|integer'
        ),
        'kode_usulan' => array(
            'field' => 'kode_usulan', 
            'label' => 'Kode Usulan', 
            'rules' => 'trim|required|xss_clean|exact_length[13]'
        )
    );
    
    public function getJson($kode)
    {	
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : $this->_order_by;
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $offset = ($page-1) * $rows;
		
        $result = array();
        $rowsd = array();
        $query = '
                SELECT 
                    a.*, 
                    (SELECT COALESCE(SUM(p.harga_pagu),0) FROM tahapan p WHERE p.id_usulan_detail = a.id AND p.id_parent = \''.'0'.'\') AS anggaran,
                    (SELECT COALESCE(SUM(p.harga_oe),0) FROM tahapan p WHERE p.id_usulan_detail = a.id AND p.id_parent = \''.'0'.'\') AS oe
                FROM '.$this->_table_name.' a 
                LEFT JOIN usulan b ON b.kode = a.kode_usulan
                LEFT JOIN periode p ON p.id = b.id_periode
                WHERE a.kode_usulan = \''.$kode.'\'';

        $result['total'] = $this->db->query($query)->num_rows();
        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
        $query_sort_order_limit_offset = $this->db->query($query);
        foreach ($query_sort_order_limit_offset->result() as $row)
        {
            $row->created_time = date("d-m-Y H:i:s",strtotime($row->created_time));
            $row->modified_time = date("d-m-Y H:i:s",strtotime($row->modified_time));
            $row->anggaran = number_format($row->anggaran, 2, ',', '.');
            $row->oe = number_format($row->oe, 2, ',', '.');
            array_push($rowsd, $row);
        }
        $result['rows'] = $rowsd;
        return json_encode($result);
    }
    
    public function get_detail_rab($kode)
    {
        $result = array();
        $query = '
                SELECT 
                    a.*, 
                    (SELECT COALESCE(SUM(p.harga_pagu),0) FROM tahapan p WHERE p.id_usulan_detail = a.id AND p.id_parent = \''.'0'.'\') AS anggaran,
                    (SELECT COALESCE(SUM(p.harga_oe),0) FROM tahapan p WHERE p.id_usulan_detail = a.id AND p.id_parent = \''.'0'.'\') AS oe
                FROM '.$this->_table_name.' a 
                LEFT JOIN usulan b ON b.kode = a.kode_usulan
                LEFT JOIN periode p ON p.id = b.id_periode
                WHERE a.kode_usulan = \''.$kode.'\'';
        foreach ($this->db->query($query)->result() as $row)
        {
            $row->created_time = date("d-m-Y H:i:s",strtotime($row->created_time));
            $row->modified_time = date("d-m-Y H:i:s",strtotime($row->modified_time));
            $row->anggaran = $row->anggaran;
            $row->oe = $row->oe;
            array_push($result, $row);
        }
        
        return $result;
    }
}