<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspelamarfg extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/pelamar/mod_hr_pelamar_fg','hrDept/mod_hr_dashboard', 'mod_master']);
            $this->date_only_def  = date("Y-m-d");
        }

        public function table_pelamar_fg(){
            $pelamar_fg = $this->mod_hr_pelamar_fg->get_datatables();
            $data       = array();
            $no         = $this->input->post('start');
            
            foreach ($pelamar_fg as $field) {
                $no++;
                $dateborn = $field->people_birth_date;    
                $date     = new DateTime($dateborn);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Tahun");
                $nama     = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $tglamar = date("Y-m-d", strtotime($field->tgl_melamar));
                if ($tglamar == $this->date_only_def) {
                    $new = " <span class='badge badge-secondary badge-roundless'>Baru</span>";
                } else {
                    $new = "";
                }

                $posisi = ($field->jabatan_alias == null) ? "-" : $field->jabatan_alias;

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $usia;
                $row[]  = $posisi;
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
                 "recordsTotal"    => $this->mod_hr_pelamar_fg->count_all(),
                 "recordsFiltered" => $this->mod_hr_pelamar_fg->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function pelamar_freshgrad(){
            $data   = array(
                'sheader'    => 'pages/ext/sheader',
                'sfooter'    => 'pages/ext/sfooter',
                'fgtotal'    => $this->mod_hr_dashboard->getfgtotal(),
            );
            $this->load->view('pages/hr/pelamar/pelamar_freshgrad', $data);
        }
    }
?>