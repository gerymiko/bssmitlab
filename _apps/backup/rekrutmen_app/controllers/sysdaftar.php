<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdaftar extends CI_Controller {

        function __construct() {
            parent::__construct();
            $checkSession = $this->session->set_userdata('username', NULL);
            $this->load->model(['mdaftar/mod_karir_daftar']);
            $this->output->enable_profiler(false);
        }

        public function checkAvailUser(){
            $username = preg_replace('/[^a-zA-Z0-9-_\.]/','', $this->input->post('username'));
            $query    = $this->mod_karir_daftar->checkAvailUser($username); 
            if($query == TRUE) {
                echo $status = 'true';
            } else {             
                echo $status = 'false'; 
            }
        }

        public function checkAvailKTP(){
            $idCard = preg_replace('/[^a-zA-Z0-9-_\.]/','', $this->input->post('plisence_number'));
            $query  = $this->mod_karir_daftar->checkAvailKTP($idCard);  
            if($query == TRUE) {
                echo $status = 'true';
            } else {             
                echo $status = 'false'; 
            }
        }

        public function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu' 	  => 'pages/pcomp/vmenu',
                'content' => 'pages/pregister/step_1',
                'footer'  => 'pages/pcomp/vfooter_reg'
        	);
        	$this->load->view('pages/index', $data);
        }

        public function step_2(){
            if (!empty($_POST)) {
                $username    = $this->input->post('username');
                $password    = $this->input->post('password');
                $cekUsername = $this->mod_karir_daftar->checkAvailUser($username);

                if($cekUsername == true) {
                    $this->session->set_flashdata('pesan', array('message' => 'Username yang Anda pilih sudah terpakai. Mohon gunakan username yang lain.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar');
                } else {
                    $this->input->set_cookie(array('name'=>'user','value'=>$username,'expire'=>'14400','path'=>'/')); 
                    $this->input->set_cookie(array('name'=>'password','value'=>$password,'expire'=>'14400','path'=>'/'));
                    redirect('sysdaftar/step_2');
                }
            } elseif($this->input->cookie('user',TRUE) == NULL && $this->input->cookie('pass',TRUE) == NULL) {
                $this->session->set_flashdata('pesan', array('message' => 'Mohon isi keseluruhan kolom disetiap tahap.', 'class' => 'error', 'title' => 'Oops!'));
                redirect('sysdaftar');
            }
            $data = array(
                'sheader' => 'pages/ext/header',
                'sfooter' => 'pages/ext/footer',
                'menu'    => 'pages/pcomp/vmenu',
                'content' => 'pages/pregister/step_2',
                'footer'  => 'pages/pcomp/vfooter_reg',
                'kota'    => $this->mod_karir_global->getCity()
            );
            $this->load->view('pages/index', $data);
        }

        public function step_3(){
            if (!empty($_POST)) {
                $firstname    = $this->input->post('people_firstname');
                $middlename   = $this->input->post('people_middlename');
                $lastname     = $this->input->post('people_lastname');
                $email        = $this->input->post('people_email');
                $ktp          = $this->input->post('plisence_number');
                $gender       = $this->input->post('people_gender');
                $birth_place  = $this->input->post('people_birth_place');
                $birth_date   = $this->input->post('people_birth_date');
                $phone        = $this->input->post('people_phone');
                $mobile       = $this->input->post('people_mobile');
                $pstat_status = $this->input->post('pstat_status');
                $religion     = $this->input->post('people_religion');
                $citizen      = $this->input->post('people_citizen');
                $blood_type   = $this->input->post('people_blood_type');
                $height       = $this->input->post('people_height');
                $weight       = $this->input->post('people_weight');
                
                $array_personal = array($firstname, $middlename, $lastname, $email, $ktp, $gender, $birth_place, $birth_date, $phone, $mobile, $pstat_status, $religion, $citizen, $blood_type, $height, $weight);
                $item_personal  = array('firstname', 'middlename', 'lastname', 'email', 'ktp', 'gender', 'bplace', 'bdate', 'phone', 'mobile', 'status', 'agama', 'negara', 'darah', 'tinggi', 'berat');
                for ($i = 0; $i < count($array_personal); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_personal[$i],'value'=>$array_personal[$i],'expire'=>'14400','path'=>'/'));
                }
                
                if ($ktp < 16) {
                    $this->session->set_flashdata('pesan', array('message' => 'Nomor KTP anda kurang dari 16 digit. Tolong cek kembali.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar/step_2');
                }

                $ktpexist   = array( 'plisence_number' => $ktp );
                $cekKondisi = $this->mod_karir_daftar->cekKondisiKTP($ktpexist);
                if ($cekKondisi == TRUE){
                    $this->session->set_flashdata('pesan', array('message' => 'Anda sudah pernah terdaftar sebelumnya. Gunakan fitur masuk/login untuk melakukan login.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar/step_2');
                }
                redirect('sysdaftar/step_3');
            } elseif ($this->input->cookie('firstname',TRUE) == NULL && $this->input->cookie('ktp',TRUE) == NULL) {
                $this->session->set_flashdata('pesan', array('message' => 'Mohon isi keseluruhan kolom disetiap tahap.', 'class' => 'error', 'title' => 'Oops!'));
                redirect('sysdaftar/step_2');
            } else {
                $data = array(
                    'sheader'  => 'pages/ext/header',
                    'sfooter'  => 'pages/ext/footer',
                    'menu'     => 'pages/pcomp/vmenu',
                    'content'  => 'pages/pregister/step_3',
                    'footer'   => 'pages/pcomp/vfooter_reg',
                    'kota'     => $this->mod_karir_global->getCity(),
                    'province' => $this->mod_karir_global->getProvince()
                );
                $this->load->view('pages/index', $data);
            }
        }

        public function step_4(){
            $firstname = $this->input->cookie('firstname',TRUE);
            if ($firstname == NULL){
                redirect('sysdaftar/step_3');
            }

            $simA_checked   = $this->input->post('simA');
            $simB1_checked  = $this->input->post('simB1');
            $simB2_checked  = $this->input->post('simB2');
            $simB2U_checked = $this->input->post('simB2U');
            $simC_checked   = $this->input->post('simC');
            $simD_checked   = $this->input->post('simD');

            //SIM A
            $number_simA   = $this->input->post('plisence_number_A');
            $kota_sim_A    = $this->input->post('kota_sim_A');
            $datestart_A   = $this->input->post('plisence_date_start_A');
            $dateend_A     = $this->input->post('plisence_date_end_A');
            
            //SIM B1
            $number_simB1  = $this->input->post('plisence_number_B1');
            $kota_sim_B1   = $this->input->post('kota_sim_B1');
            $datestart_B1  = $this->input->post('plisence_date_start_B1');
            $dateend_B1    = $this->input->post('plisence_date_end_B1');
            
            //SIM B2
            $number_simB2  = $this->input->post('plisence_number_B2');
            $kota_sim_B2   = $this->input->post('kota_sim_B2');
            $datestart_B2  = $this->input->post('plisence_date_start_B2');
            $dateend_B2    = $this->input->post('plisence_date_end_B2');
            
            //SIM B2 UMUM
            $number_simB2U = $this->input->post('plisence_number_B2U');
            $kota_sim_B2U  = $this->input->post('kota_sim_B2U');
            $datestart_B2U = $this->input->post('plisence_date_start_B2U');
            $dateend_B2U   = $this->input->post('plisence_date_end_B2U');
            
            //SIM C
            $number_simC   = $this->input->post('plisence_number_C');
            $kota_sim_C    = $this->input->post('kota_sim_C');
            $datestart_C   = $this->input->post('plisence_date_start_C');
            $dateend_C     = $this->input->post('plisence_date_end_C');
            
            //SIM D
            $number_simD   = $this->input->post('plisence_number_D');
            $kota_sim_D    = $this->input->post('kota_sim_D');
            $datestart_D   = $this->input->post('plisence_date_start_D');
            $dateend_D     = $this->input->post('plisence_date_end_D');


            if ($simA_checked == 1) {
                if ($number_simA == NULL || $kota_sim_A == NULL || $datestart_A == NULL || $dateend_A == NULL) {
                    $this->session->set_flashdata('pesan', array('message' => 'Lengkapi form SIM terlebih dahulu.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar/step_3');
                }
            }

            if ($simB1_checked == 2) {
                if ($number_simB1 == NULL || $kota_sim_B1 == NULL || $datestart_B1 == NULL || $dateend_B1 == NULL) {
                    $this->session->set_flashdata('pesan', array('message' => 'Lengkapi form SIM terlebih dahulu.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar/step_3');
                }
            }

            if ($simB2_checked == 3) {
                if ($number_simB2 == NULL || $kota_sim_B2 == NULL || $datestart_B2 == NULL || $dateend_B2 == NULL) {
                    $this->session->set_flashdata('pesan', array('message' => 'Lengkapi form SIM terlebih dahulu.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar/step_3');
                }
            }

            if ($simB2U_checked == 4) {
                if ($number_simB2U == NULL || $kota_sim_B2U == NULL || $datestart_B2U == NULL || $dateend_B2U == NULL) {
                    $this->session->set_flashdata('pesan', array('message' => 'Lengkapi form SIM terlebih dahulu.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar/step_3');
                }
            }

            if ($simC_checked == 5) {
                if ($number_simC == NULL || $kota_sim_C == NULL || $datestart_C == NULL || $dateend_C == NULL) {
                    $this->session->set_flashdata('pesan', array('message' => 'Lengkapi form SIM terlebih dahulu.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar/step_3');
                }
            }

            if ($simD_checked == 6) {
                if ($number_simD == NULL || $kota_sim_D == NULL || $datestart_D == NULL || $dateend_D == NULL) {
                    $this->session->set_flashdata('pesan', array('message' => 'Lengkapi form SIM terlebih dahulu.', 'class' => 'error', 'title' => 'Oops!'));
                    redirect('sysdaftar/step_3');
                }
            }

            if (!empty($_POST)) {
                // LISENCE KTP        
                $kota_ktp        = $this->input->post('plisence_keluaran_ktp');
                $datestart_ktp   = $this->input->post('datestart_ktp');
                $dateend_ktp     = $this->input->post('dateend_ktp');
                
                //ALAMAT KTP
                $alamatKTP       = $this->input->post('alamatKTP');
                $alamat_kota_ktp = $this->input->post('alamat_kota_ktp');
                $zip_code_ktp    = $this->input->post('zip_code_ktp');
                
                //ALAMAT DOMISILI
                $alamatDOM       = $this->input->post('alamatDOM');
                $alamat_kota_dom = $this->input->post('alamat_kota_dom');
                $zip_code_dom    = $this->input->post('zip_code_dom');
                
                //SIM A
                $number_simA     = $this->input->post('plisence_number_A');
                $kota_sim_A      = $this->input->post('kota_sim_A');
                $datestart_A     = $this->input->post('plisence_date_start_A');
                $dateend_A       = $this->input->post('plisence_date_end_A');
                
                //SIM B1
                $number_simB1    = $this->input->post('plisence_number_B1');
                $kota_sim_B1     = $this->input->post('kota_sim_B1');
                $datestart_B1    = $this->input->post('plisence_date_start_B1');
                $dateend_B1      = $this->input->post('plisence_date_end_B1');
                
                //SIM B2
                $number_simB2    = $this->input->post('plisence_number_B2');
                $kota_sim_B2     = $this->input->post('kota_sim_B2');
                $datestart_B2    = $this->input->post('plisence_date_start_B2');
                $dateend_B2      = $this->input->post('plisence_date_end_B2');
                
                //SIM B2 UMUM
                $number_simB2U   = $this->input->post('plisence_number_B2U');
                $kota_sim_B2U    = $this->input->post('kota_sim_B2U');
                $datestart_B2U   = $this->input->post('plisence_date_start_B2U');
                $dateend_B2U     = $this->input->post('plisence_date_end_B2U');
                
                //SIM C
                $number_simC     = $this->input->post('plisence_number_C');
                $kota_sim_C      = $this->input->post('kota_sim_C');
                $datestart_C     = $this->input->post('plisence_date_start_C');
                $dateend_C       = $this->input->post('plisence_date_end_C');
                
                //SIM D
                $number_simD     = $this->input->post('plisence_number_D');
                $kota_sim_D      = $this->input->post('kota_sim_D');
                $datestart_D     = $this->input->post('plisence_date_start_D');
                $dateend_D       = $this->input->post('plisence_date_end_D');

                //KTP

                $array_lisence_ktp = array($kota_ktp, $datestart_ktp, $dateend_ktp);
                $item_lisence_ktp  = array('kota_ktp', 'datestart_ktp', 'dateend_ktp');
                for ($i=0; $i < count($array_lisence_ktp); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_lisence_ktp[$i],'value'=>$array_lisence_ktp[$i],'expire'=>'14400','path'=>'/'));
                }

                //ALAMAT

                $array_alamat_ktp = array($alamatKTP, $alamat_kota_ktp, $zip_code_ktp);
                $item_alamat_ktp  = array('alamatKTP', 'alamat_kota_ktp', 'zip_code_ktp');
                for ($i=0; $i < count($array_alamat_ktp); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_alamat_ktp[$i],'value'=>$array_alamat_ktp[$i],'expire'=>'14400','path'=>'/'));
                }

                $array_alamat_dom = array($alamatDOM, $alamat_kota_dom, $zip_code_dom);
                $item_alamat_dom  = array('alamatDOM', 'alamat_kota_dom', 'zip_code_dom');
                for ($i=0; $i < count($array_alamat_dom); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_alamat_dom[$i],'value'=>$array_alamat_dom[$i],'expire'=>'14400','path'=>'/'));
                }

                //SIM

                $array_sim_A = array($number_simA, $kota_sim_A, $datestart_A, $dateend_A);
                $item_sim_A  = array('plisence_number_A', 'kota_sim_A', 'datestart_A', 'dateend_A');
                for ($i=0; $i < count($array_sim_A); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_sim_A[$i],'value'=>$array_sim_A[$i],'expire'=>'14400','path'=>'/'));
                }

                $array_sim_B1 = array($number_simB1, $kota_sim_B1, $datestart_B1, $dateend_B1);
                $item_sim_B1  = array('plisence_number_B1', 'kota_sim_B1', 'datestart_B1', 'dateend_B1');
                for ($i=0; $i < count($array_sim_B1); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_sim_B1[$i],'value'=>$array_sim_B1[$i],'expire'=>'14400','path'=>'/'));
                }

                $array_sim_B2 = array($number_simB2, $kota_sim_B2, $datestart_B2, $dateend_B2);
                $item_sim_B2  = array('plisence_number_B2', 'kota_sim_B2', 'datestart_B2', 'dateend_B2');
                for ($i=0; $i < count($array_sim_B2); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_sim_B2[$i],'value'=>$array_sim_B2[$i],'expire'=>'14400','path'=>'/'));
                }

                $array_sim_B2U = array($number_simB2U, $kota_sim_B2U, $datestart_B2U, $dateend_B2U);
                $item_sim_B2U  = array('plisence_number_B2U', 'kota_sim_B2U', 'datestart_B2U', 'dateend_B2U');
                for ($i=0; $i < count($array_sim_B2U); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_sim_B2U[$i],'value'=>$array_sim_B2U[$i],'expire'=>'14400','path'=>'/'));
                }

                $array_sim_C = array($number_simC, $kota_sim_C, $datestart_C, $dateend_C);
                $item_sim_C  = array('plisence_number_C', 'kota_sim_C', 'datestart_C', 'dateend_C');
                for ($i=0; $i < count($array_sim_C); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_sim_C[$i],'value'=>$array_sim_C[$i],'expire'=>'14400','path'=>'/'));
                }

                $array_sim_D = array($number_simD, $kota_sim_D, $datestart_D, $dateend_D);
                $item_sim_D  = array('plisence_number_D', 'kota_sim_D', 'datestart_D', 'dateend_D');
                for ($i=0; $i < count($array_sim_D); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_sim_D[$i],'value'=>$array_sim_D[$i],'expire'=>'14400','path'=>'/'));
                }
                redirect('sysdaftar/step_4');
            } elseif ($this->input->cookie('alamatKTP',TRUE) == NULL && $this->input->cookie('alamatDOM',TRUE) == NULL) {
                $this->session->set_flashdata('pesan', array('message' => 'Mohon isi keseluruhan kolom disetiap tahap.', 'class' => 'error', 'title' => 'Oops!'));
                redirect('sysdaftar/step_3');
            } else {
                $data = array(
                    'sheader' => 'pages/ext/header',
                    'sfooter' => 'pages/ext/footer',
                    'menu'    => 'pages/pcomp/vmenu',
                    'content' => 'pages/pregister/step_4',
                    'footer'  => 'pages/pcomp/vfooter_reg',
                    'kota'    => $this->mod_karir_global->getCity(),
                    'edukasi' => $this->mod_karir_global->getEducation(),
                    'major'   => $this->mod_karir_global->getMajor()
                );
                $this->load->view('pages/index', $data);
            }
        }

        public function step_5(){
            if (!empty($_POST)) {
                $edutype   = $this->input->post('edu_tipe');
                $eduname   = $this->input->post('edu_name');
                $edukota   = $this->input->post('edu_kota');
                $eduprodi  = $this->input->post('edu_jurusan');
                $edululus  = $this->input->post('edu_datepass');
                $eduket    = $this->input->post('edu_keterangan');
                
                $array_edu = array($edutype, $eduname, $eduprodi, $edukota, $edululus, $eduket);
                $item_edu  = array('edu_tipe', 'edu_name', 'edu_jurusan', 'edu_kota', 'edu_datepass', 'edu_keterangan');
                for ($i = 0; $i < count($array_edu); $i++) { 
                    $this->input->set_cookie(array('name'=>$item_edu[$i],'value'=>$array_edu[$i],'expire'=>'14400','path'=>'/'));
                }
                $data = array(
                    'sheader' => 'pages/ext/header',
                    'sfooter' => 'pages/ext/footer',
                    'menu'    => 'pages/pcomp/vmenu',
                    'content' => 'pages/pregister/step_5',
                    'footer'  => 'pages/pcomp/vfooter_reg',
                    'sector'  => $this->mod_karir_global->getSector()
                );
                $this->load->view('pages/index', $data);
            } elseif ($this->input->cookie('edu_name',TRUE) == NULL && $this->input->cookie('edu_jurusan',TRUE) == NULL) {
                $this->session->set_flashdata('pesan', array('message' => 'Mohon isi keseluruhan kolom disetiap tahap.', 'class' => 'error', 'title' => 'Oops!'));
                redirect('sysdaftar/step_4');
            } else {
                $data = array(
                    'sheader' => 'pages/ext/header',
                    'sfooter' => 'pages/ext/footer',
                    'menu'    => 'pages/pcomp/vmenu',
                    'content' => 'pages/pregister/step_5',
                    'footer'  => 'pages/pcomp/vfooter_reg',
                    'sector'  => $this->mod_karir_global->getSector()
                );
                $this->load->view('pages/index', $data);
            }
        }

        public function step_6(){
            if (!empty($_POST)) {
                $hasJob = $this->input->post('hasJob');
                $this->input->set_cookie(array('name'=>'hasJob','value'=>$hasJob,'expire'=>'14400','path'=>'/'));
                if($hasJob == 1){
                    $job_company1      = $this->input->post('job_company1');
                    $job_part1         = $this->input->post('job_part1');
                    $job_billet_first1 = $this->input->post('job_billet_first1');
                    $job_billet_last1  = $this->input->post('job_billet_last1');
                    $job_from1         = $this->input->post('job_from1');
                    $job_until1        = $this->input->post('job_until1');
                    $job_salary1       = $this->input->post('job_salary1');
                    $job_reason1       = $this->input->post('job_reason1');

                    $job_history1 = array(
                        $job_company1, $job_part1, $job_billet_first1, $job_billet_last1, $job_salary1, $job_reason1, $job_from1, $job_until1
                    );
                    $item_history1 = array(
                        'job_company1', 'job_part1', 'job_billet_first1', 'job_billet_last1', 'job_salary1', 'job_reason1', 'job_from1', 'job_until1'
                    );
                    for ($i = 0; $i < count($job_history1); $i++) {
                        $this->input->set_cookie(array('name'=>$item_history1[$i],'value'=>$job_history1[$i],'expire'=>'14400','path'=>'/'));
                    }

                    $job_company2      = $this->input->post('job_company2');
                    $job_part2         = $this->input->post('job_part2');
                    $job_billet_first2 = $this->input->post('job_billet_first2');
                    $job_billet_last2  = $this->input->post('job_billet_last2');
                    $job_from2         = $this->input->post('job_from2');
                    $job_until2        = $this->input->post('job_until2');
                    $job_salary2       = $this->input->post('job_salary2');
                    $job_reason2       = $this->input->post('job_reason2');

                    $job_history2 = array(
                        $job_company2, $job_part2, $job_billet_first2, $job_billet_last2, $job_salary2, $job_reason2, $job_from2, $job_until2
                    );
                    $item_history2 = array(
                        'job_company2', 'job_part2', 'job_billet_first2', 'job_billet_last2', 'job_salary2', 'job_reason2', 'job_from2', 'job_until2'
                    );
                    for ($i = 0; $i < count($job_history2); $i++) {
                        $this->input->set_cookie(array('name'=>$item_history2[$i],'value'=>$job_history2[$i],'expire'=>'14400','path'=>'/'));
                    }

                    $job_company3      = $this->input->post('job_company3');
                    $job_part3         = $this->input->post('job_part3');
                    $job_billet_first3 = $this->input->post('job_billet_first3');
                    $job_billet_last3  = $this->input->post('job_billet_last3');
                    $job_from3         = $this->input->post('job_from3');
                    $job_until3        = $this->input->post('job_until3');
                    $job_salary3       = $this->input->post('job_salary3');
                    $job_reason3       = $this->input->post('job_reason3');

                    $job_history3 = array(
                        $job_company3, $job_part3, $job_billet_first3, $job_billet_last3, $job_salary3, $job_reason3, $job_from3, $job_until3
                    );
                    $item_history3 = array(
                        'job_company3', 'job_part3', 'job_billet_first3', 'job_billet_last3', 'job_salary3', 'job_reason3', 'job_from3', 'job_until3'
                    );
                    for ($i = 0; $i < count($job_history3); $i++) {
                        $this->input->set_cookie(array('name'=>$item_history3[$i],'value'=>$job_history3[$i],'expire'=>'14400','path'=>'/'));
                    }

                    $job_company4      = $this->input->post('job_company4');
                    $job_part4         = $this->input->post('job_part4');
                    $job_billet_first4 = $this->input->post('job_billet_first4');
                    $job_billet_last4  = $this->input->post('job_billet_last4');
                    $job_from4         = $this->input->post('job_from4');
                    $job_until4        = $this->input->post('job_until4');
                    $job_salary4       = $this->input->post('job_salary4');
                    $job_reason4       = $this->input->post('job_reason4');

                    $job_history4 = array(
                        $job_company4, $job_part4, $job_billet_first4, $job_billet_last4, $job_salary4, $job_reason4, $job_from4, $job_until4
                    );
                    $item_history4 = array(
                        'job_company4', 'job_part4', 'job_billet_first4', 'job_billet_last4', 'job_salary4', 'job_reason4', 'job_from4', 'job_until4'
                    );
                    for ($i = 0; $i < count($job_history4); $i++) {
                        $this->input->set_cookie(array('name'=>$item_history4[$i],'value'=>$job_history4[$i],'expire'=>'14400','path'=>'/'));
                    }
                } else {
                    $item_history1 = array(
                        'job_company1', 'job_part1', 'job_billet_first1', 'job_billet_last1', 'job_salary1', 'job_reason1', 'job_from1', 'job_until1'
                    );
                    for ($i = 0; $i < count($item_history1); $i++) {
                        delete_cookie($item_history1[$i]);
                    }
                    $item_history2 = array(
                        'job_company2', 'job_part2', 'job_billet_first2', 'job_billet_last2', 'job_salary2', 'job_reason2', 'job_from2', 'job_until2'
                    );
                    for ($i = 0; $i < count($item_history2); $i++) {
                        delete_cookie($item_history2[$i]);
                    }
                    $item_history3 = array(
                        'job_company3', 'job_part3', 'job_billet_first3', 'job_billet_last3', 'job_salary3', 'job_reason3', 'job_from3', 'job_until3'
                    );
                    for ($i = 0; $i < count($item_history3); $i++) {
                        delete_cookie($item_history3[$i]);
                    }
                    $item_history4 = array(
                        'job_company4', 'job_part4', 'job_billet_first4', 'job_billet_last4', 'job_salary4', 'job_reason4', 'job_from4', 'job_until4'
                    );
                    for ($i = 0; $i < count($item_history4); $i++) {
                        delete_cookie($item_history4[$i]);
                    }
                }
                redirect('sysdaftar/step_6');
            } elseif ($this->input->cookie('hasJob', true) == FALSE) {
                $this->session->set_flashdata('pesan', array('message' => 'Mohon isi keseluruhan kolom disetiap tahap cuy.', 'class' => 'error', 'title' => 'Oops!'));
                redirect('sysdaftar/step_5');
            } else {
                $data = array(
                    'sheader'    => 'pages/ext/header',
                    'sfooter'    => 'pages/ext/footer',
                    'menu'       => 'pages/pcomp/vmenu',
                    'content'    => 'pages/pregister/step_6',
                    'footer'     => 'pages/pcomp/vfooter_reg',
                    'pertanyaan' => $this->mod_karir_daftar->getQuestionRec()
                );
                $this->load->view('pages/index', $data);
            }
        }

        public function step_final(){
            if (!empty($_POST)) {
                $question_reg1      = $this->input->post('question_reg1');
                $question_reg2      = $this->input->post('question_reg2');
                $question_salary    = $this->input->post('question_salary');
                $question_reg4      = $this->input->post('question_reg4');
                $question_reg5      = $this->input->post('question_reg5');
                $question_placement = $this->input->post('question_placement');
                $question_shift     = $this->input->post('question_shift');
                $question_reg8      = $this->input->post('question_reg8');
                $question_ref       = $this->input->post('question_ref');
                $question_refgency  = $this->input->post('question_refgency');
                $recquest_id        = $this->input->post('recquest_id');
                
                for ($i = 0; $i < 10; $i++) {
                    $datanya = $this->input->set_cookie(array('name'=>"recquest_id$i",'value'=>$recquest_id[$i],'expire'=>'14400','path'=>'/'));
                }

                $array_question = array(
                    $question_reg1, $question_reg2, $question_salary, $question_reg4, $question_reg5, $question_placement, $question_shift, $question_reg8, $question_ref, $question_refgency
                );
                $item_question = array(
                    'question_reg1', 'question_reg2', 'question_salary', 'question_reg4', 'question_reg5', 'question_placement', 'question_shift', 'question_reg8', 'question_ref', 'question_refgency'
                );
                for ($i = 0; $i < count($array_question); $i++) {
                    $this->input->set_cookie(array('name'=>$item_question[$i],'value'=>$array_question[$i],'expire'=>'14400','path'=>'/'));
                }

                redirect('sysdaftar/step_final');
            } elseif ($this->input->cookie('question_reg5') == NULL || $this->input->cookie('edu_name',TRUE) == NULL || $this->input->cookie('alamatKTP',TRUE) == NULL || $this->input->cookie('firstname',TRUE) == NULL) {
                $this->session->set_flashdata('pesan', array('message' => 'Mohon isi keseluruhan kolom disetiap tahap.', 'class' => 'error', 'title' => 'Oops!'));
                redirect('sysdaftar/step_6');
            } else {
                $data = array(
                    'sheader' => 'pages/ext/header',
                    'sfooter' => 'pages/ext/footer',
                    'menu'    => 'pages/pcomp/vmenu',
                    'content' => 'pages/pregister/step_final',
                    'footer'  => 'pages/pcomp/vfooter_reg',
                    'pertanyaan' => $this->mod_karir_daftar->getQuestionRec()
                );
                $this->load->view('pages/index', $data);
            }
        }

        private static function strEncode($password) { 
            $result = md5(base64_encode(hash("sha256", md5(sha1(md5($password))), TRUE))); 
            return $result;
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9- _.:]/','', $number);
            return $result;
        }

        function save_registrasi() {
            $registrant_kode = $this->mod_karir_daftar->getRecruitmentID();
            
            $dateBorn        = $this->input->cookie('bdate',TRUE);
            $pbirth_date     = date('Y-m-d', strtotime($dateBorn));

            $blacklist       = $this->mod_karir_daftar->checkBlackList();
            $plisence_number = $this->input->cookie('ktp',TRUE);
            $nama            = $this->input->cookie('firstname',TRUE).' '.$this->input->cookie('middlename',TRUE).' '.$this->input->cookie('lastname',TRUE);
            if(in_array($plisence_number, $blacklist) && in_array($nama, $blacklist)){
                $status_blacklist = 1;
            } else { $status_blacklist = 0; }
            
            //DATA DIRI
            $dataPersonal = array(
                'registrant_kode'    => $this->pregReps($registrant_kode),
                'username'           => $this->pregReps($this->input->cookie('user',TRUE)),
                'password'           => $this->strEncode($this->input->cookie('password',TRUE)),
                'people_firstname'   => $this->pregReps($this->input->cookie('firstname',TRUE)),
                'people_middlename'  => $this->pregReps($this->input->cookie('middlename',TRUE)),
                'people_lastname'    => $this->pregReps($this->input->cookie('lastname',TRUE)),
                'people_email'       => $this->pregReps($this->input->cookie('email',TRUE)),
                'people_gender'      => $this->pregReps($this->input->cookie('gender',TRUE)),
                'people_phone'       => $this->pregRepn($phone = ($this->input->cookie('phone',TRUE)) ? '' : $this->input->cookie('phone',TRUE)),
                'people_mobile'      => $this->pregRepn($this->input->cookie('mobile',TRUE)),
                'people_religion'    => $this->pregReps($this->input->cookie('agama',TRUE)),
                'people_birth_place' => $this->pregRepn($this->input->cookie('bplace',TRUE)),
                'people_birth_date'  => $this->pregRepn($pbirth_date),
                'people_blood_type'  => $this->pregReps($this->input->cookie('darah',TRUE)),
                'people_height'      => $this->pregRepn($this->input->cookie('tinggi',TRUE)),
                'people_weight'      => $this->pregRepn($this->input->cookie('berat',TRUE)),
                'people_citizen'     => $this->pregReps($this->input->cookie('negara',TRUE)),
                'last_ip'            => $this->input->ip_address(),
                'people_photo'       => 'default/300.png',
                'people_reg_date'    => date("Y-m-d"),
                'people_reg_time'    => date("H:i:s"),
                'active'             => 1,
                'is_login'           => 0,
                'people_black_list'  => $status_blacklist
            );

            $people_id = $this->mod_karir_daftar->insert_into_people('people', $dataPersonal);
            if ($people_id == false) {
                echo "Error";
                exit();
            }

            // STATUS NIKAH
            $dataStatus = array(
                'people_id'      => $people_id,
                'pstat_status'   => $this->pregReps($this->input->cookie('status',TRUE)),
                'pstat_reg_date' => date('Y-m-d H:i:s')
            );

            $insertStatus = $this->mod_karir_daftar->insert_all('people_status', $dataStatus);
            if ($insertStatus == false) {
                echo "Error";
                exit();
            }

            // ALAMAT KTP
            $dataAlamatKTP = array(
                'people_id'         => $people_id,
                'city_id'           => $this->pregRepn($this->input->cookie('alamat_kota_ktp',TRUE)),
                'paddress_type'     => 'KTP',
                'address'           => $this->pregReps($this->input->cookie('alamatKTP',TRUE)),
                'zip_code'          => $this->pregRepn($this->input->cookie('zip_code_ktp',TRUE)),
                'paddress_reg_date' => date("Y-m-d"),
                'paddress_reg_time' => date("H:i:s"),
                'paddress_status'   => 1
            );

            $insertAlamatKTP = $this->mod_karir_daftar->insert_all('people_address', $dataAlamatKTP);
            if ($insertAlamatKTP == false) {
                echo "Error";
                exit();
            }

            // ALAMAT DOMISILI
            $dataAlamatDOM = array(
                'people_id'         => $people_id,
                'city_id'           => $this->pregRepn($this->input->cookie('alamat_kota_dom',TRUE)),
                'paddress_type'     => 'DOMISILI',
                'address'           => $this->pregReps($this->input->cookie('alamatDOM',TRUE)),
                'zip_code'          => $this->pregRepn($this->input->cookie('zip_code_dom',TRUE)),
                'paddress_reg_date' => date("Y-m-d"),
                'paddress_reg_time' => date("H:i:s"),
                'paddress_status'   => 1
            );

            $insertAlamatDOM = $this->mod_karir_daftar->insert_all('people_address', $dataAlamatDOM);
            if ($insertAlamatDOM == false) {
                echo "Error";
                exit();
            }

            //KTP
            $datestartKTP   = date("Y-m-d", strtotime($this->input->cookie('datestart_ktp',TRUE)));
            $dateendKTP     = date("Y-m-d", strtotime($this->input->cookie('dateend_ktp',TRUE)));
            
            $tglterbitKTP   = ($datestartKTP == NULL) ? "" : $datestartKTP;
            $tglberakhirKTP = ($dateendKTP == NULL) ? "" : $dateendKTP;

            $dataKTP = array(
                'people_id'           => $people_id,
                'plisence_number'     => $this->pregRepn($this->input->cookie('ktp',TRUE)),
                'plisence_type'       => 'KTP',
                'plisence_keluaran'   => $this->pregRepn($this->input->cookie('kota_ktp',TRUE)),
                'plisence_date_start' => $this->pregRepn($tglterbitKTP),
                'plisence_date_end'   => $this->pregRepn($tglberakhirKTP),
                'plisence_reg_date'   => date("Y-m-d H:i:s")
            );

            $insertKTP = $this->mod_karir_daftar->insert_all('people_lisence', $dataKTP);
            if ($insertKTP == false) {
                echo "Error";
                exit();
            }

            $nomor_simA   = $this->pregRepn($this->input->cookie('plisence_number_A',TRUE));
            $nomor_simB1  = $this->pregRepn($this->input->cookie('plisence_number_B1',TRUE));
            $nomor_simB2  = $this->pregRepn($this->input->cookie('plisence_number_B2',TRUE));
            $nomor_simB2U = $this->pregRepn($this->input->cookie('plisence_number_B2U',TRUE));
            $nomor_simC   = $this->pregRepn($this->input->cookie('plisence_number_C',TRUE));
            $nomor_simD   = $this->pregRepn($this->input->cookie('plisence_number_D',TRUE));

            //SIM A
            $dataSIMA = array(
                'people_id'           => $people_id,
                'plisence_number'     => $nomor_simA,
                'plisence_type'       => 'SIM A',
                'plisence_keluaran'   => $this->pregRepn($this->input->cookie('kota_sim_A',TRUE)),
                'plisence_date_start' => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('datestart_A',TRUE)))),
                'plisence_date_end'   => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('dateend_A',TRUE)))),
                'plisence_reg_date'   => date("Y-m-d H:i:s")
            );

            if (!empty($nomor_simA)){
                $insertSIMA = $this->mod_karir_daftar->insert_all('people_lisence', $dataSIMA);
                if ($insertSIMA == false) {
                    echo "Error";
                    exit();
                }
            }

            //SIM B1
            $dataSIMB1 = array(
                'people_id'           => $people_id,
                'plisence_number'     => $nomor_simB1,
                'plisence_type'       => 'SIM B1',
                'plisence_keluaran'   => $this->pregRepn($this->input->cookie('kota_sim_B1',TRUE)),
                'plisence_date_start' => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('datestart_B1',TRUE)))),
                'plisence_date_end'   => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('dateend_B1',TRUE)))),
                'plisence_reg_date'   => date("Y-m-d H:i:s")
            );

            if (!empty($nomor_simB1)){
                $insertSIMB1 = $this->mod_karir_daftar->insert_all('people_lisence', $dataSIMB1);
                if ($insertSIMB1 == false) {
                    echo "Error";
                    exit();
                }
            }

            //SIM B2
            $dataSIMB2 = array(
                'people_id'           => $people_id,
                'plisence_number'     => $nomor_simB2,
                'plisence_type'       => 'SIM B2',
                'plisence_keluaran'   => $this->pregRepn($this->input->cookie('kota_sim_B2',TRUE)),
                'plisence_date_start' => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('datestart_B2',TRUE)))),
                'plisence_date_end'   => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('dateend_B2',TRUE)))),
                'plisence_reg_date'   => date("Y-m-d H:i:s")
            );

            if (!empty($nomor_simB2)){
                $insertSIMB2 = $this->mod_karir_daftar->insert_all('people_lisence', $dataSIMB2);
                if ($insertSIMB2 == false) {
                    echo "Error";
                    exit();
                }
            }

            //SIM B2U
            $dataSIMB2U = array(
                'people_id'           => $people_id,
                'plisence_number'     => $nomor_simB2,
                'plisence_type'       => 'SIM B2U',
                'plisence_keluaran'   => $this->pregRepn($this->input->cookie('kota_sim_B2U',TRUE)),
                'plisence_date_start' => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('datestart_B2U',TRUE)))),
                'plisence_date_end'   => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('dateend_B2U',TRUE)))),
                'plisence_reg_date'   => date("Y-m-d H:i:s")
            );

            if (!empty($nomor_simB2U)){
                $insertSIMB2U = $this->mod_karir_daftar->insert_all('people_lisence', $dataSIMB2U);
                if ($insertSIMB2U == false) {
                    echo "Error";
                    exit();
                }
            }

            //SIM C
            $dataSIMC = array(
                'people_id'           => $people_id,
                'plisence_number'     => $nomor_simC,
                'plisence_type'       => 'SIM C',
                'plisence_keluaran'   => $this->pregRepn($this->input->cookie('kota_sim_C',TRUE)),
                'plisence_date_start' => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('datestart_C',TRUE)))),
                'plisence_date_end'   => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('dateend_C',TRUE)))),
                'plisence_reg_date'   => date("Y-m-d H:i:s")
            );

            if (!empty($nomor_simC)){
                $insertSIMC = $this->mod_karir_daftar->insert_all('people_lisence', $dataSIMC);
                if ($insertSIMC == false) {
                    echo "Error";
                    exit();
                }
            }

            //SIM D
            $dataSIMD = array(
                'people_id'           => $people_id,
                'plisence_number'     => $nomor_simD,
                'plisence_type'       => 'SIM D',
                'plisence_keluaran'   => $this->pregRepn($this->input->cookie('kota_sim_D',TRUE)),
                'plisence_date_start' => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('datestart_D',TRUE)))),
                'plisence_date_end'   => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('dateend_D',TRUE)))),
                'plisence_reg_date'   => date("Y-m-d H:i:s")
            );

            if (!empty($nomor_simD)){
                $insertSIMD = $this->mod_karir_daftar->insert_all('people_lisence', $dataSIMD);
                if ($insertSIMD == false) {
                    echo "Error";
                    exit();
                }
            }

            //PENDIDIKAN
            $dataPendidikan = array(
                'people_id'       => $people_id,
                'edutype_id'      => $this->pregRepn($this->input->cookie('edu_tipe',TRUE)),
                'edu_name'        => $this->pregReps($this->input->cookie('edu_name',TRUE)),
                'edu_jurusan'     => $this->pregRepn($this->input->cookie('edu_jurusan',TRUE)),
                'edu_place'       => $this->pregRepn($this->input->cookie('edu_kota',TRUE)),
                'edu_tahun_lulus' => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('edu_datepass',TRUE)))),
                'edu_keterangan'  => $this->pregReps($this->input->cookie('edu_keterangan',TRUE)),
                'edu_reg_date'    => date("Y-m-d H:i:s"),
                'edu_status'      => 1
            );

            $insertPendidikan = $this->mod_karir_daftar->insert_all('people_education', $dataPendidikan);
            if ($insertPendidikan == false) {
                echo "Error";
                exit();
            }

            // INSERT IJAZAH
            $dataIjazah = array(
                'people_id'     => $people_id,
                'plisence_type' => 'IJAZAH',
            );
            $insertIjazah = $this->mod_karir_daftar->insert_all('people_lisence', $dataIjazah);
            if ($insertIjazah == false) {
                echo "Error";
                exit();
            }

            // PENGALAMAN KERJA
            $ge1   = new DateTime($this->input->cookie('job_from1',TRUE));
            $ry1   = new DateTime($this->input->cookie('job_until1',TRUE));
            $gery1 = $ge1->diff($ry1);

            $dataPengalaman1 = array(
                'people_id'                 => $people_id,
                'pjobhistory_company'       => $this->pregReps($this->input->cookie('job_company1',TRUE)),
                'pjobhistory_bidang'        => $this->pregReps($this->input->cookie('job_part1',TRUE)),
                'pjobhistory_jabatan_awal'  => $this->pregReps($this->input->cookie('job_billet_first1',TRUE)),
                'pjobhistory_jabatan_akhir' => $this->pregReps($this->input->cookie('job_billet_last1',TRUE)),
                'pjobhistory_gaji_akhir'    => $this->pregRepn($this->input->cookie('job_salary1',TRUE)),
                'pjobhistory_reason'        => $this->pregReps($this->input->cookie('job_reason1',TRUE)),
                'pjobhistory_lama'          => $gery1->format('%y Tahun %m Bulan'),
                'pjobhistory_thn_start'     => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('job_from1',TRUE)))),
                'pjobhistory_thn_end'       => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('job_until1',TRUE)))),
                'pjobhistory_reg_date'      => date("Y-m-d H:i:s"),
                'pjobhistory_status'        => 1
            );

            if (!empty($this->input->cookie('job_company1',TRUE))){
                $insertJobHis1 = $this->mod_karir_daftar->insert_all('people_job_history', $dataPengalaman1);
                if ($insertJobHis1 == false) {
                    echo "Error";
                    exit();
                }
            }

            $ge2   = new DateTime($this->input->cookie('job_from2',TRUE));
            $ry2   = new DateTime($this->input->cookie('job_until2',TRUE));
            $gery2 = $ge2->diff($ry2);

            $dataPengalaman2 = array(
                'people_id'                 => $people_id,
                'pjobhistory_company'       => $this->pregReps($this->input->cookie('job_company2',TRUE)),
                'pjobhistory_bidang'        => $this->pregReps($this->input->cookie('job_part2',TRUE)),
                'pjobhistory_jabatan_awal'  => $this->pregReps($this->input->cookie('job_billet_first2',TRUE)),
                'pjobhistory_jabatan_akhir' => $this->pregReps($this->input->cookie('job_billet_last2',TRUE)),
                'pjobhistory_gaji_akhir'    => $this->pregRepn($this->input->cookie('job_salary2',TRUE)),
                'pjobhistory_reason'        => $this->pregReps($this->input->cookie('job_reason2',TRUE)),
                'pjobhistory_lama'          => $gery2->format('%y Tahun %m Bulan'),
                'pjobhistory_thn_start'     => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('job_from2',TRUE)))),
                'pjobhistory_thn_end'       => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('job_until2',TRUE)))),
                'pjobhistory_reg_date'      => date("Y-m-d H:i:s"),
                'pjobhistory_status'        => 1
            );

            if (!empty($this->input->cookie('job_company2',TRUE))){
                $insertJobHis2 = $this->mod_karir_daftar->insert_all('people_job_history',$dataPengalaman2);
                if ($insertJobHis2 == false) {
                    echo "Error";
                    exit();
                }
            }

            $ge3   = new DateTime($this->input->cookie('job_from3',TRUE));
            $ry3   = new DateTime($this->input->cookie('job_until3',TRUE));
            $gery3 = $ge3->diff($ry3);

            $dataPengalaman3 = array(
                'people_id'                 => $people_id,
                'pjobhistory_company'       => $this->pregReps($this->input->cookie('job_company3',TRUE)),
                'pjobhistory_bidang'        => $this->pregReps($this->input->cookie('job_part3',TRUE)),
                'pjobhistory_jabatan_awal'  => $this->pregReps($this->input->cookie('job_billet_first3',TRUE)),
                'pjobhistory_jabatan_akhir' => $this->pregReps($this->input->cookie('job_billet_last3',TRUE)),
                'pjobhistory_gaji_akhir'    => $this->pregRepn($this->input->cookie('job_salary3',TRUE)),
                'pjobhistory_reason'        => $this->pregReps($this->input->cookie('job_reason3',TRUE)),
                'pjobhistory_lama'          => $gery3->format('%y Tahun %m Bulan'),
                'pjobhistory_thn_start'     => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('job_from3',TRUE)))),
                'pjobhistory_thn_end'       => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('job_until3',TRUE)))),
                'pjobhistory_reg_date'      => date("Y-m-d H:i:s"),
                'pjobhistory_status'        => 1
            );

            if (!empty($this->input->cookie('job_company3',TRUE))){
                $insertJobHis3 = $this->mod_karir_daftar->insert_all('people_job_history',$dataPengalaman3);
                if ($insertJobHis3 == false) {
                    echo "Error";
                    exit();
                }
            }

            $ge4   = new DateTime($this->input->cookie('job_from4',TRUE));
            $ry4   = new DateTime($this->input->cookie('job_until4',TRUE));
            $gery4 = $ge4->diff($ry4);

            $dataPengalaman4 = array(
                'people_id'                 => $people_id,
                'pjobhistory_company'       => $this->pregReps($this->input->cookie('job_company4',TRUE)),
                'pjobhistory_bidang'        => $this->pregReps($this->input->cookie('job_part4',TRUE)),
                'pjobhistory_jabatan_awal'  => $this->pregReps($this->input->cookie('job_billet_first4',TRUE)),
                'pjobhistory_jabatan_akhir' => $this->pregReps($this->input->cookie('job_billet_last4',TRUE)),
                'pjobhistory_gaji_akhir'    => $this->pregReps($this->input->cookie('job_salary4',TRUE)),
                'pjobhistory_reason'        => $this->pregReps($this->input->cookie('job_reason4',TRUE)),
                'pjobhistory_lama'          => $gery4->format('%y Tahun %m Bulan'),
                'pjobhistory_thn_start'     => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('job_from4',TRUE)))),
                'pjobhistory_thn_end'       => $this->pregRepn(date("Y-m-d", strtotime($this->input->cookie('job_until4',TRUE)))),
                'pjobhistory_reg_date'      => date("Y-m-d H:i:s"),
                'pjobhistory_status'        => 1
            );

            if (!empty($this->input->cookie('job_company4',TRUE))){
                $insertJobHis4 = $this->mod_karir_daftar->insert_all('people_job_history',$dataPengalaman4);
                if ($insertJobHis4 == false) {
                    echo "Error";
                    exit();
                }
            }

            //PERTANYAAN
            $no = 0;
            $recquest_id = $this->mod_karir_daftar->getQuestionRec();
            $jawabanTmp  = ($this->input->cookie('question_placement',TRUE) == 1) ? "Bersedia" : "Tidak Bersedia";
            $jawabanShft = ($this->input->cookie('question_shift',TRUE) == 1) ? "Bersedia" : "Tidak Bersedia";
            $insertAllQuestion = array();

            for ($i = 0; $i < count($recquest_id); $i++) {

                $no++;
                $dataPertanyaan = array(
                    'people_id'       => $people_id,
                    'recquest_id'     => $this->input->cookie('recquest_id'.$i.'',TRUE),
                    'answer_reg_date' => date("Y-m-d H:i:s")
                );

                if ($no == 3) {
                    $dataPertanyaan['answer'] = $this->pregRepn($this->input->cookie('question_salary',TRUE));
                } elseif ($no == 6) {
                    $dataPertanyaan['answer'] = $this->pregReps($jawabanTmp);
                } elseif ($no == 7) {
                    $dataPertanyaan['answer'] = $this->pregReps($jawabanShft);
                } elseif ($no == 9) {
                    $dataPertanyaan['answer'] = $this->pregReps($this->input->cookie('question_ref',TRUE));
                } elseif ($no == 10) {
                    $dataPertanyaan['answer'] = $this->pregReps($this->input->cookie('question_refgency',TRUE));
                } else {
                    $dataPertanyaan['answer'] = $this->pregReps($this->input->cookie("question_reg$no",TRUE));
                }

                $insertAllQuestion[] = $dataPertanyaan;
            }
            $insertPertanyaan = $this->mod_karir_daftar->insert_question('people_answer', $insertAllQuestion);

            //PARAMETER (FRESHGRADE & PJV)
            $edudatepass = $this->input->cookie('edu_datepass',TRUE);
            $tahun_lulus = date("Y-m-d", strtotime($edudatepass));

            if((strtotime($tahun_lulus)) > (strtotime("-1 years"))){
                $dataParameter = array(
                    'people_id' => $people_id, 'freshgraduate'=> 1, 'completed_data_reg' => 1, 'completed_sertifikat' => 0, 'completed_photo' => 0, 'completed_skill' => 0, 'completed_berkas' => 0, 'completed_pasangan' => 0, 'completed_anak' => 0, 'completed_answer' => 0, 'completed_berkas_kk' => 0, 'completed_berkas_ijazah' => 0
                );
                $insertParameter = $this->mod_karir_daftar->insert_all('mparameter',$dataParameter);

                if ($insertParameter == false) {
                    echo "Error";
                    exit();
                }

                $dataPJV = array('people_id' => $people_id, 'lowongan_id' => 0, 'data' => 1, 'interview_kspm' => 1, 'interview_teknis' => 0, 'interview_hrd' => 0, 'tes_teori' => 0, 'tes_praktek' => 0, 'mcu' => 0, 'agreement' => 0
                 );
                $insertPJV = $this->mod_karir_daftar->insert_all('parameter_job_vacancy',$dataPJV);
                if ($insertPJV == false) {
                    echo "Error";
                    exit();
                } else { echo "Success"; }

            } else {
                $dataParameter = array(
                    'people_id' => $people_id, 'freshgraduate' => 0, 'completed_data_reg' => 1, 'completed_sertifikat' => 0, 'completed_photo' => 0, 'completed_skill' => 0, 'completed_berkas' => 0, 'completed_pasangan' => 0, 'completed_anak' => 0, 'completed_answer' => 0, 'completed_berkas_kk' => 0, 'completed_berkas_ijazah' => 0
                 );
                $insertParameter = $this->mod_karir_daftar->insert_all('mparameter',$dataParameter);
                if ($insertParameter == false) {
                    echo "Error";
                    exit();
                } else { echo "Success"; }
            }
        }

    }
?>