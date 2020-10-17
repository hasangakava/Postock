<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index()
    { 
        $id = md5($this->session->userdata('id'));
        $this->profile($id);
    }

    //load user profile
    public function profile($id)
    {   
        
        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(4);  

        $config['base_url'] = base_url('user/profile/'.$id);
        $total_row = $this->common_model->get_images_by_user($id, 1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = 'User';
        $data['user_id'] = $id;
        $data['total_photos'] = $total_row;
        $data['images'] = $this->common_model->get_images_by_user($id, 0, $config['per_page'], $start_row);
        $data['main_content'] = $this->load->view('user/profile', $data, TRUE);
        $this->load->view('index', $data);
    }


    //load user profile
    public function videos($id)
    {   
        
        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(4);  

        $config['base_url'] = base_url('user/videos/'.$id);
        $total_row = $this->common_model->get_videos_by_user($id, 1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = 'Videos';
        $data['user_id'] = $id;
        $data['total_videos'] = $total_row;
        $data['videos'] = $this->common_model->get_videos_by_user($id, 0, $config['per_page'], $start_row);
        $data['main_content'] = $this->load->view('user/my_videos', $data, TRUE);
        $this->load->view('index', $data);
    }


    //get downloaded images by user
    public function downloads($id)
    {   
        check_login_user();
        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(4);  

        $config['base_url'] = base_url('user/downloads/'.$id);
        $total_row = $this->common_model->get_my_downloads($id, 1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = 'Downloads';
        $data['user_id'] = $id;
        $data['total_photos'] = $total_row;
        $data['images'] = $this->common_model->get_my_downloads($id, 0, $config['per_page'], $start_row);
        //echo "<pre>"; print_r($data['images']); exit();
        $data['main_content'] = $this->load->view('user/downloads', $data, TRUE);
        $this->load->view('index', $data);
    }

    //get pending images
    public function pending($user_id)
    {   
        check_login_user();
        $data = array();
        $data['page_title'] = 'Pending';
        $data['user_id'] = $user_id;
        $data['images'] = $this->common_model->get_pending_photos($user_id);
        $data['main_content'] = $this->load->view('user/pending', $data, TRUE);
        $this->load->view('index', $data);
    }

    //get all followers
    public function followers($user_id)
    {      
        check_login_user();
        $data = array();
        
        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(4);  

        $config['base_url'] = base_url('user/followers/'.$user_id);
        $total_row = $this->common_model->get_all_followers($user_id, 1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = "Followers";
        $data['user_id'] = $user_id;
        $data['total'] = $total_row;
        $data['followers'] = $this->common_model->get_all_followers($user_id, 0, $config['per_page'], $start_row);
        $data['main_content'] = $this->load->view('user/followers', $data, TRUE);
        $this->load->view('index', $data);
    }

    //get all following
    public function following($user_id)
    {      
        check_login_user();
        $data = array();
        
        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(4);  

        $config['base_url'] = base_url('user/following/'.$user_id);
        $total_row = $this->common_model->get_all_following($user_id, 1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = "Following";
        $data['user_id'] = $user_id;
        $data['total'] = $total_row;
        $data['followers'] = $this->common_model->get_all_following($user_id, 0, $config['per_page'], $start_row);
        $data['main_content'] = $this->load->view('user/followers', $data, TRUE);
        $this->load->view('index', $data);
    }

    //get users collections
    public function collections($user_id)
    {   
        $data = array();
        $data['page_title'] = 'Collections';
        $data['user_id'] = $user_id;
        $data['collections'] = $this->common_model->get_collection_list($user_id);
        $data['main_content'] = $this->load->view('user/collections', $data, TRUE);
        $this->load->view('index', $data);
    }


    //get single collection
    public function single_collection($collec_id, $user_id)
    {   
        $data = array();
        $data['user_id'] = $user_id;
        $data['page_title'] = 'Single Collections';
        $data['images'] = $this->common_model->get_collections_by_id($collec_id);
        $data['main_content'] = $this->load->view('user/single_collection', $data, TRUE);
        $this->load->view('index', $data);
    }

    // upload option page
    public function upload_option($id)
    {   
        check_login_user();
        $data = array();
        $data['user_id'] = $id;
        $data['page_title'] = 'Upload';
        $data['main_content'] = $this->load->view('user/upload_type', $data, TRUE);
        $this->load->view('index', $data);
    }


    //load upload image page
    public function upload($id)
    {   
        check_login_user();
        $data = array();
        $data['user_id'] = $id;
        $data['page_title'] = 'Upload';
        $data['categories'] = $this->common_model->select('category');
        $data['main_content'] = $this->load->view('user/upload', $data, TRUE);
        $this->load->view('index', $data);
    }


    //-- Upload image
    public function upload_image()
    {   
        check_login_user();

        $data = array();
        if ($_POST) {

            $user_id = $this->session->userdata('id');
            $img = $this->common_model->check_last_upload_img($user_id);

            //-- check perday photo upload limit
            if ($img < $this->settings->upload_limit):
                
                ini_set('memory_limit', '-1');
                set_time_limit ( -1);
                
                //get image info
                $file = $_FILES["photo"]['tmp_name'];
                list($width, $height) = getimagesize($file);
                $type = explode(".",$_FILES['photo']['name']);
             
                //check photo approval
                if($this->settings->photo_approval == 1):
                    $status = 1;
                else:
                    $status = 0;
                endif;

                $data = array(
                    'type' => end($type),
                    'size' => round($_FILES["photo"]["size"] / 1024)." kb",
                    'height' => $height,
                    'width' => $width,
                    'title' => $_POST['title'],
                    'category' => $_POST['category'],
                    'copyright' => $_POST['copyright'],
                    'user_id' => $user_id,
                    'status' => $status,
                    'uploaded_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);
                $id = $this->common_model->insert($data, 'user_image');

                // insert tags
	            foreach ($_POST['tags'] as $tag) {
	                $tags = explode(",", $tag);
	                for ($i=0; $i < count($tags); $i++) { 
	                    $data_tags = array(
	                        'img_id' => $id,
	                        'tag' => $tags[$i],
	                        'tag_slug' => str_slug($tags[$i])
	                    );
	                    $this->common_model->insert($data_tags, 'tags');
	                }
	            }

	            //check photo approval option
                if($this->settings->photo_approval == 1):
                    user_total_photos_count($this->session->userdata('id'));
                endif;
                

                //-- image upload code
                if(!empty($_FILES['photo']['name'] )){
                    
                    $up_load = $this->common_model->upload_image('1920');
                    $img_name = explode("medium/",$up_load['images']);

                    $data_img = array(
                        'image_name' => end($img_name),
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->common_model->edit_option($data_img, $id, 'user_image'); 
                }
                
                $data['status'] = 1;
                $data['url'] = base_url('user/profile/'.md5($user_id));

            else:

            	$data['status'] = 2;
                $data['msg'] = "Sorry You can upload only ".$this->settings->upload_limit." photos perday";
                
            endif;

            //send json data
            die(json_encode($data));

        }

        $data = array();
        $data['page_title'] = 'Upload';
        $data['main_content'] = $this->load->view('user/upload', $data, TRUE);
        $this->load->view('index', $data);
    }


    public function add_video($id){
        check_login_user();
        $data = array();
        $data['user_id'] = $id;
        $data['page_title'] = 'Video';
        $data['main_content'] = $this->load->view('user/upload_video', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function edit_video($user_id, $id){
        check_login_user();
        $video = $this->common_model->get_by_id($id, 'videos');
        if ($_POST) {
            
            if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {

                $configVideo['upload_path'] = 'assets/videos';
                $configVideo['max_size'] = '60000';
                $configVideo['allowed_types'] = 'avi|flv|wmv|mp4|3gp';
                $configVideo['overwrite'] = FALSE;
                $configVideo['remove_spaces'] = TRUE;
                $video_name = $_FILES['video']['name'];
                $configVideo['file_name'] = $video_name;
                $this->load->library('upload', $configVideo);
                $this->upload->initialize($configVideo);
                
                if(!$this->upload->do_upload('video')) {
                    $error =  $this->upload->display_errors();
                    $data['status'] = 2;
                    $data['msg'] = $error;
                }else{
                    $videoDetails = $this->upload->data();
                    $data['video_name']= $configVideo['file_name'];
                    $data['video_detail'] = $videoDetails;
                    
                    $data = array(
                        'title' => $_POST['title'],
                        'user_id' => $this->session->userdata('id'),
                        'path' => 'assets/videos/'.$videoDetails['file_name'],
                        'file_type' => $videoDetails['file_type'],
                        'file_ext' => $videoDetails['file_ext'],
                        'file_size' => $videoDetails['file_size'],
                        'status' => 0,
                        'created_at' => my_date_now()
                    );
                    $data = $this->security->xss_clean($data);
                    $this->common_model->insert($data, 'videos');

                    //check photo approval option
                    if($this->settings->photo_approval == 1):
                        user_total_videos_count($this->session->userdata('id'));
                    endif;

                    $data['status'] = 1;
                    $data['url'] = base_url('user/profile/'.md5($user_id));
                }
                die(json_encode($data));
                
            }else{
                echo "Please select a file";
            }
        }

        $data = array();
        $data['user_id'] = $user_id;
        $data['video'] = $video;
        $data['page_title'] = 'Edit Video';
        $data['main_content'] = $this->load->view('user/edit_video', $data, TRUE);
        $this->load->view('index', $data);
    }
    
    //-- upload videos
    public function upload_video(){
        $user_id = $this->session->userdata('id');
        if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {

            $configVideo['upload_path'] = 'assets/videos';
            $configVideo['max_size'] = $this->settings->video_file_limit*1024;
            $configVideo['allowed_types'] = 'avi|flv|wmv|mp4|3gp';
            $configVideo['overwrite'] = FALSE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = $_FILES['video']['name'];
            $configVideo['file_name'] = $video_name;
            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);
            
            if(!$this->upload->do_upload('video')) {
                $error =  $this->upload->display_errors();
                $data['status'] = 2;
                $data['msg'] = $error;
            }else{
                $videoDetails = $this->upload->data();
                $data['video_name']= $configVideo['file_name'];
                $data['video_detail'] = $videoDetails;
                
                $data = array(
                    'title' => $_POST['title'],
                    'user_id' => $this->session->userdata('id'),
                    'path' => 'assets/videos/'.$videoDetails['file_name'],
                    'file_type' => $videoDetails['file_type'],
                    'file_ext' => $videoDetails['file_ext'],
                    'file_size' => $videoDetails['file_size'],
                    'status' => 0,
                    'created_at' => my_date_now()
                );
                $data = $this->security->xss_clean($data);
                $this->common_model->insert($data, 'videos');

                //check photo approval option
                if($this->settings->photo_approval == 1):
                    user_total_videos_count($this->session->userdata('id'));
                endif;

                $data['status'] = 1;
                $data['url'] = base_url('user/profile/'.md5($user_id));
            }
            die(json_encode($data));
            
        }else{
            echo "Please select a file";
        }
    }


     public function update_video($id){

        $user_id = $this->session->userdata('id');
        if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {

            $configVideo['upload_path'] = 'assets/videos';
            $configVideo['max_size'] = '60000';
            $configVideo['allowed_types'] = 'avi|flv|wmv|mp4|3gp';
            $configVideo['overwrite'] = FALSE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = $_FILES['video']['name'];
            $configVideo['file_name'] = $video_name;
            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);
            
            if(!$this->upload->do_upload('video')) {
                $error =  $this->upload->display_errors();
                $data['status'] = 2;
                $data['msg'] = $error;
            }else{
                $videoDetails = $this->upload->data();
                $data['video_name']= $configVideo['file_name'];
                $data['video_detail'] = $videoDetails;
                
                $data = array(
                    'title' => $_POST['title'],
                    'path' => 'assets/videos/'.$videoDetails['file_name'],
                    'file_type' => $videoDetails['file_type'],
                    'file_ext' => $videoDetails['file_ext'],
                    'file_size' => $videoDetails['file_size']
                );
                $data = $this->security->xss_clean($data);
                $this->common_model->edit_option($data, $id,'videos');

                //check photo approval option
                if($this->settings->photo_approval == 1):
                    user_total_videos_count($this->session->userdata('id'));
                endif;

                $data['status'] = 1;
                $data['url'] = base_url('user/profile/'.md5($user_id));
            }
            die(json_encode($data));
            
        }else{
            echo "Please select a file";
        }
    }


    //-- Update image
    public function edit_image($user_id, $img_id)
    {   
        check_login_user();
        $img = $this->common_model->get_single_img($img_id);

        if ($_POST) {

            $data = array(
                'title' => $_POST['title'],
                'category' => $_POST['category'],
                'copyright' => $_POST['copyright'],
                'uploaded_at' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option($data, $img_id, 'user_image');
            
            
            $this->common_model->delete_tags($img_id, 'tags');
            // insert tags
            foreach ($_POST['tags'] as $tag) {
                $tags = explode(",", $tag);
                for ($i=0; $i < count($tags); $i++) { 
                    $data_tags = array(
                        'img_id' => $img_id,
                        'tag' => $tags[$i],
                        'tag_slug' => str_slug($tags[$i])
                    );
                    $this->common_model->insert($data_tags, 'tags');
                }
            }

            $this->session->set_flashdata('msg', 'Your photo uploaded Successfully');
            redirect(base_url('user'));
        }


        //combine tags
        $tags = ""; $count = 0;
        $tags_array = $this->common_model->get_tags($img->id); 
        foreach ($tags_array as $item) {
            if ($count > 0) {
                $tags .= ",";
            }
            $tags .= $item->tag;
            $count++;
        }

        $data = array();
        $data['tags'] = $tags;
        $data['page_title'] = 'Edit Image';
        $data['user_id'] = md5($user_id);
        $data['categories'] = $this->common_model->select('category');
        $data['image'] = $this->common_model->get_single_img($img_id);
        $data['main_content'] = $this->load->view('user/edit_photo', $data, TRUE);
        $this->load->view('index', $data);
    }


    public function account()
    {   
        check_login_user();
        $data = array();
        $data['page_title'] = 'Account';
        $data['main_content'] = $this->load->view('user/account', $data, TRUE);
        $this->load->view('index', $data);
    }


    //edit account
    public function edit_account($id)
    {      
        check_login_user();
        if ($_POST) {
            $id = $_POST['id'];
            $data = array(
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'country' => $_POST['country'],
                'fb' => $_POST['fb'],
                'twitter' => $_POST['twitter'],
                'google' => $_POST['google'],
                'website' => $_POST['website']
            );

            $data = $this->security->xss_clean($data);
            $this->common_model->edit_option_md5($data, $id, 'user');

            //-- image upload code
            if(!empty($_FILES['photo']['name'] )){

                $up_load = $this->common_model->upload_image('400');
                $data_img = array(
                    'image' => $up_load['images'],
                    'thumb' => $up_load['thumb']
                );
                $data = $this->security->xss_clean($data_img);
                $this->common_model->edit_option_md5($data, $id, 'user'); 
            }
            redirect(base_url('user'));
        }
        $data = array();
        $data['user_id'] = $id;
        $data['page_title'] = 'Edit Account';
        $data['user'] = $this->common_model->get_my_info($id);
        $data['countries'] = $this->common_model->select_result('country');
        $data['main_content'] = $this->load->view('user/account', $data, TRUE);
        $this->load->view('index', $data);
    }

    //change pass word
    public function change_password()
    {   
        check_login_user();
        if($_POST){
            
            $id = $this->session->userdata('id');
            $user = $this->common_model->select_option($id, 'user');

            if ($user[0]['password'] == md5($_POST['old_pass'])) {
                
                if ($_POST['new_pass'] == $_POST['confirm_pass']) {
                    $data=array(
                        'password' => md5($_POST['new_pass'])
                    );
                    $this->common_model->edit_option($data, $id, 'user');
                    echo json_encode(array('st'=>1));
                } else {
                    echo json_encode(array('st'=>2));
                }
                
            } else {
                echo json_encode(array('st'=>0));
            }
        }
    }

    //delete image
    public function delete_img($id)
    {   
        check_login_user();
        $img = $this->common_model->get_single_img($id);
        $user = $this->common_model->get_by_id($img->user_id, 'user');
        $this->common_model->delete_tags($img->id, 'tags');

        $data=array('total_photos' => $user->total_photos - 1);
        $data = $this->security->xss_clean($data);
        $this->common_model->edit_option($data, $user->id, 'user');

        $image  = $img->image;
        $thumb  = $img->thumb;

        unlink($image);
        unlink($thumb);

        $this->common_model->delete_tags($img->id, 'tags');
        $this->common_model->delete($img->id, 'user_image');
        echo json_encode(array('st' => 1));
    }

    //delete image
    public function delete_video($id)
    {   
        check_login_user();
        $video = $this->common_model->get_by_id($id, 'videos');
        $user = $this->common_model->get_by_id($video->user_id, 'user');

        $data=array('total_videos' => $user->total_videos - 1);
        $data = $this->security->xss_clean($data);
        $this->common_model->edit_option($data, $user->id, 'user');

        $videos  = $video->path;
        unlink($videos);

        $this->common_model->delete($video->id, 'videos');
        redirect(base_url('user/videos/'.md5($user->id)));
    }

    //create new collection
    public function create_collection()
    {   
        check_login_user();
    
        $data = array(
            'title' => $this->input->post('title'),
            'user_id' => $this->session->userdata('id'),
            'type' => $this->input->post('type'),
            'created_at' => my_date_now()
        );
        
        $data = $this->security->xss_clean($data);
        $this->common_model->insert($data, 'collections');
        $data['collections'] = $this->common_model->get_my_collection('collections');
        $loaded = $this->load->view('include/load_collection', $data, TRUE);
        echo json_encode(array('st' => 1, 'loaded' => $loaded));
    }


    //add images to collection
    public function add_to_collection()
    {   
        check_login_user();
        $data = array(
            'collection_id' => $this->input->post('collection'),
            'user_id' => $this->session->userdata('id'),
            'img_id' => $this->input->post('img_id'),
            'date_time' => my_date_now()
        );
        
        $data = $this->security->xss_clean($data);
        $this->common_model->insert($data, 'collection_image');

        $img = $this->common_model->get_single_img(md5($this->input->post('img_id')));
        $notify = array(
            'user_id' => $img->user_id,
            'action_id' => $this->session->userdata('id'),
            'text' => " loves and collected your image",
            'content_id' => $img->id,
            'noti_type' => 7,
            'noti_time' => my_date_now()
        );
        notify_this($notify);

        echo json_encode(array('st' => 1));
    }

    //edit collections
    public function edit_collection($id)
    {   
        check_login_user();
        $data = array(
            'title' => $this->input->post('title'),
            'type' => $this->input->post('type')
        );
        
        $data = $this->security->xss_clean($data);
        $this->common_model->edit_option($data, $id, 'collections');
        redirect(base_url('user/collections/'.md5($this->session->userdata('id'))));
    }


    //send message to user
    public function send_message(){

        if ($_POST) {

            $message = $this->input->post('message');

            if($message == ''):
                echo json_encode(array('st'=>2)); exit();
            endif;


            $mgs_to = get_user_id_md5(strip_tags($this->input->post('mgs_to')));
            $data = array(
                'mgs_to' => $mgs_to,
                'mgs_time' => my_date_now(),
                'message' => strip_tags($this->input->post('message')),
                'mgs_from' => strip_tags($this->session->userdata('id'))
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->insert($data,'message');

            //insert notification
            $notify = array(
                'user_id' => $mgs_to,
                'action_id' => strip_tags($this->session->userdata('id')),
                'text' => " sent you a message",
                'content_id' => 0,
                'noti_type' => 8,
                'noti_time' => my_date_now()
            );
            notify_this($notify);
            echo json_encode(array('st'=>1));

        }
    }




}
