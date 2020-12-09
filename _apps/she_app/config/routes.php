<?php defined('BASEPATH') OR exit('No direct script access allowed');

// SCRIPT FILE LINK
$route['getimage/jpg/(:any)'] = 'syslink/get_image_jpg/$1';
$route['getimage/png/(:any)'] = 'syslink/get_image_png/$1';

$route['goto/reports'] = 'syssite/go_to_site';

$route['reports/pica/(:any)'] = 'syshome/reports_she/$1';
$route['search/result/(:any)/(:any)/(:any)'] = 'syshome/search_result/$1';
$route['search/results/(:any)/(:any)/(:any)/(:any)'] = 'syshome/search_result/$1';
$route['table/result/(:any)/(:any)/(:any)'] = 'syshome/table_result/$1';
$route['table/results/(:any)/(:any)/(:any)/(:any)'] = 'syshome/table_result/$1';
$route['result/detail/(:any)/(:any)'] = 'syshome/detail_result/$1';
$route['table/detail_result/(:any)/(:any)'] = 'syshome/table_detail_result/$1';

$route['default_controller']   = 'syssite';
$route['404_override']         = 'syserror';
$route['translate_uri_dashes'] = FALSE;
