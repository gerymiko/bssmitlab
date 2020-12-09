<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprivilege extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mprivilege/mod_privilege', 'mglobal/mod_global']);
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.,\/@]/','', $string);
            return $result;
        }

        private static function pregPass($string){ 
            $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function strEncode($password) { 
            $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
            return $result;
        }

        public function index(){
            $data = array(
                'header'         => 'pages/ext/header',
                'footer'         => 'pages/ext/footer',
                'menu'           => 'pages/ptopbar/vtopbar',
                'content'        => 'pages/pprivilege/vprivilege',
                'count_all_user' => $this->mod_privilege->count_all_privilege(),
                'level'          => $this->mod_privilege->list_level(),
                'list_employee'  => $this->mod_privilege->list_employee(),
                'count_admin'    => $this->mod_privilege->count_admin(),
                'count_user'     => $this->mod_privilege->count_user(),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_privilege(){
            $privilege = $this->mod_privilege->get_privilege();
            $data      = array();
            $no        = $this->pregRepn($this->input->post('start'));

            foreach ($privilege as $field){
                if ($this->session->userdata('level') == 1 ) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-users" data-nik="'.$field->nik.'" data-nama="'.$field->nama.'" data-email="'.$field->email.'" data-user="'.$field->username.'" data-status="'.$field->status.'" data-level="'.$field->id_level.'" data-mobile="'.$field->phone.'" >Edit</button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default"><i class="fas fa-check-double"></i></button>';
                }

                if ( $field->status == 1 ){
                    $status = '<i class="fas fa-circle text-green" data-toggle="tooltip" title="Active"></i>';
                } else {
                    $status = '<i class="fas fa-circle text-red" data-toggle="tooltip" title="Nonactive"></i>';
                }

                if ($field->login_date == null) {
                    $login_date = "-";
                } else {
                    $login_date = date("d-m-Y h: A", strtotime($field->login_date));
                }

                $no++;
                $row               = array();
                $row['no']         = $no;
                $row['nik']        = $field->nik;
                $row['nama']       = $field->nama;
                $row['email']      = $field->email;
                $row['type']       = $field->level_name;
                $row['username']   = $field->username;
                $row['last_login'] = ($field->login_update == null ) ? $login_date : date("d-m-Y h: A", strtotime($field->login_update));
                $row['status']     = $status;
                $row['action']     = $btn;
                $data[]            = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_privilege->count_all_privilege(),
                "recordsFiltered" => $this->mod_privilege->count_filtered_privilege(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function getKaryawan(){
            $nik     = $this->pregRepn($this->input->post('opt'));
            $getkrywn = $this->mod_privilege->getKaryawan($nik);
            echo '
                <div style="padding: 15px;"></div>
                <div class="form-group hidden">
                    <input type="text" name="employee" id="employee" class="form-control required" value="'.$this->pregReps($getkrywn->Nama).'">
                    <input type="text" name="position" id="position" class="form-control required" value="'.$this->pregReps($getkrywn->jabatan).'">
                    <input type="text" name="kodest" id="kodest" class="form-control required" value="'.$this->pregReps($getkrywn->KodeST).'">
                </div>
                <div class="form-group">
                    <label class="control-label">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control num required" maxlength="10" value="'.$this->pregRepn($getkrywn->NIK).'">
                </div>
                <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control mails required" maxlength="100" value="'.$this->pregReps($getkrywn->Email).'">
                </div>
                <div class="form-group">
                    <label class="control-label">Mobile Phone</label>
                    <input type="text" name="mobile" id="mobile" class="form-control num required" maxlength="25" value="'.$this->pregReps($getkrywn->Telp).'">
                    <span><em>If the user has two mobile numbers, please choose one of them which is active.</em></span>
                </div>
            ';
        }

        public function check_user(){
            $user   = $this->pregRepn($this->input->post('users_id'));
            $query  = $this->mod_privilege->check_user($user); 
            $status = "true";
            if($query){
                echo $status = "false";
            } else {             
                echo $status; 
            }
        }

        public function check_password(){
            $old_password = $this->pregReps($this->input->post('old_password'));
            $nik   = $this->pregRepn($this->input->post('nik'));
            $query = $this->mod_privilege->check_password($nik, $old_password); 
            if($query == true) {
                echo $status = 'true';
            } else {             
                echo $status = 'false'; 
            }
        }

        private function sendEmail($email, $name, $password, $username, $registerDate, $lastIP){
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
            $this->email->to($email); 
            $data = array(
                'name'         => $name,
                'username'     => $username,
                'password'     => $password,
                'lastIP'       => $lastIP,
                'registerDate' => $registerDate
            );
            $body = $this->load->view('pages/ptemp/vemail_temp.php',$data,TRUE);
            $this->email->subject("[No-Reply] e-Registered MOSENTO PT BINA SARANA SUKSES");
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

        public function save_add_user(){
            $nik      = $this->pregRepn($this->input->post('users_id'));
            $getStatus = $this->mod_privilege->check_user($nik);
            if ($getStatus !== false) {
                echo "registered";
                exit();
            }
            $data = array(
                'id_level'        => $this->pregRepn($this->pregRepn($this->input->post('level'))),
                'nik'             => $nik,
                'nama'            => $this->pregReps($this->input->post('employee')),
                'email'           => $this->pregReps($this->input->post('email')),
                'phone'           => $this->pregRepn($this->input->post('mobile')),
                'jabatan'         => $this->pregReps($this->input->post('position')),
                'kodest'          => $this->pregReps($this->input->post('kodest')),
                'username'        => $nik,
                'password'        => $this->strEncode($nik),
                'is_login'        => 0,
                'last_ip'         => $this->input->ip_address(),
                'status'          => 1,
                'change_password' => 1,
                'register_date'   => date("Y-m-d H:i:s")
            );
            $saveUser = $this->mod_privilege->insert_all('mos_user', $data);
            if ($saveUser == true) {
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Privilege',
                    'logs_aktifitas'  => 'Melakukan penambahan data',
                    'logs_keterangan' => 'Melakukan penambahan data untuk user : '.$nik,
                    'logs_user_id'    => $this->session->userdata('nik'),
                    'logs_username'   => $this->session->userdata('nik'),
                    'logs_user_name'  => $this->session->userdata('nama'),
                    'logs_website'    => 'MOSENTO'
                );
                $this->mod_global->insert_all('web_logs', $datalogs);
                
                echo "Success";

                // SEND SMS
                $getUser    = $this->mod_privilege->getData_user($nik);
                $checkPhone = ($getUser->phone == false) ? 0 : $getUser->phone;
                if ($checkPhone == 0) {
                    exit();
                } else {
                    $content = 'User:'.$nik.'. Pass:'.$nik.'. Anda terdaftar diwebsite MOSENTO PT BSS. SMS rahasia, mohon jgn disebarkan. bit.ly/2BsSMos' ;
                    $konten = array(
                        'NOM' => $getUser->phone,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_privilege->sendsms($konten);
                }

                // SEND EMAIL
                if ($getUser->email == '' || $getUser->email == null) {
                    exit();
                } else {
                    $email        = $getUser->email;
                    $name         = $getUser->nama;
                    $username     = $nik;
                    $password     = $nik;
                    $registerDate = $getUser->register_date;
                    $lastIP       = $getUser->last_ip;
                    $this->sendEmail($email, $name, $password, $username, $registerDate, $lastIP);
                } 
            } else {
                echo "E_not_save";
            }
        }

        public function save_edit_user(){
            $nik      = $this->pregRepn($this->input->post('nik_edit'));
            if ($this->input->post('password_edit') == '' || $this->input->post('password_edit') == null) {
                $data = array(
                    'id_level' => $this->pregRepn($this->input->post('level_edit')),
                    'email'    => $this->pregReps($this->input->post('email_edit')),
                    'phone'    => $this->pregRepn($this->input->post('mobile_edit')),
                    'status'   => $this->pregRepn($this->input->post('status_edit'))
                );
            } else {
                $data = array(
                    'id_level' => $this->pregRepn($this->input->post('level_edit')),
                    'email'    => $this->pregReps($this->input->post('email_edit')),
                    'phone'    => $this->pregRepn($this->input->post('mobile_edit')),
                    'status'   => $this->pregRepn($this->input->post('status_edit')),
                    'password' => $this->pregReps($this->input->post('password_edit'))
                );
            }
            $saveEditUser = $this->mod_privilege->save_new_data($nik, $data);
            if ($saveEditUser == true) {
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Privilege',
                    'logs_aktifitas'  => 'Melakukan perubahan data',
                    'logs_keterangan' => 'Melakukan perubahan data untuk akun : '.$nik,
                    'logs_user_id'    => $this->session->userdata('nik'),
                    'logs_username'   => $this->session->userdata('nik'),
                    'logs_user_name'  => $this->session->userdata('nama'),
                    'logs_website'    => 'MOSENTO'
                );
                $this->mod_global->insert_all('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function save_edit_password(){
            $new_password = $this->pregPass($this->input->post('new_password'));
            $nik          = $this->pregRepn($this->input->post('nik'));
            $check_old    = $this->mod_privilege->check_password($nik, $new_password); 
            if ($check_old == true){
                echo "same";
                exit();
            }
            $data = array(
                'nik'             => $nik,
                'password'        => $this->strEncode($new_password),
                'update_date'     => date("Y-m-d H:i:s"),
                'change_password' => 0
            );
            $saveNewPass = $this->mod_privilege->save_new_data($nik, $data);
            if ($saveNewPass == true) {
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Privilege',
                    'logs_aktifitas'  => 'Melakukan perubahan data',
                    'logs_keterangan' => 'Melakukan perubahan password',
                    'logs_user_id'    => $this->session->userdata('nik'),
                    'logs_username'   => $this->session->userdata('nik'),
                    'logs_user_name'  => $this->session->userdata('nama'),
                    'logs_website'    => 'MOSENTO'
                );
                $this->mod_global->insert_all('web_logs', $datalogs);
                echo "Success";

                // SEND SMS
                $getUser    = $this->mod_privilege->getData_user($nik);
                $checkPhone = ($getUser->phone == false) ? 0 : $getUser->phone;
                if ($checkPhone == 0) {
                    exit();
                } else {
                    $content = 'User:'.$nik.'. Pass Baru:'.$new_password.'. Anda telah melakukan perubahan password akun MOSENTO PT BSS. SMS rahasia, mohon jgn disebarkan. bit.ly/2BsSMos' ;
                    $konten = array(
                        'NOM' => $getUser->phone,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_privilege->sendsms($konten);
                }

                // SEND EMAIL
                if ($getUser->email == '' || $getUser->email == null) {
                    exit();
                } else {
                    $email      = $getUser->email;
                    $name       = $getUser->nama;
                    $username   = $nik;
                    $password   = $new_password;
                    $updateDate = $getUser->update_date;
                    $lastIP     = $getUser->last_ip;
                    $this->sendEmailPassChange($email, $name, $password, $username, $updateDate, $lastIP);
                } 
            } else {
                echo "Error";
            }
        }

        

    }
?>