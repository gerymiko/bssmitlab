<?php defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'sa',
	'password' => '123',
	'database' => 'HOMETIS',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => FALSE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

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