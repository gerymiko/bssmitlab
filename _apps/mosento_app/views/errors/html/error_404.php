<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>MOSENTO | PT BINA SARANA SUKSES</title>
	<meta name="description" content="web.binasaranasukses.com/mosento" />
	<meta name="keywords" content="web.binasaranasukses.com/mosento" />
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta property="og:type" content="business.business">
	<meta property="og:title" content="PT BINA SARANA SUKSES">
	<meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
	<meta property="og:url" content="web.binasaranasukses.com/mosento">
	<meta property="og:image" content="<?=site_url();?>s_url/logo_favicon">
	<meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
	<meta property="business:contact_data:locality" content="Jakarta">
	<meta property="business:contact_data:region" content="DKI Jakarta">
	<meta property="business:contact_data:postal_code" content="14460">
	<meta property="business:contact_data:country_name" content="Indonesia">
	<link rel="shortcut icon" type="image/png" href="<?=site_url();?>s_url/logo_favicon"/>
	<?php
		function siteURL(){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$domainName = $_SERVER['HTTP_HOST'].'/';
			return $protocol.$domainName;
		}
		define('SITE_URL', siteURL());
	?>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist/css/skins/skin-blue.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/font-awesome/css/all.min.css" />
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery/jquery-3.4.1.min.js"></script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">
		<div id="loading" class="loading hidden"></div>
		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
					</div>
				</div>
			</nav>
		</header>
		<div class="content-wrapper" style="background: #0073B7;color: #fff;">
			<section class="content">
				<div class="error-page" style="margin-top: 150px;">
					<h2 class="headline text-red"> 404</h2>
					<div class="error-content">
						<h3><i class="fas fa-exclamation-triangle text-orange"></i> Oops! Page not found.</h3>
						<p>
							We could not find the page you were looking for.
							Meanwhile, you may Return to <a href="<?=site_url()?>menu/site"><span class="label bg-red ls3">HOMEPAGE</span></a>
						</p>
					</div>
				</div>
			</section>
		</div>
	</div>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/dist/js/adminlte.min.js"></script>
	<a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>
	<script>
		$(function(){$(window).scroll(function(){if($(this).scrollTop()>100){$('#scroll').fadeIn();}else{$('#scroll').fadeOut();}});$('#scroll').click(function(){$("html, body").animate({ scrollTop: 0 }, 600);return false;});});
	</script>
</body>
</html>


