<section class="content-header" id="header-content">
   	<h1>Data <b>Pelamar</b><small>Manual</small></h1>
   	<ol class="breadcrumb">
      	<li><a href="#">Rekrutmen</a></li>
      	<li><a href="#">Manual</a></li>
      	<li class="active">Data Pelamar</li>
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
	                  		<option value="1">Lulus (LS)</option>
	                  		<option value="2">Tunda (TD)</option>
	                  		<option value="3">Belum Interview (BI)</option>
	                  		<option value="4">Blacklist (BL)</option>
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
		<div class="box-header with-border">
			<h3 class="box-title"></h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-primary btn-sm" onclick="addApplicant();">
					+ Pelamar
				</button>
			</div>
		</div>
		<div class="box-body">
			<table id="table_applicant" class="table table-bordered table-hover" style="width:100%">
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
		$("#recman, #recman-applicant").addClass("active");
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
		var table = $('#table_applicant').DataTable({
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
				"url": '<?=site_url()?>recman/table/applicant',
				"type": 'POST',
				"data" : function(data){
					data.people_fullname  = $('#people_fullname').val();
					data.KodeJB           = $('#KodeJB').val();
					data.interview_site   = $('#interview_site').val();
					data.interview_status = $('#interview_status').val();
					data.date_range       = $('#date_range').val();
	            },
				error: function(data){
					swal({
				        title: "",
				        html: '<i class="fas fa-exclamation-circle f40 margin10 text-orange"></i><br>Gagal menarik data. Klik OK untuk menarik data kembali.',
				        type: "",
				        confirmButtonText: 'Okay',
				    }).then(function(){ table.ajax.reload(); });
				},
			},
			"language": { 
				"processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>'
			},
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
			"createdRow": function( row, data, dataIndex){
                if( data['status'] == 'BL'){ $(row).addClass('text-red text-bold'); }
                if( data['desc'] == 'Lanjut MCU'){ $(row).addClass('text-green'); }
            },
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
	function btn_interview(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>recman/interview/view/start/"+id, function(){
    		$(".select2").select2({ placeholder: "Pilih", allowClear: true });
    		localStorage.clear();
		});
	}
	function addApplicant(){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>recman/applicant/view/add/applicant", function(){
    		$(".select2").select2({ placeholder: "Pilih", allowClear: true });
    		$('.datepicker').datepicker({ autoclose: true,format:"dd-mm-yyyy",todayHighlight:true,daysOfWeekHighlighted:"0",todayBtn:"linked" });
    		localStorage.clear();
    		$('.modal').on('hidden.bs.modal', function(){ var modal = $(this);modal.validate().resetForm();modal.find('.error').removeClass('error'); });
		});
	}
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
								$('#table_applicant').DataTable().ajax.reload();
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