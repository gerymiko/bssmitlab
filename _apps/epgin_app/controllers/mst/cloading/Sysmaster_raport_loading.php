<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmaster_raport_loading extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('master_raport_loading'));
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
                }
            }
            $this->load->model(['mst/mloading/mod_master_raport_loading']);
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

        private static function viewTime($date){
            return $result = date("H:i:s", strtotime($date));
        }

        public function master_raport_loading($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'list_parameter_hdr' => $this->mod_master_raport_loading->list_parameter_hdr($site),
                'content' => 'pages/mst/ploading/vmaster_raport_loading',
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

        public function table_master_raport_loading_hdr($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_raport_loading->get_data_hdr($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit-raport-loading-hdr" data-tooltip="Edit" data-id_hdr="'.$this->my_encryption->encode($field->id).'" data-parameter="'.$field->parameter.'" data-keterangan="'.$field->keterangan.'" data-site="'.$field->site.'" data-active="'.$field->status_active.'"><i class="fas fa-pen f10"></i></button>';
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
                "recordsTotal"    => $this->mod_master_raport_loading->count_all_hdr($site),
                "recordsFiltered" => $this->mod_master_raport_loading->count_filtered_hdr($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_raport_loading_hdr($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'parameter' => $this->pregReps($this->input->post('parameter')),
                'keterangan' => $this->pregReps($this->input->post('keterangan')),
                'site' => $this->pregReps($this->input->post('site'))
            );
            $Save = $this->mod_global->insert_all('mst_parameter_raport_loading_hdr', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data raport loading hdr Name : '.$this->pregReps($this->input->post('parameter')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_raport_loading_hdr($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id_hdr = $this->my_encryption->decode($this->pregReps($this->input->post('id_hdr')));
            $data = array(
                'parameter' => $this->pregReps($this->input->post('parameter')),
                'keterangan' => $this->pregReps($this->input->post('keterangan')),
                'site' => $this->pregReps($this->input->post('site')),
                'status_active' => $this->pregRepn($this->input->post('active'))
            );
            $Edit = $this->mod_global->edit_all('id', $id_hdr, 'mst_parameter_raport_loading_hdr', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data raport loading hdr ID : '.$id_hdr.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function table_master_raport_loading_dtl($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_raport_loading->get_data_dtl($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit-raport-loading-dtl" data-tooltip="Edit" data-id_dtl="'.$this->my_encryption->encode($field->id).'" data-id_parameter_hdr="'.$field->id_parameter_raport_loading_hdr.'" data-batas_atas="'.$field->batas_atas.'" data-batas_bawah="'.$field->batas_bawah.'" data-dynamic_value="'.$field->dynamic_value.'" data-nilai="'.$field->nilai.'" data-active="'.$field->status_active.'"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['parameter']  = $field->parameter;
                $row['batas_atas'] = $field->batas_atas;
                $row['batas_bawah'] = $field->batas_bawah;
                $row['dynamic_value'] = $field->dynamic_value;
                $row['nilai'] = $field->nilai;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master_raport_loading->count_all_dtl($site),
                "recordsFiltered" => $this->mod_master_raport_loading->count_filtered_dtl($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_raport_loading_dtl($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_parameter_raport_loading_hdr' => $this->pregRepn($this->input->post('id_parameter_hdr')),
                'batas_atas' => floatval($this->pregReps($this->input->post('batas_atas'))),
                'batas_bawah' => floatval($this->pregReps($this->input->post('batas_bawah'))),
                'dynamic_value' => $this->pregReps($this->input->post('dynamic_value')),
                'nilai' => $this->pregReps($this->input->post('nilai'))
            );
            $Save = $this->mod_global->insert_all('mst_parameter_raport_loading_dtl', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data raport loading dtl ID : '.$this->pregReps($this->input->post('id_parameter_hdr')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_raport_loading_dtl($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id_dtl = $this->my_encryption->decode($this->pregReps($this->input->post('id_dtl')));
            $data = array(
                'id_parameter_raport_loading_hdr' => $this->pregRepn($this->input->post('id_parameter_hdr')),
                'batas_atas' => floatval($this->pregReps($this->input->post('batas_atas'))),
                'batas_bawah' => floatval($this->pregReps($this->input->post('batas_bawah'))),
                'dynamic_value' => $this->pregReps($this->input->post('dynamic_value')),
                'nilai' => $this->pregReps($this->input->post('nilai')),
                'status_active' => $this->pregRepn($this->input->post('active'))
            );
            $Edit = $this->mod_global->edit_all('id', $id_dtl, 'mst_parameter_raport_loading_dtl', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data raport loading dtl ID : '.$id_dtl.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }
    }
?>