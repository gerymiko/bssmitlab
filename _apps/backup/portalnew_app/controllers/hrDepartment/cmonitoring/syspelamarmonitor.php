<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspelamarmonitor extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmonitoring/mod_hr_pelamar_monitor_kspm', 'hrDept/mmonitoring/mod_hr_pelamar_monitor_hrd', 'hrDept/mmonitoring/mod_hr_pelamar_monitor_teknis', 'hrDept/mmonitoring/mod_hr_pelamar_monitor_teori', 'hrDept/mmonitoring/mod_hr_pelamar_monitor_praktek', 'hrDept/mmonitoring/mod_hr_pelamar_monitor_mcu', 'mod_master']);
            $this->date_only_def  = date("Y-m-d");
        }

        function pelamar_monitor_kspm(){
            $data = array(
                'totalKSPM' => $this->mod_hr_pelamar_monitor_kspm->count_all(),
                'city'      => $this->mod_master->city(),
            );
            $this->load->view('pages/hr/vmonitoring/pelamar_monitor_kspm', $data);
        }

        function pelamar_monitor_hrd(){
            $data = array(
                'totalHRD' => $this->mod_hr_pelamar_monitor_hrd->count_all(),
                'city'     => $this->mod_master->city(),
                'lowongan' => $this->mod_master->getlowongan_aktif()
            );
            $this->load->view('pages/hr/vmonitoring/pelamar_monitor_hrd', $data);
        }

        function pelamar_monitor_teknis(){
            $data = array(
                'totalTEKNIS' => $this->mod_hr_pelamar_monitor_teknis->count_all(),
                'lowongan'    => $this->mod_master->getlowongan_aktif()
            );
            $this->load->view('pages/hr/vmonitoring/pelamar_monitor_teknis', $data);
        }

        function pelamar_monitor_teori(){
            $data = array(
                'totalTEORI' => $this->mod_hr_pelamar_monitor_teori->count_all(),
                'lowongan'   => $this->mod_master->getlowongan_aktif()
            );
            $this->load->view('pages/hr/vmonitoring/pelamar_monitor_teori', $data);
        }

        function pelamar_monitor_praktek(){
            $data = array(
                'totalPRAKTEK' => $this->mod_hr_pelamar_monitor_praktek->count_all(),
                'lowongan'     => $this->mod_master->getlowongan_aktif()
            );
            $this->load->view('pages/hr/vmonitoring/pelamar_monitor_praktek', $data);
        }

        function pelamar_monitor_mcu(){
            $data = array(
                'totalMCU' => $this->mod_hr_pelamar_monitor_mcu->count_all(),
                'lowongan' => $this->mod_master->getlowongan_aktif()
            );
            $this->load->view('pages/hr/vmonitoring/pelamar_monitor_mcu', $data);
        }

        public function table_monitor_kspm(){
            $monitor_kspm = $this->mod_hr_pelamar_monitor_kspm->get_datatables();
            $data         = array();
            $no           = $this->input->post('start');
            
            foreach ($monitor_kspm as $field) {
                $no++;
                $condition    = ($field->freshgraduate == 0) ? '<i class="fa fa-minus"></i>' : '<i class="fa fa-check"></i>';
                
                $tglinterview = date("Y-m-d", strtotime($field->schedule_date));
                $new          = ($tglinterview == $this->date_only_def) ? " <span class='badge badge-secondary badge-roundless'>Baru</span>" : "";
                $nama         = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                if ($field->interview_kspm = 1) {
                    $status = "Selesai";
                } elseif ($field->interview_kspm = 0) {
                    $status = "-";
                } else {
                    $status = "Proses";
                }

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $condition;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->pic_name;
                $row[]  = date("H:i:s", strtotime($field->schedule_date)).' - '.date("d/m/Y", strtotime($field->schedule_date));
                $row[]  = $field->city_name;
                $row[]  = $field->interview_kspm;
                $row[]  = '<a onClick="gagalseleksikspm('.$field->pelamar_id.')" class="btn btn-xs btn-red" >Gagal Seleksi</a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_monitor_kspm->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_monitor_kspm->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_monitor_hrd(){
            $monitor_hrd = $this->mod_hr_pelamar_monitor_hrd->get_datatables();
            $data        = array();
            $no          = $this->input->post('start');
            
            foreach ($monitor_hrd as $field) {
                $no++;

                $condition    = ($field->freshgraduate == 0) ? '<i class="fa fa-minus"></i>' : '<i class="fa fa-check"></i>';
                
                $tglinterview = date("Y-m-d", strtotime($field->schedule_date));
                $new          = ($tglinterview == $this->date_only_def) ? " <span class='badge badge-secondary badge-roundless'>Baru</span>" : "";
                $nama         = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                if ($field->interview_hrd == 1) {
                    $status = "Selesai";
                    $dis    = "";
                } elseif ($field->interview_hrd = 0) {
                    $status = "-";
                    $dis    = "disabled";
                } else {
                    $status = "Proses";
                    $dis    = "disabled";
                }

                $cekdetailinterview = $this->mod_hr_pelamar_monitor_hrd->detail_interview_hrd($field->pelamar_id);
                if ($cekdetailinterview == NULL) {
                    $disabled = "disabled";
                } else {
                    $disabled = "";
                }

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $condition;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = $field->pic_name;
                $row[]  = date("H:i:s", strtotime($field->schedule_date)).' - '.date("d/m/Y", strtotime($field->schedule_date));
                $row[]  = $field->city_name;
                $row[]  = $status;
                $row[]  = '<a target="_blank" href="'.site_url().'pdfinterviewhrdkspm/'.$field->pelamar_id.'" '.$disabled.' class="btn btn-orange btn-xs" id="pdf'.$no.'">
                                <i class="fa fa-file-pdf"></i>
                            </a';
                $row[]  = '<a onClick="gagalseleksihrd('.$field->pelamar_id.')" '.$dis.' class="btn btn-xs btn-red"><i class="fa fa-times"></i> Gagal Seleksi</a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_monitor_hrd->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_monitor_hrd->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_monitor_teknis(){
            $monitor_teknis = $this->mod_hr_pelamar_monitor_teknis->get_datatables();
            $data           = array();
            $no             = $this->input->post('start');
            
            foreach ($monitor_teknis as $field) {
                $no++;

                $condition    = ($field->freshgraduate == 0) ? '<i class="fa fa-minus"></i>' : '<i class="fa fa-check"></i>';
                
                $tglinterview = date("Y-m-d", strtotime($field->schedule_date));
                $new          = ($tglinterview == $this->date_only_def) ? " <span class='badge badge-secondary badge-roundless'>Baru</span>" : "";
                $nama         = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                if ($field->interview_teknis == 1) {
                    $status   = "Selesai";
                    $disabled = "";
                } elseif ($field->interview_teknis = 0) {
                    $status   = "-";
                    $disabled = "disabled";
                } else {
                    $status   = "Proses";
                    $disabled = "disabled";
                }

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $condition;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = $field->pic_name;
                $row[]  = date("H:i:s", strtotime($field->schedule_date)).' - '.date("d/m/Y", strtotime($field->schedule_date));
                $row[]  = $field->city_name;
                $row[]  = $status;
                $row[]  = '<a onClick="gagalseleksiteknis('.$field->pelamar_id.')" '.$disabled.' class="btn btn-xs btn-red"><i class="fa fa-times"></i> Gagal Seleksi</a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_monitor_teknis->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_monitor_teknis->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_monitor_teori(){
            $level         = $this->session->userdata('level_id');
            $monitor_teori = $this->mod_hr_pelamar_monitor_teori->get_datatables();
            $data          = array();
            $no            = $this->input->post('start');
            
            foreach ($monitor_teori as $field) {
                $no++;

                $condition    = ($field->freshgraduate == 0) ? '<i class="fa fa-minus"></i>' : '<i class="fa fa-check"></i>';
                
                $tglinterview = date("Y-m-d", strtotime($field->schedule_date));
                $new          = ($tglinterview == $this->date_only_def) ? " <span class='badge badge-secondary badge-roundless'>Baru</span>" : "";
                $nama         = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                if ($field->ptotal_nilai == NULL) {
                    $cekstatustes = "Belum tes";
                    $dis = "disabled";
                } else {
                    $cekstatustes = "Sudah tes";
                    $dis = "";
                }

                $getnilai = $this->mod_hr_pelamar_monitor_teori->getnilai_pelamar($field->pelamar_id);

                if ($level !== 6) {
                    if ($getnilai->ptotal_nilai == NULL) {
                        $inputnilai = '<button onClick="alert_user()" class="btn btn-default btn-xs"><i class="fa fa-pencil-alt"></i> Nilai</button>';
                    } else {
                        $inputnilai = '<b>'.$getnilai->ptotal_nilai.'</b>';
                    }
                } else {
                    if ($getnilai->ptotal_nilai == NULL) {
                        $inputnilai = '<button data-toggle="modal" data-target="#modal-add-nilai" class="btn btn-default btn-xs" data-nama="'.$nama.'" data-id="'.$field->pelamar_id.'" data-regkode="'.$field->registrant_kode.'">
                                    <i class="fa fa-pencil-alt"></i> Nilai
                                </button>';
                    } else {
                        $editnilai = '<button data-toggle="modal" data-target="#modal-edit-nilai" class="btn btn-default btn-xs" data-nama="'.$nama.'" data-id="'.$field->pelamar_id.'" data-regkode="'.$field->registrant_kode.'" data-nilai="'.$field->ptotal_nilai.'" data-tgl_tes="'.$field->tgl_test.'">
                                    <i class="fa fa-edit"></i>
                                </button>';
                        $inputnilai = $getnilai->ptotal_nilai.' '.$editnilai;
                    }
                }

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $condition;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = date("H:i:s", strtotime($field->schedule_date)).' - '.date("d/m/Y", strtotime($field->schedule_date));
                $row[]  = $field->city_name;
                $row[]  = $cekstatustes;
                $row[]  = $inputnilai;
                $row[]  = '<a onClick="gagalseleksiteori('.$field->pelamar_id.')" '.$dis.' class="btn btn-xs btn-red"><i class="fa fa-times"></i> Gagal Seleksi</a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_monitor_teori->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_monitor_teori->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_monitor_praktek(){
            $monitor_praktek = $this->mod_hr_pelamar_monitor_praktek->get_datatables();
            $data            = array();
            $no              = $this->input->post('start');
            
            foreach ($monitor_praktek as $field) {
                $no++;

                $condition    = ($field->freshgraduate == 0) ? '<i class="fa fa-minus"></i>' : '<i class="fa fa-check"></i>';
                
                $tglinterview = date("Y-m-d", strtotime($field->schedule_date));
                $new          = ($tglinterview == $this->date_only_def) ? " <span class='badge badge-secondary badge-roundless'>Baru</span>" : "";
                $nama         = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                if ($field->tes_praktek == 1) {
                    $status = "Selesai";
                } elseif ($field->tes_praktek = 0) {
                    $status = "-";
                } else {
                    $status = "Proses";
                }

                $average = floatval(($field->practice_total_result/$field->practice_total_answer));
                $reverage = number_format($average, 2, ',', '.');

                if ($field->practice_total_result == 0) {
                    $vnilai = "-";
                } else {
                    $vnilai = '<button data-toggle="modal" data-target="#modal-penilaian" class="btn btn-default btn-xs" data-nama="'.$nama.'" data-item="'.$field->practice_total_item.'" data-benar="'.$field->practice_total_answer.'" data-total="'.$field->practice_total_result.'" data-average="'.$reverage.'" data-regkode="'.$field->registrant_kode.'">
                                <i class="fa fa-eye"></i> Nilai
                            </button>';
                }

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $condition;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = $field->pic_name;
                $row[]  = date("H:i:s", strtotime($field->schedule_date)).' - '.date("d/m/Y", strtotime($field->schedule_date));
                $row[]  = $field->city_name;
                $row[]  = $status;
                $row[]  = $vnilai;
                $row[]  = '<a onClick="gagalseleksipraktek('.$field->pelamar_id.')" class="btn btn-xs btn-red"><i class="fa fa-times"></i> Gagal Seleksi</a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_monitor_praktek->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_monitor_praktek->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_monitor_mcu(){
            $monitor_mcu = $this->mod_hr_pelamar_monitor_mcu->get_datatables();
            $data        = array();
            $no          = $this->input->post('start');
            
            foreach ($monitor_mcu as $field) {
                $no++;
                $condition    = ($field->freshgraduate == 0) ? 'No' : 'Yes';
                $tglinterview = date("Y-m-d", strtotime($field->schedule_date));
                $new          = ($tglinterview == $this->date_only_def) ? " <span class='badge badge-secondary badge-roundless'>Baru</span>" : "";
                $nama         = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $row    = array();
                $row[]  = $no;
                $row[]  = $nama.$new;
                $row[]  = $condition;
                $row[]  = $field->jabatan_alias;
                $row[]  = date("H:i:s", strtotime($field->schedule_date)).' - '.date("d/m/Y", strtotime($field->schedule_date));
                $row[]  = $field->city_name;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_monitor_mcu->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_monitor_mcu->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>