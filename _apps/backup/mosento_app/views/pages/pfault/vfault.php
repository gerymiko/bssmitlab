<section class="content-header">
	<h1>Unit Fault Notification</h1>
	<ol class="breadcrumb">
		<li><a href="<?=site_url();?>dashboard"> Home</a></li>
		<li class="active">Fault Report</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="info-box">
	            <span class="info-box-icon"><i class="fas fa-exclamation-circle text-orange"></i></span>
	            <div class="info-box-content">
	              	<span class="info-box-text f15">Today Fault</span>
	              	<span class="info-box-number f40"><?=$today_fault;?> <small>Reports</small></span>
	            </div>
	        </div>
		</div>
		<div class="col-md-3">
			<div class="info-box">
	            <span class="info-box-icon"><i class="fas fa-exclamation-circle text-orange"></i></span>
	            <div class="info-box-content">
	              	<span class="info-box-text f15">Total Fault</span>
	              	<span class="info-box-number f40"><?=$all_fault;?> <small>Reports</small></span>
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
          <table id="table_fault" class="table table-bordered table-hover nowrap" style="width:100%">
            <thead class="bg-gray">
				<tr>
					<th>#</th>
					<th>Unit</th>
					<th>From (HM)</th>
					<th>Until (HM)</th>
					<th>From (Time)</th>
					<th>Until (Time)</th>
					<th>Attempt</th>
					<th class="text-center">Information</th>
				</tr>
            </thead>
            <tfoot class="bg-gray">
				<tr>
					<th>#</th>
					<th>Unit</th>
					<th>From (HM)</th>
					<th>Until (HM)</th>
					<th>From (Time)</th>
					<th>Until (Time)</th>
					<th>Attempt</th>
					<th class="text-center">Information</th>
				</tr>
            </tfoot>
          </table>
        </div>
    </div>
</section>

<script type="text/javascript">
	$(document).ready(function (){
		var table = $('#table_fault').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"scrollX": true,
			"order": [],
			"lengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
			"pageLength": 50,
			"ajax": {
				"url"  : '<?=site_url()?>data/fault',
				"type" : 'POST',
				error: function(data) {
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
				{ "data": "unit", "className": "text-center", "orderable": false  },
				{ "data": "fromhm", "className": "text-center" },
				{ "data": "tohm", "className": "text-center"  },
				{ "data": "fromjam", "className": "text-center" },
				{ "data": "tojam", "className": "text-center" },
				{ "data": "attempt", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "info", "className": "text-left", "searchable": false, "orderable": false },
			],
		});
	});
</script>