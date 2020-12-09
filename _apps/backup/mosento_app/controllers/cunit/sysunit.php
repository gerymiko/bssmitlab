<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysunit extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['munit/mod_unit', 'mglobal/mod_global']);
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9-_.]/','', $string);
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
                'content' => 'pages/punit/vunit',
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_unit(){
            $unit = $this->mod_unit->get_unit();
            $data = array();
            if($this->pregRepn($this->input->post('start')) !== null && $this->pregRepn($this->input->post('draw')) !== null ) {   
                $no   = $this->pregRepn($this->input->post('start'));
                $draw = $this->pregRepn($this->input->post('draw'));
            } else { exit(); }
            foreach ($unit as $field){

                if ( $field->status == 1 ){
                    $status = '<i class="fas fa-circle text-green" data-toggle="tooltip" title="Active"></i>';
                } else {
                    $status = '<i class="fas fa-circle text-red" data-toggle="tooltip" title="Nonactive"></i>';
                }

                if ($this->session->userdata('level') == 1 ) {
                    $btn = '<button class="btn bg-red btn-xs" onclick="deleteUnit(\''.$this->my_encryption->encode($field->serialnumber).'\');" data-toggle="tooltip" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        <button class="btn bg-gray btn-xs" onclick="deactivatedUnit(\''.$this->my_encryption->encode($field->serialnumber).'\');" data-toggle="tooltip" title="Deactivated"><i class="fas fa-times text-red"></i></button>
                        <button class="btn bg-green btn-xs" onclick="activatedUnit(\''.$this->my_encryption->encode($field->serialnumber).'\');" data-toggle="tooltip" title="Activated"><i class="fas fa-check"></i></button>
                    ';
                } elseif($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2){
                    $btn = '<button class="btn bg-gray btn-xs" onclick="deactivatedUnit(\''.$this->my_encryption->encode($field->serialnumber).'\');" data-toggle="tooltip" title="Deactivated"><i class="fas fa-times text-red"></i></button>
                        <button class="btn bg-green btn-xs" onclick="activatedUnit(\''.$this->my_encryption->encode($field->serialnumber).'\');" data-toggle="tooltip" title="Activated"><i class="fas fa-check"></i></button>
                    ';
                } else {
                    $btn = '<button class="btn btn-xs bg-gray"><i class="fas fa-check-double"></i></button>';
                }

                $no++;
                $row                 = array();
                $row['no']           = $no;
                $row['unit']         = $field->unit;
                $row['type']         = $field->type_unit;
                $row['serialnumber'] = $field->serialnumber;
                $row['nolambung']    = $field->nolambung;
                $row['status']       = $status;
                $row['action']       = $btn;
                $data[]              = $row;
            };
            $output = array(
                "draw"            => $draw,
                "recordsTotal"    => $this->mod_unit->count_all_unit(),
                "recordsFiltered" => $this->mod_unit->count_filtered_unit(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function delete_unit(){
            $sn_post = $this->pregReps($this->input->post('sn'));
            $sn      = $this->my_encryption->decode($sn_post);
            $data    = array('isDelete' => 1, 'status' => 0);
            $checkUnit = $this->mod_unit->check_unit($sn);
            if ($checkUnit->isDelete == 1) {
                echo "deleted";
                exit();
            }
            $delete_unit = $this->mod_unit->edit_unit($sn, $data);
            if ($delete_unit = true) {
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Unit',
                    'logs_aktifitas'  => 'Hapus',
                    'logs_keterangan' => 'Hapus data untuk unit dengan SN : '.$sn,
                    'logs_user_id'    => $this->session->userdata('nik'),
                    'logs_username'   => $this->session->userdata('nik'),
                    'logs_user_name'  => $this->session->userdata('nama'),
                    'logs_website'    => 'MOSENTO'
                );
                $this->mod_global->insert_all('web_logs', $datalogs);
            }
            echo json_encode($delete_unit);
        }

        public function deactivated_unit(){
            $sn_post = $this->pregReps($this->input->post('sn'));
            $sn      = $this->my_encryption->decode($sn_post);
            $data    = array( 'status' => 0 );

            $checkUnit = $this->mod_unit->check_unit($sn);
            if ($checkUnit->status == 0) {
                echo "deactivated";
                exit();
            }
            $deactivated_unit = $this->mod_unit->edit_unit($sn, $data);
            if ($deactivated_unit = true) {
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Unit',
                    'logs_aktifitas'  => 'Edit',
                    'logs_keterangan' => 'Menonaktifkan unit dengan SN : '.$sn,
                    'logs_user_id'    => $this->session->userdata('nik'),
                    'logs_username'   => $this->session->userdata('nik'),
                    'logs_user_name'  => $this->session->userdata('nama'),
                    'logs_website'    => 'MOSENTO'
                );
                $this->mod_global->insert_all('web_logs', $datalogs);
            }
            echo json_encode($deactivated_unit);
        }

        public function activated_unit(){
            $sn_post = $this->pregReps($this->input->post('sn'));
            $sn      = $this->my_encryption->decode($sn_post);
            $data    = array( 'status' => 1 );
            $checkUnit = $this->mod_unit->check_unit($sn);
            if ($checkUnit->status == 1) {
                echo "activated";
                exit();
            }
            $activated_unit = $this->mod_unit->edit_unit($sn, $data);
            if ($activated_unit = true) {
                $datalogs = array(
                    'logs_tanggal'    => date('Y-m-d H:i:s'),
                    'logs_ip'         => $this->input->ip_address(),
                    'logs_modul'      => 'Unit',
                    'logs_aktifitas'  => 'Edit',
                    'logs_keterangan' => 'Mengaktifkan unit dengan SN : '.$sn,
                    'logs_user_id'    => $this->session->userdata('nik'),
                    'logs_username'   => $this->session->userdata('nik'),
                    'logs_user_name'  => $this->session->userdata('nama'),
                    'logs_website'    => 'MOSENTO'
                );
                $this->mod_global->insert_all('web_logs', $datalogs);
            }
            echo json_encode($activated_unit);
        }

    }
?>