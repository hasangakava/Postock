<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start Main Wrapper -->
<div class="main-wrapper">

	<div class="banner-breadcum">
		<div class="breadcrumb-image">

			<?php include'include/load_banner_img.php'; ?>
			
			<div class="container text-center">
				<p class="text-head ts"><?php echo $total; ?> - Notifications</p>
				<div class="breadcrumbs_path ts">
					<a href="<?php echo base_url() ?>"><i class="fa fa-home"></i> Home</a>    <i class="fa fa-angle-right"></i>    All Notifications
				</div>      
			</div>
		</div>
	</div>


	<div class="container page_info">
		
		<div class="panel panel-default">
			<div class="panel-heading">All Notifications</div>
			<div class="panel-body p-0">


				<?php foreach($notification as $row):?>

					<?php 

					if($row['noti_type'] == 1){
						$noty_link = '#';
						$image = 'assets/images/admin.png';
						$message = $row['text'];

					}elseif($row['noti_type'] == 2 ){

						$image = 'assets/images/admin.png';
						$noty_link = base_url('photos/details/'.md5($row['content_id']));
						$message = $row['text'];

					}elseif($row['noti_type'] == 3 ){

						$image = 'assets/images/avatar.png';

						$noty_link = base_url('user/profile/'.md5($row['content_id']));
						$message = '<b>'.$row['name'].'</b> '.$row['text'];

					}elseif($row['noti_type'] == 4 ){

						if($row['thumb'] == ''){
							$image = 'assets/images/avatar.png';
						}else{
							$image = $row['thumb'];
						}
						$noty_link = base_url('photos/details/'.md5($row['content_id']));
						$message = '<b>'.$row['name'].'</b> '.$row['text'];

					}elseif($row['noti_type'] == 5 ){

						if($row['thumb'] == ''){
							$image = 'assets/images/avatar.png';
						}else{
							$image = $row['thumb'];
						}
						$noty_link = base_url('photos/details/'.md5($row['content_id']));
						$message = '<b>'.$row['name'].'</b> '.$row['text'];

					}elseif($row['noti_type'] == 6 ){

						if($row['thumb'] == ''){
							$image = 'assets/images/avatar.png';
						}else{
							$image = $row['thumb'];
						}
						$noty_link = base_url('photos/details/'.md5($row['content_id']));
						$message = $row['text'];

					}elseif($row['noti_type'] == 7 ){

						if($row['thumb'] == ''){
							$image = 'assets/images/avatar.png';
						}else{
							$image = $row['thumb'];
						}
						$noty_link = base_url('photos/details/'.md5($row['content_id']));
						$message = '<b>'.$row['name'].'</b> '.$row['text'];

					}elseif($row['noti_type'] == 8 ){

						if($row['thumb'] == ''){
							$image = 'assets/images/avatar.png';
						}else{
							$image = $row['thumb'];
						}
						$noty_link = base_url('message');
						$message = '<b>'.$row['name'].'</b> '.$row['text'];

					}else{

						$noty_link = '#';
						$image = 'assets/images/avatar.png';
						$message = $row['text'];
					}

					
					?>

					<div class="notificationsBody" style="padding-top: 11px">
						<a href="<?php echo $noty_link;?>">
							<div class="single_notification">
								<div class="notification_img fix floatleft">
									<div class="single_body floatleft">
										<img width="80px" class="img-circle mt-5" src="<?php echo base_url($image);?>" alt="">
									</div>
								</div>

								<div class="notification_desc fix floatright">
									<div class="nitification_date">
										<p><?php echo my_date_show_time($row['noti_time']);?></span></p>
									</div>
									<div class="nitification_name">
										<p><?php echo $message; ?></p>
									</div>
								</div>
							</div>

						</a>
					</div>
				<?php endforeach;?>

				<div class="center mt-10">
					<?php echo $this->pagination->create_links(); ?>
				</div>

			</div>
		</div>

	</div>


</div>
<!-- end Main Wrapper -->