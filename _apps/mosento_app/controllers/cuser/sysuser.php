<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysuser extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('master_user'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/site');
                } elseif ($this->accessRights!=null && $this->accessRights->read != 1 || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                } elseif ($this->accessRights->id_level != 1 && $this->accessRights->id_level != 2) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                }
            }
            $this->load->model(['muser/mod_user', 'msms/mod_sms']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function strEncode($password) { 
            return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

        private static function pregPass($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
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

        public function master_user($site){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/puser/vuser',
                'accessRights' => $this->accessRights,
                'list_user'     => $this->mod_user->list_user(),
                'list_employee' => $this->mod_user->list_employee(),
                'list_level'    => $this->mod_user->list_level(),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_user($site){
            $data = array();
            $start = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $user = $this->mod_user->get_user($length, $start);
            foreach ($user as $field){
                if ($field->status_active == 1){
                    $status = '<span class="text-green">Active</span>';
                } else {
                    $status = '<span class="text-red">Not Active</span>';
                }
                if ($field->login_time == null) {
                    $login_time = "<small>haven't logged in yet</small>";
                } else {
                    $login_time = $field->login_time;
                }
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['nik'] = $field->nik;
                $row['nama'] = $field->fullname;
                $row['type']  = $field->name;
                $row['last_login'] = '<span class="hidden">'.strtotime($field->login_time).'</span>'.$login_time;
                $row['status'] = $status;
                $row['module'] = '<a data-target="#modal-module" data-toggle="modal" data-nik="'.$field->nik.'" data-id_user="'.$this->my_encryption->encode($field->id_user).'" onclick="getModule(\''.$this->my_encryption->encode($field->id_user).'\');" class="btn btn-xs btn-default" data-tooltip="Detail Module User"><i class="fas fa-tasks"></i></a>';
                $row['action'] = '<a data-target="#modal-edit-user" data-toggle="modal" class="btn btn-xs btn-danger" data-tooltip="Edit" data-id_user="'.$this->my_encryption->encode($field->id_user).'" data-fullname="'.$field->fullname.'" data-mobile="'.$field->phone.'" data-email="'.$field->email.'" data-active="'.$field->status_active.'" data-nik='.$field->nik.' data-username="'.$field->username.'" data-level="'.$field->id_level.'" ><i class="fas fa-pen f10"></i></a>';
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_user->count_all_user(),
                "recordsFiltered" => $this->mod_user->count_filtered_user(),
                "data" => $data
            );
            echo json_encode($output);
        }

        public function get_module_user($site){
            $id_user = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            if ($id_user == null || $id_user == "")
                return false;
            $getModuleUser = $this->mod_user->get_module_user($id_user);
            $getModule = $this->mod_user->get_module();
            $getsite = $this->mod_user->get_site_registered();
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
                <div class="box-group hand" id="accordion'.$no.'" data-tooltip="Click me!">
                    <div class="no-radius">
                        <div class="box-header" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$no.'" style="border-bottom: 4px solid #ddd;">
                            <h4 class="box-title">
                                '.$no.'. '.$field->name.' ['.$field->code.'] '.$status_active.'
                            </h4>
                            <i class="fas fa-angle-down pull-right f20 text-gray"></i>
                        </div>
                        <div id="collapse'.$no.'" class="panel-collapse collapse">
                            <div class="box-body">';
                                if ($this->accessRights->id_level == 1) {
                                    foreach ($getModule as $row){
                                        echo '
                                        <div style="border-bottom:1px solid #ddd">
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
                                        echo ' value="'.$row->id_module.'" style="top:3px;" >
                                                <label class="text no-margin hand" for="module'.$i.'">'.$row->description.'</label>
                                            </li>
                                        </ul>                                        
                                        <div class="box-body" id="cbmodule'.$i.'">';
                                            $access = array('create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1, 'export' => 1, 'import' => 1);
                                            $getModUserAcc = $this->mod_user->get_module_user_based_access($id_user, $row->id_module, $field->code);
                                            foreach ($access as $index => $value) {
                                                echo '
                                                <div class="col-md-2">
                                                    <div class="checkbox" style="margin-top:5px;margin-bottom:5px;">
                                                        <label class="text no-margin hand f12" for="'.$index.'_'.$i.'">
                                                            <input type="checkbox" name="'.$index.'_'.$i.'" id="'.$index.'_'.$i.'" ';
                                                            if ( $getModUserAcc!==false && isset($getModUserAcc->{$index}) && $getModUserAcc->{$index} == '1' ){
                                                                echo 'checked';
                                                            }                                            
                                                            echo ' value="'.$value.'">
                                                        '.ucfirst($index).'</label>
                                                    </div>
                                                </div>';
                                            }
                                            $i++;
                                        echo '</div></div>';
                                    }
                                } else {
                                    foreach ($getModule as $row){
                                        if ($row->name !== 'master_unit' && $row->name !== 'master_variable' && $row->name !== 'master_site' && $row->name !== 'master_module' && $row->name !== 'master_system' && $row->name !== 'master_logs' ){
                                            echo '
                                            <div style="border:1px solid #ddd">
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
                                            echo ' value="'.$row->id_module.'"  style="top:3px;" >
                                                    <label class="text no-margin hand" for="module'.$i.'">'.$row->description.'</label>
                                                </li>
                                            </ul>
                                                <div class="box-body" id="cbmodule'.$i.'">';
                                                    $access = array('create' => 1, 'read' => 1, 'update' => 1, 'delete' => 1, 'export' => 1, 'import' => 1);
                                                    $getModUserAcc = $this->mod_user->get_module_user_based_access($id_user, $row->id_module, $field->code);
                                                    foreach ($access as $index => $value) {
                                                        echo '
                                                        <div class="col-md-2">
                                                            <div class="checkbox">
                                                                <label class="text no-margin hand" for="'.$index.'_'.$i.'">
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
                                            echo '</div></div>';
                                        }
                                    }
                                }
                            echo '</div>
                        </div>
                    </div>
                </div>';
            }
        }

        public function save_edit_module_user($site){
            if ($this->accessRights->update !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";exit();
            }
            $formdata  = $this->input->post('formdata');
            $value     = json_decode($formdata, true);
            $getmodule = $this->mod_user->get_module();
            $dtmodule  = $dtpriv = [];
            $id_user   = $this->my_encryption->decode($value[0]['value']);
            $getsite   = $this->mod_user->get_site();
            $dtindex   = $dtarray = [];
            for ($i=0; $i < count($getsite); $i++){ 
                $getIndex = $this->searchForId($getsite[$i], $value, []);
                $expl = explode(' --> ', $getIndex);
                $index = $expl[0];
                $dtindex[] = $index;
            }
            asort($dtindex);
            $dtindex = array_values($dtindex);
            for ($i=0; $i<count($dtindex); $i++){
                $idx = $dtindex[$i];
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
                    $checkModule = $this->mod_user->check_module_user_exist($id_user, $id_module, $site);
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
                        $editMod = $this->mod_user->edit_module_user($id_user, $id_module, $site, $dataupdate);
                        $dataupdate = [];
                    } else {
                        $dataarray = array(
                            'id_user'   => $id_user,
                            'id_module' => $id_module,
                            'site'      => $site
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
                        $editMod = $this->mod_global->insert_all('mos_user_module', $dataarray);
                        $dataarray = [];
                    }
                    if($getIDuserMod = $this->mod_user->get_id_user_module($id_user, $id_module, $site)){
                        $idpriv[] = $getIDuserMod->id;
                    }
                }
            }
            $dataupdatex = array('status_active' => 0, 'create' => 0, 'read' => 0, 'update' => 0, 'delete' => 0, 'export' => 0, 'import' => 0);
            $editModLast = $this->mod_user->edit_not_in($id_user, 'id_user', $idpriv, 'mos_user_module', $dataupdatex);
            $dataLog = array(
                'id_user'    => $this->accessRights->id_user,
                'id_module'  => $this->accessRights->id_module,
                'logs'       => 'Changes module and access user ID: '.$id_user,
                'ip_address' => $this->input->ip_address(),
                'insert_time' => date("Y-m-d H:i:s")
            );
            $saveLogUser = $this->mod_global->insert_all('mos_user_log', $dataLog);
            if ($editMod == true) {
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function get_employee($site){
            $nik = $this->pregRepn($this->input->post('opt'));
            if ($nik == null || $nik == '') {
                echo '<b class="text-red">Choose employee first!</b>';
                exit();
            } else {
                $getkrywn = $this->mod_user->get_employee($nik);
                echo '
                    <div style="padding: 15px;"></div>
                    <div class="form-group hidden">
                        <input type="text" name="fullname" class="form-control required" value="'.$this->pregReps($getkrywn->Nama).'">
                        <input type="text" name="position" class="form-control required" value="'.$this->pregReps($getkrywn->jabatan).'">
                        <input type="text" name="kodest" class="form-control required" value="'.$this->pregReps($getkrywn->KodeST).'">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Mobile Phone</label>
                        <input type="text" name="mobile" class="form-control _CnUmB required" maxlength="25" value="'.$this->pregReps($getkrywn->Telp).'">
                        <span><em>If the user has two mobile numbers, please choose one of them which is active.</em></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="text" name="email" class="form-control _CalPhaNum required" maxlength="100" value="'.$this->pregReps($getkrywn->Email).'">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <input type="text" name="username" class="form-control _CnUmB required" maxlength="15" value="'.$this->pregRepn($getkrywn->NIK).'">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="text" name="password" class="form-control _CalPhaNum required" maxlength="15" value="'.$this->pregRepn($getkrywn->NIK).'">
                    </div>
                ';
            }
        }

        public function check_user($site){
            $nik  = $this->pregRepn($this->input->post('nik_add'));
            $query = $this->mod_user->check_user($nik);
            if($query){
                echo $status = "false";
            } else {
                echo $status = "true";
            }
        }

        public function save_add_user($site){
            if ($this->accessRights->create == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $nik = $this->pregRepn($this->input->post('nik'));
            if ($nik == null || $nik == '') {
                echo "ErrorNIK";
                exit();
            }
            $getUser = $this->mod_user->check_user($nik);
            if ($getUser !== false ) {
                echo "registered";
                exit();
            }
            $data = array(
                'id_level' => $this->pregRepn($this->input->post('level')),
                'nik'      => $nik,
                'fullname' => $this->pregReps($this->input->post('fullname')),
                'phone'    => $this->pregRepn($this->input->post('mobile')),
                'email'    => $this->pregReps($this->input->post('email')),
                'username' => $this->pregRepn($this->input->post('username')),
                'password' => $this->strEncode($this->pregRepn($this->input->post('password'))),
                'jabatan'  => $this->pregReps($this->input->post('jabatan')),
                'kodest'   => $this->pregReps($this->input->post('kodest'))
            );
            $saveUser = $this->mod_global->insert_all('mos_user', $data);
            if ($saveUser == true){
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Adding user : '.$nik,
                    'ip_address' => $this->input->ip_address(),
                    'insert_time' => date("Y-m-d H:i:s")
                );
                $saveLogUser = $this->mod_global->insert_all('mos_user_log', $dataLog);
                if ($saveLogUser == true) {
                    echo "Success";
                    // $getNewUser = $this->mod_user->get_detail_new_user($nik);
                    // $getPhone = ($getNewUser->mobile == false) ? 0 : $getNewUser->mobile;
                    // if ($getPhone == 0) {
                    //     exit();
                    // } else {
                    //     $content = 'User:'.$nik.'. Pass:'.$nik.'. You are registered on the PT BSS MOSENTO website. Secret SMS, dont share it. https://bit.ly/2BsSMos' ;
                    //     $konten = array(
                    //         'NOM' => $getNewUser->mobile,
                    //         'MSG' => $content
                    //     );
                    //     $sendsms = $this->mod_sms->sendsms($konten);
                    // }

                    // SEND EMAIL
                    // if ($getNewUser->email == '' || $getNewUser->email == null) {
                    //     exit();
                    // } else {
                    //     $name         = $nik;
                    //     $email        = $getNewUser->email;
                    //     $username     = $nik;
                    //     $password     = $this->pregReps($this->input->post('password'));
                    //     $registerDate = $getNewUser->insert_time;
                    //     $lastIP       = $this->input->ip_address();
                    //     $subject      = 'Redistered Account';
                    //     $this->sendEmail($email, $name, $password, $username, $registerDate, $lastIP, $subject);
                    // }
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorUser";exit();
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
            if ($new_password == "" || $new_password == null) {
                $data = array(
                    'fullname' => $this->pregReps($this->input->post('fullname')),
                    'phone'   => $this->pregRepn($this->input->post('mobile')),
                    'email'    => $this->pregReps($this->input->post('email')),
                    'username' => $this->pregReps($this->input->post('username')),
                    'status_active' => $this->pregRepn($this->input->post('active'))
                );
                if ($this->accessRights->id_level == 1) {
                    $dataX = array_merge($data, $datalevel);
                } else {
                    $dataX = $data;
                }
                $editUser = $this->mod_global->edit_all('id_user', $id_user, 'mos_user', $dataX);
                if ($editUser == true){
                    $dataLog = array(
                        'id_user'    => $this->accessRights->id_user,
                        'id_module'  => $this->accessRights->id_module,
                        'logs'       => 'Edit user : '.$nik,
                        'ip_address' => $this->input->ip_address(),
                        'insert_time' => date("Y-m-d H:i:s")
                    );
                    $saveLogUser = $this->mod_global->insert_all('mos_user_log', $dataLog);
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
                    echo 'notsecure';
                    exit();
                }
                $data = array(
                    'fullname' => $this->pregReps($this->input->post('fullname')),
                    'phone'   => $this->pregRepn($this->input->post('mobile')),
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
                $editUser = $this->mod_global->edit_all('id_user', $id_user, 'mos_user', $dataX);
                if ($editUser == true){
                    $dataLog = array(
                        'id_user'    => $this->accessRights->id_user,
                        'id_module'  => $this->accessRights->id_module,
                        'logs'       => 'Edit user : '.$nik,
                        'ip_address' => $this->input->ip_address(),
                        'insert_time' => date("Y-m-d H:i:s")
                    );
                    $saveLogUser = $this->mod_global->insert_all('mos_user_log', $dataLog);
                    if ($saveLogUser == true) {
                        echo "Success";
                        // $getNewUser = $this->mod_user->get_detail_new_user($nik);
                        // $getPhone = ($getNewUser->mobile == false) ? 0 : $getNewUser->mobile;
                        // if ($getPhone == 0) {
                        //     exit();
                        // } else {
                        //     $content = 'User:'.$nik.'. Pass:'.$new_password.'. Changes account on the PT BSS MOSENTO website. Secret SMS, dont share it. https://bit.ly/2BsSMos' ;
                        //     $konten = array(
                        //         'NOM' => $getNewUser->mobile,
                        //         'MSG' => $content
                        //     );
                        //     $sendsms = $this->mod_sms->sendsms($konten);
                        // }
                        // SEND EMAIL
                        // if ($getNewUser->email == '' || $getNewUser->email == null) {
                        //     exit();
                        // } else {
                        //     $name         = $nik;
                        //     $email        = $getNewUser->email;
                        //     $username     = $nik;
                        //     $password     = $this->pregReps($this->input->post('password'));
                        //     $registerDate = $getNewUser->insert_time;
                        //     $lastIP       = $this->input->ip_address();
                        //     $subject      = 'Changes Data Account';
                        //     $this->sendEmail($email, $name, $password, $username, $registerDate, $lastIP, $subject);
                        // }
                    } else {
                        echo "ErrorLog";exit();
                    }
                } else {
                    echo "ErrorUser";exit();
                }
            }
        }

    }
?>
