<!DOCTYPE html>
<html dir="ltr" lang="id">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>PT BINA SARANA SUKSES | KARIR</title>
	
	<meta name="description" content="web.binasaranasukses.com/karir" />
	<meta name="keywords" content="web.binasaranasukses.com/karir" />
	<meta name="author" content="PT Bina Sarana Sukses" />
	<meta property="og:type" content="business.business">
	<meta property="og:title" content="PT Bina Sarana Sukses">
	<meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology Profesional dan Sinergi sebagai daya saing unggulan.">
	<meta property="og:url" content="www.web.binasaranasukses.com/karir">
	<meta property="og:image" content="<?=site_url();?>s_url/logo_favicon">
	<meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
	<meta property="business:contact_data:locality" content="Jakarta">
	<meta property="business:contact_data:region" content="DKI Jakarta">
	<meta property="business:contact_data:postal_code" content="14460">
	<meta property="business:contact_data:country_name" content="Indonesia">

	<!-- Stylesheets -->
	<?php
		function siteURL(){
		    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		    $domainName = $_SERVER['HTTP_HOST'].'/';
		    return $protocol.$domainName;
		}
		define('SITE_URL', siteURL());

		$this->load->view($sheader);
	?>
	<link rel="shortcut icon" type="image/png" href="<?=site_url();?>s_url/logo_favicon"/>
</head>

<body class="stretched side-header no-transition">

	<!-- Document Wrapper -->
	<div id="wrapper" class="clearfix">

		<!-- Header -->
		<header id="header" class="no-sticky">
			<div id="header-wrap">
				<div class="container clearfix">
					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
					<!-- Logo -->
					<div id="logo">
						<a href="#" class="standard-logo" data-dark-logo="<?=site_url();?>s_url/logo_panel">
							<img src="<?=site_url();?>s_url/logo_panel" alt="BSS Logo" class="desktop">
						</a>
						<img class="mobile" src="<?=site_url();?>s_url/logo_panel" alt="BSS Logo">
					</div>

					<!-- Primary Navigation -->
					<nav id="primary-menu">
						<?php
							$this->load->view($menu);
						?>
					</nav>
				</div>
			</div>
		</header>
		
		<!-- Content -->
		<?php
			$this->load->view($content);
		?>

		<!-- Footer -->
		<div id="footer" class="not-dark">
			<?php
				$this->load->view($footer);
			?>
		</footer>

	</div><!-- #wrapper end -->

	<!-- Go To Top -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts -->
	<?php
		$this->load->view($sfooter);
	?>
</body>
</html>