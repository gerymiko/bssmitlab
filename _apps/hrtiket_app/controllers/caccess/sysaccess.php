<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysaccess extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'HR_TIKET') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global']);
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function rupiah($angka){
            return $result = "Rp " . number_format($angka,0,',','.');
        }

        private static function dateIndo($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        private static function timeIndo($time){
            return $result = date("H:i:s", strtotime($time));
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/paccess/vaccess'
            );
            $this->load->view('pages/pindex/tindex', $data);
        }

        public function table_previleges_user(){
            $previlege = $this->mod_invoice->get_previleges_user();
            $data      = array();
            $no        = $this->pregRepn($this->input->post('start'));

            foreach ($previlege as $field) {
                $no++;
                $row              = array();
                $row['no']        = $no;
                $row['nik']       = $field->nik;
                $row['name']      = $field->nama;
                $row['username']  = $field->username;
                $row['previlege'] = $field->previlege;
                $row['action']    = '';
                $data[]           = $row;
            };

            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_invoice->count_all_previleges_user(),
                "recordsFiltered" => $this->mod_invoice->count_filtered_previleges_user(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>