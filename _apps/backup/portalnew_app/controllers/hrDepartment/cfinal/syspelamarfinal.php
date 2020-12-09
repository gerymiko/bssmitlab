<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspelamarfinal extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mfinal/mod_hr_final','mod_master']);
        }


        public function finalisasi(){
            $data = array(
                'sheader'    => 'pages/ext/sheader',
                'sfooter'    => 'pages/ext/sfooter',
                'totalFinal' => $this->mod_hr_final->count_all()
            );
            $this->load->view('pages/hr/vfinal/final', $data);
        }

        public function table_final(){
            $final = $this->mod_hr_final->get_datatables();
            $data  = array();
            $no    = $this->input->post('start');

            foreach ($final as $field) {

                $nama   = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $kondisi = ($field->agreement_status == 1) ? "Proses Agreement" : "Belum Diproses";

                if ($field->agreement_status == 1) {
                    $kondisi = '<a class="btn btn-xs btn-blue btn-block" style="padding: 2px;">Proses Agreement</a>';
                } else {
                    $kondisi = '<a class="btn btn-xs btn-warning btn-block" style="padding: 2px;">Belum Agreement</a>';
                }

                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama;
                $row[]  = $field->dept;
                $row[]  = $field->jabatan;
                $row[]  = $field->registrant_kode;
                $row[]  = $field->agreement_ktp;
                $row[]  = date("d/m/Y", strtotime($field->agreement_created));
                $row[]  = "-";
                $row[]  = "-";
                $row[]  = $kondisi;
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_final->count_all(),
                 "recordsFiltered" => $this->mod_hr_final->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>