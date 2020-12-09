<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmaster_event extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('master_event'));
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
            $this->load->model(['mst/mevent/mod_master_event']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,:]/','', $string);
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

        public function master_event($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'list_event' => $this->mod_master_event->list_event($site),
                'content' => 'pages/mst/pevent/vmaster_event',
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

        public function table_event($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_event->get_data_event($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit-event" data-tooltip="Edit" data-id_event="'.$this->my_encryption->encode($field->id).'" data-nama="'.$field->nama.'" data-urut="'.$field->urut.'" data-jam_mulai_ds="'.$this->viewTime($field->jam_mulai_ds).'" data-jam_selesai_ds="'.$this->viewTime($field->jam_selesai_ds).'" data-jam_mulai_ns="'.$this->viewTime($field->jam_mulai_ds).'" data-jam_selesai_ns="'.$this->viewTime($field->jam_selesai_ns).'" data-active="'.$field->status_active.'"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['nama']  = $field->nama;
                $row['urut'] = $field->urut;
                $row['jam_mulai_ds'] = $this->viewTime($field->jam_mulai_ds);
                $row['jam_selesai_ds'] = $this->viewTime($field->jam_selesai_ds);
                $row['jam_mulai_ns'] = $this->viewTime($field->jam_mulai_ns);
                $row['jam_selesai_ns'] = $this->viewTime($field->jam_selesai_ns);
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master_event->count_all($site),
                "recordsFiltered" => $this->mod_master_event->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_event_level($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_event->get_data_event_level($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-event-level" data-tooltip="Edit" data-id_event_level="'.$this->my_encryption->encode($field->id).'" data-id_event_edit="'.$field->id_event.'" data-urut_level="'.$field->urut.'" data-notif="'.$field->notif.'" data-toleransi_waktu="'.$field->toleransi_waktu.'" data-idx="'.$field->idx.'" data-active_level="'.$field->status_active.'"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['event']  = $field->event;
                $row['urut'] = $field->urut;
                $row['notif'] = $field->notif;
                $row['toleransi_waktu'] = $field->toleransi_waktu;
                $row['idx'] = $field->idx;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master_event->count_all_level($site),
                "recordsFiltered" => $this->mod_master_event->count_filtered_level($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_event($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'nama' => $this->pregReps($this->input->post('nama')),
                'urut' => $this->pregReps($this->input->post('urut')),
                'jam_mulai_ds' => $this->pregReps($this->input->post('jam_mulai_ds')),
                'jam_selesai_ds' => $this->pregReps($this->input->post('jam_selesai_ds')),
                'jam_mulai_ns' => $this->pregReps($this->input->post('jam_mulai_ns')),
                'jam_selesai_ns' => $this->pregReps($this->input->post('jam_selesai_ns')),
                'site' => $site,
            );
            $Save = $this->mod_global->insert_all('mst_event', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add event Name : '.$this->pregReps($this->input->post('nama')).', onsite : '.$site,
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

        public function save_edit_event($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_event')));
            $data = array(
                'nama' => $this->pregReps($this->input->post('nama')),
                'urut' => $this->pregReps($this->input->post('urut')),
                'jam_mulai_ds' => $this->pregReps($this->input->post('jam_mulai_ds')),
                'jam_selesai_ds' => $this->pregReps($this->input->post('jam_selesai_ds')),
                'jam_mulai_ns' => $this->pregReps($this->input->post('jam_mulai_ns')),
                'jam_selesai_ns' => $this->pregReps($this->input->post('jam_selesai_ns')),
                'status_active' => $this->pregRepn($this->input->post('active'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_event', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes event ID : '.$id.', onsite : '.$site,
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

        public function save_add_event_level($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_event' => $this->pregReps($this->input->post('id_event')),
                'urut' => $this->pregReps($this->input->post('urut')),
                'notif' => $this->pregReps($this->input->post('notif')),
                'toleransi_waktu' => $this->pregReps($this->input->post('toleransi_waktu')),
                'idx' => $this->pregReps($this->input->post('idx'))
            );
            $Save = $this->mod_global->insert_all('mst_event_level', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add event level Name : '.$this->pregReps($this->input->post('notif')).', onsite : '.$site,
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

        public function save_edit_event_level($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $data = array(
                'id_event' => $this->pregReps($this->input->post('id_event')),
                'urut' => $this->pregReps($this->input->post('urut')),
                'notif' => $this->pregReps($this->input->post('notif')),
                'toleransi_waktu' => $this->pregReps($this->input->post('toleransi_waktu')),
                'idx' => $this->pregReps($this->input->post('idx')),
                'status_active' => $this->pregRepn($this->input->post('active'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_event_level', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes event level ID : '.$id.', onsite : '.$site,
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