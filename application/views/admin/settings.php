<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Start content -->
<div class="content">
    <div class="container">

        <!-- breadcrumb -->
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb pull-right">
                  <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  <li class="active">Settings</li>
                </ol>
            </div>
        </div>


        <div class="row">

            <div class="col-lg-12">
                
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active">
                        <a href="#general" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-cog"></i> General Settings</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#photos" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-cog"></i> Members & Photos Settings</a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#site" role="tab" data-toggle="tab" aria-expanded="false"><i class="fa fa-cog"></i> Site Settings</a>
                    </li>
                </ul>

                <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update') ?>" role="form" class="form-horizontal">

                    <div class="tab-content">
                        
                        <!-- General tab -->
                        <div role="tabpanel" class="tab-pane fade active in" id="general">


                            <div class="form-group m-t-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Application  Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="site_name" value="<?php echo $settings->site_name; ?>" class="form-control" >
                                </div>
                            </div>
                        

                            <div class="form-group m-t-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Application  Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="site_title" value="<?php echo $settings->site_title; ?>" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group m-t-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Favicon Icon</label>
                                <div class="col-sm-10">
                                    <img width="20px" src="<?php echo base_url($settings->favicon); ?>">
                                    <div style="position:relative;" class="m-t-5">
                                        <a class='btn btn-primary' href='javascript:;'>
                                            <i class="fa fa-cloud-upload"></i> Change icon
                                            <input type="file" style='position:absolute;z-index:2;top:0;left:0;height:38px;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="photo1" size="40"  onchange='$("#upload-favicon").html($(this).val());'>
                                        </a>
                                        &nbsp;
                                        <span class='label label-info' id="upload-favicon"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-t-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Logo</label>
                                <div class="col-sm-10">
                                    <img width="100px" src="<?php echo base_url($settings->logo); ?>">
                                    <div style="position:relative;" class="m-t-5">
                                        <a class='btn btn-primary' href='javascript:;'>
                                            <i class="fa fa-cloud-upload"></i> Change logo
                                            <input type="file" style='position:absolute;z-index:2;top:0;left:0;height:38px;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="photo2" size="40"  onchange='$("#upload-logo").html($(this).val());'>
                                        </a>
                                        &nbsp;
                                        <span class='label label-info' id="upload-logo"></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="example-input-normal">Keywords</label>
                                <div class="col-sm-10">
                                    <input type="text" data-role="tagsinput" name="keywords" value="<?php echo $settings->keywords; ?>" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="example-input-normal">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description"><?php echo $settings->description; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="example-input-normal">Footer About</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="footer_about"><?php echo $settings->footer_about; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="example-input-normal">Admin Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="admin_email" class="form-control" value="<?php echo $settings->admin_email; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="example-input-normal">Copyright</label>
                                <div class="col-sm-10">
                                    <input type="text" name="copyright" class="form-control" value="<?php echo $settings->copyright; ?>">
                                </div>
                            </div>

                            
                        </div>





                        <!-- Members & Photos -->
                        <div role="tabpanel" class="tab-pane fade" id="photos">
                            
                            <?php if ($settings->home_banner == "manual"): ?>
                                <?php $dis = 'block'; ?>
                            <?php else: ?>
                                <?php $dis = 'none'; ?>
                            <?php endif ?>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Home banner image</label>
                                <div class="col-sm-10">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio8" value="auto" class="show_auto" name="home_banner" <?php if($settings->home_banner == 'auto'){ echo "checked";} ?>>
                                        <label for="inlineRadio8"> Show latest featured image </label>
                                    </div>
                                    <div class="radio radio-info radio-inline m-l-5">
                                        <input type="radio" id="inlineRadio9" value="manual" class="manual_upload" name="home_banner" <?php if($settings->home_banner == 'manual'){ echo "checked";} ?>>
                                        <label for="inlineRadio9"> Manualy Upload </label>
                                    </div> <br>

                                    
                                    <div style="position:relative; display: <?php echo $dis; ?>" class="m-t-30 banner_upload_area">
                                        <img width="100px" src="<?php echo base_url($settings->home_banner_thumb); ?>"><br>
                                        <a class='btn btn-primary m-t-5' href='javascript:;'>
                                            <i class="fa fa-cloud-upload"></i> Upload Image
                                            <input type="file" style='position:absolute;z-index:2;top:22px;height:38px; left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="photo" size="40"  onchange='$("#upload-banner").html($(this).val());'>
                                        </a>
                                        &nbsp;
                                        <span class='label label-info' id="upload-banner"></span>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Enable Ads or Banner</label>
                                <div class="col-sm-10">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio15" value="1" name="enable_ad" <?php if($settings->enable_ad == 1){ echo "checked";} ?>>
                                        <label for="inlineRadio17"> ON </label>
                                    </div>
                                    <div class="radio radio-info radio-inline m-l-5">
                                        <input type="radio" id="inlineRadio16" value="0" name="enable_ad" <?php if($settings->enable_ad == 0){ echo "checked";} ?>>
                                        <label for="inlineRadio18"> OFF </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Photo Approval</label>
                                <div class="col-sm-10">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio1" value="1" name="photo_approval" <?php if($settings->photo_approval == 1){ echo "checked";} ?>>
                                        <label for="inlineRadio1"> Auto </label>
                                    </div>
                                    <div class="radio radio-info radio-inline m-l-5">
                                        <input type="radio" id="inlineRadio2" value="2" name="photo_approval" <?php if($settings->photo_approval == 2){ echo "checked";} ?>>
                                        <label for="inlineRadio2"> By Admin </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">User Registration</label>
                                <div class="col-sm-10">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio15" value="1" name="enable_registration" <?php if($settings->enable_registration == 1){ echo "checked";} ?>>
                                        <label for="inlineRadio15"> ON </label>
                                    </div>
                                    <div class="radio radio-info radio-inline m-l-5">
                                        <input type="radio" id="inlineRadio16" value="0" name="enable_registration" <?php if($settings->enable_registration == 0){ echo "checked";} ?>>
                                        <label for="inlineRadio16"> OFF </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Who can Download</label>
                                <div class="col-sm-10">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio11" value="1" name="photo_download" <?php if($settings->photo_download == 1){ echo "checked";} ?>>
                                        <label for="inlineRadio11"> Registered Users </label>
                                    </div>
                                    <div class="radio radio-info radio-inline m-l-5">
                                        <input type="radio" id="inlineRadio22" value="2" name="photo_download" <?php if($settings->photo_download == 2){ echo "checked";} ?>>
                                        <label for="inlineRadio22"> Everyone </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Message character Length</label>
                                <div class="col-sm-10">
                                    <input type="number" name="mgs_char_length" class="form-control" value="<?php echo $settings->mgs_char_length; ?>">
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Comments character Length</label>
                                <div class="col-sm-10">
                                    <input type="number" name="comments_char_length" class="form-control" value="<?php echo $settings->comments_char_length; ?>">
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Photo Uoload Perday</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="upload_limit">
                                       <?php for ($i=1; $i < 51; $i++) { ?>
                                            <option <?php if($settings->upload_limit == $i){echo "selected";}else{echo "";} ?> value="<?php echo $i; ?>"><?php echo $i; ?> Photos</option>
                                       <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Photo Grid</label>
                                <div class="col-sm-10">
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio3" value="3" name="grid_columns" <?php if($settings->grid_columns == 3){ echo "checked";} ?>>
                                        <label for="inlineRadio3"> 3 Columns </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio4" value="4" name="grid_columns" <?php if($settings->grid_columns == 4){ echo "checked";} ?>>
                                        <label for="inlineRadio4"> 4 Columns </label>
                                    </div>
                                    <div class="radio radio-info radio-inline">
                                        <input type="radio" id="inlineRadio5" value="5" name="grid_columns" <?php if($settings->grid_columns == 5){ echo "checked";} ?>>
                                        <label for="inlineRadio5"> 5 Columns </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Pagination Limit</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="number" name="pagination_limit" value="<?php echo $settings->pagination_limit; ?>">
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Maximum Input file limit</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="input_file_limit">
                                       <?php for ($i=1; $i < 64; $i++) { ?>
                                            <option <?php if($settings->input_file_limit == $i*1024){echo "selected";}else{echo "";} ?> value="<?php echo $i*1024; ?>"><?php echo $i; ?> MB</option>
                                       <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group m-b-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Video file limit (MB)</label>
                                <div class="col-sm-10">
                                    <input type="number" name="video_file_limit" class="form-control" value="<?php echo $settings->video_file_limit; ?>">
                                </div>
                            </div>

                        </div>


                        <!-- Site Settings tab -->
                        <div role="tabpanel" class="tab-pane fade" id="site">
                            
                            <div class="form-group m-t-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Facebook</label>
                                <div class="col-sm-10">
                                    <input type="text" name="facebook" value="<?php echo $settings->facebook; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group m-t-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Twitter</label>
                                <div class="col-sm-10">
                                    <input type="text" name="twitter" value="<?php echo $settings->twitter; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group m-t-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Google</label>
                                <div class="col-sm-10">
                                    <input type="text" name="google" value="<?php echo $settings->google; ?>" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group m-t-20">
                                <label class="col-sm-2 control-label" for="example-input-normal">Flickr</label>
                                <div class="col-sm-10">
                                    <input type="text" name="flicker" value="<?php echo $settings->flicker; ?>" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="example-input-normal">Google Analytics</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control summernote" name="google_analytics" rows="8"><?php echo $settings->google_analytics; ?></textarea>
                                </div>
                            </div>

                        </div>
                        
                    </div>


                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <div class="box-bottom">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary waves-effect w-md waves-light m-b-5">Save Changes</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
        

    </div> <!-- container -->

</div> 
<!-- content -->