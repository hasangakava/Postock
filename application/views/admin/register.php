<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- Title Of Site -->
        <title>Pixel - install app</title>

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
        
        <style type="text/css">
            .mt-30{
                margin-top: 30px;
            }
            .cg{
                color: green !important;
            }
        </style>
    </head>
    <body>

        <div class="text-center logo-alt-box" style="padding-top: 10px;">
            <a href="<?php echo base_url() ?>" class="logo c-g"><i class="fa fa-camera c-b"></i> <span>Pixel</span></span></a>
            <h5 class="text-muted m-t-0">Photo stock & sharing script</h5>
        </div>

        <div class="wrapper-page">

            <div class="m-t-20 card-box">
                <div class="panel-body">

                    <div class="login-area">
                    
                        <div class="cg">
                            <h4 class="text-center font-bold m-b-0" style="color: green"><i class="fa fa-check-circle c-g"></i> Congratulations !</h4>
                            <h6 class="text-center mt-10" style="color: green">Your script has been setup successfully</h6>
                            <br>
                            <a href="<?php echo base_url() ?>" class="btn btn-primary btn-block">Go to Site</a><br><br>

                            <b class="text-left">For access admin panel:</b> <br> Use <b>"/admin"</b>  after your domain or folder name like this <b>www.domain.com/admin</b><br><br>

                            OR Click the button below<br><br>

                            <a href="<?php echo base_url('admin') ?>" class="btn btn-primary btn-block">Go to Admin Panel</a><br>

                            <p style="margin-top: 10px; color: #333">* Note: Please read the documentation to know more about this script</p>
                            
                        </div>

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
        <script type="text/javascript">
            $(document).ready(function() {
              setInterval(function() {
                cache_clear()
              }, 3000);
            });

            function cache_clear() {
              window.location.reload(true);
            }
        </script>
    </body>

</html>