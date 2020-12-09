<!DOCTYPE html>
<html lang="en">
<head>
	<title>DASHBOARD | PT BINA SARANA SUKSES</title>
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
    <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/css/lib/nv.d3.min.css">
    <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/css/lib/custom.css">
    <link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/dashboard/css/application.min.css">
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery/jquery-3.4.1.min.js"></script>
</head>
<body>
	<div class="mdl-layout mdl-js-layout is-small-screen not-found">
	    <main class="mdl-layout__content">
	        <div class="mdl-card mdl-card__login mdl-shadow--2dp">
	        <div class="mdl-card__supporting-text color--dark-gray">
	            <div class="mdl-grid">
	                <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
	                    <span class="mdl-card__title-text text-color--smooth-gray">DASHBOARD</span>
	                </div>
	                <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
	                    <span class="text--huge color-text--light-blue">404</span>
	                </div>
	                <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
	                    <span class="text--sorry text-color--white">Sorry, but there's nothing here</span>
	                </div>
	                <!--<a href="index.html">-->
	                <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
	                    <a href="#" id="im_back" class="mdl-button mdl-js-button color-text--light-blue pull-right">
	                        <b>Go Back</b>
	                    </a>
	                </div>
	            </div>
	        </div>
	    </div>
	    </main>
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
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/dashboard/js/d3.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/dashboard/js/material.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/dashboard/js/nv.d3.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/dashboard/js/layout/layout.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/dashboard/js/scroll/scroll.min.js"></script>
</body>
</html>