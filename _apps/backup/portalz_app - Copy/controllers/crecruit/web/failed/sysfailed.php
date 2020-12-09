<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfailed extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/web/election/mod_failed', 'mglobal/mod_global']);
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function viewDate($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        public function index(){
            $data = array(
                'header'      => 'pages/ext/header',
                'footer'      => 'pages/ext/footer',
                'topmenu'     => 'pages/ptopbar/vtopbar',
                'sidemenu'    => 'pages/psidebar/vsidebar',
                'content'     => 'pages/precruit/web/failed/view',
                'listjabatan' => $this->mod_global->list_jabatan(),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_failed(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $applicant = $this->mod_failed->get_applicant_failed($length, $start);

            foreach ($applicant as $field){
                $date        = new DateTime($field->people_birth_date);
                $now         = new DateTime();
                $interval    = $date->diff($now);
                $age         = $interval->format("%y Tahun");
                $date_regend = date("Y-m-d", strtotime("+14 day", strtotime($field->tgl_melamar)));
                $date_regis  = $field->tgl_melamar;
                $condition   = ($field->freshgraduate == 0) ? 'N' : 'Y';
                $new         = (strtotime($date_regend) > strtotime(date("Y-m-d"))) ? " <span class='label label-success'>Baru</span>" : "";

                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['name']     = ucwords(strtolower($field->people_fullname)).$new;
                $row['fg']       = $condition;
                $row['age']      = $age;
                $row['gender']   = $field->people_gender;
                $row['position'] = $field->jabatan_alias;
                $row['domisili'] = $field->city_name;
                $row['date']     = $this->viewDate($field->tgl_melamar);
                $row['status']   = $field->keterangan_gagal;
                $row['action']   = '<a class="btn btn-primary btn-xs" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
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