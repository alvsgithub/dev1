<?php
class Group extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('group_m');
    }

    public function index ()
    {
        
        // Fetch all groups
        $this->data['groups'] = $this->group_m->get_by('id != 1 AND id != 2');

        // Load view
        $this->data['subview'] = 'app/group/index';
        $this->load->view('app/_layout_main', $this->data);
    }
    
    public function edit ($id = NULL)
    {
        // Fetch a group or set a new one
        if ($id) {
            $this->data['group'] = $this->group_m->get($id);
            count($this->data['group']) || $this->data['errors'][] = 'User could not be found';
        }
        else {
            $this->data['group'] = $this->group_m->get_new();
        }

        // Set up the form
        $rules = $this->group_m->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->group_m->array_from_post(array('nama_group'));
            $this->group_m->save($data, $id);
            redirect('app/group');
        }

        // Load the view
        $this->data['subview'] = 'app/group/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->group_m->delete($id);
        redirect('app/group');
    }
    
    public function access ()
    {
        // Fetch data
        if(isset($_GET['group'])){
            echo $this->group_m->getJsonGroup();
        }
        else if(isset($_GET['menu'])){
            echo $this->menu_m->get_nested_all_menu_json();
        }else{
            $this->data['subview'] = 'app/group/access';
            $this->load->view('app/_layout_main', $this->data);
        }
    }
    
    public function privilege ()
    {
        if(!isset($_POST))	
            show_404();

        $idg = addslashes($_POST['idg']);
        $idm = $_POST['idm'];
        $ma = $_POST['ma'];
        $idp = $_POST['idp'];
        
        if (strpos($ma,$idg) == true) {
            $ma = str_replace($idg."+", "", $ma);
        }else{
            $ma .= $idg."+";
        }
        
        if($this->menu_m->privilege($idm, $ma, $idp))
            echo json_encode(array('success'=>true));
        else
            echo json_encode(array('msg'=>'Error..'));
    }
    
    public function _unique_nama_group ($str)
    {
        // Do NOT validate if email already exists
        // UNLESS it's the email for the current group

        $id = $this->uri->segment(4);
        $this->db->where('nama_group', $this->input->post('nama_group'));
        !$id || $this->db->where('id !=', $id);
        $group = $this->group_m->get();

        if (count($group)) {
            $this->form_validation->set_message('_unique_nama_group', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }
}