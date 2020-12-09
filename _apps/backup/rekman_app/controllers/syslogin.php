<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model(['mlogin/mod_karir_login']);
        }

        function check_login(){
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));

            $user = $this->mod_karir_login->checkLogin($username, $password);

            if(!empty($user)){
                $sessionData = array(
                    'username'  => $user['username'],
                    'people_id' => $user['people_id'],
                    'active'    => $user['active'],
                    'tipeapp'   => 'WEB_KARIR',
                    'is_login'  => 1
                );
                $this->session->set_userdata($sessionData);
                if ($user['active'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">Akun anda telah dinon-aktifkan. Hubungi admin kami.<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    $data = array(
                        'date_login' => date('Y-m-d H:i:s'),
                        'last_ip'    => $this->input->ip_address(),
                        'last_login' => date('Y-m-d H:i:s'),
                        'is_login'   => '1'
                    );
                    $this->mod_karir_login->updateLastLogin($user['username'], $data);
                    $validator['success']  = true;  
                    $validator['redirect'] = base_url('myaccount');
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = '<p class="alert alert-danger"><b>Oops!</b> Username atau Password salah <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';  
            }
            echo json_encode($validator);
        }

        public function login(){
            if (isset($_SERVER['HTTP_COOKIE'])) {
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                foreach($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name  = trim($parts[0]);
                    setcookie($name, '', time()-1000);
                    setcookie($name, '', time()-1000, '/');
                }
            }
            $data = array(
                'sheader' => 'pages/ext/header',
                'sfooter' => 'pages/ext/footer'
            );
            $this->load->view('pages/psign/vlogin', $data);
        }

    }
?>