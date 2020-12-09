<section class="content-header">
   	<h1>Web Logs <small class="text-blue">Logging and Tracing</small></h1>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-header">
			<form id="form-filter" action="#" class="form-horizontal" >
				<div class="col-md-3 mobile">
					<div class="form-group mobile">
						<div class="input-group">
		            		<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
		            		<input type="text" class="form-control _CalPhaNum required" id="date_range" name="date_range" placeholder="Choose date">
		          		</div>
		          	</div>
		        </div>
		        <div class="col-md-2 mobile">
					<div class="form-group mobile">
						<input type="text" id="nik" name="nik" class="form-control" placeholder="NIK" maxlength="10">
		          	</div>
		        </div>
		        <div class="col-md-3 mobile">
					<div class="form-group mobile">
						<input type="text" id="fullname" name="fullname" class="form-control" placeholder="Name" maxlength="50">
		          	</div>
		        </div>
		        <div class="col-md-2 mobile">
					<div class="form-group mobile">
						<input type="text" id="ip_address" name="ip_address" class="form-control" placeholder="IP Address" maxlength="15">
		          	</div>
		        </div>
		        <div class="col-md-1 mobile">
		        	<div class="form-group mobile">
						<button type="button" id="btn-filter" class="btn btn-flat btn-danger" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
						<button type="button" id="btn-reset" class="btn btn-flat btn-default" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
					</div>
				</div>
			</form>
		</div>
		<div class="box-body">
			<table id="table_logs" class="table table-bordered table-hover nowrap" width="100%" style="color: #262D37;">
				<thead class="bg-cgray">
					<tr>
						<th>#</th>
						<th class="text-center">Level</th>
						<th class="text-center">NIK</th>
						<th class="text-center">Fullname</th>
						<th class="text-center">Module</th>
						<th class="text-center">Logs</th>
						<th class="text-center">IP</th>
						<th class="text-center">Time</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<style type="text/css">.form-group .select2-container{ margin-bottom: 0; }</style>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '_-' });
		$(".select2").select2({ placeholder: "Choose", allowClear: true });
		$('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' } });
	    $('#date_range').on('apply.daterangepicker', function(ev, picker){
	        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
	    });
	    $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
		$('#link-logs').addClass('active');
		var table = $('#table_logs').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"dom": 'Bfrtip',
			"buttons": ['pageLength'],
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>dtable/logs/<?=$this->uri->segment(3)?>',
				"type" : 'POST',
				data : function(data){ 
					data.date_range = $("#date_range").val();
					data.fullname = $("#fullname").val();
					data.nik = $("#nik").val();
					data.ip_address = $("#ip_address").val();
				},
				error: function(data){swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){ table.ajax.reload(); });},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "level", "className": "text-center", "orderable": false },
				{ "data": "nik", "className": "text-center", "orderable": false},
				{ "data": "name", "className": "text-left", "orderable": false},
				{ "data": "module", "className": "text-left", "orderable": false },
				{ "data": "logs", "className": "text-left", "orderable": false },
				{ "data": "ip", "className": "text-center", "orderable": false },
				{ "data": "time", "className": "text-center", "searchable": false }
			]
		});
		$('#btn-filter').click(function(){ table.ajax.reload();});
		$('#btn-reset').click(function(){ $('#form-filter')[0].reset();$(".select2").val([]).trigger('change'); table.ajax.reload();});
	});
</script>