<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysraportoneyear extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('raport_one_year'));
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
            $this->load->model(['trans/mraportoneyear/mod_raport_one_year']);
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

        public function raport_one_year($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/trans/praportoneyear/vraport_one_year',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/select.dataTables.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/dataTables.select.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dragscroll/dragscroll.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/dashboard/vendor/bs-datatables/js/paginationSelect/select.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_raport_one_year($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->mod_raport_one_year->count_all($site);
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year($length, $start, $site);
            foreach ($getdata as $field){
                $start++;
                $row       = array();
                $row['x'] = $start;
                $row['no'] = $field->no;
                $row['status'] = $field->status;
                $row['toleransi_upper'] = $field->toleransi_upper;
                $row['toleransi_lower'] = $field->toleransi_lower;
                $row['pic_dept'] = $field->pic_dept;
                $row['achv_monthly_review'] = $field->achv_monthly_review;
                $row['clustering_mvc'] = $field->clustering_mvc;
                $row['obj_hasil_fisik'] = $field->obj_hasil_fisik;
                $row['weight'] = $field->weight;
                $row['w1_plan_running_jan'] = $field->w1_plan_running_jan;
                $row['w1_actual_jan'] = $field->w1_actual_jan;
                $row['w1_deviasi_jan'] = $field->w1_deviasi_jan;
                $row['w2_plan_running_jan'] = $field->w2_plan_running_jan;
                $row['w2_actual_jan'] = $field->w2_actual_jan;
                $row['w2_deviasi_jan'] = $field->w2_deviasi_jan;
                $row['w3_plan_running_jan'] = $field->w3_plan_running_jan;
                $row['w3_actual_jan'] = $field->w3_actual_jan;
                $row['w3_deviasi_jan'] = $field->w3_deviasi_jan;
                $row['w4_plan_running_jan'] = $field->w4_plan_running_jan;
                $row['w4_actual_jan'] = $field->w4_actual_jan;
                $row['w4_deviasi_jan'] = $field->w4_deviasi_jan;
                $row['w5_plan_running_jan'] = $field->w5_plan_running_jan;
                $row['w5_actual_jan'] = $field->w5_actual_jan;
                $row['w5_deviasi_jan'] = $field->w5_deviasi_jan;
                $row['review_target_jan'] = $field->review_target_jan;
                $row['review_plan_running_jan'] = $field->review_plan_running_jan;
                $row['review_plan_base_jan'] = $field->review_plan_base_jan;
                $row['review_actual_jan'] = $field->review_actual_jan;
                $row['review_actual_target_jan'] = $field->review_actual_target_jan;
                $row['review_index_target_jan'] = $field->review_index_target_jan;
                $row['review_index_running_jan'] = $field->review_index_running_jan;
                $row['review_index_base_jan'] = $field->review_index_base_jan;
                $row['review_result_target_jan'] = $field->review_result_target_jan;
                $row['review_result_running_jan'] = $field->review_result_running_jan;
                $row['review_result_base_jan'] = $field->review_result_base_jan;
                $row['review_gagal_target_jan'] = $field->review_gagal_target_jan;
                $row['review_gagal_running_jan'] = $field->review_gagal_running_jan;
                $row['review_gagal_base_jan'] = $field->review_gagal_base_jan;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_raport_one_year->count_all($site),
                "recordsFiltered" => $this->mod_raport_one_year->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_raport_one_year_feb($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_feb($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_mar($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_mar($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_apr($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_apr($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_mei($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_mei($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_jun($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_jun($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_jul($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_jul($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_agt($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_agt($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_sep($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_sep($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_okt($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_okt($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_nov($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_nov($site);
            echo json_encode($getdata);
        }

        public function table_raport_one_year_des($site){
            $getdata = $this->mod_raport_one_year->get_data_raport_one_year_des($site);
            echo json_encode($getdata);
        }
        
    }
?>