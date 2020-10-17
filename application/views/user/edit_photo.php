<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<!-- start Main Wrapper -->
<div class="main-wrapper">


	<!-- include Banner -->
	<?php include'inc/banner.php'; ?>

	

	<div class="container">

		<div class="col-xs-12 col-sm-8 col-md-12 mt-30">
			
			<div class="panel panel-default shadow1 p-50">
				<!-- <div class="panel-heading text-center"><i class="fa fa-cloud-upload"></i> Upload Images</div> -->
			  	<div class="panel-body">

			  		<form method="post" action="<?php echo base_url('user/edit_image/'.$image->user_id.'/'.$image->id) ?>" id="upload-form">

				  		<div class="img-up mb-20" style="padding: 20px">
		                                
							<div class="image col-md-5 col-xs-12 col-sm-12">
								<img width="80%" src="<?php echo base_url($image->image); ?>"><br>
							</div>
							
							<div class="content col-md-7 col-xs-12 col-sm-12">
							
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group error">
											<label>Title</label>
											<input type="text" name="title" class="form-control" value="<?php echo $image->title; ?>" />
										</div>
									</div>

									<div class="col-sm-12">
										<div class="form-group">
		                                    <label class="ltext">Tags</label>
		                                    <input type="text" data-role="tagsinput" name="tags[]" value="<?php echo $tags; ?>" class="form-control" >
		                                </div>
		                            </div>

									<div class="col-sm-12">
										<div class="form-group">
	                                        <label>Category</label>
	                                        <select name="category" class="form-control custom-select" aria-invalid="false" required>
	                                            <option value="0">Select Category</option>
	                                            <?php foreach ($categories as $cat): ?>
	                                            	<?php if ($cat['id'] == $image->category_id) {
	                                            		$selected = 'selected';
	                                            	} else {
	                                            		$selected = '';
	                                            	}
	                                            	 ?>
	                                            	<option <?php echo $selected; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
	                                            <?php endforeach ?>
	                                        </select>
	                                    </div>
	                                </div>

	                                <div class="col-sm-12">
										<div class="form-group">
	                                        <label>Copyright</label>
	                                        <select name="copyright" class="form-control custom-select" aria-invalid="false" required>
	                                        	<option value="0">Select Copyright</option>
	                                            <option <?php if($image->copyright == 1){echo "selected";} ?> value="1">CCO (Public Domain)</option>
	                                            <option <?php if($image->copyright == 2){echo "selected";} ?> value="2">CC-BY (Attribution)</option>
	                                        </select>
	                                    </div>
	                                </div>
									
									<!-- csrf token -->
                    				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    				
									<input type="hidden" name="id" value="<?php echo $image->id; ?>">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Save changes</button>
									</div><br>
									
								</div>
							
							</div>

						</div>
	     
					</form>

			  	</div>
			</div>

			<div class="section-title mb-10 pull-right">
				<h4 class="text-left"></h4>
			</div>


		</div>

	</div>

</div>

<!-- end Main Wrapper -->

