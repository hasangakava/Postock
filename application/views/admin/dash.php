<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


	<!-- Start content -->
	<div class="content">
		<div class="container">

			<!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>

            <div class="row">

                <a href="<?php echo base_url('admin/photos') ?>">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-success pull-left">
                                <h5><i class="fa fa-camera fa-3x"></i></h5>
                            </div>
                            <div class="text-right m-t-10">
                                <h1 class="text-dark m-t-10">
                                    <b class="counter">
                                    <?php if(isset($total->images)){echo $total->images;}else{echo 0;}; ?>
                                    </b></h1>
                                <p class="text-muted mb-0 c-s"> Photos</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo base_url('admin/photos/pending') ?>">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-warning pull-left">
                                <h5><i class="fa fa-picture-o fa-3x"></i></h5>
                            </div>
                            <div class="text-right m-t-10">
                                <h1 class="text-dark m-t-10">
                                    <b class="counter">
                                    <?php if(isset($total->pending)){echo $total->pending;}else{echo 0;}; ?>
                                    </b></h1>
                                <p class="text-muted mb-0 c-w">Pending Photos</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo base_url('admin/members') ?>">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon bg-icon-info pull-left">
                                <h5><i class="fa fa-users fa-3x"></i></h5>
                            </div>
                            <div class="text-right m-t-10">
                                <h1 class="text-dark m-t-10"><b class="counter">
                                     <?php if(isset($total->members)){echo $total->members;}else{echo 0;}; ?>
                                    </b></h1>
                                <p class="text-muted mb-0 c-i"> Members</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </a>

                
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-primary pull-left">
                            <h5><i class="fa fa-thumbs-up fa-3x"></i></h5>
                        </div>
                        <div class="text-right m-t-10">
                            <h1 class="text-dark m-t-10"><b class="counter">
                                <?php if(isset($total->likes)){echo $total->likes;}else{echo 0;}; ?>
                            </b></h1>
                            <p class="text-muted mb-0"> Likes</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-inverse pull-left">
                            <h5><i class="fa fa-eye fa-3x"></i></h5>
                        </div>
                        <div class="text-right m-t-10">
                            <h1 class="text-dark m-t-10"><b class="counter">
                                <?php if(isset($total->view)){echo $total->view;}else{echo 0;}; ?>
                                </b></h1>
                            <p class="text-muted mb-0"> Views</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-purple pull-left">
                            <h5><i class="fa fa-cloud-download fa-3x"></i></h5>
                        </div>
                        <div class="text-right m-t-10">
                            <h1 class="text-dark m-t-10"><b class="counter">
                                    <?php if(isset($total->downloads)){echo $total->downloads;}else{echo 0;}; ?>
                                </b></h1>
                            <p class="text-muted mb-0"> Downloads</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                
                
            </div>



         
            <!-- end row -->


            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card-box">
                        
                        <h4 class="header-title m-t-0 m-b-30">Recently joined</h4>

                        <div class="inbox-widget nicescroll" style="height: 483px;">
                            <?php foreach ($members as $user): ?>
                  
                                <a href="<?php echo base_url('user/profile/'.md5($user->id)) ?>">
                                    <div class="inbox-item">
                                        <div class="inbox-item-img">
                                            <?php if ($user->thumb == ''): ?>
                                                <?php $avatar = 'assets/images/avatar.png' ?>
                                            <?php else: ?>
                                                <?php $avatar = $user->thumb; ?>
                                            <?php endif ?>
                                            <img src="<?php echo base_url($avatar) ?>" class="img-circle" alt="">
                                        </div>
                                        <p class="inbox-item-author"><?php echo $user->first_name ?></p>
                                        <p class="inbox-item-text"><i class="fa fa-map-marker c-p"></i> <?php if($user->country != ''){ echo $user->country;}else{echo "Not found";} ?></p>
                                        <p class="inbox-item-date c-b"><b>Joined:</b> <?php echo my_date_show($user->created_at); ?></p>
                                    </div>
                                </a>
                            <?php endforeach ?>
                            <ul class="pager">
                                <li class="next">
                                    <a href="<?php echo base_url('admin/members'); ?>">See All → </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                    <div class="card-box">
                        
                        <?php if (count($images) == 0): ?>
                            <h4 class="center p-30">Photos not found <i class="fa fa-exclamation-circle" aria-hidden="true"></i></h4>
                        <?php else: ?>
                        <h4 class="header-title m-t-0 m-b-30">Recently Uploaded</h4>
                        <div class="table-responsive">

                            <table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <th>Thumb</th>
                                        <th>Title</th>
                                        <th>Uploaded by</th>
                                        <th>Featured</th>
                                        <th>Upload date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($images as $img): ?>
                                        <tr id="row_<?php echo $img->id ?>">
                                            <td>
                                                <a target="_blank" href="<?php echo base_url('photos/details/'.md5($img->id)) ?>">
                                                    <div class="tbl-img" style="background-image: url(<?php echo base_url($img->thumb) ?>);"></div>
                                                </a>
                                            </td>
                                            <td><a title="<?php echo $img->title ?>" target="_blank" href="<?php echo base_url('photos/details/'.md5($img->id)) ?>"><?php echo character_limiter($img->title, 20) ?> <i class="fa fa-external-link-square"></i></a></td>
                                            <td><a title="<?php echo $img->user_name ?>" target="_blank" href="<?php echo base_url('user/profile/'.md5($img->user_id)) ?>"><?php echo $img->user_name; ?> </a></td>
                                            <td>
                                                <?php if ($img->is_featured == 1): ?>
                                                    <span class="label label-default"><i class="fa fa-check"></i> Featured</span>
                                                <?php else: ?>
                                                    <a href="<?php echo base_url('admin/photos/add_feature_img/'.$img->id) ?>" data-toggle="tooltip" title="Click to add feature image" class="btn btn-primary waves-effect waves-light btn-xs m-b-5"><i class="fa fa-plus"></i> Set Feature Image</a>
                                                <?php endif ?>
                                            </td>
                                            
                                            <td>
                                                <?php echo my_date_show($img->uploaded_at); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>

                        </div>
                        <?php endif ?>

                        <ul class="pager">
                            <li class="next">
                                <a href="<?php echo base_url('admin/photos'); ?>">See All → </a>
                            </li>
                        </ul>

                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->



        </div> <!-- container -->

    </div> 
    <!-- content -->

    