<section class="content-header">
    <h1>Unit <?=$detail_hd->nolambung;?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=site_url();?>dashboard">Home</a></li>
        <li>Payload</li>
        <li class="active"><?=$detail_hd->nolambung;?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
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
                            <a href="#">Status
                            <span class="pull-right label <?=($detail_hd->status == 1) ? 'label-success' : 'label-danger';?>"><?=($detail_hd->status == 1) ? 'Active' : 'Non-Active';?></span></a>
                        </li>
                        <li>
                            <a href="#">Site
                            <span class="pull-right"><?=($site_unit->servername == null) ? 'Data not found' : $site_unit->servername;?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="info-box" style="min-height: 55px;">
                <span class="info-box-icon bg-blue" style="height: 55px;width: 55px;font-size: 30px;line-height: 55px;"><i class="fas fa-calendar-check"></i></span>
                <div class="info-box-content" style="margin-left: 55px;">
                    <span class="info-box-text">LAST UPDATE DATA</span>
                    <span class="info-box-number f14"><?=($detail_hd->lastupdate == null ) ? "Data not updated" : date("d-m-Y H:i A", strtotime($detail_hd->lastupdate));?></span>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="alert alert-danger alert-dismissible hidden">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Attention!</h4>
                Sorry for the inconvenience, this page is currently under maintenance. Maybe there will be a time when an error will appear or the page cannot be accessed for a while. Thank you for your attention.
            </div>
            <div class="box box-primary ">
                <div class="box-header with-border">
                    <h3 class="box-title">Payload</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form id="form-filter-payload" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Pick date range</label>
                                <div class="input-group input-group">
                                    <input type="text" class="form-control required" id="date_range" name="date_range" placeholder="Choose date">
                                    <span class="input-group-btn">
                                        <button type="button" id="btn-filter-payload" class="btn btn-primary btn-flat">Search</button>
                                        <button class="btn btn-danger btn-flat" id="btn-reset-payload">Reset</button>
                                    </span>
                                </div><br>
                            </div>
                        </div>
                    </form>
                    <div class="panel panel-default no-radius">
                        <div class="panel-body">
                            <h4 class="text-blue"><b>Monthy Report</b></h4>
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
                            <!-- <div class="row"><div id="monthy_mvp"></div></div>
                            <div class="row"><div id="monthy_mvp_unit"></div></div> -->
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="dates-data1">* Data for : <b><?=date('F, Y');?></b></span>
                                    <span id="dates-data2" class="hidden"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <br>
                    <div id="content_payload">
                        <table id="table_payload" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Payload</th>
                                    <th>BCM Payload</th>
                                    <th>Opt. HD</th>
                                    <th>Loader</th>
                                    <th>Opt. Exca</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="content_spayload" class="hidden">
                        <table id="table_spayload" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Payload</th>
                                    <th>BCM Payload</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                    <th>Loader</th>
                                    <th>Opt. Exca</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Empty Drive Time</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="content_emptydrivetime">
                        <table id="table_empty_drive_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Empty Drive Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="content_semptydrivetime" class="hidden">
                        <table id="table_sempty_drive_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Empty Drive Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Empty Drive Distance</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="content_emptydrivedistance">
                        <table id="table_empty_drive_distance" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Empty Drive Distance (Km)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="content_semptydrivedistance" class="hidden">
                        <table id="table_sempty_drive_distance" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Empty Drive Distance (Km)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Empty Stop Time</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="content_emptystoptime">
                        <table id="table_empty_stop_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Empty Stop Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="content_semptystoptime" class="hidden">
                        <table id="table_sempty_stop_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Empty Stop Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Loading Stop Time</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="content_loadingstoptime">
                        <table id="table_loading_stop_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Loading Stop Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="content_sloadingstoptime" class="hidden">
                        <table id="table_sloading_stop_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Loading Stop Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Loaded Drive Time</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="content_loadeddrivetime">
                        <table id="table_loaded_drive_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Loaded Drive Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="content_sloadeddrivetime" class="hidden">
                        <table id="table_sloaded_drive_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Loaded Drive Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Loaded Stop Time</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div id="content_loadedstoptime">
                        <table id="table_loaded_stop_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Loaded Stop Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div id="content_sloadedstoptime" class="hidden">
                        <table id="table_sloaded_stop_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time (24 Hours)</th>
                                    <th>Loaded Stop Time (Minutes)</th>
                                    <th>NIK</th>
                                    <th>Opt. HD</th>
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
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){ 
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust(); 
            var data = $(this).data();
            if (data.chart !== undefined){ chart.validateSize(); }
        });

        $('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' } });
        $('#date_range').on('apply.daterangepicker', function(ev, picker){
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });
        $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
        var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';

        var oldExportAction = function (self, e, dt, button, config) {
            if (button[0].className.indexOf('buttons-excel') >= 0) {
                if ($.fn.dataTable.ext.buttons.excelHtml5.available(dt, config)) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                }
                else {
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                }
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
        };

        var newExportAction = function (e, dt, button, config) {
            var self = this;
            var oldStart = dt.settings()[0]._iDisplayStart;
            dt.one('preXhr', function (e, s, data) {
                data.start = 0;
                data.length = 2147483647;
                dt.one('preDraw', function (e, settings) {
                    oldExportAction(self, e, dt, button, config);
                    dt.one('preXhr', function (e, s, data) {
                        settings._iDisplayStart = oldStart;
                        data.start = oldStart;
                    });
                    setTimeout(dt.ajax.reload, 0);
                    return false;
                });
            });
            dt.ajax.reload();
        };

        var table_payload = $('#table_payload').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "scrollX": true,
            "destroy": true,
            "dom" : 'Bfrtip',
            "buttons" : [
                'pageLength', 
                {
                    extend : 'excel',
                    text : 'Export all to Excel',
                    action: newExportAction
                }
            ],
            "order": [],
            "ajax": {
                "url": '<?=site_url()?>t_payload/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                "type": 'POST',
                dataSrc: function ( data ){
                    $('#ave_payload').val(data.averagePay);
                    $('#ave_bcm_payload').val(data.averageBCM);
                    $('#min_bcm_payload').val(data.minBCM);
                    $('#max_bcm_payload').val(data.maxBCM);
                    return data.data;
                },
                error: function(data) {
                    swal({
                        animation: false,
                        focusConfirm: false,
                        text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                            table_payload.ajax.reload();
                        }
                    );
                }
            },
            "language": { "processing": bar, },
            "columns": [
                { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                { "data": "date", "className": "text-center", "orderable": false },
                { "data": "time", "className": "text-center", "orderable": false },
                { "data": "payload", "className": "text-center", "orderable": false },
                { "data": "bcm_payload", "className": "text-center", "orderable": false },
                { "data": "name", "className": "text-center", "orderable": false },
                { "data": "loader", "className": "text-center", "orderable": false },
                { "data": "nmloader", "className": "text-center", "orderable": false },
            ],
        });

        setTimeout(function(){
            var table_emptydrivetime = $('#table_empty_drive_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "destroy": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export all to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>t_edt/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    error: function(data) {
                        table_emptydrivetime.ajax.reload();
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center", "orderable": false },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "emptydrivetime", "className": "text-center", "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                ],
            });
        }, 2000);

        setTimeout(function(){
            var table_emptydrivedistance = $('#table_empty_drive_distance').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "destroy": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export all to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>t_edd/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    error: function(data) {
                        table_emptydrivedistance.ajax.reload();
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center", "orderable": false },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "emptydrivedistance", "className": "text-center", "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                ],
            });
        }, 4000);

        setTimeout(function(){
            var table_emptystoptime = $('#table_empty_stop_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "destroy": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export all to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>t_est/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    error: function(data) {
                        table_emptystoptime.ajax.reload();
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center", "orderable": false },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "emptystoptime", "className": "text-center", "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                ],
            });
        }, 6000);

        setTimeout(function(){
            var table_loadingstoptime = $('#table_loading_stop_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "destroy": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export all to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>t_lst/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    error: function(data) {
                        table_loadingstoptime.ajax.reload();
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center", "orderable": false },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "loadingstoptime", "className": "text-center", "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                ],
            });
        }, 8000);

        setTimeout(function(){
            var table_loadeddrivetime = $('#table_loaded_drive_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "destroy": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export all to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>t_ldt/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    error: function(data) {
                        table_loadeddrivetime.ajax.reload();
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center", "orderable": false },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "loadeddrivetime", "className": "text-center", "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                ],
            });
        },10000);

        setTimeout(function(){
            var table_loadedstoptime = $('#table_loaded_stop_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "destroy": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export all to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>t_ldst/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    error: function(data) {
                        table_loadedstoptime.ajax.reload();
                    }
                },
                "language": { "processing": bar, },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center", "orderable": false },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "loadedstoptime", "className": "text-center", "orderable": false },
                    { "data": "nik", "className": "text-center", "orderable": false },
                    { "data": "name", "className": "text-center", "orderable": false },
                ],
            });
        },12000);

        $('#btn-filter-payload').click(function(e){
            e.preventDefault();

            $('#loading').removeClass('hidden');

            if ($('#date_range').val() == '' || $('#date_range').val() == null){
                $('#loading').addClass('hidden');
                swal("Oops!", "Please choose date range first!", "error");
                return false;
            } else {
                $('#loading').addClass('hidden');

                var date_range = $('#date_range').val().split(' - '),
                    date_start = date_range[0],
                    date_end   = date_range[1],
                    date_start_new = date_start.replace(/\//g, '-'),
                    date_end_new   = date_end.replace(/\//g, '-');

                $("#dates-data1").addClass('hidden'); 
                $("#dates-data2").removeClass('hidden');    
                $("#dates-data2").html('*Data for : ' +date_start_new+ ' S/d ' +date_end_new);
                
                $('#content_payload').addClass('hidden');
                $('#content_spayload').removeClass('hidden');
                setTimeout(function(){
                    var table_spayload = $('#table_spayload').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "scrollX": true,
                        "destroy": true,
                        "bFilter": false,
                        "responsive": true,
                        "ordering": false,
                        "dom" : 'Bfrtip',
                        "buttons" : [
                            'pageLength', 
                            {
                                extend : 'excel',
                                text : 'Export all to Excel',
                                action: newExportAction
                            }
                        ],
                        "ajax": {
                            "url": '<?=site_url()?>st_payload/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                            "type": 'POST',
                            "dataType": 'JSON',
                            "cache": false,
                            data : function ( data ){
                                data.date_start = date_start;
                                data.date_end   = date_end;
                            },
                            dataSrc: function ( data ){
                                $('#ave_payload').val(data.averagePay);
                                $('#ave_bcm_payload').val(data.averageBCM);
                                $('#min_bcm_payload').val(data.minBCM);
                                $('#max_bcm_payload').val(data.maxBCM);
                                return data.data;
                            },
                            error: function(data) {
                                swal({
                                    animation: false,
                                    focusConfirm: false,
                                    text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                        table_spayload.ajax.reload();
                                    }
                                );
                            }
                        },
                        "language": { "processing": bar, },
                        "columns": [
                            { "data": "no", "className": "text-center"},
                            { "data": "date","className": "text-center"},
                            { "data": "time","className": "text-center"},
                            { "data": "payload","className": "text-center"},
                            { "data": "bcm_payload","className": "text-center"},
                            { "data": "nik","className": "text-center"},
                            { "data": "name","className": "text-center"},
                            { "data": "loader", "className": "text-center" },
                            { "data": "nmloader", "className": "text-center" },
                        ],
                    });
                }, 2500);

                $('#content_emptydrivetime').addClass('hidden');
                $('#content_semptydrivetime').removeClass('hidden');
                setTimeout(function(){
                    var table_semptydrivetime = $('#table_sempty_drive_time').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "responsive": true,
                        "scrollX": true,
                        "destroy": true,
                        "bFilter": false,
                        "ordering": false,
                        "dom" : 'Bfrtip',
                        "buttons" : [
                            'pageLength', 
                            {
                                extend : 'excel',
                                text : 'Export all to Excel',
                                action: newExportAction
                            }
                        ],
                        "ajax": {
                            "url": '<?=site_url()?>st_edt/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                            "type": 'POST',
                            data : function ( data ){
                                data.date_start = date_start;
                                data.date_end   = date_end;
                            },
                            error: function(data) {
                                swal({
                                    animation: false,
                                    focusConfirm: false,
                                    text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                        table_semptydrivetime.ajax.reload();
                                    }
                                );
                            }
                        },
                        "language": { "processing": bar, },
                        "columns": [
                            { "data": "no", "className": "text-center" },
                            { "data": "date", "className": "text-center" },
                            { "data": "time", "className": "text-center" },
                            { "data": "emptydrivetime", "className": "text-center" },
                            { "data": "nik", "className": "text-center" },
                            { "data": "name", "className": "text-center" },
                        ],
                    });
                }, 6500);
                
                $('#content_emptydrivedistance').addClass('hidden');
                $('#content_semptydrivedistance').removeClass('hidden');
                setTimeout(function(){
                    var table_semptydrivedistance = $('#table_sempty_drive_distance').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "responsive": true,
                        "scrollX": true,
                        "destroy": true,
                        "bFilter": false,
                        "ordering": false,
                        "dom" : 'Bfrtip',
                        "buttons" : [
                            'pageLength', 
                            {
                                extend : 'excel',
                                text : 'Export all to Excel',
                                action: newExportAction
                            }
                        ],
                        "ajax": {
                            "url": '<?=site_url()?>st_edd/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                            "type": 'POST',
                            data : function ( data ){
                                data.date_start = date_start;
                                data.date_end   = date_end;
                            },
                            error: function(data) {
                                swal({
                                    animation: false,
                                    focusConfirm: false,
                                    text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                        table_semptydrivedistance.ajax.reload();
                                    }
                                );
                            }
                        },
                        "language": {  "processing": bar, },
                        "columns": [
                            { "data": "no", "className": "text-center" },
                            { "data": "date", "className": "text-center" },
                            { "data": "time", "className": "text-center" },
                            { "data": "emptydrivedistance", "className": "text-center" },
                            { "data": "nik", "className": "text-center" },
                            { "data": "name", "className": "text-center" },
                        ],
                    });
                }, 8500);

                $('#content_emptystoptime').addClass('hidden');
                $('#content_semptystoptime').removeClass('hidden');
                setTimeout(function(){
                    var table_semptystoptime = $('#table_sempty_stop_time').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "responsive": true,
                        "scrollX": true,
                        "destroy": true,
                        "bFilter": false,
                        "ordering": false,
                        "dom" : 'Bfrtip',
                        "buttons" : [
                            'pageLength', 
                            {
                                extend : 'excel',
                                text : 'Export all to Excel',
                                action: newExportAction
                            }
                        ],
                        "ajax": {
                            "url": '<?=site_url()?>st_est/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                            "type": 'POST',
                            data : function ( data ){
                                data.date_start = date_start;
                                data.date_end   = date_end;
                            },
                            error: function(data) {
                                swal({
                                    animation: false,
                                    focusConfirm: false,
                                    text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                        table_semptystoptime.ajax.reload();
                                    }
                                );
                            }
                        },
                        "language": { 
                            "processing": 
                            bar,
                        },
                        "columns": [
                            { "data": "no", "className": "text-center" },
                            { "data": "date", "className": "text-center" },
                            { "data": "time", "className": "text-center" },
                            { "data": "emptystoptime", "className": "text-center" },
                            { "data": "nik", "className": "text-center" },
                            { "data": "name", "className": "text-center" },
                        ],
                    });
                }, 10500);

                $('#content_loadingstoptime').addClass('hidden');
                $('#content_sloadingstoptime').removeClass('hidden');
                setTimeout(function(){
                    var table_sloadingstoptime = $('#table_sloading_stop_time').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "responsive": true,
                        "scrollX": true,
                        "destroy": true,
                        "bFilter": false,
                        "ordering": false,
                        "dom" : 'Bfrtip',
                        "buttons" : [
                            'pageLength', 
                            {
                                extend : 'excel',
                                text : 'Export all to Excel',
                                action: newExportAction
                            }
                        ],
                        "ajax": {
                            "url": '<?=site_url()?>st_lst/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                            "type": 'POST',
                            data : function ( data ){
                                data.date_start = date_start;
                                data.date_end   = date_end;
                            },
                            error: function(data) {
                                swal({
                                    animation: false,
                                    focusConfirm: false,
                                    text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                        table_sloadingstoptime.ajax.reload();
                                    }
                                );
                            }
                        },
                        "language": {  "processing": bar, },
                        "columns": [
                            { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                            { "data": "date", "className": "text-center", "orderable": false },
                            { "data": "time", "className": "text-center", "orderable": false },
                            { "data": "loadingstoptime", "className": "text-center", "orderable": false },
                            { "data": "nik", "className": "text-center", "orderable": false },
                            { "data": "name", "className": "text-center", "orderable": false },
                        ],
                    });
                }, 12500);

                $('#content_loadeddrivetime').addClass('hidden');
                $('#content_sloadeddrivetime').removeClass('hidden');
                setTimeout(function(){
                    var table_loadeddrivetime = $('#table_sloaded_drive_time').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "responsive": true,
                        "scrollX": true,
                        "destroy": true,
                        "bFilter": false,
                        "ordering": false,
                        "dom" : 'Bfrtip',
                        "buttons" : [
                            'pageLength', 
                            {
                                extend : 'excel',
                                text : 'Export all to Excel',
                                action: newExportAction
                            }
                        ],
                        "ajax": {
                            "url": '<?=site_url()?>st_ldt/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                            "type": 'POST',
                            data : function ( data ){
                                data.date_start = date_start;
                                data.date_end   = date_end;
                            },
                            error: function(data) {
                                swal({
                                    animation: false,
                                    focusConfirm: false,
                                    text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                        table_loadeddrivetime.ajax.reload();
                                    }
                                );
                            }
                        },
                        "language": { "processing": bar, },
                        "columns": [
                            { "data": "no", "className": "text-center" },
                            { "data": "date", "className": "text-center" },
                            { "data": "time", "className": "text-center" },
                            { "data": "loadeddrivetime", "className": "text-center" },
                            { "data": "nik", "className": "text-center" },
                            { "data": "name", "className": "text-center" },
                        ],
                    });
                }, 14500);

                $('#content_loadedstoptime').addClass('hidden');
                $('#content_sloadedstoptime').removeClass('hidden');
                setTimeout(function(){
                    var table_sloadedstoptime = $('#table_sloaded_stop_time').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "responsive": true,
                        "scrollX": true,
                        "destroy": true,
                        "ordering": false,
                        "dom" : 'Bfrtip',
                        "buttons" : [
                            'pageLength', 
                            {
                                extend : 'excel',
                                text : 'Export all to Excel',
                                action: newExportAction
                            }
                        ],
                        "ajax": {
                            "url": '<?=site_url()?>st_ldst/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                            "type": 'POST',
                            data : function ( data ){
                                data.date_start = date_start;
                                data.date_end   = date_end;
                            },
                            error: function(data) {
                                swal({
                                    animation: false,
                                    focusConfirm: false,
                                    text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                        table_sloadedstoptime.ajax.reload();
                                    }
                                );
                            }
                        },
                        "language": { "processing": bar, },
                        "columns": [
                            { "data": "no", "className": "text-center" },
                            { "data": "date", "className": "text-center" },
                            { "data": "time", "className": "text-center" },
                            { "data": "loadedstoptime", "className": "text-center" },
                            { "data": "nik", "className": "text-center" },
                            { "data": "name", "className": "text-center" },
                        ],
                    });
                }, 16500);
            }
        });

        $('#btn-reset-payload').click(function(e) {
            e.preventDefault();

            $('#form-filter-payload')[0].reset();

            $('#table_spayload').DataTable().destroy();
            $('#table_sempty_drive_time').DataTable().destroy();
            $('#table_sempty_drive_distance').DataTable().destroy();
            $('#table_sempty_stop_time').DataTable().destroy();
            $('#table_sloading_stop_time').DataTable().destroy();
            $('#table_sloaded_drive_time').DataTable().destroy();
            $('#table_sloaded_stop_time').DataTable().destroy();

            $('#dates-data1').removeClass('hidden');
            $('#dates-data2').addClass('hidden');
            $('#content_payload').removeClass('hidden');
            $('#content_emptydrivetime').removeClass('hidden');
            $('#content_emptydrivedistance').removeClass('hidden');
            $('#content_emptystoptime').removeClass('hidden');
            $('#content_loadingstoptime').removeClass('hidden');
            $('#content_loadeddrivetime').removeClass('hidden');
            $('#content_loadedstoptime').removeClass('hidden');

            $('#content_spayload').addClass('hidden');
            $('#content_semptydrivetime').addClass('hidden');
            $('#content_semptydrivedistance').addClass('hidden');
            $('#content_semptystoptime').addClass('hidden');
            $('#content_sloadingstoptime').addClass('hidden');
            $('#content_sloadeddrivetime').addClass('hidden');
            $('#content_sloadedstoptime').addClass('hidden');
            
            setTimeout(function(){
                $('#table_payload').DataTable().ajax.reload();
            }, 1000);
            setTimeout(function(){
                $('#table_empty_drive_time').DataTable().ajax.reload();
            }, 2000);
            setTimeout(function(){
                $('#table_empty_drive_distance').DataTable().ajax.reload();
            }, 3000)
            setTimeout(function(){
                $('#table_empty_stop_time').DataTable().ajax.reload();
            }, 4000);
            setTimeout(function(){
                $('#table_loading_stop_time').DataTable().ajax.reload();
            }, 5000);
            setTimeout(function(){
                $('#table_loaded_drive_time').DataTable().ajax.reload();
            }, 6000);
            setTimeout(function(){
                $('#table_loaded_stop_time').DataTable().ajax.reload();
            }, 7000);
        });
    });

    // $.getJSON('<?=site_url()?>monthy_mvp/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>', function(data) {
    //     $.each(data, function (index, x) {
    //         $('<div class="col-md-3"><div class="form-group"><label>'+x.label+'</label><input type="text" class="form-control input-sm" value="'+x.value+'" readonly></div></div>').appendTo('#monthy_mvp');
    //     });
    // });

    // $.getJSON('<?=site_url()?>monthy_mvp_unit/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>', function(data) {
    //     $.each(data, function (index, x) {
    //         $('<div class="col-md-3"><div class="form-group"><label>'+x.label+'</label><input type="text" class="form-control input-sm" value="'+x.value+'" readonly></div></div>').appendTo('#monthy_mvp_unit');
    //     });
    // });
</script>