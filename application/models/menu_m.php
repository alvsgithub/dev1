<?php
class Menu_M extends MY_Model
{
    protected $_table_name = 'menu';
    protected $_order_by = 'id_parent, id_menu';
    public $rules = array(
        'nama_menu' => array(
            'field' => 'nama_menu', 
            'label' => 'Nama Menu', 
            'rules' => 'trim|required|valid_email|xss_clean'
        ), 
        'link' => array(
            'field' => 'link', 
            'label' => 'Link', 
            'rules' => 'trim|required'
        )
    );
    public $rules_admin = array(
        'nama_menu' => array(
            'field' => 'nama_menu', 
            'label' => 'Nama Menu', 
            'rules' => 'trim|required|valid_email|xss_clean'
        ), 
        'link' => array(
            'field' => 'link', 
            'label' => 'Link', 
            'rules' => 'trim|required'
        )
    );

    public function get_new(){
        $menu = new stdClass();
        $menu->id_menu = '';
        $menu->nama_menu = '';
        $menu->link = '';
        return $menu;
    }

    public function get_menu_for_group($id_group, $level)
    {
        $result = $this->get_by("menu_allowed like '%+$id_group+%' AND level = $level", FALSE);
        return $result;
    }
    
    public function get_nested_admin_menu ()
    {    
        $id_group = $this->session->userdata('id_group');
        $this->db->order_by($this->_order_by);
        $menus = $this->db->where('menu_allowed like '.'\'%+'.$id_group.'+%\'')->get('menu')->result_array();

        $array = array();
        foreach ($menus as $menu) {
            if (!$menu['id_parent']) {
                // This page has no parent
                $array[$menu['id_menu']] = $menu;
            }
            else {
                // This is a child page
                $array[$menu['id_parent']]['children'][] = $menu;
            }
        }//dump($array);
        return $array;
    }
    
    public function get_nested_all_menu_json ()
    {    
        
        $this->db->select('id_menu, nama_menu, id_parent, level, menu_allowed');
        $this->db->order_by($this->_order_by);
        $menus = $this->db->get($this->_table_name)->result_array();

        $array = array();
        foreach ($menus as $menu) {
            if(!$menu['id_parent']){
                $array[$menu['id_menu']] = $menu;
            }else{
                $array[$menu['id_parent']]['children'][] = $menu;
            }
        }
        
        $arr_menu = array();
        foreach ($array as $arr){
            $arr_menu[] = $arr; 
        }
//        dump($arr_menu);
        return json_encode($arr_menu);
//        return $arr_menu;
    }
    
    public function get_allowed_link ()
    {    
        $id_group = $this->session->userdata('id_group');
        $this->db->order_by($this->_order_by);
        $menus = $this->db->where('menu_allowed like '.'\'%+'.$id_group.'+%\' AND link IS NOT NULL')->get('menu')->result_array();

        $array = array(
            '0' => 'app/dashboard'
        );
        foreach ($menus as $menu) {
            $array[] = $menu['link'];
        }//dump($array);
        return $array;
    }
    
    public function get_curr_id_menu ()
    {
        $this->db->order_by($this->_order_by);
        $menus = $this->db->where('link like '.'\'%'.$this->uri->segment(2).'%\'')->get('menu')->result_array();

        $array = array();
        foreach ($menus as $menu) {
            $array[] = $menu['id_menu'];
        }//dump($array);
        return $array;
    }
    
    public function privilege ($idm, $ma, $idp){
        $where = "";
        if($idp == 0) $where = "id_menu = $idm OR id_parent = $idm";
        else $where = "id_menu = $idm OR id_menu = $idp";
        $this->db->where($where);        
        return $this->db->update(
                $this->_table_name, 
                    array(
                        'menu_allowed' => $ma
                    )); 
    }
}