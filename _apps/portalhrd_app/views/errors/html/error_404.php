<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>PORTAL HRD | PT BINA SARANA SUKSES</title>
	<meta name="description" content="web.binasaranasukses.com/hrdrekrutmen" />
	<meta name="keywords" content="web.binasaranasukses.com/hrdrekrutmen" />
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta property="og:type" content="business.business">
	<meta property="og:title" content="PT BINA SARANA SUKSES">
	<meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
	<meta property="og:url" content="web.binasaranasukses.com/hrdrekrutmen">
	<meta property="og:image" content="<?=site_url();?>getimage/png/logo_sm">
	<meta property="business:contact_data:street_address" content="Jl. Pantai Indah Utara 2, Pantai Indah Kapuk Penjaringan">
	<meta property="business:contact_data:locality" content="Jakarta">
	<meta property="business:contact_data:region" content="DKI Jakarta">
	<meta property="business:contact_data:postal_code" content="14460">
	<meta property="business:contact_data:country_name" content="Indonesia">
	<link rel="shortcut icon" type="image/png" href="<?=site_url();?>getimage/png/logo_sm"/>
	<?php
		function siteURL(){
			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			$domainName = $_SERVER['HTTP_HOST'].'/';
			return $protocol.$domainName;
		}
		define('SITE_URL', siteURL());
	?>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hrdportal/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hrdportal/dist/css/bss.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hrdportal/dist/css/skins/skin-blue-light.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/hrdportal/dist/css/custom.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/font_lte/font.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/font-awesome/css/all.min.css"/>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery/jquery-3.4.1.min.js"></script>
</head>
<body id="body" class="hold-transition skin-blue-light layout-top-nav">
	<div class="wrapper">
		<div class="content-wrapper" style="background: #002F65;color: #fff;padding-top: 100px;">
			<section class="content">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<img class="img-responsive pull-right" src="<?=site_url();?>getimage/png/404_img" width="400">
						</div>
						<div class="col-md-6">
							<h2 class="ls2"><i class="fas fa-exclamation-triangle text-yellow"></i> Oops! <br> Halaman tidak ditemukan.</h2>
							<p class="ls1">
								Kami tidak dapat menemukan halaman yang Anda cari.<br>
								Sementara itu, Anda dapat kembali ke
							</p>
							<a href="<?=site_url()?>m/welcome" class="btn bg-red ls1">Halaman Utama</a>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/hrdportal/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/hrdportal/dist/js/bss.min.js"></script>

</body>
</html>


