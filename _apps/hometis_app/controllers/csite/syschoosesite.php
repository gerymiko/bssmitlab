<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syschoosesite extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null) {
                redirect('logisisse');
            }
            $this->load->model(['msite/mod_choose_site', 'mglobal/mod_global']);
        }

        public function choose_site(){
            $data = array(
                'header'      => 'pages/ext/header',
                'footer'      => 'pages/ext/footer',
                'stpass'      => $this->mod_global->get_change_password($this->session->userdata('id_user')),
                'list_site'   => $this->mod_choose_site->list_site(),
                'css_script'  => array(
                    '<link rel ="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                    '<link rel ="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">'
                ),
                'js_script'   => array(
                    '<script type ="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                    '<script type ="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>'
                )
            );
        	$this->load->view('pages/psite/vchoose_site', $data);
        }

        public function logivout(){
            // $nik  = $this->session->userdata('nik');
            // $data = array( 'is_login' => 0, 'login_update' => date("Y-m-d H:i:s"), 'last_ip' => $this->input->ip_address() );
            // $this->mod_login->update_last_login($nik, $data);
            $this->session->unset_userdata('NIK');
            $this->session->unset_userdata('status_active');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('last_ip');
            $this->session->unset_userdata('id');
            session_destroy();
            ob_clean();
            redirect('logisisse');
        }
    }
?>