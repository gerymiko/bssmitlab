<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslink extends CI_Controller {

        function __construct() {
            parent::__construct();
        }
		
		public function logo(){
            $lokasi      = dirname("D:\\").'/images/portal';
            $filename    = $lokasi.'/'.urldecode("portal.png");
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