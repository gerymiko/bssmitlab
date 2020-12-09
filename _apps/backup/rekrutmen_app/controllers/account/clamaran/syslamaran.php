<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslamaran extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') !== 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
            }
            $this->load->model(['mlamaran/mod_karir_lamaran', 'mloker/mod_karir_loker', 'mperson/mod_karir_person']);
            $this->output->enable_profiler(false);
        }

        public function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu'    => 'pages/account/grid/vmenu',
                'content' => 'pages/account/lamaran/vlamaran',
                'footer'  => 'pages/account/grid/vfooter'
        	);
        	$this->load->view('pages/account/index', $data);
        }

        public function table_lamaran(){
            $people_id = $this->session->userdata('people_id');
            $lamaran   = $this->mod_karir_lamaran->get_datatables($people_id);
            $data      = array();
            $no        = $this->input->post('start');
           
            foreach ($lamaran as $field) {
                $status_lowongan = $field->lowongan_status;
                if ($status_lowongan == 1) {
                    if ($field->keterangan_gagal == NULL) {
                        $status_lamaran = "Proses Seleksi Berkas";
                    } else {
                        $status_lamaran = $field->keterangan_gagal;
                    }
                } else {
                    if ($field->keterangan_gagal !== NULL) {
                        $status_lamaran = $field->keterangan_gagal;
                    } else {
                        $status_lamaran = "Lowongan telah ditutup";
                    }
                }

                if ($field->keterangan_gagal !== NULL) {
                    $btn_btl = "disabled";
                } else {
                    $btn_btl = "";
                }
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->jabatan_alias;
                $row[]  = date("d-M-Y", strtotime($field->tgl_melamar))." - ".date("g:i:s A", strtotime($field->tgl_melamar));
                $row[]  = $status_lamaran;
                $row[]  = '<button class="btn btn-sm btn-danger" '.$btn_btl.' style="padding-top: 2px;padding-bottom: 2px" onclick="delete_application('.$field->pelamar_id.');">Batalkan</button>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_karir_lamaran->count_all($people_id),
                "recordsFiltered" => $this->mod_karir_lamaran->count_filtered($people_id),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        private function skill_kualifikasi($lowongan_id, $people_id){
            $skill_pelamar  = $this->mod_karir_lamaran->getskill_pelamar($people_id);
            $skill_required = $this->mod_karir_lamaran->getskill_required($lowongan_id);
            
            $validskill   = false;
            $skillnet     = array();

            if ($skill_pelamar != 0) {
                foreach ($skill_pelamar as $row) {
                    if (in_array($row, $skill_required)){
                        $validskill = true;
                        $skillnet[] = $row;
                    }
                }

                if (count($skill_required) == 0) {
                    $resultskill = 1;
                    return $resultskill;
                } else {
                    $resultskill = 0;
                    if($validskill == true && (count($skillnet) >= count($skill_required))){
                        $resultskill = 1;
                    }
                    return $resultskill;
                }
            } else if (count($skill_required == 0)) {
                $resultskill = 1;
                return $resultskill;
            } else {
                $resultskill = 0;
                return $resultskill;
            }
        }

        private function cert_kualifikasi($lowongan_id, $people_id){
            $cert_pelamar  = $this->mod_karir_lamaran->getsertifikat_pelamar($people_id);
            $cert_required = $this->mod_karir_lamaran->getsertifikat_required($lowongan_id);
            
            $validcert   = false;
            $certnet     = array();

            if ($cert_pelamar != 0) {
                foreach ($cert_pelamar as $row){
                    if (in_array($row, $cert_required)){
                        $validcert = true;
                        $certnet[] = $row;
                    }
                }
                if (count($cert_required) == 0){
                    $resultcert = 1;
                    return $resultcert;
                } else {
                    $resultcert = 0;
                    if($validcert == true && (count($certnet) >= count($cert_required))){
                        $resultcert = 1;
                    }
                    return $resultcert;
                }   
            } else if (count($cert_required == 0)) {
                $resultcert = 1;
                return $resultcert;
            } else {
                $resultcert = 0;
                return $resultcert;
            }
        }

        private function edu_kualifikasi($lowongan_id, $people_id){
            $edu_pelamar  = $this->mod_karir_lamaran->geteducation_pelamar($people_id);
            $edu_required = $this->mod_karir_lamaran->geteducation_required($lowongan_id);

            if ($edu_pelamar != 0) {
                $edu_required_val = min($edu_required);
                $edu_pelamar_val  = max($edu_pelamar);

                if ($edu_pelamar_val > $edu_required_val) {
                    $resultedu = 1;
                    return $resultedu;
                } else {
                    $resultedu = 0;
                    return $resultedu;
                }
            }
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9-]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private function firebasenotif($id){        
            define( 'API_ACCESS_KEY', 'AAAAbmLe2qQ:APA91bGX6oGpKFsE-pqOWAtWHi2Bb69MBKI0UEDbI5UlwSkbwqLfZXL0LDRIkD_32fsIH3pAyjMBc9H0PDyni7y5kO_bUEtbgRRrJ-cJtunE_CpPowDq2v5VlHFy_XWfzEKVpqg22oethdmHCfwO-Vf-mW4VPWQQcg' );

            $data = $this->mod_karir_lamaran->notifikasi_pelamar($id);

            if ($data) {
                $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                
                // $msg = array
                // (
                //     'body'     => $data->registrant_kode." Domisili ".$data->domisili,
                //     'title'  => $data->people_firstname." mendaftar ".$data->Nama,
                //     'idcanel' => $id,
                //     'vibrate'   => 1,
                //     'sound'     => 1
                // );

                // $fields = array
                // (
                //     'to'  => '/topics/bssrekrutment',
                //     'notification' => $msg
                // );

                $fields = array(
					'to'   => '/topics/bssrekrutment',
					'data' => array(
						"idpelamar" => $id,
						"body"      => $data->registrant_kode." Domisili ".$data->domisili,
						"title"     => $data->people_firstname." mendaftar ".$data->Nama   
                    )
                );

                $headers = array(
                    'Authorization: key=' . API_ACCESS_KEY,
                    'Content-Type: application/json'
                );

                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
                curl_close( $ch );
            }
        }

        public function apply_job(){

			$people_id   = $this->pregRepn($this->input->post('people_id'));
			$lowongan_id = $this->pregRepn($this->input->post('lowongan_id'));
            $cek_pelamar = $this->mod_karir_lamaran->check_duplicate_pelamar($people_id, $lowongan_id);

            if ($cek_pelamar == true) {
                echo "Duplicate";
            } else {

                // BATAS MELAMAR
                $getTotal_melamar = $this->mod_karir_lamaran->cek_total_melamar($people_id);
                if ($getTotal_melamar == 2) {
                    echo "Limit";
                    exit();
                }

                $getDetail_loker  = $this->mod_karir_loker->detail_lowongan($lowongan_id);
                $getDetail_people = $this->mod_karir_person->detail_personal($people_id);

                // JENIS KELAMIN
                $lokerJK   = str_replace(';', '', $getDetail_loker->jenis_kelamin);
                $pelamarJK = $getDetail_people->people_gender;

                if ($lokerJK !== $pelamarJK && $lokerJK !== "LP") {
                    echo "Gender";
                    exit();
                }

                // USIA
                $lokermin_age = $getDetail_loker->min_usia;
                $lokermax_age = $getDetail_loker->max_usia;
                
                $dateborn     = $getDetail_people->people_birth_date;   
                $date         = new DateTime($dateborn);
                $now          = new DateTime();
                $interval     = $date->diff($now);
                $pelamar_age  = $interval->format("%y");
                if ($pelamar_age < $lokermin_age || $lokermax_age < $pelamar_age) {
                    echo "Age";
                    exit();
                }

                // FOTO
                if ($getDetail_people->people_photo == "default/300.png") {
                    echo "Photo";
                    exit();
                }

                //PARAMETER LOKER
                $param_skill = $this->skill_kualifikasi($lowongan_id, $people_id);
                $param_cert  = $this->cert_kualifikasi($lowongan_id, $people_id);
                $param_edu   = $this->edu_kualifikasi($lowongan_id, $people_id);

                $tahap1 = $this->mod_karir_lamaran->tahap_rekrutmen_1();
                $tahap2 = $this->mod_karir_lamaran->tahap_rekrutmen_2();
                
                $dataLamaran = array(
                    'people_id'       => $people_id,
                    'lowongan_id'     => $lowongan_id,
                    'registrant_kode' => $this->pregReps($this->input->post('registrant_kode')),
                    'tgl_melamar'     => date('Y-m-d H:i:s'),
                    'pelamar_status'  => 1
                );

                // $dataParameter1 = array(
                //     'people_id'      => $people_id,
                //     'lowongan_id'    => $lowongan_id,
                //     'interview_kspm' => 1,
                //     'data'           => 1,
                //     'mcu'            => 0,
                //     'agreement'      => 0
                // );

                $dataParameter2 = array(
                    'people_id'      => $people_id,
                    'lowongan_id'    => $lowongan_id,
                    'interview_kspm' => 1,
                    'data'           => 1,
                    'mcu'            => 0,
                    'agreement'      => 0
                );

                // for ($i = 0; $i < count($tahap1); $i++){
                //     $check_parameter1 = $this->db->from('bridge_jabatan_rstep')
                //                                     ->where("rs_id = '".$tahap1[$i]['rs_id']."' AND KodeJB = '".$getDetail_loker->KodeJB."' AND bridge_j_r_status ='1'")
                //                                     ->get()
                //                                     ->row();
                //     $indexParam1 = str_replace("-", "_", $tahap1[$i]['rs_alias']);
                //     $dataParameter1[$indexParam1] = NULL == $check_parameter1 ? '1' : '2';
                // }

                for ($i = 0; $i < count($tahap2); $i++){
                    $check_parameter2 = $this->db->from('bridge_jabatan_rstep')
                                                    ->where("rs_id = '".$tahap2[$i]['rs_id']."' AND KodeJB = '".$getDetail_loker->KodeJB."' AND bridge_j_r_status ='1'")
                                                    ->get()
                                                    ->row();
                    $indexParam2 = str_replace("-", "_", $tahap2[$i]['rs_alias']);
                    $dataParameter2[$indexParam2] = NULL == $check_parameter2 ? '1' : '2';
                }

                $insertPelamar = $this->mod_karir_lamaran->insert_all('pelamar', $dataLamaran);
                if ($insertPelamar == false) {
                    echo "Error";
                    exit();
                }

                $getParam  = $this->mod_karir_lamaran->getParameter_pelamar($people_id);
                $dataQualified = array(
                    'pelamar_id'             => $insertPelamar,
                    'kualifikasi_dt'         => $getParam->completed_photo,
                    'kualifikasi_skill'      => $getParam->completed_skill,
                    'kualifikasi_sertifikat' => $getParam->completed_sertifikat,
                    'kualifikasi_last_edu'   => $getParam->completed_berkas_ijazah
                );

                $insertQualified = $this->mod_karir_lamaran->insert_qualified($dataQualified);

                // PJV
                $getPjv = $this->mod_karir_lamaran->getParameter_pjv($people_id);

                if ($getParam->freshgraduate == 1 && $getPjv->lowongan_id == 0) {
                	$updatePJV = $this->mod_karir_lamaran->update_pjv_lamaran($people_id, $dataParameter2);
                	if ($updatePJV == true) {
                		$this->firebasenotif($insertPelamar);
                		echo "Success";
                	} else {
                		echo "Error Lamar 1";
                		exit();
                	}
                } else {
                	$insertPJV = $this->mod_karir_lamaran->insert_pjv_lamaran($dataParameter2);
                	if ($insertPJV == true) {
                		$this->firebasenotif($insertPelamar);
                		echo "Success";
                	} else {
                		echo "Error Lamar 2";
                		exit();
                	}
                }
            }
        }

        public function delete_application(){
            $pelamar_id         = $this->pregRepn($this->input->post('pelamar_id'));
            $people_id          = $this->session->userdata('people_id');
            $check_status       = $this->mod_karir_lamaran->check_schedule_pelamar($people_id, $pelamar_id);

            if ($check_status == false) {
                $delete_application = $this->mod_karir_lamaran->delete_application($pelamar_id);
                echo json_encode($delete_application);
            } else {
                echo "Error Proses";
            }
            
        } 

    }
?>