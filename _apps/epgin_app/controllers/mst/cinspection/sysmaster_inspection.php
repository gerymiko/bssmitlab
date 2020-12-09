<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmaster_inspection extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('master_inspeksi'));
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
            $this->load->model(['mst/minspection/mod_master_inspection']);
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

        public function master_inspeksi($site){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/mst/pinspection/vmaster_inspection',
                'accessRights' => $this->accessRights,
                'list_site' => $this->mod_global->list_site(),
                'list_inspection' => $this->mod_master_inspection->list_inspection($site),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_inspection_hdr($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_inspection->get_data_hdr($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-inspection-hdr" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['code']  = $field->ins_code;
                $row['name']  = $field->inspection_name;
                $row['type']   = $field->type;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master_inspection->count_all_hdr($site),
                "recordsFiltered" => $this->mod_master_inspection->count_filtered_hdr($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_inspection_dtl($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_inspection->get_data_dtl($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-inspection-dtl" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['ins_code']  = $field->ins_code;
                $row['inspection_name']  = $field->inspection_name;
                $row['type']   = $field->type;
                $row['itm_code'] = $field->itm_code;
                $row['inspection_item'] = $field->inspection_item;
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master_inspection->count_all_dtl($site),
                "recordsFiltered" => $this->mod_master_inspection->count_filtered_dtl($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>