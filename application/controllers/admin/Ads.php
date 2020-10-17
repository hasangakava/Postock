<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        // check_logged_user();
        // is_logged_admin();
        $this->load->model('admin_model');
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Ads';   
        $data['ad'] = FALSE;
        $data['ads'] = $this->admin_model->get_data('google_ads');
        $data['main_content'] = $this->load->view('admin/ads/ads',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function add()
    {   
        if($_POST)
        {   
            $id = $_POST['id'];
               
            $data=array(
                'type' => $_POST['type'],
                'code' => htmlentities($_POST['code']),
                'img_url' => $_POST['img_url'],
                'status' => $_POST['status'],
                'created_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
         
            $this->admin_model->edit_option($data, $id, 'google_ads');
            $this->session->set_flashdata('msg', 'Ad Edited Successfully'); 
            
            // insert photos
            if($_FILES['photo']['name'] != ''){
                $up_load = $this->admin_model->upload_image('1200');
                $data_img = array(
                    'image' => $up_load['images'],
                    'thumb' => $up_load['thumb']
                );
                $this->admin_model->edit_option($data_img, $id, 'google_ads');   
            }
            redirect(base_url('admin/ads'));

            
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['ad'] = $this->admin_model->get_by_id($id, 'google_ads');
        $data['main_content'] = $this->load->view('admin/ads/ads',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'google_ads');
        $this->session->set_flashdata('msg', 'Ad activate Successfully'); 
        redirect(base_url('admin/ads'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'google_ads');
        $this->session->set_flashdata('msg', 'Ad deactivate Successfully'); 
        redirect(base_url('admin/ads'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'google_ads'); 
        echo json_encode(array('st' => 1));
    }


    // public function update()
    // {   
    //     if($_POST)
    //     {   
    //         $id = $_POST['ads_type'];
    //         $data=array(
    //             'title' => $_POST['title'],
    //             'type' => $_POST['type'],
    //             'code' => htmlentities($_POST['code']),
    //             'img_url' => $_POST['img_url'],
    //             'is_open_new_window' => $_POST['is_open_new_window'],
    //             'start_date' => $_POST['start_date'],
    //             'end_date' => $_POST['end_date'],
    //             'max_impressions' => $_POST['max_impressions'],
    //             'max_clicks' => $_POST['max_clicks'],
    //             'banner_categories' => $_POST['banner_categories'],
    //             'sections' => $_POST['sections']
    //         );
    //         $data = $this->security->xss_clean($data);
    //         $this->admin_model->edit_option($data, $id, 'google_ads');

    //         // insert photos
    //         if($_FILES['photo']['name'] != ''){
    //             $up_load = $this->admin_model->upload_image('1200');
    //             $data_img = array(
    //                 'image' => $up_load['images'],
    //                 'thumb' => $up_load['thumb']
    //             );
    //             $this->admin_model->edit_option($data_img, $id, 'google_ads');   
    //         }


    //         $this->session->set_flashdata('msg', 'Ads Updated Successfully'); 
    //         redirect(base_url('admin/ads/show/'.$id));

    //     }      
        
    // }





}
	

