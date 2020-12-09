<section class="content-header">
    <h4 class="text-bold">Warning &amp; Fault Unit Heavy Dump Truck</h4>
</section>
<section class="content">
    <div class="alert alert-danger alert-dismissible hidden">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Attention!</h4>
        Sorry for the inconvenience, this page is currently under maintenance. Maybe there will be a time when an error will appear or this page cannot be accessed for a while. Thank you for your attention.
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-body">
                    <div class="text-center"><img src="<?=site_url();?>s_url/icon_hd" /></div>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="#">Heavy Dump Truck
                            <span class="pull-right"><b><?=$detail_hd->unit;?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Serial Number
                            <span class="pull-right"><b><?=$detail_hd->serialnumber?></b></span></a>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="info-box" style="min-height: 70px;">
                        <span class="info-box-icon bg-white" style="height: 70px;width: 70px;font-size: 30px;line-height: 70px;"><i class="fas fa-calendar-check text-gray"></i></span>
                        <div class="info-box-content" style="margin-left: 70px;">
                            <span class="info-box-text">LAST UPDATE DATA</span>
                            <span class="info-box-number f14"><?=($detail_hd->lastupdate == null ) ? "Data not updated" : date("d-m-Y H:i A", strtotime($detail_hd->lastupdate));?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-box" style="min-height: 70px;">
                        <span class="info-box-icon bg-white" style="height: 70px;width: 70px;font-size: 30px;line-height: 70px;"><i class="far fa-calendar-alt text-gray"></i></span>
                        <div class="info-box-content" style="margin-left: 70px;">
                            <span class="info-box-text">DATA PRESENTED</span>
                            <span class="info-box-number f14"><?= date("M Y", strtotime("-1 month")).' - '.date("M Y") ?></span>
                        </div>
                    </div>
                </div>
            </div>
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
                        <label for="date_range" generated="true" class="error"></label>
                    </form><br>
                </div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Warning Message</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="table_warning_unit" class="table table-border table-hover table-striped" style="width:100%">
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
                </div>
            </div>
        </div>
    </div>
    <h4 class="page-header text-center"><b>MOSENTO</b> Technical Parameter</h4>
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-white" id="table_data">Table Data</button>
            <button class="btn btn-default active" id="chart_data">Chart Data</button>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right" id="myTabs">
                    <li class="active"><a href="#chart_oil" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_oil" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">1. Engine Oil Temperatures</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_oil">
                        <div class="chart-responsive">
                            <div class="chart" id="oil-temperature-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_oil">
                        <table id="table_engine_oil_temperature" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_transmission_oiltemp" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_transmission_oiltemp" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">3. Transmission Oil Temperature</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_transmission_oiltemp">
                        <div class="chart-responsive">
                          <div class="chart" id="transmission-oiltemp-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_transmission_oiltemp">
                        <table id="table_transmission_oiltemp" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
                    <li class="pull-left header">5. Blow By Pressure</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_blow_by_pressure">
                        <div class="chart-responsive">
                          <div class="chart" id="blow-by-pressure-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_blow_by_pressure">
                        <table id="table_blow_by_pressure" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_travel_speed" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travel_speed" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">7. Travel Speed</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travel_speed">
                        <div class="chart-responsive">
                            <div class="chart" id="travel-speed-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travel_speed">
                        <table id="table_travel_speed" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
            <div class="nav-tabs-custom" >
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_front_brake" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_front_brake" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">9. Front Brake</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_front_brake">
                        <div class="chart-responsive">
                            <div class="chart" id="front-brake-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_front_brake">
                        <table id="table_front_brake" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_oil_presslomin" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_oil_presslomin" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">11. Engine Oil Press Lo Min</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_oil_presslomin">
                        <div class="chart-responsive">
                            <div class="chart" id="oil-presslomin-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_oil_presslomin">
                        <table id="table_oil_presslomin" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_fuel" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_fuel" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">2. Fuel Rate</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_fuel">
                        <div class="chart-responsive">
                          <div class="chart" id="fuelrate-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_fuel">
                        <table id="table_fuel_rate" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_engine_coolant_temp" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_engine_coolant_temp" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">4. Engine Coolant Temperature</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_engine_coolant_temp">
                        <div class="chart-responsive">
                          <div class="chart" id="engine-coolant-temp-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_engine_coolant_temp">
                        <table id="table_engine_coolant_temp" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_boost_pressure" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_boost_pressure" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">6. Boost Pressure</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_boost_pressure">
                        <div class="chart-responsive">
                          <div class="chart" id="boost-pressure-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_boost_pressure">
                        <table id="table_boost_pressure" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_engine_speed" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_engine_speed" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">8. Engine Speed</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_engine_speed">
                        <div class="chart-responsive">
                            <div class="chart" id="engine-speed-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_engine_speed">
                        <table id="table_engine_speed" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
            <div class="nav-tabs-custom" >
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_rear_brake" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_rear_brake" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">10. Rear Brake</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_rear_brake">
                        <div class="chart-responsive">
                            <div class="chart" id="rear-brake-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_rear_brake">
                        <table id="table_rear_brake" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
                    <li class="pull-left header">12. Oil Pressure Maximal</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_oil_max">
                        <div class="chart-responsive">
                            <div class="chart" id="oil-max-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_oil_max">
                        <table id="table_oil_max" class="table table-border table-hover table-striped" width="100%" cellspacing="0" scroll-collapse="false">
                            <thead class="bg-gray">
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
<style type="text/css"> @media screen and (max-width: 767px){ .dataTables_length{ float: left; } .dataTables_filter{ float: right; }}</style>
<script type="text/javascript">
    $(document).ready(function (){
        $('#link_dashboard').addClass('active');
        $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: true});
        $('#date_range').daterangepicker({ autoUpdateInput: false, locale: { cancelLabel: 'Clear' }, dateLimit: { "days": 31 } });
        $('#date_range').on('apply.daterangepicker', function(ev, picker){$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));});
        $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val(''); });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){ $($.fn.dataTable.tables(true)).DataTable().columns.adjust(); });
        var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
        $('#btn-filter').click(function(){
            if($("#form-filter").valid() == false){
                toastr.error('Select a date range first!');
                return false;
            } else {
                $('#table_warning_unit, #table_engine_oil_temperature, #table_fuel_rate, #table_transmission_oiltemp, #table_engine_coolant_temp, #table_blow_by_pressure, #table_boost_pressure, #table_engine_speed, #table_travel_speed, #table_rear_brake, #table_front_brake, #table_oil_max, #table_oil_presslomin').DataTable().ajax.reload();
            }
        });
        $('#btn-reset').click(function(){
            $('#form-filter')[0].reset();
            $('#table_warning_unit, #table_engine_oil_temperature, #table_fuel_rate, #table_transmission_oiltemp, #table_engine_coolant_temp, #table_blow_by_pressure, #table_boost_pressure, #table_engine_speed, #table_travel_speed, #table_rear_brake, #table_front_brake, #table_oil_max, #table_oil_presslomin').DataTable().ajax.reload();
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
                    window.open('<?=site_url()?>hd/export_warning/<?=$accessRights->site?>/<?=$this->my_encryption->encode($detail_hd->serialnumber)?>/'+date_start_new+'/'+date_end_new);
                }
            }
        });
        $('#table_data').click(function(e){
            e.preventDefault();
            $('#table_data').addClass('active');$('#chart_data').removeClass('active');$('.nav a[href="#data_oil_max"]').tab('show');$('.nav a[href="#data_rear_brake"]').tab('show');$('.nav a[href="#data_front_brake"]').tab('show');$('.nav a[href="#data_engine_speed"]').tab('show');$('.nav a[href="#data_boost_pressure"]').tab('show');$('.nav a[href="#data_travel_speed"]').tab('show');$('.nav a[href="#data_engine_coolant_temp"]').tab('show');$('.nav a[href="#data_fuel"]').tab('show');$('.nav a[href="#data_oil_presslomin"]').tab('show');$('.nav a[href="#data_blow_by_pressure"]').tab('show');$('.nav a[href="#data_oil"]').tab('show');$('.nav a[href="#data_transmission_oiltemp"]').tab('show');
        });

        $('#chart_data').click(function(e){
            e.preventDefault();
            $('#chart_data').addClass('active');$('#table_data').removeClass('active');$('.nav a[href="#chart_oil_max"]').tab('show');$('.nav a[href="#chart_rear_brake"]').tab('show');$('.nav a[href="#chart_front_brake"]').tab('show');$('.nav a[href="#chart_engine_speed"]').tab('show');$('.nav a[href="#chart_boost_pressure"]').tab('show');$('.nav a[href="#chart_travel_speed"]').tab('show');$('.nav a[href="#chart_engine_coolant_temp"]').tab('show');$('.nav a[href="#chart_fuel"]').tab('show');$('.nav a[href="#chart_oil_presslomin"]').tab('show');$('.nav a[href="#chart_blow_by_pressure"]').tab('show');$('.nav a[href="#chart_oil"]').tab('show');$('.nav a[href="#chart_transmission_oiltemp"]').tab('show');
        });

        function show_indicator(chart){
            var indicator;
            function showIndicator() {
                if (indicator) { indicator.show(); } else {
                    indicator = chart.tooltipContainer.createChild(am4core.Container);indicator.background.fill = am4core.color("#fff");indicator.background.fillOpacity = 1.00;indicator.width = am4core.percent(100);indicator.height = am4core.percent(100);var indicatorLabel = indicator.createChild(am4core.Label);indicatorLabel.text = "No data...";indicatorLabel.align = "center";indicatorLabel.valign = "middle";indicatorLabel.fontSize = 20;
                }
            }
            function hideIndicator() { indicator.hide(); }
            chart.events.on("beforevalidated", function(ev) { if (ev.target.data.length == 0) { showIndicator(); } else if (indicator) { hideIndicator();}});
        }

        function show_parameter(chart,dateAxis,valueAxis,series,content){
            var series2 = chart.series.push(new am4charts.LineSeries());
            series2.dataFields.valueY = "critical";
            series2.dataFields.dateX = "date";
            series2.name = "Critical";
            series2.tooltipText = "{name}: [bold]{valueY}[/]";
            series2.tooltip.getFillFromObject = false;
            series2.tooltip.background.fill = am4core.color("#DA251C");
            series2.strokeWidth = 2;
            series2.yAxis = valueAxis;
            series2.stroke = am4core.color("red");
            var series3 = chart.series.push(new am4charts.LineSeries());
            series3.dataFields.valueY = "caution";
            series3.dataFields.dateX = "date";
            series3.name = "Caution";
            series3.tooltipText = "{name}: [bold]{valueY}[/]";
            series3.tooltip.getFillFromObject = false;
            series3.tooltip.background.fill = am4core.color("#F1C40F");
            series3.strokeWidth = 2;
            series3.yAxis = valueAxis;
            series3.stroke = am4core.color("yellow");
            chart.legend = new am4charts.Legend();
            chart.cursor = new am4charts.XYCursor();
            chart.cursor.behavior = "panXY";
            chart.cursor.xAxis = dateAxis;
            chart.cursor.snapToSeries = series;
            show_export(chart,series);
            var title = chart.titles.create();
            title.wrap = true;
            title.align = "center";
            title.text = content;
            title.fontSize = 12;
            title.marginBottom = 30;
        }

        function show_export(chart,series,content){
            var bullet = series.bullets.push(new am4charts.CircleBullet());
            bullet.circle.strokeWidth = 2;
            bullet.circle.radius = 3;
            bullet.circle.fill = am4core.color("#fff");
            chart.maskBullets = false;
            chart.exporting.menu = new am4core.ExportMenu();
            chart.exporting.menu.align = "right";
            chart.exporting.menu.verticalAlign = "bottom";
            chart.exporting.menu.items = [{ "label": "...", "menu": [ { "type": "png", "label": "PNG" }, { "type": "jpg", "label": "JPG" } ] }];
            var label = chart.chartContainer.createChild(am4core.Label);
            var title = chart.titles.create();
            title.wrap = true;
            title.align = "center";
            title.text = content;
            title.fontSize = 12;
            title.marginBottom = 30;
        }

        var table0 = $('#table_warning_unit').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "order": [],
            "ajax": {
                "url": '<?=site_url()?>hd/t_warning/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                "type": 'POST',
                data : function(data) { data.date_range = $("#date_range").val(); },
                error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table0.ajax.reload();});}
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
        setTimeout(function(){
            var table1 = $('#table_engine_oil_temperature').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_oil/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val();},
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "temperature", "className": "text-center", "orderable": false },
                ],
            });

            am4core.ready(function() {
                var chart = am4core.create("oil-temperature-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_oil/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1000);
        setTimeout(function(){
            var table2 = $('#table_fuel_rate').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_fuel/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "fuel", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("fuelrate-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_fuel/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1050);
        setTimeout(function(){
            var table3 = $('#table_transmission_oiltemp').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_trans/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table3.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "tmoiltemp", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("transmission-oiltemp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_trans/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1100);
        setTimeout(function(){
            var table4 = $('#table_engine_coolant_temp').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_coolant/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table4.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "cooltemp", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("engine-coolant-temp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_coolant/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1150);
        setTimeout(function(){
            var table5 = $('#table_blow_by_pressure').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_blow/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type" : 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table5.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "blowbypress", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("blow-by-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_blow/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1200);
        setTimeout(function(){
            var table6 = $('#table_boost_pressure').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_boost/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table6.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "boostpress", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("boost-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_boost/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1250);
        setTimeout(function(){
            var table7 = $('#table_travel_speed').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_travelspeed/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table7.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "travelspeed", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("travel-speed-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_travelspeed/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Measure (Km/Hour)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travelspeed";
                series.dataFields.dateX = "date";
                series.name = "Measure (Km/Hour)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1300);
        setTimeout(function(){
            var table8 = $('#table_engine_speed').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_enginespeed/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table8.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "enginespeed", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("engine-speed-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_enginespeed/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1350);
        setTimeout(function(){
            var table10 = $('#table_front_brake').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_fbrake/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function (data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table10.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "frontbrake", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("front-brake-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_fbrake/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1400);
        setTimeout(function(){
            var table10 = $('#table_rear_brake').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_rbrake/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function (data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table10.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "rearbrake", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("rear-brake-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_rbrake/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
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
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1450);
        setTimeout(function(){
            var table11 = $('#table_oil_presslomin').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_engoilomin/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function (data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table11.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "oilpressmin", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("oil-presslomin-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_engoilomin/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "oilpressmin";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1550);
        setTimeout(function(){
            var table12 = $('#table_oil_max').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>hd/t_oilpressmax/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>',
                    "type": 'POST',
                    data : function (data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table12.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "oilpressmax", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("oil-max-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>hd/chart_oilpressmax/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "oilpressmax";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                var content = "";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1600);

        $.getJSON('<?=site_url()?>hd/info_payload/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_hd->serialnumber)?>', function(data) {
            $.each(data, function (index, x) {
                if (x.label == "See detail") {
                    $('<li><a class="text-blue text-bold" href="'+ x.value +'">' + x.label + '</a></li>').appendTo('#myData');
                } else {
                    $('<li><a>' + x.label + ' <span class="pull-right badge bg-blue"> ' + x.value + '</span></a></li>').appendTo('#myData');
                }
                
            });
        });
    });

</script>