<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprivilege extends CI_Controller {

        function __construct() {
            parent::__construct();

            if ($this->session->userdata('users_id') == null && $this->session->userdata('bssID') == null) {
                redirect('logisisse');
            } else {
                $this->accessRights = $this->mod_global->get_detailed_user($this->session->userdata('users_id'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights->level_id != 1 && $this->accessRights->level_id != 2 ) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>Anda tidak memiliki wewenang untuk mengakses halaman ini.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('m/welcome');
                }
            }
            $this->load->model(['mprivilege/mod_privilege', 'msms/mod_sms']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function pregPass($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
        }

        private static function viewDate($date){
            return $result = date("d-m-Y H:i:s", strtotime($date));
        }

        private static function strEncode($password){ 
            return $hasil = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

        private function sendEmail($email, $name, $password, $username, $registerDate, $lastIP, $subject){
            $config['useragent'] = 'PHPMailer';
            $config['protocol']  = 'smtp';
            $config['mailpath']  = '/usr/sbin/sendmail';
            $config['smtp_host'] = 'binasaranasukses.com';
            $config['smtp_user'] = 'no_reply@binasaranasukses.com';
            $config['smtp_pass'] = 'noreply0218';
            $config['smtp_port'] = 26;
            $config['smtp_timeout'] = 5;
            $config['smtp_debug'] = 0;
            $config['wordwrap']   = true;
            $config['wrapchars']  = 76;
            $config['mailtype']   = 'html';
            $config['charset']    = 'iso-8859-1';
            $config['validate']   = true;
            $config['crlf']       = "\r\n";
            $config['newline']    = "\r\n";
            $this->email->initialize($config);
            $this->email->from('no_reply@binasaranasukses.com', 'PT. Bina Sarana Sukses');
            $this->email->to($email); 
            $data = array(
                'name'     => $name,
                'username' => $username,
                'password' => $password,
                'lastIP'   => $lastIP,
                'registerDate' => $registerDate
            );
            $body = $this->load->view('pages/ptemp/vemail.php',$data,TRUE);
            $this->email->subject($subject);
            $this->email->message($body);
            return $this->email->send();
        }

        public function privilege(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/pprivilege/view',
                'accessRights' => $this->accessRights,
                'list_level' => $this->mod_global->list_level(),
                'list_user'  => $this->mod_global->list_user(),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_user(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false); }
            $getdata = $this->mod_privilege->get_data_user($length, $start);
            foreach ($getdata as $field){
                if ($field->users_status == 1) {
                    $status = '<span class="text-green">Aktif</span>';
                } else {
                    $status = '<span class="text-red">Non-Aktif</span>';
                }
                if ($this->accessRights->level_id == 1) {
                    $btn_delete = '<a class="btn bg-red btn-xs" data-tooltip="Hapus" onclick="removeData(\''.$this->my_encryption->encode($field->users_id).'\', \''.$field->users_fullname.'\')">
                        <i class="fas fa-times"></i>
                    </a>';
                } else {
                    $btn_delete = '';
                }
                if (date("d-m-Y", strtotime($field->date_login)) == '01-01-1970') {
                    $date_login = '<small>Belum login</small>';
                } else {
                    $date_login = '<span class="hidden">'.strtotime($field->date_login).'</span>'.$this->viewDate($field->date_login);
                }
                $start++;
                $row        = array();
                $row['no']  = $start;
                $row['nik'] = $field->bssID;
                $row['name'] = ucwords(strtolower($field->users_fullname));
                $row['level'] = $field->level_name;
                $row['position'] = $field->jabatan;
                $row['status'] = $status;
                $row['lastlogin'] = $date_login;
                $row['action'] = '
                    <a class="btn bg-gray btn-xs" data-tooltip="Ubah" data-toggle="modal" data-target="#modal-edit-user" data-backdrop="static" data-keyboard="false" data-users_id="'.$this->my_encryption->encode($field->users_id).'" data-nik="'.$field->bssID.'" data-fullname="'.ucwords(strtolower($field->users_fullname)).'" data-level="'.$field->level_id.'" data-active="'.$field->users_status.'" data-mobile="'.$field->users_mobile.'" data-username="'.$field->users_username.'" data-email="'.$field->users_email.'">
                        <i class="fas fa-pen f9"></i>
                    </a> '.$btn_delete.'
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_privilege->count_all(),
                "recordsFiltered" => $this->mod_privilege->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function get_employee(){
            $nik = $this->pregRepn($this->input->post('opt'));
            if ($nik == null || $nik == '') {
                echo '<b class="text-red">Silahkan pilih karyawan!</b>';exit();
            } else {
                $getkrywn = $this->mod_privilege->get_employee($nik);
                echo '
                    <div class="form-group hidden">
                        <input type="hidden" name="fullname" class="form-control _CalPhaNum required" value="'.$this->pregReps($getkrywn->Nama).'">
                        <input type="hidden" name="username" class="form-control _CnUmB required" maxlength="15" value="'.$this->pregRepn($getkrywn->NIK).'">
                        <input type="hidden" name="password" class="form-control _CalPhaNum required" maxlength="15" value="'.$this->pregRepn($getkrywn->NIK).'">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Nomor Ponsel</label>
                        <input type="text" name="mobile" class="form-control _CnUmB required" maxlength="15" value="'.$this->pregReps($getkrywn->Telp).'">
                        <span><em>Jika pengguna memiliki dua nomor ponsel, silakan pilih salah satu yang aktif.</em></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="text" name="email" class="form-control _CalPhaNum required" maxlength="50" value="'.$this->pregReps($getkrywn->Email).'">
                    </div>
                ';
            }
        }

        public function check_user(){
            $nik  = $this->pregRepn($this->input->post('nik_add'));
            $query = $this->mod_privilege->check_user($nik);
            if($query){
                echo $status = "false";
            } else {
                echo $status = "true";
            }
        }

        public function save_add_user(){
            if ($this->accessRights->level_id != 1 && $this->accessRights->level_id != 2){
                echo "unauthority";exit();
            }
            $nik = $this->pregRepn($this->input->post('nik'));
            if ($nik == null || $nik == '') {
                echo "ErrorNIK";exit();
            }
            $getUser = $this->mod_privilege->check_user($nik);
            if ($getUser !== false ) {
                echo "registered";exit();
            }
            $data = array(
                'level_id' => $this->pregRepn($this->input->post('level')),
                'bssID'    => $nik,
                'users_fullname' => $this->pregReps($this->input->post('fullname')),
                'users_mobile'   => $this->pregRepn($this->input->post('mobile')),
                'users_email'    => $this->pregReps($this->input->post('email')),
                'users_username' => $this->pregRepn($this->input->post('username')),
                'users_password' => $this->strEncode($this->pregRepn($this->input->post('password')))
            );
            $saveUser = $this->mod_global->insert_web1('users', $data);
            if ($saveUser == true){
                $dataLog = array(
                    'logs_ip' => $this->input->ip_address(),
                    'logs_modul' => 'Hak Akses',
                    'logs_aktifitas' => 'Tambah User',
                    'logs_keterangan' => 'Menambahkan user ID: '.$nik,
                    'logs_user_id' => $this->accessRights->users_id,
                    'logs_username' => $this->accessRights->users_username,
                    'logs_user_name' => $this->accessRights->users_fullname,
                    'logs_website' => 'PORTAL'
                );
                $saveLogUser = $this->mod_global->insert_web('web_logs', $dataLog);
                if ($saveLogUser == true) {
                    echo "Success";
                    $getNewUser = $this->mod_privilege->get_detail_new_user($nik);
                    $getPhone = ($getNewUser->users_mobile == false) ? 0 : $getNewUser->users_mobile;
                    // SEND SMS
                    if ($getPhone == 0) { exit();
                    } else {
                        $content = 'User:'.$nik.'. Pass:'.$nik.'. Anda terdaftar di situs web PT BSS MOSENTO. SMS rahasia, jgn disebarkan. https://bit.ly/1BsSHrD' ;
                        $konten = array(
                            'NOM' => $getNewUser->users_mobile,
                            'MSG' => $content
                        );
                        $sendsms = $this->mod_sms->sendsms($konten);
                    }
                    // SEND EMAIL
                    if ($getNewUser->users_email == '' || $getNewUser->users_email == null) {
                        exit();
                    } else {
                        $name  = $nik;
                        $email = $getNewUser->users_email;
                        $username = $nik;
                        $password = $nik;
                        $registerDate = $getNewUser->date_create;
                        $lastIP  = $this->input->ip_address();
                        $subject = '[No-Reply] e-Registered PORTAL HRD PT BINA SARANA SUKSES';
                        $this->sendEmail($email, $name, $password, $username, $registerDate, $lastIP, $subject);
                    }
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorUser";exit();
            }
        }

        public function save_edit_user(){
            if ($this->accessRights->level_id == 1 && $this->accessRights->level_id == 2){
                echo "unauthority";exit();
            }
            $users_id = $this->my_encryption->decode($this->pregReps($this->input->post('users_id')));
            $nik     = $this->pregRepn($this->input->post('nik'));
            $new_password = $this->pregPass($this->input->post('new_password'));
            $datalevel    = array('level_id' => $this->pregRepn($this->input->post('level')));
            if ($new_password == "" || $new_password == null) {
                $data = array(
                    'users_mobile' => $this->pregRepn($this->input->post('mobile')),
                    'users_email'  => $this->pregReps($this->input->post('email')),
                    'users_username' => $this->pregReps($this->input->post('username')),
                    'users_status' => $this->pregRepn($this->input->post('active'))
                );
                if ($this->accessRights->level_id == 1) {
                    $dataX = array_merge($data, $datalevel);
                } else {
                    $dataX = $data;
                }
                $editUser = $this->mod_global->edit_web1('users_id', $users_id, 'users', $dataX);
                if ($editUser == true){
                    $dataLog = array(
                        'logs_ip' => $this->input->ip_address(),
                        'logs_modul' => 'Hak Akses',
                        'logs_aktifitas' => 'Ubah User',
                        'logs_keterangan' => 'Mengubah data user ID: '.$nik,
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
                    echo "ErrorUser";exit();
                }
            } else {
                if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $new_password)){
                    echo 'notsecure';exit();
                }
                $data = array(
                    'users_mobile'   => $this->pregRepn($this->input->post('mobile')),
                    'users_email'    => $this->pregReps($this->input->post('email')),
                    'users_username' => $this->pregReps($this->input->post('username')),
                    'users_status'   => $this->pregRepn($this->input->post('active')),
                    'users_password' => $this->strEncode($new_password)
                );
                if ($this->accessRights->level_id == 1) {
                    $dataX = array_merge($data, $datalevel);
                } else {
                    $dataX = $data;
                }
                $editUser = $this->mod_global->edit_web1('users_id', $users_id, 'users', $dataX);
                if ($editUser == true){
                    $dataLog = array(
                        'logs_ip' => $this->input->ip_address(),
                        'logs_modul' => 'Hak Akses',
                        'logs_aktifitas' => 'Ubah User',
                        'logs_keterangan' => 'Mengubah data dan password user ID: '.$nik,
                        'logs_user_id' => $this->accessRights->users_id,
                        'logs_username' => $this->accessRights->users_username,
                        'logs_user_name' => $this->accessRights->users_fullname,
                        'logs_website' => 'PORTAL'
                    );
                    $saveLogUser = $this->mod_global->insert_web('web_logs', $dataLog);
                    if ($saveLogUser == true) {
                        echo "Success";
                        $getNewUser = $this->mod_privilege->get_detail_new_user($nik);
                        $getPhone = ($getNewUser->users_mobile == false) ? 0 : $getNewUser->users_mobile;
                        if ($getPhone == 0) {
                            exit();
                        } else {
                            $content = 'User:'.$nik.'. Pass:'.$new_password.'. Mengubah akun disitus web PORTAL HRD PT BSS. SMS Rahasia, jangan disebarkan. https://bit.ly/1BsSHrD' ;
                            $konten = array(
                                'NOM' => $getNewUser->users_mobile,
                                'MSG' => $content
                            );
                            $sendsms = $this->mod_sms->sendsms($konten);
                        }
                        // SEND EMAIL
                        if ($getNewUser->users_email == '' || $getNewUser->users_email == null) {
                            exit();
                        } else {
                            $name     = $nik;
                            $email    = $getNewUser->users_email;
                            $username = $nik;
                            $password = $new_password;
                            $registerDate = date("Y-m-d H:i:s");
                            $lastIP  = $this->input->ip_address();
                            $subject = '[No-Reply] Perubahan password PORTAL HRD PT BINA SARANA SUKSES';
                            $this->sendEmail($email, $name, $password, $username, $registerDate, $lastIP, $subject);
                        }
                    } else {
                        echo "ErrorLog";exit();
                    }
                } else {
                    echo "ErrorUser";exit();
                }
            }
        }

        public function save_nonactive_user(){
            $users_id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $data = array( 'users_status' => 0 );
            $nonAative = $this->mod_global->edit_web1('users_id', $users_id, 'users', $data);
            if ($nonAative == true){
                $datalogs = array(
                    'logs_tanggal'   => date('Y-m-d H:i:s'),
                    'logs_ip'        => $this->input->ip_address(),
                    'logs_modul'     => 'Master User',
                    'logs_aktifitas' => 'Ubah Data',
                    'logs_keterangan' => 'Menonaktifkan user dengan ID : '.$users_id.'',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website' => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }
    }
?>