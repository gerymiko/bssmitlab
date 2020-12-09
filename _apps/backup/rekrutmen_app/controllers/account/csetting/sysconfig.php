<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysconfig extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') !== 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
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

        private function sendEmailPassword($getEmail_people, $password_new, $getUsername_people, $getUpdateDate_people, $getLastIP_people){
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
            $config['charset']          = 'iso-8859-1';
            $config['validate']         = true;
            $config['crlf']             = "\r\n";
            $config['newline']          = "\r\n";

            $this->email->initialize($config);

            $this->email->from('no_reply@binasaranasukses.com', 'PT. Bina Sarana Sukses');
            $this->email->to($getEmail_people); 
            $data = array(
                'username'     => $getUsername_people,
                'password_new' => $password_new,
                'last_ip'      => $getLastIP_people,
                'update_date'  => $getUpdateDate_people
            );
            $body = $this->load->view('pages/ptemp/vemail_temp.php',$data,TRUE);
            $this->email->subject("[No-Reply] e-Recruitment PT BINA SARANA SUKSES");
            $this->email->message($body);
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
                'password'           => $this->strEncode($password_new),
                'people_update_date' => date("Y-m-d H:i:s"),
                'last_ip'            => $this->input->ip_address()
            );
            $result = $this->mod_karir_setting->change_password($people_id, $data);
            if ($result == true) {
                // SEND SMS
                $getPhone        = $this->mod_karir_setting->getPhone_number($people_id);
                $getPhone_people = ($getPhone->people_mobile == false) ? 0 : $getPhone->people_mobile;
                if ($getPhone_people == 0) {
                    echo "Error 3";
                    exit();
                }
                $content = 'Password baru anda : '.$password_new.' website PT. BINA SARANA SUKSES. Ini adalah sms rahasia mohon jangan disebarkan.' ;
                $konten = array(
                    'NOM' => $getPhone->people_mobile,
                    'MSG' => $content
                );
                $sendsms = $this->mod_karir_sms->sendsms($konten);

                // SEND EMAIL
                $getEmail             = $this->mod_karir_setting->getEmail_akun($people_id);
                $getEmail_people      = ($getEmail->people_email == false) ? 0 : $getEmail->people_email;
                $getUsername_people   = $getEmail->username;
                $getUpdateDate_people = $getEmail->people_update_date;
                $getLastIP_people     = $getEmail->last_ip;

                if ($getEmail_people !== 0) {
                    $this->sendEmailPassword($getEmail_people, $password_new, $getUsername_people, $getUpdateDate_people, $getLastIP_people);
                } 
                if ($sendsms == true) {
                    echo "Success";
                } else {
                    echo "Error 4";
                }
            } else {
                echo "Error";
            }
        }

    }
?>