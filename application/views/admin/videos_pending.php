<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- Start content -->
<div class="content">
    <div class="container">


        <!-- Page breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-left m-t-5 m-b-20">
                    <h4><span class="label label-default uop">(<?php echo $total; ?>) Videos</span></h4>
                </div>
                <ol class="breadcrumb pull-right">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li class="active">Videos</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">

                    <div class="row">
                        <div class="col-lg-12">
                            
                            <?php if ($total == 0): ?>
                                <div class="center"> <h4>No Pending Videos found <i class="fa fa-info-circle"></i></h4></div>
                            <?php endif ?>

                            <div id="masonry5">
                                <?php foreach ($videos as $video): ?>
                                    <div class="thumbnail slideInUp item img-grid" id="video_<?php echo $video->id; ?>">
                                        <video width="320" height="240" poster="" id="player" playsinline controls>
                                            <source src="<?php echo base_url($video->path); ?>" type="<?php echo $video->file_type ?>">
                                            <source src="<?php echo base_url($video->path); ?>" type="video/webm">
                                        </video>
                                        
                                            <div class="col-sm-6 p-0 m-t-5 ">
                                                <span class="c-p">Uploader: <?php echo $video->name ?></span>
                                                <span class="c-p">Upload: <?php echo my_date_show($video->created_at); ?></span>
                                            </div>
                                            <div class="col-sm-6 p-0 m-t-5 ">
                                                <span class="c-p">Video Type: <?php echo $video->file_ext ?></span><br>
                                                <span class="c-p">Size: <?php echo $video->file_size ?></span>
                                            </div>
                                     
                                        <div class="col-sm-4 p-0 m-t-5 ">
                                            <a href="#" data-id="<?php echo $video->id; ?>" class="brd-0 btn btn-success btn-xs btn-block waves-effect waves-light approve_video" role="button"><i class="fa fa-check"></i> Approve</a>
                                        </div>
                                        <div class="col-sm-4 p-0 m-t-5">
                                            <a href="#" data-id="<?php echo $video->id; ?>" class="btn btn-primary btn-xs btn-block waves-effect brd-0 waves-light add_featured_video" role="button"><i class="fa fa-star"></i> Featured</a>
                                        </div>
                                        <div class="col-sm-4 p-0 m-t-5">
                                            <a href="#" data-id="<?php echo $video->id; ?>" class="btn btn-danger btn-xs btn-block brd-0 waves-effect reject_video" role="button"><i class="fa fa-times"></i> Reject</a>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>