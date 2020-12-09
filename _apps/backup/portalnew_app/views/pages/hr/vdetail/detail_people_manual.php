<h4 style="margin-top: 0;"><span class="label label-primary">DETAIL LENGKAP PELAMAR</span></h4>

<div class="profile-env">
	<header class="row">
		<div class="col-md-9">
			<ul class="profile-info-sections">
				<li>
					<div class="profile-name">
						<strong>
							<a href="#"><?=ucwords($detail_people->people_fullname);?></a>
							<a href="#" class="user-status tooltip-primary" data-toggle="tooltip" data-placement="top" data-original-title="Online"></a>
						</strong>
						<span><a href="#">Terdatar pada tanggal : <?=date("d-m-Y", strtotime($detail_people->reg_date))?></a></span>
					</div>
				</li>
				<li>
					<div class="profile-stat">
						<h4><?=$detail_people->people_noreg;?></h4>
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
				
				<a target="_blank" href="<?=site_url()?>downloadPdf/<?=$detail_people->people_id;?>" class="btn btn-default">
					<i class="entypo-print"></i>
				</a>
			</div>
		</div>
	</header>
	<?php
		$link = $this->input->post("link");
	?>
</div>
<hr>
<div class="row">
	<div class="col-md-6">
		<!-- DATA DIRI -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">DATA PRIBADI</th>
							<th><button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-edit-personal" data-id="<?=$detail_people->people_id;?>" data-name="<?=$detail_people->people_fullname;?>" data-birthplace="<?=$detail_people->people_birth_place;?>" data-birthdate="<?=date("d-m-Y", strtotime($detail_people->people_birth_date));?>" data-phone="<?=$detail_people->people_mobile;?>" data-submit="<?=date("d-m-Y", strtotime($detail_people->tgl_melamar));?>" data-gender="<?=$detail_people->people_gender;?>" data-noreg="<?=$detail_people->people_noreg;?>"><i class="entypo-pencil"></i></button></th>
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
							<td>TTL</td>
							<td><?=$detail_people->people_birth_place;?>, <?=date("d-m-Y", strtotime($detail_people->people_birth_date));?></td>
						</tr>
						<tr>
							<td>No. Telepon / Handphone</td>
							<td><?=$detail_people->people_mobile;?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<!-- ALAMAT -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">	
				<table class="table table-responsive">
					<thead>
						<tr>
							<th class="red">ALAMAT</th>
							<th><button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-edit-alamat" data-id="<?=$detail_people->people_id;?>" data-noreg="<?=$detail_people->people_noreg;?>" data-address="<?=$detail_address->address;?>" data-kota="<?=$detail_address->city;?>" data-postal="<?=$detail_address->zip_code;?>" ><i class="entypo-pencil"></i></button></th>
						</tr>
					</thead>				
					<tbody>
						<tr>
							<td rowspan="1" class="col-sm-3"><b>DOMISILI / ASAL</b></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><?=$detail_address->address;?></td>
						</tr>
						<tr>
							<td>Kota</td>
							<td><?=$detail_address->city;?></td>
						</tr>
						<tr>
							<td>Kode Pos</td>
							<td><?=$detail_address->zip_code;?></td>
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
				<button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-edit-lisensi" data-id="<?=$detail_people->people_id;?>" data-noreg="<?=$detail_people->people_noreg;?>"  ><i class="entypo-plus"></i></button>
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
							<td><?=$detail_ktp->lisence_number;?></td>
						</tr>
						<tr>
							<td>Masa Berlaku</td>
							<td>
								<?php
									$date = $detail_ktp->lisence_period;
									if ($date == null) {
										echo "Seumur Hidup";
									} else {
										echo date("d-m-Y", strtotime($date));
									}
								?>
							</td>
						</tr>
						<?php
							foreach ($detail_sim as $row) {
								$date_period = $row->lisence_period;
								echo '
									<tr>
										<td><b>'.$row->lisence_type.'</b></td>
										<td></td>
									</tr>
									<tr>
										<td>Nomor</td>
										<td>'.$row->lisence_number.'</td>
									</tr>
									<tr>
										<td>Masa Berlaku</td>
										<td>'.date("d-m-Y", strtotime($date_period)).'</td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<!-- SKILL -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">
				<b class="red">SKILL / KEMAMPUAN</b>
				<button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-edit-skill" data-id="<?=$detail_people->people_id;?>" ><i class="entypo-pencil"></i></button>
				<table class="table table-responsive">
					<thead>
						<tr>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$countSkill = count($detail_skill);
							if ($countSkill == 0) {
								echo "<tr>
										<td>Tidak ada data kemampuan</td>
									</tr>";
							} else {
								$no = 0;
								foreach ($detail_skill as $row) {
									$no++;
									echo '
										<tr>
											<td>No</td>
											<td>'.$no.'</td>
										</tr>
										<tr>
											<td>Nama Kemampuan</td>
											<td>'.$row->skill_name.'</td>
										</tr>
										<tr>
											<td>Nama Unit</td>
											<td>'.$row->skill_unit.'</td>
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
</div>

<div class="row">
	<div class="col-md-6">
		<!-- PENGALAMAN -->
		<div class="panel panel-primary panel-table">
			<div class="panel-body">
				<b class="red">PENGALAMAN</b>
				<button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#modal-edit-exp" data-id="<?=$detail_people->people_id;?>" ><i class="entypo-pencil"></i></button>
				<table class="table table-responsive">
					<thead>
						<tr>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 0;
							foreach ($detail_exp as $row) {
								$no++;

								$date1    = new DateTime($row->start_date);
				                $date2    = new DateTime($row->end_date);
				                $interval = $date1->diff($date2);

				                $tahun = "%y";
				                $bulan = "%m";

				                if ($interval->format($tahun) == 0) {
				                	$year = "";
				                } else {
				                	$year = $tahun.' Tahun';
				                }

				                if ($interval->format($bulan) == 0) {
				                	$month = "";
				                } else {
				                	$month = $bulan.' Bulan';
				                }

								echo '
									<tr>
										<td>No.</td>
										<td>'.$no.'</td>
									</tr>
									<tr>
										<td>Nama Perusahaan</td>
										<td>'.$row->company_name.'</td>
									</tr>
									<tr>
										<td>Dari Tahun</td>
										<td>'.date("d-m-Y", strtotime($row->start_date)).'</td>
									</tr>
									<tr>
										<td>Sampai Tahun</td>
										<td>'.date("d-m-Y", strtotime($row->end_date)).'</td>
									</tr>
									<tr>
										<td>Total Masa Kerja</td>
										<td>'.$interval->format(''.$year.' '.$month.'').'</td>
									</tr>
								';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<!-- HISTORY INTERVIEW -->
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title"><b class="red">RIWAYAT INTERVIEW</b></div>
			</div>
				
			<table id="table-interview" class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>#</th>
						<th>Trainer</th>
						<th>Tgl Melamar</th>
						<th>Tgl Interview/Teori</th>
						<th>Tgl Praktek</th>
						<th>Site</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	<!-- <div class="col-md-6">
		<div class="panel panel-primary panel-table">
			<div class="panel-body">
				<b class="red">CETAK BERKAS</b>
				<table class="table table-responsive">
					<thead>
						<tr>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<a class="btn btn-primary" href="<?=site_url()?>detail_berkas_manual/<?=$detail_people->people_noreg;?>"
			onclick="window.open(this.href,'targetWindow',
			                               'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=800,height=600');
			return false;">Pratinjau
								<i class="entypo-print"></i></a>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div> -->
</div>

<div id="modal-edit-personal" class="modal all-modals modal-gray">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Pelamar</h4>
			</div>
			<form id="editpersonal" method="post" action="#" class="validate">
				<div class="modal-body">
					<input type="hidden" name="people_id" id="people_id">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Lengkap</label>
								<input class="form-control required alpha" name="fullname" id="fullname"/>
							</div>
							<div class="form-group">
								<label class="control-label">Tempat Lahir</label>
		                        <input type="text" name="birthplace" id="birthplace" class="form-control required alpha" maxlength="150" />
							</div>
							<div class="form-group">
								<label class="control-label">Jenis Kelamin</label>
								<select class="form-control required" name="gender" id="gender">
									<option value="">Pilih</option>
									<option value="L">Laki - laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Tanggal Lahir</label>
								<input class="form-control required" name="birthdate" id="birthdate" data-mask="date" />
							</div>
							<div class="form-group">
								<label class="control-label">Nomor HP</label>
								<input class="form-control required num" maxlength="14" name="mobilephone" id="mobilephone" />
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Batal</button>
					<button class="btn btn-sm btn-primary" type="button" id="btn_edit_personal">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal-edit-alamat" class="modal all-modals modal-gray">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Alamat</h4>
			</div>
			<form id="editpersonal" method="post" action="#" class="validate">
				<div class="modal-body">
					<input type="hidden" name="people_id" id="people_id">
					<div class="form-group">
						<label>Alamat</label>
						<textarea class="form-control required" name="address" id="address" rows="2" maxlength="200"></textarea>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Kota</label>
								<input type="text" name="city" id="city" class="form-control required" maxlength="150">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Kode Pos</label>
								<input type="text" name="zip_code" id="zip_code" data-mask="** ****" class="form-control required" maxlength="7">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Batal</button>
					<button class="btn btn-sm btn-primary" type="button" id="btn_edit_alamat">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal-edit-lisensi" class="modal all-modals modal-gray">
	<div class="modal-dialog modal60">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Data Pelamar</h4>
			</div>
			<form id="editpersonal" method="post" action="#" class="validate">
				<div class="modal-body">
					<input type="hidden" name="people_id" id="people_id">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Pilih jenis SIM</label>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<div class="checkbox">
												<input type="checkbox" value="1" id="simB1" name="simB1">
												<label>SIM B1</label>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class="checkbox">
												<input type="checkbox" value="2" id="simB2" name="simB2">
												<label>SIM B2</label>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class="checkbox">
												<input type="checkbox" value="3" id="simB1u" name="simB1u">
												<label>SIM B1 UMUM</label>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class="checkbox">
												<input type="checkbox" value="4" id="simB2u" name="simB2u">
												<label>SIM B2 UMUM</label>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<div class="checkbox">
												<input type="checkbox" value="5" id="simA" name="simA">
												<label>SIM A</label>
											</div>
										</div>
									</div>
								</div>
								
							</div>
						</div>								
					</div>
					
					<div class="sim-b1" style="display: none;">
						<div class="row">
							<div class="col-md-2">
								<label class="control-label">&nbsp;</label>
								<p class="text-right">
									<span class="label label-info">SIM B1</span>
								</p>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Nomor SIM</label>
									<input class="form-control num required" name="nosimB1" id="nosimB1" placeholder="Lisence number" maxlength="17" />
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Berlaku S/d</label>
									<input class="form-control required" name="periodsimB1" id="periodsimB1" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
								</div>
							</div>
						</div>
					</div>
					<div class="sim-b2" style="display: none;">
						<div class="row">
							<div class="col-md-2">
								<label class="control-label">&nbsp;</label>
								<p class="text-right">
									<span class="label label-info">SIM B2</span>
								</p>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Nomor SIM</label>
									<input class="form-control num required" name="nosimB2" id="nosimB2" placeholder="Lisence number" maxlength="17"  />
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Berlaku S/d</label>
									<input class="form-control required" name="periodsimB2" id="periodsimB2" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
								</div>
							</div>
						</div>
					</div>
					<div class="sim-b1u" style="display: none;">
						<div class="row">
							<div class="col-md-2">
								<label class="control-label">&nbsp;</label>
								<p class="text-right">
									<span class="label label-info">SIM B1 U</span>
								</p>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Nomor SIM</label>
									<input class="form-control num required" name="nosimB1u" id="nosimB1u" placeholder="Lisence number" maxlength="17" />
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Berlaku S/d</label>
									<input class="form-control required" name="periodsimB1u" id="periodsimB1u" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
								</div>
							</div>
						</div>
					</div>
					<div class="sim-b2u" style="display: none;">
						<div class="row">
							<div class="col-md-2">
								<label class="control-label">&nbsp;</label>
								<p class="text-right">
									<span class="label label-info">SIM B2 U</span>
								</p>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Nomor SIM</label>
									<input class="form-control num required" name="nosimB2u" id="nosimB2u" placeholder="Lisence number" maxlength="17" />
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Berlaku S/d</label>
									<input class="form-control required" name="periodsimB2u" id="periodsimB2u" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
								</div>
							</div>
						</div>
					</div>
					<div class="sim-A" style="display: none;">
						<div class="row">
							<div class="col-md-2">
								<label class="control-label">&nbsp;</label>
								<p class="text-right">
									<span class="label label-info">SIM A</span>
								</p>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Nomor SIM</label>
									<input class="form-control num required" name="nosimA" id="nosimA" placeholder="Lisence number" maxlength="17" />
								</div>
							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label class="control-label">Berlaku S/d</label>
									<input class="form-control required" name="periodsimA" id="periodsimA" data-mask="date" placeholder="Pre-formatted date" maxlength="10" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Batal</button>
					<button class="btn btn-sm btn-primary" type="button" id="btn_edit_personal">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal-edit-skill" class="modal all-modals modal-gray">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Pelamar</h4>
			</div>
			<form id="editpersonal" method="post" action="#" class="validate">
				<div class="modal-body">
					<input type="hidden" name="people_id" id="people_id">
				</div>
				<div class="modal-footer">
					<button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Batal</button>
					<button class="btn btn-sm btn-primary" type="button" id="btn_edit_personal">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal-edit-exp" class="modal all-modals modal-gray">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Ubah Data Pelamar</h4>
			</div>
			<form id="editpersonal" method="post" action="#" class="validate">
				<div class="modal-body">
					<input type="hidden" name="people_id" id="people_id">
				</div>
				<div class="modal-footer">
					<button class="btn btn-sm btn-default pull-left" data-dismiss="modal">Batal</button>
					<button class="btn btn-sm btn-primary" type="button" id="btn_edit_personal">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<style type="text/css">
	.dataTables_length { width: 5% !important; }
	td.details-control {
		background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
	  	cursor: pointer;
	}
	tr.shown td.details-control { background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center; }
	.page-body .select2-container .select2-choice {
		height: 32px !important;
		line-height: 31px !important;
	}
	.dataTables_filter{ display:none; }
	ul.ui-autocomplete { z-index: 9999; }
</style>

<script type="text/javascript">
	function format ( d ){
		return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-bordered no-margin">'+
		'<tr>'+
			'<td class="col-xs-4">Jabatan yang dilamar</td>'+
			'<td>'+d.jabatan+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Skor Teori</td>'+
			'<td>'+d.teori+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Skor Praktek I</td>'+
			'<td>'+d.praktek1+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Skor Praktek II</td>'+
			'<td>'+d.praktek2+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Skor Praktek III</td>'+
			'<td>'+d.praktek3+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Skor Praktek IV</td>'+
			'<td>'+d.praktek4+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Skor Praktek V</td>'+
			'<td>'+d.praktek5+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Skor Praktek Rata-rata</td>'+
			'<td>'+d.paverage+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Kesimpulan</td>'+
			'<td>'+d.conclusion+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Keterangan</td>'+
			'<td>'+d.conclusion_ket+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-4">Referensi</td>'+
			'<td>'+d.reference+'</td>'+
		'</tr>'+
		'</table>';
	}

	$(document).ready(function() {
		$('#jenjang, #trainer_nik, #interviewsite, #jabatan').select2({
			placeholder: "Pilih",
    		allowClear: true
		});

		$('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			todayBtn: true,
			timePicker: true,
			autoclose: true
		});

		$('.alpha').alphanum({allowNumeric: false});
		$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
		$('.alpnum').alphanum({
			allowNumeric: true,
			allow: ',.'
		});
		$('.scores').numeric({ allow: '.' });

		var table = $('#table-interview').DataTable( {
    		"processing" : true,
			"serverSide" : true,
			"order": [],
	        "bInfo": false,
			"bLengthChange": false,
			"ajax": {
				"url": '<?=site_url();?>hrDepartment/cdetail/sysdetailpeople/table_history_interview/<?=$this->encrypt->encode($detail_people->people_id);?>',
				"type": "POST",
	            error: function(data) { swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error"); }
		    },
		    "columns": [
		    	{
	               "className": 'details-control',
	               "data": null,
	               "defaultContent": '',
	               "orderable": false, 
	               "targets": 0
	            },
	            { "data": "trainer", "className": "text-center", "orderable": false },
	            { "data": "tgl_melamar", "className": "text-center", "orderable": false },
	            { "data": "tgl_interview", "className": "text-center", "orderable": false },
	            { "data": "tgl_praktek", "className": "text-center", "orderable": false },
	            { "data": "site", "className": "text-center", "orderable": false },
	        ],
			"language":{ "url":"<?=base_url()?>../bssmitlab/_assets/portal/js/datatables/lang/indonesian.json" },
		});

		$('#table-interview tbody').on('click', 'td.details-control', function () {
			var tr  = $(this).closest('tr'),
				row = table.row( tr );
			if ( row.child.isShown() ) {
				row.child.hide();
				tr.removeClass('shown');
			} else {
				row.child( format(row.data()) ).show();
				tr.addClass('shown');
			}
		});
	});

	jQuery(document).ready(function(){ jQuery("body").append( jQuery(".page-container .all-modals") ); });

	$( "#birthplace, #city" ).autocomplete({
      	source: "<?=site_url('getcity/?');?>"
    });

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

	// Input Mask
	if($.isFunction($.fn.inputmask)) {
		$("[data-mask]").each(function(i, el) {
			var $this = $(el),
				mask = $this.data('mask').toString(),
				opts = {
					numericInput: attrDefault($this, 'numeric', false),
					radixPoint: attrDefault($this, 'radixPoint', ''),
					rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
				},
				placeholder = attrDefault($this, 'placeholder', ''),
				is_regex = attrDefault($this, 'isRegex', '');
			
			if(placeholder.length) {
				opts[placeholder] = placeholder;
			}
			
			switch(mask.toLowerCase()) {
				case "phone":
					mask = "(999) 999-9999";
					break;
				case "currency":
				case "rcurrency":
					var sign = attrDefault($this, 'sign', '$');
					mask = "999,999,999.99";
					if($this.data('mask').toLowerCase() == 'rcurrency') {
						mask += ' ' + sign;
					} else {
						mask = sign + ' ' + mask;
					}
					opts.numericInput = true;
					opts.rightAlignNumerics = false;
					opts.radixPoint = '.';
					break;
				case "email":
					mask = 'Regex';
					opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";
					break;
				case "fdecimal":
					mask = 'decimal';
					$.extend(opts, {
						autoGroup	   : true,
						groupSize	   : 3,
						radixPoint	   : attrDefault($this, 'rad', '.'),
						groupSeparator : attrDefault($this, 'dec', ',')
					});
			}
			
			if(is_regex) {
				opts.regex = mask;
				mask = 'Regex';
			}
			
			$this.inputmask(mask, opts);
		});
	}

	$(function() {
		if(localStorage.simA   == null) localStorage.simA   = "false";
		if(localStorage.simB1  == null) localStorage.simB1  = "false";
		if(localStorage.simB2  == null) localStorage.simB2  = "false";
		if(localStorage.simB1U == null) localStorage.simB1U = "false";
		if(localStorage.simB2U == null) localStorage.simB2U = "false";
      	$('#simA')
	        .prop('checked', localStorage.simB1 == "true")
	        .on('change', function() {
	        localStorage.simA = this.checked;
	        if(localStorage.simA == "true") {
	            $('.sim-A').show();
	        } else {
	            $('.sim-A').hide();
	        }
	    }).trigger('change');
	        
	    $('#simB1')
	        .prop('checked', localStorage.simB1 == "true")
	        .on('change', function() {
	        localStorage.simB1 = this.checked;
	        if(localStorage.simB1 == "true") {
	            $('.sim-b1').show();
	        } else {
	            $('.sim-b1').hide();
	        }
	    }).trigger('change');

	    $('#simB2')
	        .prop('checked', localStorage.simB2 == "true")
	        .on('change', function() {
	        localStorage.simB2 = this.checked;
	        if(localStorage.simB2 == "true") {
	            $('.sim-b2').show();
	        } else {
	            $('.sim-b2').hide();
	        }
	    }).trigger('change');

	    $('#simB1u')
	        .prop('checked', localStorage.simB1u == "true")
	        .on('change', function() {
	        localStorage.simB1u = this.checked;
	        if(localStorage.simB1u == "true") {
	            $('.sim-b1u').show();
	        } else {
	            $('.sim-b1u').hide();
	        }
	    }).trigger('change');

	    $('#simB2u')
	        .prop('checked', localStorage.simB2u == "true")
	        .on('change', function() {
	        localStorage.simB2u = this.checked;
	        if(localStorage.simB2u == "true") {
	            $('.sim-b2u').show();
	        } else {
	            $('.sim-b2u').hide();
	        }
	    }).trigger('change');
	});

	$('#modal-edit-personal').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button         = $(event.relatedTarget) 
			var id             = button.data('id')
			var name           = button.data('name')
			var birthplace     = button.data('birthplace')
			var birthdate      = button.data('birthdate')
			var phone          = button.data('phone')
			var submit 		   = button.data('submit')
			var gender         = button.data('gender')
			var jabatan        = button.data('jabatan')
			var noreg          = button.data('noreg')
			var modal          = $(this)
			modal.find('.modal-title').text('Ubah Personal : ' + noreg)
			modal.find('#people_id').val(id)
			modal.find('#fullname').val(name)
			modal.find('#birthplace').val(birthplace)
			modal.find('#birthdate').val(birthdate)
			modal.find('#mobilephone').val(phone)
			modal.find('#submissiondate').val(submit)
			$("#gender option[value="+gender+"]").prop('selected', true);
			modal.find('#position').val(jabatan)
			$('#jabatan').val('PRD020').trigger('change');
		}
	});

	$('#modal-edit-alamat').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button  = $(event.relatedTarget) 
			var id      = button.data('id')
			var noreg   = button.data('noreg')
			var address = button.data('address')
			var kota    = button.data('kota')
			var postal  = button.data('postal')
			var modal   = $(this)
			modal.find('.modal-title').text('Ubah Alamat : ' + noreg)
			modal.find('#people_id').val(id)
			modal.find('#address').val(address)
			modal.find('#city').val(kota)
			modal.find('#zip_code').val(postal)
		}
	});

	$('#modal-edit-lisensi').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button  = $(event.relatedTarget) 
			var id      = button.data('id')
			var noreg   = button.data('noreg')
			var modal   = $(this)
			modal.find('.modal-title').text('Tambah Lisensi & ID : ' + noreg)
			modal.find('#people_id').val(id)
		}
	});
</script>