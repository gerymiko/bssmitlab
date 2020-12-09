<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysforgot extends CI_Controller {

        function __construct() {
            parent::__construct();
        }

        public function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu' 	  => 'pages/pcomp/vmenu',
                'content' => 'pages/pforgot/vforgot',
                'footer'  => 'pages/pcomp/vfooter'
        	);
        	$this->load->view('pages/index', $data);
        }

    }
?>