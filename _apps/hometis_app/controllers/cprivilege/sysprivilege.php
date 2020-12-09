<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprivilege extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mprivilege/mod_privilege', 'mglobal/mod_global', 'msms/mod_sms']);
            if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null){
                redirect('logisisse');
            } else {
                $changePass = $this->mod_global->get_change_password($this->session->userdata('id_user'));
                if ($changePass == 'false') {
                    redirect('menu/site');
                } else {
                    $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('master_user'));
                    if ($this->accessRights==null){
                        show_404('', false);
                    } elseif ($this->accessRights!=null && $this->accessRights->site !== $this->uri->segment(3) || $this->accessRights->status_active !== 1){
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/site');
                    } elseif ($this->accessRights!=null && $this->accessRights->read !== 1 || $this->accessRights->status_active !== 1){
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/dashboard/'.$this->uri->segment(3));
                    }
                }
            }
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

        private static function strEncode($password){ 
            return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

        private function randomPassword(){
		    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		    $pass = array();
		    $alphaLength = strlen($alphabet) - 1;
		    for ($i = 0; $i < 8; $i++){
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }
		    return implode($pass);
		}

        private function in_array_r($needle, $haystack, $strict = false){
            foreach ($haystack as $item){
                if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))){
                    return true;
                }
            }
            return false;
        }

        private function searchForId($search_value, $array, $id_path){ 
            foreach ($array as $key1 => $val1) {
                $temp_path = $id_path;
                array_push($temp_path, $key1);
                if(is_array($val1) and count($val1)) {
                    foreach ($val1 as $key2 => $val2) {
                        if($val2 == $search_value) {
                            array_push($temp_path, $key2); 
                            return join(" --> ", $temp_path); 
                        }
                    }
                } elseif($val1 == $search_value) {  return join(" --> ", $temp_path); }
            }
            return null;
        }

        private function sendEmail($email, $name, $password, $username, $registerDate, $lastIP, $subject){
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
                'name'         => $name,
                'username'     => $username,
                'password'     => $password,
                'lastIP'       => $lastIP,
                'registerDate' => $registerDate
            );
            $body = $this->load->view('pages/ptemp/vemail_temp.php',$data,TRUE);
            $this->email->subject("[No-Reply] ".$subject." HOMETIS PT BINA SARANA SUKSES");
            $this->email->message($body);
            return $this->email->send();
        }

        public function master_user($site){
            $data = array(
                'header'        => 'pages/ext/header',
                'footer'        => 'pages/ext/footer',
                'topmenu'       => 'pages/ptopbar/vtopbar',
                'content'       => 'pages/pprivilege/vprivilege',
                'sidemenu'      => $this->mod_global->sidemenu($this->accessRights->id_user, $site),
                'list_employee' => $this->mod_privilege->list_employee(),
                'list_user'     => $this->mod_privilege->list_user(),
                'list_level'    => $this->mod_privilege->list_level(),
                'accessRights'  => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/buttons.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/select2/dist/css/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/dataTables.buttons.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/buttons.html5.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/select2/dist/js/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_privilege(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $privilege = $this->mod_privilege->get_privilege($length, $start);
            foreach ($privilege as $field){
            	if ($field->status_active == 1) {
            		$status_active = '<span class="label bg-green">Active</span>';
            	} else {
            		$status_active = '<span class="label bg-gray">Non-active</span>';
            	}
                $start++;
				$row             = array();
				$row['no']       = $start;
				$row['nik']      = $field->NIK;
				$row['fullname'] = $field->fullname;
				$row['mobile']   = $field->mobile;
				$row['last']     = ($field->login_time == null)? '-' : date("d-m-Y H:i A", strtotime($field->login_time));
                $row['level']    = $field->level_name;
				$row['status']   = $status_active;
				$row['module']   = '<a data-target="#modal-module" data-toggle="modal" data-nik="'.$field->NIK.'" data-id_user="'.$this->my_encryption->encode($field->id).'" onclick="getModule(\''.$this->my_encryption->encode($field->id).'\');" class="btn btn-xs bg-tosca" data-tooltip="Detail Module User"><i class="fas fa-th-list"></i></a>';
				$row['detail']   = '<a data-target="#modal-edit-user" data-toggle="modal" class="btn btn-xs bg-gray" data-tooltip="Edit User" data-id_user="'.$this->my_encryption->encode($field->id).'" data-fullname="'.$field->fullname.'" data-mobile="'.$field->mobile.'" data-email="'.$field->email.'" data-active="'.$field->status_active.'" data-nik='.$field->NIK.' data-username="'.$field->username.'" data-level="'.$field->id_level.'" ><i class="fas fa-pen f10"></i></a>';
				$data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_privilege->count_all_privilege(),
                "recordsFiltered" => $this->mod_privilege->count_filtered_privilege(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function get_module_user($site){
			$id_user = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            if ($id_user == null || $id_user == "")
                return false;
			$getModuleUser = $this->mod_privilege->get_module_user($id_user);
			$getModule = $this->mod_privilege->get_module();
			$getsite = $this->mod_privilege->get_site_registered();
			$no = 0;
            $i = 0;
			foreach ($getsite as $field) {
				if ($field->status_active == 1) {
            		$status_active = '<span class="label bg-green">Active</span>';
            	} else {
            		$status_active = '<span class="label bg-gray text-red">Non-active</span>';
            	}
				$no++;
				echo '
				<input name="site'.$no.'" type="hidden" value="'.$field->code.'">
              	<div class="box-group hand" id="accordion'.$no.'">
                	<div class="panel box no-radius">
	                  	<div class="box-header no-border" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$no.'">
	                    	<h4 class="box-title">
		                        '.$no.'. '.$field->name.' ['.$field->code.'] '.$status_active.'
	                    	</h4>
	                  	</div>
                  		<div id="collapse'.$no.'" class="panel-collapse collapse">
		                    <div class="box-body">';
                                if ($this->accessRights->id_level == 1) {
                                    foreach ($getModule as $row){
                                        echo '
                                        <ul class="todo-list ui-sortable">
                                            <li>
                                                <span class="handle ui-sortable-handle"><i class="fas fa-angle-right"></i></span>
                                                <input type="checkbox" onclick="checkAccess(\'module'.$i.'\')" name="module['.$i.']" id="module'.$i.'"';
                                                foreach ($getModuleUser as $key) {
                                                    if ($key->name == $row->name && $key->site == $field->code){
                                                        echo 'checked';
                                                        break;
                                                    }
                                                }
                                        echo ' value="'.$row->id.'" style="top:3px;" >
                                                <label class="text no-margin" for="module'.$i.'">'.$row->description.'</label>
                                            </li>
                                        </ul>                                        
                                        <div class="box-body" id="cbmodule'.$i.'">';
                                            $access = array('create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1, 'export' => 1, 'import' => 1);
                                            $getModUserAcc = $this->mod_privilege->get_module_user_based_access($id_user, $row->id, $field->code);
                                            foreach ($access as $index => $value) {
                                                echo '
                                                <div class="col-md-2">
                                                    <div class="checkbox">
                                                        <label class="text no-margin" for="'.$index.'_'.$i.'">
                                                            <input type="checkbox" name="'.$index.'_'.$i.'" id="'.$index.'_'.$i.'" ';
                                                            if ( $getModUserAcc!==false && isset($getModUserAcc->{$index}) && $getModUserAcc->{$index} == '1' ){
                                                                echo 'checked';
                                                            }                                            
                                                            echo ' value="'.$value.'" >
                                                        '.ucfirst($index).'</label>
                                                    </div>
                                                </div>';
                                            }
                                            $i++;
                                        echo '</div>';
                                    }
                                } else {
                                    foreach ($getModule as $row){
                                        if ($row->name !== 'hm_detail' && $row->name !== 'master_system' && $row->name !== 'master_system_version' && $row->name !== 'master_system_module' && $row->name !== 'master_site' ){
                                            echo '
                                            <ul class="todo-list ui-sortable">
                                                <li>
                                                    <span class="handle ui-sortable-handle"><i class="fas fa-angle-right"></i></span>
                                                    <input type="checkbox" onclick="checkAccess(\'module'.$i.'\')" name="module['.$i.']" id="module'.$i.'"';
                                                    foreach ($getModuleUser as $key) {
                                                        if ($key->name == $row->name && $key->site == $field->code){
                                                            echo 'checked';
                                                            break;
                                                        }
                                                    }
                                            echo ' value="'.$row->id.'"  style="top:3px;" >
                                                    <label class="text no-margin" for="module'.$i.'">'.$row->description.'</label>
                                                </li>
                                            </ul>
                                                <div class="box-body" id="cbmodule'.$i.'">';
                                                    $access = array('create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1, 'export' => 1, 'import' => 1);
                                                    $getModUserAcc = $this->mod_privilege->get_module_user_based_access($id_user, $row->id, $field->code);
                                                    foreach ($access as $index => $value) {
                                                        echo '
                                                        <div class="col-md-2">
                                                            <div class="checkbox">
                                                                <label class="text no-margin" for="'.$index.'_'.$i.'">
                                                                    <input type="checkbox" name="'.$index.'_'.$i.'" id="'.$index.'_'.$i.'" ';
                                                                    if ( $getModUserAcc!==false && isset($getModUserAcc->{$index}) && $getModUserAcc->{$index} == '1' ){
                                                                        echo 'checked';
                                                                    }                                            
                                                                    echo ' value="'.$value.'" >
                                                                '.ucfirst($index).'</label>
                                                            </div>
                                                        </div>';
                                                    }
                                                    $i++;
                                            echo '</div>';
                                        }
                                    }
                                }
		    			echo '</div>
                  		</div>
                	</div>
              	</div>';
			}
        }

        public function check_user($site){
			$nik  = $this->pregRepn($this->input->post('nik_add'));
			$query = $this->mod_privilege->check_user($nik);
            if($query){
                echo $status = "false";
            } else {
                echo $status = "true";
            }
        }

        public function check_old_password($site){
            $password = $this->pregReps($this->input->post('old_password'));
            $nik   = $this->pregRepn($this->input->post('nik'));
            $query = $this->mod_privilege->check_password($nik, $password); 
            if($query == true) {
                echo $status = 'true';
            } else {             
                echo $status = 'false'; 
            }
        }

        public function get_employee($site){
            $nik = $this->pregRepn($this->input->post('opt'));
            if ($nik == null || $nik == '') {
                echo '<b class="text-red">Choose employee first!</b>';
                exit();
            } else {
                $getkrywn = $this->mod_privilege->get_employee($nik);
                echo '
                    <div style="padding: 15px;"></div>
                    <input type="hidden" name="fullname" id="fullname" class="form-control required" maxlength="150" value="'.$this->pregReps($getkrywn->Nama).'">
                    <div class="form-group">
                        <label class="control-label">Mobile Phone</label>
                        <input type="text" name="mobile" id="mobile" class="form-control _CnUmB required" maxlength="25" value="'.$this->pregReps($getkrywn->Telp).'">
                        <span><em>If the user has two mobile numbers, please choose one of them which is active.</em></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control required" maxlength="150" value="'.$this->pregReps($getkrywn->Email).'">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control _CnUmB required" maxlength="10" value="'.$this->pregRepn($getkrywn->NIK).'">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="text" name="password" id="password" class="form-control _CalPhaNum required" maxlength="20" value="'.$this->randomPassword().'">
                    </div>
                ';
            }
        }

        public function save_add_user($site){
            if ($this->accessRights->update == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $nik = $this->pregRepn($this->input->post('nik_add'));
            if ($nik == null || $nik == '') {
                echo "Error NIK";
                exit();
            }
            $getUser = $this->mod_privilege->get_detail_new_user($nik);
            if ($getUser !== false ) {
                echo "registered";
                exit();
            }
            $data = array(
                'id_level' => $this->pregRepn($this->input->post('level_add')),
                'NIK'      => $nik,
                'fullname' => $this->pregReps($this->input->post('fullname')),
                'mobile'   => $this->pregRepn($this->input->post('mobile')),
                'email'    => $this->pregReps($this->input->post('email')),
                'username' => $this->pregReps($this->input->post('username')),
                'password' => $this->strEncode($this->pregReps($this->input->post('password'))),
                'status_active' => 1
            );
            $saveUser = $this->mod_global->insert_all('mst_user', $data);
            if ($saveUser == true){
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Adding user : '.$nik,
                    'ip_address' => $this->input->ip_address(),
                    'input_time' => date("Y-m-d H:i:s")
                );
                $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLogUser == true) {
                    echo "Success";
                    $getNewUser = $this->mod_privilege->get_detail_new_user($nik);
                    $getPhone = ($getNewUser->mobile == false) ? 0 : $getNewUser->mobile;
                    if ($getPhone == 0) {
                        exit();
                    } else {
                        $content = 'User:'.$nik.'. Pass:'.$this->pregReps($this->input->post('password')).'. Anda terdaftar diwebsite HOMETIS PT BSS. SMS rahasia, mhn jgn disebarkan. https://bit.ly/4BssHmtis' ;
                        $konten = array(
                            'NOM' => $getNewUser->mobile,
                            'MSG' => $content
                        );
                        $sendsms = $this->mod_sms->sendsms($konten);
                    }

                    // SEND EMAIL
                    if ($getNewUser->email == '' || $getNewUser->email == null) {
                        exit();
                    } else {
                        $name         = $nik;
                        $email        = $getNewUser->email;
                        $username     = $nik;
                        $password     = $this->pregReps($this->input->post('password'));
                        $registerDate = $getNewUser->insert_time;
                        $lastIP       = $this->input->ip_address();
                        $subject      = 'Redistered Account';
                        $this->sendEmail($email, $name, $password, $username, $registerDate, $lastIP, $subject);
                    }
                } else {
                    echo "Error Log";
                    exit();
                }
            } else {
                echo "Error User";
                exit();
            }
        }

        public function save_edit_user($site){
            if ($this->accessRights->update == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id_user      = $this->my_encryption->decode($this->pregReps($this->input->post('id_user')));
            $nik          = $this->pregRepn($this->input->post('nik'));
            $new_password = $this->pregPass($this->input->post('new_password'));
            $datalevel    = array('id_level' => $this->pregRepn($this->input->post('level')));
            if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $new_password)){
                echo 'notsecure';
                exit();
            }
            if ($new_password == "" || $new_password == null) {
                $data = array(
                    'fullname' => $this->pregReps($this->input->post('fullname')),
                    'mobile'   => $this->pregRepn($this->input->post('mobile')),
                    'email'    => $this->pregReps($this->input->post('email')),
                    'username' => $this->pregReps($this->input->post('username')),
                    'status_active' => $this->pregRepn($this->input->post('active'))
                );
                if ($this->accessRights->id_level == 1) {
                    $dataX = array_merge($data, $datalevel);
                } else {
                    $dataX = $data;
                }
                $editUser = $this->mod_global->edit_all('id', $id_user, 'mst_user', $dataX);
                if ($editUser == true){
                    $dataLog = array(
                        'id_user'    => $this->accessRights->id_user,
                        'id_module'  => $this->accessRights->id_module,
                        'logs'       => 'Edit user : '.$nik,
                        'ip_address' => $this->input->ip_address(),
                        'input_time' => date("Y-m-d H:i:s")
                    );
                    $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                    if ($saveLogUser == true) {
                        echo "Success";
                    } else {
                        echo "Error Log";
                        exit();
                    }
                } else {
                    echo "Error User";
                    exit();
                }
            } else {
                $data = array(
                    'fullname' => $this->pregReps($this->input->post('fullname')),
                    'mobile'   => $this->pregRepn($this->input->post('mobile')),
                    'email'    => $this->pregReps($this->input->post('email')),
                    'username' => $this->pregReps($this->input->post('username')),
                    'password' => $this->strEncode($new_password),
                    'status_active' => $this->pregRepn($this->input->post('active'))
                );
                if ($this->accessRights->id_level == 1) {
                    $dataX = array_merge($data, $datalevel);
                } else {
                    $dataX = $data;
                }
                $editUser = $this->mod_global->edit_all('id_user', $id_user, 'mst_user', $dataX);
                if ($editUser == true){
                    $dataLog = array(
                        'id_user'    => $this->accessRights->id_user,
                        'id_module'  => $this->accessRights->id_module,
                        'logs'       => 'Edit user : '.$nik,
                        'ip_address' => $this->input->ip_address(),
                        'input_time' => date("Y-m-d H:i:s")
                    );
                    $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                    if ($saveLogUser == true) {
                        echo "Success";
                        $getNewUser = $this->mod_privilege->get_detail_new_user($nik);
                        $getPhone = ($getNewUser->mobile == false) ? 0 : $getNewUser->mobile;
                        if ($getPhone == 0) {
                            exit();
                        } else {
                            $content = 'User:'.$nik.'. Pass:'.$new_password.'. Perubahan akun HOMETIS PT BSS. SMS rahasia, mhn jgn disebarkan. https://bit.ly/4BssHmtis' ;
                            $konten = array(
                                'NOM' => $getNewUser->mobile,
                                'MSG' => $content
                            );
                            $sendsms = $this->mod_sms->sendsms($konten);
                        }
                        // SEND EMAIL
                        if ($getNewUser->email == '' || $getNewUser->email == null) {
                            exit();
                        } else {
                            $name         = $nik;
                            $email        = $getNewUser->email;
                            $username     = $nik;
                            $password     = $this->pregReps($this->input->post('password'));
                            $registerDate = $getNewUser->insert_time;
                            $lastIP       = $this->input->ip_address();
                            $subject      = 'Changes Data Account';
                            $this->sendEmail($email, $name, $password, $username, $registerDate, $lastIP, $subject);
                        }
                    } else {
                        echo "Error Log";
                        exit();
                    }
                } else {
                    echo "Error User";
                    exit();
                }
            }
        }

        public function save_edit_password($site){
            $password  = $this->pregPass($this->input->post('new_password'));
            $nik       = $this->pregRepn($this->input->post('nik'));
            $check_old = $this->mod_privilege->check_password($nik, $password); 
            if ($check_old == true){
                echo "same";
                exit();
            }
            if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)){
                echo 'notsecure';
                exit();
            }
            $data = array( 'password' => $this->strEncode($password));
            $saveNewPass = $this->mod_global->edit_all('NIK', $nik, 'mst_user', $data);
            if ($saveNewPass == true){
                $datalogs = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Change Password',
                    'ip_address' => $this->input->ip_address(),
                    'input_time' => date("Y-m-d H:i:s")
                );
                $this->mod_global->insert_all('mst_user_log', $datalogs);
                echo "Success";

                // SEND SMS
                $getUser    = $this->mod_privilege->get_detail_new_user($nik);
                $checkPhone = ($getUser->mobile == false) ? 0 : $getUser->mobile;
                if ($checkPhone == 0) {
                    exit();
                } else {
                    $content = 'User:'.$nik.'. Pass Baru:'.$password.'. Anda telah melakukan perubahan password akun HOMETIS PT BSS. SMS rahasia, mhn jgn disebarkan. https://bit.ly/4BssHmtis' ;
                    $konten = array(
                        'NOM' => $getUser->mobile,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_sms->sendsms($konten);
                }

                // SEND EMAIL
                if ($getUser->email == '' || $getUser->email == null) {
                    exit();
                } else {
                    $email      = $getUser->email;
                    $name       = $getUser->nama;
                    $username   = $nik;
                    $password   = $password;
                    $updateDate = $getUser->update_date;
                    $lastIP     = $getUser->last_ip;
                    $subject    = 'Changes Data Account';
                    $this->sendEmail($email, $name, $password, $username, $updateDate, $lastIP, $subject);
                } 
            } else {
                echo "Error";
            }
        }

        public function save_edit_module_user($site){
            if ($this->accessRights->update !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";
                exit();
            }
            $formdata  = $this->input->post('formdata');
            $value     = json_decode($formdata, true);
            $getmodule = $this->mod_global->get_module();
            $dtmodule  = $dtpriv = [];
            $id_user   = $this->my_encryption->decode($value[0]['value']);
            $getsite   = $this->mod_global->get_site();
            $dtindex   = $dtarray = [];
            for ($i=0; $i < count($getsite); $i++){ 
                $getIndex = $this->searchForId($getsite[$i], $value, []);
                $expl = explode(' --> ', $getIndex);
                $index = $expl[0];
                $dtindex[] = $index;
            }
            asort($dtindex);
            $dtindex = array_values($dtindex);
            for ($i=0; $i < count($dtindex); $i++){
                $idx =  $dtindex[$i];
                $batas = isset($dtindex[$i+1]) ? ($dtindex[$i+1]) : count($value);
                $dtarray[$i] = [
                    'indexsite' => $idx,
                    'site'      => $value[$idx]['value']
                ];
                for($a = ($idx+1); $a < $batas; $a++){
                    if(strpos($value[$a]['name'],'module') !==false){
                        $idmod = $value[$a]['value'];
                        $dtarray[$i]['module'][$idmod] = [];
                    } else {
                        if (!isset($idmod))
                            continue;
                        $mkindex = explode('_', $value[$a]['name']);
                        $dtarray[$i]['module'][$idmod][$mkindex[0]] = $value[$a]['value'];
                    }
                }
            }
            $idpriv = [];
            for($i=0; $i < count($dtarray); $i++){
                if (!isset($dtarray[$i]['module'])) 
                    continue;
                foreach($dtarray[$i]['module'] as $id_module => $privVal){
                    $site = $dtarray[$i]['site'];
                    $checkModule = $this->mod_global->check_module_user_exist($id_user, $id_module, $site);
                    if ($checkModule === true){
                        $dataupdate = array('status_active' => 1);
                        $dataupdate = array_merge($dataupdate, $privVal);
                        if (!isset($dataupdate['create']))
                            $dataupdate['create'] = 0;
                        if (!isset($dataupdate['read']))
                            $dataupdate['read'] = 0;
                        if (!isset($dataupdate['update']))
                            $dataupdate['update'] = 0;
                        if (!isset($dataupdate['delete']))
                            $dataupdate['delete'] = 0;
                        if (!isset($dataupdate['export']))
                            $dataupdate['export'] = 0;
                        if (!isset($dataupdate['import']))
                            $dataupdate['import'] = 0;
                        $editMod = $this->mod_global->edit_module_user($id_user, $id_module, $site, $dataupdate);
                        $dataupdate = [];
                    } else {
                        $dataarray = array(
                            'id_user'       => $id_user,
                            'id_module'     => $id_module,
                            'site'          => $site,
                            'status_active' => '1'
                        );
                        foreach ($privVal as $privIndex => $privVals){
                            $dataarray[$privIndex] = $privVals;
                        }
                        if (!isset($dataarray['create']))
                            $dataarray['create'] = 0;
                        if (!isset($dataarray['read']))
                            $dataarray['read'] = 0;
                        if (!isset($dataarray['update']))
                            $dataarray['update'] = 0;
                        if (!isset($dataarray['delete']))
                            $dataarray['delete'] = 0;
                        if (!isset($dataarray['export']))
                            $dataarray['export'] = 0;
                        if (!isset($dataarray['import']))
                            $dataarray['import'] = 0;
                        $editMod = $this->mod_global->insert_all('mst_user_module', $dataarray);
                        $dataarray = [];
                    }
                    if($getIDuserMod = $this->mod_global->get_id_user_module($id_user, $id_module, $site)){
                        $idpriv[] = $getIDuserMod->id;
                    }
                }
            }
            $dataupdatex = array('status_active' => 0, 'create' => 0, 'read' => 0, 'update' => 0, 'delete' => 0, 'export' => 0, 'import' => 0);
            $editModLast = $this->mod_global->edit_not_in($id_user, 'id', $idpriv, 'mst_user_module', $dataupdatex);
            $dataLog = array(
                'id_user'    => $this->accessRights->id_user,
                'id_module'  => $this->accessRights->id_module,
                'logs'       => 'Changes module and access rights',
                'ip_address' => $this->input->ip_address(),
                'input_time' => date("Y-m-d H:i:s")
            );
            $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
            if ($editMod == true) {
                echo "Success";
            } else {
                echo "Error";
                exit();
            }
        }

    }
?>