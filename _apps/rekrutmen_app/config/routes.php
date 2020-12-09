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

// DAFTAR
$route['registration']        = 'sysdaftar';
$route['registration/(:any)'] = 'sysdaftar/$1';

// FORGOT
$route['forgot/password'] = 'sysforgot';

// LOGIN
$route['login']        = 'syslogin/login';
$route['authenticate'] = 'syslogin/check_login';

// LOGOUT
$route['account/logout'] = 'account/cdashboard/sysaccount/logout';

// PASSWORD
$route['account/save_new_password'] = 'account/csetting/sysconfig/save_new_password';
$route['account/config']            =  'account/csetting/sysconfig';
$route['account/config/(:any)']     = 'account/csetting/sysconfig/$1';

// STATUS LAMARAN
$route['account/vacancy/status'] = 'account/clamaran/syslamaran';

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
$route['photo_profile'] = 'account/cdashboard/sysaccount/photo_profile';
$route['save_edit_bio'] = 'account/cdashboard/sysaccount/save_edit_bio';

// ADDRESS
$route['save_edit_address_ktp']      = 'account/cdashboard/sysaddress/save_edit_address1';
$route['save_edit_address_domisili'] = 'account/cdashboard/sysaddress/save_edit_address2';

// EDUCATION FORMAL/INFORMAL
$route['edu/(:any)']          = 'account/cdashboard/syseducation/$1';
$route['save_edit_eduformal'] = 'account/cdashboard/syseducation/save_edit_eduformal';
$route['save_add_informal']   = 'account/cdashboard/syseducation/save_add_informal';
$route['save_edit_informal']  = 'account/cdashboard/syseducation/save_edit_informal';

// KTP & SIM
$route['lisence/show/(:any)']  = 'account/cdashboard/syslisence/show_lisence/$1';
$route['lisence/save_add_sim'] = 'account/cdashboard/syslisence/save_add_sim';

// ALL DATATABLE
$route['table_lisence']  = 'account/cdashboard/syslisence/table_lisence';
$route['table_skill']    = 'account/cdashboard/sysxpertise/table_skill';
$route['table_informal'] = 'account/cdashboard/syseducation/table_informal';
$route['table_ijazah']   = 'account/cdashboard/syseducation/table_ijazah';
$route['table_job']      = 'account/cdashboard/sysjobhistory/table_job';

$route['default_controller']   = 'syshome';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;
