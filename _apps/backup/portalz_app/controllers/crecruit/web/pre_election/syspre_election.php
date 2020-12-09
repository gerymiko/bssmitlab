<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspre_election extends CI_Controller {

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
            $this->load->model(['mrecruit/web/election/mod_pre_election']);
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

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/precruit/web/pre_election/view',
                'accessRights' => $this->accessRights,
                'listjabatan' => $this->mod_global->list_jabatan(),
                'css_script'  => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/moment/moment.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_pre_election(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false); }
            $pre_election = $this->mod_pre_election->get_datatables($length, $start);
            foreach ($pre_election as $field){
                $tgl_mcu = ($field->patient_m_updated_at == NULL) ? $this->viewDate($field->patient_m_date) : date("d-m-Y H:i:s", strtotime($field->patient_m_updated_at));
                $path        = "../../document/mcu/";
                $actual_path = $path.$field->mcu_r_document;
                $disbutton   = ($field->mcu_r_document == NULL) ? "disabled" : "";
                $check_agreement = $this->mod_pre_election->check_status($field->people_id);
                if ($check_agreement == TRUE) {
                    $button = '<a onClick="done('.$field->pelamar_id.')" class="text-green hand">Pra-Agreement <i class="fas fa-question-circle"></i></a>';
                } else {
                    $button = '<a onClick="pass_selection(\''.$this->my_encryption->encode($field->pelamar_id).'\',\''.$field->people_fullname.'\')" class="btn btn-xs bg-red f10"><i class="fas fa-check"></i></a>';
                }
                $start++;
                $row    = array();
                $row['no']  = $start;
                $row['detail'] = '
                    <a class="btn btn-primary btn-xs" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                        <i class="fas fa-user-tie"></i>
                    </a>';
                $row['name']     = $field->people_fullname;
                $row['position'] = $field->jabatan_alias;
                $row['nomcu']  = $field->patient_m_number;
                $row['type']   = strtoupper($field->patient_m_type);
                $row['result'] = strtoupper($field->mcu_r_status);
                $row['date']   = $tgl_mcu;
                $row['action'] = $button;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_pre_election->count_all(),
                "recordsFiltered" => $this->mod_pre_election->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>