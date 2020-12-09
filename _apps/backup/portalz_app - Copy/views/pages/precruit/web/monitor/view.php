<section class="content-header" id="header-content">
   <h1>Monitoring <b>Interview</b><small>Web</small></h1>
   <ol class="breadcrumb">
      	<li><a href="#">Rekrutmen</a></li>
      	<li><a href="#">Web</a></li>
      	<li class="active">Monitoring Interview</li>
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
				<div class="col-md-3">
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
				<div class="col-md-3">
	                <div class="form-group" style="margin-bottom: 0px;">
	                  	<select class="form-control hand" id="lowongan_status">
	                  		<option>Pilih Status Lowongan</option>
	                  		<option value="1">Buka </option>
	                  		<option value="0">Tutup </option>
	                  	</select>
	                </div>
	            </div>
	            <div class="col-md-1 text-center desktop">
	            	<div class="form-group" style="margin-bottom: 0px;">
						<button type="button" id="btn-filter" class="btn btn-flat btn-danger red-tooltip" data-toggle="tooltip" title="Filter"><i class="fas fa-filter"></i></button>
						<button type="button" id="btn-reset" class="btn btn-flat btn-default red-tooltip" data-toggle="tooltip" title="Reset"><i class="fas fa-sync"></i></button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="box">
		<div class="box-body slider-table">
			<table id="table_monitor" class="table table-bordered table-hover" style="width: 100%">
				<thead class="bg-cgray">
					<tr>
						<th>No</th>
						<th class="text-center">Nama Lengkap</th>
						<th class="text-center">Posisi</th>
						<th class="text-center">Domisili</th>
						<th>Tgl Lamar</th>
						<th class="bg-gray">HRD</th>
						<th class="bg-gray">Teknis</th>
						<th class="bg-gray">Teori</th>
						<th class="bg-gray">Praktek</th>
						<th class="bg-gray">MCU</th>
						<th class="bg-gray">Agreement</th>
						<th><i class="fas fa-cog"></i></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<style type="text/css"> 
	.form-group .select2-container{ margin-bottom:0px !important; }
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#recruit, #monitor-treeview, #monitor-recap").addClass("active");
		$('._CalPhaNum').alphanum({ allowNumeric: false, allow: '.-,' });
		$('._CnUmB').numeric({allowThouSep: true,	allowDecSep: false, allowPlus: false, allowMinus: false });
		var oldExportAction = function (self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                }
                else {
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
		var table = $('#table_monitor').DataTable({
			"processing": true,
			"serverSide": true,
			"stateSave": true,
			// "scrollX": true,
			"responsive": false,
			"dom": 'Bfrtip',
	        "buttons": [ 'pageLength', { extend : 'excel', text : 'Export Excel', action: newExportAction }],
	        "lengthMenu": [
	        	[10, 25, 50, 100], 
	        	['10 Baris', '25 Baris', '50 Baris', '100 Baris']
	        ],
			"order": [],
			"ajax": {
				"url": '<?=site_url()?>crecruit/web/monitor/sysmonitor/table_monitor',
				"type": 'POST',
				"data" : function(data){
					data.people_fullname = $('#people_fullname').val();
					data.KodeJB          = $('#KodeJB').val();
					data.domisili        = $('#domisili').val();
					data.lowongan_status = $('#lowongan_status').val();
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
			"language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>'},
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left", "orderable": false },
				{ "data": "position", "className": "text-left", "orderable": false  },
				{ "data": "domisili", "className": "text-left", "orderable": false  },
				{ "data": "date", "className": "text-center"  },
				{ "data": "hrd", "className": "text-center", "orderable": false  },
				{ "data": "teknis", "className": "text-center", "orderable": false  },
				{ "data": "teori", "className": "text-center", "orderable": false  },
				{ "data": "praktek", "className": "text-center", "orderable": false  },
				{ "data": "mcu", "className": "text-center", "orderable": false  },
				{ "data": "agree", "className": "text-center", "orderable": false  },
				{ "data": "action", "className": "text-center", "orderable": false  },
			]
		});
		$('#btn-filter').click(function(){ table.ajax.reload(); });
		$('#btn-reset').click(function(){
			$('#form-filter')[0].reset();
			$('#KodeJB').val(null).trigger('change');
			table.ajax.reload();
		});
		$('#hideshow').on('click', function(event) { $('#content-filter').toggle('show'); });
	});

	function detailApplicant(id){
		$("#main-content, #header-content").addClass("hidden");
		$("#extra-content").removeClass("hidden");
		$("#extra-content").load("<?=site_url()?>crecruit/web/applicant/sysdetail/detail_applicant/"+id);
	}
</script>