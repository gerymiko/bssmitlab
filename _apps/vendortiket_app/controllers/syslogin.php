<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->session->userdata('username') == null;
            $this->load->model(['mlogin/mod_vlogin']);
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
            );
        	$this->load->view('pages/plogin/vlogin', $data);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function auth_login(){
            $username = $this->security->xss_clean($this->pregReps($this->input->post('username')));
            $password = $this->security->xss_clean($this->pregReps($this->input->post('password')));

            // if ($nik !== $password) {
            //     $validator['success'] = false;
            //     $validator['message'] = '<p class="alert alert-danger"><b>Oops!</b> Username atau Password salah <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
            //     exit();
            // }
            
            $check_user = $this->mod_vlogin->check_login($username, $password);

            if($check_user !== false){
                $sessionData = array(
                    'users_id'       => $check_user['users_id'],
                    'users_fullname' => $check_user['users_fullname'],
                    'tipeapp'        => 'WEB_TIKET_VENDOR',
                    'is_login'       => 1
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['users_status'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">NON-AKTIF AKUN<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    // $data = array(
                    //     'date_login' => date('Y-m-d H:i:s'),
                    //     'last_ip'    => $this->input->ip_address(),
                    //     'last_login' => date('Y-m-d H:i:s'),
                    //     'is_login'   => '1'
                    // );
                    // $this->mod_tlogin->updateLastLogin($user['username'], $data);
                    $validator['success']  = true;  
                    $validator['redirect'] = base_url('cpanel/syspanel');
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = '<p class="alert alert-danger"><b>Oops!</b> Username atau Password salah <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';  
            }
            echo json_encode($validator);
        }

    }
?>