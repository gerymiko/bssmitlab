<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspengguna extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mpengguna/mod_hr_pengguna']);
            $this->date_only_def  = date("Y-m-d");
        }

        function pengguna(){
            $data = array(
                'sheader'       => 'pages/ext/sheader',
                'sfooter'       => 'pages/ext/sfooter',
                'totalpengguna' => $this->mod_hr_pengguna->count_all(),
            );
            $this->load->view('pages/hr/vpengguna/pengguna',$data);
        }

        public function table_pengguna(){
            $pengguna = $this->mod_hr_pengguna->get_datatables();
            $data     = array();
            $no       = $this->input->post('start');

            foreach ($pengguna as $field) {
                $no++;
                $dateborn = $field->people_birth_date;    
                $date     = new DateTime($dateborn);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Tahun");

                $tgldaftar = date("Y-m-d", strtotime($field->people_reg_date));
                if ($tgldaftar == $this->date_only_def) {
                    $new = " <span class='badge badge-secondary badge-roundless'>New</span>";
                } else {
                    $new = "";
                }
                $nama   = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $field->people_gender;
                $row[]  = $usia;
                $row[]  = $field->city_name;
                $row[]  = $field->people_email;
                $row[]  = $field->people_phone.' / '.$field->people_mobile;
                $row[]  = $field->total_lamar." Kali";
                $row[]  = date("d/m/Y", strtotime($field->people_reg_date));
                $row[]  = ' <a onClick="ajax_load(\''.site_url().'detailPeople/'.$field->people_id.'\')" class="btn btn-warning btn-xs" id="detail'.$no.'">
                                <i class="fa fa-user"></i>
                            </a>
                            <a target="_blank" href="'.site_url().'downloadPdf/'.$field->people_id.'" class="btn btn-primary btn-xs" id="pdf'.$no.'">
                                <i class="fa fa-file-pdf"></i>
                            </a>';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_pengguna->count_all(),
                 "recordsFiltered" => $this->mod_hr_pengguna->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>