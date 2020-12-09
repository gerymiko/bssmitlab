<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfailed extends CI_Controller {

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
            $this->load->model(['mrecruit/web/election/mod_failed']);
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
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'content' => 'pages/precruit/web/failed/view',
                'accessRights' => $this->accessRights,
                'listjabatan' => $this->mod_global->list_jabatan(),
                'css_script'  => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                )
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_failed(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false); }
            $applicant = $this->mod_failed->get_applicant_failed($length, $start);
            foreach ($applicant as $field){
                $date     = new DateTime($field->people_birth_date);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $age      = $interval->format("%y Tahun");
                $date_regend = date("Y-m-d", strtotime("+14 day", strtotime($field->tgl_melamar)));
                $date_regis  = $field->tgl_melamar;
                $condition   = ($field->freshgraduate == 0) ? 'N' : 'Y';
                $new         = (strtotime($date_regend) > strtotime(date("Y-m-d"))) ? " <span class='label label-success'>Baru</span>" : "";

                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['name'] = ucwords(strtolower($field->people_fullname)).$new;
                $row['fg']   = $condition;
                $row['age']  = $age;
                $row['gender'] = $field->people_gender;
                $row['position'] = $field->jabatan_alias;
                $row['domisili'] = $field->city_name;
                $row['date']   = $this->viewDate($field->tgl_melamar);
                $row['status'] = $field->keterangan_gagal;
                $row['action']   = '
                    <a class="btn btn-primary btn-xs" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                        <i class="fas fa-user-tie"></i>
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