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
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'c.jenis';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'DESC';
        $offset = ($page-1) * $rows;

        $result = array();
        $rowsd = array();
        $query = "
                SELECT 
                    a.*, c.jenis,
					c.kode, c.nama, c.satuan, c.harga_pagu, c.harga_oe,
					(c.harga_pagu*a.volume) AS total_harga_pagu,
					(c.harga_oe*a.volume) AS total_harga_oe
                FROM ".$this->_table_name." a
				LEFT JOIN analisa_harga b ON b.id = a.id
				LEFt JOIN item c ON c.id = a.id_item
				WHERE 1 = 1 ".$where;
        $result['total'] = $this->db->query($query)->num_rows();
        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 
        $query_sort_order_limit_offset = $this->db->query($query);
        
		$u = TRUE; $a = TRUE; $sl = TRUE;
		foreach ($query_sort_order_limit_offset->result() as $row)
        {
			if($row->jenis == 'upah' AND $u == TRUE) {
				array_push($rowsd, array('kode' => '<B>TENAGA</B>', 'nama' => '') );
				$u = FALSE;
			}else if($row->jenis = 'alat' AND $a == TRUE){
				array_push($rowsd, array('kode' => '<B>ALAT</B>', 'nama' => '' ) );
				$a = FALSE;
			}else if(($row->jenis = 'satuan' OR $row->jenis == 'lumpsum') AND $sl == TRUE){
				array_push($rowsd, array('kode' => '<B>BAHAN</B>', 'nama' => '' ) );
				$sl = FALSE;
			}

			$row->harga_pagu = number_format($row->harga_pagu, 2, '.', ',');
			$row->total_harga_pagu = number_format($row->total_harga_pagu, 2, '.', ',');
			$row->harga_oe = number_format($row->harga_oe, 2, '.', ',');
			$row->total_harga_oe = number_format($row->total_harga_oe, 2, '.', ',');
            array_push($rowsd, $row);
        }
        $result['rows'] = $rowsd;
//        dump($result);
        return json_encode($result);
    }
	
}