<section class="content-header">
	<h1><a href="<?=site_url();?>menu/dashboard/<?=$detailOFF->site?>" class="btn btn-sm bg-red no-radius padding-btn" data-tooltip="Go Back" data-tooltip-location="right"><i class="fas fa-chevron-left"></i></a> <span class="label">Detail Genset Office - <b><?=$detailOFF->no_lambung?></b></span></h1>
	<ol class="breadcrumb">
		<li><a href="#" class="text-blue"><i class="fa fa-dashboard"></i> Dashboard</a></li>
		<li class="active">Detail</li>
		<li class="active"><?=$detailOFF->no_lambung?></li>
	</ol>
</section>
<section class="content" style="min-height: 60px;">
	<form id="form-filter" action="#" class="form-horizontal" >
		<div class="col-md-5 mobile">
			<div class="form-group mobile">
				<div class="input-group">
            		<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
            		<input type="text" class="form-control _CalPhaNum required" id="date_range" name="date_range" placeholder="Choose date">
          		</div>
          		<label for="date_range" generated="true" class="error"></label>
          	</div>
        </div>
        <div class="col-md-2 mobile">
			<div class="form-group mobile">
				<div class="btn-group">
	              	<button type="button" id="btn-filter" class="btn btn-danger btn-flat marg" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
	              	<button type="button" id="btn-reset" class="btn btn-default btn-flat marg" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
	              	<button type="button" id="btn-export" class="btn btn-success btn-flat marg" data-tooltip="Export"><i class="fas fa-file-excel f17"></i></button>
	            </div>
	        </div>
		</div>
	</form>
</section>
<section class="content">
	<div class="box no-radius">
		<div class="box-body">
			<table id="table_detail_office" class="table table-bordered table-hover" style="width:100%">
				<thead class="bg-cgray">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Unit Number</th>
						<th class="text-center">Type</th>
						<th class="text-center">Status</th>
						<th class="text-center">Time Start</th>
						<th class="text-center">Time End</th>
						<th class="text-center">HM Start</th>
						<th class="text-center">HM End</th>
						<th class="text-center">HM Total</th>
						<th class="text-center">Site</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		$('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' } });
	    $('#date_range').on('apply.daterangepicker', function(ev, picker){
	        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
	    });
	    $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
	    $('#hideshow').on('click', function(event){ $('#content-filter').toggle('show'); });
	    var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('._CalPhaNum').alphanum({allowNumeric: true, allow: '.-/'});
		$('#link-dashboard').addClass('active');
		var tableDOFF = $('#table_detail_office').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
	       	"order": [],
	       	"dom": 'Bfrtip',
            "buttons": ['pageLength'],
			"ajax": {
				"url"  : '<?=site_url('dtable/office/').$detailOFF->site.'/'.$this->my_encryption->encode($detailOFF->no_lambung)?>',
				"type" : 'POST',
				error: function(data){
				   	swal({
				      	animation: false,
				      	focusConfirm: false,
				      	text: "Failed to pull data. Click OK to get data"
				    }).then(function(){ tableDOFF.ajax.reload(); });
				},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false},
				{ "data": "unit", "className": "text-center", "orderable": false, "orderable": false },
				{ "data": "type", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "status", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "timestart", "className": "text-center", "searchable": false},
				{ "data": "timeend", "className": "text-center", "searchable": false},
				{ "data": "hmstart", "className": "text-center", "searchable": false },
				{ "data": "hmend", "className": "text-center", "searchable": false },
				{ "data": "hmtotal", "className": "text-center", "searchable": false },
				{ "data": "site", "className": "text-center", "searchable": false, "orderable": false }
			]
		});
		$('#btn-filter').click(function(){ if($("#form-filter").valid() == false){ toastr.error('Select date range or input unit number first!'); return false; }else{ tableDOFF.ajax.reload();}});
		$('#btn-reset').click(function(){
			$('#form-filter')[0].reset();
			tableDOFF.ajax.reload();
		});
		$('#btn-export').click(function(){
            if($("#form-filter").valid() == false){
                toastr.error('Select a date range first!');
                return false;
            } else {
                var date_range = $('#date_range').val().split(' - '),
                date_start = date_range[0],
                date_end   = date_range[1],
                date_start_new = date_start.replace(/\//g, '-'),
                date_end_new   = date_end.replace(/\//g, '-');
                if (<?=$accessRights->export_permission?> == 0) {
                	toastr.error('You do not have access to export data.');
                } else {
                	window.open('<?=site_url()?>export/office/<?=$detailOFF->site?>/<?=$this->my_encryption->encode($detailOFF->no_lambung)?>/'+date_start_new+'/'+date_end_new);
                }
            }
        });
	});
</script>