<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// LOGIN
$route['login']        = 'syslogin/index';
$route['authenticate'] = 'syslogin/auth_login';

// LOGOUT
$route['logout'] = 'cpanel/syspanel/logout';

// SCRIPT FILE LINK
$route['s_url/(:any)'] = 'syslink/$1';

// DASHBOARD
$route['dashboard'] = 'cpanel/syspanel';
$route['dashboard/t_dozer'] = 'cpanel/syspanel/table_unit_dozer';
$route['dashboard/t_exca'] = 'cpanel/syspanel/table_unit_exca';
$route['dashboard/t_hd'] = 'cpanel/syspanel/table_unit_hd';

// UNIT
$route['unit']             = 'cunit/sysunit';
$route['data/unit']        = 'cunit/sysunit/table_unit';
$route['unit/activated']   = 'cunit/sysunit/activated_unit';
$route['unit/deactivated'] = 'cunit/sysunit/deactivated_unit';
$route['unit/trash']       = 'cunit/sysunit/delete_unit';

// VARIABLE
$route['variable']           = 'cmaster/sysmaster';
$route['variable/s_editVar'] = 'cmaster/sysmaster/save_edit_variable';
$route['variable/t_variable'] = 'cmaster/sysmaster/table_variable';

// PRIVILEGE
$route['privilege']             = 'cprivilege/sysprivilege';
$route['privilege/t_privilege'] = 'cprivilege/sysprivilege/table_privilege';
$route['privilege/getDataEm']   = 'cprivilege/sysprivilege/getKaryawan';
$route['privilege/checkData']   = 'cprivilege/sysprivilege/check_user';
$route['privilege/checkPass']   = 'cprivilege/sysprivilege/check_password';
$route['privilege/s_addUser']   = 'cprivilege/sysprivilege/save_add_user';
$route['privilege/s_editUser']  = 'cprivilege/sysprivilege/save_edit_user';
$route['privilege/s_editPass']  = 'cprivilege/sysprivilege/save_edit_password';

// CRITICAL
$route['report/critical'] = 'ccritical/syscritical';
$route['data/critical']   = 'ccritical/syscritical/table_critical_unit';

// CAUTION
$route['report/caution'] = 'ccaution/syscaution';
$route['data/caution']   = 'ccaution/syscaution/table_caution_unit';

// FAULT
$route['report/fault'] = 'cfault/sysfault';
$route['data/fault']   = 'cfault/sysfault/table_fault_unit';

// WARNING UNIT
$route['warning/unit/dozer/(:any)']   = 'cdetail/dozer/syswarning_dozer/unit/$1';
$route['warning/unit/exca/(:any)'] = 'cdetail/exca/sysdetail_exca/unit/$1';
$route['warning/unit/hd/(:any)']   = 'cdetail/hd/sysdetail_hd/unit/$1';


// WARNING UNIT DOZER TABLE
$route['t_warning/unit/dozer/(:any)']      = 'cdetail/dozer/syswarning_dozer/table_warning_unit/$1';
$route['t_oil/unit/dozer/(:any)']          = 'cdetail/dozer/syswarning_dozer/table_engine_oil_temperature/$1';
$route['t_fuel/unit/dozer/(:any)']         = 'cdetail/dozer/syswarning_dozer/table_fuel_rate/$1';
$route['t_transmission/unit/dozer/(:any)'] = 'cdetail/dozer/syswarning_dozer/table_transmission_oil_temperature/$1';
$route['t_coolant/unit/dozer/(:any)']      = 'cdetail/dozer/syswarning_dozer/table_engine_coolant_temperature/$1';
$route['t_blow/unit/dozer/(:any)']         = 'cdetail/dozer/syswarning_dozer/table_blow_by_pressure/$1';
$route['t_boost/unit/dozer/(:any)']        = 'cdetail/dozer/syswarning_dozer/table_boost_pressure/$1';

// WARNING UNIT DOZER CHART
$route['chart_oil/unit/dozer/(:any)']          = 'cdetail/dozer/syswarning_dozer/chart_engine_oil_temperature/$1';
$route['chart_fuel/unit/dozer/(:any)']         = 'cdetail/dozer/syswarning_dozer/chart_fuel_rate/$1';
$route['chart_transmission/unit/dozer/(:any)'] = 'cdetail/dozer/syswarning_dozer/chart_transmission_oil_temperature/$1';
$route['chart_coolant/unit/dozer/(:any)']      = 'cdetail/dozer/syswarning_dozer/chart_engine_coolant_temperature/$1';
$route['chart_blow/unit/dozer/(:any)']         = 'cdetail/dozer/syswarning_dozer/chart_blow_by_pressure/$1';
$route['chart_boost/unit/dozer/(:any)']        = 'cdetail/dozer/syswarning_dozer/chart_boost_pressure/$1';

