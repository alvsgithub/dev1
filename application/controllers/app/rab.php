<?php
class Rab extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('master/item_m');
        $this->load->model('master/verifikasi_m');
        $this->load->model('master/verifikasi_detail_m');
        $this->load->model('transaction/usulan_m');
        $this->load->model('transaction/usulan_detail_m');
        $this->load->model('transaction/tahapan_m');
    }
    
    public function index()
    {
        
        $this->data['options_periode'] = $this->periode_m->get();

        if(isset($_GET['rab'])){
            echo $this->usulan_m->getJson($_GET['rab']);
        }else if(isset($_GET['rab_detail'])){
            echo $this->usulan_detail_m->getJson($_GET['rab_detail']);
        }else if(isset($_GET['tahapan'])){
            echo $this->tahapan_m->getJson($_GET['tahapan']);
        }else if(isset($_GET['ai'])){
            echo $this->tahapan_m->getJsonAnalisaItem($_GET['idp']);
        }else{
            $this->data['verifikasi'] = 'app/rab/verifikasi';
            $this->data['subview'] = 'app/rab/index';
            $this->load->view('app/_layout_main', $this->data);
        }
        
    }
    
    public function create()
    {
        if(!isset($_POST))  
            show_404();

        // Set up the form
        $rules = $this->usulan_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE){
            $data = $this->usulan_m->array_from_post(array(
                        'id_periode',
                        'nama',
                        'lokasi'
                    ));

            $data['kode'] = $this->usulan_m->gen_new_kode();
            $data['status'] = 'PEMBUATAN';
            if($this->usulan_m->save($data) == TRUE) {
                $data_detail = array(
                    'versi' => '1',
                    'kode_usulan' => $data['kode']
                );
                if($this->usulan_detail_m->save($data_detail) == TRUE){
                    echo json_encode(array('success'=>true));
                }else{
                    echo json_encode(array('msg'=>'error detail usulan'));
                }
            }else{
                echo json_encode(array('msg'=>'error'));
            }
        }else{
            $this->form_validation->set_error_delimiters('', '');
            echo json_encode(array('msg'=> validation_errors() ));
        }
    }

    public function update($id = null)
    {
        if(!isset($_POST)){
            show_404();
        }

        // Set up the form
        $rules = $this->usulan_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE){
            $data = $this->usulan_m->array_from_post(array(
                        'id_periode',
                        'nama',
                        'lokasi'
                    ));

            if($this->usulan_m->update($data, $id) == TRUE) { 
                echo json_encode(array('success'=>true));
            }else{
                echo json_encode(array('msg'=>'error'));
            }
        }else{
            $this->form_validation->set_error_delimiters('', '');
            echo json_encode(array('msg'=> validation_errors() ));
        }
    }
    
    public function delete($id = NULL)
    {
        if(!isset($_POST))
            show_404();

        $id = addslashes($_POST['id']);

        if($this->usulan_m->delete($id) == true){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }
	
    // TAHAPAN //
    public function createTahapan($id = NULL)
    {
        if(!isset($_POST)){
            show_404();
        }
        
        // Set up the form
        $rules = $this->tahapan_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE){
            $data = $this->tahapan_m->array_from_post(
                    array(
                        'nama',
                        'id_parent',
                        'id_usulan_detail'
                    ));
            $no_urut = $this->input->post('no_urut');
            $data['id_usulan_detail'] = $id;
            if($data['id_parent'] == 0){
                $data['level'] = '1';
                $data['id'] = $no_urut;
            }else{
                $data['id'] = $data['id_parent'].'.'.$no_urut;
                $data['level'] = $this->tahapan_m->get_by('id = \''.$data['id_parent'].'\'', true)->level+1;
            }
        
            // cek id already exists
            if(($this->db->query('SELECT count(id) AS cid FROM tahapan WHERE id = \''.$data['id'].'\' AND id_usulan_detail = '.$id)->row()->cid) > 0){
                echo json_encode(array('msg'=>'No urut ini sudah ada'));
            }else{
                if($this->tahapan_m->save($data, $data['id'], $data['id_usulan_detail'], 'INSERT') == TRUE){
                    $this->db->query("call proc_tahapan($id)");
                    echo json_encode(array('success'=>true));
                }else{
                    echo json_encode(array('msg'=>'error'));
                }
            }
        }else{
            $this->form_validation->set_error_delimiters('', '');
            echo json_encode(array('msg'=> validation_errors() ));
        }
    }
    
    public function updateTahapan($id = null)
    {
        if(!isset($_POST)){
            show_404();
        }
        
        $iud = $this->input->post('id_usulan_detail');
        $id_parent = $this->input->post('id_parent');
        $jenis_ai = $this->input->post('jenis_ai');
        $no_urut = $this->input->post('no_urut');
        
        // tahapan / subtahapan
        if($jenis_ai == '' || $jenis_ai == NULL){
            if($id_parent == 0){
                $data['nama'] = $this->input->post('nama');
                $data['id'] = $no_urut;
            }else{
                $data['nama'] = $this->input->post('nama');
                $data['id'] = $id_parent.'.'.$no_urut;
            }

            // cek id already exists
            if(($this->db->query('SELECT count(id) AS cid FROM tahapan WHERE id = \''.$data['id'].'\' AND id_usulan_detail = '.$iud.' AND id <> \''.$id.'\'')->row()->cid) > 0){
                echo json_encode(array('msg'=>'No urut ini sudah ada'));
            }else{
                if($this->tahapan_m->save($data, $id, $iud, 'UPDATE') == TRUE) { 
                    echo json_encode(array('success'=>true));
                }else{
                    echo json_encode(array('msg'=>'Error'));
                }
            }
        }
        // analisa / item
        else{
            $data = $this->tahapan_m->array_from_post(array(
                    'id_parent',
                    'kode',
                    'nama',
                    'satuan',
                    'volume'
                ));
            $data['id'] = $data['id_parent'].'.'.$no_urut;
            if($jenis_ai == 'analisa_harga'){ 
                $data['id_analisa'] = $this->input->post('ai');
            }
            else if($jenis_ai == 'item'){ 
                $data['id_item'] = $this->input->post('ai');
            }
            // cek id already exists
            if(($this->db->query('SELECT count(id) AS cid FROM tahapan WHERE id = \''.$data['id'].'\' AND id_usulan_detail = '.$iud.' AND id <> \''.$id.'\'')->row()->cid) > 0){
                echo json_encode(array('msg'=>'No urut ini sudah ada'));
            }else{
                if($this->tahapan_m->save($data, $id, $iud, 'UPDATE') == TRUE) { 
                    echo json_encode(array('success'=>true));
                }else{
                    echo json_encode(array('msg'=>'Data gagal dismpan!!!'));
                }
            }
        }
    }
    
    public function deleteTahapan()
    {
        if (!isset($_POST)) {
            show_404();
        }

        $id = addslashes($this->input->post('id'));
        $iud = $this->input->post('iud');
        
        if($this->tahapan_m->delete($id,$iud) == true){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }
    
    // ANALISA ITEM //
    public function createAnalisaItem($id = NULL)
    {
        if(!isset($_POST))
            show_404();
        
        $data = $this->tahapan_m->array_from_post(array(
                    'id_parent',
                    'kode',
                    'nama',
                    'satuan',
                    'volume'
                ));
        $jenis_ai = $this->input->post('jenis_ai');
        $no_urut = $this->input->post('no_urut');
        
        if($jenis_ai == 'analisa_harga'){ 
            $data['id_analisa'] = $this->input->post('ai');
        }
        else if($jenis_ai == 'item'){ 
            $data['id_item'] = $this->input->post('ai');
        } 
        $data['id_usulan_detail'] = $id;
        if($data['id_parent'] == 0){
            $data['level'] = '1';
            $data['id'] = $no_urut;
        }else{
            $data['id'] = $data['id_parent'].'.'.$no_urut;
            $data['level'] = $this->tahapan_m->get_by('id = \''.$data['id_parent'].'\'', true)->level+1;
        }
        
        // cek id already exists
        if(($this->db->query('SELECT count(id) AS cid FROM tahapan WHERE id = \''.$data['id'].'\' AND id_usulan_detail = '.$id)->row()->cid) > 0){
            echo json_encode(array('msg'=>'No urut ini sudah ada'));
        }else{
            if($this->tahapan_m->save($data, $data['id'], $data['id_usulan_detail'], 'INSERT') == TRUE){
                $this->db->query("call proc_tahapan($id)");
                echo json_encode(array('success'=>true));
            }else{
                echo json_encode(array('msg'=>'error'));
            }
        }
    }
    
    public function usulkan(){
        if(!isset($_POST)){
            show_404();
        }
        
        $kode = $this->input->post('kode');
        if($this->verifikasi_detail_m->createRoleVerifikasi('usulan',$kode) == true){
            $this->db->query('
                UPDATE usulan SET   
                    status = CONCAT(\''.'DIUSULKAN KE '.'\', 
                                        (SELECT jabatan 
                                        FROM transaction_role 
                                        WHERE kode = \''.$kode.'\' AND level = 1)
                                    ),
                    position = 1
                WHERE kode = \''.$kode.'\'');
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
        
    }
    
    public function verifikasi(){
        $kode = $this->input->get('kode', TRUE);
        $data['position'] = $this->db->query('SELECT position FROM usulan WHERE kode = \''.$kode.'\'')->row()->position;
        $user = $this->db->query('SELECT count(nopeg) AS cn, COALESCE(nopeg,0) AS nopeg FROM pegawai WHERE username = \''.$this->session->userdata('username').'\'')->row();
        $data['nopeg_user'] = $user->cn == 0 ? $this->session->userdata('username') : $user->nopeg;
        $data['role'] = $this->verifikasi_detail_m->getRoleVerifikasi('usulan',$kode);
        $data['detail'] = $this->usulan_detail_m->get_detail_rab($kode);
        $data['kode'] = $kode;
        $this->load->view('app/rab/verifikasi',$data);
    }
    
    public function setujui(){
        $kode = $this->input->post('kode', TRUE);
        $approved_time = date('Y-m-d H:i:s');
        $data['position'] = $this->db->query('SELECT position FROM usulan WHERE kode = \''.$kode.'\'')->row()->position;        
        $position = $data['position'];
        if($this->db->query('UPDATE usulan SET position = '.$position.'+1 WHERE kode = \''.$kode.'\'') 
                && 
           $this->db->query('
                UPDATE transaction_role SET 
                    approved_time = \''.$approved_time.'\' 
                WHERE kode = \''.$kode.'\' AND level = '.$position)
            ){
            
            echo json_encode(array('success'=>true,'msg'=>$kode));
//            redirect('app/rab/verifikasi?kode='.$kode);
//            $data['position'] = $this->db->query('SELECT position FROM usulan WHERE kode = \''.$kode.'\'')->row()->position;        
//            $user = $this->db->query('SELECT count(nopeg) AS cn, COALESCE(nopeg,0) AS nopeg FROM pegawai WHERE username = \''.$this->session->userdata('username').'\'')->row();
//            $data['nopeg_user'] = $user->cn == 0 ? $this->session->userdata('username') : $user->nopeg;
//            $data['role'] = $this->verifikasi_detail_m->getRoleVerifikasi('usulan',$kode);
//            $data['detail'] = $this->usulan_detail_m->get_detail_rab($kode);
//            $data['kode'] = $kode;
//            $this->load->view('app/rab/verifikasi',$data);
//            header('Location: get_approval.php?id_ap='.$id_ap.'&msg='.urlencode('test'));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
        
//        $data['position'] = $this->db->query('SELECT position FROM usulan WHERE kode = \''.$kode.'\'')->row()->position;        
//        $user = $this->db->query('SELECT count(nopeg) AS cn, COALESCE(nopeg,0) AS nopeg FROM pegawai WHERE username = \''.$this->session->userdata('username').'\'')->row();
//        $data['nopeg_user'] = $user->cn == 0 ? $this->session->userdata('username') : $user->nopeg;
//        $data['role'] = $this->verifikasi_detail_m->getRoleVerifikasi('usulan',$kode);
//        $data['detail'] = $this->usulan_detail_m->get_detail_rab($kode);
//        $data['kode'] = $kode;
//        $this->load->view('app/rab/verifikasi',$data);
    }
    
    public function run_import(){
        $id_periode = $this->input->post('periode');
        $file   = explode('.',$_FILES['rab']['name']);
        $length = count($file);
        if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){//jagain barangkali uploadnya selain file excel :-)
            
            $tmp = $_FILES['rab']['tmp_name'];//Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p
            
            $file_type = $_FILES['rab']['type'];
            
            $this->load->library('excel');
            
            /**  Create a new Reader of the type defined in $inputFileType  **/
            $file_type = PHPExcel_IOFactory::identify($tmp);
            $read = PHPExcel_IOFactory::createReader($file_type);
            
            /**  Advise the Reader that we only want to load cell data  **/
            $read->setReadDataOnly(true);
            $read->setLoadAllSheets();
            
            /**  Load $inputFileName to a PHPExcel Object  **/
            $excel = $read->load($tmp);
            $sheets = $read->listWorksheetNames($tmp);//baca semua sheet yang ada
            foreach($sheets as $sheet){
                if(strtoupper($sheet) == 'RAB'){//check sheet-nya itu nama table ape bukan, kalo bukan buang aja... nyampah doank :-p
                    $_sheet = $excel->setActiveSheetIndexByName($sheet);//Kunci sheetnye biar kagak lepas :-p
                    
                    $kode = $this->db->query("select fn_gen_kode_usulan() as new_kode")->row()->new_kode;
                    $data_usulan = array(
                        'kode' => $kode,
                        'nama' => $_sheet->getCell('B1')->getCalculatedValue(),
                        'lokasi' => $_sheet->getCell('B2')->getCalculatedValue(),
                        'status' => 'PEMBUATAN',
                        'id_periode' => $id_periode,
                        'created_by' => $this->session->userdata('username'),
                        'modified_by' => $this->session->userdata('username'),
                        'created_time' => date('Y-m-d H:i:s'),
                        'modified_time' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('usulan', $data_usulan); 
                    
                    $data_usulan_detail = array(
                        'versi' => 1,
                        'kode_usulan' => $kode,
                        'created_by' => $this->session->userdata('username'),
                        'modified_by' => $this->session->userdata('username'),
                        'created_time' => date('Y-m-d H:i:s'),
                        'modified_time' => date('Y-m-d H:i:s')
                    );

                    $this->db->insert('usulan_detail', $data_usulan_detail);
                    $insert_iud = $this->db->insert_id();
                    
                    $maxRow = $_sheet->getHighestRow();
                    $maxCol = $_sheet->getHighestColumn();
                    $field  = array();
                    $sql    = array();
                    $maxCol = range('A',$maxCol);
                    
                    foreach($maxCol as $key => $column)
                    {
                        $field[$key] = $_sheet->getCell($column.'3')->getCalculatedValue();//Kolom pertama sebagai field list pada table
                    }
                    for($i = 4; $i <= $maxRow; $i++)
                    {
                        foreach($maxCol as $k => $coloumn){
                            $sql[$field[$k]]  = $_sheet->getCell($coloumn.$i)->getCalculatedValue() != NULL ? $_sheet->getCell($coloumn.$i)->getCalculatedValue() : 0;
                        }
                        
                        $sql['level'] = strlen(str_replace('.', '', $sql['id']));
                        $sql['id_parent'] = strlen($sql['id']) > 1 ? substr($sql['id'], 0, -2) : 0;
                        $sql['id_usulan_detail'] = $insert_iud;
                        $sql['created_by'] = $this->session->userdata('username');
                        $sql['modified_by'] = $this->session->userdata('username');
                        $sql['created_time'] = date('Y-m-d H:i:s');
                        $sql['modified_time'] = date('Y-m-d H:i:s');
                        
                        if($sql['kode'] != NULL || $sql['kode'] != ''){
                            //check if kode not found next row
                            if($this->db->query('SELECT count(*) AS count_kode FROM vanalisaitem WHERE kode = \''.$sql['kode'].'\''.' AND id_periode = \''.$id_periode.'\'')->row()->count_kode == 0){
                                $i++;
                            }else{
                                $data_analisa_item = $this->db->query('SELECT * FROM vanalisaitem WHERE kode = \''.$sql['kode'].'\''.' AND id_periode = \''.$id_periode.'\'')->row();
                                if($data_analisa_item->tabel == 'analisa_harga'){
                                    $sql['id_analisa'] = $data_analisa_item->id;
                                }else{
                                    $sql['id_item'] = $data_analisa_item->id;
                                }
                                $sql['satuan'] = $data_analisa_item->satuan;
                                $sql['harga_pagu'] = $data_analisa_item->harga_pagu;
                                $sql['harga_oe'] = $data_analisa_item->harga_oe;
                                $this->db->insert('tahapan',$sql); //insert data...
                            }
                        }else{
                            $sql['kode'] = NULL;
                            $sql['id_analisa'] = NULL;
                            $sql['id_item'] = NULL;
                            $sql['volume'] = NULL;
                            $sql['satuan'] = NULL;
                            $sql['harga_pagu'] = NULL;
                            $sql['harga_oe'] = NULL;
                            $this->db->insert('tahapan',$sql); //insert data...
                        }
                    }
                }
            }
        }else{
            exit('do not allowed to upload');//pesan error tipe file tidak tepat
        }

        redirect('app/rab/index');
    }
}

