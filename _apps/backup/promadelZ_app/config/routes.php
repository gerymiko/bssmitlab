<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['s_url/(:any)'] = 'syslink/$1';

$route['anmeldung'] = 'clogin/syslogin';
$route['anmeldung/check'] = 'clogin/syslogin/auth_login';
$route['home']      = 'syshome';
$route['about']     = 'cabout/sysabout';
$route['contact']   = 'ccontact/syscontact';
$route['feature']   = 'cfeature/sysfeature';
$route['faq']       = 'cinfo/sysfaq';
$route['news']      = 'cinfo/sysnews';

// AFTER LOGIN
$route['account/ausloggen'] = 'account/caccount/sysaccount/ausloggen';
$route['forum']     = 'account/cforum/sysforum';
$route['bio']       = 'account/caccount/sysaccount';

$route['default_controller']   = 'syshome';
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;
