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
                a.*,
                (select count(*) from tahapan where id_parent = a.id) as state,
                harga_pagu,
                harga_oe
            from tahapan a
            where '.$where.' AND a.id_parent = '.$id.'
            order by '.$this->_order_by)->result_array();
        $array = array();
        foreach ($tahapans as $tahapan) {
            $tahapan['state'] = $tahapan['state'] > 0 ? 'closed' : 'open';
            $tahapan['menu'] = '';
            $tahapan['harga_pagu'] = $tahapan['harga_pagu'] != NULL ? number_format($tahapan['harga_pagu'], 2, ',', '.') : '';
            $tahapan['harga_oe'] = $tahapan['harga_oe'] != NULL ? number_format($tahapan['harga_oe'], 2, ',', '.') : '';
            array_push($array, $tahapan);
        }
		
        // dump($array);
        return json_encode($array);
    }
    
    public function getJsonAnalisaItem()
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
//            $row->waktu = date("d-m-Y",strtotime($row->waktu));
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