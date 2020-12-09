<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysinputobjkpi extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('input_objective_kpi'));
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
            $this->load->model(['trans/minputobjkpi/mod_input_objective_kpi']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function input_objective_kpi($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/trans/pinputobjkpi/vinput_objective_kpi',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/select.dataTables.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/dataTables.select.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dragscroll/dragscroll.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/dashboard/vendor/bs-datatables/js/paginationSelect/select.js"></script>',
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_input_objective_kpi($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_input_objective_kpi->get_data_input_objective_kpi($length, $start, $site);
            foreach ($getdata as $field){
                $start++;
                $row       = array();
                $row['x'] = $start;
                $row['no'] = $field->no;
                $row['scorecard_category'] = $field->scorecard_category;
                $row['dept_in_charge'] = $field->dept_in_charge;
                $row['clustering_mvc'] = $field->clustering_mvc;
                $row['mining_value_chain'] = $field->mining_value_chain;
                $row['deploy_category'] = $field->deploy_category;
                $row['category'] = $field->category;
                $row['objective_kpi'] = $field->objective_kpi;
                $row['weight'] = $field->weight;
                $row['satuan'] = $field->satuan;
                $row['actual_last_year'] = $field->actual_last_year;
                $row['yearly_base'] = $field->yearly_base;
                $row['yearly_target'] = $field->yearly_target;
                $row['sem1_base'] = $field->sem1_base;
                $row['sem1_target'] = $field->sem1_target;
                $row['sem2_base'] = $field->sem2_base;
                $row['sem2_target'] = $field->sem2_target;
                $row['jan_base'] = $field->jan_base;
                $row['jan_target'] = $field->jan_target;
                $row['feb_base'] = $field->feb_base;
                $row['feb_target'] = $field->feb_target;
                $row['mar_base'] = $field->mar_base;
                $row['mar_target'] = $field->mar_target;
                $row['q1_base'] = $field->q1_base;
                $row['q1_target'] = $field->q1_target;
                $row['apr_base'] = $field->apr_base;
                $row['apr_target'] = $field->apr_target;
                $row['mei_base'] = $field->mei_base;
                $row['mei_target'] = $field->mei_target;
                $row['jun_base'] = $field->jun_base;
                $row['jun_target'] = $field->jun_target;
                $row['q2_base'] = $field->q2_base;
                $row['q2_target'] = $field->q2_target;
                $row['jul_base'] = $field->jul_base;
                $row['jul_target'] = $field->jul_target;
                $row['agt_base'] = $field->agt_base;
                $row['agt_target'] = $field->agt_target;
                $row['sept_base'] = $field->sept_base;
                $row['sept_target'] = $field->sept_target;
                $row['q3_base'] = $field->q3_base;
                $row['q3_target'] = $field->q3_target;
                $row['okt_base'] = $field->okt_base;
                $row['okt_target'] = $field->okt_target;
                $row['nov_base'] = $field->nov_base;
                $row['nov_target'] = $field->nov_target;
                $row['des_base'] = $field->des_base;
                $row['des_target'] = $field->des_target;
                $row['q4_base'] = $field->q4_base;
                $row['q4_target'] = $field->q4_target;
                $row['year'] = $field->tahun;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_input_objective_kpi->count_all($site),
                "recordsFiltered" => $this->mod_input_objective_kpi->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>