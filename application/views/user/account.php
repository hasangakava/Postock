<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<!-- include Banner -->
	<?php include'inc/banner.php'; ?>


	<div class="container mt-20">
		<div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-2">
			
			<h3 class="text-center"> Edit Account Info</h3>
			<div class="panel panel-default shadow1">
				
			  	<div class="panel-body">
					

					<div class="edit_account_area">
						<form method="post" enctype="multipart/form-data" action="<?php echo base_url('user/edit_account/'.$user_id) ?>">
					
							<div class="col-md-12" style="padding: 50px">
								<div class="row">

									<div class="col-sm-12">
										
										<?php if ($user->thumb == ''): ?>
											<?php $avatar = base_url('assets/images/avatar.png'); ?> 
										<?php else: ?>
											<?php $avatar = base_url($user->thumb); ?>
										<?php endif ?>

										<img width="120px" style="margin: 0 auto" src="<?php echo $avatar; ?>" alt="image" class="img-circle">
										
										<div class="avatar mt-10" style="margin: 0 auto; width: 110px;">
											<div style="position:relative;">
		                                        <a class='btn btn-info' href='javascript:;'>
		                                            <i class="fa fa-cloud-upload"></i> Change avatar
		                                            <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="photo" size="40"  onchange='$("#upload-logo").html($(this).val());'>
		                                        </a>
		                                        <br>
		                                        <span class='label label-info' id="upload-logo"></span>
		                                    </div>
										</div>

									</div>

									<div class="col-sm-6 mt-20">
										<div class="form-group error">
											<label>Name</label>
											<input type="text" class="form-control" value="<?php echo $user->first_name ?>" name="first_name" />
										</div>
									</div>

									<div class="col-sm-6 mt-20">
										<div class="form-group error">
											<label>Last Name</label>
											<input type="text" class="form-control" value="<?php echo $user->last_name ?>" name="last_name" />
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group error">
											<label>Email</label>
											<input type="text" class="form-control" value="<?php echo $user->email ?>" name="email" />
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group error">
											<label>Country</label>
											<select class="form-control" name="country">
												<option>Select country</option>
												<?php foreach ($countries as $country): ?>
													<option <?php if($user->country == $country->id){echo "selected";}else{echo "";} ?>  value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group error">
											<label>Facebook</label>
											<input type="text" class="form-control" value="<?php echo $user->fb ?>" name="fb" />
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group error">
											<label>Twitter</label>
											<input type="text" class="form-control" value="<?php echo $user->twitter ?>" name="twitter" />
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group error">
											<label>Google</label>
											<input type="text" class="form-control" value="<?php echo $user->google ?>" name="google" />
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group error">
											<label>Website</label>
											<input type="text" class="form-control" value="<?php echo $user->website ?>" name="website" />
										</div>
									</div>


									<input type="hidden" name="id" value="<?php echo md5($user->id) ?>">

									<!-- csrf token -->
                    				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
									
									<div class="col-sm-12">
										<button type="submit" class="btn btn-info pull-right">Update Info</button>
									</div>

									<div class="col-sm-12">
										<br>
										<a href="#" class="pull-right change_pass">Change Password <i class="fa fa-arrow-right"></i></a>
									</div>
									
								</div>
							</div>
						</form>
					</div>


					<div class="change_password_area dis_none">
					
						<form method="post" id="cahage_pass_form" action="<?php echo base_url('user/change_password') ?>" class="error" novalidate>

							<div class="col-md-12">
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group error">
											<label>Old Password</label>
											<input type="password" class="form-control" name="old_pass" />
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group error">
											<label>New Password</label>
											<input type="password" class="form-control" name="new_pass" />
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group error">
											<label>Confirm New Password</label>
											<input type="password" class="form-control" name="confirm_pass" />
										</div>
									</div>

									<!-- csrf token -->
                    				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

									<div class="col-sm-12">
										<button type="submit" class="btn btn-info">Change</button>
										<button type="button" class="btn btn-default cancel_pass"><i class="fa fa-times"></i></button>
									</div>
									
								</div>
							</div>
								
						</form>

					</div>

			  	</div>
			</div>

		</div>
	</div>

</div>
<!-- end Main Wrapper -->