

jQuery(function($) {

    "use strict";

    var base_url = $('#base_url').val();
    $('[data-toggle="tooltip"]').tooltip(); 
    


    // user register function 
    $(function(){
        $('#register-form').submit(function(){

            $.post($('#register-form').attr('action'), $('#register-form').serialize(), function(json){

                if (json.st == 1) {
                    swal({
                          title: "Success",
                          text: "Your account has been created successfully",
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


    // login user function
    $('#login-form').submit(function(){
        $.post($('#login-form').attr('action'), $('#login-form').serialize(), function(json){
            if ( json.st == 0 ){
                $('#login_pass').val('');
                swal({
                  title: "Error..",
                  text: "Sorry your email or password is not correct !",
                  type: "error",
                  confirmButtonText: "Try Again"
                });

            }else if(json.st == 2){
                swal({
                  title: "Error..",
                  text: "Your account has been suspended!",
                  type: "error",
                  confirmButtonText: "Try Again"
                });
            }else if(json.st == 3){
                swal({
                  title: "Error..",
                  text: "Your account is not verified, please check verification link in your email inbox or spam folder",
                  type: "error",
                  confirmButtonText: "Try Again"
                });
            } else {
              window.location = json.url;
            }
        },'json');
        return false;
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
                      text: "We've sent a password to your email address. Please check your inbox",
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




    // send message to user
    $('.send_user_message').submit(function(){
        $.post($('.send_user_message').attr('action'), $('.send_user_message').serialize(), function(json){
            if (json.st == 1) {
                swal({
                    title: "Success",
                    text: "Message sent successfully",
                    type: "success",
                    showConfirmButton: true
                }, function(){
                    location.reload();
                });
            }
            else if (json.st == 2) {
                swal({
                    title: "Opps !",
                    text: "You need to write something",
                    type: "error",
                    showConfirmButton: true
                });
            }
        },'json');
        return false;
    });



    // image report function
    $('#reprot_img_form').submit(function(){
        $.post($('#reprot_img_form').attr('action'), $('#reprot_img_form').serialize(), function(json){
            if (json.st == 1) {
                swal({
                    title: "Success",
                    text: "Report added successfully",
                    type: "success",
                    showConfirmButton: true
                }, function(){
                    location.reload();
                });
            }
        },'json');
        return false;
    });


    // ajax img upload function 
    $('#img-upload-form').on('submit',(function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          
          $('.imgup').hide();
          $('.ploader').show();
          $('html, body').animate({ scrollTop: 25 }, 'slow');

          $.ajax({
              type:'POST',
              url: base_url+'user/upload_image',
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



    // ajax img upload function 
    $('#video-upload-form').on('submit',(function(e) {
          e.preventDefault();
          var formData = new FormData(this);
          
          $('.imgup').hide();
          $('.ploader').show();
          $('html, body').animate({ scrollTop: 25 }, 'slow');

          $.ajax({
              type:'POST',
              url: base_url+'user/upload_video',
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

    


    $(".sort").change(function(){
        $('.sort_form').submit();
    });

    $(".country_sort").change(function(){
        $('.sort_cn_form').submit();
    });



    // create new collection
    $('.add_collection').click(function(){
        var imgId = $(this).attr('data-id');

        $(function(){
            $('#create_'+imgId).submit(function(){
                $.post($('#create_'+imgId).attr('action'), $('#create_'+imgId).serialize(), function(json){
                    if (json.st == 1) {

                        $('.create-coll').slideUp();
                        $('.add-coll').slideDown();
                        $('.create_collection')[0].reset();
                        $('.load_cdata').html(json.loaded);
                    }
                },'json');
                return false;
            });
        });

    });

    // add image to collection
    $('.add_coll_img').click(function(){
        var imgId = $(this).attr('data-id');

        $(function(){
            $('#add_collection_'+imgId).submit(function(){
                $.post($('#add_collection_'+imgId).attr('action'), $('#add_collection_'+imgId).serialize(), function(json){
                    if (json.st == 1) {
                        swal({
                            title: "Success",
                            text: "Image added to collection",
                            type: "success",
                            showConfirmButton: true
                        }, function(){
                            location.reload();
                        });
                    }
                },'json');
                return false;
            });
        });

    });


   // remove image from collection
    $(document).on('click', ".remove_collection", function() {
        var imgId = $(this).attr('data-id');

        var url = base_url+'photos/remove_collection/'+imgId;
        
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if (json.st == 1) {
                swal({
                    title: "Success",
                    text: "Image remove from your collection",
                    type: "success",
                    showConfirmButton: true
                }, function(){
                    location.reload();
                });
            }
        }, 'json' );
        return false;
    });



    $(document).on('click', ".new_coll_btn", function() {
        $('.create-coll').slideDown();
        $('.add-coll').slideUp();
        return false;
    });

    $(document).on('click', ".back_coll_btn", function() {
        $('.create-coll').slideUp();
        $('.add-coll').slideDown();
        return false;
    });



    // delete function
    $(document).on('click', ".delete_img", function() {
        
        var del_url = $(this).attr('href');
        var ID = $(this).attr('data-id');

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
                          title: "Deleted!",
                          text: "Image has been deleted.",
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#img_"+ID).slideUp();
                    }
                },'json');

            });

        return false;

    });


    // delete function
    $(document).on('click', ".delete_cmt", function() {
        
        var del_url = $(this).attr('href');
        var ID = $(this).attr('data-id');

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
                          title: "Deleted!",
                          text: "Image has been deleted.",
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#row_"+ID).slideUp();
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


    $('.comment_form').submit(function(){
        $.post($('.comment_form').attr('action'), $('.comment_form').serialize(), function(json){
            if ( json.st == 1 ){
                $('#load_comment').html(json.loaded);
                $('.comment_form')[0].reset();
            }
        },'json');
        return false;
    });



    // like image
    $(document).on('click', ".like", function(e) {
        var imgId = $(this).attr('data-id');
        var totalLike = Number($('#img_'+imgId+' .like_count_input').val());

        var url = base_url+'photos/like_img/'+imgId;
        
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                $("#img_"+imgId+" .like").addClass('unlike');
                $("#img_"+imgId+" .like").removeClass('like');

                $("#img_"+imgId+" .iconl").addClass('fa-thumbs-up');
                $("#img_"+imgId+" .iconl").removeClass('fa-thumbs-o-up');

                $("#img_"+imgId+" .like_count").html(totalLike+1);
                $("#img_"+imgId+" .like_count_input").val(totalLike+1);
            }
        }, 'json' );
         e.preventDefault();
    });


    // unlike image
    $(document).on('click', ".unlike", function(e) {
        var imgId = $(this).attr('data-id');
        var totalLike = Number($('#img_'+imgId+' .like_count_input').val());

        var url = base_url+'photos/unlike_img/'+imgId;
        
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                $("#img_"+imgId+" .unlike").addClass('like');
                $("#img_"+imgId+" .unlike").removeClass('unlike');

                $("#img_"+imgId+" .iconl").addClass('fa-thumbs-o-up');
                $("#img_"+imgId+" .iconl").removeClass('fa-thumbs-up');
               

                $("#img_"+imgId+" .like_count").html(totalLike-1);
                $("#img_"+imgId+" .like_count_input").val(totalLike-1);
            }
        }, 'json' );
         e.preventDefault();
    });
    

    // single image like
    $(document).on('click', "#like", function() {
        var imgId = $(this).attr('data-id');
        var totalLike = Number($('.like_count_input').val());
        var url = base_url+'photos/like_img/'+imgId;
        $(this).hide(); $('#unlike').show();

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                $('.like_count').html(totalLike+1);
                $('.like_count_input').val(totalLike+1);
            }
        }, 'json' );
        return false;
    });

    $(document).on('click', "#unlike", function() {
        var imgId = $(this).attr('data-id');
        var totalLike = Number($('.like_count_input').val());
        var url = base_url+'photos/unlike_img/'+imgId;
        $(this).hide(); $('#like').show();

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                $('.like_count').html(totalLike-1);
                $('.like_count_input').val(totalLike-1);
            }
        }, 'json' );
        return false;
    });


    // load more comment
    $(document).on('click', ".comment_load", function() {
        var limit = $('#limit').val();
        var imgId = $('#img_id').val();

        var url = base_url+'photos/load_more/'+limit+'/'+imgId;

        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
           if(json.st == 1){
                $('#load_comment').html(json.loaded);
                $('#limit').val(json.limit);
            }
        }, 'json' );
        return false;
    });


    // follow user
    $(document).on('click', ".follow", function() {
        var id = $(this).attr('data-id');
        var url = base_url+'member/follow/'+id;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
            if(json.st == 1){
                $(".follow").html('Following');
                $(".follow").addClass('unfollow');
                $(".follow").removeClass('follow');
            }
         },'json');
        return false;
    });

    // unfollow user
    $(document).on('click', ".unfollow", function() {
        var id = $(this).attr('data-id');
        var url = base_url+'member/unfollow/'+id;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
            if(json.st == 1){
                $(".unfollow").html('Follow');
                $(".unfollow").addClass('follow');
                $(".unfollow").removeClass('unfollow');
            }
         },'json');
        return false;
    });





    // Multiple user follow 
    $(document).on('click', ".mfollow", function() {
        var id = $(this).attr('data-id');
        var url = base_url+'member/follow/'+id;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
            if(json.st == 1){
                $("#item_"+id+" .mfollow").html('Following');
                $("#item_"+id+" .mfollow").addClass('munfollow');
                $("#item_"+id+" .mfollow").removeClass('mfollow');
            }
         },'json');
        return false;
    });

    // Multiple user unfollow 
    $(document).on('click', ".munfollow", function() {
        var id = $(this).attr('data-id');
        var url = base_url+'member/unfollow/'+id;
        $.post(url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
            if(json.st == 1){
                $("#item_"+id+" .munfollow").html('Follow');
                $("#item_"+id+" .munfollow").addClass('mfollow');
                $("#item_"+id+" .munfollow").removeClass('munfollow');
            }
         },'json');
        return false;
    });



    $(document).on('change', "#copyright", function() {
        $('#search_photos').submit();
    });

    $(document).on('change', "#photo_category", function() {
        $('#search_photos').submit();
    });





    $(document).click(function() {
      if( this.id != 'notificationContainer') {
        $("#notificationContainer").fadeOut();
      }
    });



    // load notification
    $("#notificationLink").click(function(){
        $("#notificationContainer").fadeToggle(300);
        $("#notification_count").fadeOut("slow");

        var notification_url = base_url+'notifications/my/';
        $.post(notification_url, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
            if(json.st == 1){
               $('#notifications_container').html(json.noti);
            }
        },'json');
        return false;
    });




    // send message functions start
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {
            
            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if( input.length ) {
                input.val(log);
            }
        
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    $('.img-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".imgInp").change(function(){
            readURL(this);
        });     



        // message operation
        $(function(){        
                
            message_operation();
            message_scroll();

            $('.mgs_with_btn').click(function(){

                var userID = $(this).attr('data-target');
                $('.mgs_with_btn').removeClass('msg_active');
                $(this).addClass('msg_active');

                var oprLoadUrl = base_url+"message/details/"+userID; 
                $.post(oprLoadUrl, { data: 'value', 'csrf_test_name': csrf_token }, function(json) {
                //$.post(oprLoadUrl, $(this).serialize(), function(json){
                    
                    $('#load_message').html(json.data_load); 
                    $('.message_heading_bottom_right').addClass('mgs_mob_dis');                   
                    message_operation();
                    message_scroll();

                    $('.load_message').show();                    
                    $('html, body').animate({ scrollTop: 0 }, 'slow');

                },'json');

                return false;

            });


        });


        var message_operation = function() {

            $('.send_message_form').submit(function(){

                $('.submission_text').attr('disabled');

                $.post($(this).attr('action'), $(this).serialize(), function(json){
                    if ( json.st == 1 ){

                        $('.send_message_form')[0].reset();
                        $(".message_area").append(json.append);

                        $("#mgs_input").val('');
                        $('.submission_text').removeAttr('disabled');
                        //message_scroll();

                        $('.message_area').animate({scrollTop: $('.message_area').prop("scrollHeight")}, 400);
                        $('.message_area_full').animate({scrollTop: $('.message_area_full').prop("scrollHeight")}, 400);


                    } else {
                        sweetAlert("Oops...", "Already Action!!!", "error");
                    }
                },'json');
                return false;
            });

        }

        $('.close_message').click(function(){
            $('.message_heading_bottom_right').removeClass('mgs_mob_dis'); 
            $('.load_message').hide();
            $('.close_message').hide();
        });


        $('.mgs_list').click(function(){
            if ($(window).width() < 420) {
               $('.close_message').show();
            }  
        });


        var message_scroll = function() { 
            if($('.multiple_datepicker').length) {
                $('.message_area').animate({
                    scrollTop: $('.single_sms_part:last-child').position().top
                }, 1000);
            };
        }

        var sendMessage = function() {  

            $(".send_mgs_open_btn").click(function(){
                var user_id = $(this).attr('data');
                $('#send_mgs_'+user_id).slideToggle();
                return false;
            });

            $('.send_mgs_form_user').submit(function(){
                $.post($(this).attr('action'), $(this).serialize(), function(json){
                    if ( json.st == 1 ){
                        $('#send_mgs_open_btn_'+json.user_id).removeClass('btn-default');
                        $('#send_mgs_open_btn_'+json.user_id).addClass('btn-success');
                        $('#send_mgs_open_btn_'+json.user_id).html('Message Sent');
                        $('#save_free_mgs_'+json.user_id).slideUp();
                        $("#save_free_mgs_"+json.user_id+' textarea').val('');

                        $("#free_pro_mgs_"+json.user_id).slideUp();
                        $("#free_pro_mgs_"+json.user_id+' textarea').val('');

                        $('.f_message').removeClass('btn-info');
                        $('.f_message').addClass('btn-success');
                        $('.f_message').html('Message Sent');
                    } else {
                        sweetAlert("Oops...", "Already Action!!!", "error");
                    }
                },'json');
                return false;
            });
            
        };


        $('.msg_enter').keypress(function(e){
          if(e.which == 13){
              var mgs = $(this).val().replace(/^\s*(\n)\s*$/, '');
              if(mgs != ''){
                  $('form.photo_comments_form').submit();
                  $('.msg_enter').val('');
              }
           }
        });

        // end message functions


        


});