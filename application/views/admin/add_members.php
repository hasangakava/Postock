<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Add New Member</li>
            </ol>
        </div>
    </div>

    <div class="row">

      <div class="col-md-6">
          <div class="panel panel-default input_area">
              <div class="panel-heading">
                  <h3 class="panel-title">Add New Member</h3>
              </div>
              <div class="panel-body">
                  <form method="post" id="register-form" action="<?php echo base_url('admin/members/add') ?>">

                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Name</label>
                           <input id="name" name="first_name" class="form-control" type="text" placeholder="Name" autocomplete="off"> 
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Email / Username</label>
                            <input id="email" name="email" class="form-control" type="email" placeholder="Email" autocomplete="off">
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Password</label>
                            <input id="password" name="password" class="form-control" type="password" placeholder="Password">
                          </div>
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Account Status</label> &emsp;
                            <div class="radio radio-info radio-inline">
                                  <input type="radio" id="inlineRadio1" value="1" name="status">
                                  <label for="inlineRadio1"> Active </label>
                              </div>
                              <div class="radio radio-info radio-inline m-l-5">
                                  <input type="radio" id="inlineRadio2" value="0" name="status">
                                  <label for="inlineRadio2"> Inactive </label>
                              </div>
                          </div>
                        </div>

                        <!-- csrf token -->
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-info">Save User</button>
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