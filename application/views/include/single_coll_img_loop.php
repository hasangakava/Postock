<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php if (count($images) == ''): ?>
		
	<div class="not-found center">
		<p><i class="fa fa-picture-o fa-3x"></i> <br><br> No image found </p>

		<?php if (isset($page_title) && $page_title == "User" && $user->id == $this->session->userdata('id')): ?>
			<a href="<?php echo base_url('user/upload/'.$user_id); ?>" class="btn btn-info mt-50"><i class="fa fa-upload"></i> Upload your photos </a>
		<?php endif ?>
		
	</div>

<?php else: ?>

<div id="masonry<?php echo $settings->grid_columns; ?>">

	<?php foreach ($images as $img): ?>
	    <div class="slideInUp item img-grid" id="img_<?php echo md5($img->img_id); ?>">
		    <a href="<?php echo base_url('photos/details/'.md5($img->img_id)) ?>">

		      <img src="<?php echo resize_img(base_url($img->image), 400, 600); ?>" alt="image">

		    </a>
	      <div class="overley">
		      	<div class="img-actions">

		      		<?php $check_like = check_my_like(md5($img->img_id)); ?> 
					<?php $count_like = count_image_like(md5($img->img_id)); ?>
					
					<?php $check_collection = check_my_collection(md5($img->img_id)); ?>
					<?php $count_collection = count_image_collection(md5($img->img_id)); ?>

		      		<?php if ($this->session->userdata('is_login') == TRUE): ?>
		      			<a data-id="<?php echo md5($img->img_id) ?>" href="#" class="<?php if($check_like == 0){echo "like";}else{echo "unlike";} ?>"><i class="<?php if($check_like == 0){echo "iconl fa fa-thumbs-o-up";}else{echo "iconl fa fa-thumbs-up";} ?> "></i> <span class="like_count"><?php echo $count_like->total;?></span> </a> &emsp;

		      			<?php if ($check_collection == 0): ?>
			      			<a href="#" data-toggle="modal" data-target="#imgModal_<?php echo md5($img->img_id) ?>" data-id="<?php echo $img->img_id;?>"  class="add_collection"><i class="fa fa-heart-o"></i> <span class="favourite_count"><?php echo $count_collection->total;?></span></a>
			      		<?php else: ?>
			      			<a data-id="<?php echo md5($img->img_id) ?>" href="#" class="remove_collection"><i class="iconh fa fa-heart"></i> <span class="favourite_count"><?php echo $count_collection->total;?></span> </a>
			      		<?php endif ?>
		      		<?php else: ?>
		      			<a data-toggle="modal" href="#loginModal" class="like"><i class="fa fa-thumbs-o-up"></i> <span class="like_count"><?php echo $count_like->total;?></span> </a> &emsp;

		      			<a href="#" data-toggle="modal" data-target="#loginModal" class="add_collection"><i class="fa fa-heart-o"></i> <span class="favourite_count"><?php echo $count_collection->total;?></span></a>
		      		<?php endif ?>
		      		

		      		<a href="#"> &emsp; <i class="fa fa-eye"></i> <?php echo $img->view;?></a>
		      	</div>

		      	<input type="hidden" class="like_count_input" value="<?php echo $count_like->total;?>">
		      	<input type="hidden" class="favourite_count_input" value="<?php echo $count_collection->total;?>">



				<div class="img-info">
					<?php echo $img->name; ?> 
				</div>


				<?php if ($img->owner_id == $this->session->userdata('id')): ?>
				  	<div class="users-action">
				  	 <a class="btn btn-default btn-circle" href="<?php echo base_url('user/edit_image/'.$img->user_id.'/'.md5($img->img_id)) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

				  	 <a class="btn btn-default btn-circle delete_img" data-id="<?php echo md5($img->img_id);?>" href="<?php echo base_url('user/delete_img/'.md5($img->img_id)) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
				  	</div>
				<?php endif ?>
		      	
		  </div>


		  <?php if ($img->is_featured == 1): ?>
		  		<div class="img-award"> <i class="fa fa-star" aria-hidden="true"></i></div>
		  <?php endif ?>


	    </div>
    <?php endforeach ?>

</div>

<?php endif ?>




<!-- Add to collection modal -->

<?php foreach ($images as $img): ?>
	<div id="imgModal_<?php echo md5($img->img_id) ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal_area" id="load_img">
		    	<div class="modal-content">
				  <div class="modal-body cmodal" style="height: 480px; padding: 0">
				  	<button type="button" class="closem" data-dismiss="modal">&times;</button>
				   <div class="collection-img" style="background-image:url(<?php echo base_url($img->image) ?>); "></div>
				
				    	<div class="create-coll dis_none ">
				        	<form method="post" action="<?php echo base_url('user/create_collection'); ?>" class="create_collection" id="create_<?php echo $img->img_id ?>">
							
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
							
							<form id="add_collection_<?php echo $img->img_id; ?>" method="post" action="<?php echo base_url('user/add_to_collection'); ?>">

								<div class="p-10">
									<p class="ptext">Choose collection</p>

									<div class="load_cdata">
										<?php include'load_collection.php'; ?>
									</div>

									<input type="hidden" name="img_id" value="<?php echo $img->img_id; ?>">

									<a class="new_coll_btn pull-right mt-35" href="#">Create New Collection <i class="fa fa-angle-right"></i></a>

									<!-- csrf token -->
					                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

				                </div>
				                
								
								<button type="submit" data-id="<?php echo $img->img_id; ?>" class="btn btn-info add_coll_img mt-10 cus_btn_md">Add to Colleciton</button>
							
							</form>
							
						</div>

				  </div>
				 
				</div>



			</div>
		</div>
	</div>
<?php endforeach ?>


<!-- End modal -->