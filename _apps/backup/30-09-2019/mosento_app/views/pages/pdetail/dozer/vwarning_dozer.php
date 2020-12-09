<section class="content-header">
    <h1><a href="<?=site_url();?>dashboard" class="btn btn-sm bg-orange" data-toggle="tooltip" title="Go Back"><i class="fas fa-chevron-left"></i></a> Unit <?=$warning_dozer->nolambung;?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=site_url();?>dashboard">Home</a></li>
        <li>Detail</li>
        <li class="active"><?=$warning_dozer->nolambung;?></li>
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
                    <div class="text-center"><img src="<?=site_url();?>s_url/icon_dozer" width="200" /></div>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="#">Bulldozer
                            <span class="pull-right"><b><?=$warning_dozer->unit;?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Serial Number 
                            <span class="pull-right"><b><?=$warning_dozer->serialnumber?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Status
                            <span class="pull-right label <?=($warning_dozer->status == 1) ? 'label-success' : 'label-danger';?>"><?=($warning_dozer->status == 1) ? 'Active' : 'Non-Active';?></span></a>
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
                    <span class="info-box-number f14"><?=($warning_dozer->lastupdate == null ) ? "Data not updated" : date("d-m-Y H:i A", strtotime($warning_dozer->lastupdate));?></span>
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
                            <form id="form-filter-warning">
                                <label class="control-label">Pick date range</label>
                                <div class="input-group input-group">
                                    <input type="text" class="form-control required" id="date_range" name="date_range" placeholder="Choose date">
                                    <span class="input-group-btn">
                                        <button type="button" id="btn-filter-warning" class="btn btn-danger btn-flat">Search</button>
                                        <button type="button" id="btn-reset-warning" class="btn btn-primary btn-flat">Reset</button>
                                        <button type="button" id="btn-export-warning" class="btn btn-success btn-flat hidden">Export</button>
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
                                <th class="hidden">Mensaje</th>
                            </tr>
                        </thead>
                    </table>
                    <span>* Data for : <?= date("M Y", strtotime("-1 month")).' - '.date("M Y") ?></span>
                </div>
            </div>
        </div>
    </div>
    <h4 class="page-header text-center"><b>MOSENTO</b> Technical Parameter</h4>
    <div class="row">
        <div class="col-md-6">
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
                                    <th>Temperature (DegC)</th>
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
                          <div class="chart" id="transmission-oiltemp-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_transmission_oiltemp">
                        <table id="table_transmission_oiltemp" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
                    <li class="active"><a href="#chart_transmain_press_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_transmain_press_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Transmission Main Pressure Maximal</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_transmain_press_max">
                        <div class="chart-responsive">
                          <div class="chart" id="transmain-press-max-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_transmain_press_max">
                        <table id="table_transmain_press_max" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Second (Sec)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_operatime" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_operatime" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Operating Time</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_operatime">
                        <div class="chart-responsive">
                          <div class="chart" id="operatime-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_operatime">
                        <table id="table_operatime" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Second (Sec)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_ripping_time" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_ripping_time" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Ripping Time</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_ripping_time">
                        <div class="chart-responsive">
                          <div class="chart" id="ripping-time-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_ripping_time">
                        <table id="table_ripping_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Second (Sec)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_fwd_distance_f2" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_fwd_distance_f2" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Forward Distance @F2</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_fwd_distance_f2">
                        <div class="chart-responsive">
                          <div class="chart" id="fwd-distance-f2-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_fwd_distance_f2">
                        <table id="table_fwd_distance_f2" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>KM/hour</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
                    <li class="active"><a href="#chart_transmain_press_avg" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_transmain_press_avg" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Transmission Main Pressure Average</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_transmain_press_avg">
                        <div class="chart-responsive">
                          <div class="chart" id="transmain-press-avg-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_transmain_press_avg">
                        <table id="table_transmain_press_avg" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Second (Sec)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_dozing_time" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_dozing_time" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Dozing Time</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_dozing_time">
                        <div class="chart-responsive">
                          <div class="chart" id="dozing-time-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_dozing_time">
                        <table id="table_dozing_time" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Second (Sec)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_fwd_distance_f1" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_fwd_distance_f1" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Forward Distance @F1</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_fwd_distance_f1">
                        <div class="chart-responsive">
                          <div class="chart" id="fwd-distance-f1-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_fwd_distance_f1">
                        <table id="table_fwd_distance_f1" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>KM/hour</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_fwd_distance_f3" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_fwd_distance_f3" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Forward Distance @F3</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_fwd_distance_f3">
                        <div class="chart-responsive">
                          <div class="chart" id="fwd-distance-f3-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_fwd_distance_f3">
                        <table id="table_fwd_distance_f3" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-dark-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>KM/hour</th>
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
        $('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' } });
        $('#date_range').on('apply.daterangepicker', function(ev, picker){
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });
        $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){ $($.fn.dataTable.tables(true)).DataTable().columns.adjust(); });
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
        $('#btn-filter-warning').click(function(){
            if($("#form-filter-warning").valid() == false){
                toastr.error('Select a date range first!');
                return false;
            } else {
                $('#table_warning_unit').DataTable().ajax.reload();
                $('#table_engine_oil_temperature').DataTable().ajax.reload();
                $('#table_fuel_rate').DataTable().ajax.reload();
                $('#table_transmission_oiltemp').DataTable().ajax.reload();
                $('#table_engine_coolant_temp').DataTable().ajax.reload();
                $('#table_blow_by_pressure').DataTable().ajax.reload();
                $('#table_boost_pressure').DataTable().ajax.reload();
            }
        });
        $('#btn-reset-warning').click(function(){
            $('#form-filter-warning')[0].reset();
            $('#table_warning_unit').DataTable().ajax.reload();
            $('#table_engine_oil_temperature').DataTable().ajax.reload();
            $('#table_fuel_rate').DataTable().ajax.reload();
            $('#table_transmission_oiltemp').DataTable().ajax.reload();
            $('#table_engine_coolant_temp').DataTable().ajax.reload();
            $('#table_blow_by_pressure').DataTable().ajax.reload();
            $('#table_boost_pressure').DataTable().ajax.reload();
        });
        $('#btn-export-warning').click(function(){
            if($("#form-filter-warning").valid() == false){
                toastr.error('Please select a date range first!');
                return false;
            } else {
                var date_range = $('#date_range').val().split(' - '),
                date_start = date_range[0],
                date_end   = date_range[1],
                date_start_new = date_start.replace(/\//g, '-'),
                date_end_new   = date_end.replace(/\//g, '-');
                window.open('<?=site_url()?>cdetail/dozer/sysexport_warning_exca/export/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>/'+date_start_new+'/'+date_end_new);
            }
        });

        function show_indicator(chart){
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
        }

        function show_parameter(chart,dateAxis,valueAxis,series){
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
        }

        // TABLE
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
                    "url": '<?=site_url()?>t_warning/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table1.ajax.reload();
                            }
                        );
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
                    "url": '<?=site_url()?>t_oil/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table2.ajax.reload();
                            }
                        );
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
        }, 1100);

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
                    "url": '<?=site_url()?>t_fuel/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table3.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "fuel", "className": "text-center", "orderable": false },
                ],
            });
        }, 1200);

        setTimeout(function(){
            var table4 = $('#table_transmission_oiltemp').DataTable({
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
                    "url": '<?=site_url()?>t_transmission/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table4.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "tmoiltemp", "className": "text-center", "orderable": false },
                ],
            });
        }, 1300);

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
                    "url": '<?=site_url()?>t_coolant/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table5.ajax.reload();
                            }
                        );
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
        }, 1400);

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
                    "url": '<?=site_url()?>t_blow/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type" : 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table6.ajax.reload();
                            }
                        );
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
        }, 1500);

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
                    "url": '<?=site_url()?>t_boost/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table7.ajax.reload();
                            }
                        );
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
        }, 1600);

        setTimeout(function(){
            var table8 = $('#table_transmain_press_max').DataTable({
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
                    "url": '<?=site_url()?>cdetail/dozer/syswarning_dozer/table_transmain_press_max/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table8.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "transmain_pressure_max", "className": "text-center", "orderable": false },
                ],
            });
        }, 1700);

        setTimeout(function(){
            var table9 = $('#table_transmain_press_avg').DataTable({
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
                    "url": '<?=site_url()?>cdetail/dozer/syswarning_dozer/table_transmain_press_avg/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table9.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "transmain_pressure_avg", "className": "text-center", "orderable": false },
                ],
            });
        }, 1800);

        setTimeout(function(){
            var table10 = $('#table_operatime').DataTable({
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
                    "url": '<?=site_url()?>cdetail/dozer/syswarning_dozer/table_operating_time/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table10.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "operatime", "className": "text-center", "orderable": false },
                ],
            });
        }, 1900);

        setTimeout(function(){
            var table11 = $('#table_dozing_time').DataTable({
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
                    "url": '<?=site_url()?>cdetail/dozer/syswarning_dozer/table_dozing_time/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table11.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "dozing_time", "className": "text-center", "orderable": false },
                ],
            });
        }, 2000);

        setTimeout(function(){
            var table12 = $('#table_ripping_time').DataTable({
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
                    "url": '<?=site_url()?>cdetail/dozer/syswarning_dozer/table_ripping_time/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table12.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "ripping_time", "className": "text-center", "orderable": false },
                ],
            });
        }, 2100);

        setTimeout(function(){
            var table14 = $('#table_fwd_distance_f1').DataTable({
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
                    "url": '<?=site_url()?>cdetail/dozer/syswarning_dozer/table_fwd_distance_f1/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table13.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "fwd_distance_f1", "className": "text-center", "orderable": false },
                ],
            });
        }, 2200);

        setTimeout(function(){
            var table15 = $('#table_fwd_distance_f2').DataTable({
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
                    "url": '<?=site_url()?>cdetail/dozer/syswarning_dozer/table_fwd_distance_f2/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table13.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "fwd_distance_f2", "className": "text-center", "orderable": false },
                ],
            });
        }, 2300);

        setTimeout(function(){
            var table16 = $('#table_fwd_distance_f3').DataTable({
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
                    "url": '<?=site_url()?>cdetail/dozer/syswarning_dozer/table_fwd_distance_f3/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table13.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "fwd_distance_f3", "className": "text-center", "orderable": false },
                ],
            });
        }, 2400);

        // CHART
        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("oil-temperature-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_oil/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Temperature (DegC)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "temp";
                series.dataFields.dateX = "date";
                series.name = "Temperature Oil";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1050);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("fuelrate-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_fuel/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
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
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1150);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("transmission-oiltemp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_transmission/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Temperature (DegC)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "tmoiltemp";
                series.dataFields.dateX = "date";
                series.name = "Temperature (DegC)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1250);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("engine-coolant-temp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_coolant/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Temperature (DegC)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "cooltemp";
                series.dataFields.dateX = "date";
                series.name = "Temperature (DegC)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1350);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("blow-by-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_blow/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
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
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1450);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("boost-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_boost/unit/dozer/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
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
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1550);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("transmain-press-max-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/dozer/syswarning_dozer/chart_transmain_press_max/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "transmain_pressure_max";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1650);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("transmain-press-avg-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/dozer/syswarning_dozer/chart_transmain_press_avg/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "transmain_pressure_avg";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1750);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("operatime-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/dozer/syswarning_dozer/chart_operating_time/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "opr_time";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
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
        }, 1850);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("dozing-time-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/dozer/syswarning_dozer/chart_dozing_time/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "dozing_time";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
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
        }, 1950);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("ripping-time-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/dozer/syswarning_dozer/chart_ripping_time/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "ripping_time";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
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
        }, 2050);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("fwd-distance-f1-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/dozer/syswarning_dozer/chart_fwd_distance_f1/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "KM/hour";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "fwd_distance_f1";
                series.dataFields.dateX = "date";
                series.name = "KM/hour";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
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
        }, 2150);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("fwd-distance-f2-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/dozer/syswarning_dozer/chart_fwd_distance_f2/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "KM/hour";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "fwd_distance_f2";
                series.dataFields.dateX = "date";
                series.name = "KM/hour";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
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
        }, 2250);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("fwd-distance-f3-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/dozer/syswarning_dozer/chart_fwd_distance_f3/<?=$this->my_encryption->encode($warning_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "KM/hour";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "fwd_distance_f3";
                series.dataFields.dateX = "date";
                series.name = "KM/hour";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
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
        }, 2250);

    });
</script>