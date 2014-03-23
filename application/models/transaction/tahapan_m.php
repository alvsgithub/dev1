<?php
class Tahapan_M extends MY_Model
{
    protected $_table_name = 'tahapan';
    protected $_primary_key = 'id';
    protected $_order_by = 'no_urut,id_parent';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean'
        ),
        'no_urut' => array(
            'field' => 'no_urut', 
            'label' => 'No Urut',
            'rules' => 'trim|required|xss_clean|integer'
        )
    );
	
    public function getJson($where = NULL)
    {	
		$id = isset($_POST['id']) ? ($_POST['id']) : '0' ; 
		
        $tahapans = $this->db->query('
			select 
				a.*
			from tahapan a
			where '.$where.' AND a.id_parent = '.$id.'
			order by '.$this->_order_by)->result_array();

        $array = array();
        //$array2 = array();
        foreach ($tahapans as $tahapan) {
			$count = $this->db->query('select count(*) as total_child from tahapan where id_parent = '.$tahapan['id'])->row()->total_child;
			$tahapan['state'] = $count > 0 ? 'closed' : 'open';
            array_push($array, $tahapan);
        }
		
		// dump($array);
        return json_encode($array);
    }
    
}