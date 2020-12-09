<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysperform extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mperform/mod_perform']);
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
            $nik  = $this->session->userdata('nik');
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/ptopbar/vtopbar',
                'content' => 'pages/pperform/vperformance',
                'listmonthyear' => $this->mod_perform->get_select_month_year()
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_mpv_HD465(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $payload = $this->mod_perform->get_mpv_HD465($length, $start);
            foreach ($payload as $field){
                $start++;
                $row            = array();
                $row['no']      = $start;
                $row['nik']     = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']    = ($field->nama == null) ? "-" : $this->pregReps($field->nama);
                $row['unit']    = $field->unit;
                $row['dateper'] = date("d-m-Y H:i A", strtotime($field->tgl));
                $row['bcm']     = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $data[]         = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_perform->count_all_mpv_HD465(),
                "recordsFiltered" => $this->mod_perform->count_filtered_mpv_HD465(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_mpv_HD785(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $payload = $this->mod_perform->get_mpv_HD785($length, $start);
            foreach ($payload as $field){
                $start++;
                $row            = array();
                $row['no']      = $start;
                $row['nik']     = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']    = ($field->nama == null) ? "-" : $this->pregReps($field->nama);
                $row['unit']    = $field->unit;
                $row['dateper'] = date("d-m-Y H:i A", strtotime($field->tgl));
                $row['bcm']     = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $data[]         = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_perform->count_all_mpv_HD785(),
                "recordsFiltered" => $this->mod_perform->count_filtered_mpv_HD785(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_mpv_exca465(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $payload = $this->mod_perform->get_mpv_HD465($length, $start);
            foreach ($payload as $field){
                $start++;
                $row            = array();
                $row['no']      = $start;
                $row['nik']     = ($field->nikoprloader == null && $field->nikoprloader == '') ? "-" : $this->pregRepn($field->nikoprloader);
                $row['name']    = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader);
                $row['unit']    = $field->loader;
                $row['dateper'] = date("d-m-Y H:i A", strtotime($field->tgl));
                $row['bcm']     = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $data[]         = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_perform->count_all_mpv_HD465(),
                "recordsFiltered" => $this->mod_perform->count_filtered_mpv_HD465(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_mpv_exca785(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $payload = $this->mod_perform->get_mpv_HD785($length, $start);
            foreach ($payload as $field){
                $start++;
                $row            = array();
                $row['no']      = $start;
                $row['nik']     = ($field->nikoprloader == null && $field->nikoprloader == '') ? "-" : $this->pregRepn($field->nikoprloader);
                $row['name']    = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader);
                $row['unit']    = $field->loader;
                $row['dateper'] = date("d-m-Y H:i A", strtotime($field->tgl));
                $row['bcm']     = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $data[]         = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_perform->count_all_mpv_HD785(),
                "recordsFiltered" => $this->mod_perform->count_filtered_mpv_HD785(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>