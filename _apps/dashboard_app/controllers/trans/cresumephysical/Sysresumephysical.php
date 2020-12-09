<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysresumephysical extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('resume_physical_results'));
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
            $this->load->model(['trans/mresumephysical/mod_resume_physical']);
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

        public function resume_physical_results($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/trans/presumephysical/vresume_physical',
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

        public function table_resume_physical_results($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_resume_physical->get_data_resume_physical_results($length, $start, $site);
            foreach ($getdata as $field){
                $start++;
                $row       = array();
                $row['x'] = $start;
                $row['no'] = $field->no;
                $row['status'] = $field->status;
                $row['pic_dept'] = $field->pic_dept;
                $row['achv_monthly_review'] = $field->achv_monthly_review;
                $row['clustering_mvc'] = $field->clustering_mvc;
                $row['link_input_obj_kpi'] = $field->link_input_obj_kpi;
                $row['weight'] = $field->weight;
                $row['w1_plan_running'] = $field->w1_plan_running;
                $row['w1_actual'] = $field->w1_actual;
                $row['w1_dev_idx_running'] = $field->w1_dev_idx_running;
                $row['w2_plan_running'] = $field->w2_plan_running;
                $row['w2_actual'] = $field->w2_actual;
                $row['w2_dev_idx_running'] = $field->w2_dev_idx_running;
                $row['w3_plan_running'] = $field->w3_plan_running;
                $row['w3_actual'] = $field->w3_actual;
                $row['w3_dev_idx_running'] = $field->w3_dev_idx_running;
                $row['w4_plan_running'] = $field->w4_plan_running;
                $row['w4_actual'] = $field->w4_actual;
                $row['w4_dev_idx_running'] = $field->w4_dev_idx_running;
                $row['w5_plan_running'] = $field->w5_plan_running;
                $row['w5_actual'] = $field->w5_actual;
                $row['w5_dev_idx_running'] = $field->w5_dev_idx_running;
                $row['review_target'] = $field->review_target;
                $row['review_plan_running'] = $field->review_plan_running;
                $row['review_plan_base'] = $field->review_plan_base;
                $row['review_actual'] = $field->review_actual;
                $row['review_actual_target'] = $field->review_actual_target;
                $row['review_idx_target'] = $field->review_idx_target;
                $row['review_idx_running'] = $field->review_idx_running;
                $row['review_idx_base'] = $field->review_idx_base;
                $row['review_rst_target'] = $field->review_rst_target;
                $row['review_rst_running'] = $field->review_rst_running;
                $row['review_rst_base'] = $field->review_rst_base;
                $row['review_gagal_target'] = $field->review_gagal_target;
                $row['review_gagal_running'] = $field->review_gagal_running;
                $row['review_gagal_base'] = $field->review_gagal_base;
                $row['dept'] = $field->dept;
                $row['bulan'] = $this->convYear($field->bulan);
                $row['tahun'] = $field->tahun;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_resume_physical->count_all($site),
                "recordsFiltered" => $this->mod_resume_physical->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>