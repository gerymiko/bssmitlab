<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysprofile extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mprofile/mod_profile', 'mglobal/mod_global']);
            if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null) {
                redirect('logisisse');
            } else {
				$getAccessModule = $this->mod_global->get_status_access_priv($this->session->userdata('id_user'));
				$resultModule  = $this->in_multiarray("9", $getAccessModule, "id_module");
                if ($resultModule == false || $this->session->userdata('id_level') == 3) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have the authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/site');
                }
            }
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private function in_multiarray($elem, $array, $field) {
            $top = sizeof($array) - 1;
            $bottom = 0;
            while($bottom <= $top) {
                if($array[$bottom][$field] == $elem)
                    return true;
                else
                    if(is_array($array[$bottom][$field]))
                        if(in_multiarray($elem, ($array[$bottom][$field])))
                            return true;
                $bottom++;
            }
            return false;
        }

        public function profile(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'content' => 'pages/pprofile/vprofile',
                'menu'    => 'pages/ptopbar/vtopbarext',
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/css/buttons.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.css">',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/hometis/select2/dist/css/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/sweetalert/sweetalert2.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/dataTables.buttons.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/buttons/buttons.html5.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/bs-datatables/js/jszip/jszip.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/toastr/toastr.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/hometis/select2/dist/js/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/frame', $data);
        }
    }
?>