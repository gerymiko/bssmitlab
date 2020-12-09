<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmedical extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmedical/mod_hr_medical','mod_master']);
        }

        public function medical(){
            $data = array(
                'sheader' => 'pages/ext/sheader',
                'sfooter' => 'pages/ext/sfooter',
                'totalMCU'=> $this->mod_hr_medical->count_all()
            );
            $this->load->view('pages/hr/vmedical/medical', $data);
        }

        public function table_medical(){
            $medical = $this->mod_hr_medical->get_datatables();
            $data    = array();
            $no      = $this->input->post('start');

            foreach ($medical as $field) {

                $nama   = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                if ($field->patient_m_description == NULL && $field->patient_m_updated_at == NULL) {
                    $status = "Belum Diproses";
                } elseif ($field->patient_m_description == NULL && $field->patient_m_updated_at !== NULL) {
                    $status = "Terverifikasi";
                } elseif ($field->patient_m_description !== NULL && $field->patient_m_updated_at !== NULL) {
                    $status = "Non-verifikasi";
                } else {
                    $status = "-";
                }

                $tgl_mcu = ($field->patient_m_updated_at == NULL) ? date("d-m-Y", strtotime($field->patient_m_date)) : date("d-m-Y H:i:s", strtotime($field->patient_m_updated_at));
                
                $path        = "../../document/mcu/";
                
                $actual_path = $path.$field->mcu_r_document;
                
                $disbutton   = ($field->mcu_r_document == NULL) ? "disabled" : "";

                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->pelamar_id;
                $row[]  = $nama;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->patient_m_number;
                $row[]  = strtoupper($field->patient_m_type);
                $row[]  = $status;
                $row[]  = $field->mcu_r_status; //keterangan
                $row[]  = '<a href="'.$actual_path.'" target="_blank" class="btn btn-xs btn-red" '.$disbutton.'><i class="far fa-file-pdf"></i></a>';
                $row[]  = $tgl_mcu;
                
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_medical->count_all(),
                 "recordsFiltered" => $this->mod_hr_medical->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>