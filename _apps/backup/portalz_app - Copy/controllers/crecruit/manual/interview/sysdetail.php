<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdetail extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/manual/interview/mod_detail', 'mglobal/mod_global']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        public function detail_interview($id){
            $id = $this->my_encryption->decode($this->pregReps($id));
            $data = array(
                'detail'      => $this->mod_detail->detail_people_and_interview($id),
                'dinterview'  => $this->mod_detail->detail_interview($id),
                'listjabatan' => $this->mod_global->list_jabatan(),
                'listsite'    => $this->mod_global->list_site(),
                'listpic'     => $this->mod_global->list_pic(),
            );
            $this->load->view('pages/precruit/manual/interview/detail', $data);
        }
    }
?>