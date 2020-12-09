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

	<body class="stretched">
		<!-- Document Wrapper -->
		<div id="wrapper" class="clearfix">
			<!-- Content -->
			<section id="content">
				<div class="content-wrap nopadding">
					<div class="section full-screen nopadding nomargin">
						<div class="container-fluid vertical-middle divcenter clearfix nopadding">
							<div class="row center">
								<a href="<?=siteURL();?>rekrutmen/syshome"><img src="<?=site_url();?>s_url/logo_dark" alt="PT BSS Logo"></a>
							</div>
							<div class="panel panel-default divcenter noradius noborder bshadowx" style="max-width: 400px;">
								<div class="panel-body" style="padding: 40px;">
									<form id="form-login" action="<?=site_url();?>authenticate" class="nobottommargin" method="post">
										<h3 class="t300 uppercase center">Masuk ke <b>Akun Anda</b></h3>
										<div id="notify"></div>
										<div class="col_full">
											<label for="login-form-username">Username</label>
											<input type="text" id="usernamee" name="username" class="sm-form-control not-dark" required="required" placeholder="Ketik disini . . ." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"/>
										</div>
										<div class="col_full">
											<label for="login-form-password">Password</label>
											<input type="password" id="passwordd" name="password" class="sm-form-control not-dark" placeholder="Ketik disini . . ." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required="required" />
										</div>
										<div class="col_full nobottommargin">
											<button class="button button-rounded button-border button-blue button-small nomargin" id="btnlogin" type="button">MASUK</button>
											<a href="<?=site_url();?>forgot/password" class="fright">Lupa Password?</a>
										</div>
									</form>
									<div class="line line-sm"></div>
									<div class="row center not-dark">
										<b class="red ls3">PT BINA SARANA SUKSES</b><br /><br />
										<b class="ls2">Copyrights</b> &copy; <b><?=date("Y");?></b> <br />
										<small class="ls2">Hak dilindungi oleh undang-undang.</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section><!-- #content end -->
		</div><!-- #wrapper end -->

		<!-- Go To Top -->
		<div id="gotoTop" class="icon-angle-up"></div>

		<!-- JavaScripts -->
		<?php
			$this->load->view($sfooter);
		?>

		<script type="text/javascript">
			document.getElementById("passwordd").addEventListener("keyup", function(event){
			    event.preventDefault();
			    if (event.keyCode == 13) {
			        document.getElementById("btnlogin").click();
			    }
			});

			document.getElementById("usernamee").addEventListener("keyup", function(event){
			    event.preventDefault();
			    if (event.keyCode == 13) {
			        document.getElementById("btnlogin").click();
			    }
			});

			$("#btnlogin").click(function() {
				var formlogin  = $('#form-login');
				var dataform   = $('#form-login').serializeArray();

				$.ajax({
				   url: formlogin.attr('action'),
				   type: formlogin.attr('method'),
				   data: dataform,
				   dataType : 'JSON',
				   cache : false,
				   success: function(validator) {
				        if (validator.success == true) {
				            document.location.href = validator.redirect;
				        } else {
				            $("#notify").html(validator.message);
				        }
				    }
				});
			});

			$(document).ready(function () { $('#form-login').validate(); });
		</script>

		<!-- </body></html> -->

	</body>
</html>