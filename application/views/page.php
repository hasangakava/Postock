<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">
			<?php include'include/load_banner_img.php'; ?>

    		<div class="container">
        		<div class="row">
        			<div class="col-md-12 text-center">
        				<p class="text-head ts"><?php echo $page->title; ?></p>
			            <div class="breadcrumbs_path ts">
			                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i>    <?php echo $page->title; ?>
			            </div> 
        			</div>
        		</div>     
    		</div>

		</div>
	</div>


	<div class="container page_info">
		<?php echo $page->details; ?>
	</div>

</div>
<!-- end Main Wrapper -->