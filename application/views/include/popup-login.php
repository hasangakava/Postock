<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade modal-login modal-border-transparent" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
	
	<div class="modal-dialog">
	
		<div class="modal-content">
			
			<button type="button" class="btn btn-close close" data-dismiss="modal" aria-label="Close">
				<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			</button>
			
			<div class="clear"></div>
			
			<!-- Begin # DIV Form -->
			<div id="modal-login-form-wrapper">
				
				<!-- Begin # Login Form -->
				<form id="login-form" method="post" action="<?php echo base_url('auth/log'); ?>">
				

					<div class="modal-body pb-5">
				
						<h4>Sign-in</h4>
			
						
						<div class="form-group"> 
							<input name="user_name" class="form-control" placeholder="Email" type="text" autocomplete="off"> 
						</div>
						<div class="form-group"> 
							<input name="password" class="form-control" placeholder="Password" type="password" autocomplete="off"> 
						</div>
		
						<div class="form-group mt-10 mb-10">
							<div class="row gap-5">
								<div class="col-xs-6 col-sm-6 col-md-6">
									
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6 text-right mt-5"> 
									<button id="login_lost_btn" type="button" class="btn btn-link">forgot pass?</button>
								</div>
							</div>
						</div>
					
					</div>
					
					<!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

					<div class="modal-footer">
						<div class="row gap-10">
							<div class="col-xs-6 col-md-12 mb-10">
								<button type="submit" class="btn btn-info btn-block">Sign-in</button>
							</div>
							<!-- <div class="col-xs-6 col-sm-6 mb-10">
								<button type="button" class="btn btn-main btn-block btn-inverse" data-dismiss="modal" aria-label="Close">Cancel</button>
							</div> -->
						</div>
						<div class="text-left">
							No account? 
							<button id="login_register_btn" type="button" class="btn btn-link">Register</button>
						</div>
					</div>
				
				</form>
				<!-- End # Login Form -->
							






				<!-- Begin | Lost Password Form -->
				<form id="lost-form" method="post" action="<?php echo base_url('auth/forgot_password') ?>" style="display:none;">
					<div class="modal-body pb-5">
					
						<h4>Forgot password</h4>

						<div class="form-group"> 
							<input id="lost_email" name="email" class="form-control" type="text" placeholder="Enter Your Email">
						</div>
						
						<div class="text-center mt-10 mb-10">
							<button id="lost_login_btn" type="button" class="btn btn-link">Sign-in</button> or 
							<button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
						</div>
						
					</div>

					<!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					
					<div class="modal-footer mt-10">
						
						<div class="row gap-10">
							<div class="col-xs-6 col-sm-6">
								<button type="submit" class="btn btn-info btn-block">Submit</button>
							</div>
							<div class="col-xs-6 col-sm-6">
								<button type="submit" class="btn btn-main btn-inverse btn-block" data-dismiss="modal" aria-label="Close">Cancel</button>
							</div>
						</div>
						
					</div>
					
				</form>
				<!-- End | Lost Password Form -->
							







				<!-- Begin | Register Form -->
				<form id="register-form" method="post" action="<?php echo base_url('auth/register'); ?>" style="display:none;">

					<div class="modal-body pb-5">

						<h4>Register</h4>
						
						
						
						<div class="form-group"> 
							<input id="name" name="first_name" class="form-control" type="text" placeholder="Name" autocomplete="off"> 
						</div>
						
						<div class="form-group"> 
							<input id="email" name="email" class="form-control" type="email" placeholder="Email" autocomplete="off">
						</div>
						
						<div class="form-group"> 
							<input id="password" name="password" class="form-control" type="password" placeholder="Password" >
						</div>
						
						<div class="clear mb-10"></div>

					</div>

					<!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
						
					<div class="modal-footer mt-10">
					
						<div class="row gap-10">
							<div class="col-xs-6 col-sm-6 mb-10">
								<button type="submit" class="btn btn-info btn-md btn-block">Register</button>
							</div>
							<div class="col-xs-6 col-sm-6 mb-10">
								<button type="button" class="btn btn-main btn-md btn-inverse btn-block" data-dismiss="modal" aria-label="Close">Cancel</button>
							</div>
						</div>
						
						<div class="text-left">
								Already have account? <button id="register_login_btn" type="button" class="btn btn-link">Sign-in</button>
						</div>
						
					</div>
						
				</form>
				<!-- End | Register Form -->
							
			</div>
			<!-- End # DIV Form -->
							
		</div>
	</div>

</div>
<!-- END # MODAL LOGIN -->