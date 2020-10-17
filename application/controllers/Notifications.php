<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*  Notification List

1.  Signup Notification
2.  Approve / featured/ reject / image from admin
3.  Follow user
4.  Like image 
5.  Comments image //
6.  Download image 
7.  Collect image
8.  Message

*/


class Notifications extends MY_Controller {

	function __construct(){
        parent::__construct(); 
        $this->load->model('common_model');
    }

    //load notification
	public function my() {
        $data = array();
        $data['notification'] = $this->common_model->my_notifications();
        //make unseen to seen
        $this->common_model->my_notifications_make_seen();
        $noti = $this->load->view('include/header_notifications_load',$data,TRUE);
        echo json_encode(array('st'=>1, 'noti' => $noti));
        
    }
	
    //get all notification
	public function all(){
		$data = array();

        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(3);  

        $config['base_url'] = base_url('notifications/all');
        $total_row = $this->common_model->get_all_notofication(1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

		$data['page_title'] = "All_notification";
		$data['total'] = $total_row;
		$data['notification'] = $this->common_model->get_all_notofication(0, $config['per_page'], $start_row);
		$data['main_content'] = $this->load->view('all_notification',$data,TRUE);
		$this->load->view('index',$data);
	}


}
