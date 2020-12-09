<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">Physical Results Objective - KPI</h5>
        </div>
        <div class="mdl-card__supporting-text no-padding">
        	<form class="form-inline" id="form-reset">
            	<div class="mdl-grid" style="width: 100%;">
            		<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
            			<select name="length_change" id="length_change" style="margin-right: 2px; ">
						    <option value="10">10</option>
						    <option value="25">25</option>
						    <option value="50">50</option>
						    <option value="100">100</option>
						    <option value="10000000">All</option>
						</select>
                        <button id="tt6" type="button" class="mdl-button mdl-js-button" data-toggle="modal" data-target="#searchToolModal" data-backdrop="static" data-keyboard="false">
                            <i class="material-icons">filter_list</i>
                        </button>
                        <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="tt6">
                            Filter
                        </div>
                        <button type="button" class="mdl-button mdl-js-button bg-gray" id="btn_reset">
                            <i class="material-icons">refresh</i>
                        </button>
                        <div class="mdl-tooltip mdl-tooltip--top" data-mdl-for="btn_reset">
                            Reload
                        </div>				  	
            		</div>
            		<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
						<input type="text" class="col-md-8" name="searchinput" id="searchinput" placeholder="Direct search here . . .">
						<span id="paginationx"></span>
            		</div>
            	</div>
			</form>
        	<div class="dragscroll">
	            <table id="table_physical_results_obj_kpi" class="table table-bordered" width="100%" height="100%" style="border: 3px solid #ddd;">
					<thead>
						<tr>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">NO</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">FILTER<br>YES/NO</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">DEPT<br>IN CHARGE</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">RUMUS ACHV MONTHLY<br>REVIEW & INDEX</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">CLUSTERING MVC</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">OBJECTIVE (HASIL FISIK)<br><i>Link Dari Input Objective & KPI</i></th>
			                <th colspan="1" class="text-center bg-dark-yellow border-bottom">WEIGHT</th>
			                <th colspan="2" class="text-center bg-dark-cyan border-bottom">WEEK 1</th>
			                <th colspan="1" class="text-center bg-dark-yellow border-bottom">DEVIASI</th>
			                <th colspan="2" class="text-center bg-dark-cyan border-bottom">WEEK 2</th>
			                <th colspan="1" class="text-center bg-dark-yellow border-bottom">DEVIASI</th>
			                <th colspan="2" class="text-center bg-dark-cyan border-bottom">WEEK 3</th>
			                <th colspan="1" class="text-center bg-dark-yellow border-bottom">DEVIASI</th>
			                <th colspan="2" class="text-center bg-dark-cyan border-bottom">WEEK 4</th>
			                <th colspan="1" class="text-center bg-dark-yellow border-bottom">DEVIASI</th>
			                <th colspan="2" class="text-center bg-dark-cyan border-bottom">WEEK 5</th>
			                <th colspan="1" class="text-center bg-dark-yellow border-bottom">DEVIASI</th>
			                <th colspan="14" class="text-center bg-dark-red border-bottom">MONTHLY REVIEW</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">DEPT</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">MONTH</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">YEAR</th>
			            </tr>
						<tr>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-cyan border-bottom">PLAN RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">ACTUAL</th>
							<th class="text-center bg-dark-yellow border-bottom">INDEX RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">PLAN RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">ACTUAL</th>
							<th class="text-center bg-dark-yellow border-bottom">INDEX RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">PLAN RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">ACTUAL</th>
							<th class="text-center bg-dark-yellow border-bottom">INDEX RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">PLAN RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">ACTUAL</th>
							<th class="text-center bg-dark-yellow border-bottom">INDEX RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">PLAN RUNNING</th>
							<th class="text-center bg-dark-cyan border-bottom">ACTUAL</th>
							<th class="text-center bg-dark-yellow border-bottom">INDEX RUNNING</th>
							<th class="text-center bg-dark-red border-bottom">TARGET</th>
							<th class="text-center bg-dark-red border-bottom">PLAN RUNNING</th>
							<th class="text-center bg-dark-red border-bottom">PLAN BASE</th>
							<th class="text-center bg-dark-cyan border-bottom">ACTUAL</th>
							<th class="text-center bg-dark-red border-bottom">ACTUAL TARGET</th>
							<th class="text-center bg-dark-red border-bottom">INDEX TARGET</th>
							<th class="text-center bg-dark-red border-bottom">INDEX RUNNING</th>
							<th class="text-center bg-dark-red border-bottom">INDEX BASE</th>
							<th class="text-center bg-dark-red border-bottom">RESULT TARGET</th>
							<th class="text-center bg-dark-red border-bottom">RESULT RUNNING</th>
							<th class="text-center bg-dark-red border-bottom">RESULT BASE</th>
							<th class="text-center bg-dark-red border-bottom">T. GAGAL</th>
							<th class="text-center bg-dark-red border-bottom">T. GAGAL</th>
							<th class="text-center bg-dark-red border-bottom">T. GAGAL</th>
						</tr>
						<tr>
							<th class="text-center bg-dark-yellow">W</th>
							<th class="text-center bg-dark-cyan"><i>pr</i></th>
							<th class="text-center bg-dark-cyan"><i>a</i></th>
							<th class="text-center bg-dark-yellow"><i>ir = a : pr</i></th>
							<th class="text-center bg-dark-cyan"><i>pr</i></th>
							<th class="text-center bg-dark-cyan"><i>a</i></th>
							<th class="text-center bg-dark-yellow"><i>ir = a : pr</i></th>
							<th class="text-center bg-dark-cyan"><i>pr</i></th>
							<th class="text-center bg-dark-cyan"><i>a</i></th>
							<th class="text-center bg-dark-yellow"><i>ir = a : pr</i></th>
							<th class="text-center bg-dark-cyan"><i>pr</i></th>
							<th class="text-center bg-dark-cyan"><i>a</i></th>
							<th class="text-center bg-dark-yellow"><i>ir = a : pr</i></th>
							<th class="text-center bg-dark-cyan"><i>pr</i></th>
							<th class="text-center bg-dark-cyan"><i>a</i></th>
							<th class="text-center bg-dark-yellow"><i>ir = a : pr</i></th>
							<th class="text-center bg-dark-red"><i>t</i></th>
							<th class="text-center bg-dark-red"><i>pr</i></th>
							<th class="text-center bg-dark-red"><i>pb</i></th>
							<th class="text-center bg-dark-red"><i>a</i></th>
							<th class="text-center bg-dark-red"><i>at</i></th>
							<th class="text-center bg-dark-red"><i>it = at : t</i></th>
							<th class="text-center bg-dark-red"><i>ir = a : pr</i></th>
							<th class="text-center bg-dark-red"><i>ib = a : pb</i></th>
							<th class="text-center bg-dark-red"><i>rt = it x w</i></th>
							<th class="text-center bg-dark-red"><i>rr = ir x w</i></th>
							<th class="text-center bg-dark-red"><i>rb = ib x w</i></th>
							<th class="text-center bg-dark-red border-top">TARGET</th>
							<th class="text-center bg-dark-red border-top">RUNNING</th>
							<th class="text-center bg-dark-red border-top">BASE</th>
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
								<div class="control-label">Filter Yes/No</div>
								<select class="form-control" name="status" id="status">
									<option value="">Choose</option>
									<option value="YES">YES</option>
									<option value="NO">NO</option>
								</select>
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
								<div class="control-label">Month</div>
								<select class="form-control" name="bulan" id="bulan">
									<option value="">Choose</option>
									<?php
										$a = 12;
										for ($i=1; $i <= $a; $i++) { 
											$dateObj   = DateTime::createFromFormat('!m', $i);
											echo '<option value="'.$i.'">'.$dateObj->format('F').'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<div class="control-label">DEPT</div>
								<input type="text" class="form-control" id="pic_dept" name="pic_dept" placeholder=". . .">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">DEPT in Charge</div>
								<input type="text" class="form-control" id="pic_dept" name="pic_dept" placeholder=". . .">
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
								<input type="text" class="form-control" id="tahun" name="tahun" maxlength="4" placeholder=". . .">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
					<button type="button" class="btn btn-default" id="btn_clear">Clear</button>
					<button type="button" class="btn btn-primary" id="btn_filter">Filter</button>
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
	.mdl-button .material-icons { margin: -11px 2px 2px 0px; }
	.mdl-button { min-width: 30px;height: 41px; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#link_physical_results_obj_kpi').addClass('mdl-navigation__link--current');
    	var table = $('#table_physical_results_obj_kpi').DataTable({
    		"processing": true,
    		"serverSide": true,
    		"select": true,
         	"bLengthChange": false,
         	"pagingType": "listbox",
    		"pageLength": 50,
    		"ordering": false,
    		"stateSave": true,
    		"order": [],
    		"ajax": {
    			"url": '<?=site_url('table/physical_results_obj_kpi/').$accessRights->site?>',
    			"type": 'POST',
    			// data : function(data) { data.kode_tod = $("#kode_tod").val();data.pic = $("#pic").val();data.control_checkpoint = $("#control_checkpoint").val();data.pic_dept = $("#pic_dept").val();data.kpi_sub_kpi = $("#kpi_sub_kpi").val();data.tod_link_topik = $("#tod_link_topik").val();data.clustering_mvc = $("#clustering_mvc").val();data.year = $("#year").val(); },
    			// error: function(data) { swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){$('#form-filter')[0].reset();table.ajax.reload();});}
    		},
    		"columns": [
	    		{ "data": "no", "className": "text-center", "searchable": false },
	    		{ "data": "status", "className": "text-center" },
	    		{ "data": "pic_dept", "className": "text-center" },
	    		{ "data": "achv_monthly_review", "className": "text-center" },
	    		{ "data": "clustering_mvc", "className": "text-center" },
	    		{ "data": "link_input_obj_kpi", "className": "text-center" },
	    		{ "data": "weight", "className": "text-center" },
	    		{ "data": "w1_plan_running", "className": "text-center" },
	    		{ "data": "w1_actual", "className": "text-center" },
	    		{ "data": "w1_dev_idx_running", "className": "text-center" },
	    		{ "data": "w2_plan_running", "className": "text-center" },
	    		{ "data": "w2_actual", "className": "text-center" },
	    		{ "data": "w2_dev_idx_running", "className": "text-center" },
	    		{ "data": "w3_plan_running", "className": "text-center" },
	    		{ "data": "w3_actual", "className": "text-center" },
	    		{ "data": "w3_dev_idx_running", "className": "text-center" },
	    		{ "data": "w4_plan_running", "className": "text-center" },
	    		{ "data": "w4_actual", "className": "text-center" },
	    		{ "data": "w4_dev_idx_running", "className": "text-center" },
	    		{ "data": "w5_plan_running", "className": "text-center" },
	    		{ "data": "w5_actual", "className": "text-center" },
	    		{ "data": "w5_dev_idx_running", "className": "text-center" },
	    		{ "data": "review_target", "className": "text-center" },
	    		{ "data": "review_plan_running", "className": "text-center" },
	    		{ "data": "review_plan_base", "className": "text-center" },
	    		{ "data": "review_actual", "className": "text-center" },
	    		{ "data": "review_actual_target", "className": "text-center" },
	    		{ "data": "review_idx_target", "className": "text-center" },
	    		{ "data": "review_idx_running", "className": "text-center" },
	    		{ "data": "review_idx_base", "className": "text-center" },
	    		{ "data": "review_rst_target", "className": "text-center" },
	    		{ "data": "review_rst_running", "className": "text-center" },
	    		{ "data": "review_rst_base", "className": "text-center" },
	    		{ "data": "review_gagal_target", "className": "text-center" },
	    		{ "data": "review_gagal_running", "className": "text-center" },
	    		{ "data": "review_gagal_base", "className": "text-center" },
	    		{ "data": "dept", "className": "text-center" },
	    		{ "data": "bulan", "className": "text-center" },
	    		{ "data": "tahun", "className": "text-center" },

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