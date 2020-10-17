<?php
class Common_model extends CI_Model {

    // insert function
	public function insert($data,$table){
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

    // edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    // edit function
    function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)', $id);
        $this->db->update($table,$action);
        return;
    } 

    // update function
    function update($action,$id,$table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
    }

    // delete function
    function delete($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

    public function remove_follower($id,$table){
        $this->db->delete($table, array('follower_id' => $id, 'action_id' => $this->session->userdata('id')));
        return;
    }

    // remove like
    public function remove_like($data){
        $this->db->delete('image_like', $data);
        return;
    }

    // remove favourite
    public function remove_collection($data){
        $this->db->delete('collection_image', $data);
        return;
    }

    // delete tags
    function delete_tags($img_id, $table){
        $this->db->delete($table, array('img_id' => $img_id));
        return;
    }

    // get tags
    function get_tags($img_id){
        $this->db->select();
        $this->db->from('tags');
        $this->db->where('img_id', $img_id);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get function
    function get($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // select function
    function select($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // select result function
    function select_result($table){
        $this->db->select();
        $this->db->from($table);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // select by id
    function select_option($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    // select by id
    function get_by_id($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    // select by id
    function select_option_md5($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where(md5('id'), $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 


    // select function
    function get_categories(){
        $this->db->select();
        $this->db->from('category');
        $this->db->order_by('id','ASC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // select function
    function get_single_page($slug){
        $this->db->select();
        $this->db->from('pages');
        $this->db->where('slug', $slug);
        $this->db->order_by('id','ASC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // select function
    function get_banner_img($user_id){
        $this->db->select();
        $this->db->from('user_image');
        $this->db->where('md5(user_id)', $user_id);
        $this->db->where('status', 1);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }

    // select function
    function get_breadcrumb_img(){
        $this->db->select();
        $this->db->from('user_image');
        $this->db->where('status', 1);
        $this->db->where('is_featured', 1);
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    // total unseen notification
    public function my_total_unseen_notification(){
        $this->db->select('count(id) as total_unseen_noty');
        $this->db->from('notifications');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('seen', 0);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // total unseen reports
    public function count_unseen_reports(){
        $this->db->select('count(id) as total_reports');
        $this->db->from('report');
        $this->db->where('seen', 0);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // check reports
    public function check_img_report($id){
        $this->db->select('*');
        $this->db->from('report');
        $this->db->where('md5(img_id)', $id);
        $this->db->where('action_id', $this->session->userdata('id'));
        $query = $this->db->get();
        $query = $query->num_rows();
        return $query;
        
    }


    // make seen notification
    public function my_notifications_make_seen(){
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->update('notifications', array('seen' => 1));
    }



    // get all notifications
    function my_notifications(){
        $this->db->select('n.*');
        $this->db->select('u.first_name as name, u.thumb');
        $this->db->from('notifications as n');
        $this->db->join('user as u','u.id = n.action_id','LEFT');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('id','DESC');
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    // get all notifications with pagi
    function get_all_notofication($total, $limit, $offset){
        $this->db->select('n.*');
        $this->db->select('u.first_name as name, u.thumb');
        $this->db->from('notifications as n');
        $this->db->join('user as u','u.id = n.action_id','LEFT');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->order_by('id','DESC');
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result_array();
            return $query;
        }
    }

    // get single user info
    function get_settings(){
        $this->db->select();
        $this->db->from('settings');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // get ads
    function get_ads($id){
        $this->db->select();
        $this->db->from('google_ads');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    // update image download
    public function update_photo_download($id)
    {
        $this->db->where('md5(id)', $id);
        $this->db->set('download', 'download+1', FALSE);
        $this->db->update('user_image');
        return $this->db->affected_rows();
    }


    // get images by user
    function get_images_by_user($id, $total, $limit, $offset){
        $this->db->select('ui.*');
        $this->db->select('u.first_name as name');
        $this->db->from('user_image ui');
        $this->db->where('md5(ui.user_id)',$id);
        $this->db->where('ui.status',1);
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->order_by('ui.id','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }

    // get videos by user
    function get_videos_by_user($id, $total, $limit, $offset){
        $this->db->select('v.*');
        $this->db->select('u.first_name as name');
        $this->db->from('videos v');
        $this->db->where('md5(v.user_id)',$id);
        $this->db->join('user u', 'u.id = v.user_id', 'LEFT');
        $this->db->order_by('v.id','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }

    // get featured images
    function get_featured_photos($id, $total, $limit, $offset){
        $this->db->select('ui.*');
        $this->db->select('u.first_name as name');
        $this->db->from('user_image ui');
        $this->db->where('md5(ui.user_id)',$id);
        $this->db->where('ui.status',1);
        $this->db->where('ui.is_featured',1);
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->order_by('ui.id','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }

    // get featured images
    function get_pending_photos($id){
        $this->db->select('ui.*');
        $this->db->select('u.first_name as name');
        $this->db->from('user_image ui');
        $this->db->where('md5(ui.user_id)',$id);
        $this->db->where('ui.status',0);
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->order_by('ui.id','DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
        
    }


    // get featured images
    function check_last_upload_img($id){
        $this->db->select('ui.id');
        $this->db->from('user_image ui');
        $this->db->where('ui.user_id',$id);
        $this->db->where('ui.status',1);
        $this->db->where("DATE_FORMAT(ui.uploaded_at,'%Y-%m-%d')", my_date());
        $this->db->order_by('ui.id','DESC');
        $query = $this->db->get();
        $query = $query->num_rows();
        return $query;
        
    }


    // get collections by user
    function get_my_collection(){
        $this->db->select('c.*');
        $this->db->from('collections c');
        $this->db->where('c.user_id',$this->session->userdata('id'));
        $this->db->order_by('c.id','DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get images by user
    function get_image_total_info(){
        $this->db->select('u.*');
        $this->db->select('(SELECT count(user_image.id)
                            FROM user_image 
                            WHERE (status = 1)
                            )
                            AS images',TRUE);
        $this->db->select('(SELECT count(image_like.id)
                            FROM image_like
                            )
                            AS likes',TRUE);
        $this->db->select('(SELECT count(user.id)
                            FROM user 
                            WHERE (status = 1)
                            )
                            AS members',TRUE);
        $this->db->select('(SELECT count(download.id)
                            FROM download
                            )
                            AS downloads',TRUE);

        $this->db->from('user_image u');
        $this->db->where('u.status',1);
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    // get colleciton list by user
    function get_collection_list($id){
        $this->db->select();
        $this->db->select('(SELECT count(collection_image.id)
                            FROM collection_image 
                            WHERE (collection_image.collection_id = collections.id)
                            )
                            AS total',TRUE);
        $this->db->from('collections');
        $this->db->where('md5(user_id)', $id);
        if ($this->session->userdata('is_login') == FALSE) {
            $this->db->where('type', 1); 
        }
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $this->db->select();
            $this->db->select('u.id as img_id, u.image');
            $this->db->from('collection_image c');
            $this->db->join('user_image u', 'u.id = c.img_id', 'LEFT');
            $this->db->where('c.collection_id',$value['id']);
            $this->db->order_by('c.id','DESC');
            $this->db->limit(4);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['collection_img'] = $query2;
        }

        return $query;
    }

    // get colleciton by id
    function get_collections_by_id($id){
        $this->db->select('*');
        $this->db->select('u.id as img_id, u.image, u.is_featured, u.user_id as owner_id');
        $this->db->select('ur.first_name as name');
        $this->db->select('cl.title as coll_name');
        $this->db->from('collection_image c');
        $this->db->join('user_image u', 'u.id = c.img_id', 'LEFT');
        $this->db->join('user ur', 'ur.id = c.user_id', 'LEFT');
        $this->db->join('collections cl', 'cl.id = c.collection_id', 'LEFT');
        $this->db->where('c.collection_id', $id);
        $this->db->order_by('c.id','DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    // get download images by user
    function get_my_downloads($id, $total, $limit, $offset){
        $this->db->select('d.*');
        $this->db->select('u.first_name as name');
        $this->db->select('ui.id as img_id, ui.image, ui.view, ui.is_featured,ui.download');
        $this->db->from('download d');
        $this->db->where('md5(d.action_id)', $id);
        $this->db->join('user_image ui', 'ui.id = d.img_id', 'LEFT');
        $this->db->join('user u', 'u.id = d.action_id', 'LEFT');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }



    // get all colleciton list
    function get_all_collections(){
        $this->db->select('c.*');
        $this->db->select('u.first_name as user_name, u.thumb');
        $this->db->select('(SELECT count(collection_image.id)
                            FROM collection_image 
                            WHERE (collection_image.collection_id = c.id)
                            )
                            AS total',TRUE);
        $this->db->from('collections c');
        $this->db->join('user u', 'u.id = c.user_id', 'LEFT');
        $this->db->where('c.type', 1);

        $this->db->order_by('c.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $this->db->select();
            $this->db->select('u.id as img_id, u.image');
            $this->db->from('collection_image c');
            $this->db->join('user_image u', 'u.id = c.img_id', 'LEFT');
            $this->db->where('c.collection_id',$value['id']);
            $this->db->order_by('c.id','DESC');
            $this->db->limit(4);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['collection_img'] = $query2;
        }

        return $query;
    }


    // get all tags
    function get_all_tags(){
        $this->db->select('t.*');
        $this->db->select('count(u.id) as total_photos');
        $this->db->from('tags t');
        $this->db->join('user_image u', 'u.id = t.img_id', 'LEFT');
        $this->db->group_by('t.tag');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get all tags
    function get_images_by_tag($slug){
        $this->db->select('t.*');
        $this->db->select('u.id as img_id, u.image, u.user_id, u.is_featured, u.view');
        $this->db->select('ur.first_name as name');
        $this->db->from('tags t');
        $this->db->join('user_image u', 'u.id = t.img_id', 'LEFT');
        $this->db->join('user ur', 'ur.id = u.user_id', 'LEFT');
        $this->db->where('t.tag_slug', $slug);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get all images
    function get_all_images($total, $limit, $offset){
        $this->db->select('ui.*');
        $this->db->select('u.first_name as name');
        $this->db->select('c.id as category_id, c.name as category');
        $this->db->from('user_image ui');
        
        if (isset($_GET['sort']) && $_GET['sort'] == 'view') {
            $this->db->order_by('ui.view', 'DESC');
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'download' ) {
           $this->db->order_by('ui.download', 'DESC');
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'featured') {
            $this->db->where('ui.is_featured', 1);
        }
        if (isset($_GET['category']) && $_GET['category'] != 0 ) {
            $this->db->where('ui.category', $_GET['category']);
        }
        if (isset($_GET['featured']) && $_GET['featured'] == 1 ) {
            $this->db->where('ui.is_featured', $_GET['featured']);
        }

        if (isset($_GET['search']) && $_GET['search'] != '' ) {
            $this->db->like('ui.title', $_GET['search']);
            $this->db->or_like('ui.image_name', $_GET['search']);
        }

        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->where('ui.status',1);
        $this->db->order_by('ui.id','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
        
        
    }


    // get all images
    function get_all_videos($total, $limit, $offset){
        $this->db->select('v.*');
        $this->db->select('u.first_name as name');
        $this->db->from('videos v');
        $this->db->join('user u', 'u.id = v.user_id', 'LEFT');
        $this->db->where('v.status', 1);
        $this->db->order_by('v.id','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
        
    }


    //get images by category
    function get_category_images(){
        $this->db->select('ui.id, ui.category');
        $this->db->select('(SELECT count(user_image.id)
                            FROM user_image 
                            WHERE (user_image.category = c.id)
                            )
                            AS total',TRUE);
        $this->db->select('c.id as category_id, c.name as category, c.slug');
        $this->db->from('user_image ui');
        $this->db->where('ui.status', 1);
        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
        $this->db->order_by('total','DESC');
        $this->db->group_by('ui.category');
        $query = $this->db->get();
        $query = $query->result_array();

        foreach ($query as $key => $value) {
            $this->db->select();
            $this->db->from('user_image');
            $this->db->where('category',$value['category_id']);
            $this->db->where('status',1);
            $this->db->order_by('id','DESC');
            $this->db->limit(4);
            $query2 = $this->db->get();
            $query2 = $query2->result_array();
            $query[$key]['category_img'] = $query2;
        }
        return $query;
    }




    // get images by category id
    function get_images_by_category($slug, $total, $limit, $offset){
        $this->db->select('ui.*');
        $this->db->select('(SELECT count(image_like.id)
                            FROM image_like 
                            WHERE (image_like.img_id = ui.id)
                            )
                            AS total_like',TRUE);
        $this->db->select('u.thumb as user_img, u.first_name as name');
        $this->db->select('c.id as category_id, c.name as category, c.slug');
        $this->db->from('user_image ui');
        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->where('ui.status',1);
        $this->db->where('c.slug',$slug);
        $this->db->order_by('ui.id','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();
            return $query;
        }
    }


    // get images by category
    function get_home_images(){
        $this->db->select('ui.*');
        $this->db->select('(SELECT count(image_like.id)
                            FROM image_like 
                            WHERE (image_like.img_id = ui.id)
                            )
                            AS total_like',TRUE);
        $this->db->select('u.thumb as user_img, u.first_name as name');
        $this->db->select('c.id as category_id, c.name as category');
        $this->db->from('user_image ui');
        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->where('ui.status',1);
        $this->db->order_by('ui.id','DESC');
        $this->db->limit(18);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    // get image comments
    function get_image_comment($id)
    {
        $this->db->select('c.*');
        $this->db->select('u.thumb, u.first_name as name');
        $this->db->from('comment c');
        $this->db->limit(5);
        $this->db->join('user u', 'u.id = c.user_id','LEFT');
        $this->db->where('md5(c.img_id)', $id);
        $this->db->order_by('c.id', 'DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    //get comments by img
    public function get_comments_by_img($limit, $img_id)
    {   
        $this->db->select('c.*');
        $this->db->select('u.thumb, u.first_name as name');
        $this->db->from('comment c');
        $this->db->where('md5(c.img_id)', $img_id);
        $this->db->join('user u', 'u.id = c.user_id','LEFT');
        $this->db->order_by('c.id', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    //check image like
    function check_my_like($img_id)
    {
        $this->db->select();
        $this->db->from('image_like');
        $this->db->where('action_id', $this->session->userdata('id'));
        $this->db->where('md5(img_id)', $img_id);
        $this->db->limit(1);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    //count like
    function count_image_like($img_id)
    {
        $this->db->select('count(id) as total');
        $this->db->from('image_like');
        $this->db->where('md5(img_id)', $img_id);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //check collection
    function check_my_collection($img_id)
    {
        $this->db->select();
        $this->db->from('collection_image');
        $this->db->where('user_id', $this->session->userdata('id'));
        $this->db->where('md5(img_id)', $img_id);
        $this->db->limit(1);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    //count collection
    function count_image_collection($img_id)
    {
        $this->db->select('count(id) as total');
        $this->db->from('collection_image');
        $this->db->where('md5(img_id)', $img_id);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //get users with communicated
    public function mgs_with(){

        $user_id = $this->session->userdata('id');

        $this->db->select('sq.profile_id as id');
        $this->db->select('sq.profile_name as name');
        $this->db->select('sq.thumb');
        $this->db->select('sq.mgs_time');
        $this->db->select('n.message');

        $this->db->from('message as n');
        $this->db->from(" 

            (SELECT 
                u.id AS profile_id,
                u.first_name AS profile_name,
                u.thumb AS thumb,
                MAX(m.mgs_time) AS mgs_time 
                FROM
                message AS m,
                user AS u 
                WHERE 
                CASE
                WHEN m.mgs_from = '$user_id' 
                THEN m.mgs_to = u.id 
                WHEN m.mgs_to = '$user_id' 
                THEN m.mgs_from = u.id 
                END 
                GROUP BY u.id) AS sq 

            ");

        $this->db->where("


            sq.mgs_time = n.mgs_time 
            AND 
            CASE
            WHEN n.mgs_from = '$user_id' 
            THEN n.mgs_to = sq.profile_id 
            WHEN n.mgs_to = '$user_id' 
            THEN n.mgs_from = sq.profile_id 
            END 


            ");

        $this->db->order_by('sq.mgs_time','DESC');
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    //get message details
    public function mgs_with_details($mgs_with){

        $user_id = md5($this->session->userdata('id'));

        $this->db->select('m.*');
        $this->db->select('u.first_name');
        $this->db->select('u.thumb');
        $this->db->from('message as m');
        $this->db->join('user as u','u.id = m.mgs_from','RIGHT');


        $this->db->group_start();
        $this->db->where('md5(m.mgs_from)',$mgs_with);
        $this->db->or_where('md5(m.mgs_from)',$user_id);
        $this->db->group_end();  


        $this->db->group_start();
        $this->db->where('md5(m.mgs_to)',$user_id);
        $this->db->or_where('md5(m.mgs_to)',$mgs_with);
        $this->db->group_end();  


        $this->db->order_by('m.id','ASC');
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    
    function get_user_id_md5($u_md5_id){
        $this->db->select();
        $this->db->from('user');
        $this->db->where('md5(id)', $u_md5_id);
        $this->db->limit(1);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }



    // get single image
    function get_single_img($id)
    {
        $this->db->select('ui.*');
        $this->db->select('u.id as user_id, u.thumb as user_img, u.first_name as uploader_name, u.total_photos, u.total_view, u.download as user_download, u.total_like');
        $this->db->select('c.id as category_id, c.name as category');
        $this->db->from('user_image ui');
        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->where('md5(ui.id)',$id);
        $this->db->limit(1);
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    // get related image
    function get_related_img($id, $category_id)
    {
        $this->db->select('ui.*');
        $this->db->select('u.thumb as user_img, u.first_name as name');
        $this->db->select('c.id as category_id, c.name as category');
        $this->db->from('user_image ui');
        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->where('md5(ui.id) !=',$id);
        $this->db->where('c.id',$category_id);
        $this->db->where('ui.status',1);
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }


    //increase image hit
    public function increase_image_view($id)
    {
        //get image info
        $img = $this->get_image($id);
        $user = $this->get_by_id($img->user_id, 'user');
        $view = $this->get_user_total_view($img->user_id);

        if (!empty($img)):
            if (get_cookie('var_post' . $id) != 1) {
                
                //set cookies
                set_cookie('var_post'. $id, '1', 86400);
                $data = array(
                    'view' => $img->view + 1
                );
                $this->db->where('md5(id)', $id);
                $this->db->update('user_image', $data);

                //increase user total view
                $viewdata = array(
                    'total_view' => $view->total
                );
                $this->db->where('id', $img->user_id);
                $this->db->update('user', $viewdata);
                
            }
        endif;
    }


    //get image
    public function get_image($id)
    {
        $this->db->where('md5(user_image.id)', $id);
        $query = $this->db->get('user_image');
        return $query->row();
    }



    // get_all_photographers
    function get_all_members($total, $limit, $offset){
        
        $this->db->select('u.*');
        $this->db->from('user u');
        if (isset($_GET['sort']) && $_GET['sort'] == 'like') {
            $this->db->order_by('u.total_like', 'DESC');
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'photos') {
            $this->db->order_by('u.total_photos', 'DESC');
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'download' ) {
           $this->db->order_by('u.download', 'DESC');
        }
    
        if (isset($_GET['country']) && $_GET['country'] != 0 ) {
           $this->db->where('u.country', $_GET['country']);
        }

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $this->db->like('u.first_name', $_GET['search']);
            $this->db->or_like('u.id', $_GET['search']);
        }
        $this->db->where('u.status', 1);
        $this->db->order_by('u.total_photos','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();  
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();  
            return $query;
        }
    }

    // get_all_followers
    function get_all_followers($id, $total, $limit, $offset){
        $this->db->select('f.*');
        $this->db->select('u.id as user_id,u.first_name, u.thumb, u.total_like, u.total_photos, u.download');
        $this->db->from('follower f');
        $this->db->join('user u', 'u.id = f.action_id', 'LEFT');
        $this->db->where('f.status', 1);
        $this->db->where('md5(f.follower_id)', $id);
        $this->db->order_by('f.id','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();  
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();  
            return $query;
        }
    }

    // get all following
    function get_all_following($id, $total, $limit, $offset){
        $this->db->select('f.*');
        $this->db->select('u.id as user_id,u.first_name, u.thumb, u.total_like, u.total_photos, u.download');
        $this->db->from('follower f');
        $this->db->join('user u', 'u.id = f.follower_id', 'LEFT');
        $this->db->where('f.status', 1);
        $this->db->where('md5(f.action_id)', $id);
        $this->db->order_by('f.id','DESC');
        if ($total == 1) {
            $query = $this->db->get();
            $query = $query->num_rows();  
            return $query;
        } else {
            $query = $this->db->get('', $limit, $offset);
            $query = $query->result();  
            return $query;
        }
    }

   

    // get all user list
    function get_all_user(){
        $this->db->select('u.*');
        $this->db->select('c.name as country, c.id as country_id');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->where('u.user_type',2);
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }


    // get single user info
    function get_my_info($id){
        $this->db->select('u.*');
        $this->db->select('c.name as country');
        $this->db->from('user u');
        $this->db->join('country c','c.id = u.country','LEFT');
        $this->db->where('md5(u.id)', $id);
        $this->db->order_by('u.id','DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    // count user collections
    function count_user_collections($id){
        $this->db->select();
        $this->db->from('collections');
        $this->db->where('md5(user_id)', $id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // count user collections
    function count_user_downloads($id){
        $this->db->select();
        $this->db->from('download');
        $this->db->where('md5(action_id)', $id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // count user pending photos
    function count_pending_photos($id){
        $this->db->select();
        $this->db->from('user_image');
        $this->db->where('status', 0);
        $this->db->where('md5(user_id)', $id);
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    // count total followers
    function count_total_followers($id, $type){
        $this->db->select('f.*');
        $this->db->from('follower f');
        $this->db->where('f.status', 1);
        if ($type == 1) {
            $this->db->where('md5(f.follower_id)', $id);
        } else {
            $this->db->where('md5(f.action_id)', $id);
        }
        $this->db->order_by('f.id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }

    //count user total photos
    public function user_total_photos_count($id){
        $this->db->select('count(ui.id) as total');
        $this->db->from('user_image as ui');
        $this->db->where('ui.user_id',$id);
        $this->db->where('ui.status',1);
        $query = $this->db->get();
        $query = $query->row(); 
        return $query;
    }

    //count user total videos
    public function user_total_videos_count($id){
        $this->db->select('count(v.id) as total');
        $this->db->from('videos as v');
        $this->db->where('v.user_id',$id);
        $this->db->where('v.status',1);
        $query = $this->db->get();
        $query = $query->row(); 
        return $query;
    }

    //count user total like
    public function user_total_like_count($id){
        $this->db->select('count(li.id) as total');
        $this->db->from('image_like as li');
        $this->db->join('user_image as ui','ui.id = li.img_id','LEFT');
        $this->db->where('ui.user_id',$id);
        $query = $this->db->get();
        $query = $query->row(); 
        return $query;
    }

    //count user total download
    public function user_total_download_count($id){
        $this->db->select('count(d.id) as total');
        $this->db->from('download d');
        $this->db->where('d.user_id',$id);
        $query = $this->db->get();
        $query = $query->row(); 
        return $query;
    }

    //count user total image view
    public function get_user_total_view($id){
        $this->db->select('sum(ui.view) as total');
        $this->db->from('user_image as ui');
        $this->db->where('ui.user_id',$id);
        $query = $this->db->get();
        $query = $query->row(); 
        return $query;
    }

    

    // count active, inactive and total user
    function get_user_total(){
        $this->db->select('*');
        $this->db->select('count(*) as total');
        $this->db->select('(SELECT count(user.id)
                            FROM user 
                            WHERE (user.status = 1)
                            )
                            AS active_user',TRUE);

        $this->db->select('(SELECT count(user.id)
                            FROM user 
                            WHERE (user.status = 0)
                            )
                            AS inactive_user',TRUE);

        $this->db->from('user');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //check follower

    function check_follower($id){
        $this->db->select();
        $this->db->from('follower');
        $this->db->where('action_id', $this->session->userdata('id'));
        $this->db->where('follower_id', $id);
        $this->db->limit(1);
        $this->db->query('SET SQL_BIG_SELECTS=1'); 
        $query = $this->db->get();
        if($query->num_rows() == 1) {                 
            return $query->result();
        }else{
            return 0;
        }
    }





    // image upload function with resize option
    function upload_image($max_size){
            
            // set upload path
            $config['upload_path']  = "./assets/uploads/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                // set upload path
                $source             = "./assets/uploads/".$data['file_name'] ;
                $destination_thumb  = "./assets/uploads/thumbnail/" ;
                $destination_medium = "./assets/uploads/medium/" ;
                $main_img = $data['file_name'];
                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_medium   = $max_size ;
                $limit_thumb    = 200 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
                    $percent_medium = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = ' 100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                ////// Making MEDIUM /////////////
                $img['width']   = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '100%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                // set upload path
                $images = 'assets/uploads/medium/'.$mid;
                $thumb  = 'assets/uploads/thumbnail/'.$thumb_nail;
                unlink($source) ;

                return array(
                    'images' => $images,
                    'thumb' => $thumb
                );
            }
            else {
                echo "Failed! to upload image" ;
            }
            
    }

}