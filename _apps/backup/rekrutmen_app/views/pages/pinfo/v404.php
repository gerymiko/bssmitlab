<!DOCTYPE html>
<html dir="ltr" lang="id">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>PT BINA SARANA SUKSES | KARIR</title>
	
	<meta name="description" content="web.binasaranasukses.com/karir" />
	<meta name="keywords" content="web.binasaranasukses.com/karir" />
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta property="og:type" content="business.business">
	<meta property="og:title" content="PT BINA SARANA SUKSES">
	<meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
	<meta property="og:url" content="web.binasaranasukses.com/karir">
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
	
	<!-- </head> -->
</head>

<body class="stretched no-transition">
	<div id="wrapper" class="clearfix">		
		<!-- Content -->
		<section id="slider" class="slider-parallax full-screen dark error404-wrap" style="background: url(<?=site_url();?>syslink/parallax_404) center;">
			<div class="slider-parallax-inner" style="margin-top: 90px;">

				<div class="container vertical-middle center clearfix">

					<div class="error404 dark">404</div>

					<div class="heading-block nobottomborder">
						<h4 class="black">Ooopps.! Halaman yang Anda cari, tidak dapat ditemukan.</h4>
						<span class="black">Coba masukkan alamat yang benar</span>
						<br>
						<?php
							if ($this->session->userdata('username') == null) {
								$url = site_url()."home";
							} else {
								$url = site_url()."account/home";
							}
						?>
						<a href="<?=$url;?>" class="btn btn-sm btn-primary ls5"><i class="fa fa-chevron-left"></i> KEMBALI</a>
					</div>

					<div class="red bold">
						&copy; <?=date("Y");?> PT BINA SARANA SUKSES
					</div>

				</div>

			</div>
		</section>
	</div>

	<!-- Go To Top -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts -->
	<?php
		$this->load->view($sfooter);
	?>
	<!-- </body></html> -->

</body>
</html>