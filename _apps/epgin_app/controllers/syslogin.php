<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') != null && $this->session->userdata('nik') != null) {
                redirect('cwelcome/syswelcome/welcome');
            }
            $this->session->userdata('idu') == null;
            $this->session->userdata('nik') == null;
            $this->load->model(['mlogin/mod_login']);
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
                'site' => $this->mod_global->list_site(),
                'css_script' => array(),
                'js_script'  => array()
            );
        	$this->load->view('pages/plogin/vlogin', $data);
        }

        public function auth_login(){
            $nik = $this->security->xss_clean($this->pregRepn($this->input->post('nik')));
            $password   = $this->security->xss_clean($this->pregReps($this->input->post('password')));
            $site = $this->security->xss_clean($this->pregReps($this->input->post('site')));
            $check_user = $this->mod_login->check_login($nik, $password, $site);
            if($check_user !== false){
                $sessionData = array(
                    'fullname' => $check_user['fullname'],
                    'nik' => $check_user['nik'],
                    'idu' => $check_user['id_user'],
                    'idl' => $check_user['id_level'],
                    'status' => $check_user['status_active'],
                    'site' => $check_user['site']
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['status_active'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">Akun telah ditangguhkan<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    $datalogs = array(
                        'id_user'   => $check_user['id_user'],
                        'id_module' => 1,
                        'logs'      => 'LOGIN',
                        'ip_address' => $this->input->ip_address()
                    );
                    $this->mod_global->insert_all('mst_user_log', $datalogs);
                    $validator['success']  = true; 
                    $validator['redirect'] = base_url('page/welcome/').$check_user['site'];
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = 'Username, password atau site salah';  
            }
            echo json_encode($validator);
        }

    }
?>