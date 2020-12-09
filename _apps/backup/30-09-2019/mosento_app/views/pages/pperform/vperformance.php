<section class="content-header"> 
	<h1> Performance <small>Driver and unit performance monitoring</small></h1> 
	<ol class="breadcrumb"> 
		<li><a href="<?=site_url()?>dashboard">Home</a></li> 
		<li class="active">Performance</li> 
	</ol> 
</section>
<section class="content">
	<div class="alert alert-danger alert-dismissible hidden">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Attention!</h4>
        Sorry for the inconvenience, this page is currently under maintenance. Maybe there will be a time when an error will appear or the page cannot be accessed for a while. Thank you for your attention.
    </div>
    <div class="box box-primary ">
        <div class="box-body">
            <form id="form-filter-perform" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
			                <label>Choose Month and Year</label>
			                <div class="input-group">
			                  	<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
			                  	<select name="choose_month" id="choose_month" class="form-control required" maxlength="100">
									<option></option>
                                    <?php
                                        foreach ($listmonthyear as $row) {
                                            echo '<option value="'.$row->dates.'">'.date("F Y", strtotime($row->dates)).'</option>';
                                        }
                                    ?>
		                        </select>
			                  	<span class="input-group-btn">
	                                <button type="button" id="btn-filter" class="btn btn-danger btn-flat">Search</button>
	                                <button class="btn btn-default btn-flat" id="btn-reset">Reset</button>
	                            </span>
			                </div>
		              	</div>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <p>*Data based on the latest month</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="box">
        <div class="box-header">
          	<h3 class="box-title">UNIT <b>HD465</b> PERFORMANCE</h3>
          	<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
        	<table id="table_mpv_HD465" class="table table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                <thead class="bg-dark-gray">
                    <tr>
                        <th>Ranking</th>
                        <th>NIK</th>
                        <th>Opt. HD Name</th>
                        <th>No. Lambung</th>
                        <th>Date Perform</th>
                        <th>BCM Payload</th>
                    </tr>
                </thead>
            </table>  
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">UNIT <b>HD785</b> PERFORMANCE</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table id="table_mpv_HD785" class="table table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                <thead class="bg-dark-gray">
                    <tr>
                        <th>Ranking</th>
                        <th>NIK</th>
                        <th>Opt. HD Name</th>
                        <th>No. Lambung</th>
                        <th>Date Perform</th>
                        <th>BCM Payload</th>
                    </tr>
                </thead>
            </table>  
        </div>
    </div>

    <div class="box">
        <div class="box-header no-border">
          	<h3 class="box-title">UNIT <b>EXCA HD465</b> PERFORMANCE</h3>
          	<div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
        	<table id="table_mpv_EXCA465" class="table table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                <thead class="bg-dark-gray">
                    <tr>
                        <th>Ranking</th>
                        <th>NIK</th>
                        <th>Opt. Exca Name</th>
                        <th>Unit Exca</th>
                        <th>Date Perform</th>
                        <th>BCM Payload</th>
                    </tr>
                </thead>
            </table>  
        </div>
    </div>

    <div class="box">
        <div class="box-header no-border">
            <h3 class="box-title">UNIT <b>EXCA HD785</b> PERFORMANCE</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table id="table_mpv_EXCA785" class="table table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                <thead class="bg-dark-gray">
                    <tr>
                        <th>Ranking</th>
                        <th>NIK</th>
                        <th>Opt. Exca Name</th>
                        <th>Unit Exca</th>
                        <th>Date Perform</th>
                        <th>BCM Payload</th>
                    </tr>
                </thead>
            </table>  
        </div>
    </div>
</section>
<style type="text/css">
   .dataTables_filter{ display:none; }
   .dataTables_paginate { display:none !important; }
   div.dataTables_wrapper div.dataTables_paginate ul.pagination { margin: 2px 6px; }
</style>

