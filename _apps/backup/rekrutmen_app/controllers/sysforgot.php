<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysforgot extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model(['mforgot/mod_karir_forgot']);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9-_.@]/','', $string);
            return $result;
        }

        private static function strEncode($password) { 
            $result = md5(base64_encode(hash("sha256", md5(sha1(md5($password))), TRUE))); 
            return $result;
        }

        public function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu' 	  => 'pages/pcomp/vmenu',
                'content' => 'pages/pforgot/vforgot',
                'footer'  => 'pages/pcomp/vfooter'
        	);
        	$this->load->view('pages/index', $data);
        }

        public function forgot(){
            $email      = $this->pregReps($this->security->xss_clean($this->input->post('forgotemail')));
            $checkEmail = $this->mod_karir_forgot->check_email($email);

            if ($checkEmail->people_email !== false) {
                $expireDate = date('Y-m-d', strtotime(date('Y-m-d').' + 1 days'));
                $password   = substr($this->strEncode(date('Y-m-d H:i')), 0,6);
                $username   = $checkEmail->username;

                $data = array(
                    'pwdgen_users'    => $username,
                    'pwdgen_date'     => date('Y-m-d H:i:s'),
                    'pwdgen_expired'  => $expireDate,
                    'pwdgen_password' => $this->strEncode($password),
                    'pwdgen_web'      => 'https://web.binasaranasukses.com/karir',
                    'pwdgen_status'   => 1
                );
                $PassGen = $this->mod_karir_forgot->insert_passgen($data);
                if ($PassGen == true) {
                    $this->sendforgotemail($email, $password, $username);
                    echo "Success";
                }
            } else {
                echo "Error Email";
            }
        }

        private function sendforgotemail($email, $password, $username){
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
            $config['charset']      = 'utf-8';
            $config['validate']     = true;
            $config['crlf']         = "\r\n";
            $config['newline']      = "\r\n";

            $this->email->initialize($config);

            $this->email->from('no_reply@binasaranasukses.com', 'PT. Bina Sarana Sukses');
            $this->email->to($email); 
            $data = array(
                'username'  => $username,
                'password'  => $password,
                'passcrypt' => $this->encrypt->encode($this->strEncode($password))
            );
            $body = $this->load->view('pages/ptemp/vforgotemail_temp.php', $data, TRUE);
            $this->email->subject("[No-Reply] e-Recruitment PT BINA SARANA SUKSES");
            $this->email->message($body);
            return $this->email->send();
        }

        public function validate($key){
            $keys = $this->encrypt->decode($key);
            if (empty($keys)) {
                redirect('forgot/password');
            }
            $result = $this->mod_karir_forgot->change_password($keys);
            if ($result) {
                $this->session->set_flashdata('pesan', array('message' => 'Password berhasil diubah. Silahkan login dengan password baru.', 'class' => 'success', 'title' => 'Naiss!'));
                redirect('login');
            } else {
                $this->session->set_flashdata('pesan', array('message' => 'Gagal password diubah. Silahkan coba lagi.', 'class' => 'error', 'title' => 'Oops!'));
                redirect('forgot/password');
            }
        }



    }
?>