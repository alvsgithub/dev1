<?php
class Analisa_harga_detail_M extends MY_Model
{
    protected $_table_name = 'analisa_harga_detail';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;
	
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
                    a.*,
					c.kode, c.nama, c.satuan
                FROM ".$this->_table_name." a
				LEFT JOIN analisa_harga b ON b.id = a.id
				LEFt JOIN item c ON c.id = a.id_item
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
	
}