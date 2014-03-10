<?php
class Slide_m extends MY_Model
{
    protected $_table_name = 'slider';
    protected $_order_by = 'id,order';
    public $rules = array(
        'images_link' => array(
            'field' => 'images_link', 
            'label' => 'Images', 
            'rules' => 'trim|required|xss_clean'
        ), 
        'caption' => array(
            'field' => 'caption', 
            'label' => 'Caption', 
            'rules' => 'trim|required|xss_clean'
        ), 
        'order' => array(
            'field' => 'order', 
            'label' => 'order', 
            'rules' => 'trim|required|xss_clean'
        )
    );

    public function get_new ()
    {
        $slider = new stdClass();
        $slider->images_link = '';
        $slider->caption = '';
        $slider->order = '';
        return $slider;
    }
	
}