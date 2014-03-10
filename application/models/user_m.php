<?php
class User_M extends MY_Model
{
    protected $_table_name = 'users';
    protected $_order_by = 'username';
    public $rules = array(
            'username' => array(
                'field' => 'username', 
                'label' => 'Username', 
                'rules' => 'trim|required|xss_clean'
            ), 
            'password' => array(
                'field' => 'password', 
                'label' => 'Password', 
                'rules' => 'trim|required'
            )
    );
    public $rules_app = array(
            'username' => array(
                    'field' => 'username', 
                    'label' => 'Username', 
                    'rules' => 'trim|required|xss_clean|maxlenght[45]|callback__unique_username'
            ), 
            'email' => array(
                    'field' => 'email', 
                    'label' => 'Email', 
                    'rules' => 'trim|required|valid_email|callback__unique_email|xss_clean'
            ), 
            'password' => array(
                    'field' => 'password', 
                    'label' => 'Password', 
                    'rules' => 'trim|matches[password_confirm]'
            ),
            'password_confirm' => array(
                    'field' => 'password_confirm', 
                    'label' => 'Confirm password', 
                    'rules' => 'trim|matches[password]'
            ),
            'id_group' => array(
                    'field' => 'id_group', 
                    'label' => 'Group', 
                    'rules' => 'trim|required|xss_clean'
            ),
    );

    function __construct ()
    {
        parent::__construct();
    }

    public function login ()
    {
        $user = $this->get_by(array(
                'username' => $this->input->post('username'),
                'password' => $this->hash($this->input->post('password')),
        ), TRUE);

        if (count($user)) {
            // Log in user
            $data = array(
                'username' => $user->username,
                'email' => $user->email,
                'id' => $user->id,
                'id_group' => $user->id_group,
                'loggedin' => TRUE,
            );
            $this->session->set_userdata($data);
        }
    }

    public function logout ()
    {
        $this->session->sess_destroy();
    }

    public function loggedin ()
    {
        return (bool) $this->session->userdata('loggedin');
    }

    public function get_new(){
        $user = new stdClass();
        $user->username = '';
        $user->email = '';
        $user->password = '';
        $user->id_group = '';
        return $user;
    }

    public function hash ($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }
}