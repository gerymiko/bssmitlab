<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syshome extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->session->userdata('username') == null;
            // $this->load->model(['mhome/mod_karir_home']);
        }

        public function index(){
        	// $data = array(
        	// 	'sheader' => 'pages/ext/header',
        	// 	'sfooter' => 'pages/ext/footer',
        	// 	'menu' 	  => 'pages/pcomp/vmenu',
         //        'content' => 'pages/pmain/vmain',
         //        'footer'  => 'pages/pcomp/vfooter'
        	// );
        	$this->load->view('pages/index');
        }

    }
?>