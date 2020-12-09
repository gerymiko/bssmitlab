<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('nik') !== null && $this->session->userdata('id_user') !== null) {
                redirect('menu/site');
            }
            $this->session->userdata('nik') == null;
            $this->load->model(['mlogin/mod_login', 'mglobal/mod_global']);
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'css_script' => array(),
                'js_script'  => array()
            );
        	$this->load->view('pages/plogin/vlogin', $data);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function auth_login(){
            $nik        = $this->security->xss_clean($this->pregRepn($this->input->post('nik')));
            $password   = $this->security->xss_clean($this->input->post('password'));
            $check_user = $this->mod_login->check_login($nik, $password);
            if($check_user !== false){
                $sessionData = array(
                    'id_user'       => $check_user['id_user'],
                    'id_level'      => $check_user['id_level'],
                    'nik'           => $check_user['nik'],
                    'status_active' => $check_user['status_active'],
                    'fullname'      => $check_user['fullname'],
                    'level_name'    => $check_user['level_name']
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['status_active'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = 'Account has been suspended';
                } else {
                    $datalogs = array(
                        'id_user'    => $check_user['id_user'],
                        'id_module'  => 6,
                        'logs'       => 'Login',
                        'ip_address' => $this->input->ip_address(),
                        'insert_time' => date("Y-m-d H:i:s") 
                    );
                    $this->mod_global->insert_all('mos_user_log', $datalogs);
                    $validator['success']  = true;  
                    $validator['redirect'] = base_url('menu/site');
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = 'Oops! Wrong username or password';  
            }
            echo json_encode($validator);
        }

    }
?>