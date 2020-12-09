<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">Key In Activity Plan (AP)</h5>
        </div>
        <div class="mdl-card__supporting-text no-padding">
        	<form class="form-inline" id="form-reset">
            	<div class="mdl-grid" style="width: 100%;">
            		<div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
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
            		<div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
						<input type="text" class="col-md-8" name="searchinput" id="searchinput" placeholder="Direct search here . . .">
						<span id="paginationx"></span>
            		</div>
            	</div>
			</form>
        	<div class="dragscroll">
	            <table id="table_key_in_ap" class="table table-bordered" width="100%" height="100%" style="border: 3px solid #ddd;">
					<thead>
						<tr>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">NO</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">CLUSTERING<br>MVC</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">KODE<br>ACTIVITY PLAN</th>
			                <th colspan="3" class="text-center bg-dark-yellow border-bottom">PROJECT QUALITY OBJ / KPI</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">PIC</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PIC DEPT<br>YG MENJALANKAN</th>
			                <th colspan="7" class="text-center bg-dark-yellow border-bottom">PROCESS IMPROVEMENT</th>
			                <th colspan="12" class="text-center bg-dark-yellow border-bottom">TREND SCHEDULE</th>
			                <th colspan="6" class="text-center bg-dark-cyan border-bottom">PROGRESS ACTUAL</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">ACHV<br>ACTIVITY PLAN</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">STATUS<br>GAGAL / BERHASIL</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">DEPT<br>UPLOAD</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">MONTH</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">YEAR</th>
			            </tr>
						<tr>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom">PROJECT / ACTIVITY</th>
							<th class="text-center bg-dark-yellow border-bottom">CONTROL &</th>
							<th class="text-center bg-dark-yellow border-bottom">TARGET</th>
							<th class="text-center bg-dark-yellow border-bottom">SATUAN</th>
							<th colspan="3" class="text-center bg-dark-yellow">DUEDATE</th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th colspan="5" class="text-center bg-dark-cyan">WEEK</th>
							<th class="text-center bg-dark-cyan border-bottom">MONTHLY</th>
						</tr>
						<tr>
							<th class="text-center bg-dark-yellow border-top">STRATEGY OBJ</th>
							<th class="text-center bg-dark-yellow border-top">PLAN BASE</th>
							<th class="text-center bg-dark-yellow border-top">ACTUAL</th>
							<th class="text-center bg-dark-yellow border-top"><i>Link Topik Utama Mindmap</i></th>
							<th class="text-center bg-dark-yellow border-top">CHECKPOINT</th>
							<th class="text-center bg-dark-yellow border-top">ACTIVITY PLAN</th>
							<th class="text-center bg-dark-yellow border-top">ACTIVITY PLAN</th>
							<th class="text-center bg-dark-yellow border-top">PERIODE BUDGET MULAI [BULAN]</th>
							<th class="text-center bg-dark-yellow border-top">PERIODE BUDGET CLOSE [BULAN]</th>
							<th class="text-center bg-dark-yellow border-top">PERIODE BUDGET CLOSE [WEEK]</th>
							<th class="text-center bg-dark-yellow border-top">JAN</th>
							<th class="text-center bg-dark-yellow border-top">FEB</th>
							<th class="text-center bg-dark-yellow border-top">MAR</th>
							<th class="text-center bg-dark-yellow border-top">APR</th>
							<th class="text-center bg-dark-yellow border-top">MAY</th>
							<th class="text-center bg-dark-yellow border-top">JUN</th>
							<th class="text-center bg-dark-yellow border-top">JUL</th>
							<th class="text-center bg-dark-yellow border-top">AUG</th>
							<th class="text-center bg-dark-yellow border-top">SEPT</th>
							<th class="text-center bg-dark-yellow border-top">OCT</th>
							<th class="text-center bg-dark-yellow border-top">NOV</th>
							<th class="text-center bg-dark-yellow border-top">DEC</th>
							<th class="text-center bg-dark-cyan border-top">WEEK 1</th>
							<th class="text-center bg-dark-cyan border-top">WEEK 2</th>
							<th class="text-center bg-dark-cyan border-top">WEEK 3</th>
							<th class="text-center bg-dark-cyan border-top">WEEK 4</th>
							<th class="text-center bg-dark-cyan border-top">WEEK 5</th>
							<th class="text-center bg-dark-cyan border-top"></th>
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
								<div class="control-label">Clustering MVC</div>
								<input type="text" class="form-control" id="clustering_mvc" name="clustering_mvc" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Strategy Objective</div>
								<input type="text" class="form-control" id="strategi_obj" name="strategi_obj" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">PIC Dept</div>
								<input type="text" class="form-control" id="pic_dept" name="pic_dept" placeholder=". . .">
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
								<div class="control-label">Kode AP</div>
								<input type="text" class="form-control" id="kode_ap" name="kode_ap" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">PIC</div>
								<input type="text" class="form-control" id="pic" name="pic" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Project /  Activity</div>
								<textarea type="text" class="form-control" id="link_topik_utama_mindmap" name="link_topik_utama_mindmap" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">DEPT in Charge</div>
								<input type="text" class="form-control" id="pic_dept" name="pic_dept" placeholder=". . .">
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
    	$('#link_key_in_ap').addClass('mdl-navigation__link--current');
    	var table = $('#table_key_in_ap').DataTable({
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
    			"url": '<?=site_url('table/key_in_ap/').$accessRights->site?>',
    			"type": 'POST',
    			// data : function(data) { data.kode_tod = $("#kode_tod").val();data.pic = $("#pic").val();data.control_checkpoint = $("#control_checkpoint").val();data.pic_dept = $("#pic_dept").val();data.kpi_sub_kpi = $("#kpi_sub_kpi").val();data.tod_link_topik = $("#tod_link_topik").val();data.clustering_mvc = $("#clustering_mvc").val();data.year = $("#year").val(); },
    			// error: function(data) { swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){$('#form-filter')[0].reset();table.ajax.reload();});}
    		},
    		"columns": [
	    		{ "data": "no", "className": "text-center", "searchable": false },
	    		{ "data": "clustering_mvc", "className": "text-center" },
	    		{ "data": "kode_ap", "className": "text-center" },
	    		{ "data": "strategi_obj", "className": "text-center" },
	    		{ "data": "plan_base", "className": "text-center" },
	    		{ "data": "actual", "className": "text-center" },
	    		{ "data": "pic", "className": "text-center" },
	    		{ "data": "pic_dept", "className": "text-center" },
	    		{ "data": "link_topik_utama_mindmap", "className": "text-left" },
	    		{ "data": "control_checkpoint", "className": "text-left" },
	    		{ "data": "target_ap", "className": "text-center" },
	    		{ "data": "satuan", "className": "text-center" },
	    		{ "data": "periode_budget_mulai_month", "className": "text-center" },
	    		{ "data": "periode_budget_close_month", "className": "text-center" },
	    		{ "data": "periode_budget_close_week", "className": "text-center" },
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
	    		{ "data": "week1", "className": "text-center" },
	    		{ "data": "week2", "className": "text-center" },
	    		{ "data": "week3", "className": "text-center" },
	    		{ "data": "week4", "className": "text-center" },
	    		{ "data": "week5", "className": "text-center" },
	    		{ "data": "monthly", "className": "text-center" },
	    		{ "data": "achieved", "className": "text-center" },
	    		{ "data": "status", "className": "text-center" },
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