<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">
	
	<?php include'include/banner.php'; ?>

		<?php if (count($images) == ''): ?>
			No Image Found
		<?php else: ?>

			<?php include'include/image_loop.php'; ?>

			<div class="center p-30">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		<?php endif ?>
	
</div>
<!-- end Main Wrapper -->