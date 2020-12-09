<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['getimage/jpg/(:any)'] = 'syslink/get_image_jpg/$1';
$route['getimage/png/(:any)'] = 'syslink/get_image_png/$1';

// LOGIN
$route['login'] = 'syslogin';
$route['login/authentication'] = 'syslogin/auth_login';

// LOGOUT
$route['logout'] = 'cwelcome/syswelcome/logout';

// FORGOT
$route['forgot'] = 'cforgot/sysforgot/forgot';

// WELCOME
$route['page/welcome/(:any)'] = 'cwelcome/syswelcome/welcome/$1';

// SYSTEM
$route['menu/master_sistem/(:any)'] = 'mst/csystem/systema/master_sistem/$1';
	$route['sistem/t_sistem/(:any)'] = 'mst/csystem/systema/table_system/$1';

// SYSTEM MODULE
$route['menu/master_modul/(:any)'] = 'mst/cmodule/sysmodule/master_modul/$1';
	$route['modul/t_modul/(:any)'] = 'mst/cmodule/sysmodule/table_module/$1';
	$route['sadd/module/(:any)'] = 'mst/cmodule/sysmodule/save_add_module/$1';
	$route['sedd/module/(:any)'] = 'mst/cmodule/sysmodule/save_edit_module/$1';
	$route['sdel/module/(:any)'] = 'mst/cmodule/sysmodule/delete_module/$1';

// USER
$route['menu/master_user/(:any)'] = 'mst/cuser/sysuser/master_user/$1';
	$route['user/t_user/(:any)'] = 'mst/cuser/sysuser/table_user/$1';
	$route['get/module_user/(:any)'] = 'mst/cuser/sysuser/get_module_user/$1';
	$route['get/employee/(:any)'] = 'mst/cuser/sysuser/get_employee/$1';
	$route['check/user/(:any)'] = 'mst/cuser/sysuser/check_user/$1';
	$route['sedd/module_user/(:any)'] = 'mst/cuser/sysuser/save_edit_module_user/$1';
	$route['sadd/user/(:any)'] = 'mst/cuser/sysuser/save_add_user/$1';
	$route['sedd/user/(:any)'] = 'mst/cuser/sysuser/save_edit_user/$1';
	$route['sedd/password/(:any)'] = 'mst/cuser/sysuser/save_edit_password/$1';
	$route['sedd/passwords'] = 'mst/csite/syschoosesite/save_edit_password';
	$route['check/oldpasswords'] = 'mst/csite/syschoosesite/check_old_password';

// LEVEL USER
$route['menu/master_level_user/(:any)'] = 'mst/cleveluser/sysmaster_level_user/master_level_user/$1';
	$route['leveluser/t_level_user/(:any)'] = 'mst/cleveluser/sysmaster_level_user/table_master_level_user/$1';

// SITE
$route['menu/master_site/(:any)'] = 'mst/csite/syssite/master_site/$1';
	$route['site/t_site/(:any)'] = 'mst/csite/syssite/table_site/$1';

// UNIT
$route['menu/master_unit/(:any)'] = 'mst/cunit/sysunit/master_unit/$1';
	$route['unit/t_unit/(:any)'] = 'mst/cunit/sysunit/table_unit/$1';
	$route['unit/t_unit_activity/(:any)'] = 'mst/cunit/sysunit/table_unit_activity/$1';
	$route['unit/t_unit_category/(:any)'] = 'mst/cunit/sysunit/table_unit_category/$1';
	$route['unit/t_unit_mapping/(:any)'] = 'mst/cunit/sysunit/table_unit_mapping/$1';

// INSPECTION
$route['menu/master_inspeksi/(:any)'] = 'mst/cinspection/sysmaster_inspection/master_inspeksi/$1';
	$route['inspection/t_inspection_hdr/(:any)'] = 'mst/cinspection/sysmaster_inspection/table_inspection_hdr/$1';
	$route['inspection/t_inspection_dtl/(:any)'] = 'mst/cinspection/sysmaster_inspection/table_inspection_dtl/$1';

// TOD - PRODUKSI
$route['menu/master_prod_tod/(:any)'] = 'mst/ctod/systod/master_tod/$1';
	$route['tod/t_produksi_param_hdr/(:any)'] = 'mst/ctod/systod/table_produksi_parameter_hdr/$1';

	$route['tod/t_produksi_param_sub/(:any)'] = 'mst/ctod/systod/table_produksi_parameter_sub/$1';
		$route['sadd/prod_param_sub/(:any)'] = 'mst/ctod/systod/save_add_param_sub/$1';
		$route['sedd/prod_param_sub/(:any)'] = 'mst/ctod/systod/save_edit_param_sub/$1';

	$route['tod/t_produksi_param_sub_dictionary/(:any)'] = 'mst/ctod/systod/table_produksi_parameter_sub_dictionary/$1';
		$route['sadd/prod_param_sub_dictionary/(:any)'] = 'mst/ctod/systod/save_add_param_sub_dictionary/$1';
		$route['sedd/prod_param_sub_dictionary/(:any)'] = 'mst/ctod/systod/save_edit_param_sub_dictionary/$1';

	$route['tod/t_produksi_param_score/(:any)'] = 'mst/ctod/systod/table_produksi_parameter_score/$1';
	$route['tod/t_produksi_param_score_dtl/(:any)'] = 'mst/ctod/systod/table_produksi_parameter_score_dtl/$1';
	$route['tod/t_tod_foreman/(:any)'] = 'mst/ctod/systod/table_tod_foreman/$1';
	$route['tod/t_tod_foreman_schedule/(:any)'] = 'mst/ctod/systod/table_tod_foreman_schedule/$1';
	$route['tod/t_corrective_action/(:any)'] = 'mst/ctod/systod/table_corrective_action/$1';

