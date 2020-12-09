<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspelamarqualify extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/pelamar/mod_hr_pelamar_qualify','hrDept/mod_hr_dashboard', 'mod_master']);
            $this->date_only_def  = date("Y-m-d");
        }

        public function table_pelamar_qualify(){
            $pelamar_qualify = $this->mod_hr_pelamar_qualify->get_datatables();
            $data        = array();
            $no          = $this->input->post('start');
            
            foreach ($pelamar_qualify as $field) {
                $no++;
                $dateborn = $field->people_birth_date;    
                $date     = new DateTime($dateborn);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Tahun");

                $condition = ($field->freshgraduate == 0) ? 'No' : 'Yes';
                $tglamar = date("Y-m-d", strtotime($field->tgl_melamar));
                if ($tglamar == $this->date_only_def) {
                    $new = " <span class='badge badge-secondary badge-roundless'>New</span>";
                } else {
                    $new = "";
                }

                $nama   = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $condition;
                $row[]  = $usia;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = $field->city_name;
                $row[]  = date("d/m/Y", strtotime($field->tgl_melamar));
                $row[]  = ' <a onClick="ajax_load(\''.site_url().'detailPeople/'.$field->people_id.'/'.$field->registrant_kode.'\')" class="btn btn-warning btn-xs" id="detail'.$no.'">
                                <i class="fa fa-user"></i>
                            </a>
                            <a target="_blank" href="'.site_url().'downloadPdf/'.$field->people_id.'" class="btn btn-primary btn-xs" id="pdf'.$no.'">
                                <i class="fa fa-file-pdf"></i>
                            </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_qualify->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_qualify->count_filtered(),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function pelamar_qualify(){
            $data = array(
                'sheader'      => 'pages/ext/sheader',
                'sfooter'      => 'pages/ext/sfooter',
                'city'         => $this->mod_master->city(),
                'pic'          => $this->mod_master->pic(),
                'qualifytotal' => $this->mod_hr_dashboard->getqualifytotal(),
            );
            $this->load->view('pages/hr/pelamar/pelamar_qualify', $data);
        }
    }
?>