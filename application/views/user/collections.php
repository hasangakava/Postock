<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<!-- start Main Wrapper -->
<div class="main-wrapper">

	<?php include'inc/banner.php'; ?>



	<div class="container">
		<div class="row">

			<?php if (count($collections) == ''): ?>
		
				<div class="not-found center mt-10">
					<p><i class="fa fa-picture-o fa-3x"></i> <br><br> No photos in your collections</p>
				</div>

			<?php else: ?>
		
				<?php foreach ($collections as $col): ?>
					
					<div class="col-md-4 main-box">
						
						<p class="cat-title "><?php echo $col['title']; ?></p>
						
						<p class="mb-10">(<b><?php echo $col['total']; ?></b>) Photos | <b><?php if($col['type'] == 1){echo "Public";}else{echo 'Private';} ?></b> Collections</p>
					

						<a href="<?php echo base_url('user/single_collection/'.$col['id'].'/'.$user_id) ?>">

							<?php if (count($col['collection_img']) == ''): ?>
								<div class="snot-found center">
									<p><i class="fa fa-picture-o fa-3x"></i> <br><br> You have not collect any image </p>
								</div>
							<?php else: ?>

							<div class="row colls-row">
								<?php if (count($col['collection_img']) == 1): ?>

									<?php foreach ($col['collection_img'] as $img): ?>
										<div class="col-md-12 inner-box-full" style="background-image: url(<?php echo resize_img($img['image'], 300, 300); ?>);"></div>
									<?php endforeach ?>

								<?php else: ?>

									<?php $i = 0; foreach ($col['collection_img'] as $img): ?>
										<div class="<?php if($i == 0){echo "col-md-12";}else{echo "col-md-4 col-xs-4";} ?> <?php if($i == 1){echo "ldl";}?> <?php if($i == 3){echo "rdl";}?> inner-box-small" style="background-image: url(<?php echo resize_img($img['image'], 300, 300); ?>);"></div>
									<?php $i++; endforeach ?>

								<?php endif ?>

								<?php if ($col['user_id'] == $this->session->userdata('id')): ?>
									<a data-toggle="modal" href="#editCollModal_<?php echo $col['id']; ?>" class="edit_collection"><i class="fa fa-pencil"></i> Edit Collection</a>
								<?php endif ?>
								
							</div>

							<?php endif ?>

						</a>
					</div>

				<?php endforeach ?>

			<?php endif; ?>
			
		</div>
	</div>


</div>
<!-- end Main Wrapper -->


<!-- edit collection modal -->
	<?php foreach ($collections as $col): ?>
		<div id="editCollModal_<?php echo $col['id']; ?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal_area">
			    	<div class="modal-content">
					  <div class="modal-body cmodal" style="height: 200px; padding: 0">
					  	<button type="button" class="closem" data-dismiss="modal">&times;</button>
					   	
					
					    	<div class="create-coll">
					        	<form method="post" action="<?php echo base_url('user/edit_collection/'.$col['id']); ?>" id="edit_collection">
								
									<div class="p-10">
										<h5>Edit Collection</h5>

										<div class="form-group mt-30"> 
											<input type="text" name="title" class="form-control minput" value="<?php echo $col['title']; ?>"> 
										</div>
							
										<div class="form-group"> 
											<label class="radio-inline">
										      <input <?php if($col['type'] == 1){echo "checked";}else{echo "";} ?> type="radio" name="type" value="1" required>Public
										    </label>
										    <label class="radio-inline">
										      <input <?php if($col['type'] == 2){echo "checked";}else{echo "";} ?> type="radio" name="type" value="2" required>Private
										    </label>
										</div>

										<!-- csrf token -->
						                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
						            </div>

									<button type="submit" class="btn btn-info cus_btn_md mt-10">Edit Colleciton</button>
									
								</form>
							</div>


					  </div>
					 
					</div>



				</div>
			</div>
		</div>
	<?php endforeach ?>
<!-- edit collection modal -->