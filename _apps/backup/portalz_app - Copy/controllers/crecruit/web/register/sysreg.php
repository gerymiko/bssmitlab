<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysreg extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null && $this->session->userdata('tipeapp') != 'PORTAL') {
                redirect('logisisse');
            }
            $this->load->model(['mrecruit/web/register/mod_register']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        public function index(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'topmenu'  => 'pages/ptopbar/vtopbar',
                'sidemenu' => 'pages/psidebar/vsidebar',
                'content'  => 'pages/precruit/web/register/view',
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_register(){
            $data     = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $register = $this->mod_register->get_register($length, $start);
            foreach ($register as $field){
                $date     = new DateTime($field->people_birth_date);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $age      = $interval->format("%y Tahun");
                $date_regend = date("Y-m-d", strtotime("+14 day", strtotime($field->people_reg_date)));
                $date_regis  = $field->people_reg_date;
                if (strtotime($date_regend) > strtotime(date("Y-m-d"))) {
                    $new = " <span class='label label-success'>Baru</span>";
                } else {
                    $new = "";
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['name']     = ucwords(strtolower($field->people_fullname)).$new;
                $row['gender']   = $field->people_gender;
                $row['age']      = $age;
                $row['domisili'] = $field->city_name;
                $row['email']    = ($field->people_email == null) ? "-" : strtolower($field->people_email);
                $row['mobile']   = $field->people_phone.' / '.$field->people_mobile;
                $row['apply']    = $field->total_lamar." Kali";
                $row['date']     = $this->viewDate($field->people_reg_date);
                $row['action']   = '<a class="btn btn-primary btn-xs" data-tooltip="Detail" onclick="detailApplicant(\''.$this->my_encryption->encode($field->people_id).'\')" >
                                        <i class="fas fa-user-tie"></i>
                                    </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_register->count_all(),
                "recordsFiltered" => $this->mod_register->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>