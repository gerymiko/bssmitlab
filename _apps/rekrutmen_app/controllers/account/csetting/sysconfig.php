<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysconfig extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == NULL) {
                redirect('http://bss.com/rekrutmen');
            }
            $this->load->model(['msetting/mod_karir_setting', 'msms/mod_karir_sms']);
            $this->output->enable_profiler(false);
        }

        public function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu'    => 'pages/account/grid/vmenu',
                'content' => 'pages/account/setting/vsetting',
                'footer'  => 'pages/account/grid/vfooter',
        	);
        	$this->load->view('pages/account/index', $data);
        }

        public function checkOldPassword(){
            $password_old = preg_replace('/[^a-zA-Z0-9-_.]/','', $this->input->post('password_old'));
            $people_id    = $this->session->userdata('people_id');
            $query        = $this->mod_karir_setting->checkOldPassword($people_id, $password_old); 
            if($query == true) {
                echo $status = 'true';
            } else {             
                echo $status = 'false'; 
            }
        }

        private static function strEncode($password) {
            $result = md5(base64_encode(hash("sha256", md5(sha1(md5($password))), TRUE))); 
            return $result;
        }

        private function sendforgotemail($getEmail_people, $password_new, $getUsername_people){
            $config['useragent']        = 'PHPMailer';
            $config['protocol']         = 'smtp';
            $config['mailpath']         = '/usr/sbin/sendmail';
            $config['smtp_host']        = 'binasaranasukses.com';
            $config['smtp_user']        = 'no_reply@binasaranasukses.com';
            $config['smtp_pass']        = 'noreply0218';
            $config['smtp_port']        = 26;
            $config['smtp_timeout']     = 5;
            $config['smtp_debug']       = 0;
            $config['wordwrap']         = true;
            $config['wrapchars']        = 76;
            $config['mailtype']         = 'html';
            $config['charset']          = 'utf-8';
            $config['validate']         = true;
            $config['crlf']             = "\r\n";
            $config['newline']          = "\r\n";

            $this->email->initialize($config);

            $this->email->from('no_reply@binasaranasukses.com', 'PT. Bina Sarana Sukses');
            $this->email->to($getEmail_people); 

            $isi_email = "
            <p>Dear Pelamar,</p>
            
            <p>Kami telah menerima notifikasi perubahan Sandi untuk akun dengan Username <b>".$getUsername_people."</b>.</p> 
            <p>Password Baru yang telah Anda tentukan adalah <b>".$password_new."</b>.</p> 
            <p>Ini merupakan pesan rahasia, mohon untuk tidak menyebarluaskan agar tidak terjadi penyalahgunaan terhadap data-data Anda.</p>

            <p>PT. BINA SARANA SUKSES</p> 
            <p>CONFIDENTIALITY NOTICE</p>
            <p>Perhatian: Seluruh informasi yang ada dalam e-mail ini (termasuk seluruh lampirannya, bila ada) merupakan korespondesi yang isinya berada dibawah kerahasiaan dan/atau dilindungi hukum antara pengirim kepada (para) penerima yang tercantum di atas. Jika Anda bukan (salah satu) penerima yang dituju, maka Anda tidak diperkenankan untuk memanfaatkan, menyebarkan, mendistribusikan, atau menggandakan e-mail ini beserta seluruh lampirannya. Jika anda menerima email ini karena suatu kesalahan, mohon kerjasamanya agar memberitahukan kepada pengirimnya di alamat email yang tercantum di atas serta menghapus e-mail ini beserta seluruh lampirannya.</p>

            <p>Caution: The information enclosed in this email (and any attachments) may be legally privileged and/or confidential and is intended only for the use of the addressee(s). No addressee should forward, print, copy, or otherwise reproduce this message in any manner that would allow it to be viewed by any individual not originally listed as a recipient. If the reader of this message is not the intended recipient, you are hereby notified that any unauthorized disclosure, dissemination, distribution, copying or the taking of any action in reliance on the information herein is strictly prohibited. If you have received this communication in error, please immediately notify the sender and delete this message.</p>
            ";

            $this->email->subject("PASSWORD WEBSITE PT BINA SARANA SUKSES");
            $this->email->message($isi_email);
            return $this->email->send();
        }

        public function save_new_password(){
            $people_id      = $this->session->userdata('people_id');
            $password_old   = preg_replace('/[^a-zA-Z0-9-_.]/','', $this->input->post('password_old'));
            $password_new   = preg_replace('/[^a-zA-Z0-9-_.]/','', $this->input->post('password'));
            $getOldPassword = $this->mod_karir_setting->checkOldPassword($people_id, $password_old);
            if ($getOldPassword == false ) {
                echo "Error 1";
                exit();
            }
            if ($password_old == $password_new) {
                echo "Error 2";
                exit();
            }
            $data = array(
                'password' => $this->strEncode($password_new)
            );
            $result = $this->mod_karir_setting->change_password($people_id, $data);
            if ($result == true) {
                // SEND SMS
                // $getPhone        = $this->mod_karir_setting->getPhone_number($people_id);
                // $getPhone_people = ($getPhone->people_mobile == false) ? 0 : $getPhone->people_mobile;
                // if ($getPhone_people == 0) {
                //     echo "Error 3";
                //     exit();
                // }
                // $content = 'Password baru anda : '.$password_new.' website PT. BINA SARANA SUKSES. Ini adalah sms rahasia mohon jangan disebarkan.' ;
                // $konten = array(
                //     'NOM' => $getPhone->people_mobile,
                //     'MSG' => $content
                // );
                // $sendsms = $this->mod_karir_sms->sendsms($konten);

                // SEND EMAIL
                $getEmail           = $this->mod_karir_setting->getEmail_akun($people_id);
                $getEmail_people    = ($getEmail->people_email == false) ? 0 : $getEmail->people_email;
                $getUsername_people = $getEmail->username;



                if ($getEmail_people !== 0) {
                    $this->sendforgotemail($getEmail_people, $password_new, $getUsername_people);
                } 
                // if ($sendsms == true) {
                //     echo "Success";
                // } else {
                //     echo "Error 4";
                // }
            } else {
                echo "Error";
            }
        }

    }
?>