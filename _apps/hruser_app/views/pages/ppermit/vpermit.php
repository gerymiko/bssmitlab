<section class="content-header">
  <h1>PENGAJUAN <b>IZIN</b>
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
					<h3 class="box-title">Jenis Izin</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<form id="myForm">
					<div class="box-body">
						<ul class="todo-list">
							<li>
								<input type="radio" class="minimal" name="jenis_izin" value="#modal-resmi" checked="checked">
								<span class="text">Izin Resmi</span>
							</li>
							<li>
								<input type="radio" class="minimal" name="jenis_izin" value="#modal-nonresmi">
								<span class="text">Izin Tidak Resmi</span>
							</li>
						</ul>
					</div>
					<div class="box-footer clearfix no-border">
						<button id="btn-pengajuan" type="button" class="btn btn-sm btn-warning pull-right btn-flat" data-toggle="modal" data-target="#modal-resmi" data-backdrop="static" data-keyboard="false"><em>Buat Pengajuan</em></button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">Riwayat Izin</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<div class="slider-table">
						<table id="table_history_permit" class="table table-bordered table-hover">
							<thead class="bg-purple-active">
								<tr>
									<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
									<th>No</th>
									<th>No. Dok</th>
									<th>Tgl Pengajauan</th>
									<th>Selama</th>
									<th>Tgl Mulai</th>
									<th>Tgl Akhir</th>
									<th>Kategori</th>
									<th>Jenis Izin</th>
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

