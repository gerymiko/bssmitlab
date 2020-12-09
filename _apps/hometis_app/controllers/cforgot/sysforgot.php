<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysforgot extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model(['mforgot/mod_forgot', 'mglobal/mod_global']);
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

        private static function serverDate($date){
            return $result = date("Y-m-d H:i:s", strtotime($date));
        }

        private static function strEncode($password) { 
            return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

        private function sendforgotemail($email, $name, $username, $token){
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
                'name'       => $name,
                'token'      => $token
            );
            $body = $this->load->view('pages/ptemp/vemail_forgot.php', $data, TRUE);
            $this->email->subject("[No-Reply] Reset Password HOMETIS PT BINA SARANA SUKSES");
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
            $this->email->subject("[No-Reply] Notification HOMETIS PT BINA SARANA SUKSES");
            $this->email->message($body);
            return $this->email->send();
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

        public function index(){
            $data = array(
                'header'     => 'pages/ext/header',
                'footer'     => 'pages/ext/footer',
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">',
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>',
                ),
            );
        	$this->load->view('pages/pforgot/vforgot', $data);
        }

        public function forgot(){
			$post_email = $this->security->xss_clean($this->pregReps($this->input->post('forgotemail')));
			$post_phone = $this->security->xss_clean($this->pregRepn($this->input->post('forgotphone')));
            if ($post_phone!=="" || $post_phone!=null) {
                $var = array('mobile' => $post_phone, 'status_active' => 1);
                $checkPhone = $this->mod_forgot->check_data($var);
                if ($checkPhone == false) {
                    echo "ErrorPhone";
                    exit();
                } else {
                    $checkSessPassGen = $this->mod_forgot->check_session_passgen($checkPhone->NIK);
                    if ($checkSessPassGen==null) {
                        $phone      = $checkPhone->mobile;
                        $expireTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').' + 1 hour'));
                        $name       = $checkPhone->fullname;
                        $username   = $checkPhone->username;
                        $nik        = $checkPhone->NIK;
                        $token      = $this->randomToken();
                        $data = array(
                            'pwdgen_users'    => $nik,
                            'pwdgen_date'     => date('Y-m-d H:i:s'),
                            'pwdgen_expired'  => $expireTime,
                            'pwdgen_token'    => $token,
                            'pwdgen_status'   => 1
                        );
                        $PassGen = $this->mod_global->insert_all('password_generator', $data);
                        if ($PassGen==true){
                            $content = 'web.binasaranasukses.com/hometis/forgot/validate/'.$token.' . Link utk reset password akun HOMETIS anda.' ;
                            $konten = array(
                                'NOM' => $checkPhone->mobile,
                                'MSG' => $content
                            );
                            $sendsms = $this->mod_forgot->sendsms($konten);
                            echo "SuccessPhone";
                        } else {
                            echo "ErrorPassgen";
                            exit();
                        }
                    } else {
                        if(strtotime($this->serverDate($checkSessPassGen->pwdgen_expired)) >= strtotime(date("Y-m-d H:i:s"))){
                            echo "activePhone";
                            exit();
                        }
                    }
                    
                }
            } else {
                $var = array('email' => $post_email, 'status_active' => 1);
                $checkEmail = $this->mod_forgot->check_data($var);
                if ($checkEmail == false) {
                 echo "ErrorEmail";
                 exit();
                } else {
                    $checkSessPassGen = $this->mod_forgot->check_session_passgen($checkEmail->NIK);
                    if ($checkSessPassGen==null) {
                        $email      = $checkEmail->email;
                        $expireTime = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').' + 1 hour'));
                        $name       = $checkEmail->fullname;
                        $username   = $checkEmail->username;
                        $nik        = $checkEmail->NIK;
                        $token      = $this->randomToken();
                        $data = array(
                            'pwdgen_users'    => $username,
                            'pwdgen_date'     => date('Y-m-d H:i:s'),
                            'pwdgen_expired'  => $expireTime,
                            'pwdgen_token'    => $token,
                            'pwdgen_status'   => 1
                        );
                        $PassGen = $this->mod_global->insert_all('password_generator', $data);
                        if ($PassGen == true) {
                            $this->sendforgotemail($email, $name, $username, $token);
                            echo "SuccessEmail";
                        } else {
                            echo "ErrorPassgen";
                            exit();
                        }
                    } else {
                        if(strtotime($this->serverDate($checkSessPassGen->pwdgen_expired)) >= strtotime(date("Y-m-d H:i:s"))){
                            echo "activeEmail";
                            exit();
                        }
                    }
                }
            }
        }

        public function validate($token){
            $token_key = $this->pregReps($token);
            $getToken = $this->mod_forgot->check_token( $token_key );
            if ($getToken==false) {
                show_404();
                exit();
            } else {
                if ($getToken->pwdgen_token == $token_key && $getToken->pwdgen_status == 1 && $getToken->pwdgen_expired >= date("Y-m-d H:i:s") ) {
                    $data = array(
                        'token_id'   => $getToken->pwdgen_id,
                        'token'      => $token_key,
                        'nik'        => $getToken->pwdgen_users,
                        'expired'    => date("Y-m-d H:i:s", strtotime($getToken->pwdgen_expired)),
                        'header'     => 'pages/ext/header',
                        'footer'     => 'pages/ext/footer',
                        'css_script' => array(
                            '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                            '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">',
                        ),
                        'js_script' => array(
                            '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                            '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>',
                        ),
                    );
                    $this->load->view('pages/pforgot/validate', $data);
                } else {
                    redirect('forgot');
                }
            }
        }

        public function timesup(){
            $pwdgen_id = $this->my_encryption->decode($this->pregReps($this->input->post('token_id')));
            $data = array( 'pwdgen_status' => 0 );
            $editGenerator = $this->mod_global->edit_all('pwdgen_id', $pwdgen_id, 'password_generator', $data);
            if ($editGenerator == true) {
                echo "Success";
            } else {
                echo "Error";
                exit();
            }
        }

        public function save_new_password(){
            $new_password = $this->pregPass($this->input->post('new_password'));
            $nik          = $this->pregRepn($this->input->post('nik'));
            $pwdgen_id    = $this->my_encryption->decode($this->pregReps($this->input->post('token_id')));
            if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $new_password)){
                echo 'notsecure';
                exit();
            } else {
                $dataPassGen = array(
                    'pwdgen_password' => $this->strEncode($new_password),
                    'pwdgen_status'   => 0
                );
                $editGenerator = $this->mod_global->edit_all('pwdgen_id', $pwdgen_id, 'password_generator', $dataPassGen);
                if ($editGenerator==true) {
                    $dataChange  = array('password' => $this->strEncode($new_password));
                    $saveNewPass = $this->mod_global->edit_all('NIK', $nik, 'mst_user', $dataChange);
                    if ($saveNewPass==true) {
                        $getUser = $this->mod_forgot->get_detail_new_user($nik);
                        $dataLog = array(
                            'id_user'    => $getUser->id,
                            'id_module'  => 9,
                            'logs'       => 'Reset Password : '.$nik,
                            'ip_address' => $this->input->ip_address(),
                            'input_time' => date("Y-m-d H:i:s")
                        );
                        $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                        if ($saveLogUser==true) {
                            echo "Success";
                            $checkPhone = ($getUser->mobile == false) ? 0 : $getUser->mobile;
                            if ($checkPhone==0) {
                                exit();
                            } else {
                                $content = 'User:'.$getUser->username.'. Pass:'.$new_password.'. Perubahan akun HOMETIS PT BSS. SMS rahasia, mhn jgn disebarkan. https://bit.ly/4BssHmtis' ;
                                $konten = array(
                                    'NOM' => $getUser->mobile,
                                    'MSG' => $content
                                );
                                $sendsms = $this->mod_forgot->sendsms($konten);
                            }
                        } else {
                            echo "ErrorLogs";
                            exit();
                        }
                    } else {
                        echo "ErrorNewPass";
                        exit();
                    }
                } else {
                    echo "ErrorPassgen";
                    exit();
                }
            }
        }
    }
?>