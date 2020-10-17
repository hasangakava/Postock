<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>



<!-- start Main Wrapper -->
<div class="main-wrapper">
	
	<?php include'inc/banner.php'; ?>
	

	<div class="grid-box"> 
	   	<div id="masonry5">
            <?php foreach ($videos as $video): ?>
                <div class=" slideInUp item img-grid" id="video_<?php echo $video->id; ?>">
                    <video width="320" height="240" poster="" id="player" playsinline controls>
                        <source src="<?php echo base_url($video->path); ?>" type="<?php echo $video->file_type ?>">
                        <source src="<?php echo base_url($video->path); ?>" type="video/webm">
                    </video>


                    <div class="col-sm-6 p-0 m-t-5 ">
                        <?php echo $video->title; ?>
                    </div>
                    <div class="col-sm-6 p-0 m-t-5 text-right">
	                    <?php if ($video->status == 0): ?>
	                    	<span class="label label-danger">Pending</span>
	                    <?php endif ?>
                    </div>

                    <div class="col-sm-12 p-0 m-t-5 ">
                        <a href="<?php echo base_url('user/edit_video/'.$user_id.'/'.$video->id) ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo base_url('user/delete_video/'.$video->id) ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                    </div>


                </div>
            <?php endforeach ?>
        </div>
	</div>

	<div class="center p-30">
		<?php echo $this->pagination->create_links(); ?>
	</div>
	
</div>
<!-- end Main Wrapper -->