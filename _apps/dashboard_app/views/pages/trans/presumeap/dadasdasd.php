<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
    <div class="mdl-card mdl-shadow--2dp">
        <div class="mdl-card__title">
            <h5 class="mdl-card__title-text">Resume Activity Plan (AP)</h5>
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
				<table id="table_resume_ap" class="table table-bordered fixed_header" width="100%" height="100%" style="border: 3px solid #ddd;">
					<thead id="theadx">
						<tr id="tr1">
							<th rowspan="4" class="text-center bg-dark-yellow padding-bottom50">NO</th>
							<th rowspan="4" class="text-center bg-dark-yellow padding-bottom50">CLUSTERING MVC</th>
			                <th rowspan="4" class="text-center bg-dark-yellow padding-bottom50">KODE AP</th>
			                <th colspan="3" class="text-center bg-dark-yellow border-bottom">QUALITY OBJECTIVE / KPI</th>
			                <th rowspan="4" class="text-center bg-dark-yellow padding-bottom50">PIC</th>
			                <th rowspan="4" class="text-center bg-dark-yellow padding-bottom50">PIC DEPT</th>
			                <th colspan="4" class="text-center bg-dark-yellow border-bottom">PROCESS IMPROVEMENT</th>
			                <th colspan="3" class="text-center bg-dark-yellow border-bottom">DUEDATE</th>
			                <th colspan="12" class="text-center bg-dark-yellow border-bottom">TREND SCHEDULE</th>
			                <th colspan="12" class="text-center bg-dark-yellow border-bottom">JANUARY</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">FEBRUARY</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">MARCH</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">APRIL</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">MAY</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">JUNE</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">JULY</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">AUGUST</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">SEPTEMBER</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">OCTOBER</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">NOVEMBER</th><th colspan="12" class="text-center bg-dark-yellow border-bottom">DECEMBER</th><th rowspan="4" class="text-center bg-dark-yellow padding-bottom50">DEPT UPLOAD</th><th rowspan="4" class="text-center bg-dark-yellow padding-bottom50">YEAR</th>
			            </tr>
			            <tr id="tr2">
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom">PERIODE</th>
							<th class="text-center bg-dark-yellow border-bottom">PERIODE</th>
							<th class="text-center bg-dark-yellow border-bottom">PERIODE</th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th class="text-center bg-dark-yellow border-bottom"></th>
							<th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL JANUARY</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL FEBRUARY</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL MARCH</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL APRIL</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL MAY</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL JUNE</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL JULY</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL AUGUST</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL SEPTEMBER</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL OCTOBER</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL NOVEMBER</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th colspan="6" class="text-center bg-dark-red border-bottom">PROGRESS ACTUAL DECEMBER</th><th class="text-center bg-dark-yellow border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-bottom">STATUS</th><th class="text-center bg-dark-yellow border-bottom">PLAN</th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom"></th><th class="text-center bg-dark-yellow border-bottom">STATUS</th>
						</tr>
						<tr id="tr3">
							<th class="text-center bg-dark-yellow border-top border-bottom">STRATEGY CO. & OBJ</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">PLAN BASE</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">PROJECT / ACTIVITY</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">CONTROL &amp; CHECKPOINT</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">TARGET AP</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">SATUAN AP</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">BUDGET</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">BUDGET</th>
							<th class="text-center bg-dark-yellow border-top border-bottom">BUDGET</th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th class="text-center bg-dark-yellow border-top border-bottom"></th>
							<th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th colspan="5" class="text-center bg-dark-red border-bottom">WEEK</th><th class="text-center bg-dark-red border-bottom">MONTHLY</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTIVITY</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th><th class="text-center bg-dark-yellow border-top border-bottom">BASE</th><th class="text-center bg-dark-yellow border-top border-bottom">ACTUAL</th><th class="text-center bg-dark-yellow border-top border-bottom">ACHV</th><th class="text-center bg-dark-yellow border-top border-bottom">GAGAL /</th>
						</tr>
						<tr id="tr4">
							<th class="text-center bg-dark-yellow border-top"></th>
							<th class="text-center bg-dark-yellow border-top"></th>
							<th class="text-center bg-dark-yellow border-top"></th>
							<th class="text-center bg-dark-yellow border-top"></th>
							<th class="text-center bg-dark-yellow border-top"></th>
							<th class="text-center bg-dark-yellow border-top"></th>
							<th class="text-center bg-dark-yellow border-top"></th>
							<th class="text-center bg-dark-yellow border-top">MULAI [BULAN]</th>
							<th class="text-center bg-dark-yellow border-top">CLOSE [BULAN]</th>
							<th class="text-center bg-dark-yellow border-top">CLOSE [WEEK]</th>
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
							<th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">JAN</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">JAN</th><th class="text-center bg-dark-yellow border-top">JAN</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">FEB</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">FEB</th><th class="text-center bg-dark-yellow border-top">FEB</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">MAR</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">MAR</th><th class="text-center bg-dark-yellow border-top">MAR</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">APR</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">APR</th><th class="text-center bg-dark-yellow border-top">APR</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">MAY</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">MAY</th><th class="text-center bg-dark-yellow border-top">MAY</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">JUN</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">JUN</th><th class="text-center bg-dark-yellow border-top">JUN</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">JUL</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">JUL</th><th class="text-center bg-dark-yellow border-top">JUL</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">AUG</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">AUG</th><th class="text-center bg-dark-yellow border-top">AUG</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">SEP</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">SEP</th><th class="text-center bg-dark-yellow border-top">SEP</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">OCT</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">OCT</th><th class="text-center bg-dark-yellow border-top">OCT</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">NOV</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">NOV</th><th class="text-center bg-dark-yellow border-top">NOV</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-red">WEEK 1</th><th class="text-center bg-dark-red">WEEK 2</th><th class="text-center bg-dark-red">WEEK 3</th><th class="text-center bg-dark-red">WEEK 4</th><th class="text-center bg-dark-red">WEEK 5</th><th class="text-center bg-dark-red border-top">DEC</th><th class="text-center bg-dark-yellow border-top">PLAN</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th><th class="text-center bg-dark-yellow border-top">DEC</th><th class="text-center bg-dark-yellow border-top">DEC</th><th class="text-center bg-dark-yellow border-top">OBJECTIVE</th><th class="text-center bg-dark-yellow border-top">BERHASIL</th>
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
								<div class="control-label">Strategy Co. & Obj</div>
								<input type="text" class="form-control _CalPhaNum" id="strategy_coorp_obj" name="strategy_coorp_obj" placeholder=". . .">
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
								<div class="control-label">Periode Budget Mulai (Bulan)</div>
								<select class="form-control" name="periode_mulai_month" id="periode_mulai_month">
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
								<div class="control-label">Periode Budget Close (Week)</div>
								<select class="form-control" name="periode_close_week" id="periode_close_week">
									<option value="">Choose</option>
									<?php
										$a = 5;
										for ($i=1; $i<=$a; $i++) {
											echo '<option value="Week '.$i.'">Week '.$i.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="control-label">Kode AP</div>
								<input type="text" class="form-control _CalPhaNum" id="kode_ap" name="kode_ap" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">PIC</div>
								<input type="text" class="form-control _CalPhaNum" id="pic" name="pic" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Satuan AP</div>
								<input type="text" class="form-control _CalPhaNum" id="satuan" name="satuan" placeholder=". . .">
							</div>
							<div class="form-group">
								<div class="control-label">Project / Activity</div>
								<textarea type="text" class="form-control _CalPhaNum" id="project_activity" name="project_activity" placeholder=". . ." rows="2"></textarea>
							</div>
							<div class="form-group">
								<div class="control-label">Periode Budget Close (Bulan)</div>
								<select class="form-control" name="periode_close_month" id="periode_close_month">
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

	/*.limit-width1 {
		min-width: 300px !important;
		max-width: 700px !important;
		word-wrap: break-word;
	}
	.limit-width2 {
		min-width: 100px !important;
		max-width: 700px !important;
		white-space: nowrap;
	}*/
	/*.table { overflow-y: scroll !important; max-height: 600px !important; }*/
	 /*th { position: sticky !important; top: 0!important; }*/
	
	/*.fixed_header{
	    width: 100%;
	    table-layout: fixed;
	    border-collapse: collapse;
	}

	.fixed_header tbody{
	  display:block;
	  width: 100%;
	  overflow: auto;
	  height: 600px;
	}

	.fixed_header thead tr {
	   display: block;
	}

	.fixed_header thead {
	  background: black;
	  color:#fff;
	}

	.fixed_header th, .fixed_header td {
	  padding: 5px;
	  text-align: left;
	  width: 200px;
	}*/
/*
	table {
  margin: 1em 0;
  border-collapse: collapse;
  border: 0.1em solid #d6d6d6;
}
th,
td {
  padding: 0.25em 0.5em 0.25em 1em;
  vertical-align: text-top;
  text-align: left;
  text-indent: -0.5em;
}

th {
  vertical-align: bottom;
  background-color: #666;
  color: #fff;
}

tr:nth-child(even) th[scope=row] {
  background-color: #f2f2f2;
}

tr:nth-child(odd) th[scope=row] {
  background-color: #fff;
}

tr:nth-child(even) {
  background-color: rgba(0, 0, 0, 0.05);
}

tr:nth-child(odd) {
  background-color: rgba(255, 255, 255, 0.05);
}

td:nth-of-type(2) {
  font-style: italic;
}

th:nth-of-type(3),
td:nth-of-type(3) {
  text-align: right;
}

/* Fixed Headers */

/*th {
  position: -webkit-sticky;
  position: sticky;
  top: 0;
  z-index: 2;
}

th[scope=row] {
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  z-index: 1;
}

th[scope=row] {
  vertical-align: top;
  color: inherit;
  background-color: inherit;
  background: linear-gradient(90deg, transparent 0%, transparent calc(100% - .05em), #d6d6d6 calc(100% - .05em), #d6d6d6 100%);
}

table:nth-of-type(2) th:not([scope=row]):first-child {
  left: 0;
  z-index: 3;
  background: linear-gradient(90deg, #666 0%, #666 calc(100% - .05em), #ccc calc(100% - .05em), #ccc 100%);
}

/* Strictly for making the scrolling happen. */

/*th[scope=row] + td {
  min-width: 24em;
}

th[scope=row] {
  min-width: 20em;
}*/
</style>
<script type="text/javascript">
    $(document).ready(function (){
    	$('#link_resume_ap').addClass('mdl-navigation__link--current');
    	$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '._-' });
   		$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
    	$.fn.dataTable.ext.classes.sPageButton = 'button';
    	$.fn.DataTable.ext.pager.numbers_length = 4;
		$.when(
			$('#loading').removeClass('hidden'),
	    	table = $('#table_resume_ap').DataTable({
	    		"processing": true,
	    		"serverSide": true,
	    		"select": true,
	         	"bLengthChange": false,
	         	"pagingType": "simple_numbers",
	    		"pageLength": 10,
	    		"ordering": false,
	    		"order": [],
	    		"ajax": {
	    			"url": '<?=site_url('table/resume_ap/').$accessRights->site?>',
	    			"type": 'POST',
	    			data: function (data) { data.clustering_mvc = $("#clustering_mvc").val();data.kode_ap = $("#kode_ap").val();data.tahun = $("#tahun").val();data.pic = $("#pic").val();data.pic_dept = $("#pic_dept").val();data.control_checkpoint = $("#control_checkpoint").val();data.strategy_coorp_obj = $("#strategy_coorp_obj").val();data.periode_mulai_month = $("#periode_mulai_month").val();data.periode_close_month = $("#periode_close_month").val();data.periode_close_week = $("#periode_close_week").val();data.project_activity = $("#project_activity").val();data.satuan = $("#satuan").val(); },
		    		error: function (data) { swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){$('#form-filter')[0].reset();table.ajax.reload();});}
	    		},
	    		"columns": [
	    			{ "data": "no", "className": "text-center", "searchable": false },
	    			{ "data": "clustering_mvc", "className": "text-center limit-width2" },
		    		{ "data": "kode_ap", "className": "text-center no-wrap" },
		    		{ "data": "strategy_coorp_obj", "className": "text-center limit-width2" },
		    		{ "data": "plan_base", "className": "text-center" },
		    		{ "data": "actual", "className": "text-center" },
		    		{ "data": "pic", "className": "text-center limit-width2" },
		    		{ "data": "pic_dept", "className": "text-center" },
		    		{ "data": "project_activity", "className": "text-left limit-width1" },
		    		{ "data": "control_checkpoint", "className": "text-left limit-width1" },
		    		{ "data": "target", "className": "text-center" },
		    		{ "data": "satuan", "className": "text-center" },
		    		{ "data": "periode_mulai_month", "className": "text-center" },
		    		{ "data": "periode_close_month", "className": "text-center" },
		    		{ "data": "periode_close_week", "className": "text-center" },
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
	    		],
	    		createdRow: function( row, data, dataIndex ) {
			        $(row).attr('data-id', data.id);
			    },
    		})
    	).then(function() {
    		// e.preventDefault();
    			$('#table_resume_ap thead #tr1').append('');
    			$('#table_resume_ap thead #tr2').append('');
    			$('#table_resume_ap thead #tr3').append('');
    			$('#table_resume_ap thead #tr4').append('');
    			$('table > tbody  > tr').each(function(index, tr) {
    				var id = $(this).data('id'), thiss = $(this) ;
    				$.ajax({ 
						"url": '<?=site_url('get/data_id/').$accessRights->site?>',
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
		
    	$('#btn_filter').click(function(){
    		$('#loading').removeClass('hidden');
    		$('#table_resume_ap').DataTable().ajax.reload(function(){
    			$('#table_resume_ap > tbody  > tr').each(function(index, tr) {
					var id = $(this).data('id'), thiss = $(this) ;
    				$.ajax({ 
						"url": '<?=site_url('get/data_id/').$accessRights->site?>',
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
			$('#table_resume_ap').DataTable().ajax.reload(function(){
    			$('#table_resume_ap > tbody  > tr').each(function(index, tr) {
					var id = $(this).data('id'), thiss = $(this) ;
    				$.ajax({ 
						"url": '<?=site_url('get/data_id/').$accessRights->site?>',
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
		$('#length_change').val(table.page.len());
		$('#length_change').change( function() {
			// $('#loading').removeClass('hidden');
			table.page.len( $(this).val()).draw(function(){
				$('#table_resume_ap > tbody  > tr').each(function(index, tr) {
					var id = $(this).data('id'), thiss = $(this);
					$.ajax({ 
						"url": '<?=site_url('get/data_id/').$accessRights->site?>',
						"type": 'POST',
						"dataType": 'JSON',
						"data": { 'id': id },
						"success": function (result) {
							var tdhtml = '';
							$.each(result, function(index, value){
								tdhtml+='<td class="text-center">'+value+'</td>';
							});
				 			thiss.append(tdhtml);
				 			// $('#loading').addClass('hidden');
				 		}
				 	});		
				});
			});
		 });
		$("#paginationx").append($(".dataTables_paginate"));
		// table.on('page', function() {
			// console.log($('#table_resume_ap > tbody').html());
			// $('#loading').removeClass('hidden');
			// console.clear();
			table.on( 'draw', function () {
				$('#table_resume_ap > tbody  > tr').each(function(index, tr) {
					var id = $(this).data('id'), thiss = $(this);
					if (id > 10) {
						$.ajax({
							"url": '<?=site_url('get/data_id/').$accessRights->site?>',
							"type": 'POST',
							"dataType": 'JSON',
							"data": { 'id': id },
							"success": function (result) {
								// console.log(result);
								var tdhtml = '';
								$.each(result, function(index, value){
									tdhtml+='<td class="text-center">'+value+'</td>';
								});
					 			thiss.append(tdhtml);
					 			// $('#loading').addClass('hidden');
					 		}
					 	});
					} else {
						console.log("no");
					}
							
				});
			});
        // });
		$('#table_resume_ap tbody').on('dblclick', 'tr', function () {
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