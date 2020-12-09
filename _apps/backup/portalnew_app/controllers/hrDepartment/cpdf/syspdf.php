<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	class Syspdf extends CI_Controller {

		public function __construct(){	
			parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mdetail/mod_hr_detailpeople', 'hrDept/mdetail/mod_hr_detailinterview']);
            $this->load->library(['Pdf']);
		}

		public function photo_profile($people_id){
            $getFilename = $this->mod_hr_detailpeople->detail_people($people_id);
            $lokasi      = dirname("E:\\").'/images/karir/upload/';
            $filename    = $lokasi.'/'.urldecode($getFilename->people_photo);
            header('Content-Description: File Transfer');
            header('Content-Type: application/file');
            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            header("Last-Modified: ".date ("D, d M Y H:i:s", filemtime($filename))." GMT");
            ob_clean();
            flush();
            readfile($filename);
            exit;
        }

		public function download_pdf($people_id){
			$data   = array(
                'detail_people'          => $this->mod_hr_detailpeople->detail_people($people_id),
                'detail_alamat_asal'     => $this->mod_hr_detailpeople->detail_alamat_asal($people_id),
                'detail_alamat_domisili' => $this->mod_hr_detailpeople->detail_alamat_domisili($people_id),
                'detail_ktp'             => $this->mod_hr_detailpeople->detail_ktp($people_id),
                'detail_sim'             => $this->mod_hr_detailpeople->detail_sim($people_id),
                'detail_edufor'          => $this->mod_hr_detailpeople->detail_edufor($people_id),
                'detail_eduinfor'        => $this->mod_hr_detailpeople->detail_eduinfor($people_id),
                'detail_fambig'          => $this->mod_hr_detailpeople->detail_fambig($people_id),
                'detail_faminti'         => $this->mod_hr_detailpeople->detail_faminti($people_id),
                'detail_status'          => $this->mod_hr_detailpeople->detail_status($people_id),
                'detail_jobhis'          => $this->mod_hr_detailpeople->detail_jobhis($people_id),
                'detail_questjob'        => $this->mod_hr_detailpeople->detail_questjob($people_id),
                'detail_questfamily'     => $this->mod_hr_detailpeople->detail_questfamily($people_id),
                'detail_questsosial'     => $this->mod_hr_detailpeople->detail_questsosial($people_id),
                'detail_questother'      => $this->mod_hr_detailpeople->detail_questother($people_id),
                'detail_answer'          => $this->mod_hr_detailpeople->detail_answer($people_id),
                // 'detail_loker'           => $this->mod_hr_detailpeople->detail_loker($people_id, $pelamar_id),
            );
			$this->load->view('pages/hr/vpdf/downloadpdf', $data);
		}

        public function download_pdf_interview_hrdkspm($pelamar_id){
            $data = array(
                'detail_people' => $this->mod_hr_detailinterview->detail_people($pelamar_id),
                'detail_hrd'    => $this->mod_hr_detailinterview->detail_interview_hrd($pelamar_id)
            );
            $this->load->view('pages/hr/vpdf/pdfinterviewhrdkspm', $data);
        }

        public function download_pdf_rekap_monitoring($pelamar_id){
            $data = array(
                'detail_people'  => $this->mod_hr_detailinterview->detail_people($pelamar_id),
                'detail_hrd'     => $this->mod_hr_detailinterview->status_interview_hrd($pelamar_id),
                'detail_teknis'  => $this->mod_hr_detailinterview->detail_tes_teknis($pelamar_id),
                'detail_teori'   => $this->mod_hr_detailinterview->detail_tes_teori($pelamar_id),
                'detail_praktek' => $this->mod_hr_detailinterview->detail_tes_praktek($pelamar_id),
                'detail_mcu' => $this->mod_hr_detailinterview->detail_mcu($pelamar_id)
            );
            $this->load->view('pages/hr/vpdf/pdfrekapmonitoring', $data);
        }
	}
?>