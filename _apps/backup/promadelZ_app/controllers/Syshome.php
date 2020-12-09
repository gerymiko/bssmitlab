<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syshome extends CI_Controller {

        function __construct(){
            parent::__construct();
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/pmenu/menu',
                'content' => 'pages/phome/home',
            );
        	$this->load->view('pages/pindex/index', $data);
        }

    }
?>