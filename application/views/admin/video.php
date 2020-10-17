<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
             <div class="btn-group pull-right m-t-5 m-b-20" style="display: none;">
                 
              </div>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Videos</li>
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

      <div class="col-md-6">
          <div class="panel panel-default input_area">
              <div class="panel-heading">
                  <h3 class="panel-title">Add new Videos</h3>
              </div>
              <div class="panel-body">
                  <form method="post" action="<?php echo base_url('admin/videos/upload_video')?>" role="form" enctype="multipart/form-data">
                      
                      <div class="form-group">
                          <input type="text" class="form-control" name="title" placeholder="Title" required>
                      </div>

                      <div class="form-group">
                          <input type="file" class="form-control" name="video" required>
                      </div>

                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <button type="submit" class="btn btn-info">Save</button>
                  </form>
              </div>
          </div>
      </div>

      
    </div>

  </div>
</div>

