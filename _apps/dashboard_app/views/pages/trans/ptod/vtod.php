<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">Table of Duties (TOD)</h5>
        </div>
        <div class="mdl-card__supporting-text no-padding">
        	<form class="form-inline" id="form-reset">
            	<div class="mdl-grid" style="width: 100%;">
            		<div class="mdl-cell mdl-cell--10-col-desktop mdl-cell--10-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
            			<select class="" name="length_change" id="length_change">
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
	            <table id="table_tod" class="table table-bordered" width="100%" height="100%" style="border: 3px solid #ddd;">
					<thead>
						<tr>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom40">No</th>
			                <th rowspan="2" class="text-center bg-dark-yellow padding-bottom40">KODE TOD</th>
			                <th colspan="3" class="text-center bg-dark-yellow">PROJECT<br>QUALITY OBJECTIVE / KPI</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom40">PIC</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">Table of Duties<br><i>Link Topik Kecil Mindmap</i></th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">CONTROL &amp;<br>CHECKPOINT</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">TARGET<br>TOD</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">PERIODE TARGET<br>CLOSE [DAILY]</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">SATUAN<br>TOD</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">PIC DEPT<br>YG MENJALANKAN</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">PERIODE TARGET<br>MULAI [BULAN]</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">PERIODE TARGET<br>CLOSE [BULAN]</th>
			                <th rowspan="2" class="text-center bg-dark-yellow padding-bottom40">CLUSTERING MVC</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom40">STATUS</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom40">YEAR</th>
			            </tr>
						<tr>
							<th class="text-center bg-dark-yellow">KPI - SUB KPI</th>
							<th class="text-center bg-dark-yellow">PLAN BASE THIS YEAR</th>
							<th class="text-center bg-dark-yellow">ACTUAL LAST YEAR</th>
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
								<div class="control-label">Kode TOD</div>
								<input type="text" class="form-control" id="kode_tod" name="kode_tod" placeholder=". . ." maxlength="25">
							</div>
							<div class="form-group">
								<div class="control-label">PIC</div>
								<input type="text" class="form-control" id="pic" name="pic" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Control &amp; Checkpoint</div>
								<textarea type="text" class="form-control" id="control_checkpoint" name="control_checkpoint" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">PIC DEPT</div>
								<input type="text" class="form-control" id="pic_dept" name="pic_dept" placeholder=". . .">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">KPI - SUB KPI</div>
								<input type="text" class="form-control" id="kpi_sub_kpi" name="kpi_sub_kpi" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">TOD</div>
								<textarea type="text" class="form-control" id="tod_link_topik" name="tod_link_topik" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Clustering MVC</div>
								<input type="text" class="form-control" id="clustering_mvc" name="clustering_mvc" placeholder=". . .">
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
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#link_table_of_duties').addClass('mdl-navigation__link--current');
    	var table = $('#table_tod').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"select": true,
         	"bLengthChange": false,
         	"pagingType": "listbox",
    		"pageLength": 50,
    		"ordering": false,
    		"order": [],
    		"ajax": {
    			"url": '<?=site_url('table/tod/').$accessRights->site?>',
    			"type": 'POST',
    			data : function(data) { data.kode_tod = $("#kode_tod").val();data.pic = $("#pic").val();data.control_checkpoint = $("#control_checkpoint").val();data.pic_dept = $("#pic_dept").val();data.kpi_sub_kpi = $("#kpi_sub_kpi").val();data.tod_link_topik = $("#tod_link_topik").val();data.clustering_mvc = $("#clustering_mvc").val();data.year = $("#year").val(); },
    			error: function(data) { swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){$('#form-filter')[0].reset();table.ajax.reload();});}
    		},
    		"columns": [
	    		{ "data": "no", "className": "text-center", "searchable": false },
	    		{ "data": "kode_tod", "className": "text-center" },
	    		{ "data": "kpi_sub_kpi", "className": "text-left" },
	    		{ "data": "plan_base", "className": "text-center" },
	    		{ "data": "actual", "className": "text-center" },
	    		{ "data": "pic", "className": "text-center" },
	    		{ "data": "tod_link_topik", "className": "text-left" },
	    		{ "data": "control_checkpoint", "className": "text-left" },
	    		{ "data": "target", "className": "text-center" },
	    		{ "data": "target_close_daily", "className": "text-center" },
	    		{ "data": "satuan", "className": "text-center" },
	    		{ "data": "pic_dept", "className": "text-center" },
	    		{ "data": "target_mulai_month", "className": "text-center" },
	    		{ "data": "target_close_month", "className": "text-center" },
	    		{ "data": "clustering_mvc", "className": "text-center" },
	    		{ "data": "status", "className": "text-center" },
	    		{ "data": "year", "className": "text-center" }
    		]
    	});
    	$('#btn_filter').click(function(){ table.ajax.reload();$('#searchToolModal').modal('hide'); });
		$('#btn_reset').click(function(){ $('#form-filter')[0].reset();table.ajax.reload(); });
		$('#btn_clear').click(function(){ $('#form-filter')[0].reset(); });
		$('#searchinput').keyup(function(){ table.search($(this).val()).draw() ; });
		$('#length_change').val(table.page.len());
		$('#length_change').change( function() { table.page.len($(this).val()).draw(); });
		$("#paginationx").append($(".dataTables_paginate"));
    });
</script>