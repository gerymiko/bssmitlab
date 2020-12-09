<section class="content-header">
   <h4>Summary <b class="text-red"><?=$accessRights->site?></b></h4>
</section>
<section class="content" style="min-height: 50px;">
	<form id="form-filter" action="#" class="form-horizontal no-padding" >
		<div class="col-md-3 mobile">
			<div class="form-group mobile">
				<div class="input-group">
            		<span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
            		<input type="text" class="form-control _CalPhaNum required daterange" id="date_range" name="date_range" placeholder="Choose date">
          		</div>
          	</div>
        </div>
        <div class="col-md-3 mobile">
			<div class="form-group mobile">
				<input type="text" id="unit" name="unit" class="form-control" placeholder="Units" maxlength="50">
          	</div>
        </div>
        <div class="col-md-3 mobile">
			<div class="form-group mobile">
				<input type="text" id="alert" name="alert" class="form-control" placeholder="Alerts" maxlength="15">
          	</div>
        </div>
        <div class="col-md-1 mobile">
        	<div class="form-group mobile">
				<button type="button" id="btn-filter" class="btn btn-flat btn-danger" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
				<button type="button" id="btn-reset" class="btn btn-flat btn-default" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
			</div>
		</div>
	</form>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
			<h4 class="text-bold">Caution Alerts</h4>
			<?php
				$monday = strtotime("last monday");
				$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
				$sunday = strtotime(date("Y-m-d",$monday)." +6 days"); //+6 can be changed to +1,+2...so on acc to your need
				$this_week_sd = date("d-m-Y",$monday);
				$this_week_ed = date("d-m-Y",$sunday);
			?>
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default no-radius">
			           	<span class="info-box-icon bg-white" style="height: 70px;line-height:70px;"><?=$today;?></span>
			           	<div class="info-box-content bg-white">
			              	<span class="info-box-text"><b class="text-red">Caution</b> Report<br> Today</span>
			           	</div>
			        </div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-default no-radius">
			           	<span class="info-box-icon bg-white" style="height: 70px;line-height:70px;"><?=$week;?></span>
			           	<div class="info-box-content bg-white">
			              	<span class="info-box-text"><b class="text-red">Caution</b> Report<br> this Week</span>
			           	</div>
			        </div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-default no-radius">
			           	<span class="info-box-icon bg-white" style="height: 70px;line-height:70px;"><?=$month;?></span>
			           	<div class="info-box-content bg-white">
			              	<span class="info-box-text"><b class="text-red">Caution</b> Report<br> this Month</span>
			           	</div>
			        </div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-default no-radius">
			           	<span class="info-box-icon bg-white" style="height: 70px;line-height:70px;"><?=$year;?></span>
			           	<div class="info-box-content bg-white">
			              	<span class="info-box-text"><b class="text-red">Caution</b> Report<br> this Year</span>
			           	</div>
			        </div>
				</div>
			</div>
			<div class="nav-tabs-custom">
		   		<ul class="nav nav-tabs pull-right">
		   			<li class="active">
		   				<a href="#week_caution" data-toggle="tab">Week</a>
		   			</li>
		   			<li>
		   				<a href="#month_caution" data-toggle="tab">Month</a>
		   			</li>
		   			<li>
		   				<a href="#year_caution" data-toggle="tab">Year</a>
		   			</li>
		   		</ul>
		   		<div class="tab-content">
		   			<div class="active tab-pane" id="week_caution">
		   				<p class="text-bold"><?="Current Week : ".$this_week_sd." to ".$this_week_ed?></p>
		   			</div>
		   			<div class="tab-pane" id="month_caution">
		   				<p class="text-bold"><?='Current Month : '.date("F")?></p>
		   				<table id="table_caution_month" class="table table-border table-striped table-hover" width="100%">
							<thead class="bg-gray">
								<tr>
									<th>#</th>
									<th>Unit</th>
									<th>Date</th>
									<th>Alert</th>
									<th>Value</th>
								</tr>
							</thead>
						</table>
		   			</div>
		   			<div class="tab-pane" id="year_caution">
		   				<p class="text-bold"><?='Current Year : '.date("Y")?></p>
		   			</div>
		   		</div>
		   	</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('._CalPhaNum').alphanum({ allowNumeric: true, allow: '/- ' });
		$('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: false});
		$('#link_summary').addClass('active');
		$('.daterange').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' } });
		$('.daterange').on('apply.daterangepicker', function(ev, picker){ $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));});
		$('.daterange').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
		var table1 = $('#table_caution_month').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": '<?=site_url('summary/t_caution_month/').$accessRights->site?>',
                "type": 'POST',
                // data : function(data) { data.date_range = $("#date_range").val();},
                // error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
            },
            "language": { "processing": bar },
            "columns": [
                { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                { "data": "unit", "className": "text-center", "orderable": false },
                { "data": "date", "className": "text-center" },
                { "data": "alert", "className": "text-center", "orderable": false },
                { "data": "value", "className": "text-center", "orderable": false },
            ],
        });
	});
</script>