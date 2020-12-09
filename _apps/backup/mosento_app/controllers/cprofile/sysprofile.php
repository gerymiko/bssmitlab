<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprofile extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mprofile/mod_profile', 'mprivilege/mod_privilege']);
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.@]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function index(){
            $nik = $this->session->userdata('nik');
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/ptopbar/vtopbar',
                'content' => 'pages/pprofile/vprofile',
                'user'    => $this->mod_profile->getData_user($nik),
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function get_user($nik){
            $nik     = $this->my_encryption->decode($nik);
            $getData = $this->mod_profile->get_user($nik);
            $data = array();
            foreach ($getData as $field) {
                $row          = array();
                $row['name']  = $field->nama;
                $row['nik']   = $field->nik;
                $row['site']  = $field->site;
                $row['email'] = $field->email;
                $row['phone'] = $field->phone;
                $data[]       = $row;
            }
            echo json_encode($data);
        }

        private function sendEmailDataChange($email, $new_email, $name, $phone, $updateDate, $lastIP){
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
                'phone'      => $phone,
                'new_email'  => $new_email,
                'lastIP'     => $lastIP,
                'updateDate' => $updateDate
            );
            $body = $this->load->view('pages/ptemp/vemail_datachange.php', $data, TRUE);
            $this->email->subject("[No-Reply] Notification MOSENTO PT BINA SARANA SUKSES");
            $this->email->message($body);
            return $this->email->send();
        }

        public function save_edit_data(){
            $nik     = $this->pregRepn($this->input->post('nik_data'));
            $getUser = $this->mod_privilege->getData_user($nik);
            $getRecovery = $this->mod_profile->check_recovery_data($nik);

            $email_post = $this->pregReps($this->input->post('email'));
            $phone_post = $this->pregRepn($this->input->post('phone'));

            if ($getUser->email == $email_post && $getUser->phone == $phone_post ) {
                echo "nochange";
                exit();
            }

            if ($getRecovery == false ) {
                $dataRecovery = array(
                    'nik'   => $nik,
                    'email' => $getUser->email,
                    'phone' => $getUser->phone
                );
                $saveRecovery = $this->mod_profile->insert_all('mos_user_recovery', $dataRecovery);
            } else {
                $dataRecovery = array(
                    'email' => $getUser->email,
                    'phone' => $getUser->phone
                );
                $saveRecovery = $this->mod_profile->edit_recovery($nik, $dataRecovery);
            }

            $data = array(
                'email' => $this->pregReps($this->input->post('email')),
                'phone' => $this->pregRepn($this->input->post('phone')),
                'update_date' => date("Y-m-d H:i:s")
            );
            $saveData = $this->mod_profile->edit_data($nik, $data);
            if ($saveData == true) {
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Profile',
                    'logs_aktifitas'  => 'Melakukan perubahan data',
                    'logs_keterangan' => 'Melakukan perubahan data untuk akun : '.$nik,
                    'logs_user_id'    => $this->session->userdata('nik'),
                    'logs_username'   => $this->session->userdata('nik'),
                    'logs_user_name'  => $this->session->userdata('nama'),
                    'logs_website'    => 'MOSENTO'
                );
                $this->mod_profile->insert_all('web_logs', $datalogs);

                // SEND SMS
                $getUser2     = $this->mod_privilege->getData_user($nik);
                $getRecovery2 = $this->mod_profile->check_recovery_data($nik);
                $checkPhone   = ($getUser2->phone == false) ? 0 : $getUser2->phone;
                if ($checkPhone == 0) {
                    exit();
                } else {
                    $content = 'Anda telah melakukan perubahan data akun MOSENTO PT BSS. Apabila tidak melakukannya segera hubungi admin. bit.ly/2BsSMos' ;
                    $konten = array(
                        'NOM' => $getUser2->phone,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_privilege->sendsms($konten);

                    $kontenRec = array(
                        'NOM' => $getRecovery2->phone,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_privilege->sendsms($kontenRec);
                }

                // SEND EMAIL
                if ($getUser2->email == '' || $getUser2->email == null) {
                    exit();
                } else {
                    $email      = $getRecovery2->email;
                    $new_email  = $getUser2->email;
                    $name       = $getUser2->nama;
                    $phone      = $getUser2->phone;
                    $updateDate = $getUser2->update_date;
                    $lastIP     = $getUser2->last_ip;
                    $this->sendEmailDataChange($email, $new_email, $name, $phone, $updateDate, $lastIP);
                }
                echo "Success";
            } else {
                echo "Error Save";
            }
        }
    }
?>