<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmonitoringteori extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmonitoring/mod_hr_pelamar_monitor_teori', 'mod_master']);
            $this->date_only_def  = date("Y-m-d");
        }

        public function gagal_seleksi_teori($pelamar_id){
			$pelamar_id = $this->input->post('pelamar_id');
			$data = array(
				'pelamar_status'   => 0,
				'keterangan_gagal' => 'Gagal seleksi Tes Teori',
				'tgl_update'       => $this->date_only_def
			);
            $updatestatuspelamar = $this->mod_hr_pelamar_monitor_teori->update_statuspelamar($pelamar_id, $data);
            echo json_encode($updatestatuspelamar);
        }

        public function add_nilai_tes(){
            $pelamar_id  = $this->input->post('pelamar_id');
            $getpeopleid = $this->mod_hr_pelamar_monitor_teori->get_people_id($pelamar_id);
            $people_id   = (isset($getpeopleid->people_id) ? $getpeopleid->people_id : "0");
            $lowongan_id = (isset($getpeopleid->lowongan_id) ? $getpeopleid->lowongan_id : "0");

            $data1 = array(
                'pelamar_id' => $pelamar_id,
                'tgl_test'   => date("Y-m-d", strtotime($this->input->post('tgl_tes')))
            );
            $insertpeserta = $this->mod_hr_pelamar_monitor_teori->simpan_peserta_tes($data1);

            $data2 = array(
                'pelamar_id'   => $pelamar_id,
                'ptotal_nilai' => $this->input->post('ptotal_nilai')
            );
            $insertnilai = $this->mod_hr_pelamar_monitor_teori->simpan_nilai_tes($data2);

            $data3 = array(
                'tes_teori' => 1
            );
            $updateparameter = $this->mod_hr_pelamar_monitor_teori->update_pjv_status($people_id, $lowongan_id, $data3);

            if ($insertpeserta == true && $insertnilai == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function edit_nilai_tes(){
            $pelamar_id  = $this->input->post('pelamar_id');
            $getpeopleid = $this->mod_hr_pelamar_monitor_teori->get_people_id($pelamar_id);
            $people_id   = (isset($getpeopleid->people_id) ? $getpeopleid->people_id : "0");
            $lowongan_id = (isset($getpeopleid->lowongan_id) ? $getpeopleid->lowongan_id : "0");

            $data1 = array(
                'tgl_test' => date("Y-m-d", strtotime($this->input->post('tgl_tes')))
            );
            $updatepeserta = $this->mod_hr_pelamar_monitor_teori->update_peserta_tes($pelamar_id, $data1);

            $data2 = array(
                'ptotal_nilai' => $this->input->post('ptotal_nilai')
            );
            $updatenilai = $this->mod_hr_pelamar_monitor_teori->update_nilai_tes($pelamar_id, $data2);

            $data3 = array(
                'tes_teori' => 1
            );
            $updateparameter = $this->mod_hr_pelamar_monitor_teori->update_pjv_status($people_id, $lowongan_id, $data3);

            if ($updatepeserta == true && $updatenilai == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

    }
?>