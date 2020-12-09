<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'sa',
	'password' => '123',
	'database' => 'PORTAL',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt'  => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

// SERVER
// $db['default'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'EPROCBSS',
// 	'username' => 'web',
// 	'password' => 'p5dmm1L3n14L',
// 	'database' => 'WEB_RECRUITMENT',
// 	'dbdriver' => 'sqlsrv',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => FALSE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

// $db['web'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'EPROCBSS',
// 	'username' => 'web',
// 	'password' => 'p5dmm1L3n14L',
// 	'database' => 'WEB',
// 	'dbdriver' => 'sqlsrv',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => FALSE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

// $db['hrd'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'EPROCBSS',
// 	'username' => 'web',
// 	'password' => 'p5dmm1L3n14L',
// 	'database' => 'HRD',
// 	'dbdriver' => 'sqlsrv',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => FALSE,
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );

// $db['web1'] = array(
//  	'dsn'	=> '',
//  	'hostname' => 'EPROCBSS',
//  	'username' => 'web',
//  	'password' => 'p5dmm1L3n14L',
//  	'database' => 'WEB_1',
//  	'dbdriver' => 'sqlsrv',
//  	'dbprefix' => '',
//  	'pconnect' => FALSE,
//  	'db_debug' => FALSE,
//  	'cache_on' => FALSE,
//  	'cachedir' => '',
//  	'char_set' => 'utf8',
//  	'dbcollat' => 'utf8_general_ci',
//  	'swap_pre' => '',
//  	'encrypt' => FALSE,
//  	'compress' => FALSE,
//  	'stricton' => FALSE,
//  	'failover' => array(),
//  	'save_queries' => TRUE
// );

$db['sms'] = array(
	'dsn'          => '',
	'hostname'     => 'smd.binasaranasukses.com',
	'username'     => 'smsgw',
	'password'     => 'smscl0ud',
	'database'     => 'MM',
	'dbdriver'     => 'sqlsrv',
	'dbprefix'     => '',
	'pconnect'     => FALSE,
	'db_debug'     => FALSE,
	'cache_on'     => FALSE,
	'cachedir'     => '',
	'char_set'     => 'utf8',
	'dbcollat'     => 'utf8_general_ci',
	'swap_pre'     => '',
	'encrypt'      => FALSE,
	'compress'     => FALSE,
	'stricton'     => FALSE,
	'failover' 	   => array(),
	'save_queries' => TRUE
);