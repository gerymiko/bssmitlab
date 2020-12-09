<section class="content-header">
    <h4 class="text-bold">Warning &amp; Fault Unit Dozer</h4>
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
                    <div class="text-center"><img src="<?=site_url();?>s_url/icon_dozer" width="200" /></div>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="#">Bulldozer
                            <span class="pull-right"><b><?=$detail_dozer->unit;?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Serial Number 
                            <span class="pull-right"><b><?=$detail_dozer->serialnumber?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Hull Number 
                            <span class="pull-right text-blue f15"><b><?=$detail_dozer->nolambung;?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Status
                            <span class="pull-right <?=($detail_dozer->status == 1) ? 'text-green' : 'text-red';?>"><?=($detail_dozer->status == 1) ? 'Active' : 'Non-Active';?></span></a>
                        </li>
                        <li>
                            <a href="#">Site
                            <span class="pull-right"><?=($detail_dozer->servername == null) ? 'Data not found' : $detail_dozer->servername;?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="info-box" style="min-height: 70px;">
                <span class="info-box-icon bg-white" style="height: 70px;width: 70px;font-size: 30px;line-height: 70px;"><i class="fas fa-calendar-check text-gray"></i></span>
                <div class="info-box-content" style="margin-left: 70px;">
                    <span class="info-box-text">LAST UPDATE DATA</span>
                    <span class="info-box-number f14"><?=($detail_dozer->lastupdate == null ) ? "Data not updated" : date("d-m-Y H:i A", strtotime($detail_dozer->lastupdate));?></span>
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
                    </form>
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
                    <table id="table_warning_unit" class="table table-border table-striped table-hover" width="100%">
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
                <ul class="nav nav-tabs pull-right">
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
                        <table id="table_engine_oil_temperature" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                        <table id="table_transmission_oiltemp" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
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
                        <table id="table_blow_by_pressure" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
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
                    <li class="active"><a href="#chart_transmain_press_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_transmain_press_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">7. Transmission Main Pressure Maximal</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_transmain_press_max">
                        <div class="chart-responsive">
                          <div class="chart" id="transmain-press-max-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_transmain_press_max">
                        <table id="table_transmain_press_max" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="pull-left header">9. Operating Time</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_operatime">
                        <div class="chart-responsive">
                          <div class="chart" id="operatime-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_operatime">
                        <table id="table_operatime" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="pull-left header">11. Ripping Time</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_ripping_time">
                        <div class="chart-responsive">
                          <div class="chart" id="ripping-time-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_ripping_time">
                        <table id="table_ripping_time" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="pull-left header">13. Forward Distance @F2</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_fwd_distance_f2">
                        <div class="chart-responsive">
                          <div class="chart" id="fwd-distance-f2-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_fwd_distance_f2">
                        <table id="table_fwd_distance_f2" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_rvs_dist_r1" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_rvs_dist_r1" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">15. Reverse Distance @R1</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_rvs_dist_r1">
                        <div class="chart-responsive">
                          <div class="chart" id="rvs-distance-r1-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_rvs_dist_r1">
                        <table id="table_rvs_dist_r1" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_rvs_dist_r3" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_rvs_dist_r3" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">17. Reverse Distance @R3</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_rvs_dist_r3">
                        <div class="chart-responsive">
                          <div class="chart" id="rvs-distance-r3-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_rvs_dist_r3">
                        <table id="table_rvs_dist_r3" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_travtime_f2" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travtime_f2" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">19. Travel Time @F2</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travtime_f2">
                        <div class="chart-responsive">
                          <div class="chart" id="travtime-f2-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travtime_f2">
                        <table id="table_travtime_f2" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_travtime_r1" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travtime_r1" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">21. Travel Time @R1</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travtime_r1">
                        <div class="chart-responsive">
                          <div class="chart" id="travtime-r1-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travtime_r1">
                        <table id="table_travtime_r1" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_travtime_r3" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travtime_r3" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">23. Travel Time @R3</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travtime_r3">
                        <div class="chart-responsive">
                          <div class="chart" id="travtime-r3-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travtime_r3">
                        <table id="table_travtime_r3" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_pitch_avg" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_pitch_avg" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">25. Pitch Angle Average</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_pitch_avg">
                        <div class="chart-responsive">
                            <div class="chart" id="pitch-avg-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_pitch_avg">
                        <table id="table_pitch_avg" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>DegC</th>
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
                        <table id="table_fuel_rate" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
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
                        <table id="table_engine_coolant_temp" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
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
                        <table id="table_boost_pressure" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
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
                    <li class="active"><a href="#chart_transmain_press_avg" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_transmain_press_avg" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">8. Transmission Main Pressure Average</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_transmain_press_avg">
                        <div class="chart-responsive">
                          <div class="chart" id="transmain-press-avg-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_transmain_press_avg">
                        <table id="table_transmain_press_avg" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="pull-left header">10. Dozing Time</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_dozing_time">
                        <div class="chart-responsive">
                          <div class="chart" id="dozing-time-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_dozing_time">
                        <table id="table_dozing_time" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="pull-left header">12. Forward Distance @F1</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_fwd_distance_f1">
                        <div class="chart-responsive">
                          <div class="chart" id="fwd-distance-f1-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_fwd_distance_f1">
                        <table id="table_fwd_distance_f1" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="pull-left header">14. Forward Distance @F3</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_fwd_distance_f3">
                        <div class="chart-responsive">
                          <div class="chart" id="fwd-distance-f3-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_fwd_distance_f3">
                        <table id="table_fwd_distance_f3" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_rvs_dist_r2" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_rvs_dist_r2" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">16. Reverse Distance @R2</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_rvs_dist_r2">
                        <div class="chart-responsive">
                          <div class="chart" id="rvs-distance-r2-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_rvs_dist_r2">
                        <table id="table_rvs_dist_r2" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
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
                    <li class="active"><a href="#chart_travtime_f1" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travtime_f1" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">18. Travel Time @F1</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travtime_f1">
                        <div class="chart-responsive">
                          <div class="chart" id="travtime-f1-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travtime_f1">
                        <table id="table_travtime_f1" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_travtime_f3" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travtime_f3" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">20. Travel Time @F3</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travtime_f3">
                        <div class="chart-responsive">
                          <div class="chart" id="travtime-f3-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travtime_f3">
                        <table id="table_travtime_f3" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_travtime_r2" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travtime_r2" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">22. Travel Time @R2</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travtime_r2">
                        <div class="chart-responsive">
                          <div class="chart" id="travtime-r2-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travtime_r2">
                        <table id="table_travtime_r2" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Hours</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_pitch_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_pitch_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">24. Pitch Angle Max</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_pitch_max">
                        <div class="chart-responsive">
                            <div class="chart" id="pitch-max-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_pitch_max">
                        <table id="table_pitch_max" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>DegC</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_pitch_min" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_pitch_min" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">26. Pitch Angle Min</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_pitch_min">
                        <div class="chart-responsive">
                            <div class="chart" id="pitch-min-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_pitch_min">
                        <table id="table_pitch_min" class="table table-border table-striped table-hover" width="100%" cellspacing="0">
                            <thead class="bg-gray">
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>DegC</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style type="text/css">  @media screen and (max-width: 767px){ .dataTables_length{ float: left; } .dataTables_filter{ float: right; }}</style>
<script type="text/javascript">
    $(document).ready(function (){
        $('#link_dashboard').addClass('active');
        $('._CnUmB').numeric({allowThouSep: false, allowDecSep: false, allowPlus: false, allowMinus: true});
        $('#date_range').daterangepicker({autoUpdateInput: false, locale:{cancelLabel: 'Clear'}, dateLimit: { "days": 31 }});
        $('#date_range').on('apply.daterangepicker', function(ev, picker){$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));});
        $('#date_range').on('cancel.daterangepicker', function(ev, picker){ $(this).val('');});
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){ $($.fn.dataTable.tables(true)).DataTable().columns.adjust();});
        var bar = '<div class="load-bar"><div class="bar"></div><div class="bar"></div><div class="bar"></div></div>';
        $('#btn-filter').click(function(){
            if($("#form-filter").valid() == false){
                toastr.error('Select a date range first!');
                return false;
            } else {
                $('#table_warning_unit, #table_engine_oil_temperature, #table_fuel_rate, #table_transmission_oiltemp, #table_engine_coolant_temp, #table_blow_by_pressure, #table_boost_pressure, #table_transmain_press_max, #table_transmain_press_avg, #table_operatime, #table_dozing_time, #table_ripping_time, #table_fwd_distance_f1, #table_fwd_distance_f2, #table_fwd_distance_f3, #table_rvs_dist_r1, #table_rvs_dist_r2, #table_rvs_dist_r3, #table_travtime_f1, #table_travtime_f2, #table_travtime_f3, #table_travtime_r1, #table_travtime_r2, #table_travtime_r3, #table_pitch_max, #table_pitch_avg, #table_pitch_min').DataTable().ajax.reload();
            }
        });
        $('#btn-reset').click(function(){
            $('#form-filter')[0].reset();
            $('#table_warning_unit, #table_engine_oil_temperature, #table_fuel_rate, #table_transmission_oiltemp, #table_engine_coolant_temp, #table_blow_by_pressure, #table_boost_pressure, #table_transmain_press_max, #table_transmain_press_avg, #table_operatime, #table_dozing_time, #table_ripping_time, #table_fwd_distance_f1, #table_fwd_distance_f2, #table_fwd_distance_f3, #table_rvs_dist_r1, #table_rvs_dist_r2, #table_rvs_dist_r3, #table_travtime_f1, #table_travtime_f2, #table_travtime_f3, #table_travtime_r1, #table_travtime_r2, #table_travtime_r3, #table_pitch_max, #table_pitch_avg, #table_pitch_min').DataTable().ajax.reload();
        });

        $('#table_data').click(function(e){
            e.preventDefault();
            $('#table_data').addClass('active');
            $('#chart_data').removeClass('active');
            $('.nav a[href="#data_oil"]').tab('show');$('.nav a[href="#data_transmission_oiltemp"]').tab('show');$('.nav a[href="#data_blow_by_pressure"]').tab('show');$('.nav a[href="#data_fuel"]').tab('show');$('.nav a[href="#data_engine_coolant_temp"]').tab('show');$('.nav a[href="#data_boost_pressure"]').tab('show');$('.nav a[href="#data_transmain_press_max"]').tab('show');$('.nav a[href="#data_operatime"]').tab('show');$('.nav a[href="#data_ripping_time"]').tab('show');$('.nav a[href="#data_oil_max"]').tab('show');$('.nav a[href="#data_rear_brake"]').tab('show');$('.nav a[href="#data_front_brake"]').tab('show');$('.nav a[href="#data_engine_speed"]').tab('show');$('.nav a[href="#data_boost_pressure"]').tab('show');$('.nav a[href="#data_transmain_press_avg"]').tab('show');$('.nav a[href="#data_dozing_time"]').tab('show');$('.nav a[href="#data_fwd_distance_f1"]').tab('show');$('.nav a[href="#data_fwd_distance_f2"]').tab('show');$('.nav a[href="#data_fwd_distance_f3"]').tab('show');$('.nav a[href="#data_rvs_dist_r1"]').tab('show');$('.nav a[href="#data_rvs_dist_r2"]').tab('show');$('.nav a[href="#data_rvs_dist_r3"]').tab('show');$('.nav a[href="#data_travtime_f1"]').tab('show');$('.nav a[href="#data_travtime_f2"]').tab('show');$('.nav a[href="#data_travtime_f3"]').tab('show');$('.nav a[href="#data_travtime_r1"]').tab('show');$('.nav a[href="#data_travtime_r2"]').tab('show');$('.nav a[href="#data_travtime_r3"]').tab('show');$('.nav a[href="#data_pitch_max"]').tab('show');$('.nav a[href="#data_pitch_min"]').tab('show');$('.nav a[href="#data_pitch_avg"]').tab('show');
        });
        $('#chart_data').click(function(e){
            e.preventDefault();
            $('#chart_data').addClass('active');
            $('#table_data').removeClass('active');
            $('.nav a[href="#chart_oil"]').tab('show');$('.nav a[href="#chart_transmission_oiltemp"]').tab('show');$('.nav a[href="#chart_blow_by_pressure"]').tab('show');$('.nav a[href="#chart_fuel"]').tab('show');$('.nav a[href="#chart_engine_coolant_temp"]').tab('show');$('.nav a[href="#chart_boost_pressure"]').tab('show');$('.nav a[href="#chart_transmain_press_max"]').tab('show');$('.nav a[href="#chart_operatime"]').tab('show');$('.nav a[href="#chart_ripping_time"]').tab('show');$('.nav a[href="#chart_oil_max"]').tab('show');$('.nav a[href="#chart_rear_brake"]').tab('show');$('.nav a[href="#chart_front_brake"]').tab('show');$('.nav a[href="#chart_engine_speed"]').tab('show');$('.nav a[href="#chart_boost_pressure"]').tab('show');$('.nav a[href="#chart_transmain_press_avg"]').tab('show');$('.nav a[href="#chart_dozing_time"]').tab('show');$('.nav a[href="#chart_fwd_distance_f1"]').tab('show');$('.nav a[href="#chart_fwd_distance_f2"]').tab('show');$('.nav a[href="#chart_fwd_distance_f3"]').tab('show');$('.nav a[href="#chart_rvs_dist_r1"]').tab('show');$('.nav a[href="#chart_rvs_dist_r2"]').tab('show');$('.nav a[href="#chart_rvs_dist_r3"]').tab('show');$('.nav a[href="#chart_travtime_f1"]').tab('show');$('.nav a[href="#chart_travtime_f2"]').tab('show');$('.nav a[href="#chart_travtime_f3"]').tab('show');$('.nav a[href="#chart_travtime_r1"]').tab('show');$('.nav a[href="#chart_travtime_r2"]').tab('show');$('.nav a[href="#chart_travtime_r3"]').tab('show');$('.nav a[href="#chart_pitch_max"]').tab('show');$('.nav a[href="#chart_pitch_min"]').tab('show');$('.nav a[href="#chart_pitch_avg"]').tab('show');
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
                    window.open('<?=site_url()?>dozer/export_warning/<?=$accessRights->site?>/<?=$this->my_encryption->encode($detail_dozer->serialnumber)?>/'+date_start_new+'/'+date_end_new);
                }
            }
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

        // TABLE & CHART
        var table0 = $('#table_warning_unit').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "scrollX": true,
            "order": [],
            "ajax": {
                "url": '<?=site_url()?>dozer/t_warning/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
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
                    "url": '<?=site_url()?>dozer/t_oil/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val();},
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table1.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "temperature", "className": "text-center", "orderable": false },
                ],
            });

            am4core.ready(function() {
                var chart = am4core.create("oil-temperature-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_oil/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
            var table2 = $('#table_fuel_rate').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_fuel/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type" : 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table2.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "fuel", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("fuelrate-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_fuel/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
        }, 1100);

        setTimeout(function(){
            var table3 = $('#table_transmission_oiltemp').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_trans/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type" : 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table3.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "tmoiltemp", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("transmission-oiltemp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_trans/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
        }, 1150);

        setTimeout(function(){
            var table4 = $('#table_engine_coolant_temp').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_coolant/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type" : 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table4.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "cooltemp", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("engine-coolant-temp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_coolant/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
        }, 1200);

        setTimeout(function(){
            var table5 = $('#table_blow_by_pressure').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_blow/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type" : 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table5.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "blowbypress", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("blow-by-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_blow/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
        }, 1250);

        setTimeout(function(){
            var table6 = $('#table_boost_pressure').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_boost/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table6.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "boostpress", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("boost-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_boost/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
        }, 1300);

        setTimeout(function(){
            var table7 = $('#table_transmain_press_max').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_transpres_max/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table7.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "transmain_pressure_max", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("transmain-press-max-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_transpres_max/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
                var content = "The highest value (maximum) of the Transmission Main Oil Pressure for 20 operating hours";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1350);

        setTimeout(function(){
            var table8 = $('#table_transmain_press_avg').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_transpres_avg/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table8.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "transmain_pressure_avg", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("transmain-press-avg-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_transpres_avg/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
                var content = "The average value of the Transmission Main Oil Pressure for 20 hours of operation";
                show_parameter(chart,dateAxis,valueAxis,series,content);
            });
        }, 1400);

        setTimeout(function(){
            var table9 = $('#table_operatime').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_optime/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table9.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "operatime", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("operatime-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_optime/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
                var content = "Actual Working Hours of 20 hours Engine ON. The difference of 20 hours minus Operating Time is Engine Time ON but the unit is not working (idling / standby). This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1450);

        setTimeout(function(){
            var table10 = $('#table_dozing_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_doztime/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table10.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "dozing_time", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("dozing-time-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_doztime/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
                var content = "Actual Working Hours used for Dozing work during 20 operating hours. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1500);

        setTimeout(function(){
            var table11 = $('#table_ripping_time').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_riptime/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table11.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "ripping_time", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("ripping-time-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_riptime/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
                var content = "Actual Working Hours used for Ripping work during 20 operating hours. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1550);

        setTimeout(function(){
            var table12 = $('#table_fwd_distance_f1').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_fwdist_f1/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table12.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "fwd_distance_f1", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("fwd-distance-f1-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_fwdist_f1/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
                var content = "Actual mileage in kilometers using F1 Forward Speed for 20 hours of operation. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1600);

        setTimeout(function(){
            var table13 = $('#table_fwd_distance_f2').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_fwdist_f2/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table13.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "fwd_distance_f2", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("fwd-distance-f2-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_fwdist_f2/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
                var content = "Actual mileage in kilometers using F2 Forward Speed for 20 hours of operation. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1650);

        setTimeout(function(){
            var table14 = $('#table_fwd_distance_f3').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_fwdist_f3/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table14.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "fwd_distance_f3", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("fwd-distance-f3-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_fwdist_f3/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
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
                var content = "Actual mileage in kilometers using F3 Forward Speed for 20 hours of operation. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1700);

        setTimeout(function(){
            var table15 = $('#table_rvs_dist_r1').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_rvsdist_r1/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table15.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "rvs_distance_r1", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("rvs-distance-r1-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_rvsdist_r1/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "KM/hour";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "rvs_distance_r1";
                series.dataFields.dateX = "date";
                series.name = "KM/hour";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual mileage in kilometers using Reverse Speed R1 for 20 hours of operation. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1750);

        setTimeout(function(){
            var table16 = $('#table_rvs_dist_r2').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_rvsdist_r2/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table16.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "rvs_distance_r2", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("rvs-distance-r2-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_rvsdist_r2/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "KM/hour";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "rvs_distance_r2";
                series.dataFields.dateX = "date";
                series.name = "KM/hour";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual mileage in kilometers using Reverse Speed R2 for 20 hours of operation. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1800);

        setTimeout(function(){
            var table17 = $('#table_rvs_dist_r3').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_rvsdist_r3/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table17.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "rvs_distance_r3", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("rvs-distance-r3-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_rvsdist_r3/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "KM/hour";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "rvs_distance_r3";
                series.dataFields.dateX = "date";
                series.name = "KM/hour";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual mileage in kilometers using Reverse Speed R3 for 20 hours of operation. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1800);

        setTimeout(function(){
            var table18 = $('#table_travtime_f1').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_travtime_f1/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table18.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "travel_time_f1", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("travtime-f1-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_travtime_f1/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Hours";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travel_time_f1";
                series.dataFields.dateX = "date";
                series.name = "Hours";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual Working Hours when the Machine Traveling uses F1 Forward Speed for 20 operating hours. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1850);

        setTimeout(function(){
            var table19 = $('#table_travtime_f2').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_travtime_f2/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table19.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "travel_time_f2", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("travtime-f2-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_travtime_f2/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Hours";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travel_time_f2";
                series.dataFields.dateX = "date";
                series.name = "Hours";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual Working Hours when the Traveling Machine uses Forward Speed F2 for 20 operating hours. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1900);

        setTimeout(function(){
            var table20 = $('#table_travtime_f3').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_travtime_f3/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table20.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "travel_time_f3", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("travtime-f3-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_travtime_f3/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Hours";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travel_time_f3";
                series.dataFields.dateX = "date";
                series.name = "Hours";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual Working Hours when the Machine Traveling uses Forward Speed F3 for 20 operating hours. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 1950);

        setTimeout(function(){
            var table21 = $('#table_travtime_r1').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_travtime_r1/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table21.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "travel_time_r1", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("travtime-r1-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_travtime_r1/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Hours";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travel_time_r1";
                series.dataFields.dateX = "date";
                series.name = "Hours";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual Working Hours when the Machine Traveling uses Reverse Speed R1 for 20 operating hours. This parameter has no specified limit value";
                show_export(chart,series,content);
            });
        }, 2000);

        setTimeout(function(){
            var table22 = $('#table_travtime_r2').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_travtime_r2/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table22.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "travel_time_r2", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("travtime-r2-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_travtime_r2/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Hours";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travel_time_r2";
                series.dataFields.dateX = "date";
                series.name = "Hours";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual Working Hours when the Traveling Machine uses Reverse Speed R2 for 20 operating hours. This parameter has no specified limit value.";
                show_export(chart,series,content);
            });
        }, 2050);

        setTimeout(function(){
            var table23 = $('#table_travtime_r3').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_travtime_r3/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table23.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "travel_time_r3", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("travtime-r3-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_travtime_r3/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Hours";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travel_time_r3";
                series.dataFields.dateX = "date";
                series.name = "Hours";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "Actual Working Hours when the Traveling Machine uses Reverse Speed R3 for 20 operating hours. This parameter has no specified limit value.";
                show_export(chart,series,content);
            });
        }, 2050);

        setTimeout(function(){
            var table24 = $('#table_pitch_max').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_pitch_max/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table24.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "pitch_angle_max", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("pitch-max-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_pitch_max/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "DegC";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "pitch_angle_max";
                series.dataFields.dateX = "date";
                series.name = "DegC";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "The highest value (maximum) in units of degrees of tilt blade (Tilt Blade) for 20 hours of operation";
                show_export(chart,series,content);
            });
        }, 2150);

        setTimeout(function(){
            var table25 = $('#table_pitch_avg').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_pitch_avg/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table25.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "pitch_angle_avg", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("pitch-avg-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_pitch_avg/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "DegC";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "pitch_angle_avg";
                series.dataFields.dateX = "date";
                series.name = "DegC";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "The average value in units of degrees of tilt blade (Tilt Blade) for 20 hours of operation";
                show_export(chart,series,content);
            });
        }, 2200);

        setTimeout(function(){
            var table26 = $('#table_pitch_min').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "order": [],
                "ajax": {
                    "url": '<?=site_url()?>dozer/t_pitch_min/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>',
                    "type": 'POST',
                    data : function(data) { data.date_range = $("#date_range").val(); },
                    error: function(data) {swal({animation: false,focusConfirm: false,text: "Failed to pull data. Click OK to get data"}).then(function(){table26.ajax.reload();});}
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center", "orderable": false },
                    { "data": "pitch_angle_min", "className": "text-center", "orderable": false },
                ],
            });
            am4core.ready(function() {
                var chart = am4core.create("pitch-min-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>dozer/chart_pitch_min/<?=$accessRights->site.'/'.$this->my_encryption->encode($detail_dozer->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "DegC";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "pitch_angle_min";
                series.dataFields.dateX = "date";
                series.name = "DegC";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                chart.legend = new am4charts.Legend();
                chart.cursor = new am4charts.XYCursor();
                chart.cursor.behavior = "panXY";
                chart.cursor.xAxis = dateAxis;
                chart.cursor.snapToSeries = series;
                var content = "The lowest value (minimum) in units of degrees of tilt blade (Tilt Blade) for 20 hours of operation";
                show_export(chart,series,content);
            });
        }, 2250);
    });
</script>