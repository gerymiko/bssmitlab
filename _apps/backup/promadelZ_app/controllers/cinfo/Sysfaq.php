<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfaq extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mfaq/Mod_faq']);
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/pmenu/menu',
                'content' => 'pages/pinfo/faq/faq',
            );
        	$this->load->view('pages/pindex/index', $data);
        }

    }
?>