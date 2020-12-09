<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmpelamarall extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('https://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/pelamar/manual/mod_hr_mpelamar_all','hrDept/mod_hr_dashboard', 'mod_master']);
            $this->date_only_def = date("Y-m-d");
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function dateEast($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        private static function dateWest($date){
            $date = str_replace("/", "-", $date);
            return $result = date("Y-m-d", strtotime($date));
        }

        private static function dateDiff($date1, $date2){
            $date1_ts = strtotime($date1);
            $date2_ts = strtotime($date2);
            $diff     = $date2_ts - $date1_ts;
            return round($diff / 86400 + 1);
        }

        public function table_mpelamar_all(){
            $pelamar_all = $this->mod_hr_mpelamar_all->get_datatables();
            $data        = array();
            $no          = $this->pregRepn($this->input->post('start'));
            
            foreach ($pelamar_all as $field) {
                $no++;
                $dateborn = $field->people_birth_date;    
                $date     = new DateTime($dateborn);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Tahun");

                $practice_date = $this->dateWest($field->praktek_date);
                $last_date = date("Y-m-d", strtotime("+ 6 month", strtotime($field->praktek_date)));

                
                if ($field->conclusion == 3) {
                    $status_tes = "Belum Interview";
                } elseif ($field->conclusion == 0) {
                    $status_tes = "TL";
                } elseif ($field->conclusion == 2) {
                    $status_tes = "Input Belum Selesai";
                } else {
                    $status_tes = "LULUS";
                }

                if ($field->score_practice1 == null ) {
                    $score_practice_average = "-";
                } else {
                    $score_practice_average = (floatval($field->score_practice1) + floatval($field->score_practice2) + floatval($field->score_practice3) + floatval($field->score_practice4) + floatval($field->score_practice5)) / 5;
                }

                if ( $this->session->userdata('level_id') == 6 || $this->session->userdata('users_id') == 550 || $this->session->userdata('users_id') == 3 || $this->session->userdata('users_id') == 25 || $this->session->userdata('users_id') == 571) {
                    $btn_hidden = "";
                } else {
                    $btn_hidden = "hidden";
                }

                if ($field->interview_status !== 0) {
                    $btn_interview_again = "hidden"; 
                } else {
                    $btn_interview_again = "";
                }

                // if ($field->trainer_nik == null) {
                //     $btn_interview = "hidden"; 
                // } else {
                //     $btn_interview = "";
                // }

                if ($field->interview_status !== 0 && $field->conclusion !== 0) {
                    $btn_interview_new = '
                    <a href="#" class="btn btn-black btn-xs " data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-interview" data-id="'.$field->people_id.'" data-name="'.$field->people_fullname.'" data-noreg="'.$field->people_noreg.'" data-jabatan="'.$field->KodeJB.'" data-site="'.$field->interview_site.'" data-inhrd="'.$field->interview_date.'" data-inteori="'.$field->teori_date.'" data-inpraktek="'.$field->praktek_date.'" >
                        <i class="entypo-mic" style="font-size:7px;" ></i>  
                    </a>';
                } else {
                    $btn_interview_new = "";
                }

                $row                = array();
                $row['no']          = $no;
                $row['id']          = $field->people_id;
                $row['fullname']    = $field->people_fullname;
                $row['noreg']       = $field->people_noreg;
                $row['edu']         = $field->edutype_name;
                $row['age']         = $usia;
                $row['jabatan']     = $field->jabatan;
                $row['tgl_melamar'] = $this->dateEast($field->tgl_melamar);
                $row['site']        = $field->interview_site;
                $row['action']      = 
                    '<a href="#" class="btn btn-blue btn-xs '.$btn_interview_again.' " onclick="activatedPelamar('.$field->people_id.');" data-id="'.$field->people_id.'" data-name="'.$field->people_fullname.'" data-noreg="'.$field->people_noreg.'">
                        <i class="entypo-dot-2" style="font-size:7px;" ></i>
                    </a>
                    '.$btn_interview_new.'
                    <a href="#" class="btn btn-danger btn-xs '.$btn_hidden.' " onclick="removePelamar('.$field->people_id.');" >
                        <i class="fa fa-times"></i>
                    </a>';


                
                $row['interview_date'] = ($field->interview_date == null || date("Y", strtotime($field->interview_date)) == 1970 ) ? '-' : $this->dateEast($field->interview_date);
                $row['hrd_name']       = ($field->hrd_nik == null) ? '-' : $field->hrd_nik ;
                
                $row['teori_date']     = ($field->teori_date == null || date("Y", strtotime($field->teori_date)) == 1970 ) ? '-' : $this->dateEast($field->teori_date);
                $row['teori_name']     = ($field->teori_nik == null) ? '-' : $field->teori_nik ;
                $row['score_teori']    = ($field->score_teori == null) ? '-' : $field->score_teori;

                $row['praktek_date']           = ($field->praktek_date == null || date("Y", strtotime($field->praktek_date)) == 1970 ) ? '-' : $this->dateEast($field->praktek_date);
                $row['trainer_name']           = ($field->trainer_nik == null) ? '-' : $field->trainer_nik;
                $row['score_practice1']        = ($field->score_practice1 == null) ? '-' : $field->score_practice1;
                $row['score_practice2']        = ($field->score_practice2 == null) ? '-' : $field->score_practice2;
                $row['score_practice3']        = ($field->score_practice3 == null) ? '-' : $field->score_practice3;
                $row['score_practice4']        = ($field->score_practice4 == null) ? '-' : $field->score_practice4;
                $row['score_practice5']        = ($field->score_practice5 == null) ? '-' : $field->score_practice5;
                $row['score_practice_average'] = $score_practice_average;
                $row['conclusion']             = $status_tes;
                $row['conclusion_ref']         = $field->conclusion;
                $row['conclusion_ket']         = ($field->conclusion_ket == null) ? '-' : $field->conclusion_ket;
                $row['reference']              = ($field->reference == null) ? '-' : $field->reference;
                $row['last_date']              = ($field->praktek_date == null) ? '-' : $this->dateEast($last_date);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_hr_mpelamar_all->count_all(),
                "recordsFiltered" => $this->mod_hr_mpelamar_all->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function pelamar_all(){
            $data = array(
                'sheader'       => 'pages/ext/sheader',
                'sfooter'       => 'pages/ext/sfooter',
                'city'          => $this->mod_master->city(),
                'education'     => $this->mod_master->education(),
                'list_karyawan' => $this->mod_master->list_karyawan_perJB(),
                'list_trainer' => $this->mod_master->list_trainer_perJB(),
                'list_jabatan'  => $this->mod_master->list_jabatan(),
                'site'          => $this->mod_master->site(),
                'totalPelamar' => 1,
            );
            $this->load->view('pages/hr/pelamar/manual/pelamar_all', $data);
        }

        public function check_noktp(){
            $noktp = $this->pregRepn($this->input->post('noktp'));
            $query  = $this->mod_hr_mpelamar_all->check_duplicate_pelamar($noktp);  
            if($query == true) {
                echo "true";
            } else {             
                echo "false"; 
            }
        }

        public function addpelamarmanual(){
            $noktp = $this->pregRepn($this->input->post('idktp'));
            $checkDuplicate = $this->mod_hr_mpelamar_all->check_duplicate_pelamar($noktp);
            if ($checkDuplicate !== false) {
                echo "Duplicate";
                exit();
            }

            $dataPelamar = array(
                'people_noreg'          => $this->mod_hr_mpelamar_all->getRecruitmentID(),
                'people_fullname'       => $this->pregReps($this->input->post('fullname')),
                'people_birth_place'    => $this->pregReps($this->input->post('birthplace')),
                'people_birth_date'     => $this->dateWest($this->input->post('birthdate')),
                'people_gender'         => $this->pregReps($this->input->post('gender')),
                'people_mobile'         => $this->pregRepn($this->input->post('mobilephone')),
                'tgl_melamar'           => $this->dateWest($this->input->post('submissiondate')),
                'people_education'      => $this->pregRepn($this->input->post('jenjang')),
                'people_education_name' => $this->pregReps($this->input->post('eduname')),
                'reg_date'              => date("Y-m-d H:i:s"),
                'people_status'         => 1,
                'people_blacklist'      => $this->pregRepn($this->input->post('blacklist'))
            );
            $people_id = $this->mod_hr_mpelamar_all->insert_into_people('people_manual', $dataPelamar);
            if ($people_id == false) {
                echo "Error";
                exit();
            }

            $dataAddress = array(
                'people_id' => $people_id,
                'address'   => $this->pregReps($this->input->post('street')),
                'city'      => $this->pregReps($this->input->post('addressplace')),
                'zip_code'  => $this->pregRepn($this->input->post('zip')),
                'reg_date'  => date("Y-m-d H:i:s"),
            );
            $save_address = $this->mod_hr_mpelamar_all->insert_all('people_address_manual', $dataAddress);
            if ($save_address == false) {
                echo "Error";
                exit();
            }

            $dataKTP = array(
                'people_id'      => $people_id,
                'lisence_type'   => 'KTP',
                'lisence_number' => $this->pregRepn($this->input->post('idktp')),
                'lisence_status' => 1,
                'reg_date'       => date("Y-m-d H:i:s"),
            );
            $save_ktp = $this->mod_hr_mpelamar_all->insert_all('people_lisence_manual', $dataKTP);
            if ($save_ktp == false) {
                echo "Error";
                exit();
            }

            if ( $this->pregRepn($this->input->post('simB1')) == 1 ) {
                $dataSIMB1 = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM B1',
                    'lisence_number' => $this->pregRepn($this->input->post('nosimB1')),
                    'lisence_period' => $this->dateWest($this->input->post('periodsimB1')),
                    'lisence_status' => 1,
                    'reg_date'       => date("Y-m-d H:i:s"),
                );
                $saveB1 = $this->mod_hr_mpelamar_all->insert_all('people_lisence_manual', $dataSIMB1);
                if ($saveB1 == false) {
                    echo "Error";
                    exit();
                }
            } 

            if ( $this->pregRepn($this->input->post('simB2')) == 2 ) {
                $dataSIMB2 = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM B2',
                    'lisence_number' => $this->pregRepn($this->input->post('nosimB2')),
                    'lisence_period' => $this->dateWest($this->input->post('periodsimB2')),
                    'lisence_status' => 1,
                    'reg_date'       => date("Y-m-d H:i:s"),
                );
                $saveB2 = $this->mod_hr_mpelamar_all->insert_all('people_lisence_manual', $dataSIMB2);
                if ($saveB2 == false) {
                    echo "Error";
                    exit();
                }
            }

            if ( $this->pregRepn($this->input->post('simB1u')) == 3 ) {
                $dataSIMB1U = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM B1 UMUM',
                    'lisence_number' => $this->pregRepn($this->input->post('nosimB1u')),
                    'lisence_period' => $this->dateWest($this->input->post('periodsimB1u')),
                    'lisence_status' => 1,
                    'reg_date'       => date("Y-m-d H:i:s"),
                );
                $saveB1U = $this->mod_hr_mpelamar_all->insert_all('people_lisence_manual', $dataSIMB1U);
                if ($saveB1U == false) {
                    echo "Error";
                    exit();
                }
            }

            if ( $this->pregRepn($this->input->post('simB2u')) == 4 ) {
                $dataSIMB2U = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM B2 UMUM',
                    'lisence_number' => $this->pregRepn($this->input->post('nosimB2u')),
                    'lisence_period' => $this->dateWest($this->input->post('periodsimB2u')),
                    'lisence_status' => 1,
                    'reg_date'       => date("Y-m-d H:i:s"),
                );
                $saveB2U = $this->mod_hr_mpelamar_all->insert_all('people_lisence_manual', $dataSIMB1U);
                if ($saveB2U == false) {
                    echo "Error";
                    exit();
                }
            }

            if ( $this->pregRepn($this->input->post('simA')) == 5 ) {
                $dataSIMA = array(
                    'people_id'      => $people_id,
                    'lisence_type'   => 'SIM A',
                    'lisence_number' => $this->pregRepn($this->input->post('nosimA')),
                    'lisence_period' => $this->dateWest($this->input->post('periodsimA')),
                    'lisence_status' => 1,
                    'reg_date'       => date("Y-m-d H:i:s"),
                );
                $saveA = $this->mod_hr_mpelamar_all->insert_all('people_lisence_manual', $dataSIMA);
                if ($saveA == false) {
                    echo "Error";
                    exit();
                }
            } 

            $totalData  = $this->input->post('company_name');
            $insertData = array();

            $res = array_filter($totalData, function($value) {
                return ($value !== null && $value !== false && $value !== ''); 
            });

            for ($i = 0; $i < count($res); $i++) {
                $dataExp = array(
                    'people_id'    => $people_id,
                    'company_name' => $this->input->post('company_name')[$i],
                    'position'     => $this->input->post('position')[$i],
                    'start_date'   => date("Y-m-d", strtotime($this->input->post('start_date')[$i])),
                    'end_date'     => date("Y-m-d", strtotime($this->input->post('end_date')[$i])),
                    'exp_status'   => 1,
                    'reg_date'     => date("Y-m-d")
                );
                $insertData[] = $dataExp;
            }
            $saveExp = $this->mod_hr_mpelamar_all->insert_batch('people_exp_manual', $insertData);
            if ($saveExp == false) {
                echo "Error";
                exit();
            }

            $totalDataSkill  = $this->input->post('skillname');
            $insertDataSkill = array();

            $skill = array_filter($totalDataSkill, function($value) {
                return ($value !== null && $value !== false && $value !== ''); 
            });

            for ($i = 0; $i < count($skill); $i++) {
                $dataSkill = array(
                    'people_id'    => $people_id,
                    'skill_name'   => $this->pregReps($this->input->post('skillname'))[$i],
                    'skill_unit'   => $this->pregReps($this->input->post('skillunit'))[$i],
                    'skill_status' => 1,
                    'reg_date'     => date("Y-m-d")
                );
                $insertDataSkill[] = $dataSkill;
            }
            $saveSkill = $this->mod_hr_mpelamar_all->insert_batch('people_skill_manual', $insertDataSkill);
            if ($saveSkill == false) {
                echo "Error";
                exit();
            }

            if ($this->pregRepn($this->input->post('blacklist')) == 1) {
                echo "BL";
                exit();
            } else {
                $dataInterview = array(
                    'people_id'        => $people_id,
                    'interview_status' => 1,
                    'interview_date'   => null,
                    'praktek_date'     => null,
                    'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                    'conclusion'       => 3,
                    'conclusion_ket'   => "Belum Interview",
                );
                $saveInv = $this->mod_hr_mpelamar_all->insert_all('interview_manual', $dataInterview);
                if ($saveInv == false) {
                    echo "Error";
                    exit();
                } else {
                    echo "Success";
                    exit();
                }
            }
        }

        public function destroy_pelamar(){
            $people_id = $this->pregRepn($this->input->post('people_id'));
            $data = array( 'people_status' => 0, 'update_date' => date("Y-m-d") );
            $delete_pelamar = $this->mod_hr_mpelamar_all->delete_pelamar($people_id, $data);
            if ($delete_pelamar == true) {
                $data_logs = array(
                    'logs_tanggal'    => date("Y-m-d"),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => "PELAMAR MANUAL",
                    'logs_aktifitas'  => "HAPUS",
                    'logs_keterangan' => "Menghapus data melamar dengan ID ".$people_id." ",
                    'logs_user_id'    => $this->session->userdata('users_id'),
                    'logs_username'   => $this->session->userdata('username'),
                    'logs_user_name'  => $this->session->userdata('fullname'),
                    'logs_website'    => $this->session->userdata('tipeapp'),
                );
                $insert_logs = $this->mod_hr_mpelamar_all->insert_all('WEB_1.dbo.web_logs', $data_logs);
                echo json_encode($delete_pelamar);
            }
        }

        public function activated_pelamar(){
            $people_id = $this->pregRepn($this->input->post('people_id'));
            $getPelamardata = $this->mod_hr_mpelamar_all->get_last_interview_data($people_id);
            if ($getPelamardata == false) {
                echo "Error";
                exit();
            }

            $last_date = date("Y-m-d", strtotime("+ 6 month", strtotime($getPelamardata->praktek_date)));
            $param_date_activated = strtotime($last_date);
            $date_now = strtotime(date("Y-m-d"));

            // if ($date_now < $param_date_activated) {
            //     echo "Error Activated";
            //     exit();
            // }

            $data = array( 
                'people_id'        => $getPelamardata->people_id,
                'trainer_nik'      => $getPelamardata->trainer_nik,
                'interview_date'   => $getPelamardata->interview_date,
                'praktek_date'     => $getPelamardata->praktek_date,
                'KodeJB'           => $getPelamardata->KodeJB,
                'interview_site'   => $getPelamardata->interview_site,
                'score_teori'      => $getPelamardata->score_teori,
                'score_practice1'  => $getPelamardata->score_practice1,
                'score_practice2'  => $getPelamardata->score_practice2,
                'score_practice3'  => $getPelamardata->score_practice3,
                'score_practice4'  => $getPelamardata->score_practice4,
                'score_practice5'  => $getPelamardata->score_practice5,
                'conclusion'       => $getPelamardata->conclusion,
                'conclusion_ket'   => $getPelamardata->conclusion_ket,
                'reference'        => $getPelamardata->reference,
                'interview_status' => $getPelamardata->interview_status,
                'tgl_melamar'      => $getPelamardata->tgl_melamar,
                'reg_date'         => date("Y-m-d"),
            );
            $activated_pelamar = $this->mod_hr_mpelamar_all->insert_all('interview_manual_history', $data);
            if ($activated_pelamar == true) {
                $data_clear = array(
                    'trainer_nik'      => null,
                    'interview_date'   => null,
                    'praktek_date'     => null,
                    'KodeJB'           => "PRD020",
                    'interview_site'   => null,
                    'score_teori'      => null,
                    'score_practice1'  => null,
                    'score_practice2'  => null,
                    'score_practice3'  => null,
                    'score_practice4'  => null,
                    'score_practice5'  => null,
                    'conclusion'       => 3,
                    'conclusion_ket'   => "Belum Interview",
                    'reference'        => null,
                    'interview_status' => 1,
                    'reg_date'         => null,
                );
                $update_data = $this->mod_hr_mpelamar_all->edit_interview($people_id, $data_clear);
                if ($update_data == true) {
                    $data_logs = array(
                        'logs_tanggal'    => date("Y-m-d"),
                        'logs_ip'         => $this->input->ip_address(),
                        'logs_modul'      => "PELAMAR MANUAL",
                        'logs_aktifitas'  => "AKTIVASI PELAMAR",
                        'logs_keterangan' => "mengaktifkan kembali interview untuk ID Pelamar = ".$people_id." ",
                        'logs_user_id'    => $this->session->userdata('users_id'),
                        'logs_username'   => $this->session->userdata('username'),
                        'logs_user_name'  => $this->session->userdata('fullname'),
                        'logs_website'    => $this->session->userdata('tipeapp'),
                    );
                    $insert_logs = $this->mod_hr_mpelamar_all->insert_all('WEB_1.dbo.web_logs', $data_logs);
                } else {
                    echo "Error clear data interview";
                    exit();
                }
                echo json_encode($activated_pelamar);
            } else {
                echo "Error moving history data interview";
                exit();
            }
        }

        public function edit_score_teori(){
            $people_id = $this->pregRepn($this->input->post('people_id'));
            $data = array( 
                'score_teori'    => $this->pregReps($this->input->post('score_teori_edit')),
                'interview_date' => $this->dateWest($this->input->post('interview_date')),
            );
            $edit_score_teori = $this->mod_hr_mpelamar_all->edit_interview($people_id, $data);
            if ($edit_score_teori == true) {
                $data_logs = array(
                    'logs_tanggal'    => date("Y-m-d"),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => "PELAMAR MANUAL",
                    'logs_aktifitas'  => "UBAH DATA",
                    'logs_keterangan' => "Mengubah data nilai tes teori untuk ID Pelamar = ".$people_id." ",
                    'logs_user_id'    => $this->session->userdata('users_id'),
                    'logs_username'   => $this->session->userdata('username'),
                    'logs_user_name'  => $this->session->userdata('fullname'),
                    'logs_website'    => $this->session->userdata('tipeapp'),
                );
                $insert_logs = $this->mod_hr_mpelamar_all->insert_all('WEB_1.dbo.web_logs', $data_logs);
                echo "Success";
            } else {
                echo "Error";
                exit();
            }
        }

        public function edit_score_praktek(){
            $people_id = $this->pregRepn($this->input->post('people_id'));
            $data = array( 
                'score_practice1' => floatval($this->input->post('score_practice1_edit')),
                'score_practice2' => floatval($this->input->post('score_practice2_edit')),
                'score_practice3' => floatval($this->input->post('score_practice3_edit')),
                'score_practice4' => floatval($this->input->post('score_practice4_edit')),
                'score_practice5' => floatval($this->input->post('score_practice5_edit')),
                'conclusion'      => $this->pregRepn($this->input->post('statusinterview_edit')),
                'conclusion_ket'  => $this->pregReps($this->input->post('conclusion_ket_edit')),
                'reference'       => $this->pregReps($this->input->post('reference_edit')),
            );
            $edit_score_praktek = $this->mod_hr_mpelamar_all->edit_interview($people_id, $data);
            if ($edit_score_praktek == true) {
                $data_logs = array(
                    'logs_tanggal'    => date("Y-m-d"),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => "PELAMAR MANUAL",
                    'logs_aktifitas'  => "UBAH DATA",
                    'logs_keterangan' => "Mengubah data nilai dan keterangan tes praktek untuk ID Pelamar = ".$people_id." ",
                    'logs_user_id'    => $this->session->userdata('users_id'),
                    'logs_username'   => $this->session->userdata('username'),
                    'logs_user_name'  => $this->session->userdata('fullname'),
                    'logs_website'    => $this->session->userdata('tipeapp'),
                );
                $insert_logs = $this->mod_hr_mpelamar_all->insert_all('WEB_1.dbo.web_logs', $data_logs);
                echo "Success";
            } else {
                echo "Error";
                exit();
            }
        }

        public function save_interview(){
            $people_id = $this->pregRepn($this->input->post('people_id'));
            $jenis_tes = $this->input->post('jenis_tes');
            if ( in_array("1", $jenis_tes) ) {
                if ($this->pregRepn($this->input->post('statusinterview')) == 1 ) {
                    $dataInterview = array(
                        'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                        'interview_site'   => $this->pregReps($this->input->post('interviewsite')),
                        'conclusion'       => $this->pregRepn($this->input->post('statusinterview')),
                        'conclusion_ket'   => $this->pregReps($this->input->post('conclusion_ket')),
                        'interview_status' => 1,
                    );
                    $saveInv = $this->mod_hr_mpelamar_all->edit_interview($people_id, $dataInterview);
                } else {
                    $dataInterview = array(
                        'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                        'interview_site'   => $this->pregReps($this->input->post('interviewsite')),
                        'conclusion'       => $this->pregRepn($this->input->post('statusinterview')),
                        'conclusion_ket'   => $this->pregReps($this->input->post('conclusion_ket')),
                        'interview_status' => 0,
                    );
                    $saveInv = $this->mod_hr_mpelamar_all->edit_interview($people_id, $dataInterview);
                }
                echo "Success";
            } else if ( in_array("2", $jenis_tes) ) {
                if ($this->pregRepn($this->input->post('statusinterview')) == 1 ) {
                    $dataInterview = array(
                        'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                        'interview_site'   => $this->pregReps($this->input->post('interviewsite')),
                        'interview_date'   => $this->dateWest($this->input->post('interviewdate_hrd')),
                        'hrd_nik'          => $this->pregReps($this->input->post('hrd_nik')),
                        'conclusion'       => $this->pregRepn($this->input->post('statusinterview')),
                        'conclusion_ket'   => $this->pregReps($this->input->post('conclusion_ket')),
                        'interview_status' => 1,
                    );
                    $saveInv = $this->mod_hr_mpelamar_all->edit_interview($people_id, $dataInterview);
                } else {
                    $dataInterview = array(
                        'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                        'interview_site'   => $this->pregReps($this->input->post('interviewsite')),
                        'interview_date'   => $this->dateWest($this->input->post('interviewdate_hrd')),
                        'hrd_nik'          => $this->pregReps($this->input->post('hrd_nik')),
                        'conclusion'       => $this->pregRepn($this->input->post('statusinterview')),
                        'conclusion_ket'   => $this->pregReps($this->input->post('conclusion_ket')),
                        'interview_status' => 0,
                    );
                    $saveInv = $this->mod_hr_mpelamar_all->edit_interview($people_id, $dataInterview);
                }
            } else if ( in_array("3", $jenis_tes) ) {
                if ($this->pregRepn($this->input->post('statusinterview')) == 1 ) {
                    $dataInterview = array(
                        'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                        'interview_site'   => $this->pregReps($this->input->post('interviewsite')),
                        'teori_date'       => $this->dateWest($this->input->post('interviewdate_teori')),
                        'teori_nik'        => $this->pregReps($this->input->post('teori_nik')),
                        'score_teori'      => $this->pregReps($this->input->post('score_teori')),
                        'conclusion'       => $this->pregRepn($this->input->post('statusinterview')),
                        'conclusion_ket'   => $this->pregReps($this->input->post('conclusion_ket')),
                        'interview_status' => 1,
                    );
                    $saveInv = $this->mod_hr_mpelamar_all->edit_interview($people_id, $dataInterview);
                } else {
                    $dataInterview = array(
                        'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                        'interview_site'   => $this->pregReps($this->input->post('interviewsite')),
                        'teori_date'       => $this->dateWest($this->input->post('interviewdate_teori')),
                        'teori_nik'        => $this->pregReps($this->input->post('teori_nik')),
                        'score_teori'      => $this->pregReps($this->input->post('score_teori')),
                        'conclusion'       => $this->pregRepn($this->input->post('statusinterview')),
                        'conclusion_ket'   => $this->pregReps($this->input->post('conclusion_ket')),
                        'interview_status' => 0,
                    );
                    $saveInv = $this->mod_hr_mpelamar_all->edit_interview($people_id, $dataInterview);
                }
            } else if ( in_array("4", $jenis_tes) ) {
                if ($this->pregRepn($this->input->post('statusinterview')) == 1 ) {
                    $dataInterview = array(
                        'KodeJB'          => $this->pregReps($this->input->post('jabatan')),
                        'interview_site'  => $this->pregReps($this->input->post('interviewsite')),
                        'praktek_date'    => $this->dateWest($this->input->post('interviewdate_praktek')),
                        'trainer_nik'     => $this->pregReps($this->input->post('trainer_nik')),
                        'score_practice1' => $this->pregReps($this->input->post('score_practice1')),
                        'score_practice2' => $this->pregReps($this->input->post('score_practice2')),
                        'score_practice3' => $this->pregReps($this->input->post('score_practice3')),
                        'score_practice4' => $this->pregReps($this->input->post('score_practice4')),
                        'score_practice5' => $this->pregReps($this->input->post('score_practice5')),
                        'conclusion'      => $this->pregRepn($this->input->post('statusinterview')),
                        'conclusion_ket'  => $this->pregReps($this->input->post('conclusion_ket')),
                        'interview_status' => 0,
                    );
                    $saveInv = $this->mod_hr_mpelamar_all->edit_interview($people_id, $dataInterview);
                } else {
                    $dataInterview = array(
                        'KodeJB'           => $this->pregReps($this->input->post('jabatan')),
                        'interview_site'   => $this->pregReps($this->input->post('interviewsite')),
                        'praktek_date'     => $this->dateWest($this->input->post('interviewdate_praktek')),
                        'trainer_nik'      => $this->pregReps($this->input->post('trainer_nik')),
                        'score_practice1'  => $this->pregReps($this->input->post('score_practice1')),
                        'score_practice2'  => $this->pregReps($this->input->post('score_practice2')),
                        'score_practice3'  => $this->pregReps($this->input->post('score_practice3')),
                        'score_practice4'  => $this->pregReps($this->input->post('score_practice4')),
                        'score_practice5'  => $this->pregReps($this->input->post('score_practice5')),
                        'conclusion'       => $this->pregRepn($this->input->post('statusinterview')),
                        'conclusion_ket'   => $this->pregReps($this->input->post('conclusion_ket')),
                        'interview_status' => 0,
                    );
                    $saveInv = $this->mod_hr_mpelamar_all->edit_interview($people_id, $dataInterview);
                }
                echo "Success";
            } else {
                echo "ESelection";
                exit();
            }
                
        }
    }
?>