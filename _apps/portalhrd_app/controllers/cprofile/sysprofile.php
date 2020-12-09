<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprofile extends CI_Controller {

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.@]/','', $string);
        }

        private static function pregPass($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function strEncode($password){ 
            return $hasil = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('bssID') == null) {
                redirect('logisisse');
            } else {
                $this->accessRights = $this->mod_global->get_detailed_user($this->session->userdata('users_id'));
                if ($this->accessRights==null) {
                    show_404('', false);
                }
            }
            $this->load->model(['mprofile/mod_profile', 'msms/mod_sms']);
        }

        public function my_profile(){
            $nik = $this->session->userdata('bssID');
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/pprofile/view',
                'accessRights' => $this->accessRights,
                'user'    => $this->mod_profile->getData_user($nik),
                'css_script' => array(),
                'js_script'  => array(),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function get_user_data($id){
            $nik     = $this->my_encryption->decode($this->pregReps($this->uri->segment(3)));
            $getData = $this->mod_profile->get_user_data($nik);
            $data = array();
            foreach ($getData as $field) {
                $row  = array();
                $row['name']  = $field->users_fullname;
                $row['nik']   = $field->bssID;
                $row['site']  = $field->KodeST;
                $row['email'] = $field->users_email;
                $row['phone'] = $field->users_mobile;
                $data[] = $row;
            }
            echo json_encode($data);
        }

        public function save_edit_profile(){
            $nik     = $this->pregRepn($this->input->post('nik_data'));
            $getUser = $this->mod_profile->getData_user($nik);
            $email_post = $this->pregReps($this->input->post('email'));
            $phone_post = $this->pregRepn($this->input->post('phone'));
            if ($getUser->users_email == $email_post && $getUser->users_mobile == $phone_post ) {
                echo "nochange";exit();
            }
            $data = array(
                'users_email' => $email_post,
                'users_mobile' => $phone_post
            );
            $saveData = $this->mod_global->edit_web1('bssID', $nik, 'users', $data);
            if ($saveData == true) {
                $dataLog = array(
                    'logs_ip' => $this->input->ip_address(),
                    'logs_modul' => 'Profil Saya',
                    'logs_aktifitas' => 'Ubah Data',
                    'logs_keterangan' => 'Mengubah data : '.$nik,
                    'logs_user_id' => $this->accessRights->users_id,
                    'logs_username' => $this->accessRights->users_username,
                    'logs_user_name' => $this->accessRights->users_fullname,
                    'logs_website' => 'PORTAL'
                );
                $saveLogUser = $this->mod_global->insert_web('web_logs', $dataLog);
                if ($saveLogUser == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorSaveData";exit();
            }
        }

        public function get_old_password(){
            $old_pass = $this->pregReps($this->input->post('old_password'));
            $nik  = $this->pregRepn($this->input->post('nik'));
            $query = $this->mod_profile->get_old_password($nik, $old_pass);
            if($query == false){
                echo $status = "false";
            } else {
                echo $status = "true";
            }
        }

        public function save_edit_password(){
            $new_password = $this->pregPass($this->input->post('new_password'));
            $nik       = $this->pregRepn($this->input->post('nik'));
            $check_old = $this->mod_profile->get_old_password($nik, $new_password); 
            if ($check_old == true){
                echo "same";exit();
            }
            if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $new_password)){
                echo 'notsecure';exit();
            }
            $data = array(
                'users_password' => $this->strEncode($new_password)
            );
            $saveNewPass = $this->mod_global->edit_web1('bssID', $nik, 'users', $data);
            if ($saveNewPass == true) {
                $getUser = $this->mod_profile->get_detail_new_user($nik);
                $dataLog = array(
                    'logs_ip' => $this->input->ip_address(),
                    'logs_modul' => 'Profil Saya',
                    'logs_aktifitas' => 'Ubah Data',
                    'logs_keterangan' => 'Mengubah password',
                    'logs_user_id' => $this->accessRights->users_id,
                    'logs_username' => $this->accessRights->users_username,
                    'logs_user_name' => $this->accessRights->users_fullname
                );
                $saveLog = $this->mod_global->insert_web('web_logs', $dataLog);
                echo "Success";

                // SEND SMS
                $checkPhone = ($getUser->users_mobile == false) ? 0 : $getUser->users_mobile;
                if ($checkPhone == 0) {
                    exit();
                } else {
                    $content = 'User:'.$nik.'. New Pass:'.$new_password.'. Anda telah mengubah kata sandi akun HRD PORTAL PT BSS. SMS rahasia, jgn disebarkan. https://bit.ly/1BsSHrD' ;
                    $konten = array(
                        'NOM' => $getUser->users_mobile,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_sms->sendsms($konten);
                }

                // SEND EMAIL
                // if ($getUser->email == '' || $getUser->email == null) {
                //     exit();
                // } else {
                //     $email      = $getUser->email;
                //     $name       = $getUser->fullname;
                //     $username   = $nik;
                //     $password   = $new_password;
                //     $updateDate = date("Y-m-d H:i:s");
                //     $lastIP     = $this->input->ip_address();
                //     $this->sendEmailPassChange($email, $name, $password, $username, $updateDate, $lastIP);
                // }
            } else {
                echo "Error";exit();
            }
        }

    }
?>
