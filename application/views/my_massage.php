<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">
			<?php include'include/load_banner_img.php'; ?>

    		<div class="container">
        		<div class="row">
        			<div class="col-md-12 text-center">
        				<p class="text-head ts"><?php echo $page_title; ?></p>
			            <div class="breadcrumbs_path ts">
			                <a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i>    <?php echo $page_title; ?>s
			            </div> 
        			</div>
        		</div>     
    		</div>

		</div>
	</div>


	<div class="fix my_message_area mt-10">
		<div class="fix my_message structer">
			<div class="fix my_message_left floatleft">
				
			</div>
			<div class="fix my_message_right floatleft">
				<div class="message_heading fix">
					<div class="fix my_message_heading floatleft">
						<h4><i class="fa fa-comments"></i> Messages <?php if($total_mgs_with != 0){echo "with ".$total_mgs_with." members";} ?></h4>
					</div>

					<div id="cancel_icon" class="close_message floatright" style="display: none;">
	                    <a class="btn btn-danger" hreff="#">X</a>
	                </div>
				</div>
				<div class="fix message_heading_bottom_area">

					<div id="load_message" class="load_message">
						<?php echo $mgs_part; ?>
					</div>
					<div class="fix message_heading_bottom_right">
						<?php foreach($mgs_with as $mgs_p):?>
							<a class="mgs_with_btn <?php if(md5($mgs_p['id']) == $mgs_with_id){echo 'msg_active';};?>" data-target="<?php echo md5($mgs_p['id']); ?>" href="#">
								<div class="fix single_message_heding_btm floatleft mgs_list">
									<div class="single_message_heding_btm_img floatleft">
										<?php 
											if($mgs_p['thumb'] == ''){
												$profile_pic = 'assets/images/avatar.png';
											}else{
												$profile_pic = $mgs_p['thumb'];
											}
										?>
										<img src="<?php echo base_url($profile_pic);?>">
									</div>

									<div class="floatright mgs_list">
									<div class="single_message_heding_btm_name">
										<h5><span class="label label-primary"><?php echo $mgs_p['name']; ?></span></h5>
										<p class="c-b"><?php echo my_date_show_time($mgs_p['mgs_time']);?></p>
										<p><b><?php echo substr(strip_tags($mgs_p['message']), 0, 100); ?></b></p>
									</div>

									</div>
								</div>
							</a>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div><br>


</div>