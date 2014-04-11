<?php
class Paket_detail_M extends MY_Model
{
    protected $_table_name = 'paket_detail';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;
        
    public function getJson($kode_paket)
    {	
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : $this->_order_by;
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $offset = ($page-1) * $rows;

        $filter = isset($_POST['filter']) ? strval($_POST['filter']) : '';
        if($filter!='') {
                list($field, $value) = explode('|', $filter);
            $filter = "AND upper(".$field.") like upper('%".$value."%')";
        }else {
            $filter = '';
        }
		
        $result = array();
        $rowsd = array();
        $query = "
                SELECT 
                    a.*,
                    b.nama, b.lokasi
                FROM ".$this->_table_name." a 
                LEFT JOIN usulan b ON b.kode = a.kode_rab
                WHERE a.kode_paket = '" . $kode_paket. "' " . $filter;
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