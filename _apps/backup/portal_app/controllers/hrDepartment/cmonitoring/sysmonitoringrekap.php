<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmonitoringrekap extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmonitoring/mod_hr_pelamar_monitor_rekap', 'mod_master']);
            $this->date_only_def = date("Y-m-d");
        }

        public function pelamar_monitor_rekap(){
            $data = array(
                'totalRekap' => $this->mod_hr_pelamar_monitor_rekap->count_all(),
                'lowongan'   => $this->mod_master->getlowongan_aktif()
            );
            $this->load->view('pages/hr/vmonitoring/pelamar_monitor_rekap', $data);
        }

        public function table_monitor_rekap(){
            $monitor_rekap = $this->mod_hr_pelamar_monitor_rekap->get_datatables();
            $data          = array();
            $no            = $this->input->post('start');
            $step          = $this->mod_hr_pelamar_monitor_rekap->getStepRekrutmen();

            foreach ($monitor_rekap as $field) {
                $no++;
                $condition = ($field->freshgraduate == 0) ? '<i class="fa fa-minus"></i>' : '<i class="fa fa-check"></i>';
                $nama      = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $pelamar_id   = $field->pelamar_id;
                $modhrd       = $this->mod_hr_pelamar_monitor_rekap->status_interview_hrd($pelamar_id);
                $modteknis    = $this->mod_hr_pelamar_monitor_rekap->status_interview_teknis($pelamar_id);
                $modteori     = $this->mod_hr_pelamar_monitor_rekap->status_tes_teori($pelamar_id);
                $modpraktek   = $this->mod_hr_pelamar_monitor_rekap->status_tes_praktek($pelamar_id);
                $modmcu       = $this->mod_hr_pelamar_monitor_rekap->status_mcu($pelamar_id);
                $modagreement = $this->mod_hr_pelamar_monitor_rekap->status_agreement($pelamar_id);

                if ($modhrd->interview_hrd == 1) {
                    $shrd = "Selesai";
                    $btn1 = "green";
                    $tgl1 = $modhrd->tgl;
                } elseif ($modhrd->tgl == NULL) {
                    $shrd = "Belum Proses";
                    $btn1 = "red";
                    $tgl1 = "-";
                } else {
                    $shrd = "Proses";
                    $btn1 = "blue";
                    $tgl1 = $modhrd->tgl;
                }

                if ($modteknis->interview_teknis == 1) {
                    $steknis = "Selesai";
                    $btn2    = "green";
                    $tgl2    = $modteknis->tgl;
                } elseif ($modteknis->tgl == NULL) {
                    $steknis = "Belum Proses";
                    $btn2    = "red";
                    $tgl2    = "-";
                } else {
                    $steknis = "Proses";
                    $btn2    = "blue";
                    $tgl2    = $modteknis->tgl;
                }

                if ($modteori->tes_teori == 1) {
                    $steori = "Selesai";
                    $btn3   = "green";
                    $tgl3   = $modteori->tgl;
                } elseif ($modteori->tgl == NULL) {
                    $steori = "Belum Proses";
                    $btn3   = "red";
                    $tgl3   = "-";
                } else {
                    $steori = "Proses";
                    $btn3   = "blue";
                    $tgl3   = $modteori->tgl;
                }

                if ($modpraktek->tes_praktek == 1) {
                    $spraktek = "Selesai";
                    $btn4     = "green";
                    $tgl4     = $modpraktek->tgl;
                } elseif ($modpraktek->tgl == NULL) {
                    $spraktek = "Belum Proses";
                    $btn4     = "red";
                    $tgl4     = "-";
                } else {
                    $spraktek = "Proses";
                    $btn4     = "blue";
                    $tgl4     = $modpraktek->tgl;
                }

                if ($modmcu->mcu == 1) {
                    $smcu = "Selesai";
                    $btn5 = "green";
                    $tgl5 = $modmcu->tgl;
                } elseif ($modmcu->tgl == NULL) {
                    $smcu = "Belum Proses";
                    $btn5 = "red";
                    $tgl5 = "-";
                } else {
                    $smcu = "Proses";
                    $btn5 = "blue";
                    $tgl5 = $modmcu->tgl;
                }

                if (isset($modagreement->agreement)) {
                    $sagreement = "Proses";
                    $btn6       = "blue";
                    $tgl6       = date("d-m-Y", strtotime($modagreement->tgl));
                } else {
                    $sagreement = "Belum Proses";
                    $btn6       = "red";
                    $tgl6       = "-";
                }

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama;
                $row[]  = $condition;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = date("d/m/Y", strtotime($field->tgl_melamar));
                $row[]  = '<a class=" '.$btn1.' " data-toggle="popover" data-trigger="click" data-placement="top" data-content="'.$tgl1.'">'.$shrd.' </a><div class="bold small">'.$tgl1.'</div>';
                $row[]  = '<a class=" '.$btn2.' " data-toggle="popover" data-trigger="click" data-placement="top" data-content="'.$tgl2.'">'.$steknis.' </a><div class="bold small">'.$tgl2.'</div>';
                $row[]  = '<a class=" '.$btn3.' " data-toggle="popover" data-trigger="click" data-placement="top" data-content="'.$tgl3.'">'.$steori.' </a><div class="bold small">'.$tgl3.'</div>';
                $row[]  = '<a class="'.$btn4.'" data-toggle="popover" data-trigger="click" data-placement="top" data-content="'.$tgl4.'">'.$spraktek.' </a><div class="bold small">'.$tgl4.'</div>';
                $row[]  = '<a class="'.$btn5.'" data-toggle="popover" data-trigger="click" data-placement="top" data-content="'.$tgl5.'">'.$smcu.' </a><div class="bold small">'.$tgl5.'</div>';
                $row[]  = '<a class="'.$btn6.'" data-toggle="popover" data-trigger="click" data-placement="top" data-content="'.$tgl6.'">'.$sagreement.' </a><div class="bold small">'.$tgl6.'</div>';
                $row[]  = '<a target="_blank" href="'.site_url().'pdfRekap/'.$pelamar_id.'" class="btn btn-blue btn-xs">
                                <i class="fa fa-file-pdf"></i>
                            </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_monitor_rekap->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_monitor_rekap->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>