<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syscontact extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mcontact/Mod_contact']);
        }

        public function index(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/pmenu/menu',
                'content' => 'pages/pcontact/contact',
            );
        	$this->load->view('pages/pindex/index', $data);
        }

    }
?>