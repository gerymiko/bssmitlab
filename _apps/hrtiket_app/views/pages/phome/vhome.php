<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BSS HRD Systems</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
<body class="hold-transition login-page">
	<div class="container">
		<div class="login-box" style="margin: 3% auto;">
	        <div class="login-logo">
	            <a href="#" class="white"><b class="red">BSS</b> <b>HRD</b> SYSTEMS</a>
	        </div>
	    </div>
		<div class="col-lg-3 col-xs-6">
			<div class="box box-widget widget-user-2 animated bounce">
				<div class="widget-user-header bg-navy">
					<h3 class="widget-user-username" style="margin-left: 0;"><b>HR</b> USER</h3>
					<h5 class="widget-user-desc" style="margin-left: 0;">Pengajuan cuti, izin, tiket dan pengunduran diri</h5>
				</div>
				<div class="box-footer no-padding">
					<ul class="nav nav-stacked">
						<li><a href="<?=site_url()?>hr_user/clogin/syslogin">Ke aplikasi <span class="pull-right badge bg-blue"><i class="fas fa-caret-right"></i></span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="box box-widget widget-user-2 animated bounce delay-1s">
				<div class="widget-user-header bg-navy">
					<h3 class="widget-user-username" style="margin-left: 0;"><b>HR</b> PORTAL</h3>
					<h5 class="widget-user-desc" style="margin-left: 0;">Admin Rekrutmen, Profiling dan MCU</h5>
				</div>
				<div class="box-footer no-padding">
					<ul class="nav nav-stacked">
						<li><a href="https://web.binasaranasukses.com/portal" target="_blank" rel="noopener">Ke aplikasi <span class="pull-right badge bg-blue"><i class="fas fa-caret-right"></i></span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="box box-widget widget-user-2 animated bounce delay-2s">
				<div class="widget-user-header bg-navy">
					<h3 class="widget-user-username" style="margin-left: 0;"><b>WEB</b> KARIR</h3>
					<h5 class="widget-user-desc" style="margin-left: 0;">Web pelamar kerja dan Informasi lowongan kerja</h5>
				</div>
				<div class="box-footer no-padding">
					<ul class="nav nav-stacked">
						<li><a href="https://web.binasaranasukses.com/karir" target="_blank" rel="noopener">Ke aplikasi <span class="pull-right badge bg-blue"><i class="fas fa-caret-right"></i></span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="box box-widget widget-user-2 animated bounce delay-3s">
				<div class="widget-user-header bg-navy">
					<h3 class="widget-user-username" style="margin-left: 0;"><b>HR</b> TIKET</h3>
					<h5 class="widget-user-desc" style="margin-left: 0;">Admin manajemen permintaan tiket penerbangan cuti &amp; dinas</h5>
				</div>
				<div class="box-footer no-padding">
					<ul class="nav nav-stacked">
						<li><a href="<?=site_url()?>hr_tiket/clogin/syslogin">Ke aplikasi <span class="pull-right badge bg-blue"><i class="fas fa-caret-right"></i></span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="login-box" style="margin: 3% auto;">
	        <div class="login-logo">
	            <a href="#" class="white"><b class="red">BSS</b> <b class="text-navy">VENDOR</b> SYSTEMS</a>
	        </div>
	    </div>
		<div class="col-lg-3 col-xs-6">
			<div class="box box-widget widget-user-2 animated bounce delay-4s">
				<div class="widget-user-header bg-red">
					<h3 class="widget-user-username" style="margin-left: 0;"><b>VENDOR</b> MCU</h3>
					<h5 class="widget-user-desc" style="margin-left: 0;">Permintaan MCU </h5>
				</div>
				<div class="box-footer no-padding">
					<ul class="nav nav-stacked">
						<li><a href="https://web.binasaranasukses.com/mcu/" target="_blank" rel="noopener">Ke aplikasi <span class="pull-right badge bg-blue"><i class="fas fa-caret-right"></i></span></a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="box box-widget widget-user-2 animated bounce delay-5s">
				<div class="widget-user-header bg-red">
					<h3 class="widget-user-username" style="margin-left: 0;"><b>VENDOR</b> TIKET</h3>
					<h5 class="widget-user-desc" style="margin-left: 0;">Permintaan Tiket Penerbangan </h5>
				</div>
				<div class="box-footer no-padding">
					<ul class="nav nav-stacked">
						<li><a href="<?=site_url()?>hr_vendor/clogin/syslogin" target="_blank" rel="noopener">Ke aplikasi <span class="pull-right badge bg-blue"><i class="fas fa-caret-right"></i></span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
