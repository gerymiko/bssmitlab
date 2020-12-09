<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysnews extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mnews/Mod_news']);
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/pmenu/menu',
                'content' => 'pages/pinfo/news/news',
            );
        	$this->load->view('pages/pindex/index', $data);
        }

    }
?>