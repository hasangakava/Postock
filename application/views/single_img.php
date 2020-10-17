<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="main-wrapper">
	<div class="content-wrapper">
		<div class="detail-wrapper">
			<div class="container">
				<div class="section-sm">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-8">
							
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 mb-30-sm">
									<div class="detail-image mb-10">

										<img src="<?php echo base_url($image->image); ?>" alt="Images" />
										
									</div>
									
									<div class="detail-sm-section mt-20 mb-20">
										
										<?php if (count($tags) != 0): ?>
											<p class="ptext"><i class="fa fa-tags"></i> Tags</p>
											<?php foreach ($tags as $tag): ?>
												<a href="<?php echo base_url('photos/tag/'.$tag->tag_slug) ?>" type="button" class="btn btn-default btn-rounded w-md waves-effect m-b-5"><?php echo $tag->tag; ?></a>
											<?php endforeach ?>
										<?php endif ?>
										
									</div>

									
								</div>
							</div>
							
						</div>

						<div class="col-xs-12 col-sm-12 col-md-4">
							<div class="row gap-20">
								<div class="col-xs-12 col-sm-6 col-md-12 mb-10 right-img-ingo shadow1">
									
									<div class="detail-person clearfix">
										<div class="image">

											<?php if ($image->user_img == ''): 
											$avatar = 'assets/images/avatar.png';
											else: 
												$avatar = $image->user_img;
											endif ?>
											
											<a href="<?php echo base_url('user/profile/'.md5($image->user_id)) ?>">
												<img class="img-circle" src="<?php echo base_url($avatar) ?>" />
											</a>
										</div>
										<div class="content">
											<a href="<?php echo base_url('user/profile/'.md5($image->user_id)) ?>" class="block"><?php echo $image->uploader_name; ?></a>
											<p><i class="fa fa-camera"></i> <?php echo $image->total_photos ?> &nbsp; <i class="fa fa-thumbs-up"></i> <?php echo $image->total_like; ?> &nbsp; <i class="fa fa-eye"></i> <?php echo $image->total_view; ?> &nbsp; <i class="fa fa-download"></i> <?php echo $image->user_download; ?></p>
											

											<?php if($this->session->userdata('is_login') == TRUE):?>
												<?php $follow = check_follower($image->user_id); ?>
												<?php if ($follow == 0): ?>
													<a href="#" data-id="<?php echo $image->user_id; ?>" class="btn btn-info btn-sm follow">Follow</a>
												<?php else: ?>
													<a href="#" data-id="<?php echo $image->user_id; ?>" class="btn btn-info btn-sm unfollow">Following</a>
												<?php endif ?>
											<?php endif ?>

										</div>
									</div>
								</div>
								
								<div class="col-xs-12 col-sm-6 col-md-12 mb-10" style="padding: 0 !important">
									
									<?php $check_like = check_my_like(md5($image->id)); ?> 
									<?php $count_like = count_image_like(md5($image->id)); ?>

									<?php $check_collection = check_my_collection(md5($image->id)); ?>
									<?php $count_collection = count_image_collection(md5($image->id)); ?>

									<div class="social-share clearfix">
										
										<?php if($this->session->userdata('is_login') == TRUE):?>
											<a data-toggle="tooltip" data-placement="top" title="Like" href="#" data-id="<?php echo md5($image->id) ?>" id="like" class="social-twitter <?php if($check_like == 1){echo "dis_none";}else{echo "";} ?>">
												<span class="block">
													<i class="fa fa-thumbs-o-up"></i> <span class="like_count"><?php echo $count_like->total;?></span>
												</span>
											</a>
											<a data-toggle="tooltip" data-placement="top" title="Liked" href="#" data-id="<?php echo md5($image->id) ?>" id="unlike" class="social-twitter <?php if($check_like == 0){echo "dis_none";}else{echo "";} ?>">
												<span class="block likes">
													<i class="fa fa-thumbs-up"></i> <span class="like_count"><?php echo $count_like->total;?></span>
												</span>
											</a>

											<!-- add to collection -->
											<a href="#" data-toggle="modal" data-target="#imgModals_<?php echo md5($image->id) ?>" data-id="<?php echo $image->id;?>" class="social-twitter add_collection <?php if($check_collection == 1){echo "dis_none";}else{echo "";} ?>">
												<span class="block">
													<i class="fa fa-heart-o"></i> <span class="favourite_count"><?php echo $count_collection->total;?></span>
												</span>
											</a>



											<a href="#" data-id="<?php echo md5($image->id) ?>" id="cancel_favourite" class="social-twitter remove_collection <?php if($check_collection == 0){echo "dis_none";}else{echo "";} ?>">
												<span class="block fav">
													<i class="fa fa-heart"></i> <span class="favourite_count"><?php echo $count_collection->total;?></span>
												</span>
											</a>

										<?php else: ?>
											<a data-toggle="modal" href="#loginModal" class="social-twitter">
												<span class="block">
													<i class="fa fa-thumbs-o-up"></i> <?php echo $count_like->total;?>
												</span>
											</a>
											<a data-toggle="modal" href="#loginModal" class="social-twitter">
												<span class="block">
													<i class="fa fa-heart-o"></i> <?php echo $count_collection->total;?>
												</span>
											</a>
										<?php endif ?>
										<input type="hidden" class="like_count_input" value="<?php echo $count_like->total;?>">
										<input type="hidden" class="favourite_count_input" value="<?php echo $count_collection->total;?>">

										<a href="#" class="social-twitter">
											<span class="block">
												<i class="fa fa-eye"></i> <?php echo $image->view; ?>
											</span>
										</a>

										<a href="#" class="social-twitter">
											<span class="block">
												<i class="fa fa-download"></i> <?php echo $image->download; ?>
											</span>
										</a>

									</div>

									<?php if ($settings->photo_download == 1): ?>
										
										<?php if ($this->session->userdata('is_login') == true): ?>

											<div class="dropdown mb-10 mt-20">
												<button class="btn btn-info btn-block dropdown-toggle p-10" type="button" data-toggle="dropdown"><i class="fa fa-cloud-download"></i> Download
													<span class="caret"></span></button>
													<ul class="dropdown-menu">
														<li><a href="<?php echo base_url('photos/download_img/1/'.md5($image->id)) ?>">Small <span style="float:right">600 x 400 </span> </a></li>
														<li><a href="<?php echo base_url('photos/download_img/2/'.md5($image->id)) ?>">Medium <span style="float:right">1200 x 700 </span> </a></li>
														<li><a href="<?php echo base_url('photos/download_img/3/'.md5($image->id)) ?>">Large <span style="float:right">1920 x 1080 </span> </a></li>
														<li><a href="<?php echo base_url('photos/download_img/4/'.md5($image->id)) ?>">Original <span style="float:right"><?php echo $image->width.'x'.$image->height; ?> </span> </a></li>
													</ul>
												</div>

											<?php else: ?>
												<button class="btn btn-info btn-block dropdown-toggle p-10" type="button" data-toggle="modal" href="#loginModal"><i class="fa fa-cloud-download"></i> Download</button>
											<?php endif ?>
										<?php else: ?>
											<div class="dropdown mb-10 mt-20">
												<button class="btn btn-info btn-block dropdown-toggle p-10" type="button" data-toggle="dropdown"><i class="fa fa-cloud-download"></i> Download
													<span class="caret"></span></button>
													<ul class="dropdown-menu">
														<li><a href="<?php echo base_url('photos/download_img/1/'.md5($image->id)) ?>">Small <span style="float:right">600 x 400 </span> </a></li>
														<li><a href="<?php echo base_url('photos/download_img/2/'.md5($image->id)) ?>">Medium <span style="float:right">1200 x 700 </span> </a></li>
														<li><a href="<?php echo base_url('photos/download_img/3/'.md5($image->id)) ?>">Large <span style="float:right">1920 x 1080 </span> </a></li>
														<li><a href="<?php echo base_url('photos/download_img/4/'.md5($image->id)) ?>">Original <span style="float:right"><?php echo $image->width.'x'.$image->height; ?> </span> </a></li>
													</ul>
												</div>
											<?php endif ?>

										</div>


										<div class="col-xs-12 col-sm-6 col-md-12 mb-20 right-img-ingo shadow">
											<div class="detail-sm-section mt-20 mb-20">
												<h5><i class="fa fa-creative-commons myicon-right" aria-hidden="true"></i> License and Use</h5>
												<?php if ($image->copyright == 1): ?>
													<p> ✓ CCO (Public Domain)</p>
													<p>Public can copy, modify, distribute &amp; perform the work, even for commercial purposes, all without asking permission &amp; no attribution required. </p>
												<?php else: ?>
													<p> ✓ CC-BY (Attribution)</p>
													<p>Photographer reserves, or holds all the rights, provided by copyright law. Nobody can Copy, Share or Use. </p>
												<?php endif ?>
												
											</div>
										</div>


										<div class="col-xs-12 col-sm-6 col-md-12 mb-20 right-img-ingo shadow">
											<div class="detail-sm-section mt-20 mb-20 center">
												<div class="addthis_inline_share_toolbox"></div>
											</div>
										</div>

										<div class="col-xs-12 col-sm-6 col-md-12 mb-0">
											<div class="list-group">
												<ul class="list-group">
													<li class="list-group-item">Published <span class="pull-right"><?php echo my_date_show($image->uploaded_at) ?></span></li>
													<li class="list-group-item">Resolution <span class="pull-right"><?php echo $image->width.'x'.$image->height; ?></span></li>
													<li class="list-group-item">Image type <span class="pull-right"><?php echo $image->type; ?></span></li>
													<li class="list-group-item">File Size <span class="pull-right"><?php echo $image->size; ?></span></li>
												</ul>
											</div>

										</div>


										<?php if ($this->session->userdata('is_login') == TRUE && $image->user_id != $this->session->userdata('id')): ?>
											<div class="col-xs-12 col-sm-6 col-md-12 mb-20 p-10 right-img-ingo shadow">

												<?php if ($report == 0): ?>
													<a data-toggle="modal" href="#reportModal" class="report mt-10"><i class="fa fa-flag"></i> Report photos</a>
												<?php else: ?>
													<a href="#" class="report mt-10"><i class="fa fa-flag"></i> You already report this photos</a>
												<?php endif ?>

											</div>
										<?php endif ?>


									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				

				<div class="container">

					<div class="section-title mb-10">
						<h4 class="text-left mt-40">Related Photos</h4>
					</div>
					
					
					<div class="row">
						<?php foreach ($related_img as $img): ?>
							<a href="<?php echo base_url('photos/details/'.md5($img->id)) ?>">
								<div class="col-md-2 img-rel">
									<div class="related-img" style="background-image:url('<?php echo base_url($img->thumb) ?>');">

									</div>
								</div>
							</a>
						<?php endforeach ?>
					</div>

					

					<div class="clear mb-10"></div>
					
					

					<div class="section-titles mt-50">
						<h3 class="text-lefts"><i class="fa fa-comments"></i> Comments </h3>
					</div>

					<div class="comments mb-80">

						<?php if($this->session->userdata('is_login') == TRUE):?>

							<?php $img = $this->session->userdata('thumb'); ?>
							<?php 
							if($img == ''){
								$profile_img = 'assets/images/avatar.png';
							}else{
								$profile_img = $img;
							}
							?>


							<form class="comment_form" method="post" action="<?php echo base_url('photos/add_comment/'.md5($image->id)) ?>">
								<div class="comment-wrap">
									<div class="photo">
										<div class="avatar" style="background-image: url(<?php echo base_url($profile_img); ?>)">
										</div>
									</div>
									<div class="comment-block">
										<textarea class="mgs_text_area" name="comment" id="comment" maxlength="<?php echo $settings->comments_char_length; ?>" cols="30" rows="2" placeholder="Add comment..." required></textarea>
									</div>
								</div>

								<!-- csrf token -->
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

								<button type="submit" class="btn btn-info" name=""><i class="fa fa-paper-plane"></i> Send</button>
							</form>


						<?php else: ?>
							<br>
							<h5>Please Login to Start Comments</h5>
						<?php endif; ?>


						<div id="load_comment">
							<?php include'include/comment_load.php'; ?>
						</div>

						<?php if (isset($count_comment) && $count_comment > 4): ?>
							<div class="container" style="text-align: center;">
								<button type="button" class="comment_load btn btn-info" value="loadmore" >Load More</button>
								<input type="hidden" name="limit" id="limit" value="5"/>
								<input type="hidden" name="img_id" id="img_id" value="<?php echo $image->id; ?>"/>
							</div>
						<?php endif ?>
						

						
					</div>
				</div>
			</div>
		</div>
		<!-- end Main Wrapper -->






		<div id="imgModals_<?php echo md5($image->id) ?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal_area" id="load_img">
					<div class="modal-content">
						<div class="modal-body cmodal" style="height: 480px; padding: 0">
							<button type="button" class="closem" data-dismiss="modal">×</button>
							<div class="collection-img" style="background-image:url(<?php echo base_url($image->image) ?>); "></div>
							
							<div class="create-coll dis_none ">
								<form method="post" action="<?php echo base_url('user/create_collection'); ?>" class="create_collection" id="create_<?php echo $image->id ?>">
									
									<div class="p-10">
										<h5>Add New Collection</h5>

										<div class="form-group"> 
											<input type="text" name="title" class="form-control minput" placeholder="Collection name" required> 
										</div>
										
										<div class="form-group"> 
											<label class="radio-inline">
												<input type="radio" name="type" value="1" required>Public
											</label>
											<label class="radio-inline">
												<input type="radio" name="type" value="2" required>Private
											</label>
										</div>

										<a class="back_coll_btn pull-right" href="#"><i class="fa fa-angle-left"></i> Back </a>
										<!-- csrf token -->
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
									</div>

									<button type="submit" class="btn btn-info cus_btn_md mt-10">Create Colleciton</button>
									
								</form>
							</div>


							<div class="add-coll">
								
								<form id="add_collection_<?php echo $image->id; ?>" method="post" action="<?php echo base_url('user/add_to_collection'); ?>">

									<div class="p-10">
										<h5>Select Collection</h5>

										<div class="load_cdata">
											<?php include'include/load_collection.php'; ?>
										</div>

										<input type="hidden" name="img_id" value="<?php echo $image->id; ?>">

										<a class="new_coll_btn pull-right mt-35" href="#">Create New Collection <i class="fa fa-angle-right"></i></a>

										<!-- csrf token -->
										<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

									</div>
									
									
									<button type="submit" data-id="<?php echo $image->id; ?>" class="btn btn-info add_coll_img mt-10 cus_btn_md">Add to Colleciton</button>
									
								</form>
								
							</div>

						</div>
						
					</div>



				</div>
			</div>
		</div>






		<div class="modal fade" id="reportModal" role="dialog">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title center">Report Photos</h4>
					</div>

					<div class="modal-body p-0 mt-10">
						<form id="reprot_img_form" method="post" action="<?php echo base_url('photos/report_img/'.md5($image->id)); ?>">

							<div class="p-10">
								<p class="ptext">Choose report type</p>
								<div class="form-group mt-10"> 
									<select name="report" class="form-control minput custom-select col-md-3 pull-right">
										<option value="1">Copyright issue</option>
										<option value="2">Privacy issue</option>
										<option value="3">Violent or sexual content</option>
									</select>
								</div>

								<!-- csrf token -->
								<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

								<button type="submit" class="btn btn-info report_img mt-30">Report</button>
							</div>
							
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>