<section class="content-header">
    <h1><a href="<?=site_url();?>dashboard" class="btn btn-sm bg-orange" data-toggle="tooltip" title="Go Back"><i class="fas fa-chevron-left"></i></a> Unit <?=$detail_hd->nolambung;?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=site_url();?>dashboard">Home</a></li>
        <li>Warning & Fault</li>
        <li class="active"><?=$detail_hd->nolambung;?></li>
    </ol>
</section>
<section class="content">
    <div class="alert alert-danger alert-dismissible hidden">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Attention!</h4>
      Sorry for the inconvenience, this page is currently under maintenance. Maybe there will be a time when an error will appear or this page cannot be accessed for a while. Thank you for your attention.
   </div>
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
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-blue" style="padding: 5px;">
                    <h3 class="text-center">Payload</h3>
                    <h5 class="text-center"><i class="far fa-calendar-alt"></i> <?=date('M Y')?></h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked" id="myData"></ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Search</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form id="form-filter-warning" method="post" action="#">
                                <label class="control-label">Pick date range</label>
                                <div class="input-group input-group">
                                    <input type="text" class="form-control required" id="date_range" name="date_range" placeholder="Choose date">
                                    <span class="input-group-btn">
                                        <button type="button" id="btn-filter-warning" class="btn btn-danger btn-flat">Search</button>
                                        <button type="button" id="btn-reset-warning" class="btn btn-primary btn-flat">Reset</button>
                                        <button type="button" id="btn-export-warning" class="btn btn-success btn-flat hidden">Export All</button>
                                    </span>
                                </div><br>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Warning Message Status</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="table_warning_unit" class="table table-bordered table-hover nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th class="text-center bg-white">Messages</th>
                                <th>Mensaje</th>
                            </tr>
                        </thead>
                    </table>
                    <span>* Data for : <?= date("M Y", strtotime("-1 month")).' - '.date("M Y") ?></span>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right" id="myTabs">
                    <li class="active"><a href="#chart_oil" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_oil" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Engine Oil Temperatures</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_oil">
                        <div class="chart-responsive">
                            <div class="chart" id="oil-temperature-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_oil">
                        <table id="table_engine_oil_temperature" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Temperatures (DegC)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_fuel" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_fuel" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Fuel Rate</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_fuel">
                        <div class="chart-responsive">
                            <div class="chart" id="fuelrate-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_fuel">
                        <table id="table_fuel_rate" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Rate (liter / Hour)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_transmission_oiltemp" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_transmission_oiltemp" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Transmission Oil Temperature</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_transmission_oiltemp">
                        <div class="chart-responsive">
                            <div class="chart" id="transmission_oiltemp-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_transmission_oiltemp">
                        <table id="table_transmission_oil_temp" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Temperatures (DegC)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_engine_coolant_temp" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_engine_coolant_temp" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Engine Coolant Temperature</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_engine_coolant_temp">
                        <div class="chart-responsive">
                            <div class="chart" id="engine-coolant-temp-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_engine_coolant_temp">
                        <table id="table_engine_coolant_temp" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Temperatures (DegC)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_blow_by_pressure" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_blow_by_pressure" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Blow By Pressure</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_blow_by_pressure">
                        <div class="chart-responsive">
                            <div class="chart" id="blow-by-pressure-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_blow_by_pressure">
                        <table id="table_blow_by_pressure" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Pressure (mmAq)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_boost_pressure" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_boost_pressure" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Boost Pressure</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_boost_pressure">
                        <div class="chart-responsive">
                            <div class="chart" id="boost-pressure-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_boost_pressure">
                        <table id="table_boost_pressure" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Pressure (mmHg)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_travel_speed" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travel_speed" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Travel Speed</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travel_speed">
                        <div class="chart-responsive">
                            <div class="chart" id="travel-speed-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travel_speed">
                        <table id="table_travel_speed" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Measure (Km / Hour)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_engine_speed" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_engine_speed" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Engine Speed</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_engine_speed">
                        <div class="chart-responsive">
                            <div class="chart" id="engine-speed-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_engine_speed">
                        <table id="table_engine_speed" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Measure (Rpm)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_front_brake" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_front_brake" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Front Brake</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_front_brake">
                        <div class="chart-responsive">
                          <div class="chart" id="front-brake-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_front_brake">
                        <table id="table_front_brake" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Pressure (mPa)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom" >
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_rear_brake" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_rear_brake" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Rear Break</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_rear_brake">
                        <div class="chart-responsive">
                            <div class="chart" id="rear-brake-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_rear_brake">
                        <table id="table_rear_brake" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Pressure (mPa)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom" >
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_oil_min" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_oil_min" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Oil Pressure Minimum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_oil_min">
                        <div class="chart-responsive">
                            <div class="chart" id="oil-min-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_oil_min">
                        <table id="table_oil_min" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Pressure (mPa)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom" >
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_oil_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_oil_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Oil Pressure Maximum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_oil_max">
                        <div class="chart-responsive">
                            <div class="chart" id="oil-max-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_oil_max">
                        <table id="table_oil_max" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Pressure (mPa)</th>
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
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){ $($.fn.dataTable.tables(true)).DataTable().columns.adjust(); });
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

        setTimeout(function(){
            var table1 = $('#table_warning_unit').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "scrollX": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_warning/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table1.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "messages", "className": "text-left", "orderable": false },
                    { "data": "mensaje", "className": "text-center", "visible": false },
                ],
                "createdRow": function( row, data, dataIndex){
                    if( data['mensaje'] == 'CRITICAL'){
                        $(row).addClass('bg-red');
                    } else {
                        $(row).addClass('bg-yellow');
                    }
                },
            });
        }, 1000);

        setTimeout(function(){
            var table2 = $('#table_engine_oil_temperature').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_oil/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table2.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "temperature", "className": "text-center", "orderable": false },
                ],
            });
        }, 2000);

        setTimeout(function(){
            var table3 = $('#table_fuel_rate').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_fuel/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function (data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        table3.ajax.reload();
                    }
                },
                "language": { "processing":bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "fuel", "className": "text-center", "orderable": false },
                ],
            });
        }, 3000);

        setTimeout(function(){
            var table4 = $('#table_transmission_oil_temp').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_transmission/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                       table4.ajax.reload();
                    }
                },
                "language": { "processing":bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "tmoiltemp", "className": "text-center", "orderable": false },
                ],
            });
        }, 4000);

        setTimeout(function(){
            var table5 = $('#table_engine_coolant_temp').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_coolant/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table5.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "cooltemp", "className": "text-center", "orderable": false },
                ],
            });
        }, 5000);

        setTimeout(function(){
            var table6 = $('#table_blow_by_pressure').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_blow/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table6.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "blowbypress", "className": "text-center", "orderable": false },
                ],
            });
        }, 6000);

        setTimeout(function(){
            var table7 = $('#table_boost_pressure').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_boost/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table7.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "boostpress", "className": "text-center", "orderable": false },
                ],
            });
        }, 7000);

        setTimeout(function(){
            var table8 = $('#table_travel_speed').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_travel/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table8.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "travelspeed", "className": "text-center", "orderable": false },
                ],
            });
        }, 8000);

        setTimeout(function(){
            var table9 = $('#table_engine_speed').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_engine/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table9.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "enginespeed", "className": "text-center", "orderable": false },
                ],
            });
        }, 9000);

        setTimeout(function(){
            var table10 = $('#table_front_brake').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_front/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table10.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "frontbrake", "className": "text-center", "orderable": false },
                ],
            });
        }, 10000);

        setTimeout(function(){
            var table11 = $('#table_rear_brake').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_rear/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                    	table11.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "rearbrake", "className": "text-center", "orderable": false },
                ],
            });
        }, 11000);

        setTimeout(function(){
            var table12 = $('#table_oil_min').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_oilpmin/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        table12.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "oilpressmin", "className": "text-center", "orderable": false },
                ],
            });
        }, 12000);

        setTimeout(function(){
            var table12 = $('#table_oil_max').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "dom" : 'Bfrtip',
                "buttons" : [
                    'pageLength', 
                    {
                        extend : 'excel',
                        text : 'Export to Excel',
                        action: newExportAction
                    }
                ],
                "order": [],
                "ajax": {
                    "url"  : '<?=site_url()?>t_oilpmax/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        table12.ajax.reload();
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "oilpressmax", "className": "text-center", "orderable": false },
                ],
            });
        }, 13000);

        setTimeout(function(){
            var chart = am4core.create("oil-temperature-chart", am4charts.XYChart);
            chart.responsive.enabled = true;
            chart.preloader.disabled = true;
            var indicator;
            function showIndicator() {
                if (indicator) {
                    indicator.show();
                } else {
                    indicator = chart.tooltipContainer.createChild(am4core.Container);
                    indicator.background.fill = am4core.color("#fff");
                    indicator.background.fillOpacity = 1.00;
                    indicator.width = am4core.percent(100);
                    indicator.height = am4core.percent(100);

                    var indicatorLabel = indicator.createChild(am4core.Label);
                    indicatorLabel.text = "No data...";
                    indicatorLabel.align = "center";
                    indicatorLabel.valign = "middle";
                    indicatorLabel.fontSize = 20;
                }
            }
            function hideIndicator() { indicator.hide(); }
            chart.events.on("beforevalidated", function(ev) {
                if (ev.target.data.length == 0) {
                    showIndicator();
                } else if (indicator) {
                    hideIndicator();
                }
            });
            
            chart.dataSource.url = "<?=site_url();?>chart_oil/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

            var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
            dateAxis.renderer.minGridDistance = 100;
            dateAxis.renderer.grid.template.disabled = true;
            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.title.text = "Temperature DegC";

            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "temp";
            series.dataFields.dateX = "date";
            series.name = "Temperature Oil";
            series.tooltipText = "{name}: [bold]{valueY}[/]";
            series.strokeWidth = 2;

            var series2 = chart.series.push(new am4charts.LineSeries());
            series2.dataFields.valueY = "critical";
            series2.dataFields.dateX = "date";
            series2.name = "Critical";
            series2.tooltipText = "{name}: [bold]{valueY}[/]";
            series2.strokeWidth = 2;
            series2.yAxis = valueAxis;
            series2.stroke = am4core.color("red");

            var series3 = chart.series.push(new am4charts.LineSeries());
            series3.dataFields.valueY = "caution";
            series3.dataFields.dateX = "date";
            series3.name = "Caution";
            series3.tooltipText = "{name}: [bold]{valueY}[/]";
            series3.strokeWidth = 2;
            series3.yAxis = valueAxis;
            series3.stroke = am4core.color("yellow");

            chart.legend = new am4charts.Legend();
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panXY";
            chart.cursor.xAxis = dateAxis;
            chart.cursor.snapToSeries = series;

            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.strokeWidth = 2;
            bullet.circle.radius = 3;
            bullet.circle.fill = am4core.color("#fff");

            chart.maskBullets = false;
        }, 1500);

        $('#btn-filter-warning').click(function(){
            $('#table_warning_unit').DataTable().ajax.reload();
            $('#table_engine_oil_temperature').DataTable().ajax.reload();
            $('#table_fuel_rate').DataTable().ajax.reload();
            $('#table_transmission_oil_temp').DataTable().ajax.reload();
            $('#table_engine_coolant_temp').DataTable().ajax.reload();
            $('#table_blow_by_pressure').DataTable().ajax.reload();
            $('#table_boost_pressure').DataTable().ajax.reload();
            $('#table_travel_speed').DataTable().ajax.reload();
            $('#table_engine_speed').DataTable().ajax.reload();
            $('#table_front_brake').DataTable().ajax.reload();
            $('#table_rear_brake').DataTable().ajax.reload();
            $('#table_oil_min').DataTable().ajax.reload();
            $('#table_oil_max').DataTable().ajax.reload();
        });
        $('#btn-reset-warning').click(function(){ 
            $('#form-filter-warning')[0].reset();
            $('#table_warning_unit').DataTable().ajax.reload();
            $('#table_engine_oil_temperature').DataTable().ajax.reload();
            $('#table_fuel_rate').DataTable().ajax.reload();
            $('#table_transmission_oil_temp').DataTable().ajax.reload();
            $('#table_engine_coolant_temp').DataTable().ajax.reload();
            $('#table_blow_by_pressure').DataTable().ajax.reload();
            $('#table_boost_pressure').DataTable().ajax.reload();
            $('#table_travel_speed').DataTable().ajax.reload();
            $('#table_engine_speed').DataTable().ajax.reload();
            $('#table_front_brake').DataTable().ajax.reload();
            $('#table_rear_brake').DataTable().ajax.reload();
            $('#table_oil_min').DataTable().ajax.reload();
            $('#table_oil_max').DataTable().ajax.reload();
        });

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("fuelrate-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_fuel/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Liter / Hour";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "fuel";
                series.dataFields.dateX = "date";
                series.name = "Liter / Hour";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 2500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("transmission_oiltemp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_transmission/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Temperature DegC";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "tmoiltemp";
                series.dataFields.dateX = "date";
                series.name = "Temperature DegC";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 3500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("engine-coolant-temp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_coolant/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Temperature DegC";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "cooltemp";
                series.dataFields.dateX = "date";
                series.name = "Temperature DegC";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 4500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("blow-by-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_blow/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mmAq)";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "blowbypress";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mmAq)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 5500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("boost-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_boost/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mmHg)";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "boostpress";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mmHg)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 6500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("travel-speed-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_travel/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Measure (Km / Hour)";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travelspeed";
                series.dataFields.dateX = "date";
                series.name = "Measure (Km / Hour)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 7500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("engine-speed-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_engine/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Measure (Rpm)";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "enginespeed";
                series.dataFields.dateX = "date";
                series.name = "Measure (Rpm)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 8500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("front-brake-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_front/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "frontbrake";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 9500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("rear-brake-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_rear/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "rearbrake";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 10500);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("oil-min-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_oil_min/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "oilplomin";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 11000);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("oil-max-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                var indicator;
                function showIndicator() {
                    if (indicator) {
                        indicator.show();
                    } else {
                        indicator = chart.tooltipContainer.createChild(am4core.Container);
                        indicator.background.fill = am4core.color("#fff");
                        indicator.background.fillOpacity = 1.00;
                        indicator.width = am4core.percent(100);
                        indicator.height = am4core.percent(100);

                        var indicatorLabel = indicator.createChild(am4core.Label);
                        indicatorLabel.text = "No data...";
                        indicatorLabel.align = "center";
                        indicatorLabel.valign = "middle";
                        indicatorLabel.fontSize = 20;
                    }
                }
                function hideIndicator() { indicator.hide(); }
                chart.events.on("beforevalidated", function(ev) {
                    if (ev.target.data.length == 0) {
                        showIndicator();
                    } else if (indicator) {
                        hideIndicator();
                    }
                });
                chart.dataSource.url = "<?=site_url();?>chart_oil_max/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>";

                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";

                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "oilpmax";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;

                var series2 = chart.series.push(new am4charts.LineSeries());
                series2.dataFields.valueY = "critical";
                series2.dataFields.dateX = "date";
                series2.name = "Critical";
                series2.tooltipText = "{name}: [bold]{valueY}[/]";
                series2.strokeWidth = 2;
                series2.yAxis = valueAxis;
                series2.stroke = am4core.color("red");

                var series3 = chart.series.push(new am4charts.LineSeries());
                series3.dataFields.valueY = "caution";
                series3.dataFields.dateX = "date";
                series3.name = "Caution";
                series3.tooltipText = "{name}: [bold]{valueY}[/]";
                series3.strokeWidth = 2;
                series3.yAxis = valueAxis;
                series3.stroke = am4core.color("yellow");

                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;

                var bullet = series.bullets.push(new am4charts.CircleBullet());
                bullet.circle.strokeWidth = 2;
                bullet.circle.radius = 3;
                bullet.circle.fill = am4core.color("#fff");

                chart.maskBullets = false;
            });
        }, 11500);
    });

    $.getJSON('<?=site_url()?>info_payload/unit/hd/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>', function(data) {
        $.each(data, function (index, x) {
            if (x.label == "See detail") {
                $('<li><a class="text-blue text-bold" href="'+ x.value +'">' + x.label + '</a></li>').appendTo('#myData');
            } else {
                $('<li><a>' + x.label + ' <span class="pull-right badge bg-blue"> ' + x.value + '</span></a></li>').appendTo('#myData');
            }
            
        });
    });
</script>