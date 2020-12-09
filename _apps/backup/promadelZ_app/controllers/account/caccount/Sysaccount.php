<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysaccount extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('username') == "") {
                redirect('home');
            }
            $this->load->model(['maccount/Mod_account', 'mlogin/Mod_login']);
        }

        private static function strEncode($password) { 
            $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
            return $result;
        }

        private static function pregPass($string){ 
            $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
            return $result;
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }


        public function index(){
            $id = $this->session->userdata('id_user');
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/pmenu/menu',
                'content' => 'pages/paccount/account',
                'dserial' => $this->mod_account->detail_serial($id)
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function change_account(){
            $id = $this->session->userdata('id_user');
            $data = array(
                'dserial' => $this->mod_account->detail_serial($id)
            );
            $this->load->view('pages/paccount/edit', $data);
        }

        public function ausloggen(){
            $users = $this->session->userdata('id_user');
            $data  = array('timestamp' => date("Y-m-d H:i:s"), 'ip' => $this->input->ip_address() );
            $this->mod_login->update_last_login($users, $data);
            $this->session->unset_userdata('id_user');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('fullname');
            $this->session->unset_userdata('id_desa');
            session_destroy();
            ob_clean();
            redirect('home');
        }

        public function check_old_password(){
            $password = $this->pregReps($this->input->post('old_password'));
            $id    = $this->my_encryption->decode($this->input->post('id'));
            $query = $this->mod_account->check_old_password($id, $password); 
            if($query !== false) {
                echo $status = 'true';
            } else {             
                echo $status = 'false'; 
            }
        }

        public function save_change_account(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $old_password = $this->pregReps($this->input->post('old_password'));
            $new_password = $this->strEncode($this->pregReps($this->input->post('new_password')));
            $getData = $this->mod_account->check_old_password($id, $old_password);
            if ($getData->password == $new_password) {
                echo "same";
                exit();
            }

            $dataAccount = array(
                'fullname' => $this->pregReps($this->input->post('fullname')),
                'mobile'   => $this->pregRepn($this->input->post('mobile')),
                'email'    => $this->pregReps($this->input->post('email')),
                'username' => $this->pregReps($this->input->post('username')),
                'password' => $this->strEncode($this->pregReps($this->input->post('new_password'))),
            );
            $saveAccount = $this->mod_account->edit_data('id_user', $id, 'users', $dataAccount);
            if($saveAccount == true){
                $dataLogs = array(
                    'logs_date'     => date("Y-m-d H:i:s"),
                    'logs_ip'       => $this->input->ip_address(),
                    'logs_activity' => 'Melakukan perubahan data akun ID : '.$id.'',
                    'logs_id_user'  => $this->session->userdata('id_user'),
                    'logs_username' => $this->session->userdata('username'),
                    'logs_fullname' => $this->session->userdata('fullname')
                );
                $saveLogs = $this->mod_account->insert_data('logs', $dataLogs);
                echo 'success';
            } else {             
                echo 'error'; 
            }
        }

    }
?>