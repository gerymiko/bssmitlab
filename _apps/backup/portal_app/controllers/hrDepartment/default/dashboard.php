<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Dashboard extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mod_hr_dashboard','hrDept/mod_hr_global']);
        }

        public function index(){
            $data = array(
                'sheader'           => 'pages/ext/sheader',
                'sfooter'           => 'pages/ext/sfooter',
                'regtoday'          => $this->mod_hr_dashboard->getregisteredusertoday(),
                'pelamartoday'      => $this->mod_hr_dashboard->getpelamartoday(),
                'sectiontoday'      => $this->mod_hr_dashboard->getsectiontoday(),
                'regtotal'          => $this->mod_hr_dashboard->getregisteredusertotal(),
                'pelamartotal'      => $this->mod_hr_dashboard->getpelamartotal(),
                'lowongantotal'     => $this->mod_hr_dashboard->getlowongantotal(),
                'deptotal'          => $this->mod_hr_dashboard->getdepartementotal(),
                'jabtotal'          => $this->mod_hr_dashboard->getjabatantotal(),
                'lokernewtoday'     => $this->mod_hr_dashboard->getlokernewtoday(),
                'pelamargagaltoday' => $this->mod_hr_dashboard->getpelamargagaltoday(),
                'interviewtoday'    => $this->mod_hr_dashboard->getinterviewtoday(),
                'testeoritoday'     => $this->mod_hr_dashboard->gettesteoritoday(),
                'tespraktektoday'   => $this->mod_hr_dashboard->gettespraktektoday(),
                'mcutoday'          => $this->mod_hr_dashboard->getmcutoday(),
                'fgtotal'           => $this->mod_hr_dashboard->getfgtotal(),
                'qualifytotal'      => $this->mod_hr_dashboard->getqualifytotal(),
                'notqualify'        => $this->mod_hr_dashboard->getnotqualifytotal(),
                'pelamargagaltotal' => $this->mod_hr_dashboard->getpelamargagaltotal(),
            );
            $this->load->view('pages/hr/dashboard/dashboard_hr', $data);
        }

        public function table_admin_online(){
            $adminol = $this->mod_hr_dashboard->get_datatables();
            $data    = array();
            $no      = $this->input->post('start');
            
            foreach ($adminol as $field) {
                $no++;
                $row    = array();
                $status = $field->is_login;
                if ($status = 1) {
                    $online = '<i class="fa fa-circle green"></i> Online';
                }

                $row[]  = $no;
                $row[]  = $field->users_fullname;
                $row[]  = $online;
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_dashboard->count_all(),
                 "recordsFiltered" => $this->mod_hr_dashboard->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function get_city(){
            if (isset($_GET['term'])) {
                $result = $this->mod_hr_global->city_autocomplete($_GET['term']);
                if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->city_name;
                    echo json_encode($arr_result);
                }
            }
        }
    }
?>