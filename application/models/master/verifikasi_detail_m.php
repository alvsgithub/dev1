<?php
class Verifikasi_detail_M extends MY_Model
{
    protected $_table_name = 'verifikasi_detail';
    protected $_primary_key = 'id';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;
    
    public function getJson($id)
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
                a.*, b.username, b.nama, b.jabatan, c.nama as bagian
            FROM ".$this->_table_name." a
            LEFT JOIN pegawai b ON b.nopeg = a.nopeg
            LEFT JOIN bagian c ON c.kode = b.kode_bagian
            WHERE a.id_verifikasi = $id";
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
    
    public function createRoleVerifikasi($tabel,$kode){
        if($this->db->query('
            INSERT INTO transaction_role
            (level, nopeg, nama, jabatan, kode, tabel)
            (SELECT 
            a.level, a.nopeg, c.nama, c.jabatan, \''.$kode.'\', \''.$tabel.'\'
            FROM verifikasi_detail a
            LEFT JOIN verifikasi b ON b.id = a.id_verifikasi
            LEFT JOIN pegawai c ON c.nopeg = a.nopeg
            WHERE b.tabel = \''.$tabel.'\')
        ')){
            return true;
        }else{
            return false;
        }
    }
    
    public function getRoleVerifikasi($tabel,$kode){
        return $this->db->query('
            select 
                level, nopeg, nama, jabatan, approved_time, kode, tabel
            from transaction_role 
            where kode = \''.$kode.'\' and
                  tabel = \''.$tabel.'\' 
            order by level asc')->result_array();
    }
    
}
