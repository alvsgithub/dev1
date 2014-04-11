<?php
class Paket_M extends MY_Model
{
    protected $_table_name = 'paket';
    protected $_primary_key = 'kode';
    protected $_order_by = 'kode';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'nama' => array(
            'field' => 'kode', 
            'label' => 'Kode', 
            'rules' => 'trim|required|xss_clean|integer'
        ),
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean'
        ),
        'swakelola' => array(
            'field' => 'swakelola', 
            'label' => 'Swakelola', 
            'rules' => 'trim|required|xss_clean'
        ),
        'tahun' => array(
            'field' => 'tahun', 
            'label' => 'Tahun',
            'rules' => 'trim|required|xss_clean|integer'
        )
    );

    public function get_new(){
        $paket = new stdClass();
        $paket->kode = '';
        $paket->nama = '';
        $paket->swakelola = '';
        $paket->tahun = '';
        return $paket;
    }

    public function get_tahun()
    {
        return $this->db->query("SELECT tahun FROM vtahun")->result();
    }

    public function get_kode()
    {
        $query = $this->db->query("SELECT fn_gen_kode_paket() as A");
        $row = $query->row();
        return $row->A;
    }
    
    public function getJson($tahun)
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
                SELECT * FROM ".$this->_table_name." a 
                WHERE a.tahun = '" . $tahun. "' " . $filter;
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