<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// LOGIN
$route['login'] = 'syslogin/index';
$route['authenticate'] = 'syslogin/auth_login';
// LOGOUT
$route['logout'] = 'csite/syschoosesite/logout';

// SCRIPT FILE LINK
$route['s_url/(:any)'] = 'syslink/$1';

// MENU
$route['menu/site'] = 'csite/syschoosesite/choose_site';
$route['menu/dashboard/(:any)'] = 'cpanel/syspanel/dashboard/$1';
$route['menu/performance/(:any)'] = 'cperform/sysperform/performance/$1';
$route['menu/summary/(:any)'] = 'csummary/sysummary/summary/$1';
$route['menu/master_user/(:any)'] = 'cuser/sysuser/master_user/$1';
$route['menu/master_variable/(:any)'] = 'cvariable/sysvariable/master_variable/$1';
$route['menu/master_module/(:any)'] = 'cmodule/sysmodule/master_module/$1';
$route['menu/master_system/(:any)'] = 'csystem/systema/master_system/$1';
$route['menu/master_site/(:any)'] = 'csite/sysconfigsite/master_site/$1';
$route['menu/master_unit/(:any)'] = 'cunit/sysunit/master_unit/$1';
$route['menu/master_logs/(:any)'] = 'clog/syslog/master_logs/$1';

// REPORT CRITICAL
$route['report/critical/(:any)'] = 'ccritical/syscritical/today_critical/$1';
$route['report/t_critical/(:any)'] = 'ccritical/syscritical/table_critical/$1';

// REPORT CAUTION
$route['report/caution/(:any)'] = 'ccaution/syscaution/today_caution/$1';
$route['report/t_caution/(:any)'] = 'ccaution/syscaution/table_caution/$1';

// REPORT FAULT
$route['report/fault/(:any)'] = 'cfault/sysfault/today_fault/$1';
$route['report/t_fault/(:any)'] = 'cfault/sysfault/table_fault/$1';

// DASHBOARD
$route['dashboard/t_dozer/(:any)'] = 'cpanel/syspanel/table_unit_dozer/$1';
$route['dashboard/t_exca/(:any)'] = 'cpanel/syspanel/table_unit_exca/$1';
$route['dashboard/t_hd/(:any)'] = 'cpanel/syspanel/table_unit_hd/$1';

