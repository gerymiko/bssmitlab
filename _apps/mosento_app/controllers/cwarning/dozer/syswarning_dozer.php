<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syswarning_dozer extends CI_Controller{

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
            $this->load->model(['mwarning/dozer/mod_warning_dozer']);
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

        public function unit($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/pwarning/dozer/vwarning_dozer',
                'detail_dozer' => $this->mod_warning_dozer->get_detail_dozer($site, $sn),
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

        // TABLE
        public function table_warning_unit($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $warning_unit = $this->mod_warning_dozer->get_warning_unit($sn, $length, $start, $site);
            foreach ($warning_unit as $field){
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
                "recordsTotal"    => $this->mod_warning_dozer->count_all_warning_unit($sn, $site),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_warning_unit($sn, $site),
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
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.engoiltemp');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('engoiltemp');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->engoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->engoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->engoiltemp);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['temperature'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.engoiltemp'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.engoiltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_oil_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $output = array();
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.engoiltemp');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('engoiltemp');
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
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.fuelrate');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('fuelrate');
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
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.fuelrate'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.fuelrate'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_fuel_rate($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $mastervar  = $this->mod_warning_dozer->fetch_data_mastervar('fuelrate');
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.fuelrate');
            $output = array();
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
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.tmoiltemp');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('tmoiltemp');
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
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.tmoiltemp'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.tmoiltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_transmission_oil_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $mastervar = $this->mod_warning_dozer->fetch_data_mastervar('tmoiltemp');
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.tmoiltemp');
            $output  = array();
            list($rowmastervar) = $mastervar;
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
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.cooltemp');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('cooltemp');
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
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.cooltemp'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.cooltemp'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_coolant_temperature($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.cooltemp');
            $output = array();
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('cooltemp');
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
            $trend  = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.blowbypress');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('blowbypress');
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
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.blowbypress'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.blowbypress'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_blow_by_pressure($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.blowbypress');
            $output  = array();
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('blowbypress');
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
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.boostpress');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('boostpress');
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
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.boostpress'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.boostpress'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_boost_pressure($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.boostpress');
            $output = array();
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('boostpress');
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

        public function table_transmain_press_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.transmain_pressure_max');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('transmain_pressure_max');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->transmain_pressure_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->transmain_pressure_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->transmain_pressure_max);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['transmain_pressure_max'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.transmain_pressure_max'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.transmain_pressure_max'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_transmain_press_max($site){
            $output = array();
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.transmain_pressure_max');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('transmain_pressure_max');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->transmain_pressure_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->transmain_pressure_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->transmain_pressure_max);
                }
                $output[] = array(
                    'date' => $row->date,
                    'transmain_pressure_max' => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_transmain_press_avg($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.transmain_pressure_avg');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('transmain_pressure_avg');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->transmain_pressure_avg) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->transmain_pressure_avg) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->transmain_pressure_avg);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['transmain_pressure_avg'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.transmain_pressure_avg'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.transmain_pressure_avg'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_transmain_press_avg($site){
            $output = array();
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.transmain_pressure_avg');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('transmain_pressure_avg');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->transmain_pressure_avg) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->transmain_pressure_avg) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->transmain_pressure_avg);
                }
                $output[] = array(
                    'date' => $row->date,
                    'transmain_pressure_avg' => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function table_operating_time($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.opr_time');
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['operatime'] = floatval($field->opr_time);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.opr_time'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.opr_time'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_operating_time($site){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.opr_time');
            foreach ($trend as $row) {
                $output[] = array(
                    'date' => $row->date,
                    'opr_time' => floatval($row->opr_time)
                );
            }
            echo json_encode($output);
        }

        public function table_dozing_time($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.dozing_time');
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['dozing_time'] = floatval($field->dozing_time);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.dozing_time'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.dozing_time'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_dozing_time($site){
            $output = array();
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.dozing_time');
            foreach ($trend as $row) {
                $output[] = array(
                    'date' => $row->date,
                    'dozing_time' => round(floatval($row->dozing_time), 2)
                );
            }
            echo json_encode($output);
        }

        public function table_ripping_time($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.ripping_time');
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['ripping_time'] = floatval($field->ripping_time);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.ripping_time'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.ripping_time'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_ripping_time($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.ripping_time');
            foreach ($trend as $row) {
                $output[] = array(
                    'date' => $row->date,
                    'ripping_time' => round(floatval($row->ripping_time), 2)
                );
            }
            echo json_encode($output);
        }

        public function table_fwd_distance_f1($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.fwd_distance_f1');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f1');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->fwd_distance_f1) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->fwd_distance_f1) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->fwd_distance_f1);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['fwd_distance_f1'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.fwd_distance_f1'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.fwd_distance_f1'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_fwd_distance_f1($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.fwd_distance_f1');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f1');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->fwd_distance_f1) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->fwd_distance_f1) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->fwd_distance_f1);
                }
                $output[] = array(
                    'date' => $row->date,
                    'fwd_distance_f1' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_fwd_distance_f2($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.fwd_distance_f2');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f2');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->fwd_distance_f2) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->fwd_distance_f2) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->fwd_distance_f2);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['fwd_distance_f2'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.fwd_distance_f2'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.fwd_distance_f2'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_fwd_distance_f2($site){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.fwd_distance_f2');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f2');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->fwd_distance_f2) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->fwd_distance_f2) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->fwd_distance_f2);
                }
                $output[] = array(
                    'date' => $row->date,
                    'fwd_distance_f2' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_fwd_distance_f3($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.fwd_distance_f3');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f3');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->fwd_distance_f3) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->fwd_distance_f3) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->fwd_distance_f3);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['fwd_distance_f3'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.fwd_distance_f3'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.fwd_distance_f3'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_fwd_distance_f3($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.fwd_distance_f3');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f3');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->fwd_distance_f3) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->fwd_distance_f3) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->fwd_distance_f3);
                }
                $output[] = array(
                    'date' => $row->date,
                    'fwd_distance_f3' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_rvs_distance_r1($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.rvs_distance_r1');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r1');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->rvs_distance_r1) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->rvs_distance_r1) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->rvs_distance_r1);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['rvs_distance_r1'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.rvs_distance_r1'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.rvs_distance_r1'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_rvs_distance_r1($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.rvs_distance_r1');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r1');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->rvs_distance_r1) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->rvs_distance_r1) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->rvs_distance_r1);
                }
                $output[] = array(
                    'date' => $row->date,
                    'rvs_distance_r1' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_rvs_distance_r2($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.rvs_distance_r2');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r2');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->rvs_distance_r2) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->rvs_distance_r2) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->rvs_distance_r2);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['rvs_distance_r2'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.rvs_distance_r2'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.rvs_distance_r2'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_rvs_distance_r2($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.rvs_distance_r2');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r2');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->rvs_distance_r2) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->rvs_distance_r2) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->rvs_distance_r2);
                }
                $output[] = array(
                    'date' => $row->date,
                    'rvs_distance_r2' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_rvs_distance_r3($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.rvs_distance_r3');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r3');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->rvs_distance_r3) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->rvs_distance_r3) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->rvs_distance_r3);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['rvs_distance_r3'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.rvs_distance_r3'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.rvs_distance_r3'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_rvs_distance_r3($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.rvs_distance_r3');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r3');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->rvs_distance_r3) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->rvs_distance_r3) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->rvs_distance_r3);
                }
                $output[] = array(
                    'date' => $row->date,
                    'rvs_distance_r3' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_travel_time_f1($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.travel_time_f1');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f1');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travel_time_f1) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travel_time_f1) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travel_time_f1);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['travel_time_f1'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.travel_time_f1'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.travel_time_f1'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_travel_time_f1($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.travel_time_f1');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f1');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travel_time_f1) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travel_time_f1) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travel_time_f1);
                }
                $output[] = array(
                    'date' => $row->date,
                    'travel_time_f1' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_travel_time_f2($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.travel_time_f2');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f2');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travel_time_f2) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travel_time_f2) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travel_time_f2);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['travel_time_f2'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.travel_time_f2'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.travel_time_f2'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_travel_time_f2($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.travel_time_f2');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f2');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travel_time_f2) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travel_time_f2) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travel_time_f2);
                }
                $output[] = array(
                    'date' => $row->date,
                    'travel_time_f2' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_travel_time_f3($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.travel_time_f3');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f3');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travel_time_f3) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travel_time_f3) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travel_time_f3);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['travel_time_f3'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.travel_time_f3'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.travel_time_f3'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_travel_time_f3($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.travel_time_f3');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f3');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travel_time_f3) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travel_time_f3) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travel_time_f3);
                }
                $output[] = array(
                    'date' => $row->date,
                    'travel_time_f3' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_travel_time_r1($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.travel_time_r1');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r1');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travel_time_r1) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travel_time_r1) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travel_time_r1);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['travel_time_r1'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.travel_time_r1'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.travel_time_r1'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_travel_time_r1($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.travel_time_r1');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r1');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travel_time_r1) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travel_time_r1) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travel_time_r1);
                }
                $output[] = array(
                    'date' => $row->date,
                    'travel_time_r1' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_travel_time_r2($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.travel_time_r2');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r2');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travel_time_r2) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travel_time_r2) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travel_time_r2);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['travel_time_r2'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.travel_time_r2'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.travel_time_r2'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_travel_time_r2($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.travel_time_r2');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r2');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travel_time_r2) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travel_time_r2) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travel_time_r2);
                }
                $output[] = array(
                    'date' => $row->date,
                    'travel_time_r2' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_travel_time_r3($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.travel_time_r3');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r3');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travel_time_r3) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travel_time_r3) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travel_time_r3);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['travel_time_r3'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.travel_time_r3'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.travel_time_r3'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_travel_time_r3($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.travel_time_r3');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r3');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travel_time_r3) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travel_time_r3) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travel_time_r3);
                }
                $output[] = array(
                    'date' => $row->date,
                    'travel_time_r3' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_pitch_angle_max($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.pitch_angle_max');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_max');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pitch_angle_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pitch_angle_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pitch_angle_max);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['pitch_angle_max'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.pitch_angle_max'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.pitch_angle_max'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_pitch_angle_max($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.pitch_angle_max');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_max');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pitch_angle_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pitch_angle_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pitch_angle_max);
                }
                $output[] = array(
                    'date' => $row->date,
                    'pitch_angle_max' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_pitch_angle_avg($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.pitch_angle_avg');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_avg');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pitch_angle_avg) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pitch_angle_avg) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pitch_angle_avg);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['pitch_angle_avg'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.pitch_angle_avg'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.pitch_angle_avg'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_pitch_angle_avg($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.pitch_angle_avg');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_avg');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pitch_angle_avg) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pitch_angle_avg) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pitch_angle_avg);
                }
                $output[] = array(
                    'date' => $row->date,
                    'pitch_angle_avg' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

        public function table_pitch_angle_min($site){
            $sn = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('', false); }
            $trend = $this->mod_warning_dozer->get_data($sn, $length, $start, $site, 'a.pitch_angle_min');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_min');
            foreach ($trend as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pitch_angle_min) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pitch_angle_min) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pitch_angle_min);
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = '<span class="hidden">'.strtotime($field->date).'</span>'.$this->viewDate($field->date);
                $row['time'] = $this->viewTime($field->date);
                $row['pitch_angle_min'] = round($realval, 2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all($sn, $site, 'a.pitch_angle_min'),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered($sn, $site, 'a.pitch_angle_min'),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_pitch_angle_min($site){
            $output = array();
            $sn     = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $trend  = $this->mod_warning_dozer->get_data_for_chart($site, $sn, 'a.pitch_angle_min');
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_min');
            foreach ($trend as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pitch_angle_min) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pitch_angle_min) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pitch_angle_min);
                }
                $output[] = array(
                    'date' => $row->date,
                    'pitch_angle_min' => round($realval, 2)
                );
            }
            echo json_encode($output);
        }

    }
?>