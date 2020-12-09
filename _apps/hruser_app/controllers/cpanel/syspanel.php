<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspanel extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('NIK') == null || $this->session->userdata('tipeapp') != 'HR_USER') {
                redirect('syslogin');
            }
            $this->load->model(['mleave/mod_leave']);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function index(){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/phome/vpanel',
        	);
        	$this->load->view('pages/pindex/uindex', $data);
        }

        public function logout(){
            // $people_id = $this->session->userdata('people_id');
            // $data      = array( 'is_login' => '0' );
            // $this->mod_karir_login->changeStatusLogin($people_id, $data);
            $this->session->unset_userdata('Nama');
            $this->session->unset_userdata('NIK');
            $this->session->unset_userdata('AKTIF');
            session_destroy();
            redirect('syslogin');
        }

    }
?>