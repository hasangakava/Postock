

jQuery(function($) {

  "use strict";
  
    var base_url = $('#base_url').val();

    $('[data-toggle="tooltip"]').tooltip(); 
  

    //-- ajax login admin function 
    $('#login-form').submit(function(){
        $.post($('#login-form').attr('action'), $('#login-form').serialize(), function(json){
            if ( json.st == 0 ){
                $('#login_pass').val('');
                swal({
                  title: "Error..",
                  text: "Sorry username or password is not correct !",
                  type: "error",
                  confirmButtonText: "Try Again"
                });

            }else {
              window.location = json.url;
            }
        },'json');
        return false;
    });

    // user register function 
    $(function(){
        $('#register-form').submit(function(){

            $.post($('#register-form').attr('action'), $('#register-form').serialize(), function(json){

                if (json.st == 1) {
                    swal({
                          title: "Success",
                          text: "Account has been created successfully",
                          type: "success",
                          showConfirmButton: true
                    }, function(){
                            window.location = json.url;
                    });
                    
                }else if (json.st == 2) {
                    swal({
                      title: "Opps !",
                      text: "This Email Already Used",
                      type: "error",
                      showConfirmButton: true
                    });
                }else {
                    swal({
                      title: "Error!",
                      text: "Password at least 4 digit",
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });

    });


    //-- ajax register admin function 
    $(function(){
        $('#register_admin_form').submit(function(){

            $.post($('#register_admin_form').attr('action'), $('#register_admin_form').serialize(), function(json){

                if (json.st == 1) {
                    swal({
                          title: "Success",
                          text: "Your account has been created successfully",
                          type: "success",
                          showConfirmButton: true
                    }, function(){
                            window.location = json.url;
                    });
                }
            },'json');
            return false;
        });

    });


    // cahage pass function 
    $(function(){
        $('#cahage_pass_form').submit(function(){
          
            $.post($('#cahage_pass_form').attr('action'), $('#cahage_pass_form').serialize(), function(json){

                if (json.st == 1) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                          title: "Congratulations!",
                          text: "Your Password has been changed Successfully",
                          type: "success",
                          showConfirmButton: true
                    });
                }else if (json.st == 2) {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: "Opps !",
                      text: "Your Confirm Password doesn't Match",
                      type: "error",
                      showConfirmButton: true
                    });
                }else {
                    $('#cahage_pass_form')[0].reset();
                    swal({
                      title: "Error!",
                      text: "Your Old Password doesn't Match",
                      type: "error",
                      showConfirmButton: true
                    });
                }
            },'json');
            return false;
        });

    });


    //recover password form
    $('#lost-form').submit(function(){
        $.post($('#lost-form').attr('action'), $('#lost-form').serialize(), function(json){
            
            if ( json.st == 1 ){

                swal({
                      title: "Password Reset Successfully!",
                      text: "We've sent a password to your email address. Please check your inbox or spam folder",
                      type: "success",
                      showConfirmButton: true
                    }, function(){
                        window.location = json.url;
                });
            
            } else {
              swal({
                  title: "Sorry !",
                  text: "You are not a valid user",
                  type: "error",
                  confirmButtonText: "Try Again"
                });
            }
        },'json');
        return false;
    });


    //recover password form
    $('#edit_admin_profile').submit(function(){
        $.post($('#edit_admin_profile').attr('action'), $('#edit_admin_profile').serialize(), function(json){
            
            if ( json.st == 1 ){
                swal({
                      title: "Success",
                      text: "Info updated Successfully !",
                      type: "success",
                      showConfirmButton: true
                    }, function(){
                        window.location.reload();
                });
            }
        },'json');
        return false;
    });



    // ajax img upload function 
    $('#video-upload-form').on('submit',(function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          
          $('.imgup').hide();
          $('.ploader').show();
          $('html, body').animate({ scrollTop: 25 }, 'slow');

          $.ajax({
              type:'POST',
              url: base_url+'admin/photos/upload_video',
              data:formData,
              dataType: 'json',
              cache:false,
              contentType: false,
              processData: false,
              success:function(data){
                
                if (data.status == 1) {
                    $('.ploader').hide();
                    $('.showup').show();
                    swal({
                        title: "Success",
                        text: "Video uploaded successfully",
                        type: "success",
                        showConfirmButton: true
                    }, function(){
                        window.location = data.url;
                    });
                }else{
                    $('.ploader').hide();
                    swal({
                        title: "Opps !",
                        text: data.msg,
                        type: "error",
                        showConfirmButton: true
                    }, function(){
                        location.reload();
                    });
                }
                console.log("success");
                console.log(data);
              },
              error: function(data){
                  console.log("error");
                  console.log(data);
              }
          });
      }));



    // ajax img upload function 
    $('#img-upload-form').on('submit',(function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          
          $('.imgup').hide();
          $('.ploader').show();
          $('html, body').animate({ scrollTop: 25 }, 'slow');

          $.ajax({
              type:'POST',
              url: base_url+'admin/photos/upload_image',
              data:formData,
              dataType: 'json',
              cache:false,
              contentType: false,
              processData: false,
              success:function(data){
                
                if (data.status == 1) {
                    $('.ploader').hide();
                    $('.showup').show();
                    swal({
                        title: "Success",
                        text: "Image uploaded successfully",
                        type: "success",
                        showConfirmButton: true
                    }, function(){
                        window.location = data.url;
                    });
                }else{
                    $('.ploader').hide();
                    swal({
                        title: "Opps !",
                        text: data.msg,
                        type: "error",
                        showConfirmButton: true
                    }, function(){
                        location.reload();
                    });
                }
                console.log("success");
                console.log(data);
              },
              error: function(data){
                  console.log("error");
                  console.log(data);
              }
          });
      }));



    //approved image by admin
    $(document).on('click', ".approve_img", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/photos/approve_img/0/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Image has been approved.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#img_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });

    //add featured image by admin
    $(document).on('click', ".add_featured", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/photos/approve_img/1/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Image has been approved and selected featured.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#img_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });


    //reject img image by admin
    $(document).on('click', ".reject_img", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/photos/reject_img/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Image has been rejected.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#img_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });



    $(".sort").change(function(){
        $('#sort_form').submit();
    });

  

      //approved image by admin
    $(document).on('click', ".approve_video", function() {

        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/videos/approve_video/0/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Video has been approved.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#video_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });

    //add featured image by admin
    $(document).on('click', ".add_featured_video", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/videos/approve_video/1/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Video has been approved and selected featured.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#video_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });


    //reject img image by admin
    $(document).on('click', ".reject_video", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'admin/videos/reject_video/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                swal({
                  title: "Success",
                  text: "Video has been rejected.",
                  type: "success",
                  showCancelButton: false
                }),
                $('#video_'+imgId).slideUp();
            }
        }, 'json' );
        return false;
    });





    $(document).on('click', ".add_page", function() {
        $('.add_page_area').slideDown();
        $('.all_page_area').slideUp();
        return false;
    });


    $(document).on('click', ".cancel_page", function() {
        $('.add_page_area').slideUp();
        $('.all_page_area').slideDown();
        return false;
    });


    $(document).on('click', ".manual_upload", function() {
        $('.banner_upload_area').slideToggle();
        $('this').checked();
        return false;
    });

    $(document).on('click', ".show_auto", function() {
        $('.banner_upload_area').slideUp();
        $('this').checked();
        return false;
    });



    //delete items
    $(document).on('click', ".delete_item", function() {
        
        var del_url = $(this).attr('href');
        var imgId = $(this).attr('data-id');


            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this file",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){ 

                $.post(del_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){     
                        swal({
                          title: "Success",
                          text: "Deleted successfully",
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#row_"+imgId).slideUp();
                    }
                },'json');

            });

        return false;

    });
    

    //delete all items
    $(document).on('click', ".delete_all_item", function() {
        
        var del_url = $(this).attr('href');
        var imgId = $(this).attr('data-id');


            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this file",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){ 

                $.post(del_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                    if(json.st == 1){     
                        swal({
                          title: "Success",
                          text: "Deleted successfully",
                          type: "success",
                          showCancelButton: false
                        }),                
                        location.reload();
                    }
                },'json');

            });

        return false;

    });



    $('.change_pass').click(function(){
        $('.change_password_area').slideDown();
        $('.edit_account_area').hide();
        $("html, body").animate({ scrollTop: 200 }, "slow");
        return false;
    });

    $('.cancel_pass').click(function(){
        $('.change_password_area').hide();
        $('.edit_account_area').slideDown();
        return false;
    });


    $('.recover_pass').click(function(){
        $('.recover-pass-area').slideDown();
        $('.login-area').hide();
        $("html, body").animate({ scrollTop: 200 }, "slow");
        return false;
    });

    $('.back_login').click(function(){
        $('.recover-pass-area').hide();
        $('.login-area').slideDown();
        return false;
    });





});