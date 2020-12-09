<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syssite extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['msite/mod_site']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9-_.]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function index(){
            $data = array(
                'header' => 'pages/ext/logheader',
                'footer' => 'pages/ext/logfooter',
                'list_site' => $this->mod_site->list_site(),
                'css_script' => array(),
                'js_script' => array(),
            );
        	$this->load->view('pages/psite/vsite', $data);
        }

        public function go_to_site(){
            $site = $this->security->xss_clean($this->pregReps($this->input->post('site')));
            if($site !== '' || $site !== null){
                $validator['success']  = true; 
                $validator['redirect'] = base_url('reports/pica/').$site;
            } else {
                $validator['success'] = false;
                $validator['message'] = 'Salah site!';  
            }
            echo json_encode($validator);
        }

    }
?>