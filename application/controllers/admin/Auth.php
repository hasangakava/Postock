<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('common_model');
    }

    //-- load Login view Page
    public function index()
    {
        $data = array();
        $data['page'] = 'Auth';
        $this->load->view('admin/login');
    }


    //admin login 
    public function log()
    {
        if($_POST){
            //-- check valid user 
            $query = $this->login_model->validate_admin();

            if($query){

                $data = array();
                foreach($query as $row){
                    $data = array(
                        'id' => $row->id,
                        'name' => $row->name,
                        'email' => $row->email,
                        'admin_login' => TRUE
                    );
                    $this->session->set_userdata($data); 
                }
                $url = base_url('admin/dashboard');
                echo json_encode(array('st'=>1,'url'=> $url));
            }else{
                echo json_encode(array('st'=>0));
            }
        }else{
            $this->load->view('auth/admin',$data);
        }
    }

    //-- load register view Page
    public function register()
    {
        $data = array();
        $data['page_title'] = 'Register';
        $this->load->view('admin/register');
    }

    //-- load register view Page
    public function register_admin()
    {
        $data=array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => md5($_POST['password']),
            'created_at' => my_date_now()
        );
        $data = $this->security->xss_clean($data);
        $id = $this->common_model->insert($data, 'admin');

        $query = $this->login_model->validate_admin_id(md5($id));
        foreach ($query as $row) {
            $data = array(
                'id' => $row->id,
                'name' => $row->name,
                'email' => $row->email,
                'admin_login' => TRUE
            );
            $this->session->set_userdata($data);
        }
        $url = base_url('admin/dashboard');
        echo json_encode(array('st'=>1, 'url' => $url));
    }

    //-- Recover forgot password 
    public function forgot_password()
    {
        $mail =  strtolower(trim($_POST["email"])); 
        $random_pw = random_string('numeric',4);
        $valid = $this->login_model->check_admin_email($mail);
        //echo "<pre>"; print_r($valid); exit();
        if ($valid) {
           
           foreach($valid as $row){
                $data['email'] = $row->email;
                $data['name'] = $row->name;
                $data['password'] = $random_pw;
                $user_id = $row->id;
                
                $admin_data = array('password' => md5($random_pw));
                $this->common_model->edit_option($admin_data, $user_id, 'admin');

                $this->send_recovery_mail($data);
                $url = base_url('admin/dashboard');
                echo json_encode(array('st'=>1, 'url' => $url));
            }

        } else {
            echo json_encode(array('st'=>2));
        }
        
    }

    // send reset email to admin email inbox
    public function send_recovery_mail($admin)
    {
        $data = array();
        $data['name'] = $admin['name'];
        $data['password'] = $admin['password'];
        $data['email'] = $admin['email'];
        $msg = $this->load->view('email_template/recover_password',$data, true);
        $this->load->library('email');
        $this->load->library('encrypt');
        $this->email->set_mailtype('html');
        
        $this->email->from('md.mhhn1@gmail.com', 'Macrotech');
        $this->email->to($data['email']);
        $this->email->subject('Recovery Password');
        $this->email->message($msg);
        $this->email->send();
    }

    
    function logout(){
        $this->session->sess_destroy();
        redirect('admin/auth');
    }

}