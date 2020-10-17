

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<!-- include Banner -->
	<?php include'inc/banner.php'; ?>
	
	<div class="container">

		<div class="row up-box">
			<div class="col-xs-12 col-sm-6 col-md-6 mt-30 text-center">
				<a href="<?php echo base_url('user/upload/'.$user_id) ?>" class="btn btn-default mt-10 cbtn upload-twin"><i class="fa fa-picture-o fa-3x"></i><br><br> Upload Photos</a>
			</div>

			<div class="col-xs-12 col-sm-6 col-md-6 mt-30 text-center">
				<a href="<?php echo base_url('user/add_video/'.$user_id) ?>" class="btn btn-default mt-10 cbtn upload-twin"><i class="fa fa-play-circle fa-3x"></i> <br><br> Upload Videos</a>
			</div>
		</div>
		
	</div>

</div>
<!-- end Main Wrapper -->