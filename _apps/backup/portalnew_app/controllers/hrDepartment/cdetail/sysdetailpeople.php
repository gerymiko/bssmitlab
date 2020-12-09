<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdetailpeople extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('https://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mdetail/mod_hr_detailpeople']);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function dateEast($date){
            return $result = date("d-m-Y", strtotime($date));
        }


        public function detail_people($people_id){
            $people_id = $this->pregRepn($people_id);
            $data = array(
                'sheader'                => 'pages/ext/sheader',
                'sfooter'                => 'pages/ext/sfooter',
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
                'detail_answer'          => $this->mod_hr_detailpeople->detail_answer($people_id),
                'detail_lisence'         => $this->mod_hr_detailpeople->detail_lisence($people_id),
                'detail_melamar'         => $this->mod_hr_detailpeople->detail_melamar($people_id),
            );
            $this->load->view('pages/hr/vdetail/detail_people',$data);
        }

        public function detail_people_manual($people_noreg){
            $people_noreg = $this->pregReps($people_noreg);
            $data = array(
                'sheader'        => 'pages/ext/sheader',
                'sfooter'        => 'pages/ext/sfooter',
                'detail_people'  => $this->mod_hr_detailpeople->detail_people_manual($people_noreg),
                'detail_address' => $this->mod_hr_detailpeople->detail_address_manual($people_noreg),
                'detail_ktp'     => $this->mod_hr_detailpeople->detail_ktp_manual($people_noreg),
                'detail_sim'     => $this->mod_hr_detailpeople->detail_sim_manual($people_noreg),
                'detail_skill'   => $this->mod_hr_detailpeople->detail_skill_manual($people_noreg),
                'detail_exp'     => $this->mod_hr_detailpeople->detail_exp_manual($people_noreg),
            );
            $this->load->view('pages/hr/vdetail/detail_people_manual',$data);
        }

        public function detail_berkas($people_id){
            $people_id = $this->encrypt->decode($people_id);
            $data = array(
                'detail_lisence' => $this->mod_hr_detailpeople->detail_lisence($people_id),
                'detail_jobhis'  => $this->mod_hr_detailpeople->detail_jobhis($people_id),
            );
            $this->load->view('pages/hr/vdetail/detail_berkas',$data);
        }

        public function detail_berkas_manual($people_noreg){
            $people_noreg = $this->pregReps($people_noreg);
            $data = array(
                'detail_lisence_manual' => $this->mod_hr_detailpeople->detail_lisence_manual($people_noreg),
                'detail_jobhis_manual'  => $this->mod_hr_detailpeople->detail_jobhis_manual($people_noreg),
            );
            $this->load->view('pages/hr/vdetail/detail_berkas_manual',$data);
        }

        public function gagal_berkas($pelamar_id){
            $pelamar_id = $this->pregRepn($this->input->post('pelamar_id'));
            $data = array(
                'pelamar_status'   => 0,
                'keterangan_gagal' => 'Gagal seleksi berkas',
                'tgl_update'       => date("Y-m-d H:i:s"),
            );
            $updatestatuspelamar = $this->mod_hr_detailpeople->update_statuspelamar($pelamar_id, $data);
            echo json_encode($updatestatuspelamar);
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

        public function show_lisence($plisence_id){
            $getFilename = $this->mod_hr_detailpeople->get_file_lisence($plisence_id);
            $lokasi      = dirname("E:\\").'/images/karir/upload';
            $filename    = $lokasi.'/'.urldecode($getFilename->plisence_file);
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

        public function show_job_lisence($pjobhistory_id){
            $getFilename = $this->mod_hr_detailpeople->get_file_job_lisence($pjobhistory_id);
            $lokasi      = dirname("E:\\").'/images/karir/upload';
            $filename    = $lokasi.'/'.urldecode($getFilename->pjobhistory_file);
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

        public function show_lisence_manual($plisence_id){
            $getFilename = $this->mod_hr_detailpeople->detail_lisence_manual($plisence_id);
            $lokasi      = dirname("E:\\").'/images/karir/upload';
            $filename    = $lokasi.'/'.urldecode($getFilename->lisence_file);
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

        public function show_job_lisence_manual($pexp_id){
            $getFilename = $this->mod_hr_detailpeople->detail_lisence_manual($pexp_id);
            $lokasi      = dirname("E:\\").'/images/karir/upload';
            $filename    = $lokasi.'/'.urldecode($getFilename->exp_file);
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

        public function table_history_interview($people_id){
            $people_id = $this->encrypt->decode($people_id);
            $history_interview = $this->mod_hr_detailpeople->get_datatables_historiview($people_id);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($history_interview as $field) {

                if ($field->conclusion == 0) {
                    $status_tes = "TL";
                } else {
                    $status_tes = "LULUS";
                }

                $no++;
                $row                   = array();
                $row['trainer']        = $field->trainer_nik;
                $row['tgl_melamar']    = $this->dateEast($field->tgl_melamar);
                $row['tgl_interview']  = $this->dateEast($field->interview_date);
                $row['tgl_praktek']    = $this->dateEast($field->praktek_date);
                $row['site']           = $field->interview_site;
                $row['jabatan']        = $field->jabatan;
                $row['teori']          = $field->score_teori;
                $row['praktek1']       = $field->score_practice1;
                $row['praktek2']       = $field->score_practice2;
                $row['praktek3']       = $field->score_practice3;
                $row['praktek4']       = $field->score_practice4;
                $row['praktek5']       = $field->score_practice5;
                $row['paverage']       = (floatval($field->score_practice1) + floatval($field->score_practice2) + floatval($field->score_practice3) + floatval($field->score_practice4) + floatval($field->score_practice5)) / 5;
                $row['conclusion']     =  $status_tes;
                $row['conclusion_ket'] = $field->conclusion_ket;
                $row['reference']      = $field->reference;

                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_hr_detailpeople->count_all($people_id),
                "recordsFiltered" => $this->mod_hr_detailpeople->count_filtered($people_id),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>