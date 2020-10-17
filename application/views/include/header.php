<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php $settings = get_settings(); ?>
	
	<!-- Title Of Site -->
	<title><?php if(isset($page_title)){echo $page_title;}else{ echo $settings->site_name; } ?> - <?php echo $settings->site_title; ?></title>
	    <meta name="description" content="<?php echo $settings->description; ?>"/>
	    <meta name="keywords" content="<?php echo $settings->keywords; ?>"/>
	    <meta name="author" content="Macrotech"/>
	    <meta name="robots" content="all"/>
	    <meta name="revisit-after" content="1 Days"/>
	    <meta property="og:site_name" content="<?php echo $settings->site_name; ?>"/>
		<meta name="author" content="crenoveative">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<?php if (isset($page_title) && $page_title == "Single Image"): ?>
		<?php $count_like = count_image_like(md5($image->id)); ?>
		<meta property="og:title" content="<?php echo $image->title; ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:image" content="<?php echo base_url($image->image);?>" />
        <meta property="og:url" content="<?php echo base_url('photos/details/'.md5($image->id)) ?>" />
		
		<meta property="og:description" content="<?php echo $image->title; ?>" />				
		<meta name="description" content="<?php echo $image->title; ?>" />

		<meta name="twitter:card" content="<?php echo $image->title; ?>"/>
	    <meta name="twitter:site" content="@<?php echo $settings->site_name; ?>"/>
	    <meta name="twitter:creator" content="@<?php echo $image->uploader_name; ?>"/>
	    <meta name="twitter:title" content="<?php echo $image->title; ?>"/>
	    <meta name="twitter:description" content="Like <?php echo $count_like->total;?>, View <?php echo $image->view; ?>"/>
	    <meta name="twitter:image" content="<?php echo base_url($image->image);?>"/>
	<?php endif ?>
	
	<!-- Fav and Touch Icons -->
	<link rel="shortcut icon" href="<?php echo base_url($settings->favicon); ?>">

	<!-- CSS Plugins -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" media="screen">	
	<link href="<?php echo base_url() ?>assets/css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/main.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
	
	<!-- CSS Font Icons -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/icons/font-awesome/css/font-awesome.min.css">

	<!-- CSS Custom -->
	<link href="<?php echo base_url() ?>assets/css/style.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap-tagsinput.css">
	<link href="<?php echo base_url()?>assets/css/sweet-alert.css" rel="stylesheet">
	<link href="<?php echo base_url()?>assets/css/plyr.css" rel="stylesheet">
	<!-- CSS Custom -->
	<link href="<?php echo base_url() ?>assets/css/bootstrap-imageupload.css" rel="stylesheet">
	
	<!-- Add your own style -->
	<link href="<?php echo base_url() ?>assets/css/your-style.css" rel="stylesheet">
	
	
	<script type="text/javascript">
	   var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
	   var token_name = '<?php echo $this->security->get_csrf_token_name();?>'
	</script>
	
	<script>
        <?php echo $settings->google_analytics; ?>
    </script>
        
</head>

<body>

	<!-- start Container Wrapper -->
	<div class="wrapper container-wrapper" id="wrap">

		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	        <div class="container">
	        
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>

	                <a class="navbar-brand" href="<?php echo base_url() ?>">
	                	<?php if ($settings->logo == ''): ?>
	                		<i class="fa fa-camera fa-4x"></i> <?php echo $settings->site_name; ?>
	                	<?php else: ?>
	                		<img width="130px" src="<?php echo base_url($settings->logo) ?>">
	                	<?php endif ?>
	                </a>

	            </div>
	            <div class="collapse navbar-collapse navbar-ex1-collapse">
	              
	                <!-- DROPDOWN LOGIN STARTS HERE  -->
	                <ul id="signInDropdown" class="nav navbar-nav navbar-right">


	                	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Explore <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo base_url('photos/all_photos?featured=1') ?>"><i class="fa fa-star mr-5"></i> Featured Photos</a></li>
								<li><a href="<?php echo base_url('photos/all_photos') ?>"><i class="fa fa-picture-o mr-5"></i> Photos</a></li>
								<li><a href="<?php echo base_url('videos') ?>"><i class="fa fa-play mr-5"></i>Videos</a></li>
								<li><a href="<?php echo base_url('member') ?>"> <i class="fa fa-users mr-5"></i> Members</a></li>
								<li><a href="<?php echo base_url('photos') ?>"><i class="fa fa-list mr-5"></i> Categories</a></li>
								<li><a href="<?php echo base_url('photos/collections') ?>"><i class="fa fa-folder mr-5"></i> Collections</a></li>
								<li><a href="<?php echo base_url('photos/tags') ?>"><i class="fa fa-tags mr-5"></i> Tags</a></li>
                            </ul>
                        </li>
                        

                        <?php if ($this->session->userdata('is_login') == TRUE): ?>


                        <div class="notification_area notifydk pleft">
                            <?php $this->load->view('include/header_notification.php') ?>
                        </div>

                        <div class="notifymobile dis_none">
                        	<a href="<?php echo base_url('notifications/all') ?>" class=""><i class="fa fa-bell-o"></i></a>
                        </div>

	                    <li class="dropdown">

	                    	<?php $user_id = $this->session->userdata('id'); ?>
	                    	<?php $user = get_my_info(md5($user_id)); ?>

	                    	<?php if ($user->thumb == ''): ?>
								<?php $avatar = base_url('assets/images/avatar.png'); ?> 
							<?php else: ?>
								<?php $avatar = base_url($user->thumb); ?>
							<?php endif ?>

							<a id="dropdownMenu1" class="dropdown-toggle mb-userimg" data-toggle="dropdown" href="#">
							<img class="user_img img-circle" src="<?php echo $avatar; ?>" width="30px">
							</a>

	                        <ul class="dropdown-menu">
		                         <li class="menu-item">
		                         	<a href="<?php echo base_url('user') ?>"><i class="fa fa-user mr-5"></i> <?php echo $user->first_name; ?></a>
		                         </li>
		                         <li class="menu-item">
		                         	<a href="<?php echo base_url('user/edit_account/'.md5($user_id)) ?>"><i class="fa fa-cog mr-5"></i> Account Settings</a>
		                         </li>
		                         <li class="menu-item">
		                         	<a href="<?php echo base_url('user/collections/'.md5($user_id)) ?>"><i class="fa fa-folder-open mr-5"></i> Collections</a>
		                         </li>
		                         <li class="menu-item">
		                         	<a href="<?php echo base_url('message') ?>"><i class="fa fa-comment mr-5"></i> Messages</a>
		                         </li>
		                         <li class="menu-item">
		                         	<a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-sign-out mr-5"></i> Logout</a>
		                         </li>
	                        </ul>
		                        
	                    </li>

	                    <li class="dropdown upload"><a href="<?php echo base_url('user/upload_option/'.md5($user_id)) ?>" class="upa"><i class="fa fa-cloud-upload"></i></a></li>

	                    <?php else: ?>
						<li class="user-action signin">
							<a class="asign" data-toggle="modal" href="#loginModal"><span>SIGN UP/IN</span></a>
						</li>
						<?php endif ?>
	                    

	                </ul>
	                <!-- DROPDOWN LOGIN ENDS HERE  -->
	            </div>
	        </div>
	    </div>