<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['s_url/(:any)'] = 'syslink/$1';

// LOGIN
$route['logisisse'] = 'syslogin';
$route['check/auth/login'] = 'syslogin/auth_login';

// LOGOUT
$route['logivalja'] = 'csite/syschoosesite/logivout';

// DASHBOARD
$route['table/tl/(:any)'] = 'cpanel/syspanel/table_tl/$1';
$route['table/office/(:any)'] = 'cpanel/syspanel/table_office/$1';
$route['dashboard/export_tl/(:any)'] = 'cpanel/syspanex/export_tl/$1';
$route['dashboard/export_of/(:any)'] = 'cpanel/syspanex/export_of/$1';

// DETAIL TL
$route['dtable/tl/(:any)/(:any)'] = 'cdetail/tl/systl/table_detail_tl/$1/$1';

// DETAIL OFFICE
$route['dtable/office/(:any)/(:any)'] = 'cdetail/office/sysoffice/table_detail_office/$1/$1';

// PRIVILEGE
$route['dtable/privilege/(:any)'] = 'cprivilege/sysprivilege/table_privilege';
$route['check/oldpassword'] = 'cprivilege/sysprivilege/check_old_password';
$route['check/user/(:any)'] = 'cprivilege/sysprivilege/check_user/$1';
$route['get/employee/(:any)'] = 'cprivilege/sysprivilege/get_employee/$1';
$route['get/module_user/(:any)'] = 'cprivilege/sysprivilege/get_module_user/$1';
$route['sadd/user/(:any)'] = 'cprivilege/sysprivilege/save_add_user/$1';
$route['sedd/user/(:any)'] = 'cprivilege/sysprivilege/save_edit_user/$1';
$route['sedd/moduleuser/(:any)'] = 'cprivilege/sysprivilege/save_edit_module_user/$1';
$route['sedd/password/(:any)'] = 'cprivilege/sysprivilege/save_edit_password/$1';

// MENU
$route['menu/site'] = 'csite/syschoosesite/choose_site';
$route['menu/dashboard/(:any)'] = 'cpanel/syspanel/dashboard/$1';
$route['menu/resume_hm/(:any)'] = 'cresume/sysresume/resume_hm/$1';
$route['menu/master_user/(:any)'] = 'cprivilege/sysprivilege/master_user/$1';
$route['menu/master_system/(:any)'] = 'csystem/system/master_system/$1';
$route['menu/master_system_module/(:any)'] = 'cmodule/sysmodule/master_system_module/$1';
$route['menu/master_site/(:any)'] = 'csite/sysconfigsite/master_site/$1';
$route['menu/profile/(:any)'] = 'cprofile/sysprofile/profile/$1';
$route['menu/logs/(:any)'] = 'clogs/syslogs/logs/$1';

// DETAIL
$route['detail/tl/(:any)/(:any)'] = 'cdetail/tl/systl/detail/$1/$1';
$route['detail/office/(:any)/(:any)'] = 'cdetail/office/sysoffice/detail/$1/$1';

// DETAIL HM EXPORT
$route['export/tl/(:any)/(:any)/(:any)/(:any)'] = 'cdetail/tl/systlex/export/$1/$1/$1/$1';
$route['export/office/(:any)/(:any)/(:any)/(:any)'] = 'cdetail/office/sysofficeex/export/$1/$1/$1/$1';

// RESUME
$route['search/tl/(:any)/(:any)/(:any)'] = 'cresume/sysresume/search/$1/$1/$1';
$route['chart/tl/(:any)/(:any)/(:any)'] = 'cresume/sysresume/chart_tl/$1/$1/$1';
$route['chart/office/(:any)/(:any)/(:any)'] = 'cresume/sysresume/chart_office/$1/$1/$1';

// MODULE CONFIG
$route['dtable/module/(:any)'] = 'cmodule/sysmodule/table_module_config';
$route['sadd/module/(:any)'] = 'cmodule/sysmodule/save_add_module/$1';
$route['sedd/module/(:any)'] = 'cmodule/sysmodule/save_edit_module/$1';
$route['sdel/module/(:any)'] = 'cmodule/sysmodule/delete_module/$1';

// SITE CONFIG
$route['dtable/site/(:any)'] = 'csite/sysconfigsite/table_site_config';
$route['get/site_name/(:any)'] = 'csite/sysconfigsite/get_name_site/$1';
$route['sadd/site/(:any)'] = 'csite/sysconfigsite/save_add_site/$1';
$route['sedd/site/(:any)'] = 'csite/sysconfigsite/save_edit_site/$1';
$route['sdel/site/(:any)'] = 'csite/sysconfigsite/delete_site/$1';

// SYSTEM CONFIG
$route['dtable/system/(:any)'] = 'csystem/system/table_system';
$route['sadd/system/(:any)'] = 'csystem/system/save_add_system/$1';
$route['sedd/system/(:any)'] = 'csystem/system/save_edit_system/$1';
$route['sdel/system/(:any)'] = 'csystem/system/delete_system/$1';

// LOGS
$route['dtable/logs/(:any)'] = 'clogs/syslogs/table_logs';

// FORGOT
$route['forgot'] = 'cforgot/sysforgot';
$route['check/forgot'] = 'cforgot/sysforgot/forgot';
$route['forgot/validate/(:any)'] = 'cforgot/sysforgot/validate/$1';
$route['sadd/forgot/password'] = 'cforgot/sysforgot/save_new_password';
$route['forgot/timesup'] = 'cforgot/sysforgot/timesup';

$route['default_controller']   = 'syslogin';
$route['404_override']         = 'syserror';
$route['translate_uri_dashes'] = FALSE;
