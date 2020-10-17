<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
  <div class="container">

    <!-- breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
      
            <ol class="breadcrumb pull-right">
              <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Ads</li>
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

      <?php if (isset($page_title) && $page_title == "Edit"): ?>
      <div class="col-md-12 add_page_area">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Add New Ads  <a href="<?php echo base_url('admin/ads') ?>" class="pull-right btn btn-primary"><i class="fa fa-list"></i> All Ads</a></h3>
              </div>
              <div class="panel-body">
                  <form method="post" action="<?php echo base_url('admin/ads/add')?>" role="form" enctype="multipart/form-data">
                    
                      <div class="form-group">
                          <label class="control-label m-r-10">Show Ad Type</label><br>

                          <input <?php if($ad->type == 1){echo "checked";}else{echo "";} ?> name="type" value="1" type="radio" id="radio_1">
                          <label for="radio_1">Code</label> &emsp;

                          <input <?php if($ad->type == 2){echo "checked";}else{echo "";} ?> name="type" value="2" type="radio" id="radio_2">
                          <label for="radio_2">Image</label> 
                      </div>

                      <div class="form-group">
                          <label>Banner code for (728 x 90)</label>
                          <textarea class="form-control" name="code" rows="8"><?php echo $ad->code ?></textarea>
                      </div>


                      <div class="form-group">
                          <?php if (isset($page_title) && $page_title == "Edit"): ?>
                              <img width="200px" src="<?php echo base_url($ad->thumb) ?>">
                          <?php endif; ?><br>
                          <input type="file" id="imgInp" name="photo">
                      </div>

                      <div class="form-group">
                          <label>Image url</label>
                          <input type="text" class="form-control" name="img_url" value="<?php echo $ad->img_url; ?>">
                      </div>

                      <input type="hidden" name="id" value="<?php echo $ad->id; ?>">

                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <button type="submit" class="btn btn-info">Save</button>
                  </form>
              </div>
          </div>
      </div>
      <?php else: ?>

      <div class="col-md-12 all_page_area">
          <div class="panel panel-default">
            
              <div class="panel-heading">
                  <h3 class="panel-title">All Ads <a href="#" class="pull-right btn btn-info add_page"><i class="fa fa-plus"></i> Add new Ads</a></h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 scroll">
                          <table class="table table-bordered" id="dg_table">
                              <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Ad type</th>
                                      <th>Ad location</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php $i=1; foreach ($ads as $ad): ?>
                                  <tr id="row_<?php echo $ad->id; ?>">
                                      <td><?php echo $i; ?></td>
                                      <td>
                                        <?php if ($ad->type == 1): ?>
                                          <span class="label label-primary">Code</span>
                                        <?php elseif ($ad->type == 2): ?>
                                          <span class="label label-info">Image</span>
                                        <?php endif ?>
                                      </td>
                                      <td>
                                        <?php if ($ad->ad_type == 1): ?>
                                          <span class="label label-primary">Index Top Ad</span>
                                        <?php elseif ($ad->ad_type == 2): ?>
                                          <span class="label label-primary">Index bottom Ad</span>
                                        <?php elseif ($ad->ad_type == 3): ?>
                                          <span class="label label-primary">Photos page</span>
                                        <?php elseif ($ad->ad_type == 4): ?>
                                          <span class="label label-primary">Videos page</span>
                                        <?php elseif ($ad->ad_type == 5): ?>
                                          <span class="label label-primary">Category page</span>
                                        <?php endif ?>
                                      </td>
                                      
                                      <td class="actions">
                                        <a href="<?php echo base_url('admin/ads/edit/'.$ad->id);?>" class="on-default edit-row" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
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
      
      <?php endif; ?>

    </div>

  </div>
</div>

