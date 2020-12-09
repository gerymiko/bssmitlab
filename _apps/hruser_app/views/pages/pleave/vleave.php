<section class="content-header">
  <h1>PENGAJUAN <b>CUTI</b>
    <small><em>Human Resource Department System</em></small>
  </h1>
</section>

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box box-default">
				<div class="box-header">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Data Karyawan</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body no-padding">
					<table class="table table-striped">
						<tbody>
							<tr>
								<td>NIK</td>
								<td><?=$dkaryawan->NIK;?></td>
							</tr>
							<tr>
								<td>Nama</td>
								<td><?=$dkaryawan->Nama;?></td>
							</tr>
							<tr>
								<td>Jabatan</td>
								<td><?=$dkaryawan->jabatan;?></td>
							</tr>
							<tr>
								<td>Departemen</td>
								<td><?=$dkaryawan->departemen;?></td>
							</tr>
							<tr>
								<td>SITE</td>
								<td><?=$dkaryawan->KodeST;?></td>
							</tr>
							<tr>
								<td>POH</td>
								<td><?=$dkaryawan->POH;?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-default">
				<div class="box-header">
					<i class="ion ion-clipboard"></i>
					<h3 class="box-title">Jenis Cuti</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<form id="myForm">
					<div class="box-body">
						<ul class="todo-list">
							<li>
								<input type="radio" class="minimal" name="jenis_cuti" value="#modal-rooster" checked="checked">
								<span class="text">Cuti Rooster</span>
							</li>
							<li>
								<input type="radio" class="minimal" name="jenis_cuti" value="#modal-besar">
								<span class="text">Cuti Besar</span>
							</li>
							<li>
								<input type="radio" class="minimal" name="jenis_cuti" value="#modal-lahir">
								<span class="text">Cuti Melahirkan</span>
							</li>
						</ul>
					</div>
					<div class="box-footer clearfix no-border">
						<button id="btn-pengajuan" type="button" class="btn btn-sm btn-warning pull-right btn-flat" data-toggle="modal" data-target="#modal-rooster" data-backdrop="static" data-keyboard="false"><em>Buat Pengajuan</em></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Riwayat Cuti</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="slider-table">
						<table id="table_history_cuti" class="table table-bordered table-hover">
							<thead class="bg-purple-active">
								<tr>
									<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
									<th>No</th>
									<th>No. Dok</th>
									<th>Tgl Pengajuan</th>
									<th>Jml Hari</th>
									<th>Cuti Tahunan</th>
									<th>Tgl Mulai</th>
									<th>Tgl Akhir</th>
									<th>Permohonan</th>
									<th>Penegasan</th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal" id="modal-rooster">
	<div class="modal-dialog modal70">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Cuti Rooster</h4>
			</div>
			<form id="form-cuti-rooster" action="<?=site_url();?>cleave/sysleave/save_cuti_rooster" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Dari Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_awal" id="tgl_awal" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="selama" id="selama" class="form-control _CnUmB required" max="<?=$dperiode->Lama_Cuti;?>" maxlength="2">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Cuti Tahunan (hari) <a data-toggle="popover" title="Informasi" data-content="Cuti tahunan hanya dapat diambil bersama dengan cuti rooster dan izin" tabindex="0" data-trigger="focus" data-placement="bottom"><i class="far fa-question-circle hand"></i></a></label>
								<div class="input-group">
			                        <span class="input-group-addon">
			                        	<input type="checkbox" name="cuti_tahunan" id="cuti_tahunan" >
			                        </span>
			                    	<input type="text" name="CutiThn" id="CutiThn" class="form-control" maxlength="1" readonly="readonly">
			                  	</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Sampai Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="form-control pull-right required" name="tgl_akhir" id="tgl_akhir" maxlength="10" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label>Kembali Bekerja</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="form-control pull-right required" readonly="readonly" name="tgl_kerja" id="tgl_kerja" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="site" id="site">
										<option></option>
										<?php
											foreach ($list_site as $row) {
												echo '<option value="'.$row->KodeST.'">'.$row->KodeST.' - '.$row->Nama.'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Total Cuti (hari)</label>
								<input type="text" class="form-control" name="total_cuti" id="total_cuti" maxlength="7" readonly="readonly">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?php
									$tipe = $dperiode->Tipe;
									if ($tipe == 3) {
										$tperiod = "3 months";
									} elseif ($tipe == 2) {
										$tperiod = "6 months";
									} else {
										$tperiod = $dperiode->Periode_Cuti." months";
									}
								?>
								<label>Periode Sekarang</label><br>
								<input type="radio" class="minimal required" name="periode_cuti" value="p1" checked="checked">
								
								<input type="hidden" name="pcuti1_awal" value="<?=date("d-m-Y", strtotime($dperiode->TglAkhir));?>">
								<input type="hidden" name="pcuti1_akhir" value="<?=date("d-m-Y", strtotime("+".$tperiod."", strtotime($dperiode->TglAkhir)));?>">

								<span class="padding5"><b><?=date("d-m-Y", strtotime($dperiode->TglAkhir));?></b> s.d. <b><?=date("d-m-Y", strtotime("+".$tperiod."", strtotime($dperiode->TglAkhir)));?></b></span>
							</div>
						</div>
						<div class="col-md-6">
							<label>Periode Selanjutnya</label><br>
							<?php $periode2 = date("d-m-Y", strtotime("+".$tperiod."", strtotime($dperiode->TglAkhir)));?>

							<input type="radio" class="minimal" name="periode_cuti" value="p2">
							
							<input type="hidden" name="pcuti2_awal" value="<?=$periode2;?>">
							<input type="hidden" name="pcuti2_akhir" value="<?=date("d-m-Y", strtotime("+".$tperiod."", strtotime($periode2)));?>">

							<span class="padding5"><b><?=$periode2;?></b> s.d. <b><?=date("d-m-Y", strtotime("+".$tperiod."", strtotime($periode2)));?></b></span>
						</div>
					</div>
					<div class="form-group">
						<label>Petugas Pengganti <a data-toggle="popover" title="Informasi" data-content="Batas petugas pengganti adalah 3 orang." tabindex="0" data-trigger="focus" data-placement="right"><i class="far fa-question-circle hand"></i></a></label>
						<select class="form-control required" multiple="multiple" name="ptgs_pengganti[]" id="ptgs_pengganti" data-placeholder="Cari Nama">
							<?php
								foreach ($list_karyawan as $row) {
									echo '<option value="'.$row->NIK.'">'.$row->NaKar.' - '.$row->jabatan.'</option>';
								}
							?>
						</select>
					</div>
					<div style="padding: 15px;"></div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<input type="text" name="outstanding_tugas[]" id="outstanding_tugas" class="form-control _CalPhaNum required">
						<div style="padding: 1px;"></div>
						<div class="input_fields_wrap"></div>
					</div>
					<a class="add_field_button btn btn-xs btn-primary" href="#"><em>+ Tambahkan outstanding tugas</em></a><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<button type="button" id="btn_rooster" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-besar">
	<div class="modal-dialog modal70">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Cuti Besar</h4>
			</div>
			<form id="form-cuti-besar" action="<?=site_url();?>cleave/sysleave/save_cuti_besar" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Dari Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_awal2" id="tgl_awal2" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Sampai Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_akhir2" id="tgl_akhir2" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="selama2" id="selama2" class="form-control _CnUmB required" maxlength="2" readonly="readonly">
								<div id="daymax" class="red hidden">Maksimal 25 hari</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Kembali Bekerja</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="form-control pull-right" readonly="readonly" name="tgl_kerja2" id="tgl_kerja2" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="site2" id="site2">
										<option></option>
										<?php
											foreach ($list_site as $row) {
												echo '<option value="'.$row->KodeST.'">'.$row->KodeST.' - '.$row->Nama.'</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Petugas Pengganti <a data-toggle="popover" title="Informasi" data-content="Batas petugas pengganti adalah 3 orang." tabindex="0" data-trigger="focus" data-placement="right"><i class="far fa-question-circle"></i></a></label>
						<select class="form-control required" multiple="multiple" name="ptgs_pengganti2[]" id="ptgs_pengganti2" data-placeholder="Cari Nama">
							<?php
								foreach ($list_karyawan as $row) {
									echo '<option value="'.$row->NIK.'">'.$row->NaKar.' - '.$row->jabatan.'</option>';
								}
							?>
						</select>
					</div>
					<div style="padding: 15px"></div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<input type="text" name="outstanding_tugas2[]" id="outstanding_tugas2" class="form-control _CalPhaNum required">
						<div style="padding: 1px;"></div>
						<div class="input_fields_wrap2"></div>
					</div>
					<a class="add_field_button2 btn btn-xs btn-primary" href="#"><em>+ Tambahkan outstanding tugas</em></a>
					<br><br>
					<?php
						$d1   = new DateTime($dcutikaryawan->Tgl_Masuk);
						$d2   = new DateTime(date("Y-m-d"));
						$diff = $d2->diff($d1);

						$a = $diff->y % 5;
						$b = $diff->m;

						if ( $a == 0 && $b == 0 ) {
					        $hidden = '<button type="button" id="btn_besar" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>';
						} else {
							echo '<div class="callout callout-danger">
					                <p>Anda belum dapat mengambil cuti besar.</p>
					              </div>';
					        $hidden = '';
						}
					?>
					Keterangan:
					<ol>
						<li>Karyawan dengan masa kerja telah mencapai 5 tahun bekerja tanpa terputus/pemutihan.</li>
						<li>Cuti besar dapat diambil dikelipatan 5 tahun berikutnya.</li>
						<li>Maksimal hari untuk cuti besar adalah 25 hari berturut-turut dan tidak boleh melebihi batas maksimal hari.</li>
						<li>Karyawan dapat mengambil cuti besar kurang dari maksimal hari (25 hari) dengan tidak ada penggantian pembayaran kompensasi untuk sisa hari cutinya.</li>
					</ol>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<?=$hidden;?>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-lahir">
	<div class="modal-dialog modal70">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Cuti Melahirkan</h4>
			</div>
			<form id="form-cuti-melahirkan" action="<?=site_url();?>cleave/sysleave/save_cuti_melahirkan" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Dari Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_awal3" id="tgl_awal3" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Sampai Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_akhir3" id="tgl_akhir3" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="selama3" id="selama3" class="form-control _CnUmB required" readonly="readonly">
								<div id="daymax2" class="red hidden">Maksimal 45 hari</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Kembali Bekerja</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="form-control pull-right" readonly="readonly" name="tgl_kerja3" id="tgl_kerja3" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="site3" id="site3">
										<option></option>
										<?php
											foreach ($list_site as $row) {
												echo '<option value="'.$row->KodeST.'">'.$row->KodeST.' - '.$row->Nama.'</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Petugas Pengganti <a data-toggle="popover" title="Informasi" data-content="Batas petugas pengganti adalah 3 orang." tabindex="0" data-trigger="focus" data-placement="right"><i class="far fa-question-circle"></i></a></label>
						<select class="form-control required" multiple="multiple" name="ptgs_pengganti3[]" id="ptgs_pengganti3" data-placeholder="Cari Nama">
							<?php
								foreach ($list_karyawan as $row) {
									echo '<option value="'.$row->NIK.'">'.$row->NaKar.' - '.$row->jabatan.'</option>';
								}
							?>
						</select>
					</div>
					<div style="padding: 15px;"></div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<input type="text" name="outstanding_tugas3[]" id="outstanding_tugas3" class="form-control _CalPhaNum required">
						<div class="input_fields_wrap3"></div>
					</div>
					<a class="add_field_button3 btn btn-xs btn-primary" href="#"><em>+ Tambahkan outstanding tugas</em></a>
					<br><br>
					<?php
						if ($dcutikaryawan->JK == "L") {
							echo '<div class="callout callout-danger">
					                <p>Cuti melahirkan hanya dikhususkan untuk karyawan perempuan.</p>
					              </div>';
					        $hidden_birth = '';
						} else {
							$hidden_birth = '<button type="button" id="btn_melahirkan" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>';
						}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<?=$hidden_birth;?>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-rooster">
	<div class="modal-dialog modal70">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<form id="form-edit-rooster" action="<?=site_url();?>cleave/sysleave/save_edit_rooster" method="post">
				<input type="hidden" name="nodoc" id="nodoc_edit">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Dari Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_awal_edit" id="tgl_awal_edit" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="selama_edit" id="selama_edit" class="form-control _CnUmB required" max="<?=$dperiode->Lama_Cuti;?>" maxlength="2">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Cuti Tahunan (hari) <a data-toggle="popover" title="Informasi" data-content="Cuti tahunan hanya dapat diambil bersama dengan cuti rooster" tabindex="0" data-trigger="focus" data-placement="bottom"><i class="far fa-question-circle hand"></i></a></label>
								<div class="input-group">
			                        <span class="input-group-addon">
			                        	<input type="checkbox" name="cuti_tahunan_edit" id="cuti_tahunan_edit">
			                        </span>
			                    	<input type="text" name="CutiThn_edit" id="CutiThn_edit" class="form-control" maxlength="1" readonly="readonly">
			                  	</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Sampai Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="form-control pull-right required" name="tgl_akhir_edit" id="tgl_akhir_edit" maxlength="10" readonly="readonly">
								</div>
							</div>
							<div class="form-group">
								<label>Kembali Bekerja</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="form-control pull-right required" name="tgl_kerja_edit" id="tgl_kerja_edit" maxlength="10" readonly="readonly">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="site_edit" id="site_edit">
										<option></option>
										<?php
											foreach ($list_site as $row) {
												echo '<option value="'.$row->KodeST.'">'.$row->KodeST.' - '.$row->Nama.'</option>';
											}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Total Cuti (hari)</label>
								<input type="text" class="form-control" name="total_cuti_edit" id="total_cuti_edit" maxlength="2" readonly="readonly">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<?php
									$tipe = $dperiode->Tipe;
									if ($tipe == 3) {
										$tperiod = "2 months";
									} elseif ($tipe == 2) {
										$tperiod = "5 months";
									} else {
										$tperiod = $dperiode->Periode_Cuti." months";
									}
								?>
								<label>Periode Sekarang</label><br>
								<input type="radio" class="minimal required" name="periode_cuti_edit" value="p1e" checked="checked">
								<input type="hidden" name="pcuti1_awal_edit" value="<?=date("d-m-Y", strtotime($dperiode->TglAkhir));?>">
								<input type="hidden" name="pcuti1_akhir_edit" value="<?=date("d-m-Y", strtotime("+".$tperiod."", strtotime($dperiode->TglAkhir)));?>">
								<span class="padding5"><b><?=date("d-m-Y", strtotime($dperiode->TglAkhir));?></b> s.d. <b><?=date("d-m-Y", strtotime("+".$tperiod."", strtotime($dperiode->TglAkhir)));?></b></span>
							</div>
						</div>
						<div class="col-md-6">
							<label>Periode Selanjutnya</label><br>
							<?php $periode2 = date("d-m-Y", strtotime("+".$tperiod."", strtotime($dperiode->TglAkhir)));?>
							<input type="radio" class="minimal" name="periode_cuti_edit" value="p2e">
							<input type="hidden" name="pcuti2_awal_edit" value="<?=$periode2;?>">
							<input type="hidden" name="pcuti2_akhir_edit" value="<?=date("d-m-Y", strtotime("+".$tperiod."", strtotime($periode2)));?>">
							<span class="padding5"><b><?=$periode2;?></b> s.d. <b><?=date("d-m-Y", strtotime("+".$tperiod."", strtotime($periode2)));?></b></span>
						</div>
					</div>
					<div class="form-group">
						<label>Petugas Pengganti <a data-toggle="popover" title="Informasi" data-content="Batas petugas pengganti adalah 3 orang." tabindex="0" data-trigger="focus" data-placement="right"><i class="far fa-question-circle hand"></i></a></label>
						<select class="form-control required" multiple="multiple" name="ptgs_pengganti_edit[]" id="ptgs_pengganti_edit" data-placeholder="Cari Nama">
							<?php
								foreach ($list_karyawan as $row) {
									echo '<option value="'.$row->NIK.'">'.$row->NaKar.' - '.$row->jabatan.'</option>';
								}
							?>
						</select>
					</div>
					<div style="padding: 15px"></div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<table id="table_job_pending" class="table no-padding">
							<thead>
								<th>0</th>
								<th>1</th>
								<th>2</th>
							</thead>
						</table>
					</div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<div class="jobpending_rooster_edit_content"></div>
					</div>
					<a class="add_field_eroos btn btn-xs btn-primary" href="#"><em>+ Tambahkan outstanding tugas</em></a><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<button type="button" id="btn_rooster_edit" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-besar">
	<div class="modal-dialog modal70">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Cuti Besar</h4>
			</div>
			<form id="form-edit-cutibesar" action="<?=site_url();?>cleave/sysleave/save_edit_cutibesar" method="post">
				<input type="hidden" name="nodoc" id="nodoc_e5th">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Dari Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_awal2_edit" id="tgl_awal2_edit" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Sampai Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_akhir2_edit" id="tgl_akhir2_edit" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="selama2_edit" id="selama2_edit" class="form-control _CnUmB required" readonly="readonly">
								<div id="daymax2_edit" class="red hidden">Maksimal 25 hari</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Kembali Bekerja</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="form-control pull-right" readonly="readonly" name="tgl_kerja2_edit" id="tgl_kerja2_edit" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="site2_edit" id="site2_edit">
										<option></option>
										<?php
											foreach ($list_site as $row) {
												echo '<option value="'.$row->KodeST.'">'.$row->KodeST.' - '.$row->Nama.'</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Petugas Pengganti <a data-toggle="popover" title="Informasi" data-content="Batas petugas pengganti adalah 3 orang." tabindex="0" data-trigger="focus" data-placement="right"><i class="far fa-question-circle"></i></a></label>
						<select class="form-control required" multiple="multiple" name="ptgs_pengganti2_edit[]" id="ptgs_pengganti2_edit" data-placeholder="Cari Nama">
							<?php
								foreach ($list_karyawan as $row) {
									echo '<option value="'.$row->NIK.'">'.$row->NaKar.' - '.$row->jabatan.'</option>';
								}
							?>
						</select>
					</div>
					<div style="padding: 15px"></div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<table id="table_job_pending_5th" class="table no-padding">
							<thead>
								<th>1</th>
								<th>2</th>
							</thead>
						</table>
					</div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<div class="edit_content_jp_5th"></div>
					</div>
					<a class="add_btn_5th_edit btn btn-xs btn-primary" href="#"><em>+ Tambahkan outstanding tugas</em></a>
					<br><br>
					<?php
						$d1   = new DateTime($dcutikaryawan->Tgl_Masuk);
						$d2   = new DateTime(date("Y-m-d"));
						$diff = $d2->diff($d1);

						$a = $diff->y % 5;
						$b = $diff->m;

						if ( $a == 0 && $b == 0 ) {
					        $hidden = '<button type="button" id="btn_besar" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>';
						} else {
							echo '<div class="callout callout-danger">
					                <p>Anda belum dapat mengambil cuti besar.</p>
					              </div>';
					        $hidden = '';
						}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<?=$hidden;?>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-edit-lahir">
	<div class="modal-dialog modal70">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Cuti Melahirkan</h4>
			</div>
			<form id="form-edit-cutimelahirkan" action="<?=site_url();?>cleave/sysleave/save_edit_cutimelahirkan" method="post">
				<input type="hidden" name="nodoc" id="nodoc_birth">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Dari Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_awal3_edit" id="tgl_awal3_edit" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Sampai Tanggal</label>
								<div class="input-group date">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="datepicker form-control pull-right required" name="tgl_akhir3_edit" id="tgl_akhir3_edit" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="selama3_edit" id="selama3_edit" class="form-control required" readonly="readonly">
								<div id="daymax3_edit" class="red hidden">Maksimal 45 hari</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Kembali Bekerja</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
									<input type="text" class="form-control pull-right" readonly="readonly" name="tgl_kerja3_edit" id="tgl_kerja3_edit" maxlength="10">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="site3_edit" id="site3_edit">
										<option></option>
										<?php
											foreach ($list_site as $row) {
												echo '<option value="'.$row->KodeST.'">'.$row->KodeST.' - '.$row->Nama.'</option>';
											}
										?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Petugas Pengganti <a data-toggle="popover" title="Informasi" data-content="Batas petugas pengganti adalah 3 orang." tabindex="0" data-trigger="focus" data-placement="right"><i class="far fa-question-circle"></i></a></label>
						<select class="form-control required" multiple="multiple" name="ptgs_pengganti3_edit[]" id="ptgs_pengganti3_edit" data-placeholder="Cari Nama">
							<?php
								foreach ($list_karyawan as $row) {
									echo '<option value="'.$row->NIK.'">'.$row->NaKar.' - '.$row->jabatan.'</option>';
								}
							?>
						</select>
					</div>
					<div style="padding: 15px;"></div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<table id="table_job_pending_birth" class="table no-padding">
							<thead>
								<th>1</th>
								<th>2</th>
							</thead>
						</table>
					</div>
					<div class="form-group">
						<label>Outstanding Tugas</label>
						<div class="edit_content_jp_birth"></div>
					</div>
					<a class="add_btn_birth_edit btn btn-xs btn-primary" href="#"><em>+ Tambahkan outstanding tugas</em></a>
					<br><br>
					<?php
						if ($dcutikaryawan->JK == "L") {
							echo '<div class="callout callout-danger">
					                <p>Cuti melahirkan hanya dikhususkan untuk karyawan perempuan.</p>
					              </div>';
					        $hidden_birth = '';
						} else {
							$hidden_birth = '<button type="button" id="btn_melahirkan_edit" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>';
						}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<?=$hidden_birth;?>
				</div>
			</form>
		</div>
	</div>
</div>

<style type="text/css">
	td.details-control {
		background: url('<?=site_url();?>syslink/icon_detail/details_open') no-repeat center center;
	  	cursor: pointer;
	}
	tr.shown td.details-control {
	  	background: url('<?=site_url();?>syslink/icon_detail/details_close') no-repeat center center;
	}
	#table_job_pending, #table_job_pending_5th, #table_job_pending_birth thead { display: none; }
	#table_job_pending_paginate, #table_job_pending_5th_paginate, #table_job_pending_birth_paginate { display: none; }
</style>

<script type="text/javascript">

	function format ( d ) {
		var arrptgs  = d.ptgs;
		var itemptgs = [];
		
		var arrjob   = d.jobpending;
		var itemjp   = [];

		$.each( arrptgs, function( key, value ){ itemptgs.push( value.nama ); });

		$.each( arrjob, function( key, value ){ itemjp.push( value.keterangan ); });

		return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-bordered no-margin">'+
		'<tr>'+
			'<td class="col-xs-2">Periode Awal</td>'+
			'<td>'+d.periode1+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-2">Periode Akhir</td>'+
			'<td>'+d.periode2+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-2">Tgl Bekerja Kembali</td>'+
			'<td>'+d.tglmasuk+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-2">Petugas Pengganti</td>'+
			'<td>'+itemptgs.join(", ")+'</td>'+
		'</tr>'+
		'<tr>'+
		    '<td class="col-xs-2">Outstanding Tugas</td>'+
		    '<td>'+itemjp.join("<br> ")+'</td>'+
		'</tr>'+
		'</table>';
    }

    function delete_cuti(nopengajuancuti){
		var table = $('#table_history_cuti').DataTable();
	    swal({
	        title: "Konfirmasi",
	        text: "Apakah anda yakin ingin menghapus data pengajuan ini ?",
	        type: "warning",
	        showCancelButton: true,
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>cleave/sysleave/delete_cuti",
					type: "post",
					data: {nopengajuancuti:nopengajuancuti},
					success:function(){
						table.ajax.reload();
						swal("Naiss!", "Data berhasil dihapus", "success");
					},
					error:function(){
						table.ajax.reload();
						swal("Oops!", "Data gagal dihapus. Reload halaman ini kemudian coba lagi.", "error");
					},
				});
			}
        });
  	};

  	function editrooster(item){
		var id       = $(item).attr("data-id"),
			ctahunan = $(item).attr("data-cutitahunan"),
			arritemptgs = [];

		if (ctahunan == 3) {
			$('#cuti_tahunan_edit').prop('checked', true);
		} else {
			$('#cuti_tahunan_edit').prop('checked', false);
		}

		$.ajax({
			"url"  : '<?=site_url()?>cleave/sysleave/getPtgscuti/' +id ,
			"type" : 'POST',
			success: function(data){
				var itemPtgs = JSON.parse(data);
				$.each( itemPtgs, function( key, value ){
				   arritemptgs.push( value.nik ) ;
				});
				$("#ptgs_pengganti_edit").select2().val(arritemptgs).trigger('change.select2');
			}
		});

		var table2 = $('#table_job_pending').DataTable({
			"destroy": true,
			"processing": true,
			"serverSide": true,
			"autoWidth": false,
			"bFilter": false,
			"bLengthChange": false,
			"bInfo": false,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>cleave/sysleave/table_job_pending/' +id,
				"type" : 'POST',
			},
			"columns": [
	            { "data": "keterangan" },
	            { "data": "action" },
	        ],
	        "columnDefs": [
				{
					"targets": [ 1 ],
					"className": "text-right",
					"searchable": false,
					"orderable": false,
				},
				{
					"targets": [ 0 ],
					"className": "text-left",
					"searchable": false,
					"orderable": false,
				}
			]
		});
	}

	function editgreatleave(item){
		var id = $(item).attr("data-id"),
			arritemptgs = [];

		$.ajax({
			"url"  : '<?=site_url()?>cleave/sysleave/getPtgscuti/' +id ,
			"type" : 'POST',
			success: function(data){
				var itemPtgs = JSON.parse(data);
				$.each( itemPtgs, function( key, value ){
				   arritemptgs.push( value.nik ) ;
				});
				$("#ptgs_pengganti2_edit").select2().val(arritemptgs).trigger('change.select2');
			}
		});

		var table = $('#table_job_pending_5th').DataTable({
			"destroy": true,
			"processing": true,
			"serverSide": true,
			"autoWidth": false,
			"bFilter": false,
			"bLengthChange": false,
			"bInfo": false,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>cleave/sysleave/table_job_pending/' +id,
				"type" : 'POST',
			},
			"columns": [
	            { "data": "keterangan" },
	            { "data": "action" },
	        ],
	        "columnDefs": [
				{
					"targets": [ 1 ],
					"className": "text-right",
					"searchable": false,
					"orderable": false,
				},
				{
					"targets": [ 0 ],
					"className": "text-left",
					"searchable": false,
					"orderable": false,
				}
			]
		});
	}

	function editgivebirth(item){
		var id = $(item).attr("data-id"),
			arritemptgs = [];

		$.ajax({
			"url"  : '<?=site_url()?>cleave/sysleave/getPtgscuti/' +id ,
			"type" : 'POST',
			success: function(data){
				var itemPtgs = JSON.parse(data);
				$.each( itemPtgs, function( key, value ){
				   arritemptgs.push( value.nik ) ;
				});
				$("#ptgs_pengganti3_edit").select2().val(arritemptgs).trigger('change.select2');
			}
		});

		var table = $('#table_job_pending_birth').DataTable({
			"destroy": true,
			"processing": true,
			"serverSide": true,
			"autoWidth": false,
			"bFilter": false,
			"bLengthChange": false,
			"bInfo": false,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>cleave/sysleave/table_job_pending/' +id,
				"type" : 'POST',
			},
			"columns": [
	            { "data": "keterangan" },
	            { "data": "action" },
	        ],
	        "columnDefs": [
				{
					"targets": [ 1 ],
					"className": "text-right",
					"searchable": false,
					"orderable": false,
				},
				{
					"targets": [ 0 ],
					"className": "text-left",
					"searchable": false,
					"orderable": false,
				}
			]
		});
	}

	function deteleJP(id){
		var nodoc = $(id).attr("data-nodoc"),
			idx   = $(id).attr("data-idx"),
			tipe  = $(id).attr("data-tipe");

		if (tipe == "001") {
			table = $('#table_job_pending').DataTable();
		} else if (tipe == "002"){
			table = $('#table_job_pending_5th').DataTable();
		} else {
			table = $('#table_job_pending_birth').DataTable();
		}

		$.ajax({
			url: "<?=site_url()?>cleave/sysleave/delete_job_pending",
			type: "POST",
			data: { nodoc:nodoc , idx:idx },
			success:function(){
				table.ajax.reload();
			},
		});
	}

	function toDate(dateStr) {
	  	var parts = dateStr.split("-")
	  	return new Date(parts[2], parts[1] - 1, parts[0])
	}

	$(document).ready(function () {

		$("#li-PngCti").addClass("bg-purple");
      	$("#hf-PngCti").addClass("white");

      	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.' });
      	$('._CnUmB').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});

		$("#form-cuti-rooster, #form-cuti-besar, #form-cuti-lahir").validate();

		$( "input[name=jenis_cuti]" ).on( "ifClicked", function(event) {
			$('#btn-pengajuan').attr('data-target', this.value);
		});

		$("#ptgs_pengganti, #ptgs_pengganti2, #ptgs_pengganti3").select2({ maximumSelectionLength: 3 });

		$("#site, #site2, #site3, #site_edit, #site2_edit, #site3_edit").select2({
			placeholder: "Pilih",
    		allowClear: true
		});

		$('#selama').keyup(function(){
			if ($(this).val() > <?=$dperiode->Lama_Cuti;?>){ $(this).val(<?=$dperiode->Lama_Cuti;?>); }
		});

		$("#selama").on("input", function() {
			if (/^0/.test(this.value)) { this.value = this.value.replace(/^0/, "1"); }
		})

		var table = $('#table_history_cuti').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": false,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>cleave/sysleave/table_history_cuti',
				"type" : 'POST',
				error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
			},
			"language": {
				"processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>'
			},
			"columns": [
	            {
	               "className": 'details-control',
	               "data": null,
	               "defaultContent": '',
	               "orderable": false, 
	               "targets": 0
	            },
	            { "data": "no" },
	            { "data": "nopengajuan" },
	            { 
	            	"data": "tglpengajuan",
	            	"type": "num",
	            	"render": {
	            		"_" : "tgl",
	            		"sort": "sort_tgl"
	            	}
	            },
	            { "data": "selama" },
	            { "data": "cutitahunan" },
	            { "data": "tglmulai" },
	            { "data": "tglakhir" },
	            { "data": "jnscuti" },
	            { "data": "btnpenegasan" },
	            { "data": "btnaction" },
	        ],
			"columnDefs": [
				{
					"targets": [ 0, 1, 4, 5, 6, 7, 8, 9, 10, ],
					"className": "text-center",
					"searchable": false,
					"orderable": false,
				},
				{
					"targets": [ 1,2,3 ],
					"className": "text-center"
				},
			],
		});

		$('#table_history_cuti tbody').on('click', 'td.details-control', function () {
			var tr  = $(this).closest('tr');
			var row = table.row( tr );

			if ( row.child.isShown() ) {
				row.child.hide();
				tr.removeClass('shown');
			} else {
				row.child( format(row.data()) ).show();
				tr.addClass('shown');
			}
		});

		$('#selama').val(<?=$dperiode->Lama_Cuti;?>);
		$('#cuti_tahunan').attr('disabled', true);
		$('#CutiThn').val(3);

		// 1. CUTI ROOSTER -------------------------------------------------------------------------------------------- //
		$('#tgl_awal').change(function(){
			$('#cuti_tahunan').removeAttr('disabled');

			var input_selama = $('#selama').val() - 1,
				tglAwal  = Date.parse( $('#tgl_awal').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (input_selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#tgl_akhir').val( newtglAkhir );
			$('#tgl_kerja').val( newtglMasuk );
			$('#total_cuti').val( (input_selama + 1) );
		});

		$('#selama').change(function(){
			var input_selama = ($('#selama').val() - 1),
				tglAwal  = Date.parse( $('#tgl_awal').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (input_selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#tgl_akhir').val( newtglAkhir );
			$('#tgl_kerja').val( newtglMasuk );
			$('#total_cuti').val( (input_selama + 1) );
		});

		$('#cuti_tahunan').change(function(){
			var input_selama  = ($('#selama').val() - 1),
				cuti_tahunan  = 3,
				sisa_cuti_thn = $('#sisa_cuti_thn').val();

			if (this.checked) {
				var tglAwal  = Date.parse( $('#tgl_awal').datepicker('getDate') ),
					tglAkhir = new Date( tglAwal + ( (input_selama + cuti_tahunan )*24*60*60*1000) ),
					tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

				var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
					newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

				$('#CutiThn').val(cuti_tahunan);
				$('#tgl_akhir').val( newtglAkhir );
				$('#tgl_kerja').val( newtglMasuk );
				$('#total_cuti').val( (input_selama + 1 + cuti_tahunan) );
				$('#sisa_cuti_tahunan').text(sisa_cuti_thn - cuti_tahunan);
			} else {
				var tglAwal  = Date.parse( $('#tgl_awal').datepicker('getDate') ),
					tglAkhir = new Date( tglAwal + ( input_selama*24*60*60*1000) ),
					tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

				var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
					newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

				$('#CutiThn').val(0);
				$('#tgl_akhir').val( newtglAkhir );
				$('#tgl_kerja').val( newtglMasuk );
				$('#total_cuti').val( (input_selama + 1) );
				$('#sisa_cuti_tahunan').text(sisa_cuti_thn);
			}			
		});

		// EDIT CUTI ROOSTER
		$('#tgl_awal_edit').change(function(){
			var input_selama = ($('#selama_edit').val() - 1),
				tglAwal  = Date.parse( $('#tgl_awal_edit').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (input_selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#tgl_akhir_edit').val( newtglAkhir );
			$('#tgl_kerja_edit').val( newtglMasuk );
			$('#total_cuti_edit').val( (input_selama + 1) );
		});

		$('#selama_edit').change(function(){
			var input_selama = $('#selama_edit').val() - 1,
				tglAwal      = Date.parse( $('#tgl_awal_edit').datepicker('getDate') ),
				tglAkhir     = new Date( tglAwal + (input_selama*24*60*60*1000) ),
				tglMasuk     = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#tgl_akhir_edit').val( newtglAkhir );
			$('#tgl_kerja_edit').val( newtglMasuk );
			$('#total_cuti_edit').val( (input_selama + 1) );
		});

		$('#cuti_tahunan_edit').change(function(){

			var input_selama = ($('#selama_edit').val() - 1),
				tglAwal      = $('#tgl_awal_edit').val(),
				cuti_tahunan = 3,
				newtglAwal   = Date.parse(tglAwal.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3")) ;

			if (this.checked) {
				var tglAkhir = new Date( newtglAwal + ( (input_selama + cuti_tahunan )*24*60*60*1000) ),
					tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

				var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
					newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

				$('#CutiThn_edit').val(cuti_tahunan);
				$('#tgl_akhir_edit').val( newtglAkhir );
				$('#tgl_kerja_edit').val( newtglMasuk );
				$('#total_cuti_edit').val( (input_selama + 1 + cuti_tahunan) );
			} else {
				var tglAkhir = new Date( newtglAwal + ( input_selama*24*60*60*1000) ),
					tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

				var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
					newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

				$('#CutiThn_edit').val(0);
				$('#tgl_akhir_edit').val( newtglAkhir );
				$('#tgl_kerja_edit').val( newtglMasuk );
				$('#total_cuti_edit').val( (input_selama + 1) );
			}			
		});

		var max_fields = 10,
			wrapper    = $(".input_fields_wrap"), 
			add_button = $(".add_field_button"),
	    	x = 1; 
	    $(add_button).click(function(e){ 
	        e.preventDefault();
	        if(x < max_fields){ 
	            x++; 
	            $(wrapper).append('<div class="input-group"><input type="text" class="form-control" name="outstanding_tugas[]" maxlength="100"><span class="input-group-btn"><button type="button" class="btn btn-danger btn-flat remove_field"><i class="fa fa-times"></i></button></span></div><div style="padding: 1px;"></div>'); 
	        }
	    });
	    $(wrapper).on("click",".remove_field", function(e){ e.preventDefault(); $(this).parent().parent().remove(); x--; });

	    var max_fields4 = 5,
			wrapper4    = $(".jobpending_rooster_edit_content"),
			add_button4 = $(".add_field_eroos"),
	    	x = 1; 
	    $(add_button4).click(function(e){ 
	        e.preventDefault();
	        if(x < max_fields4){ 
	            x++; 
	            $(wrapper4).append('<div class="input-group"><input type="text" class="form-control" name="jobpending_rooster_edit[]" maxlength="100"><span class="input-group-btn"><button type="button" class="btn btn-danger btn-flat remove_field_edit1"><i class="fa fa-times"></i></button></span></div><div style="padding: 1px;"></div>'); 
	        }
	    });
	    $(wrapper4).on("click",".remove_field_edit1", function(e){ e.preventDefault(); $(this).parent().parent().remove(); x--; });

		// 2. CUTI BESAR -------------------------------------------------------------------------------------------- //
		$('#tgl_awal2').change(function(){
			var tglAwal  = Date.parse( $('#tgl_awal2').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (24*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			var timeDiff = tglAkhir - tglAwal,
				daysDiff = Math.floor( timeDiff / (24*60*60*1000) );

			$('#tgl_akhir2').datepicker('setDate', newtglAkhir );
			$('#tgl_kerja2').val( newtglMasuk );
			$('#selama2').val(daysDiff + 1);
		});

		$('#tgl_akhir2').change(function(){
			var tglAwal  = Date.parse( $('#tgl_awal2').datepicker('getDate') ),
				tglAkhir = Date.parse( $('#tgl_akhir2').datepicker('getDate') ),
				tglMasuk = new Date( tglAkhir + (24*60*60*1000) );

			var timeDiff = tglAkhir - tglAwal,
				daysDiff = Math.floor(timeDiff / (24*60*60*1000) + 1 ),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			if (daysDiff > 25) {
				$('#daymax').removeClass('hidden');
			} else {
				$('#daymax').addClass('hidden');
			}
			$('#selama2').val(daysDiff);
			$('#tgl_kerja2').val( newtglMasuk );
		});

		var max_fields2 = 5,
			wrapper2    = $(".input_fields_wrap2"),
			add_button2 = $(".add_field_button2"),
	    	x = 1; 
	    $(add_button2).click(function(e){ 
	        e.preventDefault();
	        if(x < max_fields2){ 
	            x++; 
	            $(wrapper2).append('<div class="input-group"><input type="text" class="form-control" name="outstanding_tugas2[]" maxlength="100"><span class="input-group-btn"><button type="button" class="btn btn-danger btn-flat remove_field2"><i class="fa fa-times"></i></button></span></div><div style="padding: 1px;"></div>'); 
	        }
	    });
	    $(wrapper2).on("click",".remove_field2", function(e){ e.preventDefault(); $(this).parent().parent().remove(); x--; });

		// EDIT CUTI BESAR

		$('#tgl_awal2_edit').change(function(){
			var tglAwal  = Date.parse( $('#tgl_awal2_edit').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (24*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			var timeDiff = tglAkhir - tglAwal,
				daysDiff = Math.floor( timeDiff / (24*60*60*1000) );

			$('#tgl_akhir2_edit').datepicker('setDate', newtglAkhir );
			$('#tgl_kerja2_edit').val( newtglMasuk );
			$('#selama2_edit').val(daysDiff + 1);
		});

		$('#tgl_akhir2_edit').change(function(){
			var tglAwal  = Date.parse( $('#tgl_awal2_edit').datepicker('getDate') ),
				tglAkhir = Date.parse( $('#tgl_akhir2_edit').datepicker('getDate') ),
				tglMasuk = new Date( tglAkhir + (24*60*60*1000) );

			var timeDiff = tglAkhir - tglAwal,
				daysDiff = Math.floor(timeDiff / (24*60*60*1000) + 1 ),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			if (daysDiff > 25) {
				$('#daymax2_edit').removeClass('hidden');
			} else {
				$('#daymax2_edit').addClass('hidden');
			}
			$('#selama2_edit').val(daysDiff);
			$('#tgl_kerja2_edit').val( newtglMasuk );
		});

	    var max_fields2_5th = 5,
			wrapper2_5th    = $(".edit_content_jp_5th"),
			add_button2_5th = $(".add_btn_5th_edit"),
	    	x = 1; 
	    $(add_button2_5th).click(function(e){ 
	        e.preventDefault();
	        if(x < max_fields2_5th){ 
	            x++; 
	            $(wrapper2_5th).append('<div class="input-group"><input type="text" class="form-control" name="outstanding_tugas2_edit_5th[]" maxlength="100"><span class="input-group-btn"><button type="button" class="btn btn-danger btn-flat remove_field2_edit_5th"><i class="fa fa-times"></i></button></span></div><div style="padding: 1px;"></div>'); 
	        }
	    });
	    $(wrapper2_5th).on("click",".remove_field2_edit_5th", function(e){ e.preventDefault(); $(this).parent().parent().remove(); x--; });

		// 3. CUTI MELAHIRKAN -------------------------------------------------------------------------------------- //
		$('#tgl_awal3').change(function(){
			var tglAwal  = Date.parse( $('#tgl_awal3').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (44*24*60*60*1000) ),
				tglMasuk = new Date ( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			var dateDiff = tglAkhir - tglAwal,
				daysDiff = Math.floor( dateDiff / (24*60*60*1000) + 1 );

			$('#tgl_akhir3').datepicker('setDate', newtglAkhir );
			$('#tgl_kerja3').val( newtglMasuk );
			$('#selama3').val(daysDiff);
		});

		$('#tgl_akhir3').change(function(){
			var tglAwal  = Date.parse( $('#tgl_awal3').datepicker('getDate') ),
				tglAkhir = Date.parse( $('#tgl_akhir3').datepicker('getDate') ),
				tglMasuk = new Date( tglAkhir + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			var timeDiff = tglAkhir - tglAwal,
				daysDiff = Math.floor( timeDiff / (24*60*60*1000) + 1 );

			if (daysDiff > 45) {
				$('#daymax2').removeClass('hidden');
			} else {
				$('#daymax2').addClass('hidden');
			}

			$('#selama3').val(daysDiff);
			$('#tgl_kerja3').val( newtglMasuk );
		});

		var max_fields3 = 5,
			wrapper3    = $(".input_fields_wrap3"), 
			add_button3 = $(".add_field_button3"),
	    	x = 1; 
	    $(add_button3).click(function(e){ 
	        e.preventDefault();
	        if(x < max_fields3){ 
	            x++; 
	            $(wrapper3).append('<div class="input-group"><input type="text" class="form-control" name="outstanding_tugas3[]" maxlength="100"><span class="input-group-btn"><button type="button" class="btn btn-danger btn-flat remove_field3"><i class="fa fa-times"></i></button></span></div><div style="padding: 1px;"></div>'); 
	        }
	    });
	    $(wrapper3).on("click",".remove_field3", function(e){ e.preventDefault(); $(this).parent().parent().remove(); x--; });

		// EDIT CUTI MELAHIRKAN
		$('#tgl_awal3_edit').change(function(){
			var tglAwal  = Date.parse( $('#tgl_awal3_edit').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (44*24*60*60*1000) ),
				tglMasuk = new Date ( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			var dateDiff = tglAkhir - tglAwal,
				daysDiff = Math.floor( dateDiff / (24*60*60*1000) + 1 );

			$('#tgl_akhir3_edit').datepicker('setDate', newtglAkhir );
			$('#tgl_kerja3_edit').val( newtglMasuk );
			$('#selama3_edit').val(daysDiff);
		});

		$('#tgl_akhir3_edit').change(function(){
			var getAwal = $('#tgl_awal3_edit').val(),
				getAkhir = $('#tgl_akhir3_edit').val(),
				tglAwal  = new Date( Date.parse(getAwal.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3")) ),
				tglAkhir = new Date( Date.parse(getAkhir.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3")) ),
				tglMasuk = new Date( Date.parse(getAkhir.replace( /(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3")) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			var timeDiff = tglAkhir - tglAwal,
				daysDiff = Math.floor( timeDiff / (24*60*60*1000) + 1 );

			if (daysDiff > 45) {
				$('#daymax3_edit').removeClass('hidden');
			} else {
				$('#daymax3_edit').addClass('hidden');
			}

			$('#selama3_edit').val(daysDiff);
			$('#tgl_kerja3_edit').val( newtglMasuk );
		});

	    var max_fields3_edit = 5,
			wrapper3_edit    = $(".edit_content_jp_birth"),
			add_button3_edit = $(".add_btn_birth_edit"),
	    	x = 1; 
	    $(add_button3_edit).click(function(e){ 
	        e.preventDefault();
	        if(x < max_fields3_edit){ 
	            x++; 
	            $(wrapper3_edit).append('<div class="input-group"><input type="text" class="form-control" name="outstanding_tugas3_edit[]" maxlength="100"><span class="input-group-btn"><button type="button" class="btn btn-danger btn-flat remove_field3_edit"><i class="fa fa-times"></i></button></span></div><div style="padding: 1px;"></div>'); 
	        }
	    });
	    $(wrapper3_edit).on("click",".remove_field3_edit", function(e){ e.preventDefault(); $(this).parent().parent().remove(); x--; });
	    // -------------------------------------------------------------------------------------------------------- //
	
	    // STATE SAVE
		$("#btn_rooster").click(function () {
			var formdata = $("#form-cuti-rooster").serialize();
	 		var table    = $('#table_history_cuti').DataTable();
			if($("#form-cuti-rooster").valid() == false){
				return false;
			} else {
				$.post("<?=base_url();?>cleave/sysleave/save_cuti_rooster",
				formdata,
				function(data) {
					if(data == "Success"){
						table.ajax.reload();
						$('#modal-rooster').modal('hide');
						swal("Naiss!", "Pengajuan cuti berhasil disimpan", "success");
					} else if (data == 'onprogress') {
						$('#modal-rooster').modal('hide');
						swal("Oops!", "Maaf masih ada pengajuan cuti anda yang sedang diproses.", "error");
					} else {
						$('#modal-rooster').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
					}
				});	
			}
		});

		$("#btn_rooster_edit").click(function () {
			var formdata = $("#form-edit-rooster").serialize(),
	 			table    = $('#table_history_cuti').DataTable();
			if($("#form-edit-rooster").valid() == false){
				return false;
			} else {
				$.post("<?=base_url();?>cleave/sysleave/save_edit_rooster",
				formdata,
				function(data) {
					if(data == "Success"){
						table.ajax.reload();
						$('#modal-edit-rooster').modal('hide');
						swal("Naiss!", "Pengajuan cuti berhasil disimpan", "success");
					} else {
						$('#modal-edit-rooster').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
					}
				});	
			}
		});

		$("#btn_besar").click(function () {
			var formdata = $("#form-cuti-besar").serialize(),
	 			table    = $('#table_history_cuti').DataTable();
			if($("#form-cuti-besar").valid() == false){
				return false;
			} else {
				$.post("<?=base_url();?>cleave/sysleave/save_cuti_besar",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#modal-besar').modal('hide');
						swal("Naiss!", "Pengajuan cuti berhasil disimpan", "success");
						table.ajax.reload();
					} else {
						$('#modal-besar').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
						table.ajax.reload();
					}
				});	
			}
		});

		$("#btn_besar_edit").click(function () {
			var formdata = $("#form-edit-cutibesar").serialize(),
	 			table    = $('#table_history_cuti').DataTable();
			if($("#form-edit-cutibesar").valid() == false){
				return false;
			} else {
				$.post("<?=base_url();?>cleave/sysleave/save_edit_cutibesar",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#modal-edit-besar').modal('hide');
						swal("Naiss!", "Pengajuan cuti berhasil disimpan", "success");
						table.ajax.reload();
					} else {
						$('#modal-edit-besar').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
						table.ajax.reload();
					}
				});	
			}
		});

		$("#btn_melahirkan").click(function () {
			var formdata = $("#form-cuti-melahirkan").serialize(),
	 			table    = $('#table_history_cuti').DataTable();
			if($("#form-cuti-melahirkan").valid() == false){
				return false;
			} else {
				$.post("<?=base_url();?>cleave/sysleave/save_cuti_melahirkan",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#modal-lahir').modal('hide');
						swal("Naiss!", "Pengajuan cuti berhasil disimpan", "success");
						table.ajax.reload();
					} else {
						$('#modal-lahir').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
						table.ajax.reload();
					}
				});	
			}
		});

		$("#btn_melahirkan_edit").click(function () {
			var formdata = $("#form-edit-cutimelahirkan").serialize(),
	 			table    = $('#table_history_cuti').DataTable();
			if($("#form-edit-cutimelahirkan").valid() == false){
				return false;
			} else {
				$.post("<?=base_url();?>cleave/sysleave/save_edit_cutimelahirkan",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#modal-edit-lahir').modal('hide');
						swal("Naiss!", "Pengajuan cuti berhasil disimpan", "success");
						table.ajax.reload();
					} else {
						$('#modal-edit-lahir').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
						table.ajax.reload();
					}
				});	
			}
		});

		$('#modal-edit-rooster').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button     = $(event.relatedTarget)
				var nodoc      = button.data('nodoc')
				var tgl_awal   = button.data('tgl_awal')
				var selama     = button.data('selama')
				var tgl_akhir  = button.data('tgl_akhir')
				var tgl_kerja  = button.data('tgl_kerja')
				var total_cuti = button.data('total_cuti')
				var CutiThn    = button.data('cutitahunan')
				var site 	   = button.data('site')
				var modal      = $(this)

				modal.find('#nodoc_edit').val(nodoc)
				modal.find('#tgl_awal_edit').val(tgl_awal)
				modal.find('#selama_edit').val(selama)
				modal.find('#tgl_akhir_edit').val(tgl_akhir)
				modal.find('#tgl_kerja_edit').val(tgl_kerja)
				modal.find('#total_cuti_edit').val(total_cuti)
				modal.find('#CutiThn_edit').val(CutiThn)
				modal.find('.modal-title').text('Cuti Rooster | No. Pengajuan : ' + nodoc)
				modal.find('#site_edit').val(site).trigger('change')
			}
		});

		$('#modal-edit-besar').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button    = $(event.relatedTarget)
				var nodoc     = button.data('nodoc')
				var tgl_awal  = button.data('tgl_awal')
				var selama    = button.data('selama')
				var tgl_akhir = button.data('tgl_akhir')
				var tgl_kerja = button.data('tgl_kerja')
				var modal     = $(this)

				modal.find('#nodoc_e5th').val(nodoc)
				modal.find('#tgl_awal2_edit').val(tgl_awal)
				modal.find('#selama2_edit').val(selama)
				modal.find('#tgl_akhir2_edit').val(tgl_akhir)
				modal.find('#tgl_kerja2_edit').val(tgl_kerja)
				modal.find('.modal-title').text('Cuti Besar | No. Pengajuan : ' + nodoc)
				modal.find('#site2_edit').val('<?=($dkaryawan->KodeST !== NULL) ? $dkaryawan->KodeST : 0;?>').trigger('change')
			}
		});

		$('#modal-edit-lahir').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button    = $(event.relatedTarget)
				var nodoc     = button.data('nodoc')
				var tgl_awal  = button.data('tgl_awal')
				var selama    = button.data('selama')
				var tgl_akhir = button.data('tgl_akhir')
				var tgl_kerja = button.data('tgl_kerja')
				var modal     = $(this)

				modal.find('#nodoc_birth').val(nodoc)
				modal.find('#tgl_awal3_edit').val(tgl_awal)
				modal.find('#selama3_edit').val(selama)
				modal.find('#tgl_akhir3_edit').val(tgl_akhir)
				modal.find('#tgl_kerja3_edit').val(tgl_kerja)
				modal.find('.modal-title').text('Cuti Melahirkan | No. Pengajuan : ' + nodoc)
				modal.find('#site3_edit').val('<?=($dkaryawan->KodeST !== NULL) ? $dkaryawan->KodeST : 0;?>').trigger('change')
			}
		});

	});

	
</script>