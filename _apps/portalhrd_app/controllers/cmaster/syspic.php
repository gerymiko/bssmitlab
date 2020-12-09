<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspic extends CI_Controller {

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
            $this->load->model(['mmaster/mod_pic']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function master_pic(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/pmaster/vpic',
                'accessRights' => $this->accessRights,
                'listpic' => $this->mod_pic->list_users(),
                'css_script'  => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_pic(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false); }
            $getdata = $this->mod_pic->get_master_pic($length, $start);
            foreach ($getdata as $field){
                $status  = ($field->pic_status == 1) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Non-Aktif</span>';
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['nik']  = $field->bssID;
                $row['name'] = $field->pic_name;
                $row['position'] = '';
                $row['status']   = $status;
                $row['action']   = '
                    <a class="btn bg-gray btn-xs" data-tooltip="Ubah" data-toggle="modal" data-target="#modal-edit-pic" data-backdrop="static" data-keyboard="false">
                        <i class="fas fa-pen f9"></i>
                    </a>
                    <a class="btn btn-danger btn-xs data-tooltip="NonAktifkan" onClick="removeThis(\''.$this->my_encryption->encode($field->pic_id).'\', \''.$field->pic_name.'\')">
                        <i class="fas fa-user-slash f9"></i>
                    </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_pic->count_all(),
                "recordsFiltered" => $this->mod_pic->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function get_step_selection(){
            $users_id = $this->input->post('opt');
            $getStep = $this->mod_pic->get_step_selection($users_id);
            $stepSelection = $this->mod_pic->step_selection();
            foreach ($stepSelection as $row){
                echo '<div class="checkbox">
                        <label class="hand"><input type="checkbox" name="rs_id[]"';
                            foreach ($getStep as $key){ if($key->rs_name == $row->rs_name){ echo 'checked ';break; }}
                echo ' value="'.$row->rs_id.'">'.$row->rs_name.'</label>
                    </div>';
            }
        }

    }
?>
