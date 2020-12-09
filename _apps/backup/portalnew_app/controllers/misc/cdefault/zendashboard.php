<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Zendashboard extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null) :
                $this->session->set_flashdata('notif','Oops! Silahkan login terlebih dahulu.');
                redirect('syslogin');
            endif;
            $this->load->model(['misc/mdefault/mod_misc_dashboard']);
        }

        public function index(){
            $users = $this->session->userdata('users_id');
            $data = array(
                'sheader'          => 'pages/ext/sheader',
                'sfooter'          => 'pages/ext/sfooter',
                'countalladmintdy' => $this->mod_misc_dashboard->count_all_admin_tdy(),
                'countalladmin'    => $this->mod_misc_dashboard->count_all_admin(),
                'countlevelall'    => $this->mod_misc_dashboard->count_all_level(),
                'countallsection'  => $this->mod_misc_dashboard->count_all_section(),
            );
            $this->load->view('pages/misc/vdefault/dashboard_misc', $data);
        }
    }
?>