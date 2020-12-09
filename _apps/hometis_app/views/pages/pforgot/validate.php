<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>HOMETIS | PT BINA SARANA SUKSES</title>
	<meta name="description" content="web.binasaranasukses.com/hometis" />
	<meta name="keywords" content="web.binasaranasukses.com/hometis" />
	<meta name="author" content="PT BINA SARANA SUKSES" />
	<meta property="og:type" content="business.business">
	<meta property="og:title" content="PT BINA SARANA SUKSES">
	<meta property="og:description" content="Merupakan perusahaan kontraktor tambang berbasis Performance Technology, Profesional dan Sinergi sebagai daya saing unggulan.">
	<meta property="og:url" content="web.binasaranasukses.com/hometis">
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
		$this->load->view($header);
	?>
	<style type="text/css">
		.image-container{display: flex;justify-content: center;padding-top: 80px;}
		@media (min-width: 1200px){.container{width: 770px;}.content{padding-top: 80px;}}
	</style>
</head>
<body id="body" class="hold-transition skin-blue-light layout-top-nav">
	<div class="wrapper">
		<div id="loading" class="loading hidden"></div>
		<div class="content-wrapper text-white">
			<section class="content">
				<div class="container">
					<div class="alert alert-info alert-dismissible hidden">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Attention!</h4>
						Sorry for the inconvenience, this feature is currently under maintenance and cannot be used. Thank you for your attention.
					</div>
					<div class="row">
						<div class="col-md-5">
							<div class="image-container">
								<img src="<?=site_url()?>s_url/reset">
							</div>
						</div>
						<div class="col-md-7">
							<h3>Reset Password</h3>
							<div class="alert alert-info">
			                	<p></i> Your expiration time to reset password</p>
			                	<h4><span id="minutes"></span> : <span id="seconds"></span></h4>
			              	</div>
							<p>Type your new password below.</p>
							<form id="form-new-password" method="post" action="#">
								<input type="hidden" name="token" id="token" value="<?=$token?>">
								<input type="hidden" name="expired" id="expired" value="<?=$expired?>">
								<input type="hidden" name="token_id" id="token_id" value="<?=$this->my_encryption->encode($token_id)?>">
								<input type="hidden" name="nik" id="nik" value="<?=$nik?>">
								<div class="form-group">
									<label>New Password</label>
									<input type="text" name="new_password" id="new_password" class="form-control _CalPhaNumz required">
									<span>* Only number and alphabet for password.</span>
								</div>
								<div class="form-group">
									<label>Re-type Password</label>
									<input type="text" name="repassword" id="repassword" class="form-control _CalPhaNumz required">
								</div>
								<button type="button" class="btn bg-blue btn-flat" id="btn_newpass">Save</button>
							</form>
						</div>
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
	<?php $this->load->view($footer); ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
			$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '_.@' });
			$('._CalPhaNumz').alphanum({ allowNumeric: true });
			$('#form-new-password').on('keyup keypress', function(e){
				var keyCode = e.keyCode || e.which;
				if (keyCode === 13){e.preventDefault();return false;}
			});
			$('#form-new-password').validate({
				rules: {new_password: "required",repassword: "required",repassword: { equalTo: "#new_password"}},
				messages: {new_password: "Enter your new password.",repassword: "The password does not match."}
			});

			$("#btn_newpass").click(function () {
				$("#loading").removeClass("hidden");
				var formData = $("#form-new-password").serialize();
				if($("#form-new-password").valid() == false){
					$("#loading").addClass("hidden");
					toastr.error('There was an error filling the data, please check again.');
					return false;
				} else {
					$.post("<?=site_url();?>sadd/forgot/password",
		            formData,
		            function(data) {
		               	if(data == "Success"){
		                  	$("#loading").addClass("hidden");
							swal({title: "",html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data saved successfully.',type: "",confirmButtonText: 'Okay',}).then(function(){ window.location = "https://web.binasaranasukses.com/hometis"});
		               	} else if(data == "notsecure"){
		               		$("#loading").addClass("hidden");
		               		swal({title: "",html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Password must use alphabet and number combination.',type: "",confirmButtonText: 'Okay',});
		               	} else {
		                  	$("#loading").addClass("hidden");
		                  	swal({title: "",html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Failed to save data, an error occurred, reload this page and try again.',type: "",confirmButtonText: 'Okay',});
		               	}
		            });   
				}
			});
		});

		function countdown() {
			interval = setInterval(calculate, 100);
			function calculate() {
				var endDate = '<?=$expired?>',endTime   = new Date(endDate).getTime(),startTime = new Date().getTime();
				if (endTime <= startTime) {
					swal({
						title: "",text: "Time's Up! Time to reset the password has expired.",allowOutsideClick: false,
						type: "info"}).then(function(){ 
							var formData = $("#form-new-password").serialize();
							$.post("<?=site_url();?>forgot/timesup",
							formData,
							function(data) {
								if(data == "Success"){
									window.location = "https://web.binasaranasukses.com/hometis";
								} else {
									window.location = "https://web.binasaranasukses.com/hometis";
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


