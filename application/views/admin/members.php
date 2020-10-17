<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
    <div class="container">

        <!-- Page breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-left m-t-5 m-b-20">
                    <h4><span class="label label-default uop">(<?php echo $total; ?>) Members</span></h4>
                </div>
                <ol class="breadcrumb pull-right">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="#">Members</a></li>
                  <li class="active">All members</li>
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

            <div class="col-md-12">
                <div class="card-box">
                    <div class="box row">
                        <div class="pull-left col-md-12">
                            <form action="<?php echo base_url('admin/members/all_members') ?>" id="sort_form" method="get">
                            
                                <div class="col-md-2 col-sm-3 m-t-5"> 
                                    <select name="sort" class="form-control input-sm sort" style="width: auto; padding-right: 20px;">
                                        <option selected="selected">Sort by</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'id'){echo "selected";} ?> value="id">Id</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'pending'){echo "selected";} ?> value="pending">Pending</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'active'){echo "selected";} ?> value="active">Active</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'suspend'){echo "selected";} ?> value="suspend">Suspended</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'photos'){echo "selected";} ?> value="photos">Most Photos</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'download'){echo "selected";} ?> value="download">Most downloads</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'view'){echo "selected";} ?> value="view">Most views</option>
                                        <option <?php if(isset($_GET['sort']) && $_GET['sort'] == 'like'){echo "selected";} ?> value="like">Most likes</option>
                                    </select>
                                </div>

                                <div class="col-md-3 col-sm-3 m-t-5"> 

                                    <select name="country" class="form-control input-sm sort">
                                        <option selected="selected" value="0">Sort by countries</option>
                                        <?php foreach ($countries as $country): ?>
                                            <option <?php if(isset($_GET['country']) && $_GET['country'] == $country['id']){echo "selected";} ?> value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </form>

                            <div class="col-md-7 col-sm-3 m-t-5">
                                <form role="search" autocomplete="off" action="<?php echo base_url('admin/members/all_members') ?>" method="get" class="pull-right">
                                     <div class="input-group input-group-sm" style="width: 300px;">
                                      <input type="text" name="search" class="form-control pull-right" placeholder="Search" autocomplete="off">
                    
                                      <div class="input-group-btn">
                                        <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                                      </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div><br>

                    <h4 class="header-title m-t-0 m-b-30"></h4>


                    <div class="table-responsive">
                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>User Actions</th>
                                    <th>Verified</th>
                                    <th>Joining Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($members as $member): ?>
                                    <tr id="row_<?php echo $member->id ?>">
                                        <th scope="row"><?php echo $i ?></th>
                                        
                                        <?php if ($member->thumb == ''): ?>
                                            <?php $avatar = 'assets/images/avatar.png'; ?> 
                                        <?php else: ?>
                                            <?php $avatar = $member->thumb; ?>
                                        <?php endif ?>

                                        <td>
                                        <a title="<?php echo $member->first_name ?>" target="_blank" href="<?php echo base_url('user/profile/'.md5($member->id)) ?>">
                                            <img width="60px" class="img-circle" src="<?php echo base_url($avatar) ?>"></td>
                                        </a>
                                        <td>
                                            <a title="<?php echo $member->first_name ?>" target="_blank" href="<?php echo base_url('user/profile/'.md5($member->id)) ?>">
                                                <?php echo $member->first_name.' '.$member->last_name ?> <i class="fa fa-external-link-square"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="label label-default uop"><?php echo $member->total_photos ?> <i class="fa fa-camera"></i></span>

                                            <span class="label label-success uop"><?php echo $member->total_view ?> <i class="fa fa-eye"></i></span>
                                            
                                            <span class="label label-primary uop"><?php echo $member->total_like ?> <i class="fa fa-thumbs-up"></i></span>
                                            <span class="label label-inverse uop"><?php echo $member->download ?> <i class="fa fa-download"></i> </span>

                                        </td>
                                        <td>
                                            <?php if ($member->is_verified == 1): ?>
                                                <span class="label label-success"><i class="fa fa-check-circle"></i> Verified</span>
                                            <?php else: ?>
                                                <a href="<?php echo base_url('admin/members/verified/'.$member->id) ?>" data-toggle="tooltip" title="Click to Verified User" class="btn btn-primary waves-effect waves-light btn-xs m-b-5"><i class="fa fa-check-circle"></i> Verify User</a>
                                            <?php endif ?>
                                        </td>
                                        <td><?php echo my_date_show($member->created_at) ?></td>
                                        <td>
                                            <?php if ($member->status == 0): ?>
                                                <span class="label label-warning">Pending</span>
                                            <?php endif ?>
                                            <?php if ($member->status == 1): ?>
                                                <span class="label label-success">Active</span>
                                            <?php endif ?>
                                            <?php if ($member->status == 2): ?>
                                                <span class="label label-danger">Suspend</span>
                                            <?php endif ?>
                                        </td>
                                        <td class="actions">
                                            <?php if ($member->status == 1): ?>
                                                <a href="<?php echo base_url('admin/members/deactive/'.$member->id) ?>" data-toggle="tooltip" title="Suspend" class="btn btn-xs btn-icon waves-effect waves-light btn-warning m-b-5"><i class="fa fa-times"></i></a>
                                            <?php endif ?>
                                            <?php if ($member->status == 2 || $member->status == 0): ?>
                                                <a href="<?php echo base_url('admin/members/active/'.$member->id) ?>" data-toggle="tooltip" title="Active" class="btn btn-xs btn-icon waves-effect waves-light btn-primary m-b-5"><i class="fa fa-check-circle"></i></a>
                                            <?php endif ?>

                                            <a href="<?php echo base_url('admin/members/delete/'.$member->id) ?>" data-id="<?php echo $member->id ?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-icon waves-effect waves-light btn-danger m-b-5 delete_item"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php $i++; endforeach ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="center p-30">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                    
                </div>
            </div><!-- end col -->
        </div>

    </div>
    <!-- container -->

</div> 
<!-- content -->