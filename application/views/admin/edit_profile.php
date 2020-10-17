<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Edit Profile</li>
            </ol>
        </div>
    </div>

    <div class="row">

      <div class="col-md-6">
          <div class="panel panel-default input_area">
              <div class="panel-heading">
                  <h3 class="panel-title">Edit Profile</h3>
              </div>
              <div class="panel-body">
                  <form method="post" id="edit_admin_profile" action="<?php echo base_url('admin/dashboard/edit_profile') ?>">

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="<?php echo $user->name; ?>" name="name" />
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Email / Username</label>
                            <input type="text" class="form-control" value="<?php echo $user->email; ?>" name="email" />
                          </div>
                        </div>

                        <!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-info">Update</button>
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