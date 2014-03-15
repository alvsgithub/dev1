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
        $this->data['datatables'] = TRUE;
        $this->data['options_periode'] = $this->periode_m->get();
        $this->data['item'] = $this->item_m->get_item_by($jenis); // Fetch all provinsi with limit offset
        $this->data['jenis'] = $jenis;
        $this->data['subview'] = 'app/master/anggaran/index'; // Load view
//        dump($this->data['pagination']);
        $this->load->view('app/_layout_main', $this->data);
    }
    
    public function edit ($param = NULL)
    {
        list($jenis, $id) = explode('-', $param);
        if ($id != 'new') {
            $this->data['item'] = $this->item_m->get($id);
            $this->data['options_periode'] = $this->periode_m->get();
//            dump($this->data['item']);
            count($this->data['item']) || $this->data['errors'][] = 'item could not be found';
        }
        else {
            $this->data['options_periode'] = $this->periode_m->get();
            $this->data['item'] = $this->item_m->get_new($jenis);
        }
        
        // Set up the form
        $rules = $this->item_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->item_m->array_from_post(array(
                        'id_periode',
                        'kode',
                        'nama',
                        'satuan',
                        'jenis',
                        'harga_pagu'
                    ));
            if($id=='new'){ $id = NULL; }
            $this->item_m->save($data, $id);
            redirect('app/anggaran/index/'.$jenis);
        }
        
        // Load the view
        $this->data['rules'] = $rules;
//        dump($this->data['rules']);
        $this->data['subview'] = 'app/master/anggaran/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($param)
    {
        list($jenis, $id) = explode('-', $param);
        $this->item_m->delete($id);
        redirect('app/anggaran/index/'.$jenis);
    }

	public function run_import(){
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
                        $field[$key]    = $_sheet->getCell($coloumn.'1')->getCalculatedValue();//Kolom pertama sebagai field list pada table
                    }
                    for($i = 2; $i <= $maxRow; $i++){
                        foreach($maxCol as $k => $coloumn){
                            $sql[$field[$k]]  = $_sheet->getCell($coloumn.$i)->getCalculatedValue();
                        }
                        $this->db->insert($sheet,$sql);//ribet banget tinggal insert doank...
                    }
                }
            }
        }else{
            exit('do not allowed to upload');//pesan error tipe file tidak tepat
        }
        redirect('app/anggaran/index/upah');
    }
}


?>
