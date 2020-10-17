

<!-- BEGIN # LOGIN MODAL LOGIN -->
	<?php include'popup-login.php'; ?>
<!-- END # MODAL LOGIN -->




<?php 
	$categories = get_categories();
	$pages 		= get_pages();
 ?>

<div class="footer-wrapper scrollspy-footer">
	<footer class="main-footer">
		<div class="container">
			<div class="row">

				<div class="col-xs-12 col-sm-12 col-sm-8 col-md-5">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<h4 class="footer-title"><?php echo $settings->site_name; ?></h4>
							<p><?php echo $settings->footer_about; ?></p>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-xs-12 col-sm-12 col-sm-4 col-md-3 mb-30-xs">
					<h4 class="footer-title">Pages</h4>
					<ul class="menu-footer">
						<?php foreach ($pages as $page): ?>
							<li><a href="<?php echo base_url('page/details/'.$page['slug']) ?>"><?php echo $page['title']; ?></a></li>
						<?php endforeach ?>
					</ul>
				</div>
				
				

				<div class="col-xs-12 col-sm-12 col-sm-8 col-md-3">
					<h4 class="footer-title">Categories</h4>
					<ul class="menu-footer">
						<?php foreach ($categories as $category): ?>
							<li><a href="<?php echo base_url('photos/category/'.md5($category['id'])) ?>"><?php echo $category['name']; ?></a></li>
						<?php endforeach ?>
							<li><a href="<?php echo base_url('photos') ?>" class="c-p">More <i class="fa fa-long-arrow-right"></i></a></li>
					</ul>
				</div>
			</div>
			

			<?php if ($settings->facebook || $settings->twitter || $settings->google != ''): ?>
				<div class="bb mt-20"></div>
			<?php endif ?>
			
			<div class="mb-20"></div>
			<div class="social-footer clearfix">
				<?php if($settings->facebook != ''): ?>
					<a target="_blank" href="http://<?php echo $settings->facebook; ?>"><i class="fa fa-facebook-official"></i></a>
				<?php endif ?>
				<?php if($settings->twitter != ''): ?>
					<a target="_blank" href="http://<?php echo $settings->twitter; ?>"><i class="fa fa-twitter"></i></a>
				<?php endif ?>
				<?php if($settings->google != ''): ?>
					<a target="_blank" href="http://<?php echo $settings->google; ?>"><i class="fa fa-google-plus "></i></a>
				<?php endif ?>
				<?php if($settings->flicker != ''): ?>
					<a target="_blank" href="http://<?php echo $settings->flicker; ?>"><i class="fa fa-flickr"></i></a>
				<?php endif ?>
			</div>
			
		</div>
		
	</footer>
	
	<footer class="secondary-footer">
	
		<div class="container">
		
			<div class="row">
			
				<div class="col-sm-6">
					<p class="copy-right"> <?php echo $settings->copyright; ?></p>
				</div>
				
				<div class="col-sm-6">
					<ul class="secondary-footer-menu clearfix">
						<?php if ($this->session->userdata('is_login') == TRUE): ?>
							<li><a href="<?php echo base_url('user/profile/'.md5($this->session->userdata('id'))) ?>">My Account</a></li>
						<?php else: ?>
						<li><a data-toggle="modal" href="#loginModal">Sign-in</a></li>
						<li><a data-toggle="modal" href="#loginModal">Sign-up</a></li>
						<?php endif ?>
					</ul>
				</div>
				
			</div>
		
		</div>
		
	</footer>
	
</div>
		
 </div> <!-- / .wrapper -->
	<!-- end Container Wrapper -->
 
 
 <!-- start Back To Top -->
<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
<!-- end Back To Top -->

<input type="hidden" id="input_file_limit" value="<?php echo $settings->input_file_limit; ?>">
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
<!-- JS -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/SmoothScroll.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.placeholder.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.introLoader.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/plyr.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.flex-images.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.countimator.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.simpletip-1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/bootstrap-imageupload.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

<!-- addthis share plugin -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5abfcb04ce6a7ba0"></script>

<!-- custom js -->
<script type="text/javascript" src="<?php echo base_url()?>assets/js/customs.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/my.js"></script>

<script src="<?php echo base_url()?>assets/js/sweet-alert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqBootstrapValidation/1.3.7/jqBootstrapValidation.js"></script>
<script type="text/javascript" src="http://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>


<script type="text/javascript">

	var $imageupload = $('.imageupload');
    $imageupload.imageupload();

    $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );

    $(document).on("keypress", "#img-upload-form", function(event) { 
	    return event.keyCode != 13;
	});

	$('textarea.mgs_text_area').maxlength({
        alwaysShow: true
    });

</script>


<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', () => { 
	  // This is the bare minimum JavaScript. You can opt to pass no arguments to setup.
	  const player = new Plyr('#player');

	  // Bind event listener
	  function on(selector, type, callback) {
	    document.querySelector(selector).addEventListener(type, callback, false);
	  }

	  // Play
	  on('.js-play', 'click', () => { 
	    player.play();
	  });

	  // Pause
	  on('.js-pause', 'click', () => { 
	    player.pause();
	  });

	  // Stop
	  on('.js-stop', 'click', () => { 
	    player.stop();
	  });

	  // Rewind
	  on('.js-rewind', 'click', () => { 
	    player.rewind();
	  });

	  // Forward
	  on('.js-forward', 'click', () => { 
	    player.forward();
	  });
	});
</script>


</body>

</html>