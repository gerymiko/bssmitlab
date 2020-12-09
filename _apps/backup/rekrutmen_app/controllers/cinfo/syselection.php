<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syselection extends CI_Controller {

        function __construct() {
            parent::__construct();
        }

        function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu' 	  => 'pages/pcomp/vmenu',
                'content' => 'pages/pinfo/velection',
                'footer'  => 'pages/pcomp/vfooter',
        	);
        	$this->load->view('pages/index', $data);
        }



    }
?>