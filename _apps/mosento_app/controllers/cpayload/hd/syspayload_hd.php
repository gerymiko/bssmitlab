<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspayload_hd extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('detail_payload'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site !== $this->uri->segment(3) || $this->accessRights->status_active !== 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/site');
                } elseif ($this->accessRights!=null && $this->accessRights->read !== 1 || $this->accessRights->status_active !== 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                }
            }
            $this->load->model(['mpayload/hd/mod_payload_hd']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        private static function viewTime($time){
            return $result = date("H:i:s", strtotime($time));
        }

        private static function reformat_payload($object){
            return $result = number_format(round(floatval($object / 10), 2), 2);
        }

        private static function reformat_bcm($object){
            return $result = number_format(round(floatval($object  / 10 / 2.47), 2), 2);
        }

        public function array_fungsi($dataarray, $value1, $value2 = null){
            $valarray = array();
            foreach ($dataarray as $key) {
                if ($value2 != null) {
                    $valfinal = floatval($key['payload'] / $value1 / $value2);
                } else {
                    $valfinal = floatval($key['payload'] / $value1);
                }
                $valarray[] = $valfinal;
            }
            return $valarray;
        }

        public function unit($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/ppayload/hd/vpayload_hd',
                'detail_hd' => $this->mod_payload_hd->get_detail_hd($site, $sn),
                'accessRights' => $this->accessRights,
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/dataTables.bootstrap.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/css/responsive.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/mosento/daterangepicker/daterangepicker.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/jquery.dataTables.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.bootstrap.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/bs-datatables/js/dataTables.responsive.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/moment/moment.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/daterangepicker/daterangepicker.min.js"></script>'
                ),
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_payload($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $all_payload = $this->mod_payload_hd->get_all_payload($sn, $site);
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $payload = $this->mod_payload_hd->get_data($sn, $length, $start, $site, 'a.payload');
            foreach ($payload as $field){
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['date'] = $this->viewDate($field->tgl);
                $row['time'] = $this->viewTime($field->dates);
                $row['payload'] = $this->reformat_payload($field->payload);
                $row['bcm'] = $this->reformat_bcm($field->payload);
                $row['opthd'] = ($field->nama == null && $field->nik == '') ? "-" : $field->nama.' ('.$field->nik.')';
                $row['loader'] = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nmloader'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader).' ('.$this->pregRepn($field->nikoprloader).')';
                $data[] = $row;
            };
            $payloadValue = $this->array_fungsi($all_payload, 10);
            $payloadBCM   = $this->array_fungsi($all_payload, 10, 2.47);
            if (empty($payloadValue)) { $averagePay = 0; } else { $averagePay = array_sum($payloadValue) / count($payloadValue); }
            if (empty($payloadBCM)) { $averageBCM = 0; $minBCM = 0; $maxBCM = 0; } else {
                $averageBCM = array_sum($payloadBCM) / count($payloadBCM); $minBCM = min($payloadBCM); $maxBCM = max($payloadBCM);
            }
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_payload_hd->count_all($sn, $site, 'a.payload'),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered($sn, $site, 'a.payload'),
                "data" => $data,
                "averageBCM" => number_format(round($averageBCM, 2), 2),
                "averagePay" => number_format(round($averagePay, 2), 2),
                "maxBCM" => number_format(round($maxBCM, 2), 2),
                "minBCM" => number_format(round($minBCM, 2), 2)
            );
            echo json_encode($output);
        }

        public function table_empty_drive_time($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $param = $this->mod_payload_hd->get_data($sn, $length, $start, $site, 'a.emptydrivetime');
            foreach ($param as $field){
                if (date("d-m-Y", strtotime($field->tgl)) == date("d-m-Y")) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['date'] = $this->viewDate($field->tgl);
                $row['time'] = $this->viewTime($field->dates);
                $row['emptydrivetime'] = floatval($field->emptydrivetime / 10);
                $row['opthd'] = ($field->nama == null && $field->nik == '') ? "-" : $field->nama.' ('.$field->nik.')';
                $row['loader'] = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nmloader'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader).' ('.$this->pregRepn($field->nikoprloader).')';
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_payload_hd->count_all($sn, $site, 'a.emptydrivetime'),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered($sn, $site, 'a.emptydrivetime'),
                "data" => $data
            );
            echo json_encode($output);
        }

        public function table_empty_drive_distance($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $param = $this->mod_payload_hd->get_data($sn, $length, $start, $site, 'a.emptydrivedistance');
            foreach ($param as $field){
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['date'] = $this->viewDate($field->tgl);
                $row['time'] = $this->viewTime($field->dates);
                $row['emptydrivedistance'] = floatval($field->emptydrivedistance / 10);
                $row['opthd'] = ($field->nama == null && $field->nik == '') ? "-" : $field->nama.' ('.$field->nik.')';
                $row['loader'] = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nmloader'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader).' ('.$this->pregRepn($field->nikoprloader).')';
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_payload_hd->count_all($sn, $site, 'a.emptydrivedistance'),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered($sn, $site, 'a.emptydrivedistance'),
                "data" => $data,
            );
            echo json_encode($output);
        }

        public function table_empty_stop_time($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $param = $this->mod_payload_hd->get_data($sn, $length, $start, $site, 'a.emptystoptime');
            foreach ($param as $field){
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['date'] = $this->viewDate($field->tgl);
                $row['time'] = $this->viewTime($field->dates);
                $row['emptystoptime'] = floatval($field->emptystoptime / 10);
                $row['opthd'] = ($field->nama == null && $field->nik == '') ? "-" : $field->nama.' ('.$field->nik.')';
                $row['loader'] = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nmloader'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader).' ('.$this->pregRepn($field->nikoprloader).')';
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_payload_hd->count_all($sn, $site, 'a.emptystoptime'),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered($sn, $site, 'a.emptystoptime'),
                "data" => $data,
            );
            echo json_encode($output);
        }

        public function table_loading_stop_time($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $param = $this->mod_payload_hd->get_data($sn, $length, $start, $site, 'a.loadingstoptime');
            foreach ($param as $field){
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['date'] = $this->viewDate($field->tgl);
                $row['time'] = $this->viewTime($field->dates);
                $row['loadingstoptime'] = floatval($field->loadingstoptime / 10);
                $row['opthd'] = ($field->nama == null && $field->nik == '') ? "-" : $field->nama.' ('.$field->nik.')';
                $row['loader'] = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nmloader'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader).' ('.$this->pregRepn($field->nikoprloader).')';
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_payload_hd->count_all($sn, $site, 'a.loadingstoptime'),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered($sn, $site, 'a.loadingstoptime'),
                "data" => $data,
            );
            echo json_encode($output);
        }

        public function table_loaded_drive_time($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $param = $this->mod_payload_hd->get_data($sn, $length, $start, $site, 'a.loadeddrivetime');
            foreach ($param as $field){
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['date'] = $this->viewDate($field->tgl);
                $row['time'] = $this->viewTime($field->dates);
                $row['loadeddrivetime'] = floatval($field->loadeddrivetime / 10);
                $row['opthd'] = ($field->nama == null && $field->nik == '') ? "-" : $field->nama.' ('.$field->nik.')';
                $row['loader'] = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nmloader'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader).' ('.$this->pregRepn($field->nikoprloader).')';
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_payload_hd->count_all($sn, $site, 'a.loadeddrivetime'),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered($sn, $site, 'a.loadeddrivetime'),
                "data" => $data,
            );
            echo json_encode($output);
        }

        public function table_loaded_stop_time($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $param = $this->mod_payload_hd->get_data($sn, $length, $start, $site, 'a.loadedstoptime');
            foreach ($param as $field){
                $start++;
                $row = array();
                $row['no'] = $start;
                $row['date'] = $this->viewDate($field->tgl);
                $row['time'] = $this->viewTime($field->dates);
                $row['loadedstoptime'] = floatval($field->loadedstoptime / 10);
                $row['opthd'] = ($field->nama == null && $field->nik == '') ? "-" : $field->nama.' ('.$field->nik.')';
                $row['loader'] = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nmloader'] = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader).' ('.$this->pregRepn($field->nikoprloader).')';
                $data[] = $row;
            };
            $output = array(
                "draw" => $this->pregRepn($this->input->post('draw')),
                "recordsTotal" => $this->mod_payload_hd->count_all($sn, $site, 'a.loadedstoptime'),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered($sn, $site, 'a.loadedstoptime'),
                "data" => $data,
            );
            echo json_encode($output);
        }

        // public function table_loaded_stop_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $loaded_stop_time = $this->mod_payload_hd->get_loaded_stop_time($sn);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($loaded_stop_time as $field){
        //         $no++;
        //         $row                   = array();
        //         $row['no']             = $no;
        //         $row['date']           = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']           = date("H:i A", strtotime($field->dates));
        //         $row['loadedstoptime'] = floatval($field->loadedstoptime / 10);
        //         $row['nik']            = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']           = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]                = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_loaded_stop_time($sn),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_loaded_stop_time($sn),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        // public function table_loaded_drive_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $loaded_drive_time = $this->mod_payload_hd->get_loaded_drive_time($sn);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($loaded_drive_time as $field){
        //         $no++;
        //         $row                    = array();
        //         $row['no']              = $no;
        //         $row['date']            = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']            = date("H:i A", strtotime($field->dates));
        //         $row['loadeddrivetime'] = floatval($field->loadeddrivetime / 10);
        //         $row['nik']             = $this->pregRepn($field->nik);
        //         $row['name']            = $this->pregReps($field->nama);
        //         $data[]                 = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_loaded_drive_time($sn),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_loaded_drive_time($sn),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        // public function table_loading_stop_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $loading_stop_time = $this->mod_payload_hd->get_loading_stop_time($sn);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($loading_stop_time as $field){
        //         $no++;
        //         $row                    = array();
        //         $row['no']              = $no;
        //         $row['date']            = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']            = date("H:i A", strtotime($field->dates));
        //         $row['loadingstoptime'] = floatval($field->loadingstoptime / 10);
        //         $row['nik']             = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']            = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]                 = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_loading_stop_time($sn),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_loading_stop_time($sn),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        // public function table_empty_stop_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $empty_stop_time = $this->mod_payload_hd->get_empty_stop_time($sn);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($empty_stop_time as $field){
        //         $no++;
        //         $row                  = array();
        //         $row['no']            = $no;
        //         $row['date']          = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']          = date("H:i A", strtotime($field->dates));
        //         $row['emptystoptime'] = floatval($field->emptystoptime / 10);
        //         $row['nik']           = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']          = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]               = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_empty_stop_time($sn),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_empty_stop_time($sn),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        // public function most_valuable_driver($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $max_mvd = $this->mod_payload_hd->max_bcm_monthly($sn);
        //     $min_mvd = $this->mod_payload_hd->min_bcm_monthly($sn);

        //     $arrays = array(
        //         'Opt. HD High BCM'   => $max_mvd->nama.' ['.$max_mvd->nik.']',
        //         'Opt. HD Low BCM'    => $min_mvd->nama.' ['.$min_mvd->nik.']',
        //         'Opt. Exca High BCM' => $max_mvd->nmloader.' ['.$max_mvd->nikoprloader.']',
        //         'Opt. Exca Low BCM'  => $min_mvd->nmloader.' ['.$min_mvd->nikoprloader.']',
        //     );

        //     $data = array();

        //     foreach ($arrays as $x => $key) {
        //         $row          = array();
        //         $row['value'] = $key;
        //         $row['label'] = $x;
        //         $data[]       = $row;
        //     }
        //     echo json_encode($data);
        // }

        // public function most_valuable_unit($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $max_mvd = $this->mod_payload_hd->max_bcm_monthly($sn);
        //     $min_mvd = $this->mod_payload_hd->min_bcm_monthly($sn);
        //     $max_mvd2 = $this->mod_payload_hd->array_max_bcm_monthly($sn);
        //     $min_mvd2 = $this->mod_payload_hd->array_min_bcm_monthly($sn);
        //     $payloadMaxBCM   = $this->array_fungsi($max_mvd2, 10, 2.47);
        //     $payloadMinBCM   = $this->array_fungsi($min_mvd2, 10, 2.47);

        //     $arrays = array(
        //         'HD High BCM'   => $max_mvd->unit.' ['.number_format(round(max($payloadMaxBCM), 2), 2).']',
        //         'HD Low BCM'    => $min_mvd->unit.' ['.number_format(round(min($payloadMinBCM), 2), 2).']',
        //         'Exca High BCM' => $max_mvd->loader.' ['.number_format(round(max($payloadMaxBCM), 2), 2).']',
        //         'Exca Low BCM'  => $min_mvd->loader.' ['.number_format(round(min($payloadMinBCM), 2), 2).']',
        //     );

        //     $data = array();

        //     foreach ($arrays as $x => $key) {
        //         $row          = array();
        //         $row['value'] = $key;
        //         $row['label'] = $x;
        //         $data[]       = $row;
        //     }
        //     echo json_encode($data);
            
        //     // var_dump(max($payloadBCM));
        //     // echo "<pre>";
        //     // var_dump($min_mvd);
        //     // echo "</pre>";
        // }        

        // public function search_table_payload($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $date1      = str_replace("/", "-", $this->input->post('date_start'));
        //     $date2      = str_replace("/", "-", $this->input->post('date_end'));
        //     $date_start = date("Y-m-d", strtotime($date1));
        //     $date_end   = date("Y-m-d", strtotime($date2));

        //     $payload     = $this->mod_payload_hd->get_spayload($sn, $date_start, $date_end);
        //     $all_payload = $this->mod_payload_hd->get_average_spayload($sn, $date_start, $date_end);

        //     $data    = array();
        //     $no      = $this->pregRepn($this->input->post('start'));

        //     foreach ($payload as $field) {
        //         $no++;
        //         $row                = array();
        //         $row['no']          = $no;
        //         $row['date']        = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']        = date("H:i A", strtotime($field->dates));
        //         $row['payload']     = number_format(round(floatval($field->payload / 10), 2), 2);
        //         $row['bcm_payload'] = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
        //         $row['nik']         = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']        = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $row['loader']      = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
        //         $row['nmloader']    = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader);
        //         $data[]             = $row;
        //     }

        //     $payloadValue = $this->array_fungsi($all_payload, 10);
        //     $payloadBCM   = $this->array_fungsi($all_payload, 10, 2.47);
        //     if (empty($payloadValue)) { $averagePay = 0;
        //     } else { $averagePay = array_sum($payloadValue) / count($payloadValue); }
        //     if (empty($payloadBCM)) { $averageBCM = 0; $minBCM = 0; $maxBCM = 0; } 
        //     else {
        //         $averageBCM = array_sum($payloadBCM) / count($payloadBCM);
        //         $minBCM     = min($payloadBCM);
        //         $maxBCM     = max($payloadBCM);
        //     }

        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_spayload($sn, $date_start, $date_end),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_spayload($sn, $date_start, $date_end),
        //         "data"            => $data,
        //         "averageBCM"      => number_format(round($averageBCM, 2), 2),
        //         "averagePay"      => number_format(round($averagePay, 2), 2),
        //         "maxBCM"          => number_format(round($maxBCM, 2), 2),
        //         "minBCM"          => number_format(round($minBCM, 2), 2)
        //     );
        //     echo json_encode($output);
        // }

        

        // public function search_table_empty_drive_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $date1      = str_replace("/", "-", $this->input->post('date_start'));
        //     $date2      = str_replace("/", "-", $this->input->post('date_end'));
        //     $date_start = date("Y-m-d", strtotime($date1));
        //     $date_end   = date("Y-m-d", strtotime($date2));

        //     $empty_drive_time = $this->mod_payload_hd->get_search_empty_drive_time($sn, $date_start, $date_end);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($empty_drive_time as $field){
        //         $no++;
        //         $row                   = array();
        //         $row['no']             = $no;
        //         $row['date']           = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']           = date("H:i A", strtotime($field->dates));
        //         $row['emptydrivetime'] = floatval($field->emptydrivetime / 10);
        //         $row['nik']            = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']           = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]                = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_search_empty_drive_time($sn, $date_start, $date_end),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_empty_drive_time($sn, $date_start, $date_end),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        

        // public function search_table_empty_drive_distance($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $date1      = str_replace("/", "-", $this->input->post('date_start'));
        //     $date2      = str_replace("/", "-", $this->input->post('date_end'));
        //     $date_start = date("Y-m-d", strtotime($date1));
        //     $date_end   = date("Y-m-d", strtotime($date2));

        //     $empty_drive_distance = $this->mod_payload_hd->get_search_empty_drive_distance($sn, $date_start, $date_end);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($empty_drive_distance as $field){
        //         $no++;
        //         $row                       = array();
        //         $row['no']                 = $no;
        //         $row['date']               = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']               = date("H:i A", strtotime($field->dates));
        //         $row['emptydrivedistance'] = floatval($field->emptydrivedistance / 10);
        //         $row['nik']                = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']               = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]                    = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_search_empty_drive_distance($sn, $date_start, $date_end),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_empty_drive_distance($sn, $date_start, $date_end),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        

        // public function search_table_empty_stop_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $date1      = str_replace("/", "-", $this->input->post('date_start'));
        //     $date2      = str_replace("/", "-", $this->input->post('date_end'));
        //     $date_start = date("Y-m-d", strtotime($date1));
        //     $date_end   = date("Y-m-d", strtotime($date2));

        //     $empty_stop_time = $this->mod_payload_hd->get_search_empty_stop_time($sn, $date_start, $date_end);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($empty_stop_time as $field){
        //         $no++;
        //         $row                  = array();
        //         $row['no']            = $no;
        //         $row['date']          = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']          = date("H:i A", strtotime($field->dates));
        //         $row['emptystoptime'] = floatval($field->emptystoptime / 10);
        //         $row['nik']           = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']          = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]               = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_search_empty_stop_time($sn, $date_start, $date_end),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_empty_stop_time($sn, $date_start, $date_end),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        

        // public function search_table_loading_stop_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $date1      = str_replace("/", "-", $this->input->post('date_start'));
        //     $date2      = str_replace("/", "-", $this->input->post('date_end'));
        //     $date_start = date("Y-m-d", strtotime($date1));
        //     $date_end   = date("Y-m-d", strtotime($date2));

        //     $loading_stop_time = $this->mod_payload_hd->get_search_loading_stop_time($sn, $date_start, $date_end);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($loading_stop_time as $field){
        //         $no++;
        //         $row                    = array();
        //         $row['no']              = $no;
        //         $row['date']            = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']            = date("H:i A", strtotime($field->dates));
        //         $row['loadingstoptime'] = floatval($field->loadingstoptime / 10);
        //         $row['nik']             = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']            = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]                 = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_search_loading_stop_time($sn, $date_start, $date_end),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_loading_stop_time($sn, $date_start, $date_end),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        

        // public function search_table_loaded_drive_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $date1      = str_replace("/", "-", $this->input->post('date_start'));
        //     $date2      = str_replace("/", "-", $this->input->post('date_end'));
        //     $date_start = date("Y-m-d", strtotime($date1));
        //     $date_end   = date("Y-m-d", strtotime($date2));

        //     $loaded_drive_time = $this->mod_payload_hd->get_search_loaded_drive_time($sn, $date_start, $date_end);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($loaded_drive_time as $field){
        //         $no++;
        //         $row                    = array();
        //         $row['no']              = $no;
        //         $row['date']            = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']            = date("H:i A", strtotime($field->dates));
        //         $row['loadeddrivetime'] = floatval($field->loadeddrivetime / 10);
        //         $row['nik']             = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']            = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]                 = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_search_loaded_drive_time($sn, $date_start, $date_end),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_loaded_drive_time($sn, $date_start, $date_end),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        

        // public function search_table_loaded_stop_time($sn){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));
        //     $date1      = str_replace("/", "-", $this->input->post('date_start'));
        //     $date2      = str_replace("/", "-", $this->input->post('date_end'));
        //     $date_start = date("Y-m-d", strtotime($date1));
        //     $date_end   = date("Y-m-d", strtotime($date2));

        //     $loaded_stop_time = $this->mod_payload_hd->get_search_loaded_stop_time($sn, $date_start, $date_end);
        //     $data = array();
        //     $no   = $this->pregRepn($this->input->post('start'));

        //     foreach ($loaded_stop_time as $field){
        //         $no++;
        //         $row                   = array();
        //         $row['no']             = $no;
        //         $row['date']           = date("d-m-Y", strtotime($field->tgl));
        //         $row['time']           = date("H:i A", strtotime($field->dates));
        //         $row['loadedstoptime'] = floatval($field->loadedstoptime / 10);
        //         $row['nik']            = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
        //         $row['name']           = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
        //         $data[]                = $row;
        //     };
        //     $output = array(
        //         "draw"            => $this->pregRepn($this->input->post('draw')),
        //         "recordsTotal"    => $this->mod_payload_hd->count_all_search_loaded_stop_time($sn, $date_start, $date_end),
        //         "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_loaded_stop_time($sn, $date_start, $date_end),
        //         "data"            => $data,
        //     );
        //     echo json_encode($output);
        // }

        // public function chart_payload($sn, $date_start_new, $date_end_new){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));

        //     $date_start = date("Y-m-d", strtotime($this->dateValid($date_start_new)));
        //     $date_end   = date("Y-m-d", strtotime($this->dateValid($date_end_new)));

        //     $payload = $this->mod_payload_hd->get_chart_payload($sn, $date_start, $date_end);
        //     foreach ($payload as $row) {
        //         $data[] = array(
        //             'date'    => date("Y-m-d H:i:s", strtotime($row->tgl)),
        //             'payload' => floatval($row->payload / 10),
        //             'bcm'     => floatval($row->payload / 10 / 2.47),
        //             'nik'     => $this->pregRepn($row->nik),
        //             'name'    => $this->pregReps($row->nama),
        //         );
        //     }
        //     echo json_encode($data);
        // }

        // public function chart_emptydrivetime($sn, $date_start_new, $date_end_new){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));

        //     $date_start = date("Y-m-d", strtotime($this->dateValid($date_start_new)));
        //     $date_end   = date("Y-m-d", strtotime($this->dateValid($date_end_new)));

        //     $emptydrivetime = $this->mod_payload_hd->get_chart_empty_drive_time($sn, $date_start, $date_end);
        //     foreach ($emptydrivetime as $row) {
        //         $output[] = array(
        //             'date'           => date("Y-m-d H:i:s", strtotime($row->tgl)),
        //             'emptydrivetime' => floatval($row->emptydrivetime / 10),
        //             'nik'            => $this->pregRepn($row->nik),
        //             'name'           => $this->pregReps($row->nama),
        //         );
        //     }
        //     echo json_encode($output);
        // }

        // public function chart_emptydrivedistance($sn, $date_start_new, $date_end_new){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));

        //     $date_start = date("Y-m-d", strtotime($this->dateValid($date_start_new)));
        //     $date_end   = date("Y-m-d", strtotime($this->dateValid($date_end_new)));

        //     $emptydrivedistance = $this->mod_payload_hd->get_chart_empty_drive_distance($sn, $date_start, $date_end);
        //     foreach ($emptydrivedistance as $row) {
        //         $output[] = array(
        //             'date'           => date("Y-m-d H:i:s", strtotime($row->tgl)),
        //             'emptydrivedistance' => floatval($row->emptydrivedistance / 10),
        //             'nik'            => $this->pregRepn($row->nik),
        //             'name'           => $this->pregReps($row->nama),
        //         );
        //     }
        //     echo json_encode($output);
        // }

        // public function chart_emptystoptime($sn, $date_start_new, $date_end_new){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));

        //     $date_start = date("Y-m-d", strtotime($this->dateValid($date_start_new)));
        //     $date_end   = date("Y-m-d", strtotime($this->dateValid($date_end_new)));

        //     $emptystoptime = $this->mod_payload_hd->get_chart_empty_stop_time($sn, $date_start, $date_end);
        //     foreach ($emptystoptime as $row) {
        //         $output[] = array(
        //             'date'          => date("Y-m-d H:i:s", strtotime($row->tgl)),
        //             'emptystoptime' => floatval($row->emptystoptime / 10),
        //             'nik'           => $this->pregRepn($row->nik),
        //             'name'          => $this->pregReps($row->nama),
        //         );
        //     }
        //     echo json_encode($output);
        // }

        // public function chart_loadingstoptime($sn, $date_start_new, $date_end_new){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));

        //     $date_start = date("Y-m-d", strtotime($this->dateValid($date_start_new)));
        //     $date_end   = date("Y-m-d", strtotime($this->dateValid($date_end_new)));

        //     $loadingstoptime = $this->mod_payload_hd->get_chart_loading_stop_time($sn, $date_start, $date_end);
        //     foreach ($loadingstoptime as $row) {
        //         $output[] = array(
        //             'date'            => date("Y-m-d H:i:s", strtotime($row->tgl)),
        //             'loadingstoptime' => floatval($row->loadingstoptime / 10),
        //             'nik'             => $this->pregRepn($row->nik),
        //             'name'            => $this->pregReps($row->nama),
        //         );
        //     }
        //     echo json_encode($output);
        // }

        // public function chart_loadeddrivetime($sn, $date_start_new, $date_end_new){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));

        //     $date_start = date("Y-m-d", strtotime($this->dateValid($date_start_new)));
        //     $date_end   = date("Y-m-d", strtotime($this->dateValid($date_end_new)));

        //     $loadeddrivetime = $this->mod_payload_hd->get_chart_loaded_drive_time($sn, $date_start, $date_end);
        //     foreach ($loadeddrivetime as $row) {
        //         $output[] = array(
        //             'date'          => date("Y-m-d H:i:s", strtotime($row->tgl)),
        //             'loadeddrivetime' => floatval($row->loadeddrivetime / 10),
        //             'nik'           => $this->pregRepn($row->nik),
        //             'name'          => $this->pregReps($row->nama),
        //         );
        //     }
        //     echo json_encode($output);
        // }

        // public function chart_loadedstoptime($sn, $date_start_new, $date_end_new){
        //     $sn = $this->my_encryption->decode($this->pregReps($sn));

        //     $date_start = date("Y-m-d", strtotime($this->dateValid($date_start_new)));
        //     $date_end   = date("Y-m-d", strtotime($this->dateValid($date_end_new)));

        //     $loadedstoptime = $this->mod_payload_hd->get_chart_loaded_stop_time($sn, $date_start, $date_end);
        //     foreach ($loadedstoptime as $row) {
        //         $output[] = array(
        //             'date'           => date("Y-m-d H:i:s", strtotime($row->tgl)),
        //             'loadedstoptime' => floatval($row->loadedstoptime / 10),
        //             'nik'            => $this->pregRepn($row->nik),
        //             'name'           => $this->pregReps($row->nama),
        //         );
        //     }
        //     echo json_encode($output);
        // }



    }
?>