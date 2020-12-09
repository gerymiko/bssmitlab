<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslogin extends CI_Controller {

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') !== null && $this->session->userdata('NIK') !== null) {
                redirect('menu/site');
            }
            $this->session->userdata('id_user') == null;
            $this->load->model(['mlogin/mod_login', 'mglobal/mod_global']);
        }

        public function index(){
            $data = array(
                'header'     => 'pages/ext/header',
                'footer'     => 'pages/ext/footer',
                'css_script' => array(),
                'js_script'  => array(),
            );
        	$this->load->view('pages/plogin/vlogin', $data);
        }

        public function auth_login(){
            $username   = $this->security->xss_clean($this->input->post('username'));
            $password   = $this->security->xss_clean($this->input->post('password'));
            $check_user = $this->mod_login->check_login($username, $password);
            if($check_user !== false){
                $sessionData = array(
                    'id_user'        => $check_user['id_user'],
                    'fullname'       => $check_user['fullname'],
                    'NIK'            => $check_user['NIK'],
                    'status_account' => $check_user['status_account'],
                    'id_module'      => $check_user['id_module'],
                    'id_level'       => $check_user['id_level'],
                    'level_name'     => $check_user['level_name']
                );
                $this->session->set_userdata($sessionData);
                if ($check_user['status_account'] == 0) {
                    $validator['success'] = false;
                    $validator['message'] = '<p class="alert alert-danger">Account has been suspended<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';
                } else {
                    $datalogs = array(
                        'id_user'    => $check_user['id_user'],
                        'id_module'  => $check_user['id_module'],
                        'logs'       => 'Login',
                        'ip_address' => $this->input->ip_address(),
                        'input_time' => date("Y-m-d H:i:s")
                    );
                    $this->mod_global->insert_all('mst_user_log', $datalogs);
                    $validator['success']  = true;  
                    $validator['redirect'] = base_url('menu/site');
                }
            } else {
                $validator['success'] = false;
                $validator['message'] = '<p class="alert alert-danger"><b>Oops!</b> Wrong Username or password<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></p>';  
            }
            echo json_encode($validator);
        }
    }
?>