<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">Activity Plan</h5>
        </div>
        <div class="mdl-card__supporting-text no-padding">
        	<form class="form-inline" id="form-reset">
            	<div class="mdl-grid" style="width: 100%;">
            		<div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--10-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
            			<select name="length_change" id="length_change">
						    <option value="10">10</option>
						    <option value="25">25</option>
						    <option value="50">50</option>
						    <option value="100">100</option>
						    <option value="100000">All</option>
						</select>
					  	<button type="button" data-toggle="modal" data-target="#searchToolModal">Filter</button>
					  	<button class="bg-gray" type="button" id="btn_reset">Reset</button>
					  	<input type="text" class="col-md-5" name="searchinput" id="searchinput" placeholder="Direct search here . . .">
            		</div>
            		<div class="mdl-cell mdl-cell--2-col-desktop mdl-cell--2-col-tablet mdl-cell--2-col-phone form__article" style="margin: 0;">
						<span id="paginationx"></span>
            		</div>
            	</div>
			</form>
        	<div class="dragscroll">
	            <table id="table_activity_plan" class="table table-bordered" width="100%" style="border: 3px solid #ddd;">
					<thead>
						<tr>
			                <th rowspan="3" class="text-center bg-dark-cyan padding-bottom">No</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom">KODE ACTIVITY PLAN</th>
			                <th colspan="3" class="text-center bg-dark-yellow border-bottom">PROJECT</th>
			                <th colspan="9" class="text-center bg-dark-cyan">PROCESS IMPROVEMENT</th>
			                <th colspan="12" class="text-center bg-dark-cyan">TREND SCHEDULE THIS YEAR</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom">CLUSTERING MVC</th>
			                <th rowspan="3" class="text-center bg-dark-cyan padding-bottom">STATUS</th>
			                <th rowspan="3" class="text-center bg-dark-cyan padding-bottom">YEAR</th>
			            </tr>
						<tr>
							<th colspan="3" class="text-center bg-dark-yellow border-top">QUALITY OBJECTIVE / KPI</th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th colspan="3" class="text-center bg-dark-cyan">DUEDATE</th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom"></th>
						</tr>
						<tr>
							<th class="text-center bg-dark-yellow">OBJECTIVE<br>1 YEAR</th>
							<th class="text-center bg-dark-yellow">PLAN BASE<br>THIS YEAR</th>
							<th class="text-center bg-dark-yellow">ACTUAL<br>LAST YEAR</th>
							<th class="text-center bg-dark-cyan border-top">PIC</th>
							<th class="text-center bg-dark-cyan border-top">PIC DEPT<br>YG MENJALANKAN</th>
							<th class="text-center bg-dark-cyan border-top">(PROJECT / ACTIVITY)<br><i>Link Topik Utama Mindmap</i></th>
							<th class="text-center bg-dark-cyan border-top">CONTROL &amp;<br>CHECKPOINT</th>
							<th class="text-center bg-dark-cyan border-top">TARGET<br>ACTIVITY PLAN</th>
							<th class="text-center bg-dark-cyan border-top">SATUAN<br>ACTIVITY PLAN</th>
							<th class="text-center bg-dark-cyan">PERIODE TARGET<br>MULAI [BULAN]</th>
							<th class="text-center bg-dark-cyan">PERIODE TARGET<br>CLOSE [BULAN]</th>
							<th class="text-center bg-dark-cyan">PERIODE TARGET<br>CLOSE [WEEK]</th>
							<th class="text-center bg-dark-cyan border-top">JAN</th>
							<th class="text-center bg-dark-cyan border-top">FEB</th>
							<th class="text-center bg-dark-cyan border-top">MAR</th>
							<th class="text-center bg-dark-cyan border-top">APR</th>
							<th class="text-center bg-dark-cyan border-top">MAY</th>
							<th class="text-center bg-dark-cyan border-top">JUN</th>
							<th class="text-center bg-dark-cyan border-top">JUL</th>
							<th class="text-center bg-dark-cyan border-top">AUG</th>
							<th class="text-center bg-dark-cyan border-top">SEPT</th>
							<th class="text-center bg-dark-cyan border-top">OCT</th>
							<th class="text-center bg-dark-cyan border-top">NOV</th>
							<th class="text-center bg-dark-cyan border-top">DEC</th>
						</tr>
					</thead>
				</table>
			</div>
    	</div>
	</div>
