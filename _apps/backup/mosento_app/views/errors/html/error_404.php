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
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist-mosento/css/AdminLTE.min.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist-mosento/css/custom.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist-mosento/css/skins/skin-blue.min.css">
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/font-awesome/css/all.min.css" />
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/jquery/dist/jquery.min.js"></script>
</head>
<body id="body" class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">
		<div id="loading" class="loading hidden"></div>
		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<img src="<?=site_url();?>s_url/logo" alt="BSS MOSENTO" class="logo" />
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					</div>
				</div>
			</nav>
		</header>
		<div class="content-wrapper">
			<section class="content">
				<div class="error-page">
					<h2 class="headline text-yellow"> 404</h2>

					<div class="error-content">
						<h3><i class="fas fa-exclamation-triangle text-yellow"></i> Oops! Page not found.</h3>

						<p>
							We could not find the page you were looking for.
							Meanwhile, you may <a href="<?=site_url()?>dashboard">return to dashboard</a>.
						</p>
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			<div class="container">
				<div class="pull-right hidden-xs">
					<b>Version</b> 1.0.0
				</div>
				<strong>Copyright &copy; <?=date("Y");?> <a class="text-red" href="#">PT BINA SARANA SUKSES</a>.</strong> All rights reserved.
			</div>
		</footer>
	</div>

	<!-- Bottom Script -->
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/dist-mosento/js/adminlte.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/font-awesome/js/all.min.js"></script>

	<a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>

	<script>
		$(function () {

			$(window).scroll(function(){ 
				if ($(this).scrollTop() > 100) { 
					$('#scroll').fadeIn(); 
				} else { 
					$('#scroll').fadeOut(); 
				} 
			}); 

			$('#scroll').click(function(){ 
				$("html, body").animate({ scrollTop: 0 }, 600); 
				return false; 
			}); 
		});
	</script>

</body>
</html>


