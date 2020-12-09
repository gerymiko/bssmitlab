<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syssite extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('master_site'));
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
            $this->load->model(['mst/msite/mod_site']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function master_site($site){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/mst/psite/vsite',
                'accessRights' => $this->accessRights,
                'list_site' => $this->mod_global->list_site(),
                'list_sitex' => $this->mod_site->list_sitex(),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>',
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>',
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_site($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_site->get_data($length, $start);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="mdl-button mdl-js-button mdl-button--icon mdl-button--raised mdl-js-ripple-effect button--colored-orange" data-toggle="modal" data-target="#modal-edit-site" data-id_site="'.$this->my_encryption->encode($field->id_site).'" data-code="'.$field->code.'" data-name="'.$field->name.'" data-active="'.$field->status_active.'">
                                    <i class="material-icons f18">create</i>
                                </button>';
                } else {
                    $btn = '
                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                            <i class="material-icons f18">do_not_disturb_alt</i>
                        </button>
                        <div class="mdl-tooltip mdl-tooltip--left" data-mdl-for="tt6">
                          Unauthority
                        </div>
                    ';
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['code'] = $field->code;
                $row['name'] = $field->name;
                $row['active'] = ($field->status_active == 1 ) ? 'Active' : '<span class="text-red">Inactive</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_site->count_all(),
                "recordsFiltered" => $this->mod_site->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_site($site){
            if ($this->accessRights->createx !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";
                exit();
            } else {
                if ($this->pregReps($this->input->post('code'))==null || $this->pregReps($this->input->post('name'))==null || $this->pregRepn($this->input->post('status'))==null ){
                    echo "ErrorInput";exit();
                }
                $code = $this->pregReps($this->input->post('code'));
                $name = $this->pregReps($this->input->post('name'));
                $getSiteReg = $this->mod_site->get_site_registered($code, $name);
                if ($getSiteReg !== false) { echo "registered";exit(); }
                $data = array(
                    'code' => $code,
                    'name' => $name,
                    'status_active' => $this->pregRepn($this->input->post('status'))
                );
                $saveSite = $this->mod_global->insert_all('master_site', $data);
                if ($saveSite == true) {
                    $dataLog = array(
                        'id_user'    => $this->accessRights->id_user,
                        'id_module'  => $this->accessRights->id_module,
                        'logs'       => 'Add new site : '.$code.', onsite : '.$site,
                        'ip_address' => $this->input->ip_address()
                    );
                    $saveLogUser = $this->mod_global->insert_all('master_user_log', $dataLog);
                    if ($saveLogUser == true) {
                        echo "Success";
                    } else {
                        echo "Error Log";
                    }
                } else {
                    echo "Error Site";
                }
            }
        }

        public function save_edit_site($site){
            if ($this->pregReps($this->input->post('id_site'))==null || $this->pregReps($this->input->post('code'))==null || $this->pregReps($this->input->post('name'))==null || $this->pregRepn($this->input->post('active'))==null ){
                echo "Error 1";exit();
            }
            if ($this->accessRights->updatex !== 1 || $this->accessRights->status_active !== 1){
                echo "unauthority";exit();
            }
            $id_site = $this->my_encryption->decode($this->pregReps($this->input->post('id_site')));
            $data = array(
                'code' => $this->pregReps($this->input->post('code')),
                'name' => $this->pregReps($this->input->post('name')),
                'status_active' => $this->pregRepn($this->input->post('active'))
            );
            $editSite = $this->mod_global->edit_all('id_site', $id_site, 'master_site', $data);
            if ($editSite == true) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Edit site ID : '.$id_site.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLogUser = $this->mod_global->insert_all('master_user_log', $dataLog);
                if ($saveLogUser == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorSave";exit();
            }
        }

        public function get_name_site($site){
            $code = $this->input->post('opt');
            $getSiteName = $this->mod_site->get_site_name($code);
            if ($getSiteName !== false) {
                echo $data = $getSiteName->Nama;
            } else {
                echo $data = '';
            }
        }
    }
?>