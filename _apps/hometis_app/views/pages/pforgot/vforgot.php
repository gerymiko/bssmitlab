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
</head>
<body id="body" class="hold-transition skin-blue-light layout-top-nav">
	<div class="wrapper">
		<div id="loading" class="loading hidden"></div>
		<div class="content-wrapper">
			<section class="content text-white">
				<div id="alertz" class="alert alert-info alert-dismissible" style="display: none;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h4><i class="icon fa fa-ban"></i> Attention!</h4>
					Sorry for the inconvenience, this feature is currently under maintenance and cannot be used. Thank you for your attention.
				</div>
				<div class="error-page" style="padding-top: 100px;">
					<h2 class="headline text-yellow"><i class="fas fa-question-circle"></i></h2>
					<div class="error-content text-white">
						<h3>Forgot Account</h3>
						<p>Type your email or phone number that has been registered. System will send a link to reset your password.</p>
						<form id="form-forgot" method="post" action="#">
							<div class="row">
								<div class="col-md-5">
									<button type="button" id="btn_phone" class="btn btn-flat bg-red btn-block">Phone number</button>
								</div>
								<div class="col-md-1">
									<span class="text-center f20 slash desktop">/</span>
								</div>
								<div class="col-md-5">
									<button type="button" id="btn_email" class="btn btn-flat bg-blue btn-block">Email</button>
								</div>
							</div><br>
							<div id="content-phone" style="display: none;">
								<div class="input-group">
									<input type="text" name="forgotphone" id="forgotphone" maxlength="15" class="form-control _CnUmB required" placeholder="Your phone number">
									<div class="input-group-btn">
										<button type="button" onclick="forgot_password();" class="btn btn-flat bg-red"><i class="fas fa-paper-plane"></i></button>
									</div>
								</div>
								<label for="forgotphone" generated="true" class="error"></label>
							</div>
							<div id="content-email" style="display: none;">
								<div class="input-group">
									<input type="text" name="forgotemail" id="forgotemail" maxlength="50" class="form-control _CalPhaNum required" placeholder="Your email">
									<div class="input-group-btn">
										<button type="button" onclick="forgot_password();" class="btn btn-flat bg-blue"><i class="fas fa-paper-plane"></i></button>
									</div>
								</div>
								<label for="forgotemail" generated="true" class="error"></label>
							</div>
						</form>
						<p>Or<br>
							Back to <a href="<?=site_url()?>"> <span class="label bg-red f12"> login</span></a> page.</p>
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
		function forgot_password(){
			$("#loading").removeClass("hidden");
			var forgot = $("#form-forgot").serialize();
			if($("#form-forgot").valid() == false){
				$("#loading").addClass("hidden");
				toastr.error('There was an error filling the data, please check again.');
				return false;
			} else {
				$.post("<?=site_url();?>check/forgot",
				forgot,
				function(data) {
					if (data =="ErrorPhone") {
						$("#loading").addClass("hidden");
						swal("Hmmmm...", "The phone you entered does not match the registered one", "info");
					} else if(data =="ErrorEmail") {
						$("#loading").addClass("hidden");
						swal("Hmmmm...", "The email you entered does not match the registered one", "info");
					} else if(data =="activePhone") {
						$("#loading").addClass("hidden");
						swal("Hmmmm...", "We have sent a link to change password to your phone number", "info");
					} else if(data =="activeEmail") {
						$("#loading").addClass("hidden");
						$("#form-forgot").addClass("hidden");
						swal("Hmmmm...", "We have sent a link to change password to your email. Please check in INBOX or SPAM folder", "info");
					} else if(data =="SuccessPhone") {
						$("#loading").addClass("hidden");
						$("#form-forgot").addClass("hidden");
						swal("Yeay!", "We have sent a link to change password to your phone number.", "success");
					} else if(data =="SuccessEmail") {
						$("#loading").addClass("hidden");
						$("#form-forgot").addClass("hidden");
						swal("Yeay!", "We have sent a link to change password to your email. Please check in INBOX or SPAM folder", "success");
					} else {
						$("#loading").addClass("hidden");
						alert("Something goes wrong. Reload this page then try again");
					}
				});		
			}
		}
		$(document).ready(function() {
			$('._CnUmB').numeric({allowThouSep: false,   allowDecSep: false, allowPlus: false, allowMinus: false});
			$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '-_.@' });
			$('#form-forgot').on('keyup keypress',function(e){
				var keyCode = e.keyCode || e.which;
				if (keyCode===13){e.preventDefault();return false;}
			});
			$('#btn_email').on('click', function(){
				$('#content-phone').hide(200);$('#content-email').toggle(200);$("#forgotphone").val("");$("#forgotphone").attr("disabled", true);$("#forgotemail").attr("disabled", false);
			});
			$('#btn_phone').on('click', function(){
				$('#content-phone').toggle(200);$('#content-email').hide(200);$("#forgotemail").val("");$("#forgotemail").attr("disabled", true);$("#forgotphone").attr("disabled", false);
			});
		});
	</script>

</body>
</html>


