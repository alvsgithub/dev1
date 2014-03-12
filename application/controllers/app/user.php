<?php
class User extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('group_m');
    }

    public function index ()
    {
        $this->data['datatables'] = TRUE;
        // Fetch all users
        $this->data['users'] = $this->user_m-> // get_by('id != 1');
            get_ljoin(NULL, FALSE, 'users_group', 'id_group', 'id', 'users.*, b.nama_group', 'users.id != 1');

        // Load view
        $this->data['subview'] = 'app/user/index';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        if($this->session->userdata('id_group') == 1 || $this->session->userdata('id_group') == 2)
            $this->data['options_group'] = $this->group_m->get_combobox(NULL, FALSE, 'id', 'nama_group', 'id != 1', FALSE);
        else
            $this->data['options_group'] = $this->group_m->get_combobox(NULL, FALSE, 'id', 'nama_group', 'id != 1 AND id != 2', FALSE);
            
        // Fetch a user or set a new one
        if ($id) {
            $this->data['user'] = $this->user_m->get($id);
            count($this->data['user']) || $this->data['errors'][] = 'User could not be found';
        }
        else {
            $this->data['user'] = $this->user_m->get_new();
        }

        // Set up the form
        $rules = $this->user_m->rules_app;
        $id || $rules['password']['rules'] .= '|required';
        $this->form_validation->set_rules($rules);

        // Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->user_m->
                    array_from_post(
                        array(
                            'username', 
                            'email', 
                            'password',
                            'id_group'
                        ));
            $data['password'] = $this->user_m->hash($data['password']);
            $this->user_m->save($data, $id);
            redirect('app/user');
        }

        // Load the view
        $this->data['subview'] = 'app/user/edit';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function delete ($id)
    {
        $this->user_m->delete($id);
        redirect('app/user');
    }

    public function login ()
    {
        // Redirect a user if he's already logged in
        $dashboard = 'app/dashboard';
        $this->user_m->loggedin() == FALSE || redirect($dashboard);

        // Set form
        $rules = $this->user_m->rules;
        $this->form_validation->set_rules($rules);

        // Process form
        if ($this->form_validation->run() == TRUE) {
            // We can login and redirect
            if ($this->user_m->login() == TRUE) {
                redirect($dashboard);
            }
            else {
                $this->session->set_flashdata('error', 'That username/password combination does not exist');
                redirect('app/user/login', 'refresh');
            }
        }

        // Load view
        $this->data['subview'] = 'app/user/login';
        $this->load->view('app/_layout_modal', $this->data);
    }

    public function logout ()
    {
        $this->user_m->logout();
        redirect('app/user/login');
    }

    public function _unique_username ()
    {
        // Do NOT validate if email already exists
        // UNLESS it's the username for the current user

        $id = $this->uri->segment(4);
        $this->db->where('username', $this->input->post('username'));
        !$id || $this->db->where('id !=', $id);
        $user = $this->user_m->get();

        if (count($user)) {
            $this->form_validation->set_message('_unique_username', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }
    
    public function _unique_email ()
    {
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $user = $this->user_m->get();

        if (count($user)) {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }
}