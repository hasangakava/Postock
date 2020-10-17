<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
    <div class="container">

        <!-- Page breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-left m-t-5 m-b-20">
                    <h4><span class="label label-default uop">(<?php echo $total; ?>) Reports</span></h4>
                </div>
                <ol class="breadcrumb pull-right">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li><a href="#">Reports</a></li>
                  <li class="active">All Reports</li>
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

                    <h4 class="header-title m-t-0 m-b-30"></h4>

                    <?php if ($total == 0): ?>
                        <h4 class="center p-30">Reports not found <i class="fa fa-exclamation-circle" aria-hidden="true"></i></h4>
                    <?php else: ?>
                    
                    <div class="table-responsive">

                        <table class="table table-bordered m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Reported photo</th>
                                    <th>Reported by</th>
                                    <th>Report reason</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=1; foreach ($reports as $report): ?>
                                    <tr id="row_<?php echo $report->id ?>">
                                        <th scope="row"><?php echo $i ?></th>
                                        
                                        <td><a target="_blank" href="<?php echo base_url('photos/details/'.md5($report->img_id)) ?>">
                                            <img width="100px" src="<?php echo base_url($report->thumb) ?>">
                                        </a></td>
                                        
                                        <td><a title="<?php echo $report->action_id ?>" target="_blank" href="<?php echo base_url('user/profile/'.md5($report->action_id)) ?>"><?php echo $report->reporter; ?> <i class="fa fa-external-link-square"></i></a>
                                        </td>

                                        <td>
                                            <?php if ($report->report == 1): ?>
                                                <p>Copyright issue</p>
                                            <?php elseif ($report->report == 2): ?>
                                                <p>Privacy issue</p>
                                            <?php else: ?>
                                                <p>Violent or sexual content</p>
                                            <?php endif ?>
                                        </td>
                                        <td><?php echo my_date_show($report->date_time); ?></td>
                                        <td class="actions">
                                            <a href="<?php echo base_url('admin/reports/delete/'.$report->id) ?>" data-id="<?php echo $report->id ?>" data-toggle="tooltip" title="Delete" class="btn btn-xs btn-icon waves-effect waves-light btn-danger m-b-5 delete_item"><i class="fa fa-trash-o"></i></a>
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