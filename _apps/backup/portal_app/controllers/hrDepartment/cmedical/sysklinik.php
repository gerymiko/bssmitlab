<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysklinik extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null) :
                $this->session->set_flashdata('notif','Oops! Silahkan login terlebih dahulu.');
                redirect('syslogin');
            endif;
            $this->load->model(['hrDept/mmedical/mod_hr_klinik', 'mod_master']);
        }

        public function klinik(){
            $data = array(
                'sheader'    => 'pages/ext/sheader',
                'sfooter'    => 'pages/ext/sfooter',
                'city'       => $this->mod_master->city(),
            );
            $this->load->view('pages/hr/vmedical/klinik', $data);
        }

        public function table_klinik(){
            $klinik = $this->mod_hr_klinik->get_datatables();
            $data   = array();
            $no     = $this->input->post('start');

            foreach ($klinik as $field) {
                $status_clinic = ($field->clinic_status == 1) ? "Aktif" : "Non-Aktif";
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->clinic_name;
                $row[]  = $field->clinic_address;
                $row[]  = $field->city_name;
                $row[]  = $field->clinic_telp;
                $row[]  = $field->clinic_price;
                $row[]  = $status_clinic;
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_klinik->count_all(),
                 "recordsFiltered" => $this->mod_hr_klinik->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>