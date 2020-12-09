<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysofficial extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'HR_TIKET') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global']);
        }

        public function official_travel(){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/pofficial/vofficial_travel'
        	);
        	$this->load->view('pages/pindex/tindex', $data);
        }

    }
?>