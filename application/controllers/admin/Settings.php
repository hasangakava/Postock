<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->load->model('admin_model');
    }

    
    public function index()
    {
        $data = array();
        $data['page_title'] = 'Settings';
        $data['settings'] = $this->admin_model->get('settings');
        $data['main_content'] = $this->load->view('admin/settings', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    // update settings info
    public function update(){

        if ($_POST) {
            $data = array(
                'site_name' => $_POST['site_name'],
                'site_title' => $_POST['site_title'],
                'keywords' => $_POST['keywords'],
                'description' => $_POST['description'],
                'footer_about' => $_POST['footer_about'],
                'admin_email' => $_POST['admin_email'],
                'home_banner' => $_POST['home_banner'],
                'copyright' => $_POST['copyright'],
                'photo_approval' => $_POST['photo_approval'],
                'photo_download' => $_POST['photo_download'],
                'enable_registration' => $_POST['enable_registration'],
                'enable_ad' => $_POST['enable_ad'],
                'grid_columns' => $_POST['grid_columns'],
                'upload_limit' => $_POST['upload_limit'],
                'video_file_limit' => $_POST['video_file_limit'],
                'mgs_char_length' => $_POST['mgs_char_length'],
                'comments_char_length' => $_POST['comments_char_length'],
                'pagination_limit' => $_POST['pagination_limit'],
                'input_file_limit' => $_POST['input_file_limit'],
                'facebook' => $_POST['facebook'],
                'twitter' => $_POST['twitter'],
                'google' => $_POST['google'],
                'flicker' => $_POST['flicker'],
                'google_analytics' => htmlentities($_POST['google_analytics'])
            );

            // upload favicon image
            $data_img = $this->admin_model->do_upload('photo1');
            if($data_img){

                $data_img = array(
                    'favicon' => $data_img['thumb']
                );
                $this->admin_model->edit_option($data_img, 1, 'settings'); 
             }

             // upload logo
            $data_img2 = $this->admin_model->do_upload('photo2');
            if($data_img2){
                $data_img = array(
                    'logo' => $data_img2['thumb']
                );            
                $this->admin_model->edit_option($data_img, 1, 'settings');
            }

            //-- image upload code
            if(!empty($_FILES['photo']['name'] )){
                
                $up_load = $this->admin_model->upload_image('2000');
               
                $data_img = array(
                    'home_banner_img' => $up_load['images'],
                    'home_banner_thumb' => $up_load['thumb']
                );
                $this->admin_model->edit_option($data_img, 1, 'settings'); 
            }

            $data = $this->security->xss_clean($data);
            $this->admin_model->edit_option($data, 1, 'settings');
            redirect(base_url('admin/settings'));
        }
    }


}