// RAPORT FOREMAN FRONT
$route['menu/master_raport_foreman_front/(:any)'] = 'mst/cforeman/sysmaster_raport_foreman_front/master_raport_foreman_front/$1';
	$route['foreman/t_raport_foreman_front_hdr/(:any)'] = 'mst/cforeman/sysmaster_raport_foreman_front/table_raport_foreman_front_hdr/$1';
	$route['foreman/t_raport_foreman_front_dtl/(:any)'] = 'mst/cforeman/sysmaster_raport_foreman_front/table_raport_foreman_front_dtl/$1';

// EVENT
$route['menu/master_event/(:any)'] = 'mst/cevent/sysmaster_event/master_event/$1';
	$route['event/t_event/(:any)'] = 'mst/cevent/sysmaster_event/table_event/$1';
	$route['event/t_event_level/(:any)'] = 'mst/cevent/sysmaster_event/table_event_level/$1';
	$route['sadd/event/(:any)'] = 'mst/cevent/sysmaster_event/save_add_event/$1';
	$route['sedd/event/(:any)'] = 'mst/cevent/sysmaster_event/save_edit_event/$1';
	$route['sadd/event_level/(:any)'] = 'mst/cevent/sysmaster_event/save_add_event_level/$1';
	$route['sedd/event_level/(:any)'] = 'mst/cevent/sysmaster_event/save_edit_event_level/$1';

// MATCH FLEET
$route['menu/master_matching_fleet/(:any)'] = 'mst/cfleet/sysmaster_match_fleet/master_matching_fleet/$1';
	$route['match_fleet/t_match_fleet/(:any)'] = 'mst/cfleet/sysmaster_match_fleet/table_master_match_fleet/$1';
	$route['sedd/match_fleet/(:any)'] = 'mst/cfleet/sysmaster_match_fleet/save_edit_match_fleet/$1';
	$route['sadd/match_fleet/(:any)'] = 'mst/cfleet/sysmaster_match_fleet/save_add_match_fleet/$1';

// RAPORT HAULING
$route['menu/master_raport_hauling/(:any)'] = 'mst/chauling/sysmaster_raport_hauling/master_raport_hauling/$1';
	$route['raport_hauling/t_master_raport_hauling_hdr/(:any)'] = 'mst/chauling/sysmaster_raport_hauling/table_master_raport_hauling_hdr/$1';
	$route['raport_hauling/t_master_raport_hauling_dtl/(:any)'] = 'mst/chauling/sysmaster_raport_hauling/table_master_raport_hauling_dtl/$1';
	$route['sadd/raport_hauling_hdr/(:any)'] = 'mst/chauling/sysmaster_raport_hauling/save_add_raport_hauling_hdr/$1';
	$route['sedd/raport_hauling_hdr/(:any)'] = 'mst/chauling/sysmaster_raport_hauling/save_edit_raport_hauling_hdr/$1';
	$route['sadd/raport_hauling_dtl/(:any)'] = 'mst/chauling/sysmaster_raport_hauling/save_add_raport_hauling_dtl/$1';
	$route['sedd/raport_hauling_dtl/(:any)'] = 'mst/chauling/sysmaster_raport_hauling/save_edit_raport_hauling_dtl/$1';

// RAPORT LOADING
$route['menu/master_raport_loading/(:any)'] = 'mst/cloading/sysmaster_raport_loading/master_raport_loading/$1';
	$route['raport_loading/t_master_raport_loading_hdr/(:any)'] = 'mst/cloading/sysmaster_raport_loading/table_master_raport_loading_hdr/$1';
	$route['raport_loading/t_master_raport_loading_dtl/(:any)'] = 'mst/cloading/sysmaster_raport_loading/table_master_raport_loading_dtl/$1';
	$route['sadd/raport_loading_hdr/(:any)'] = 'mst/cloading/sysmaster_raport_loading/save_add_raport_loading_hdr/$1';
	$route['sedd/raport_loading_hdr/(:any)'] = 'mst/cloading/sysmaster_raport_loading/save_edit_raport_loading_hdr/$1';
	$route['sadd/raport_loading_dtl/(:any)'] = 'mst/cloading/sysmaster_raport_loading/save_add_raport_loading_dtl/$1';
	$route['sedd/raport_loading_dtl/(:any)'] = 'mst/cloading/sysmaster_raport_loading/save_edit_raport_loading_dtl/$1';

$route['default_controller']   = 'syslogin';
$route['404_override']         = 'syserror';
$route['translate_uri_dashes'] = FALSE;
