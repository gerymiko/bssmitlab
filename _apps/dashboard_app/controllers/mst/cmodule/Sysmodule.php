<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmodule extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('master_module'));
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
            $this->load->model(['mst/mmodule/mod_module']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function master_modul($site){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site' => $this->mod_global->list_site(),
                'list_system' => $this->mod_module->list_system(),
                'content' => 'pages/mst/pmodule/vmodule',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/dashboard/vendor/bs-datatables/css/responsive.dataTables.min.css"/>',
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/dashboard/vendor/bs-datatables/js/dataTables.responsive.min.js"></script>',
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_module($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $module = $this->mod_module->get_data($length, $start);
            foreach ($module as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '
                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--raised mdl-js-ripple-effect" data-toggle="modal" data-target="#modal-edit-module" data-id_module="'.$this->my_encryption->encode($field->id_module).'" data-id_system="'.$field->id_system.'" data-name="'.$field->module_name.'" data-alias="'.$field->alias.'" data-desc="'.$field->description.'" data-active="'.$field->status_active.'" data-type="'.$field->type.'" data-urut="'.$field->urut.'">
                        <i class="material-icons f18">create</i>
                    </button>
                    <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--raised mdl-js-ripple-effect button--colored-red" id="dd'.$field->id_module.'" onclick="removeData(\''.$this->my_encryption->encode($field->id_module).'\', \''.$field->alias.'\');" >
                        <i class="material-icons f18">close</i>
                    </button>
                    ';
                } else {
                    $btn = '
                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                            <i class="material-icons f18">do_not_disturb_alt</i>
                        </button>
                    ';
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['system'] = $field->desc_system;
                $row['module'] = $field->module_name;
                $row['alias']  = $field->alias;
                $row['desc']   = $field->description;
                $row['order']   = $field->urut;
                $row['active'] = ($field->status_active == 1 ) ? 'Active' : '<span class="text-red">Inactive</span>';
                $row['action'] = $btn;
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_module->count_all(),
                "recordsFiltered" => $this->mod_module->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_module($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_system' => $this->pregRepn($this->input->post('id_system')),
                'name' => $this->pregReps($this->input->post('name')),
                'alias' => $this->pregReps($this->input->post('alias')),
                'description' => $this->pregReps($this->input->post('desc')),
                'type' => $this->pregReps($this->input->post('type')),
                'icon' => 'web',
                'urut' => $this->pregRepn($this->input->post('urut'))
            );
            $Save = $this->mod_global->insert_all('master_system_module', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add module Name : '.$this->pregReps($this->input->post('name')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_module($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id_module = $this->my_encryption->decode($this->pregReps($this->input->post('id_module')));
            $data = array(
                'id_system' => $this->pregRepn($this->input->post('id_system')),
                'name' => $this->pregReps($this->input->post('name')),
                'alias' => $this->pregReps($this->input->post('alias')),
                'description' => $this->pregReps($this->input->post('desc')),
                'status_active' => $this->pregRepn($this->input->post('active')),
                'type' => $this->pregReps($this->input->post('type')),
                'urut' => $this->pregRepn($this->input->post('urut'))
            );
            $Edit = $this->mod_global->edit_all('id_module', $id_module, 'master_system_module', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes module ID : '.$id_module.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function delete_module($site){
            if ($this->accessRights->deletex !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";exit();
            } else {
                $id_module = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
                $name = $this->pregReps($this->input->post('name'));
                $data = array('isdelete' => 0, 'status_active' => 0);
                $isDelete = $this->mod_global->edit_all('id_module', $id_module, 'master_system_module', $data);
                if ($isDelete == true){
                    $dataLog = array(
                        'id_user'    => $this->accessRights->id_user,
                        'id_module'  => $this->accessRights->id_module,
                        'logs'       => 'Delete module ID : '.$id_module.', onsite : '.$site,
                        'ip_address' => $this->input->ip_address()
                    );
                    $saveLog = $this->mod_global->insert_all('master_user_log', $dataLog);
                    if ($saveLog == true) {
                        echo "Success";
                    } else {
                        echo "ErrorLog";exit();
                    }
                } else {
                    echo "ErrorDel";exit();
                }
            }
        }
    }
?>