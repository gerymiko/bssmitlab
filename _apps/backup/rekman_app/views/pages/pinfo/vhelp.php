<style type="text/css">
	#page-title {
		background: #002F65; 
		background: -webkit-linear-gradient(to right, #002F65, #010522); 
		background: linear-gradient(to right, #002F65, #010522);
		padding: 50px 0;
	}
	.faq {
		font-weight: 700 !important;
		font-size: 35px !important; 
	}
	.h2faq { font-weight: 300; }
	.toggle-nomarginbtm {
		margin-bottom: 5px;
		padding: 5px;
	}
	.line-pad { line-height: 30px !important; }
	.toggle:hover {
		background-color: #1883E9;
		color: #FFF;
	}
	.togglet:hover { color: #F1F1F1; }
</style>

<section id="page-title" class="page-title-dark" data-stellar-background-ratio="0.3">
	<div class="container clearfix">
		<h1>Bantuan</h1>
		<span>Help Center/ Frequently Ask Question</span>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li><a href="#">Informasi</a></li>
			<li class="active red">Bantuan</li>
		</ol>
	</div>
</section>

<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="row">
				<div class="col-md-8">
					<div class="nobottommargin clearfix">
						<h2 class="heading-block h2faq"><b class="faq">Pertanyaan</b> yang sering diajukan</h2>
						<p>Berikut ini adalah hal-hal yang sering dipertanyakan mengenai Karir <b class="red">PT. BINA SARANA SUKSES</b></p>
						
						<div class="toggle toggle-border toggle-nomarginbtm line-pad noradius">
							<div class="togglet line-pad"><i class="toggle-closed icon-ok-circle line-pad"></i><i class="toggle-open icon-remove-circle line-pad"></i>Apakah saya boleh melamar lebih dari 2 kali?</div>
							<div class="togglec" style="display: none;">Anda hanya diperkenankan melamar untuk 2 kali di 2 lowongan yang berbeda.</div>
						</div>

						<div class="toggle toggle-border toggle-nomarginbtm line-pad noradius">
							<div class="togglet line-pad"><i class="toggle-closed icon-ok-circle line-pad"></i><i class="toggle-open icon-remove-circle line-pad"></i>Bagaimana jika lamaran saya tidak diproses dalam kurun waktu yang lama?</div>
							<div class="togglec" style="display: none;">Lamaran anda akan kami proses jika memang anda termasuk dalam kualifikasi yang kami butuhkan. Jika lamaran tidak diproses lebih dari 3 minggu, segera batalkan lamaran yang sudah anda pilih kemudian pilih lowongan yang lain.</div>
						</div>

						<div class="toggle toggle-border toggle-nomarginbtm line-pad noradius">
							<div class="togglet line-pad"><i class="toggle-closed icon-ok-circle line-pad"></i><i class="toggle-open icon-remove-circle line-pad"></i>Apa saja web browser yang dapat digunakan untuk melakukan pengisian aplikasi online?</div>
							<div class="togglec" style="display: none;">Untuk kelancaran pendaftaran Anda, kami menyarankan Anda menggunakan web browser Google Chrome minimal versi 16 atau versi terbaru untuk melaksanakan Aplikasi secara online. Serta mengeset komputer Anda untuk dapat menerima cookies. Anda dapat juga menggunakan browser yang lain seperti Mozila Firefox, Opera, UC Browser, Microsoft Edge dan Internet Explorer versi terbaru.</div>
						</div>

						<div class="toggle toggle-border toggle-nomarginbtm line-pad noradius">
							<div class="togglet line-pad"><i class="toggle-closed icon-ok-circle line-pad"></i><i class="toggle-open icon-remove-circle line-pad"></i>Dimana saya dapat melakukan pendaftaran?</div>
							<div class="togglec" style="display: none;">Aplikasi bersifat online dan dapat dilakukan dimana saja selama web browser yang direkomendasikan telah terinstal pada komputer/laptop dan terhubung dengan internet. Anda juga dapat melakukan pendaftaran dan melamar pekerjaan menggunakan smartphone Anda. Atau untuk mendapatkan informasi yang lebih baik dalam pendaftaran atau pengisian dapat dilakukan di seluruh kantor <b class="red">PT. BINA SARANA SUKSES</b>.</div>
						</div>

						<div class="toggle toggle-border toggle-nomarginbtm line-pad noradius">
							<div class="togglet line-pad"><i class="toggle-closed icon-ok-circle line-pad"></i><i class="toggle-open icon-remove-circle line-pad"></i>Haruskah saya mengirimkan berkas-berkas seperti Ijazah, KTP, SIM, Sertifikat dll?</div>
							<div class="togglec" style="display: none;">Anda diwajibkan untuk mengupload dokumen yaitu KTP, foto, ijazah, transkrip nilai dan dokumen sertifikasi pendukung lainnya dalam bentuk file berformat gambar (JPG, JPEG, PNG) dengan ukuran file masing-masing tidak lebih dari 5MB.</div>
						</div>

						<div class="toggle toggle-border toggle-nomarginbtm line-pad noradius">
							<div class="togglet line-pad"><i class="toggle-closed icon-ok-circle line-pad"></i><i class="toggle-open icon-remove-circle line-pad"></i>Apa yang harus saya lakukan jika saya lupa akun user dan password saya?</div>
							<div class="togglec" style="display: none;">Jika anda mendapat kendala saat ingin melakukan login ke akun anda seperti lupa username dan password, anda dapat memilih menu LUPA PASSWORD di halaman login. Kemudian masukkan email yang pernah anda daftarkan untuk membuat akun diwebsite ini. Password baru akan langsung dikirimkan ke email anda. Jika tidak ada di folder INBOX email anda, coba cari di folder SPAM email anda. Jika masih terdapat kendala, anda dapat menghubungi nomor yang tertera dibagian bawah website kami atau dapat melalui :<br />
							<b>WhatsApp : +62-811-5500-855</b>  atau <br>
							<b>Email : rpt@binasaranasukses.com</b></div>
						</div>

						<div class="divider"><i class="icon-circle"></i></div>
					</div>
				</div>

				<div class="col-md-4">
					<?php
						if ($this->session->userdata('username') !== NULL) {
							$param = "account/";
							$hide  = 'class="hidden"';
						} else {
							$param = "";
							$hide  = "";
						}
					?>
					<!-- Sidebar -->
					<div class="sidebar nobottommargin col_last clearfix">
						<div class="sidebar-widgets-wrap">
							<div class="widget widget_links clearfix">
								<h4>KARIR</h4>
								<ul>
									<li><a href="<?=site_url($param);?>information/about"><div>Tentang Perusahaan</div></a></li>
									<li><a href="<?=site_url($param);?>information/election"><div>Tahap Seleksi</div></a></li>
									<li><a href="<?=site_url($param);?>information/notice"><div>Pengumuman</div></a></li>
									<li><a href="<?=site_url($param);?>vacancy"><div>Loker</div></a></li>
									<li <?=$hide;?>><a href="<?=site_url();?>registration"><div>Daftar</div></a></li>
								</ul>
							</div>

							<div class="widget clearfix">
								<h4>TAG</h4>
								<div class="tagcloud">
									<a href="#">rekrutmen</a>
									<a href="#">PT BSS</a>
									<a href="#">tambang</a>
									<a href="#">kontraktor</a>
									<a href="#">FAQ</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>