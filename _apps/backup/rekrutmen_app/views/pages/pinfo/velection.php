<style type="text/css">
	#page-title {
		background: #002F65; 
		background: -webkit-linear-gradient(to right, #002F65, #010522); 
		background: linear-gradient(to right, #002F65, #010522);
		padding: 50px 0;
	}
</style>

<section id="page-title" class="page-title-dark" data-stellar-background-ratio="0.3">
	<div class="container clearfix">
		<h1>TAHAP SELEKSI KARYAWAN</h1>
		<span>Recruitment selection stage</span>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li><a href="#">Informasi</a></li>
			<li class="active red">Tahap Seleksi</li>
		</ol>
	</div>
</section>

<section id="content">
	<div class="content-wrap nobottompadding">
		<div class="container-fluid clearfix">
			<div class="col_full">

				<div class="heading-block center">
					<h2>Alur Perekrutan Karyawan</h2>
					<span class="divcenter" style="max-width: 900px;">Dibawah ini menjelaskan tentang tahapan yang akan Anda jalani dalam seleksi karyawan di perusahaan kami. Untuk lebih jelasnya silahkan memilih tahapan yang diinginkan.</span>
				</div>
				<div class="panel panel-default noradius">
					<div class="panel-body">
						<div id="processTabs">
							<ul class="process-steps bottommargin clearfix">
								<li style="width: 20%;">
									<a href="#ptab1" class="i-circled i-bordered i-alt divcenter">1</a>
									<h5>Seleksi Berkas</h5>
								</li>
								<li style="width: 20%;">
									<a href="#ptab2" class="i-circled i-bordered i-alt divcenter">2</a>
									<h5>Interview</h5>
								</li>
								<li style="width: 20%;">
									<a href="#ptab3" class="i-circled i-bordered i-alt divcenter">3</a>
									<h5>Tes Teori & Praktek</h5>
								</li>
								<li style="width: 20%;">
									<a href="#ptab4" class="i-circled i-bordered i-alt divcenter">4</a>
									<h5>MCU (Medical Check Up)</h5>
								</li>
								<li style="width: 20%;">
									<a href="#ptab5" class="i-circled i-bordered i-alt divcenter">5</a>
									<h5>Agreement</h5>
								</li>
							</ul>
							<div>
								<div id="ptab1">
									<p class="text-justify">Tahap seleksi berkas merupakan tahapan dimana setiap PIC yang bertanggung jawab atas lowongan yang telah dibuka untuk menyeleksi berkas mana yang akan lolos atau dipertimbangkan untuk dapat ke tahap selanjutnya atau akan digagalkan untuk tidak dilanjutkan.</p>
								</div>
								<div id="ptab2">
									<p class="text-justify">Tahap interview merupakan tahap penting bagi kami untuk mengenal anda lebih dalam baik secara kepribadian dan mental.</p>
								</div>
								<div id="ptab3">
									<p class="text-justify">. . .</p>
								</div>
								<div id="ptab4">
									<p class="text-justify">. . .</p>
								</div>
								<div id="ptab5">
									<p class="text-justify">. . .</p>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(function() {
		$( "#processTabs" ).tabs({ show: { effect: "fade", duration: 400 } });
		$( ".tab-linker" ).click(function() {
			$( "#processTabs" ).tabs("option", "active", $(this).attr('rel') - 1);
			return false;
		});
	});
</script>

