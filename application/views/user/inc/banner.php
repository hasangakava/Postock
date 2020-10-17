<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="banner">
	<?php $img = get_banner_img($user_id); ?>
	<?php if (isset($img) && $img->image != '') {
		$banner_img = resize_img($img->image, 1200,240);
	} else {
		$banner_img = base_url('assets/images/banner.jpg');
	}
	?>
	<div class="banner-widget banner-middle">
	  <div class="banner-blur" style="background-image: url('<?php echo $banner_img; ?>');">
	  </div>
	</div>


	<div class="banner-text">

		<?php $user = get_my_info($user_id); ?>
		<?php if ($user->thumb == ''): ?>
			<?php $avatar = base_url('assets/images/avatar.png'); ?> 
		<?php else: ?>
			<?php $avatar = base_url($user->thumb); ?>
		<?php endif ?>

		<img width="90px" style="margin: 0 auto" src="<?php echo $avatar; ?>" alt="image" class="img-circle">
		<h3 class="">
			<?php echo $user->first_name.' '.$user->last_name; ?> 
			<?php if ($user->is_verified == 1): ?>
				<i class="fa fa-check-circle fa-1x"></i>
			<?php endif ?>
		</h3>

		<div class="info dk-info">
			<p class="bctext"><?php if($user->country != ''){ ?> <i class="fa fa-map-marker"></i> <?php echo $user->country; ?> <?php } ?> &emsp; Since - <?php echo my_date_show($user->created_at); ?></p>
			<span class="banner-info-text"> <?php echo $user->total_photos; ?> Photos</span>
			<span class="banner-info-text"> <?php echo $user->total_videos; ?> Videos</span>
			<span class="banner-info-text"> <?php echo $user->total_view; ?> Views</span>
			<span class="banner-info-text"> <?php echo $user->total_like; ?> Likes</span>
			<span class="banner-info-text"> <?php echo $user->download; ?> Downloads</span><br>
		</div>

		<div class="info mobile-info dis_none">
			<p class="bctext"><?php if($user->country != ''){ ?> <i class="fa fa-map-marker"></i> <?php echo $user->country; ?> <?php } ?> &emsp; Since - <?php echo my_date_show($user->created_at); ?></p>
			<span class="banner-info-text"><i class="fa fa-camera"></i> <?php echo $user->total_photos; ?></span>
			<span class="banner-info-text"><i class="fa fa-eye"></i> <?php echo $user->total_photos; ?></span>
			<span class="banner-info-text"><i class="fa fa-thumbs-up"></i> <?php echo $user->total_like; ?></span>
			<span class="banner-info-text"><i class="fa fa-download"></i> <?php echo $user->download; ?></span><br>
		</div>

	</div>

	<div class="info-btm b">

		<div class="col-md-4 col-sm-4 col-xs-4 text-left social-user">
			<?php if($user->fb != ''): ?>
				<a target="_blank" href="http://<?php echo $user->fb; ?>"><i class="fa fa-facebook-official"></i></a>
			<?php endif ?>
			<?php if($user->twitter != ''): ?>
				<a target="_blank" href="http://<?php echo $user->twitter; ?>"><i class="fa fa-twitter"></i></a>
			<?php endif ?>
			<?php if($user->google != ''): ?>
				<a target="_blank" href="http://<?php echo $user->google; ?>"><i class="fa fa-google-plus "></i></a>
			<?php endif ?>
			<?php if($user->website != ''): ?>
				<a target="_blank" href="http://<?php echo $user->website; ?>"><i class="fa fa-external-link-square"></i></a>
			<?php endif ?>
		</div>

		<div class="col-md-4 col-sm-4 col-xs-4">
			<?php if ($this->session->userdata('is_login') == TRUE): ?>
				<?php $follow = check_follower($user->id); ?>
				<?php if ($follow == 0): ?>
					<a href="#" data-id="<?php echo $user->id; ?>" class="btn btn-info btn-sm follow mt-0">Follow</a>
				<?php else: ?>
					<a href="#" data-id="<?php echo $user->id; ?>" class="btn btn-info btn-sm unfollow mt-0">Following</a>
				<?php endif ?>

				<?php if ($user->id != $this->session->userdata('id')): ?>
					<a data-toggle="modal" href="#msgModal" class="btn btn-info btn-sm mt-0"><i class="fa fa-comment-o"></i> Message</a>
				<?php endif ?>
			<?php else: ?>
					<a data-toggle="modal" href="#loginModal" class="btn btn-info btn-sm"><i class="fa fa-comment-o"></i> Message</a>
			<?php endif ?>

		</div>

		<div class="col-md-4 col-sm-4 col-xs-4 text-right">

			<?php if ($this->session->userdata('is_login') == TRUE && $user->id == $this->session->userdata('id')): ?>
				<a href="<?php echo base_url('user/edit_account/'.$user_id) ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> Edit Profile</a>
			<?php endif ?>
		</div>

	</div><br>

