<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>

            	<li class="menu-title"><?php echo $settings->site_name; ?> Admin Panel</li>

                <li class="has_sub ">
                    <a href="<?php echo base_url('admin/dashboard') ?>" class="waves-effect"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo base_url('admin/settings') ?>" class="waves-effect"><i class="fa fa-gears"></i> <span> Settings </span> </a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo base_url('admin/category') ?>" class="waves-effect"><i class="fa fa-list"></i> <span> Category </span> </a>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-picture-o"></i><span> Photos </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url('admin/photos/add_photos') ?>"> Add Photos</a></li>
                        <li><a href="<?php echo base_url('admin/photos') ?>"> All Photos</a></li>
                        <li><a href="<?php echo base_url('admin/photos/pending') ?>">Pending </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-play"></i><span> Videos </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url('admin/videos') ?>"> All Videos</a></li>
                        <li><a href="<?php echo base_url('admin/videos/pending') ?>">Pending </a></li>
                        <li><a href="<?php echo base_url('admin/videos/add_video') ?>"> Add Videos</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i><span> Members </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url('admin/members/add') ?>"> Add Members</a></li>
                        <li><a href="<?php echo base_url('admin/members') ?>"> All Members</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="<?php echo base_url('admin/ads') ?>" class="waves-effect"><i class="fa fa-money"></i> <span> Manage Ads </span> </a>
                </li>

                <li class="has_sub">
                    <a href="<?php echo base_url('admin/pages') ?>" class="waves-effect"><i class="fa fa-file"></i> <span> Pages </span> </a>
                </li>

                <li class="has_sub">
                    <?php $total = count_unseen_reports(); ?>
                    <a href="<?php echo base_url('admin/reports') ?>" class="waves-effect"><i class="fa fa-flag"></i> <span> Photo Reports </span> <span class="badge badge-danger pull-right"><?php if($total != 0) { echo $total; } ?></span></a>
                </li>
              
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>