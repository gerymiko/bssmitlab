<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class System extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['msystem/mod_system', 'mglobal/mod_global']);
            if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null){
                redirect('logisisse');
            } else {
                $changePass = $this->mod_global->get_change_password($this->session->userdata('id_user'));
                if ($changePass == 'false') {
                    redirect('menu/site');
                } else {
                    $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('master_system'));
                    if ($this->accessRights==null){
                        show_404();exit();
                    } elseif ($this->accessRights!=null && $this->accessRights->site !== $this->uri->segment(3) || $this->accessRights->status_active !== 1){
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/site');
                    } elseif ($this->accessRights!=null && $this->accessRights->read !== 1 || $this->accessRights->status_active !== 1){
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/dashboard/'.$this->uri->segment(3));
                    }
                }
            }
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function master_system($site){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/psystem/vsystem',
                'topmenu' => 'pages/ptopbar/vtopbar',
                'sidemenu' => $this->mod_global->sidemenu($this->accessRights->id_user, $site),
                'accessRights' => $this->accessRights,
                'css_script' => array(
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

        public function table_system(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $system = $this->mod_system->get_system($length, $start);

            foreach ($system as $field){
                if ($field->status_active == 1) {
                    $status_active = '<span class="label bg-green">Active</span>';
                } else {
                    $status_active = '<span class="label bg-gray">Non-active</span>';
                }
                if ($this->accessRights->id_level == 1) {
                    $btn = '
                        <a data-target="#modal-edit-system" data-tooltip="Edit" data-toggle="modal" class="btn btn-xs bg-gray" data-id="'.$this->my_encryption->encode($field->id).'" data-desc="'.$field->description.'" data-name="'.$field->name.'" data-code="'.$field->code.'" data-active="'.$field->status_active.'" ><i class="fas fa-pen f10"></i></a>
                        <a class="btn btn-xs bg-red" data-tooltip="Deactivated" onclick="removeData(\''.$this->my_encryption->encode($field->id).'\', \''.$field->code.'\');"><i class="fas fa-times"></i></a>';
                } else {
                    $btn = '<a data-target="#modal-edit-system" data-tooltip="Edit" data-toggle="modal" class="btn btn-xs bg-gray" data-id="'.$field->id.'" data-name="'.$field->name.'" data-code="'.$field->code.'" data-active="'.$field->status_active.'" ><i class="fas fa-pen f10"></i></a>';
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['code']   = $field->code;
                $row['name']   = $field->name;
                $row['desc']   = $field->description;
                $row['status'] = $status_active;
                $row['detail'] = $btn;
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_system->count_all_system(),
                "recordsFiltered" => $this->mod_system->count_filtered_system(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function save_add_system($site){
            if ($this->pregReps($this->input->post('code'))==null || $this->pregReps($this->input->post('name'))==null || $this->pregReps($this->input->post('desc'))==null || $this->pregRepn($this->input->post('status'))==null ){
                echo "Error Log";
                exit();
            }
            if ($this->accessRights->create !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";
                exit();
            }
            $code = $this->pregReps($this->input->post('code'));
            $getSysReg = $this->mod_system->get_system_registered($code);
            if ($getSysReg !== false) {
                echo "registered";
                exit();
            }
            $data = array(
                'code'          => $code,
                'name'          => $this->pregReps($this->input->post('name')),
                'description'   => $this->pregReps($this->input->post('desc')),
                'status_active' => $this->pregRepn($this->input->post('status'))
            );
            $saveSys = $this->mod_global->insert_all('mst_system', $data);
            if ($saveSys == true) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add new system : '.$code,
                    'ip_address' => $this->input->ip_address(),
                    'input_time' => date("Y-m-d H:i:s")
                );
                $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLogUser == true) {
                    echo "Success";
                } else {
                    echo "Error Log";
                }
            } else {
                echo "Error Sys";
            }
        }

        public function save_edit_system($site){
            if ($this->pregReps($this->input->post('id_system'))==null || $this->pregReps($this->input->post('code'))==null || $this->pregReps($this->input->post('name'))==null || $this->pregReps($this->input->post('desc'))==null || $this->pregRepn($this->input->post('status'))==null ){
                echo "Error";
                exit();
            }
            if ($this->accessRights->update !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";
                exit();
            }
            $id_system = $this->my_encryption->decode($this->pregReps($this->input->post('id_system')));
            $data = array(
                'code' => $this->pregReps($this->input->post('code')),
                'name' => $this->pregReps($this->input->post('name')),
                'description' => $this->pregReps($this->input->post('desc')),
                'status_active' => $this->pregRepn($this->input->post('status'))
            );
            $editSys = $this->mod_global->edit_all('id', $id_system, 'mst_system', $data);
            if ($editSys == true){
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Edit system : '.$this->pregReps($this->input->post('code')),
                    'ip_address' => $this->input->ip_address(),
                    'input_time' => date("Y-m-d H:i:s")
                );
                $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLogUser == true){
                    echo "Success";
                } else {
                    echo "Error Log";
                    exit();
                }
            } else {
                echo "Error Sys";
                exit();
            }
        }

        public function delete_system($site){
            if ($this->accessRights->delete !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $code = $this->pregReps($this->input->post('code'));
            $delete = array('status_active' => 0);
            $isDelete = $this->mod_global->edit_all('id', $id, 'mst_system', $delete);
            if ($isDelete == true){
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Delete system : '.$code,
                    'ip_address' => $this->input->ip_address(),
                    'input_time' => date("Y-m-d H:i:s")
                );
                $saveLogUser = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLogUser == true) {
                    echo "Success";
                } else {
                    echo "Error Log";
                }
            } else {
                echo "Error Del";
            }
        }

    }
?>