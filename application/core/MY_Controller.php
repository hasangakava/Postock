<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        $global_data['settings'] = $this->common_model->get('settings');
        $this->settings = $global_data['settings'];
        $this->load->vars($global_data);
    }

}