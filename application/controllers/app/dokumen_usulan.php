<?php
class Dokumen_usulan extends Admin_Controller
{
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('transaction/dokumen_usulan_m');
    }
    
    public function index ()
    {
        if (isset($_GET['id_usulan_detail']))
        {
            echo $this->dokumen_usulan_m->getJson('id_usulan_detail = ' . $_GET['id_usulan_detail']);
        }
        else
        {
            $this->data['subview'] = 'app/paket/index';
            $this->load->view('app/_layout_main', $this->data);
        }
    }
    
    public function create()
    {
        if(!isset($_POST))
            show_404();

        $name = $_FILES["file"]["name"];
        $type = $_FILES["file"]["type"];
        $size = $_FILES["file"]["size"];
        $temp_name = $_FILES["file"]["tmp_name"];

        $allowedMimeTypes = array(
                            'application/application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/msword',
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 
                            'application/vnd.ms-powerpoint',
                            'application/pdf',
                            'image/gif',
                            'image/jpeg',
                            'image/png'
        );

        if (in_array($type, $allowedMimeTypes))
        {
            move_uploaded_file($temp_name, 'asset/file/' . $name);

            $data = $this->dokumen_usulan_m->array_from_post(array(
                        'id_usulan_detail',
                        'keterangan'
                    ));

            $data['link'] = $name;

            if($this->dokumen_usulan_m->save($data) == TRUE)
            {
                echo json_encode(array('success'=>true));
            }else
            {
                echo json_encode(array('msg'=>'error'));
            }
        }
        else{
            echo json_encode(array('msg'=>'error'));
        }
    }

    public function update($id = null)
    {
        if(!isset($_POST))
            show_404();

        $name = $_FILES["file"]["name"];
        $type = $_FILES["file"]["type"];
        $size = $_FILES["file"]["size"];
        $temp_name = $_FILES["file"]["tmp_name"];

        $allowedMimeTypes = array(
                            'application/application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/msword',
                            'application/vnd.ms-excel',
                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 
                            'application/vnd.ms-powerpoint',
                            'application/pdf',
                            'image/gif',
                            'image/jpeg',
                            'image/png'
        );

        if (!empty($name))
        {
            if (in_array($type, $allowedMimeTypes))
            {
                $checkOldFile = array('id' => $id);

                $old_file = $this->dokumen_usulan_m->get_by($checkOldFile, TRUE);

                unlink('asset/file/' . $old_file->link);

                move_uploaded_file($temp_name, 'asset/file/' . $name);

                $data = $this->dokumen_usulan_m->array_from_post(array(
                            'id_usulan_detail',
                            'keterangan'
                        ));

                $data['link'] = $name;

                if($this->dokumen_usulan_m->update($data, $id) == TRUE)
                {
                    echo json_encode(array('success'=>true));
                }else
                {
                    echo json_encode(array('msg'=>'error'));
                }
            }
            else{
                echo json_encode(array('msg'=>'error'));
            }
        }
        else{
            $data = $this->dokumen_usulan_m->array_from_post(array(
                        'keterangan'
                    ));

            if($this->dokumen_usulan_m->update($data, $id) == TRUE)
            {
                echo json_encode(array('success'=>true));
            }else
            {
                echo json_encode(array('msg'=>'error'));
            }                
        }
    }
    
    public function delete($id = NULL)
    {
        if(!isset($_POST))
            show_404();

        $id = addslashes($_POST['id']);

        $checkOldFile = array('id' => $id);

        $old_file = $this->dokumen_usulan_m->get_by($checkOldFile, TRUE);

        unlink('asset/file/' . $old_file->link);

        if($this->dokumen_usulan_m->delete($id))
        {
            echo json_encode(array('success'=>true));
        }
        else{
            echo json_encode(array('msg'=>'error'));
        }
    }
}

