<?php 
class Laporan extends Admin_Controller{
    
    public function __construct(){
        parent::__construct();
        $this->load->model('master/penangkar_m');
        $this->load->model('master/pengedar_m');
        $this->load->model('transaksi/rencana_m');
        $this->load->model('transaksi/rencana_detail_m');
        $this->load->model('transaksi/realisasi_m');
    }
    
    // public function index() {
            	
    	// $this->data['subview'] = 'app/laporan/index';
    	// $this->load->view('app/_layout_main', $this->data);
    // }
    
    public function unit_penangkar() {
        if(isset($_GET['penangkar'])){
            echo $this->penangkar_m->getJsonOptPenangkar();
        }else{
            $this->data['subview'] = 'app/laporan/unit_penangkar';
            $this->load->view('app/_layout_main', $this->data);
        }
    }
       
    public function peredaran_tsl() {
        if(isset($_GET['pengedar'])){
            echo $this->pengedar_m->getJsonOptPengedar();
        }else{
            $this->data['options_years'] = $this->rencana_m->get_year();
            $this->data['subview'] = 'app/laporan/peredaran_tsl';
            $this->load->view('app/_layout_main', $this->data);
        }
    }
    
    public function pdf_penangkar()
    {
        $id = $_REQUEST['id'];
        $this->load->helper('dompdf');
        $data['site_url'] = site_url();
        $data['penangkar'] = $this->penangkar_m->getReportPenangkar($id);
        $data['komoditi'] = $this->penangkar_m->getReportDetailKomoditi($id);
        $data['tsl'] = $this->penangkar_m->getReportDetailTsl($id);
        $html = $this->load->view('app/laporan/report_penangkar', $data, true);  
        pdf_create($html,'Penangkar', true, 'landscape'); 
    }
    
    function xls_penangkar()
    {
        $id = $_REQUEST['id'];
        $this->load->library('excel');
        $sheet = new PHPExcel();
        
        $sheet->getProperties()->setTitle('Attendance Report')->setDescription('Attendance Report');
        $sheet->setActiveSheetIndex(0);
        
        $attendance_data = $this->penangkar_m->get_report_audit_qty('AND a.id_penangkar = '.$id);
        
        $col = 0;
        foreach ($attendance_data[0] as $field=>$value) {
            $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
//        
        $row = 2;
        foreach ($attendance_data as $data) {
            $col = 0;
            foreach ($data as $field_val) {
                    $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field_val);
                    $col++;
            }
            $row++;
        }
//        
        $sheet_writer = PHPExcel_IOFactory::createWriter($sheet, 'Excel5');
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Penangkar_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');

        $sheet_writer->save('php://output');
        
    }
    
    public function pdf_pengedar()
    {
        $id = $_REQUEST['id'];
        $year = $_REQUEST['tahun'];
        $this->load->helper('dompdf');
        $data['site_url'] = site_url();
        $data['pengedar'] = $this->realisasi_m->getReportRekap($year, $id);
        $data['rencana_detail'] = $this->rencana_detail_m->getReportRencanaDetail($year,$id);
        $data['realisasi'] = $this->realisasi_m->getReportRealisasiDetail($year,$id);

        $html = $this->load->view('app/laporan/report_pengedar', $data, true);  
        pdf_create($html,'Pengedar', true, 'landscape'); 
    }
    
    function xls_pengedar()
    {
        $id = $_REQUEST['id'];
		$year = $_REQUEST['tahun'];
        $this->load->library('excel');
        $sheet = new PHPExcel();
        
        $sheet->getProperties()->setTitle('Attendance Report')->setDescription('Attendance Report');
        $sheet->setActiveSheetIndex(0);
        
        $data_pengedar = $this->pengedar_m->get_report_peredaran($id);
        
		$sheet->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'Nama Perusahaan');
		$sheet->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'Alamat');
		$sheet->getActiveSheet()->setCellValueByColumnAndRow(0, 3, 'SK Perijinan');
		$sheet->getActiveSheet()->setCellValueByColumnAndRow(0, 4, 'Awal Berlaku');
		$sheet->getActiveSheet()->setCellValueByColumnAndRow(0, 5, 'Akhir Berlaku');
		
		$row = 1;
		foreach($data_pengedar[0] as $field => $value){
			$sheet->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $value);
			$row++;
		}
		
		$data_rencana_pengedar = $this->rencana_detail_m->getReportRencanaDetail($year,$id);
        $sheet->getActiveSheet()->setCellValueByColumnAndRow(0, 7, 'Rencana');
		$col = 0;
        foreach ($data_rencana_pengedar[0] as $field=>$value) {
            $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, 8, $field);
            $col++;
        }
		
        $row = 9;
        foreach ($data_rencana_pengedar as $data) {
            $col = 0;
            foreach ($data as $field_val) {
                    $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field_val);
                    $col++;
            }
            $row++;
        }
//      
		$row = $row+1;
		$sheet->getActiveSheet()->setCellValueByColumnAndRow(0, $row, 'Realisasi');
		$row = $row+1;
		$data_realisasi_pengedar = $this->realisasi_m->getReportRealisasiDetail($year,$id);
        $col = 0;
        foreach ($data_realisasi_pengedar[0] as $field=>$value) {
            $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field);
            $col++;
        }
        $row = $row+1;
        foreach ($data_realisasi_pengedar as $data) {
            $col = 0;
            foreach ($data as $field_val) {
                    $sheet->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $field_val);
                    $col++;
            }
            $row++;
        }
		
        $sheet_writer = PHPExcel_IOFactory::createWriter($sheet, 'Excel5');
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Penangkar_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');

        $sheet_writer->save('php://output');
        
    }
}
?>