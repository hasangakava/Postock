<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php foreach ($image_comment as $cmt): ?>
	<div class="comment-wrap mt-20" id="row_<?php echo $cmt->id; ?>">
		<div class="photo">
			<?php if ($cmt->thumb == ''){ 
				$profile_pic = 'assets/images/avatar.png';
			}else {
				$profile_pic = $cmt->thumb;
			} ?>
			<div class="avatar" style="background-image: url(<?php echo base_url($profile_pic); ?>)">
			</div>
		</div>
		<div class="comment-block">
			<div class="bottom-comment mb-5">
				<div class="comment-name"><?php echo $cmt->name; ?> </div>
				<ul class="comment-date">
					<li class="complain"><?php echo get_time_ago($cmt->date_time); ?></li>

					<?php if ($this->session->userdata('id') == $cmt->user_id): ?>
						<li class="complain"><a data-id="<?php echo $cmt->id; ?>" class="delete_cmt" href="<?php echo base_url('photos/delete_comment/'.$cmt->id) ?>" style="color: red"><i class="fa fa-trash"></i></a></li>
					<?php endif ?>
					
				</ul>
			</div><br>
			<p class="comment-text"><?php echo $cmt->comment; ?></p>
		</div>
	</div>
<?php endforeach ?>