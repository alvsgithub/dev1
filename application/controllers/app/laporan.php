<?php

class Laporan extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }

    function run_import() {
        $file_type              =   $_FILES['item']['type'];
        $file_directory         =   $_FILES['item']['tmp_name'];
        $file_name              =   str_replace(chr(32), "_", $_FILES['item']['name']);
        $file_size              =   $_FILES['item']['size'];
        $local_directory        =   './asset/files/' . $file_name;
        $upload_file            =   move_uploaded_file($file_directory, $local_directory);

        $this->load->library('excel');

        if ($file_type != "file/xls" AND $file_type != "file/xlsx" AND $file_size < 100000) {
            try{
                $inputFileType  = PHPExcel_IOFactory::identify($local_directory);
                $objReader      = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel    = $objReader->load($local_directory);
            }catch(Exception $e){
                die('Error loading file "'.pathinfo($local_directory, PATHINFO_BASENAME) . '": ' . $e->getMessage());
            }

            $sheet          = $objPHPExcel->getSheet(0);
            $highestRow     = $sheet->getHighestRow();
            $highestColumn  = $sheet->getHighestColumn();

            for ($row = 2; $row <= $highestRow; $row++) {
              
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                $data = array(
                            "kode"          => $rowData[0][0],
                            "id_periode"    => $rowData[0][1],
                            "nama"          => $rowData[0][2],
                            "jenis"         => $rowData[0][3],
                            "satuan"        => $rowData[0][4],
                            "harga_pagu"    => $rowData[0][5],
                            "harga_oe"      => $rowData[0][6]
                        );

                $this->db->insert("item", $data);
            }

            unlink($local_directory); 
        }

        redirect('app/anggaran/index/upah');
    }
}