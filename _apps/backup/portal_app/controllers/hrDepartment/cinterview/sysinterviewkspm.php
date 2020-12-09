<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysinterviewkspm extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/interview/mod_interview_kspm','mod_master']);
        }

        public function table_interview_kspm(){
            $pelamar_kpsm = $this->mod_interview_kspm->get_datatables();
            $data        = array();
            $no          = $_POST['start'];
            
            foreach ($pelamar_kpsm as $field) {
                $no++;
                $dateborn = $field->people_birth_date;    
                $date     = new DateTime($dateborn);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Tahun");
                if ($field->freshgraduate == 0){
                    $condition = 'No';
                } else {
                    $condition = 'Yes';
                }
                $nama   = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = "
                        <input type='checkbox' name='people_id' id='people_id' value='".$field->people_id."'>
                        <input type='hidden' name='people_name' id='people_name' class='people_name' value='".$field->people_firstname." ".$field->people_middlename." ".$field->people_lastname."'>
                        <input type='hidden' name='pelamar_id' id='pelamar_id' value='".$field->pelamar_id."'>
                        ";
                $row[]  = $nama;
                $row[]  = $condition;
                $row[]  = $usia;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = $field->city_name;
                $row[]  = date("d/m/Y", strtotime($field->tgl_melamar));
                $row[]  = ' <a href="" class="btn btn-blue btn-xs">
                                <i class="entypo-info"></i>
                            </a>
                            <a href="" class="btn btn-orange btn-xs">
                                <i class="entypo-down"></i>
                            </a>
                            ';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $_POST['draw'],
                 "recordsTotal"    => $this->mod_interview_kspm->count_all(),
                 "recordsFiltered" => $this->mod_interview_kspm->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function interview_kspm(){
            $data = array(
                    'sheader'      => 'pages/ext/sheader',
                    'sfooter'      => 'pages/ext/sfooter',
                    'city'         => $this->mod_master->city(),
                    'pic'          => $this->mod_master->pic(),
                    'totalPelamarKspm' => $this->mod_interview_kspm->count_all(),
            );
            $this->load->view('pages/hr/interview/interview_kspm', $data);
        }

    }
?>