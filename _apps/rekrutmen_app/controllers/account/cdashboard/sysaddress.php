<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysaddress extends CI_Controller {

        function __construct() {
            parent::__construct();
            // if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
            //     redirect('http://web.binasaranasukses.com/portal');
            // }
            if ($this->session->userdata('username') == NULL) {
                redirect('http://bss.com/rekrutmen');
            }
            $this->load->model(['mperson/mod_karir_address', 'mglobal/mod_karir_global']);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,\/]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9-_.:]/','', $number);
            return $result;
        }

        public function save_edit_address1(){
            $paddress_id = $this->input->post('paddress_id1');
            $data = array(
                'address'  => $this->pregReps($this->input->post('address1')),
                'city_id'  => $this->pregRepn($this->input->post('paddress_city1')),
                'zip_code' => $this->pregRepn($this->input->post('zip_code1')),
                'paddress_update_date' => date("Y-m-d H:i:s")
            );
            $result = $this->mod_karir_address->update_address1($paddress_id, $data);
            if ($result == TRUE) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function save_edit_address2(){
            $paddress_id = $this->input->post('paddress_id2');
            $data = array(
                'address'  => $this->pregReps($this->input->post('address2')),
                'city_id'  => $this->pregRepn($this->input->post('paddress_city2')),
                'zip_code' => $this->pregRepn($this->input->post('zip_code2')),
                'paddress_update_date' => date("Y-m-d H:i:s")
            );
            $result = $this->mod_karir_address->update_address2($paddress_id, $data);
            if ($result == TRUE) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>