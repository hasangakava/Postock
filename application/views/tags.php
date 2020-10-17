<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>

    		<div class="container text-center">
        		<p class="text-head ts"><?php echo $total; ?> - Tags</p>
	            <div class="breadcrumbs_path ts">
	                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i> All tags
	            </div>      
    		</div>
		</div>
	</div>



	<div class="container">
		<div class="row">

			<div class="tag-area mt-50 mb-50">
				<?php if (count($tags) == ''): ?>
			
					<div class="not-found center mt-20 mb-20">
						<p><i class="fa fa-tags fa-3x"></i> <br><br> No tags found</p>
					</div>

				<?php else: ?>
			
					<?php foreach ($tags as $tag): ?>
						<a href="<?php echo base_url('photos/tag/'.$tag->tag_slug) ?>" type="button" class="btn btn-default btn-rounded w-md waves-effect mb-10"><?php echo $tag->tag; ?>  (<b><?php echo $tag->total_photos; ?></b>)</a>
					<?php endforeach ?>

				<?php endif; ?>
			</div>
			
		</div>
	</div>


</div>
<!-- end Main Wrapper -->