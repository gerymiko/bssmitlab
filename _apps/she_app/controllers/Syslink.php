<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslink extends CI_Controller {

        function __construct(){
            parent::__construct();
        }

        public function get_image_jpg($img){
            $lokasi   = dirname("D:\\").'/images/she';
            $filename = $lokasi.'/'.urldecode($img.'.jpg');
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

        public function get_image_png($img){
            $lokasi   = dirname("D:\\").'/images/she';
            $filename = $lokasi.'/'.urldecode($img.'.png');
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