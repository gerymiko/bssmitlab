<section class="content-header" id="header-content">
	<h1><span class="label no-padding text-black">Data Pelamar MCU</span></h1>
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
				<div class="col-md-3">
					<div class="form-group" style="margin-bottom: 0px;">
	                  	<input type="text" class="form-control _CalPhaNum" id="people_fullname" placeholder="Nama Lengkap">
	                </div>
				</div>
				<div class="col-md-2">
	                <div class="form-group" style="margin-bottom: 0px;">
                        <select class="form-control select2" id="interview_site">
                            <option></option>
                            <?php
	                        	foreach ($listsite as $row) {
	                        		echo '<option value="'.$row->KodeST.'">'.$row->NamaST.' ['.$row->KodeST.']</option>';
	                        	}
	                        ?>
                        </select>
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
				<div class="col-md-3">
	                <div class="form-group" style="margin-bottom: 0px;">
	                  	<input type="text" class="form-control" id="date_range" placeholder="Tgl Interview">
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
			<table id="table_applicant_medical" class="table table-border table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th></th>
						<th class="text-center">Nama</th>
						<th>Pend.</th>
						<th>Usia</th>
						<th>JK</th>
						<th>Domisili</th>
						<th class="text-center">Posisi</th>
						<th>Tgl Lamar</th>
						<th>Site</th>
						<th>Tahap</th>
						<th>Status</th>
						<th class="text-center">Ket.</th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="box-footer">
			<div class="row">
				<div class="col-md-2 info-status">
					Keterangan kode status :
				</div>
				<div class="col-md-2 info-status">
					<b>BI</b> = Belum Interview
				</div>
				<div class="col-md-2 info-status">
					<b>TD</b> = Tunda
				</div>
				<div class="col-md-2 info-status">
					<b>BL</b> = Blacklist
				</div>
				<div class="col-md-2 info-status">
					<b>TL</b> = Tidak Lulus
				</div>
				<div class="col-md-2 info-status">
					<b>LS</b> = Lulus
				</div>
			</div>
		</div>
	</div>
</section>
<div class="modal" id="modal-desicion-mcu">
	<div class="modal-dialog modal700">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Form Hasil MCU</h4>
			</div>
			<form id="form_decision_mcu" action="#" method="post">
				<input type="hidden" name="id" id="id">
				<input type="hidden" name="people_id" id="people_id">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Lengkap</label>
								<input type="text" id="fullname" class="form-control" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Kode Registrasi</label>
								<input type="text" id="people_noreg" class="form-control" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Hasil MCU</label>
								<select name="mcu_result" id="mcu_result" class="form-control select2 pull-right required">
					                <option></option>
					                <option value="FIT">FIT</option>
					                <option value="UNFIT">UNFIT</option>
					                <option value="FIT WITH NOTE">FIT WITH NOTE</option>
					                <option value="TEMPORARY">TEMPORARY</option>
					            </select>
							</div>
							<div style="padding: 15px;"></div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Apakah pelamar lulus ?</label>
								<select class="form-control required select2" name="statusinterview" id="statusinterview">
									<option value="">Pilih</option>
									<option value="2Tunda">Tunda</option>
									<option value="1Lanjut Agreement">Lanjut Agreement</option>
									<option value="0Blacklist">Blacklist</option>
									<option value="0Gagal MCU">Gagal MCU</option>
								</select>
							</div>
							<div style="padding: 15px;"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Keterangan (Lulus / Tidak Lulus)</label>
								<textarea name="conclusion_ket" id="conclusion_ket" class="form-control _CalPhaNum required" row="3" maxlength="100" placeholder="Ketik disini"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
		                       	<label class="control-label">Tanggal MCU</label>
		                       	<div class="input-group date">
		                          	<div class="input-group-addon"> <i class="far fa-calendar-alt"></i></div>
		                          	<input type="text" class="form-control data-mask required pull-right" name="mcu_date" id="mcu_date" maxlength="10" placeholder="dd-mm-yyyy"/>
		                       	</div>
		                    </div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
		            <button type="button" class="btn btn-primary" id="btn_sv_mcu">Simpan</button>
		            <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
		        </div>
			</form>
		</div>
	</div>
