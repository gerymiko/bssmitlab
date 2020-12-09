<!DOCTYPE html>
<html lang="en">
<head>
	<title>EPGIN | PT BINA SARANA SUKSES</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="<?=site_url();?>getimage/png/favicon"/>
	<?php
        function siteURL(){
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $domainName = $_SERVER['HTTP_HOST'].'/';
            return $protocol.$domainName;
        }
        define('SITE_URL', siteURL());
    ?>
    <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/epgin/bootstrap/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/font-awesome/css/all.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/epgin/login/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/epgin/login/vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/epgin/login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/epgin/login/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/epgin/login/css/main.css">
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery/jquery-3.4.1.min.js"></script>
    <style type="text/css">
        .opo {
            background: url(<?=site_url()?>getimage/jpg/404-min) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>
<body>
	<div class="limiter">
		<div class="container-login100 opo">
			<div class="wrap-login100">
				<div class="text-center">
					<span class="login100-form-title p-b-26 text-red">404</span><br>
					<span class="fs-20">Halaman tidak ditemukan.</span>
					<div class="p-t-20">
						<button class="text-bold text-blue" id="im_back">Kembali</button>
					</div>
					<div class="p-t-50">
						<h5 class="text-center text-bold">&copy; <?=date("Y");?> <b class="text-red">PT BINA SARANA SUKSES</b></h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#im_back').on('click', function(){
				var referrer =  document.referrer;
				console.log(referrer);
				window.location.href = referrer;
			});
		});
	</script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/epgin/login/vendor/animsition/js/animsition.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/epgin/login/vendor/bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/epgin/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>