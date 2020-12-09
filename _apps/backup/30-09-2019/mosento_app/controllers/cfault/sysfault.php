<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfault extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null && $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mfault/mod_fault']);
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function index(){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/ptopbar/vtopbar',
                'content' => 'pages/pfault/vfault',
                'today_fault' => $this->mod_fault->count_all_fault_unit_today(),
                'all_fault'   => $this->mod_fault->count_all_fault_unit()
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_fault_unit(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $fault_unit = $this->mod_fault->get_fault_unit($length, $start);
            foreach ($fault_unit as $field){
                if (date("d-m-Y", strtotime($field->fromJam)) == date("d-m-Y") ) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $start++;
                $row            = array();
                $row['no']      = $start;
                $row['unit']    = $field->nolambung;
                $row['fromhm']  = number_format(($field->fromHM / 10),2,",",".");
                $row['tohm']    = number_format(($field->toHM / 10),2,",",".");
                $row['fromjam'] = ($field->fromJam == '1970-01-01 08:00:00.000') ? 'Error Time' : date('d-m-Y H:i A', strtotime($field->fromJam)).' '.$today_notif;
                $row['tojam']   = ($field->toJam == '1970-01-01 08:00:00.000') ? 'Error Time' : date('d-m-Y H:i A', strtotime($field->toJam));
                $row['attempt'] = $field->count.' times';
                $row['info']    = $this->pregReps($field->ket);
                $row['name']    = $this->pregReps($field->nama);
                $data[]         = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_fault->count_all_fault_unit(),
                "recordsFiltered" => $this->mod_fault->count_filtered_fault_unit(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>