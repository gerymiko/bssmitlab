<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprivilege extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('syslogin');
            }
            $this->load->model(['mprivilege/mod_privilege','mglobal/mod_global']);
            ob_start();
        }

        public function index(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/pprivilege/view',
            );
            $this->load->view('pages/pindex/index', $data);
        }
    }
?>