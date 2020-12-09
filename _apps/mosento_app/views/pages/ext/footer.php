	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/dist/js/bss.min.js"></script>
	<!-- PLUGIN -->
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery-validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/pace/pace.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/toastr/toastr.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<?php
		if (count($js_script) !== 0) {
			for ($i=0; $i < count($js_script); $i++) { 
				echo $js_script[$i];
			}
		}
	?>


