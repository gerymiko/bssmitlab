<section class="content-header">
    <h4 class="text-bold">Payload</h4>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-body">
                    <div class="text-center"><img src="<?=site_url();?>s_url/icon_hd" width="200" /></div>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="#">Heavy Dump Truck
                            <span class="pull-right"><b><?=$detail_hd->unit;?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Serial Number 
                            <span class="pull-right"><b><?=$detail_hd->serialnumber;?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Hull Number 
                            <span class="pull-right text-blue f15"><b><?=$detail_hd->nolambung;?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Status
                            <span class="pull-right <?=($detail_hd->status == 1) ? 'text-green' : 'text-red';?>"><?=($detail_hd->status == 1) ? 'Active' : 'Non-Active';?></span></a>
                        </li>
                        <li>
                            <a href="#">Site
                            <span class="pull-right"><?=($detail_hd->servername == null) ? 'Data not found' : $detail_hd->servername;?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="info-box" style="min-height: 70px;">
                <span class="info-box-icon bg-white" style="height: 70px;width: 70px;font-size: 30px;line-height: 70px;"><i class="fas fa-calendar-check text-gray"></i></span>
                <div class="info-box-content" style="margin-left: 70px;">
                    <span class="info-box-text">LAST UPDATE DATA</span>
                    <span class="info-box-number f14"><?=($detail_hd->lastupdate == null ) ? "Data not updated" : date("d-m-Y H:i A", strtotime($detail_hd->lastupdate));?></span>
                </div>
            </div>
            <div class="info-box" style="min-height: 70px;">
                <span class="info-box-icon bg-white" style="height: 70px;width: 70px;font-size: 30px;line-height: 70px;"><i class="far fa-calendar-alt text-gray"></i></span>
                <div class="info-box-content" style="margin-left: 70px;">
                    <span class="info-box-text">DATA PRESENTED</span>
                    <span class="info-box-number f14"><?= date("M Y", strtotime("-1 month")).' - '.date("M Y") ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="alert alert-danger alert-dismissible hidden">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Attention!</h4>
                Sorry for the inconvenience, this page is currently under maintenance. Maybe there will be a time when an error will appear or the page cannot be accessed for a while. Thank you for your attention.
            </div>
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-7">
                            <form id="form-filter">
                                <label class="control-label">Search Data</label>
                                <div class="input-group input-group">
                                    <span class="input-group-addon"><i class="far fa-calendar-alt"></i></span>
                                    <input type="text" class="form-control _CnUmB required" id="date_range" name="date_range" placeholder="Choose date">
                                    <span class="input-group-btn">
                                        <button type="button" id="btn-filter" class="btn btn-danger btn-flat" data-tooltip="Filter"><i class="fas fa-filter"></i></button>
                                        <button type="button" id="btn-reset" class="btn btn-default btn-flat" data-tooltip="Reset"><i class="fas fa-sync"></i></button>
                                        <button type="button" id="btn-export" class="btn btn-success btn-flat" data-tooltip="Export"><i class="far fa-file-excel f15"></i></button>
                                    </span>
                                </div>
                                <label for="date_range" generated="true" class="error hidden"></label>
                            </form><br>
                        </div>
                    </div>
                    <div class="panel panel-default no-radius">
                        <div class="panel-body">
                            <h4 class="text-blue"><b>Monthly Report</b></h4>
                            <hr style="margin-top: 10px; margin-bottom: 10px;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Average Payload</label>
                                        <input type="text" id="ave_payload" class="form-control input-sm" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Average BCM Payload</label>
                                        <input type="text" id="ave_bcm_payload" class="form-control input-sm" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Min BCM Payload</label>
                                        <input type="text" id="min_bcm_payload" class="form-control input-sm" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Max BCM Payload</label>
                                        <input type="text" id="max_bcm_payload" class="form-control input-sm" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="dates-data1">* Data for : <b><?=date('F, Y');?></b></span>
                                    <span id="dates-data2" class="hidden"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table id="table_payload" class="table table-hover table-striped table-border" width="100%" cellspacing="0" scroll-collapse="false">
                        <thead class="bg-gray">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time (24H)</th>
                                <th>Payload</th>
                                <th>BCM</th>
                                <th>Opt. HD</th>
                                <th>Loader</th>
                                <th>Opt. Exca</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Empty Drive Time (EDT)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="table_empty_drive_time" class="table table-striped table-hover table-border" width="100%" cellspacing="0" scroll-collapse="false">
                        <thead class="bg-gray">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time (24 Hours)</th>
                                <th>EDT (Minutes)</th>
                                <th>Opt. HD</th>
                                <th>Loader</th>
                                <th>Opt. Exca</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Empty Drive Distance (EDD)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="table_empty_drive_distance" class="table table-striped table-hover table-border" width="100%" cellspacing="0" scroll-collapse="false">
                        <thead class="bg-gray">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time (24 Hours)</th>
                                <th>EDD (Km)</th>
                                <th>Opt. HD</th>
                                <th>Loader</th>
                                <th>Opt. Exca</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Empty Stop Time (EST)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="table_empty_stop_time" class="table table-striped table-hover table-border" width="100%" cellspacing="0" scroll-collapse="false">
                        <thead class="bg-gray">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time (24 Hours)</th>
                                <th>EST (Minutes)</th>
                                <th>Opt. HD</th>
                                <th>Loader</th>
                                <th>Opt. Exca</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Loading Stop Time (LST)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="table_loading_stop_time" class="table table-striped table-hover table-border" width="100%" cellspacing="0" scroll-collapse="false">
                        <thead class="bg-gray">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time (24 Hours)</th>
                                <th>LST (Minutes)</th>
                                <th>Opt. HD</th>
                                <th>Loader</th>
                                <th>Opt. Exca</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Loaded Drive Time (LDT)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="content_loadeddrivetime">
                        <table id="table_loaded_drive_time" class="table table-striped table-hover table-border" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Loaded Drive Time (Minutes)</th>
                                    <th>Opt. HD</th>
                                    <th>Loader</th>
                                    <th>Opt. Exca</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Loaded Stop Time (LDST)</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="content_loadedstoptime">
                        <table id="table_loaded_stop_time" class="table table-striped table-hover table-border" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>LDST (Minutes)</th>
                                    <th>Opt. HD</th>
                                    <th>Loader</th>
                                    <th>Opt. Exca</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function (){
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){ $($.fn.dataTable.tables(true)).DataTable().columns.adjust();var data = $(this).data();if (data.chart !== undefined){ chart.validateSize(); }});
        $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: true});
        var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
        $('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' }, dateLimit: { "days": 31 } });
        $('#date_range').on('apply.daterangepicker', function(ev, picker){$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));});
        $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
        $('#link_dashboard').addClass('active');
        $('#btn-filter').click(function(){
            if($("#form-filter").valid() == false){
                toastr.error('Select a date range first!');
                return false;
            } else {
                $('#table_payload, #table_empty_drive_time, #table_empty_drive_distance, #table_empty_stop_time, #table_loading_stop_time, #table_loaded_drive_time, #table_loaded_stop_time').DataTable().ajax.reload();
                var date_range = $('#date_range').val().split(' - '),
                    date_start = date_range[0],
                    date_end   = date_range[1],
                    date_start_new = date_start.replace(/\//g, '-'),
                    date_end_new   = date_end.replace(/\//g, '-');
                $("#dates-data1").addClass('hidden'); 
                $("#dates-data2").removeClass('hidden');    
                $("#dates-data2").html('*Data for : ' +date_start_new+ ' S/d ' +date_end_new);
            }
        });
        $('#btn-reset').click(function(){
            $('#form-filter')[0].reset();
            $('#dates-data1').removeClass('hidden');
            $('#dates-data2').addClass('hidden');
            $('#table_payload, #table_empty_drive_time, #table_empty_drive_distance, #table_empty_stop_time, #table_loading_stop_time, #table_loaded_drive_time, #table_loaded_stop_time').DataTable().ajax.reload();
        });
        $('#btn-export').click(function(){
            if($("#form-filter").valid() == false){
                toastr.error('Select a date range first!');
                return false;
            } else {
                var date_range = $('#date_range').val().split(' - '),
                date_start = date_range[0],
                date_end   = date_range[1],
                date_start_new = date_start.replace(/\//g, '-'),
                date_end_new   = date_end.replace(/\//g, '-');
                if (<?=$accessRights->export?> == 0) {
                    toastr.error('You do not have access to export data.');
                } else {
                    window.open('<?=site_url()?>hd/export_payload/<?=$accessRights->site?>/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>/'+date_start_new+'/'+date_end_new);
                }
            }
        });
        var table0 = $('#table_payload').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": '<?=site_url()?>hd/t_payload/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                "type": 'POST',
                data : function(data) { data.date_range = $("#date_range").val(); },
                dataSrc: function(data) { $('#ave_payload').val(data.averagePay);$('#ave_bcm_payload').val(data.averageBCM);$('#min_bcm_payload').val(data.minBCM);$('#max_bcm_payload').val(data.maxBCM);return data.data;},
                error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table0.ajax.reload();});}
            },
            "language": { "processing": bar, },
            "columns": [
                { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                { "data": "date", "className": "text-center" },
                { "data": "time", "className": "text-center", "orderable": false },
                { "data": "payload", "className": "text-center", "orderable": false },
                { "data": "bcm", "className": "text-center", "orderable": false },
                { "data": "opthd", "className": "text-center", "orderable": false },
                { "data": "loader", "className": "text-center", "orderable": false },
                { "data": "nmloader", "className": "text-center", "orderable": false }
            ],
        });

        setTimeout(function(){
            var table1 = $('#table_empty_drive_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_edt/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "emptydrivetime", "className": "text-center", "orderable": false },
                    { "data": "opthd", "className": "text-center", "orderable": false },
                    { "data": "loader", "className": "text-center", "orderable": false },
                    { "data": "nmloader", "className": "text-center", "orderable": false }
                ],
            });
        }, 1000);

        setTimeout(function(){
            var table2 = $('#table_empty_drive_distance').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_edd/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "emptydrivedistance", "className": "text-center", "orderable": false },
                    { "data": "opthd", "className": "text-center", "orderable": false },
                    { "data": "loader", "className": "text-center", "orderable": false },
                    { "data": "nmloader", "className": "text-center", "orderable": false }
                ],
            });
        }, 1100);

        setTimeout(function(){
            var table3 = $('#table_empty_stop_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_est/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table3.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "emptystoptime", "className": "text-center", "orderable": false },
                    { "data": "opthd", "className": "text-center", "orderable": false },
                    { "data": "loader", "className": "text-center", "orderable": false },
                    { "data": "nmloader", "className": "text-center", "orderable": false }
                ],
            });
        }, 1200);

        setTimeout(function(){
            var table4 = $('#table_loading_stop_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_lst/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table4.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "loadingstoptime", "className": "text-center", "orderable": false },
                    { "data": "opthd", "className": "text-center", "orderable": false },
                    { "data": "loader", "className": "text-center", "orderable": false },
                    { "data": "nmloader", "className": "text-center", "orderable": false }
                ],
            });
        }, 1300);

        setTimeout(function(){
            var table5 = $('#table_loaded_drive_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_ldt/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table5.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "loadeddrivetime", "className": "text-center", "orderable": false },
                    { "data": "opthd", "className": "text-center", "orderable": false },
                    { "data": "loader", "className": "text-center", "orderable": false },
                    { "data": "nmloader", "className": "text-center", "orderable": false }
                ],
            });
        },1400);

        setTimeout(function(){
            var table6 = $('#table_loaded_stop_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_ldst/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table6.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "loadedstoptime", "className": "text-center", "orderable": false },
                    { "data": "opthd", "className": "text-center", "orderable": false },
                    { "data": "loader", "className": "text-center", "orderable": false },
                    { "data": "nmloader", "className": "text-center", "orderable": false }
                ],
            });
        },1500);
    });
</script>