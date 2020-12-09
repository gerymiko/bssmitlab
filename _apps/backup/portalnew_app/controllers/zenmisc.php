<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Zenmisc extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mod_hr_global']);
        }

        public function index(){
            $users = $this->session->userdata('users_id');
            $data = array(
                'sheader'      => 'pages/ext/sheader',
                'sfooter'      => 'pages/ext/sfooter',
                'main_menu'    => 'pages/public/public_menu',
                'sidebar_menu' => 'pages/misc/vsidebar/sidebar_menu',
                'detailuser'   => $this->mod_hr_global->detailuser($users),
            );
            $this->load->view('pages/misc/index', $data);
        }
    }
?>