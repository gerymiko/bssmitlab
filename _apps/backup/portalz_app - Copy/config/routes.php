<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['s_url/(:any)'] = 'syslink/$1';

// LOGIN
$route['logisisse'] = 'syslogin';
$route['check/auth/login'] = 'syslogin/auth_login';
$route['logivalja'] = 'cboard/syspanel/logout';

// MENU
// 1. DASHBOARD
$route['menu/dashboard'] = 'cboard/syspanel';
// 2. HAK AKSES
// 3. REKRUTMEN
// - WEB
$route['recweb/menu/vacancy'] = 'crecruit/web/vacancy/sysvacancy';
$route['recweb/menu/applicant/list'] = 'crecruit/web/applicant/sysapplicant';
$route['recweb/menu/applicant/register'] = 'crecruit/web/register/sysreg';
$route['recweb/menu/applicant/qualify'] = 'crecruit/web/qualify/sysqualify';
$route['recweb/menu/applicant/failed'] = 'crecruit/web/failed/sysfailed';
$route['recweb/menu/applicant/monitor'] = 'crecruit/web/monitor/sysmonitor';
// - MANUAL
$route['recman/menu/status/applicant'] = 'crecruit/manual/applicant/sysapplicant';
$route['recman/menu/failed/applicant'] = 'crecruit/manual/failed/sysfailed';
$route['recman/menu/medical/applicant'] = 'crecruit/manual/medical/sysmedical';

// A. REKRUTMEN WEB
$route['recweb/table/applicant'] = 'crecruit/web/applicant/sysapplicant/table_applicant';
$route['recweb/applicant/view/detail/(:any)'] = 'crecruit/web/applicant/sysdetail/detail_applicant/$1';

// B. REKRUTMEN MANUAL
// - APPLICANT LIST
$route['recman/table/applicant'] = 'crecruit/manual/applicant/sysapplicant/table_applicant';
$route['recman/check/identity_number'] = 'crecruit/manual/applicant/sysapplicant/check_noktp';
$route['recman/applicant/add/applicant'] = 'crecruit/manual/applicant/sysapplicant/save_add_applicant';
$route['recman/applicant/add/lisence'] = 'crecruit/manual/applicant/sysapplicant/save_add_lisence';
$route['recman/applicant/add/experience'] = 'crecruit/manual/applicant/sysapplicant/save_add_experience';
$route['recman/applicant/add/skill'] = 'crecruit/manual/applicant/sysapplicant/save_add_skill';
$route['recman/applicant/edit/personal'] = 'crecruit/manual/applicant/sysapplicant/save_edit_personal';
$route['recman/applicant/edit/address'] = 'crecruit/manual/applicant/sysapplicant/save_edit_address';
$route['recman/applicant/edit/lisence'] = 'crecruit/manual/applicant/sysapplicant/save_edit_lisence';
$route['recman/applicant/edit/experience'] = 'crecruit/manual/applicant/sysapplicant/save_edit_experience';
$route['recman/applicant/edit/skill'] = 'crecruit/manual/applicant/sysapplicant/save_edit_skill';
$route['recman/applicant/remove/applicant'] = 'crecruit/manual/applicant/sysapplicant/delete_applicant';
$route['recman/applicant/view/detail/(:any)'] = 'crecruit/manual/applicant/sysdetail/detail_applicant/$1';
$route['recman/applicant/view/add/applicant'] = 'crecruit/manual/applicant/sysapplicant/add_applicant';
// - APPLICANT FAILED
$route['recman/table/failed/applicant'] = 'crecruit/manual/failed/sysfailed/table_applicant_failed';
// - APPLICANT MEDICAL
$route['recman/table/medical/applicant'] = 'crecruit/manual/medical/sysmedical/table_applicant_medical';
$route['recman/medical/add/result'] = 'crecruit/manual/medical/sysmedical/save_decision_mcu';
// - INTERVIEW
$route['recman/interview/view/detail/(:any)'] = 'crecruit/manual/interview/sysdetail/detail_interview/$1';
$route['recman/interview/view/start/(:any)'] = 'crecruit/manual/interview/sysinterview/step_interview/$1';
$route['recman/interview/repeat'] = 'crecruit/manual/interview/sysinterview/reinterview';
$route['recman/interview/add'] = 'crecruit/manual/interview/sysinterview/save_add_interview';
$route['recman/interview/change/app_info'] = 'crecruit/manual/interview/sysinterview/save_edit_melamar';
$route['recman/interview/change/stage/blacklist'] = 'crecruit/manual/interview/sysinterview/save_edit_blacklist';
$route['recman/interview/change/stage/app_file'] = 'crecruit/manual/interview/sysinterview/save_edit_berkas';
$route['recman/interview/change/stage/technical'] = 'crecruit/manual/interview/sysinterview/save_edit_hrd_teknis';
$route['recman/interview/change/stage/theory'] = 'crecruit/manual/interview/sysinterview/save_edit_teori';
$route['recman/interview/change/stage/practice'] = 'crecruit/manual/interview/sysinterview/save_edit_praktek';
$route['recman/interview/change/stage/medical'] = 'crecruit/manual/interview/sysinterview/save_edit_mcu';

$route['default_controller']   = 'syslogin';
$route['404_override']         = 'syserror';
$route['translate_uri_dashes'] = FALSE;
