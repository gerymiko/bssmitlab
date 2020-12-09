<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmedical extends CI_Controller{

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
            $this->load->model(['mrecruit/manual/medical/mod_medical']);
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
                'content' => 'pages/precruit/manual/medical/view',
                'accessRights' => $this->accessRights,
                'listjabatan' => $this->mod_global->list_jabatan(),
                'listsite'    => $this->mod_global->list_site(),
                'css_script'  => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/moment/moment.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/input-mask/jquery.inputmask.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/input-mask/jquery.inputmask.date.extensions.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_applicant_medical(){
            $applicant = $this->mod_medical->get_datatables();
            $data      = array();
            $no        = $this->pregRepn($this->input->post('start'));
            
            foreach ($applicant as $field){
                $no++;   
                $date     = new DateTime($field->people_birth_date);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Thn");

                if ($field->interview_status == 3){
                    $status_tes      = "BI";
                    $btn_dinterview  = "hidden";
                } elseif ($field->interview_status == 0){
                    $status_tes      = "TL";
                    $btn_dinterview  = "";
                } elseif ($field->interview_status == 2){
                    $status_tes      = "TD";
                    $btn_dinterview  = "";
                } elseif ($field->interview_status == 4){
                    $status_tes      = "BL";
                    $btn_dinterview  = "";
                } else {
                    $status_tes      = "LS";
                    $btn_dinterview  = "";
                }
                $row           = array();
                $row['no']     = $no;
                $row['detail'] = '
                    <a class="btn btn-primary btn-xs" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                        <i class="fas fa-user-tie"></i>
                    </a>
                ';
                $row['name']     = $field->people_fullname;
                $row['edu']      = $field->edutype_name;
                $row['age']      = $usia;
                $row['gender']   = $field->people_gender;
                $row['domisili'] = $field->city.', '.$field->address;
                $row['position'] = $field->jabatan;
                $row['date']     = $this->viewDate($field->tgl_melamar);
                $row['site']     = ($field->interview_site == null) ? '-' : $field->interview_site;
                $row['stage']    = ($field->tahap == null) ? '-' : $field->tahap;
                $row['status']   = $status_tes;
                $row['desc']     = ($field->interview_desc == 'BI') ? '-' : $field->interview_desc;
                $row['action']   = '
                    <a href="#" class="btn bg-navy btn-xs" data-tooltip="Hasil" data-toggle="modal" data-target="#modal-desicion-mcu" data-backdrop="static" data-keyboard="false" data-id="'.$this->my_encryption->encode($field->id).'" data-people_id="'.$this->my_encryption->encode($field->people_id).'" data-noreg="'.$field->people_noreg.'" data-fullname="'.$field->people_fullname.'" >
                        <i class="fas fa-clipboard-list"></i>
                    </a>
                    <button type="button" class="btn bg-gray btn-xs '.$btn_dinterview.'" style="padding: 1px 4px;" data-tooltip="Detail Interview" onclick="detailInterview(\''.$this->my_encryption->encode($field->id).'\');">
                        <i class="fas fa-binoculars"></i>
                    </button>
                    <a href="#" class="btn btn-danger btn-xs" data-tooltip="Hapus" onclick="removeData(\''.$this->my_encryption->encode($field->people_id).'\', \''.$field->people_fullname.'\');" >
                        <i class="fa fa-times"></i>
                    </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_medical->count_all(),
                "recordsFiltered" => $this->mod_medical->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_decision_mcu(){
            $interview_id  = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $people_id     = $this->my_encryption->decode($this->pregReps($this->input->post('people_id')));
            $valinterview  = substr($this->input->post('statusinterview'), 0, 1);
            $statinterview = substr($this->input->post('statusinterview'), 1);

            if ($statinterview == "Blacklist") {
                $dataInterview = array(
                    'interview_status' => 4,
                    'interview_desc'   => $this->pregReps($this->input->post('conclusion_ket')),
                );
                $saveInterview = $this->mod_medical->edit_extra_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                $dataPeople    = array(
                    'people_blacklist' => 1,
                    'update_date'      => date("Y-m-d H:i:s")
                );
                $savePeople = $this->mod_medical->edit_people($people_id, $dataPeople);
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Interview Manual',
                    'logs_aktifitas'  => 'Insert',
                    'logs_keterangan' => 'Insert pelamar ID interview : '.$newid.' form (Blacklist)',
                    'logs_user_id'    => $this->session->userdata('bssID'),
                    'logs_username'   => $this->session->userdata('username'),
                    'logs_user_name'  => $this->session->userdata('fullname'),
                    'logs_website'    => 'PORTAL'
                );
                $this->mod_global->insert_web('web_logs', $datalogs);
            } else {
                $checkMCU = $this->mod_medical->check_data_mcu($interview_id);
                if ($checkMCU !== false) {
                    $dataMCU = array(
                        'mcu_date'            => $this->serverDate($this->pregReps($this->input->post('mcu_date'))),
                        'mcu_status'          => 1,
                        'mcu_result'          => $this->pregReps($this->input->post('mcu_result')),
                        'mcu_conclusion'      => $valinterview,
                        'mcu_conclusion_desc' => $statinterview,
                        'mcu_description'     => $this->pregReps($this->input->post('conclusion_ket')),
                        'timestamp'           => date("Y-m-d H:i:s")
                    );
                    $saveMCU = $this->mod_medical->edit_extra_all('id', $interview_id, 'seleksi_mcu', $dataMCU);
                    if ($saveMCU == true) {
                        $dataInterview = array(
                            'tahap'            => "MCU",
                            'interview_status' => $valinterview,
                            'interview_desc'   => $statinterview,
                            'mcu'              => 1,
                            'update_date'      => date("Y-m-d H:i:s"),
                            'timestamp'        => date("Y-m-d H:i:s"),
                        );
                        $saveInterview = $this->mod_medical->edit_extra_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                        $datalogs = array(
                            'logs_tanggal'    => date('Y-m-d H:i:s'),
                            'logs_ip'         => $this->input->ip_address(),
                            'logs_modul'      => 'Interview Manual',
                            'logs_aktifitas'  => 'Insert',
                            'logs_keterangan' => 'Insert pelamar ID interview : '.$interview_id.' form (Hasil MCU)',
                            'logs_user_id'    => $this->session->userdata('bssID'),
                            'logs_username'   => $this->session->userdata('username'),
                            'logs_user_name'  => $this->session->userdata('fullname'),
                            'logs_website'    => 'PORTAL'
                        );
                        $this->mod_global->insert_web('web_logs', $datalogs);
                        echo "Success";
                    } else {
                        echo "Error";
                        exit();
                    }
                } else {
                    $dataMCU = array(
                        'id'                  => $interview_id,
                        'people_id'           => $people_id,
                        'mcu_date'            => $this->serverDate($this->pregReps($this->input->post('mcu_date'))),
                        'mcu_status'          => 1,
                        'mcu_result'          => $this->pregReps($this->input->post('mcu_result')),
                        'mcu_conclusion'      => $valinterview,
                        'mcu_conclusion_desc' => $statinterview,
                        'mcu_description'     => $this->pregReps($this->input->post('conclusion_ket')),
                        'timestamp'           => date("Y-m-d H:i:s")
                    );
                    $saveMCU = $this->mod_medical->insert_all('seleksi_mcu', $dataMCU);
                    if ($saveMCU == true) {
                        $dataInterview = array(
                            'tahap'            => "MCU",
                            'interview_status' => $valinterview,
                            'interview_desc'   => $statinterview,
                            'mcu'              => 1,
                            'update_date'      => date("Y-m-d H:i:s"),
                            'timestamp'        => date("Y-m-d H:i:s"),
                        );
                        $saveInterview = $this->mod_medical->edit_extra_all('id', $interview_id, 'pmanual_interview', $dataInterview);
                        $datalogs = array(
                            'logs_tanggal'    => date('Y-m-d H:i:s'),
                            'logs_ip'         => $this->input->ip_address(),
                            'logs_modul'      => 'Interview Manual',
                            'logs_aktifitas'  => 'Insert',
                            'logs_keterangan' => 'Insert pelamar ID interview : '.$interview_id.' form (Hasil MCU)',
                            'logs_user_id'    => $this->session->userdata('bssID'),
                            'logs_username'   => $this->session->userdata('username'),
                            'logs_user_name'  => $this->session->userdata('fullname'),
                            'logs_website'    => 'PORTAL'
                        );
                        $this->mod_global->insert_web('web_logs', $datalogs);
                        echo "Success";
                    } else {
                        echo "Error";
                        exit();
                    }
                }
            }
        }
    }
?>