<?php
class Item_M extends MY_Model
{
    protected $_table_name = 'item';
    protected $_primary_key = 'id';
    protected $_order_by = 'kode';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'id_periode' => array(
            'field' => 'id_periode', 
            'label' => 'Periode', 
            'rules' => 'trim|required|xss_clean'
        ),
        'kode' => array(
            'field' => 'kode', 
            'label' => 'Kode', 
            'rules' => 'trim|required|xss_clean|callback__unique_per_periode|max_length[11]'
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
    
    public function get_item_by($jenis){
        $this->db->select('item.*, concat(periode.tahun,'.'0'.',periode.semester) as periode', FALSE);
        $this->db->from('item');
        $this->db->join('periode', 'periode.id = item.id_periode', 'left');
        $this->db->where('item.jenis', $jenis);
        return $this->db->get()->result();
    }
	
    public function getJsonOpt($id_periode)
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
            WHERE id_periode = $id_periode AND 

                    (
                     upper(a.kode) LIKE '%$q%' OR 

                     upper(a.nama) LIKE '%$q%' OR 

                     upper(a.satuan) LIKE '%$q%'
                    )";

        $result['total'] = $this->db->query($query)->num_rows();

        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
//        LIMIT $rows OFFSET $offset
        $query_sort_order_limit_offset = $this->db->query($query);

        foreach ($query_sort_order_limit_offset->result() as $row)
        {
//            $row->waktu = date("d-m-Y",strtotime($row->waktu));
            $row->harga_pagu = number_format($row->harga_pagu, 2, ',', '.');
            $row->harga_oe = number_format($row->harga_oe, 2, ',', '.');
            array_push($rowsd, $row);
        }

        $result['rows'] = $rowsd;

        return json_encode($result);

    }
    
    public function getJson($id_periode,$jenis)
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
        $query = '
            SELECT 
                a.id, a.kode, a.nama, a.satuan, a.harga_pagu, a.harga_oe, a.id_periode, a.jenis
            FROM '.$this->_table_name.' a
            LEFT JOIN periode p ON p.id = a.id_periode
            WHERE a.id_periode = '.$id_periode.' AND a.jenis = \''.$jenis.'\''.$filter;
        $result['total'] = $this->db->query($query)->num_rows();
        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
        $query_sort_order_limit_offset = $this->db->query($query);
        foreach ($query_sort_order_limit_offset->result() as $row)
        {
            $row->harga_pagu = number_format($row->harga_pagu, 2, ',', '.');
            $row->harga_oe = number_format($row->harga_oe, 2, ',', '.');
            array_push($rowsd, $row);
        }
        $result['rows'] = $rowsd;
//        dump($result);
        return json_encode($result);
    }
}
