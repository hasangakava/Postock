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
	    <div class="item img-grid" id="img_<?php echo md5($img->id); ?>">
		    <a href="<?php echo base_url('photos/details/'.md5($img->id)) ?>">

		      <img src="<?php echo resize_img(base_url($img->image), 400, 600); ?>" alt="image">

		    </a>
	      <div class="overley">
		      	<div class="img-actions">

		      		<?php $check_like = check_my_like(md5($img->id)); ?> 
					<?php $count_like = count_image_like(md5($img->id)); ?>
					
					<?php $check_collection = check_my_collection(md5($img->id)); ?>
					<?php $count_collection = count_image_collection(md5($img->id)); ?>

		      		<?php if ($this->session->userdata('is_login') == TRUE): ?>
		      			<a data-id="<?php echo md5($img->id) ?>" href="#" class="<?php if($check_like == 0){echo "like";}else{echo "unlike";} ?>"><i class="<?php if($check_like == 0){echo "iconl fa fa-thumbs-o-up";}else{echo "iconl fa fa-thumbs-up";} ?> "></i> <span class="like_count"><?php echo $count_like->total;?></span> </a> &emsp;

		      			<?php if ($check_collection == 0): ?>
			      			<a href="#" data-toggle="modal" data-target="#imgModal_<?php echo md5($img->id) ?>" data-id="<?php echo $img->id;?>"  class="add_collection"><i class="fa fa-heart-o"></i> <span class="favourite_count"><?php echo $count_collection->total;?></span></a>
			      		<?php else: ?>
			      			<a data-id="<?php echo md5($img->id) ?>" href="#" class="remove_collection"><i class="iconh fa fa-heart"></i> <span class="favourite_count"><?php echo $count_collection->total;?></span> </a>
			      		<?php endif ?>
		      		<?php else: ?>
		      			<a data-toggle="modal" href="#loginModal" class="like"><i class="fa fa-thumbs-o-up"></i> <span class="like_count"><?php echo $count_like->total;?></span> </a> &emsp;

		      			<a href="#" data-toggle="modal" data-target="#loginModal" class="add_collection"><i class="fa fa-heart-o"></i> <span class="favourite_count"><?php echo $count_collection->total;?></span></a>
		      		<?php endif ?>
		      			

		      		<a href="#"> &emsp; <i class="fa fa-eye"></i> <?php echo $img->view;?></a>
		      		<a href="#"> &emsp; <i class="fa fa-download"></i> <?php echo $img->download;?></a>
		      	</div>

		      	<input type="hidden" class="like_count_input" value="<?php echo $count_like->total;?>">
		      	<input type="hidden" class="favourite_count_input" value="<?php echo $count_collection->total;?>">


				<div class="img-info">
					<a target="_blank" href="<?php echo base_url('user/profile/'.md5($img->user_id)) ?>"><?php echo $img->name; ?> </a>
				</div>


				<?php if ($img->user_id == $this->session->userdata('id')): ?>
				  	<div class="users-action">
				  	 <a class="btn btn-default btn-circle" href="<?php echo base_url('user/edit_image/'.$img->user_id.'/'.md5($img->id)) ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

				  	 <a class="btn btn-default btn-circle delete_img" data-id="<?php echo md5($img->id);?>" href="<?php echo base_url('user/delete_img/'.md5($img->id)) ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<?php include'img_modal.php'; ?>