<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {

	function __construct(){
        parent::__construct(); 
        $this->load->model('common_model');
        check_login_user();
    }

	public function index()
    {
		$data = array();
        //get users with communicated   
		$data['mgs_with'] = $this->common_model->mgs_with();
        $data['total_mgs_with']  = count($data['mgs_with']);
        if (count($data['mgs_with']) == 0) {
            $mgs_with_id = 0;
        } else {
            $mgs_with_id = $data['mgs_with']['0']['id'];
        }

        $data['page_title'] = 'Message';
		$data['mgs_with_id'] = md5($mgs_with_id);
        //get message details
        $data['message'] = $this->common_model->mgs_with_details(md5($mgs_with_id));
		$data['mgs_part'] = $this->load->view('include/mgs_load', $data, TRUE);
		$data['main_content'] = $this->load->view('my_massage',$data,TRUE);
		$this->load->view('index',$data);
	}

    //get details
	public function details($mgs_with_id)
    {
		$data = array();
		$data['page_title'] = "My Message";
		$data['mgs_with_id'] = $mgs_with_id;
        $data['message'] = $this->common_model->mgs_with_details($mgs_with_id);
        $data_load = $this->load->view('include/mgs_load', $data, TRUE);
        echo json_encode(array('st' => 1, 'data_load' => $data_load));
	}
	
	
    //send message to user
	public function send() 
    {
        
        if ($_POST) {

            $mgs_to = get_user_id_md5(strip_tags($this->input->post('mgs_to')));

            $data = array(
                'mgs_to' => $mgs_to,
                'mgs_time' => my_date_now(),
                'message' => nl2br(strip_tags($this->input->post('message'))),
                'mgs_from' => $this->session->userdata('id'),
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->insert($data, 'message');

            $notify = array(
                'user_id' => $mgs_to,
                'action_id' => strip_tags($this->session->userdata('id')),
                'text' => " sent you a message",
                'content_id' => 0,
                'noti_type' => 8,
                'noti_time' => my_date_now()
            );
            notify_this($notify);
            $image = base_url('asset/img/asset/img/avatar.png');
            
            $mgs_time = my_date_show_time(my_date_now());
            $message = nl2br(strip_tags($this->input->post('message')));
            $name = $this->session->userdata('name');
            //load message 
            $append = " 
                <div class='single_sms_part text-right fix'>
                    <div class='sms_text style_single_msg fix floatleft'>
                        <div class='sms_date_time text-right fix'>$mgs_time</div>
                        <div class='sms_description text-right fix'>
                            $message
                        </div>
                    </div>
                </div>
            ";
            echo json_encode(array('st' => 1, 'append' => $append));
        }
    }
	
	


}
