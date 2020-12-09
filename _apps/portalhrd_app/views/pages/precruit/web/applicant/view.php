<section class="content-header" id="header-content">
	<h1>
	   	<div class="btn-group">
			<button type="button" class="btn bg-blue btn-xs">2</button>
			<button type="button" class="btn bg-navy btn-xs">B</button>
	    </div>
	    <span class="label no-padding text-black">Daftar <b>Pelamar Web</b></span>
	</h1>
</section>
<div id="extra-content" class="hidden"></div>
<section class="content" id="main-content">
	<div class="row mobile">
		<div class="col-md-12">
			<div class="btn-group pull-right">
				<button type="button" class="btn btn-danger" id="hideshow">Filter</button>
				<button class="btn bg-red">
					<i class="fas fa-filter"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="box box-primary desktop" id="content-filter">
		<div class="box-body">
			<form id="form-filter" action="#" class="form-horizontal">					
				<div class="col-md-2">
					<div class="form-group" style="margin-bottom: 0px;">
	                  	<input type="text" class="form-control _CalPhaNum" id="people_fullname" placeholder="Nama Lengkap">
	                </div>
				</div>
				<div class="col-md-2">
	                <div class="form-group" style="margin-bottom: 0px;">
	                  	<input type="text" class="form-control _CalPhaNum" id="domisili" placeholder="Domisili">
	                </div>
	            </div>
				<div class="col-md-3">
	                <div class="form-group" style="margin-bottom: 0px;">
                        <select class="form-control select2" id="KodeJB">
                            <option></option>
                            <?php
                            	foreach ($listjabatan as $row){
                            		echo '<option value="'.$row->KodeJB.'">'.$row->jabatan.' ['.$row->departemen.']</option>';
                            	}
                            ?>
                        </select>
					</div>
	            </div>
				<div class="col-md-2">
	                <div class="form-group" style="margin-bottom: 0px;">
	                  	<select class="form-control hand" id="freshgraduate">
	                  		<option value="">Pilih Lulusan Baru</option>
	                  		<option value="1">Ya</option>
	                  		<option value="0">Tidak</option>
	                  	</select>
	                </div>
	            </div>
	            <div class="col-md-2">
	            	<div class="form-group" style="margin-bottom: 0px;">
	                  	<select class="form-control hand" id="status_interview">
	                  		<option value="">Pilih Status Interview</option>
	                  		<option value="1">Sudah dipanggil</option>
	                  		<option value="0">Belum dipanggil</option>
	                  	</select>
	                </div>
	            </div>
	            <div class="col-md-1 text-center desktop">
	            	<div class="form-group" style="margin-bottom: 0px;">
						<button type="button" id="btn-filter" class="btn btn-flat btn-danger"><i class="fas fa-filter"></i></button>
						<button type="button" id="btn-reset" class="btn btn-flat btn-default"><i class="fas fa-sync"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="box">
		<div class="box-body slide-content">
			<table id="table_applicant" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th></th>
						<th class="text-center">Nama Lengkap</th>
						<th data-tooltip="Lulusan Baru" data-tooltip-location="right">FG <i class="far fa-question-circle"></i></th>
						<th>Usia</th>
						<th>JK</th>
						<th class="text-center">Jabatan</th>
						<th class="text-center">Domisili</th>
						<th>Tgl Lamar</th>
						<th>Status</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>

