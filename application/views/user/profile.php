<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<!-- start Main Wrapper -->
<div class="main-wrapper">
	
	<?php include'inc/banner.php'; ?>
	

	<div class="grid-box"> 
	   	<?php include(APPPATH.'views/include/image_loop.php'); ?>
	</div>

	<div class="center p-30">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	
</div>
<!-- end Main Wrapper -->