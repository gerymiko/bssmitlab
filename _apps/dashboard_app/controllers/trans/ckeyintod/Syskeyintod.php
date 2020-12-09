<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syskeyintod extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('key_in_tod'));
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
            $this->load->model(['trans/mkeyintod/mod_key_in_tod']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function convYear($monthNum){
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            return $monthName = $dateObj->format('F');
        }

        public function key_in_tod($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/trans/pkeyintod/vkey_in_tod',
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

        public function table_key_in_tod($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_key_in_tod->get_data_key_in_tod($length, $start, $site);
            foreach ($getdata as $field){
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['clustering_mvc'] = $field->clustering_mvc;
                $row['kode_tod'] = $field->kode_tod;
                $row['obj_kpi'] = $field->obj_kpi;
                $row['plan_base'] = $field->plan_base;
                $row['actual'] = $field->actual*100;
                $row['pic'] = $field->pic;
                $row['link_topik_kecil_mindmap'] = $field->link_topik_kecil_mindmap;
                $row['control_checkpoint'] =  $field->control_checkpoint;
                $row['target'] = $field->target;
                $row['periode_target_close_daily'] = $field->periode_target_close_daily;
                $row['satuan'] = $field->satuan;
                $row['pic_dept'] = $field->pic_dept;
                $row['periode_target_mulai_month'] = $field->periode_target_mulai_month;
                $row['periode_target_close_month'] = $field->periode_target_close_month;
                $row['monthly_target'] = $field->monthly_target;
                $row['monthly_actual'] = $field->monthly_actual;
                $row['monthly_achieved'] = $field->monthly_achieved;
                $row['status'] = $field->status;
                $row['day1_w1'] = $field->day1_w1;
                $row['day2_w1'] = $field->day2_w1;
                $row['ev_day2_w1'] = $field->ev_day2_w1;
                $row['day3_w1'] = $field->day3_w1;
                $row['day4_w1'] = $field->day4_w1;
                $row['ev_day4_w1'] = $field->ev_day4_w1;
                $row['day5_w1'] = $field->day5_w1;
                $row['day6_w1'] = $field->day6_w1;
                $row['ev_day6_w1'] = $field->ev_day6_w1;
                $row['target_w1'] = $field->target_w1;
                $row['actual_w1'] = $field->actual_w1;
                $row['achieved_w1'] = $field->achieved_w1;
                $row['day1_w2'] = $field->day1_w2;
                $row['day2_w2'] = $field->day2_w2;
                $row['ev_day2_w2'] = $field->ev_day2_w2;
                $row['day3_w2'] = $field->day3_w2;
                $row['day4_w2'] = $field->day4_w2;
                $row['ev_day4_w2'] = $field->ev_day4_w2;
                $row['day5_w2'] = $field->day5_w2;
                $row['day6_w2'] = $field->day6_w2;
                $row['ev_day6_w2'] = $field->ev_day6_w2;
                $row['target_w2'] = $field->target_w2;
                $row['actual_w2'] = $field->actual_w2;
                $row['achieved_w2'] = $field->achieved_w2;
                $row['day1_w3'] = $field->day1_w3;
                $row['day2_w3'] = $field->day2_w3;
                $row['ev_day2_w3'] = $field->ev_day2_w3;
                $row['day3_w3'] = $field->day3_w3;
                $row['day4_w3'] = $field->day4_w3;
                $row['ev_day4_w3'] = $field->ev_day4_w3;
                $row['day5_w3'] = $field->day5_w3;
                $row['day6_w3'] = $field->day6_w3;
                $row['ev_day6_w3'] = $field->ev_day6_w3;
                $row['target_w3'] = $field->target_w3;
                $row['actual_w3'] = $field->actual_w3;
                $row['achieved_w3'] = $field->achieved_w3;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_key_in_tod->count_all($site),
                "recordsFiltered" => $this->mod_key_in_tod->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_key_in_tod_w4w5($site){
            $getdata = $this->mod_key_in_tod->get_data_key_in_tod_w4w5($site);
            echo json_encode($getdata);
        }
    }
?>