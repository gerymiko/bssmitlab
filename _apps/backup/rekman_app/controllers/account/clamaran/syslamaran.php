<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslamaran extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model(['mlamaran/mod_karir_lamaran', 'mloker/mod_karir_loker']);
        }

        public function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu'    => 'pages/account/grid/vmenu',
                'content' => 'pages/account/lamaran/vlamaran',
                'footer'  => 'pages/account/grid/vfooter'
        	);
        	$this->load->view('pages/account/index', $data);
        }

        public function table_lamaran(){
            $people_id = $this->session->userdata('people_id');
            $lamaran   = $this->mod_karir_lamaran->get_datatables($people_id);
            $data      = array();
            $no        = $this->input->post('start');
           
            foreach ($lamaran as $field) {
                $status_lowongan = $field->lowongan_status;
                if ($status_lowongan == 1) {
                    if ($field->keterangan_gagal == NULL) {
                        $status_lamaran = "Proses Seleksi Berkas";
                    } else {
                        $status_lamaran = $field->keterangan_gagal;
                    }
                } else {
                    if ($field->keterangan_gagal !== NULL) {
                        $status_lamaran = $field->keterangan_gagal;
                    } else {
                        $status_lamaran = "Lowongan telah ditutup";
                    }
                }

                if ($field->keterangan_gagal !== NULL) {
                    $btn_btl = "disabled";
                } else {
                    $btn_btl = "";
                }
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->jabatan_alias;
                $row[]  = date("d-M-Y", strtotime($field->tgl_melamar));
                $row[]  = $status_lamaran;
                $row[]  = '<button class="btn btn-sm btn-danger" '.$btn_btl.' style="padding-top: 2px;padding-bottom: 2px">Batalkan</button>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_karir_lamaran->count_all($people_id),
                "recordsFiltered" => $this->mod_karir_lamaran->count_filtered($people_id),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function apply_job(){

            $data = array(
                'people_id'   => $this->input->post('people_id'),
                'lowongan_id' => $this->input->post('lowongan_id')
            );
            $cek_pelamar = $this->mod_karir_lamaran->cek_pelamar($data);

            if ($cek_pelamar == TRUE) {
                echo "Duplicate";
            } else {
                echo $getLowongan = $this->mod_karir_loker->getLowongan($data['lowongan_id']);

            }
        }

    }
?>