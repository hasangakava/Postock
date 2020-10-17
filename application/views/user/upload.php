

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

			


	  		<form method="post" enctype="multipart/form-data" action="<?php echo base_url('user/upload_image') ?>" id="img-upload-form">
	  			          
				<div class="image col-md-6 col-xs-12 col-sm-12 mt-30">
					<div class="imageupload">
		                <div class="file-tab">
		                    <label class="btn btn-info btn-md btn-file">
		                        <span>Browse</span>
		                        <!-- The file is stored here. -->
		                        <input type="file" name="photo" required>
		                    </label>
		                    <button type="button" class="btn btn-danger btn-md"><i class="fa fa-times"></i></button>
		                </div>
		            </div>
				</div>

				<div class="image col-md-6 col-xs-12 col-sm-12 mt-30">
					<div class="alert alert-danger" role="alert" >
						<ul class="padding-zero">
							<li class=""><i class="glyphicon glyphicon-warning-sign myicon-right"></i>  Please read the terms and conditions to avoid sanctions</li>
							<li class="fs-11"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  You can upload <b><?php echo $settings->upload_limit; ?></b> photos per day</li>
							<li class="fs-11"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  It is not allowed images of violence or pornographic content of any kind</li>
							<li class="fs-11"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  Photos must be of Authoring</li>
							
							<?php if ($this->settings->photo_approval == 2): ?>
								<li class="fs-11"><i class="glyphicon glyphicon-info-sign myicon-right"></i>  Photo will be public after approval</li>
							<?php endif ?>

						</ul>
					</div>
				</div>
				
				<div class="content col-md-12 col-xs-12 col-sm-12 mb-30 mt-10">
					
					<div class="panel panel-default input_area">
			             <div class="panel-heading">
			                 <h3 class="panel-title">Add Info</h3>
			             </div>
			             <div class="panel-body">
		                  	<div class="row">
								<div class="col-sm-12">
									<div class="form-group error">
										<label class="ltext">Title</label>
										<input type="text" name="title" class="form-control" required/>
									</div>
								</div>

								<div class="col-sm-12">
									<div class="form-group img-tag">
	                                    <label class="ltext">Tags</label>
	                                    <input type="text" data-role="tagsinput" name="tags[]" value="" class="form-control" >
	                                </div>
	                            </div>

								<div class="col-sm-12 mt-10">
									<div class="form-group">
                                        <label class="ltext">Category</label>
                                        <select name="category" class="form-control custom-select" required>
                                            <option value="">Select Category</option>
                                            <?php foreach ($categories as $cat): ?>
                                            	<option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 mt-10">
									<div class="form-group">
		                                <div class="radio_btn_area">
											<label class="ltext">Select Copyright</label>
											<div class="form-group copyright">
												<label class="radio-inline">
											      <input type="radio" name="copyright" value="1" required>CCO (Public Domain)
											      <p>Public can copy, modify, distribute &amp; perform the work, even for commercial purposes, all without asking permission &amp; no attribution required. </p>
											    </label>
											</div>
											<div class="form-group copyright">
												<label class="radio-inline">
											      <input type="radio" name="copyright" value="2" required>All Right Reserved
											      <p>Photographer reserves, or holds all the rights, provided by copyright law. Nobody can Copy, Share or Use. </p>
											    </label>
											</div>
										</div>
									</div>
								</div>
								
								<!-- csrf token -->
                				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                				
								<div class="col-sm-3 mt-10">
									<button width="80%" type="submit" class="btn btn-info btn-block upload"><i class="fa fa-upload"></i> Upload Photo</button>
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