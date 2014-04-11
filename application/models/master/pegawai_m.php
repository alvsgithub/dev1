<?php
class Pegawai_M extends MY_Model
{
    protected $_table_name = 'pegawai';
    protected $_primary_key = 'nopeg';
    protected $_order_by = 'nama';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'nopeg' => array(
            'field' => 'nopeg', 
            'label' => 'NPP', 
            'rules' => 'trim|required|xss_clean|callback__unique_nopeg|max_length[11]'
        ),
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean|max_length[255]'
        ),
        'jabatan' => array(
            'field' => 'jabatan', 
            'label' => 'Jabatan', 
            'rules' => 'trim|required|xss_clean|max_length[100]'
        ),
        'username' => array(
            'field' => 'username', 
            'label' => 'Username',
            'rules' => 'trim|required|xss_clean'
        ),
        'kode_bagian' => array(
            'field' => 'kode_bagian', 
            'label' => 'Kode Bagian',
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
                a.nopeg, a.nama, a.jabatan, a.kode_bagian, a.username
            FROM ".$this->_table_name." a 
            LEFT JOIN bagian b ON b.kode = a.kode_bagian
            WHERE 

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
            $filter = "AND upper(".$field.") like upper('%".$value."%')";
        }else {
            $filter = '';
        }
        
        $result = array();
        $rowsd = array();
        $query = '
            SELECT 
                a.nopeg, a.nama, a.jabatan, a.kode_bagian, a.username,
                b.nama AS bagian
            FROM '.$this->_table_name.' a
            LEFT JOIN bagian b ON b.kode = a.kode_bagian
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
