<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdetail extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/web/election/mod_applicant']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        public function detail_applicant($id){
            $id   = $this->my_encryption->decode($this->pregReps($id));
            $data = array(
                'dapplicant'   => $this->mod_applicant->detail_applicant($id),
                'daddrshome'   => $this->mod_applicant->detail_addr_hometown($id),
                'daddrsdom'    => $this->mod_applicant->detail_addr_domicile($id),
                'deduformal'   => $this->mod_applicant->detail_eduformal($id),
                'deduinformal' => $this->mod_applicant->detail_eduinformal($id),
                'dlisence'     => $this->mod_applicant->detail_lisence($id),
                'dstatus'      => $this->mod_applicant->detail_status($id),
                'dexperiance'  => $this->mod_applicant->detail_experiance($id),
                'dquest'       => $this->mod_applicant->detail_question($id),
            );
            $this->load->view('pages/precruit/web/applicant/detail', $data);
        }
    }
?>