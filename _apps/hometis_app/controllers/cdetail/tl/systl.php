<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Systl extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->load->model(['mdetail/tl/mod_detail_tl', 'mglobal/mod_global']);
            if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null) {
                redirect('logisisse');
            } else {
                $changePass = $this->mod_global->get_change_password($this->session->userdata('id_user'));
                if ($changePass == 'false') {
                    redirect('menu/site');
                } else {
                    $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('hm_detail'));
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

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }
        
        public function detail($site){
            $nolambung = $this->my_encryption->decode($this->uri->segment(4));
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => $this->mod_global->sidemenu($this->session->userdata('id_user'), $site),
                'content'  => 'pages/pdetail/tl/view',
                'detailTL' => $this->mod_detail_tl->detail_tl($site, $nolambung),
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/buttons.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-daterangepicker/daterangepicker.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/dataTables.buttons.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/buttons.html5.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/moment/moment.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-daterangepicker/daterangepicker.min.js"></script>'
                ),
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_detail_tl($site, $nolambung){
            $nolambung = $this->my_encryption->decode($this->uri->segment(4));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $detail_tl = $this->mod_detail_tl->get_detail_tl($length, $start, $site, $nolambung);

            foreach ($detail_tl as $field){
                $hmtotal = floatval($field->hm_end_decimal) - floatval($field->hm_start_decimal);
                $timestart = ($field->time_start == null) ? "NULL" : $field->time_start;
                $timeend = ($field->time_end == null) ? "NULL" : $field->time_end;
                $start++;
                $row              = array();
                $row['no']        = $start;
                $row['unit']      = $field->no_unit;
                $row['type']      = $field->name;
                $row['status']    = ($field->status_engine == null ) ? "NULL" : $field->status_engine;
                $row['timestart'] = '<span style="display:none;">'.strtotime($field->time_start).'</span>'.$timestart;
                $row['timeend']   = '<span style="display:none;">'.strtotime($field->time_end).'</span>'.$timeend;
                $row['hmstart']   = ($field->hm_start_decimal == null) ? "NULL" : $field->hm_start_decimal;
                $row['hmend']     = ($field->hm_end_decimal == null) ? "NULL" : $field->hm_end_decimal;
                $row['hmtotal']   = ($field->hm_start_decimal == null && $field->hm_end_decimal == null) ? "NULL" : $hmtotal;
                $row['site']      = $field->site;
                $data[]           = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_tl->count_all_detail_tl($site, $nolambung),
                "recordsFiltered" => $this->mod_detail_tl->count_filtered_detail_tl($site, $nolambung),
                "data"            => $data
            );
            echo json_encode($output);
        }

    }
?>