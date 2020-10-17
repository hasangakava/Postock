<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
    }

    public function index()
    {   
        $data = array();
        $data['page_title'] = 'Discover Photos';
        $data['categories'] = $this->common_model->get_category_images();
        $data['main_content'] = $this->load->view('discover_photos', $data, TRUE);
        $this->load->view('index', $data);
    }

    //all photos
    public function all_photos(){

        //get search and sort value
        if(isset($_GET['category'])){
            $category = trim($this->input->get('category'));
        }else{
            $category = '';
        }
        if(isset($_GET['sort'])){
            $sort = trim($this->input->get('sort'));
        }else{
            $sort = '';
        }

        $data = array();

        //initialize pagination
        $this->load->library('pagination');
        $start_row = $this->uri->segment(3);  

        //make pagination url for search & sord data
        $config['enable_query_strings']=TRUE;
        $getData = array('sort' => $sort, 'category' => $category);


        $config['base_url'] = base_url('photos/all_photos');
        $config['suffix'] = '?'.http_build_query($getData,'',"&amp;");
        $config['first_url'] = $config['base_url'].'?category='.$category;

        $total_row = $this->common_model->get_all_images(1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = "All Photos";
        $data['total_photos'] = $total_row;
        $data['categories'] = $this->common_model->select('category');
        $data['images'] = $this->common_model->get_all_images(0, $config['per_page'], $start_row);
        $data['main_content'] = $this->load->view('all_images', $data, TRUE);
        $this->load->view('index', $data);
    }


    //all photos by category
    public function category($slug)
    {
        $data = array();
        $this->load->library('pagination');
        $start_row = $this->uri->segment(4);  

        $config['base_url'] = base_url('photos/category/'.$slug);
        $total_row = $this->common_model->get_images_by_category($slug, 1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data = array();
        $data['total_photos'] = $total_row;
        $data['page_title'] = 'Discover Details';
        $data['images'] = $this->common_model->get_images_by_category($slug, $total=0, $config['per_page'], $start_row);
        $data['main_content'] = $this->load->view('category_details', $data, TRUE);
        $this->load->view('index', $data);
    }

    //get all collections
    public function collections()
    {   
        $data = array();
        $data['page_title'] = 'Collections';
        $data['collections'] = $this->common_model->get_all_collections();
        $data['total'] = count($data['collections']);
        $data['main_content'] = $this->load->view('all_collections', $data, TRUE);
        $this->load->view('index', $data);
    }

    //get single collections
    public function single_collection($collec_id)
    {   
        $data = array();
        $data['page_title'] = 'Single Collections';
        $data['images'] = $this->common_model->get_collections_by_id($collec_id);
        $data['total'] = count($data['images']);
        $data['main_content'] = $this->load->view('single_collection', $data, TRUE);
        $this->load->view('index', $data);
    }


    //get all tags
    public function tags()
    {   
        $data = array();
        $data['page_title'] = 'Tags';
        $data['tags'] = $this->common_model->get_all_tags();
        $data['total'] = count($data['tags']);
        $data['main_content'] = $this->load->view('tags', $data, TRUE);
        $this->load->view('index', $data);
    }

    //get images by tag
    public function tag($slug)
    {   
        $data = array();
        $data['page_title'] = 'Tags';
        $data['images'] = $this->common_model->get_images_by_tag($slug);
        $data['total'] = count($data['images']);
        $data['main_content'] = $this->load->view('tag_images', $data, TRUE);
        $this->load->view('index', $data);
    }
    

    //get single image details
    public function details($id)
    {   
        $data = array();
        $data['page_title'] = 'Single Image';
        $data['image'] = $this->common_model->get_single_img($id);
        $category_id = $data['image']->category_id;
        $data['related_img'] = $this->common_model->get_related_img($id, $category_id);
        $data['image_comment'] = $this->common_model->get_comments_by_img(5, $id);
        $data['count_comment'] = count($data['image_comment']);
        $data['report'] = $this->common_model->check_img_report($id);
        $data['tags'] = $this->common_model->get_tags($data['image']->id);
        $this->load->helper('cookie');
        $this->common_model->increase_image_view($id);
        $data['main_content'] = $this->load->view('single_img', $data, TRUE);
        $this->load->view('index', $data);
    }

    //load comment
    public function load_more($limit, $img_id)
    {
        $limit = $limit + 5;
        $data['image_comment'] = $this->common_model->get_comments_by_img($limit, md5($img_id));
        $loaded = $this->load->view('include/comment_load', $data, TRUE);
        echo json_encode(array('st' => 1, 'loaded' => $loaded, 'limit' => $limit));
    }

    //like image
    public function like_img($img_id)
    {
        $img = $this->common_model->get_single_img($img_id);
    
        $data = array(
            'user_id' => $img->user_id,
            'action_id' => $this->session->userdata('id'),
            'img_id' => $img->id,
            'date_time' => my_date_now()
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->insert($data, 'image_like');

        user_total_like_count($img->user_id);

        if ($this->session->userdata('is_login') == TRUE) {
            $action_id = $this->session->userdata('id');
        }else{
            $action_id = 0;
        }

        //-- insert notification
        $notify = array(
            'user_id' => $img->user_id,
            'action_id' => $action_id,
            'content_id' => $img->id,
            'text' => " likes your photo",
            'noti_type' => 4,
            'noti_time' => my_date_now()
        );
        $notify = $this->security->xss_clean($notify);
        if ($this->session->userdata('id') != $img->user_id) {
            notify_this($notify);
        }

        echo json_encode(array('st' => 1));
        
    }

    //unlike image
    public function unlike_img($img_id)
    {
        $img = $this->common_model->get_single_img($img_id);

        user_total_like_count($img->user_id);
        $data = array(
            'img_id' => $img->id,
            'action_id' => $this->session->userdata('id')
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->remove_like($data);

        user_total_like_count($img->user_id);
        echo json_encode(array('st' => 1));
        
    }


    //remove collection
    public function remove_collection($img_id)
    {
        $img = $this->common_model->get_single_img($img_id);
        $data = array(
            'img_id' => $img->id,
            'user_id' => $this->session->userdata('id')
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->remove_collection($data);

        $user = $this->common_model->get_by_id($img->user_id, 'user');

        $data = array('total_favourite' => $user->total_favourite - 1);
        $data = $this->security->xss_clean($data);
        $this->common_model->edit_option($data, $user->id, 'user');
        echo json_encode(array('st' => 1));
        

    }


    //insert comments
    public function add_comment($img_id)
    {
        $img = $this->common_model->get_single_img($img_id);

        if ($_POST) {
            $data = array(
                'user_id' => $this->session->userdata('id'),
                'img_id' => $img->id,
                'comment' => strip_tags($_POST['comment']),
                'date_time' => my_date_now()
            );
            $data = $this->security->xss_clean($data);
            $this->common_model->insert($data, 'comment');

            //-- insert notification
            $notify = array(
                'user_id' => $img->user_id,
                'action_id' => $this->session->userdata('id'),
                'content_id' => $img->id,
                'text' => " coments on your photo",
                'noti_type' => 5,
                'noti_time' => my_date_now()
            );
            $notify = $this->security->xss_clean($notify);
            if ($this->session->userdata('id') != $img->user_id) {
                notify_this($notify);
            }

            $data = array();
            $data['image_comment'] = $this->common_model->get_image_comment($img_id);
            $loaded = $this->load->view('include/comment_load', $data, TRUE);
            echo json_encode(array('st' => 1, 'loaded' => $loaded));
        }

    }

    public function delete_comment($id)
    {
        $this->common_model->delete($id,'comment'); 
        echo json_encode(array('st' => 1));
    }

    //-- Resize and downlaod image
    public function download_img($type, $img_id)
    {
        // get image details
        $img = $this->common_model->get_single_img($img_id);

        //customize image name
        $ext = substr($img->image_name, strrpos($img->image_name, "."));
        // crop image 
        if ($type == 1) {
            $link = resize_img(base_url('assets/uploads/medium/'.$img->image_name),640,426);
            $img_name = basename($img->image_name, $ext) . "-426_640" . $ext;
            $del_img_url = 'assets/uploads/medium/'.$img_name;
        }else if($type == 2){
            $link = resize_img(base_url('assets/uploads/medium/'.$img->image_name),1280,850);
            $img_name = basename($img->image_name, $ext) . "-850_1280" . $ext;
            $del_img_url = 'assets/uploads/medium/'.$img_name;
        }else {
            $link = resize_img(base_url('assets/uploads/medium/'.$img->image_name),1920,1080);
            $img_name = basename($img->image_name, $ext) . "-1080_1920" . $ext;
            $del_img_url = 'assets/uploads/medium/'.$img_name;
        }
        
        $this->load->helper('download');

        if ($this->session->userdata('is_login') == TRUE) {
            $action_id = $this->session->userdata('id');
            $action_name = $this->session->userdata('name');
        }else{
            $action_id = 0;
            $action_name = "Someone";
        }

        //-- insert download
        $data = array(
            'img_id' => $img->id,
            'user_id' => $img->user_id,
            'action_id' => $action_id,
            'date_time' => my_date_now()
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->insert($data, 'download');
        
        //count and update download
        user_total_download_count($img->user_id);
        $this->common_model->update_photo_download(md5($img->id));

        // insert notification
        $notify = array(
            'user_id' => $img->user_id,
            'action_id' => $action_id,
            'content_id' => $img->id,
            'text' => "<b>".$action_name."</b> downloaded your photo",
            'noti_type' => 6,
            'noti_time' => my_date_now()
        );
        $notify = $this->security->xss_clean($notify);
        if ($this->session->userdata('id') != $img->user_id) {
            notify_this($notify);
        }

        $data = file_get_contents($link);
        $name = $img->image_name;
        unlink($del_img_url); //delete resize image after download
        force_download($name, $data); 
        

    }


    // add image report
    public function report_img($img_id)
    {
        $img = $this->common_model->get_single_img($img_id);
        $data = array(
            'user_id' => $img->user_id,
            'img_id' => $img->id,
            'action_id' => $this->session->userdata('id'),
            'report' => $this->input->post('report'),
            'date_time' => my_date_now()
        );
        $data = $this->security->xss_clean($data);
        $this->common_model->insert($data, 'report');
        echo json_encode(array('st' => 1));
        

    }


}
