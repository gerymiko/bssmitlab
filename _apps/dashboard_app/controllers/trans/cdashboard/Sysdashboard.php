<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdashboard extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('dashboard'));
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
            $this->load->model(['trans/mdashboard/mod_dashboard']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function dashboard($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'menu'   => $this->mod_global->menu($this->accessRights->id_user, $site),
                'list_site'  => $this->mod_global->list_site(),
                // -----------
                'cost_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'COST'),
                'rev_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'REVENUE & PRODUKSI'),
                'coal_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'COAL'),
                'ob_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'OB REMOVAL'),
                'gmp_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'GMP'),
                'csi_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'CSI'),
                'pa_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'PA UNIT'),
                'pmp_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'PRODUKTIFITAS MP'),
                'paa_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'PRODUCTIVITY ALAT'),
                'ua_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'UA'),
                'safety_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'SAFETY PERFORMANCE'),
                'csr_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'CSR'),
                'index_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'INDEX KEPUASAN KARYAWAN'),
                'dev_base'  => $this->mod_dashboard->yearly_base_db_prj_arr($site, 'SYSTEM DEVELOPMENT'),
                // -----------
                'cost_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'COST'),
                'rev_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'REVENUE & PRODUKSI'),
                'coal_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'COAL'),
                'ob_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'OB REMOVAL'),
                'gmp_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'GMP'),
                'csi_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'CSI'),
                'pa_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'PA UNIT'),
                'pmp_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'PRODUKTIFITAS MP'),
                'paa_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'PRODUCTIVITY ALAT'),
                'ua_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'UA'),
                'safety_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'SAFETY PERFORMANCE'),
                'csr_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'CSR'),
                'index_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'INDEX KEPUASAN KARYAWAN'),
                'dev_Running'  => $this->mod_dashboard->yearly_running_db_prj_arr($site, 'SYSTEM DEVELOPMENT'),

                'content' => 'pages/trans/pdashboard/vdashboard',
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/select.dataTables.min.css"/>',
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/dataTables.select.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dragscroll/dragscroll.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/dashboard/vendor/bs-datatables/js/paginationSelect/select.js"></script>',
                    '<script src="'.site_url().'../bssmitlab/_assets/dashboard/js/widgets/table/table.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_cost_base($site){
            $stgobj = $this->input->post('strategy_obj');
            $month = $this->input->post('bulan');
            $getdata = $this->mod_dashboard->monthly_base_db_prj_arr($site, $stgobj, $month);
            echo json_encode($getdata);
        }
    }
?>