// WARNING UNIT EXCA TABLE
$route['t_warning/unit/exca/(:any)']      = 'cdetail/exca/sysdetail_exca/table_warning_unit/$1';
$route['t_oil/unit/exca/(:any)']          = 'cdetail/exca/sysdetail_exca/table_engine_oil_temperature/$1';
$route['t_fuel/unit/exca/(:any)']         = 'cdetail/exca/sysdetail_exca/table_fuel_rate/$1';
$route['t_transmission/unit/exca/(:any)'] = 'cdetail/exca/sysdetail_exca/table_transmission_oil_temperature/$1';
$route['t_coolant/unit/exca/(:any)']      = 'cdetail/exca/sysdetail_exca/table_engine_coolant_temperature/$1';
$route['t_blow/unit/exca/(:any)']         = 'cdetail/exca/sysdetail_exca/table_blow_by_pressure/$1';
$route['t_boost/unit/exca/(:any)']        = 'cdetail/exca/sysdetail_exca/table_boost_pressure/$1';

// WARNING UNIT EXCA CHART
$route['chart_oil/unit/exca/(:any)']          = 'cdetail/exca/sysdetail_exca/chart_engine_oil_temperature/$1';
$route['chart_fuel/unit/exca/(:any)']         = 'cdetail/exca/sysdetail_exca/chart_fuel_rate/$1';
$route['chart_transmission/unit/exca/(:any)'] = 'cdetail/exca/sysdetail_exca/chart_transmission_oil_temperature/$1';
$route['chart_coolant/unit/exca/(:any)']      = 'cdetail/exca/sysdetail_exca/chart_engine_coolant_temperature/$1';
$route['chart_blow/unit/exca/(:any)']         = 'cdetail/exca/sysdetail_exca/chart_blow_by_pressure/$1';
$route['chart_boost/unit/exca/(:any)']        = 'cdetail/exca/sysdetail_exca/chart_boost_pressure/$1';

// WARNING UNIT HD TABLE
$route['t_warning/unit/hd/(:any)']      = 'cdetail/hd/sysdetail_hd/table_warning_unit/$1';
$route['t_oil/unit/hd/(:any)']          = 'cdetail/hd/sysdetail_hd/table_engine_oil_temperature/$1';
$route['t_fuel/unit/hd/(:any)']         = 'cdetail/hd/sysdetail_hd/table_fuel_rate/$1';
$route['t_transmission/unit/hd/(:any)'] = 'cdetail/hd/sysdetail_hd/table_transmission_oil_temperature/$1';
$route['t_coolant/unit/hd/(:any)']      = 'cdetail/hd/sysdetail_hd/table_engine_coolant_temperature/$1';
$route['t_blow/unit/hd/(:any)']         = 'cdetail/hd/sysdetail_hd/table_blow_by_pressure/$1';
$route['t_boost/unit/hd/(:any)']        = 'cdetail/hd/sysdetail_hd/table_boost_pressure/$1';
$route['t_travel/unit/hd/(:any)']       = 'cdetail/hd/sysdetail_hd/table_travel_speed/$1';
$route['t_engine/unit/hd/(:any)']       = 'cdetail/hd/sysdetail_hd/table_engine_speed/$1';
$route['t_front/unit/hd/(:any)']        = 'cdetail/hd/sysdetail_hd/table_front_brake/$1';
$route['t_rear/unit/hd/(:any)']         = 'cdetail/hd/sysdetail_hd/table_rear_brake/$1';
$route['t_oilpmin/unit/hd/(:any)']      = 'cdetail/hd/sysdetail_hd/table_oil_pressure_min/$1';
$route['t_oilpmax/unit/hd/(:any)']      = 'cdetail/hd/sysdetail_hd/table_oil_pressure_max/$1';

