<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syselection extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == NULL) {
                redirect('http://bss.com/rekrutmen');
            }
        }

        function index(){
        	$data = array(
        		'sheader' => 'pages/ext/header',
                'sfooter' => 'pages/ext/footer',
                'menu'    => 'pages/account/grid/vmenu',
                'content' => 'pages/pinfo/velection',
                'footer'  => 'pages/account/grid/vfooter'
            );
            $this->load->view('pages/account/index', $data);
        }



    }
?>