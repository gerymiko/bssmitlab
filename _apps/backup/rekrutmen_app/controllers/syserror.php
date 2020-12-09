<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syserror extends CI_Controller {

        function __construct() {
            parent::__construct();
        }

        public function index(){
        	$this->output->set_status_header('404');
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer'
        	);
        	$this->load->view('pages/pinfo/v404', $data);
        }

    }
?>