<section class="content-header">
	<h1>Dashboard <b class="text-blue"><?=$this->uri->segment(3)?></b></h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="box box-widget widget-user no-radius">
				<div class="widget-user-header">
					<h4 class=" no-margin">UNIT GENSET TL : <b><?=$totalTL['all']?></b></h4>
				</div>
				<div class="box-footer no-padding">
					<div class="row">
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header"><?=$totalTL['on']?></h5>
								<span class="description-text">ON</span>
							</div>
						</div>
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header"><?=$totalTL['off']?></h5>
								<span class="description-text">OFF</span>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header"><?=$totalTL['nodata']?></h5>
								<span class="description-text">NO DATA</span>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="box box-widget widget-user no-radius">
				<div class="widget-user-header">
					<h4 class=" no-margin">UNIT GENSET OFFICE : <b><?=$totalOF['all']?></b></h4>
				</div>
				<div class="box-footer no-padding">
					<div class="row">
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header"><?=$totalOF['on']?></h5>
								<span class="description-text">ON</span>
							</div>
						</div>
						<div class="col-sm-4 border-right">
							<div class="description-block">
								<h5 class="description-header"><?=$totalOF['off']?></h5>
								<span class="description-text">OFF</span>
							</div>
						</div>
						<div class="col-sm-4">
							<div class="description-block">
								<h5 class="description-header"><?=$totalOF['nodata']?></h5>
								<span class="description-text">NO DATA</span>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<div class="box no-radius">
		<div class="box-header no-border">
			<h3 class="box-title">GENSET-TL</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-header with-border" style="padding-top: 5px;padding-bottom: 5px;">
			<form id="form-filter-tl" action="#" class="form-horizontal" >
				<div class="col-md-2 mobile">
					<div class="form-group mobile">
						<select class="form-control select2 input-sm" name="engine_tl" id="engine_tl">
							<option></option>
							<option value="ON">ON</option>
							<option value="OFF">OFF</option>
						</select>
		          	</div>
		        </div>
		        <div class="col-md-2 mobile">
					<div class="form-group mobile">
						<input type="text" id="unit_tl" name="unit_tl" class="form-control input-sm" placeholder="Unit Number" maxlength="5">
		          	</div>
		        </div>
		        <div class="col-md-2 mobile">
					<div class="form-group mobile">
						<input type="text" id="hull_tl" name="hull_tl" class="form-control input-sm" placeholder="Hull Number" maxlength="6">
		          	</div>
		        </div>
		        <div class="col-md-2 mobile">
		        	<div class="form-group mobile">
						<button type="button" id="btn-filter-tl" class="btn btn-flat btn-danger btn-sm" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
						<button type="button" id="btn-reset-tl" class="btn btn-flat btn-default btn-sm" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
						<button type="button" id="btn-export-tl" class="btn btn-success btn-flat btn-sm" data-tooltip="Export"><i class="fas fa-file-excel"></i></button>
					</div>
				</div>
			</form>
		</div>
		<div class="box-body no-padding">
			<table id="table_tl" class="table table-hover">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">UNIT</th>
						<th class="text-center">HULL NUMBER</th>
						<th class="text-center">STATUS ENGINE</th>
						<th class="text-center">LAST HM</th>
						<th class="text-center">HM DETAIL</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
	<div class="box no-radius">
		<div class="box-header no-border">
			<h3 class="box-title">GENSET-OFFICE</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			</div>
		</div>
		<div class="box-header with-border" style="padding-top: 5px;padding-bottom: 5px;">
			<form id="form-filter-of" action="#" class="form-horizontal" >
				<div class="col-md-2 mobile">
					<div class="form-group mobile">
						<select class="form-control select2 input-sm" name="engine_of" id="engine_of">
							<option></option>
							<option value="ON">ON</option>
							<option value="OFF">OFF</option>
						</select>
		          	</div>
		        </div>
		        <div class="col-md-2 mobile">
					<div class="form-group mobile">
						<input type="text" id="unit_of" name="unit_of" class="form-control input-sm" placeholder="Unit Number">
		          	</div>
		        </div>
		        <div class="col-md-2 mobile">
					<div class="form-group mobile">
						<input type="text" id="hull_of" name="hull_of" class="form-control input-sm" placeholder="Hull Number">
		          	</div>
		        </div>
		        <div class="col-md-2 mobile">
		        	<div class="form-group mobile">
						<button type="button" id="btn-filter-of" class="btn btn-flat btn-danger btn-sm" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
						<button type="button" id="btn-reset-of" class="btn btn-flat btn-default btn-sm" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
						<button type="button" id="btn-export-of" class="btn btn-success btn-flat btn-sm" data-tooltip="Export"><i class="fas fa-file-excel"></i></button>
					</div>
				</div>
			</form>
		</div>
		<div class="box-body no-padding">
			<table id="table_office" class="table table-hover">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">UNIT</th>
						<th class="text-center">HULL NUMBER</th>
						<th class="text-center">STATUS ENGINE</th>
						<th class="text-center">LAST HM</th>
						<th class="text-center">HM DETAIL</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>
