<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">Key In Table of Duties (TOD)</h5>
        </div>
        <div class="mdl-card__supporting-text no-padding">
        	<form class="form-inline" id="form-reset">
            	<div class="mdl-grid" style="width: 100%;">
            		<div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--4-col-phone form__article" style="margin: 0;">
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
						<span id="paginationx"></span>
            		</div>
            	</div>
			</form>
        	<div class="dragscroll">
	            <table id="table_key_in_tod" class="table table-bordered" width="100%" height="100%" style="border: 3px solid #ddd;">
					<thead>
						<tr id="tr1">
			                <th rowspan="3" class="text-center bg-dark-cyan padding-bottom50">NO</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">CLUSTERING<br>MVC</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">KODE<br>TOD</th>
			                <th colspan="3" class="text-center bg-dark-yellow border-bottom">ACTIVITY QUALITY OBJ / KPI</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">PIC</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">TABLE OF DUTIES<br><i>Link Topik Utama Mindmap</i></th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">CONTROL &amp; CHECKPOINT</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">TARGET<br><i>Table of Duties</i></th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PERIODE TARGET<br>CLOSE [DAILY]</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">SATUAN<br><i>Table of Duties</i></th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PIC YG<br>MENJALANKAN</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PERIODE TARGET<br>MULAI [BULAN]</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PERIODE TARGET<br>CLOSE [BULAN]</th>
			                <th colspan="3" class="text-center bg-dark-red border-bottom">OUTPUT MONTHLY</th>
			                <th rowspan="3" class="text-center bg-dark-red padding-bottom40">STATUS<br>GAGAL / BERHASIL</th>
			                <th colspan="60" class="text-center bg-dark-cyan border-bottom">OUTPUT PER WEEK</th>
			            </tr>
						<tr id="tr2">
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th class="bg-dark-yellow border-bottom"></th>
							<th colspan="3" class="bg-dark-red text-center">PROSES TABLE OF DUTIES</th>
							<th colspan="12" class="bg-dark-cyan text-center">WEEK 1</th>
							<th colspan="12" class="bg-dark-cyan text-center">WEEK 2</th>
							<th colspan="12" class="bg-dark-cyan text-center">WEEK 3</th>
						</tr>
						<tr id="tr3">
							<th class="text-center bg-dark-yellow border-top">OBJECTIVE - KPI</th>
							<th class="text-center bg-dark-yellow border-top">PLAN BASE</th>
							<th class="text-center bg-dark-yellow border-top">ACTUAL</th>
							<th class="text-center bg-dark-red border-top">TARGET TOD</th>
							<th class="text-center bg-dark-red border-top">ACTUAL TOD</th>
							<th class="text-center bg-dark-red border-top">ACHV TOD</th>
							<th class="text-center bg-dark-cyan border-top">DAY 1</th>
							<th class="text-center bg-dark-cyan border-top">DAY 2</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 2</th>
							<th class="text-center bg-dark-cyan border-top">DAY 3</th>
							<th class="text-center bg-dark-cyan border-top">DAY 4</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 4</th>
							<th class="text-center bg-dark-cyan border-top">DAY 5</th>
							<th class="text-center bg-dark-cyan border-top">DAY 6</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 6</th>
							<th class="text-center bg-dark-cyan border-top">TARGET TOD</th>
							<th class="text-center bg-dark-red border-top">ACTUAL TOD</th>
							<th class="text-center bg-dark-yellow border-top">ACHV</th>
							<th class="text-center bg-dark-cyan border-top">DAY 1</th>
							<th class="text-center bg-dark-cyan border-top">DAY 2</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 2</th>
							<th class="text-center bg-dark-cyan border-top">DAY 3</th>
							<th class="text-center bg-dark-cyan border-top">DAY 4</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 4</th>
							<th class="text-center bg-dark-cyan border-top">DAY 5</th>
							<th class="text-center bg-dark-cyan border-top">DAY 6</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 6</th>
							<th class="text-center bg-dark-cyan border-top">TARGET TOD</th>
							<th class="text-center bg-dark-red border-top">ACTUAL TOD</th>
							<th class="text-center bg-dark-yellow border-top">ACHV</th>
							<th class="text-center bg-dark-cyan border-top">DAY 1</th>
							<th class="text-center bg-dark-cyan border-top">DAY 2</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 2</th>
							<th class="text-center bg-dark-cyan border-top">DAY 3</th>
							<th class="text-center bg-dark-cyan border-top">DAY 4</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 4</th>
							<th class="text-center bg-dark-cyan border-top">DAY 5</th>
							<th class="text-center bg-dark-cyan border-top">DAY 6</th>
							<th class="text-center bg-dark-yellow border-top">EVALUASI DAY 6</th>
							<th class="text-center bg-dark-cyan border-top">TARGET TOD</th>
							<th class="text-center bg-dark-red border-top">ACTUAL TOD</th>
							<th class="text-center bg-dark-yellow border-top">ACHV</th>
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
				<h5 class="modal-title" id="searchToolModalLabel">Filter Data</h5>
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
								<input type="text" class="form-control _CalPhaNum" id="clustering_mvc" name="clustering_mvc" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Strategy Objective</div>
								<input type="text" class="form-control _CalPhaNum" id="strategi_obj" name="strategi_obj" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">PIC Dept</div>
								<input type="text" class="form-control _CalPhaNum" id="pic_dept" name="pic_dept" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Control &amp; Checkpoint</div>
								<textarea type="text" class="form-control _CalPhaNum" id="control_checkpoint" name="control_checkpoint" placeholder=". . ." rows="2"></textarea>
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
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">Kode TOD</div>
								<input type="text" class="form-control _CalPhaNum" id="kode_tod" name="kode_tod" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">PIC</div>
								<input type="text" class="form-control _CalPhaNum" id="pic" name="pic" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Project /  Activity</div>
								<textarea type="text" class="form-control _CalPhaNum" id="link_topik_kecil_mindmap" name="link_topik_kecil_mindmap" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Year</div>
								<select class="form-control" name="tahun" id="tahun">
									<option value="">Choose</option>
									<?php
										$latest_year = date("Y");
										$earliest_year = date("Y", strtotime('-3 years'));
										foreach ( range( $latest_year, $earliest_year ) as $i ) {
											echo '<option value="'.$i.'">'.$i.'</option>';
										} 
									?>
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
</div>
<style type="text/css">
	th, td { white-space: nowrap; }
    div.dataTables_wrapper { margin: 0 auto; }
    div.container { width: 80%; }
    .dataTables_filter, #table_key_in_tod_paginate { display: none; }
    .border-bottom { border-bottom: 0px !important; }
	.border-top { border-top: 0px !important; }
	.mdl-button .material-icons { margin: -11px 2px 2px 0px; }
	.mdl-button { min-width: 30px;height: 41px; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#link_key_in_tod').addClass('mdl-navigation__link--current');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   		$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
    	$.when(
    		$('#loading').removeClass('hidden'),
	    	table = $('#table_key_in_tod').DataTable({
	    		"processing": true,
	    		"serverSide": true,
	    		"select": true,
	         	"bLengthChange": false,
	    		"ordering": false,
	    		"pageLength": 10000000000,
	    		"order": [],
	    		"ajax": {
	    			"url": "<?=site_url('table/key_in_tod/').$accessRights->site?>",
	    			"type": "POST",
	    			data : function(data) { data.clustering_mvc = $("#clustering_mvc").val();data.kode_tod = $("#kode_tod").val();data.bulan = $("#bulan").val();data.tahun = $("#tahun").val();data.pic = $("#pic").val();data.pic_dept = $("#pic_dept").val();data.link_topik_kecil_mindmap = $("#link_topik_kecil_mindmap").val(); },
	    			error: function(data) { swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){$('#form-filter')[0].reset();table.ajax.reload();});}
	    		},
	    		"columns": [
		    		{ "data": "no", "className": "text-center", "searchable": false },
		    		{ "data": "clustering_mvc", "className": "text-center" },
		    		{ "data": "kode_tod", "className": "text-center" },
		    		{ "data": "obj_kpi", "className": "text-center" },
		    		{ "data": "plan_base", "className": "text-center" },
		    		{ "data": "actual", "className": "text-center" },
		    		{ "data": "pic", "className": "text-center" },
		    		{ "data": "link_topik_kecil_mindmap", "className": "text-left" },
		    		{ "data": "control_checkpoint", "className": "text-left" },
		    		{ "data": "target", "className": "text-center" },
		    		{ "data": "periode_target_close_daily", "className": "text-center" },
		    		{ "data": "satuan", "className": "text-center" },
		    		{ "data": "pic_dept", "className": "text-center" },
		    		{ "data": "periode_target_mulai_month", "className": "text-center" },
		    		{ "data": "periode_target_close_month", "className": "text-center" },
		    		{ "data": "monthly_target", "className": "text-center" },
		    		{ "data": "monthly_actual", "className": "text-center" },
		    		{ "data": "monthly_achieved", "className": "text-center" },
		    		{ "data": "status", "className": "text-center" },
		    		{ "data": "day1_w1", "className": "text-center" },
		    		{ "data": "day2_w1", "className": "text-center" },
		    		{ "data": "ev_day2_w1", "className": "text-center" },
		    		{ "data": "day3_w1", "className": "text-center" },
		    		{ "data": "day4_w1", "className": "text-center" },
		    		{ "data": "ev_day4_w1", "className": "text-center" },
		    		{ "data": "day5_w1", "className": "text-center" },
		    		{ "data": "day6_w1", "className": "text-center" },
		    		{ "data": "ev_day6_w1", "className": "text-center" },
		    		{ "data": "target_w1", "className": "text-center" },
		    		{ "data": "actual_w1", "className": "text-center" },
		    		{ "data": "achieved_w1", "className": "text-center" },
		    		{ "data": "day1_w2", "className": "text-center" },
		    		{ "data": "day2_w2", "className": "text-center" },
		    		{ "data": "ev_day2_w2", "className": "text-center" },
		    		{ "data": "day3_w2", "className": "text-center" },
		    		{ "data": "day4_w2", "className": "text-center" },
		    		{ "data": "ev_day4_w2", "className": "text-center" },
		    		{ "data": "day5_w2", "className": "text-center" },
		    		{ "data": "day6_w2", "className": "text-center" },
		    		{ "data": "ev_day6_w2", "className": "text-center" },
		    		{ "data": "target_w2", "className": "text-center" },
		    		{ "data": "actual_w2", "className": "text-center" },
		    		{ "data": "achieved_w2", "className": "text-center" },
		    		{ "data": "day1_w3", "className": "text-center" },
		    		{ "data": "day2_w3", "className": "text-center" },
		    		{ "data": "ev_day2_w3", "className": "text-center" },
		    		{ "data": "day3_w3", "className": "text-center" },
		    		{ "data": "day4_w3", "className": "text-center" },
		    		{ "data": "ev_day4_w3", "className": "text-center" },
		    		{ "data": "day5_w3", "className": "text-center" },
		    		{ "data": "day6_w3", "className": "text-center" },
		    		{ "data": "ev_day6_w3", "className": "text-center" },
		    		{ "data": "target_w3", "className": "text-center" },
		    		{ "data": "actual_w3", "className": "text-center" },
		    		{ "data": "achieved_w3", "className": "text-center" }
	    		],
	    		createdRow: function( row, data, dataIndex ) {
			        $(row).attr('id', dataIndex);
			    },
	    	})
		).then(function() {
	        $.ajax({ 
	    		"url": '<?=site_url('table/key_in_tod_w4w5/').$accessRights->site?>',
	    		"type": 'POST',
	    		"dataType": 'JSON',
	    		success: function (result) {
	    			window.setTimeout(function () {
		    			$('#table_key_in_tod thead #tr1').append('<th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">DEPT<br>UPLOAD</th><th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">MONTH</th><th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">YEAR</th>');
		    			$('#table_key_in_tod thead #tr2').append('<th colspan="12" class="bg-dark-cyan text-center">WEEK 4</th><th colspan="12" class="bg-dark-cyan text-center">WEEK 5</th>');
		    			$('#table_key_in_tod thead #tr3').append('<th class="text-center bg-dark-cyan border-top">DAY 1</th><th class="text-center bg-dark-cyan border-top">DAY 2</th><th class="text-center bg-dark-yellow border-top">EVALUASI DAY 2</th><th class="text-center bg-dark-cyan border-top">DAY 3</th><th class="text-center bg-dark-cyan border-top">DAY 4</th><th class="text-center bg-dark-yellow border-top">EVALUASI DAY 4</th><th class="text-center bg-dark-cyan border-top">DAY 5</th><th class="text-center bg-dark-cyan border-top">DAY 6</th><th class="text-center bg-dark-yellow border-top">EVALUASI DAY 6</th><th class="text-center bg-dark-cyan border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-yellow border-top">ACHV</th><th class="text-center bg-dark-cyan border-top">DAY 1</th><th class="text-center bg-dark-cyan border-top">DAY 2</th><th class="text-center bg-dark-yellow border-top">EVALUASI DAY 2</th><th class="text-center bg-dark-cyan border-top">DAY 3</th><th class="text-center bg-dark-cyan border-top">DAY 4</th><th class="text-center bg-dark-yellow border-top">EVALUASI DAY 4</th><th class="text-center bg-dark-cyan border-top">DAY 5</th><th class="text-center bg-dark-cyan border-top">DAY 6</th><th class="text-center bg-dark-yellow border-top">EVALUASI DAY 6</th><th class="text-center bg-dark-cyan border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-yellow border-top">ACHV</th>');
		    			var i = 0;
		    			$.each(result, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_key_in_tod tbody #'+i).append(html);
						    i++;
						});
						$('#loading').addClass('hidden');
					}, 2000);
	    		}
	    	});
	    });

	    $('#btn_filter').click(function(){
	    	$('#loading').removeClass('hidden');
	    	$('#table_key_in_tod').DataTable().ajax.reload();
	    	$('#searchToolModal').modal('hide');
	    	$.ajax({ 
	    		"url": '<?=site_url('table/key_in_tod_w4w5/').$accessRights->site?>',
	    		"type": 'POST',
	    		"dataType": 'JSON',
	    		data: { 'clustering_mvc': $("#clustering_mvc").val(), 'kode_tod': $("#kode_tod").val(), 'bulan': $("#bulan").val(), 'tahun': $("#tahun").val(), 'pic': $("#pic").val(), 'pic_dept': $("#pic_dept").val(), 'link_topik_kecil_mindmap': $("#link_topik_kecil_mindmap").val(),  },
	    		success: function (result) {
	    			window.setTimeout(function () {
		    			var i = 0;
		    			$.each(result, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_key_in_tod tbody #'+i).append(html);
						    i++;
						});
						$('#loading').addClass('hidden');
					}, 1000);
	    		}
	    	});
	    });
		$('#btn_reset').click(function(){
			$('#loading').removeClass('hidden');
			$('#form-filter')[0].reset();
			$('#table_key_in_tod').DataTable().ajax.reload();
			$.ajax({ 
	    		"url": '<?=site_url('table/key_in_tod_w4w5/').$accessRights->site?>',
	    		"type": 'POST',
	    		"dataType": 'JSON',
	    		data: { 'clustering_mvc': $("#clustering_mvc").val(), 'kode_tod': $("#kode_tod").val(), 'bulan': $("#bulan").val(), 'tahun': $("#tahun").val(), 'pic': $("#pic").val(), 'pic_dept': $("#pic_dept").val(), 'link_topik_kecil_mindmap': $("#link_topik_kecil_mindmap").val(),  },
	    		success: function (result) {
	    			window.setTimeout(function () {
		    			var i = 0;
		    			$.each(result, function(index, value) {
		    				var html = ''; 
		    				$.each(value, function(key, val){
		    					html+='<td class="text-center">'+val+'</td>';
						    });
						    $('#table_key_in_tod tbody #'+i).append(html);
						    i++;
						});
						$('#loading').addClass('hidden');
					}, 1000);
	    		}
	    	});
		});
		$('#btn_clear').click(function(){ $('#form-filter')[0].reset(); });
    });
</script>