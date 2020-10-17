				<footer class="footer">
			        <?php echo $settings->copyright; ?>
			    </footer>

			</div>

			

        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

        <!-- jQuery  -->
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>

        <script src="<?php echo base_url() ?>assets/admin/js/detect.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/fastclick.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.blockUI.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/waves.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/wow.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.scrollTo.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        
        <!-- Counter Up  -->
        <script src="<?php echo base_url() ?>assets/admin/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Dashboard init -->
        <script src="<?php echo base_url() ?>assets/admin/pages/jquery.dashboard.js"></script>

        <!-- Custom js -->
        <script src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>

        <script src="<?php echo base_url()?>assets/js/sweet-alert.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.core.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/js/jquery.app.js"></script>
         <!-- Datatables-->
        <script src="<?php echo base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url() ?>assets/admin/plugins/datatables/dataTables.bootstrap.js"></script>

        <script type="text/javascript" src="<?php echo base_url()?>assets/js/imageuploadify.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('input[type="file"]').imageuploadify();
            })
        </script>

        <!-- Summernote js-->
        <script src="<?php echo base_url() ?>assets/admin/plugins/summernote/summernote.min.js"></script>

        <script>
            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 200,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });

                $('.inline-editor').summernote({
                    airMode: true
                });

            });



            $(document).ready( function() {
              $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                  label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
                });
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        
                        reader.onload = function (e) {
                            $('#img-upload').attr('src', e.target.result);
                        }
                        
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $("#imgInp").change(function(){
                    readURL(this);
                });   
              });


        </script>

        <!-- auto hide message div-->
        <script type="text/javascript">
            $( document ).ready(function(){
                $('#datatable').dataTable();
               $('.delete_msg').delay(2000).slideUp();
            });
        </script>
        
	</body>


</html>