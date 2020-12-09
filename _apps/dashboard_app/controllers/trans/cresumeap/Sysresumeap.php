<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysresumeap extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('resume_ap'));
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
            $this->load->model(['trans/mresumeap/mod_resume_ap']);
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

        public function resume_ap($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                'content' => 'pages/trans/presumeap/vresume_ap',
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

        public function table_resume_ap($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_resume_ap->get_data_resume_ap($length, $start, $site);
            foreach ($getdata as $field){
                $start++;
                $row       = array();
                $row['x'] = $start;
                $row['id'] = $field->id;
                $row['clustering_mvc'] = $field->clustering_mvc;
                $row['no'] = $field->no;
                $row['kode_ap'] = $field->kode_ap;
                $row['strategy_coorp_obj'] = $field->strategy_coorp_obj;
                $row['plan_base'] = $field->plan_base;
                $row['actual'] = $field->actual;
                $row['pic'] = $field->pic;
                $row['pic_dept'] = $field->pic_dept;
                $row['project_activity'] = $field->project_activity;
                $row['control_checkpoint'] = $field->control_checkpoint;
                $row['target'] = $field->target;
                $row['satuan'] = $field->satuan;
                $row['periode_mulai_month'] = $field->periode_mulai_month;
                $row['periode_close_month'] = $field->periode_close_month;
                $row['periode_close_week'] = $field->periode_close_week;
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
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_resume_ap->count_all($site),
                "recordsFiltered" => $this->mod_resume_ap->count_filtered($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function get_data_id($site){
            $id = $this->pregRepn($this->input->post('id'));
            // var_dump($id);
            $getdata = $this->mod_resume_ap->get_data_id($site, $id);
            list($index, $value) = each($getdata);
            echo json_encode($value);
        }

        
    }
?>