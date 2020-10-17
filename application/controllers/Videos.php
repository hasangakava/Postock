<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
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
        
        $total_row = $this->common_model->get_all_videos(1, 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = $this->settings->pagination_limit;
        $this->pagination->initialize($config);

        $data['page_title'] = 'Videos';
        $data['total'] = $total_row;

        //get videos
        $data['videos'] = $this->common_model->get_all_videos(0, $config['per_page'], $start_row);
        
        $data['main_content'] = $this->load->view('videos', $data, TRUE);
        $this->load->view('index', $data);
    }

    

}