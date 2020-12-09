<section class="content-header" id="header-content">
   	<h1>Pelamar <b>Gagal</b><small>Manual</small></h1>
   	<ol class="breadcrumb">
      	<li><a href="#">Rekrutmen</a></li>
      	<li><a href="#">Manual</a></li>
      	<li class="active">Pelamar Gagal</li>
  	 </ol>
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
				<div class="col-md-2">
	                <div class="form-group" style="margin-bottom: 0px;">
	                  	<input type="text" class="form-control" id="date_range" placeholder="Tgl Interview">
	                </div>
	            </div>
	            <div class="col-md-2">
	            	<div class="form-group" style="margin-bottom: 0px;">
	                  	<select class="form-control" id="interview_status">
	                  		<option>Pilih Status</option>
	                  		<option value="Gagal Berkas">Gagal Berkas</option>
	                  		<option value="Gagal Interview HRD">Gagal Interview HRD</option>
	                  		<option value="Gagal Interview Teknis">Gagal Interview Teknis</option>
	                  		<option value="Gagal Teori">Gagal Teori</option>
	                  		<option value="Gagal Praktek">Gagal Praktek</option>
	                  		<option value="Gagal MCU">Gagal MCU</option>
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
			<table id="table_applicant_failed" class="table table-bordered table-hover" style="width:100%">
				<thead class="bg-cgray">
					<tr>
						<th>No</th>
						<th>#</th>
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
						<th><i class="fas fa-cog"></i></th>
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
<style type="text/css"> .form-group .select2-container{ margin-bottom:0px !important; } div.dt-buttons{ padding-bottom: 5px; } .dataTables_filter { display: none; }</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#recman, #recman-applicant-fail").addClass("active");
		$('._CalPhaNum').alphanum({ allowNumeric: false, allow: '.-,' });
		$('._CnUmB').numeric({allowThouSep: true,	allowDecSep: false, allowPlus: false, allowMinus: false });
		$('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Batal' } });
		$('#date_range').on('apply.daterangepicker', function(ev, picker){
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' sd ' + picker.endDate.format('DD-MM-YYYY'));
        });
        $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
        var oldExportAction = function (self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                } else {
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                }
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
        };
        var newExportAction = function (e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
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
		var table = $('#table_applicant_failed').DataTable({
			"processing": true,
			"serverSide": true,
			"stateSave": true,
			"ordering": false,
			"responsive": true,
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength', { extend : 'excel', text : 'Export Excel', action: newExportAction }],
	        "lengthMenu": [
	        	[10, 25, 50, 100], 
	        	['10 Baris', '25 Baris', '50 Baris', '100 Baris']
	        ],
			"ajax": {
				"url": '<?=site_url()?>recman/table/failed/applicant',
				"type": 'POST',
				"data" : function(data){
					data.people_fullname  = $('#people_fullname').val();
					data.KodeJB           = $('#KodeJB').val();
					data.interview_site   = $('#interview_site').val();
					data.date_range       = $('#date_range').val();
					data.interview_status = $('#interview_status').val();
	            },
				error: function(data){
					swal({
				        title: "",
				        html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.',
				        type: "",
				        confirmButtonText: 'Okay',
				    }).then(function(){
						table.ajax.reload();
					});
				},
			},
			"language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>' },
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
		$('#btn-reset').click(function(){
			$('#form-filter')[0].reset();
			$('.select2').val(null).trigger('change');
			table.ajax.reload();
		});
		$('#hideshow').on('click', function(event){ $('#content-filter').toggle('show'); });
	});
	function detailApplicant(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>recman/applicant/view/detail/"+id, function(){
			$(".select2").select2({ placeholder: "Pilih", allowClear: true });
			$('.data-mask').inputmask('dd-mm-yyyy');
			$('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
		});
	}
	function detailInterview(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>recman/interview/view/detail/"+id, function(){
			$(".select2").select2({ placeholder: "Pilih", allowClear: true });
			$('.data-mask').inputmask('dd-mm-yyyy');
			$('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
		});
	}
	function btn_reinterview(id, name, period){
	    swal({
	        title: "",
	        html: '<i class="fas fa-question-circle f40 margin10 text-purple"></i><br>Lakukan <b>interview ulang</b>, untuk pelamar <b>'+name+'<b>'+' ?',
	        type: "",
	        showCancelButton: true,
			focusConfirm: false,
			confirmButtonText: 'Okay, lanjutkan',
			confirmButtonAriaLabel: 'Ok',
			cancelButtonText: '<i class="fas fa-times"></i>',
			cancelButtonAriaLabel: 'Batal',
	    }).then((result) => {
			if (result.value) {
			    $.ajax({
					url: "<?=site_url()?>recman/interview/repeat",
					type: "post",
					data: {id:id},
					success:function(result){
						if (result == "Success"){
							swal({
						        title: "",
						        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Pelamar berhasil diaktivasi (<b>'+name+'</b>).',
						        type: "",
						        confirmButtonText: 'Okay',
						    });
							$('#table_applicant').DataTable().ajax.reload();
							$('#table_applicant_failed').DataTable().ajax.reload();
							$('#table_applicant_medical').DataTable().ajax.reload();
						} else if (result == "NotThisTime"){
							swal({
						        title: "",
						        html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Maaf anda belum bisa melakukan interview kembali pada pelamar (<b>'+name+'</b>), karena masa aktif (<b>+6 bulan</b>) belum terlewati.<br>Tanggal aktif (<b>'+period+'</b>)',
						        type: "",
						        confirmButtonText: 'Okay, Saya mengerti',
						    });
						} else if (result == "StillRunning"){
							swal({
						        title: "",
						        html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Maaf interview kembali tidak dapat dilakukan pada pelamar (<b>'+name+'</b>) karena sedang diproses.',
						        type: "",
						        confirmButtonText: 'Okay, Sorry',
						    });
						} else {
							swal({
						        title: "",
						        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal diproses. Muat ulang halaman ini dan coba lagi.',
						        type: "",
						        confirmButtonText: 'Okay',
						    });
						}
					},
				});
			}
        });
  	};
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
					url: "<?=site_url()?>recman/applicant/remove/applicant",
					type: "post",
					data: { id:id },
					success:function(data){
						if(data == "Success"){
							swal({
						        title: "",
						        html: '<i class="fas fa-check-circle f40 margin10 text-green"></i><br>Data berhasil dihapus.',
						        type: "",
						        confirmButtonText: 'Okay',
						    }).then(function(){
								$('#table_applicant_failed').DataTable().ajax.reload();
							});
						} else {
							swal({
						        title: "",
						        html: '<i class="fas fa-times-circle f40 margin10 text-red"></i><br>Gagal dihapus. Muat ulang halaman ini dan coba lagi.',
						        type: "",
						        confirmButtonText: 'Okay',
						    });
						}
					},
				});
			}
        });
    }
</script>