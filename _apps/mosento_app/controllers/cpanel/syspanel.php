<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspanel extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                // $changePass = $this->mod_global->get_change_password($this->session->userdata('id_user'));
                // if ($changePass == 'false'){
                //     redirect('menu/site');
                // } else {
                    $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('dashboard'));
                    if ($this->accessRights==null) {
                        show_404();exit();
                    } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active !== 1) {
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/site');
                    } elseif ($this->accessRights!=null && $this->accessRights->read != 1 || $this->accessRights->status_active != 1) {
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/site');
                    }
                // }
            }
            ob_start();
            $this->load->model(['mpanel/mod_panel']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function dashboard($site){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/ppanel/vpanel',
                'count_unit' => $this->mod_panel->count_unit($site),
                'critical_today' => $this->mod_panel->count_critical_today($site),
                'caution_today' => $this->mod_panel->count_caution_today($site),
                'fault_today' => $this->mod_panel->count_fault_today($site),
                'accessRights' => $this->accessRights,
                'list_unit' => $this->mod_panel->get_all_unit($site),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/daterangepicker/daterangepicker.min.css"/>',
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/moment/moment.min.js"/></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/daterangepicker/daterangepicker.min.js"/></script>',
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_unit_dozer($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);}
            $unit_dozer = $this->mod_panel->get_unit($length, $start, $site, 'Dozer Truck');
            foreach ($unit_dozer as $field){
                $sn = $field->serialnumber;
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['unit'] = $field->unit;
                $row['serial'] = $sn;
                $row['hull'] = $field->nolambung;
                $row['warningfault'] = '<a href="'.site_url().'warning/dozer/'.$site.'/'.$this->my_encryption->encode($sn).'" class="ls1 label label-default f12" data-tooltip="Towards Details">Warning & Fault <i class="fas fa-external-link-square-alt link-muted"></i></a>';
                $row['site'] = ($field->servername == null) ? '<span class="text-red">Data not found</span>' : $field->servername;
                $row['lastupdate'] = (date("Y", strtotime($field->lastupdate)) == '1990') ? '-' : date("d-m-Y H:i A", strtotime($field->lastupdate));
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_panel->count_all_unit($site, 'Dozer Truck'),
                "recordsFiltered" => $this->mod_panel->count_filtered_unit($site, 'Dozer Truck'),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function table_unit_exca($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false);}
            $unit_exca = $this->mod_panel->get_unit($length, $start, $site, 'Excavator');
            foreach ($unit_exca as $field){
                $sn = $field->serialnumber;
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['unit'] = $field->unit;
                $row['serial'] = $sn;
                $row['hull'] = $field->nolambung;
                $row['warningfault'] = '<a href="'.site_url().'warning/exca/'.$site.'/'.$this->my_encryption->encode($sn).'" class="ls1 label label-default f12" data-tooltip="Towards Details">Warning & Fault <i class="fas fa-external-link-square-alt link-muted"></i></a>';
                $row['site'] = ($field->servername == null) ? '<span class="text-red">Data not found</span>' : $field->servername;
                $row['lastupdate'] = (date("Y", strtotime($field->lastupdate)) == '1990') ? '-' : date("d-m-Y H:i A", strtotime($field->lastupdate));
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_panel->count_all_unit($site, 'Excavator'),
                "recordsFiltered" => $this->mod_panel->count_filtered_unit($site, 'Excavator'),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function table_unit_hd($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false);}
            $unit_hd = $this->mod_panel->get_unit_hd($length, $start, $site);
            foreach ($unit_hd as $field){
                $sn = $field->serialnumber;
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['unit'] = $field->unit;
                $row['serial'] = $sn;
                $row['hull'] = $field->nolambung;
                $row['warningfault'] = '<a href="'.site_url().'warning/hd/'.$site.'/'.$this->my_encryption->encode($sn).'" class="ls1 label label-default f12" data-tooltip="Towards Details">Warning & Fault <i class="fas fa-external-link-square-alt link-muted"></i></a>' ;
                $row['payload'] = '<a href="'.site_url().'payload/hd/'.$site.'/'.$this->my_encryption->encode($sn).'" class="ls1 label label-default f12" data-tooltip="Towards Details">Payload <i class="fas fa-external-link-square-alt link-muted"></i></a>';
                $row['site'] = ($field->servername == null) ? '<span class="text-red">Data not found</span>' : $field->servername;
                $row['lastupdate'] = (date("Y", strtotime($field->lastupdate)) == '1990') ? '-' : date("d-m-Y H:i A", strtotime($field->lastupdate));
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_panel->count_all_unit_hd($site),
                "recordsFiltered" => $this->mod_panel->count_filtered_unit_hd($site),
                "data"            => $data
            );
            echo json_encode($output);
        }

    }
?>