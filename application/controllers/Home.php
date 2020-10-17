<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index()
    {   
        $data = array();
        $data['page'] = 'Home';
        $data['images'] = $this->common_model->get_home_images();
        $data['total'] = $this->common_model->get_image_total_info();
        $data['main_content'] = $this->load->view('home', $data, TRUE);
        $this->load->view('index', $data);
    }

}
