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

                    <div class="box row">
                        <div class="pull-left col-md-12">
                            <div class="col-md-2 col-sm-3 m-t-5"> 
                                <form action="<?php echo base_url('admin/videos/all_videos') ?>" id="sort_form" method="get">
                                    <select name="sort" class="form-control input-sm sort" style="width: auto; padding-right: 20px;">
                                        <option selected="selected">Sort by</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'id'){echo "selected";} ?> value="id">Id</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'active'){echo "selected";} ?> value="active">Active</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'suspend'){echo "selected";} ?> value="suspend">Hold</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'download'){echo "selected";} ?> value="download">Most downloads</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'view'){echo "selected";} ?> value="view">Most views</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'featured'){echo "selected";} ?> value="featured">Featured Videos</option>
                                  </select>
                                  <!-- csrf token -->
                                </form>
                            </div>

                            <div class="col-md-2 col-sm-3 m-t-5">
                                <a href="<?php echo base_url('admin/videos/delete_rejected_videos') ?>" class="btn btn-default btn-sm delete_all_item"><i class="fa fa-trash"></i> Delete all rejected Videos</a>
                            </div>

                            <div class="col-md-8 col-sm-3 m-t-5">
                                <form  class="pull-right" role="search" autocomplete="off" action="<?php echo base_url('admin/videos/all_videos') ?>" method="get">
                                     <div class="input-group input-group-sm" style="width: 300px;">
                                      <input type="text" name="search" class="form-control pull-right" placeholder="Search" autocomplete="off">
                    
                                      <div class="input-group-btn">
                                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                      </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                    <h4 class="header-title m-t-0 m-b-30"></h4>



                    <div class="row">
                        <div class="col-lg-12">
                            
                            <?php if ($total == 0): ?>
                                <div class="center"> <h4>No Videos found <i class="fa fa-info-circle"></i></h4></div>
                            <?php endif ?>

                            <div id="masonry5">
                                <?php foreach ($videos as $video): ?>
                                     <div class="thumbnails slideInUp item img-grid" id="video_<?php echo $video->id; ?>">
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

                                       <div class="col-sm-12 p-0 m-t-5 m-b-20">
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