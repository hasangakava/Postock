<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>

    		<div class="container text-center">
        		<p class="text-head ts"><?php echo $total; ?> - Members</p>
	            <div class="breadcrumbs_path ts">
	                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i>    All Members
	            </div>      
    		</div>
		</div>
	</div>

	<div class="container mt-10">

		
		<div class="sort">
			<div class="col-xs-12 col-sm-12 col-md-12 sort-area mb-10 mt-10">

				<div class="col-md-6 col-sm-6 mt-5 p-0">
					<form class="sort_form pull-left" method="get" action="<?php echo base_url('member/all_members') ?>">
						<select name="sort" class="form-control custom-select col-sm-2 sort ">
	                    	<option selected="selected">Sort by</option>
	                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'photos'){echo "selected";} ?> value="photos">Most Images</option>
	                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'download'){echo "selected";} ?> value="download">Most Downloads</option>
	                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'like'){echo "selected";} ?> value="like">Most Likers</option>
	                    </select>
	                </form>
                </div>

                <div class="col-md-6 col-sm-6 mt-5 p-0">
                    <form role="search" autocomplete="off" action="<?php echo base_url('member') ?>" method="get" class="pull-right">
                         <div class="input-group input-group-sm" style="width: 300px;">
                          <input type="text" name="search" class="form-control" placeholder="Search" autocomplete="off">
        
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                </div>
               
			</div>
		</div>

		<div class="row"><br>
			<?php if ($total == 0): ?>
				<div class="not-found center mt-50" style="width: 97%">
					<p><i class="fa fa-user-times fa-3x"></i> <br><br> No Members found </p>
				</div>
			<?php else: ?>
				
			<?php endif ?>
			<?php foreach ($members as $user): ?>
			
				<div class="col-md-4 col-sm-6 col-xs-12" id="item_<?php echo $user->id; ?>">
					<div class="single-pg-box">
						<a target="_blank" href="<?php echo base_url('user/profile/'.md5($user->id)); ?>">
							<div class="pg-info-box fix" >
								<div class="col-md-12 col-sm-12 col-xs-12 pg-img">
									
									<?php if ($user->thumb == '') {
										$avatar = base_url('assets/images/avatar.png');
									}else{
										 $avatar = base_url($user->thumb);
									}?>

									<img width="100px" class="img-circle" src="<?php echo $avatar; ?>">
									<div class="verify-badge">
										<?php if ($user->is_verified == 1): ?>
											<i class="fa fa-check-circle fa-2x"></i>
										<?php endif ?>
									</div>
								</div>

								<div class="pg-text col-md-12 col-xs-12 mb-10">
									<p><?php echo $user->first_name; ?></p>
									<span> Member since: <?php echo my_date_show($user->created_at) ?></span><br>
									<span class="info-text"><i class="fa fa-camera"></i> <?php echo $user->total_photos; ?></span>
									<span class="info-text"><i class="fa fa-eye"></i> <?php echo $user->total_view; ?></span>
									<span class="info-text"><i class="fa fa-thumbs-up"></i> <?php echo $user->total_like; ?></span>
									<span class="info-text"><i class="fa fa-download"></i> <?php echo $user->download; ?></span>
								</div>

								<?php if ($this->session->userdata('is_login') == TRUE): ?>
									<?php $follow = check_follower($user->id); ?>
									<?php if ($follow == 0): ?>
										<a href="#" id="follow_<?php echo $user->id; ?>" data-id="<?php echo $user->id; ?>" class="btn btn-info btn-sm mfollow">Follow</a>
									<?php else: ?>
										<a href="#" id="unfollow_<?php echo $user->id; ?>" data-id="<?php echo $user->id; ?>" class="btn btn-info btn-sm munfollow">Following</a>
									<?php endif ?>
								<?php endif ?>

							</div>
						</a>
					</div>
				</div>

			<?php endforeach ?>

		</div>

	</div>

	<div class="center p-30">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	
</div>
<!-- end Main Wrapper -->