<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysinvoice extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_TIKET_VENDOR') {
                redirect('syslogin');
            }
            $this->load->model([ 'mglobal/mod_hr_global' ]);
            $this->output->enable_profiler(false);
        }

        public function index(){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/pinvoice/vinvoice'
        	);
        	$this->load->view('pages/pindex/vindex', $data);
        }

    }
?>