</div>
<style type="text/css"> .form-group .select2-container{ margin-bottom:0px !important; } div.dt-buttons{ padding-bottom: 5px; } .dataTables_filter { display: none; }</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#recman, #recman-applicant-mcu").addClass("active");
		$('.select2').select2({ placeholder: 'Pilih', allowClear: true });
		$('.data-mask').inputmask('dd-mm-yyyy');
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '.-,' });
		$('._CnUmB').numeric({allowThouSep: true,	allowDecSep: false, allowPlus: false, allowMinus: false });
		$('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Batal', format:'DD-MM-YYYY'} });
		$('#date_range').on('apply.daterangepicker', function(ev, picker){ $(this).val(picker.startDate.format('DD-MM-YYYY') + ' sd ' + picker.endDate.format('DD-MM-YYYY'));});
        $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
        var oldExportAction = function (self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                } else { $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);}
            } else if (button[0].className.indexOf('buttons-print') >= 0) { $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);}
        };
        var newExportAction = function (e, dt, button, config) {
            var self = this, oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    oldExportAction(self, e, dt, button, config);
                    dt.one('preXhr', function (e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });
            dt.ajax.reload();
        };
		var table = $('#table_applicant_medical').DataTable({
			"processing": true,
			"serverSide": true,
			"stateSave": true,
			"ordering": false,
			"responsive": true,
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength', { extend : 'excel', text : 'Export Excel', action: newExportAction }, { text: 'Reload',
            	action: function (e, dt, node, config){ table.ajax.reload(); }}],
	        "lengthMenu": [ [10, 25, 50, 100], ['10 Baris', '25 Baris', '50 Baris', '100 Baris'] ],
			"ajax": {
				"url": '<?=site_url()?>form/table/medical',
				"type": 'POST',
				"data" : function(data){
					data.people_fullname = $('#people_fullname').val();data.KodeJB = $('#KodeJB').val();data.interview_site = $('#interview_site').val();data.interview_status = $('#interview_status').val();data.date_range = $('#date_range').val();},
				error: function(data){ swal({ title: "", html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.', type: "", confirmButtonText: 'Okay'}).then(function(){ table.ajax.reload(); });},
			},
			"language": { "processing": '<div class="loadings"><div class="spinner-wrapper"><span class="spinner-text">LOADING</span><span class="spinner"></span></div></div>' },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false },
				{ "data": "detail", "className": "text-center", "searchable": false },
				{ "data": "name", "className": "text-left" },
				{ "data": "edu", "className": "text-center", "searchable": false },
				{ "data": "age", "className": "text-center", "searchable": false },
				{ "data": "gender", "className": "text-center", "searchable": false },
				{ "data": "domisili", "className": "text-center", "searchable": false, "visible": false },
				{ "data": "position", "className": "text-left" },
				{ "data": "date", "className": "text-center" },
				{ "data": "site", "className": "text-center" },
				{ "data": "stage", "className": "text-center" },
				{ "data": "status", "className": "text-center" },
				{ "data": "desc", "className": "text-left" },
				{ "data": "action", "className": "text-center", "searchable": false },
			],
		});
		$('#btn-filter').click(function(){ table.ajax.reload();});
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset();$('.select2').val(null).trigger('change');table.ajax.reload();});
		$('#hideshow').on('click', function(event){ $('#content-filter').toggle('show'); });
	});
	$('#modal-desicion-mcu').on('show.bs.modal', function (event) {
		if (event.namespace == 'bs.modal') {
			var button = $(event.relatedTarget)
			var id     = button.data('id')
			var people_id = button.data('people_id')
			var fullname  = button.data('fullname')
			var noreg = button.data('noreg')
			var modal = $(this)
			modal.find('#id').val(id)
			modal.find('#people_id').val(people_id)
			modal.find('#fullname').val(fullname)
			modal.find('#people_noreg').val(noreg)
		}
	});
	function detailApplicant(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>crecruit/manual/applicant/sysdetail/detail_applicant/"+id, function(){
			$(".select2").select2({ placeholder: "Pilih", allowClear: true });
			$('.data-mask').inputmask('dd-mm-yyyy');
			$('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
		});
	}
	function detailInterview(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>crecruit/manual/interview/sysdetail/detail_interview/"+id, function(){
			$(".select2").select2({ placeholder: "Pilih", allowClear: true });
			$('.data-mask').inputmask('dd-mm-yyyy');
			$('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
		});
	}

	$("#btn_sv_mcu").click(function (){
		$("#loading").removeClass("hidden");
		var formdata = $("#form_decision_mcu").serialize();
		if($("#form_decision_mcu").valid() == false){
			toastr.error('Terdapat kesalahan dalam pengisian data. Cek kembali data yang diinputkan.');
			$("#loading").addClass("hidden");
			return false;
		} else {
			$.post("<?=base_url();?>form/add/medical",
			formdata,
			function(data){
				if(data == "Success"){
					$("#loading").addClass("hidden");
					$('#modal-desicion-mcu').modal('hide');
					swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil disimpan.', type: "", confirmButtonText: 'Okay', allowOutsideClick: false }).then(function(){ $('#table_applicant_medical').DataTable().ajax.reload();});
				} else {
					$("#loading").addClass("hidden");
					$('#modal-desicion-mcu').modal('hide');
					swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal disimpan. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay' });
				}
			});
		}
	});
	function removeData(id, name){
	    swal({
	        title: "",
	        html: '<i class="fas fa-question-circle f40 margin10 text-red"></i><br>Hapus data ini (<b>'+name+'</b>).',
	        type: "",
	        showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: 'Okay, hapus',
			confirmButtonAriaLabel: 'Ok',
			cancelButtonText: '<i class="fas fa-times"></i>',
			cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>form/remove/applicant",
					type: "post",
					data: { id:id },
					success:function(data){
						if(data == "Success"){
							swal({ title: "", html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.', type: "",
						        confirmButtonText: 'Okay'});
						    $('#table_applicant').DataTable().ajax.reload();
						} else {
							swal({ title: "", html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dihapus. Muat ulang halaman ini dan coba lagi.', type: "", confirmButtonText: 'Okay'});
						}
					},
				});
			}
        });
	}
</script>