<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspayload_hd extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mpayload/hd/mod_payload_hd']);
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function dateValid($number){ 
            $result = preg_replace('/[^0-9-]/','', $number);
            return $result;
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

        public function unit($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
        	$data = array(
                'header'    => 'pages/ext/header',
                'footer'    => 'pages/ext/footer',
                'menu'      => 'pages/ptopbar/vtopbar',
                'content'   => 'pages/ppayload/hd/vpayload_hd',
                'detail_hd' => $this->mod_payload_hd->get_detail_hd($sn),
                'site_unit' => $this->mod_payload_hd->get_unit_hd($sn)
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function info_payload($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $all_payload = $this->mod_payload_hd->get_all_payload($sn);

            $payloadValue = $this->array_fungsi($all_payload, 10);
            $payloadBCM   = $this->array_fungsi($all_payload, 10, 2.47);
            if (empty($payloadValue)) { $averagePay = 0;
            } else { $averagePay = array_sum($payloadValue) / count($payloadValue); }
            if (empty($payloadBCM)) { $averageBCM = 0; $minBCM = 0; $maxBCM = 0; } 
            else {
                $averageBCM = array_sum($payloadBCM) / count($payloadBCM);
                $minBCM     = min($payloadBCM);
                $maxBCM     = max($payloadBCM);
            }
            $arrays = array(
                'Average Payload' => number_format(round($averagePay, 2), 2),
                'Average BCM'     => number_format(round($averageBCM, 2), 2),
                'Min BCM'         => number_format(round($minBCM, 2), 2),
                'Max BCM'         => number_format(round($maxBCM, 2), 2),
                'See detail'      => site_url('payload/unit/hd/').$this->my_encryption->encode($sn)
            );
            $data = array();
            foreach ($arrays as $x => $key) {
                $row          = array();
                $row['value'] = $key;
                $row['label'] = $x;
                $data[]       = $row;
            }
            echo json_encode($data);
        }

        public function most_valuable_driver($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $max_mvd = $this->mod_payload_hd->max_bcm_monthly($sn);
            $min_mvd = $this->mod_payload_hd->min_bcm_monthly($sn);

            $arrays = array(
                'Opt. HD High BCM'   => $max_mvd->nama.' ['.$max_mvd->nik.']',
                'Opt. HD Low BCM'    => $min_mvd->nama.' ['.$min_mvd->nik.']',
                'Opt. Exca High BCM' => $max_mvd->nmloader.' ['.$max_mvd->nikoprloader.']',
                'Opt. Exca Low BCM'  => $min_mvd->nmloader.' ['.$min_mvd->nikoprloader.']',
            );

            $data = array();

            foreach ($arrays as $x => $key) {
                $row          = array();
                $row['value'] = $key;
                $row['label'] = $x;
                $data[]       = $row;
            }
            echo json_encode($data);

            // $payloadBCM   = $this->array_fungsi($max_mvd, 10, 2.47);
            // var_dump(max($payloadBCM));
            // echo "<pre>";
            // var_dump($min_mvd);
            // echo "</pre>";
        }

        public function most_valuable_unit($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $max_mvd = $this->mod_payload_hd->max_bcm_monthly($sn);
            $min_mvd = $this->mod_payload_hd->min_bcm_monthly($sn);
            $max_mvd2 = $this->mod_payload_hd->array_max_bcm_monthly($sn);
            $min_mvd2 = $this->mod_payload_hd->array_min_bcm_monthly($sn);
            $payloadMaxBCM   = $this->array_fungsi($max_mvd2, 10, 2.47);
            $payloadMinBCM   = $this->array_fungsi($min_mvd2, 10, 2.47);

            $arrays = array(
                'HD High BCM'   => $max_mvd->unit.' ['.number_format(round(max($payloadMaxBCM), 2), 2).']',
                'HD Low BCM'    => $min_mvd->unit.' ['.number_format(round(min($payloadMinBCM), 2), 2).']',
                'Exca High BCM' => $max_mvd->loader.' ['.number_format(round(max($payloadMaxBCM), 2), 2).']',
                'Exca Low BCM'  => $min_mvd->loader.' ['.number_format(round(min($payloadMinBCM), 2), 2).']',
            );

            $data = array();

            foreach ($arrays as $x => $key) {
                $row          = array();
                $row['value'] = $key;
                $row['label'] = $x;
                $data[]       = $row;
            }
            echo json_encode($data);

            
            // var_dump(max($payloadBCM));
            // echo "<pre>";
            // var_dump($min_mvd);
            // echo "</pre>";
        }

        public function table_payload($sn){
            $sn          = $this->my_encryption->decode($this->pregReps($sn));
            $payload     = $this->mod_payload_hd->get_payload($sn);
            $all_payload = $this->mod_payload_hd->get_all_payload($sn);
            $data        = array();
            $no          = $this->pregRepn($this->input->post('start'));

            foreach ($payload as $field){
                $no++;
                $row                = array();
                $row['no']          = $no;
                $row['date']        = date("d-m-Y", strtotime($field->tgl));
                $row['time']        = date("H:i A", strtotime($field->dates));
                $row['payload']     = number_format(round(floatval($field->payload / 10), 2), 2);
                $row['bcm_payload'] = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                // $row['nik']         = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']        = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama).' ['.$this->pregRepn($field->nik).']';
                $row['loader']      = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nikloader']         = ($field->nikoprloader == null && $field->nikoprloader == '') ? "-" : $this->pregRepn($field->nikoprloader);
                $row['nmloader']    = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader).' ['.$this->pregRepn($field->nikoprloader).']';
                $data[]             = $row;
            };
            $payloadValue = $this->array_fungsi($all_payload, 10);
            $payloadBCM   = $this->array_fungsi($all_payload, 10, 2.47);
            if (empty($payloadValue)) { $averagePay = 0;
            } else { $averagePay = array_sum($payloadValue) / count($payloadValue); }
            if (empty($payloadBCM)) { $averageBCM = 0; $minBCM = 0; $maxBCM = 0; } 
            else {
                $averageBCM = array_sum($payloadBCM) / count($payloadBCM);
                $minBCM     = min($payloadBCM);
                $maxBCM     = max($payloadBCM);
            }
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_payload($sn),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_payload($sn),
                "data"            => $data,
                "averageBCM"      => number_format(round($averageBCM, 2), 2),
                "averagePay"      => number_format(round($averagePay, 2), 2),
                "maxBCM"          => number_format(round($maxBCM, 2), 2),
                "minBCM"          => number_format(round($minBCM, 2), 2)
            );
            echo json_encode($output);
        }

        public function search_table_payload($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $date1      = str_replace("/", "-", $this->input->post('date_start'));
            $date2      = str_replace("/", "-", $this->input->post('date_end'));
            $date_start = date("Y-m-d", strtotime($date1));
            $date_end   = date("Y-m-d", strtotime($date2));

            $payload     = $this->mod_payload_hd->get_spayload($sn, $date_start, $date_end);
            $all_payload = $this->mod_payload_hd->get_average_spayload($sn, $date_start, $date_end);

            $data    = array();
            $no      = $this->pregRepn($this->input->post('start'));

            foreach ($payload as $field) {
                $no++;
                $row                = array();
                $row['no']          = $no;
                $row['date']        = date("d-m-Y", strtotime($field->tgl));
                $row['time']        = date("H:i A", strtotime($field->dates));
                $row['payload']     = number_format(round(floatval($field->payload / 10), 2), 2);
                $row['bcm_payload'] = number_format(round(floatval($field->payload / 10 / 2.47), 2), 2);
                $row['nik']         = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']        = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $row['loader']      = ($field->loader == null) ? "-" : $this->pregReps($field->loader);
                $row['nmloader']    = ($field->nmloader == null) ? "-" : $this->pregReps($field->nmloader);
                $data[]             = $row;
            }

            $payloadValue = $this->array_fungsi($all_payload, 10);
            $payloadBCM   = $this->array_fungsi($all_payload, 10, 2.47);
            if (empty($payloadValue)) { $averagePay = 0;
            } else { $averagePay = array_sum($payloadValue) / count($payloadValue); }
            if (empty($payloadBCM)) { $averageBCM = 0; $minBCM = 0; $maxBCM = 0; } 
            else {
                $averageBCM = array_sum($payloadBCM) / count($payloadBCM);
                $minBCM     = min($payloadBCM);
                $maxBCM     = max($payloadBCM);
            }

            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_spayload($sn, $date_start, $date_end),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_spayload($sn, $date_start, $date_end),
                "data"            => $data,
                "averageBCM"      => number_format(round($averageBCM, 2), 2),
                "averagePay"      => number_format(round($averagePay, 2), 2),
                "maxBCM"          => number_format(round($maxBCM, 2), 2),
                "minBCM"          => number_format(round($minBCM, 2), 2)
            );
            echo json_encode($output);
        }

        public function table_empty_drive_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $empty_drive_time = $this->mod_payload_hd->get_empty_drive_time($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($empty_drive_time as $field){
                if (date("d-m-Y", strtotime($field->tgl)) == date("d-m-Y") ) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $no++;
                $row                   = array();
                $row['no']             = $no;
                $row['date']           = date("d-m-Y", strtotime($field->tgl));
                $row['time']           = date("H:i A", strtotime($field->dates));
                $row['emptydrivetime'] = floatval($field->emptydrivetime / 10);
                $row['nik']            = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']           = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_empty_drive_time($sn),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_empty_drive_time($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function search_table_empty_drive_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $date1      = str_replace("/", "-", $this->input->post('date_start'));
            $date2      = str_replace("/", "-", $this->input->post('date_end'));
            $date_start = date("Y-m-d", strtotime($date1));
            $date_end   = date("Y-m-d", strtotime($date2));

            $empty_drive_time = $this->mod_payload_hd->get_search_empty_drive_time($sn, $date_start, $date_end);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($empty_drive_time as $field){
                $no++;
                $row                   = array();
                $row['no']             = $no;
                $row['date']           = date("d-m-Y", strtotime($field->tgl));
                $row['time']           = date("H:i A", strtotime($field->dates));
                $row['emptydrivetime'] = floatval($field->emptydrivetime / 10);
                $row['nik']            = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']           = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_search_empty_drive_time($sn, $date_start, $date_end),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_empty_drive_time($sn, $date_start, $date_end),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_empty_drive_distance($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $empty_drive_distance = $this->mod_payload_hd->get_empty_drive_distance($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($empty_drive_distance as $field){
                $no++;
                $row                       = array();
                $row['no']                 = $no;
                $row['date']               = date("d-m-Y", strtotime($field->tgl));
                $row['time']               = date("H:i A", strtotime($field->dates));
                $row['emptydrivedistance'] = floatval($field->emptydrivedistance / 10);
                $row['nik']                = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']               = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                    = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_empty_drive_distance($sn),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_empty_drive_distance($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function search_table_empty_drive_distance($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $date1      = str_replace("/", "-", $this->input->post('date_start'));
            $date2      = str_replace("/", "-", $this->input->post('date_end'));
            $date_start = date("Y-m-d", strtotime($date1));
            $date_end   = date("Y-m-d", strtotime($date2));

            $empty_drive_distance = $this->mod_payload_hd->get_search_empty_drive_distance($sn, $date_start, $date_end);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($empty_drive_distance as $field){
                $no++;
                $row                       = array();
                $row['no']                 = $no;
                $row['date']               = date("d-m-Y", strtotime($field->tgl));
                $row['time']               = date("H:i A", strtotime($field->dates));
                $row['emptydrivedistance'] = floatval($field->emptydrivedistance / 10);
                $row['nik']                = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']               = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                    = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_search_empty_drive_distance($sn, $date_start, $date_end),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_empty_drive_distance($sn, $date_start, $date_end),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_empty_stop_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $empty_stop_time = $this->mod_payload_hd->get_empty_stop_time($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($empty_stop_time as $field){
                $no++;
                $row                  = array();
                $row['no']            = $no;
                $row['date']          = date("d-m-Y", strtotime($field->tgl));
                $row['time']          = date("H:i A", strtotime($field->dates));
                $row['emptystoptime'] = floatval($field->emptystoptime / 10);
                $row['nik']           = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']          = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]               = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_empty_stop_time($sn),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_empty_stop_time($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function search_table_empty_stop_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $date1      = str_replace("/", "-", $this->input->post('date_start'));
            $date2      = str_replace("/", "-", $this->input->post('date_end'));
            $date_start = date("Y-m-d", strtotime($date1));
            $date_end   = date("Y-m-d", strtotime($date2));

            $empty_stop_time = $this->mod_payload_hd->get_search_empty_stop_time($sn, $date_start, $date_end);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($empty_stop_time as $field){
                $no++;
                $row                  = array();
                $row['no']            = $no;
                $row['date']          = date("d-m-Y", strtotime($field->tgl));
                $row['time']          = date("H:i A", strtotime($field->dates));
                $row['emptystoptime'] = floatval($field->emptystoptime / 10);
                $row['nik']           = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']          = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]               = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_search_empty_stop_time($sn, $date_start, $date_end),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_empty_stop_time($sn, $date_start, $date_end),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_loading_stop_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $loading_stop_time = $this->mod_payload_hd->get_loading_stop_time($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($loading_stop_time as $field){
                $no++;
                $row                    = array();
                $row['no']              = $no;
                $row['date']            = date("d-m-Y", strtotime($field->tgl));
                $row['time']            = date("H:i A", strtotime($field->dates));
                $row['loadingstoptime'] = floatval($field->loadingstoptime / 10);
                $row['nik']             = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']            = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                 = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_loading_stop_time($sn),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_loading_stop_time($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function search_table_loading_stop_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $date1      = str_replace("/", "-", $this->input->post('date_start'));
            $date2      = str_replace("/", "-", $this->input->post('date_end'));
            $date_start = date("Y-m-d", strtotime($date1));
            $date_end   = date("Y-m-d", strtotime($date2));

            $loading_stop_time = $this->mod_payload_hd->get_search_loading_stop_time($sn, $date_start, $date_end);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($loading_stop_time as $field){
                $no++;
                $row                    = array();
                $row['no']              = $no;
                $row['date']            = date("d-m-Y", strtotime($field->tgl));
                $row['time']            = date("H:i A", strtotime($field->dates));
                $row['loadingstoptime'] = floatval($field->loadingstoptime / 10);
                $row['nik']             = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']            = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                 = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_search_loading_stop_time($sn, $date_start, $date_end),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_loading_stop_time($sn, $date_start, $date_end),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_loaded_drive_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $loaded_drive_time = $this->mod_payload_hd->get_loaded_drive_time($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($loaded_drive_time as $field){
                $no++;
                $row                    = array();
                $row['no']              = $no;
                $row['date']            = date("d-m-Y", strtotime($field->tgl));
                $row['time']            = date("H:i A", strtotime($field->dates));
                $row['loadeddrivetime'] = floatval($field->loadeddrivetime / 10);
                $row['nik']             = $this->pregRepn($field->nik);
                $row['name']            = $this->pregReps($field->nama);
                $data[]                 = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_loaded_drive_time($sn),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_loaded_drive_time($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function search_table_loaded_drive_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $date1      = str_replace("/", "-", $this->input->post('date_start'));
            $date2      = str_replace("/", "-", $this->input->post('date_end'));
            $date_start = date("Y-m-d", strtotime($date1));
            $date_end   = date("Y-m-d", strtotime($date2));

            $loaded_drive_time = $this->mod_payload_hd->get_search_loaded_drive_time($sn, $date_start, $date_end);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($loaded_drive_time as $field){
                $no++;
                $row                    = array();
                $row['no']              = $no;
                $row['date']            = date("d-m-Y", strtotime($field->tgl));
                $row['time']            = date("H:i A", strtotime($field->dates));
                $row['loadeddrivetime'] = floatval($field->loadeddrivetime / 10);
                $row['nik']             = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']            = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                 = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_search_loaded_drive_time($sn, $date_start, $date_end),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_loaded_drive_time($sn, $date_start, $date_end),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_loaded_stop_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $loaded_stop_time = $this->mod_payload_hd->get_loaded_stop_time($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($loaded_stop_time as $field){
                $no++;
                $row                   = array();
                $row['no']             = $no;
                $row['date']           = date("d-m-Y", strtotime($field->tgl));
                $row['time']           = date("H:i A", strtotime($field->dates));
                $row['loadedstoptime'] = floatval($field->loadedstoptime / 10);
                $row['nik']            = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']           = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_loaded_stop_time($sn),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_loaded_stop_time($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function search_table_loaded_stop_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $date1      = str_replace("/", "-", $this->input->post('date_start'));
            $date2      = str_replace("/", "-", $this->input->post('date_end'));
            $date_start = date("Y-m-d", strtotime($date1));
            $date_end   = date("Y-m-d", strtotime($date2));

            $loaded_stop_time = $this->mod_payload_hd->get_search_loaded_stop_time($sn, $date_start, $date_end);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($loaded_stop_time as $field){
                $no++;
                $row                   = array();
                $row['no']             = $no;
                $row['date']           = date("d-m-Y", strtotime($field->tgl));
                $row['time']           = date("H:i A", strtotime($field->dates));
                $row['loadedstoptime'] = floatval($field->loadedstoptime / 10);
                $row['nik']            = ($field->nik == null && $field->nik == '') ? "-" : $this->pregRepn($field->nik);
                $row['name']           = ($field->nama == null && $field->nik == '') ? "-" : $this->pregReps($field->nama);
                $data[]                = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_payload_hd->count_all_search_loaded_stop_time($sn, $date_start, $date_end),
                "recordsFiltered" => $this->mod_payload_hd->count_filtered_search_loaded_stop_time($sn, $date_start, $date_end),
                "data"            => $data,
            );
            echo json_encode($output);
        }

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