<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') != null && $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('syslogin');
            }
            $this->load->model(['mod_login']);
        }

        function index(){
            $data = array(
                'header' => 'pages/ext.2/header',
                'footer' => 'pages/ext.2/footer',
            );
            $this->load->view('pages/plogin/vlogin', $data);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        function check_login(){
            $username = $this->pregReps($this->input->post('username'));
            $password = $this->pregReps($this->input->post('password'));

            $user = $this->mod_login->checkLogin($username, $password);
            
            if(!empty($user)){
                $sessionData = array(
                    'username'     => $user['users_username'],
                    'fullname'     => $user['users_fullname'],
                    'last_ip'      => $user['last_ip'],
                    'users_id'     => $user['users_id'],
                    'level_id'     => $user['level_id'],
                    'tipeapp'      => 'WEB_PORTAL',
                    'users_status' => 1,
                );
                $this->session->set_userdata($sessionData);

                if ($user['users_status'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<div class="alert alert-danger text-center">
                                                <h5><b>Oh Snap!</b> Akun ini telah di non-aktifkan. Mohon menghubungi administrator untuk informasi lebih lanjut.</h5>
                                            </div>';
                    $this->session->unset_userdata('users_username');
                    $this->session->unset_userdata('users_password');
                    session_destroy();
                    $validator['redirect'] = base_url('syslogin');
                } else {
                    $data = array(
                        'date_login' => date('Y-m-d H:i:s'),
                        'last_ip'    => $this->input->ip_address(),
                        'is_login'   => '1'
                    );
                    $this->mod_login->updateLastLogin($user['users_username'], $data);
                    $datos = array(
                        'logs_tanggal'    => date('Y-m-d H:i:s'),
                        'logs_ip'         => $this->input->ip_address(),
                        'logs_modul'      => 'LOGIN',
                        'logs_aktifitas'  => 'LOGIN',
                        'logs_keterangan' => 'LOGIN WEB PAGE',
                        'logs_user_id'    => $user['users_id'],
                        'logs_username'   => $user['users_username'],
                        'logs_user_name'  => $user['users_fullname'],
                        'logs_website'    => 'WEB_PORTAL'
                    );
                    $this->mod_login->insertLogs($datos);
                    $validator['success']  = true;  
                    $validator['redirect'] = base_url('syspanel');
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = 'invalid';  
            }
            echo json_encode($validator);
        }   
    }
?>