<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<!-- Start content -->
<div class="content">
    <div class="container">

        <!-- Page breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-left m-t-5 m-b-20">
                    <h4><span class="label label-default uop">(<?php echo $total; ?>) 
                       
                        <?php if(isset($page_title) && $page_title == 'Photos'){echo "Photos";}else{echo "Videos";} ?>
                            
                        </span></h4>
                </div>
                <ol class="breadcrumb pull-right">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="#"><?php if(isset($page_title) && $page_title == 'Photos'){echo "Photos";}else{echo "Videos";} ?></a></li>
                  <li class="active">All <?php if(isset($page_title) && $page_title == 'Photos'){echo "Photos";}else{echo "Videos";} ?></li>
                </ol>
            </div>
        </div>
        

        <div class="row">

            <div class="container">
                <?php $msg = $this->session->flashdata('msg'); ?>
                <?php if (isset($msg)): ?>
                    <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                <?php endif ?>
            </div>


            <div class="col-lg-12">
                <div class="card-box">
                    
                   


                    <div class="box row">
                        <div class="pull-left col-md-12">
                            <div class="col-md-2 col-sm-3 m-t-5"> 
                                <form action="<?php echo base_url('admin/photos/all_photos') ?>" id="sort_form" method="get">
                                    <select name="sort" class="form-control input-sm sort" style="width: auto; padding-right: 20px;">
                                        <option selected="selected">Sort by</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'id'){echo "selected";} ?> value="id">Id</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'active'){echo "selected";} ?> value="active">Active</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'suspend'){echo "selected";} ?> value="suspend">Hold</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'download'){echo "selected";} ?> value="download">Most downloads</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'view'){echo "selected";} ?> value="view">Most views</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'featured'){echo "selected";} ?> value="featured">Featured image</option>
                                  </select>
                                  <!-- csrf token -->
                                </form>
                            </div>

                            <div class="col-md-2 col-sm-3 m-t-5">
                                <a href="<?php echo base_url('admin/photos/delete_rejected_photos') ?>" class="btn btn-default btn-sm delete_all_item"><i class="fa fa-trash"></i> Delete all rejected <?php if(isset($page_title) && $page_title == 'Photos'){echo "Photos";}else{echo "Videos";} ?></a>
                            </div>

                            <div class="col-md-8 col-sm-3 m-t-5">
                                <form  class="pull-right" role="search" autocomplete="off" action="<?php echo base_url('admin/photos/all_photos') ?>" method="get">
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

                    <?php if ($total == 0): ?>
                        <h4 class="center p-30"><?php if(isset($page_title) && $page_title == 'Photos'){echo "Photos";}else{echo "Videos";} ?> not found <i class="fa fa-exclamation-circle" aria-hidden="true"></i></h4>
                    <?php else: ?>
                    
                    <div class="table-responsive">

                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Thumb</th>
                                    <th>Title</th>
                                    <th>Uploaded by</th>
                                    <th>Image Actions</th>
                                    <th>Featured</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($images as $img): ?>
                                    <tr id="row_<?php echo $img->id ?>">
                                        <th scope="row"><?php echo $i ?></th>
                                        <td><a target="_blank" href="<?php echo base_url('photos/details/'.md5($img->id)) ?>">
                                            <div class="tbl-img" style="background-image: url(<?php echo base_url($img->thumb) ?>);"></div>
                                        </a></td>
                                        <td><a title="<?php echo $img->title ?>" target="_blank" href="<?php echo base_url('photos/details/'.md5($img->id)) ?>"><?php echo character_limiter($img->title, 20) ?> <i class="fa fa-external-link-square"></i></a></td>
                                        <td><a title="<?php echo $img->user_name ?>" target="_blank" href="<?php echo base_url('user/profile/'.md5($img->user_id)) ?>"><?php echo $img->user_name; ?> </a></td>
                                        <td>
                                            <span class="label label-default"><?php echo $img->total_like ?> <i class="fa fa-thumbs-up"></i></span>
                                            <span class="label label-primary"><?php echo $img->view ?> <i class="fa fa-eye"></i></span>
                                        </td>
                                        <td>
                                            <?php if ($img->is_featured == 1): ?>
                                                <span class="label label-default"><i class="fa fa-star"></i> Featured</span>
                                            <?php else: ?>
                                                <a href="<?php echo base_url('admin/photos/add_feature_img/'.$img->id) ?>" data-toggle="tooltip" title="Click to add feature image" class="btn btn-primary waves-effect waves-light btn-xs m-b-5"><i class="fa fa-plus"></i> Set Feature <?php if(isset($page_title) && $page_title == 'Photos'){echo "Photo";}else{echo "Video";} ?></a>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php if ($img->status == 1): ?>
                                                <span class="label label-success">Active</span>
                                            <?php endif ?>
                                            <?php if ($img->status == 2): ?>
                                                <span class="label label-warning">Rejected</span>
                                            <?php endif ?>
                                        </td>
                                        <td class="actions">
                                    
                                            <?php if ($img->status == 1): ?>
                                                <a href="<?php echo base_url('admin/photos/suspend/'.$img->id) ?>" data-toggle="tooltip" title="Reject" class="btn btn-xs btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-times"></i></a>
                                            <?php endif ?>
                                            <?php if ($img->status == 2): ?>
                                                <a href="<?php echo base_url('admin/photos/active/'.$img->id) ?>" data-toggle="tooltip" title="Active" class="btn btn-xs btn-icon waves-effect waves-light btn-primary m-b-5"><i class="fa fa-check-circle"></i></a>
                                            <?php endif ?>
                                            

                                            <a href="<?php echo base_url('admin/photos/delete/'.$img->id) ?>" data-id="<?php echo $img->id ?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-icon waves-effect waves-light btn-danger m-b-5 delete_item"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php $i++; endforeach ?>
                            </tbody>
                        </table>

                    </div>

                    <div class="center p-30">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>

                    <?php endif ?>

                </div>
            </div><!-- end col -->
        </div>

    </div>
    <!-- container -->

</div> 
<!-- content -->