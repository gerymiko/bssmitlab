<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') !== null && $this->session->userdata('username') !== null) {
                redirect('home');
            }
            $this->load->model(['mlogin/Mod_login', 'mglobal/Mod_global']);
        }

        public function auth_login(){
            $username   = $this->security->xss_clean($this->input->post('username'));
            $password   = $this->security->xss_clean($this->input->post('password'));
            $check_user = $this->mod_login->check_login($username, $password);
            if($check_user !== false){
                $sessionData = array(
                    'username' => $check_user['username'],
                    'fullname' => $check_user['fullname'],
                    'id_user'  => $check_user['id_user'],
                    'id_desa'  => $check_user['id_desa']
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['status'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">Akun telah ditangguhkan<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    $data = array(
                        'timestamp' => date('Y-m-d H:i:s'),
                        'ip'        => $this->input->ip_address()
                    );
                    $update_status = $this->mod_login->update_last_login($check_user['id_user'], $data);
                    if ($update_status == true) {
                        $dataLogs = array(
                            'logs_date'     => date('Y-m-d H:i:s'),
                            'logs_ip'       => $this->input->ip_address(),
                            'logs_activity' => 'Melakukan login',
                            'logs_id_user'  => $check_user['id_user'],
                            'logs_username' => $check_user['username'],
                            'logs_fullname' => $check_user['fullname']
                        );
                        $this->mod_global->insert_data('logs', $dataLogs);
                        $validator['success']  = true;  
                        $validator['redirect'] = base_url('home');
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