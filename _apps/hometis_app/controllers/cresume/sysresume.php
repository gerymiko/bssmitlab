<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysresume extends CI_Controller{

        function __construct(){
            parent::__construct();
            $this->load->model(['mresume/mod_resume', 'mglobal/mod_global']);
            if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null) {
                redirect('logisisse');
            } else {
                $changePass = $this->mod_global->get_change_password($this->session->userdata('id_user'));
                if ($changePass == 'false') {
                    redirect('menu/site');
                } else {
                    $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('resume_hm'));
                    if ($this->accessRights==null) {
                        show_404();exit();
                    } elseif ($this->accessRights!=null && $this->accessRights->site !== $this->uri->segment(3) || $this->accessRights->status_active !== 1) {
                        $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                        $this->session->set_flashdata('pesan', $pesan);
                        redirect('menu/site');
                    } elseif ($this->accessRights!=null && $this->accessRights->read !== 1 || $this->accessRights->status_active !== 1) {
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

        private function validateDate($date, $format = 'Y-m-d'){
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }

        private function in_multiarray($elem, $array, $field) {
            $top = sizeof($array) - 1;
            $bottom = 0;
            while($bottom <= $top) {
                if($array[$bottom][$field] == $elem)
                    return true;
                else 
                    if(is_array($array[$bottom][$field]))
                        if(in_multiarray($elem, ($array[$bottom][$field])))
                            return true;
                $bottom++;
            }        
            return false;
        }

        public function resume_hm($site){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => $this->mod_global->sidemenu($this->session->userdata('id_user'), $site),
                'accessRights' => $this->accessRights,
                'content'  => 'pages/presume/view',
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-daterangepicker/daterangepicker.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/moment/moment.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-daterangepicker/daterangepicker.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/amcharts4/v447/core.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/amcharts4/v447/charts.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function search($site){
            $data = array(
                'start' => $this->uri->segment(4), 
                'end'   => $this->uri->segment(5)
            );
            $this->load->view('pages/presume/search', $data);
        }

        public function chart_tl($site){
            $start = date("Y-m-d", strtotime($this->uri->segment(4)));
            $end   = date("Y-m-d", strtotime($this->uri->segment(5)));
            if ($this->validateDate($start) == false && $this->validateDate($end) == false) {
                echo "error date";
                exit();
            }
            $output   = array();
            $chart_tl = $this->mod_resume->get_chart_tl($site, $start, $end);
            foreach ($chart_tl as $row){
                $output[] = array(
                    'hm_total' => ($row->hm_total == null) ? 0 : $row->hm_total,
                    'no_unit'  => $row->no_unit
                );
            }
            echo json_encode($output);
        }

        public function chart_office($site){
            $start = date("Y-m-d", strtotime($this->uri->segment(4)));
            $end   = date("Y-m-d", strtotime($this->uri->segment(5)));
            if ($this->validateDate($start) == false && $this->validateDate($end) == false) {
                echo "error date";
                exit();
            }
            $output = array();
            $chart_office = $this->mod_resume->get_chart_office($site, $start, $end);
            foreach ($chart_office as $row){
                $output[] = array(
                    'hm_total' => ($row->hm_total == null) ? 0 : $row->hm_total,
                    'no_unit'  => $row->no_unit
                );
            }
            echo json_encode($output);
        }

    }
?>