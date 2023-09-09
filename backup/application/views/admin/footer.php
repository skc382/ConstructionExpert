<input type="hidden" id="page" value="<?=$page?>">
<input type="hidden" id="baseurl" value="<?=$base_url?>">

<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" id="admin_csrf" />
</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="<?=$base_url?>backend/js/jquery-3.2.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?=$base_url?>backend/js/popper.min.js"></script>
        <script src="<?=$base_url?>backend/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
        <script src="<?=$base_url?>backend/plugins/slimscroll/jquery.slimscroll.min.js"></script>

		<!-- Datatables JS -->
		<script src="<?=$base_url?>backend/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?=$base_url?>backend/plugins/datatables/datatables.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="<?=$base_url?>backend/js/select2.min.js"></script>
		
		<script src="<?=$base_url?>backend/js/summernote.min.js"></script>
		<!-- bootstrap datepicker -->
		<script src="<?=$base_url?>asset/plugins/datepicker/js/bootstrap-datetimepicker.min.js"></script>

		<!-- Custom JS -->
		<script  src="<?=$base_url?>backend/js/script.js"></script>
    <script  src="<?=$base_url?>backend/js/admin.js"></script>
		<script>
				 // Datapicker
		$('.datepicker').datetimepicker({
        format: "DD-MM-YYYY"
    });
		</script>
    </body>

<!-- Mirrored from dreamguys.co.in/demo/doccure/admin/blank-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 30 Nov 2019 04:12:53 GMT -->
</html>