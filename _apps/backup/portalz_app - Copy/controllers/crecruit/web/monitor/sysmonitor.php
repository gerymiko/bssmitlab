<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmonitor extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/web/monitor/mod_monitor', 'mglobal/mod_global']);
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
                'header'      => 'pages/ext/header',
                'footer'      => 'pages/ext/footer',
                'topmenu'     => 'pages/ptopbar/vtopbar',
                'sidemenu'    => 'pages/psidebar/vsidebar',
                'content'     => 'pages/precruit/web/monitor/view',
                'listjabatan' => $this->mod_global->list_jabatan()
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_monitor(){
            $monitorRecap = $this->mod_monitor->get_datatables();
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($monitorRecap as $field){
                $no++;
                $gethrd     = $this->mod_monitor->status_interview_hrd($field->pelamar_id);
                $getteknis  = $this->mod_monitor->status_interview_teknis($field->pelamar_id);
                $getteori   = $this->mod_monitor->status_tes_teori($field->pelamar_id);
                $getpraktek = $this->mod_monitor->status_tes_praktek($field->pelamar_id);
                $getmcu     = $this->mod_monitor->status_mcu($field->pelamar_id);
                $getagree   = $this->mod_monitor->status_agreement($field->pelamar_id);
                if ($gethrd->interview_hrd == 1){
                    $shrd = "Selesai";
                    $btn1 = "bg-green";
                    $tgl1 = $this->viewDate($gethrd->tgl);
                } elseif ($gethrd->tgl == NULL){
                    $shrd = "Belum Proses";
                    $btn1 = "bg-blue";
                    $tgl1 = "-";
                } else {
                    $shrd = "Proses";
                    $btn1 = "bg-orange";
                    $tgl1 = $this->viewDate($gethrd->tgl);
                }
                if ($getteknis->interview_teknis == 1) {
                    $steknis = "Selesai";
                    $btn2    = "bg-green";
                    $tgl2    = $this->viewDate($getteknis->tgl);
                } elseif ($getteknis->tgl == NULL) {
                    $steknis = "Belum Proses";
                    $btn2    = "bg-blue";
                    $tgl2    = "-";
                } else {
                    $steknis = "Proses";
                    $btn2    = "bg-orange";
                    $tgl2    = $this->viewDate($getteknis->tgl);
                }
                if ($getteori->tes_teori == 1) {
                    $steori = "Selesai";
                    $btn3   = "bg-green";
                    $tgl3   = $this->viewDate($getteori->tgl);
                } elseif ($getteori->tgl == NULL) {
                    $steori = "Belum Proses";
                    $btn3   = "bg-blue";
                    $tgl3   = "-";
                } else {
                    $steori = "Proses";
                    $btn3   = "bg-orange";
                    $tgl3   = $this->viewDate($getteori->tgl);
                }
                if ($getpraktek->tes_praktek == 1) {
                    $spraktek = "Selesai";
                    $btn4     = "bg-green";
                    $tgl4     = $this->viewDate($getpraktek->tgl);
                } elseif ($getpraktek->tgl == NULL) {
                    $spraktek = "Belum Proses";
                    $btn4     = "bg-blue";
                    $tgl4     = "-";
                } else {
                    $spraktek = "Proses";
                    $btn4     = "bg-orange";
                    $tgl4     = $this->viewDate($getpraktek->tgl);
                }
                if ($getmcu->mcu == 1) {
                    $smcu = "Selesai";
                    $btn5 = "bg-green";
                    $tgl5 = $this->viewDate($getmcu->tgl);
                } elseif ($getmcu->tgl == NULL) {
                    $smcu = "Belum Proses";
                    $btn5 = "bg-blue";
                    $tgl5 = "-";
                } else {
                    $smcu = "Proses";
                    $btn5 = "bg-orange";
                    $tgl5 = $this->viewDate($getmcu->tgl);
                }
                if (isset($getagree->agreement)) {
                    $sagreement = "Proses";
                    $btn6       = "bg-orange";
                    $tgl6       = $this->viewDate($getagree->tgl);
                } else {
                    $sagreement = "Belum Proses";
                    $btn6       = "bg-blue";
                    $tgl6       = "-";
                }

                if ($field->lowongan_status == 1) {
                    $vacanStatus = '<i class="fas fa-dot-circle text-green"></i>';
                } else {
                    $vacanStatus = '<i class="fas fa-dot-circle text-red"></i>';
                }
 
                $row             = array();
                $row['no']       = $no;
                $row['name']     = $field->people_fullname;
                $row['position'] = $field->jabatan_alias.' '.$vacanStatus;
                $row['domisili'] = $field->city_name;
                $row['date']     = $this->viewDate($field->tgl_melamar);
                $row['hrd']      = '<span class="label f12 hand '.$btn1.'">'.$shrd.'</span>';
                $row['teknis']   = '<span class="label f12 hand '.$btn2.'">'.$steknis.'</span>';
                $row['teori']    = '<span class="label f12 hand '.$btn3.'">'.$steori.'</span>';
                $row['praktek']  = '<span class="label f12 hand '.$btn4.'">'.$spraktek.'</span>';
                $row['mcu']      = '<span class="label f12 hand '.$btn5.'">'.$smcu.'</span>';
                $row['agree']    = '<span class="label f12 hand '.$btn6.'">'.$sagreement.'</span>';
                $row['action']   = '<a class="hand btn btn-primary btn-xs red-tooltip" data-toggle="tooltip" title="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                                        <i class ="fas fa-user-tie"></i>
                                    </a>
                                    <a class="hand btn btn-danger btn-xs red-tooltip" data-toggle="tooltip" title="Cetak PDF" >
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_monitor->count_all(),
                "recordsFiltered" => $this->mod_monitor->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>