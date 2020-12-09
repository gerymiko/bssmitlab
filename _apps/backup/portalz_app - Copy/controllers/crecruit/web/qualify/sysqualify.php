<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysqualify extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/web/election/mod_qualify', 'mglobal/mod_global']);
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
                'content'     => 'pages/precruit/web/qualify/view',
                'listjabatan' => $this->mod_global->list_jabatan(),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_qualify(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $applicant = $this->mod_qualify->get_applicant($length, $start);

            foreach ($applicant as $field){
                $date        = new DateTime($field->people_birth_date);
                $now         = new DateTime();
                $interval    = $date->diff($now);
                $age         = $interval->format("%y Tahun");
                $date_regend = date("Y-m-d", strtotime("+14 day", strtotime($field->tgl_melamar)));
                $date_regis  = $field->tgl_melamar;
                $condition   = ($field->freshgraduate == 0) ? 'N' : 'Y';
                $new         = (strtotime($date_regend) > strtotime(date("Y-m-d"))) ? " <span class='label label-success'>Baru</span>" : "";

                $getstatus_pelamar = $this->mod_qualify->status_pelamar($field->pelamar_id);
                $statuspelamar  = ($getstatus_pelamar == true) ? '<span class="label label-success f12">Proses Interview</span>' : 'Belum dipanggil';

                $tahap_kspm     = $this->mod_qualify->get_sms_kspm($field->pelamar_id);
                $tahap_teknis   = $this->mod_qualify->get_sms_teknis($field->pelamar_id);
                $tahap_teori    = $this->mod_qualify->get_sms_teori($field->pelamar_id);
                $tahap_praktek  = $this->mod_qualify->get_sms_praktek($field->pelamar_id);
                $tahap_mcu      = $this->mod_qualify->get_sms_mcu($field->pelamar_id);
                
                $status_kspm    = $this->mod_qualify->status_sent_sms_kspm($field->pelamar_id);
                $status_teori   = $this->mod_qualify->status_sent_sms_teori($field->pelamar_id);
                $status_teknis  = $this->mod_qualify->status_sent_sms_teknis($field->pelamar_id);
                $status_praktek = $this->mod_qualify->status_sent_sms_praktek($field->pelamar_id);
                $status_mcu     = $this->mod_qualify->status_sent_sms_mcu($field->pelamar_id);

                $kspm    = ($tahap_kspm !== false) ? '<button class="btn btn-xs bg-maroon"><i class="fas fa-envelope"></i> SMS</button>' : 'Tidak ada tahap KSPM & HRD';
                $teori   = ($tahap_teori !== false) ? '<button class="btn btn-xs bg-maroon"><i class="fas fa-envelope"></i> SMS</button>' : 'Tidak ada tahap Tes Teori';
                $teknis  = ($tahap_teknis !== false) ? '<button class="btn btn-xs bg-maroon"><i class="fas fa-envelope"></i> SMS</button>' : 'Tidak ada tahap Teknis';
                $praktek = ($tahap_praktek !== false) ? '<button class="btn btn-xs bg-maroon"><i class="fas fa-envelope"></i> SMS</button>' : 'Tidak ada tahap Tes Praktek';
                $mcu     = ($tahap_mcu !== false) ? '<button class="btn btn-xs bg-maroon"><i class="fas fa-envelope"></i> SMS</button>' : 'Tidak ada tahap MCU';

                $kspm_status    = ($status_kspm !== false) ? 'Sudah dipanggil' : 'Belum dipanggil';
                $teori_status   = ($status_teori !== false) ? 'Sudah dipanggil' : 'Belum dipanggil';
                $teknis_status  = ($status_teknis !== false) ? 'Sudah dipanggil' : 'Belum dipanggil';
                $praktek_status = ($status_praktek !== false) ? 'Sudah dipanggil' : 'Belum dipanggil';
                $mcu_status     = ($status_mcu !== false) ? 'Sudah dipanggil' : 'Belum dipanggil';
                
                $start++;
                $row                   = array();
                $row['no']             = $start;
                $row['sms']           = '<a class="btn btn-danger btn-xs details-control" data-tooltip="SMS Interview">
                                        <i class="fas fa-microphone"></i>
                                    </a>';
                $row['name']           = ucwords(strtolower($field->people_fullname)).$new;
                $row['fg']             = $condition;
                $row['age']            = $age;
                $row['gender']         = $field->people_gender;
                $row['position']       = $field->jabatan_alias;
                $row['domisili']       = $field->city_name;
                $row['date']           = $this->viewDate($field->tgl_melamar);
                $row['status']         = $statuspelamar;
                $row['kspm']           = $kspm;
                $row['teori']          = $teori;
                $row['teknis']         = $teknis;
                $row['praktek']        = $praktek;
                $row['mcu']            = $mcu;
                $row['kspm_status']    = $kspm_status;
                $row['teori_status']   = $teori_status;
                $row['teknis_status']  = $teknis_status;
                $row['praktek_status'] = $praktek_status;
                $row['mcu_status']     = $mcu_status;
                $row['action']   = '<a class="btn btn-primary btn-xs" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                                        <i class="fas fa-user-tie"></i>
                                    </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_qualify->count_all(),
                "recordsFiltered" => $this->mod_qualify->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>