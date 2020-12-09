<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syswarning_exca extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('detail_warning_fault'));
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
            $this->load->model(['mwarning/exca/mod_warning_exca']);
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

        public function unit($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/pwarning/exca/vwarning_exca',
                'detail_exca'  => $this->mod_warning_exca->get_detail_exca($site, $sn),
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
            $warning = $this->mod_warning_exca->get_warning_unit($sn, $length, $start, $site);
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
                "recordsTotal"    => $this->mod_warning_exca->count_all_warning_unit($sn, $site),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered_warning_unit($sn, $site),
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
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.engoiltemp');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('engoiltemp');
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
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.engoiltemp'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.engoiltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_oil_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $output = array();
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.engoiltemp');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('engoiltemp');
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
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.fuelrate');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('fuelrate');
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
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.fuelrate'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.fuelrate'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_fuel_rate($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $mastervar  = $this->mod_warning_exca->fetch_data_mastervar('fuelrate');
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.fuelrate');
            $output  = array();
            list($rowmastervar) = $mastervar;
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
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.tmoiltemp');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('tmoiltemp');
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
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.tmoiltemp'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.tmoiltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_transmission_oil_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.tmoiltemp');
            $output  = array();
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('tmoiltemp');
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
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.cooltemp');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('cooltemp');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->cooltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->cooltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->cooltemp);
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['cooltemp'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.cooltemp'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.cooltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_coolant_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.cooltemp');
            $output = array();
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('cooltemp');
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
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.blowbypress');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('blowbypress');
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
                $row['blowbypress'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.blowbypress'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.blowbypress'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_blow_by_pressure($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.blowbypress');
            $output = array();
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('blowbypress');
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
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.boostpress');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('boostpress');
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
                $row['boostpress'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.boostpress'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.boostpress'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_boost_pressure($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.boostpress');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('boostpress');
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

        public function table_pump_front_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.pumpF_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('pumpF_press_max');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication'){
                    $realval = (floatval($field->pumpF_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division'){
                    $realval = (floatval($field->pumpF_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pumpF_press_max);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['pumpF_press_max'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.pumpF_press_max'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.pumpF_press_max'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_pump_front_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.pumpF_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('pumpF_press_max');
            $output = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pumpF_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pumpF_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pumpF_press_max);
                }
                $output[] = array(
                    'date' => $row->date,
                    'pumpF_press_max' => round($realval, 2),
                    'critical' => round($rowmastervar->criticalValue, 2),
                    'caution'  => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_pump_rear_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.pumpR_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('pumpR_press_max');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pumpR_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pumpR_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pumpR_press_max);
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['pumpR_press_max'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.pumpR_press_max'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.pumpR_press_max'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_pump_rear_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.pumpR_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('pumpR_press_max');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pumpR_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pumpR_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pumpR_press_max);
                }
                $output[] = array(
                    'date' => $row->date,
                    'pumpR_press_max' => round($realval, 2),
                    'critical' => round($rowmastervar->criticalValue, 2),
                    'caution'  => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_swing_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.swing_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('swing_press_max');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->swing_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->swing_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->swing_press_max);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time']  = $this->viewTime($field->date);
                $row['swing'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.swing_press_max'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.swing_press_max'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_swing_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.swing_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('swing_press_max');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->swing_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->swing_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->swing_press_max);
                }
                $output[] = array(
                    'date' => $row->date,
                    'swing_press_max' => round($realval, 2),
                    'critical' => round($rowmastervar->criticalValue, 2),
                    'caution'  => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_g1pump_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.g1pump_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('g1pump_press_max');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->g1pump_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->g1pump_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->g1pump_press_max);
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time']   = $this->viewTime($field->date);
                $row['g1pump'] = $realval;
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.g1pump_press_max'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.g1pump_press_max'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_g1pump_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.g1pump_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('g1pump_press_max');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->g1pump_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->g1pump_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->g1pump_press_max);
                }
                $output[] = array(
                    'date' => $row->date,
                    'g1pump_press_max' => round($realval, 2),
                    'critical' => round($rowmastervar->criticalValue, 2),
                    'caution'  => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_g2pump_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.g2pump_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('g2pump_press_max');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->g2pump_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->g2pump_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->g2pump_press_max);
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time']   = $this->viewTime($field->date);
                $row['g2pump'] = $realval;
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.g2pump_press_max'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.g2pump_press_max'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_g2pump_pressure_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.g2pump_press_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('g2pump_press_max');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->g2pump_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->g2pump_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->g2pump_press_max);
                }
                $output[] = array(
                    'date' => $row->date,
                    'g2pump_press_max' => round($realval, 2),
                    'critical' => round($rowmastervar->criticalValue, 2),
                    'caution'  => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_pto_temp_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.pto_temp_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('pto_temp_max');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pto_temp_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pto_temp_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pto_temp_max);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['pto_temp_max'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.pto_temp_max'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.pto_temp_max'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_pto_temp_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.pto_temp_max');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('pto_temp_max');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pto_temp_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pto_temp_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pto_temp_max);
                }
                $output[] = array(
                    'date' => $row->date,
                    'pto_temp_max' => round($realval, 2),
                    'critical' => round($rowmastervar->criticalValue, 2),
                    'caution'  => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_pto_temp_min($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.pto_temp_min');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('pto_temp_min');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pto_temp_min) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pto_temp_min) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pto_temp_min);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['pto_temp_min'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.pto_temp_min'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.pto_temp_min'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_pto_temp_min($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.pto_temp_min');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('pto_temp_min');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pto_temp_min) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pto_temp_min) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pto_temp_min);
                }
                $output[] = array(
                    'date' => $row->date,
                    'pto_temp_min' => round($realval, 2),
                    'critical' => round($rowmastervar->criticalValue, 2),
                    'caution'  => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_arm_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.arm_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('arm_ppc_on');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->arm_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->arm_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->arm_ppc_on);
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['arm_ppc_on'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.arm_ppc_on'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.arm_ppc_on'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_arm_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.arm_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('arm_ppc_on');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->arm_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->arm_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->arm_ppc_on);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'arm_ppc_on' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_bucket_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.bucket_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('bucket_ppc_on');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->bucket_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->bucket_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->bucket_ppc_on);
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['bucket_ppc_on'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.bucket_ppc_on'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.bucket_ppc_on'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_bucket_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.bucket_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('bucket_ppc_on');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->bucket_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->bucket_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->bucket_ppc_on);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'bucket_ppc_on' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_boom_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.boom_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('boom_ppc_on');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->boom_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->boom_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->boom_ppc_on);
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['boom_ppc_on'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.boom_ppc_on'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.boom_ppc_on'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_boom_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.boom_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('boom_ppc_on');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->boom_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->boom_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->boom_ppc_on);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'boom_ppc_on' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_swing_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.swing_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('swing_ppc_on');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->swing_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->swing_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->swing_ppc_on);
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['swing_ppc_on'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.swing_ppc_on'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.swing_ppc_on'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_swing_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.swing_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('swing_ppc_on');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->swing_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->swing_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->swing_ppc_on);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'swing_ppc_on' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_travel_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend = $this->mod_warning_exca->get_data($sn, $length, $start, $site, 'a.travel_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('travel_ppc_on');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travel_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travel_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travel_ppc_on);
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['travel_ppc_on'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_exca->count_all($sn, $site, 'a.travel_ppc_on'),
                "recordsFiltered" => $this->mod_warning_exca->count_filtered($sn, $site, 'a.travel_ppc_on'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_travel_ppc_on($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_exca->get_data_for_chart($site, $sn, 'a.travel_ppc_on');
            list($rowmastervar) = $this->mod_warning_exca->fetch_data_mastervar('travel_ppc_on');
            $output  = array();
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travel_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travel_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travel_ppc_on);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'travel_ppc_on' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

    }
?>