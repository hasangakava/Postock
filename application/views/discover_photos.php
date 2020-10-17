<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>
			
    		<div class="container text-center">
        		<p class="text-head ts">Categories</p>
	            <div class="breadcrumbs_path ts">
	                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i>  All Categories
	            </div>      
    		</div>
		</div>
	</div>

	<div class="container">

		<?php $ad = get_ads(5); ?>
		<?php if ($settings->enable_ad == 1 && $ad != ''): ?>
			<div class="text-center ad-box mt-20">
				<?php if ($ad->type == 1): ?>
					<?php echo $ad->code ?>
				<?php else: ?>
					<a target="_blank" href="<?php echo $ad->img_url ?>"><img src="<?php echo base_url($ad->image); ?>"></a>
				<?php endif ?>
			</div>
		<?php endif ?>

		<div class="row">

			<?php if (count($categories) == ''): ?>
		
				<div class="not-found center mt-20 mb-20">
					<p><i class="fa fa-picture-o fa-3x"></i> <br><br> No categories found</p>
				</div>

			<?php else: ?>
		
				<?php foreach ($categories as $category): ?>
					
					<div class="col-md-4 main-box">
						
						<p class="cat-title"><?php echo $category['category']; ?></p>
						<p>(<?php echo $category['total']; ?>) Photos</p>
						
						<a href="<?php echo base_url('photos/category/'.$category['slug']) ?>">
							<div class="row mt-5">
								<?php if (count($category['category_img']) == 1): ?>

									<?php foreach ($category['category_img'] as $img): ?>
										<div class="col-md-12 inner-box-full" style="background-image: url(<?php echo resize_img($img['image'], 300, 300); ?>);"></div>
									<?php endforeach ?>

								<?php else: ?>

									<?php $i = 0; foreach ($category['category_img'] as $img): ?>
										<div class="<?php if($i == 0){echo "col-md-12";}else{echo "col-md-4 col-xs-4";} ?> <?php if($i == 1){echo "ldl";}?> <?php if($i == 3){echo "rdl";}?> inner-box-small" style="background-image: url(<?php echo resize_img($img['image'], 300, 300); ?>);">
										</div>
									<?php $i++; endforeach ?>

								<?php endif ?>
							</div>
						</a>
					</div>

				<?php endforeach ?>

			<?php endif; ?>
			
		</div>
	</div>
	
</div>








<!-- end Main Wrapper -->
		