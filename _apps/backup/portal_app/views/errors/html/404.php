<!DOCTYPE html>
<html lang="id" class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>
	<meta name="description" content="Website karir PT Bina Sarana Sukses" />
	<meta name="author" content="PT Bina Sarana Sukses" />
	
	<?php
		function siteURL(){
		    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		    $domainName = $_SERVER['HTTP_HOST'].'/';
		    return $protocol.$domainName;
		}
		define('SITE_URL', siteURL());
	?>

	<link rel="shortcut icon" type="image/png" href="<?php echo base_url();?>../bssmitlab/_assets/karir/images/logo/logox.png"/>
	
	<title>BSS Karir | Bina Sarana Sukses</title>

	<!-- JQUERY UI -->
	<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/portal/js/jquery-ui/css/jquery-ui.min.css">
	<!-- FONTS -->
	<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/fonts/entypo/css/entypo.css">
	<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/fonts/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/portal/css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/portal/css/neon-core.css">
	<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/portal/css/neon-theme.css">
	<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/portal/css/neon-forms.css">
	<link rel="stylesheet" href="<?php echo siteURL();?>bssmitlab/_assets/portal/css/custom.css">

	<!-- JQUERY -->
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/jquery-2.2.3.min.js"></script>

	<style type="text/css">
	    html{ height:100%; }
	    body{ min-height:100%; padding:0; margin:0; position:relative; }
	    body::after{ content:''; display:block; }
	    footer{ position:absolute; bottom:0; width:100%; }
	</style>
</head>

<body>
	<div class="wrap">	
		<div style="padding-top: 100px; "></div>
		<div class="main-content">
			<div class="page-error-404">


				<div class="error-symbol">
					<i class="entypo-attention"></i>
				</div>

				<div class="error-text">
					<h2>404</h2>
					<p>Halaman tidak ditemukan!</p>
					<small>Halaman yang Anda cari tidak ada atau kesalahan lain terjadi.<br><a href="<?php echo site_url();?>syspanel">Kembali</a>, atau kunjungi <a class="red" href="<?php echo site_url()?>syspanel">web.binasaranasukses.com/portal</a> untuk memilih menu baru.</small>
				</div>

			</div>	
		</div>

		<footer class="site-footer front">
			<div class="container">
				<div class="row">
					<div class="text-center" style="color: #FFF;">
						&copy; <b>PT. Bina Sarana Sukses</b> <?=date("Y");?>. Hak Cipta Dilindungi Undang-Undang. 
					</div>
				</div>
			</div>
		</footer>
	</div>
	
	<!-- Bottom Scripts -->
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/gsap/main-gsap.js"></script>
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/jquery-ui/js/jquery-ui.min.js"></script>
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/bootstrap.js"></script>
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/joinable.js"></script>
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/resizeable.js"></script>
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/neon-api.js"></script>
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/neon-custom.js"></script>
	<script src="<?php echo siteURL();?>bssmitlab/_assets/portal/js/neon-demo.js"></script>

</body>
</html>