// WARNING UNIT HD CHART
$route['chart_oil/unit/hd/(:any)']          = 'cdetail/hd/sysdetail_hd/chart_engine_oil_temperature/$1';
$route['chart_fuel/unit/hd/(:any)']         = 'cdetail/hd/sysdetail_hd/chart_fuel_rate/$1';
$route['chart_transmission/unit/hd/(:any)'] = 'cdetail/hd/sysdetail_hd/chart_transmission_oil_temperature/$1';
$route['chart_coolant/unit/hd/(:any)']      = 'cdetail/hd/sysdetail_hd/chart_engine_coolant_temperature/$1';
$route['chart_blow/unit/hd/(:any)']         = 'cdetail/hd/sysdetail_hd/chart_blow_by_pressure/$1';
$route['chart_boost/unit/hd/(:any)']        = 'cdetail/hd/sysdetail_hd/chart_boost_pressure/$1';
$route['chart_travel/unit/hd/(:any)']       = 'cdetail/hd/sysdetail_hd/chart_travel_speed/$1';
$route['chart_engine/unit/hd/(:any)']       = 'cdetail/hd/sysdetail_hd/chart_engine_speed/$1';
$route['chart_front/unit/hd/(:any)']        = 'cdetail/hd/sysdetail_hd/chart_front_brake/$1';
$route['chart_rear/unit/hd/(:any)']         = 'cdetail/hd/sysdetail_hd/chart_rear_brake/$1';
$route['chart_oil_min/unit/hd/(:any)']      = 'cdetail/hd/sysdetail_hd/chart_oil_press_min/$1';
$route['chart_oil_max/unit/hd/(:any)']      = 'cdetail/hd/sysdetail_hd/chart_oil_press_max/$1';

// WARNING UNIT HD INFO
$route['info_payload/unit/hd/(:any)'] = 'cpayload/hd/syspayload_hd/info_payload/$1';

// PAYLOAD TABLE
$route['t_payload/unit/hd/(:any)'] = 'cpayload/hd/syspayload_hd/table_payload/$1';
$route['t_edt/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/table_empty_drive_time/$1';
$route['t_edd/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/table_empty_drive_distance/$1';
$route['t_est/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/table_empty_stop_time/$1';
$route['t_lst/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/table_loading_stop_time/$1';
$route['t_ldt/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/table_loaded_drive_time/$1';
$route['t_ldst/unit/hd/(:any)']    = 'cpayload/hd/syspayload_hd/table_loaded_stop_time/$1';

// PAYLOAD TABLE SEARCH
$route['st_payload/unit/hd/(:any)'] = 'cpayload/hd/syspayload_hd/search_table_payload/$1';
$route['st_edt/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/search_table_empty_drive_time/$1';
$route['st_edd/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/search_table_empty_drive_distance/$1';
$route['st_est/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/search_table_empty_stop_time/$1';
$route['st_lst/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/search_table_loading_stop_time/$1';
$route['st_ldt/unit/hd/(:any)']     = 'cpayload/hd/syspayload_hd/search_table_loaded_drive_time/$1';
$route['st_ldst/unit/hd/(:any)']    = 'cpayload/hd/syspayload_hd/search_table_loaded_stop_time/$1';

// MONTHLY MVP
$route['monthy_mvp/unit/hd/(:any)'] = 'cpayload/hd/syspayload_hd/most_valuable_driver/$1';
$route['monthy_mvp_unit/unit/hd/(:any)'] = 'cpayload/hd/syspayload_hd/most_valuable_unit/$1';

// PROFILE
$route['profile'] ='cprofile/sysprofile';
$route['profile/s_editData']        = 'cprofile/sysprofile/save_edit_data';
$route['profile/g_userData/(:any)'] ='cprofile/sysprofile/get_user/$1';

// PERFORMANCE
$route['perform'] = 'cperform/sysperform/index';
$route['perform/mpv/unit/hd465'] = 'cperform/sysperform/table_mpv_HD465';
$route['perform/mpv/unit/hd785'] = 'cperform/sysperform/table_mpv_HD785';
$route['perform/mpv/unit/exca465'] = 'cperform/sysperform/table_mpv_exca465';
$route['perform/mpv/unit/exca785'] = 'cperform/sysperform/table_mpv_exca785';

// FORGOT PAGE
$route['forgot'] = 'cforgot/sysforgot';
$route['forgot/validate/(:any)'] = 'cforgot/sysforgot/validate/$1';

// PAYLOAD
$route['payload/unit/hd/(:any)'] = 'cpayload/hd/syspayload_hd/unit/$1';

$route['default_controller']   = 'syslogin';
$route['404_override'] = 'syserror';
$route['translate_uri_dashes'] = FALSE;
