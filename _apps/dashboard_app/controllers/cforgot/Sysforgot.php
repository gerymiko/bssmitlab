<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysforgot extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model(['mforgot/mod_forgot', 'msms/mod_sms']);
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9-_.@]/','', $string);
        }

        private static function pregRepn($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
        }

        private static function pregPass($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
        }

        private static function strEncode($password) { 
            return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

        private function randomToken(){
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array();
            $alphaLength = strlen($alphabet) - 1;
            for ($i = 0; $i < 8; $i++){
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass);
        }

        private function sendforgotemail($email, $nama, $username, $token){
            $config['useragent']    = 'PHPMailer';
            $config['protocol']     = 'smtp';
            $config['mailpath']     = '/usr/sbin/sendmail';
            $config['smtp_host']    = 'binasaranasukses.com';
            $config['smtp_user']    = 'no_reply@binasaranasukses.com';
            $config['smtp_pass']    = 'noreply0218';
            $config['smtp_port']    = 26;
            $config['smtp_timeout'] = 5;
            $config['smtp_debug']   = 0;
            $config['wordwrap']     = true;
            $config['wrapchars']    = 76;
            $config['mailtype']     = 'html';
            $config['charset']      = 'iso-8859-1';
            $config['validate']     = true;
            $config['crlf']         = "\r\n";
            $config['newline']      = "\r\n";

            $this->email->initialize($config);

            $this->email->from('no_reply@binasaranasukses.com', 'PT. Bina Sarana Sukses');
            $this->email->to($email); 
            $data = array(
                'username'   => $username,
                'nama'       => $nama,
                'token'      => $token
            );
            $body = $this->load->view('pages/ptemp/vemail_forgot.php', $data, TRUE);
            $this->email->subject("[No-Reply] Reset Password MOSENTO PT BINA SARANA SUKSES");
            $this->email->message($body);
            return $this->email->send();
        }

        private function sendEmailPassChange($email, $name, $password, $username, $updateDate, $lastIP){
            $config['useragent']    = 'PHPMailer';
            $config['protocol']     = 'smtp';
            $config['mailpath']     = '/usr/sbin/sendmail';
            $config['smtp_host']    = 'binasaranasukses.com';
            $config['smtp_user']    = 'no_reply@binasaranasukses.com';
            $config['smtp_pass']    = 'noreply0218';
            $config['smtp_port']    = 26;
            $config['smtp_timeout'] = 5;
            $config['smtp_debug']   = 0;
            $config['wordwrap']     = true;
            $config['wrapchars']    = 76;
            $config['mailtype']     = 'html';
            $config['charset']      = 'iso-8859-1';
            $config['validate']     = true;
            $config['crlf']         = "\r\n";
            $config['newline']      = "\r\n";

            $this->email->initialize($config);

            $this->email->from('no_reply@binasaranasukses.com', 'PT. Bina Sarana Sukses');
            $this->email->to($email); 
            $data = array(
                'name'       => $name,
                'username'   => $username,
                'password'   => $password,
                'lastIP'     => $lastIP,
                'updateDate' => $updateDate
            );
            $body = $this->load->view('pages/ptemp/vemail_passchange.php', $data, TRUE);
            $this->email->subject("[No-Reply] Notification MOSENTO PT BINA SARANA SUKSES");
            $this->email->message($body);
            return $this->email->send();
        }

        public function index(){
            $data = array(
                'header'     => 'pages/ext/logheader',
                'footer'     => 'pages/ext/logfooter',
                'css_script' => array(),
                'js_script'  => array()
            );
        	$this->load->view('pages/pforgot/vforgot', $data);
        }

        public function forgot(){
			$post_email = $this->security->xss_clean($this->pregReps($this->input->post('forgotemail')));
			$post_phone = $this->security->xss_clean($this->pregRepn($this->input->post('forgotphone')));
            if ($post_phone !== "") {
                $var = array('phone' => $post_phone);
                $checkPhone = $this->mod_forgot->check_data($var);
                if ($checkPhone == false) {
                    echo "ErrorPhone";exit();
                } else {
                    $checkSessPassGen = $this->mod_forgot->check_session_passgen($checkPhone->nik);
                    if (strtotime(date("Y-m-d H:i:s", strtotime($checkSessPassGen->pwdgen_expired))) >= strtotime(date("Y-m-d H:i:s")) ) {
                        echo "activePhone";exit();
                    }
                    $phone      = $checkPhone->phone;
                    $expireTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').' + 1 hour'));
                    $nama       = $checkPhone->fullname;
                    $username   = $checkPhone->username;
                    $token      = $this->randomToken();
                    $data = array(
                        'pwdgen_users'   => $username,
                        'pwdgen_date'    => date('Y-m-d H:i:s'),
                        'pwdgen_expired' => $expireTime,
                        'pwdgen_token'   => $token,
                        'pwdgen_status'  => 1
                    );
                    $PassGen = $this->mod_global->insert_all('password_generator', $data);
                    if ($PassGen == true) {
                        $content = 'web.binasaranasukses.com/mosento/forgot/validate/'.$token.' . Link utk reset password akun MOSENTO anda.' ;
                        $konten = array(
                            'NOM' => $checkPhone->phone,
                            'MSG' => $content
                        );
                        $sendsms = $this->mod_sms->sendsms($konten);
                        echo "Success Phone";
                    } else {
                        echo "Error Passgen";exit();
                    }
                }
            } else {
                $var = array('email' => $post_email);
                $checkEmail = $this->mod_forgot->check_data($var);
                if ($checkEmail == false) {
                    echo "ErrorEmail";exit();
                } else {
                    $checkSessPassGen = $this->mod_forgot->check_session_passgen($checkEmail->nik);
                    if (strtotime(date("Y-m-d H:i:s", strtotime($checkSessPassGen->pwdgen_expired))) >= strtotime(date("Y-m-d H:i:s")) ) {
                        echo "activeEmail";exit();
                    }
                    $email      = $checkEmail->email;
                    $expireTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').' + 1 hour'));
                    $nama       = $checkEmail->fullname;
                    $username   = $checkEmail->username;
                    $token      = $this->randomToken();
                    $data = array(
                        'pwdgen_users'   => $username,
                        'pwdgen_date'    => date('Y-m-d H:i:s'),
                        'pwdgen_expired' => $expireTime,
                        'pwdgen_token'   => $token,
                        'pwdgen_status'  => 1
                    );
                    $PassGen = $this->mod_global->insert_all('password_generator', $data);
                    if ($PassGen == true) {
                        $this->sendforgotemail($email, $nama, $username, $token);
                        echo "Success Email";
                    } else {
                        echo "Error Passgen";exit();
                    }
                }
            }
        }

        public function validate($token){
            $token_key = $token;
            $getToken = $this->mod_forgot->check_token( $this->pregReps($token) );
            if ($getToken->pwdgen_token == $token_key && $getToken->pwdgen_status == 1 && $getToken->pwdgen_expired >= date("Y-m-d H:i:s") ) {
            	$data = array(
                    'header'     => 'pages/ext/header',
                    'footer'     => 'pages/ext/footer',
                    'css_script' => array(),
                    'js_script'  => array(),
                    'token_id'   => $getToken->pwdgen_id,
                    'token'      => $token_key,
                    'nik'        => $getToken->pwdgen_users,
                    'expired'    => date("Y-m-d H:i:s", strtotime($getToken->pwdgen_expired)),
	            );
            	$this->load->view('pages/pforgot/vvalidate_forgot', $data);
            } else {
            	redirect('forgot');
            }
        }

        public function timesup(){
            $pwdgen_id = $this->pregReps($this->input->post('token_id'));
            $data = array( 'pwdgen_status' => 0 );
            $editGenerator = $this->mod_forgot->edit_all('pwdgen_id', $pwdgen_id, 'password_generator', $data);
            if ($editGenerator == true) {
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function save_new_password(){
            $new_password = $this->pregPass($this->input->post('new_password'));
            $nik          = $this->pregRepn($this->input->post('nik'));
            $pwdgen_id    = $this->pregRepn($this->input->post('token_id'));
            $dataPassGen = array(
                'pwdgen_password' => $this->strEncode($new_password),
                'pwdgen_status'   => 0
            );
            $editGenerator = $this->mod_forgot->edit_all('pwdgen_id', $pwdgen_id, 'password_generator', $dataPassGen);
            $dataAccount = array(
                'nik'      => $nik,
                'password' => $this->strEncode($new_password),
            );
            $saveNewPass = $this->mod_global->edit_all('nik', $nik, 'mos_user', $dataAccount);
            if ($saveNewPass == true) {
                $dataLog = array(
                    'id_user'     => $this->session->userdata('id_user'),
                    'id_module'   => 6,
                    'logs'        => 'Changes password : '.$this->session->userdata('nik'),
                    'ip_address'  => $this->input->ip_address(),
                    'insert_time' => date("Y-m-d H:i:s")
                );
                $saveLogUser = $this->mod_global->insert_all('mos_user_log', $dataLog);
                echo "Success";

                // SEND SMS
                $getUser    = $this->mod_forgot->getData_user($nik);
                $checkPhone = ($getUser->phone == false) ? 0 : $getUser->phone;
                if ($checkPhone == 0) {
                    exit();
                } else {
                    $content = 'User: '.$nik.'. New Pass: '.$new_password.'. You have changed the password of the PT BSS MOSENTO account. Secret SMS, please dont share it. bit.ly/2BsSMos' ;
                    $konten = array(
                        'NOM' => $getUser->phone,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_sms->sendsms($konten);
                }

                // SEND EMAIL
                if ($getUser->email == '' || $getUser->email == null) {
                    exit();
                } else {
                    $email      = $getUser->email;
                    $name       = $getUser->fullname;
                    $username   = $nik;
                    $password   = $new_password;
                    $updateDate = date("Y-m-d H:i:s");
                    $lastIP     = $this->input->ip_address();
                    $this->sendEmailPassChange($email, $name, $password, $username, $updateDate, $lastIP);
                } 
            } else {
                echo "Error";exit();
            }
        }

    }
?>