<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysagreement extends CI_Controller {

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
            $this->load->model(['mrecruit/web/election/mod_pre_agreement']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("d-m-Y H:i:s", strtotime($date));
        }

        private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/precruit/web/agree/view',
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

        public function table_pre_agreement(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false); }
            $pre_agreement = $this->mod_pre_agreement->get_datatables($length, $start);
            foreach ($pre_agreement as $field) {
                if ($field->agreement_status == 1) {
                    $kondisi = '<span>Proses Agreement <b>ERP</b></span>';
                } else {
                    $kondisi = '<a class="btn btn-xs bg-red" onclick="proses_agreement(\''.$this->my_encryption->encode($field->people_id).'\',\''.$field->people_fullname.'\')">Belum Agreement</a>';
                }
                $start++;
                $row    = array();
                $row['no']  = $start;
                $row['detail'] = '
                    <a class="btn btn-primary btn-xs" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                        <i class="fas fa-user-tie"></i>
                    </a>';
                $row['name']  = $field->people_fullname;
                $row['department']  = ucwords(strtolower($field->dept));
                $row['position']  = $field->jabatan;;
                $row['noktp']  = $field->agreement_ktp;
                $row['date']  = '<span class="hidden">'.strtotime($field->agreement_created).'</span>'.$this->viewDate($field->agreement_created);
                $row['poh']  = "-";
                $row['site']  = "-";
                $row['action']  = $kondisi;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_pre_agreement->count_all(),
                "recordsFiltered" => $this->mod_pre_agreement->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>