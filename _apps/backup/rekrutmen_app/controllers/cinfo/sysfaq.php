<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfaq extends CI_Controller {

        function __construct() {
            parent::__construct();
            $checkSession = $this->session->set_userdata('username', NULL);
        }

        function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu' 	  => 'pages/pcomp/vmenu',
                'content' => 'pages/pinfo/vhelp',
                'footer'  => 'pages/pcomp/vfooter',
        	);
        	$this->load->view('pages/index', $data);
        }

    }
?>