<style type="text/css">
	table.dataTable { margin-top: 0px !important; }
   .dataTables_filter{ display:none; }
   #table_tl_paginate, #table_office_paginate { display:none !important; padding-right: 10px !important; }
   .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single { padding: 4px 10px;height:30px !important; }
   .form-group .select2-container{ margin-bottom: 0; }
   .form-group { margin-bottom: 5px; }
   .widget-user .widget-user-header{ height: 40px;padding: 10px; }
   .widget-user .box-footer{ padding-top:0; }
   .box-footer{ padding: 5p; }
   .widget-user .widget-user-username{ text-shadow:none; }
</style>
<?php 
  	$pesan = $this->session->flashdata('pesan');
  	if(isset($pesan)){ ?>
  	<script>
     	$(document).ready(function(){swal({ type: '<?=$pesan['type'];?>', title: '<?=$pesan['title'];?>', html: '<?=$pesan['message'];?>', timer: 3000 });});    
  	</script>
<?php } ?>
<script type="text/javascript">
	$(document).ready(function (){
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$('#link-dashboard').addClass('active');
		$(".select2").select2({ placeholder: "Status Engine", allowClear: true });
		var tableTL = $('#table_tl').DataTable({
			"processing": true,
			"serverSide": true,
	        "info": false,
			"scrollY": "300px",
			"bLengthChange": false,
			"pageLength": 1000,
	        "scrollCollapse": true,
	        "order": [],
			"ajax": {
				"url" : '<?=site_url('table/tl/').$this->uri->segment(3)?>',
				"type" : 'POST',
				data : function(data){ data.engine_tl = $("#engine_tl").val();data.unit_tl = $("#unit_tl").val();data.hull_tl = $("#hull_tl").val();},
				error: function(data){swal({ animation: false, focusConfirm: false, text: "Failed to pull data. Click OK to get data"}).then(function(){ tableTL.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "unit", "className": "text-center"},
				{ "data": "serial", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "engine", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "lasthm", "className": "text-center", "searchable": false },
				{ "data": "detail", "className": "text-center", "searchable": false, "orderable": false }
			]
		});
		$('#btn-filter-tl').click(function(){ tableTL.ajax.reload();});
		$('#btn-reset-tl').click(function(){ $('#form-filter-tl')[0].reset();$(".select2").val([]).trigger('change'); tableTL.ajax.reload();});
		$('#btn-export-tl').click(function(){
            if (<?=$accessRights->export?> == 0) {
            	toastr.error('You do not have access to export data.');
            } else {
            	window.open('<?=site_url()?>dashboard/export_tl/<?=$this->uri->segment(3)?>');
            }
        });

		var tableOF = $('#table_office').DataTable({
			"processing": true,
			"serverSide": true,
	        "info": false,
			"scrollY": "300px",
			"bLengthChange": false,
			"pageLength": 1000,
	        "scrollCollapse": true,
	        "order": [],
			"ajax": {
				"url": '<?=site_url('table/office/').$this->uri->segment(3)?>',
				"type": 'POST',
				data : function(data){ data.engine_of = $("#engine_of").val();data.unit_of = $("#unit_of").val();data.hull_of = $("#hull_of").val();},
				error: function(data){swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){tableOF.ajax.reload();});},
			},
			"language": { "processing": bar },
			"columns": [
				{ "data": "no", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "unit", "className": "text-center"},
				{ "data": "serial", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "engine", "className": "text-center", "searchable": false, "orderable": false },
				{ "data": "lasthm", "className": "text-center", "searchable": false },
				{ "data": "detail", "className": "text-center", "searchable": false, "orderable": false }
			]
		});
		$('#btn-filter-of').click(function(){ tableOF.ajax.reload();});
		$('#btn-reset-of').click(function(){ $('#form-filter-of')[0].reset();$(".select2").val([]).trigger('change'); tableOF.ajax.reload();});
		$('#btn-export-of').click(function(){
            if (<?=$accessRights->export?> == 0) {
            	toastr.error('You do not have access to export data.');
            } else {
            	window.open('<?=site_url()?>dashboard/export_of/<?=$this->uri->segment(3)?>');
            }
        });
	});
</script>