<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">Raport One Year</h5>
        </div>
        <div class="mdl-card__supporting-text no-padding">
        	<form class="form-inline" id="form-reset">
            	<div class="mdl-grid" style="width: 100%;">
            		<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
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
                        <button type="button" class="btn btn-default" id="btn_feb">
                            FEB
                        </button>
                        <button type="button" class="btn btn-default" id="btn_mar">
                            MAR
                        </button>
                        <button type="button" class="btn btn-default" id="btn_apr">
                            APR
                        </button>
                        <button type="button" class="btn btn-default" id="btn_may">
                            MAY
                        </button>
                        <button type="button" class="btn btn-default" id="btn_jun">
                            JUN
                        </button>
                        <button type="button" class="btn btn-default" id="btn_jul">
                            JUL
                        </button>
                        <button type="button" class="btn btn-default" id="btn_aug">
                            AUG
                        </button>
                        <button type="button" class="btn btn-default" id="btn_sep">
                            SEP
                        </button>
                        <button type="button" class="btn btn-default" id="btn_oct">
                            OCT
                        </button>
                        <button type="button" class="btn btn-default" id="btn_nov">
                            NOV
                        </button>
                        <button type="button" class="btn btn-default" id="btn_dec">
                            DES
                        </button>
            		</div>
            		<div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
						<span id="paginationx"></span>
            		</div>
            	</div>
			</form>
        	<div class="dragscroll">
				<table id="table_raport_one_year" class="table table-bordered" width="100%" height="100%" style="border: 3px solid #ddd;">
					<thead>
						<tr id="tr1">
							<th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">NO</th>
							<th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">STATUS<br>YES / NO</th>
							<th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">TOLERANSI<br>UPPER</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">TOLERANSI<br>LOWER</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">PIC DEPT</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">ACHV MONTHLY<br>REVIEW</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">CLUSTERING MVC</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">OBJECTIVE<br>HASIL FISIK</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">WEIGHT</th>
			                <th colspan="29" class="text-center bg-dark-cyan border-bottom">JANUARY</th>
			            </tr>
			            <tr id="tr2">
							<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th>
							<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th>
							<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th>
							<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th>
							<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th>
							<th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>
						</tr>
						<tr id="tr3">
							<th class="text-center bg-dark-red">PLAN RUNNING</th>
							<th class="text-center bg-dark-red">ACTUAL</th>
							<th class="text-center bg-dark-red">DEVIASI</th>
							<th class="text-center bg-dark-red">PLAN RUNNING</th>
							<th class="text-center bg-dark-red">ACTUAL</th>
							<th class="text-center bg-dark-red">DEVIASI</th>
							<th class="text-center bg-dark-red">PLAN RUNNING</th>
							<th class="text-center bg-dark-red">ACTUAL</th>
							<th class="text-center bg-dark-red">DEVIASI</th>
							<th class="text-center bg-dark-red">PLAN RUNNING</th>
							<th class="text-center bg-dark-red">ACTUAL</th>
							<th class="text-center bg-dark-red">DEVIASI</th>
							<th class="text-center bg-dark-red">PLAN RUNNING</th>
							<th class="text-center bg-dark-red">ACTUAL</th>
							<th class="text-center bg-dark-red">DEVIASI</th>
							<th class="text-center bg-dark-red">TARGET</th>
							<th class="text-center bg-dark-red">PLAN RUNNING</th>
							<th class="text-center bg-dark-red">PLAN BASE</th>
							<th class="text-center bg-dark-red">ACTUAL</th>
							<th class="text-center bg-dark-red">ACTUAL TARGET</th>
							<th class="text-center bg-dark-red">INDEX TARGET</th>
							<th class="text-center bg-dark-red">INDEX RUNNING</th>
							<th class="text-center bg-dark-red">INDEX BASE</th>
							<th class="text-center bg-dark-red">RESULT TARGET</th>
							<th class="text-center bg-dark-red">RESULT RUNNING</th>
							<th class="text-center bg-dark-red">RESULT BASE</th>
							<th class="text-center bg-dark-red">GAGAL TARGET</th>
							<th class="text-center bg-dark-red">GAGAL RUNNING</th>
							<th class="text-center bg-dark-red">GAGAL BASE</th>
						</tr>
					</thead>
				</table>
			</div>
    	</div>
	</div>