<div class="modal fade" id="modal-resmi">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Izin Resmi</h4>
			</div>
			<form id="form-official-permit" action="#" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Jenis Izin Resmi</label>
								<select class="form-control required" name="opermit_type" id="opermit_type">
									<option></option>
									<?php
										foreach ($list_opermit as $row) {
											echo '<option value="'.$row->Kode.$row->lama.'">'.$row->Nama.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="oselama" id="oselama" class="form-control required" readonly="readonly" maxlength="1">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label>Dari Tanggal</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="datepicker form-control pull-right required" name="otgl_awal" id="otgl_awal" maxlength="10">
							</div>
						</div>
						<div class="col-md-6">
							<label>Sampai Tanggal</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="form-control pull-right required" name="otgl_akhir" id="otgl_akhir" maxlength="10" readonly="readonly">
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<label>Kembali Bekerja</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="form-control pull-right required" name="otgl_masuk" id="otgl_masuk" maxlength="10" readonly="readonly">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="osite_ir" id="osite_ir">
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
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control required" rows="3" name="odesc" id="odesc" maxlength="200"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<button type="button" id="btn_opermit" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-nonresmi">
	<div class="modal-dialog modal70">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Izin Tidak Resmi</h4>
			</div>
			<form id="form-unofficial-permit" action="#" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>Jenis Izin Tidak Resmi</label>
								<select class="form-control required" name="unopermit_type" id="unopermit_type">
									<option></option>
									<?php
										foreach ($list_unopermit as $row) {
											echo '<option value="'.$row->Kode.'">'.$row->Nama.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="unoselama" id="unoselama" class="num form-control required" maxlength="2">
								<div id="notif" class="hidden">Maksimal 3 hari</div>
							</div>
						</div>
						<div class="col-md-4">
							<label>Dari Tanggal</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="datepicker form-control pull-right required" name="unotgl_awal" id="unotgl_awal" maxlength="10">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<label>Sampai Tanggal</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="form-control pull-right required" name="unotgl_akhir" id="unotgl_akhir" maxlength="10" readonly="readonly">
							</div>
						</div>
						<div class="col-md-4">
							<label>Kembali Bekerja</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="form-control pull-right required" name="unotgl_masuk" id="unotgl_masuk" maxlength="10" readonly="readonly">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="unosite_ir" id="unosite_ir">
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
					</div><br>
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
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control" rows="3" name="unodesc" id="unodesc" maxlength="200"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<button type="button" id="btn_unopermit" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-edit-official">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Izin Resmi</h4>
			</div>
			<form id="form-edit-official-permit" action="#" method="post">
				<input type="hidden" name="nopengajuan_edit" id="nopengajuan_edit">
				<input type="hidden" name="hdnFormChanged" id="hdnFormChanged">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Jenis Izin Resmi</label>
								<select class="form-control required" name="opermit_type_edit" id="opermit_type_edit">
									<option></option>
									<?php
										foreach ($list_opermit as $row) {
											echo '<option value="'.$row->Kode.$row->lama.'">'.$row->Nama.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Selama (hari)</label>
								<input type="text" name="oselama_edit" id="oselama_edit" class="form-control required" readonly="readonly" maxlength="1">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label>Dari Tanggal</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="datepicker form-control pull-right required" name="otgl_awal_edit" id="otgl_awal_edit" maxlength="10">
							</div>
						</div>
						<div class="col-md-6">
							<label>Sampai Tanggal</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="form-control pull-right required" name="otgl_akhir_edit" id="otgl_akhir_edit" maxlength="10" readonly="readonly">
							</div>
						</div>
					</div><br>
					<div class="row">
						<div class="col-md-6">
							<label>Kembali Bekerja</label>
							<div class="input-group date">
								<div class="input-group-addon"><i class="fas fa-calendar-alt"></i></div>
								<input type="text" class="form-control pull-right required" name="otgl_masuk_edit" id="otgl_masuk_edit" maxlength="10" readonly="readonly">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Site</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
									<select class="form-control required" name="osite_ir_edit" id="osite_ir_edit">
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
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Keterangan</label>
								<textarea class="form-control" rows="3" name="odesc_edit" id="odesc_edit" maxlength="200"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-sm btn-flat" data-dismiss="modal"><em>Tutup</em></button>
					<button type="button" id="btn_edit_opermit" class="btn btn-warning btn-sm btn-flat"><em>Simpan</em></button>
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
	/*#table_job_pending, #table_job_pending_5th, #table_job_pending_birth thead { display: none; }
	#table_job_pending_paginate, #table_job_pending_5th_paginate, #table_job_pending_birth_paginate { display: none; }*/
</style>

<script type="text/javascript">
	function format ( d ) {
		return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-bordered no-margin">'+
		'<tr>'+
			'<td class="col-xs-2">Keterangan</td>'+
			'<td>'+d.keterangan+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-2">Periode</td>'+
			'<td>'+d.periode+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td class="col-xs-2">Cuti Tahunan</td>'+
			'<td>'+d.periodeCT+'</td>'+
		'</tr>'+
		'</table>';
    }

	$(document).ready(function () {

		$("#li-PngIzn").addClass("bg-purple");
      	$("#hf-PngIzn").addClass("white");

      	$('.alpha').alphanum({allowNumeric: false});
		$('.num').numeric({allowThouSep: false,	allowDecSep: false, allowPlus: false, allowMinus: false});
		
		$("#opermit_type").select2({
			placeholder: "Pilih",
    		allowClear: true
		}).on("select2:select", function(e) {
			var valopt = $(this).children("option:selected").val();
			var valday = valopt.substr(valopt.length - 1);
		    $('#oselama').val(valday);
		});

		$("#opermit_type_edit").select2({
			placeholder: "Pilih",
    		allowClear: true
		}).on("select2:select", function(e) {
			var valopt = $(this).children("option:selected").val();
			var valday = valopt.substr(valopt.length - 1);
		    $('#oselama_edit').val(valday);
		});

		$( "input[name=jenis_izin]" ).on( "ifClicked", function(event) {
			$('#btn-pengajuan').attr('data-target', this.value);
		});

		$('.modal').on('hidden.bs.modal', function (e) {
			$(this)
			.find("textarea").val('').end()
			.find("input[name=hdnFormChanged]").val('').end();
			// .find("input[type=checkbox], input[type=radio]").prop("checked", "").end();
			$("#opermit_type, #osite_ir").val([]).trigger("change");
		});

		$("#unopermit_type, #osite_ir, #opermit_type_edit, #osite_ir_edit").select2({
			placeholder: "Pilih",
    		allowClear: true
		});

		$("#unoselama").on("input", function() {
			if (/^0/.test(this.value)) {
				this.value = this.value.replace(/^0/, "1")
			}
		});

		// 1. IZIN RESMI //
		$('#otgl_awal').change(function(){
			var selama   = ($('#oselama').val() - 1),
				tglAwal  = Date.parse( $('#otgl_awal').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) ) ;

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#otgl_akhir').val(newtglAkhir);
			$('#otgl_masuk').val(newtglMasuk);
		});

		$('#opermit_type').on("select2:select", function(e){
			$('#otgl_awal').datepicker('setDate', new Date() + (24*60*60*1000));
			var selama   = ($('#oselama').val() - 1),
				tglAwal  = Date.parse( $('#otgl_awal').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) ) ;

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#otgl_akhir').val(newtglAkhir);
			$('#otgl_masuk').val(newtglMasuk);
		});

		// EDIT IZIN RESMI //
		$('#otgl_awal_edit').change(function(){
			var selama   = ($('#oselama_edit').val() - 1),
				tglAwal  = Date.parse( $('#otgl_awal_edit').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#otgl_akhir_edit').val(newtglAkhir);
			$('#otgl_masuk_edit').val(newtglMasuk);
			$("#hdnFormChanged").val("yes");
		});

		$('#opermit_type_edit').on("select2:select", function(e){
			$('#otgl_awal_edit').datepicker('setDate', new Date() + (24*60*60*1000));
			var selama   = ($('#oselama_edit').val() - 1),
				tglAwal  = Date.parse( $('#otgl_awal_edit').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) ) ;

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#otgl_akhir_edit').val(newtglAkhir);
			$('#otgl_masuk_edit').val(newtglMasuk);
			$("#hdnFormChanged").val("yes");
		});

		$('#odesc_edit').change(function() {
		  	$("#hdnFormChanged").val("yes");
		});

		// 2. IZIN TIDAK RESMI //
		$('#unotgl_awal').change(function(){
			var selama   = ($('#unoselama').val() - 1),
				tglAwal  = Date.parse( $('#unotgl_awal').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#unotgl_akhir').val(newtglAkhir);
			$('#unotgl_masuk').val(newtglMasuk);
		});

		$('#unoselama').change(function(){
			var selama   = ($('#unoselama').val() - 1),
				tglAwal  = Date.parse( $('#unotgl_awal').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (selama*24*60*60*1000) ),
				tglMasuk =  new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#unotgl_akhir').val(newtglAkhir);
			$('#unotgl_masuk').val(newtglMasuk);
		});

		$('#unopermit_type').on("select2:select", function(e){
			$('#unotgl_awal').datepicker('setDate', new Date() + (24*60*60*1000));
			$('#unoselama').val(1);
			var valopt = $(this).children("option:selected").val(),
				selama = ( $('#unoselama').val() - 1 );

			if ( valopt == "IZ116" ) {
				$('#notif').removeClass('hidden');
			} else {
				$('#notif').addClass('hidden');
			}
			
			var tglAwal  = Date.parse( $('#unotgl_awal').datepicker('getDate') ),
				tglAkhir = new Date( tglAwal + (selama*24*60*60*1000) ),
				tglMasuk = new Date( Date.parse( tglAkhir ) + (24*60*60*1000) );

			var newtglAkhir = moment(tglAkhir).format('DD-MM-YYYY'),
				newtglMasuk = moment(tglMasuk).format('DD-MM-YYYY');

			$('#unotgl_akhir').val(newtglAkhir);
			$('#unotgl_masuk').val(newtglMasuk);
		});

		var table = $('#table_history_permit').DataTable({
			"processing": true,
			"serverSide": true,
			"autoWidth": false,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>cpermit/syspermit/table_history_permit',
				"type" : 'POST',
				error: function(data) {
					swal("Oh Noez!", "Gagal menarik data! Coba lagi", "error");
				}
			},
			"language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>' },
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
	            { "data": "tglmulai" },
	            { "data": "tglakhir" },
	            { "data": "katizin" },
	            { "data": "jnsizin" },
	            { "data": "action" },
	        ],
			"columnDefs": [
				{
					"targets": [ 0 ],
					"className": "text-center",
					"searchable": false,
					"orderable": false,
				},
				{
					"targets": [ 1, 4, 5, 6, 8 ],
					"className": "text-center",
					"orderable": false,
				},
				{
					"targets": [ 7, 9 ],
					"className": "text-left",
					"searchable": false,
					"orderable": false
				},
				{
					"targets": [ 2 , 3 ],
					"className": "text-center",
				},
			],
		});

		$('#table_history_permit tbody').on('click', 'td.details-control', function () {
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

		$("#btn_opermit").click(function () {
			var formdata = $("#form-official-permit").serialize(),
	 			table    = $('#table_history_permit').DataTable();
			if($("#form-official-permit").valid() == false){
				return false;
			} else {
				$.post("<?=base_url();?>cpermit/syspermit/save_official_permit",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#modal-resmi').modal('hide');
						swal("Naiss!", "Pengajuan izin berhasil disimpan", "success");
						table.ajax.reload();
					} else {
						$('#modal-resmi').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
						table.ajax.reload();
					}
				});	
			}
		});

		$('#btn_edit_opermit').click(function() {
	    	$('#loading').removeClass('hidden');
			var formdata = $("#form-edit-official-permit").serialize(),
	 			table    = $('#table_history_permit').DataTable();
			if($("#form-edit-official-permit").valid() == false){
				return false;
				$('#loading').addClass('hidden');
			} else if ( $("#hdnFormChanged").val() !== "yes"){
				$('#loading').addClass('hidden');
				swal({
					title: '...',
					text: 'Tidak ada perubahan data yang harus disimpan',
					showCancelButton: false,
					showConfirmButton: false
				});
			} else {
				$.post("<?=base_url();?>cpermit/syspermit/save_edit_official_permit",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#loading').addClass('hidden');
						$('#modal-edit-official').modal('hide');
						swal("Naiss!", "Pengajuan izin berhasil disimpan", "success");
						table.ajax.reload();
					} else {
						$('#loading').addClass('hidden');
						$('#modal-edit-official').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
						table.ajax.reload();
					}
				});	
			}
		});

		$("#btn_unopermit").click(function () {
			var formdata = $("#form-unofficial-permit").serialize(),
	 			table    = $('#table_history_permit').DataTable();
			if($("#form-unofficial-permit").valid() == false){
				return false;
			} else {
				$.post("<?=base_url();?>cpermit/syspermit/save_unofficial_permit",
				formdata,
				function(data) {
					if(data == "Success"){
						$('#modal-nonresmi').modal('hide');
						swal("Naiss!", "Pengajuan izin berhasil disimpan", "success");
						table.ajax.reload();
					} else {
						$('#modal-nonresmi').modal('hide');
						swal("Oops!", "Maaf pengajuan gagal diproses. Muat ulang halaman ini dan coba lagi", "error");
						table.ajax.reload();
					}
				});	
			}
		});

		$('#modal-edit-official').on('show.bs.modal', function (event) {
			if (event.namespace == 'bs.modal') {
				var button      = $(event.relatedTarget)
				var nopengajuan = button.data('nopengajuan')
				var jenis       = button.data('jenis')
				var tgl_awal    = button.data('tgl_awal')
				var tgl_akhir   = button.data('tgl_akhir')
				var tgl_masuk   = button.data('tgl_masuk')
				var selama      = button.data('selama')
				var keterangan  = button.data('desc')
				var site        = button.data('site')
				var modal       = $(this)

				modal.find('.modal-title').text('Izin Resmi | No. Pengajuan : ' + nopengajuan)
				modal.find('#nopengajuan_edit').val(nopengajuan)
				modal.find('#otgl_awal_edit').val(tgl_awal)
				modal.find('#otgl_akhir_edit').val(tgl_akhir)
				modal.find('#otgl_masuk_edit').val(tgl_masuk)
				modal.find('#oselama_edit').val(selama)
				modal.find('#odesc_edit').val(keterangan)
				modal.find('#osite_ir_edit').val(site).trigger('change')
				modal.find('#opermit_type_edit').val(jenis).trigger('change')
			}
		});

	});
</script>