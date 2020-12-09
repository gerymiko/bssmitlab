<section class="content-header" id="header-content">
   	<h1>Detail <b>Lowongan</b><small>Web</small></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ul class="timeline">
				<li>
					<i class="far fa-check-circle text-orange"></i>
					<div class="timeline-item">
						<button type="button" class="btn btn-danger btn-sm pull-right" id="back_show_list_vacancy">Kembali</button>
					</div>
				</li>
				<br>
				<li class="time-label">
					<span class="bg-blue">Keterangan</span>
				</li>
				<li>
					<div class="timeline-item">
						<span class="time"><i class="far fa-clock"></i> <?=date('d-m-Y H:i:s', strtotime($dvacan->date_create))?></span>
						<h3 class="timeline-header"><?=$dvacan->jabatan_alias?></h3>
						<div class="timeline-body">
							<ul>
								<li>Kode Lowongan : <?=$dvacan->kode_lowongan?></li>
								<li>Departemen : <?=$dvacan->departemen?></li>
								<li>Jumlah dibutuhkan : <?=$dvacan->jml_rekrut?></li>
								<li>Tanggal dibuka : <?=date('d-m-Y', strtotime($dvacan->tgl_open))?></li>
								<li>Tanggal ditutup : <?=date('d-m-Y', strtotime($dvacan->tgl_close))?></li>
								<li>Status Lowongan : <?=($dvacan->lowongan_status == 1) ? 'Buka' : 'Tutup'?></li>
							</ul>
						</div>
					</div>
				</li>
				<li class="time-label">
					<span class="bg-blue">Kualifikasi</span>
				</li>
				<li>
					<div class="timeline-item">
						<div class="timeline-body">
							<ul>
								<?php
									if ($dvacan->jenis_kelamin == "L") {
										$jk = "Laki-laki";
									} elseif ($dvacan->jenis_kelamin == "P") {
										$jk = "Perempuan";
									} else {
										$jk = "Laki-laki / Perempuan";
									}
									if ($dvacan->experience == 0) {
										$exp = "tidak dibutuhkan";
									} else {
										$exp = $dvacan->experience.' tahun';
									}
									if ($dvacan->experience_subject == "") {
										$exp_sub = "berkaitan tidak dibutuhkan";
									} else {
										$exp_sub = $dvacan->experience_subject;
									}
									if ($dvacan->edu_jurusan == "") {
										$jurusan = "Lowongan ini untuk semua jurusan";
									} else {
										$jurusan = $dvacan->edu_jurusan;
									}
									$countedu = count($dedureq);
									if ($countedu !== 0) {
										foreach ($dedureq as $row) {
											echo '<li> Pendidikan minimal '.$row->edutype_name.'</li>';
										}
									} else { echo '<li>Lowongan ini untuk seluruh jenjang pendidikan<li>'; }
									echo '
										<li>'.$jurusan.'</li>
										<li>Minimal usia dari '.$dvacan->min_usia.' sampai '.$dvacan->max_usia.' tahun</li>
										<li>Jenis kelamin '.$jk.'</li>
										<li>Pengalaman '.$exp.'</li>
										<li>Pengalaman dibidang '.$exp_sub.'</li>';
								?>
							</ul>
						</div>
					</div>
				</li>
				<li class="time-label">
					<span class="bg-blue">Kemampuan / Skill</span>
				</li>
				<li>
					<div class="timeline-item">
						<div class="timeline-body">
							<ul>
								<?php
		                           	$countskillreq = count($dskillreq);
		                           	if ($countskillreq !== 0) {
	                                 	foreach ($dskillreq as $key) {
	                                    	echo '<li>'.$key->skill_name.'</li>';
	                                 	}
		                            } else { echo 'Tidak ada skill khusus untuk jabatan ini.'; }    
		                        ?>
							</ul>
						</div>
					</div>
				</li>
				<li class="time-label">
					<span class="bg-blue">Syarat</span>
				</li>
				<li>
					<div class="timeline-item">
						<div class="timeline-body">
							<ul>
								<?php
									$countskill = count($dsyaratreq);
									if ($countskill !== 0) {
										foreach ($dsyaratreq as $row) {
											echo '<li>'.$row->syarat_name.'</li>';
										}
									} else { echo "Tidak ada syarat untuk lowongan ini"; }
								?>
							</ul>
						</div>
					</div>
				</li>
				<li class="time-label">
					<span class="bg-blue">Deskripsi</span>
				</li>
				<li>
					<div class="timeline-item">
						<div class="timeline-body">
							<?php
								if ($dvacan->job_desc == "") {
									$deskripsi = "Tidak ada deskripsi pekerjaan pada lowongan ini";
								} else {
									$deskripsi = $dvacan->job_desc;
								}
							?> 
							<p><?=html_entity_decode($deskripsi);?></p>
						</div>
					</div>
				</li>
				<li>
					<i class="far fa-check-circle text-orange"></i>
					<div class="timeline-item">
						<button type="button" class="btn btn-danger btn-sm pull-right" id="back_show_list_vacancy">Kembali</button>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_show_list_vacancy, #back_show_list_vacancy").click(function(){
			$("#main-content, #header-content").removeClass("hidden");
			$("#extra-content").addClass("hidden");
		});
	});
</script>
