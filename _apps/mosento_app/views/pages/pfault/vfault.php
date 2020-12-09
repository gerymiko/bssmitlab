<section class="content-header">
   <h4>Warning &amp; Fault Report <b class="text-red"><?=$accessRights->site?></b></h4>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-3">
			<div class="info-box">
               	<span class="info-box-icon bg-white"><?=$today;?></span>
               	<div class="info-box-content bg-white">
                  	<span class="info-box-text">Today <b class="text-red">Warning <br>&amp; Fault</b><br> Report</span>
               	</div>
            </div>
		</div>
		<div class="col-md-3">
			<div class="info-box">
               	<span class="info-box-icon bg-white"><?=$month;?></span>
               	<div class="info-box-content bg-white">
                  	<span class="info-box-text"><b class="text-red">Warning &amp;<br> Fault</b> Report<br> this Month</span>
               	</div>
            </div>
		</div>
		<div class="col-md-3">
			<div class="info-box">
               	<span class="info-box-icon bg-white"><?=$year;?></span>
               	<div class="info-box-content bg-white">
                  	<span class="info-box-text"><b class="text-red">Warning &amp;<br> Fault</b> Report<br> this Year</span>
               	</div>
            </div>
		</div>
	</div>
	<div class="box">
        <div class="box-body">
          <table id="table_fault" class="table table-border table-striped" width="100%">
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
					<th>Opr. HD</th>
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
					<th>Opr. HD</th>
				</tr>
            </tfoot>
          </table>
        </div>
    </div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		$('#link_dashboard').addClass('active');
		var table = $('#table_fault').DataTable({
			"processing": true,
			"serverSide": true,
			"responsive": true,
			"scrollX": true,
			"order": [],
			"lengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100, 200]],
			"pageLength": 50,
			"ajax": {
				"url"  : '<?=site_url('report/t_fault/').$accessRights->site?>',
				"type" : 'POST',
				error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table.ajax.reload();});}
			},
			"language": { "processing": '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>'},
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "unit", "className": "text-center", "orderable": false  },
				{ "data": "fromhm", "className": "text-center" },
				{ "data": "tohm", "className": "text-center"  },
				{ "data": "fromjam", "className": "text-center" },
				{ "data": "tojam", "className": "text-center" },
				{ "data": "attempt", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "info", "className": "text-left", "searchable": false, "orderable": false },
				{ "data": "name", "className": "text-left", "orderable": false },
			],
		});
	});
</script>