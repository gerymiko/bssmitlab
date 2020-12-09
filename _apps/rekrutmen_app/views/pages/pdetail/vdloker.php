<style type="text/css">
	#page-title {
		background: #002F65; 
		background: -webkit-linear-gradient(to right, #002F65, #010522); 
		background: linear-gradient(to right, #002F65, #010522);
		padding: 50px 0;
	}
	.accordion.accordion-bg .acctitle, .accordion.accordion-bg .acctitlec {
	    line-height: 44px !important;
	    padding: 0 0 0 36px !important;;
	}
</style>
<section id="page-title" class="page-title-dark" data-stellar-background-ratio="0.3">
	<div class="container clearfix">
		<h1>Detail Lowongan</h1>
		<span>Dipublikasikan pada tanggal : <?=date("d-M-Y", strtotime($dloker->tgl_open));?></span>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li><a href="#">Loker</a></li>
			<li class="active">Detail</li>
		</ol>
	</div>
</section>

<section id="content">
	<div class="content-wrap" style="padding: 40px 0;">
		<div class="container clearfix">
			<div class="col_three_fifth nobottommargin">
				<div class="fancy-title title-bottom-border">
					<h3><?=$dloker->jabatan_alias?></h3>
				</div>
				<p><?=html_entity_decode($jobdesc = ($dloker->job_desc == NULL) ? "-" : $dloker->job_desc);?></p>
				<div class="accordion accordion-bg clearfix">
					<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>Kualifikasi</div>
					<div class="acc_content clearfix">
						<ul class="iconlist iconlist-color nobottommargin">
							<li><i class="icon-ok"></i>Minimal lulusan
							<?php
								$countedu = count($dedureq);
								if ($countedu !== 0) {
									foreach ($dedureq as $row) {
										echo ' '.$row->edutype_name.', ';
									}
								}
							?>
							</li>
							<li><i class="icon-ok"></i>
							<?php
								$laki   = 'L'; $wanita = 'P'; $both   ='L;P';
								if ($dloker->jenis_kelamin == $laki){
							 		echo "Laki-laki umur ".$dloker->min_usia." sampai dengan ".$dloker->max_usia." tahun";
								} elseif ($dloker->jenis_kelamin == $wanita){
							 		echo "Perempuan umur ".$dloker->min_usia." sampai dengan ".$dloker->max_usia." tahun";
							 	} else {
							 		echo "Laki-laki / Perempuan umur ".$dloker->min_usia." sampai dengan ".$dloker->max_usia." tahun";
							 	}
							?>
							</li>
							<?php
								foreach ($dsyarat as $row) {
									echo '<li><i class="icon-ok"></i>'.$row->syarat_name.'</li>';
								}
							?>
						</ul>
					</div>
					<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>Skill / Keahlian</div>
					<div class="acc_content clearfix">
						<ul class="iconlist iconlist-color nobottommargin">
							<?php
								$countskill = count($dskillreq);
								if ($countskill == 0) {
									echo '<li><i class="icon-ok"></i>Tidak ada keterampilan khusus untuk loker ini.</li>';
								} else {
									foreach ($dskillreq as $row) {
										echo'<li><i class="icon-ok"></i>'.$row->skill_name.'</li>';
									}
								}
							?>
						</ul>
					</div>
					<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>Sertifikat Keahlian</div>
					<div class="acc_content clearfix">
						<ul class="iconlist iconlist-color nobottommargin">
							<?php
				                $countsert = count($dsertreq);
				                if ($countsert == 0) {
				                	echo '<li><i class="icon-ok"></i>Loker ini tidak memerlukan Sertifikat keahlian khusus.</li>';
				                } else {
				                    foreach ($dsertreq as $row){
										echo '<li><i class="icon-ok"></i>'.$row->certificate_name.'</li>';
				                    }
								}
							?>
						</ul>
					</div>
				</div>
				<?php
					if ($this->session->userdata("username") == NULL) {
						$param = "#modal-login";
					} else {
						$param = "#modal-apply-job";
					}
				?>
				<button type="button" class="button button-border button-rounded button-blue nomargin button-small" data-toggle="modal" data-target="<?=$param;?>">Lamar Sekarang</button>
				<a href="#" class="button button-rounded button-dark nomargin button-small" id="close-window">Kembali</a>
				<div class="divider divider-short"><i class="icon-star3"></i></div>
			</div><!--  detail loker -->
			<div class="col_two_fifth nobottommargin col_last">
				<div id="job-apply" class="heading-block highlight-me nobottommargin">
					<h4>Lowongan Lainnya</h4>
					<span>Pekerjaan lain yang mungkin anda minati.</span>
				</div><br />
				<div class="sidebar-widgets-wrap">
					<div class="widget widget_links clearfix">
						<ul>
							<?php
								if($this->session->userdata('username') !== NULL){
									$param = "account/cdetail/sysdetail";
								} else {
									$param = "cdetail/sysdloker";
								}
								foreach ($other_jobs as $row) {
									$title    = str_replace(" ", "", $row->jabatan_alias);
									$string   = html_entity_decode($title);
									$subtitle = preg_replace("/&/",'',$string);
									$id       = $this->encrypt->encode($row->lowongan_id);
									echo '<li><a href="'.site_url(''.$param.'/detail_loker/'.$id.'/'.strtolower($subtitle)).'">'.$row->jabatan_alias.'</a></li>';
								}
							?>
						</ul>
					</div>
					<div class="widget clearfix">
						<h4>TAGS</h4>
						<div class="tagcloud">
							<a href="#">rekrutmen</a>
							<a href="#">PT BSS</a>
							<a href="#">kontraktor</a>
							<a href="#">tambang</a>
							<a href="#">lowongan</a>
							<a href="#">kerja</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fadeIn" id="modal-login" tabindex="-1" role="dialog" aria-labelledby="LabelJob" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bshadowx">
			<div class="modal-header" style="border: none;">
				<h5 class="modal-title nomargin" id="LabelJob">
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="center">
					<h4 style="font-weight: 300;">Silahkan login terlebih dahulu</h4>
					<p>Klik tombol <b>OK</b> dibawah untuk login</p>
					<button type="button" class="button button-small button-border button-rounded button-white" data-dismiss="modal">Mungkin Nanti</button>
					<button type="button" data-toggle="modal" data-target=".modal-login" class="button button-3d button-rounded button-red"  data-dismiss="modal">Ok, Lanjutkan</button>
				</div>
				<div class="center topmargin-sm">
					<p>Belum punya akun? <a href="<?=site_url();?>sysdaftar"><b>Daftar</b> disini</a></p>
				</div>
			</div>
			<div class="modal-footer" style="border: none;"></div>
		</div>
	</div>
</div>

<div class="modal fadeIn" id="modal-apply-job" tabindex="-1" role="dialog" aria-labelledby="LabelJob" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content bshadowx">
			<div class="modal-header" style="border: none;">
				<h5 class="modal-title nomargin" id="LabelJob">
					<button type="button" class="close" data-dismiss="modal">×</button>
				</h5>
			</div>
			<form role="form" method="post" id="form-apply-job" name="job_apply" class="nomargin">
				<div class="modal-body">
					<?php
						$id 		 = $dloker->lowongan_id;
						$people_id   = $this->session->userdata('people_id');
						$lowongan_id = $id;
					?>
					<div class="form-group">
						<input type="hidden" name="people_id" value="<?=$people_id;?>">
						<input type="hidden" name="lowongan_id" value="<?=$lowongan_id;?>">
					</div>
					<div class="center">
						<h4 style="font-weight: 300;">Melamar untuk posisi ini ?</h4>
						<h3><?=$dloker->jabatan_alias;?></h3>
					</div>
				</div>
				<div class="modal-footer" style="border: none;">
					<div class="container">
						<div class="row">
							<div class="col-sm-6">
								<button type="button" class="button button-3d button-small button-rounded button-white button-light btn-block" data-dismiss="modal">Batal</button>
							</div>
							<div class="col-sm-6">
								<button type="button" name="submit" id="btn" class="button button-3d button-small button-rounded button-red white button-light btn-block" onclick="apply_job()">Ok</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	document.getElementById("close-window").addEventListener("click", function(){ 
    	window.close();
	});
	function apply_job(){
		var paramstr = $("#form-apply-job").serialize();
		if($("#form-apply-job").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/clamaran/syslamaran/apply_job",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#modal-apply-job').modal('hide');
				    swal("Selamat!", "Lamaran Anda telah kami terima.", "success");
				} else if(data == "Duplicate") {
					$('#modal-apply-job').modal('hide');
				    swal("Aww!", "Anda sudah melamar untuk lowongan ini", "warning");
				} else {
					$('#modal-apply-job').modal('hide');
					swal("Oops!", "Terjadi kesalahan. Mohon muat ulang halaman ini dan coba lagi", "warning");
				}
			});	
		}
	}
</script>

