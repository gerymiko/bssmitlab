<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('users_id') !== null && $this->session->userdata('tipeapp') == 'PORTAL') {
                redirect('menu/dashboard');
            }
            $this->session->userdata('users_id') == null;
            $this->load->model(['mlogin/mod_login', 'mglobal/mod_global']);
        }

        public function index(){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
            );
        	$this->load->view('pages/plogin/vlogin', $data);
        }

        public function auth_login(){
            $nik        = $this->security->xss_clean($this->input->post('nik'));
            $password   = $this->security->xss_clean($this->input->post('password'));
            $check_user = $this->mod_login->check_login($nik, $password);

            if($check_user !== false){
                $sessionData = array(
                    'username' => $check_user['users_username'],
                    'bssID'    => $check_user['bssID'],
                    'fullname' => $check_user['users_fullname'],
                    'last_ip'  => $check_user['last_ip'],
                    'users_id' => $check_user['users_id'],
                    'level_id' => $check_user['level_id'],
                    'tipeapp'  => 'PORTAL'
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['users_status'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">Akun telah ditangguhkan<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    $data = array(
                        'is_login'   => 1,
                        'date_login' => date('Y-m-d H:i:s'),
                        'last_login' => date('Y-m-d H:i:s'),
                        'last_ip'    => $this->input->ip_address()
                    );
                    $update_status = $this->mod_login->update_last_login($check_user['users_id'], $data);
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
                        $validator['redirect'] = base_url('menu/dashboard');
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