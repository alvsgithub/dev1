<?php

class Anggaran extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('master/item_m');
    }

    public function index ($jenis = NULL)
    {
        
        $this->data['options_periode'] = $this->periode_m->get();
        $this->data['jenis'] = $jenis;
        $this->data['tipe'] = 'Anggaran';
        
        if(isset($_GET['item']) && isset($_GET['periode']) && !isset($_GET['trans'])){
            echo $this->item_m->getJson($_GET['periode'],$_GET['item']);
        }
        else{
            $this->data['subview'] = 'app/master/anggaran'; // Load view
            $this->load->view('app/_layout_main', $this->data);
        }
    }
    
    public function create()
    {
        if(!isset($_POST)) { 
            show_404();
        }

        // Set up the form
        $rules = $this->item_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE){
            $data = $this->item_m->array_from_post(array(
                        'id_periode',
                        'jenis',
                        'kode',
                        'nama',
                        'satuan',
                        'harga_pagu'
                    ));
            $this->data['rules'] = $rules;
            if($this->item_m->save($data) == TRUE){
                echo json_encode(array('success'=>true));
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
        $rules = $this->item_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE){
            $data = $this->item_m->array_from_post(array(
                        'id_periode',
                        'jenis',
                        'kode',
                        'nama',
                        'satuan',
                        'harga_pagu'
                    ));
            $this->data['rules'] = $rules;
            if($this->item_m->update($data, $id) == TRUE){ 
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
        if(!isset($_POST)){
            show_404();
        }
        
        $id = addslashes($this->input->post('id'));
        if($this->item_m->delete($id) == true){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function run_import(){
        $id_periode = $this->input->post('periode');
        $jenis = $this->input->post('jenis');
        $file   = explode('.',$_FILES['item']['name']);
        $length = count($file);
        if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){//jagain barangkali uploadnya selain file excel :-)
            $tmp    = $_FILES['item']['tmp_name'];//Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p
            $file_type    = $_FILES['item']['type'];
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
                    foreach($maxCol as $key => $coloumn){
                        $field[$key] = $_sheet->getCell($coloumn.'1')->getCalculatedValue();//Kolom pertama sebagai field list pada table
                    }
                    for($i = 2; $i <= $maxRow; $i++){
                        foreach($maxCol as $k => $coloumn){
                            $sql[$field[$k]]  = $_sheet->getCell($coloumn.$i)->getCalculatedValue() != NULL ? $_sheet->getCell($coloumn.$i)->getCalculatedValue() : 0;
                            
                        }
                        $sql['id_periode'] = $id_periode;
                        $sql['jenis'] = $jenis;
                        $sql['created_by'] = $this->session->userdata('username');
                        $sql['modified_by'] = $this->session->userdata('username');
                        $sql['created_time'] = date('Y-m-d H:i:s');
                        $sql['modified_time'] = date('Y-m-d H:i:s');
                        
                        
                        //check if kode already exists, next row
                        if($this->db->query('SELECT count(*) AS count_kode FROM item WHERE kode = \''.$sql['kode'].'\''.' AND id_periode = \''.$sql['id_periode'].'\'')->row()->count_kode > 0){
                            $i++;
                        }else{
                            $this->db->insert($sheet,$sql); //insert data...
                        }
                    }
                }
            }
        }else{
            exit('do not allowed to upload');//pesan error tipe file tidak tepat
        }
        redirect('app/anggaran/index/'.$jenis);
    }
    
    public function _unique_per_periode ()
    {
        // Do NOT validate if kode in this periode already exists
        $id = $this->uri->segment(4);
        $kode = $this->input->post('kode');
        $id_periode = $this->input->post('id_periode');
        $this->db->where(
                array(
                    'kode'=>$kode,
                    'id_periode'=>$id_periode
                )
            );
        ! $id || $this->db->where('id !=', $id);
        $item = $this->item_m->get();

        if (count($item)) {
            $this->form_validation->set_message('_unique_per_periode', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }
}


?>