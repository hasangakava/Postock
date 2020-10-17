<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->load->model('admin_model');
    }

    public function index()
    {	
        $data = array();
        $data['page_title'] = 'Pages';   
        $data['pages'] = $this->admin_model->select('pages');          
        $data['main_content'] = $this->load->view('admin/pages',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    //add pages
    public function add()
    {   
        if($_POST){
            
            $data=array(
                'title' => $_POST['title'],
                'slug' => str_slug(trim($_POST["slug"])),
                'details' => $_POST['details'],
                'status' => 1
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->insert($data, 'pages');
            $this->session->set_flashdata('msg', 'Page added Successfully'); 
            redirect(base_url('admin/pages'));
         }
    }

    //edit pages
    public function edit($id)
    {  
         
        if($_POST){

            $data=array(
                'title' => $_POST['title'],
                'slug' => str_slug(trim($_POST["slug"])),
                'details' => $_POST['details'],
                'status' => 1
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, $id, 'pages'); 
            $this->session->set_flashdata('msg', 'Page edited Successfully'); 
            redirect(base_url('admin/pages'));
        }           
            
        $data = array();
        $data['page'] = 'Page Edit';   
        $data['page'] = $this->admin_model->get_by_id($id, 'pages');                
        $data['main_content'] = $this->load->view('admin/pages_edit',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $this->session->set_flashdata('msg', 'Page activate Successfully'); 
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'pages');
        redirect(base_url('admin/pages'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $this->session->set_flashdata('msg', 'Page deactivate Successfully'); 
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'pages');
        redirect(base_url('admin/pages'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'pages'); 
        echo json_encode(array('st' => 1));
        
    }

}
	

