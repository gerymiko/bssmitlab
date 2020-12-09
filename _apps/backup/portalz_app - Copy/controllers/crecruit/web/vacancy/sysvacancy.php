<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysvacancy extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/web/vacancy/mod_vacancy']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,;]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

        private static function viewDate($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        public function index(){
            $data = array(
                'header'           => 'pages/ext/header',
                'footer'           => 'pages/ext/footer',
                'topmenu'          => 'pages/ptopbar/vtopbar',
                'sidemenu'         => 'pages/psidebar/vsidebar',
                'content'          => 'pages/precruit/web/vacancy/view',
                'lowonganaktif'    => $this->mod_vacancy->vacancy_active(),
                'lowongannonaktif' => $this->mod_vacancy->vacancy_not_active(),
                'lowonganterdaftar'=> $this->mod_vacancy->vacancy_registered()
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function vadd_vacancy(){
            $data = array(
                'listjabatan' => $this->mod_vacancy->list_jabatan(),
                'msyarat'     => $this->mod_vacancy->syarat_wajiblist(),
            );
            $this->load->view('pages/precruit/web/vacancy/add', $data);
        }

        public function vedit_vacancy($id, $kode){
            $ids = $this->my_encryption->decode($this->pregReps($id));
            $data = array(
                'dvacan'      => $this->mod_vacancy->detail_vacancy($ids),
                'deduc'       => $this->mod_vacancy->detail_education($ids),
                'meduc'       => $this->mod_vacancy->master_education(),
                'msyarat'     => $this->mod_vacancy->syarat_wajiblist(),
                'mskillumum'  => $this->mod_vacancy->master_skillumum(),
                'mskillreq'   => $this->mod_vacancy->master_skillreq($kode),
                'dskill'      => $this->mod_vacancy->detail_skill($ids),                
                'msertumum'   => $this->mod_vacancy->master_sertifikatumum(),    
                'dsert'       => $this->mod_vacancy->detail_sertifikat($ids),
                'msertreq'    => $this->mod_vacancy->master_sertifikatreq($kode),
                'msyaratumum' => $this->mod_vacancy->master_syaratumum(),    
                'dsyarat'     => $this->mod_vacancy->detail_syaratumum($ids),
                'msyaratreq'  => $this->mod_vacancy->master_syaratreq($kode),
            );
            $this->load->view('pages/precruit/web/vacancy/edit', $data);
        }

        public function vdetail_vacancy($id){
            $ids = $this->my_encryption->decode($this->pregReps($id));
            $data = array(
                'dvacan'     => $this->mod_vacancy->detail_vacancy($ids),
                'dedureq'    => $this->mod_vacancy->detail_edureq($ids),
                'dskillreq'  => $this->mod_vacancy->detail_skillreq($ids),
                'dsyaratreq' => $this->mod_vacancy->detail_syaratreq($ids),
            );
            $this->load->view('pages/precruit/web/vacancy/detail', $data);
        }

        public function table_vacancy(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $vacancy = $this->mod_vacancy->get_vacancy($length, $start);
            foreach ($vacancy as $field){
                if ($field->lowongan_status == 1) {
                    $status = '<span class="label label-success">BUKA</span>';
                    $btn = "";
                } else {
                    $status = '<span class="label label-danger">TUTUP</span>';
                    $btn = "hidden";
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['kode']     = $field->kode_lowongan;
                $row['dept']     = $field->Nama;
                $row['jb']       = $field->jabatan_alias;
                $row['jmlrec']   = $field->jml_rekrut;
                $row['dateopen'] = $this->viewDate($field->tgl_open);
                $row['status']   = $status;
                $row['action']   = '
                            <a class="btn btn-default btn-xs" data-tooltip="Detail" onClick="btn_detail_vacancy(\''.$this->my_encryption->encode($field->lowongan_id).'\')">
                                <i class="fas fa-binoculars f10"></i>
                            </a>
                            <a class="btn btn-primary btn-xs" data-tooltip="Ubah" onClick="btn_edit_vacancy(\''.$this->my_encryption->encode($field->lowongan_id).'\', \''.$field->KodeJB.'\')">
                                <i class="fas fa-pen f10"></i>
                            </a>
                            <a class="btn btn-danger btn-xs '.$btn.'" data-tooltip="Hapus" onClick="removeThis(\''.$this->my_encryption->encode($field->lowongan_id).'\', \''.$field->jabatan_alias.'\')">
                                <i class="fas fa-times"></i>
                            </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_vacancy->count_all_vacancy(),
                "recordsFiltered" => $this->mod_vacancy->count_filtered_vacancy(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function check_vacancy(){
            $kodeJB = $this->pregReps($this->input->post('jabatan_alias'));
            $query  = $this->mod_vacancy->check_vacancy($kodeJB);
            if($query){
                echo $status = "false";
            } else {             
                echo $status = "true"; 
            }
        }

        public function getSkill(){
            $kodeJB   = $this->pregReps($this->input->post('skill'));
            $getskill = $this->mod_vacancy->getSkill($kodeJB);
            echo '<div name="skill_id" id="skill">';
                    if ($getskill) {
                        foreach ($getskill as $row) {
                            echo '<div class="checkbox">
                                        <label><input name="skill_id[]" type="checkbox" class="checkcus" value="'.$row->skill_id.'">'.$row->skill_name.'</label></div>';
                        }
                    } else { echo '<span>Tidak ada data skill yang sesuai dengan jabatan ini</span>'; }
            echo '</div>';
        }

        public function getSyarat(){
            $kodeJB    = $this->pregReps($this->input->post('syarat'));
            $getsyarat = $this->mod_vacancy->getSyarat($kodeJB);
            echo '<div name="syarat_id" id="syarat">';
                    if ($getsyarat) {
                        foreach ($getsyarat as $row) {
                            echo '<div class="checkbox">
                                <label><input name="syarat_id[]" type="checkbox" class="checkcus" value="'.$row->syarat_id.'">'.$row->syarat_name.'</label></div>';
                        }
                    } else { echo '<span>Tidak ada data syarat yang sesuai dengan jabatan ini</span>'; }
            echo '</div>';
        }

        public function getSertifikat(){
            $kodeJB        = $this->pregReps($this->input->post('sertifikat'));
            $getsertifikat = $this->mod_vacancy->getSertifikat($kodeJB);
            echo '<div name="certificate_id" id="sertifikat">';
                    if ($getsertifikat) {
                        foreach ($getsertifikat as $row) {
                            echo '<div class="checkbox">
                                    <label><input name="certificate_id[]" class="checkcus" type="checkbox" value="'.$row->certificate_id.'">'.$row->certificate_name.'</label></div>';
                        }
                    } else { echo '<span>Tidak ada data sertifikat yang sesuai dengan jabatan ini</span>'; }
            echo '</div>';
        }

        public function save_add_vacancy(){
            $kodeJB          = $this->pregReps($this->input->post('jabatan_alias'));
            $get_jabatan     = $this->mod_vacancy->get_jabatan_name($kodeJB);
            $mingaji         = $this->pregRepn($this->input->post('min_salary'));
            $maxgaji         = $this->pregRepn($this->input->post('max_salary'));
            $exp             = $this->pregRepn($this->input->post('experience'));
            $listEdu         = $this->input->post('edutype_id');
            $listTalent      = $this->input->post('skill_id');
            $listCertificate = $this->input->post('certificate_id');
            $listCondition      = $this->input->post('syarat_id');

            $min_salary = (empty($mingaji)) ? 0 : $mingaji;
            $max_salary = (empty($maxgaji)) ? 0 : $maxgaji;
            $experience = (empty($exp)) ? 0 : $exp;
            
            $check_exist = $this->mod_vacancy->check_exist_vacancy($kodeJB);
            if ($kodeJB == $check_exist->KodeJB) {
                echo "duplicate";
                exit();
            }

            $data = array(
                'KodeJB'             => $kodeJB,
                'KodeDP'             => $this->pregReps($this->input->post('KodeDP')),
                'kode_lowongan'      => $this->pregReps($this->input->post('kode_lowongan')),
                'jabatan_alias'      => strtoupper($get_jabatan->Nama),
                'jenis_kelamin'      => $this->pregReps($this->input->post('jenis_kelamin')),
                'min_usia'           => $this->pregRepn($this->input->post('min_usia')),
                'max_usia'           => $this->pregRepn($this->input->post('max_usia')),
                'min_salary'         => $min_salary,
                'max_salary'         => $max_salary,
                'experience'         => $experience,
                'experience_subject' => $this->pregReps($this->input->post('experience_subject')),
                'edu_jurusan'        => $this->pregReps($this->input->post('edu_jurusan')),
                'jml_rekrut'         => $this->pregRepn($this->input->post('jml_rekrut')),
                'tgl_open'           => $this->serverDate($this->input->post('tgl_open')),
                'tgl_close'          => $this->serverDate($this->input->post('tgl_close')),
                'job_desc'           => $this->security->xss_clean($this->input->post('job_desc')),
                'date_create'        => date("Y-m-d H:i:s"),
                'lowongan_status'    => 1
            );
            $getIdVacancy = $this->mod_vacancy->insert_get_id($data);
            for ($i = 0; $i < count($listEdu); $i++){
               $edu = array(
                    'edutype_id'    => $listEdu[$i],
                    'lowongan_id'   => $getIdVacancy,
                    'edureq_status' => 1
                );
               $insertedu = $this->mod_vacancy->addedureqloker($edu);
            }
            for ($i = 0; $i < count($listTalent); $i++){
               $skill = array(
                    'skill_id'        => $listTalent[$i],
                    'lowongan_id'     => $getIdVacancy,
                    'skillreq_status' => 1
                );
               $insertskill = $this->mod_vacancy->addskillreqloker($skill);
            }
            for ($i = 0; $i < count($listCertificate); $i++){
               $certificate = array(
                    'certificate_id'        => $listCertificate[$i],
                    'lowongan_id'           => $getIdVacancy,
                    'certificatereq_status' => 1
                );
               $insertcertificate = $this->mod_vacancy->addcertificatereqloker($certificate);
            }
            for ($i = 0; $i < count($listCondition); $i++){
                $syarat = array(
                    'syarat_id'        => $listCondition[$i],
                    'lowongan_id'      => $getIdVacancy,
                    'syaratreq_status' => 1
                );
               $insertsyarat = $this->mod_vacancy->addsyaratreqloker($syarat);
            }
            if($insertloker == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function save_edit_vacancy(){
            $lowongan_id     = $this->my_encryption->decode($this->pregReps($this->input->post('lowongan_id')));
            $listEdu         = $this->input->post('edutype_id');
            $listSkill       = $this->input->post('skill_id');
            $listCertificate = $this->input->post('certificate_id');
            $listCondition   = $this->input->post('syarat_id');
            $vacancy = array(
                'kode_lowongan'      => $this->pregReps($this->input->post('kode_lowongan')),
                'jenis_kelamin'      => $this->pregReps($this->input->post('jenis_kelamin')),
                'min_usia'           => $this->pregRepn($this->input->post('min_usia')),
                'max_usia'           => $this->pregRepn($this->input->post('max_usia')),
                'min_salary'         => (empty($this->pregReps($this->input->post('min_salary')))) ? 0 : $this->pregReps($this->input->post('min_salary')),
                'max_salary'         => (empty($this->pregReps($this->input->post('max_salary')))) ? 0 : $this->pregReps($this->input->post('max_salary')),
                'experience'         => (empty($this->pregRepn($this->input->post('experience')))) ? 0 : $this->pregRepn($this->input->post('experience')),
                'experience_subject' => $this->pregReps($this->input->post('experience_subject')),
                'edu_jurusan'        => $this->pregReps($this->input->post('edu_jurusan')),
                'jml_rekrut'         => $this->pregRepn($this->input->post('jml_rekrut')),
                'tgl_open'           => $this->serverDate($this->pregReps($this->input->post('tgl_open'))),
                'tgl_close'          => $this->serverDate($this->pregReps($this->input->post('tgl_close'))),
                'job_desc'           => $this->security->xss_clean($this->input->post('job_desc')),
                'date_create'        => date("Y-m-d H:i:s"),
                'lowongan_status'    => ($this->pregRepn($this->input->post('loker_status')) == "") ? 1 : $this->pregRepn($this->input->post('loker_status')),
            );
            $saveVacancy = $this->mod_vacancy->edit_extra_all('lowongan_id', $lowongan_id, 'lowongan', $vacancy);
            if ($saveVacancy == true) {
                $deleteEdu  = $this->mod_vacancy->delete_extra_all('lowongan_id', $lowongan_id, 'edu_required');
                for ($i = 0; $i < count($listEdu); $i++){
                    $edu = array(
                        'edutype_id'    => $listEdu[$i],
                        'lowongan_id'   => $lowongan_id,
                        'edureq_status' => 1
                    );
                    $saveReqEdu = $this->mod_vacancy->insert_all('edu_required', $edu);
                }
                $deleteSkill  = $this->mod_vacancy->delete_extra_all('lowongan_id', $lowongan_id, 'skill_required');
                for ($i = 0; $i < count($listSkill); $i++){
                    $skill = array(
                        'skill_id'        => $listSkill[$i],
                        'lowongan_id'     => $lowongan_id,
                        'skillreq_status' => 1
                    );
                   $saveReqSkill = $this->mod_vacancy->insert_all('skill_required', $skill);
                }
                $deleteCertificate  = $this->mod_vacancy->delete_extra_all('lowongan_id', $lowongan_id, 'certificate_required');
                for ($i = 0; $i < count($listCertificate); $i++){
                    $certificate = array(
                        'certificate_id'        => $listCertificate[$i],
                        'lowongan_id'           => $lowongan_id,
                        'certificatereq_status' => 1
                    );
                    $saveReqCert = $this->mod_vacancy->insert_all('certificate_required', $certificate);
                }
                $deleteCondition = $this->mod_vacancy->delete_extra_all('lowongan_id', $lowongan_id, 'syarat_required');  
                for ($i = 0; $i < count($listCondition); $i++){
                    $condition = array(
                        'syarat_id'        => $listCondition[$i],
                        'lowongan_id'      => $lowongan_id,
                        'syaratreq_status' => 1
                    );
                    $saveReqCond = $this->mod_vacancy->insert_all('syarat_required', $condition);
                }
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function deactivated_vacancy(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $vacancy = array( 'lowongan_status' => 0 );
            $deactivated = $this->mod_vacancy->edit_extra_all('lowongan_id', $id, 'lowongan', $vacancy);
            if ($deactivated == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }


    }
?>