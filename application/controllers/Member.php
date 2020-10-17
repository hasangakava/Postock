<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
    }


    public function index()
    {
        $this->all_members();
    }

    //get all members
    public function all_members()
    {   
        //get search and sort value
        $q = trim($this->input->get('search'));
        if(isset($_GET['sort'])){
            $sort = trim($this->input->get('sort'));
        }else{
            $sort = '';
        }

        $data = array();
        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(3);  

        //make pagination url for search & sord data
        $config['enable_query_strings']=TRUE;
        $getData = array('search' => $q, 'sort' => $sort);

        $config['base_url'] = base_url('member/all_members');

        $config['suffix'] = '?'.http_build_query($getData,'',"&amp;");
        $config['first_url'] = $config['base_url'].'?search='.$q;

        //count all members
        $total_row = $this->common_model->get_all_members(1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = "Member";
        $data['total'] = $total_row;
        $data['countries'] = $this->common_model->select('country');
        $data['members'] = $this->common_model->get_all_members(0, $config['per_page'], $start_row);
        $data['main_content'] = $this->load->view('member_list', $data, TRUE);
        $this->load->view('index', $data);
    }

    //get all collections
    public function collections()
    {
        $data = array();
        $data['page_title'] = 'Collections';
        $data['main_content'] = $this->load->view('user/collections', $data, TRUE);
        $this->load->view('index', $data);
    }


    public function account()
    {
        $data = array();
        $data['page_title'] = 'Account';
        $data['main_content'] = $this->load->view('user/account', $data, TRUE);
        $this->load->view('index', $data);
    }

    //follow user
    public function follow($id)
    {   
        $data = array(
            'follower_id' => $id,
            'action_id' => $this->session->userdata('id'),
            'status' => 1,
            'created_at' => my_date_now()
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->insert($data, 'follower');

        //-- insert notification
        $notify = array(
            'user_id' => $id,
            'action_id' => $this->session->userdata('id'),
            'content_id' => $this->session->userdata('id'),
            'text' => " follow you",
            'noti_type' => 3,
            'noti_time' => my_date_now()
        );
        $notify = $this->security->xss_clean($notify);
        
        if($this->session->userdata('id') != $id):
            notify_this($notify);
        endif;

        echo json_encode(array('st' => 1));
    }


    //unfollow user
    public function unfollow($id){
        $this->common_model->remove_follower($id, 'follower');
        echo json_encode(array('st' => 1));
    }

}
