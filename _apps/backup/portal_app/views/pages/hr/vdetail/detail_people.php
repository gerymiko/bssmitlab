<h4 style="margin-top: 0;"><span class="label label-primary">DETAIL LENGKAP PELAMAR</span></h4>
<input type="hidden" id="people_id" name="people_id" value="<?=$detail_people->people_id;?>">

<div class="profile-env">
	<header class="row">
		<div class="col-md-2">
			<a href="#" class="profile-picture">
				<?php
					$path = site_url().'hrDepartment/cdetail/sysdetailpeople/photo_profile/'.$detail_people->people_id;
					if (file_exists($path)) {
					    echo '
							<img src="http://web.binasaranasukses.com/bssmitlab/_assets/images/logo/bssfav.png" class="img-responsive">
					    ';
					} else {
						echo '
							<img src="'.$path.'" class="img-responsive">
						';
					}
				?>
			</a>
		</div>
		<div class="col-md-7">
			<ul class="profile-info-sections">
				<li>
					<div class="profile-name">
						<strong>
							<a href="#"><?=ucfirst($detail_people->people_firstname).' ',ucfirst($detail_people->people_middlename).' '.ucfirst($detail_people->people_lastname);?></a>
							<?php
								if($detail_people->is_login == 1){
									$online = "is-online";
								} else {
									$online = "is-offline";
								}
							?>
							<a href="#" class="user-status <?=$online;?> tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Online"></a>
						</strong>
						<span><a href="#">Terdatar pada tanggal : <?=date_indo($detail_people->people_reg_date)?></a></span>
					</div>
				</li>
				<li>
					<div class="profile-stat">
						<h4><?=$detail_people->registrant_kode;?></h4>
						<span><a href="#">Kode Registrasi</a></span>
					</div>
				</li>
			</ul>
		</div>
		
		<div class="col-md-3">
			<div class="profile-buttons">
				<a onClick="ajax_load('<?=$this->input->post('last_link');?>')" class="btn btn-red">
					<i class="entypo-left-open"></i>
					Kembali
				</a>
				
				<a target="_blank" href="<?php echo site_url()?>downloadPdf/<?=$detail_people->people_id;?>" class="btn btn-default">
					<i class="entypo-print"></i>
				</a>
			</div>
		</div>
	</header>
	<?php
		$link = $this->input->post("link");
	?>
	
	<section class="profile-info-tabs">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-offset-2 col-sm-10">
					<ul class="user-details">
						<div class="container-fluid">
							<div class="row">
								<div class="col-sm-3">
									<div style="padding-top: 8px"></div>
									<li>
										<!-- <i class="entypo-location"></i> -->
										<td class="bold">Email</td>
										<td>:</td>
										<td><?=$detail_people->people_email;?></td>
									</li>
									<li>
										<td>No. Handphone</td>
										<td>:</td>
										<td><?=$detail_people->people_mobile;?></td>
									</li>
									<li>
										<td>Username</td>
										<td>:</td>
										<td><?=$detail_people->username;?></td>
									</li>
								</div>
								<div class="col-sm-4">
									<div style="padding-top: 8px"></div>
									<li>
										<!-- <i class="entypo-location"></i> -->
										<td class="bold">Kota Asal</td>
										<td>:</td>
										<td><?=$detail_alamat_asal->city_name;?></td>
									</li>
									<li>
										<td>Kota Domisili</td>
										<td>:</td>
										<td><?=$detail_alamat_domisili->city_name;?></td>
									</li>
									<li>
										<td>Login Terakhir</td>
										<td>:</td>
										<td><?=date("d/m/Y H:i:s", strtotime($detail_people->last_login));?></td>
									</li>
								</div>
								<div class="col-sm-5">
									<?php
										foreach ($detail_melamar as $row) {
											echo '
												<td><a style="margin-bottom: 2px;" onClick="gagalberkas('.$row->pelamar_id.')" class="gagalberkas btn btn-primary btn-sm">
					                                Gagal Berkas <b>'.$row->jabatan_alias.'</b>
					                            </a></td>
											';
										}
									?>
								</div>
							</div>
						</div>
					</ul>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	function kembali(id){
	    $.ajax({
			type: "GET",
			url: id,
			success: function(data) { 
				$('#contents').html(data);
				window.history.pushState( "Details", "Title", "/portal/syshaer/" + id.substring(window.location.href.indexOf("portal")+7,id.length));
			}
	    });
	}
