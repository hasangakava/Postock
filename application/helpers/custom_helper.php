<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	
	//-- check logged user
	if (!function_exists('check_login_user')) {
	    function check_login_user() {
	        $ci = get_instance();
	        if ($ci->session->userdata('is_login') != TRUE) {
	            $ci->session->sess_destroy();
	            redirect(base_url('auth'));
	        }
	    }
	}

	//-- check logged user
	if (!function_exists('check_admin_login')) {
	    function check_admin_login() {
	        $ci = get_instance();
	        if ($ci->session->userdata('admin_login') != TRUE) {
	            $ci->session->sess_destroy();
	            redirect(base_url('admin/auth'));
	        }
	    }
	}

	//-- current date time function
	if(!function_exists('my_date_now')){
	    function my_date_now(){        
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = $dt->format('Y-m-d H:i:s');      
	        return $date_time;
	    }
	}

	//-- current date time function
	if(!function_exists('my_date')){
	    function my_date(){        
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = $dt->format('Y-m-d');      
	        return $date_time;
	    }
	}

	//-- show current date & time with custom format
	if(!function_exists('my_date_show_time')){
	    function my_date_show_time($date){       
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y h:i A");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}


	if(!function_exists('get_user_id_md5')){
    function get_user_id_md5($u_md5_id){        
        $ci = get_instance();
        
        $ci->load->model('common_model');
        $option = $ci->common_model->get_user_id_md5($u_md5_id);        
        
        return $option['0']['id'];        
        
    }
}


	//-- show current date with custom format
	if(!function_exists('my_date_show')){
	    function my_date_show($date){       
	        
	        if($date != ''){
	            $date2 = date_create($date);
	            $date_new = date_format($date2,"d M Y");
	            return $date_new;
	        }else{
	            return '';
	        }
	    }
	}

	//-- date difference
	if(!function_exists('date_difference')){
	    function date_difference($date1,$date2){  

	        $datetime1 = date_create($date1);
	        $datetime2 = date_create($date2);
	        $interval = date_diff($datetime1, $datetime2);
	        return $interval->format('%a');
	    }
	}


	if(!function_exists('my_total_unseen_notification')){
	    function my_total_unseen_notification(){         
	        $ci = get_instance();        
	        $ci->load->model('common_model');
	        $noty = $ci->common_model->my_total_unseen_notification();

	        return $noty->total_unseen_noty;
	    }
	}

	if(!function_exists('count_unseen_reports')){
	    function count_unseen_reports(){         
	        $ci = get_instance();        
	        $ci->load->model('common_model');
	        $noty = $ci->common_model->count_unseen_reports();

	        return $noty->total_reports;
	    }
	}

   //-- count user collections
  	if(!function_exists('count_user_collections')){
	    function count_user_collections($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->count_user_collections($id);        
	        
	        return count($option);
	    }
    } 

    //-- count user downloads
  	if(!function_exists('count_user_downloads')){
	    function count_user_downloads($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->count_user_downloads($id);        
	        
	        return count($option);
	    }
    } 

    //-- count user pending photos
  	if(!function_exists('count_pending_photos')){
	    function count_pending_photos($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->count_pending_photos($id);        
	        
	        return count($option);
	    }
    } 

    //-- count followers
  	if(!function_exists('count_total_followers')){
	    function count_total_followers($id, $type){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->count_total_followers($id, $type);        
	        
	        return count($option);
	    }
    } 

    //-- insert notification
    if(!function_exists('notify_this')){
	    function notify_this($data){         
	        $ci = get_instance();        
	        $ci->load->model('common_model');

	        $ci->common_model->insert($data,'notifications');
	    }
	}

    //-- get user info
  	if(!function_exists('get_my_info')){
	    function get_my_info($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->get_my_info($id);        
	        
	        return $option;
	    }
    } 


    //-- get categories
  	if(!function_exists('get_categories')){
	    function get_categories(){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->get_categories();        
	        
	        return $option;
	    }
    } 

    //-- get pages
  	if(!function_exists('get_pages')){
	    function get_pages(){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->select('pages');        
	        
	        return $option;
	    }
    } 

    //-- get banner image
  	if(!function_exists('get_banner_img')){
	    function get_banner_img($user_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->get_banner_img($user_id);        
	        
	        return $option;
	    }
    } 

    //-- get breadcrumb image
  	if(!function_exists('get_breadcrumb_img')){
	    function get_breadcrumb_img(){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->get_breadcrumb_img();        
	        
	        return $option;
	    }
    } 

    //-- get breadcrumb image
  	if(!function_exists('get_home_banner_img')){
	    function get_home_banner_img(){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->get_breadcrumb_img();        
	        
	        return $option;
	    }
    } 


    //-- get settings
  	if(!function_exists('get_settings')){
	    function get_settings(){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->get_settings();        
	        
	        return $option;
	    }
    } 

    //-- get settings
  	if(!function_exists('get_ads')){
	    function get_ads($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->get_ads($id);        
	        
	        return $option;
	    }
    } 


    //-- check follower
    if(!function_exists('check_follower')){
	    function check_follower($id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->check_follower($id);        
	        return $option;  
	    }
	}

	//-- check like status
    if(!function_exists('check_my_like')){
	    function check_my_like($img_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->check_my_like($img_id);        
	        return count($option);  
	    }
	}

	//-- count image likes
    if(!function_exists('count_image_like')){
	    function count_image_like($img_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->count_image_like($img_id);        
	        return $option;  
	    }
	}

	//-- check favourite status
    if(!function_exists('check_my_collection')){
	    function check_my_collection($img_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->check_my_collection($img_id);        
	        return count($option);  
	    }
	}

	//-- count image favourites
    if(!function_exists('count_image_collection')){
	    function count_image_collection($img_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->count_image_collection($img_id);        
	        return $option;  
	    }
	}



	if(!function_exists('user_total_photos_count')){
	    function user_total_photos_count($user_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->user_total_photos_count($user_id);
	        $data = array(
	            'total_photos' => $option->total
	        );
	        $data = $ci->security->xss_clean($data);
	        $ci->common_model->edit_option($data, $user_id, 'user');
	    
	    }
	}

	if(!function_exists('user_total_videos_count')){
	    function user_total_videos_count($user_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->user_total_videos_count($user_id);
	        $data = array(
	            'total_videos' => $option->total
	        );
	        $data = $ci->security->xss_clean($data);
	        $ci->common_model->edit_option($data, $user_id, 'user');
	    
	    }
	}
	

	if(!function_exists('user_total_like_count')){
	    function user_total_like_count($user_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->user_total_like_count($user_id);
	        //echo "<pre>"; print_r($option); exit();
	        $data = array(
	            'total_like' => $option->total
	        );
	        $data = $ci->security->xss_clean($data);
	        $ci->common_model->edit_option($data, $user_id, 'user');
	    
	    }
	}

	if(!function_exists('user_total_download_count')){
	    function user_total_download_count($user_id){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->user_total_download_count($user_id);

	        $data = array(
	            'download' => $option->total
	        );
	        $data = $ci->security->xss_clean($data);
	        $ci->common_model->edit_option($data, $user_id, 'user');
	    
	    }
	}






	//-- get collection
    if(!function_exists('get_my_collection')){
	    function get_my_collection(){        
	        $ci = get_instance();
	        
	        $ci->load->model('common_model');
	        $option = $ci->common_model->get_my_collection();        
	        return $option;  
	    }
	}



    if(!function_exists('get_time_ago')){
	    function get_time_ago($time_ago){        
	        $ci = get_instance();
	        
	        $dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
	        $date_time = strtotime($dt->format('Y-m-d H:i:s')); 

	        $time_ago = strtotime($time_ago);
	        $cur_time   = $date_time;
	        $time_elapsed   = $cur_time - $time_ago;
	        $seconds    = $time_elapsed ;
	        $minutes    = round($time_elapsed / 60 );
	        $hours      = round($time_elapsed / 3600);
	        $days       = round($time_elapsed / 86400 );
	        $weeks      = round($time_elapsed / 604800);
	        $months     = round($time_elapsed / 2600640 );
	        $years      = round($time_elapsed / 31207680 );
	        // Seconds

	        //return $seconds;

	        if($seconds <= 60){
	            return "just now";
	        }
	        //Minutes
	        else if($minutes <=60){
	            if($minutes==1){
	                return "one minute ago";
	            }
	            else{
	                return "$minutes minutes ago";
	            }
	        }
	        //Hours
	        else if($hours <=24){
	            if($hours==1){
	                return "an hour ago";
	            }else{
	                return "$hours hrs ago";
	            }
	        }
	        //Days
	        else if($days <= 7){
	            if($days==1){
	                return "yesterday";
	            }else{
	                return "$days days ago";
	            }
	        }
	        //Weeks
	        else if($weeks <= 4.3){
	            if($weeks==1){
	                return "a week ago";
	            }else{
	                return "$weeks weeks ago";
	            }
	        }
	        //Months
	        else if($months <=12){
	            if($months==1){
	                return "a month ago";
	            }else{
	                return "$months months ago";
	            }
	        }
	        //Years
	        else{
	            if($years==1){
	                return "one year ago";
	            }else{
	                return "$years years ago";
	            }
	        }


	        
	    }
	}


	//-- flying image cropper
	if(!function_exists('resize_img')){
	    function resize_img($fullname, $width, $height){         
  
        	$dir = 'assets/uploads/medium/';
        	$url = base_url() . 'assets/uploads/medium/';
	        
	        
	        // Get the CodeIgniter super object
	        $CI = &get_instance();
	        // get src file's extension and file name
	        $extension = pathinfo($fullname, PATHINFO_EXTENSION);
	        $filename = pathinfo($fullname, PATHINFO_FILENAME);
	        $image_org = $dir . $filename . "." . $extension;
	        $image_thumb = $dir . $filename . "-" . $height . '_' . $width . "." . $extension;
	        $image_returned = $url . $filename . "-" . $height . '_' . $width . "." . $extension;

	        if (!file_exists($image_thumb)) {
	            // LOAD LIBRARY
	            $CI->load->library('image_lib');
	            // CONFIGURE IMAGE LIBRARY
	            $config['source_image'] = $image_org;
	            $config['new_image'] = $image_thumb;
	            $config['width'] = $width;
	            $config['height'] = $height;
	            $CI->image_lib->initialize($config);
	            $CI->image_lib->resize();
	            $CI->image_lib->clear();
	        }
	        return $image_returned;
	    }
	}


	//slug generator
	if (!function_exists('str_slug')) {
	    function str_slug($str, $separator = 'dash', $lowercase = TRUE)
	    {
	        $str = trim($str);
	        $CI =& get_instance();
	        $foreign_characters = array(
	            '/ä|æ|ǽ/' => 'ae',
	            '/ö|œ/' => 'o',
	            '/ü/' => 'u',
	            '/Ä/' => 'Ae',
	            '/Ü/' => 'u',
	            '/Ö/' => 'o',
	            '/À|Á|Â|Ã|Ä|Å|Ǻ|Ā|Ă|Ą|Ǎ|Α|Ά|Ả|Ạ|Ầ|Ẫ|Ẩ|Ậ|Ằ|Ắ|Ẵ|Ẳ|Ặ|А/' => 'A',
	            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª|α|ά|ả|ạ|ầ|ấ|ẫ|ẩ|ậ|ằ|ắ|ẵ|ẳ|ặ|а/' => 'a',
	            '/Б/' => 'B',
	            '/б/' => 'b',
	            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
	            '/ç|ć|ĉ|ċ|č/' => 'c',
	            '/Д/' => 'D',
	            '/д/' => 'd',
	            '/Ð|Ď|Đ|Δ/' => 'Dj',
	            '/ð|ď|đ|δ/' => 'dj',
	            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě|Ε|Έ|Ẽ|Ẻ|Ẹ|Ề|Ế|Ễ|Ể|Ệ|Е|Э/' => 'E',
	            '/è|é|ê|ë|ē|ĕ|ė|ę|ě|έ|ε|ẽ|ẻ|ẹ|ề|ế|ễ|ể|ệ|е|э/' => 'e',
	            '/Ф/' => 'F',
	            '/ф/' => 'f',
	            '/Ĝ|Ğ|Ġ|Ģ|Γ|Г|Ґ/' => 'G',
	            '/ĝ|ğ|ġ|ģ|γ|г|ґ/' => 'g',
	            '/Ĥ|Ħ/' => 'H',
	            '/ĥ|ħ/' => 'h',
	            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ|Η|Ή|Ί|Ι|Ϊ|Ỉ|Ị|И|Ы/' => 'I',
	            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı|η|ή|ί|ι|ϊ|ỉ|ị|и|ы|ї/' => 'i',
	            '/Ĵ/' => 'J',
	            '/ĵ/' => 'j',
	            '/Ķ|Κ|К/' => 'K',
	            '/ķ|κ|к/' => 'k',
	            '/Ĺ|Ļ|Ľ|Ŀ|Ł|Λ|Л/' => 'L',
	            '/ĺ|ļ|ľ|ŀ|ł|λ|л/' => 'l',
	            '/М/' => 'M',
	            '/м/' => 'm',
	            '/Ñ|Ń|Ņ|Ň|Ν|Н/' => 'N',
	            '/ñ|ń|ņ|ň|ŉ|ν|н/' => 'n',
	            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ|Ο|Ό|Ω|Ώ|Ỏ|Ọ|Ồ|Ố|Ỗ|Ổ|Ộ|Ờ|Ớ|Ỡ|Ở|Ợ|О/' => 'O',
	            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º|ο|ό|ω|ώ|ỏ|ọ|ồ|ố|ỗ|ổ|ộ|ờ|ớ|ỡ|ở|ợ|о/' => 'o',
	            '/П/' => 'P',
	            '/п/' => 'p',
	            '/Ŕ|Ŗ|Ř|Ρ|Р/' => 'R',
	            '/ŕ|ŗ|ř|ρ|р/' => 'r',
	            '/Ś|Ŝ|Ş|Ș|Š|Σ|С/' => 'S',
	            '/ś|ŝ|ş|ș|š|ſ|σ|ς|с/' => 's',
	            '/Ț|Ţ|Ť|Ŧ|τ|Т/' => 'T',
	            '/ț|ţ|ť|ŧ|т/' => 't',
	            '/Þ|þ/' => 'th',
	            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ|Ũ|Ủ|Ụ|Ừ|Ứ|Ữ|Ử|Ự|У/' => 'U',
	            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ|υ|ύ|ϋ|ủ|ụ|ừ|ứ|ữ|ử|ự|у/' => 'u',
	            '/Ý|Ÿ|Ŷ|Υ|Ύ|Ϋ|Ỳ|Ỹ|Ỷ|Ỵ|Й/' => 'Y',
	            '/ý|ÿ|ŷ|ỳ|ỹ|ỷ|ỵ|й/' => 'y',
	            '/В/' => 'V',
	            '/в/' => 'v',
	            '/Ŵ/' => 'W',
	            '/ŵ/' => 'w',
	            '/Ź|Ż|Ž|Ζ|З/' => 'Z',
	            '/ź|ż|ž|ζ|з/' => 'z',
	            '/Æ|Ǽ/' => 'AE',
	            '/ß/' => 'ss',
	            '/Ĳ/' => 'IJ',
	            '/ĳ/' => 'ij',
	            '/Œ/' => 'OE',
	            '/ƒ/' => 'f',
	            '/ξ/' => 'ks',
	            '/π/' => 'p',
	            '/β/' => 'v',
	            '/μ/' => 'm',
	            '/ψ/' => 'ps',
	            '/Ё/' => 'Yo',
	            '/ё/' => 'yo',
	            '/Є/' => 'Ye',
	            '/є/' => 'ye',
	            '/Ї/' => 'Yi',
	            '/Ж/' => 'Zh',
	            '/ж/' => 'zh',
	            '/Х/' => 'Kh',
	            '/х/' => 'kh',
	            '/Ц/' => 'Ts',
	            '/ц/' => 'ts',
	            '/Ч/' => 'Ch',
	            '/ч/' => 'ch',
	            '/Ш/' => 'Sh',
	            '/ш/' => 'sh',
	            '/Щ/' => 'Shch',
	            '/щ/' => 'shch',
	            '/Ъ|ъ|Ь|ь/' => '',
	            '/Ю/' => 'Yu',
	            '/ю/' => 'yu',
	            '/Я/' => 'Ya',
	            '/я/' => 'ya'
	        );

	        $str = preg_replace(array_keys($foreign_characters), array_values($foreign_characters), $str);

	        $replace = ($separator == 'dash') ? '-' : '_';

	        $trans = array(
	            '&\#\d+?;' => '',
	            '&\S+?;' => '',
	            '\s+' => $replace,
	            '[^a-z0-9\-\._]' => '',
	            $replace . '+' => $replace,
	            $replace . '$' => $replace,
	            '^' . $replace => $replace,
	            '\.+$' => ''
	        );

	        $str = strip_tags($str);

	        foreach ($trans as $key => $val) {
	            $str = preg_replace("#" . $key . "#i", $val, $str);
	        }

	        if ($lowercase === TRUE) {
	            if (function_exists('mb_convert_case')) {
	                $str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
	            } else {
	                $str = strtolower($str);
	            }
	        }

	        $str = preg_replace('#[^' . $CI->config->item('permitted_uri_chars') . ']#i', '', $str);

	        return trim(stripslashes($str));
	    }
	}