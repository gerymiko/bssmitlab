<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>PORTAL HRD | PT BINA SARANA SUKSES</title>
	<meta name="description" content="web.binasaranasukses.com/portal" />
	<meta name="keywords" content="web.binasaranasukses.com/portal" />
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta property="og:type" content="business.business">
	<meta property="og:title" content="PT BINA SARANA SUKSES">
	<meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
	<meta property="og:url" content="web.binasaranasukses.com/portal">
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
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/portalz/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/portalz/dist-portal/css/AdminLTE.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/portalz/dist-portal/css/skins/skin-blue-light.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/portalz/dist-portal/css/custom.css"/>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/portalz/font-awesome/css/all.min.css" />
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/portalz/jquery/dist/jquery.min.js"></script>
</head>
<body id="body" class="hold-transition skin-blue-light layout-top-nav">
	<div class="wrapper">
		<div class="content-wrapper">
			<section class="content" style="padding-top: 200px;">
				<div class="error-page">
					<h2 class="headline text-red"> 404</h2>
					<div class="error-content">
						<h3><i class="fas fa-exclamation-triangle text-yellow"></i> Oops! Halaman tidak ditemukan.</h3>
						<p>
							Kami tidak dapat menemukan halaman yang Anda cari.
							Sementara itu, Anda dapat kembali ke <br><a href="<?=site_url()?>menu/dashboard"><b>Dashboard</b></a>
						</p>
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			<div class="container">
				<strong>Copyright &copy; <?=date("Y");?> <a class="text-red" href="#">PT BINA SARANA SUKSES</a></strong>
			</div>
		</footer>
	</div>

	<!-- Bottom Script -->
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/portalz/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/portalz/dist-portal/js/adminlte.min.js"></script>
	<a href="#" id="scroll" style="display: none;"><i class="fas fa-arrow-up upside"></i></a>

	<script>
		$(function () {
			$(window).scroll(function(){ 
				if ($(this).scrollTop() > 100){ $('#scroll').fadeIn(); } else { $('#scroll').fadeOut(); } 
			});
			$('#scroll').click(function(){ 
				$("html, body").animate({ scrollTop: 0 }, 600); 
				return false; 
			}); 
		});
	</script>

</body>
</html>


