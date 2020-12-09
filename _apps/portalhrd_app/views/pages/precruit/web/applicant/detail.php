<section class="content-header" id="header-content">
	<h1><span class="label no-padding text-black">Detail Pelamar</span></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<ul class="timeline">
				<li>
					<i class="far fa-dot-circle text-navy"></i>
					<div class="timeline-item" style="background: none;box-shadow: none;">
						<div class="row">
							<div class="col-md-12">
								<?php
									$photo = explode('/', $dapplicant->people_photo);
									$link = site_url('getimage/career/profile/').$photo[1];
									if (file_exists(dirname("E:\\").'/images/karir/upload/profile/'.$photo[1])){
										echo '<a class="hand" onclick="zoom(\''.$link.'\');"><img src="'.$link.'" width="150"></a>';
									} else {
										echo '<img src="'.site_url().'getimage/png/user">';
									}
								?>								
								<div class="btn-group pull-right desktop">
									<button type="button" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
									<button type="button" class="btn bg-gray" id="btn_show_list"> Kembali</button>
			                    </div>
			                    <div class="btn-group pull-right mobile">
									<button type="button" class="btn btn-danger"><i class="fas fa-file-pdf"></i></button>
									<button type="button" class="btn bg-gray" id="mbtn_show_list"><i class="fas fa-chevron-left"></i></button>
			                    </div>
							</div>
						</div>		
					</div>
				</li>
				<li>
					<i class="fas fa-user-circle text-navy"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Personal</h3>
						<div class="timeline-body">
							<div class="row">
								<div class="col-md-6">
									<?php
										$date = new DateTime($dapplicant->people_birth_date);
										$now  = new DateTime();
						                $interval = $date->diff($now);
						                $usia = $interval->format("%y Tahun");
									?>
									<h5><?=$dapplicant->registrant_kode?><br><small>Kode Registrasi</small></h5>
									<h5><?=$dapplicant->people_firstname.' '.$dapplicant->people_middlename.' '.$dapplicant->people_lastname?><br><small>Nama Lengkap</small></h5>
									<h5><?=$dapplicant->city_name?>, <?=date("d-m-Y", strtotime($dapplicant->people_birth_date))?><br><small>Tempat &amp; Tgl Lahir</small></h5>
									<h5><?=$usia?><br><small>Usia</small></h5>
									<h5><?=($dapplicant->people_gender == 'L') ? 'Laki-laki' : 'Perempuan'?><br><small>Jenis Kelamin</small></h5>
									<h5><?=$dstatus->pstat_status?><br><small>Status</small></h5>
								</div>
								<div class="col-md-6">
									<h5><?=($dapplicant->people_phone == null) ? '-' : $dapplicant->people_phone?> / <?=$dapplicant->people_mobile?><br><small>No. Tlp</small></h5>
									<h5><?=ucwords($dapplicant->people_religion)?><br><small>Agama</small></h5>
									<h5><?=$dapplicant->people_citizen?><br><small>Kewarganegaraan</small></h5>
									<h5><?=$dapplicant->people_blood_type?><br><small>Golongan Darah</small></h5>
									<h5><?=$dapplicant->people_height?> cm<br><small>Tinggi Badan</small></h5>
									<h5><?=$dapplicant->people_weight?> kg<br><small>Berat Badan</small></h5>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fas fa-compass text-navy"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Alamat</h3>
						<div class="timeline-body">
							<div class="row">
								<div class="col-md-6">
									<h5><b>Domisili</b></h5>
									<p><?=$daddrsdom->address?><br> Kode Pos <?=$daddrsdom->zip_code?><br> Kota <?=$daddrsdom->city_name?></p>
								</div>
								<div class="col-md-6">
									<h5><b>Asal</b></h5>
									<p><?=$daddrshome->address?><br> Kode Pos <?=$daddrshome->zip_code?><br> Kota <?=$daddrshome->city_name?></p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fas fa-info-circle text-navy"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Pendidikan</h3>
						<div class="timeline-body">
							<div class="row">
								<div class="col-md-4">
									<h5><b>Formal</b></h5>
									<?php
										foreach ($deduformal as $row) {
										echo '
											<b>'.$row->edutype_name.'</b>
											<p>'.$row->edu_name.'<br><small><em>Nama Sekolah / P.T. / Univ.</em></small></p>
											<p>'.ucfirst($row->major_name).'<br><small><em>Jurusan</em></small></p>
											<p>'.$row->city_name.'<br><small><em>Kota</em></small></p>
											<p>'.date("Y", strtotime($row->edu_tahun_lulus)).'<br><small><em>Tahun Lulus</em></small></p>
											<p>'.ucfirst($row->edu_keterangan).'<br><small><em>Keterangan Lulus</em></small></p>';
										}
									?>
								</div>
								<div class="col-md-8">
									<h5><b>Informal</b></h5>
									<div class="row">
										<?php
											$counteduinfor = count($deduinformal);
											if ($counteduinfor !== 0) {
												$no = 0;
												foreach ($deduinformal as $row) {
													$no++;
													echo '
													<div class="col-md-6">
														<b>'.$no.'. '.$row->informaledu_name.'</b>
														<p>'.$row->informaledu_tempat.'<br><small><em>Institusi Penyelenggara</em></small></p>
														<p>'.date("d-m-Y", strtotime($row->informaledu_dari)).' S/d '.date("d-m-Y", strtotime($row->informaledu_sampai)).'<br><small><em>Masa Pelatihan</em></small></p>
														<p>'.ucwords($row->informaledu_keterangan).'<br><small><em>Keterangan</em></small></p>
													</div>';
												}
											} else { echo '<div class="col-md-12"><p>Tidak ada data yang dapat ditampilkan.</p></div>'; }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fab fa-bandcamp text-navy"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Identitas dan Surat Izin Mengemudi</h3>
						<div class="timeline-body">
							<div class="row">
								<?php
									foreach ($dlisence as $row) {
										$datestart = (date("Y", strtotime($row->plisence_date_start)) == "1970" ) ? '-' : $row->plisence_date_start;
										$dateend = (date("Y", strtotime($row->plisence_date_end)) == "1970" ) ? '-' : date("d-m-Y", strtotime($row->plisence_date_end));
										echo '
										<div class="col-md-4">
											<b>'.$row->plisence_type.'</b>
											<p>'.$row->plisence_number.'<br><small><em>Nomor</em></small></p>
											<p>'.$row->city_name.'<br><small><em>Diterbitkan di</em></small></p>
											<p>'.date("d-m-Y", strtotime($datestart)).' S/d '.$dateend.'<br><small><em>Masa Berlaku</em></small></p>
										</div>';
									}
								?>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fas fa-dot-circle text-navy"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Pengalaman</h3>
						<div class="timeline-body">
							<div class="row">
							<?php
								$countjobhis = count($dexp);
								if ($countjobhis !== 0) {
									$no = 0;
									foreach ($dexp as $row) {
										$no++;
										echo '
										<div class="col-md-4">
											<b>'.$no.'. '.$row->pjobhistory_company.'</b>
											<p>'.$row->sector_name.'<br><small><em>Bidang</em></small></p>
											<p>'.ucfirst($row->pjobhistory_jabatan_awal).'<br><small><em>Jabatan Awal</em></small></p>
											<p>'.ucfirst($row->pjobhistory_jabatan_akhir).'<br><small><em>Jabatan Akhir</em></small></p>
											<p>'.$row->pjobhistory_gaji_akhir.'<br><small><em>Gaji Akhir</em></small></p>
											<p>'.date("d-m-Y", strtotime($row->pjobhistory_thn_start)).' S/d '.date("d-m-Y", strtotime($row->pjobhistory_thn_end)).'<br><small><em>Masa Kerja</em></small></p>
											<p>'.ucfirst($row->pjobhistory_reason).'<br><small><em>Alasan Keluar</em></small></p>
										</div>';
									}
								} else { echo '<div class="col-md-12"><p>Tidak ada data yang dapat ditampilkan.</p></div>'; }
							?>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="fas fa-question-circle text-navy"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Pertanyaan</h3>
						<div class="timeline-body">
							<?php
								foreach ($dquest as $row){
									echo '
									<p>'.$row->recquest_question.'<br>
										<b><em>Jawaban : '.$row->answer.'</em></b>
									</p>';
								}
							?>
						</div>
					</div>
				</li>
				<li>
					<i class="fab fa-creative-commons-share text-navy"></i>
					<div class="timeline-item">
						<h3 class="timeline-header">Berkas</h3>
						<div class="timeline-body">
							<p>KTP dan SIM</p>
							<div class="row">
								<?php
									$countdlisence = count($dlisence);
									if ($countdlisence != 0) {
										foreach ($dlisence as $row) {
											$photo = explode('/', $row->plisence_file);
											if (isset($photo[1])) {
												if ($photo[1] != null || $photo[1] != '') {
													$link = site_url('getimage/career/docs/').$photo[1];
													if (file_exists(dirname("D:\\").'/images/karir/upload/berkas/'.$photo[1])){
														echo '
															<a data-tooltip="Lihat" class="hand" onclick="zoom(\''.$link.'\');">
																<div class="col-md-3">
																	<img src="'.$link.'" width="100%">
																</div>
															</a>';
													} else {
														echo '
														<div class="col-md-3">
															<p>Tidak ada berkas.</p>
														</div>';
													}
												}
											}
										}
									} else {
										echo '<p>Tidak ada berkas.</p>';
									}
								?>
							</div>
							<br>
							<div class="row">
								<?php
									$countjobhis = count($dexp);
									if ($countjobhis != 0) {
										foreach ($dexp as $row) {
											$file = explode('/', $row->pjobhistory_file);
											if (isset($file[1])) {
												echo '<div class="col-md-12"><p>BERKAS PENDUKUNG</p></div>';
												$link = site_url('getimage/career/docs/').$file[1];
												if (file_exists(dirname("D:\\").'/images/karir/upload/berkas/'.$file[1])){
													echo '
														<a data-tooltip="Lihat" class="hand" onclick="zoom(\''.$link.'\');">
															<div class="col-md-3">
																<img src="'.$link.'" width="100%">
															</div>
														</a>';
												} else {
													echo '
													<div class="col-md-3">
														<p>Tidak ada berkas.</p>
													</div>';
												}
											}
										}
									}
								?>
							</div>
						</div>
					</div>
				</li>
				<li>
					<i class="far fa-check-circle text-navy"></i>
					<div class="timeline-item">
						<div class="btn-group pull-right desktop">
							<button type="button" class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
							<button type="button" class="btn bg-gray" id="btn_show_list"> Kembali</button>
	                    </div>
	                    <div class="btn-group pull-right mobile">
							<button type="button" class="btn btn-danger"><i class="fas fa-file-pdf"></i></button>
							<button type="button" class="btn bg-gray" id="mbtn_show_list"><i class="fas fa-chevron-left"></i></button>
	                    </div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){
		$("#btn_show_list, #mbtn_show_list").click(function(){
			Pace.restart();
			$("#main-content, #header-content").removeClass("hidden");
			$("#extra-content").addClass("hidden");
		});
	});
	function zoom(argument) {
		swal({ 
			title: "", 
			html: '<img src="'+argument+'" width="100%">', 
			type: "",
			animation: false,
			confirmButtonText: 'Okay' 
		})
	}
</script>