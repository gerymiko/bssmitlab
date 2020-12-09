<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfeature extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mfeature/Mod_feature']);
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/pmenu/menu',
                'content' => 'pages/pfeature/feature',
            );
        	$this->load->view('pages/pindex/index', $data);
        }

    }
?>