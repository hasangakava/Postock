<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->load->model('admin_model');
    }


    public function index(){
        //hide seen pending photos
        $this->admin_model->make_reports_seen();
        $this->all_reports();
    }


    //get all image reports
    public function all_reports()
    {
        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(4);

        $config['base_url'] = base_url('admin/reports/all_reports');
        //count total reports
        $total_row = $this->admin_model->get_all_reports(1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = 'Reports';
        $data['total'] = $total_row;
        $data['reports'] = $this->admin_model->get_all_reports(0, $config['per_page'], $start_row);
        
        $data['main_content'] = $this->load->view('admin/reports', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //-- delete photos
    public function delete($id)
    {
        $this->admin_model->delete($id,'report');
        echo json_encode(array('st'=>1));
    }

}