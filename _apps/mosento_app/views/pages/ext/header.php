	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist/css/bss.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist/css/skins/skin-blue.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist/css/custom.css"/>
	<!-- FONTS -->
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/font_lte/font.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/font-awesome/css/all.min.css" />
	<!-- PLUGINS -->
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/pace/pace.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/toastr/toastr.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>
	<?php
		if (count($css_script) !== 0){
			for ($i=0; $i < count($css_script); $i++){ 
				echo $css_script[$i];
			}
		}
	?>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery/jquery-3.4.1.min.js"></script>
