<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspanel extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mpanel/mod_panel','mglobal/mod_global']);
            ob_start();
        }

        public function index(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/ppanel/vpanel',
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function logout(){
            $users = $this->session->userdata('users_id');
            $data  = array( 'is_login' => 0, 'last_login' => date("Y-m-d H:i:s"), 'last_ip' => $this->input->ip_address() );
            $this->mod_login->update_last_login($users, $data);
            $this->session->unset_userdata('users_fullname');
            $this->session->unset_userdata('users_username');
            $this->session->unset_userdata('bssID');
            $this->session->unset_userdata('users_status');
            $this->session->unset_userdata('tipeapp');
            $this->session->unset_userdata('level_id');
            session_destroy();
            ob_clean();
            redirect('logisisse');
        }

    }
?>
