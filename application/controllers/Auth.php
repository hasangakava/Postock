<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->model('common_model');
    }

    // load Login view Page
    public function index()
    {
        $data = array();
        $data['page'] = 'Auth';
        redirect(base_url('home'));
    }


    // login User
    public function log()
    {
        if($_POST){

            // check valid user 
            $query = $this->login_model->validate_user();
            // if valid
            if($query){

                $data = array();
                foreach($query as $row){
                    $data = array(
                        'id' => $row->id,
                        'name' => $row->first_name,
                        'thumb' => $row->thumb,
                        'email' =>$row->email,
                        'is_login' => TRUE
                    );
                    $data = $this->security->xss_clean($data);
                    $this->session->set_userdata($data); 
                    
                    // check suspend account
                    if ($row->status == 2) {
                        $url = base_url('home');
                        echo json_encode(array('st'=>2,'url'=> $url));
                        exit();
                    }

                }
                $url = base_url('user');
                echo json_encode(array('st'=>1,'url'=> $url));
            }else{
                echo json_encode(array('st'=>0));
            }
        }else{
            $this->load->view('auth',$data);
        }
    }


    // Register member
    public function register()
    {

        if($_POST){
            $config = array(
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'trim|required|min_length[4]|alpha_numeric'
                ),
            );
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules($config);

            // If validation false show error message using ajax
            if($this->form_validation->run() == FALSE){
                $data = array();
                $data['errors'] = validation_errors();
                $str = $data['errors'];
                echo json_encode(array('st'=>0,'msg'=>$str));
            }else{
                $mail =  strtolower(trim($_POST["email"]));

                //check duplicate email
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
                        'status' => 1,
                        'created_at' => my_date_now()
                    );

                    $data = $this->security->xss_clean($data);
                    $id = $this->common_model->insert($data, 'user');

                    $query = $this->login_model->validate_id(md5($id));
                    foreach ($query as $row) {
                        $data = array(
                            'id' => $row->id,
                            'name' => $row->first_name,
                            'email_verify_code' => $row->email_verify_code,
                            'thumb' =>$row->thumb,
                            'email' => $row->email,
                            'is_login' => true
                        );

                        $this->session->set_userdata($data);
                        $url = base_url('home');

                        // insert notification
                        $notify = array(
                            'user_id' => $row->id,
                            'action_id' => 0,
                            'content_id' => 0,
                            'text' => "Welcome to <b>".$this->settings->site_name."</b>",
                            'noti_type' => 1,
                            'noti_time' => my_date_now()
                        );
                        notify_this($notify);
                        echo json_encode(array('st'=>1, 'url' => $url));
                     
                    }
                    
                }
            }
        }
    }



    
    // Recover forgot password 
    public function forgot_password()
    {
        $mail =  strtolower(trim($_POST["email"])); 
        $random_pw = random_string('numeric',4);
        $valid = $this->login_model->check_email($mail);
        //echo "<pre>"; print_r($valid); exit();
        if ($valid) {
           
           foreach($valid as $row){
                $data['email'] = $row->email;
                $data['name'] = $row->first_name;
                $data['password'] = $random_pw;
                $user_id = $row->id;
                
                $users = array('password' => md5($random_pw));
                $this->common_model->edit_option($users, $user_id, 'user');

                $this->send_recovery_mail($data);
                $url = base_url('home');
                echo json_encode(array('st'=>1, 'url' => $url));
            }

        } else {
            echo json_encode(array('st'=>2));
        }
        
    }

    //send reset code to user email
    public function send_recovery_mail($user)
    {
        $data = array();
        $data['name'] = $user['name'];
        $data['password'] = $user['password'];
        $data['email'] = $user['email'];
        $data['site_name'] = $this->settings->site_name;
        $msg = $this->load->view('email_template/recover_password',$data, true);
        $this->load->library('email');
        $this->load->library('encrypt');
        $this->email->set_mailtype('html');
        
        $this->email->from($this->settings->admin_email, $this->settings->site_name);
        $this->email->to($data['email']);
        $this->email->subject('Recovery Password');
        $this->email->message($msg);
        $this->email->send();
    }

    
    function logout(){
        $this->session->sess_destroy();
        redirect('auth');
    }

}