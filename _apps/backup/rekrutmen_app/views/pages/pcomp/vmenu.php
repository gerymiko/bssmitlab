<style type="text/css">
	#top-account > .dropdown-menu > li > a { padding: 0 0 0 5px !important; }
	#top-account > ul > li { margin-left: 0 !important; }
	.open > .dropdown-menu { display: block !important; }
	#top-cart p a:hover{ color: #FFF; }
	#top-cart > .daftar a p { color: #1883E9; }
</style>
<ul>
	<li class=""><a href="<?=site_url()?>home"><div>Beranda</div></a></li>
	<li class=""><a href="<?=site_url()?>vacancy"><div>Loker</div></a></li>
	<li class=""><a href="<?=site_url()?>registration"><div>Daftar</div></a></li>
	<li id="mobileshow"><a href="<?=site_url()?>login"><div>Login</div></a></li>
	<li class=""><a href="#"><div>Informasi</div></a>
		<ul>
			<li><a href="<?=site_url()?>information/about"><div>Tentang Perusahaan</div></a></li>
			<li><a href="<?=site_url()?>information/election"><div>Tahap Seleksi</div></a></li>
			<li><a href="<?=site_url()?>information/notice"><div>Pengumuman</div></a></li>
			<li><a href="<?=site_url()?>information/help"><div>Bantuan</div></a></li>
		</ul>
	</li>
</ul>

<div id="top-cart">
	<a data-toggle="modal" data-target=".modal-login" style="cursor: pointer;"><i class="icon-user"></i></a>
</div>