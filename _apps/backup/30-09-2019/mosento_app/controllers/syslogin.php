<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('nik') !== null) {
                redirect('dashboard');
            }
            $this->session->userdata('nik') == null;
            $this->load->model(['mlogin/mod_login', 'mglobal/mod_global']);
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
            $nik        = $this->security->xss_clean($this->pregRepn($this->input->post('nik')));
            $password   = $this->security->xss_clean($this->input->post('password'));
            $check_user = $this->mod_login->check_login($nik, $password);

            if($check_user !== false){
                $sessionData = array(
                    'nik'     => $check_user['nik'],
                    'status'  => $check_user['status'],
                    'nama'    => $check_user['nama'],
                    'level'   => $check_user['id_level'],
                    'tipeapp' => 'MOSENTO'
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['status'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">Account has been suspended<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    $data = array(
                        'is_login'     => 1,
                        'login_date'   => date('Y-m-d H:i:s'),
                        'login_update' => date('Y-m-d H:i:s'),
                        'last_ip'      => $this->input->ip_address(),
                    );
                    $update_status = $this->mod_login->update_last_login($check_user['nik'], $data);
                    if ($update_status == true) {
                        $datalogs = array(
                            'logs_tanggal'    => date('Y-m-d H:i:s'),
                            'logs_ip'         => $this->input->ip_address(),
                            'logs_modul'      => 'Login',
                            'logs_aktifitas'  => 'Melakukan Login',
                            'logs_keterangan' => 'Login ke halaman website',
                            'logs_user_id'    => $check_user['nik'],
                            'logs_username'   => $check_user['username'],
                            'logs_user_name'  => $check_user['nama'],
                            'logs_website'    => 'MOSENTO'
                        );
                        $this->mod_global->insert_all('web_logs', $datalogs);
                        $validator['success']  = true;  
                        $validator['redirect'] = base_url('dashboard');
                    }
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = '<p class="alert alert-danger"><b>Oops!</b> Wrong username or password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';  
            }
            echo json_encode($validator);
        }

    }
?>