
<!DOCTYPE html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="description" content="Admin Panel" />
		<meta name="author" content="PT BINA SARANA SUKSES" />
		<title>BSS PORTAL | Login</title>

		<?php
			function siteURL(){
			    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
			    $domainName = $_SERVER['HTTP_HOST'].'/';
			    return $protocol.$domainName;
			}
			define('SITE_URL', siteURL());

			$this->load->view($sheader);
		?>
	</head>

	<noscript>
		<div class="tile-block tile-purple" style="border-radius: 0;margin-bottom: 0;">				
			<div class="tile-content">
				<div style="padding-top: 10px"></div>
				<p class="text-center">JavaScript tidak diaktifkan. Mohon aktifkan javascript melalui pengaturan browser anda. <a target="_blank" href="http://web.binasaranasukses.com/karir/javascript"><b>Klik disini</b></a> untuk cara mengaktifkannya.</p>
			</div>
		</div>
	</noscript>

	<body class="page-body login-page login-form-fall">
		<div class="login-container">
			<div class="login-header login-caret">
				<div class="login-content">
					<a href="#" class="logo">
						<img src="<?php echo siteURL();?>bssmitlab/_assets/images/logo/portal.png" width="200" alt="PT BINA SARANA SUKSES" />
					</a>
					<p class="description gray">Untuk pengguna, Mohon login terlebih dulu untuk mengakses halaman portal.</p>
					<br>
					<p><i>
						Jika kolom login tidak muncul, mohon bersihkan cache atau history browser anda terlebih dahulu.
					</i></p>
					<!-- <h2 class="white">MAAF MASIH DALAM PERBAIKAN</h2> -->
					<div class="login-progressbar-indicator">
						<h3>43%</h3>
						<span>logging in...</span>
					</div>
				</div>
			</div>

			<noscript>
				<div class="text-center">
					<div style="padding-top: 80px"></div>
					<i class="fa fa-ban" style="font-size: 100px"></i>
				</div>
			</noscript>

			<div class="login-progressbar"><div></div></div>

			<div class="login-form">
				<div class="login-content">
					<div class="form-login-error">
						<h3>Login tidak valid</h3>
						<p>Username dan password salah.</p>
					</div>

					<form method="post" role="form" id="form_login" action="#">
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon"><i class="entypo-user"></i></div>
								<input type="text" class="form-control" name="username" id="username" placeholder="Username / NIK" autocomplete="off" />
							</div>
						</div>
						<div class="form-group">
							<div class="input-group" style="">
								<div class="input-group-addon"><i class="entypo-key"></i></div>
								<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off"/>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block btn-login" style="background-color: #fff;color: #000;">
								<i class="entypo-login"></i>
								Login In
							</button>
						</div>		
					</form>
					<div class="login-bottom-links">
						<a href="#" class="link">Lupa password?</a><br />
						<i><a href="#">Powered by - </a><a href="#"><b class="red">IT Dept, PT Bina Sarana Sukses </b></a><br><b><?=date("Y");?></b></i>

					</div>
				</div>
			</div>
		</div>

		<!-- Bottom Scripts -->
		<?php
			$this->load->view($sfooter);
		?>
		<script src="<?=siteURL();?>bssmitlab/_assets/portal/js/bss-login.js"></script>
	</body>
</html>