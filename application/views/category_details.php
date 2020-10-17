<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>

    		<div class="container text-center">
        		<p class="text-head ts"><?php echo $total_photos; ?> - <?php if(!empty($images[0]->category)){echo $images[0]->category;} ?></p>
	            <div class="breadcrumbs_path ts">
	                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>  <i class="fa fa-angle-right"></i> Category  <i class="fa fa-angle-right"></i> <?php if(!empty($images[0]->category)){echo $images[0]->category;} ?>
	            </div>      
    		</div>
	    		
		</div>
	</div>

	<h3 class=" ml-10"></h3>
	

	<div class="grid-box"> 
	   	<?php include('include/image_loop.php'); ?>
	</div>

	<div class="center p-30">
		<?php echo $this->pagination->create_links(); ?>
	</div>

</div>
<!-- end Main Wrapper -->
		