<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmessage extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/web/message/mod_message', 'mglobal/mod_global']);
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.,:]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function viewDate($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

        public function send_sms_kspm(){
            $people_id      = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $pelamar_id     = $this->my_encryption->decode($this->pregReps($this->input->post('pelamar_id')));
            $people_mobile  = $this->my_encryption->decode($this->pregReps($this->input->post('mobile')));
            $interview_date = $this->pregReps($this->input->post('interview_date'));
            $interview_time = $this->pregReps($this->input->post('interview_time'));
            $pic            = $this->pregRepn($this->input->post('pic_kspm'));
            $rs_id          = $this->pregRepn($this->input->post('rs_id'));
            $locationid     = $this->pregRepn($this->input->post('location'));
            $checkSchedule  = $this->mod_message->check_schedule_interview($pelamar_id, $rs_id);
            if ($checkSchedule !== false) {
                echo "Duplicate";
                exit();
            }
            $msgid          = 2;
            $checkpicstatus = $this->mod_message->check_pic_status($pic, $rs_id);
            $getmsg         = $this->mod_message->get_message_content($msgid);
            $getlocation    = $this->mod_global->get_city($locationid);
            $getname        = $this->mod_message->get_people_name($people_id);
            if($people_id !== '' && $pelamar_id !== ''){
                $msgcontent = $getmsg->doc_content;
                $target     = ["--nama--", "--tgl--", "--jam--", "--site--"];
                $replace    = [ucfirst(strtolower($getname->people_firstname)), $interview_date, $interview_time, $getlocation->city_name];
                $content    = str_replace($target, $replace, $msgcontent);
                $dataMessage = array(
                    'pelamar_id'        => $pelamar_id,
                    'people_id'         => $people_id,
                    'rs_id'             => $rs_id,
                    'bridge_p_r_id'     => $checkpicstatus->bridge_p_r_id,
                    'schedule_msg'      => $content,
                    'schedule_location' => $locationid,
                    'schedule_date'     => $this->serverDate($interview_date).' '.date("H:i:s", strtotime($interview_time)),
                    'schedule_status'   => 2,
                );
                $saveSchedule = $this->mod_message->insert_all('schedule', $dataMessage);
                if ($saveSchedule == true) {
                    $konten = array(
                        'NOM' => $people_mobile,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_message->sendsms($konten);
                    if($sendsms == true){
                        echo "Success";
                    } else {
                        echo "Error";
                    }
                }
            } else {
                echo "Error";                
            }
        }

        public function send_sms_teknis(){
            $people_id      = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $pelamar_id     = $this->my_encryption->decode($this->pregReps($this->input->post('pelamar_id')));
            $people_mobile  = $this->my_encryption->decode($this->pregReps($this->input->post('mobile')));
            $interview_date = $this->pregReps($this->input->post('interview_date'));
            $interview_time = $this->pregReps($this->input->post('interview_time'));
            $pic            = $this->pregRepn($this->input->post('pic_teknis'));
            $rs_id          = $this->pregRepn($this->input->post('rs_id'));
            $locationid     = $this->pregRepn($this->input->post('location'));
            $checkSchedule  = $this->mod_message->check_schedule_interview($pelamar_id, $rs_id);
            if ($checkSchedule !== false) {
                echo "Duplicate";
                exit();
            }
            $msgid          = 3;
            $checkpicstatus = $this->mod_message->check_pic_status($pic, $rs_id);
            $getmsg         = $this->mod_message->get_message_content($msgid);
            $getlocation    = $this->mod_global->get_city($locationid);
            $getname        = $this->mod_message->get_people_name($people_id);
            if($people_id !== '' && $pelamar_id !== ''){
                $msgcontent = $getmsg->doc_content;
                $target     = ["--nama--", "--tgl--", "--jam--", "--site--"];
                $replace    = [ucfirst(strtolower($getname->people_firstname)), $interview_date, $interview_time, $getlocation->city_name];
                $content    = str_replace($target, $replace, $msgcontent);
                $dataMessage = array(
                    'pelamar_id'        => $pelamar_id,
                    'people_id'         => $people_id,
                    'rs_id'             => $rs_id,
                    'bridge_p_r_id'     => $checkpicstatus->bridge_p_r_id,
                    'schedule_msg'      => $content,
                    'schedule_location' => $locationid,
                    'schedule_date'     => $this->serverDate($interview_date).' '.date("H:i:s", strtotime($interview_time)),
                    'schedule_status'   => 2,
                );
                $saveSchedule = $this->mod_message->insert_all('schedule', $dataMessage);
                if ($saveSchedule == true) {
                    $konten = array(
                        'NOM' => $people_mobile,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_message->sendsms($konten);
                    if($sendsms == true){
                        echo "Success";
                    } else {
                        echo "Error";
                    }
                }
            } else {
                echo "Error";                
            }
        }

        public function send_sms_mcu(){
            $people_id      = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $pelamar_id     = $this->my_encryption->decode($this->pregReps($this->input->post('pelamar_id')));
            $people_mobile  = $this->my_encryption->decode($this->pregReps($this->input->post('mobile')));
            $mcu_date       = $this->pregReps($this->input->post('mcu_date'));
            $mcu_time       = $this->pregReps($this->input->post('mcu_time'));
            $site           = $this->pregReps($this->input->post('site'));
            $rs_id          = $this->pregRepn($this->input->post('rs_id'));
            $locationid     = $this->pregRepn($this->input->post('clinic_location'));
            $clinic_id      = $this->pregRepn($this->input->post('clinic_id'));
            $clinic_address = $this->pregReps($this->input->post('clinic_address'));
            $checkSchedule  = $this->mod_message->check_schedule_interview($pelamar_id, $rs_id);
            if ($checkSchedule !== false) {
                echo "Duplicate";
                exit();
            }
            $getPJV = $this->mod_message->get_pjv_pelamar($pelamar_id);
            if ($getPJV == false) {
                echo "Unfulfilled";
                exit();
            }
            $msgid       = 6;
            $getMsg      = $this->mod_message->get_message_content($msgid);
            $getLocation = $this->mod_global->get_city($locationid);
            $getPName    = $this->mod_message->get_people_name($people_id);
            $getClinic   = $this->mod_message->get_detail_clinic($clinic_id);

            if($people_id !== '' && $pelamar_id !== ''){
                $date    = date('ymd', strtotime($mcu_date));
                $number  = $this->mod_message->get_last_mcu_number('BSS-MCU-'.$date);
                if ($number) {
                    $temps  = substr($number->patient_m_number, 14);
                    $tempid = $temps + 1;
                    $mcu_noreg = 'BSS-MCU-'.$date.str_pad($tempid, 3, "0", STR_PAD_LEFT);
                } else {
                    $mcu_noreg = 'BSS-MCU-'.$date.'001';
                }
                $address    = $clinic_address.'-'.$getLocation->city_name;
                $msgContent = $getMsg->doc_content;
                $target     = ["--nama--", "--noreg--","--tgl--", "--jam--", "--klinik--", "--alamat--"];
                $replace    = [strtoupper($getPName->people_firstname), $mcu_noreg, $mcu_date, $mcu_time, $getClinic->clinic_name, $address];
                $content    = str_replace($target, $replace, $msgContent);
                $dataMessage = array(
                    'pelamar_id'        => $pelamar_id,
                    'people_id'         => $people_id,
                    'rs_id'             => $rs_id,
                    'bridge_p_r_id'     => 0,
                    'schedule_msg'      => $content,
                    'schedule_location' => $locationid,
                    'schedule_date'     => $this->serverDate($mcu_date).' '.date("H:i:s", strtotime($mcu_time)),
                    'schedule_status'   => 2,
                );
                $saveSchedule = $this->mod_message->insert_all('schedule', $dataMessage);
                if ($saveSchedule == true) {
                    $dataPJV = array('mcu' => 2);
                    $savePJV = $this->mod_message->edit_extra_all('jv_id', $getPJV->jv_id, 'parameter_job_vacancy', $dataPJV);
                    if ($savePJV == true) {
                        $pasienMCU = array(
                            'clinic_id'            => $clinic_id,
                            'pelamar_id'           => $pelamar_id,
                            'patient_m_number'     => $mcu_noreg,
                            'patient_m_date'       => $this->serverDate($mcu_date),
                            'patient_m_type'       => 'KARIR',
                            'patient_m_status'     => 1,
                            'patient_m_created_at' => date("Y-m-d H:i:s"),
                            'patient_m_created_by' => $this->session->userdata('username'),
                            'KodeST'               => $site
                        );
                        $savePatient = $this->mod_message->insert_all('WEB.dbo.patient_mcu', $pasienMCU);
                        if ($savePatient == true) {
                            $dataSite = array( 'KodeST' => $site );
                            $saveSite = $this->mod_message->edit_extra_all('pelamar_id', $pelamar_id, 'pelamar', $dataSite);
                            if ($saveSite == true) {
                                $konten = array(
                                    'NOM' => $people_mobile,
                                    'MSG' => $content
                                );
                                $sendsms = $this->mod_message->sendsms($konten);
                                if ($sendsms == true) {
                                    echo "Success";
                                } else {
                                    echo "Error";
                                    exit();
                                }
                            }
                        }
                    }
                }
            } else {
                echo "Error";
                exit();              
            }
        }
    }
?>