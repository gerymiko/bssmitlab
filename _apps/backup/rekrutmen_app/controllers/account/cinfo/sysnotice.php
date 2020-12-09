<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysnotice extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') !== 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
            }
            $this->load->model(['minfo/mod_karir_info']);
        }

        function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
                'sfooter' => 'pages/ext/footer',
                'menu'    => 'pages/account/grid/vmenu',
                'content' => 'pages/pinfo/vnotice',
                'footer'  => 'pages/account/grid/vfooter',
                'count_daftar_lolos' => count($this->mod_karir_info->daftar_lolos()),
            );
            $this->load->view('pages/account/index', $data);
        }

    }
?>