<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspelamarall extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/pelamar/mod_hr_pelamar_all','hrDept/mod_hr_dashboard', 'mod_master']);
            $this->date_only_def  = date("Y-m-d");
            $this->output->enable_profiler(false);
        }

        public function table_pelamar_all(){
            $pelamar_all = $this->mod_hr_pelamar_all->get_datatables();
            $data        = array();
            $no          = $this->input->post('start');
            
            foreach ($pelamar_all as $field) {
                $no++;
                $dateborn = $field->people_birth_date;    
                $date     = new DateTime($field->people_birth_date);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Tahun");

                $condition = ($field->freshgraduate == 0) ? 'No' : 'Yes';
                $tglamar = date("Y-m-d", strtotime($field->tgl_melamar));
                if ($tglamar == $this->date_only_def) {
                    $new = " <span class='badge badge-secondary badge-roundless'>Baru</span>";
                } else {
                    $new = "";
                }
                $nama = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $pelamar_id     = $field->pelamar_id;
                $status_pelamar = $this->mod_hr_pelamar_all->status_pelamar($pelamar_id);

                if ($status_pelamar == true) {
                    $statuspelamar = '<p class="green">Proses Interview</p>';
                } else {
                    $statuspelamar = 'Belum dipanggil';
                }

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = $nama.$new;
                $row[]  = $field->registrant_kode;
                $row[]  = $condition;
                $row[]  = $usia;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->city_name;
                $row[]  = date("d/m/Y", strtotime($field->tgl_melamar));
                $row[]  = $statuspelamar;
                $row[]  = ' <a onClick="ajax_load(\''.site_url().'detailPeople/'.$field->people_id.'/'.$field->registrant_kode.'\')" class="btn btn-primary btn-xs" id="detail'.$no.'" >
                                <i class="fa fa-user"></i>
                            </a>
                            <a target="_blank" href="'.site_url().'downloadPdf/'.$field->people_id.'" class="btn btn-orange btn-xs" id="pdf'.$no.'">
                                <i class="fa fa-file-pdf"></i>
                            </a>';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_pelamar_all->count_all(),
                 "recordsFiltered" => $this->mod_hr_pelamar_all->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function pelamar_all(){
            $data = array(
                'sheader'      => 'pages/ext/sheader',
                'sfooter'      => 'pages/ext/sfooter',
                'city'         => $this->mod_master->city(),
                'pic'          => $this->mod_master->pic(),
                'totalPelamar' => $this->mod_hr_dashboard->getpelamartotal(),
            );
            $this->load->view('pages/hr/pelamar/pelamar_all', $data);
        }
    }
?>