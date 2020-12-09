<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspelamarjabatan extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/pelamar/mod_hr_pelamar_perjabatan','hrDept/mod_hr_dashboard']);
            $this->date_only_def  = date("Y-m-d");
        }

        public function table_pelamar_perjabatan(){
            $pelamar_perjabatan = $this->mod_hr_pelamar_perjabatan->getpelamarperjabatan();
            $data = array();
            $no   = $this->input->post('start');
            foreach ($pelamar_perjabatan as $field) {

                $tglbuat = date("Y-m-d", strtotime($field->date_create));
                if ($tglbuat == $this->date_only_def) {
                    $new = " <span class='badge badge-danger badge-roundless'>Baru</span>";
                } else {
                    $new = "";
                }

                $no++;
                $row    = array();
                $row[]  = '
                        <a onClick="ajax_load(\''.site_url().'dperjabatan/'.$field->lowongan_id.'/'.strtolower($field->kode_lowongan).'\')" style="cursor: pointer;">
                            <div class="white-bg" style="border: 1px solid #ddd; padding: 10px; margin-bottom:5px;">
                                <strong>'.$field->jabatan_alias.'</strong>'.$new.'
                            </div>
                        </a>';
                $row[]  = '<div class="white-bg text-center" style="border: 1px solid #ddd; padding: 10px; margin-bottom:5px;">'.$field->total.'</div>';
                $data[] = $row;
            }
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_perjabatan->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_perjabatan->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function pelamar_perjabatan(){
            $data = array(
                'sheader'      => 'pages/ext/sheader',
                'sfooter'      => 'pages/ext/sfooter',
                'totalPelamar' => $this->mod_hr_dashboard->getpelamartotal()
            );
            $this->load->view('pages/hr/pelamar/pelamar_perjabatan', $data);
        }

        public function detail_perjabatan($lowongan_id){
            $data = array(
                'sheader'        => 'pages/ext/sheader',
                'sfooter'        => 'pages/ext/sfooter',
                'totalPelamarJB' => $this->mod_hr_pelamar_perjabatan->get_count_all($lowongan_id),
                'detailjb'       => $this->mod_hr_pelamar_perjabatan->getdetailjb($lowongan_id),
            );
            $this->load->view('pages/hr/vdetail/detail_perjabatan', $data);
        }

        public function table_detail_perjabatan($lowongan_id){
            $pelamar_djabatan = $this->mod_hr_pelamar_perjabatan->get_datatables($lowongan_id);
            $data        = array();
            $no          = $_POST['start'];
            
            foreach ($pelamar_djabatan as $field) {
                $no++;
                $dateborn = $field->people_birth_date;    
                $date     = new DateTime($dateborn);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Tahun");

                $condition = ($field->freshgraduate == 0) ? 'No' : 'Yes';
                $tglamar = date("Y-m-d", strtotime($field->tgl_melamar));
                if ($tglamar == $this->date_only_def) {
                    $new = " <span class='badge badge-danger badge-roundless'>Baru</span>";
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
                                <span data-balloon-length="" data-balloon="Detail" data-balloon-pos="up">
                                    <i class="fa fa-user"></i>
                                </span>
                            </a>
                            <a target="_blank" href="'.site_url().'downloadPdf/'.$field->people_id.'" class="btn btn-primary btn-xs" id="pdf'.$no.'">
                                <span data-balloon-length="" data-balloon="PDF" data-balloon-pos="up">
                                    <i class="fa fa-file-pdf"></i>
                                </span>
                            </a>';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $_POST['draw'],
                 "recordsTotal"    => $this->mod_hr_pelamar_perjabatan->get_count_all($lowongan_id),
                 "recordsFiltered" => $this->mod_hr_pelamar_perjabatan->get_count_filtered($lowongan_id),
                 "data"            => $data,
            );
            echo json_encode($output);
        }
    }
?>