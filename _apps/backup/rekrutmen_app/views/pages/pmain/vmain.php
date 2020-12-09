<?php if ($this->session->userdata('username') == NULL) { ?>

<!-- Slider -->
<section id="slider" class="slider-parallax swiper_wrapper full-screen clearfix"  data-effect="fade" data-autoplay="5000" data-speed="650" data-loop="true">
	<div class="slider-parallax-inner">
		<div class="swiper-container swiper-parent">
			<div class="swiper-wrapper">
				<div class="swiper-slide dark lazy" style="background-image: url('<?=site_url();?>s_url/slider_1');">
					<div class="container clearfix">
						<div class="slider-caption slider-caption-center dark">
							<h2 data-caption-animate="fadeInUp">Selamat Datang</h2>
							<p data-caption-animate="fadeInUp" data-caption-delay="200"><b class="red">PT BINA SARANA SUKSES</b> merupakan perusahaan kontraktor tambang berbasis <i>Performance Technology</i>, Profesional dan Sinergi sebagai daya saing unggulan.</p>
						</div>
					</div>
				</div>
				<div class="swiper-slide lazy" style="background-image: url('<?=site_url();?>s_url/slider_2'); background-position: center top;">
					<div class="container clearfix">
						<div class="slider-caption">
							<h2 data-caption-animate="fadeInUp" style="color: #333;">Profesional <br/>&amp; Sinergi</h2>
							<p data-caption-animate="fadeInUp" data-caption-delay="200" class="dark txt-shadow">Mengkolaborasikan Profesionalisme dengan Sinergi yang efektif untuk menjawab segala tantangan usaha.</p>
						</div>
					</div>
				</div>
			</div>
			<div id="slider-arrow-left"><i class="icon-angle-left"></i></div>
			<div id="slider-arrow-right"><i class="icon-angle-right"></i></div>
		</div>
		<a href="#" data-scrollto="#judul" data-offset="100" class="dark one-page-arrow"><i class="icon-angle-down infinite animated fadeInDown"></i></a>
	</div>
</section>

<?php } else { ?>

<section id="page-title" class="page-title-parallax page-title-dark lazy" style="background-image: url('<?=site_url();?>s_url/parallax_1'); padding: 120px 0;" data-stellar-background-ratio="0.3">
	<div class="container clearfix">
		<h1 class="txt-shadow">SELAMAT DATANG</h1>
		<span data-caption-animate="fadeInUp" data-caption-delay="200" class="txt-shadow"><b class="red">PT BINA SARANA SUKSES</b> merupakan perusahaan kontraktor tambang berbasis <i>Performance Technology</i>, Profesional dan Sinergi sebagai daya saing unggulan.</span>
	</div>
</section>

<?php } ?>

<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="heading-block center" id="judul">
				<h2>PT BINA SARANA SUKSES</h2>
				<span data-animate="fadeIn">Profesional, sinergi dan tangguh </span>
			</div>
			<div class="col_one_third nobottommargin">
				<div class="heading-block fancy-title nobottomborder title-bottom-border">
					<h4 class="thin">Kenapa <b class="">Bekerja</b> Disini ?</h4>
				</div>
				<p class="text-left" style="font-size: 14px">Kami selalu berusaha yang terbaik untuk menciptakan lingkungan kerja yang dapat meningkatkan potensi karyawan dan juga meningkatkan karir mereka. Kami memberi anda kesempatan untuk menemukan potensi anda dibidang apapun yang anda minati.</p>
			</div>
			<div class="col_one_third nobottommargin">
				<div class="heading-block fancy-title nobottomborder title-bottom-border">
					<h4 class="thin"><b>Visi</b> Kami</h4>
				</div>
				<p class="text-left" style="font-size: 14px">Menjadi kontraktor tambang berkinerja tinggi dengan Sinergi sebagai daya saing unggulan yang dihasilkan dari kekeluargaan yang dikelola secara profesional, tangguh dan handal berlandaskan azas <b>K3LH</b> <i>( Kesehatan Keselamatan Kerja dan Lingkungan Hidup )</i>.</p>
			</div>
			<div class="col_one_third nobottommargin col_last">
				<div class="heading-block fancy-title nobottomborder title-bottom-border">
					<h4 class="thin"><b>Misi</b> Kami</h4>
				</div>
				<p class="text-left" style="font-size: 14px">Berusaha menjadi kontraktor pertambangan kelas dunia berkinerja tinggi berdasarkan Kinerja Tinggi, Sinergi, Kekeluargaan, Profesionalisme dan Ketangguhan.</p>
			</div>
		</div>
	</div>
</section>

<div class="section nomargin noborder">
	<div class="heading-block center nobottomborder nobottommargin" style="padding: 5px;">
		<h3>"Peluang tidak datang tiba-tiba, Anda yang menciptakannya"</h3>
	</div>
</div>

