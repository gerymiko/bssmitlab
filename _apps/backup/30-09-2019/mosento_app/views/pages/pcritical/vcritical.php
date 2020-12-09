<section class="content-header">
	<h1>Warning Status Unit</h1>
	<ol class="breadcrumb">
		<li><a href="<?=site_url();?>dashboard">Home</a></li>
		<li class="active">Critical Report</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="info-box">
	            <span class="info-box-icon"><i class="fas fa-exclamation-triangle text-red"></i></span>
	            <div class="info-box-content">
	              	<span class="info-box-text f15">Today Critical</span>
	              	<span class="info-box-number f40"><?=$today_critical;?> <small>Reports</small></span>
	            </div>
	        </div>
		</div>
		<div class="col-md-3">
			<div class="info-box">
	            <span class="info-box-icon"><i class="fas fa-exclamation-triangle text-red"></i></span>
	            <div class="info-box-content">
	              	<span class="info-box-text f15">Total Critical</span>
	              	<span class="info-box-number f40"><?=$all_critical;?> <small>Reports</small></span>
	            </div>
	        </div>
		</div>
	</div>
	<div class="box">
		<div class="box-header">
			<a href="<?=site_url();?>dashboard" class="btn btn-sm bg-bluecrown-light" data-toggle="tooltip" title="Go Back"><i class="fas fa-chevron-left"></i></a>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
			</div>
		</div>
        <div class="box-body">
          <table id="table_critical_unit" class="table table-bordered table-hover nowrap" style="width:100%">
            <thead>
				<tr>
					<th>#</th>
					<th>Unit</th>
					<th>Date</th>
					<th>Time</th>
					<th>Value</th>
					<th class="text-center bg-white">Messages</th>
				</tr>
            </thead>
          </table>
        </div>
    </div>
</section>

<script type="text/javascript">
	$(document).ready(function (){
		var table = $('#table_critical_unit').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"scrollX": true,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url()?>data/critical',
				"type" : 'POST',
				error: function(data){
					swal({
						animation: false,
						focusConfirm: false,
						text: "Failed to pull data. Click OK to get data"}).then(function(){ 
							table.ajax.reload();
						}
					);
				}
			},
			"language": { 
				"processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>',
			},
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "unit", "className": "text-center", "orderable": false },
				{ "data": "date", "className": "text-center" },
				{ "data": "time", "className": "text-center", "orderable": false },
				{ "data": "value", "className": "text-center" },
				{ "data": "messages", "className": "text-left bg-red", "orderable": false },
			],
		});
	});
</script>