<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysresign extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('NIK') == null || $this->session->userdata('tipeapp') != 'HR_USER') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global', 'mresign/mod_resign']);
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
            $nik  = $this->pregRepn($this->session->userdata('NIK'));
        	$data = array(
                'header'         => 'pages/ext/header',
                'footer'         => 'pages/ext/footer',
                'sidebar'        => 'pages/psidebar/vsidebar',
                'content'        => 'pages/presign/vresign',
                'dkaryawan'      => $this->mod_hr_global->getDetail_karyawan($nik),
        	);
        	$this->load->view('pages/pindex/uindex', $data);
        }

    }
?>