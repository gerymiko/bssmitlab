<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysactivityplan extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('activity_plan'));
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
            $this->load->model(['trans/mactivityplan/mod_activity_plan']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function activity_plan($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/trans/pactivityplan/vactivity_plan',
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

        public function table_activity_plan($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_activity_plan->get_data_activity_plan($length, $start, $site);
            foreach ($getdata as $field){
                $start++;
                $row       = array();
                $row['x'] = $start;
                $row['no'] = $field->no;
                $row['kode_ap'] = $field->kode_ap;
                $row['obj1year'] = $field->obj1year;
                $row['plan_base'] = $field->plan_base;
                $row['actual'] = $field->actual;
                $row['pic'] = $field->pic;
                $row['pic_dept'] = $field->pic_dept;
                $row['project_activity'] = $field->project_activity;
                $row['control_checkpoint'] = $field->control_checkpoint;
                $row['target'] = $field->target;
                $row['satuan'] = $field->satuan;
                $row['target_mulai_month'] = $field->target_mulai_month;
                $row['target_close_month'] = $field->target_close_month;
                $row['target_close_week'] = $field->target_close_week;
                $row['jan'] = $field->jan;
                $row['feb'] = $field->feb;
                $row['mar'] = $field->mar;
                $row['apr'] = $field->apr;
                $row['mei'] = $field->mei;
                $row['jun'] = $field->jun;
                $row['jul'] = $field->jul;
                $row['agt'] = $field->agt;
                $row['sep'] = $field->sep;
                $row['okt'] = $field->okt;
                $row['nov'] = $field->nov;
                $row['des'] = $field->des;
                $row['clustering_mvc'] = ($field->clustering_mvc == null) ? '-' : $field->clustering_mvc;
                $row['status'] = ($field->status == 1) ? 'Aktif' : 'Tidak Aktif';
                $row['year'] = $field->tahun;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_activity_plan->count_all($site),
                "recordsFiltered" => $this->mod_activity_plan->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>