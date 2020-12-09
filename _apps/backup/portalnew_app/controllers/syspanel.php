<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspanel extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('https://web.binasaranasukses.com/portal');
            }
            $this->load->model(['mod_login','hrDept/mod_hr_global']);
            $this->dtf_default = date("Y-m-d H:i:s");
        }

        public function index(){
            $users = $this->session->userdata('users_id');
            $data = array(
                'sheader'    => 'pages/ext/sheader',
                'sfooter'    => 'pages/ext/sfooter',
                'main_menu'  => 'pages/public/public_menu',
                'content'    => 'pages/public/public_home',
                'detailuser' => $this->mod_hr_global->detailuser($users),
            );
            $this->load->view('pages/index', $data);
        }

        function logout(){
            $user = $this->session->userdata('users_id');
            $data = array(
                'is_login'   => '0',
                'last_login' => $this->dtf_default,
            );
            $this->mod_login->isLogin($user,$data);
            $this->session->unset_userdata('users_id');
            session_destroy();
            redirect('');
        }
    }
?>