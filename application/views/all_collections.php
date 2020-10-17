<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>

    		<div class="container text-center">
        		<p class="text-head ts"><?php echo $total; ?> - Collections</p>
	            <div class="breadcrumbs_path ts">
	                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i> All collections
	            </div>      
    		</div>
		</div>
	</div>



	<div class="container">
		<div class="row">

			<?php if (count($collections) == ''): ?>
		
				<div class="not-found center mt-20 mb-20">
					<p><i class="fa fa-picture-o fa-3x"></i> <br><br> No collections found</p>
				</div>

			<?php else: ?>
		
				<?php foreach ($collections as $col): ?>
					
					<div class="col-md-4 main-box">
						
						<p class="cat-title "><?php echo $col['title']; ?></p>
				
						<p>(<b><?php echo $col['total']; ?></b>) Photos | Created by - <?php echo $col['user_name']; ?></p>
						<p class="mb-10"><?php echo get_time_ago($col['created_at']); ?></p>

						<a href="<?php echo base_url('photos/single_collection/'.$col['id']) ?>">

							<?php if (count($col['collection_img']) == ''): ?>
								<div class="snot-found center">
									<p><i class="fa fa-picture-o fa-3x"></i> <br><br> You have not collect any image </p>
								</div>
							<?php else: ?>

							<div class="row">
								<?php if (count($col['collection_img']) == 1): ?>

									<?php foreach ($col['collection_img'] as $img): ?>
										<div class="col-md-12 inner-box-full" style="background-image: url(<?php echo resize_img($img['image'], 300, 300); ?>);"></div>
									<?php endforeach ?>

								<?php else: ?>

									<?php $i = 0; foreach ($col['collection_img'] as $img): ?>
										<div class="<?php if($i == 0){echo "col-md-12";}else{echo "col-md-4 col-xs-4";} ?> <?php if($i == 1){echo "ldl";}?> <?php if($i == 3){echo "rdl";}?> inner-box-small" style="background-image: url(<?php echo resize_img($img['image'], 300, 300); ?>);"></div>
									<?php $i++; endforeach ?>

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