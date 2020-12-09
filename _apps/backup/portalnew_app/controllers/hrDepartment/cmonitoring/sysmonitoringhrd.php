<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmonitoringhrd extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmonitoring/mod_hr_pelamar_monitor_hrd', 'mod_master']);
            $this->date_only_def  = date("Y-m-d");
        }

        public function gagal_seleksi_hrd($pelamar_id){
			$pelamar_id = $this->input->post('pelamar_id');
			$data = array(
				'pelamar_status'   => 0,
				'keterangan_gagal' => 'Gagal seleksi interview HRD',
				'tgl_update'       => $this->date_only_def,
			);
            $updatestatuspelamar = $this->mod_hr_pelamar_monitor_hrd->update_statuspelamar($pelamar_id, $data);
            echo json_encode($updatestatuspelamar);
        }

    }
?>