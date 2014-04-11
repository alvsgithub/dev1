<?php
class Volume_M extends MY_Model
{
    protected $_table_name = 'volume';
    protected $_primary_key = 'id';
    protected $_order_by = 'kode';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'kode' => array(
            'field' => 'kode', 
            'label' => 'Kode', 
            'rules' => 'trim|required|xss_clean'
        ),
        'rumus' => array(
            'field' => 'rumus', 
            'label' => 'Rumus', 
            'rules' => 'trim|required|xss_clean|max_length[255]'
        ),
        'kelompok' => array(
            'field' => 'kelompok', 
            'label' => 'Kelompok', 
            'rules' => 'trim|required|xss_clean'
        )
    );
	
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
                    a.id, a.kode, a.rumus, a.kelompok
            FROM ".$this->_table_name." a 
            WHERE id_periode = $id_periode AND 

                    (
                     upper(a.kode) LIKE '%$q%' OR 

                     upper(a.rumus) LIKE '%$q%' OR 

                     upper(a.kelompok) LIKE '%$q%'
                    )";

        $result['total'] = $this->db->query($query)->num_rows();

        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
//        LIMIT $rows OFFSET $offset
        $query_sort_order_limit_offset = $this->db->query($query);

        foreach ($query_sort_order_limit_offset->result() as $row)
        {
            array_push($rowsd, $row);
        }

        $result['rows'] = $rowsd;

        return json_encode($result);

    }
    
    public function getJson()
    {	
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : $this->_order_by;
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $offset = ($page-1) * $rows;

        $filter = isset($_POST['filter']) ? strval($_POST['filter']) : '';
        if($filter!='') {
                list($field, $value) = explode('|', $filter);
            $filter = " upper(".$field.") like upper('%".$value."%')";
        }else {
            $filter = '';
        }
        
        $result = array();
        $rowsd = array();
        $query = '
            SELECT 
                a.id, a.kode, a.rumus, a.kelompok
            FROM '.$this->_table_name.' a
            WHERE 1=1 '.$filter;
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
