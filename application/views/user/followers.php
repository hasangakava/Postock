<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">


	
	<?php include'inc/banner.php'; ?>

	    <div class="container">
	    	
	    	<div class="row"><br>
	    		<?php if ($total == 0): ?>
	    			<div class="not-found center">
						<p><i class="fa fa-user-times fa-3x"></i> <br><br>
						 <?php if (!empty($page_title) && $page_title == "Followers"): ?>
						 	No followers found 
						 <?php else: ?>
						 	Nobody follows you 
						 <?php endif ?>
						 
						</p>
					</div>
	    		<?php else: ?>

					<?php foreach ($followers as $user): ?>
						
						<div class="col-md-4 col-sm-6 col-xs-12" id="item_<?php echo $user->user_id;?>">
							<div class="single-pg-box">
								<a target="_blank" href="<?php echo base_url('user/profile/'.md5($user->id)); ?>">
									<div class="pg-info-box fix">
										<div class="col-md-12 col-sm-12 col-xs-12 pg-img">
											
											<?php if ($user->thumb == '') {
												$avatar = base_url('assets/images/avatar.png');
											}else{
												 $avatar = base_url($user->thumb);
											}?>
					
											<img width="100px" class="img-circle" src="<?php echo $avatar; ?>">
										</div>

										<div class="pg-text col-md-12 col-xs-12">
											<p><?php echo $user->first_name; ?></p>
											<span> Member since: <?php echo my_date_show($user->created_at) ?></span><br>
											<span class="info-text"><i class="fa fa-camera"></i> <?php echo $user->total_photos; ?></span>
											<span class="info-text"><i class="fa fa-eye"></i> <?php echo $user->total_like; ?></span>
											<span class="info-text"><i class="fa fa-thumbs-up"></i> <?php echo $user->total_like; ?></span>
											<span class="info-text"><i class="fa fa-download"></i> <?php echo $user->download; ?></span>
										</div>

										<?php if ($this->session->userdata('is_login') == TRUE): ?>
											<?php $follow = check_follower($user->user_id); ?>
											<?php if ($follow == 0): ?>
												<a href="#" id="follow_<?php echo $user->user_id; ?>" data-id="<?php echo $user->user_id; ?>" class="btn btn-info btn-sm mfollow">Follow</a>
											<?php else: ?>
												<a href="#" id="unfollow_<?php echo $user->user_id; ?>" data-id="<?php echo $user->user_id; ?>" class="btn btn-info btn-sm munfollow">Following</a>
											<?php endif ?>
										<?php endif ?>

									</div>
								</a>
							</div>
						</div>

					<?php endforeach ?>

				<?php endif ?>
			</div>
		
	    </div>

	<div class="center p-30">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	
</div>
<!-- end Main Wrapper -->