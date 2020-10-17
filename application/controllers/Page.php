<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
    }

    // show page details
    public function details($slug)
    {
        $data = array();
        $data['page'] = 'Page';
        $data['page'] = $this->common_model->get_single_page($slug);
        $data['main_content'] = $this->load->view('page', $data, TRUE);
        $this->load->view('index', $data);
    }


}
