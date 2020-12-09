<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspoh extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'HR_TIKET') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global', 'mbudget/mod_budget']);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,\/]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
            return $hasil_rupiah;
        }

        public function akomodasi_cuti(){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/ppoh/vakomodasi_cuti'
        	);
        	$this->load->view('pages/pindex/tindex', $data);
        }

        public function table_akomodasi_cuti(){
            $budget_poh = $this->mod_budget->get_budget_poh();
            $data       = array();
            $no         = $this->pregRepn($this->input->post('start'));

            foreach ($budget_poh as $field) {
                $no++;
                $row = array();

                $row[]  = $no;
                $row[]  = $field->poh;
                $row[]  = $field->site;
                $row[]  = $this->rupiah($field->uang_transport);
                $row[]  = $this->rupiah($field->uang_makan);
                $row[]  = '
                    <button class="btn btn-xs btn-primary btn-flat text-center" data-toggle="modal" data-target="#request-vendor-modal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-xs btn-danger btn-flat text-center" data-toggle="modal" data-target="#request-vendor-modal"><i class="far fa-trash-alt"></i></button>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_budget->count_all_budget_poh(),
                "recordsFiltered" => $this->mod_budget->count_filtered_budget_poh(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function akomodasi_dinas(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/ppoh/vakomodasi_dinas'
            );
            $this->load->view('pages/pindex/tindex', $data);
        }

        public function table_akomodasi_dinas(){
            $budget_poh = $this->mod_budget->get_akomodasi_dinas();
            $data       = array();
            $no         = $this->pregRepn($this->input->post('start'));

            foreach ($budget_poh as $field) {
                $no++;
                $row = array();

                $row[]  = $no;
                $row[]  = $field->site_asal;
                $row[]  = $field->site_tujuan;
                $row[]  = $this->rupiah($field->uang_transport);
                $row[]  = $this->rupiah($field->uang_makan);
                $row[]  = '
                    <button class="btn btn-xs btn-primary btn-flat text-center" data-toggle="modal" data-target="#request-vendor-modal"><i class="far fa-edit"></i></button>
                    <button class="btn btn-xs btn-danger btn-flat text-center" data-toggle="modal" data-target="#request-vendor-modal"><i class="far fa-trash-alt"></i></button>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_budget->count_all_akomodasi_dinas(),
                "recordsFiltered" => $this->mod_budget->count_filtered_akomodasi_dinas(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>