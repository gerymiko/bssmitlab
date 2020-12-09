<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syswarning_hd extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('detail_warning_fault'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active !== 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/site');
                } elseif ($this->accessRights!=null && $this->accessRights->read != 1 || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                }
            }
            $this->load->model(['mwarning/hd/mod_warning_hd']);
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
            return $result = date("H:i A", strtotime($time));
        }

        private static function array_fungsi($dataarray, $value1, $value2 = null){
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
                'content' => 'pages/pwarning/hd/vwarning_hd',
                'detail_hd' => $this->mod_warning_hd->get_detail_hd($site, $sn),
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
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/daterangepicker/daterangepicker.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/amcharts4/v447/core.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/mosento/amcharts4/v447/charts.js"></script>'
                ),
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_warning_unit($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $warning = $this->mod_warning_hd->get_warning_unit($sn, $length, $start, $site);
            foreach ($warning as $field){
                if ($this->viewDate($field->tgl) == date("d-m-Y") ) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = '<span class="hidden">'.strtotime($field->tgl).'</span>'.$this->viewDate($field->tgl).' '.$today_notif;
                $row['time']     = $this->viewTime($field->tgl);
                $row['messages'] = $field->ket;
                $row['mensaje']  = (strpos($field->ket, 'CRITICAL') == true) ? 'CRITICAL' : 'NONE';
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all_warning_unit($sn, $site),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered_warning_unit($sn, $site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_engine_oil_temperature($site){
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.engoiltemp');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('engoiltemp');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->engoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->engoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->engoiltemp);
                }
                $start++;
                $row                = array();
                $row['no']          = $start;
                $row['date']        = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time']        = $this->viewTime($field->date);
                $row['temperature'] = $realval;
                $data[]             = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.engoiltemp'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.engoiltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_oil_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.engoiltemp');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('engoiltemp');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->engoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->engoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->engoiltemp);
                }
                $output[] = array(
                    'date'     => $row->date,
                    'temp'     => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_fuel_rate($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.fuelrate');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('fuelrate');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->fuelrate) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->fuelrate) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->fuelrate);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['fuel'] = $realval;
                $data[]      = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.fuelrate'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.fuelrate'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_fuel_rate($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.fuelrate');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('fuelrate');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->fuelrate) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->fuelrate) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->fuelrate);
                }
                $output[] = array(
                    'date'     => $row->date,
                    'fuel'     => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_transmission_oil_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.tmoiltemp');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('tmoiltemp');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->tmoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->tmoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->tmoiltemp);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['tmoiltemp'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.tmoiltemp'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.tmoiltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_transmission_oil_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.tmoiltemp');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('tmoiltemp');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->tmoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->tmoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->tmoiltemp);
                }
                $output[] = array(
                    'date'     => $row->date,
                    'tmoiltemp'=> round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_engine_coolant_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.cooltemp');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('cooltemp');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->cooltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->cooltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->cooltemp);
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = $this->viewDate($field->date);
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['cooltemp'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.cooltemp'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.cooltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_coolant_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.cooltemp');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('cooltemp');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->cooltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->cooltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->cooltemp);
                }
                $output[] = array(
                    'date'     => $row->date,
                    'cooltemp' => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_blow_by_pressure($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.blowbypress');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('blowbypress');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->blowbypress) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->blowbypress) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->blowbypress);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['blowbypress'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.blowbypress'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.blowbypress'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_blow_by_pressure($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.blowbypress');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('blowbypress');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->blowbypress) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->blowbypress) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->blowbypress);
                }
                $output[] = array(
                    'date'        => $row->date,
                    'blowbypress' => round($realval, 2),
                    'critical'    => $rowmastervar->criticalValue,
                    'caution'     => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_boost_pressure($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.boostpress');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('boostpress');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->boostpress) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->boostpress) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->boostpress);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['boostpress'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.boostpress'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.boostpress'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_boost_pressure($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.boostpress');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('boostpress');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->boostpress) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->boostpress) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->boostpress);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'boostpress' => round($realval, 2),
                    'critical'   => $rowmastervar->criticalValue,
                    'caution'    => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_travel_speed($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.travelspeed');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('travelspeed');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travelspeed) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travelspeed) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travelspeed);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['travelspeed'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.travelspeed'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.travelspeed'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_travel_speed($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.travelspeed');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('travelspeed');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travelspeed) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travelspeed) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travelspeed);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'travelspeed' => round($realval, 2),
                    'critical'   => $rowmastervar->criticalValue,
                    'caution'    => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_engine_speed($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.enginespeed');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('enginespeed');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->enginespeed) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->enginespeed) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->enginespeed);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['enginespeed'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.enginespeed'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.enginespeed'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_speed($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.enginespeed');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('enginespeed');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->enginespeed) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->enginespeed) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->enginespeed);
                }
                $output[] = array(
                    'date'        => $row->date,
                    'enginespeed' => round($realval, 2),
                    'critical'    => $rowmastervar->criticalValue,
                    'caution'     => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_front_brake($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.frontbrake');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('frontbrake');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->frontbrake) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->frontbrake) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->frontbrake);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['frontbrake'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.frontbrake'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.frontbrake'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_front_brake($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.frontbrake');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('frontbrake');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->frontbrake) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->frontbrake) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->frontbrake);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'frontbrake' => round($realval, 2),
                    'critical'   => $rowmastervar->criticalValue,
                    'caution'    => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_rear_brake($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.rearbrake');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('rearbrake');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->rearbrake) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->rearbrake) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->rearbrake);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['rearbrake'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.rearbrake'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.rearbrake'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_rear_brake($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.rearbrake');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('rearbrake');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->rearbrake) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->rearbrake) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->rearbrake);
                }
                $output[] = array(
                    'date'      => $row->date,
                    'rearbrake' => round($realval, 2),
                    'critical'  => $rowmastervar->criticalValue,
                    'caution'   => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_engine_oil_lomin($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.oilplomin');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('oilpressmin');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->oilplomin) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->oilplomin) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->oilplomin);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['oilpressmin'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.oilplomin'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.oilplomin'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_oil_lomin($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.oilplomin');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('oilpressmin');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->oilplomin) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->oilplomin) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->oilplomin);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'oilpressmin' => round($realval, 2),
                    'critical'   => $rowmastervar->criticalValue,
                    'caution'    => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_oil_pressure_maximal($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_hd->get_data($sn, $length, $start, $site, 'a.oilpmax');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('oilpressmax');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->oilpmax) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->oilpmax) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->oilpmax);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['oilpressmax'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_hd->count_all($sn, $site, 'a.oilpmax'),
                "recordsFiltered" => $this->mod_warning_hd->count_filtered($sn, $site, 'a.oilpmax'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_oil_pressure_maximal($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_hd->get_data_for_chart($site, $sn, 'a.oilpmax');
            list($rowmastervar) = $this->mod_warning_hd->fetch_data_mastervar('oilpressmax');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->oilpmax) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->oilpmax) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->oilpmax);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'oilpressmax' => round($realval, 2),
                    'critical'   => $rowmastervar->criticalValue,
                    'caution'    => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function info_payload($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $all_payload  = $this->mod_warning_hd->get_all_payload($sn, $site);
            $payloadValue = $this->array_fungsi($all_payload, 10);
            $payloadBCM   = $this->array_fungsi($all_payload, 10, 2.47);
            if (empty($payloadValue)) { $averagePay = 0;
            } else { $averagePay = array_sum($payloadValue) / count($payloadValue); }
            if (empty($payloadBCM)) { $averageBCM = 0; $minBCM = 0; $maxBCM = 0; } 
            else {
                $averageBCM = array_sum($payloadBCM) / count($payloadBCM);
                $minBCM = min($payloadBCM);
                $maxBCM = max($payloadBCM);
            }
            $arrays = array(
                'Average Payload' => number_format(round($averagePay, 2), 2),
                'Average BCM' => number_format(round($averageBCM, 2), 2),
                'Min BCM' => number_format(round($minBCM, 2), 2),
                'Max BCM' => number_format(round($maxBCM, 2), 2),
                'See detail' => site_url('payload/hd/').$this->accessRights->site.'/'.$this->my_encryption->encode($sn)
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

    }
?>