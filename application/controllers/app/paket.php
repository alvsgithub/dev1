<?php
class Paket extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('transaction/paket_m');
        $this->load->model('transaction/paket_detail_m');
        $this->load->model('transaction/usulan_m');
    }
    
    public function index ()
    {
        $this->data['options_tahun'] = $this->paket_m->get_tahun();

        if(isset($_GET['paket'])){
            echo $this->paket_m->getJson($_GET['paket']);
        }else if(isset($_GET['rincian_paket'])){
            echo $this->usulan_m->getJsonUsulanVerified($_GET['rincian_paket']);
        }else if(isset($_GET['paket_detail'])){
            echo $this->paket_detail_m->getJson($_GET['paket_detail']);
        }else{
            $this->data['subview'] = 'app/paket/index';
            $this->load->view('app/_layout_main', $this->data);
        }
    }
    
    public function create()
    {
        if(!isset($_POST)){
            show_404();
        }
        
        $data = $this->paket_m->array_from_post(array(
                    'nama',
                    'tahun',
                    'swakelola'
                ));

        $data['kode'] = $this->paket_m->get_kode();

        if($this->paket_m->save($data) == TRUE){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function update($id = null)
    {
        if(!isset($_POST)){
            show_404();
        }
        
        $data = $this->paket_m->array_from_post(array(
                    'nama',
                    'swakelola',
                    'tahun'
                ));

        if($this->paket_m->save($data, $id) == TRUE){ 
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'Data gagal dismpan!!!'));
        }
    }
    
    public function delete($id = NULL)
    {
        if(!isset($_POST))
            show_404();

        $id = addslashes($_POST['id']);
        if($this->paket_m->delete($id)){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    //END OF MASTER DETAIL

    public function checked()
    {
        if(!isset($_POST)){
            show_404();
        }
        
        $data['kode_paket'] = $this->input->post('kodep');
        $data['kode_rab'] = $this->input->post('koder');
        
            
        if($this->paket_detail_m->save($data) == TRUE){
            echo json_encode(array('success'=>true));
        }
        else{
            echo json_encode(array('msg'=>'error'));
        }
    }
    
    public function uncheck()
    {
        if(!isset($_POST)){
            show_404();
        }
        
        $id = $this->input->post('id');
        if($this->paket_detail_m->delete($id) == TRUE){
            echo json_encode(array('success'=>true));
        }
        else{
            echo json_encode(array('msg'=>'error'));
        }
    }
    
    public function createDetail($id = NULL)
    {
        if(!isset($_POST))
            show_404();

        $data = $this->analisa_harga_detail_m->array_from_post(array(
                    'id_analisa',
                    'id_item',
                    'volume'
                ));
        $data['id_analisa'] = $id;
        if($this->analisa_harga_detail_m->save($data)){
            $data_item['harga_pagu'] = $this->input->post('harga_pagu');
            if($this->item_m->save($data_item, $data['id_item'])){
                echo json_encode(array('success'=>true));
            }
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function updateDetail($id = null)
    {
        if(!isset($_POST))  
            show_404();

        $data = $this->analisa_harga_detail_m->array_from_post(array(
                    'id_item',
                    'volume'
                ));
        if($this->analisa_harga_detail_m->save($data, $id)){
            if($this->input->post('harga_pagu') != 0){
                $data_item['harga_pagu'] = $this->input->post('harga_pagu');
            }
            if($this->input->post('harga_oe') != 0){
                $data_item['harga_oe'] = $this->input->post('harga_oe');
            }
            if($this->item_m->save($data_item, $data['id_item'])){
                echo json_encode(array('success'=>true));
            }
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }
    
    public function deleteDetail ($id = null)
    {
        if(!isset($_POST))  
            show_404();

        $id = addslashes($_POST['id']);
        if($this->analisa_harga_detail_m->delete($id)){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function run_import(){
        $id_periode = $this->input->post('periode');
        $file   = explode('.',$_FILES['analisa_harga']['name']);
        $length = count($file);
        if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){//jagain barangkali uploadnya selain file excel :-)
            $tmp    = $_FILES['analisa_harga']['tmp_name'];//Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p
            $file_type    = $_FILES['analisa_harga']['type'];
            $this->load->library('excel');
            /**  Create a new Reader of the type defined in $inputFileType  **/
            $file_type  = PHPExcel_IOFactory::identify($tmp);
            $read = PHPExcel_IOFactory::createReader($file_type);
            /**  Advise the Reader that we only want to load cell data  **/
            $read->setReadDataOnly(true);
            $read->setLoadAllSheets();
            /**  Load $inputFileName to a PHPExcel Object  **/
            $excel = $read->load($tmp);
            $sheets = $read->listWorksheetNames($tmp);//baca semua sheet yang ada
            foreach($sheets as $sheet){
                if($this->db->table_exists($sheet)){//check sheet-nya itu nama table ape bukan, kalo bukan buang aja... nyampah doank :-p
                    $_sheet = $excel->setActiveSheetIndexByName($sheet);//Kunci sheetnye biar kagak lepas :-p
                    $maxRow = $_sheet->getHighestRow();
                    $maxCol = $_sheet->getHighestColumn();
                    $field  = array();
                    $sql    = array();
                    $maxCol = range('A',$maxCol);

                    foreach($maxCol as $key => $coloumn)
                    {
                        $field[$key]    = $_sheet->getCell($coloumn.'1')->getCalculatedValue();//Kolom pertama sebagai field list pada table
                    }

                    for($i = 2; $i <= $maxRow; $i++)
                    {
                        foreach($maxCol as $k => $coloumn) 
                        {
                            $sql[$field[$k]]  = $_sheet->getCell($coloumn.$i)->getCalculatedValue();
                        }

                        if ($sheet == "analisa_harga_detail")
                        {
                            $checkAnalisaHarga = array('kode' => $sql['kode_analisa'], 'id_periode' => $id_periode);

                            $analisa_harga = $this->analisa_harga_m->get_by($checkAnalisaHarga, TRUE);

                            if(count($analisa_harga) !== 0)
                            {
                                $checkItem = array('kode' => $sql['kode_item'], 'id_periode' => $id_periode);

                                $analisa_harga_item = $this->item_m->get_by($checkItem, TRUE);

                                if (count($analisa_harga_item) !== 0)
                                {
                                    $data = array(
                                        'id_analisa'    => $analisa_harga->id,
                                        'id_item'       => $analisa_harga_item->id,
                                        'no_urut'       => $sql['no_urut'],
                                        'volume'        => $sql['volume'],
                                        'created_by'    => $this->session->userdata('username'),
                                        'modified_by'   => $this->session->userdata('username'),
                                        'created_time'  => date('Y-m-d H:i:s'),
                                        'modified_time' => date('Y-m-d H:i:s')
                                    );

                                    $this->db->insert($sheet, $data);//ribet banget tinggal insert doank...
                                }
                            }
                        }

                        $sql['id_periode']      = $id_periode;
                        $sql['created_by']      = $this->session->userdata('username');
                        $sql['modified_by']     = $this->session->userdata('username');
                        $sql['created_time']    = date('Y-m-d H:i:s');
                        $sql['modified_time']   = date('Y-m-d H:i:s');

                        if ($sheet == "analisa_harga") {
                            $this->db->insert($sheet, $sql);//ribet banget tinggal insert doank...
                        }
                    }
                }
            }
        }else{
            exit('do not allowed to upload');//pesan error tipe file tidak tepat
        }

        redirect('app/analisa_harga/anggaran');
    }
}