<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['getimage/jpg/(:any)'] = 'syslink/get_image_jpg/$1';
$route['getimage/png/(:any)'] = 'syslink/get_image_png/$1';
$route['getimage/career/profile/(:any)'] = 'syslink/get_image_career_profile/$1';
$route['getimage/career/docs/(:any)'] = 'syslink/get_image_career_docs/$1';

// FORGOT


// LOGIN
$route['logisisse'] = 'syslogin';
$route['check/authentication'] = 'syslogin/auth_login';
$route['m/logivalja'] = 'cpanel/syspanel/logout';

// WELCOME
$route['m/welcome'] = 'cwelcome/syswelcome/welcome';

// DASHBOARD
$route['m/dashboard'] = 'cpanel/syspanel/dashboard';

// PROFILE
$route['m/myprofile'] = 'cprofile/sysprofile/my_profile';
	$route['profile/getUserData/(:any)'] = 'cprofile/sysprofile/get_user_data/$1';
	$route['get/oldpassword'] = 'cprofile/sysprofile/get_old_password';
	$route['sedd/password'] = 'cprofile/sysprofile/save_edit_password';
	$route['sedd/profile'] = 'cprofile/sysprofile/save_edit_profile';

// HAK AKSES
$route['m/privilege'] = 'cprivilege/sysprivilege/privilege';
	$route['get/employee'] = 'cprivilege/sysprivilege/get_employee';
	$route['check/user'] = 'cprivilege/sysprivilege/check_user';
	$route['sadd/user'] = 'cprivilege/sysprivilege/save_add_user';
	$route['sedd/user'] = 'cprivilege/sysprivilege/save_edit_user';
	$route['snon/user'] = 'cprivilege/sysprivilege/save_nonactive_user';
	$route['table/user'] = 'cprivilege/sysprivilege/table_user';

// MASTER LOG
$route['m/weblogs'] = 'clog/syslog/web_log';
	$route['table/logs'] = 'clog/syslog/table_log';

// REKRUTMEN
// - WEBSITE
$route['web/detail/vacancy/(:any)'] = 'crecruit/web/vacancy/sysvacancy/vdetail_vacancy/$1';
	$route['web/check/vacancy'] = 'crecruit/web/vacancy/sysvacancy/check_vacancy';
	$route['web/deactivated/vacancy'] = 'crecruit/web/vacancy/sysvacancy/deactivated_vacancy';
	$route['web/edit/vacancy'] = 'crecruit/web/vacancy/sysvacancy/save_edit_vacancy';
	$route['web/add/vacancy'] = 'crecruit/web/vacancy/sysvacancy/save_add_vacancy';
	$route['web/get/skill'] = 'crecruit/web/vacancy/sysvacancy/getSkill';
	$route['web/get/certificate'] = 'crecruit/web/vacancy/sysvacancy/getSertifikat';
	$route['web/get/condition'] = 'crecruit/web/vacancy/sysvacancy/getSyarat';

$route['web/detail/applicant/(:any)'] = 'crecruit/web/applicant/sysdetail/detail_applicant/$1';

$route['m/web/vacancy'] = 'crecruit/web/vacancy/sysvacancy';
	$route['web/table/vacancy'] = 'crecruit/web/vacancy/sysvacancy/table_vacancy';
	$route['web/add/vacancy'] = 'crecruit/web/vacancy/sysvacancy/vadd_vacancy';
	$route['web/edit/vacancy/(:any)/(:any)'] = 'crecruit/web/vacancy/sysvacancy/vedit_vacancy/$1/$1';

$route['m/web/applicant/registered'] = 'crecruit/web/register/sysreg';
	$route['web/table/registered'] = 'crecruit/web/register/sysreg/table_register';

$route['m/web/applicant/all'] = 'crecruit/web/applicant/sysapplicant';
	$route['web/table/applicant'] = 'crecruit/web/applicant/sysapplicant/table_applicant';
	$route['web/get/clinic_address'] = 'crecruit/web/applicant/sysapplicant/get_clinic_address';
	$route['web/send/message/kspm'] = 'crecruit/web/message/sysmessage/send_sms_kspm';
	$route['web/send/message/teknis'] = 'crecruit/web/message/sysmessage/send_sms_teknis';
	$route['web/send/message/mcu'] = 'crecruit/web/message/sysmessage/send_sms_mcu';

$route['m/web/applicant/qualified'] = 'crecruit/web/qualify/sysqualify';
	$route['web/table/qualified'] = 'crecruit/web/qualify/sysqualify/table_qualify';

$route['m/web/applicant/failed'] = 'crecruit/web/failed/sysfailed';
	$route['web/table/failed'] = 'crecruit/web/failed/sysfailed/table_failed';