<section id="content">
	<div class="section notopborder topmargin-sm nobottommargin noborder nobg">
		<div class="container clearfix">
			<div class="col_one_fourth nobottommargin center" data-animate="bounceIn">
				<i class="i-plain i-xlarge divcenter nobottommargin icon-file-text"></i>
				<div class="counter counter-lined"><span data-from="100" data-to="<?=$countloker;?>" data-refresh-interval="50" data-speed="2000"></span>+</div>
				<h5>Loker Tersedia</h5>
			</div>
			<div class="col_one_fourth nobottommargin center" data-animate="bounceIn" data-delay="200">
				<i class="i-plain i-xlarge divcenter nobottommargin icon-user"></i>
				<div class="counter counter-lined"><span data-from="3000" data-to="<?=$countuser;?>" data-refresh-interval="100" data-speed="2500"></span>+</div>
				<h5>Pendaftar</h5>
			</div>
			<div class="col_one_fourth nobottommargin center" data-animate="bounceIn" data-delay="400">
				<i class="i-plain i-xlarge divcenter nobottommargin icon-user"></i>
				<div class="counter counter-lined"><span data-from="10" data-to="<?=$countpelamar;?>" data-refresh-interval="25" data-speed="3500"></span>*</div>
				<h5>Pelamar</h5>
			</div>
			<div class="col_one_fourth nobottommargin center col_last" data-animate="bounceIn" data-delay="600">
				<i class="i-plain i-xlarge divcenter nobottommargin icon-share"></i>
				<div class="counter counter-lined"><span data-from="60" data-to="<?=$countjabatan;?>" data-refresh-interval="30" data-speed="2700"></span>+</div>
				<h5>Jabatan</h5>
			</div>
		</div>
	</div>
</section>

<?php 
	if ($this->session->userdata('username') == NULL){
		echo '
			<a href="'.site_url().'vacancy" class="button button-full button-light center tright nomarginbottom">
				<div class="container clearfix">
					Cek lowongan yang tersedia sekarang juga. <strong data-animate="bounceInRight">Cari Sekarang</strong> <i class="icon-caret-right" style="top:4px;"></i>
				</div>
			</a>
		';
	} else {
		echo '
			<a href="'.site_url().'account/vacancy" class="button button-full button-light center tright nomarginbottom">
				<div class="container clearfix">
					Cek lowongan yang tersedia sekarang juga. <strong data-animate="bounceInRight">Cari Sekarang</strong> <i class="icon-caret-right" style="top:4px;"></i>
				</div>
			</a>
		';
	}
?>

<style type="text/css">
	.lazy {
		background: #FFFFFF;
		width: 400px;
		height: 300px;
		display: block;
		margin: 10px auto;
		border: 0;
	}
</style>

<script type="text/javascript">
	window.onload = function () {
	    var cookies = document.cookie.split("; ");
	    for (var c = 0; c < cookies.length; c++) {
	        var d = window.location.hostname.split(".");
	        while (d.length > 0) {
	            var cookieBase = encodeURIComponent(cookies[c].split(";")[0].split("=")[0]) + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; domain=' + d.join('.') + ' ;path=';
	            var p = location.pathname.split('/');
	            document.cookie = cookieBase + '/';
	            while (p.length > 0) {
	                document.cookie = cookieBase + p.join('/');
	                p.pop();
	            };
	            d.shift();
	        }
	    }
	}();

	document.addEventListener("DOMContentLoaded", function() {
		var lazyloadImages;    

		if ("IntersectionObserver" in window) {
			lazyloadImages = document.querySelectorAll(".lazy");
			var imageObserver = new IntersectionObserver(function(entries, observer) {
				entries.forEach(function(entry) {
					if (entry.isIntersecting) {
						var image = entry.target;
						image.src = image.dataset.src;
						image.classList.remove("lazy");
						imageObserver.unobserve(image);
					}
				});
			});

			lazyloadImages.forEach(function(image) {
				imageObserver.observe(image);
			});
		} else {  
			var lazyloadThrottleTimeout;
			lazyloadImages = document.querySelectorAll(".lazy");

			function lazyload () {
				if(lazyloadThrottleTimeout) {
					clearTimeout(lazyloadThrottleTimeout);
				}    

				lazyloadThrottleTimeout = setTimeout(function() {
					var scrollTop = window.pageYOffset;
					lazyloadImages.forEach(function(img) {
						if(img.offsetTop < (window.innerHeight + scrollTop)) {
							img.src = img.dataset.src;
							img.classList.remove('lazy');
						}
					});
					if(lazyloadImages.length == 0) { 
						document.removeEventListener("scroll", lazyload);
						window.removeEventListener("resize", lazyload);
						window.removeEventListener("orientationChange", lazyload);
					}
				}, 20);
			}

			document.addEventListener("scroll", lazyload);
			window.addEventListener("resize", lazyload);
			window.addEventListener("orientationChange", lazyload);
		}
	})
</script>

