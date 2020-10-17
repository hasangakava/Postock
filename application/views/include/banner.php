<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="banner">
	<div class="banner-text">
		<?php if ($user->thumb == ''): ?>
			<?php $avatar = base_url('assets/images/avatar.png'); ?> 
		<?php else: ?>
			<?php $avatar = base_url($user->thumb); ?>
		<?php endif ?>

		<img width="90px" style="margin: 0 auto" src="<?php echo $avatar; ?>" alt="image" class="img-circle">
		<h3 class=""><?php echo $user->first_name.' '.$user->last_name; ?></h3>

		<div class="info">
			<span class="info-text"><i class="fa fa-camera"></i> <?php echo $user->total_photos; ?> Photos</span>
			<span class="info-text"><i class="fa fa-eye"></i> <?php echo $user->total_photos; ?> Views</span>
			<span class="info-text"><i class="fa fa-thumbs-up"></i> <?php echo $user->total_like; ?> Likes</span>
			<span class="info-text"><i class="fa fa-download"></i> <?php echo $user->download; ?> Downloads</span><br>
			
			<?php if ($this->session->userdata('is_login') == TRUE): ?>
				<?php $follow = check_follower($user->id); ?>
				<?php if ($follow == 0): ?>
					<a href="#" data-id="<?php echo $user->id; ?>" class="btn btn-info btn-sm follow">Follow</a>
				<?php else: ?>
					<a href="#" data-id="<?php echo $user->id; ?>" class="btn btn-info btn-sm unfollow">Following</a>
				<?php endif ?>
			<?php endif ?>
			
		</div>
	</div>
</div>



<div class="topnav mb-30">
	<ul>
		<li><a class="<?php if(isset($page_title) && $page_title == "User") {echo "active";} ?>" href="<?php echo base_url('photographer/photos') ?>"><i class="fa fa-camera"></i> Photos (<?php echo $user->total_photos; ?>)</a></li>

		<li><a class="<?php if(isset($page_title) && $page_title == "Albums") {echo "active";} ?>" href="<?php echo base_url('photographer/collections') ?>"><i class="fa fa-picture-o"></i> Collections</a></li>
	</ul>
</div>