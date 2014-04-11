<?php
class Analisa_harga_detail_M extends MY_Model
{
    protected $_table_name = 'analisa_harga_detail';
    protected $_primary_key = 'id';
//    protected $_order_by = 'no_urut,jenis';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'id_analisa' => array(
            'field' => 'id_analisa', 
            'label' => 'Kode Analisa Harga', 
            'rules' => 'trim|required|xss_clean|integer'
        ),
        'id_item' => array(
            'field' => 'id_item', 
            'label' => 'Item', 
            'rules' => 'trim|required|xss_clean|integer'
        ),
        'volume' => array(
            'field' => 'volume', 
            'label' => 'Kuantitas', 
            'rules' => 'trim|required|xss_clean|numeric'
        )
    );
    
    public function getJson($id)
    {
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
                WHERE a.id_analisa = $id";
        $result['total'] = $this->db->query($query)->num_rows();
        $query = $query." ORDER BY jenis DESC, no_urut ASC"; // $sort $order LIMIT $rows OFFSET $offset" 
        $query_sort_order_limit_offset = $this->db->query($query);
        
        $a = 0; $b = 0; $c = 0; $d = 0;
        foreach ($query_sort_order_limit_offset->result() as $row)
        {
            if($row->jenis == 'upah'){
                if($a == 0){
                    $query_total = $this->db->query("select 
                                                        coalesce(sum(a.volume*b.harga_pagu),0) as total_pagu,
                                                        coalesce(sum(a.volume*b.harga_oe),0) as total_oe
                                                    from analisa_harga_detail a 
                                                    left join item b on b.id = a.id_item
                                                    where a.id_analisa = $id and b.jenis = 'upah'")->row();
                    $total_harga_pagu = $query_total->total_pagu;
                    $total_harga_oe = $query_total->total_oe;
                    array_push(
                        $rowsd, 
                        array(
                            'id' => '-1', 
                            'nama' => 'TENAGA',
                            'total_harga_pagu' => '<b>'.number_format($total_harga_pagu, 2, ',', '.').'</b>',
                            'total_harga_oe' => '<b>'.number_format($total_harga_oe, 2, ',', '.').'</b>'
                        )
                    );
                    $a = 1;
                }
                $row->_parentId = '-1';
                $row->jenis = ucfirst($row->jenis);
                $row->volume = number_format($row->volume, 5, ',', '.');
                $row->harga_pagu = number_format($row->harga_pagu, 2, ',', '.');
                $row->total_harga_pagu = number_format($row->total_harga_pagu, 2, ',', '.');
                $row->harga_oe = number_format($row->harga_oe, 2, ',', '.');
                $row->total_harga_oe = number_format($row->total_harga_oe, 2, ',', '.');
                array_push($rowsd, $row);
            }
            else if($row->jenis == 'satuan'){
                if($b == 0){
                    $query_total = $this->db->query("select 
                                                        coalesce(sum(a.volume*b.harga_pagu),0) as total_pagu,
                                                        coalesce(sum(a.volume*b.harga_oe),0) as total_oe
                                                    from analisa_harga_detail a 
                                                    left join item b on b.id = a.id_item
                                                    where a.id_analisa = $id and b.jenis = 'satuan'")->row();
                    $total_harga_pagu = $query_total->total_pagu;
                    $total_harga_oe = $query_total->total_oe;
                    array_push(
                        $rowsd, 
                        array(
                            'id' => '-2', 
                            'nama' => 'BAHAN',
                            'total_harga_pagu' => '<b>'.number_format($total_harga_pagu, 2, ',', '.').'</b>',
                            'total_harga_oe' => '<b>'.number_format($total_harga_oe, 2, ',', '.').'</b>'
                        )
                    );
                    $b = 1;
                }
                $row->_parentId = '-2';
                $row->jenis = ucfirst($row->jenis);
                $row->volume = number_format($row->volume, 5, ',', '.');
                $row->harga_pagu = number_format($row->harga_pagu, 2, ',', '.');
                $row->total_harga_pagu = number_format($row->total_harga_pagu, 2, ',', '.');
                $row->harga_oe = number_format($row->harga_oe, 2, ',', '.');
                $row->total_harga_oe = number_format($row->total_harga_oe, 2, ',', '.');
                array_push($rowsd, $row);
            }else if($row->jenis == 'alat'){
                if($c == 0){
                    $query_total = $this->db->query("select 
                                                        coalesce(sum(a.volume*b.harga_pagu),0) as total_pagu,
                                                        coalesce(sum(a.volume*b.harga_oe),0) as total_oe
                                                    from analisa_harga_detail a 
                                                    left join item b on b.id = a.id_item
                                                    where a.id_analisa = $id and b.jenis = 'alat'")->row();
                    $total_harga_pagu = $query_total->total_pagu;
                    $total_harga_oe = $query_total->total_oe;
                    array_push(
                        $rowsd, 
                        array(
                            'id' => '-3', 
                            'nama' => 'PERALATAN',
                            'total_harga_pagu' => '<b>'.number_format($total_harga_pagu, 2, ',', '.').'</b>',
                            'total_harga_oe' => '<b>'.number_format($total_harga_oe, 2, ',', '.').'</b>'
                        )
                    );
                    $c = 1;
                }
                $row->_parentId = '-3';
                $row->jenis = ucfirst($row->jenis);
                $row->volume = number_format($row->volume, 5, ',', '.');
                $row->harga_pagu = number_format($row->harga_pagu, 2, ',', '.');
                $row->total_harga_pagu = number_format($row->total_harga_pagu, 2, ',', '.');
                $row->harga_oe = number_format($row->harga_oe, 2, ',', '.');
                $row->total_harga_oe = number_format($row->total_harga_oe, 2, ',', '.');
                array_push($rowsd, $row);
            } 
            else if($row->jenis == 'lumpsum'){
                if($d == 0){
                    $query_total = $this->db->query("select 
                                                        coalesce(sum(a.volume*b.harga_pagu),0) as total_pagu,
                                                        coalesce(sum(a.volume*b.harga_oe),0) as total_oe
                                                    from analisa_harga_detail a 
                                                    left join item b on b.id = a.id_item
                                                    where a.id_analisa = $id and b.jenis = 'lumpsum'")->row();
                    $total_harga_pagu = $query_total->total_pagu;
                    $total_harga_oe = $query_total->total_oe;
                    array_push(
                        $rowsd, 
                        array(
                            'id' => '-4', 
                            'nama' => 'LUMPSUM',
                            'total_harga_pagu' => '<b>'.number_format($total_harga_pagu, 2, ',', '.').'</b>',
                            'total_harga_oe' => '<b>'.number_format($total_harga_oe, 2, ',', '.').'</b>'
                        )
                    );
                    $d = 1;
                }
                $row->_parentId = '-4';
                $row->jenis = ucfirst($row->jenis);
                $row->volume = number_format($row->volume, 5, ',', '.');
                $row->harga_pagu = number_format($row->harga_pagu, 2, ',', '.');
                $row->total_harga_pagu = number_format($row->total_harga_pagu, 2, ',', '.');
                $row->harga_oe = number_format($row->harga_oe, 2, ',', '.');
                $row->total_harga_oe = number_format($row->total_harga_oe, 2, ',', '.');
                array_push($rowsd, $row);
            }
        }
        $result['rows'] = $rowsd;
//        dump($result);
        return json_encode($result);
    }
	
}