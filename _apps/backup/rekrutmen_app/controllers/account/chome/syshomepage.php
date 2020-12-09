<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syshomepage extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') !== 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
            }
            $this->load->model(['mhome/mod_karir_home']);
        }

        public function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
        		'sfooter' => 'pages/ext/footer',
        		'menu'    => 'pages/account/grid/vmenu',
                'content' => 'pages/pmain/vmain',
                'footer'  => 'pages/account/grid/vfooter',
                'countloker'   => count($this->mod_karir_home->loker()),
                'countuser'    => count($this->mod_karir_home->user()),
                'countpelamar' => count($this->mod_karir_home->pelamar()),
                'countjabatan' => count($this->mod_karir_home->jabatan())
        	);
        	$this->load->view('pages/account/index', $data);
        }

    }
?>