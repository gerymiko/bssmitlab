	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/hometis/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/hometis/dist/js/adminlte.min.js"></script>
	<!-- PLUGIN -->
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery-validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/hometis/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/hometis/fastclick/fastclick.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/hometis/pace/pace.min.js"></script>
	<?php
		if (count($js_script) !== 0) {
			for ($i=0; $i < count($js_script); $i++) { 
				echo $js_script[$i];
			}
		}
	?>
