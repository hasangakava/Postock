<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Start content -->
<div class="content">
	<div class="container">

		<!-- breadcrumb -->
    <div class="row">
        <div class="col-sm-12">
             <div class="btn-group pull-right m-t-5 m-b-20" style="display: none;">
                  <?php if (isset($message) && $message != ''): ?>
                      <div class="alert alert-success">
                        <strong>Success!</strong> <?php echo $message; ?>
                      </div>
                  <?php endif ?>
              </div>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Edit Photos</li>
            </ol>
        </div>
    </div>

    <div class="row">

      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">Edit Photos</h3>
              </div>
              <div class="panel-body">
                  <form method="post" action="<?php echo base_url('admin/photos/edit/'.$image->id)?>" role="form">

                      <div class="form-group">
                        <img width="20%" class="thumbnail" src="<?php echo base_url($image->thumb); ?>"><br>
                      </form>
                      <div class="form-group">
                          <label>Page title</label>
                          <input type="text" class="form-control" name="title" value="<?php echo $image->title ?>">
                      </div>
                      <div class="form-group">
                          <label class="ltext">Tags</label>
                          <input type="text" data-role="tagsinput" name="tags[]" value="<?php echo $tags; ?>" class="form-control" >
                      </div>

                      <div class="form-group">
                          <label>Category</label>
                          <select name="category" class="form-control custom-select" aria-invalid="false">
                              <option value="0">Select Category</option>
                              <?php foreach ($categories as $cat): ?>
                                <?php if ($cat['id'] == $image->category) {
                                  $selected = 'selected';
                                } else {
                                  $selected = '';
                                }
                                 ?>
                                <option <?php echo $selected; ?> value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                              <?php endforeach ?>
                          </select>
                      </div>

                      <div class="form-group">
                          <label>Copyright</label>
                          <select name="copyright" class="form-control custom-select" aria-invalid="false">
                            <option value="0">Select Copyright</option>
                              <option <?php if($image->copyright == 1){echo "selected";} ?> value="1">CCO (Public Domain)</option>
                              <option <?php if($image->copyright == 2){echo "selected";} ?> value="2">CC-BY (Attribution)</option>
                          </select>
                      </div>
                      <input type="hidden" name="id" value="<?php echo $image->id; ?>">

                      <!-- csrf token -->
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                      <button type="submit" class="btn btn-info">Save changes</button>
                  </form>
              </div>
          </div>
      </div>

      
    </div>

  </div>
</div>

