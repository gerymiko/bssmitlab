<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysabout extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mabout/Mod_about']);
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/pmenu/menu',
                'content' => 'pages/pabout/about',
            );
        	$this->load->view('pages/pindex/index', $data);
        }

    }
?>