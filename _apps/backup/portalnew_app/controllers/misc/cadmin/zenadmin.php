<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Zenadmin extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null) :
                $this->session->set_flashdata('notif','Oops! Silahkan login terlebih dahulu.');
                redirect('syslogin');
            endif;
            $this->load->model(['misc/madmin/mod_misc_administrator', 'mod_master']);
            
            $this->dtf_default    = date("Y-m-d H:i:s");
            $this->date_only_def  = date("Y-m-d");
        }

        public function table_admin(){
            $level_id  = $this->session->userdata('level_id');
            $admin_all = $this->mod_misc_administrator->get_datatables();
            $data      = array();
            $no        = $this->input->post('start');
            
            foreach ($admin_all as $field) {
                $no++;
                $tgldaftar = date("Y-m-d", strtotime($field->date_create));
                if ($tgldaftar == $this->date_only_def) {
                    $new = " <span class='badge badge-secondary badge-roundless'>New</span>";
                } else {
                    $new = "";
                }
                $online = $field->is_login;
                $status_online = ($online != 0) ? '<i class="fa fa-circle green"></i> Online' : '<i class="fa fa-circle red"></i> Offline';

                $status = $field->users_status;
                $status_aktif = ($status != 0) ? 'Aktif' : 'Non-Aktif';

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->bssID;
                $row[]  = $field->users_fullname.$new;
                $row[]  = $field->level_name;
                $row[]  = $field->users_mobile;
                $row[]  = $field->users_email;
                $row[]  = $field->users_username;
                $row[]  = date("d/m/Y", strtotime($field->date_create));
                $row[]  = $status_online;
                $row[]  = $status_aktif;
                if ($level_id != 1 && $level_id != 2) {
                    if ($this->session->userdata('users_id') == $field->users_id) {
                        $row[]  = '
                            <button type="button" class="btn btn-gold btn-xs" data-toggle="modal" data-target="#modal-edit-admin" data-level_id="'.$field->level_id.'" data-nik="'.$field->bssID.'" data-name="'.$field->users_fullname.'" data-mobile="'.$field->users_mobile.'" data-email="'.$field->users_email.'" data-username="'.$field->users_username.'" data-aktif="'.$field->users_status.'" data-users_id="'.$field->users_id.'" data-aktif="'.$field->users_status.'">
                                <i class="fa fa-edit"></i>
                            </button>
                            <a class="btn btn-red btn-xs" onClick="alert_user()" id="pdf'.$no.'">
                                <i class="fa fa-trash"></i>
                            </a>';
                    } else {
                        $row[]  = '
                            <a class="btn btn-red btn-xs" onClick="alert_user()" id="pdf'.$no.'">
                                <i class="fa fa-trash"></i>
                            </a>';
                    }
                } else {
                    $row[]  = '
                            <button type="button" class="btn btn-gold btn-xs" data-toggle="modal" data-target="#modal-edit-admin" data-level_id="'.$field->level_id.'" data-nik="'.$field->bssID.'" data-name="'.$field->users_fullname.'" data-mobile="'.$field->users_mobile.'" data-email="'.$field->users_email.'" data-username="'.$field->users_username.'" data-aktif="'.$field->users_status.'" data-users_id="'.$field->users_id.'" data-aktif="'.$field->users_status.'">
                                <i class="fa fa-edit"></i>
                            </button>
                            <a onClick="nonaktifuser('.$field->users_id.')" href="#" class="nonaktifusers btn btn-red btn-xs" id="pdf'.$no.'">
                                <i class="fa fa-trash"></i>
                            </a>
                            ';
                }
                
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_misc_administrator->count_all(),
                 "recordsFiltered" => $this->mod_misc_administrator->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function administrator(){
            $level_id = $this->session->userdata('level_id');
            $data = array(
                'sheader'      => 'pages/ext/sheader',
                'sfooter'      => 'pages/ext/sfooter',
                'totalAdmin'   => $this->mod_misc_administrator->count_all(),
                'listkaryawan' => $this->mod_master->list_karyawan(),
            );
            $this->load->view('pages/misc/vadmin/administrator', $data);
        }

        function clean($string) {
           $string = str_replace(' ', '-', $string);
           return preg_replace('/[^0-9]/', '', $string);
        }

        public function getKaryawan(){
            $data     = $this->input->post('bssID');
            $getkrywn = $this->mod_misc_administrator->getKaryawan($data);

            echo '
                <div class="form-group">
                    <label class="control-label"><b>NIK</b></label>
                    <input type="text" name="bssID" class="form-control required" readonly id="bssID" value="'.$this->clean($getkrywn->NIK).'" data-validate="required">
                </div>
                <div class="form-group">
                    <input type="hidden" name="users_fullname" class="form-control required" id="users_fullname" value="'.$getkrywn->Nama.'" data-validate="required">
                </div>
                <div class="form-group">
                    <label class="control-label"><b>No. Telp</b></label>
                    <input type="text" name="users_mobile" class="form-control required" id="users_mobile" value="'.$this->clean($getkrywn->Telp).'">
                </div>
                <div class="form-group">
                    <label class="control-label"><b>Email</b></label>
                    <input type="text" name="users_email" class="form-control required" id="users_email" value="'.$getkrywn->Email.'">
                </div>
            ';
        }

        public function checkAdmin(){
            $admin  = $this->input->post('users_id');
            $query  = $this->mod_misc_administrator->checkAdmin($admin); 
            $status = "true";
            if($query){
               echo $status = "false";
            } else {             
                echo $status; 
            }
        }

        private static function strEncode($password) { 
            $hasil = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
            return $hasil;
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function add_admin(){
            $admin  = $this->input->post('bssID');
            $getNik = $this->mod_misc_administrator->checkAdmin($admin);
            $status = "Success";
            if ($getNik) {
                echo $status = "false";
            } else {
                $data = array(
                    'level_id'       => $this->input->post('level_id'),
                    'bssID'          => $this->input->post('bssID'),
                    'users_fullname' => $this->input->post('users_fullname'),
                    'users_email'    => $this->input->post('users_email'),
                    'users_mobile'   => $this->input->post('users_mobile'),
                    'users_username' => $this->input->post('users_username'),
                    'users_password' => $this->strEncode($this->input->post('users_password')),
                    'date_create'    => $this->dtf_default,
                    'is_login'       => 0,
                    'users_status'   => 1
                );
                $insertadmin = $this->mod_misc_administrator->add_administrator($data);
                if ($insertadmin) {
                    echo "Success";
                } else {
                    echo "Error";
                }
            }
        }

        public function edit_admin(){
            $level_id = $this->pregRepn($this->input->post('level_id'));
            $users_id = $this->pregRepn($this->input->post('users_ids'));
            $password = $this->input->post('users_password');

            // $getpass  = $this->mod_misc_administrator->getpassuser($users_id);
            
            $data = array(
                'level_id'       => $level_id,
                'users_email'    => (empty($this->input->post('users_email'))) ? '' : $this->input->post('users_email'),
                'users_mobile'   => (empty($this->input->post('users_mobile'))) ? '' : $this->input->post('users_mobile'),
                'users_username' => (empty($this->input->post('users_username'))) ? '' : $this->input->post('users_username'),
                'users_password' => (empty($this->input->post('users_password'))) ? '' : $this->strEncode($this->input->post('users_password')),
                'users_status'   => (empty($this->input->post('users_status'))) ? '' : $this->input->post('users_status'),
            );
            $updateadmin = $this->mod_misc_administrator->edit_administrator($users_id, $data);
            if ($updateadmin) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function nonaktifuser($users_id){
            $users_id = $this->input->post('users_id');
            $data     = array('users_status' => 0);
            $updatestatususer = $this->mod_misc_administrator->update_statususer($users_id, $data);
            echo json_encode($updatestatususer);
        } 
    }
?>