<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper mwrap">

	<!-- start hero-header -->
	
	<?php if ($settings->home_banner == 'auto'): ?>
		<?php $img = get_breadcrumb_img(); ?>
		<?php if (isset($img) && $img->image != '') {
			$banner_img = base_url($img->image);
		} else {
			$banner_img = base_url('assets/images/hero-header/01.jpg');
		}?>
	<?php else: ?>
			<?php $banner_img = base_url($settings->home_banner_img); ?>
	<?php endif ?>
	<div class="hero" style="background-image:url('<?php echo $banner_img; ?>');">

		<div class="container">
			<div class="row gap-0">
				<div class="col-md-10 col-md-offset-1">
				  <div class="section-title-special">
						<h1><?php echo $settings->site_name; ?></h1>
						<p class="p-title"><?php echo $settings->site_title; ?></p>
					</div>
				</div>

				
				<div class="col-md-8 col-md-offset-2">
				
					<div class="input-group-search-form-wrapper size-lg">
				
					<form method="get" action="<?php echo base_url('photos/all_photos') ?>">
						
						<div class="input-group bg-change-focus-addclass">
							<input type="text" name="search" class="form-control" placeholder="Search photos" >
							
							<div class="input-group-btn dropdown-select">
								<div class="dropdown dropdown-select">
									<button class="btn dropdown-toggle" type="button" id="mainSearchDropdown" data-toggle="dropdown" aria-expanded="true">
										All Stock
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu" role="menu" aria-labelledby="mainSearchDropdown">
							
										<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('photos/all_photos?sort=featured') ?>">Featured photos</a></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('photos/all_photos?sort=download') ?>">Top downloads</a></li>
										<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url('photos/all_photos?sort=view') ?>">Top views</a></li>
									
									</ul>
								</div>
							</div><!-- /btn-group -->
							
							<div class="input-group-btn hidden-xss">
								<button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
							</div>
						</div><!-- /input-group -->
						<button class="btn btn-info btn-block bt visible-xss"><i class="fa fa-search"></i> Search Image</button>

					</form>
					
					</div>

				</div>
				
			</div>

		</div>
		
	</div>
	<!-- end hero-header -->



	<div class="content-wrapper">
		<div class="section">
			<div class="container">

				<?php $ad = get_ads(1); ?>
				<?php if ($settings->enable_ad == 1 && $ad != ''): ?>
					<div class="text-center ad-box">
						<?php if ($ad->type == 1): ?>
							<?php echo $ad->code ?>
						<?php else: ?>
							<a target="_blank" href="<?php echo $ad->img_url ?>"><img src="<?php echo base_url($ad->image); ?>"></a>
						<?php endif ?>
					</div>
				<?php endif ?>
				

				<div class="row gap- mt-30">
					<div class="col-md-10 col-md-offset-1">
					
						<div class="section-title-special mb-30">
							<span class="badge title"><?php echo $this->settings->site_name; ?> Stock Photos</span>
						</div>
				
					</div>
				</div>
				
			</div>

		    <div class="grid-box" id="load_data"> 
			   	<?php include'include/image_loop.php'; ?>
			</div>
		
			<?php if (count($images) != 0): ?>
				<div class="container" style="text-align: center;">
					<a href="<?php echo base_url('photos/all_photos') ?>" class="btn btn-info" value="loadmore" >See More</a>
				</div>
			<?php endif ?>
		
		</div>
	</div>





	<div class="counting-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3 bor">
					<div class="counting-item">
						<div class="counting-number h1"><span class="counter" data-decimal-delimiter="," data-thousand-delimiter="," data-value="<?php if(!empty($total->images)){echo $total->images;} ?>" ></span></div>
						Photos
					</div>
				</div>

				<div class="col-sm-6 col-md-3 bor">
					<div class="counting-item">
						<div class="counting-number h1"><span class="counter" data-decimal-delimiter="," data-thousand-delimiter="," data-value="<?php if(!empty($total->members)){echo $total->members;} ?>" ></span></div>
						Members
					</div>
				</div>
				
				<div class="col-sm-6 col-md-3 bor">
					<div class="counting-item">
						<div class="counting-number h1"><span class="counter" data-decimal-delimiter="," data-thousand-delimiter="," data-value="<?php if(!empty($total->images)){echo $total->likes;} ?>" ></span></div>
						Likes
					</div>
				</div>

				<div class="col-sm-6 col-md-3">
					<div class="counting-item">
						<div class="counting-number h1"><span class="counter" data-decimal-delimiter="," data-thousand-delimiter="," data-value="<?php if(!empty($total->downloads)){echo $total->downloads;} ?>" ></span></div>
						Downloads
					</div>
				</div>
				
			</div>
		
			
		</div>
		
	</div>

	<div class="section pt-70 pb-80">
		<div class="container">
			<div class="user-action-wrapper mb-70">
				<div class="GridLex-gap-30">
		
					<div class="GridLex-grid-noGutter-equalHeight">
						
						<div class="GridLex-col-6_sm-6_xs-12">
				
							<div class="user-action-item clearfix">
					
								<div class="icon">
									<i class="fa fa-picture-o"></i>
								</div>
								
								<div class="content">
								
									<h4 class="text-uppercase mb-20">Looking Free Photos</h4>
									<?php if ($this->session->userdata('is_login') != true): ?>
										<a data-toggle="modal" href="#loginModal" class="btn btn-default">Sign Up For Free</a>
									<?php endif; ?>
									
								</div>
							
							</div>
							
						</div>
								
						<div class="GridLex-col-6_sm-6_xs-12">
						
							<div class="user-action-item clearfix">
							
								<div class="icon">
									<i class="fa fa-camera"></i>
								</div>
								
								<div class="content">
								
									<h4 class="text-uppercase mb-20">Are You Photograpper?</h4>
									<?php if ($this->session->userdata('is_login') == true): ?>
										<a href="<?php echo base_url('user/upload/'.md5($this->session->userdata('id'))) ?>" class="btn btn-default">Upload your photos</a>
									<?php else: ?>
										<a data-toggle="modal" href="#loginModal" class="btn btn-default">Upload your photos</a>
									<?php endif ?>
									
									
								</div>
							
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>


			<?php $ad = get_ads(1); ?>
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
		
	</div>
	
</div>
<!-- end Main Wrapper -->