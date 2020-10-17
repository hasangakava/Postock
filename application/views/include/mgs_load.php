<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="message_area_full clr">
	<div class="message_area">
		<?php if(count($message) == 0):?>
		<div class="data_not_found msg_not fix">
			<i class="fa fa-frown-o fa-2x"></i>
			<h4>No Message found !</h4>
		</div>
		<?php else:?>
		<?php foreach($message as $mgs):?>
			<?php if($mgs['mgs_from'] == $this->session->userdata('id')):?>
			<div class="single_sms_part text-right  style_single_msg fix">
				
				<div class="sms_text style_single_msg fix floatleft">
					<div class="sms_date_time  text-right fix">
					<?php echo get_time_ago($mgs['mgs_time']);?>
					</div>
					<div class="sms_description fix">
					<?php $mgs = preg_replace( "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~", "<a target='_blank' style='color: #3399ff' href=\"\\0\">\\0</a>", $mgs['message']); ?>

						<?php echo $mgs;?>
					</div>
				</div>
			</div>
			<?php else:?>
			<div class="single_sms_part fix">
				<div class="sms_author fix floatleft">

					<?php 
						if($mgs['thumb'] == ''){
							$profile_pic = 'assets/images/avatar.png';
						}else{
							$profile_pic = $mgs['thumb'];
						}
					?>
					
					<img src="<?php echo base_url($profile_pic);?>">

				</div>
				<div class="sms_text fix floatleft">
					<div class="sms_date_time fix">
					<b><?php echo $mgs['first_name'];?></b>
					<?php echo get_time_ago($mgs['mgs_time']);?>
					</div>
					<div class="sms_description fix">
					<?php $mgs = preg_replace( "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~", "<a target='_blank' style='color: #3399ff' href=\"\\0\">\\0</a>", $mgs['message']); ?>

						<?php echo $mgs;?>
					</div>
				</div>
			</div>

			<?php endif;?>
		<?php endforeach;?>	
		<?php endif;?>
	</div>
	<div class="mgs_btm_for_csroll"></div>
</div>


<?php if(count($message) != 0):?>
<form method="post" class="send_message_form" action="<?php echo base_url('message/send');?>">
	<div class="write_sms_area fix">
		<div class="your_comment_area fix mt-10">
			<div class="fix">
				<textarea class="form-control msg_enter mgs_text_area" maxlength="<?php echo $settings->mgs_char_length; ?>" rows="2" required name="message"></textarea>
				
				<input type="hidden" name="mgs_to" value="<?php echo $mgs_with_id;?>">

			</div>
		</div>
		<div class="your_others fix">
			
			<!-- csrf token -->
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

			<div class="your_submission floatright fix mt-10">
				<button type="submit" class="btn btn-info submission_text">Send</button>
			</div>					
		</div>
	</div>
</form>
<?php endif;?>