<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syswelcome extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null) {
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_detailed_user($this->session->userdata('idu'));
                if ($this->accessRights==null) { show_404('', false); }
            }
        }

        public function welcome($site){
            $this->session->set_userdata('site', $site);
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/pwelcome/vwelcome',
                'accessRights' => $this->accessRights,
                'list_site' => $this->mod_global->list_site(),
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
            redirect('login');
        }

    }
?>
