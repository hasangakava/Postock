

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<!-- include Banner -->
	<?php include'inc/banner.php'; ?>
	
	<div class="container">

		<div class="ploader dis_none p-20">
			<div class="spinner center">
				<div class="double-bounce1"></div>
				<div class="double-bounce2"></div><br>
				<p class="mr-20 mt-50">Uploading... </p>
			</div>
		</div>
		<div class="dis_none showup" style="min-height: 300px"></div>

		<div class="col-xs-12 col-sm-8 col-md-12 mt-30 imgup">
			
			<div class="alert-msg mt-5">
				<?php $msg = $this->session->flashdata('msg'); ?>
				<?php if (isset($msg)): ?>
					<div class="alert alert-danger pull"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
					</div>
				<?php endif ?>
			</div>

			


			<form method="post" enctype="multipart/form-data" action="<?php echo base_url('user/update_video/'.$video->id) ?>" id="video-upload-form">

				<div class="image col-md-6 col-xs-12 col-sm-12 mt-30">
					
				</div>

				<div class="image col-md-6 col-xs-12 col-sm-12 mt-30">
					<div class="alert alert-danger" role="alert" >
						<ul class="padding-zero">
							<li class=""><i class="glyphicon glyphicon-warning-sign myicon-right"></i>  Please read the terms and conditions to avoid sanctions</li>
							<li class="fs-11"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  You can upload <b><?php echo $settings->upload_limit; ?></b> videos per day</li>
							<li class="fs-11"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  It is not allowed videos of violence or pornographic of any kind</li>
							<li class="fs-11"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  Videos must be of Authoring</li>
							
							<?php if ($this->settings->photo_approval == 2): ?>
								<li class="fs-11"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  Video will be public after approval</li>
							<?php endif ?>

						</ul>
					</div>
				</div>
				
				<div class="content col-md-12 col-xs-12 col-sm-12 mb-30 mt-10">
					
					<div class="panel panel-default input_area">
						<div class="panel-heading">
							<h3 class="panel-title">Edit Video</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								

								<div class="col-md-12">
						
									<div class="form-group">
										<label class="ltext">Title</label>
										<input type="text" name="title" value="<?php echo $video->title ?>" class="form-control"/>
									</div>
							
									<div class="form-group">
				                        <input type="file" class="form-control" name="video">
				                    </div>

								</div>
								
								<!-- csrf token -->
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

								<div class="col-sm-3 mt-10">
									<button width="80%" type="submit" class="btn btn-info btn-block upload"><i class="fa fa-upload"></i> Upload Video</button>
								</div><br>


								
							</div>
						</div>
					</div>

				</div>

			</form>

			<div class="section-title mb-10 pull-right">
				<h4 class="text-left"></h4>
			</div>

		</div>
		
	</div>

</div>
<!-- end Main Wrapper -->