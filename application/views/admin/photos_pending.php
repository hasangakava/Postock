<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- Start content -->
<div class="content">
    <div class="container">


        <!-- Page breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-left m-t-5 m-b-20">
                    <h4><span class="label label-default uop">(<?php echo $total; ?>) Photos Pending for Approval</span></h4>
                </div>
                <ol class="breadcrumb pull-right">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="#">Photos</a></li>
                  <li class="active">Pending photos</li>
                </ol>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <?php if ($total == 0): ?>
                                <div class="center"> <h4>No Pending Photos found <i class="fa fa-info-circle"></i></h4></div>
                            <?php endif ?>

                            <div id="masonry4">
                                <?php foreach ($images as $img): ?>
                                    <div class="thumbnail slideInUp item img-grid" id="img_<?php echo $img->id; ?>">
                                        <a target="_blank" href="<?php echo base_url('photos/details/'.md5($img->id)) ?>">
                                            <img src="<?php echo base_url($img->image) ?>" alt="image">
                                        </a>
                                        
                                        <div class="col-sm-4 p-0 m-t-5 ">
                                            <a href="#" data-id="<?php echo $img->id; ?>" class="brd-0 btn btn-success btn-xs btn-block waves-effect waves-light approve_img" role="button"><i class="fa fa-check"></i> Approve</a>
                                        </div>
                                        <div class="col-sm-4 p-0 m-t-5">
                                            <a href="#" data-id="<?php echo $img->id; ?>" class="btn btn-primary btn-xs btn-block waves-effect brd-0 waves-light add_featured" role="button"><i class="fa fa-star"></i> Featured</a>
                                        </div>
                                        <div class="col-sm-4 p-0 m-t-5">
                                            <a href="#" data-id="<?php echo $img->id; ?>" class="btn btn-danger btn-xs btn-block brd-0 waves-effect reject_img" role="button"><i class="fa fa-times"></i> Reject</a>
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