<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->load->model('admin_model');
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Category';   
        $data['category'] = $this->admin_model->select('category');
        $data['main_content'] = $this->load->view('admin/category',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    // insert category
    public function add()
    {	
        if($_POST)
        {
            $data=array(
                'name' => $_POST['name'],
                'slug' => str_slug(trim($_POST["name"])),
                'status' => 1
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->insert($data, 'category');
            $this->session->set_flashdata('msg', 'Category added Successfully'); 
            redirect(base_url('admin/category'));
         }      
        
    }

    // edit category
    public function edit()
    {  
        if($_POST)
        {
            $id = $_POST['id'];
            $data=array(
                'name' => $_POST['name'],
                'slug' => str_slug(trim($_POST["name"]))
            );
            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, $id, 'category'); 
            $this->session->set_flashdata('msg', 'Category editted Successfully'); 
            redirect(base_url('admin/category'));
        }  
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'category');
        $this->session->set_flashdata('msg', 'Category activate Successfully'); 
        redirect(base_url('admin/category'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'category');
        $this->session->set_flashdata('msg', 'Category deactivate Successfully'); 
        redirect(base_url('admin/category'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'category'); 
        echo json_encode(array('st' => 1));
    }

}
	

