<?php
class Analisa_harga extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('master/periode_m');
        $this->load->model('master/item_m');
        $this->load->model('master/analisa_harga_m');
        $this->load->model('master/analisa_harga_detail_m');
    }
    
    public function anggaran ()
    {
        $this->data['jenis'] = 'Anggaran';
        $this->data['options_periode'] = $this->periode_m->get();

		if(isset($_GET['analisa_harga'])){
			echo $this->analisa_harga_m->getJson('AND a.id_periode = '.$_GET['analisa_harga']);
		}else if(isset($_GET['analisa_harga_detail'])){
			echo $this->analisa_harga_detail_m->getJson('AND a.id_analisa = '.$_GET['analisa_harga_detail']);
		}else if(isset($_GET['item'])){
			echo $this->item_m->getJsonOpt();
		}else{		
			$this->data['subview'] = 'app/master/analisa_harga/index';
			$this->load->view('app/_layout_main', $this->data);
		}
        
    }
    
    public function aktual ()
    {
        $this->data['jenis'] = 'Aktual';
        $this->data['options_periode'] = $this->periode_m->get();
		
		if(isset($_GET['analisa_harga'])){
			echo $this->analisa_harga_m->getJson('AND a.id_periode = '.$_GET['analisa_harga']);
		}else if(isset($_GET['analisa_harga_detail'])){
			echo $this->analisa_harga_detail_m->getJson('AND a.id_analisa = '.$_GET['analisa_harga_detail']);
		}else if(isset($_GET['item'])){
			echo $this->item_m->getJsonOpt();
		}else{		
			$this->data['subview'] = 'app/master/analisa_harga/index';
			$this->load->view('app/_layout_main', $this->data);
		}
    }
    
    public function create()
    {
        if(!isset($_POST))	
            show_404();
			
        $data = $this->analisa_harga_m->array_from_post(array(
                    'kode',
                    'nama',
                    'satuan'
                ));
		$data['id_periode'] = $_GET['id_periode'];
		if($this->analisa_harga_m->save($data)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'error'));
		}
    }
	
	public function update($id = null)
    {
        if(!isset($_POST))
            show_404();

        $data = $this->analisa_harga_m->array_from_post(array(
                    'kode',
                    'nama',
                    'satuan'
                ));

        if($this->analisa_harga_m->save($data)){ 
            echo json_encode(array('success'=>true));
        }else{
            echo json_encode(array('msg'=>'Data gagal dismpan!!!'));
        }

		if($this->analisa_harga_m->save2($data)){
			if($this->analisa_harga_m->save($data, $id)){
				echo json_encode(array('success'=>true));
			}else{
				echo json_encode(array('msg'=>'error'));
			}
		}
    }
    
    public function delete($id = NULL)
    {
		if(!isset($_POST))
			show_404();
				
		$id = addslashes($_POST['id']);
        if($this->analisa_harga_m->delete($id)){
			echo json_encode(array('success'=>true));
		}else{
			echo json_encode(array('msg'=>'error'));
		}
    }
	
	//END OF MASTER DETAIL
	
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