<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">
			<?php include'include/load_banner_img.php'; ?>

    		<div class="container">
        		<div class="row">
        			<div class="col-md-12 text-center">
        				<p class="text-head ts"><?php echo $page_title; ?></p>
			            <div class="breadcrumbs_path ts">
			                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i>    <?php echo $page_title; ?>
			            </div> 
        			</div>
        		</div>     
    		</div>

		</div>
	</div>


	<div class="container text-center mt-20" style="padding: 100px; background: #fff">
		<i class="fa fa-check-circle fa-5x c-s"></i><br>
		<h4 class="mt-5 c-s">Congratulations ! Your account is verified now</h4>
		<a data-toggle="modal" href="<?php echo base_url('user/upload/'.$user_id) ?>" class="btn btn-info mt-20"><i class="fa fa-cloud-upload"></i>  Upload your first photos</a>
	</div><br>

</div>
<!-- end Main Wrapper -->