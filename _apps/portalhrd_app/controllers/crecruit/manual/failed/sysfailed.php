<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfailed extends CI_Controller{

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
            $this->load->model(['mrecruit/manual/failed/mod_failed']);
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
                'content' => 'pages/precruit/manual/failed/view',
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

        public function table_applicant_failed(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false); }
            $applicant = $this->mod_failed->get_datatables($length, $start);
            foreach ($applicant as $field){
                $start++;   
                $date     = new DateTime($field->people_birth_date);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Thn");
                $interviewAvailableDate = date("Y-m-d", strtotime("+ 6 month", strtotime($field->timestamp)));
                if ($field->interview_status == 3){
                    $status_tes      = "BI";
                    $btn_reinterview = "hidden";
                    $btn_dinterview  = "hidden";
                } elseif ($field->interview_status == 0){
                    $status_tes      = "TL";
                    $btn_reinterview = "";
                    $btn_dinterview  = "";
                } elseif ($field->interview_status == 2){
                    $status_tes      = "TD";
                    $btn_reinterview = "hidden";
                    $btn_dinterview  = "";
                } elseif ($field->interview_status == 4){
                    $status_tes      = "BL";
                    $btn_reinterview = "hidden";
                    $btn_dinterview  = "";
                } else {
                    $status_tes      = "LS";
                    $btn_reinterview = "hidden";
                    $btn_dinterview  = "";
                }
                $row       = array();
                $row['no'] = $start;
                $row['detail'] = '
                    <a class="btn btn-primary btn-xs red-tooltip" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                        <i class="fas fa-user-tie"></i>
                    </a>';
                $row['name']   = $field->people_fullname;
                $row['edu']    = $field->edutype_name;
                $row['age']    = $usia;
                $row['gender'] = $field->people_gender;
                $row['domisili'] = $field->city.', '.$field->address;
                $row['position'] = $field->jabatan;
                $row['date']   = '<span class="hidden">'.strtotime($field->tgl_melamar).'</span>'.$this->viewDate($field->tgl_melamar);
                $row['site']   = ($field->interview_site == null) ? '-' : $field->interview_site;
                $row['stage']  = ($field->tahap == null) ? '-' : $field->tahap;
                $row['status'] = $status_tes;
                $row['desc']   = ($field->interview_desc == 'BI') ? '-' : $field->interview_desc;
                $row['action'] = '
                    <button type="button" class="btn bg-navy btn-xs '.$btn_reinterview.' " data-tooltip="Interview Ulang" onclick="btn_reinterview(\''.$this->my_encryption->encode($field->id).'\',\''.$field->people_fullname.'\',\''.$this->viewDate($interviewAvailableDate).'\');">
                        <i class="fas fa-sync f10"></i>
                    </button>
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
                "recordsTotal"    => $this->mod_failed->count_all(),
                "recordsFiltered" => $this->mod_failed->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>