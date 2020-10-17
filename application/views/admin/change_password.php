<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Change Password</li>
            </ol>
        </div>
    </div>

    <div class="row">

      <div class="col-md-6">
          <div class="panel panel-default input_area">
              <div class="panel-heading">
                  <h3 class="panel-title">Change Password</h3>
              </div>
              <div class="panel-body">
                  <form method="post" id="cahage_pass_form" action="<?php echo base_url('admin/dashboard/change') ?>">

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" class="form-control" name="old_pass" />
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>New Password</label>
                            <input type="password" class="form-control" name="new_pass" />
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_pass" />
                          </div>
                        </div>

                        <!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-info">Change</button>
                        </div>
                        
                      </div>
                    </div>
                      
                  </form>
              </div>
          </div>
      </div>


    </div>

  </div>
</div>


<!--End Modal content-->