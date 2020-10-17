
$(document).ready(function(){

    
    $(function(){
        $('#data-table').DataTable();
    });

    //-- show register area
    $(document).on('click', "#register", function() {
        $('.login-area').hide();
        $('.register-area').slideDown();
        $('.forgot-pass-area').hide();
        return false;
    });

    $(document).on('click', "#click", function() {
      alert('hi'); return false;
        swal({
          title: "Deleted!",
          text: "User has been deleted.",
          type: "success",
          showCancelButton: false
        }),
        return false;
    });
    
    //-- auto hide msg div
    $(function() {
      setTimeout(function() {
        $('.delete_msg').slideUp();
      }, 3000);
    });

    //-- ajax user delete function  
    $(document).on('click', ".delete_item", function() {
        
        //-- get action url
        var del_url = $(this).attr('href');
        var ID = $(this).attr('data-id');

            swal({
              title: "Are you sure?",
              text: "You will not be able to recover this file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: false
            },
            function(){ 

                $.post(del_url, $(this).serialize(), function(json){
                    if(json.st == 1){  
                        swal({
                          title: "Deleted!",
                          text: "User has been deleted.",
                          type: "success",
                          showCancelButton: false
                        }),                
                        $("#row_"+ID).slideUp();
                    }
                },'json');

            });

        return false;

    });




    //-- ajax change password function 
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

    

    //-- ajax recover password function 
    $('#recover-pass-form').submit(function(){
        $.post($('#recover-pass-form').attr('action'), $('#recover-pass-form').serialize(), function(json){
            
            if ( json.st == 1 ){

                swal({
                      title: "Success !",
                      text: "Your password has been reset successfully",
                      type: "success",
                      showConfirmButton: true
                    }, function(){
                        window.location = json.url;
                });
            
            } else {
              swal({
                  title: "Oops !",
                  text: "You are not a valid user",
                  type: "error",
                  confirmButtonText: "Try Again"
                });
            }
        },'json');
        return false;
    });




    //-- ajax register user function  
    $(function(){
        $('#admin-register-form').submit(function(){

            $.post($('#admin-register-form').attr('action'), $('#admin-register-form').serialize(), function(json){

                if (json.st == 1) {
                    swal({
                          title: "Success !",
                          text: "Your account has been created successfully",
                          type: "success",
                          showConfirmButton: true
                    }, function(){
                            window.location = json.url;
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


  

    //-- ajax register user function  
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




    //-- ajax login user function 
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
            } else {
              window.location = json.url;
            }
        },'json');
        return false;
    });


    
});
