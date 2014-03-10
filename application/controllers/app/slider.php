<?php
class Slider extends Admin_Controller
{

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('slide_m');
    }

    public function index ()
    {
        
        // Fetch all slides
        $this->data['slider'] = $this->slide_m->get();

        // Load view
        $this->data['subview'] = 'app/slider/index';
        $this->load->view('app/_layout_main', $this->data);
    }

    public function edit ($id = NULL)
    {
        // Fetch a page or set a new one
        if ($id) {
            $this->data['slider'] = $this->slide_m->get($id);
            count($this->data['slider']) || $this->data['errors'][] = 'slider could not be found';
        }
        else {
            $this->data['images'] = $this->get_images();
            $this->data['slider'] = $this->slide_m->get_new();
        }

        // Pages for dropdown
        // $this->data['pages_no_parents'] = $this->slide_m->get_no_parents();

        // Set up the form
        // $rules = $this->slide_m->rules;
        // $this->form_validation->set_rules($rules);

        // Process the form
        // if ($this->form_validation->run() == TRUE) {
        //    $data = $this->slide_m->array_from_post(array(
        //        'caption', 
        //        'images_link', 
        //        'order'
        //    ));
        //    $this->slide_m->save($data, $id);
        //    redirect('app/slider');
        //}
		
        // Load the view
        $this->data['subview'] = 'app/slider/edit';
        $this->load->view('app/_layout_main', $this->data);
    }
}