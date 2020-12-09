<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysinterview extends CI_Controller{

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
            $this->load->model(['mrecruit/manual/interview/mod_interview']);
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

        public function step_interview($id){
            $id = $this->my_encryption->decode($this->pregReps($id));
            $getLastStep = $this->mod_interview->get_last_step_interview($id);
            if ($getLastStep->interview_status == 2) {
                $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>Ada status interview yang tertunda. Ubah status TUNDA terlebih dahulu di menu <b>detail interview</b> untuk dapat melanjutkan ke tahap interview selanjutnya.');
                $this->session->set_flashdata('pesan', $pesan);
                $this->load->view('pages/precruit/manual/applicant/view', $pesan);
            } else {
                $data = array(
                    'detail'      => $this->mod_interview->detail_people_and_interview($id),
                    'dinterview'  => $this->mod_interview->detail_interview($id),
                    'listjabatan' => $this->mod_global->list_jabatan(),
                    'listsite'    => $this->mod_global->list_site(),
                    'listpic'     => $this->mod_global->list_pic(),
                    'accessRights' => $this->accessRights,
                    'css_script'  => array(
                        '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>',
                        '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/bs-datepicker/bs-datepicker.min.css"/>',
                        '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/bs-timepicker/bs-timepicker.min.css"/>'
                    ),
                    'js_script' => array(
                        '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>',
                        '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/moment/moment.min.js"></script>',
                        '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/bs-datepicker/bs-datepicker.min.js"></script>',
                        '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/bs-timepicker/bs-timepicker.min.js"></script>'
                    ),
                );
                $this->load->view('pages/precruit/manual/interview/view', $data);
            }
        }

        public function detail_interview($id){
            $id = $this->my_encryption->decode($this->pregReps($id));
            $this->load->view('pages/precruit/manual/interview/detail', $id);
        }

        public function save_add_interview(){
            $people_id     = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $interview_id  = $this->my_encryption->decode($this->pregReps($this->input->post('interview_id')));
            $valinterview  = substr($this->input->post('statusinterview'), 0, 1);
            $statinterview = substr($this->input->post('statusinterview'), 1);
            $KodeJB    = $this->pregReps($this->input->post('jabatan'));
            $test_type = $this->input->post('test_type');
            $dinterview = $this->mod_interview->detail_interview($interview_id);
            $dataInterview = array(
                'interview_site' => $this->pregReps($this->input->post('interview_site')),
                'KodeJB' => $KodeJB,
            );
            $saveIn = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
            if ($saveIn == true) {
                if ($statinterview === "Blacklist") {
                    $dataInterviewNext = array(
                        'interview_status' => 4,
                        'interview_desc'   => $this->pregReps($this->input->post('conclusion_ket')),
                    );
                    $datArray      = array_merge($dataInterviewNext, $dataInterview);
                    $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $datArray);

                    $dataPeople = array( 'people_blacklist' => 1 );
                    $savePeople = $this->mod_global->edit_all('people_id', $people_id, 'pmanual_applicant', $dataPeople);
                    echo "Success";
                    exit();
                }
                if ( in_array(1, $test_type) ) {
                    $selectionStep = array(
                        'id'          => $interview_id,
                        'people_id'   => $people_id,
                        'berkas_pic'  => $this->pregReps($this->input->post('pic')),
                        'berkas_periksa' => $this->pregRepn($this->input->post('election_file')),
                        'berkas_conclusion' => $this->pregRepn($valinterview),
                        'berkas_conclusion_desc' => $statinterview,
                        'berkas_description' => $this->pregReps($this->input->post('conclusion_ket')),
                        'berkas_reference' => $this->pregReps($this->input->post('reference'))
                    );
                    if ($this->pregRepn($valinterview) == 1 ) {
                        if ($dinterview->interview_status == 2) {
                            $editSelection = $this->mod_global->edit_all('id', $interview_id, 'seleksi_berkas', $selectionStep);
                        } else {
                            $saveSelection = $this->mod_global->insert_all('seleksi_berkas', $selectionStep);
                        }
                        $dataInterview = array('interview_status' => 1, 'berkas' => 1, 'tahap' => 'Berkas', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    } elseif ($this->pregRepn($valinterview) == 2) {
                        $saveSelection = $this->mod_global->insert_all('seleksi_berkas', $selectionStep);
                        $dataInterview = array('interview_status' => 2, 'berkas' => 1, 'tahap' => 'Berkas', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    } else {
                        $saveSelection = $this->mod_global->insert_all('seleksi_berkas', $selectionStep);
                        $dataInterview = array('interview_status' => 0, 'berkas' => 1, 'tahap' => 'Berkas', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    }
                }
                if ( in_array(2, $test_type) ) {
                    $selectionStep = array(
                        'id'        => $interview_id,
                        'people_id' => $people_id,
                        'hrdteknis_date' => $this->serverDate($this->input->post('interviewdate_hrd')),
                        'hrd_pic'    => $this->pregReps($this->input->post('hrd_nik')),
                        'teknis_pic' => $this->pregReps($this->input->post('teknis_nik')),
                        'hrdteknis_conclusion' => $this->pregRepn($valinterview),
                        'hrdteknis_conclusion_desc' => $statinterview,
                        'hrdteknis_description' => $this->pregReps($this->input->post('conclusion_ket')),
                        'hrdteknis_reference'   => $this->pregReps($this->input->post('reference'))
                    );
                    if ($this->pregRepn($valinterview) == 1) {
                        if ($dinterview->interview_status == 2) {
                            $editSelection = $this->mod_global->edit_all('id', $interview_id, 'seleksi_hrd_teknis', $selectionStep);
                        } else {
                            $saveSelection = $this->mod_global->insert_all('seleksi_hrd_teknis', $selectionStep);
                        }
                        $dataInterview = array('interview_status' => 1, 'hrdteknis' => 1, 'tahap' => 'HRD-Teknis', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    } elseif ($this->pregRepn($valinterview) == 2) {
                        $saveSelection = $this->mod_global->insert_all('seleksi_hrd_teknis', $selectionStep);
                        $dataInterview = array('interview_status' => 2, 'hrdteknis' => 1, 'tahap' => 'HRD-Teknis', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    } else {
                        $saveSelection = $this->mod_global->insert_all('seleksi_hrd_teknis', $selectionStep);
                        $dataInterview = array('interview_status' => 0, 'hrdteknis' => 1, 'tahap' => 'HRD-Teknis', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    }
                }
                if ( in_array(3, $test_type) ) {
                    $selectionStep = array(
                        'id'          => $interview_id,
                        'people_id'   => $people_id,
                        'teori_date'  => $this->serverDate($this->input->post('interviewdate_teori')),
                        'teori_pic'   => $this->pregReps($this->input->post('teori_nik')),
                        'teori_score' => $this->pregReps($this->input->post('score_teori')),
                        'teori_conclusion' => $this->pregRepn($valinterview),
                        'teori_conclusion_desc' => $statinterview,
                        'teori_description' => $this->pregReps($this->input->post('conclusion_ket')),
                        'teori_reference'   => $this->pregReps($this->input->post('reference'))
                    );
                    if ($this->pregRepn($valinterview) == 1 ) {
                        if ($dinterview->interview_status == 2) {
                            $editSelection = $this->mod_global->edit_all('id', $interview_id, 'seleksi_teori', $selectionStep);
                        } else {
                            $saveSelection = $this->mod_global->insert_all('seleksi_teori', $selectionStep);
                        }
                        $dataInterview = array('interview_status' => 1, 'teori' => 1, 'tahap' => 'Teori', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    } elseif ($this->pregRepn($valinterview) == 2) {
                        $saveSelection = $this->mod_global->insert_all('seleksi_teori', $selectionStep);
                        $dataInterview = array('interview_status' => 2, 'teori' => 1, 'tahap' => 'Teori', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    } else {
                        $saveSelection = $this->mod_global->insert_all('seleksi_teori', $selectionStep);
                        $dataInterview = array('interview_status' => 0, 'teori' => 1, 'tahap' => 'Teori', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    }
                }
                if ( in_array(4, $test_type) ) {
                    $selectionStep = array(
                        'id'           => $interview_id,
                        'people_id'    => $people_id,
                        'praktek_date' => $this->serverDate($this->input->post('interviewdate_praktek')),
                        'praktek_pic'  => $this->pregReps($this->input->post('trainer_nik')),
                        'score1' => $this->pregReps($this->input->post('score_practice1')),
                        'score2' => $this->pregReps($this->input->post('score_practice2')),
                        'score3' => $this->pregReps($this->input->post('score_practice3')),
                        'score4' => $this->pregReps($this->input->post('score_practice4')),
                        'score5' => $this->pregReps($this->input->post('score_practice5')),
                        'praktek_conclusion' => $this->pregRepn($valinterview),
                        'praktek_conclusion_desc' => $statinterview,
                        'praktek_description' => $this->pregReps($this->input->post('conclusion_ket')),
                        'praktek_reference'   => $this->pregReps($this->input->post('reference'))
                    );
                    if ($this->pregRepn($valinterview) == 1 ) {
                        if ($dinterview->interview_status == 2) {
                            $editSelection = $this->mod_global->edit_all('id', $interview_id, 'seleksi_praktek', $selectionStep);
                        } else {
                            $saveSelection = $this->mod_global->insert_all('seleksi_praktek', $selectionStep);
                        }
                        $dataInterview = array('interview_status' => 1, 'praktek' => 1, 'tahap' => 'Praktek', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    } elseif ($this->pregRepn($valinterview) == 2) {
                        $saveSelection = $this->mod_global->insert_all('seleksi_praktek', $selectionStep);
                        $dataInterview = array('interview_status' => 2, 'praktek' => 1, 'tahap' => 'Praktek', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    } else {
                        $saveSelection = $this->mod_global->insert_all('seleksi_praktek', $selectionStep);
                        $dataInterview = array('interview_status' => 0, 'praktek' => 1, 'tahap' => 'Praktek', 'interview_desc' => $statinterview);
                        $saveInterview = $this->mod_global->edit_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                    }
                }
                echo "Success";
            } else {
                echo "Error";exit();
            }  
        }

        public function reinterview(){
            $id    = $this->input->post('id');
            $newid = $this->my_encryption->decode($this->pregReps($id));
            $checkAvailable = $this->mod_interview->check_availability_interview($newid);
            $interviewAvailableDate = date("Y-m-d", strtotime("+ 6 month", strtotime($checkAvailable->timestamp)));
            if (strtotime($interviewAvailableDate) > strtotime(date("Y-m-d"))){
                echo "NotThisTime";exit();
            }
            $checkPeople = $this->mod_interview->check_exist_interview($checkAvailable->people_id);
            if ($checkPeople !== false ){
                echo "StillRunning";exit();
            }
            $dataInterview = array(
                'people_id'   => $checkAvailable->people_id,
                'KodeJB'      => $checkAvailable->KodeJB,
                'interview_status' => 3,
                'interview_desc'   => 'BI',
                'berkas'    => 0,
                'hrdteknis' => 0,
                'teori'     => 0,
                'praktek'   => 0,
                'mcu'       => 0,
            );
            $saveInterview = $this->mod_global->insert_all('pmanual_interview', $dataInterview);
            if ($saveInterview == true){
                $datalogs = array(
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Interview Formulir',
                    'logs_aktifitas'  => 'Ubah',
                    'logs_keterangan' => 'Reinterview pelamar ID interview : '.$newid.' form (Reinterview)',
                    'logs_user_id'    => $this->session->userdata('bssID'),
                    'logs_username'   => $this->session->userdata('username'),
                    'logs_user_name'  => $this->session->userdata('fullname'),
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web1('web_logs', $datalogs);
                echo "Success";
            } else {
                echo "Error";exit();
            }
        }

        public function save_edit_melamar(){
            $id          = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $tgl_melamar = $this->serverDate($this->pregReps($this->input->post('tgl_melamar')));
            $KodeJB    = $this->pregReps($this->input->post('jabatan'));
            $site      = $this->pregReps($this->input->post('site'));
            $getRecord = $this->mod_interview->get_record_melamar($id);
            if ($this->serverDate($getRecord->tgl_melamar) ==  $tgl_melamar && $getRecord->KodeJB == $KodeJB && $getRecord->interview_site == $site ){
                echo "Nochange";exit();
            } else {
                $apply = array(
                    'tgl_melamar' => $tgl_melamar,
                    'KodeJB'      => $KodeJB,
                    'interview_site' => $site
                );
                $saveApply = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $apply);
                if ($saveApply == true){
                    $datalogs = array(
                        'logs_ip'         => $this->input->ip_address(),
                        'logs_modul'      => 'Interview Formulir',
                        'logs_aktifitas'  => 'Ubah',
                        'logs_keterangan' => 'Melakukan perubahan data pelamar ID interview : '.$id.' form (Ubah Data Melamar)',
                        'logs_user_id'    => $this->session->userdata('bssID'),
                        'logs_username'   => $this->session->userdata('username'),
                        'logs_user_name'  => $this->session->userdata('fullname'),
                        'logs_website'    => 'PORTAL'
                    );
                    $this->mod_global->insert_web1('web_logs', $datalogs);
                    echo "Success";
                } else {
                    echo "Error";exit();
                }
            }
        }

        public function save_edit_blacklist(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $getRecord = $this->mod_interview->get_record_melamar($id);
            if ($getRecord->interview_desc == $this->pregReps($this->input->post('conclusion_ket'))){
                echo "Nochange";exit();
            } else {
                $blacklist = array(
                    'interview_status' => 1,
                    'interview_desc' => $this->pregReps($this->input->post('conclusion_ket'))
                );
                $saveBlacklist = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $blacklist);
                $peopleBlacklist = array(
                    'people_blacklist' => $this->pregRepn($this->input->post('blacklist'))
                );
                $savePeopleBlacklist = $this->mod_global->edit_all('people_id', $getRecord->people_id, 'pmanual_applicant', $peopleBlacklist);
                if ($saveBlacklist == true && $savePeopleBlacklist == true){
                    $datalogs = array(
                        'logs_ip'         => $this->input->ip_address(),
                        'logs_modul'      => 'Interview Formulir',
                        'logs_aktifitas'  => 'Ubah',
                        'logs_keterangan' => 'Melakukan perubahan data pelamar ID interview : '.$id.' form (Ubah Keterangan Blacklist)',
                        'logs_user_id'    => $this->session->userdata('bssID'),
                        'logs_username'   => $this->session->userdata('username'),
                        'logs_user_name'  => $this->session->userdata('fullname'),
                        'logs_website'    => 'PORTAL'
                    );
                    $this->mod_global->insert_web1('web_logs', $datalogs);
                    echo "Success";
                } else {
                    echo "Error";exit();
                }
            }
        }

        public function save_edit_berkas(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $valinterview  = substr($this->pregReps($this->input->post('statusinterview')), 0, 1);
            $statinterview = substr($this->pregReps($this->input->post('statusinterview')), 1);
            $getRecord = $this->mod_interview->get_record_seleksi($id, 'seleksi_berkas');
            if ( 
                $getRecord->berkas_periksa   == $this->pregRepn($this->input->post('berkas_periksa')) && 
                $getRecord->berkas_reference == $this->pregReps($this->input->post('reference')) && 
                $getRecord->berkas_pic       == $this->pregReps($this->input->post('berkas_pic')) && 
                $getRecord->berkas_conclusion      == $valinterview && 
                $getRecord->berkas_conclusion_desc == $statinterview && 
                $getRecord->berkas_description     == $this->pregReps($this->input->post('conclusion_ket')) 
            ){ echo "Nochange"; exit();
            } elseif ($statinterview == "Blacklist") {
                $peopleBlacklist = array( 'people_blacklist' => 1 );
                $this->mod_global->edit_all('people_id', $getRecord->people_id, 'pmanual_applicant', $peopleBlacklist);
                $blacklist = array(
                    'interview_status' => 4,
                    'interview_desc' => $this->pregReps($this->input->post('conclusion_ket'))
                );
                $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $blacklist);
                echo "Success";exit();
            } else {
                $getLastStep = $this->mod_interview->get_last_step_interview($id);
                $berkas = array(
                    'berkas_periksa'    => $this->pregRepn($this->input->post('berkas_periksa')),
                    'berkas_reference'  => $this->pregReps($this->input->post('reference')),
                    'berkas_pic'        => $this->pregReps($this->input->post('berkas_pic')),
                    'berkas_conclusion' => $valinterview,
                    'berkas_conclusion_desc' => $statinterview,
                    'berkas_description' => $this->pregReps($this->input->post('conclusion_ket'))
                );
                $saveBerkas = $this->mod_global->edit_all('id', $id, 'seleksi_berkas', $berkas);
                if ($saveBerkas == true){
                    $datalogs = array(
                        'logs_ip'         => $this->input->ip_address(),
                        'logs_modul'      => 'Interview Formulir',
                        'logs_aktifitas'  => 'Ubah',
                        'logs_keterangan' => 'Melakukan perubahan data pelamar ID interview : '.$id.' form (Ubah Seleksi Berkas)',
                        'logs_user_id'    => $this->session->userdata('bssID'),
                        'logs_username'   => $this->session->userdata('username'),
                        'logs_user_name'  => $this->session->userdata('fullname'),
                        'logs_website'    => 'PORTAL'
                    );
                    $this->mod_global->insert_web1('web_logs', $datalogs);
                    if ($getLastStep->tahap == "Berkas") {
                        $interview = array(
                            'interview_status' => $valinterview,
                            'interview_desc' => $statinterview
                        );
                        $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $interview);
                        echo "Success";
                    } else {
                        echo "Success";
                    }
                } else {
                    echo "Error";exit();
                }
            }
        }

        public function save_edit_hrd_teknis(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $valinterview  = substr($this->pregReps($this->input->post('statusinterview')), 0, 1);
            $statinterview = substr($this->pregReps($this->input->post('statusinterview')), 1);
            $getRecord = $this->mod_interview->get_record_seleksi($id, 'seleksi_hrd_teknis');
            if ( 
                $this->serverDate($getRecord->hrdteknis_date) == $this->serverDate($this->input->post('hrdteknis_date')) &&
                $getRecord->hrd_pic == $this->pregReps($this->input->post('hrd_pic')) &&
                $getRecord->teknis_pic == $this->pregReps($this->input->post('teknis_pic')) &&
                $getRecord->hrdteknis_conclusion == $valinterview &&
                $getRecord->hrdteknis_conclusion_desc == $statinterview &&
                $getRecord->hrdteknis_description == $this->pregReps($this->input->post('conclusion_ket')) &&
                $getRecord->hrdteknis_reference == $this->pregReps($this->input->post('reference'))
            ){ echo "Nochange"; exit(); }
            elseif ($statinterview == "Blacklist") {
                $peopleBlacklist = array( 'people_blacklist' => 1 );
                $this->mod_global->edit_all('people_id', $getRecord->people_id, 'pmanual_applicant', $peopleBlacklist);
                $blacklist = array(
                    'interview_status' => 4,
                    'interview_desc' => $this->pregReps($this->input->post('conclusion_ket'))
                );
                $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $blacklist);
                echo "Success";exit();
            } else {
                $getLastStep = $this->mod_interview->get_last_step_interview($id);
                $hrdteknis = array(
                    'hrdteknis_date' => $this->serverDate($this->input->post('hrdteknis_date')),
                    'hrd_pic'    => $this->pregReps($this->input->post('hrd_pic')),
                    'teknis_pic' => $this->pregReps($this->input->post('teknis_pic')),
                    'hrdteknis_conclusion' => $valinterview,
                    'hrdteknis_conclusion_desc' => $statinterview,
                    'hrdteknis_description' => $this->pregReps($this->input->post('conclusion_ket')),
                    'hrdteknis_reference'   => $this->pregReps($this->input->post('reference'))
                );
                $saveHRDTeknis = $this->mod_global->edit_all('id', $id, 'seleksi_hrd_teknis', $hrdteknis);
                if ($saveHRDTeknis == true){
                    $datalogs = array(
                        'logs_ip'         => $this->input->ip_address(),
                        'logs_modul'      => 'Interview Formulir',
                        'logs_aktifitas'  => 'Ubah',
                        'logs_keterangan' => 'Melakukan perubahan data pelamar ID interview : '.$id.' form (Ubah Seleksi HRD-Teknis)',
                        'logs_user_id'    => $this->session->userdata('bssID'),
                        'logs_username'   => $this->session->userdata('username'),
                        'logs_user_name'  => $this->session->userdata('fullname'),
                        'logs_website'    => 'PORTAL'
                    );
                    $this->mod_global->insert_web1('web_logs', $datalogs);
                    if ($getLastStep->tahap == "HRD-Teknis") {
                        $interview = array(
                            'interview_status' => $valinterview,
                            'interview_desc'   => $statinterview
                        );
                        $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $interview);
                        echo "Success";
                    } else {
                        echo "Success";
                    }
                } else {
                    echo "Error";exit();
                }
            }
        }

        public function save_edit_teori(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $valinterview  = substr($this->pregReps($this->input->post('statusinterview')), 0, 1);
            $statinterview = substr($this->pregReps($this->input->post('statusinterview')), 1);
            $getRecord = $this->mod_interview->get_record_seleksi($id, 'seleksi_teori');
            if ( 
                $this->serverDate($getRecord->teori_date) == $this->serverDate($this->input->post('teori_date')) &&
                $getRecord->teori_pic == $this->pregReps($this->input->post('teori_pic')) &&
                $getRecord->teori_score == $this->pregReps($this->input->post('teori_score')) &&
                $getRecord->teori_conclusion == $valinterview &&
                $getRecord->teori_conclusion_desc == $statinterview &&
                $getRecord->teori_description == $this->pregReps($this->input->post('conclusion_ket')) &&
                $getRecord->teori_reference == $this->pregReps($this->input->post('reference'))
            ){ echo "Nochange"; exit(); }
            elseif ($statinterview == "Blacklist") {
                $peopleBlacklist = array( 'people_blacklist' => 1 );
                $this->mod_global->edit_all('people_id', $getRecord->people_id, 'pmanual_applicant', $peopleBlacklist);
                $blacklist = array(
                    'interview_status' => 4,
                    'interview_desc'   => $this->pregReps($this->input->post('conclusion_ket'))
                );
                $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $blacklist);
                echo "Success";exit();
            } else {
                $getLastStep = $this->mod_interview->get_last_step_interview($id);
                $teori = array(
                    'teori_date'  => $this->serverDate($this->input->post('teori_date')),
                    'teori_pic'   => $this->pregReps($this->input->post('teori_pic')),
                    'teori_score' => $this->pregReps($this->input->post('teori_score')),
                    'teori_conclusion' => $valinterview,
                    'teori_conclusion_desc' => $statinterview,
                    'teori_description' => $this->pregReps($this->input->post('conclusion_ket')),
                    'teori_reference'   => $this->pregReps($this->input->post('reference'))
                );
                $saveTeori = $this->mod_global->edit_all('id', $id, 'seleksi_teori', $teori);
                if ($saveTeori == true){
                    $datalogs = array(
                        'logs_ip'      => $this->input->ip_address(),
                        'logs_modul'   => 'Interview Formulir',
                        'logs_aktifitas'  => 'Ubah',
                        'logs_keterangan' => 'Melakukan perubahan data pelamar ID interview : '.$id.' form (Ubah Seleksi Teori)',
                        'logs_user_id'    => $this->session->userdata('bssID'),
                        'logs_username'   => $this->session->userdata('username'),
                        'logs_user_name'  => $this->session->userdata('fullname'),
                        'logs_website'    => 'PORTAL'
                    );
                    $this->mod_global->insert_web1('web_logs', $datalogs);
                    if ($getLastStep->tahap == "Teori") {
                        $interview = array(
                            'interview_status' => $valinterview,
                            'interview_desc'   => $statinterview
                        );
                        $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $interview);
                        echo "Success";
                    } else {
                        echo "Success";
                    }
                } else {
                    echo "Error";exit();
                }
            }
        }

        public function save_edit_praktek(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $valinterview  = substr($this->pregReps($this->input->post('statusinterview')), 0, 1);
            $statinterview = substr($this->pregReps($this->input->post('statusinterview')), 1);
            $getRecord = $this->mod_interview->get_record_seleksi($id, 'seleksi_praktek');
            if ( 
                $this->serverDate($getRecord->praktek_date) == $this->serverDate($this->input->post('praktek_date')) &&
                $getRecord->praktek_pic == $this->pregReps($this->input->post('praktek_pic')) &&
                $getRecord->score1 == $this->pregReps($this->input->post('score1')) &&
                $getRecord->score2 == $this->pregReps($this->input->post('score2')) &&
                $getRecord->score3 == $this->pregReps($this->input->post('score3')) &&
                $getRecord->score4 == $this->pregReps($this->input->post('score4')) &&
                $getRecord->score5 == $this->pregReps($this->input->post('score5')) &&
                $getRecord->praktek_conclusion == $valinterview &&
                $getRecord->praktek_conclusion_desc == $statinterview &&
                $getRecord->praktek_description == $this->pregReps($this->input->post('conclusion_ket')) &&
                $getRecord->praktek_reference == $this->pregReps($this->input->post('reference'))
            ){ echo "Nochange"; exit(); }
            elseif ($statinterview == "Blacklist") {
                $peopleBlacklist = array( 'people_blacklist' => 1 );
                $this->mod_global->edit_all('people_id', $getRecord->people_id, 'pmanual_applicant', $peopleBlacklist);
                $blacklist = array(
                    'interview_status' => 4,
                    'interview_desc'   => $this->pregReps($this->input->post('conclusion_ket'))
                );
                $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $blacklist);
                echo "Success";exit();
            } else {
                $getLastStep = $this->mod_interview->get_last_step_interview($id);
                $praktek = array(
                    'praktek_date' => $this->serverDate($this->input->post('praktek_date')),
                    'praktek_pic'  => $this->pregReps($this->input->post('praktek_pic')),
                    'score1' => $this->pregReps($this->input->post('score1')),
                    'score2' => $this->pregReps($this->input->post('score2')),
                    'score3' => $this->pregReps($this->input->post('score3')),
                    'score4' => $this->pregReps($this->input->post('score4')),
                    'score5' => $this->pregReps($this->input->post('score5')),
                    'praktek_conclusion' => $valinterview,
                    'praktek_conclusion_desc' => $statinterview,
                    'praktek_description' => $this->pregReps($this->input->post('conclusion_ket')),
                    'praktek_reference'   => $this->pregReps($this->input->post('reference'))
                );
                $savePraktek = $this->mod_global->edit_all('id', $id, 'seleksi_praktek', $praktek);
                if ($savePraktek == true){
                    $datalogs = array(
                        'logs_ip'         => $this->input->ip_address(),
                        'logs_modul'      => 'Interview Formulir',
                        'logs_aktifitas'  => 'Ubah',
                        'logs_keterangan' => 'Melakukan perubahan data pelamar ID interview : '.$id.' form (Ubah Seleksi Praktek)',
                        'logs_user_id'    => $this->session->userdata('bssID'),
                        'logs_username'   => $this->session->userdata('username'),
                        'logs_user_name'  => $this->session->userdata('fullname'),
                        'logs_website'    => 'PORTAL'
                    );
                    $this->mod_global->insert_web1('web_logs', $datalogs);
                    if ($getLastStep->tahap == "Praktek") {
                        $interview = array(
                            'interview_status' => $valinterview,
                            'interview_desc'   => $statinterview
                        );
                        $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $interview);
                        echo "Success";
                    } else {
                        echo "Success";
                    }
                } else {
                    echo "Error";exit();
                }
            }
        }

        public function save_edit_mcu(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $valinterview  = substr($this->pregReps($this->input->post('statusinterview')), 0, 1);
            $statinterview = substr($this->pregReps($this->input->post('statusinterview')), 1);
            $getRecord = $this->mod_interview->get_record_seleksi($id, 'seleksi_mcu');
            if ( 
                $this->serverDate($getRecord->mcu_date) == $this->serverDate($this->input->post('mcu_date')) &&
                $getRecord->mcu_conclusion == $valinterview &&
                $getRecord->mcu_conclusion_desc == $statinterview &&
                $getRecord->mcu_description == $this->pregReps($this->input->post('conclusion_ket')) &&
                $getRecord->mcu_result == $this->pregReps($this->input->post('mcu_result'))
            ){ echo "Nochange"; exit(); }
            elseif ($statinterview == "Blacklist") {
                $peopleBlacklist = array( 'people_blacklist' => 1 );
                $this->mod_global->edit_all('people_id', $getRecord->people_id, 'pmanual_applicant', $peopleBlacklist);
                $blacklist = array(
                    'interview_status' => 4,
                    'interview_desc'   => $this->pregReps($this->input->post('conclusion_ket'))
                );
                $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $blacklist);
                echo "Success";exit();
            } else {
                $getLastStep = $this->mod_interview->get_last_step_interview($id);
                $praktek = array(
                    'mcu_date'   => $this->serverDate($this->input->post('mcu_date')),
                    'mcu_result' => $this->pregReps($this->input->post('mcu_result')),
                    'mcu_conclusion'      => $valinterview,
                    'mcu_conclusion_desc' => $statinterview,
                    'mcu_description'     => $this->pregReps($this->input->post('conclusion_ket'))
                );
                $saveMCU = $this->mod_global->edit_all('id', $id, 'seleksi_mcu', $praktek);
                if ($saveMCU == true){
                    $datalogs = array(
                        'logs_ip'         => $this->input->ip_address(),
                        'logs_modul'      => 'Interview Formulir',
                        'logs_aktifitas'  => 'Ubah',
                        'logs_keterangan' => 'Melakukan perubahan data pelamar ID interview : '.$id.' form (Ubah Seleksi MCU)',
                        'logs_user_id'    => $this->session->userdata('bssID'),
                        'logs_username'   => $this->session->userdata('username'),
                        'logs_user_name'  => $this->session->userdata('fullname'),
                        'logs_website'    => 'PORTAL'
                    );
                    $this->mod_global->insert_web1('web_logs', $datalogs);
                    if ($getLastStep->tahap == "MCU") {
                        $interview = array(
                            'interview_status' => $valinterview,
                            'interview_desc'   => $statinterview
                        );
                        $saveInterview = $this->mod_global->edit_all('id', $id, 'pmanual_interview', $interview);
                        echo "Success";
                    } else {
                        echo "Success";
                    }
                } else {
                    echo "Error";exit();
                }
            }
        }

    }
?>