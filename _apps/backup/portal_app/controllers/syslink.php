<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslink extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('https://web.binasaranasukses.com/portal');
            }
        }
		
		public function logo(){
            $lokasi      = dirname("E:\\").'/images/logo';
            $filename    = $lokasi.'/'.urldecode("logox.png");
            header('Content-Description: File Transfer');
            header('Content-Type: application/file');
            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            header("Last-Modified: ".date ("D, d M Y H:i:s", filemtime($filename))." GMT");
            ob_clean();
            flush();
            readfile($filename);
            exit;
        }

    }
?>