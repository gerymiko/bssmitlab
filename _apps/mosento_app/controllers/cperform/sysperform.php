<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysperform extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('performance'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/site');
                } elseif ($this->accessRights!=null && $this->accessRights->read != 1 || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                }
            }
            $this->load->model(['mperform/mod_perform']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("d-m-Y H:i:s", strtotime($date));
        }

        public function performance($site){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/pperform/vperformance',
                'accessRights' => $this->accessRights,
                'listmonthyear' => $this->mod_perform->get_select_month_year($site),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_perform_hd465($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $perform = $this->mod_perform->get_perform($length, $start, $site , 'HD465');
            foreach ($perform as $field){
                $start++;
                $row = array();
                $row['no']   = $start;
                $row['nik']  = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name'] = ($field->nama == null) ? "-" : $this->pregReps($field->nama);
                $row['unit'] = $field->unit;
                $row['dateper'] = $this->viewDate($field->tgl);
                $row['bcm'] = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_perform->count_all($site, 'HD465'),
                "recordsFiltered" => $this->mod_perform->count_filtered($site, 'HD465'),
                "data" => $data
            );
            echo json_encode($output);
        }

        public function table_perform_hd785($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $perform = $this->mod_perform->get_perform($length, $start, $site , 'HD785');
            foreach ($perform as $field){
                $start++;
                $row = array();
                $row['no']   = $start;
                $row['nik']  = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name'] = ($field->nama == null) ? "-" : $this->pregReps($field->nama);
                $row['unit'] = $field->unit;
                $row['dateper'] = $this->viewDate($field->tgl);
                $row['bcm'] = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_perform->count_all($site, 'HD785'),
                "recordsFiltered" => $this->mod_perform->count_filtered($site, 'HD785'),
                "data" => $data
            );
            echo json_encode($output);
        }

        public function table_perform_exca465($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $perform = $this->mod_perform->get_perform($length, $start, $site , 'HD465');
            foreach ($perform as $field){
                $start++;
                $row = array();
                $row['no']   = $start;
                $row['nik']  = ($field->nikoprloader == null && $field->nikoprloader == '') ? "-" : $this->pregRepn($field->nikoprloader);
                $row['name'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader);
                $row['unit'] = $field->loader;
                $row['dateper'] = $this->viewDate($field->tgl);
                $row['bcm'] = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_perform->count_all($site, 'HD465'),
                "recordsFiltered" => $this->mod_perform->count_filtered($site, 'HD465'),
                "data" => $data
            );
            echo json_encode($output);
        }

        public function table_perform_exca785($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $perform = $this->mod_perform->get_perform($length, $start, $site , 'HD785');
            foreach ($perform as $field){
                $start++;
                $row = array();
                $row['no']   = $start;
                $row['nik']  = ($field->nikoprloader == null && $field->nikoprloader == '') ? "-" : $this->pregRepn($field->nikoprloader);
                $row['name'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader);
                $row['unit'] = $field->loader;
                $row['dateper'] = $this->viewDate($field->tgl);
                $row['bcm'] = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_perform->count_all($site, 'HD785'),
                "recordsFiltered" => $this->mod_perform->count_filtered($site, 'HD785'),
                "data" => $data
            );
            echo json_encode($output);
        }

    }
?>