</div>
<div class="modal" id="searchToolModal" tabindex="-1" role="dialog" aria-labelledby="searchToolModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="searchToolModalLabel">Search Tool</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="#" method="post" id="form-filter">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">Kode AP</div>
								<input type="text" class="form-control" id="kode_ap" name="kode_ap" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">PIC</div>
								<input type="text" class="form-control" id="pic" name="pic" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Project / Activity</div>
								<textarea type="text" class="form-control" id="project_activity" name="project_activity" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Satuan AP</div>
								<input type="text" class="form-control" id="satuan" name="satuan" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Clustering MVC</div>
								<input type="text" class="form-control" id="clustering_mvc" name="clustering_mvc" placeholder=". . .">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">Objective 1 Year</div>
								<textarea type="text" class="form-control" id="obj1year" name="obj1year" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">PIC DEPT</div>
								<input type="text" class="form-control" id="pic_dept" name="pic_dept" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Control &amp; Checkpoint</div>
								<input type="text" class="form-control" id="control_checkpoint" name="control_checkpoint" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Year</div>
								<input type="text" class="form-control" id="year" name="year" maxlength="4" placeholder=". . .">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" id="btn_clear">Clear</button>
					<button type="button" class="btn btn-primary" id="btn_filter">Search</button>
				</div>
			</form>
		</div>
	</div>
</div>
<style type="text/css">
	th, td { white-space: nowrap; }
    div.dataTables_wrapper { margin: 0 auto; }
    div.container { width: 80%; }
    .dataTables_filter { display: none; }
    .border-bottom { border-bottom: 0px !important; }
	.border-top { border-top: 0px !important; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#link_activity_plan').addClass('mdl-navigation__link--current');
    	var table = $('#table_activity_plan').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"select": true,
         	"bLengthChange": false,
         	"pagingType": "listbox",
    		"pageLength": 50,
    		"ordering": false,
    		"order": [],
    		"ajax": {
    			"url": '<?=site_url('table/activity_plan/').$accessRights->site?>',
    			"type": 'POST',
    			data : function(data) { data.kode_ap = $("#kode_ap").val();data.obj1year = $("#obj1year").val();data.pic = $("#pic").val();data.pic_dept = $("#pic_dept").val();data.project_activity = $("#project_activity").val();data.control_checkpoint = $("#control_checkpoint").val();data.satuan = $("#satuan").val();data.clustering_mvc = $("#clustering_mvc").val();data.year = $("#year").val(); },
    			error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){$('#form-filter')[0].reset();table.ajax.reload();});}
    		},
    		"columns": [
	    		{ "data": "no", "className": "text-center", "searchable": false },
	    		{ "data": "kode_ap", "className": "text-center" },
	    		{ "data": "obj1year", "className": "text-left" },
	    		{ "data": "plan_base", "className": "text-center" },
	    		{ "data": "actual", "className": "text-center" },
	    		{ "data": "pic", "className": "text-center" },
	    		{ "data": "pic_dept", "className": "text-center" },
	    		{ "data": "project_activity", "className": "text-left" },
	    		{ "data": "control_checkpoint", "className": "text-left" },
	    		{ "data": "target", "className": "text-center" },
	    		{ "data": "satuan", "className": "text-center" },
	    		{ "data": "target_mulai_month", "className": "text-center" },
	    		{ "data": "target_close_month", "className": "text-center" },
	    		{ "data": "target_close_week", "className": "text-center" },
	    		{ "data": "jan", "className": "text-center" },
	    		{ "data": "feb", "className": "text-center" },
	    		{ "data": "mar", "className": "text-center" },
	    		{ "data": "apr", "className": "text-center" },
	    		{ "data": "mei", "className": "text-center" },
	    		{ "data": "jun", "className": "text-center" },
	    		{ "data": "jul", "className": "text-center" },
	    		{ "data": "agt", "className": "text-center" },
	    		{ "data": "sep", "className": "text-center" },
	    		{ "data": "okt", "className": "text-center" },
	    		{ "data": "nov", "className": "text-center" },
	    		{ "data": "des", "className": "text-center" },
	    		{ "data": "clustering_mvc", "className": "text-center" },
	    		{ "data": "status", "className": "text-center" },
	    		{ "data": "year", "className": "text-center" },
    		],
    	});
    	$('#btn_filter').click(function(){ table.ajax.reload();$('#searchToolModal').modal('hide'); });
		$('#btn_reset').click(function(){ $('#form-filter')[0].reset();table.ajax.reload(); });
		$('#btn_clear').click(function(){ $('#form-filter')[0].reset(); });
		$('#searchinput').keyup(function(){ table.search($(this).val()).draw() ; });
		$('#length_change').val(table.page.len());
		$('#length_change').change( function() { table.page.len( $(this).val() ).draw(); });
		$("#paginationx").append($(".dataTables_paginate"));
    });
</script>