$route['m/web/applicant/monitoring'] = 'crecruit/web/monitor/sysmonitor';
	$route['web/table/monitoring'] = 'crecruit/web/monitor/sysmonitor/table_monitor';

$route['m/web/applicant/pre_election'] = 'crecruit/web/pre_election/syspre_election';

$route['m/web/applicant/agreement'] = 'crecruit/web/agree/sysagreement';

$route['m/web/master/skill'] = 'cmaster/sysskill/master_skill';
	$route['web/table/master_skill'] = 'cmaster/sysskill/table_master_skill';

$route['m/web/master/condition'] = 'cmaster/syscondition/master_condition';
	$route['web/table/master_cond'] = 'cmaster/syscondition/table_master_condition';

$route['m/web/master/certificate'] = 'cmaster/syscertificate/master_certificate';
	$route['web/table/master_cert'] = 'cmaster/syscertificate/table_master_certificate';

$route['m/web/master/pic'] = 'cmaster/syspic/master_pic';

$route['m/web/master/department'] = 'cmaster/sysdept/master_department';

// - FORMULIR
$route['form/detail/applicant/(:any)'] = 'crecruit/manual/applicant/sysdetail/detail_applicant/$1';
	$route['form/edit/personal'] = 'crecruit/manual/applicant/sysapplicant/save_edit_personal';
	$route['form/edit/address'] = 'crecruit/manual/applicant/sysapplicant/save_edit_address';
	$route['form/edit/lisence'] = 'crecruit/manual/applicant/sysapplicant/save_edit_lisence';
	$route['form/add/lisence'] = 'crecruit/manual/applicant/sysapplicant/save_add_lisence';
	$route['form/edit/experience'] = 'crecruit/manual/applicant/sysapplicant/save_edit_experience';
	$route['form/add/experience'] = 'crecruit/manual/applicant/sysapplicant/save_add_experience';
	$route['form/edit/skill'] = 'crecruit/manual/applicant/sysapplicant/save_edit_skill';
	$route['form/add/skill'] = 'crecruit/manual/applicant/sysapplicant/save_add_skill';
	$route['form/delete/(:any)'] = 'crecruit/manual/applicant/sysapplicant/$1';

$route['form/detail/interview/(:any)'] = 'crecruit/manual/interview/sysdetail/detail_interview/$1';
	$route['form/edit/applied'] = 'crecruit/manual/interview/sysinterview/save_edit_melamar';
	$route['form/edit/blacklist'] = 'crecruit/manual/interview/sysinterview/save_edit_blacklist';
	$route['form/edit/documents'] = 'crecruit/manual/interview/sysinterview/save_edit_berkas';
	$route['form/edit/hrd_teknis'] = 'crecruit/manual/interview/sysinterview/save_edit_hrd_teknis';
	$route['form/edit/theory'] = 'crecruit/manual/interview/sysinterview/save_edit_teori';
	$route['form/edit/practice'] = 'crecruit/manual/interview/sysinterview/save_edit_praktek';
	$route['form/edit/medical'] = 'crecruit/manual/interview/sysinterview/save_edit_mcu';

$route['form/start/interview/(:any)'] = 'crecruit/manual/interview/sysinterview/step_interview/$1';
	$route['form/add/interview'] = 'crecruit/manual/interview/sysinterview/save_add_interview';

$route['m/form/applicant/all'] = 'crecruit/manual/applicant/sysapplicant';
	$route['form/table/applicant'] = 'crecruit/manual/applicant/sysapplicant/table_applicant';
	$route['form/add/applicant'] = 'crecruit/manual/applicant/sysapplicant/add_applicant';
	$route['form/remove/applicant'] = 'crecruit/manual/applicant/sysapplicant/delete_applicant';
	$route['form/check/idnumber'] = 'crecruit/manual/applicant/sysapplicant/check_noktp';
	$route['form/sadd/applicant'] ='crecruit/manual/applicant/sysapplicant/save_add_applicant';

$route['m/form/applicant/failed'] = 'crecruit/manual/failed/sysfailed';
	$route['form/table/failed'] = 'crecruit/manual/failed/sysfailed/table_applicant_failed';
	$route['form/re/interview'] = 'crecruit/manual/interview/sysinterview/reinterview';

$route['m/form/applicant/medical'] = 'crecruit/manual/medical/sysmedical';
	$route['form/add/medical'] = 'crecruit/manual/medical/sysmedical/save_decision_mcu';
	$route['form/table/medical'] = 'crecruit/manual/medical/sysmedical/table_applicant_medical';

$route['default_controller']   = 'syslogin';
$route['404_override']         = 'syserror';
$route['translate_uri_dashes'] = FALSE;
