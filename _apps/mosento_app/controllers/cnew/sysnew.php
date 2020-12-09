<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysnew extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null) {
                redirect('login');
            }
            $this->load->model(['mnew/mod_new']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        public function index(){
            $data = array(
                'header'      => 'pages/ext/header',
                'footer'      => 'pages/ext/footer',
                'css_script'  => array(
                    '<link rel ="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                ),
                'js_script'   => array(
                    '<script type ="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/amcharts4/v447/core.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/amcharts4/v447/charts.js"></script>'
                )
            );
            $this->load->view('pages/pnew/vnew', $data);
        }

        public function chart_data(){
            $getdata = $this->mod_new->downtime();
            $output = array();
            foreach ($getdata as $row) {
                $output[] = array(
                    'tahun' => $row->tahun,
                    'first' => $row->nama_perusahaan
                );
            }
            echo json_encode($output);
        }

        public function chart_data1(){
            $output = [];
            $getkontrak = $this->mod_new->kontrak();
            $getdown = $this->mod_new->downtime1();
            foreach ($getdown as $key) {
                $output1 = array(
                    'tahun' => $key->tahun
                );
                foreach ($getkontrak as $row) {
                    $getparam = $this->mod_new->downtime_ex($key->tahun, $row->no_kontrak);
                    $outputval = ($getparam == null ? 0 : $getparam->JamDowntime);
                    if (isset($output1[$row->nama_perusahaan.'-'.$row->site])) {
                       $output1[$row->nama_perusahaan.'-'.$row->site]+=$outputval;
                        // $output1['first']+=$outputval;
                    } else {
                       $output1[$row->nama_perusahaan.'-'.$row->site] = $outputval;
                        // $output1['first'] = $outputval;
                    }           
                }
                $output[] = $output1;
            }
            echo json_encode($output);
        }
    }
?>