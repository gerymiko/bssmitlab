<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysunit extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('master_unit'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/site');
                } elseif ($this->accessRights!=null && $this->accessRights->read != 1 || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                } elseif ($this->accessRights->id_level != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                }
            }
            $this->load->model(['munit/mod_unit']);
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

        public function master_unit($site){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/punit/vunit',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_unit($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $site = $this->mod_unit->get_unit($length, $start);
            foreach ($site as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-unit" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                if ($field->lastupdate == "1990-01-01 00:00:00.000") {
                    $lastupdate = "-";
                } else {
                    $lastupdate = '<span class="hidden">'.strtotime($field->lastupdate).'</span>'.$this->viewDate($field->lastupdate);
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['unit']   = $field->unit;
                $row['type']   = $field->type_unit;
                $row['sn']     = $field->serialnumber;
                $row['hull']   = $field->nolambung;
                $row['update'] = $lastupdate;
                $row['status'] = ($field->status == 1 ) ? '<span class="text-green">Active</span>' : '<span class="text-red">Not Active</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_unit->count_all(),
                "recordsFiltered" => $this->mod_unit->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>