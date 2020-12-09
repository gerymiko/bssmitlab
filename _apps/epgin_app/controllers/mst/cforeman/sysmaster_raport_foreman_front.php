<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmaster_raport_foreman_front extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('master_raport_foreman_front'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('logout');
                } elseif ($this->accessRights!=null && $this->accessRights->readx != 1 || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('page/welcome/'.$this->accessRights->site);
                } elseif ($this->accessRights->id_level != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('page/welcome/'.$this->accessRights->site);
                }
            }
            $this->load->model(['mst/mforeman/mod_master_raport_foreman_front']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("d-m-Y H:i:s", strtotime($date));
        }

        public function master_raport_foreman_front($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_param' => $this->mod_master_raport_foreman_front->list_parameter(),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/mst/pforeman/vmaster_raport_foreman_front',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_raport_foreman_front_hdr($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_raport_foreman_front->get_data_hdr($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-parameter-hdr" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['parameter']  = $field->parameter;
                $row['keterangan'] = $field->keterangan;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master_raport_foreman_front->count_all_hdr($site),
                "recordsFiltered" => $this->mod_master_raport_foreman_front->count_filtered_hdr($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_raport_foreman_front_dtl($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_raport_foreman_front->get_data_dtl($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-parameter-hdr" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['parameter']   = $field->keterangan;
                $row['batas_atas']  = $field->batas_atas;
                $row['batas_bawah'] = $field->batas_bawah;
                $row['dynamic'] = $field->dynamic_value;
                $row['nilai']   = $field->nilai;
                $row['status']  = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master_raport_foreman_front->count_all_dtl($site),
                "recordsFiltered" => $this->mod_master_raport_foreman_front->count_filtered_dtl($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>