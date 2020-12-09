<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Zenlevel extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null) :
                $this->session->set_flashdata('notif','Oops! Silahkan login terlebih dahulu.');
                redirect('syslogin');
            endif;
            $this->load->model(['misc/mlevel/mod_misc_level']);
        }

        public function level_user(){
            $users = $this->session->userdata('users_id');
            $data = array(
                'sheader'    => 'pages/ext/sheader',
                'sfooter'    => 'pages/ext/sfooter',
                'level'      => $this->mod_misc_level->list_level(),
            );
            $this->load->view('pages/misc/vlevel/level_user', $data);
        }
    }
?>