<div class="modal" id="modal-sms-kspm">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Kirim SMS <b>Interview KSPM &amp; HRD</b></h4>
			</div>
			<form id="form-sms-kspm" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id_kspm">
				<input type="hidden" name="pelamar_id" id="pelamar_id_kspm">
				<input type="hidden" name="rs_id" value="5">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Pelamar</label>
								<input type="text" id="people_fullname_kspm" class="form-control" readonly>
							</div>
		                    <div class="form-group">
								<label class="control-label">PIC</label>
		                        <select class="form-control select2 required" name="pic_kspm">
		                            <option></option>
		                            <?php
		                            	foreach ($listpic as $row){
		                            		echo '<option value="'.$row->pic_id.'">'.$row->pic_name.'</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
							<div class="form-group">
		                       	<label class="control-label">Tanggal</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input type="text" class="form-control datepicker required pull-right" name="interview_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. HP</label>
								<input type="text" class="form-control _CnUmB required" name="mobile" id="mobile_kspm" maxlength="15">
							</div>
							<div class="form-group">
								<label class="control-label">Lokasi</label>
		                        <select class="form-control select2 required" name="location" >
		                            <option></option>
		                            <?php
		                            	foreach ($listcity as $row){
		                            		echo '<option value="'.$row->city_id.'">'.$row->city_name.' ['.$row->province_name.']</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
							<div class="form-group">
		                       	<label class="control-label">Waktu</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-clock"></i>
		                          	</div>
		                          	<input type="text" class="form-control timepicker required pull-right" name="interview_time" maxlength="8" placeholder="hh-mm AM/PM"/>
		                       	</div>
		                    </div>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Batal</button>
					<button type="button" class="btn btn-danger btn-sm" id="btn_sms_kspm" >Kirim SMS</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-sms-teknis">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Kirim SMS <b>Interview Teknis</b></h4>
			</div>
			<form id="form-sms-teknis" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id_teknis">
				<input type="hidden" name="pelamar_id" id="pelamar_id_teknis">
				<input type="hidden" name="rs_id" value="2">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Pelamar</label>
								<input type="text" id="people_fullname_teknis" class="form-control" readonly>
							</div>
							<div class="form-group">
		                       	<label class="control-label">Tanggal</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input type="text" class="form-control datepicker required pull-right" name="interview_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
		                    <div class="form-group">
								<label class="control-label">PIC</label>
		                        <select class="form-control select2 required" name="pic_teknis">
		                            <option></option>
		                            <?php
		                            	foreach ($listpic as $row){
		                            		echo '<option value="'.$row->pic_id.'">'.$row->pic_name.'</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. HP</label>
								<input type="text" class="form-control _CnUmB required" name="mobile" id="mobile_teknis" maxlength="15">
							</div>
							<div class="form-group">
								<label class="control-label">Lokasi</label>
		                        <select class="form-control select2 required" name="location">
		                            <option></option>
		                            <?php
		                            	foreach ($listcity as $row){
		                            		echo '<option value="'.$row->city_id.'">'.$row->city_name.' ['.$row->province_name.']</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
							<div class="form-group">
		                       	<label class="control-label">Waktu</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-clock"></i>
		                          	</div>
		                          	<input type="text" class="form-control timepicker required pull-right" name="interview_time" maxlength="8" placeholder="hh-mm AM/PM"/>
		                       	</div>
		                    </div>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Batal</button>
					<button type="button" class="btn btn-danger btn-sm" id="btn_sms_teknis" >Kirim SMS</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-sms-teori">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Kirim SMS <b>Tes Teori</b></h4>
			</div>
			<form id="form-sms-teori" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id_teori">
				<input type="hidden" name="pelamar_id" id="pelamar_id_teori">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Pelamar</label>
								<input type="text" id="people_fullname_teori" class="form-control" readonly>
							</div>
							<div class="form-group">
		                       	<label class="control-label">Tanggal</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input type="text" class="form-control datepicker required pull-right" name="interview_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
		                    <div class="form-group">
								<label class="control-label">PIC</label>
		                        <select class="form-control select2" name="pic_teori">
		                            <option></option>
		                            <?php
		                            	foreach ($listpic as $row){
		                            		echo '<option value="'.$row->pic_id.'">'.$row->pic_name.'</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. HP</label>
								<input type="text" class="form-control _CnUmB required" name="mobile" id="mobile_teori" maxlength="15">
							</div>
							<div class="form-group">
								<label class="control-label">Lokasi</label>
		                        <select class="form-control select2" name="location" >
		                            <option></option>
		                            <?php
		                            	foreach ($listcity as $row){
		                            		echo '<option value="'.$row->city_id.'">'.$row->city_name.' ['.$row->province_name.']</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
							<div class="form-group">
		                       	<label class="control-label">Waktu</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-clock"></i>
		                          	</div>
		                          	<input type="text" class="form-control timepicker required pull-right" name="interview_time" maxlength="8" placeholder="hh-mm AM/PM"/>
		                       	</div>
		                    </div>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Batal</button>
					<button type="button" class="btn btn-danger btn-sm" id="btn_sms_teori">Kirim SMS</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-sms-praktek">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Kirim SMS <b>Tes Praktek</b></h4>
			</div>
			<form id="form-sms-praktek" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id_praktek">
				<input type="hidden" name="pelamar_id" id="pelamar_id_praktek">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Pelamar</label>
								<input type="text" id="people_fullname_praktek" class="form-control" readonly>
							</div>
							<div class="form-group">
		                       	<label class="control-label">Tanggal</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input type="text" class="form-control datepicker required pull-right" name="interview_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
		                    <div class="form-group">
								<label class="control-label">PIC</label>
		                        <select class="form-control select2" id="pic_praktek">
		                            <option></option>
		                            <?php
		                            	foreach ($listpic as $row){
		                            		echo '<option value="'.$row->pic_id.'">'.$row->pic_name.'</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. HP</label>
								<input type="text" class="form-control _CnUmB required" name="mobile" id="mobile_praktek" maxlength="15">
							</div>
							<div class="form-group">
								<label class="control-label">Lokasi</label>
		                        <select class="form-control select2" name="location">
		                            <option></option>
		                            <?php
		                            	foreach ($listcity as $row){
		                            		echo '<option value="'.$row->city_id.'">'.$row->city_name.' ['.$row->province_name.']</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
							<div class="form-group">
		                       	<label class="control-label">Waktu</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-clock"></i>
		                          	</div>
		                          	<input type="text" class="form-control timepicker required pull-right" name="interview_time" maxlength="8" placeholder="hh-mm AM/PM"/>
		                       	</div>
		                    </div>
						</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Batal</button>
					<button type="button" class="btn btn-danger btn-sm" id="btn_sms_praktek">Kirim SMS</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal" id="modal-sms-mcu">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Kirim SMS <b>Tes MCU</b></h4>
			</div>
			<form id="form-sms-mcu" action="#" method="post">
				<input type="hidden" name="people_id" id="people_id_mcu">
				<input type="hidden" name="pelamar_id" id="pelamar_id_mcu">
				<input type="hidden" name="rs_id" value="6">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Pelamar</label>
								<input type="text" id="people_fullname_mcu" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Site</label>
		                        <select class="form-control select2 required" name="site">
		                            <option></option>
		                            <?php
		                            	foreach ($listsite as $row){
		                            		echo '<option value="'.$row->KodeST.'">'.$row->NamaST.' ['.$row->KodeST.']</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
		                       	<label class="control-label">Tanggal MCU</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-calendar-alt"></i>
		                          	</div>
		                          	<input type="text" class="form-control datepicker required pull-right" name="mcu_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
		                    <div class="form-group">
	                            <label class="control-label">Lokasi Klinik</label>
		                        <select class="form-control select2 required" name="clinic_location">
		                            <option></option>
		                            <?php
		                            	foreach ($listcity as $row){
		                            		echo '<option value="'.$row->city_id.'">'.$row->city_name.' ['.$row->province_name.']</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">No. HP</label>
								<input type="text" class="form-control _CnUmB required" name="mobile" id="mobile_mcu" maxlength="15">
							</div>
							<div class="form-group">
		                       	<label class="control-label">Waktu</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon">
		                             	<i class="far fa-clock"></i>
		                          	</div>
		                          	<input type="text" class="form-control timepicker required pull-right" name="mcu_time" maxlength="8" placeholder="hh-mm AM/PM"/>
		                       	</div>
		                    </div>
							<div class="form-group">
								<label class="control-label">Nama Klinik</label>
		                        <select class="form-control select2 required" name="clinic_id" id="clinic_id">
		                            <option></option>
		                            <?php
		                            	foreach ($listclinic as $row){
		                            		echo '<option value="'.$row->clinic_id.'">'.$row->clinic_name.'</option>';
		                            	}
		                            ?>
		                        </select>
							</div>
							<div style="padding: 17px;"></div>
						</div>	
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Alamat Klinik</label>
								<textarea class="form-control required" maxlength="100" name="clinic_address" id="clinic_address"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" >Batal</button>
					<button type="button" class="btn btn-danger btn-sm" id="btn_sms_mcu">Kirim SMS</button>
				</div>
			</form>
		</div>
	</div>
</div>

<style type="text/css">.form-group .select2-container{ margin-bottom:0px !important; } .dataTables_filter{ display:none;} .dt-buttons{ margin-bottom: 10px; }</style>
<script type="text/javascript">
	function format ( d ){
		return '<table cellpadding="0" cellspacing="0" style="padding-left:0px;" class="table table-bordered no-margin">'+
		'<tr id="kspm">'+
			'<td>KSPM & HRD</td>'+
			'<td>'+d.kspm_status+'</td>'+
			'<td>'+d.kspm+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Teknis</td>'+
			'<td>'+d.teknis_status+'</td>'+
			'<td>'+d.teknis+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Tes Teori</td>'+
			'<td>'+d.teori_status+'</td>'+
			'<td>'+d.teori+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Tes Praktek</td>'+
			'<td>'+d.praktek_status+'</td>'+
			'<td>'+d.praktek+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Tes MCU</td>'+
			'<td>'+d.mcu_status+'</td>'+
			'<td>'+d.mcu+'</td>'+
		'</tr>'+
		'<tr>'+
			'<td>Status Seleksi Awal</td>'+
			'<td></td>'+
			'<td></td>'+
		'</tr>'+
		'</table>';
    }
	$(document).ready(function(){
		$("#recruit, #recruit-applicant, #recruit-treeview").addClass("active");
		$('.select2').select2({ placeholder: 'Pilih', allowClear: true });
		$('._CalPhaNum').alphanum({ allowNumeric: false, allow: '.-,' });
		$('._CnUmB').numeric({allowThouSep: true, allowDecSep: false, allowPlus: false, allowMinus: false });
		$('.datepicker').datepicker({ autoclose: true,format:"dd-mm-yyyy",todayHighlight:true,daysOfWeekHighlighted:"0",todayBtn:"linked" });
		$('.timepicker').timepicker({ showInputs: false });
		var table = $('#table_applicant').DataTable({
			"processing": true,
			"serverSide": true,
			"stateSave": true,
			"order": [],
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength', { text: 'Reload', action: function (e, dt, node, config){ table.ajax.reload(); }} ],
	        "lengthMenu": [ [10, 25, 50, 100],['10 Baris', '25 Baris', '50 Baris', '100 Baris'] ],
			"responsive": {
		        details: {
		            renderer: function (api, rowIdx, columns){
		                var data = $.map(columns, function (col, i){
		                    return col.hidden ?
		                        '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
		                            '<td>'+col.title+':'+'</td> '+
		                            '<td>'+col.data+'</td>'+
		                        '</tr>' : '';
		                }).join('');
		                return data ? $('<table/>').append(data): false;
		            }
		        }
		    },
			"ajax": {
				"url": '<?=site_url()?>web/table/applicant',
				"type": 'POST',
				data : function(data){
					data.people_fullname = $('#people_fullname').val();data.fullname = $('#fullname').val();data.KodeJB = $('#KodeJB').val();data.domisili = $('#domisili').val();data.freshgraduate = $('#freshgraduate').val();data.status_interview = $('#status_interview').val();
	            },
				error: function(data){ swal({ title: "", html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.', type: "", confirmButtonText: 'Okay' }).then(function(){ table.ajax.reload();});},
			},
			"language": { "processing": '<div class="loadings"><div class="spinner-wrapper"><span class="spinner-text">LOADING</span><span class="spinner"></span></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "sms", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "fg", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "age", "className": "text-center", "orderable": false },
				{ "data": "gender", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "position", "className": "text-left", "orderable": false },
				{ "data": "domisili", "className": "text-left", "orderable": false },
				{ "data": "date", "className": "text-center" },
				{ "data": "status", "className": "text-center", "orderable": false },
				{ "data": "action", "className": "text-center", "orderable": false },
			],
		});
		$('#btn-filter').click(function(){ table.ajax.reload(); });
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset(); $('#KodeJB').val(null).trigger('change'); table.ajax.reload(); });
		$('#hideshow').on('click', function(event){ $('#content-filter').toggle('show'); });
		$('#table_applicant tbody').on('click', 'a.details-control', function (){
			var tr  = $(this).closest('tr'), row = table.row( tr );
			if (row.child.isShown()){ row.child.hide();tr.removeClass('shown'); } else { row.child(format(row.data())).show();tr.addClass('shown'); }
		});
		$('#clinic_id').change(function() {
    		var opt = 'clinic_name=' + $(this).val();
    		$.ajax({
    			type: "POST",
    			url: "<?=site_url()?>web/get/clinic_address",
    			data: opt,
    			success:function(data){ $("#clinic_address").val(data); }
    		});
    	});
		$('#modal-sms-kspm').on('show.bs.modal', function (event){
			if (event.namespace == 'bs.modal'){
				var button = $(event.relatedTarget)
				var pid    = button.data('pid')
				var plid   = button.data('plid')
				var name   = button.data('name')
				var mobile = button.data('mobile')
				var modal  = $(this)
				modal.find('#people_id_kspm').val(pid)
				modal.find('#pelamar_id_kspm').val(plid)
				modal.find('#mobile_kspm').val(mobile)
				modal.find('#people_fullname_kspm').val(name)
			}
		});
		$("#btn_sms_kspm").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form-sms-kspm").serialize();
			if($("#form-sms-kspm").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>web/send/message/kspm",
				formdata,
				function(data) {
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-sms-kspm').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Berhasil kirim sms.', type: "", confirmButtonText: 'Okay' }).then(function(){ $('#form-sms-kspm')[0].reset(); $('.select2').val(null).trigger('change'); $('#table_applicant').DataTable().ajax.reload();});
					} else if(data == "Duplicate") {
						$("#loading").addClass("hidden");
						$('#modal-sms-kspm').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Sudah dikirim sms sebelumnya.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-sms-kspm').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dikirim. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});   
			}
		});
		$('#modal-sms-teknis').on('show.bs.modal', function(event){
			if (event.namespace == 'bs.modal'){
				var button = $(event.relatedTarget)
				var pid    = button.data('pid')
				var plid   = button.data('plid')
				var name   = button.data('name')
				var mobile = button.data('mobile')
				var modal  = $(this)
				modal.find('#people_id_teknis').val(pid)
				modal.find('#pelamar_id_teknis').val(plid)
				modal.find('#mobile_teknis').val(mobile)
				modal.find('#people_fullname_teknis').val(name)
			}
		});
		$("#btn_sms_teknis").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form-sms-teknis").serialize();
			if($("#form-sms-teknis").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>web/send/message/teknis",
				formdata,
				function(data){
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-sms-teknis').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Berhasil kirim sms.', type: "", confirmButtonText: 'Okay' }).then(function(){ $('#form-sms-teknis')[0].reset(); $('.select2').val(null).trigger('change'); $('#table_applicant').DataTable().ajax.reload();});
					} else if(data == "Duplicate") {
						$("#loading").addClass("hidden");
						$('#modal-sms-teknis').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Sudah dikirim sms sebelumnya.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-sms-teknis').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dikirim. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});   
			}
		});
		$('#modal-sms-teori').on('show.bs.modal', function (event){
			if (event.namespace == 'bs.modal'){
				var button = $(event.relatedTarget)
				var pid    = button.data('pid')
				var plid   = button.data('plid')
				var name   = button.data('name')
				var mobile = button.data('mobile')
				var modal  = $(this)
				modal.find('#people_id_teori').val(pid)
				modal.find('#pelamar_id_teori').val(plid)
				modal.find('#mobile_teori').val(mobile)
				modal.find('#people_fullname_teori').val(name)
			}
		});
		$('#modal-sms-praktek').on('show.bs.modal', function (event){
			if (event.namespace == 'bs.modal'){
				var button = $(event.relatedTarget)
				var pid    = button.data('pid')
				var plid   = button.data('plid')
				var name   = button.data('name')
				var mobile = button.data('mobile')
				var modal  = $(this)
				modal.find('#people_id_praktek').val(pid)
				modal.find('#pelamar_id_praktek').val(plid)
				modal.find('#mobile_praktek').val(mobile)
				modal.find('#people_fullname_praktek').val(name)
			}
		});
		$('#modal-sms-mcu').on('show.bs.modal', function (event){
			if (event.namespace == 'bs.modal'){
				var button = $(event.relatedTarget)
				var pid    = button.data('pid')
				var plid   = button.data('plid')
				var name   = button.data('name')
				var mobile = button.data('mobile')
				var modal  = $(this)
				modal.find('#people_id_mcu').val(pid)
				modal.find('#pelamar_id_mcu').val(plid)
				modal.find('#mobile_mcu').val(mobile)
				modal.find('#people_fullname_mcu').val(name)
			}
		});
		$("#btn_sms_mcu").click(function (){
			$("#loading").removeClass("hidden");
			var formdata = $("#form-sms-mcu").serialize();
			if($("#form-sms-mcu").valid() == false){
				toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
				$("#loading").addClass("hidden");
				return false;
			} else {
				$.post("<?=base_url();?>web/send/message/mcu",
				formdata,
				function(data) {
					if(data == "Success"){
						$("#loading").addClass("hidden");
						$('#modal-sms-mcu').modal('hide');
						swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Berhasil kirim sms.', type: "", confirmButtonText: 'Okay' }).then(function(){ $('#form-sms-mcu')[0].reset(); $('.select2').val(null).trigger('change'); $('#table_applicant').DataTable().ajax.reload();});
					} else if(data == "Duplicate") {
						$("#loading").addClass("hidden");
						$('#modal-sms-mcu').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Sudah dikirim sms sebelumnya.', type: "", confirmButtonText: 'Okay' });
					} else if(data == "Unfulfilled") {
						$("#loading").addClass("hidden");
						$('#modal-sms-mcu').modal('hide');
						swal({ title: "", html: '<i class="fas fa-info-circle f40 margin10 text-orange"></i><br>Ada tahap yang belum dilaksanakan. MCU dapat dilaksanakan ketika semua tahap (Seleksi berkas, Interview HRD & Teknis / Tes Teori / Tes Praktek) telah terpenuhi sesuai dengan persyaratan tahapan loker.', type: "", confirmButtonText: 'Okay' });
					} else {
						$("#loading").addClass("hidden");
						$('#modal-sms-mcu').modal('hide');
						swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dikirim. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
					}
				});   
			}
		});
	});
	function detailApplicant(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>web/detail/applicant/"+id);
	}
</script>
