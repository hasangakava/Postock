<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">
	
	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>

    		<div class="container text-center">
        		<p class="text-head ts"><?php echo $total_photos; ?> - Photos</p>
	            <div class="breadcrumbs_path ts">
	                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i> All Photos
	            </div>      
    		</div>
		</div>
	</div>



	<div class="container mt-10">
	
		<div class="sort">

			<form id="search_photos" method="get" action="<?php echo base_url('photos/all_photos') ?>">
				<div class="col-xs-12 col-sm-5 col-md-6 mt-20">
					<select id="copyright" name="sort" class="sort-select custom-select col-md-4 pull-left" aria-invalid="false">
                    	<option value="">Sort by</option>
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'download'){echo "selected";} ?> value="download">Most downloads</option>
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'view'){echo "selected";} ?> value="view">Most views</option>
                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'featured'){echo "selected";} ?> value="featured">Featured image</option>

                    </select>
				</div>

				<div class="col-xs-12 col-sm-5 col-md-6 mt-20">
					<select id="photo_category" name="category" class="sort-select custom-select col-md-4 pull-right" aria-invalid="false">
                    	<option value="0">Sort by category</option>
                    	<?php foreach ($categories as $category): ?>
                    		<option <?php if(isset($_GET['category']) && $_GET['category'] == $category['id']){echo "selected";} ?> value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
                    	<?php endforeach ?>
                    </select>
				</div>
			</form>


		</div>
	
	</div>

	<div class="grid-box mt-10"> 
	   	<?php include'include/image_loop.php'; ?>
	</div>

	<div class="container">
		<div class="center p-30">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>

	<?php $ad = get_ads(3); ?>
	<?php if ($settings->enable_ad == 1 && $ad != ''): ?>
		<div class="text-center ad-box">
			<?php if ($ad->type == 1): ?>
				<?php echo $ad->code ?>
			<?php else: ?>
				<a target="_blank" href="<?php echo $ad->img_url ?>"><img src="<?php echo base_url($ad->image); ?>"></a>
			<?php endif ?>
		</div>
	<?php endif ?>

</div>
<!-- end Main Wrapper -->
		