</div>
<!-- <div class="modal" id="searchToolModal" tabindex="-1" role="dialog" aria-labelledby="searchToolModalLabel" aria-hidden="true">
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
							<div class="form-group">
								<div class="control-label">Quartal</div>
								<select class="form-control" id="quartal" name="quartal">
									<option value="q1">Q1</option>
									<option value="q2">Q2</option>
									<option value="q3">Q3</option>
									<option value="q4">Q4</option>
								</select>
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
</div> -->
<style type="text/css">
	th, td { white-space: nowrap; }
    div.dataTables_wrapper { margin: 0 auto; }
    div.container { width: 80%; }
    .dataTables_filter { display: none; }
    .border-bottom { border-bottom: 0px !important; }
	.border-top { border-top: 0px !important; }
	.mdl-button .material-icons { margin: -11px 2px 2px 0px !important; }
	.mdl-button { min-width: 30px;height: 41px; }
	.tombol { padding-top: 2px !important; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#link_raport_one_year').addClass('mdl-navigation__link--current');
		// var result1, result2, result3, result4, result5, result6, result7, result8, result9, result10, result11;
		// $.when(
		// 	$('#loading').removeClass('hidden'),
			table = $('#table_raport_one_year').DataTable({
	    		"processing": true,
	    		"serverSide": true,
	    		"select": true,
	         	"bLengthChange": false,
	    		"pageLength": 10000000,
	    		"ordering": false,
	    		"stateSave": true,
	    		"paging": false,
	    		"dom": "lfrti",
	    		"order": [],
	    		"ajax": {
	    			"url": '<?=site_url('table/raport_one_year/').$accessRights->site?>',
	    			"type": 'POST',
	    		},
	    		"columns": [
	    			{ "data": "no", "className": "text-center", "searchable": false },
	    			{ "data": "status", "className": "text-center" },
		    		{ "data": "toleransi_upper", "className": "text-center" },
		    		{ "data": "toleransi_lower", "className": "text-center" },
		    		{ "data": "pic_dept", "className": "text-center" },
		    		{ "data": "achv_monthly_review", "className": "text-center" },
		    		{ "data": "clustering_mvc", "className": "text-center" },
		    		{ "data": "obj_hasil_fisik", "className": "text-left" },
		    		{ "data": "weight", "className": "text-center" },
					{ "data": "w1_plan_running_jan", "className": "text-center" },
					{ "data": "w1_actual_jan", "className": "text-center" },
					{ "data": "w1_deviasi_jan", "className": "text-center" },
					{ "data": "w2_plan_running_jan", "className": "text-center" },
					{ "data": "w2_actual_jan", "className": "text-center" },
					{ "data": "w2_deviasi_jan", "className": "text-center" },
					{ "data": "w3_plan_running_jan", "className": "text-center" },
					{ "data": "w3_actual_jan", "className": "text-center" },
					{ "data": "w3_deviasi_jan", "className": "text-center" },
					{ "data": "w4_plan_running_jan", "className": "text-center" },
					{ "data": "w4_actual_jan", "className": "text-center" },
					{ "data": "w4_deviasi_jan", "className": "text-center" },
					{ "data": "w5_plan_running_jan", "className": "text-center" },
					{ "data": "w5_actual_jan", "className": "text-center" },
					{ "data": "w5_deviasi_jan", "className": "text-center" },
					{ "data": "review_target_jan", "className": "text-center" },
					{ "data": "review_plan_running_jan", "className": "text-center" },
					{ "data": "review_plan_base_jan", "className": "text-center" },
					{ "data": "review_actual_jan", "className": "text-center" },
					{ "data": "review_actual_target_jan", "className": "text-center" },
					{ "data": "review_index_target_jan", "className": "text-center" },
					{ "data": "review_index_running_jan", "className": "text-center" },
					{ "data": "review_index_base_jan", "className": "text-center" },
					{ "data": "review_result_target_jan", "className": "text-center" },
					{ "data": "review_result_running_jan", "className": "text-center" },
					{ "data": "review_result_base_jan", "className": "text-center" },
					{ "data": "review_gagal_target_jan", "className": "text-center" },
					{ "data": "review_gagal_running_jan", "className": "text-center" },
					{ "data": "review_gagal_base_jan", "className": "text-center" },
	    		],
	    		createdRow: function( row, data, dataIndex ) {
			        $(row).attr('id', dataIndex);
			    },
	    	});
	    	$('#btn_feb').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_feb/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">FEBRUARY</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_feb').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_mar').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_mar/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">MARCH</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_mar').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_apr').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_apr/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">APRIL</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_apr').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_may').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_mei/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">MAY</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_may').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_jun').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_jun/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">JUNE</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_jun').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_jul').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_jul/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">JULY</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_jul').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_aug').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_agt/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">AUGUST</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_aug').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_sep').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_sep/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">SEPTEMBER</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_sep').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_oct').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_okt/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">OCTOBER</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_oct').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_nov').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_nov/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">NOVEMBER</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_nov').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});
	    	$('#btn_dec').click(function(){
	    		$('#loading').removeClass('hidden');
	    		$.ajax({ 
		    		"url": '<?=site_url('table/raport_one_year_des/').$accessRights->site?>',
		    		"type": 'POST',
		    		"dataType": 'JSON',
		    		success: function (data) {
		    			$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">DECEMBER</th>');
						$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
						$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
						var i = 0;
		    			$.each(data, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_raport_one_year tbody #'+i).append(html);
						    i++;
						});
						$('#btn_dec').prop("disabled", true);
						$('#loading').addClass('hidden');
		    		}
		    	});
	    	});



			// $.ajax({ 
			// 	"url": '<?=site_url('table/raport_one_year_feb/').$accessRights->site?>',
			// 	"type": 'POST',
			// 	"dataType": 'JSON',
			// 	"success": function (data1) {
			// 		result1 = data1;
			// 	}
			// }),
		 //    $.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_mar/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data2) {
			// 		result2 = data2;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_apr/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data3) {
			// 		result3 = data3;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_mei/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data4) {
			// 		result4 = data4;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_jun/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data5) {
			// 		result5 = data5;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_jul/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data6) {
			// 		result6 = data6;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_agt/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data7) {
			// 		result7 = data7;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_sep/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data8) {
			// 		result8 = data8;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_okt/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data9) {
			// 		result9 = data9;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_nov/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data10) {
			// 		result10 = data10;
	  //   		}
	  //   	}),
	  //   	$.ajax({ 
	  //   		"url": '<?=site_url('table/raport_one_year_des/').$accessRights->site?>',
	  //   		"type": 'POST',
	  //   		"dataType": 'JSON',
	  //   		"success": function (data11) {
			// 		result11 = data11;
	  //   		}
	  //   	})
		// ).then(function() {
		// 	window.setTimeout(function () {
		// 	    $('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">FEBRUARY</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result1, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 	    $('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">MARCH</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result2, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">APRIL</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result3, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">MAY</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result4, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">JUNE</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result5, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">JULY</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result6, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">AUGUST</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result7, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">SEPTEMBER</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result8, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">OCTOBER</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result9, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">NOVEMBER</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result10, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 	}, 1000);
		// 	window.setTimeout(function () {
		// 		console.log(result11);
		// 		$('#table_raport_one_year thead #tr1').append('<th colspan="29" class="text-center bg-dark-cyan border-bottom">DECEMBER</th>');
		// 		$('#table_raport_one_year thead #tr2').append('<th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 1</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 2</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 3</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 4</th><th colspan="3" class="text-center bg-dark-green border-bottom">WEEK 5</th><th colspan="14" class="text-center bg-dark-red border-bottom">REVIEW</th>');
		// 		$('#table_raport_one_year thead #tr3').append('<th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">DEVIASI</th><th class="text-center bg-dark-red">TARGET</th><th class="text-center bg-dark-red">PLAN RUNNING</th><th class="text-center bg-dark-red">PLAN BASE</th><th class="text-center bg-dark-red">ACTUAL</th><th class="text-center bg-dark-red">ACTUAL TARGET</th><th class="text-center bg-dark-red">INDEX TARGET</th><th class="text-center bg-dark-red">INDEX RUNNING</th><th class="text-center bg-dark-red">INDEX BASE</th><th class="text-center bg-dark-red">RESULT TARGET</th><th class="text-center bg-dark-red">RESULT RUNNING</th><th class="text-center bg-dark-red">RESULT BASE</th><th class="text-center bg-dark-red">GAGAL TARGET</th><th class="text-center bg-dark-red">GAGAL RUNNING</th><th class="text-center bg-dark-red">GAGAL BASE</th>');
		// 		var i = 0;
  //   			$.each(result11, function(index, value) {
  //   				var html = ''; 
  //   				$.each(value, function(key, val){
  //   					html+='<td class="text-center">'+val+'</td>';
		// 		    });
		// 		    $('#table_raport_one_year tbody #'+i).append(html);
		// 		    i++;
		// 		});
		// 		$('#loading').addClass('hidden');
		// 	}, 1000);
		// });
    	$('#btn_filter').click(function(){ table.ajax.reload();$('#searchToolModal').modal('hide'); });
		$('#btn_reset').click(function(){ $('#form-filter')[0].reset();table.ajax.reload(); });
		$('#btn_clear').click(function(){ $('#form-filter')[0].reset(); });
    });
</script>