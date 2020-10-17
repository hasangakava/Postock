<!DOCTYPE html>
<html>
	
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="<?php echo base_url($settings->favicon); ?>">
        <?php $settings = get_settings(); ?>
		<title><?php echo $settings->site_name; ?> - Dashboard</title>
        <meta name="description" content="<?php echo $settings->description; ?>"/>
        <meta name="keywords" content="<?php echo $settings->keywords; ?>"/>
        <meta name="author" content="<?php echo $settings->site_name; ?>"/>
        <meta name="robots" content="all"/>
        <meta name="revisit-after" content="1 Days"/>
        <meta property="og:site_name" content="<?php echo $settings->site_name; ?>"/>
        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/morris/morris.css">
        <link href="<?php echo base_url()?>assets/css/imageuploadify.min.css" rel="stylesheet">

		<link href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="<?php echo base_url()?>assets/css/sweet-alert.css" rel="stylesheet">
        <link href="<?php echo base_url() ?>assets/admin/plugins/summernote/summernote.css" rel="stylesheet" />
        <!-- DataTables -->
        <link href="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url() ?>assets/admin/js/modernizr.min.js"></script>
        
        <script type="text/javascript">
           var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
           var token_name = '<?php echo $this->security->get_csrf_token_name();?>'
        </script>

	</head>

	<body class="fixed-left">

		<!-- Begin page -->
		<div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="<?php echo base_url('admin/dashboard') ?>" class="logo">
                            <i class="fa fa-camera"></i><span> <?php echo $settings->site_name; ?></span></span>
                        </a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="zmdi zmdi-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <a target="_blank" href="<?php echo base_url('home') ?>" class="navbar-left app-search pull-left btn btn-primary btn-sm"><i class="fa fa-eye"></i> View Website</a>
                            
                            <ul class="nav navbar-nav navbar-right pull-right">

                                <li class="dropdown user-box">
                                    <a href="#" class="dropdown-toggle waves-effect waves-light profile " data-toggle="dropdown" aria-expanded="true">
                                        <?php echo $this->session->userdata('name'); ?> <img src="<?php echo base_url() ?>assets/images/avatar.png" alt="user-img" class="img-circle user-img">
                                        
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo base_url('admin/dashboard/edit_profile') ?>"><i class="ti-user m-r-5"></i> Update Profile</a></li>
                                        <li><a href="<?php echo base_url('admin/dashboard/change_password') ?>"><i class="ti-pencil m-r-5"></i> Change Password</a></li>
                                        <li><a href="<?php echo base_url('admin/auth/logout') ?>"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->






            <!-- ========== Left Sidebar ========== -->

                <?php include('left_sideber.php'); ?>
			
            <!-- ========== Left Sidebar ========== -->





			<div class="content-page">