// WARNING UNIT
$route['warning/dozer/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/unit/$1';
$route['warning/exca/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/unit/$1';
$route['warning/hd/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/unit/$1';

// PAYLOAD
$route['payload/hd/(:any)/(:any)'] = 'cpayload/hd/syspayload_hd/unit/$1';

// TABLE & CHART Technical Parameter DOZER
$route['dozer/t_warning/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_warning_unit/$1';
$route['dozer/t_oil/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_engine_oil_temperature/$1';
$route['dozer/t_fuel/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_fuel_rate/$1';
$route['dozer/t_trans/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_transmission_oil_temperature/$1';
$route['dozer/t_coolant/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_engine_coolant_temperature/$1';
$route['dozer/t_blow/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_blow_by_pressure/$1';
$route['dozer/t_boost/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_boost_pressure/$1';
$route['dozer/t_transpres_max/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_transmain_press_max/$1';
$route['dozer/t_transpres_avg/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_transmain_press_avg/$1';
$route['dozer/t_optime/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_operating_time/$1';
$route['dozer/t_doztime/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_dozing_time/$1';
$route['dozer/t_riptime/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_ripping_time/$1';
$route['dozer/t_fwdist_f1/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_fwd_distance_f1/$1';
$route['dozer/t_fwdist_f2/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_fwd_distance_f2/$1';
$route['dozer/t_fwdist_f3/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_fwd_distance_f3/$1';
$route['dozer/t_rvsdist_r1/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_rvs_distance_r1/$1';
$route['dozer/t_rvsdist_r2/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_rvs_distance_r2/$1';
$route['dozer/t_rvsdist_r3/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_rvs_distance_r3/$1';
$route['dozer/t_travtime_f1/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_travel_time_f1/$1';
$route['dozer/t_travtime_f2/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_travel_time_f2/$1';
$route['dozer/t_travtime_f3/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_travel_time_f3/$1';
$route['dozer/t_travtime_r1/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_travel_time_r1/$1';
$route['dozer/t_travtime_r2/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_travel_time_r2/$1';
$route['dozer/t_travtime_r3/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_travel_time_r3/$1';
$route['dozer/t_pitch_max/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_pitch_angle_max/$1';
$route['dozer/t_pitch_avg/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_pitch_angle_avg/$1';
$route['dozer/t_pitch_min/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/table_pitch_angle_min/$1';
$route['dozer/chart_oil/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_engine_oil_temperature/$1';
$route['dozer/chart_fuel/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_fuel_rate/$1';
$route['dozer/chart_trans/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_transmission_oil_temperature/$1';
$route['dozer/chart_coolant/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_engine_coolant_temperature/$1';
$route['dozer/chart_blow/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_blow_by_pressure/$1';
$route['dozer/chart_boost/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_boost_pressure/$1';
$route['dozer/chart_transpres_max/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_transmain_press_max/$1';
$route['dozer/chart_transpres_avg/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_transmain_press_avg/$1';
$route['dozer/chart_optime/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_operating_time/$1';
$route['dozer/chart_doztime/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_dozing_time/$1';
$route['dozer/chart_riptime/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_ripping_time/$1';
$route['dozer/chart_fwdist_f1/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_fwd_distance_f1/$1';
$route['dozer/chart_fwdist_f2/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_fwd_distance_f2/$1';
$route['dozer/chart_fwdist_f3/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_fwd_distance_f3/$1';
$route['dozer/chart_rvsdist_r1/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_rvs_distance_r1/$1';
$route['dozer/chart_rvsdist_r2/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_rvs_distance_r2/$1';
$route['dozer/chart_rvsdist_r3/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_rvs_distance_r3/$1';
$route['dozer/chart_travtime_f1/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_travel_time_f1/$1';
$route['dozer/chart_travtime_f2/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_travel_time_f2/$1';
$route['dozer/chart_travtime_f3/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_travel_time_f3/$1';
$route['dozer/chart_travtime_r1/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_travel_time_r1/$1';
$route['dozer/chart_travtime_r2/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_travel_time_r2/$1';
$route['dozer/chart_travtime_r3/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_travel_time_r3/$1';
$route['dozer/chart_pitch_max/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_pitch_angle_max/$1';
$route['dozer/chart_pitch_avg/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_pitch_angle_avg/$1';
$route['dozer/chart_pitch_min/(:any)/(:any)'] = 'cwarning/dozer/syswarning_dozer/chart_pitch_angle_min/$1';

// TABLE & CHART Technical Parameter EXCA
$route['exca/t_warning/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_warning_unit/$1';
$route['exca/t_oil/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_engine_oil_temperature/$1';
$route['exca/t_fuel/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_fuel_rate/$1';
$route['exca/t_trans/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_transmission_oil_temperature/$1';
$route['exca/t_coolant/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_engine_coolant_temperature/$1';
$route['exca/t_blow/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_blow_by_pressure/$1';
$route['exca/t_boost/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_boost_pressure/$1';
$route['exca/t_fpress_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_pump_front_pressure_max/$1';
$route['exca/t_rpress_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_pump_rear_pressure_max/$1';
$route['exca/t_swingpress_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_swing_pressure_max/$1';
$route['exca/t_g1press_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_g1pump_pressure_max/$1';
$route['exca/t_g2press_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_g2pump_pressure_max/$1';
$route['exca/t_pto_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_pto_temp_max/$1';
$route['exca/t_pto_min/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_pto_temp_min/$1';
$route['exca/t_arm_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_arm_ppc_on/$1';
$route['exca/t_bucket_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_bucket_ppc_on/$1';
$route['exca/t_boom_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_boom_ppc_on/$1';
$route['exca/t_swing_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_swing_ppc_on/$1';
$route['exca/t_travel_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/table_travel_ppc_on/$1';
$route['exca/chart_oil/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_engine_oil_temperature/$1';
$route['exca/chart_fuel/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_fuel_rate/$1';
$route['exca/chart_trans/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_transmission_oil_temperature/$1';
$route['exca/chart_coolant/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_engine_coolant_temperature/$1';
$route['exca/chart_blow/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_blow_by_pressure/$1';
$route['exca/chart_boost/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_boost_pressure/$1';
$route['exca/chart_fpress_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_pump_front_pressure_max/$1';
$route['exca/chart_rpress_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_pump_rear_pressure_max/$1';
$route['exca/chart_swingpress_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_swing_pressure_max/$1';
$route['exca/chart_g1press_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_g1pump_pressure_max/$1';
$route['exca/chart_g2press_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_g2pump_pressure_max/$1';
$route['exca/chart_pto_max/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_pto_temp_max/$1';
$route['exca/chart_pto_min/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_pto_temp_min/$1';
$route['exca/chart_arm_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_arm_ppc_on/$1';
$route['exca/chart_bucket_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_bucket_ppc_on/$1';
$route['exca/chart_boom_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_boom_ppc_on/$1';
$route['exca/chart_swing_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_swing_ppc_on/$1';
$route['exca/chart_travel_ppc/(:any)/(:any)'] = 'cwarning/exca/syswarning_exca/chart_travel_ppc_on/$1';

// TABLE & CHART Technical Parameter HD
$route['hd/t_warning/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_warning_unit/$1';
$route['hd/t_oil/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_engine_oil_temperature/$1';
$route['hd/t_fuel/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_fuel_rate/$1';
$route['hd/t_trans/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_transmission_oil_temperature/$1';
$route['hd/t_coolant/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_engine_coolant_temperature/$1';
$route['hd/t_blow/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_blow_by_pressure/$1';
$route['hd/t_boost/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_boost_pressure/$1';
$route['hd/t_travelspeed/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_travel_speed/$1';
$route['hd/t_enginespeed/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_engine_speed/$1';
$route['hd/t_fbrake/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_front_brake/$1';
$route['hd/t_rbrake/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_rear_brake/$1';
$route['hd/t_engoilomin/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_engine_oil_lomin/$1';
$route['hd/t_oilpressmax/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/table_oil_pressure_maximal/$1';
$route['hd/chart_oil/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_engine_oil_temperature/$1';
$route['hd/chart_fuel/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_fuel_rate/$1';
$route['hd/chart_trans/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_transmission_oil_temperature/$1';
$route['hd/chart_coolant/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_engine_coolant_temperature/$1';
$route['hd/chart_blow/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_blow_by_pressure/$1';
$route['hd/chart_boost/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_boost_pressure/$1';
$route['hd/chart_travelspeed/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_travel_speed/$1';
$route['hd/chart_enginespeed/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_engine_speed/$1';
$route['hd/chart_fbrake/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_front_brake/$1';
$route['hd/chart_rbrake/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_rear_brake/$1';
$route['hd/chart_engoilomin/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_engine_oil_lomin/$1';
$route['hd/chart_oilpressmax/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/chart_oil_pressure_maximal/$1';
$route['hd/info_payload/(:any)/(:any)'] = 'cwarning/hd/syswarning_hd/info_payload/$1';

// TABLE PAYLOAD
$route['hd/t_payload/(:any)/(:any)'] = 'cpayload/hd/syspayload_hd/table_payload/$1';
$route['hd/t_edt/(:any)/(:any)'] = 'cpayload/hd/syspayload_hd/table_empty_drive_time/$1';
$route['hd/t_edd/(:any)/(:any)'] = 'cpayload/hd/syspayload_hd/table_empty_drive_distance/$1';
$route['hd/t_est/(:any)/(:any)'] = 'cpayload/hd/syspayload_hd/table_empty_stop_time/$1';
$route['hd/t_lst/(:any)/(:any)'] = 'cpayload/hd/syspayload_hd/table_loading_stop_time/$1';
$route['hd/t_ldt/(:any)/(:any)'] = 'cpayload/hd/syspayload_hd/table_loaded_drive_time/$1';
$route['hd/t_ldst/(:any)/(:any)'] = 'cpayload/hd/syspayload_hd/table_loaded_stop_time/$1';

// EXPORT DATA WARNING
$route['dozer/export_warning/(:any)/(:any)/(:any)/(:any)'] = 'cwarning/dozer/sysexport_dozer/export/$1';
$route['exca/export_warning/(:any)/(:any)/(:any)/(:any)'] = 'cwarning/exca/sysexport_exca/export/$1';
$route['hd/export_warning/(:any)/(:any)/(:any)/(:any)'] = 'cwarning/hd/sysexport_hd/export/$1';

// EXPORT DATA PAYLOAD
$route['hd/export_payload/(:any)/(:any)/(:any)/(:any)'] = 'cpayload/hd/sysexport_hd/export_payload/$1';

// MASTER USER
$route['user/t_user/(:any)'] = 'cuser/sysuser/table_user/$1';
$route['get/module_user/(:any)'] = 'cuser/sysuser/get_module_user/$1';
$route['get/employee/(:any)'] = 'cuser/sysuser/get_employee/$1';
$route['check/user/(:any)'] = 'cuser/sysuser/check_user/$1';
$route['sedd/module_user/(:any)'] = 'cuser/sysuser/save_edit_module_user/$1';
$route['sadd/user/(:any)'] = 'cuser/sysuser/save_add_user/$1';
$route['sedd/user/(:any)'] = 'cuser/sysuser/save_edit_user/$1';
$route['sedd/password/(:any)'] = 'cuser/sysuser/save_edit_password/$1';

// MASTER VARIABLE
$route['variable/t_variable/(:any)'] = 'cvariable/sysvariable/table_variable/$1';

// MASTER MODULE
$route['module/t_module/(:any)'] = 'cmodule/sysmodule/table_module/$1';

// MASTER SYSTEM
$route['system/t_system/(:any)'] = 'csystem/systema/table_system/$1';

// MASTER SITE
$route['site/t_site/(:any)'] = 'csite/sysconfigsite/table_site/$1';

// MASTER UNIT
$route['unit/t_unit/(:any)'] = 'cunit/sysunit/table_unit/$1';

// MASTER LOGS
$route['logs/t_logs/(:any)'] = 'clog/syslog/table_logs/$1';

// PERFORMANCE
$route['perform/t_perform_hd465/(:any)'] = 'cperform/sysperform/table_perform_hd465/$1';
$route['perform/t_perform_hd785/(:any)'] = 'cperform/sysperform/table_perform_hd785/$1';
$route['perform/t_perform_exca465/(:any)'] = 'cperform/sysperform/table_perform_exca465/$1';
$route['perform/t_perform_exca785/(:any)'] = 'cperform/sysperform/table_perform_exca785/$1';

// SUMMARY
$route['summary/caution/(:any)'] = 'csummary/sysummary/caution/$1';
$route['summary/t_caution_month/(:any)'] = 'csummary/sysummary/table_caution_month/$1';

// // PROFILE
// $route['profile'] ='cprofile/sysprofile';
// $route['profile/s_editData']        = 'cprofile/sysprofile/save_edit_data';
// $route['profile/g_userData/(:any)'] ='cprofile/sysprofile/get_user/$1';

// // PERFORMANCE
// $route['perform'] = 'cperform/sysperform/index';
// $route['perform/mpv/unit/hd465'] = 'cperform/sysperform/table_mpv_HD465';
// $route['perform/mpv/unit/hd785'] = 'cperform/sysperform/table_mpv_HD785';
// $route['perform/mpv/unit/exca465'] = 'cperform/sysperform/table_mpv_exca465';
// $route['perform/mpv/unit/exca785'] = 'cperform/sysperform/table_mpv_exca785';

// // FORGOT PAGE
// $route['forgot'] = 'cforgot/sysforgot';
// $route['forgot/validate/(:any)'] = 'cforgot/sysforgot/validate/$1';

$route['default_controller']   = 'syslogin';
$route['404_override'] = 'syserror';
$route['translate_uri_dashes'] = FALSE;
