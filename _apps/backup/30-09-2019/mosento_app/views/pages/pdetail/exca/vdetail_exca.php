<section class="content-header">
    <h1><a href="<?=site_url();?>dashboard" class="btn btn-sm bg-orange" data-toggle="tooltip" title="Go Back"><i class="fas fa-chevron-left"></i></a> Unit <?=$detail_exca->nolambung;?></h1>
    <ol class="breadcrumb">
        <li><a href="<?=site_url();?>dashboard">Home</a></li>
        <li>Detail</li>
        <li class="active"><?=$detail_exca->nolambung;?></li>
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
                    <div class="text-center"><img src="<?=site_url();?>s_url/icon_exca" width="200" /></div>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="#">Excavator
                            <span class="pull-right"><b><?=$detail_exca->unit;?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Serial Number 
                            <span class="pull-right"><b><?=$detail_exca->serialnumber?></b></span></a>
                        </li>
                        <li>
                            <a href="#">Status
                            <span class="pull-right label <?=($detail_exca->status == 1) ? 'label-success' : 'label-danger';?>"><?=($detail_exca->status == 1) ? 'Active' : 'Non-Active';?></span></a>
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
                    <span class="info-box-number f14"><?=($detail_exca->lastupdate == null ) ? "Data not updated" : date("d-m-Y H:i A", strtotime($detail_exca->lastupdate));?></span>
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
                                        <button type="button" id="btn-export-warning" class="btn btn-success btn-flat">Export</button>
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
                    <li class="active"><a href="#chart_pumpF_press_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_pumpF_press_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Pump Front Pressure Maximum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_pumpF_press_max">
                        <div class="chart-responsive">
                          <div class="chart" id="pumpF-pressmax-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_pumpF_press_max">
                        <table id="table_pumpF_press_max" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_swing_press_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_swing_press_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Swing Pressure Maximum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_swing_press_max">
                        <div class="chart-responsive">
                          <div class="chart" id="swing-pressmax-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_swing_press_max">
                        <table id="table_swing_press_max" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_g2pump_press_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_g2pump_press_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">G2 Pump Pressure Maximum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_g2pump_press_max">
                        <div class="chart-responsive">
                          <div class="chart" id="g2pump-pressmax-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_g2pump_press_max">
                        <table id="table_g2pump_press_max" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_pto_temp_min" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_pto_temp_min" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">PTO Temperature Minimum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_pto_temp_min">
                        <div class="chart-responsive">
                          <div class="chart" id="pto-temp-min-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_pto_temp_min">
                        <table id="table_pto_temp_min" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
                    <li class="active"><a href="#chart_bucket_ppc_on" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_bucket_ppc_on" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Bucket PPC ON</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_bucket_ppc_on">
                        <div class="chart-responsive">
                          <div class="chart" id="bucket-ppc-on-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_bucket_ppc_on">
                        <table id="table_bucket_ppc_on" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
                    <li class="active"><a href="#chart_swing_ppc_on" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_swing_ppc_on" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Swing PPC ON</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_swing_ppc_on">
                        <div class="chart-responsive">
                          <div class="chart" id="swing-ppc-on-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_swing_ppc_on">
                        <table id="table_swing_ppc_on" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
        </div>
        <div class="col-md-6">
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
                    <li class="active"><a href="#chart_pumpR_press_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_pumpR_press_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Pump Rear Pressure Maximum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_pumpR_press_max">
                        <div class="chart-responsive">
                          <div class="chart" id="pumpR-pressmax-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_pumpR_press_max">
                        <table id="table_pumpR_press_max" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_g1pump_press_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_g1pump_press_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">G1 Pump Pressure Maximum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_g1pump_press_max">
                        <div class="chart-responsive">
                          <div class="chart" id="g1pump-pressmax-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_g1pump_press_max">
                        <table id="table_g1pump_press_max" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#chart_pto_temp_max" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_pto_temp_max" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">PTO Temperature Maximum</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_pto_temp_max">
                        <div class="chart-responsive">
                          <div class="chart" id="pto-temp-max-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_pto_temp_max">
                        <table id="table_pto_temp_max" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
                    <li class="active"><a href="#chart_arm_ppc_on" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_arm_ppc_on" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Arm PPC ON</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_arm_ppc_on">
                        <div class="chart-responsive">
                          <div class="chart" id="arm-ppc-on-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_arm_ppc_on">
                        <table id="table_arm_ppc_on" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
                    <li class="active"><a href="#chart_boom_ppc_on" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_boom_ppc_on" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Boom PPC ON</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_boom_ppc_on">
                        <div class="chart-responsive">
                          <div class="chart" id="boom-ppc-on-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_boom_ppc_on">
                        <table id="table_boom_ppc_on" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
                    <li class="active"><a href="#chart_travel_ppc_on" data-toggle="tab">Chart</a></li>
                    <li><a href="#data_travel_ppc_on" data-toggle="tab">Data</a></li>
                    <li class="pull-left header">Travel PPC ON</li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="chart_travel_ppc_on">
                        <div class="chart-responsive">
                          <div class="chart" id="travel-ppc-on-chart" style="height: 450px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data_travel_ppc_on">
                        <table id="table_travel_ppc_on" class="table table-bordered table-hover nowrap" width="100%" cellspacing="0" scroll-collapse="false">
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
                $('#table_transmission_oil_temp').DataTable().ajax.reload();
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
            $('#table_transmission_oil_temp').DataTable().ajax.reload();
            $('#table_engine_coolant_temp').DataTable().ajax.reload();
            $('#table_blow_by_pressure').DataTable().ajax.reload();
            $('#table_boost_pressure').DataTable().ajax.reload();
        });
        $('#btn-export-warning').click(function(){
            if($("#form-filter-warning").valid() == false){
                toastr.error('Select a date range first!');
                return false;
            } else {
                var date_range = $('#date_range').val().split(' - '),
                date_start = date_range[0],
                date_end   = date_range[1],
                date_start_new = date_start.replace(/\//g, '-'),
                date_end_new   = date_end.replace(/\//g, '-');
                window.open('<?=site_url()?>cdetail/exca/sysexport_warning_exca/export/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>/'+date_start_new+'/'+date_end_new);
            }
        });

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
                    "url": '<?=site_url()?>t_warning/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
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
                    "url": '<?=site_url()?>t_oil/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
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
                    "url": '<?=site_url()?>t_fuel/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
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
                    "url": '<?=site_url()?>t_transmission/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
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
                    "url": '<?=site_url()?>t_coolant/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
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
                    "url": '<?=site_url()?>t_blow/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
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
                    "url": '<?=site_url()?>t_boost/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
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
            var table8 = $('#table_pumpF_press_max').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_pump_front_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
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
                    { "data": "pumpF_press_max", "className": "text-center", "orderable": false },
                ],
            });
        }, 1700);

        setTimeout(function(){
            var table9 = $('#table_pumpR_press_max').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_pump_rear_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
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
                    { "data": "pumpR_press_max", "className": "text-center", "orderable": false },
                ],
            });
        }, 1800);

        setTimeout(function(){
            var table10 = $('#table_swing_press_max').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_swing_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
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
                    { "data": "swing", "className": "text-center", "orderable": false },
                ],
            });
        }, 1900);

        setTimeout(function(){
            var table11 = $('#table_g1pump_press_max').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_g1pump_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
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
                    { "data": "g1pump", "className": "text-center", "orderable": false },
                ],
            });
        }, 2000);

        setTimeout(function(){
            var table12 = $('#table_g2pump_press_max').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_g2pump_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
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
                    { "data": "g2pump", "className": "text-center", "orderable": false },
                ],
            });
        }, 2100);

        setTimeout(function(){
            var table13 = $('#table_pto_temp_max').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_pto_temp_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
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
                    { "data": "pto_temp_max", "className": "text-center", "orderable": false },
                ],
            });
        }, 2200);

        setTimeout(function(){
            var table14 = $('#table_pto_temp_min').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_pto_temp_min/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table14.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "pto_temp_min", "className": "text-center", "orderable": false },
                ],
            });
        }, 2300);

        setTimeout(function(){
            var table15 = $('#table_arm_ppc_on').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_arm_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table15.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "arm_ppc_on", "className": "text-center", "orderable": false },
                ],
            });
        }, 2300);

        setTimeout(function(){
            var table16 = $('#table_bucket_ppc_on').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_bucket_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table16.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "bucket_ppc_on", "className": "text-center", "orderable": false },
                ],
            });
        }, 2400);

        setTimeout(function(){
            var table17 = $('#table_boom_ppc_on').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_boom_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table17.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "boom_ppc_on", "className": "text-center", "orderable": false },
                ],
            });
        }, 2500);

        setTimeout(function(){
            var table18 = $('#table_swing_ppc_on').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_swing_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table18.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "swing_ppc_on", "className": "text-center", "orderable": false },
                ],
            });
        }, 2600);

        setTimeout(function(){
            var table19 = $('#table_travel_ppc_on').DataTable({
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
                    "url": '<?=site_url()?>cdetail/exca/sysdetail_exca/table_travel_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>',
                    "type": 'POST',
                    data : function ( data ) { data.date_range = $("#date_range").val(); },
                    error: function(data) {
                        swal({
                            animation: false,
                            focusConfirm: false,
                            text: "Failed to pull data. Click OK to get data"}).then(function(){ 
                                table19.ajax.reload();
                            }
                        );
                    }
                },
                "language": { "processing": bar },
                "columns": [
                    { "data": "no", "className": "text-center", "searchable": false, "orderable": false },
                    { "data": "date", "className": "text-center" },
                    { "data": "time", "className": "text-center" },
                    { "data": "travel_ppc_on", "className": "text-center", "orderable": false },
                ],
            });
        }, 2700);

        // CHART
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

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("oil-temperature-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_oil/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
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
        }, 1150);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("fuelrate-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_fuel/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
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
        }, 1250);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("transmission_oiltemp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_transmission/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
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
        }, 1350);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("engine-coolant-temp-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_coolant/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
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
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1450);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("blow-by-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_blow/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
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
        }, 1550);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("boost-pressure-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>chart_boost/unit/exca/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
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
        }, 1650);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("pumpF-pressmax-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_pump_front_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "pumpF_press_max";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1750);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("pumpR-pressmax-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_pump_rear_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "pumpR_press_max";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1850);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("swing-pressmax-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_swing_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "swing_press_max";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 1950);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("g1pump-pressmax-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_g1pump_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "g1pump_press_max";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2050);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("g2pump-pressmax-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_g2pump_pressure_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Pressure (mPa)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "g2pump_press_max";
                series.dataFields.dateX = "date";
                series.name = "Pressure (mPa)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2150);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("pto-temp-max-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_pto_temp_max/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Temperature (DegC)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "pto_temp_max";
                series.dataFields.dateX = "date";
                series.name = "Temperature (DegC)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2250);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("pto-temp-min-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_pto_temp_min/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Temperature (DegC)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "pto_temp_min";
                series.dataFields.dateX = "date";
                series.name = "Temperature (DegC)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2350);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("arm-ppc-on-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_arm_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "arm_ppc_on";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2350);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("bucket-ppc-on-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_bucket_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "bucket_ppc_on";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2450);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("boom-ppc-on-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_boom_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                chart.dateFormatter.dateFormat = "yyyy-MM-dd";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "boom_ppc_on";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2550);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("swing-ppc-on-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_swing_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                chart.dateFormatter.dateFormat = "yyyy-MM-dd";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "swing_ppc_on";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2650);

        setTimeout(function(){
            am4core.ready(function() {
                var chart = am4core.create("travel-ppc-on-chart", am4charts.XYChart);
                chart.responsive.enabled = true;
                chart.preloader.disabled = true;
                show_indicator(chart);
                chart.dataSource.url = "<?=site_url();?>cdetail/exca/sysdetail_exca/chart_travel_ppc_on/<?=$this->my_encryption->encode($detail_exca->serialnumber)?>";
                chart.dateFormatter.dateFormat = "yyyy-MM-dd";
                var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                dateAxis.renderer.minGridDistance = 100;
                dateAxis.renderer.grid.template.disabled = true;
                var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                valueAxis.title.text = "Second (Sec)";
                var series = chart.series.push(new am4charts.LineSeries());
                series.dataFields.valueY = "travel_ppc_on";
                series.dataFields.dateX = "date";
                series.name = "Second (Sec)";
                series.tooltipText = "{name}: [bold]{valueY}[/]";
                series.strokeWidth = 2;
                show_parameter(chart,dateAxis,valueAxis,series);
            });
        }, 2750);

    });

</script>