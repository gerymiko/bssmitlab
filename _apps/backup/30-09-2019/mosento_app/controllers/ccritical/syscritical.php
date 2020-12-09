<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syscritical extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null && $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mcritical/mod_critical']);
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
                'content' => 'pages/pcritical/vcritical',
                'today_critical' => $this->mod_critical->count_all_critical_unit_today(),
                'all_critical'   => $this->mod_critical->count_all_critical_unit()
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_critical_unit(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $critical_unit = $this->mod_critical->get_critical_unit($length, $start);

            foreach ($critical_unit as $field){
                if (date("d-m-Y", strtotime($field->tgl)) == date("d-m-Y")) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['unit']     = $field->unit;
                $row['date']     = date("d-m-Y", strtotime($field->tgl)).' '.$today_notif;
                $row['time']     = date("H:i A", strtotime($field->tgl));
                $row['value']    = (float)number_format($field->value, 2, '.', '');
                $row['messages'] = $field->ket;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_critical->count_all_critical_unit(),
                "recordsFiltered" => $this->mod_critical->count_filtered_critical_unit(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>