<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

    public function index(){
        $this->all_videos();
    }

    //get all photos
    public function all_videos()
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

        $config['base_url'] = base_url('videos/all_videos');

        $config['suffix'] = '?'.http_build_query($getData,'',"&amp;");
        $config['first_url'] = $config['base_url'].'?search='.$q;
        
        $total_row = $this->admin_model->get_all_videos(1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = 'Videos';
        $data['total'] = $total_row;

        //get videos
        $data['videos'] = $this->admin_model->get_all_videos(0, $config['per_page'], $start_row);
        $data['main_content'] = $this->load->view('admin/videos', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function add_video(){
        $data = array();
        $data['page_title'] = 'Video';
        $data['main_content'] = $this->load->view('admin/video', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    
    //add videos
    public function upload_video(){
        if (isset($_FILES['video']['name']) && $_FILES['video']['name'] != '') {

            $configVideo['upload_path'] = 'assets/videos';
            $configVideo['max_size'] = '60000';
            $configVideo['allowed_types'] = 'avi|flv|wmv|mp4';
            $configVideo['overwrite'] = FALSE;
            $configVideo['remove_spaces'] = TRUE;
            $video_name = $_FILES['video']['name'];
            $configVideo['file_name'] = $video_name;
            $this->load->library('upload', $configVideo);
            $this->upload->initialize($configVideo);
            
            if(!$this->upload->do_upload('video')) {
                echo $this->upload->display_errors();
            }else{
                $videoDetails = $this->upload->data();
                $data['video_name']= $configVideo['file_name'];
                $data['video_detail'] = $videoDetails;
                
                $data = array(
                    'title' => $_POST['title'],
                    'user_id' => 0,
                    'path' => 'assets/videos/'.$videoDetails['file_name'],
                    'file_type' => $videoDetails['file_type'],
                    'file_ext' => $videoDetails['file_ext'],
                    'file_size' => $videoDetails['file_size'],
                    'status' => 1,
                    'created_at' => my_date_now()
                );
                //echo "<pre>"; print_r($videoDetails); exit();
                $this->admin_model->insert($data, 'videos');
                redirect(base_url('admin/videos'));
            }
            
        }else{
            echo "Please select a file";
        }
    }


    //get all pending photos
    public function pending()
    {
        $data = array();
        $data['page_title'] = 'Videos';
        $data['videos'] = $this->admin_model->get_pending_videos();
        $data['total'] = count($data['videos']);
        $data['main_content'] = $this->load->view('admin/videos_pending', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



    //approve photos
    public function approve_video($type, $id)
    {   
        if($type == 1):
            $featured = 1;
            $noti_text = "<b>Your video</b> selected as a featured video";
        else:
            $featured = 0;
            $noti_text = "<b>Admin</b> approved your video";
        endif;

        $data = array(
            'status' => 1,
            'is_featured' => $featured
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'videos');
        $img = $this->admin_model->get_by_id($id,'videos');
        
        //update total video
        user_total_videos_count($img->user_id);

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


    //reject video
    public function reject_video($video_id)
    {
        $data = array(
            'status' => 2
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $video_id,'videos');
        $video = $this->admin_model->get_by_id($video_id,'videos');
        
         //update total video
        user_total_videos_count($video->user_id);
        
        //delete tags
        //$this->admin_model->delete_tags($video_id, 'tags');

        //-- insert notification
        $notify = array(
            'user_id' => $video->user_id,
            'action_id' => 0,
            'content_id' => $video->id,
            'text' => "<b>Admin</b> rejected your video",
            'noti_type' => 2,
            'noti_time' => my_date_now()
        );
        $notify = $this->security->xss_clean($notify);
        notify_this($notify);

        echo json_encode(array('st' => 1));
    }


    //-- add featured image
    public function add_feature_video($id) 
    {
        $data = array(
            'is_featured' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'videos');
        $img = $this->admin_model->get_by_id($img_id,'videos');
         
        //update total video
        user_total_videos_count($img->user_id);

        //-- insert notification
        $notify = array(
            'user_id' => $img->user_id,
            'action_id' => 0,
            'content_id' => $img->id,
            'text' => "<b>Your video</b> selected as a featured video",
            'noti_type' => 2,
            'noti_time' => my_date_now()
        );
        $notify = $this->security->xss_clean($notify);
        notify_this($notify);

        $this->session->set_flashdata('msg', 'Featured video Successfully'); 
        redirect(base_url('admin/photos'));
    }

    //-- deactive photos
    public function suspend($id) 
    {
        $data = array(
            'status' => 2
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'videos');
        $this->session->set_flashdata('msg', 'Video hold Successfully'); 
        redirect(base_url('admin/photos'));
    }

    //-- deactive photos
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'videos');
        $this->session->set_flashdata('msg', 'Video active Successfully'); 
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
        //$this->admin_model->delete_tags($id, 'tags');
        $this->admin_model->delete($id,'videos');
        echo json_encode(array('st'=>1));
    }

}