<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App title -->
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


        <!-- App CSS -->
        <link href="<?php echo base_url() ?>assets/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/core.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/components.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/admin/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/css/sweet-alert.css" rel="stylesheet">
        <script src="<?php echo base_url() ?>assets/admin/js/modernizr.min.js"></script>
        
        <script>
            <?php echo $settings->google_analytics; ?>
        </script>

    </head>
    <body>

        <div class="text-center logo-alt-box" style="padding-top: 50px;">
            <a href="<?php echo base_url() ?>" class="logo"><i class="fa fa-camera c-b"></i> <span><?php echo $settings->site_name; ?></span></span></a>
            <h5 class="text-muted m-t-0"><?php echo $settings->site_title; ?></h5>
        </div>

        <div class="wrapper-page">

        	<div class="m-t-20 card-box">
                <div class="panel-body">

                    <div class="login-area">
                    
                        <div class="text-center">
                            <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
                        </div>

                        <form class="form-horizontal m-t-30" id="login-form" method="post" action="<?php echo base_url('admin/auth/log') ?>">

    						<div class="form-group ">
                                <div class="col-xs-12">
                                    <input class="form-control" name="email" type="email" required placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" name="password" type="password" required placeholder="Password">
                                </div>
                            </div>

                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

    						<div class="form-group text-center m-t-30">
                                <div class="col-xs-12">
                                    <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light text-uppercase" type="submit">Log In</button>
                                </div>
                            </div>

                            <div class="form-group m-t-30 m-b-0">
                                <div class="col-sm-12">
                                    <a href="#" class="text-muted recover_pass"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
                                </div>
                            </div>

    					</form>
                    </div>

                    <div class="recover-pass-area dis_none">
                        <div class="text-center">
                            <h4 class="text-uppercase font-bold m-b-0">Recover Password</h4>
                        </div>

                        <form id="lost-form" class="form-horizontal m-t-30" action="<?php echo base_url('admin/auth/forgot_password') ?>">

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" name="email" required placeholder="Enter email">
                                </div>
                            </div>

                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                            <div class="form-group text-center m-t-20 m-b-0">
                                <div class="col-xs-12">
                                    <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light text-uppercase" type="submit">Reset Password</button>
                                </div>
                            </div>

                            <div class="form-group m-t-30 m-b-0">
                                <div class="col-sm-12">
                                    <a href="#" class="text-muted back_login"><i class="fa fa-arrow-left m-r-5"></i>Back to login</a>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <!-- end card-box -->

        </div>
        <!-- end wrapper page -->




    	<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/detect.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/fastclick.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/waves.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/wow.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo base_url()?>assets/js/sweet-alert.min.js"></script>
        <!-- Custom js -->
        <script src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>
        <!-- App js -->
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.core.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.app.js"></script>

	</body>

</html>