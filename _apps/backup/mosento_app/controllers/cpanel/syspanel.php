<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspanel extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mlogin/mod_login', 'mpanel/mod_panel']);
            ob_start(); # add this
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepsURL($string){ 
            $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function index(){
            $nik  = $this->session->userdata('nik');
        	$data = array(
                'header'               => 'pages/ext/header',
                'footer'               => 'pages/ext/footer',
                'menu'                 => 'pages/ptopbar/vtopbar',
                'content'              => 'pages/phome/vpanel',
                'count_unit'           => $this->mod_panel->count_all_unit(),
                'count_critical_today' => $this->mod_panel->count_all_critical_unit_today(),
                'count_caution_today'  => $this->mod_panel->count_all_caution_unit_today(),
                'count_fault_today'    => $this->mod_panel->count_all_fault_unit_today(),
                'stpass'               => $this->mod_panel->get_status_password($nik),
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function logout(){
            $nik  = $this->session->userdata('nik');
            $data = array( 'is_login' => 0, 'login_update' => date("Y-m-d H:i:s"), 'last_ip' => $this->input->ip_address() );
            $this->mod_login->update_last_login($nik, $data);
            $this->session->unset_userdata('nama');
            $this->session->unset_userdata('nik');
            $this->session->unset_userdata('status');
            $this->session->unset_userdata('tipeapp');
            $this->session->unset_userdata('level');
            session_destroy();
            ob_clean();
            redirect('login');
        }

        public function table_unit_exca(){
            $unit_exca = $this->mod_panel->get_unit_exca();
            $data      = array();
            $no        = $this->pregRepn($this->input->post('start'));

            foreach ($unit_exca as $field){

                if ( $field->status == 1 ){
                    $status = '<i class="fas fa-circle text-green" data-toggle="tooltip" title="Active"></i>';
                } else {
                    $status = '<i class="fas fa-circle text-red" data-toggle="tooltip" title="Nonactive"></i>';
                }

                $sn = $field->serialnumber;

                $no++;
                $row                 = array();
                $row['no']           = $no;
                $row['unit']         = $field->unit;
                $row['serial']       = $field->serialnumber;
                $row['warningfault'] = '<a href="'.site_url().'warning/unit/exca/'.$this->my_encryption->encode($sn).'" class="btn label label-danger f12" data-toggle="tooltip" title="See More">'.$field->nolambung.'</a>';
                $row['status']       = $status;
                $data[]              = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_panel->count_all_unit_exca(),
                "recordsFiltered" => $this->mod_panel->count_filtered_unit_exca(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function table_unit_hd(){
            $unit_hd = $this->mod_panel->get_unit_hd();
            $data    = array();
            $no      = $this->pregRepn($this->input->post('start'));

            foreach ($unit_hd as $field){
                $sn = $field->serialnumber;
                if ( $field->status == 1 ){
                    $status = '<i class="fas fa-circle text-green" data-toggle="tooltip" title="Active"></i>';
                } else {
                    $status = '<i class="fas fa-circle text-red" data-toggle="tooltip" title="Nonactive"></i>';
                }

                if ($this->mod_panel->count_warning_hd($sn) == 0) {
                    $countwarning = '<span class="label label-info f12">No data</span>';
                } else {
                    $countwarning = '';
                }

                if ($this->mod_panel->count_payload_hd($sn) == 0) {
                    $countpayload = '<span class="label label-info f12">No data</span>';
                } else {
                    $countpayload = '';
                }

                $no++;
                $row                 = array();
                $row['no']           = $no;
                $row['unit']         = $field->unit;
                $row['serial']       = $field->serialnumber;
                $row['warningfault'] = '<a href="'.site_url().'warning/unit/hd/'.$this->my_encryption->encode($sn).'" class="btn label label-danger f12" data-toggle="tooltip" title="See More">'.$field->nolambung.'</a> '.$countwarning;
                $row['payload']      = '<a href="'.site_url().'payload/unit/hd/'.$this->my_encryption->encode($sn).'" class="btn label label-primary f12" data-toggle="tooltip" title="See More">'.$field->nolambung.'</a> '.$countpayload;
                $row['status']       = $status;
                $data[]              = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_panel->count_all_unit_hd(),
                "recordsFiltered" => $this->mod_panel->count_filtered_unit_hd(),
                "data"            => $data
            );
            echo json_encode($output);
        }

    }
?>