<script type="text/javascript">
   	$(document).ready(function (){
		$("#choose_month").select2({ placeholder: "Choose", allowClear: true });
        $('#btn-filter').click(function(){
            $('#table_mpv_HD465').DataTable().ajax.reload();
            $('#table_mpv_HD785').DataTable().ajax.reload();
            $('#table_mpv_EXCA785').DataTable().ajax.reload();
            $('#table_mpv_EXCA465').DataTable().ajax.reload();
            $('#dates_1').addClass('hidden');
            $('#dates_1a').removeClass('hidden');
        });
        $('#btn-reset').click(function(){ 
            $('#form-filter-perform')[0].reset();
            $('#table_mpv_HD465').DataTable().ajax.reload();
            $('#table_mpv_HD785').DataTable().ajax.reload();
            $('#table_mpv_EXCA785').DataTable().ajax.reload();
            $('#table_mpv_EXCA465').DataTable().ajax.reload();
        });
		var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		var table_driver_HD465 = $('#table_mpv_HD465').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "bInfo": false,
         	"bLengthChange": false,
            "order": [],
            "ajax": {
                "url": '<?=site_url()?>perform/mpv/unit/hd465',
                "type": 'POST',
                data: function(data){
                    data.choose_month = $('#choose_month').val();
                },
                error: function(data) {
                    swal({
                        animation: false,
                        focusConfirm: false,
                        text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                            table.ajax.reload();
                        }
                    );
                }
            },
            "language": { "processing": bar, },
            "columns": [
                { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                { "data": "nik", "className": "text-center", "orderable": false },
                { "data": "name", "className": "text-center", "orderable": false },
                { "data": "unit", "className": "text-center", "orderable": false },
                { "data": "dateper", "className": "text-center", "orderable": false },
                { "data": "bcm", "className": "text-center", "orderable": false },
            ],
            "createdRow": function( row, data, dataIndex){
                if( data['no'] == 1){
                    $(row).addClass('f16 text-bold');
                } else if (data['no'] == 2) {
                	$(row).addClass('f15 text-bold');
                } else if (data['no'] == 3) {
                	$(row).addClass('f14 text-bold');
                } else {
                	$(row).addClass('f13');
                }
            },
        });
        setTimeout(function(){
            var table_driver_HD785 = $('#table_mpv_HD785').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "bInfo": false,
                "bLengthChange": false,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>perform/mpv/unit/hd785',
                    "type": 'POST',
                    data: function(data){
                        data.choose_month = $('#choose_month').val();
                    },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                    { "data": "unit", "className": "text-center", "orderable": false },
                    { "data": "dateper", "className": "text-center", "orderable": false },
                    { "data": "bcm", "className": "text-center", "orderable": false },
                ],
                "createdRow": function( row, data, dataIndex){
                    if( data['no'] == 1){
                        $(row).addClass('f16 text-bold');
                    } else if (data['no'] == 2) {
                        $(row).addClass('f15 text-bold');
                    } else if (data['no'] == 3) {
                        $(row).addClass('f14 text-bold');
                    } else {
                        $(row).addClass('f13');
                    }
                },
            });
        }, 2000);
        setTimeout(function(){
            var table_driver_EXCA465 = $('#table_mpv_EXCA465').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "bInfo": false,
             	"bLengthChange": false,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>perform/mpv/unit/exca465',
                    "type": 'POST',
                    data: function(data){
                        data.choose_month = $('#choose_month').val();
                    },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                    { "data": "unit", "className": "text-center", "orderable": false },
                    { "data": "dateper", "className": "text-center", "orderable": false },
                    { "data": "bcm", "className": "text-center", "orderable": false },
                ],
                "createdRow": function( row, data, dataIndex){
                    if( data['no'] == 1){
                        $(row).addClass('f16 text-bold');
                    } else if (data['no'] == 2) {
                    	$(row).addClass('f15 text-bold');
                    } else if (data['no'] == 3) {
                    	$(row).addClass('f14 text-bold');
                    } else {
                    	$(row).addClass('f13');
                    }
                },
            });
        }, 3000);
        setTimeout(function(){
            var table_driver_EXCA785 = $('#table_mpv_EXCA785').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "bInfo": false,
                "bLengthChange": false,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>perform/mpv/unit/exca785',
                    "type": 'POST',
                    data: function(data){
                        data.choose_month = $('#choose_month').val();
                    },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                    { "data": "unit", "className": "text-center", "orderable": false },
                    { "data": "dateper", "className": "text-center", "orderable": false },
                    { "data": "bcm", "className": "text-center", "orderable": false },
                ],
                "createdRow": function( row, data, dataIndex){
                    if( data['no'] == 1){
                        $(row).addClass('f16 text-bold');
                    } else if (data['no'] == 2) {
                        $(row).addClass('f15 text-bold');
                    } else if (data['no'] == 3) {
                        $(row).addClass('f14 text-bold');
                    } else {
                        $(row).addClass('f13');
                    }
                },
            });
        }, 4000);
	});
</script>