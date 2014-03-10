<?php
class Group_M extends MY_Model
{
    protected $_table_name = 'users_group';
    protected $_order_by = 'id';
    public $rules = array(
            'nama_group' => array(
                'field' => 'nama_group', 
                'label' => 'Nama Group', 
                'rules' => 'trim|required|xss_clean|callback__unique_nama_group'
            )
    );

    public function get_new(){
        $group = new stdClass();
        $group->nama_group = '';
        return $group;
    }

    public function getJsonGroup()
    {
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : $this->_order_by;
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
        $offset = ($page-1) * $rows;

        $result = array();
        $rowsd = array();
        $query = "
                SELECT 
                    a.*
                FROM ".$this->_table_name." a
                WHERE a.id != 1 AND a.id != 2";
        $result['total'] = $this->db->query($query)->num_rows();
        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
        $query_sort_order_limit_offset = $this->db->query($query);
        foreach ($query_sort_order_limit_offset->result() as $row){
            array_push($rowsd, $row);
        }
        $result['rows'] = $rowsd;
//        dump($result);
        return json_encode($result);
    }
    
}