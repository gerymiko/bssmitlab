<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmaster extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null && $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mmaster/mod_master']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,\/]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function index(){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/ptopbar/vtopbar',
                'content' => 'pages/pmaster/vmaster',
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_variable(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $variable = $this->mod_master->get_variable($length, $start);
            foreach ($variable as $field){
                if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2 ) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-variable" data-nama="'.$field->nama.'" data-alias="'.$field->alias.'" data-critical="'.$field->criticalValue.'" data-caution="'.$field->cautionValue.'" data-measure="'.$field->ket.'" data-status="'.$field->status.'" data-rate="'.floatval($field->value).'" data-operation="'.$field->operation.'" data-code="'.$field->code.'" >Edit</button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default"><i class="fas fa-check-double"></i></button>';
                }
                $start++;
                $row              = array();
                $row['no']        = $start;
                $row['variable']  = $field->nama;
                $row['alias']     = $field->alias;
                $row['critical']  = $field->criticalValue;
                $row['caution']   = $field->cautionValue;
                $row['measures']  = $field->ket;
                $row['active']    = ($field->status == 1 ) ? '<span class="label label-success">Active</span>' : '<span class="label label-danger">Non-Active</span>';
                $row['rate']      = floatval($field->value);
                $row['operation'] = $field->operation;
                $row['action']    = $btn;
                $data[]           = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master->count_all_variable(),
                "recordsFiltered" => $this->mod_master->count_filtered_variable(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_edit_variable(){
            $alias = $this->pregReps($this->input->post('alias'));
            $code  = $this->pregRepn($this->input->post('code'));
            $data  = array();
            $dataVar = array(
                'cautionValue'  => $this->pregReps($this->input->post('caution')),
                'criticalValue' => $this->pregReps($this->input->post('critical'))
            );
            $editVar = $this->mod_master->edit_variable($alias, $dataVar);
            if ($editVar == true) {
                $dataSatuan = array(
                    'ket'       => $this->pregReps($this->input->post('measure')),
                    'value'     => $this->pregReps($this->input->post('rate')),
                    'operation' => $this->pregReps($this->input->post('operation')),
                    'status'    => $this->pregRepn($this->input->post('status'))
                );
                $editSatuan = $this->mod_master->edit_satuan($code, $dataSatuan);
                if ($editSatuan == true) {
                    $data['response'] = true;
                    echo json_encode($data);
                } else {
                    echo "Error Satuan";
                    exit();
                }
            } else {
                echo "Error Variable";
                exit();
            }
        }
    }
?>