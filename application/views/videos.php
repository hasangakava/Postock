<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">
	
	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>

    		<div class="container text-center">
        		<p class="text-head ts">Videos</p>
	            <div class="breadcrumbs_path ts">
	                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i> All Videos
	            </div>      
    		</div>
		</div>
	</div>



	<div class="container mt-10">
	
		<div class="sort">

		</div>

		<?php $ad = get_ads(4); ?>
		<?php if ($settings->enable_ad == 1 && $ad != ''): ?>
			<div class="text-center ad-box mt-20">
				<?php if ($ad->type == 1): ?>
					<?php echo $ad->code ?>
				<?php else: ?>
					<a target="_blank" href="<?php echo $ad->img_url ?>"><img src="<?php echo base_url($ad->image); ?>"></a>
				<?php endif ?>
			</div>
		<?php endif ?>
	
	</div>




	<div class="row">
        <div class="col-lg-12">
            
            <?php if (count($videos) == 0): ?>
                <div class="center"> <h4>No Videos found <i class="fa fa-info-circle"></i></h4></div>
            <?php endif ?>

            <div id="masonry5" class="mt-20 ml-20">
                <?php foreach ($videos as $video): ?>
                     <div class="img-grid" id="video_<?php echo $video->id; ?>">
                        <video width="320" height="240" poster="" id="player" playsinline controls>
                            <source src="<?php echo base_url($video->path); ?>" type="<?php echo $video->file_type ?>">
                            <source src="<?php echo base_url($video->path); ?>" type="video/webm">
                        </video>
                    </div>
                <?php endforeach ?>
            </div>
           
        </div>
    </div>




	<div class="container">
		<div class="center p-30">
			<?php echo $this->pagination->create_links(); ?>
		</div>
	</div>

</div>
<!-- end Main Wrapper -->

