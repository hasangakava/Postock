<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->load->model('admin_model');
        $this->load->model('login_model');
    }


    public function index(){
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
        if(isset($_GET['country'])){
            $country = trim($this->input->get('country'));
        }else{
            $country = '';
        }


        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(4);  

        //make pagination url for search & sord data
        $config['enable_query_strings']=TRUE;
        $getData = array('search' => $q, 'sort' => $sort, 'country' => $country);

        $config['base_url'] = base_url('admin/members/all_members');
        $config['suffix'] = '?'.http_build_query($getData,'',"&amp;");
        $config['first_url'] = $config['base_url'].'?search='.$q;

        //count all members
        $total_row = $this->admin_model->get_all_members(1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = 'Photos';
        $data['total'] = $total_row;

        //get all members
        $data['members'] = $this->admin_model->get_all_members(0, $config['per_page'], $start_row);
        $data['countries'] = $this->common_model->select('country');
        $data['main_content'] = $this->load->view('admin/members', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function add() {
        
        if ($_POST) {
            
            $mail =  strtolower(trim($_POST["email"]));
            $email = $this->login_model->check_email($mail);
 
            // if email already exist
            if ($email){
                echo json_encode(array('st'=>2));
            } else {
                
                $data = array();
                $data=array(
                    'first_name' => $_POST['first_name'],
                    'email' => $_POST['email'],
                    'password' => md5($_POST['password']),
                    'status' => $_POST['status'],
                    'created_at' => my_date_now()
                );

                $data = $this->security->xss_clean($data);
                $this->common_model->insert($data, 'user');
                $url = base_url('admin/members');
                echo json_encode(array('st'=>1, 'url' => $url));
                exit();
            }
        }

        $data = array();
        $data['main_content'] = $this->load->view('admin/add_members', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



    public function active($id) {
        $data = array(
            'status' => 1
        );
        $this->admin_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'Member activate Successfully'); 
        redirect(base_url('admin/members'));
    }

    public function deactive($id) {
        $data = array(
            'status' => 2
        );
        $this->admin_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'Member deactivate Successfully'); 
        redirect(base_url('admin/members'));
    }

    public function verified($id) {
        $data = array(
            'is_verified' => 1
        );
        $this->admin_model->update($data, $id,'user');
        $this->session->set_flashdata('msg', 'Member verified Successfully'); 
        redirect(base_url('admin/members'));
    }

    public function delete($id){
        $this->admin_model->delete($id,'user'); 
        echo json_encode(array('st' => 1));
        
    }


}