</div>


<?php $total_collection = count_user_collections($user_id); ?>
<?php $total_download = count_user_downloads($user_id); ?>
<?php $total_pending = count_pending_photos($user_id); ?>
<?php $total_followers = count_total_followers($user_id, 1); ?>
<?php $total_following = count_total_followers($user_id, 2); ?>

<div class="topnav">
	<ul>
		<li><a class="<?php if(isset($page_title) && $page_title == "User") {echo "active";} ?>" href="<?php echo base_url('user/profile/'.$user_id) ?>"> <b><?php echo $user->total_photos; ?></b>&nbsp; Photos</a></li>

		<li><a class="<?php if(isset($page_title) && $page_title == "Videos") {echo "active";} ?>" href="<?php echo base_url('user/videos/'.$user_id) ?>"> <b><?php echo $user->total_videos; ?></b>&nbsp; Videos</a></li>
		
		<li><a class="<?php if(isset($page_title) && $page_title == "Collections") {echo "active";} ?>" href="<?php echo base_url('user/collections/'.$user_id) ?>"><b><?php echo $total_collection; ?></b>&nbsp; Collections</a></li>
		
		<?php if ($this->session->userdata('is_login') == TRUE && md5($this->session->userdata('id')) == $user_id): ?>
			
			<li><a class="<?php if(isset($page_title) && $page_title == "Pending") {echo "active";} ?>" href="<?php echo base_url('user/pending/'.$user_id) ?>"> <b><?php echo $total_pending ?></b>&nbsp; Pending</a></li>
			
			<li><a class="<?php if(isset($page_title) && $page_title == "Downloads") {echo "active";} ?>" href="<?php echo base_url('user/downloads/'.$user_id) ?>"><b><?php echo $total_download ?></b>&nbsp; Downloads</a></li>

			<li><a class="<?php if(isset($page_title) && $page_title == "Followers") {echo "active";} ?>" href="<?php echo base_url('user/followers/'.$user_id) ?>"> <b><?php echo $total_followers ?></b>&nbsp; Followers</a></li>
			
			<li><a class="<?php if(isset($page_title) && $page_title == "Following") {echo "active";} ?>" href="<?php echo base_url('user/following/'.$user_id) ?>"> <b><?php echo $total_following ?></b>&nbsp; Following</a></li>

			<li><a class="" href="<?php echo base_url('message') ?>"><i class="fa fa-comment"></i> Messages</a></li>
			
		<?php endif ?>

	</ul>
</div>





  <!-- send message Modal -->
  <div class="modal fade" id="msgModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-comment"></i> Send message to <span class="c-p"><?php echo $user->first_name; ?></span></h4>
        </div>

        <div class="modal-body">
          	<form method="post" class="send_user_message" action="<?php echo base_url('user/send_message');?>">
				<div class="form-group">
					<textarea class="form-control mgs_text_area" maxlength="<?php echo $settings->mgs_char_length; ?>" rows="6" name="message"></textarea>
				</div>

				<!-- csrf token -->
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

				<input type="hidden" name="mgs_to" value="<?php echo md5($user->id); ?>">
				<div class="form-group mt-10">
					<button type="submit" class="btn btn-info"><i class="fa fa-paper-plane"></i> SEND</button>
				</div>
			</form>
        </div>
      
      </div>
    </div>
  </div>
</div>