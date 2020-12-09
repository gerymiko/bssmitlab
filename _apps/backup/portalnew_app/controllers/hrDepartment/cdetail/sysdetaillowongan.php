<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdetaillowongan extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mdetail/mod_hr_detaillowongan']);
        }

        public function detail_lowongan($lowongan_id){
            $data   = array(
                    'sheader'          => 'pages/ext/sheader',
                    'sfooter'          => 'pages/ext/sfooter',
                    'detailoker'       => $this->mod_hr_detaillowongan->detailoker($lowongan_id),
                    'detail_edureq'    => $this->mod_hr_detaillowongan->detail_edureq($lowongan_id),
                    'detail_skillreq'  => $this->mod_hr_detaillowongan->detail_skillreq($lowongan_id),
                    'detail_syaratreq' => $this->mod_hr_detaillowongan->detail_syaratreq($lowongan_id),
                );
            $this->load->view('pages/hr/vdetail/detail_lowongan',$data);
        }
    }
?>