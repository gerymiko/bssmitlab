<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('users_id') != null && $this->session->userdata('bssID') != null) {
                redirect('m/dashboard');
            }
            $this->session->userdata('users_id') == null;
            $this->session->userdata('bssID') == null;
            $this->load->model(['mlogin/mod_login']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function index(){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'css_script' => array(),
                'js_script'  => array()
            );
        	$this->load->view('pages/plogin/vlogin', $data);
        }

        public function auth_login(){
            $nik = $this->security->xss_clean($this->pregRepn($this->input->post('nik')));
            $password   = $this->security->xss_clean($this->pregReps($this->input->post('password')));
            $check_user = $this->mod_login->check_login('bssID', $nik, $password);
            if($check_user !== false){
                $sessionData = array(
                    'username' => $check_user['users_username'],
                    'fullname' => $check_user['users_fullname'],
                    'bssID'    => $check_user['bssID'],
                    'users_id' => $check_user['users_id'],
                    'level_id' => $check_user['level_id'],
                    'status'   => $check_user['users_status']
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['users_status'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">Akun telah ditangguhkan<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    $data = array(
                        'date_login' => date('Y-m-d H:i:s'),
                        'ip_address' => $this->input->ip_address()
                    );
                    $update_status = $this->mod_global->edit_web1('users_id', $check_user['users_id'], 'users', $data);
                    if ($update_status == true) {
                        $datalogs = array(
                            'logs_tanggal'    => date('Y-m-d H:i:s'),
                            'logs_ip'         => $this->input->ip_address(),
                            'logs_modul'      => 'LOGIN',
                            'logs_aktifitas'  => 'Login',
                            'logs_keterangan' => 'Login website',
                            'logs_user_id'    => $check_user['users_id'],
                            'logs_username'   => $check_user['users_username'],
                            'logs_user_name'  => $check_user['users_fullname'],
                            'logs_website'    => 'PORTAL'
                        );
                        $this->mod_global->insert_web1('web_logs', $datalogs);
                        $validator['success']  = true;  
                        $validator['redirect'] = base_url('m/welcome');
                    }
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = '<p class="alert alert-danger"><b>Oops!</b> Username atau password salah<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';  
            }
            echo json_encode($validator);
        }

    }
?>