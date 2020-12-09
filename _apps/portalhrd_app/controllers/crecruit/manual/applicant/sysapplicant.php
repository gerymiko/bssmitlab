<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysapplicant extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('bssID') == null) {
                redirect('logisisse');
            } else {
                $this->accessRights = $this->mod_global->get_detailed_user($this->session->userdata('users_id'));
                if ($this->accessRights==null) {
                    show_404('', false);
                }
            }
            $this->load->model(['mrecruit/manual/applicant/mod_applicant']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/precruit/manual/applicant/view',
                'accessRights' => $this->accessRights,
                'listjabatan' => $this->mod_global->list_jabatan(),
                'listsite'    => $this->mod_global->list_site(),
                'css_script'  => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/bs-datepicker/bs-datepicker.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/moment/moment.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/bs-datepicker/bs-datepicker.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/input-mask/jquery.inputmask.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/input-mask/jquery.inputmask.date.extensions.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_applicant(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false); }
            $applicant = $this->mod_applicant->get_datatables($length, $start);
            foreach ($applicant as $field){
                $start++;   
                $date = new DateTime($field->people_birth_date);
                $now  = new DateTime();
                $interval = $date->diff($now);
                $usia = $interval->format("%y Thn");
                $interviewAvailableDate = date("Y-m-d", strtotime("+ 6 month", strtotime($field->timestamp)));
                if ($field->interview_status == 3){
                    $status_tes      = "BI";
                    $btn             = "";
                    $btn_reinterview = "hidden";
                    $btn_dinterview  = "hidden";
                } elseif ($field->interview_status == 0){
                    $status_tes      = "TL";
                    $btn             = "hidden";
                    $btn_reinterview = "";
                    $btn_dinterview  = "";
                } elseif ($field->interview_status == 2){
                    $status_tes      = "TD";
                    $btn             = "";
                    $btn_reinterview = "hidden";
                    $btn_dinterview  = "";
                } elseif ($field->interview_status == 4){
                    $status_tes      = "BL";
                    $btn             = "hidden";
                    $btn_reinterview = "hidden";
                    $btn_dinterview  = "";
                } else {
                    if ($field->berkas == 1 && $field->hrdteknis == 1 && $field->teori == 1 && $field->praktek == 1) {
                        $btn = "hidden";
                    } else {
                        $btn = "";
                    }
                    $status_tes      = "LS";
                    $btn_reinterview = "hidden";
                    $btn_dinterview  = "";
                }
                $row           = array();
                $row['no']     = $start;
                $row['detail'] = '
                    <a class="btn btn-primary btn-xs" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                        <i class="fas fa-user-tie"></i>
                    </a>
                ';
                $row['name']   = $field->people_fullname;
                $row['edu']    = $field->edutype_name;
                $row['age']    = $usia;
                $row['gender'] = $field->people_gender;
                $row['domisili'] = $field->city.', '.$field->address;
                $row['position'] = $field->jabatan;
                $row['date']   = $this->viewDate($field->tgl_melamar);
                $row['site']   = ($field->interview_site == null) ? '-' : $field->interview_site;
                $row['stage']  = ($field->tahap == null) ? '-' : $field->tahap;
                $row['status'] = $status_tes;
                $row['desc']   = ($field->interview_desc == 'BI') ? '-' : $field->interview_desc;
                $row['action'] = 
                    '<button type="button" class="btn bg-navy btn-xs '.$btn.' " data-tooltip="Interview" onclick="btn_interview(\''.$this->my_encryption->encode($field->id).'\');">
                        <i class="fas fa-microphone"></i>
                    </button>
                    <button type="button" class="btn bg-blue btn-xs '.$btn_reinterview.' " data-tooltip="Interview Ulang" onclick="btn_reinterview(\''.$this->my_encryption->encode($field->id).'\',\''.$field->people_fullname.'\',\''.$this->viewDate($interviewAvailableDate).'\');">
                        <i class="fas fa-sync f10"></i>
                    </button>
                    <button type="button" class="btn bg-gray btn-xs '.$btn_dinterview.'" style="padding: 1px 4px;"data-tooltip="Detail Interview" onclick="detailInterview(\''.$this->my_encryption->encode($field->id).'\');">
                        <i class="fas fa-binoculars"></i>
                    </button>
                    <a href="#" class="btn btn-danger btn-xs" data-tooltip="Hapus" onclick="removeData(\''.$this->my_encryption->encode($field->people_id).'\', \''.$field->people_fullname.'\');" >
                        <i class="fa fa-times"></i>
                    </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_applicant->count_all(),
                "recordsFiltered" => $this->mod_applicant->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function check_noktp(){
            $noktp = $this->pregRepn($this->input->post('noktp'));
            $query = $this->mod_applicant->check_duplicate_applicant($noktp);
            if($query == true){ echo "true"; } else { echo "false"; }
        }

        public function add_applicant(){
            $data = array(
                'listjabatan' => $this->mod_global->list_jabatan(),
                'grade'       => $this->mod_global->list_grade(),
            );
            $this->load->view('pages/precruit/manual/applicant/add', $data);
        }

        public function save_add_applicant(){
            $noktp = $this->pregRepn($this->input->post('noktp'));
            $checkDuplicate = $this->mod_applicant->check_duplicate_applicant($noktp);
            if ($checkDuplicate !== false) {
                echo "Duplicate";exit();
            }
            $dataPelamar = array(
                'people_noreg'       => $this->mod_applicant->getRecruitmentID(),
                'people_fullname'    => $this->pregReps($this->input->post('people_fullname')),
                'people_birth_place' => $this->pregReps($this->input->post('people_birth_place')),
                'people_birth_date'  => $this->serverDate($this->input->post('people_birth_date')),
                'people_gender'      => ($this->pregReps($this->input->post('people_gender')) == "") ? 'L' : $this->pregReps($this->input->post('people_gender')),
                'people_mobile'      => $this->pregRepn($this->input->post('people_mobile')),
                'people_education'   => $this->pregRepn($this->input->post('grade')),
                'people_education_name' => $this->pregReps($this->input->post('people_education_name'))
            );
            $people_id = $this->mod_global->insert_into_people('pmanual_applicant', $dataPelamar);
            if ($people_id == false) {
                echo "Error";exit();
            }
            $dataAddress = array(
                'people_id' => $people_id,
                'address'   => $this->pregReps($this->input->post('people_address')),
                'city'      => $this->pregReps($this->input->post('people_address_city')),
                'zip_code'  => $this->pregRepn($this->input->post('people_address_zip'))
            );
            $save_address = $this->mod_global->insert_all('pmanual_address', $dataAddress);
            if ($save_address == false) {
                echo "Error";exit();
            }
            $dataKTP = array(
                'people_id'      => $people_id,
                'lisence_type'   => 'KTP',
                'lisence_number' => $noktp
            );
            $save_ktp = $this->mod_global->insert_all('pmanual_lisence', $dataKTP);
            if ($save_ktp == false) {
                echo "Error";exit();
            }
            if ( $this->pregRepn($this->input->post('sim_A')) == 1 ) {
                $dataSIMA = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM A',
                    'lisence_number' => $this->pregRepn($this->input->post('no_sim_A')),
                    'lisence_period' => $this->serverDate($this->input->post('period_sim_A'))
                );
                $saveA = $this->mod_global->insert_all('pmanual_lisence', $dataSIMA);
                if ($saveA == false) {
                    echo "Error";exit();
                }
            }
            if ( $this->pregRepn($this->input->post('sim_B1')) == 2 ) {
                $dataSIMB1 = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM B1',
                    'lisence_number' => $this->pregRepn($this->input->post('no_sim_B1')),
                    'lisence_period' => $this->serverDate($this->input->post('period_sim_B1'))
                );
                $saveB1 = $this->mod_global->insert_all('pmanual_lisence', $dataSIMB1);
                if ($saveB1 == false) {
                    echo "Error";exit();
                }
            }
            if ( $this->pregRepn($this->input->post('sim_B2')) == 3 ) {
                $dataSIMB2 = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM B2',
                    'lisence_number' => $this->pregRepn($this->input->post('no_sim_B2')),
                    'lisence_period' => $this->serverDate($this->input->post('period_sim_B2'))
                );
                $saveB2 = $this->mod_global->insert_all('pmanual_lisence', $dataSIMB2);
                if ($saveB2 == false) {
                    echo "Error";exit();
                }
            }
            if ( $this->pregRepn($this->input->post('sim_B1U')) == 4 ) {
                $dataSIMB1U = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM B1 UMUM',
                    'lisence_number' => $this->pregRepn($this->input->post('no_sim_B1U')),
                    'lisence_period' => $this->serverDate($this->input->post('period_sim_B1U'))
                );
                $saveB1U = $this->mod_global->insert_all('pmanual_lisence', $dataSIMB1U);
                if ($saveB1U == false) {
                    echo "Error";exit();
                }
            }
            if ( $this->pregRepn($this->input->post('sim_B2U')) == 5 ) {
                $dataSIMB2U = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM B2 UMUM',
                    'lisence_number' => $this->pregRepn($this->input->post('no_sim_B2U')),
                    'lisence_period' => $this->serverDate($this->input->post('period_sim_B2U'))
                );
                $saveB2U = $this->mod_global->insert_all('pmanual_lisence', $dataSIMB1U);
                if ($saveB2U == false) {
                    echo "Error";exit();
                }
            }
            $totalData  = $this->input->post('people_exp_company');
            if ($totalData[0] !== "") {
                $insertData = array();
                $res = array_filter($totalData, function($value) {
                    return ($value !== null && $value !== false && $value !== ''); 
                });
                for ($i = 0; $i < count($res); $i++) {
                    $dataExp = array(
                        'people_id'    => $people_id,
                        'company_name' => $this->input->post('people_exp_company')[$i],
                        'position'     => $this->input->post('people_exp_position')[$i],
                        'start_date'   => $this->serverDate($this->input->post('people_exp_period1')[$i]),
                        'end_date'     => $this->serverDate($this->input->post('people_exp_period2')[$i])
                    );
                    $insertData[] = $dataExp;
                }
                $saveExp = $this->mod_global->insert_batch('pmanual_experience', $insertData);
                if ($saveExp == false) {
                    echo "Error";exit();
                }
            }
            $totalDataSkill  = $this->input->post('people_skill');
            if ($totalDataSkill[0] !== "") {
                $insertDataSkill = array();
                $skill = array_filter($totalDataSkill, function($value) {
                    return ($value !== null && $value !== false && $value !== ''); 
                });
                for ($i = 0; $i < count($skill); $i++) {
                    $dataSkill = array(
                        'people_id'  => $people_id,
                        'skill_name' => $this->pregReps($this->input->post('people_skill'))[$i],
                        'skill_unit' => $this->pregReps($this->input->post('people_skill_unit'))[$i]
                    );
                    $insertDataSkill[] = $dataSkill;
                }
                $saveSkill = $this->mod_global->insert_batch('pmanual_skill', $insertDataSkill);
                if ($saveSkill == false) {
                    echo "Error";exit();
                }
            }
            $dataInterview = array(
                'people_id'        => $people_id,
                'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                'tgl_melamar'      => $this->serverDate($this->input->post('tgl_melamar')),
                'timestamp'        => date("Y-m-d H:i:s"),
                'interview_status' => 3,
                'interview_desc'   => 'Belum Interview',
                'berkas'           => 0,
                'hrdteknis'        => 0,
                'teori'            => 0,
                'praktek'          => 0,
                'mcu'              => 0
            );
            $saveInv = $this->mod_global->insert_all('pmanual_interview', $dataInterview);
            $datalogs = array(
                'logs_tanggal'    => date('Y-m-d H:i:s'),
                'logs_ip'         => $this->input->ip_address(),
                'logs_modul'      => 'Pelamar Formulir',
                'logs_aktifitas'  => 'Tambah Data',
                'logs_keterangan' => 'Melakukan penambahan data pelamar ID : '.$people_id.' form (Tambah Pelamar)',
                'logs_user_id'    => $this->accessRights->users_id,
                'logs_username'   => $this->accessRights->users_username,
                'logs_user_name'  => $this->accessRights->users_fullname,
                'logs_website'    => 'PORTAL'
            );
            $this->mod_global->insert_web('web_logs', $datalogs);
            if ($saveInv == false) {
                echo "Error";exit();
            } else {
                echo "Success";exit();
            }
        }

        public function save_add_skill(){
            $id    = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $skill = $this->input->post('people_skill');
            $insertDataSkill = array();
            for ($i = 0; $i < count($skill); $i++) {
                $dataSkill = array(
                    'people_id'    => $id,
                    'skill_name'   => $this->pregReps($this->input->post('people_skill'))[$i],
                    'skill_unit'   => $this->pregReps($this->input->post('people_skill_unit'))[$i],
                    'skill_status' => 1,
                    'reg_date'     => date("Y-m-d H:i:s")
                );
                $insertDataSkill[] = $dataSkill;
            }
            $addSkill = $this->mod_global->insert_batch('pmanual_skill', $insertDataSkill);
            if ($addSkill == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Tambah',
                    'logs_keterangan' => 'Melakukan penambahan data untuk Pelamar ID : '.$id.' form (Tambah Kemampuan)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function save_add_experience(){
            $id  = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $exp = $this->input->post('people_exp_company');
            $insertDataExp = array();
            for ($i = 0; $i < count($exp); $i++) {
                $dataExp = array(
                    'people_id'    => $id,
                    'company_name' => $this->input->post('people_exp_company')[$i],
                    'position'     => $this->input->post('people_exp_position')[$i],
                    'start_date'   => $this->serverDate($this->input->post('people_exp_period1')[$i]),
                    'end_date'     => $this->serverDate($this->input->post('people_exp_period2')[$i]),
                    'exp_status'   => 1,
                    'reg_date'     => date("Y-m-d H:i:s")
                );
                $insertDataExp[] = $dataExp;
            }
            $addExp = $this->mod_global->insert_batch('pmanual_experience', $insertDataExp);
            if ($addExp == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Tambah',
                    'logs_keterangan' => 'Melakukan penambahan data Pelamar ID : '.$id.' form (Tambah Pengalaman)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function save_add_lisence(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $lisence = array(
                'people_id'      => $id,
                'lisence_type'   => $this->pregReps($this->input->post('lisence_type')),
                'lisence_number' => $this->pregRepn($this->input->post('lisence_number')),
                'lisence_period' => $this->serverDate($this->pregReps($this->input->post('lisence_period')))
            );
            $addLisence = $this->mod_global->insert_all('pmanual_lisence', $lisence);
            if ($addLisence == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Tambah',
                    'logs_keterangan' => 'Melakukan penambahan data Pelamar ID : '.$id.' form (Tambah SIM)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function save_edit_personal(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $getData = $this->mod_applicant->get_data($id, 'people_id', 'pmanual_applicant');
            if ( $getData->people_fullname == $this->pregReps($this->input->post('people_fullname')) &&
                $getData->people_birth_place == $this->pregReps($this->input->post('people_birth_place')) &&
                $this->serverDate($getData->people_birth_date) == $this->serverDate($this->pregReps($this->input->post('people_birth_date'))) &&
                $getData->people_mobile == $this->pregRepn($this->input->post('people_mobile')) &&
                $getData->people_education == $this->pregRepn($this->input->post('people_education')) &&
                $getData->people_education_name == $this->pregReps($this->input->post('people_education_name'))
            ) {
                echo "Nochange";exit();
            }
            $personal = array(
                'people_fullname'       => $this->pregReps($this->input->post('people_fullname')),
                'people_birth_place'    => $this->pregReps($this->input->post('people_birth_place')),
                'people_birth_date'     => $this->serverDate($this->pregReps($this->input->post('people_birth_date'))),
                'people_mobile'         => $this->pregRepn($this->input->post('people_mobile')),
                'people_education'      => $this->pregRepn($this->input->post('people_education')),
                'people_education_name' => $this->pregReps($this->input->post('people_education_name')),
                'update_date'           => date("Y-m-d H:i:s")
            );
            $editPersonal = $this->mod_global->edit_all('people_id', $id, 'pmanual_applicant', $personal);
            if ($editPersonal == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Ubah Data',
                    'logs_keterangan' => 'Melakukan perubahan data pelamar ID : '.$id.' form (Ubah Personal)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function save_edit_address(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $getData = $this->mod_applicant->get_data($id, 'people_id', 'pmanual_address');
            if ( $getData->address == $this->pregReps($this->input->post('people_address')) &&
                $getData->zip_code == $this->pregRepn($this->input->post('people_zip')) &&
                $getData->city == $this->pregReps($this->input->post('people_city'))
            ) {
                echo "Nochange";exit();
            }
            $address = array(
                'address'  => $this->pregReps($this->input->post('people_address')),
                'zip_code' => $this->pregRepn($this->input->post('people_zip')),
                'city'     => $this->pregReps($this->input->post('people_city')),
                'update_date' => date("Y-m-d H:i:s")
            );
            $editAddress = $this->mod_global->edit_all('people_id', $id, 'pmanual_address', $address);
            if ($editAddress == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Ubah Data',
                    'logs_keterangan' => 'Melakukan perubahan data pelamar ID : '.$id.' form (Ubah Alamat)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function save_edit_lisence(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('lisence_id')));
            $getData = $this->mod_applicant->get_data($id, 'plisence_id', 'pmanual_lisence');
            if ( $getData->lisence_number == $this->pregRepn($this->input->post('lisence_number')) &&
                $this->serverDate($getData->lisence_period) == $this->serverDate($this->pregReps($this->input->post('lisence_period')))
            ) {
                echo "Nochange";exit();
            }
            if ($this->pregReps($this->input->post('lisence_type')) == "KTP") {
                $period = null;
            } else {
                $period = $this->serverDate($this->pregReps($this->input->post('lisence_period')));
            }
            $lisence = array(
                'lisence_number' => $this->pregRepn($this->input->post('lisence_number')),
                'lisence_period' => $period,
                'update_date'    => date("Y-m-d H:i:s")
            );
            $editLisence = $this->mod_global->edit_all('plisence_id', $id, 'pmanual_lisence', $lisence);
            if ($editLisence == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Ubah Data',
                    'logs_keterangan' => 'Melakukan perubahan data pelamar ID : '.$id.' form (Ubah SIM)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function save_edit_experience(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('pexp_id')));
            $getData = $this->mod_applicant->get_data($id, 'pexp_id', 'pmanual_experience');
            if ( $getData->company_name == $this->pregReps($this->input->post('company_name')) &&
                $getData->position == $this->pregReps($this->input->post('position')) &&
                $this->serverDate($getData->start_date) == $this->serverDate($this->pregReps($this->input->post('start_date'))) &&
                $this->serverDate($getData->end_date) == $this->serverDate($this->pregReps($this->input->post('end_date')))
            ) {
                echo "Nochange";exit();
            }
            $experience = array(
                'company_name' => $this->pregReps($this->input->post('company_name')),
                'position'     => $this->pregReps($this->input->post('position')),
                'start_date'   => $this->serverDate($this->pregReps($this->input->post('start_date'))),
                'end_date'     => $this->serverDate($this->pregReps($this->input->post('end_date'))),
                'update_date'  => date("Y-m-d H:i:s")
            );
            $editExperence = $this->mod_global->edit_all('pexp_id', $id, 'pmanual_experience', $experience);
            if ($editExperence == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Ubah',
                    'logs_keterangan' => 'Melakukan perubahan data untuk pelamar ID : '.$id.' form (Ubah Pengalaman)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function save_edit_skill(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('pskill_id')));
            $getData = $this->mod_applicant->get_data($id, 'pskill_id', 'pmanual_skill');
            if ( $getData->skill_name == $this->pregReps($this->input->post('skill_name')) &&
                $getData->skill_unit == $this->pregReps($this->input->post('skill_unit'))
            ) {
                echo "Nochange";exit();
            }
            $skill = array(
                'skill_name'  => $this->pregReps($this->input->post('skill_name')),
                'skill_unit'  => $this->pregReps($this->input->post('skill_unit')),
                'update_date' => date("Y-m-d H:i:s")
            );
            $editSkill = $this->mod_global->edit_all('pskill_id', $id, 'pmanual_skill', $skill);
            if ($editSkill == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Ubah Data',
                    'logs_keterangan' => 'Melakukan perubahan data pelamar ID : '.$id.' form (Ubah Kemampuan)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function delete_applicant(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $delete = array(
                'people_status' => 0,
                'update_date'   => date("Y-m-d H:i:s")
            );
            $deleteApplicant = $this->mod_global->edit_all('people_id', $id, 'pmanual_applicant', $delete);
            if ($deleteApplicant == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Hapus Data',
                    'logs_keterangan' => 'Melakukan perubahan data pelamar ID : '.$id.' form (Hapus Pelamar)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function delete_skill(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $deleteSkill = $this->mod_global->delete_all('pskill_id', $id, 'pmanual_skill');
            if ($deleteSkill == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Hapus',
                    'logs_keterangan' => 'Melakukan perubahan data untuk Kemampuan ID : '.$id.' form (Hapus Kemampuan)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function delete_experience(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $deleteExp = $this->mod_global->delete_all('pexp_id', $id, 'pmanual_experience');
            if ($deleteExp == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Hapus',
                    'logs_keterangan' => 'Melakukan perubahan data Pengalaman ID : '.$id.' form (Hapus Pengalaman)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function delete_lisence(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $deleteLisence = $this->mod_global->delete_all('plisence_id', $id, 'pmanual_lisence');
            if ($deleteLisence == true){
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Pelamar Manual',
                    'logs_aktifitas'  => 'Hapus',
                    'logs_keterangan' => 'Melakukan perubahan data SIM ID : '.$id.' form (Hapus SIM)',
                    'logs_user_id'    => $this->accessRights->users_id,
                    'logs_username'   => $this->accessRights->users_username,
                    'logs_user_name'  => $this->accessRights->users_fullname,
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }
    }
?>