<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmodule extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mmodule/mod_module', 'mglobal/mod_global']);
            if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null) {
                redirect('logisisse');
            } else {
				$this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('master_system_module'));
                if ($this->accessRights==null){
                    show_404();exit();
                } elseif ($this->accessRights!=null && $this->accessRights->site !== $this->uri->segment(3) || $this->accessRights->status_active !== 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/site');
                } elseif ($this->accessRights!=null && $this->accessRights->read !== 1 || $this->accessRights->status_active !== 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->uri->segment(3));
                }
            }
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function master_system_module($site){
            $data = array(
                'header'      => 'pages/ext/header',
                'footer'      => 'pages/ext/footer',
                'content'     => 'pages/pmodule/vmodule',
                'topmenu'     => 'pages/ptopbar/vtopbar',
                'sidemenu'    => $this->mod_global->sidemenu($this->accessRights->id_user, $site),
                'list_system' => $this->mod_module->list_system(),
                'accessRights'  => $this->accessRights,
                'css_script'  => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/buttons.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/select2/dist/css/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/dataTables.buttons.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/buttons.html5.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/select2/dist/js/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_module_config(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $module_config = $this->mod_module->get_module_config($length, $start);
            foreach ($module_config as $field){
                if ($field->status_active == 1) {
                    $status_active = '<span class="label bg-green">Active</span>';
                } else {
                    $status_active = '<span class="label bg-gray">Non-active</span>';
                }
                if ($this->accessRights->id_level == 1){
                    $btn = '
                        <a data-target="#modal-edit-module" data-tooltip="Edit" data-toggle="modal" class="btn btn-xs bg-gray" data-id="'.$this->my_encryption->encode($field->id).'" data-name="'.$field->name.'" data-alias="'.$field->alias.'" data-desc="'.$field->description.'" data-active="'.$field->status_active.'" ><i class="fas fa-pen f10"></i></a>
                        <a class="btn btn-xs bg-red" data-tooltip="Delete" onclick="removeData(\''.$this->my_encryption->encode($field->id).'\', \''.$field->name.'\');"><i class="fas fa-times"></i></a>';
                } else {
                    $btn = '<a data-target="#modal-edit-module" data-tooltip="Edit" data-toggle="modal" class="btn btn-xs bg-gray" data-id="'.$this->my_encryption->encode($field->id).'" data-name="'.$field->name.'" data-alias="'.$field->alias.'" data-desc="'.$field->description.'" data-active="'.$field->status_active.'" ><i class="fas fa-pen f10"></i></a>';
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['name']   = $field->name;
                $row['alias']  = $field->alias;
                $row['desc']   = $field->description;
                $row['status'] = $status_active;
                $row['detail'] = $btn;
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_module->count_all_module_config(),
                "recordsFiltered" => $this->mod_module->count_filtered_module_config(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function save_add_module($site){
            if ($this->accessRights->create !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";
                exit();
            }
            $modname = $this->pregReps($this->input->post('module_name'));
            $id_system = $this->pregRepn($this->input->post('module_system'));
            $getModReg = $this->mod_module->get_module_registered($modname, $id_system);
            if ($getModReg !== false) {
                echo "register";
                exit();
            }
            $data = array(
                'id_system'     => $id_system,
                'name'          => $modname,
                'description'   => $this->pregReps($this->input->post('module_desc')),
                'alias'         => $this->pregReps($this->input->post('module_alias')),
                'status_active' => $this->pregRepn($this->input->post('module_status')),
                'isDelete'      => 0
            );
            $saveMod = $this->mod_global->insert_all('mst_system_module', $data);
            if ($saveMod == true) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add new module : '.$this->input->post('module_name'),
                    'ip_address' => $this->input->ip_address(),
                    'input_time' => date("Y-m-d H:i:s")
                );
                $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLogUser == true) {
                    echo "Success";
                } else {
                    echo "Error Log";
                    exit();
                }
            } else {
                echo "Error Mod";
                exit();
            } 
        }

        public function save_edit_module($site){
            if ($this->accessRights->update !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";
                exit();
            } else {
                $id_module = $this->my_encryption->decode($this->pregReps($this->input->post('id_module')));
                $data = array(
                    'name'          => $this->pregReps($this->input->post('module_name')),
                    'description'   => $this->pregReps($this->input->post('module_desc')),
                    'alias'         => $this->pregReps($this->input->post('module_alias')),
                    'status_active' => $this->pregRepn($this->input->post('module_status'))
                );
                $editMod = $this->mod_global->edit_all('id', $id_module, 'mst_system_module', $data);
                if ($editMod == true) {
                    $dataLog = array(
                        'id_user'    => $this->accessRights->id_user,
                        'id_module'  => $this->accessRights->id_module,
                        'logs'       => 'Edit module : '.$this->input->post('module_name'),
                        'ip_address' => $this->input->ip_address(),
                        'input_time' => date("Y-m-d H:i:s")
                    );
                    $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                    if ($saveLogUser == true) {
                        echo "Success";
                    } else {
                        echo "Error Log";
                        exit();
                    }
                } else {
                    echo "Error Mod";
                    exit();
                }
            }
        }

        public function delete_module($site){
            if ($this->accessRights->delete !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";
                exit();
            } else {
                $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
                $name = $this->pregReps($this->input->post('name'));
                $delete = array('isDelete' => 1);
                $isDelete = $this->mod_global->edit_all('id', $id, 'mst_system_module', $delete);
                if ($isDelete == true){
                    $dataLog = array(
                        'id_user'    => $this->accessRights->id_user,
                        'id_module'  => $this->accessRights->id_module,
                        'logs'       => 'Delete module : '.$name,
                        'ip_address' => $this->input->ip_address(),
                        'input_time' => date("Y-m-d H:i:s")
                    );
                    $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                    if ($saveLogUser == true) {
                        echo "Success";
                    } else {
                        echo "Error Log";
                        exit();
                    }
                } else {
                    echo "Error Del";
                    exit();
                }
            }
        }

    }
?>