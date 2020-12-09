<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['getimage/jpg/(:any)'] = 'syslink/get_image_jpg/$1';
$route['getimage/png/(:any)'] = 'syslink/get_image_png/$1';
$route['getlogo/png/(:any)'] = 'syslink/get_logo_png/$1';

// LOGIN
$route['logisisse'] = 'syslogin';
$route['check/authentication'] = 'syslogin/auth_login';
$route['m/logivalja'] = 'cpanel/syspanel/logout';

// WELCOME
$route['m/welcome'] = 'cwelcome/syswelcome/welcome';

// DASHBOARD
$route['m/dashboard'] = 'cpanel/syspanel/dashboard';

$route['default_controller']   = 'syshome';
$route['404_override']         = 'syserror';
$route['translate_uri_dashes'] = FALSE;
