<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['s_url/(:any)'] = 'syslink/$1';

// LOGIN
$route['myaccount'] = 'account/cdashboard/sysaccount';

// BERANDA
$route['home']         = 'syshome';
$route['account/home'] = 'account/chome/syshomepage';

// LOKER
$route['vacancy']                              = 'sysloker';
$route['vacancy/(:any)']                       = 'sysloker/$1';
$route['account/vacancy']                      = 'account/cloker/sysvacancy';
$route['account/vacancy/(:any)']               = 'account/cloker/sysvacancy/$1';
$route['vacancy/detail/(:any)/(:any)']         = 'cdetail/sysdloker/detail_loker/$1/$1';
$route['account/vacancy/detail/(:any)/(:any)'] = 'account/cdetail/sysdetail/detail_loker/$1/$1';

// LAMARAN
$route['account/application/status'] = 'account/clamaran/syslamaran';
$route['account/apply_job']          = 'account/clamaran/syslamaran/apply_job';
$route['account/decline_job']        = 'account/clamaran/syslamaran/delete_application';

// DAFTAR
$route['registration']        = 'sysdaftar';
$route['registration/(:any)'] = 'sysdaftar/$1';

// FORGOT
$route['forgot/password']        = 'sysforgot';
$route['for/p/validate/(:any)']  = 'sysforgot/validate/$1';
$route['forgot/password/(:any)'] = 'sysforgot/$1';

// LOGIN
$route['login']        = 'syslogin/login';
$route['authenticate'] = 'syslogin/check_login';

// LOGOUT
$route['account/logout'] = 'account/cdashboard/sysaccount/logout';

// PASSWORD
$route['account/snew_password'] = 'account/csetting/sysconfig/save_new_password';
$route['account/config']        = 'account/csetting/sysconfig';
$route['account/config/(:any)'] = 'account/csetting/sysconfig/$1';

// INFORMATION
$route['information/about']    = 'cinfo/sysabout';
$route['information/election'] = 'cinfo/syselection';
$route['information/notice']   = 'cinfo/sysnotice';
$route['information/help']     = 'cinfo/sysfaq';
$route['information/cookie']   = 'cinfo/syscookies';
$route['information/privacy']  = 'cinfo/sysprivacy';

$route['account/information/about']    = 'account/cinfo/sysabout';
$route['account/information/election'] = 'account/cinfo/syselection';
$route['account/information/notice']   = 'account/cinfo/sysnotice';
$route['account/information/help']     = 'account/cinfo/sysfaq';

// AKUN
$route['account/sadd_photo']    = 'account/cdashboard/sysaccount/save_add_photo';
$route['account/photo_profile/(:any)'] = 'account/cdashboard/sysaccount/photo_profile/$1';
$route['account/sedit_bio']     = 'account/cdashboard/sysaccount/save_edit_bio';

// SKILL
$route['account/get_skill']    = 'account/cdashboard/sysxpertise/get_skill';
$route['account/sadd_skill']   = 'account/cdashboard/sysxpertise/save_add_skill';
$route['account/delete_skill'] = 'account/cdashboard/sysxpertise/delete_skill';


// ADDRESS
$route['account/sedit_address_ktp']      = 'account/cdashboard/sysaddress/save_edit_address1';
$route['account/sedit_address_domisili'] = 'account/cdashboard/sysaddress/save_edit_address2';
$route['account/tab_address']            = 'account/cdashboard/sysaddress/tab_address';

// EDUCATION FORMAL/INFORMAL
$route['edu/(:any)']              = 'account/cdashboard/syseducation/$1';
$route['account/sedit_eduformal'] = 'account/cdashboard/syseducation/save_edit_eduformal';
$route['account/sadd_informal']   = 'account/cdashboard/syseducation/save_add_informal';
$route['account/sedit_informal']  = 'account/cdashboard/syseducation/save_edit_informal';
$route['account/tab_education']   = 'account/cdashboard/syseducation/tab_education';
$route['account/tab_ijazah']      = 'account/cdashboard/syseducation/tab_ijazah';
$route['account/delete_informal'] = 'account/cdashboard/syseducation/delete_informal';
$route['account/sadd_ijazah']     = 'account/cdashboard/syseducation/save_add_ijazah';
$route['account/show/ijazah/(:any)'] = 'account/cdashboard/syseducation/show_ijazah/$1';


// KTP & SIM
$route['lisence/show/(:any)']     = 'account/cdashboard/syslisence/show_lisence/$1';
$route['account/sadd_sim']        = 'account/cdashboard/syslisence/save_add_sim';
$route['account/supload_lisence'] = 'account/cdashboard/syslisence/save_upload_lisence';
$route['account/tab_lisence']     = 'account/cdashboard/syslisence/tab_lisence';

// CERTIFICATE
$route['account/tab_certificate']         = 'account/cdashboard/syscertificate/tab_certificate';
$route['account/show_certificate/(:any)'] = 'account/cdashboard/syscertificate/show_certificate/$1';
$route['account/sadd_certificate']        = 'account/cdashboard/syscertificate/save_add_certificate';
$route['account/delete_certificate']      = 'account/cdashboard/syscertificate/delete_certificate';


// EXPERIENCE
$route['account/tab_experience'] = 'account/cdashboard/sysjobhistory/tab_experience';
$route['account/sadd_job']       = 'account/cdashboard/sysjobhistory/save_add_job';
$route['account/supload_job']    = 'account/cdashboard/sysjobhistory/save_upload_job';
$route['account/delete_job']     = 'account/cdashboard/sysjobhistory/delete_job';
$route['account/sedit_job']      = 'account/cdashboard/sysjobhistory/save_edit_job';

// ALL DATATABLE
$route['table_lisence']     = 'account/cdashboard/syslisence/table_lisence';
$route['table_skill']       = 'account/cdashboard/sysxpertise/table_skill';
$route['table_informal']    = 'account/cdashboard/syseducation/table_informal';
$route['table_ijazah']      = 'account/cdashboard/syseducation/table_ijazah';
$route['table_certificate'] = 'account/cdashboard/syscertificate/table_certificate';
$route['table_job']         = 'account/cdashboard/sysjobhistory/table_job';
$route['table_lamaran']		= 'account/clamaran/syslamaran/table_lamaran';
$route['table_peserta']		= 'cinfo/sysnotice/table_peserta';


$route['default_controller']   = 'syshome';
$route['404_override']         = 'syserror';
$route['translate_uri_dashes'] = FALSE;
