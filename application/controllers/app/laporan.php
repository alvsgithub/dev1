<?php

class Laporan extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('pdf_helper');
    }

    public function index()

	{

            $cek = $this->session->userdata('logged_in');

            if(!empty($cek)){

                $d['prg'] = $this->config->item('prg');

                $d['web_prg'] = $this->config->item('web_prg');

                $d['nama_program'] = $this->config->item('nama_program');

                $d['instansi'] = $this->config->item('instansi');

                $d['usaha'] = $this->config->item('usaha');

                $d['alamat_instansi'] = $this->config->item('alamat_instansi');

                $d['kode_group'] = $this->session->userdata('kode_group');

                

                if($this->app_model->check_menu_access('cek_pal_batas_laporan') < 1){

                    redirect('home');

                }else{

                

                    //main_content

                    $d['judul'] = "Cek Pal Batas";

                    $d['data_kawasan'] = $this->kawasan_model->getKawasan();

                    $d['content'] = $this->load->view('pendataan/cek_pal_batas_laporan', $d, true);

                    $d['menu'] = $this->app_model->getMenu($d['kode_group']);

                    $d['sub_menu'] = $this->app_model->getSubMenu($d['kode_group']);

                    

                    $this->load->view('header',$d);

                    $this->load->view('left_nav',$d);

                    $this->load->view('main_content',$d);

                    $this->load->view('footer',$d);



                }

            }else{

                header('location:'.base_url());

            }

	}

        public function laporan_pdf()

        {
            
            $id_kawasan = $_REQUEST['kawasan'];
            
			$d['jabatan1'] = $_REQUEST['jabatan1'];
            $d['jabatan2'] = $_REQUEST['jabatan2'];
            $d['nama1'] = $_REQUEST['nama1'];
            $d['nama2'] = $_REQUEST['nama2'];
            $d['nip1'] = $_REQUEST['nip1'];
            $d['nip2'] = $_REQUEST['nip2'];

            $d['judul'] = "";
            $d['id_kawasan'] = $id_kawasan;
            $tgl1 = $_REQUEST['tgl1'];

            $tgl2 = $_REQUEST['tgl2'];
            
            if($id_kawasan == 'SEMUA'){
                $d['judul'] = "REKAPITULASI CEK PAL BATAS<br>".$tgl1." S/D ".$tgl2;
            }else{
                $kawasan = $this->kawasan_model->getKawasanWhere($id_kawasan);
                
                $d['judul'] = "REKAPITULASI CEK PAL BATAS<br>KAWASAN : "
                              .$kawasan->kode_fungsi_kawasan.". ".$kawasan->nama_kawasan."<br>"
                              .$tgl1." S/D ".$tgl2;
            }
            
            $d['prg'] = $this->config->item('prg');

            $d['web_prg'] = $this->config->item('web_prg');

            $d['nama_program'] = $this->config->item('nama_program');

            $d['instansi'] = $this->config->item('instansi');

            $d['usaha'] = $this->config->item('usaha');

            $d['alamat_instansi'] = $this->config->item('alamat_instansi');

            $d['data_table'] = $this->cek_pal_batas_model->getDataReportLaporan($id_kawasan, $tgl1, $tgl2);

            $this->load->view('pdfreport', $d);

        }
}