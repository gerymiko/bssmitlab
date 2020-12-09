<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdetail extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/manual/applicant/mod_detail', 'mglobal/mod_global']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        public function detail_applicant($id){
            $id   = $this->my_encryption->decode($this->pregReps($id));
            $data = array(
                'dapplicant'  => $this->mod_detail->detail_applicant($id),
                'daddress'    => $this->mod_detail->detail_address($id),
                'dlisence'    => $this->mod_detail->detail_lisence($id),
                'dexperience' => $this->mod_detail->detail_experience($id),
                'dskill'      => $this->mod_detail->detail_skill($id),
                'grade'       => $this->mod_global->list_grade(),
                'dinterview'  => $this->mod_detail->history_interview($id),
            );
            $this->load->view('pages/precruit/manual/applicant/detail', $data);
        }
    }
?>