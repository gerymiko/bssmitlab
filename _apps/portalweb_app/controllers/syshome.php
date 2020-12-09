<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syshome extends CI_Controller {

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') != null && $this->session->userdata('nik') != null) {
                redirect('m/dashboard');
            }
            $this->session->userdata('id_user') == null;
            $this->session->userdata('nik') == null;
            $this->load->model(['mhome/mod_home']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9-_.]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function index(){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'content' => 'pages/phome/vhome',
                'css_script' => array(),
                'js_script'  => array()
            );
        	$this->load->view('pages/pindex/index', $data);
        }

    }
?>