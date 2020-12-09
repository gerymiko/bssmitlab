<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysoneyearco extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('one_year_co'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('logout');
                } elseif ($this->accessRights!=null && $this->accessRights->readx != 1 || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('page/first/'.$this->accessRights->site);
                }
            }
            $this->load->model(['trans/moneyearco/mod_one_year_co']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function one_year_co($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/trans/poneyearco/vone_year_co',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/select.dataTables.min.css"/>',
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/dataTables.select.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dragscroll/dragscroll.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/dashboard/vendor/bs-datatables/js/paginationSelect/select.js"></script>',
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_one_year_co($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_one_year_co->get_data_one_year_co($length, $start, $site);
            foreach ($getdata as $field){
                if ($field->inti_value == 'v') {
                    $inti_value = '<i class="material-icons f14">done</i>';
                } else {
                    $inti_value = '<i class="material-icons f14">radio_button_unchecked</i>';
                }
                if ($field->support1_value == '?') {
                    $support1_value = '<i class="material-icons f14">radio_button_unchecked</i>';
                } else {
                    $support1_value = $field->support1_value;
                }
                if ($field->support2_value == '?') {
                    $support2_value = '<i class="material-icons f14">radio_button_unchecked</i>';
                } else {
                    $support2_value = $field->support2_value;
                }
                $start++;
                $row       = array();
                $row['x'] = $start;
                $row['no'] = $field->no;
                $row['balance_scorecard']  = $field->balance_scorecard;
                $row['guideline_policy'] = $field->guideline_policy ;
                $row['strategy_definition'] = $field->strategy_definition;
                $row['strategy_target'] = $field->strategy_target;
                $row['strategy_obj'] = $field->strategy_obj;
                $row['category'] = $field->category;
                $row['definisi'] = $field->definisi;
                $row['rumus_achv'] = $field->rumus_achv;
                $row['plan_base_q1'] = $field->plan_base_q1;
                $row['plan_base_q2'] = $field->plan_base_q2;
                $row['plan_base_q3'] = $field->plan_base_q3;
                $row['plan_base_q4'] = $field->plan_base_q4;
                $row['inti_desc'] = $field->inti_desc.' '.$inti_value;
                $row['support1_desc'] = $field->support1_desc.' '.$support1_value;
                $row['support2_desc'] = $field->support2_desc.' '.$support2_value;
                $row['rumus_obj'] = ($field->rumus_obj == 0)  ? "-" : $field->rumus_obj;
                $row['year'] = ($field->tahun == 0)  ? "-" : $field->tahun;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_one_year_co->count_all($site),
                "recordsFiltered" => $this->mod_one_year_co->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>