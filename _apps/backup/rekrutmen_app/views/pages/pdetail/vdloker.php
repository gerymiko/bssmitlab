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
		<span>Dipublikasikan pada tanggal : <?=date("d-M-Y", strtotime($this->security->xss_clean($dloker->tgl_open)));?></span>
		<ol class="breadcrumb">
			<li><a href="#">Beranda</a></li>
			<li><a href="#">Loker</a></li>
			<li class="active red">Detail Loker</li>
		</ol>
	</div>
</section>

<section id="content">
	<div class="content-wrap" style="padding: 40px 0;">
		<div class="container clearfix">
			<div class="col_three_fifth nobottommargin">
				<div class="fancy-title title-bottom-border">
					<h3><?=$this->security->xss_clean($dloker->jabatan_alias);?></h3>
				</div>
				<p><?=html_entity_decode($jobdesc = ($this->security->xss_clean($dloker->job_desc) == NULL) ? "-" : $this->security->xss_clean($dloker->job_desc));?></p>
				<div class="accordion accordion-bg clearfix">
					<div class="acctitle"><i class="acc-closed icon-ok-circle"></i><i class="acc-open icon-remove-circle"></i>Kualifikasi</div>
					<div class="acc_content clearfix">
						<ul class="iconlist iconlist-color nobottommargin">
							<li><i class="icon-ok"></i>Minimal lulusan
							<?php
								$countedu = count($dedureq);
								if ($countedu !== 0) {
									foreach ($dedureq as $row) {
										echo ' '.$this->security->xss_clean($row->edutype_name).', ';
									}
								}
							?>
							</li>
							<li><i class="icon-ok"></i>
							<?php
								$laki   = 'L'; $wanita = 'P'; $both   ='L;P';
								if ($this->security->xss_clean($dloker->jenis_kelamin) == $laki){
							 		echo "Laki-laki umur ".$this->security->xss_clean($dloker->min_usia)." sampai dengan ".$this->security->xss_clean($dloker->max_usia)." tahun";
								} elseif ($this->security->xss_clean($dloker->jenis_kelamin) == $wanita){
							 		echo "Perempuan umur ".$this->security->xss_clean($dloker->min_usia)." sampai dengan ".$this->security->xss_clean($dloker->max_usia)." tahun";
							 	} else {
							 		echo "Laki-laki / Perempuan umur ".$this->security->xss_clean($dloker->min_usia)." sampai dengan ".$this->security->xss_clean($dloker->max_usia)." tahun";
							 	}
							?>
							</li>
							<?php
								foreach ($dsyarat as $row) {
									echo '<li><i class="icon-ok"></i>'.$this->security->xss_clean($row->syarat_name).'</li>';
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
										echo'<li><i class="icon-ok"></i>'.$this->security->xss_clean($row->skill_name).'</li>';
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
										echo '<li><i class="icon-ok"></i>'.$this->security->xss_clean($row->certificate_name).'</li>';
				                    }
								}
							?>
						</ul>
					</div>
				</div>
				<?php
					if ($this->session->userdata("username") == NULL) {
						$param       = "#modal-login";
						$umur_notif  = "hidden";
						$jk_notif    = "hidden";
						$class_umur  = "";
						$class_jk    = "";
						$notice_umur = "";
						$notice_jk   = "";
						
					} else {
						$param      = "#modal-apply-job";

						$born  = new DateTime($this->security->xss_clean($dperson->people_birth_date));
						$today = new DateTime(date("Y-m-d"));
						$umur  = $born->diff($today);
						$age   = $umur->format('%y');

						if ($age >= $this->security->xss_clean($dloker->min_usia) && $age <= $this->security->xss_clean($dloker->max_usia) ) {
							$umur_notif  = "hidden";
							$class_umur  = "";
							$notice_umur = "";
						} else {
							$umur_notif  = "";
							$class_umur  = "hidden";
							$notice_umur = "Umur anda tidak memenuhi syarat lowongan ini.";
						} 

						$both  = "L;P";
						if ($this->security->xss_clean($dloker->jenis_kelamin) == $this->security->xss_clean($dperson->people_gender) || $this->security->xss_clean($dloker->jenis_kelamin) == $both) {
							$jk_notif  = "hidden";
							$notice_jk = "";
							$class_jk  = "";
						} else {
							$jk_notif  = "";
							$notice_jk = "Jenis kelamin anda tidak memenuhi syarat lowongan ini.";
							$class_jk  = "hidden";
						}

					}

					
				?>
				<div class="panel panel-primary <?=$umur_notif;?>">
					<div class="panel-body">
						<?=$notice_umur;?>
					</div>
				</div>
				<div class="panel panel-primary <?=$jk_notif;?>">
					<div class="panel-body">
						<?=$notice_jk;?>
					</div>
				</div>

				<button type="button" class="button button-border button-rounded button-blue nomargin button-small <?=$class_umur;?> <?=$class_jk;?>" data-toggle="modal" data-target="<?=$param;?>">Lamar Sekarang</button>
				<a href="#" class="button button-rounded button-dark nomargin button-small" id="close-window">Kembali</a>
				<div class="divider divider-rounded"><i class="icon-ok"></i></div>
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
									$param = "account/vacancy/detail";
								} else {
									$param = "vacancy/detail";
								}
								foreach ($other_jobs as $row) {
									$title    = str_replace(" ", "", $this->security->xss_clean($row->jabatan_alias));
									$string   = html_entity_decode($title);
									$subtitle = preg_replace("/&/",'',$string);
									$id       = $this->encrypt->encode($this->security->xss_clean($row->lowongan_id));
									echo '<li><a href="'.site_url(''.$param.'/'.$id.'/'.strtolower($subtitle)).'">'.$this->security->xss_clean($row->jabatan_alias).'</a></li>';
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
							<a href="#" class="lowercase bg-red"><?=$dloker->jabatan_alias;?></a>
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
					<p>Belum punya akun? <a href="<?=site_url();?>registration"><b>Daftar</b> disini</a></p>
				</div>
			</div>
			<div class="modal-footer" style="border: none;"></div>
		</div>
	</div>
</div>

<div class="loading hidden" id="loading"></div>

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
						if ($this->session->userdata('username') !== null) {
							$people_id       = $this->session->userdata('people_id');
							$lowongan_id     = $this->security->xss_clean($dloker->lowongan_id);
							$registrant_kode = $this->security->xss_clean($dperson->registrant_kode);
						} else {
							$people_id       = "";
							$lowongan_id     = "";
							$registrant_kode = "";
						}
					?>
					<div class="form-group">
						<input type="hidden" name="people_id" value="<?=$people_id;?>">
						<input type="hidden" name="lowongan_id" value="<?=$lowongan_id;?>">
						<input type="hidden" name="registrant_kode" value="<?=$registrant_kode;?>">
					</div>
					<div class="center">
						<h4 style="font-weight: 300;">Melamar untuk posisi ini ?</h4>
						<h3><?=$this->security->xss_clean($dloker->jabatan_alias);?></h3>
					</div>
				</div>
				<div class="modal-footer" style="border: none;">
					<div class="container">
						<div class="row">
							<div class="col-sm-6">
								<button type="button" class="button button-3d button-small button-rounded button-white button-light btn-block" data-dismiss="modal">Batal</button>
							</div>
							<div class="col-sm-6">
								<button type="button" name="submit" id="btn-apply-job" class="button button-3d button-small button-rounded button-red white button-light btn-block" onclick="apply_job()">Ok</button>
							</div>
						</div>
						<br>
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
		$('#loading').removeClass('hidden');
		$('#modal-apply-job').modal('hide');
		$('#btn-apply-job').addClass('hidden');
		if($("#form-apply-job").valid() == false){
			return false;
		} else {
			$.post("<?=base_url();?>account/apply_job",
			paramstr,
			function(data) {
				if(data == "Success"){
					$('#loading').addClass('hidden');
					$('#modal-apply-job').modal('hide');
				    swal("Selamat!", "Lamaran Anda telah kami terima.", "success");
				} else if(data == "Duplicate") {
					$('#loading').addClass('hidden');
					$('#modal-apply-job').modal('hide');
				    swal("Oops!", "Anda sudah melamar untuk lowongan ini", "warning");
				} else if (data == "Limit") {
					$('#loading').addClass('hidden');
					$('#modal-apply-job').modal('hide');
					swal("Oops!", "Anda sudah melamar 2 lowongan. Tidak diperbolehkan melebihi 2 lowongan.", "warning");
				} else if (data == "Gender") {
					$('#loading').addClass('hidden');
					$('#modal-apply-job').modal('hide');
					swal("Oops!", "Maaf jenis kelamin anda tidak memenuhi syarat lowongan ini.", "warning");
				} else if (data == "Age") {
					$('#loading').addClass('hidden');
					$('#modal-apply-job').modal('hide');
					swal("Oops!", "Maaf umur anda tidak memenuhi syarat lowongan ini.", "warning");
				} else if (data == "Photo") {
					$('#loading').addClass('hidden');
					$('#modal-apply-job').modal('hide');
					swal("Oops!", "Lengkapi foto diri Anda.", "warning");
				} else {
					$('#loading').addClass('hidden');
					$('#modal-apply-job').modal('hide');
					$('#btn-apply-job').removeClass('hidden');
					swal("Oops!", "Terjadi kesalahan. Mohon muat ulang halaman ini dan coba lagi", "warning");
				}
			});	
		}
	}
</script>

