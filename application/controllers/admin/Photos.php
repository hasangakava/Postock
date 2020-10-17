<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        check_admin_login();
        $this->load->model('admin_model');
    }

    public function index(){
        $this->all_photos();
    }

    //get all photos
    public function all_photos()
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
        $start_row = $this->uri->segment(4);  

        //make pagination url for search & sord data
        $config['enable_query_strings']=TRUE;
        $getData = array('search' => $q, 'sort' => $sort);

        $config['base_url'] = base_url('admin/photos/all_photos');

        $config['suffix'] = '?'.http_build_query($getData,'',"&amp;");
        $config['first_url'] = $config['base_url'].'?search='.$q;
        
        $total_row = $this->admin_model->get_all_images(1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = 'Photos';
        $data['total'] = $total_row;

        //get photos
        $data['images'] = $this->admin_model->get_all_images(0, $config['per_page'], $start_row);
        
        $data['main_content'] = $this->load->view('admin/photos', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //upload photos page
    public function add_photos()
    {   
        $data = array();
        $data['page_title'] = 'Upload Photos';
        $data['categories'] = $this->common_model->select('category');
        $data['main_content'] = $this->load->view('admin/upload_photos', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    //-- Upload image
    public function upload_image()
    {   
       
        $data = array();
        if ($_POST) {
            
            $user = $this->admin_model->check_user();
            if ($user != '') {
                $user_id = $user->id;
            }else{
                $user_id = $this->create_admin();
            }
            
        
            ini_set('memory_limit', '-1');
            set_time_limit ( -1);
            
            //get image info
            $file = $_FILES["photo"]['tmp_name'];
            list($width, $height) = getimagesize($file);
            $type = explode(".",$_FILES['photo']['name']);
         
            $data = array(
                'type' => end($type),
                'size' => round($_FILES["photo"]["size"] / 1024)." kb",
                'height' => $height,
                'width' => $width,
                'title' => $_POST['title'],
                'category' => $_POST['category'],
                'copyright' => $_POST['copyright'],
                'user_id' => $user_id,
                'status' => 1,
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
                user_total_photos_count($user_id);
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
            $data['url'] = base_url('admin/photos');


            //send json data
            die(json_encode($data));

        }
    }

    //create admin account
    public function create_admin() 
    {
        $data=array(
            'first_name' => 'Admin',
            'email' => $this->settings->admin_email,
            'password' => md5(1234),
            'status' => 1,
            'type' => 1,
            'created_at' => my_date_now()
        );
        $data = $this->security->xss_clean($data);
        $id = $this->admin_model->insert($data, 'user');
        return $id;
    }

    //-- Update image
    public function edit($img_id)
    {   

        if ($_POST) {

            $data = array(
                'title' => $_POST['title'],
                'category' => $_POST['category'],
                'copyright' => $_POST['copyright']
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

            $this->session->set_flashdata('msg', 'Photo edited Successfully');
            redirect(base_url('admin/photos'));
        }


        //combine tags
        $tags = ""; $count = 0;
        $tags_array = $this->common_model->get_tags($img_id); 
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
        $data['categories'] = $this->common_model->select('category');
        $data['image'] = $this->common_model->get_by_id($img_id, 'user_image');
        //echo "<pre>"; print_r($data['image']); exit();
        $data['main_content'] = $this->load->view('admin/edit_photos', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    //get all pending photos
    public function pending()
    {
        $data = array();
        $data['page_title'] = 'Photos';
        $data['images'] = $this->admin_model->get_pending_images();
        $data['total'] = count($data['images']);
        $data['main_content'] = $this->load->view('admin/photos_pending', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



    //approve photos
    public function approve_img($type, $img_id)
    {   
        if($type == 1):
            $featured = 1;
            $noti_text = "<b>Your image</b> selected as a featured image";
        else:
            $featured = 0;
            $noti_text = "<b>Admin</b> approved your image";
        endif;

        $data = array(
            'status' => 1,
            'is_featured' => $featured
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $img_id,'user_image');
        $img = $this->admin_model->get_by_id($img_id,'user_image');
        
        //update total photos
        user_total_photos_count($img->user_id);

        //-- insert notification
        $notify = array(
            'user_id' => $img->user_id,
            'action_id' => 0,
            'content_id' => $img->id,
            'text' => $noti_text,
            'noti_type' => 2,
            'noti_time' => my_date_now()
        );
        $notify = $this->security->xss_clean($notify);
        notify_this($notify);

        echo json_encode(array('st' => 1));
    }


    //reject photos
    public function reject_img($img_id)
    {
        $data = array(
            'status' => 2
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $img_id,'user_image');
        $img = $this->admin_model->get_by_id($img_id,'user_image');
        //update total photos
        user_total_photos_count($img->user_id);
        
        //delete tags
        $this->admin_model->delete_tags($img_id, 'tags');

        //-- insert notification
        $notify = array(
            'user_id' => $img->user_id,
            'action_id' => 0,
            'content_id' => $img->id,
            'text' => "<b>Admin</b> rejected your image",
            'noti_type' => 2,
            'noti_time' => my_date_now()
        );
        $notify = $this->security->xss_clean($notify);
        notify_this($notify);

        echo json_encode(array('st' => 1));
    }


    //-- add featured image
    public function add_feature_img($id) 
    {
        $data = array(
            'is_featured' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'user_image');
        $img = $this->admin_model->get_by_id($img_id,'user_image');
        //update total photos
        user_total_photos_count($img->user_id);

        //-- insert notification
        $notify = array(
            'user_id' => $img->user_id,
            'action_id' => 0,
            'content_id' => $img->id,
            'text' => "<b>Your image</b> selected as a featured image",
            'noti_type' => 2,
            'noti_time' => my_date_now()
        );
        $notify = $this->security->xss_clean($notify);
        notify_this($notify);

        $this->session->set_flashdata('msg', 'Featured image Successfully'); 
        redirect(base_url('admin/photos'));
    }

    //-- deactive photos
    public function suspend($id) 
    {
        $data = array(
            'status' => 2
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'user');
        $this->admin_model->update($data, $id,'user_image');
        $this->session->set_flashdata('msg', 'Image hold Successfully'); 
        redirect(base_url('admin/photos'));
    }

    //-- deactive photos
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'user');
        $this->admin_model->update($data, $id,'user_image');
        $this->session->set_flashdata('msg', 'Image active Successfully'); 
        redirect(base_url('admin/photos'));
    }


    //-- delete photos
    public function delete_rejected_photos()
    {   
        $images = $this->admin_model->get_rejected_img_ids();
        foreach ($images as $img) {
            $this->admin_model->delete_tags($img->id, 'tags');
        }
        $this->admin_model->delete_rejected_photos();
        echo json_encode(array('st'=>1));
    }

    //-- delete photos
    public function delete($id)
    {
        $this->admin_model->delete_tags($id, 'tags');
        $this->admin_model->delete($id,'user_image');
        echo json_encode(array('st'=>1));
    }



}