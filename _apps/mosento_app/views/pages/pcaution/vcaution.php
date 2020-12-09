<section class="content-header">
   <h4>Caution Report <b class="text-red"><?=$accessRights->site?></b></h4>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="info-box">
               	<span class="info-box-icon bg-white"><?=$today;?></span>
               	<div class="info-box-content bg-white">
                  	<span class="info-box-text">Today <b class="text-red">Caution</b><br> Report</span>
               	</div>
            </div>
		</div>
		<div class="col-md-3">
			<div class="info-box">
               	<span class="info-box-icon bg-white"><?=$month;?></span>
               	<div class="info-box-content bg-white">
                  	<span class="info-box-text"><b class="text-red">Caution</b> Report<br> this Month</span>
               	</div>
            </div>
		</div>
		<div class="col-md-3">
			<div class="info-box">
               	<span class="info-box-icon bg-white"><?=$year;?></span>
               	<div class="info-box-content bg-white">
                  	<span class="info-box-text"><b class="text-red">Caution</b> Report<br> this Year</span>
               	</div>
            </div>
		</div>
	</div>
	<div class="box">
		<div class="box-body">
			<table id="table_caution" class="table table-border table-striped table-hover" width="100%">
				<thead class="bg-gray">
					<tr>
						<th>#</th>
						<th>Unit</th>
						<th>Date</th>
						<th>Time</th>
						<th>Value</th>
						<th>Site</th>
						<th class="text-center">Messages</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		$('#link_dashboard').addClass('active');
		var table = $('#table_caution').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
				"url"  : '<?=site_url('report/t_caution/').$accessRights->site?>',
				"type" : 'POST',
				error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
			},
			"language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>'},
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "unit", "className": "text-center", "orderable": false },
				{ "data": "date", "className": "text-center" },
				{ "data": "time", "className": "text-center", "orderable": false },
				{ "data": "value", "className": "text-center" },
				{ "data": "site", "className": "text-center", "orderable": false },
				{ "data": "messages", "className": "text-left", "orderable": false },
			],
		});
	});
</script>