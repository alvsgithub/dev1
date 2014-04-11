<?php
class Tahapan_M extends MY_Model
{
    protected $_table_name = 'tahapan';
    protected $_order_by = 'id';
    protected $_timestamps = TRUE;
    protected $_logs = TRUE;

    public $rules = array(
        'id_parent' => array(
            'field' => 'id_parent', 
            'label' => 'Parent', 
            'rules' => 'trim|required|xss_clean'
        ),
        'id_usulan_detail' => array(
            'field' => 'id_usulan_detail', 
            'label' => 'Usulan Detail', 
            'rules' => 'trim|required|xss_clean|integer'
        ),
        'nama' => array(
            'field' => 'nama', 
            'label' => 'Nama', 
            'rules' => 'trim|required|xss_clean|max_length[250]'
        )
    );
	
    public function getJson($iud)
    {
//        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
//        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'CAST(id AS unsigned)';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'ASC';
//        $offset = ($page-1) * $rows;
        
//        $id = isset($_POST['id']) ? strval($_POST['id']) : 0;

        $result = array();        
        $this->db->query("call proc_tahapan($iud)");
        
        $result['total'] = $this->db->query('SELECT count(*) as parent FROM tahapan WHERE id_usulan_detail = '.$iud)->row()->parent;
        $tahapans = $this->db->query("
        SELECT 
            a.id, a.id_usulan_detail, a.id_parent, a.level, 
            a.nama, a.kode, a.satuan, 
            a.volume, a.harga_pagu, a.harga_oe,
            (SELECT count(*) FROM tahapan where id_parent = a.id) AS state,
            (CASE WHEN id_analisa IS NOT NULL THEN
                a.id_analisa
            ELSE
                a.id_item
            END) ai,
            (CASE WHEN id_analisa IS NOT NULL 
            THEN
                'analisa_harga'
            ELSE
                'item'
            END) AS jenis_ai
        FROM tahapan a
        WHERE a.id_usulan_detail = $iud
        ORDER BY $sort $order")->result_array();
//            AND a.id_parent = '$id'
        $rowsd = array();
        foreach ($tahapans as $tahapan) {
            if($tahapan['state'] == 0 && $tahapan['kode'] == NULL) { 
                $tahapan['iconCls'] = 'icon-folder';
            }
            $tahapan['state'] = $tahapan['state'] > 0 ? 'closed' : 'open';
            if($tahapan['level'] != 1){
                $tahapan['_parentId'] = $tahapan['id_parent'];
            }
            $tahapan['menu'] = '';
            
            $tahapan['no_urut'] = substr($tahapan['id'], -1);
            $tahapan['kode'] = $tahapan['kode'] != NULL ? $tahapan['kode'] : '';
            $tahapan['volume'] = $tahapan['volume'] != NULL ? number_format($tahapan['volume'], 5, ',', '.') : '';
            $tahapan['harga_pagu'] = $tahapan['harga_pagu'] != NULL ? number_format($tahapan['harga_pagu'], 2, ',', '.') : '';
            $tahapan['harga_oe'] = $tahapan['harga_oe'] != NULL ? number_format($tahapan['harga_oe'], 2, ',', '.') : '';
            
//            if($tahapan['kode'] == '')
            
            array_push($rowsd, $tahapan);
        }
        $result['rows'] = $rowsd;
//        }
        
        $footer = array();
        $harga_pagu = $this->db->query('SELECT COALESCE(SUM(harga_pagu),0) AS harga_pagu FROM tahapan WHERE id_parent = 0 AND id_usulan_detail = '.$iud)->row()->harga_pagu;
        $harga_oe = $this->db->query('SELECT COALESCE(SUM(harga_oe),0) AS harga_oe FROM tahapan WHERE id_parent = 0 AND id_usulan_detail = '.$iud)->row()->harga_oe;
        $harga_pagu_ppn = $harga_pagu * (10/100);
        $harga_oe_ppn = $harga_oe * (10/100);
        $harga_pagu_ds = $harga_pagu * (2/100);
        //$harga_oe_ds = $harga_oe * (2/100);

        $harga_pagu_gt = $harga_pagu + $harga_pagu_ppn + $harga_pagu_ds;
        $harga_oe_gt = $harga_oe + $harga_oe_ppn;

        array_push($footer,
            array(
                'id' => '.',
                'nama' => 'TOTAL',
                'menu' => 'FOOTER',
                'kode' => '',
                'volume' => '',
                'harga_pagu' => number_format($harga_pagu,2,',','.'),
                'harga_oe' => number_format($harga_oe,2,',','.'),
                'iconCls' => 'icon-sum'
            )
        );
        array_push($footer,
            array(
                'id' => '.',
                'nama' => 'PPN 10%',
                'menu' => 'FOOTER',
                'kode' => '',
                'volume' => '',
                'harga_pagu' => number_format($harga_pagu_ppn,2,',','.'),
                'harga_oe' => number_format($harga_oe_ppn,2,',','.'),
                'iconCls' => 'icon-sum'
            )
        );
        array_push($footer,
            array(
                'id' => '.',
                'nama' => 'Desain & Survey',
                'menu' => 'FOOTER',
                'kode' => '',
                'volume' => '',
                'harga_pagu' => number_format($harga_pagu_ds,2,',','.'),
                'harga_oe' => number_format(0,2,',','.'),
                'iconCls' => 'icon-sum'
            )
        );
        array_push($footer,
            array(
                'id' => '.',
                'nama' => 'Grand Total',
                'menu' => 'FOOTER',
                'kode' => '',
                'volume' => '',
                'harga_pagu' => number_format($harga_pagu_gt,2,',','.'),
                'harga_oe' => number_format($harga_oe_gt,2,',','.'),
                'iconCls' => 'icon-sum'
            )
        );
        $result['footer'] = $footer;
        
        return json_encode($result);
    }
    
    public function getJsonAnalisaItem($id_periode)
    {

        $q = isset($_POST['q']) ? strval($_POST['q']) : '';    
        $q = strtoupper($q);

        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'kode';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $offset = ($page-1) * $rows;

        $result = array();
        $rowsd = array();
        $query = "

            SELECT 
                a.id, a.kode, a.nama, a.satuan, 
                a.harga_pagu, a.harga_oe,
                a.tabel, a.id AS ai
            FROM vanalisaitem a 
            WHERE a.id_periode = $id_periode AND 

                (upper(a.kode) LIKE '%$q%' OR 

                 upper(a.nama) LIKE '%$q%' OR 

                 upper(a.satuan) LIKE '%$q%')";

        $result['total'] = $this->db->query($query)->num_rows();

        $query = $query." ORDER BY $sort $order LIMIT $rows OFFSET $offset"; 

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
    
    public function save($data, $id, $iud, $insupd){
        // Insert
        if ($insupd == 'INSERT') {
            $data['created_time'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('username');
            if ($this->db->insert($this->_table_name,$data)) {
               return TRUE;
            }else{
               return FALSE;
            }
        }
        // Update
        else if ($insupd == 'UPDATE') {
            $data['modified_time'] = date('Y-m-d H:i:s');
            $data['modified_by'] = $this->session->userdata('username');
            $this->db->where(array('id' => $id, 'id_usulan_detail' => $iud));
            if($this->db->update($this->_table_name,$data)){
                if(!isset($data['kode'])){
                    $this->db->query('
                        UPDATE tahapan SET
                            id = CONCAT('.$data['id'].',substr(id,CHAR_LENGTH(\''.$data['id'].'\')+1))
                        WHERE substr(id,1,'.strlen($id).') = \''.$id.'\' AND id_usulan_detail = '.$iud.'
                    ');
                    $this->db->query('
                        UPDATE tahapan SET
                            id_parent = (CASE WHEN id_parent <> 0 THEN substr(id,1,CHAR_LENGTH(id)-2) ELSE 0 END)
                        WHERE substr(id,1,'.strlen($id).') = \''.$data['id'].'\' AND id_usulan_detail = '.$iud.'
                    ');  
                    $this->db->query('
                        UPDATE usulan_detail SET 
                            modified_time = \''.date('Y-m-d H:i:s').'\',
                            modified_by = \''.$this->session->userdata('username').'\'
                        WHERE id = '.$iud);
                }
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
    public function delete($id,$uid){
        if($this->db->query('
            DELETE FROM tahapan 
            WHERE 
                substr(id, 1, '.strlen($id).') = \''.$id.'\' AND 
                id_usulan_detail = '.$uid)){
            return true;
        }else{
            return false;
        }   
    }
    
}