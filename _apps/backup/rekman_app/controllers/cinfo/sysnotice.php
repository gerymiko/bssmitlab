<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysnotice extends CI_Controller {

        function __construct() {
            parent::__construct();
            $this->load->model(['minfo/mod_karir_info']);
            $this->output->enable_profiler(false);
        }

        function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu' 	  => 'pages/pcomp/vmenu',
                'content' => 'pages/pinfo/vnotice',
                'footer'  => 'pages/pcomp/vfooter',
                'count_daftar_lolos' => count($this->mod_karir_info->daftar_lolos()),
        	);
        	$this->load->view('pages/index', $data);
        }

        public function table_peserta(){
            $daftarlolos = $this->mod_karir_info->get_datatables();
            $data        = array();
            $no          = $this->input->post('start');

            foreach ($daftarlolos as $field) {
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->nama;
                $row[]  = $field->Nama;
                $row[]  = $field->keterangan;
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_karir_info->count_all(),
                 "recordsFiltered" => $this->mod_karir_info->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>