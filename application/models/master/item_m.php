<?php
class Item_M extends MY_Model
{
    protected $_table_name = 'item';
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
        'jenis' => array(
            'field' => 'jenis', 
            'label' => 'Jenis', 
            'rules' => 'trim|required|xss_clean'
        ),
        'satuan' => array(
            'field' => 'satuan', 
            'label' => 'Satuan',
            'rules' => 'trim|required|xss_clean'
        ),
        'harga_pagu' => array(
            'field' => 'harga_pagu', 
            'label' => 'Harga Pagu',
            'rules' => 'trim|xss_clean|numeric'
        ),
        'harga_oe' => array(
            'field' => 'harga_oe', 
            'label' => 'Harga OE',
            'rules' => 'trim|xss_clean|numeric'
        )
    );

    public function get_new($jenis){
        $item = new stdClass();
        $item->id_periode = '';
        $item->kode = '';
        $item->nama = '';
        $item->jenis = $jenis;
        $item->satuan = '';
        $item->harga_pagu = '';
        $item->harga_oe = '0';
        return $item;
    }
    
    public function get_item_by($jenis){
        $this->db->select('item.*, concat(periode.tahun,'.'0'.',periode.semester) as periode', FALSE);
        $this->db->from('item');
        $this->db->join('periode', 'periode.id = item.id_periode', 'left');
        $this->db->where('item.jenis', $jenis);
        return $this->db->get()->result();
    }
	
	
	public function getJsonOpt()
	{

		$q = isset($_POST['q']) ? strval($_POST['q']) : '';    
		$q = strtoupper($q);
		
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
		$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
		$sort = isset($_POST['sort']) ? strval($_POST['sort']) : $this->_primary_key;
		$order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
		$offset = ($page-1) * $rows;
		
		$result = array();
		$rowsd = array();
		$query = "

			SELECT 
				a.id, a.kode, a.nama, a.satuan, upper(a.jenis) AS jenis,
				a.harga_pagu, a.harga_oe
			FROM ".$this->_table_name." a 
			WHERE 1=1 AND 

				(upper(a.kode) LIKE '%$q%' OR 

				 upper(a.nama) LIKE '%$q%' OR 

				 upper(a.satuan) LIKE '%$q%')";

		$result['total'] = $this->db->query($query)->num_rows();

		$query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 

		$query_sort_order_limit_offset = $this->db->query($query);

		foreach ($query_sort_order_limit_offset->result() as $row)
		{
//                $row->waktu = date("d-m-Y",strtotime($row->waktu));
			$row->harga_pagu = number_format($row->harga_pagu, 2, '.', ',');
			$row->harga_oe = number_format($row->harga_oe, 2, '.', ',');
			array_push($rowsd, $row);
		}

		$result['rows'] = $rowsd;
		
		// $fp = fopen('get_data_kawasan.json', 'w');

		// fwrite($fp, json_encode($result));

		// fclose($fp);

		return json_encode($result);

	}
    
}