</script>
<div class="row">
	<div class="col-md-5">
		<!-- DATA DIRI -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">DATA PRIBADI</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<tr>
							<td>Jenis Kelamin</td>
							<td><?=$detail_people->people_gender;?></td>
						</tr>
						<?php
							$dateborn = $detail_people->people_birth_date;    
			                $date     = new DateTime($dateborn);
			                $now      = new DateTime();
			                $interval = $date->diff($now);
			                $usia     = $interval->format("%y Tahun");
						?>
						<tr>
							<td>Usia</td>
							<td><?=$usia;?></td>
						</tr>
						<tr>
							<td>Tempat Lahir</td>
							<td><?=$detail_people->city_name;?></td>
						</tr>
						<tr>
							<td>Tanggal Lahir</td>
							<td><?=date_indo($detail_people->people_birth_date);?></td>
						</tr>
						<tr>
							<td>No. Telepon / Handphone</td>
							<td><?=$detail_people->people_phone." / ".$detail_people->people_mobile;?></td>
						</tr>
						<tr>
							<td>Golongan Darah</td>
							<td><?=$detail_people->people_blood_type;?></td>
						</tr>
						<tr>
							<td>Agama</td>
							<td><?=ucfirst($detail_people->people_religion);?></td>
						</tr>
						<tr>
							<td>Kewarganegaraan</td>
							<td><?=$detail_people->people_citizen;?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<!-- ALAMAT -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">ALAMAT</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<tr>
							<td rowspan="1" class="col-sm-3"><b>KTP / ASAL</b></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><?=$detail_alamat_asal->address;?></td>
						</tr>
						<tr>
							<td>Kota</td>
							<td><?=$detail_alamat_asal->city_name;?></td>
						</tr>
						<tr>
							<td>Kode Pos</td>
							<td><?=$detail_alamat_asal->zip_code;?></td>
						</tr>
						<tr>
							<td><b>DOMISILI</b></td>
							<td></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><?=$detail_alamat_domisili->address;?></td>
						</tr>
						<tr>
							<td>Kota</td>
							<td><?=$detail_alamat_domisili->city_name;?></td>
						</tr>
						<tr>
							<td>Kode Pos</td>
							<td><?=$detail_alamat_domisili->zip_code;?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<!-- KTP DAN SURAT IZIN -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">
				<b class="red">SURAT IZIN MENGEMUDI &amp; IDENTITAS</b>
				<table class="table table-responsive">
					<thead>
						<tr>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><b>KTP</b></td>
						</tr>
						<tr>
							<td>Nomor</td>
							<td><?=$detail_ktp->plisence_number?></td>
						</tr>
						<tr>
							<td>Diterbitkan di</td>
							<td><?=$detail_ktp->city_name?></td>
						</tr>
						<tr>
							<td>Masa Berlaku</td>
							<td>
								<?php
									$dateA = $detail_ktp->plisence_date_start;
									$dateB = $detail_ktp->plisence_date_end;

									$reformA = date("Y-m-d", strtotime($dateA));
									$reformB = date("Y-m-d", strtotime($dateB));

									if ($reformB === "1970-01-01") {
										echo "Seumur Hidup";
									} else {
										echo date_indo($reformA).'-'.date_indo($reformB);
									}
								?>
							</td>
						</tr>
						<?php
							foreach ($detail_sim as $row) {
								$dateC = $row->plisence_date_start;
								$dateD = $row->plisence_date_end;

								$reformC = date("Y-m-d", strtotime($dateC));
								$reformD = date("Y-m-d", strtotime($dateD));
								echo '
									<tr>
										<td><b>'.$row->plisence_type.'</b></td>
										<td></td>
									</tr>
									<tr>
										<td>Nomor</td>
										<td>'.$row->plisence_number.'</td>
									</tr>
									<tr>
										<td>Diterbitkan di</td>
										<td>'.$row->city_name.'</td>
									</tr>
									<tr>
										<td>Masa Berlaku</td>
										<td>'.date_indo($reformC).' S/d '.date_indo($reformD).'</td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		
		<!-- KELUARGA BESAR -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">KELUARGA BESAR</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<?php
							foreach ($detail_fambig as $row) {
								echo '
									<tr>
										<td><b>'.$row->fp_name.'</b></td>
										<td></td>
									</tr>
									<tr>
										<td>Nama</td>
										<td>'.$row->family_name.'</td>
									</tr>
									<tr>
										<td>Tempat & Tanggal Lahir</td>
										<td>'.$row->city_name.', '.date_indo($row->family_birth_date).'</td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>'.$row->family_gender.'</td>
									</tr>
									<tr>
										<td>Pendidikan</td>
										<td>'.$row->edutype_name.'</td>
									</tr>
									<tr>
										<td>Pekerjaan</td>
										<td>'.ucfirst($row->family_job).'</td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- KELUARGA INTI -->
		<?php
			$countfaminti = count($detail_faminti);
			$hidden1 = ($countfaminti !== 0) ? "" : "hidden";
		?>
		<div class="panel panel-primary panel-table <?=$hidden1;?>">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">KELUARGA INTI</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<?php
							if ($countfaminti !== 0) {
								foreach ($detail_faminti as $row) {
									echo '
										<tr>
											<td><b>'.$row->fp_name.'</b></td>
											<td></td>
										</tr>
										<tr>
											<td>Nama</td>
											<td>'.$row->family_name.'</td>
										</tr>
										<tr>
											<td>Tempat & Tanggal Lahir</td>
											<td>'.$row->city_name.', '.date_indo($row->family_birth_date).'</td>
										</tr>
										<tr>
											<td>Jenis Kelamin</td>
											<td>'.$row->family_gender.'</td>
										</tr>
										<tr>
											<td>Pendidikan</td>
											<td>'.$row->edutype_name.'</td>
										</tr>
										<tr>
											<td>Pekerjaan</td>
											<td>'.ucfirst($row->family_job).'</td>
										</tr>
									';
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<!-- PENDIDIKAN FORMAL -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">PENDIDIKAN FORMAL</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<?php
							foreach ($detail_edufor as $row) {
								echo '
									<tr>
										<td><b>'.$row->edutype_name.'</b></td>
										<td></td>
									</tr>
									<tr>
										<td>Nama Sekolah / P.T. / Univ.</td>
										<td>'.$row->edu_name.'</td>
									</tr>
									<tr>
										<td>Jurusan</td>
										<td>'.ucfirst($row->major_name).'</td>
									</tr>
									<tr>
										<td>Kota</td>
										<td>'.$row->city_name.'</td>
									</tr>
									<tr>
										<td>Tahun Lulus</td>
										<td>'.date("Y", strtotime($row->edu_tahun_lulus)).'</td>
									</tr>
									<tr>
										<td>Keterangan Lulus</td>
										<td>'.ucfirst($row->edu_keterangan).'</td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		
		<!-- PENDIDIKAN INFORMAL -->
		<?php
			$counteduinfor = count($detail_eduinfor);
			$hidden2 = ($counteduinfor !== 0) ? "" : "hidden";
		?>
		<div class="panel panel-primary panel-table <?=$hidden2;?>">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">PENDIDIKAN INFORMAL</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<?php
							$counteduinfor = count($detail_eduinfor);
							if ($counteduinfor !== 0) {
								foreach ($detail_eduinfor as $row) {
									echo '
										<tr>
											<td><b>'.$row->informaledu_name.'</b></td>
											<td></td>
										</tr>
										<tr>
											<td>Nama Institusi Penyelenggara</td>
											<td>'.$row->informaledu_tempat.'</td>
										</tr>
										<tr>
											<td>Masa Pelatihan</td>
											<td>'.date_indo($row->informaledu_dari).' S/d '.date_indo($row->informaledu_sampai).'</td>
										</tr>
										<tr>
											<td>Keterangan</td>
											<td>'.ucfirst($row->informaledu_keterangan).'</td>
										</tr>
									';
								}
							} else {
								echo "<td>Tidak ada data yang dapat ditampilkan.</td>";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- STATUS NIKAH -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">STATUS PERNIKAHAN</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<tr>
							<td>Status</td>
							<td><?=$detail_status->pstat_status;?></td>
						</tr>
						<?php
							$status  = $detail_status->pstat_status;
							$dateE   = $detail_status->pstat_date_marriage;
							$dateF   = $detail_status->pstat_date_divorce;
							
							$reformE = date("Y-m-d", strtotime($dateE));
							$reformF = date("Y-m-d", strtotime($dateF));
							if ($reformE == "1970-01-01") {
								$reformE = "-";
							} else {
								$reformE = date_indo($reformE);
							}
							if ($status == "Pernah Menikah") {
								echo '
									<tr>
										<td>Tanggal Menikah</td>
										<td>'.$reformE.'</td>
									</tr>
									<tr>
										<td>Tanggal Bercerai</td>
										<td>'.date_indo($reformF).'</td>
									</tr>
								';
							} elseif ($status == "Menikah") {
								echo '
									<tr>
										<td>Tanggal Menikah</td>
										<td>'.$reformE.'</td>
									</tr>
								';
							}

						?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- KERJAAN -->
		<?php
			$countjobhis = count($detail_jobhis);
			$hidden3 = ($countjobhis !== 0) ? "" : "hidden";
		?>
		<div class="panel panel-primary panel-table <?=$hidden3;?>">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">RIWAYAT PEKERJAAN</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<?php
							$countjobhis = count($detail_jobhis);
							if ($countjobhis !== 0) {
								foreach ($detail_jobhis as $row) {
									echo '
										<tr>
											<td><b>'.$row->pjobhistory_company.'</b></td>
											<td></td>
										</tr>
										<tr>
											<td>Bidang</td>
											<td>'.$row->sector_name.'</td>
										</tr>
										<tr>
											<td>Jabatan Awal</td>
											<td>'.ucfirst($row->pjobhistory_jabatan_awal).'</td>
										</tr>
										<tr>
											<td>Jabatan Akhir</td>
											<td>'.ucfirst($row->pjobhistory_jabatan_akhir).'</td>
										</tr>
										<tr>
											<td>Gaji Akhir</td>
											<td>'.$row->pjobhistory_gaji_akhir.'</td>
										</tr>
										<tr>
											<td>Masa Kerja</td>
											<td>'.date("d/m/Y", strtotime($row->pjobhistory_thn_start)).' S/d '.date("d/m/Y", strtotime($row->pjobhistory_thn_end)).'</td>
										</tr>
										<tr>
											<td>Alasan Keluar</td>
											<td>'.ucfirst($row->pjobhistory_reason).'</td>
										</tr>
									';
								}
							} else {
								echo "<td>Tidak ada data yang dapat ditampilkan.</td>";	
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- PERTANYAAN -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">PERTANYAAN</th>
							<th></th>
						</tr>
					</thead>				
					<tbody>
						<?php
							foreach ($detail_answer as $row) {
								echo '
									<tr>
										<td>
											'.$row->recquest_question.'<br />
											<b><i>Jawaban : '.$row->answer.'</i></b>
										</td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<!-- PERTANYAAN -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">
				<b class="red">BERKAS - BERKAS</b>
				<table class="table table-responsive">
					<thead>
						<tr>
							<th>Jenis</th>
							<th>Berkas</th>
						</tr>
					</thead>				
					<tbody>
						<?php
							foreach ($detail_lisence as $row) {
								echo '
									<tr>
										<td>'.$row->plisence_type.'</td>
										<td><a class="btn btn-xs btn-red" href="#" data-toggle="modal" data-target="#modal-view-berkas'.$row->plisence_id.'">Lihat</a></td>
									</tr>
								';
							}
							foreach($detail_jobhis as $row){
								echo '
									<tr>
										<td>'.$row->pjobhistory_company.'</td>
										<td><a class="btn btn-xs btn-red" href="#" data-toggle="modal" data-target="#modal-view-job-berkas'.$row->pjobhistory_id.'">Lihat</a></td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
			</div>
			<div class="panel-footer">
				<a class="btn btn-primary" href="<?php echo site_url()?>detail_berkas/<?=$this->encrypt->encode($detail_people->people_id);?>"
   onclick="window.open(this.href,'targetWindow',
                                   'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600');
 return false;">Pratinjau
				<i class="entypo-print"></i></a>
			</div>
		</div>
	</div>
</div>

<!-- MODAL VIEW DOKUMEN -->
<?php foreach($detail_lisence as $row){ ?>
<div class="modal fade all-modals" id="modal-view-berkas<?=$row->plisence_id;?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="entypo-search"></i> Lihat Dokumen</h4>
			</div>
			<div class="modal-body text-center">
				<?php 
					echo '<img src="'.site_url().'hrDepartment/cdetail/sysdetailpeople/show_lisence/'.$row->plisence_id.'" "width="100%" class="img-responsive img-thumbnail"  />';
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-icon" data-dismiss="modal">
					Tutup
					<i class="entypo-cancel"></i>
				</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<?php foreach($detail_jobhis as $row){ ?>
<div class="modal fade all-modals" id="modal-view-job-berkas<?=$row->pjobhistory_id;?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><i class="entypo-search"></i> Lihat Dokumen</h4>
			</div>
			<div class="modal-body text-center">
				<?php 
					echo '<img src="'.site_url().'hrDepartment/cdetail/sysdetailpeople/show_job_lisence/'.$row->pjobhistory_id.'" "width="100%" class="img-responsive img-thumbnail"  />';
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-icon" data-dismiss="modal">
					Tutup
					<i class="entypo-cancel"></i>
				</button>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<script type="text/javascript">
	jQuery(document).ready(function(){
	    jQuery("body").append( jQuery(".page-container .all-modals") );
	});

	function gagalberkas(pelamar_id){
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah pelamar ini tidak lolos seleksi berkas ?",
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: '#FF6666',
	        confirmButtonText: 'Ya, Setuju',
	        cancelButtonText: "Batal",
	        confirmButtonClass: "btn-danger",
	        closeOnConfirm: false,
	        closeOnCancel: true
	    },

		function() {
			$.ajax({
				url: "<?php echo site_url()?>gagalberkas/",
				type: "post",
				data: {pelamar_id:pelamar_id},
				success:function(){
					swal({
					  title: "Good job!",
					  text: "Pelamar berhasil digagalkan",
					  icon: "success",
					  button: "Aww yiss!",
					});
				},
				error:function(){
					swal("Oops", "error");
				}
			})
        });
        return false;
  	};
</script>