<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspanel extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'HR_TIKET') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global']);
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
                'content' => 'pages/phome/vpanel'
        	);
        	$this->load->view('pages/pindex/tindex', $data);
        }

        public function logout(){
            // $people_id = $this->session->userdata('people_id');
            // $data      = array( 'is_login' => '0' );
            // $this->mod_karir_login->changeStatusLogin($people_id, $data);
            $this->session->unset_userdata('users_id');
            $this->session->unset_userdata('users_fullname');
            session_destroy();
            redirect('syslogin');
        }

        public function count_submission_staff(){
            $getValue = $this->mod_hr_global->count_submission_staff();
            echo json_encode($getValue);
        }

        public function count_submission_vendor(){
            $getValue = $this->mod_hr_global->count_submission_vendor();
            echo json_encode($getValue);
        }

        public function count_opsional_vendor(){
            $getValue = $this->mod_hr_global->count_opsional_vendor();
            echo json_encode($getValue);
        }

        public function count_ordered_ticket(){
            $getValue = $this->mod_hr_global->count_ordered_ticket();
            echo json_encode($getValue);
        }
    }
?>