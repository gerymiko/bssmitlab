<section class="content-header">
   <h4>Performance Driver &amp; Unit <b class="text-red"><?=$accessRights->site?></b></h4>
</section>
<section class="content">
    <form id="form-filter" method="post">
        <div class="row">
            <div class="col-md-5">
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
                            <button type="button" id="btn-filter" class="btn btn-danger btn-flat" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
                            <button type="button" id="btn-reset" class="btn btn-default btn-flat" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
                        </span>
	                </div>
              	</div>
                <p>*Data based on the latest month</p>
            </div>
            <div class="col-md-6"></div>
        </div>
    </form>

    <div class="box">
        <div class="box-header"><p class="f15 no-margin">HD465</p></div>
        <div class="box-body table-responsive no-padding">
        	<table id="table_mpv_HD465" class="table table-hover" width="100%">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>NIK</th>
                        <th>Opt. HD</th>
                        <th>Hull Number</th>
                        <th>Date Perform</th>
                        <th>BCM Payload</th>
                    </tr>
                </thead>
            </table>  
        </div>
    </div>

    <div class="box">
        <div class="box-header"><p class="f15 no-margin">HD785</p></div>
        <div class="box-body table-responsive no-padding">
            <table id="table_mpv_HD785" class="table table-hover" width="100%">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>NIK</th>
                        <th>Opt. HD</th>
                        <th>Hull Number</th>
                        <th>Date Perform</th>
                        <th>BCM Payload</th>
                    </tr>
                </thead>
            </table>  
        </div>
    </div>

    <div class="box">
        <div class="box-header"><p class="f15 no-margin">EXCA HD465</p></div>
        <div class="box-body table-responsive no-padding">
        	<table id="table_mpv_EXCA465" class="table table-hover" width="100%">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>NIK</th>
                        <th>Opt. Exca</th>
                        <th>Unit Exca</th>
                        <th>Date Perform</th>
                        <th>BCM Payload</th>
                    </tr>
                </thead>
            </table>  
        </div>
    </div>

    <div class="box">
        <div class="box-header"><p class="f15 no-margin">EXCA HD785</p></div>
        <div class="box-body table-responsive no-padding">
            <table id="table_mpv_EXCA785" class="table table-hover" width="100%">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>NIK</th>
                        <th>Opt. Exca</th>
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
        var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
		$("#choose_month").select2({ placeholder: "Choose", allowClear: true });
        $('#link_performance').addClass('active');
        $('#btn-filter').click(function(){
            $('#table_mpv_HD465').DataTable().ajax.reload();
            $('#table_mpv_HD785').DataTable().ajax.reload();
            $('#table_mpv_EXCA785').DataTable().ajax.reload();
            $('#table_mpv_EXCA465').DataTable().ajax.reload();
            $('#dates_1').addClass('hidden');
            $('#dates_1a').removeClass('hidden');
        });
        $('#btn-reset').click(function(){ 
            $('#form-filter')[0].reset();
            $('#table_mpv_HD465').DataTable().ajax.reload();
            $('#table_mpv_HD785').DataTable().ajax.reload();
            $('#table_mpv_EXCA785').DataTable().ajax.reload();
            $('#table_mpv_EXCA465').DataTable().ajax.reload();
        });
		
		var table1 = $('#table_mpv_HD465').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "bInfo": false,
         	"bLengthChange": false,
            "order": [],
            "ajax": {
                "url": '<?=site_url('perform/t_perform_hd465/').$accessRights->site?>',
                "type": 'POST',
                data: function(data) {data.choose_month = $('#choose_month').val();},
                error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
            },
            
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
                    $(row).addClass('text-bold bg-light-gray');
                } else if (data['no'] == 2) {
                    $(row).addClass('text-bold bg-light-gray');
                } else if (data['no'] == 3) {
                    $(row).addClass('text-bold bg-light-gray');
                } else {
                    $(row).addClass('');
                }
            }
        });
        setTimeout(function(){
            var table2 = $('#table_mpv_HD785').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "bInfo": false,
                "bLengthChange": false,
                "order": [],
                "ajax": {
                    "url": '<?=site_url('perform/t_perform_hd785/').$accessRights->site?>',
                    "type": 'POST',
                    data: function(data) {data.choose_month = $('#choose_month').val();},
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
                },
                
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
                        $(row).addClass('text-bold bg-light-gray');
                    } else if (data['no'] == 2) {
                        $(row).addClass('text-bold bg-light-gray');
                    } else if (data['no'] == 3) {
                        $(row).addClass('text-bold bg-light-gray');
                    } else {
                        $(row).addClass('');
                    }
                }
            });
        }, 2000);
        setTimeout(function(){
            var table3 = $('#table_mpv_EXCA465').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "bInfo": false,
             	"bLengthChange": false,
                "order": [],
                "ajax": {
                    "url": '<?=site_url('perform/t_perform_exca465/').$accessRights->site?>',
                    "type": 'POST',
                    data: function(data) {data.choose_month = $('#choose_month').val();},
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table3.ajax.reload();});}
                },
                
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
                        $(row).addClass('text-bold bg-light-gray');
                    } else if (data['no'] == 2) {
                        $(row).addClass('text-bold bg-light-gray');
                    } else if (data['no'] == 3) {
                        $(row).addClass('text-bold bg-light-gray');
                    } else {
                        $(row).addClass('');
                    }
                }
            });
        }, 3000);
        setTimeout(function(){
            var table4 = $('#table_mpv_EXCA785').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "bInfo": false,
                "bLengthChange": false,
                "order": [],
                "ajax": {
                    "url": '<?=site_url('perform/t_perform_exca785/').$accessRights->site?>',
                    "type": 'POST',
                    data: function(data) {data.choose_month = $('#choose_month').val();},
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table4.ajax.reload();});}
                },
                
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
                        $(row).addClass('text-bold bg-light-gray');
                    } else if (data['no'] == 2) {
                        $(row).addClass('text-bold bg-light-gray');
                    } else if (data['no'] == 3) {
                        $(row).addClass('text-bold bg-light-gray');
                    } else {
                        $(row).addClass('');
                    }
                }
            });
        }, 4000);
	});
</script>