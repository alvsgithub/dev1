<?php
class Analisa_harga_M extends MY_Model
{
    protected $_table_name = 'analisa_harga';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'id_periode' => array(
            'field' => 'id_periode', 
            'label' => 'Periode', 
            'rules' => 'trim|required|xss_clean|integer'
        ),
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
        'satuan' => array(
            'field' => 'satuan', 
            'label' => 'Satuan',
            'rules' => 'trim|required|xss_clean'
        )
    );

    public function get_new(){
        $analisa_harga = new stdClass();
        $analisa_harga->id_periode = '';
        $analisa_harga->kode = '';
        $analisa_harga->nama = '';
        $analisa_harga->satuan = '';
        return $analisa_harga;
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
        }else {
            $filter = '';
        }
		
        $result = array();
        $rowsd = array();
        $query = "
            SELECT 
                a.*, 
                (SELECT COALESCE(SUM(c.harga_pagu*b.volume),0) FROM analisa_harga_detail b LEFT JOIN item c ON c.id = b.id_item WHERE b.id_analisa = a.id) AS harga_pagu,
                (SELECT COALESCE(SUM(c.harga_oe*b.volume),0) FROM analisa_harga_detail b LEFT JOIN item c ON c.id = b.id_item WHERE b.id_analisa = a.id) AS harga_oe
            FROM ".$this->_table_name." a
            LEFT JOIN periode p ON p.id = a.id_periode
            WHERE 1 = 1 ".$where." ".$filter;
        $result['total'] = $this->db->query($query)->num_rows();
        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
        $query_sort_order_limit_offset = $this->db->query($query);
        foreach ($query_sort_order_limit_offset->result() as $row)
        {
            $row->harga_pagu = number_format($row->harga_pagu, 2, '.', ',');
            $row->harga_oe = number_format($row->harga_oe, 2, '.', ',');
            array_push($rowsd, $row);
        }
        $result['rows'] = $rowsd;
//        dump($result);
        return json_encode($result);
    }
}