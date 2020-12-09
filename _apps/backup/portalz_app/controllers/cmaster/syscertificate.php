<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syscertificate extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('bssID') == null) {
                redirect('logisisse');
            } else {
                $this->accessRights = $this->mod_global->get_detailed_user($this->session->userdata('users_id'));
                if ($this->accessRights==null) {
                    show_404('', false);
                }
            }
            $this->load->model(['mmaster/mod_cert']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function master_certificate(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'content'  => 'pages/pmaster/vcert',
                'accessRights' => $this->accessRights,
                'css_script' => array(),
                'js_script'  => array(),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_master_certificate(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false); }
            $getdata = $this->mod_cert->get_master_cert($length, $start);
            foreach ($getdata as $field){
                $jabatan = ($field->Nama == null) ? 'Seluruh Jabatan' : $field->Nama;
                $status  = ($field->certificate_status == 1) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Non-Aktif</span>';
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['cert'] = $field->certificate_name;
                $row['position'] = $jabatan;
                $row['status'] = $status;
                $row['action'] = '
                    <a class="btn bg-gray btn-xs" data-tooltip="Ubah" onClick="btn_edit_cond(\''.$this->my_encryption->encode($field->certificate_id).'\')">
                        <i class="fas fa-pen f9"></i>
                    </a>
                    <a class="btn btn-danger btn-xs data-tooltip="Hapus" onClick="removeThis(\''.$this->my_encryption->encode($field->certificate_id).'\', \''.$field->certificate_name.'\')">
                        <i class="fas fa-times"></i>
                    </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_cert->count_all(),
                "recordsFiltered" => $this->mod_cert->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>
