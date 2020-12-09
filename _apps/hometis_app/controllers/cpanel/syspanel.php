<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspanel extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->load->model(['mpanel/mod_panel', 'mglobal/mod_global']);
            if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null){
                redirect('logisisse');
            } else {
                $changePass = $this->mod_global->get_change_password($this->session->userdata('id_user'));
                if ($changePass == 'false'){
                    redirect('menu/site');
                } else {
                    $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('dashboard'));
                    if ($this->accessRights==null) {
                        show_404('',false);
                    } elseif ($this->accessRights!=null && $this->accessRights->site !== $this->uri->segment(3) || $this->accessRights->status_active !== 1) {
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/site');
                    } elseif ($this->accessRights!=null && $this->accessRights->read !== 1 || $this->accessRights->status_active !== 1) {
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/site');
                    }
                }
            }
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function dashboard($site){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => $this->mod_global->sidemenu($this->accessRights->id_user, $site),
                'content'  => 'pages/ppanel/vpanel',
                'totalTL'  => array(
                                'all' => $this->mod_panel->count_all_tl($site, "all"),
                                'on' => $this->mod_panel->count_all_tl($site, "ON"),
                                'off' => $this->mod_panel->count_all_tl($site, "OFF"),
                                'nodata' => intval($this->mod_panel->count_all_tl($site, "all") - ($this->mod_panel->count_all_tl($site, "ON")+$this->mod_panel->count_all_tl($site, "OFF")) )
                            ),
                'totalOF'  => array(
                                'all' => $this->mod_panel->count_all_office($site, "all"),
                                'on' => $this->mod_panel->count_all_office($site, "ON"),
                                'off' => $this->mod_panel->count_all_office($site, "OFF"),
                                'nodata' => intval($this->mod_panel->count_all_office($site, "all") - ($this->mod_panel->count_all_office($site, "ON")+$this->mod_panel->count_all_office($site, "OFF")) )
                            ),
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/buttons.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/select2/dist/css/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/dataTables.buttons.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/buttons.html5.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/select2/dist/js/select2.full.min.js"></script>'
                ),
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_tl($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $unit_tl = $this->mod_panel->get_unit_tl($length, $start, $site);

            foreach ($unit_tl as $field){
                if ($field->status_engine == "ON") {
                    $statusengine = '<lable class="label bg-green">ON</lable>';
                } elseif ($field->status_engine == "OFF") {
                    $statusengine = '<lable class="label bg-red">OFF</lable>';
                } else {
                    $statusengine = '<lable class="label bg-black">NO DATA</lable>';
                }
                $sn = $field->no_lambung;
                $hmlast = ($field->hm_end_decimal == null) ? "-" : floatval($field->hm_end_decimal);
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['unit']   = $field->no_unit;
                $row['serial'] = $sn;
                $row['engine'] = $statusengine;
                $row['lasthm'] = $hmlast;
                $row['detail'] = '<a href="'.site_url().'detail/tl/'.$site.'/'.$this->my_encryption->encode($sn).'" class="btn btn-xs bg-red" data-tooltip="Go to detail"><i class="fas fa-external-link-square-alt"></i></a>';
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_panel->count_all_unit_tl($site),
                "recordsFiltered" => $this->mod_panel->count_filtered_unit_tl($site),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function table_office($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $unit_office = $this->mod_panel->get_unit_office($length, $start, $site);

            foreach ($unit_office as $field){
                if ($field->status_engine == "ON") {
                    $statusengine = '<lable class="label bg-green">ON</lable>';
                } elseif ($field->status_engine == "OFF") {
                    $statusengine = '<lable class="label bg-red">OFF</lable>';
                } else {
                    $statusengine = '<lable class="label bg-black">NO DATA</lable>';
                }
                $sn = $field->no_lambung;
                $hmlast = ($field->hm_end_decimal == null) ? "-" : floatval($field->hm_end_decimal);
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['unit']   = $field->no_unit;
                $row['serial'] = $sn;
                $row['engine'] = $statusengine;
                $row['lasthm'] = $hmlast;
                $row['detail'] = '<a href="'.site_url().'detail/office/'.$site.'/'.$this->my_encryption->encode($sn).'" class="btn btn-xs bg-red" data-tooltip="Go to detail"><i class="fas fa-external-link-square-alt"></i></a>';
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_panel->count_all_unit_office($site),
                "recordsFiltered" => $this->mod_panel->count_filtered_unit_office($site),
                "data"            => $data
            );
            echo json_encode($output);
        }

    }
?>