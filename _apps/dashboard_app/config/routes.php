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
$route['forgot'] = 'cforgot/sysforgot/index';

// WELCOME
$route['page/first/(:any)'] = 'cwelcome/syswelcome/welcome/$1';

// DASHBOARD
$route['menu/dashboard/(:any)'] = 'trans/cdashboard/sysdashboard/dashboard/$1';
	$route['table/cost_base/(:any)'] = 'trans/cdashboard/sysdashboard/table_cost_base/$1';

// SYSTEM
$route['menu/master_sistem/(:any)'] = 'mst/csystem/systema/master_sistem/$1';
	$route['sistem/t_sistem/(:any)'] = 'mst/csystem/systema/table_system/$1';

// SYSTEM MODULE
$route['menu/master_module/(:any)'] = 'mst/cmodule/sysmodule/master_modul/$1';
	$route['table/modul/(:any)'] = 'mst/cmodule/sysmodule/table_module/$1';
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
	$route['table/site/(:any)'] = 'mst/csite/syssite/table_site/$1';
	$route['sadd/site/(:any)'] = 'mst/csite/syssite/save_add_site/$1';
	$route['sedd/site/(:any)'] = 'mst/csite/syssite/save_edit_site/$1';
	$route['get/site/(:any)'] = 'mst/csite/syssite/get_name_site/$1';

// ONE YEAR CO
$route['menu/one_year_co/(:any)'] = 'trans/coneyearco/sysoneyearco/one_year_co/$1';
	$route['table/one_year_co/(:any)'] = 'trans/coneyearco/sysoneyearco/table_one_year_co/$1';

// INPUT OBJECTIVE KPI
$route['menu/input_objective_kpi/(:any)'] = 'trans/cinputobjkpi/sysinputobjkpi/input_objective_kpi/$1';
	$route['table/input_objective_kpi/(:any)'] = 'trans/cinputobjkpi/sysinputobjkpi/table_input_objective_kpi/$1';

// ACTIVITY PLAN
$route['menu/activity_plan/(:any)'] = 'trans/cactivityplan/sysactivityplan/activity_plan/$1';
	$route['table/activity_plan/(:any)'] = 'trans/cactivityplan/sysactivityplan/table_activity_plan/$1';

// TOD
$route['menu/table_of_duties/(:any)'] = 'trans/ctod/systod/table_of_duties/$1';
	$route['table/tod/(:any)'] = 'trans/ctod/systod/table_tod/$1';

// PHYSICAL RESULTS OBJ - KPI
$route['menu/physical_results_obj_kpi/(:any)'] = 'trans/cphysicalobjkpi/sysphysical_results_obj_kpi/physical_results_obj_kpi/$1';
	$route['table/physical_results_obj_kpi/(:any)'] = 'trans/cphysicalobjkpi/sysphysical_results_obj_kpi/table_physical_results_obj_kpi/$1';

// KEY IN AP
$route['menu/key_in_ap/(:any)'] = 'trans/ckeyinap/syskeyinap/key_in_ap/$1';
	$route['table/key_in_ap/(:any)'] = 'trans/ckeyinap/syskeyinap/table_key_in_ap/$1';

// KEY IN TOD
$route['menu/key_in_tod/(:any)'] = 'trans/ckeyintod/syskeyintod/key_in_tod/$1';
	$route['table/key_in_tod/(:any)'] = 'trans/ckeyintod/syskeyintod/table_key_in_tod/$1';
	$route['table/key_in_tod_w4w5/(:any)'] = 'trans/ckeyintod/syskeyintod/table_key_in_tod_w4w5/$1';

// RESUME AP
$route['menu/resume_ap/(:any)'] = 'trans/cresumeap/sysresumeap/resume_ap/$1';
	$route['table/resume_ap/(:any)'] = 'trans/cresumeap/sysresumeap/table_resume_ap/$1';
	$route['table/resume_ap_q1/(:any)'] = 'trans/cresumeap/sysresumeap/table_resume_ap_q1/$1';
	$route['table/resume_ap_q2/(:any)'] = 'trans/cresumeap/sysresumeap/table_resume_ap_q2/$1';
	$route['table/resume_ap_q3/(:any)'] = 'trans/cresumeap/sysresumeap/table_resume_ap_q3/$1';
	$route['table/resume_ap_q4/(:any)'] = 'trans/cresumeap/sysresumeap/table_resume_ap_q4/$1';
$route['get/data_id/(:any)'] = 'trans/cresumeap/sysresumeap/get_data_id/$1';

// RESUME TOD
$route['menu/resume_tod/(:any)'] = 'trans/cresumetod/sysresumetod/resume_tod/$1';
	$route['table/resume_tod/(:any)'] = 'trans/cresumetod/sysresumetod/table_resume_tod/$1';
	$route['table/resume_tod_data/(:any)'] = 'trans/cresumetod/sysresumetod/table_resume_tod_data/$1';

// RESUME PHYSICAL RESULT
$route['menu/resume_physical_results/(:any)'] = 'trans/cresumephysical/sysresumephysical/resume_physical_results/$1';
	$route['table/resume_physical_results/(:any)'] = 'trans/cresumephysical/sysresumephysical/table_resume_physical_results/$1';

// RAPORT ONE YEAR
$route['menu/raport_one_year/(:any)'] = 'trans/craportoneyear/sysraportoneyear/raport_one_year/$1';
	$route['table/raport_one_year/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year/$1';
	$route['table/raport_one_year_feb/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_feb/$1';
	$route['table/raport_one_year_mar/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_mar/$1';
	$route['table/raport_one_year_apr/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_apr/$1';
	$route['table/raport_one_year_mei/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_mei/$1';
	$route['table/raport_one_year_jun/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_jun/$1';
	$route['table/raport_one_year_jul/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_jul/$1';
	$route['table/raport_one_year_agt/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_agt/$1';
	$route['table/raport_one_year_sep/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_sep/$1';
	$route['table/raport_one_year_okt/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_okt/$1';
	$route['table/raport_one_year_nov/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_nov/$1';
	$route['table/raport_one_year_des/(:any)'] = 'trans/craportoneyear/sysraportoneyear/table_raport_one_year_des/$1';

$route['default_controller']   = 'syslogin';
$route['404_override']         = 'syserror';
$route['translate_uri_dashes'] = FALSE;
