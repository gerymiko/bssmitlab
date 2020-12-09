<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syscaution extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mcaution/mod_caution']);
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
                'content' => 'pages/pcaution/vcaution',
                'today_caution' => $this->mod_caution->count_all_caution_unit_today(),
                'all_caution'   => $this->mod_caution->count_all_caution_unit()
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_caution_unit(){
            $caution_unit = $this->mod_caution->get_caution_unit();
            $data      = array();
            $no        = $this->pregRepn($this->input->post('start'));

            foreach ($caution_unit as $field){
                if (date("d-m-Y", strtotime($field->tgl)) == date("d-m-Y") ) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }

                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['unit']     = $field->unit;
                $row['date']     = date("d-m-Y", strtotime($field->tgl)).' '.$today_notif;
                $row['time']     = date("H:i A", strtotime($field->tgl));
                $row['value']    = (float)number_format($field->value, 2, '.', '');
                $row['messages'] = $field->ket;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_caution->count_all_caution_unit(),
                "recordsFiltered" => $this->mod_caution->count_filtered_caution_unit(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>