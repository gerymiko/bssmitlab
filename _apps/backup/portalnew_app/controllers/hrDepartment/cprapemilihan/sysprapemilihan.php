<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprapemilihan extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mprapemilihan/mod_hr_prapemilihan','mod_master']);
        }


        public function prapemilihan(){
            $data = array(
                'sheader' => 'pages/ext/sheader',
                'sfooter' => 'pages/ext/sfooter',
                'totalElection' => $this->mod_hr_prapemilihan->count_all()
            );
            $this->load->view('pages/hr/vprapemilihan/prapemilihan', $data);
        }

        public function table_prapemilihan(){
            $medical = $this->mod_hr_prapemilihan->get_datatables();
            $data    = array();
            $no      = $this->input->post('start');

            foreach ($medical as $field) {

                $nama        = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;
                $tgl_mcu     = ($field->patient_m_updated_at == NULL) ? date("d-m-Y", strtotime($field->patient_m_date)) : date("d-m-Y H:i:s", strtotime($field->patient_m_updated_at));
                $path        = "../../document/mcu/";
                $actual_path = $path.$field->mcu_r_document;
                $disbutton   = ($field->mcu_r_document == NULL) ? "disabled" : "";

                $people_id       = $field->people_id;
                $check_agreement = $this->mod_hr_prapemilihan->check_status($people_id);
                if ($check_agreement == TRUE) {
                    $button = '<a onClick="passed('.$field->pelamar_id.')" class="btn btn-xs btn-blue btn-block" style="padding: 2px;">Pra-Agreement</a>';
                } else {
                    $button = '<a onClick="lolosseleksi('.$field->pelamar_id.')" class="btn btn-xs btn-red btn-block" style="padding: 2px;"">Lolos Seleksi</a>';
                }

                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = $field->patient_m_number;
                $row[]  = strtoupper($field->patient_m_type);
                $row[]  = $field->mcu_r_status; //keterangan
                $row[]  = $tgl_mcu;
                $row[]  = $button;
                
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_prapemilihan->count_all(),
                 "recordsFiltered" => $this->mod_hr_prapemilihan->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }


        function lolos_seleksi($pelamar_id){
            $getpeople = $this->mod_hr_prapemilihan->getpeople_id($pelamar_id);
            $data = array(
                'people_id'         => $getpeople->people_id,
                'agreement_created' => date("Y-m-d H:i:s"),
                'agreement_position'=> $getpeople->KodeJB,
                'agreement_ktp'     => $getpeople->plisence_number,
                'agreement_status'  => 2
            );
            $insertagree = $this->mod_hr_prapemilihan->insert_agreement($data);
            if($insertagree == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>