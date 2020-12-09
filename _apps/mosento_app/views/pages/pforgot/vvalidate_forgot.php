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
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist-mosento/css/AdminLTE.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist-mosento/css/custom.css" />
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/dist-mosento/css/skins/skin-blue.min.css" />
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/mosento/font-awesome/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=siteURL()?>bssmitlab/_assets/global/sweetalert/sweetalert2.min.css" />
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/jquery/dist/jquery.min.js"></script>
</head>
<body id="body" class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">
		<div id="loading" class="loading hidden"></div>
		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a href="<?=site_url()?>"><img src="<?=site_url();?>s_url/logo" alt="BSS MOSENTO" class="logo" /></a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					</div>
				</div>
			</nav>
		</header>
		<div class="content-wrapper">
			<section class="content">
				<div class="alert alert-info alert-dismissible hidden">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Attention!</h4>
					Sorry for the inconvenience, this feature is currently under maintenance and cannot be used. Thank you for your attention.
				</div>
				<div class="error-page">
					<h2 class="headline text-yellow"><i class="far fa-check-circle"></i></h2>

					<div class="error-content">
						<h3>Reset Password</h3>
						<div class="alert alert-info">
		                	<p></i> Your expiration time to reset password</p>
		                	<h4><span id="minutes"></span> : <span id="seconds"></span></h4>
		              	</div>
						<p>Type your new password below.</p>
						<form id="form-new-password" method="post" action="#">
							<input type="hidden" name="token" id="token" value="<?=$token?>">
							<input type="hidden" name="expired" id="expired" value="<?=$expired?>">
							<input type="hidden" name="token_id" id="token_id" value="<?=$token_id?>">
							<input type="hidden" name="nik" id="nik" value="<?=$nik?>">
							<div class="form-group">
								<label>New Password</label>
								<input type="password" name="new_password" id="new_password" class="form-control _CalPhaNumz required">
								<span>* Only number and alphabet for password.</span>
							</div>
							<div class="form-group">
								<label>Re-type Password</label>
								<input type="password" name="repassword" id="repassword" class="form-control _CalPhaNumz required">
							</div>
							<button type="button" class="btn btn-primary" id="btn_newpass">Save</button>
						</form>
					</div>
				</div>
			</section>
		</div>
		<footer class="main-footer">
			<div class="container">
				<div class="pull-right hidden-xs"><b>Version</b> 1.0.0</div>
				<strong>Copyright &copy; <?=date("Y");?> <a class="text-red" href="#">PT BINA SARANA SUKSES</a>.</strong> All rights reserved.
			</div>
		</footer>
	</div>

	<!-- Bottom Script -->
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/dist-mosento/js/adminlte.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/mosento/font-awesome/js/all.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/alphanum/jquery.alphanum.js"></script>
	<script type="text/javascript" src="<?=siteURL()?>bssmitlab/_assets/global/jquery-validation/dist/jquery.validate.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
			$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '_.@' });
			$('._CalPhaNumz').alphanum({ allowNumeric: true });
			$('#form-new-password').on('keyup keypress', function(e) {
				var keyCode = e.keyCode || e.which;
				if (keyCode === 13) { 
					e.preventDefault();
					return false;
				}
			});

			$('#form-new-password').validate({
				rules: {
					new_password: "required",
					repassword: "required",
					repassword: { equalTo: "#new_password" }
				},
				messages: {
					new_password: "Enter your new password.",
					repassword: "The password does not match.",
				}
			});

			$("#btn_newpass").click(function () {
				$("#loading").removeClass("hidden");
				var formData = $("#form-new-password").serialize();
				if($("#form-new-password").valid() == false){
					$("#loading").addClass("hidden");
					return false;
				} else {
					$.post("<?=site_url();?>cforgot/sysforgot/save_new_password",
		            formData,
		            function(data) {
		               	if(data == "Success"){
		                  	$("#loading").addClass("hidden");
							swal({
								title: "Yeay!", 
								text: "The password was successfully changed", 
								type: "success"}).then(function(){ 
									window.location = "https://web.binasaranasukses.com/mosento"
								}
							);
		               	} else {
		                  	$("#loading").addClass("hidden");
		                  	swal("Oops", "Failed to save data, an error occurred, reload this page and try again.", "error");
		               	}
		            });   
				}
			});
		});

		function countdown() {

			interval = setInterval(calculate, 100);

			function calculate() {

				var endDate = '<?=$expired?>';
				var endTime   = new Date(endDate).getTime();
				var startTime = new Date().getTime();

				if (endTime <= startTime) {
					swal({
						title: "Oops!", 
						text: "Time's Up!",
						allowOutsideClick: false,
						type: "info"}).then(function(){ 
							var formData = $("#form-new-password").serialize();
							$.post("<?=site_url();?>cforgot/sysforgot/timesup",
							formData,
							function(data) {
								if(data == "Success"){
									window.location = "https://web.binasaranasukses.com/mosento";
								} else {
									window.location = "https://web.binasaranasukses.com/mosento";
								}
							});
						}
					);
					clearInterval(interval);
				}

				timeRemaining = parseInt((endTime - startTime) / 1000);

				minutes = parseInt(timeRemaining / 60);
				timeRemaining = (timeRemaining % 60);

				seconds = parseInt(timeRemaining);

				document.getElementById("minutes").innerHTML = (minutes);
				document.getElementById("seconds").innerHTML = (seconds);

			}
		}
		countdown();


		
	</script>

</body>
</html>


