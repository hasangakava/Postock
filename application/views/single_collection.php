<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>

    		<div class="container text-center">
        		<p class="text-head ts"><?php echo $total; ?> - <?php echo $images[0]->coll_name; ?></p>
	            <div class="breadcrumbs_path ts">
	                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i> Single collections
	            </div>      
    		</div>
		</div>
	</div>


	<div class="grid-box"> 
	   	<?php include('include/single_coll_img_loop.php'); ?>
	</div>

</div>