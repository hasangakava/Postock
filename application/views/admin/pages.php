<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
      
            <ol class="breadcrumb pull-right">
              <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Pages</li>
            </ol>
        </div>
    </div>

    <div class="row">
      
      <div class="container">
          <?php $msg = $this->session->flashdata('msg'); ?>
          <?php if (isset($msg)): ?>
              <div class="alert alert-success delete_msg pull c-b" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
              </div>
          <?php endif ?>
      </div>


      <div class="col-md-12 add_page_area dis_none">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Add New Pages  <a href="#" class="pull-right btn btn-primary cancel_page"><i class="fa fa-list"></i> All pages</a></h3>
              </div>
              <div class="panel-body">
                  <form method="post" action="<?php echo base_url('admin/pages/add')?>" role="form">
                      <div class="form-group">
                          <label>Page title</label>
                          <input type="text" class="form-control" name="title" required>
                      </div>
                      <div class="form-group">
                          <label>Page slug or url</label>
                          <input type="text" class="form-control" name="slug" required>
                      </div>

                      <div class="form-group">
                          <label>Page description</label>
                          <textarea class="form-control summernote" name="details"></textarea>
                      </div>

                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <button type="submit" class="btn btn-info">Save</button>
                  </form>
              </div>
          </div>
      </div>


      <div class="col-md-12 all_page_area">
          <div class="panel panel-default">
            
              <div class="panel-heading">
                  <h3 class="panel-title">All Pages <a href="#" class="pull-right btn btn-info add_page"><i class="fa fa-plus"></i> Add new page</a></h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 scroll">
                          <table class="table table-bordered" id="dg_table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Page title</th>
                                      <th>Slug or url</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; foreach ($pages as $page): ?>
                                  <tr id="row_<?php echo $page['id']; ?>">
                                      <td><?php echo $i; ?></td>
                                      <td><?php echo $page['title']; ?></td>
                                      <td><?php echo $page['slug']; ?></td>
                                      <td>
                                        <?php if ($page['status'] == 1): ?>
                                          <span class="label label-info">Active</span>
                                        <?php else: ?>
                                          <span class="label label-danger">Inactive</span>
                                        <?php endif ?>
                                          
                                      </td>
                                      <td class="actions">
                                        <a href="<?php echo base_url('admin/pages/edit/'.$page['id']);?>" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></a> &emsp;
                                        <a data-val="Category" data-id="<?php echo $page['id']; ?>" href="<?php echo base_url('admin/pages/delete/'.$page['id']);?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a>&emsp;

                                        <?php if ($page['status'] == 1): ?>
                                          <a href="<?php echo base_url('admin/pages/deactive/'.$page['id']);?>" class="on-default deactive-row" data-toggle="tooltip" data-placement="top" title="Deactivate"><i class="fa fa-times"></i></a>&emsp;
                                        <?php else: ?>
                                          <a href="<?php echo base_url('admin/pages/active/'.$page['id']);?>" class="on-default active-row" data-toggle="tooltip" data-placement="top" title="Activate"><i class="fa fa-check-circle"></i></a>
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

