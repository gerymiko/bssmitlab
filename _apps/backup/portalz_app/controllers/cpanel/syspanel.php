<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspanel extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('bssID') == null) {
                redirect('logisisse');
            } else {
                $this->accessRights = $this->mod_global->get_detailed_user($this->session->userdata('users_id'));
                if ($this->accessRights==null) {
                    show_404('', false);
                }
            }
            $this->load->model(['mpanel/mod_panel']);
            ob_start();
        }

        public function dashboard(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'content'  => 'pages/ppanel/vpanel',
                'accessRights' => $this->accessRights,
                'css_script' => array(),
                'js_script'  => array(),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function logout(){
            $this->session->unset_userdata('users_fullname');
            $this->session->unset_userdata('users_username');
            $this->session->unset_userdata('bssID');
            $this->session->unset_userdata('users_status');
            $this->session->unset_userdata('level_id');
            $this->session->unset_userdata('users_id');
            session_destroy();
            ob_clean();
            redirect('https://localhost/portal/');
        }

    }
?>
