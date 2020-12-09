<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmaster_match_fleet extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('master_matching_fleet'));
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
            $this->load->model(['mst/mfleet/mod_master_match_fleet']);
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

        public function master_matching_fleet($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/mst/pfleet/vmaster_match_fleet',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/select.dataTables.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/dataTables.select.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dragscroll/dragscroll.js"></script>',
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_master_match_fleet($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_master_match_fleet->get_data($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-match-fleet" data-tooltip="Edit" data-id_mfleet="'.$this->my_encryption->encode($field->id).'" data-category_loader="'.$field->category_loader.'" data-category_hauler="'.$field->category_hauler.'" data-distance="'.$field->distance.'" data-capacity="'.$field->capacity.'" data-loading="'.$field->loading.'" data-loaded="'.$field->loaded.'" data-dumping="'.$field->dumping.'" data-empty="'.$field->empty.'" data-spotting="'.$field->spotting.'" data-efisiensi="'.$field->efisiensi.'" data-cycle_time="'.$field->cycle_time.'" data-pdty_jam="'.$field->pdty_jam.'" data-konversi="'.$field->konversi.'" data-pdty_jam_km="'.$field->pdty_jam_km.'" data-keperluan_unit="'.$field->keperluan_unit.'" data-match_factor="'.$field->match_factor.'"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['category_loader'] = $field->category_loader;
                $row['category_hauler'] = $field->category_hauler;
                $row['distance'] = $field->distance;
                $row['capacity'] = $field->capacity;
                $row['loading'] = $field->loading;
                $row['loaded'] = $field->loaded;
                $row['dumping'] = $field->dumping;
                $row['empty'] = $field->empty;
                $row['spotting'] = $field->spotting;
                $row['efisiensi'] = $field->efisiensi;
                $row['cycle_time'] = $field->cycle_time;
                $row['pdty_jam'] = $field->pdty_jam;
                $row['konversi'] = $field->konversi;
                $row['pdty_jam_km'] = $field->pdty_jam_km;
                $row['keperluan_unit'] = $field->keperluan_unit;
                $row['match_factor'] = $field->match_factor;
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_master_match_fleet->count_all($site),
                "recordsFiltered" => $this->mod_master_match_fleet->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_match_fleet($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'category_loader' => $this->pregReps($this->input->post('category_loader')),
                'category_hauler' => $this->pregReps($this->input->post('category_hauler')),
                'distance' => floatval($this->pregReps($this->input->post('distance'))),
                'capacity' => floatval($this->pregReps($this->input->post('capacity'))),
                'loading' => floatval($this->pregReps($this->input->post('loading'))),
                'loaded' => floatval($this->pregReps($this->input->post('loaded'))),
                'dumping' => floatval($this->pregReps($this->input->post('dumping'))),
                'empty' => floatval($this->pregReps($this->input->post('empty'))),
                'spotting' => floatval($this->pregReps($this->input->post('spotting'))),
                'efisiensi' => floatval($this->pregReps($this->input->post('efisiensi'))),
                'cycle_time' => floatval($this->pregReps($this->input->post('cycle_time'))),
                'pdty_jam' => floatval($this->pregReps($this->input->post('pdty_jam'))),
                'konversi' => floatval($this->pregReps($this->input->post('konversi'))),
                'pdty_jam_km' => floatval($this->pregReps($this->input->post('pdty_jam_km'))),
                'keperluan_unit' => intval($this->pregReps($this->input->post('keperluan_unit'))),
                'match_factor' => floatval($this->pregReps($this->input->post('match_factor'))),
                'site' => $site,
            );
            $SaveAdd = $this->mod_global->insert_all('mst_matching_fleet', $data);
            if ($SaveAdd == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Adding match fleet data ID : Last ID, onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorSave";exit();
            }
        }

        public function save_edit_match_fleet($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_mfleet')));
            $data = array(
                'category_loader' => $this->pregReps($this->input->post('category_loader')),
                'category_hauler' => $this->pregReps($this->input->post('category_hauler')),
                'distance' => floatval($this->pregReps($this->input->post('distance'))),
                'capacity' => floatval($this->pregReps($this->input->post('capacity'))),
                'loading' => floatval($this->pregReps($this->input->post('loading'))),
                'loaded' => floatval($this->pregReps($this->input->post('loaded'))),
                'dumping' => floatval($this->pregReps($this->input->post('dumping'))),
                'empty' => floatval($this->pregReps($this->input->post('empty'))),
                'spotting' => floatval($this->pregReps($this->input->post('spotting'))),
                'efisiensi' => floatval($this->pregReps($this->input->post('efisiensi'))),
                'cycle_time' => floatval($this->pregReps($this->input->post('cycle_time'))),
                'pdty_jam' => floatval($this->pregReps($this->input->post('pdty_jam'))),
                'konversi' => floatval($this->pregReps($this->input->post('konversi'))),
                'pdty_jam_km' => floatval($this->pregReps($this->input->post('pdty_jam_km'))),
                'keperluan_unit' => intval($this->pregReps($this->input->post('keperluan_unit'))),
                'match_factor' => floatval($this->pregReps($this->input->post('match_factor'))),
            );
            $SaveEdit = $this->mod_global->edit_all('id', $id, 'mst_matching_fleet', $data);
            if ($SaveEdit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes match fleet data ID : '.$id.', onsite : '.$site,
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