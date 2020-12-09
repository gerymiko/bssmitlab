<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->session->userdata('username') == null;
            $this->load->model(['mlogin/mod_ulogin']);
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
            );
        	$this->load->view('pages/plogin/vlogin', $data);
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function auth_login(){
            $nik       = $this->security->xss_clean($this->pregRepn($this->input->post('nik')));
            $password  = $this->security->xss_clean($this->pregRepn($this->input->post('password')));

            if ($nik !== $password) {
                $validator['success'] = false;
                $validator['message'] = '<p class="alert alert-danger"><b>Oops!</b> Username atau Password salah <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
            }
            
            $check_nik = $this->mod_ulogin->check_login($nik, $password);

            if($check_nik !== false){
                $sessionData = array(
                    'NIK'     => $check_nik['NIK'],
                    'AKTIF'   => $check_nik['AKTIF'],
                    'Nama'    => $check_nik['Nama'],
                    'tipeapp' => 'HR_USER'
                );
                $this->session->set_userdata($sessionData);
                if ($check_nik['AKTIF'] == 1) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">NON-AKTIF AKUN<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    // $data = array(
                    //     'date_login' => date('Y-m-d H:i:s'),
                    //     'last_ip'    => $this->input->ip_address(),
                    //     'last_login' => date('Y-m-d H:i:s'),
                    //     'is_login'   => '1'
                    // );
                    // $this->mod_login->updateLastLogin($user['username'], $data);
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