<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprofile extends CI_Controller {

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.@]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('bssID') == null) {
                redirect('logisisse');
            } else {
                $this->accessRights = $this->mod_global->get_detailed_user($this->session->userdata('users_id'));
                if ($this->accessRights==null) {
                    show_404('', false);
                }
            }
            $this->load->model(['mprofile/mod_profile', 'msms/mod_sms']);
        }

        public function my_profile(){
            $nik = $this->session->userdata('bssID');
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/pprofile/view',
                'accessRights' => $this->accessRights,
                'user'    => $this->mod_profile->getData_user($nik),
                'css_script' => array(),
                'js_script'  => array(),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function get_user_data($id){
            $nik     = $this->my_encryption->decode($this->pregReps($this->uri->segment(3)));
            $getData = $this->mod_profile->get_user_data($nik);
            $data = array();
            foreach ($getData as $field) {
                $row  = array();
                $row['name']  = $field->users_fullname;
                $row['nik']   = $field->bssID;
                $row['site']  = $field->KodeST;
                $row['email'] = $field->users_email;
                $row['phone'] = $field->users_mobile;
                $data[] = $row;
            }
            echo json_encode($data);
        }

        public function save_edit_data($site){
            $nik     = $this->pregRepn($this->input->post('nik_data'));
            $getUser = $this->mod_privilege->getData_user($nik);
            $getRecovery = $this->mod_profile->check_recovery_data($nik);
            $email_post = $this->pregReps($this->input->post('email'));
            $phone_post = $this->pregRepn($this->input->post('phone'));
            if ($getUser->email == $email_post && $getUser->phone == $phone_post ) {
                echo "nochange";exit();
            }
            if ($getRecovery == false ) {
                $dataRecovery = array(
                    'nik'   => $nik,
                    'email' => $getUser->email,
                    'phone' => $getUser->phone
                );
                $saveRecovery = $this->mod_global->insert_all('mos_user_recovery', $dataRecovery);
            } else {
                $dataRecovery = array(
                    'email' => $getUser->email,
                    'phone' => $getUser->phone
                );
                $saveRecovery = $this->mod_profile->edit_recovery($nik, $dataRecovery);
            }
            $data = array(
                'email' => $this->pregReps($this->input->post('email')),
                'phone' => $this->pregRepn($this->input->post('phone')),
                'update_date' => date("Y-m-d H:i:s")
            );
            $saveData = $this->mod_profile->edit_data($nik, $data);
            if ($saveData == true) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Configure own account, onsite : '.$site,
                    'ip_address' => $this->input->ip_address(),
                    'insert_time' => date("Y-m-d H:i:s")
                );
                $saveLog = $this->mod_global->insert_all('mos_user_log', $dataLog);

                // SEND SMS
                $getUser2     = $this->mod_profile->getData_user($nik);
                $getRecovery2 = $this->mod_profile->check_recovery_data($nik);
                $checkPhone   = ($getUser2->phone == false) ? 0 : $getUser2->phone;
                if ($checkPhone == 0) {
                    exit();
                } else {
                    $content = 'You have made changes to the PT BSS MOSENTO account data. If you dont, contact admin immediately. bit.ly/2BsSMos' ;
                    $konten = array(
                        'NOM' => $getUser2->phone,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_sms->sendsms($konten);

                    $kontenRec = array(
                        'NOM' => $getRecovery2->phone,
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_sms->sendsms($kontenRec);
                }

                // SEND EMAIL
                if ($getUser2->email == '' || $getUser2->email == null) {
                    exit();
                } else {
                    $email      = $getRecovery2->email;
                    $new_email  = $getUser2->email;
                    $name       = $getUser2->fullname;
                    $phone      = $getUser2->phone;
                    $updateDate = $getUser2->update_date;
                    $lastIP     = $getUser2->last_ip;
                    $this->sendEmailDataChange($email, $new_email, $name, $phone, $updateDate, $lastIP);
                }
                echo "Success";
            } else {
                echo "Error Save";exit();
            }
        }

        public function get_old_password(){
            $old_pass = $this->pregReps($this->input->post('old_password'));
            $nik  = $this->pregRepn($this->input->post('nik'));
            $query = $this->mod_profile->get_old_password($nik, $old_pass);
            if($query == false){
                echo $status = "false";
            } else {
                echo $status = "true";
            }
        }

    }
?>
