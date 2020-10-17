<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php foreach ($images as $img): ?>
	<div id="imgModal_<?php echo md5($img->id) ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal_area" id="load_img">
		    	<div class="modal-content">
				  <div class="modal-body cmodal" style="height: 480px; padding: 0">
				  	<button type="button" class="closem" data-dismiss="modal">&times;</button>
				   <div class="collection-img" style="background-image:url(<?php echo resize_img(base_url($img->image), 400, 600) ?>); "></div>
				
				    	<div class="create-coll dis_none ">
				        	<form method="post" action="<?php echo base_url('user/create_collection'); ?>" class="create_collection" id="create_<?php echo $img->id ?>">
							
								<div class="p-10">
									<h5>Add New Collection</h5>

									<div class="form-group"> 
										<input type="text" name="title" class="form-control minput" placeholder="Collection name" required> 
									</div>
						
									<div class="form-group"> 
										<label class="radio-inline">
									      <input type="radio" name="type" value="1" required>Public
									    </label>
									    <label class="radio-inline">
									      <input type="radio" name="type" value="2" required>Private
									    </label>
									</div>

									<a class="back_coll_btn pull-right" href="#"><i class="fa fa-angle-left"></i> Back </a>
									<!-- csrf token -->
					                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					            </div>

								<button type="submit" class="btn btn-info cus_btn_md mt-10">Create Colleciton</button>
								
							</form>
						</div>


						<div class="add-coll">
							
							<form id="add_collection_<?php echo $img->id; ?>" method="post" action="<?php echo base_url('user/add_to_collection'); ?>">

								<div class="p-10">
									<p class="ptext">Choose collection</p>

									<div class="load_cdata">
										<?php include'load_collection.php'; ?>
									</div>

									<input type="hidden" name="img_id" value="<?php echo $img->id; ?>">

									<a class="new_coll_btn pull-right mt-35" href="#">Create New Collection <i class="fa fa-angle-right"></i></a>

									<!-- csrf token -->
					                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

				                </div>
				                
								
								<button type="submit" data-id="<?php echo $img->id; ?>" class="btn btn-info add_coll_img mt-10 cus_btn_md">Add to Colleciton</button>
							
							</form>
							
						</div>

				  </div>
				 
				</div>



			</div>
		</div>
	</div>
<?php endforeach ?>