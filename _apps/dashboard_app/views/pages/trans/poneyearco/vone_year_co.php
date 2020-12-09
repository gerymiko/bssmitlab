<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">One Year Co.</h5>
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
	            <table id="table_one_year_co" class="table table-bordered" width="100%" style="border: 3px solid #ddd;">
					<thead>
						<tr>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">No</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom20">SCORECARD<br>CATEGORY</th>
			                <th rowspan="2" class="text-center bg-dark-yellow padding-bottom20">GUIDELINE & POLICY<br>(3 Years Guidelines)</th>
			                <th colspan="2" class="text-center bg-dark-yellow">STRATEGY QUALITY OBJECTIVE / KPI</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">STRATEGY OBJ</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">CATEGORY</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">DEFINISI</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom20">RUMUS<br>ACHIEVEMENT</th>
			                <th colspan="4" class="text-center bg-dark-cyan">PRIORITY MEASURE</th>
			                <th colspan="3" class="text-center bg-dark-green">DEPT IN CHARGE</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom20">RUMUS<br>OBJECTIVE</th>
			                <th rowspan="2" class="text-center bg-dark-cyan padding-bottom30">YEAR</th>
			            </tr>
						<tr>
							<th class="text-center bg-dark-yellow">Definition</th>
							<th class="text-center bg-dark-yellow">Target</th>
							<th class="text-center bg-dark-cyan">PLAN BASE Q1</th>
							<th class="text-center bg-dark-cyan">PLAN BASE Q2</th>
							<th class="text-center bg-dark-cyan">PLAN BASE Q3</th>
							<th class="text-center bg-dark-cyan">PLAN BASE Q4</th>
							<th class="text-center bg-dark-green">INTI</th>
							<th class="text-center bg-dark-green">SUPPORT 1</th>
							<th class="text-center bg-dark-green">SUPPORT 2</th>
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
								<div class="control-label">Guidline & Policy</div>
								<textarea type="text" class="form-control" id="guideline_policy" name="guideline_policy" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Strategy OBJ</div>
								<input type="text" class="form-control" id="strategy_obj" name="strategy_obj" placeholder=". . .">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">Strategy Definition</div>
								<textarea type="text" class="form-control" id="strategy_definition" name="strategy_definition" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Definisi</div>
								<textarea type="text" class="form-control" id="definisi" name="definisi" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Year</div>
								<input type="text" class="form-control" id="year" name="year" placeholder=". . .">
							</div>
						</div>
					</div>
					<label class="text-bold">DEPT in Charge</label>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">Inti</div>
								<input type="text" class="form-control" id="inti_desc" name="inti_desc" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Support 2</div>
								<input type="text" class="form-control" id="support2_desc" name="support2_desc" placeholder=". . .">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">Support 1</div>
								<input type="text" class="form-control" id="support1_desc" name="support1_desc" placeholder=". . .">
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
    	$('#link_one_year_co').addClass('mdl-navigation__link--current');
    	var table = $('#table_one_year_co').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"select": true,
    		"pageLength": 50,
    		"pagingType": "listbox",
    		"bLengthChange": false,
    		"order": [],
    		"ordering": false,
    		"ajax": {
    			"url": '<?=site_url('table/one_year_co/').$accessRights->site?>',
    			"type": 'POST',
    			data : function(data) { data.guideline_policy = $("#guideline_policy").val();data.strategy_definition = $("#strategy_definition").val();data.strategy_obj = $("#strategy_obj").val();data.strategy_definition = $("#strategy_definition").val();data.definisi = $("#definisi").val();data.year = $("#year").val();data.inti_desc = $("#inti_desc").val();data.support1_desc = $("#support1_desc").val();data.support2_desc = $("#support2_desc").val(); },
    			error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){$('#form-filter')[0].reset();table.ajax.reload();});}
    		},
    		"columns": [
	    		{ "data": "no", "className": "text-center", "searchable": false },
	    		{ "data": "balance_scorecard", "className": "text-center" },
	    		{ "data": "guideline_policy", "className": "text-left" },
	    		{ "data": "strategy_definition", "className": "text-left" },
	    		{ "data": "strategy_target", "className": "text-left" },
	    		{ "data": "strategy_obj", "className": "text-left" },
	    		{ "data": "category", "className": "text-center text-bold bg-light-blue" },
	    		{ "data": "definisi", "className": "text-left" },
	    		{ "data": "rumus_achv", "className": "text-center" },
	    		{ "data": "plan_base_q1", "className": "text-center" },
	    		{ "data": "plan_base_q2", "className": "text-center" },
	    		{ "data": "plan_base_q3", "className": "text-center" },
	    		{ "data": "plan_base_q4", "className": "text-center" },
	    		{ "data": "inti_desc", "className": "text-center" },
	    		{ "data": "support1_desc", "className": "text-center" },
	    		{ "data": "support2_desc", "className": "text-center" },
	    		{ "data": "rumus_obj", "className": "text-center" },
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