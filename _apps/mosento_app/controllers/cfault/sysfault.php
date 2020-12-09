<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfault extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('dashboard'));
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
            $this->load->model(['mfault/mod_fault']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function today_fault($site){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/pfault/vfault',
                'accessRights' => $this->accessRights,
                'today' => $this->mod_fault->count_fault_today($site),
                'month' => $this->mod_fault->count_fault_month($site),
                'year' => $this->mod_fault->count_fault_year($site),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/responsive.dataTables.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.responsive.min.js"></script>'
                ),
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_fault($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $fault = $this->mod_fault->get_fault($length, $start, $site);
            foreach ($fault as $field){
                if (date("d-m-Y", strtotime($field->fromJam)) == date("d-m-Y") ) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $start++;
                $row            = array();
                $row['no']      = $start;
                $row['unit']    = $field->nolambung;
                $row['fromhm']  = number_format(($field->fromHM / 10),2,",",".");
                $row['tohm']    = number_format(($field->toHM / 10),2,",",".");
                $row['fromjam'] = ($field->fromJam == '1970-01-01 08:00:00.000') ? 'Error Time' : date('d-m-Y H:i A', strtotime($field->fromJam)).' '.$today_notif;
                $row['tojam']   = ($field->toJam == '1970-01-01 08:00:00.000') ? 'Error Time' : date('d-m-Y H:i A', strtotime($field->toJam));
                $row['attempt'] = $field->count.' times';
                $row['info'] = $this->pregReps($field->ket);
                $row['name'] = ($field->nama == null) ? '-' : $field->nama;
                $data[]      = $row;
            };
            $output = array(
                "draw"         => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_fault->count_all($site),
                "recordsFiltered" => $this->mod_fault->count_filtered($site),
                "data" => $data,
            );
            echo json_encode($output);
        }

    }
?>