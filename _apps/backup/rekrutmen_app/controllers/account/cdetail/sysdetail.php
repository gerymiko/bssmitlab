<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdetail extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') !== 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
            }$this->load->model([
                'mperson/mod_karir_person',
                'mdetail/mod_karir_detail'
            ]);
            $this->load->model(['mdetail/mod_karir_detail']);
        }

        public function detail_loker($id){
            $lowongan_id = $this->encrypt->decode($id);
            $people_id   = $this->session->userdata('people_id');
            $data = array(
                'sheader'   => 'pages/ext/header',
                'sfooter'   => 'pages/ext/footer',
                'menu'      => 'pages/account/grid/vmenu',
                'content'   => 'pages/pdetail/vdloker',
                'footer'    => 'pages/account/grid/vfooter',
                'dperson'   => $this->mod_karir_person->detail_personal($people_id),
                'dloker'    => $this->mod_karir_detail->detailoker($lowongan_id),
                'dsyarat'   => $this->mod_karir_detail->detail_syaratreq($lowongan_id),
                'dedureq'   => $this->mod_karir_detail->detail_edureq($lowongan_id),
                'dskillreq' => $this->mod_karir_detail->detail_skillreq($lowongan_id),
                'dsertreq'  => $this->mod_karir_detail->detail_certreq($lowongan_id),
                'other_jobs'=> $this->mod_karir_detail->other_jobs(),
            );
            $this->load->view('pages/account/index', $data);
        }
    }
?>