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
		<!-- Header -->
		<header id="header" class="transparent-header full-header" data-sticky-class="not-dark">
			<div id="header-wrap">
				<div class="container clearfix">
					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>
					<div id="logo">
						<a href="<?=site_url();?>home" class="standard-logo" data-dark-logo="<?=site_url();?>s_url/logo_dark">
							<img src="<?=site_url();?>s_url/logo_dark" alt="BSS Logo" class="desktop">
						</a>
						<img class="mobile" src="<?=site_url();?>s_url/logo_mobile" alt="BSS Logo">
					</div>
					<nav id="primary-menu" class="dark">
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
		<footer id="footer" class="not-dark">
			<?php
				$this->load->view($footer);
			?>
		</footer>
	</div>

	<!-- Go To Top -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts -->
	<?php
		$this->load->view($sfooter);
	?>

	<?php if(!isset($_COOKIE["comply_cookie"])) { ?>
		<div id="content">
			<div id="cookies">
				<p>Situs ini menggunakan cookie untuk memberikan layanan terbaik kami dan menampilkan daftar pekerjaan. Dengan menggunakan situs kami, Anda menyetujui bahwa Anda telah membaca dan memahami <a href="<?=site_url();?>information/cookie">Kebijakan Cookie</a>, <a href="<?=site_url();?>information/privacy">Kebijakan Privasi</a>, dan <a>Ketentuan Layanan</a> kami.
			  	<span class="cookie-accept" title="Okay, close"><i class="fa fa-times"></i></span></p>
			</div>
		</div>
	<?php } ?>

	<div class="modal modal-login fadeIn" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="block divcenter" style="background-color: #FFF; max-width: 700px;">
				<div class="row nomargin clearfix modal-box">
					<div class="col-sm-6" data-height-lg="456" data-height-md="456" data-height-sm="456" data-height-xs="0" data-height-xxs="0" style="background-image: url(<?=site_url();?>s_url/banner_login); background-size: cover;"></div>
					<div class="col-sm-6 " data-height-lg="456" data-height-md="456" data-height-sm="456" data-height-xs="456" data-height-xxs="456">
						<div class="panel-body" style="padding: 25px">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="uppercase ls1">SILAHKAN LOGIN</h4>
							<form id="form-login" action="<?=site_url();?>authenticate" method="post" class="clearfix" style="max-width: 300px;">
								<div id="notify"></div>
								<div class="col_full">
									<label class="black">Username</label>
									<input type="text" id="usernamee" name="username" class="sm-form-control not-dark" placeholder="Ketik disini..." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required/>
								</div>
								<div class="col_full">
									<label class="black">Password</label>
									<input type="password" id="passwordd" name="password" class="sm-form-control not-dark" placeholder="Ketik disini..." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required/>
								</div>
								<div class="col_full nobottommargin">
									<button id="btnlogin" type="button" class="button button-rounded button-small button-blue nomargin">Masuk</button>
								</div>
							</form>
							<a href="<?=site_url();?>forgot/password">Lupa password ?</a><br>
							<a href="<?=site_url();?>registration" class="daftar">Belum punya akun ? <b class="black">Daftar</b> disini</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function () {
			$('.cookie-accept').click(function () { 
				days   = 1;
				myDate = new Date();
				myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
				document.cookie = "comply_cookie = comply_yes; expires = " + myDate.toGMTString(); 
				$("#cookies").slideUp("slow"); 
			});
			$('.cookie-accept').onclick = function(e) {
				days   = 1;
				myDate = new Date();
				myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
				document.cookie = "comply_cookie = comply_yes; expires = " + myDate.toGMTString(); 
				document.getElementById("cookies").parentNode.removeChild(elem);
			}
		});
		document.getElementById("passwordd").addEventListener("keyup", function(event){
		    event.preventDefault();
		    if (event.keyCode == 13) { document.getElementById("btnlogin").click(); }
		});
		document.getElementById("usernamee").addEventListener("keyup", function(event){
		    event.preventDefault();
		    if (event.keyCode == 13) { document.getElementById("btnlogin").click(); }
		});
		$("#btnlogin").click(function() {
			var formlogin  = $('#form-login');
			var dataform   = $('#form-login').serializeArray();
			$.ajax({
			   url: formlogin.attr('action'),
			   type: formlogin.attr('method'),
			   data: dataform,
			   dataType: 'JSON',
			   cache: false,
			   success: function(validator) {
			        if (validator.success == true) {
			            document.location.href = validator.redirect;
			        } else { $("#notify").html(validator.message); }
			    }
			});
		});
		$('#usernamee').alphanum({allowSpace: false, disallow: '', allow: '_'});
	</script>

	<!-- </body></html> -->

</body>
</html>