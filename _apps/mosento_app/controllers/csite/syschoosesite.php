<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syschoosesite extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null) {
                redirect('login');
            }
            $this->load->model(['msite/mod_choose_site']);
        }

        public function choose_site(){
            $data = array(
                'header'      => 'pages/ext/header',
                'footer'      => 'pages/ext/footer',
                // 'stpass'      => $this->mod_global->get_change_password($this->session->userdata('id_user')),
                'list_site'   => $this->mod_choose_site->list_site(),
                'css_script'  => array(
                    '<link rel ="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                ),
                'js_script'   => array(
                    '<script type ="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                )
            );
        	$this->load->view('pages/psite/vchoose_site', $data);
        }

        public function logout(){
            $this->session->unset_userdata('nik');
            $this->session->unset_userdata('status_active');
            $this->session->unset_userdata('fullname');
            $this->session->unset_userdata('id_level');
            $this->session->unset_userdata('id_user');
            $this->session->unset_userdata('level_name');
            session_destroy();
            ob_clean();
            redirect('login');
        }
    }
?>