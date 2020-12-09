<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslog extends CI_Controller {

        function __construct() {
            parent::__construct();

            if ($this->session->userdata('users_id') == null && $this->session->userdata('bssID') == null) {
                redirect('logisisse');
            } else {
                $this->accessRights = $this->mod_global->get_detailed_user($this->session->userdata('users_id'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights->level_id != 1 && $this->accessRights->level_id != 2 ) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>Anda tidak memiliki wewenang untuk mengakses halaman ini.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('m/welcome');
                }
            }
            $this->load->model(['mlog/mod_log']);
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

        public function web_log(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/plog/vlog',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hrdportal/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hrdportal/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hrdportal/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hrdportal/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hrdportal/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/moment/moment.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_log(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $logs = $this->mod_log->get_logs($length, $start);
            foreach ($logs as $field){
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['level'] = $field->level_name;
                $row['nik']   = $field->bssID;
                $row['name']  = $field->users_fullname;
                $row['logs']  = $field->logs_keterangan;
                $row['ip']    = $field->logs_ip;
                $row['time']  = $this->viewDate($field->logs_tanggal);
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_log->count_all_logs(),
                "recordsFiltered" => $this->mod_log->count_filtered_logs(),
                "data"            => $data
            );
            echo json_encode($output);
        }

    }
?>