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
		<h1>TENTANG PERUSAHAAN</h1>
		<span>About our company</span>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li><a href="#">Informasi</a></li>
			<li class="active red">Tentang Perusahaan</li>
		</ol>
	</div>
</section>

<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="col_full nobottommargin">
				<p class="text-justify f15"><b class="red">PT. BINA SARANA SUKSES</b> merupakan perusahaan yang bergerak di bidang usaha jasa pertambangan dan penyewaan alat berat. Berdiri oleh undang-undang dan UUD Negara Republik Indonesia melalui Akta Pendirian Perseroan Terbatas No. 20 pada tanggal 2 Maret 2005 di Jakarta.</p>

				<div class="divider"><i class="icon-circle"></i></div>

				<div class="heading-block highlight-me">
					<h2 class="red">VISI & MISI</h2>
					<span>PT. BINA SARANA SUKSES</span>
				</div>

				<p class="text-justify">Menjadi kontraktor tambang berkinerja tinggi dengan Sinergi sebagai daya saing unggulan yang dihasilkan dari kekeluargaan yang dikelola secara profesional, tangguh dan handal berlandaskan azas K3LH ( Kesehatan Keselamatan Kerja dan Lingkungan Hidup ).</p>

				<p class="text-justify">Dalam mewujudkan visinya, kami mencanangkan MISI berikut ini untuk mewujudkan :</p>
				<div class="accordion clearfix">
					<div class="acctitle acctitlec"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>
						A. Berusaha menjadi kontraktor pertambangan kelas dunia berdasarkan :
					</div>
					<div class="acc_content clearfix" style="display: block;">
						<ul>
							<li><div>Berkinerja Tinggi</div></li>
							<li><div>Melalui sinergi dengan standar yang tinggi antara semua fungsi-fungsi yang ada secara berkesinambungan.</div></li>
						</ul>
					</div>

					<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>
						B. Memberikan solusi sebagai mitra pendukung bagi pihak internal maupun eksternal.
					</div>
					<div class="acc_content clearfix" style="display: none;">
						<ul>
							<li><div>Sinergi</div></li>
							<li><div>Memanfaatkan sinergi sebagai daya saing utama.</div></li>
						</ul>
					</div>

					<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>
						C. Membangun ikatan kekerabatan yang erat, baik di dalam maupun di luar perusahaan.
					</div>
					<div class="acc_content clearfix" style="display: none;">
						<ul>
							<li><div>Kekeluargaan</div></li>
							<li><div>Melahirkan sinergi yang efektif menjawab segala tantangan usaha.</div></li>
						</ul>
					</div>

					<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>
						D. Membuat perusahaan yang dikelola dengan baik berdasarkan nilai-nilai sebagai berikut :
					</div>
					<div class="acc_content clearfix" style="display: none;">
						<ul>
							<li><div>Profesionalisme</div></li>
							<li><div>Dengan membudayakan bersama integritas yang prima dalam mewujudkan "Sistem yang menjalankan kegiatan usaha dan SDM yang menjalankan sistem dimaksud".</div></li>
							<li><div>Ketangguhan</div></li>
							<li><div>Memberlakukan sistem yang tangguh, Menyeleksi dan mendaya hasilkan kompetensi Finansial - Teknis - SDM yang tangguh.</div></li>
						</ul>
					</div>

				</div>
			</div>

			<?php
				if ($this->session->userdata('username') !== NULL) {
					echo '

						<div class="heading-block highlight-me">
							<h2 class="red">ALAMAT</h2>
							<span>PT. BINA SARANA SUKSES</span>
						</div>
						<div class="row">
							<div class="col-md-4">
							<div style="padding: 10px"></div>
								<h4 class="nobottommargin">KANTOR PUSAT</h4><br />
								<p style="margin-bottom: 15px;"><small>Ruko Galeri Niaga Mediterania I - X3 Blok I.8E<br>
								Jl. Pantai Indah Utara 2, Pantai Indah Kapuk RT. 008 RW. 006 Penjaringan Jakarta Utara 
								DKI Jakarta 14460, Indonesia.</small></p>
								<abbr title="Phone Number"><strong>Telepon :</strong></abbr> (021) 5888 222 45<br>
								<abbr title="Fax"><strong>Fax :</strong></abbr> (021) 5888 222 46
							</div>
							
							<div class="col-md-4">
							<div style="padding: 10px"></div>
								<h4 class="nobottommargin">KANTOR CABANG KALTIM</h4><br />
								<p style="margin-bottom: 15px;"><small>Jl. A. Wahab Syahrani No 855, Samarinda, Kalimantan Timur, Indonesia.</small></p>
								<abbr title="Phone Number"><strong>Telepon :</strong></abbr> (0541) 250 088 <br>
								<abbr title="Phone Number"><strong>Telepon :</strong></abbr> (0541) 250 355
							</div>

							<div class="col-md-4">
								<div style="padding: 10px"></div>
								<h4 class="nobottommargin">KANTOR CABANG KALSEL</h4><br />
								<p style="margin-bottom: 15px;"><small>Jl. A. Yani KM 11 Komp. Perumahan Pesona Modern<br>
								Jl. Alam II Block C No. 2 RT. 2, Kertak Hanyar<br>
								Kel. Mekar Raya, Kab. Banjar - Banjarmasin
								70654 Kalimantan Selatan, Indonesia</small></p>
								<abbr title="Phone Number"><strong>Telepon :</strong></abbr> (0511) 422 1037
							</div>
						</div>
					';
				}
			?>
		</div>
	</div>
</section>




