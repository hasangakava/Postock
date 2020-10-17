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
              <li class="active">Categories</li>
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
                  <h3 class="panel-title">Add new categories</h3>
              </div>
              <div class="panel-body">
                  <form method="post" action="<?php echo base_url('admin/category/add')?>" role="form">
                      <div class="form-group">
                          <input type="text" class="form-control" name="name" placeholder="Category Name" required>
                      </div>
                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <button type="submit" class="btn btn-info">Save</button>
                  </form>
              </div>
          </div>
      </div>


      <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">All Categories</h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 scroll">
                          <table class="table table-bordered" id="datatable">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Category Name</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; foreach ($category as $cat): ?>
                                  <tr id="row_<?php echo $cat['id']; ?>">
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $cat['name']; ?></td>
                                      <td>
                                        <?php if ($cat['status'] == 1): ?>
                                          <span class="label label-info">Active</span>
                                        <?php else: ?>
                                          <span class="label label-danger">Inactive</span>
                                        <?php endif ?>
                                          
                                      </td>
                                      <td class="actions">
                                        <a href="#myModal<?php echo $cat['id'];?>" class="on-default edit-row" data-toggle="modal" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &emsp;
                                        <a data-val="Category" data-id="<?php echo $cat['id']; ?>" href="<?php echo base_url('admin/category/delete/'.$cat['id']);?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>&emsp;

                                        <?php if ($cat['status'] == 1): ?>
                                          <a href="<?php echo base_url('admin/category/deactive/'.$cat['id']);?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a>&emsp;
                                        <?php else: ?>
                                          <a href="<?php echo base_url('admin/category/active/'.$cat['id']);?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
                                        <?php endif ?>

                                        

                                      </td>
                                  </tr>
                                <?php $i++; endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      
    </div>

  </div>
</div>


<!-- Start Edit Modal -->
   <?php foreach ($category as $cat):?>
    <div class="modal fade" id="myModal<?php echo $cat['id'];?>" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
           <form method="post" role="form" class="form-horizontal" action="<?php echo base_url('admin/category/edit')?>">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Edit Category</h3>
              </div>
              <div class="modal-body">
                <div class="control-group">
                  <!-- <label class="control-label">Category Name</label> -->
                  <div class="controls">
                  
                    <input type="text" id="name" name="name" value="<?php echo $cat['name']; ?>" class="span8 form-control" required />
                    <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                  </div>
                </div>
              </div><br>

              <!-- csrf token -->
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

              <div class="modal-footer" style="text-align: left;">
                <button type="Submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>

            </form>
          </div>

        </div>
    </div>
<?php endforeach;?>
<!--End Modal content-->