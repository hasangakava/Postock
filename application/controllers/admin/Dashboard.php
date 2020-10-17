<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->load->model('admin_model');
    }

    
    public function index()
    {
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['total'] = $this->admin_model->get_image_total_info();
        $data['members'] = $this->admin_model->get_latest_members();
        $data['images'] = $this->admin_model->get_latest_images();
        $data['main_content'] = $this->load->view('admin/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function edit_profile()
    {
        $id = $this->session->userdata('id');
        if ($_POST) {
            $data=array(
                'name' => $_POST['name'],
                'email' => $_POST['email']
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option($data, $id, 'admin');
            echo json_encode(array('st'=>1)); exit();
        }
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['user'] = $this->admin_model->get_by_id($id, 'admin');
        $data['main_content'] = $this->load->view('admin/edit_profile', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function change_password()
    {
        $data = array();
        $data['page_title'] = 'Dashboard';
        $data['main_content'] = $this->load->view('admin/change_password', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //change password
    public function change()
    {   
 
        if($_POST){
            
            $id = $this->session->userdata('id');
            $user = $this->common_model->select_option($id, 'admin');

            if ($user[0]['password'] == md5($_POST['old_pass'])) {
                
                if ($_POST['new_pass'] == $_POST['confirm_pass']) {
                    $data=array(
                        'password' => md5($_POST['new_pass'])
                    );
                    $this->common_model->edit_option($data, $id, 'admin');
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
                
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }

}