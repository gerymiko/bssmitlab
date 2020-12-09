<?php defined('BASEPATH') OR exit('No direct script access allowed');

	date_default_timezone_set('Asia/Makassar');

	$autoload['packages']  = array();

	$autoload['libraries'] = array('database', 'session', 'form_validation', 'pagination', 'encrypt', 'upload', 'email');

	$autoload['drivers']   = array();

	$autoload['helper']    = array('url', 'html', 'form', 'cookie', 'file', 'array');

	$autoload['config']    = array();

	$autoload['language']  = array();

	$autoload['model']     = array('mlogin/mod_vlogin');

?>
