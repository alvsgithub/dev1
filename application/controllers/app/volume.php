<?php

class Volume extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/volume_m');
    }

    public function index ()
    {
        if(isset($_GET['volume']) == true){
            echo $this->volume_m->getJson();
        }
        else{
            $this->data['subview'] = 'app/master/volume'; // Load view
            $this->load->view('app/_layout_main', $this->data);
        }
    }
    
    public function create()
    {
        if(!isset($_POST)) { 
            show_404();
        }

        // Set up the form
        $rules = $this->volume_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE){
            $data = $this->volume_m->array_from_post(array(
                        'kode',
                        'rumus',
                        'kelompok'
                    ));
            $this->data['rules'] = $rules;
            if($this->volume_m->save($data) == TRUE){
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
        $rules = $this->volume_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE){
            $data = $this->volume_m->array_from_post(array(
                        'kode',
                        'rumus',
                        'kelompok'
                    ));
            $this->data['rules'] = $rules;
            if($this->volume_m->update($data, $id) == TRUE){ 
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
        if($this->volume_m->delete($id) == true){
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function run_import(){
        $file   = explode('.',$_FILES['volume']['name']);
        $length = count($file);
        if($file[$length -1] == 'xlsx' || $file[$length -1] == 'xls'){//jagain barangkali uploadnya selain file excel :-)
            $tmp    = $_FILES['volume']['tmp_name'];//Baca dari tmp folder jadi file ga perlu jadi sampah di server :-p
            $file_type    = $_FILES['volume']['type'];
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
                            $sql[$field[$k]]  = $_sheet->getCell($coloumn.$i)->getCalculatedValue();    
                        }
                        
                        $sql['created_by'] = $this->session->userdata('username');
                        $sql['created_time'] = date('Y-m-d H:i:s');
                        $this->db->insert($sheet,$sql); //insert data...
                    }
                }
            }
        }else{
            exit('do not allowed to upload');//pesan error tipe file tidak tepat
        }
        redirect('app/volume');
    }
}


?>