<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">Resume Table of Duties (TOD)</h5>
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
						    <option value="100000000">All</option>
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
						<span id="paginationx"></span>
            		</div>
            	</div>
			</form>
        	<div class="dragscroll">
				<table id="table_resume_tod" class="table table-bordered" width="100%" height="100%" style="border: 3px solid #ddd;">
					<thead>
						<tr id="tr1">
							<th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">NO</th>
							<th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">CLUSTERING MVC</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">KODE TOD</th>
			                <th colspan="3" class="text-center bg-dark-yellow border-bottom">ACTIVITY QUALITY OBJECTIVE / KPI</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">PIC</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">TABLE OF DUTIES<br>Link Topik Kecil Mindmap</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">CONTROL & CHECKPOINT</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">TARGET<br>TOD</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PERIODE TARGET<br>CLOSE [DAILY]</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">SATUAN TOD</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PIC DEPT <br>YG MENJALANKAN</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PERIODE TARGET<br>MULAI [BULAN]</th>
			                <th rowspan="3" class="text-center bg-dark-yellow padding-bottom40">PERIODE TARGET<br>CLOSE [BULAN]</th>
			            </tr>
			            <tr id="tr2">
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom">PLAN BASE</th>
							<th class="text-center bg-dark-yellow border-bottom">ACTUAL</th>
						</tr>
						<tr id="tr3">
							<th class="text-center bg-dark-yellow border-top">OBJECTIVE - KPI</th>
							<th class="text-center bg-dark-yellow border-top">THIS YEAR</th>
							<th class="text-center bg-dark-yellow border-top">LAST YEAR</th>
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
								<div class="control-label">Objective - KPI</div>
								<input type="text" class="form-control _CalPhaNum" id="obj_kpi" name="obj_kpi" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">PIC DEPT</div>
								<input type="text" class="form-control _CalPhaNum" id="pic_dept" name="pic_dept" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Control & Checkpoint</div>
								<textarea type="text" class="form-control _CalPhaNum" id="control_checkpoint" name="control_checkpoint" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Target TOD</div>
								<input type="text" class="form-control _CnUmB" id="target" name="target" maxlength="10" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Periode Target Mulai (Bulan)</div>
								<select class="form-control" name="periode_target_mulai_month" id="periode_target_mulai_month">
									<option value="">Choose</option>
									<?php
										$bulan = array (1 => 'Januari',
											'Februari',
											'Maret',
											'April',
											'Mei',
											'Juni',
											'Juli',
											'Agustus',
											'September',
											'Oktober',
											'November',
											'Desember'
										);
										$a = 12;
										for ($i=1; $i<=$a; $i++) {
											echo '<option value="'.$bulan[$i].'">'.$bulan[$i].'</option>';
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
								<div class="control-label">Satuan TOD</div>
								<input type="text" class="form-control _CalPhaNum" id="satuan" name="satuan" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Link Topik Kecil Mindmap</div>
								<textarea type="text" class="form-control _CalPhaNum" id="link_topik_kecil" name="link_topik_kecil" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Periode Target Close (Bulan)</div>
								<select class="form-control" name="periode_target_closed_month" id="periode_target_closed_month">
									<option value="">Choose</option>
									<?php
										$bulan = array (1 => 'Januari',
											'Februari',
											'Maret',
											'April',
											'Mei',
											'Juni',
											'Juli',
											'Agustus',
											'September',
											'Oktober',
											'November',
											'Desember'
										);
										$a = 12;
										for ($i=1; $i<=$a; $i++) {
											echo '<option value="'.$bulan[$i].'">'.$bulan[$i].'</option>';
										}
									?>
								</select>
							</div>
							<div class="form-group">
								<div class="control-label">Year</div>
								<select class="form-control" name="tahun" id="tahun">
									<option>Choose</option>
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
<div class="modal" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="searchToolModalLabel">Details</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="control-label">Clustering MVC</div>
							<input type="text" class="form-control clustering_mvc">
						</div>
						<div class="form-group">
							<div class="control-label">Strategy Co. & Obj</div>
							<input type="text" class="form-control strategy_coorp_obj">
						</div>
						<div class="form-group">
							<div class="control-label">PIC DEPT</div>
							<input type="text" class="form-control pic_dept">
						</div>
						<div class="form-group">
							<div class="control-label">Control & Checkpoint</div>
							<textarea type="text" class="form-control control_checkpoint" rows="3"></textarea>
						</div>
						<div class="form-group">
							<div class="control-label">Periode Budget Mulai (Bulan)</div>
						</div>
						<div class="form-group">
							<div class="control-label">Periode Budget Close (Week)</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="control-label">Kode AP</div>
							<input type="text" class="form-control kode_ap">
						</div>
						<div class="form-group">
							<div class="control-label">PIC</div>
							<input type="text" class="form-control pic">
						</div>
						<div class="form-group">
							<div class="control-label">Satuan AP</div>
							<input type="text" class="form-control satuan">
						</div>
						<div class="form-group">
							<div class="control-label">Project / Activity</div>
							<textarea type="text" class="form-control project_activity" rows="3"></textarea>
						</div>
						<div class="form-group">
							<div class="control-label">Periode Budget Close (Bulan)</div>
						</div>
						<div class="form-group">
							<div class="control-label">Year</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	th { white-space: nowrap; }
	.no-wrap { white-space: nowrap; }
	.table td, .table th { padding: 5px; }
    div.dataTables_wrapper { margin: 0 auto; }
    div.container { width: 80%; }
    .dataTables_filter { display: none; }
    .border-bottom { border-bottom: 0px !important; }
	.border-top { border-top: 0px !important; }
	.mdl-button .material-icons { margin: -11px 2px 2px 0px !important; }
	.mdl-button { min-width: 30px;height: 41px; }
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#link_resume_tod').addClass('mdl-navigation__link--current');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   		$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
   		$.fn.dataTable.ext.classes.sPageButton = 'button';
    	$.fn.DataTable.ext.pager.numbers_length = 4;
		$.when(
			$('#loading').removeClass('hidden'),
	    	table = $('#table_resume_tod').DataTable({
	    		"processing": true,
	    		"serverSide": true,
	    		"select": true,
	         	"bLengthChange": false,
	         	"pagingType": "simple_numbers",
    			"pageLength": 25,
	    		"ordering": false,
	    		"order": [],
	    		"ajax": {
	    			"url": '<?=site_url('table/resume_tod/').$accessRights->site?>',
	    			"type": 'POST',
	    			data: function (data) { data.clustering_mvc = $("#clustering_mvc").val();data.kode_tod = $("#kode_tod").val();data.tahun = $("#tahun").val();data.pic = $("#pic").val();data.pic_dept = $("#pic_dept").val();data.control_checkpoint = $("#control_checkpoint").val();data.obj_kpi = $("#obj_kpi").val();data.periode_target_mulai_month = $("#periode_target_mulai_month").val();data.periode_target_closed_month = $("#periode_target_closed_month").val();data.target = $("#target").val();data.link_topik_kecil = $("#link_topik_kecil").val();data.satuan = $("#satuan").val(); },
		    		error: function (data) { swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){$('#form-filter')[0].reset();table.ajax.reload();});}
	    		},
	    		"columns": [
	    			{ "data": "no", "className": "text-center", "searchable": false },
	    			{ "data": "clustering_mvc", "className": "text-center" },
	    			{ "data": "kode_tod", "className": "text-center" },
	    			{ "data": "obj_kpi", "className": "text-center" },
	    			{ "data": "plan_base", "className": "text-center" },
	    			{ "data": "actual", "className": "text-center" },
	    			{ "data": "pic", "className": "text-center" },
	    			{ "data": "link_topik_kecil", "className": "text-left" },
	    			{ "data": "control_checkpoint", "className": "text-left" },
	    			{ "data": "target", "className": "text-center" },
	    			{ "data": "periode_target_close_daily", "className": "text-center" },
	    			{ "data": "satuan", "className": "text-center" },
	    			{ "data": "pic_dept", "className": "text-center" },
	    			{ "data": "periode_target_mulai_month", "className": "text-center" },
	    			{ "data": "periode_target_closed_month", "className": "text-center" },
	    		],
	    		createdRow: function( row, data, dataIndex ) {
			        $(row).attr('data-id', data.id);
			    },
	    	})
	    ).then(function() {
	    	window.setTimeout(function () {
	    		$('#table_resume_tod thead #tr1').append('<th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY JANUARY</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY FEBRUARY</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY MARCH</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th>');
    			$('#table_resume_tod thead #tr2').append('<th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th>');
    			$('#table_resume_tod thead #tr3').append('<th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE JAN</th><th class="text-center bg-dark-red border-top">JAN</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE FEB</th><th class="text-center bg-dark-red border-top">FEB</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE MAR</th><th class="text-center bg-dark-red border-top">MAR</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th>');
    			$('#table_resume_tod thead #tr1').append('<th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY APRIL</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY MAY</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY JUNE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th>');
    			$('#table_resume_tod thead #tr2').append('<th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th>');
    			$('#table_resume_tod thead #tr3').append('<th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE APR</th><th class="text-center bg-dark-red border-top">APR</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE MAY</th><th class="text-center bg-dark-red border-top">MAY</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE JUN</th><th class="text-center bg-dark-red border-top">JUN</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th>');
    			$('#table_resume_tod thead #tr1').append('<th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY JULY</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY AUGUST</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY SEPTEMBER</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th>');
    			$('#table_resume_tod thead #tr2').append('<th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th>');
    			$('#table_resume_tod thead #tr3').append('<th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE JUL</th><th class="text-center bg-dark-red border-top">JUL</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE AUG</th><th class="text-center bg-dark-red border-top">AUG</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE SEP</th><th class="text-center bg-dark-red border-top">SEP</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th>');
    			$('#table_resume_tod thead #tr1').append('<th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY OCTOBER</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY NOVEMBER</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-dark-cyan border-bottom">OUTPUT MONTHLY DECEMBER</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th colspan="3" class="text-center bg-yellow border-bottom">RESULT OBJECTIVE</th><th rowspan="1" class="text-center bg-dark-red border-bottom">STATUS</th><th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">UPLOAD DEPT</th><th rowspan="3" class="text-center bg-dark-yellow padding-bottom50">YEAR</th>');
    			$('#table_resume_tod thead #tr2').append('<th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th colspan="3" class="text-center bg-yellow">PROSES TABLE OF DUTIES</th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th><th class="text-center bg-dark-red border-top border-bottom">PLAN</th><th class="text-center bg-dark-red border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-red border-top border-bottom"></th><th class="text-center bg-dark-red border-top border-bottom">GAGAL</th>');
    			$('#table_resume_tod thead #tr3').append('<th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE OCT</th><th class="text-center bg-dark-red border-top">OCT</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE NOV</th><th class="text-center bg-dark-red border-top">NOV</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">TARGET TOD</th><th class="text-center bg-dark-red border-top">ACTUAL TOD</th><th class="text-center bg-dark-red border-top">ACH</th><th class="text-center bg-dark-red border-top">BERHASIL</th><th class="text-center bg-dark-red border-top">BASE DEC</th><th class="text-center bg-dark-red border-top">DEC</th><th class="text-center bg-dark-red border-top">ACHV</th><th class="text-center bg-dark-red border-top">BERHASIL</th>');
    			$('table > tbody  > tr').each(function(index, tr) {
    				var id = $(this).data('id'), thiss = $(this) ;
    				$.ajax({ 
						"url": '<?=site_url('table/resume_tod_data/').$accessRights->site?>',
						"type": 'POST',
						"dataType": 'JSON',
						"data": { 'id': id },
						"success": function (result) {
							var tdhtml = '';
							$.each(result, function(index, value){
								tdhtml+='<td class="text-center">'+value+'</td>';
							})
				 			thiss.append(tdhtml);
				 			$('#loading').addClass('hidden');
				 		}
				 	});		
				});
		    }, 1000 );
	    });
    	$('#btn_filter').click(function(){
    		$('#loading').removeClass('hidden');
    		$('#table_resume_tod').DataTable().ajax.reload(function(){
    			$('#table_resume_tod > tbody  > tr').each(function(index, tr) {
					var id = $(this).data('id'), thiss = $(this) ;
    				$.ajax({ 
						"url": '<?=site_url('table/resume_tod_data/').$accessRights->site?>',
						"type": 'POST',
						"dataType": 'JSON',
						"data": { 'id': id },
						"success": function (result) {
				 			var tdhtml = '';
							$.each(result, function(index, value){
								tdhtml+='<td class="text-center">'+value+'</td>';
							})
				 			thiss.append(tdhtml);
				 			$('#loading').addClass('hidden');
				 		}
				 	});	
				})
    		});
    		$('#searchToolModal').modal('hide');
    	});
		$('#btn_reset').click(function(){
			$('#loading').removeClass('hidden');
			$('#form-filter')[0].reset();
			$('#table_resume_tod').DataTable().ajax.reload(function(){
    			$('#table_resume_tod > tbody  > tr').each(function(index, tr) {
					var id = $(this).data('id'), thiss = $(this) ;
    				$.ajax({ 
						"url": '<?=site_url('table/resume_tod_data/').$accessRights->site?>',
						"type": 'POST',
						"dataType": 'JSON',
						"data": { 'id': id },
						"success": function (result) {
				 			var tdhtml = '';
							$.each(result, function(index, value){
								tdhtml+='<td class="text-center">'+value+'</td>';
							})
				 			thiss.append(tdhtml);
				 			$('#loading').addClass('hidden');
				 		}
				 	});	
				})
    		});
    	});
    	$('#btn_clear').click(function(){ $('#form-filter')[0].reset(); });
		$('#length_change').val( table.page.len() );
		$('#length_change').change( function() { 
			table.page.len( $(this).val() ).draw();
			$('#loading').removeClass('hidden');
			table.on( 'draw', function () {
				$('#table_resume_tod > tbody  > tr').each(function(index, tr) {
					var id = $(this).data('id'), thiss = $(this);
					$.ajax({ 
						"url": '<?=site_url('table/resume_tod_data/').$accessRights->site?>',
						"type": 'POST',
						"dataType": 'JSON',
						"data": { 'id': id },
						"success": function (result) {
							var tdhtml = '';
							$.each(result, function(index, value){
								tdhtml+='<td class="text-center">'+value+'</td>';
							})
				 			thiss.append(tdhtml);
				 			$('#loading').addClass('hidden');
				 		}
				 	});		
				});
			});
		 });
		$("#paginationx").append($(".dataTables_paginate"));
		$('#table_resume_tod').on('page.dt', function() {
			$('#loading').removeClass('hidden');
			table.on( 'draw', function () {
				$('#table_resume_tod > tbody  > tr').each(function(index, tr) {
					var id = $(this).data('id'), thiss = $(this);
					$.ajax({ 
						"url": '<?=site_url('table/resume_tod_data/').$accessRights->site?>',
						"type": 'POST',
						"dataType": 'JSON',
						"data": { 'id': id },
						"success": function (result) {
							var tdhtml = '';
							$.each(result, function(index, value){
								tdhtml+='<td class="text-center">'+value+'</td>';
							})
				 			thiss.append(tdhtml);
				 			$('#loading').addClass('hidden');
				 		}
				 	});		
				});
			});
        });
		$('#table_resume_tod tbody').on('dblclick', 'tr', function () {
		    $('.clustering_mvc').val($('td', this).eq(1).text());
		    $('.kode_ap').val($('td', this).eq(2).text());
		    $('.strategy_coorp_obj').val($('td', this).eq(3).text());
		    $('.pic').val($('td', this).eq(6).text());
		    $('.pic_dept').val($('td', this).eq(7).text());
		    $('.project_activity').val($('td', this).eq(8).text());
		    $('.control_checkpoint').val($('td', this).eq(9).text());
		    $('#detailModal').modal("show");
		});
    });
</script>