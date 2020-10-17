<?php
class Admin_model extends CI_Model {

    //-- insert function
	public function insert($data,$table){
        $this->db->insert($table,$data);        
        return $this->db->insert_id();
    }

    //-- edit function
    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    } 

    //-- edit function
    function edit_option_md5($action, $id, $table){
        $this->db->where('md5(id)', $id);
        $this->db->update($table,$action);
        return;
    } 

    //-- update function
    function update($action,$id,$table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
    }

    //-- delete function
    function delete($id,$table){
        $this->db->delete($table, array('id' => $id));
        return;
    }

    // delete tags
    function delete_rejected_photos(){
        $this->db->delete('user_image', array('status' => 2));
        return;
    }

    // delete tags
    function delete_tags($img_id, $table){
        $this->db->delete($table, array('img_id' => $img_id));
        return;
    }

  

    //-- get function
    function get($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }

    //-- select function
    function select($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    }

    //-- select function
    function get_data($table){
        $this->db->select();
        $this->db->from($table);
        $this->db->order_by('id','DESC');
        $query = $this->db->get();
        $query = $query->result();  
        return $query;
    }


    //-- select by id
    function select_option($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->result_array();  
        return $query;
    } 

    //-- select by id
    function get_by_id($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 

    //-- select by id
    function select_option_md5($id,$table){
        $this->db->select();
        $this->db->from($table);
        $this->db->where(md5('id'), $id);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    } 


    //-- get admin
    function check_user(){
        $this->db->select();
        $this->db->from('user');
        $this->db->where('type', 1);
        $query = $this->db->get();
        $query = $query->row();  
        return $query;
    }


    //-- update image download
    public function update_photo_download($id)
    {
        $this->db->where('md5(id)', $id);
        $this->db->set('download', 'download+1', FALSE);
        $this->db->update('user_image');
        return $this->db->affected_rows();
    }

    //-- update video download
    public function update_video_download($id)
    {
        $this->db->where('md5(id)', $id);
        $this->db->set('download', 'download+1', FALSE);
        $this->db->update('videos');
        return $this->db->affected_rows();
    }


    //get image reports
    function get_rejected_img_ids(){
        
        $this->db->select();
        $this->db->from('user_image');
        $this->db->where('status', 2);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    
    //get image reports
    function get_all_reports($total, $limit, $offset){
        
        $this->db->select('r.*');
        $this->db->select('u.first_name as reporter');
        $this->db->select('ui.thumb');
        $this->db->from('report r');
        $this->db->join('user_image ui', 'ui.id = r.img_id', 'LEFT');
        $this->db->join('user u', 'u.id = r.action_id', 'LEFT');
        $this->db->order_by('r.id','DESC');
        
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

    //-- make seen reports
    public function make_reports_seen(){
        $this->db->update('report', array('seen' => 1));
    }


    //-- get images by user
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
        if (isset($_GET['sort']) && $_GET['sort'] == 'active' ) {
            $this->db->where('u.status', 1);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'suspend' ) {
            $this->db->where('u.status', 2);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'pending' ) {
            $this->db->where('u.status', 0);
            $this->db->where('u.email_validation', 0);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'id' ) {
            $this->db->order_by('u.id','ASC');
        }

        if (isset($_GET['country']) && $_GET['country'] != 0 ) {
           $this->db->where('u.country', $_GET['country']);
        }

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $this->db->like('u.first_name', $_GET['search']);
            $this->db->or_like('u.id', $_GET['search']);
        }


        $this->db->order_by('u.id','DESC');
        $this->db->query('SET SQL_BIG_SELECTS=1');
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

    //get all photos
    function get_all_images($total, $limit, $offset){
        
        $this->db->select('ui.*');
        $this->db->select('(SELECT count(image_like.id)
                            FROM image_like 
                            WHERE (image_like.img_id = ui.id)
                            )
                            AS total_like',TRUE);
        $this->db->select('c.id as category_id, c.name as category');
        $this->db->select('u.first_name as user_name');
        $this->db->from('user_image ui');
        $this->db->where('ui.status !=', 0);
        
        if (isset($_GET['sort']) && $_GET['sort'] == 'view') {
            $this->db->order_by('ui.view', 'DESC');
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'download' ) {
           $this->db->order_by('ui.download', 'DESC');
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'featured') {
            $this->db->where('ui.is_featured', 1);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'active' ) {
            $this->db->where('ui.status', 1);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'suspend' ) {
            $this->db->where('ui.status', 2);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'id' ) {
            $this->db->order_by('ui.id','ASC');
        }

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $this->db->like('ui.title', $_GET['search']);
            $this->db->or_like('ui.id', $_GET['search']);
            $this->db->or_like('u.first_name', $_GET['search']);
        }

        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
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
        echo "<pre>"; print_r($query); exit();
        
    }

    //get all videos
    function get_all_videos($total, $limit, $offset){
        $this->db->select('v.*');
        $this->db->select('u.first_name as name');
        $this->db->from('videos v');
        $this->db->join('user u', 'u.id = v.user_id', 'LEFT');
        $this->db->where('v.status', 1);

        // if (isset($_GET['sort']) && $_GET['sort'] == 'view') {
        //     $this->db->order_by('ui.view', 'DESC');
        // }
        // if (isset($_GET['sort']) && $_GET['sort'] == 'download' ) {
        //    $this->db->order_by('ui.download', 'DESC');
        // }
        if (isset($_GET['sort']) && $_GET['sort'] == 'featured') {
            $this->db->where('v.is_featured', 1);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'active' ) {
            $this->db->where('v.status', 1);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'suspend' ) {
            $this->db->where('v.status', 2);
        }
        if (isset($_GET['sort']) && $_GET['sort'] == 'id' ) {
            $this->db->order_by('v.id','ASC');
        }

        if (isset($_GET['search']) && $_GET['search'] != '') {
            $this->db->like('v.title', $_GET['search']);
            $this->db->or_like('v.id', $_GET['search']);
        }

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


    function get_pending_videos(){
        $this->db->select('v.*');
        $this->db->select('u.first_name as name');
        $this->db->from('videos v');
        $this->db->join('user u', 'u.id = v.user_id', 'LEFT');
        $this->db->where('v.status', 0);

        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get pending photos
    function get_pending_images(){
        $this->db->select('ui.*');
        $this->db->select('c.id as category_id, c.name as category');
        $this->db->select('u.first_name as uname');
        $this->db->from('user_image ui');
        $this->db->where('ui.status', 0);
        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->order_by('ui.id','DESC');
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //get latest members
    function get_latest_members(){
        $this->db->select('u.*');
        $this->db->select('c.name as country');
        $this->db->from('user u');
        $this->db->join('country c', 'c.id = u.country', 'LEFT');
        $this->db->where('u.status', 1);
        $this->db->order_by('u.id','DESC');
        $this->db->limit(7);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //-- get all images
    function get_latest_images(){
        $this->db->select('ui.*');
        $this->db->select('c.id as category_id, c.name as category');
        $this->db->select('u.first_name as user_name');
        $this->db->from('user_image ui');
        $this->db->join('category c', 'c.id = ui.category', 'LEFT');
        $this->db->join('user u', 'u.id = ui.user_id', 'LEFT');
        $this->db->where('ui.status', 1);
        $this->db->order_by('ui.id','DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    function get_latest_photos(){
        $this->db->select();
        $this->db->from('user_image');
        $this->db->where('status', 1);
        $this->db->order_by('id','DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    function get_pending_photos(){
        $this->db->select();
        $this->db->from('user_image');
        $this->db->where('status', 0);
        $this->db->order_by('id','DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        $query = $query->result();
        return $query;
    }

    //-- get images by user
    function get_image_total_info(){
        $this->db->select('u.*');
        $this->db->select('(SELECT count(user_image.id)
                            FROM user_image 
                            WHERE (status = 1)
                            )
                            AS images',TRUE);
        $this->db->select('(SELECT count(user_image.id)
                            FROM user_image 
                            WHERE (status = 0)
                            )
                            AS pending',TRUE);
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
        $this->db->select('(SELECT sum(user_image.view)
                            FROM user_image
                            )
                            AS view',TRUE);

        $this->db->from('user_image u');
        $query = $this->db->get();
        $query = $query->row();
        return $query;
    }


    //-- single image upload with resize option
    function upload_image($max_size){
            
            //-- set upload path
            $config['upload_path']  = "./assets/uploads/";
            $config['allowed_types']= 'gif|jpg|png|jpeg';
            $config['max_size']     = '92000';
            $config['max_width']    = '92000';
            $config['max_height']   = '92000';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload("photo")) {

                
                $data = $this->upload->data();

                //-- set upload path
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

                //-- set upload path
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

    //multiple image upload with resize option
    public function do_upload($photo) {                   
        $config['upload_path']  = "./assets/uploads/";
        $config['allowed_types']= 'gif|jpg|png|jpeg';
        $config['max_size']     = '20000';
        $config['max_width']    = '20000';
        $config['max_height']   = '20000';
 
        $this->load->library('upload', $config);                
        
            if ($this->upload->do_upload($photo)) {
                $data       = $this->upload->data(); 
                /* PATH */
                $source             = "./assets/uploads/".$data['file_name'] ;
                $destination_thumb  = "./assets/uploads/thumbnail/" ;
                $destination_medium = "./assets/img/program/medium/" ;
                $destination_big    = "./assets/uploads/big/" ;

                // Permission Configuration
                chmod($source, 0777) ;

                /* Resizing Processing */
                // Configuration Of Image Manipulation :: Static
                $this->load->library('image_lib') ;
                $img['image_library'] = 'GD2';
                $img['create_thumb']  = TRUE;
                $img['maintain_ratio']= TRUE;

                /// Limit Width Resize
                $limit_big   = 1000 ;
                $limit_medium    = 400 ;
                $limit_thumb    = 250 ;

                // Size Image Limit was using (LIMIT TOP)
                $limit_use  = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'] ;

                // Percentase Resize
                if ($limit_use > $limit_big || $limit_use > $limit_thumb || $limit_use > $limit_medium) {
                    $percent_big = $limit_big/$limit_use ;
                    $percent_medium  = $limit_medium/$limit_use ;
                    $percent_thumb  = $limit_thumb/$limit_use ;
                }

                //// Making THUMBNAIL ///////
                $img['width']  = $limit_use > $limit_thumb ?  $data['image_width'] * $percent_thumb : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_thumb ?  $data['image_height'] * $percent_thumb : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_thumb-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_thumb ;

                $thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;                 

                //// Making MEDIUM ///////
                $img['width']  = $limit_use > $limit_medium ?  $data['image_width'] * $percent_medium : $data['image_width'] ;
                $img['height'] = $limit_use > $limit_medium ?  $data['image_height'] * $percent_medium : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_medium-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_medium ;

                $medium = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;               

                ////// Making BIG /////////////
                $img['width']   = $limit_use > $limit_big ?  $data['image_width'] * $percent_big : $data['image_width'] ;
                $img['height']  = $limit_use > $limit_big ?  $data['image_height'] * $percent_big : $data['image_height'] ;

                // Configuration Of Image Manipulation :: Dynamic
                $img['thumb_marker'] = '_big-'.floor($img['width']).'x'.floor($img['height']) ;
                $img['quality']      = '99%' ;
                $img['source_image'] = $source ;
                $img['new_image']    = $destination_big ;

                $album_picture = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];
                // Do Resizing
                $this->image_lib->initialize($img);
                $this->image_lib->resize();
                $this->image_lib->clear() ;

                $data_image = array(
                    'thumb' => 'assets/uploads/thumbnail/'.$thumb_nail,
                    'medium' => 'assets/uploads/medium/'.$medium,
                    'img' => 'assets/uploads/big/'.$album_picture
                );

                unlink($source) ;   
                return $data_image;   
    
            }
            else {
                return FALSE ;
            }
       
    }

}