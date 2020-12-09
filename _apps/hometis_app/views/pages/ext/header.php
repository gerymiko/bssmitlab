	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hometis/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hometis/dist/css/AdminLTE.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hometis/dist/css/skins/skin-blue-light.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hometis/dist/css/custom.css"/>
	<!-- FONTS -->
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,600italic"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hometis/font-awesome/css/all.min.css"/>
	<!-- PLUGIN -->
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hometis/pace/pace.min.css">
	<?php
		if (count($css_script) !== 0) {
			for ($i=0; $i < count($css_script); $i++) { 
				echo $css_script[$i];
			}
		}
	?>
	<!-- JQUERY -->
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/hometis/jquery/dist/jquery-3.4.1.min.js"></script>
	
