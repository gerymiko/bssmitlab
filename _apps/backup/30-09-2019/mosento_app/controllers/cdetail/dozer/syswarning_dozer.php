<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syswarning_dozer extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null && $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mdetail/dozer/mod_warning_dozer']);
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

        public function unit($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/ptopbar/vtopbar',
                'content' => 'pages/pdetail/dozer/vwarning_dozer',
                'warning_dozer' => $this->mod_warning_dozer->get_detail_dozer($sn),
                'site_unit'     => $this->mod_warning_dozer->get_unit_dozer($sn)
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        // TABLE
        public function table_warning_unit($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $sn = $this->pregReps($sn);
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $warning_unit = $this->mod_warning_dozer->get_warning_unit($sn, $length, $start);

            foreach ($warning_unit as $field){
                if ($this->viewDate($field->tgl) == date("d-m-Y") ) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = $this->viewDate($field->tgl).' '.$today_notif;
                $row['time']     = date("H:i A", strtotime($field->tgl));
                $row['messages'] = $field->ket;
                $row['mensaje']  = (strpos($field->ket, 'CRITICAL') == true) ? 'CRITICAL' : 'NONE';
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_warning_unit($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_warning_unit($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_engine_oil_temperature($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $eot  = $this->mod_warning_dozer->get_eot($sn, $length, $start);

            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('engoiltemp');

            foreach ($eot as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->engoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->engoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->engoiltemp);
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = $this->viewDate($field->date);
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['temperature'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_eot($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_eot($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_fuel_rate($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $fuel_rate  = $this->mod_warning_dozer->get_fuel_rate($sn, $length, $start);

            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('fuelrate');

            foreach ($fuel_rate as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->fuelrate) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->fuelrate) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->fuelrate);
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = $this->viewDate($field->date);
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['fuel']     = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_fuel_rate($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_fuel_rate($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_transmission_oil_temperature($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $tot  = $this->mod_warning_dozer->get_tot($sn, $length, $start);

            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('tmoiltemp');

            foreach ($tot as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->tmoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->tmoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->tmoiltemp);
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = $this->viewDate($field->date);
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['tmoiltemp'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_tot($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_tot($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_engine_coolant_temperature($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $ect  = $this->mod_warning_dozer->get_ect($sn, $length, $start);

            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('cooltemp');

            foreach ($ect as $field){
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
                "recordsTotal"    => $this->mod_warning_dozer->count_all_ect($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_ect($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_blow_by_pressure($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $bbp  = $this->mod_warning_dozer->get_bbp($sn, $length, $start);

            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('blowbypress');

            foreach ($bbp as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->blowbypress) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->blowbypress) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->blowbypress);
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = $this->viewDate($field->date);
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['blowbypress'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_bbp($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_bbp($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_boost_pressure($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $bp   = $this->mod_warning_dozer->get_bp($sn, $length, $start);

            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('boostpress');

            foreach ($bp as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->boostpress) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->boostpress) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->boostpress);
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = $this->viewDate($field->date);
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['boostpress'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_bp($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_bp($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_transmain_press_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $transmain_pressure_max   = $this->mod_warning_dozer->get_transmain_pressure_max($sn, $length, $start);

            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('transmain_pressure_max');

            foreach ($transmain_pressure_max as $field){
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
                $row['date'] = $this->viewDate($field->date);
                $row['time'] = date("H:i A", strtotime($field->date));
                $row['transmain_pressure_max'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_transmain_pressure_max($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_transmain_pressure_max($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_transmain_press_avg($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $transmain_pressure_avg   = $this->mod_warning_dozer->get_transmain_pressure_avg($sn, $length, $start);

            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('transmain_pressure_avg');

            foreach ($transmain_pressure_avg as $field){
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
                $row['date'] = $this->viewDate($field->date);
                $row['time'] = date("H:i A", strtotime($field->date));
                $row['transmain_pressure_avg'] = $realval;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_transmain_pressure_avg($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_transmain_pressure_avg($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_operating_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend   = $this->mod_warning_dozer->get_operating_time($sn, $length, $start);
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = $this->viewDate($field->date);
                $row['time'] = date("H:i A", strtotime($field->date));
                $row['operatime'] = floatval($field->opr_time);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_operating_time($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_operating_time($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_dozing_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend   = $this->mod_warning_dozer->get_dozing_time($sn, $length, $start);
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = $this->viewDate($field->date);
                $row['time'] = date("H:i A", strtotime($field->date));
                $row['dozing_time'] = floatval($field->dozing_time);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_dozing_time($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_dozing_time($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_ripping_time($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend   = $this->mod_warning_dozer->get_ripping_time($sn, $length, $start);
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = $this->viewDate($field->date);
                $row['time'] = date("H:i A", strtotime($field->date));
                $row['ripping_time'] = floatval($field->ripping_time);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_ripping_time($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_ripping_time($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_fwd_distance_f1($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend   = $this->mod_warning_dozer->get_fwd_distance_f1($sn, $length, $start);
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = $this->viewDate($field->date);
                $row['time'] = date("H:i A", strtotime($field->date));
                $row['fwd_distance_f1'] = floatval($field->fwd_distance_f1);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_fwd_distance_f1($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_fwd_distance_f1($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_fwd_distance_f2($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend   = $this->mod_warning_dozer->get_fwd_distance_f2($sn, $length, $start);
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = $this->viewDate($field->date);
                $row['time'] = date("H:i A", strtotime($field->date));
                $row['fwd_distance_f2'] = floatval($field->fwd_distance_f2);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_fwd_distance_f2($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_fwd_distance_f2($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_fwd_distance_f3($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $length = $this->pregRepn($this->input->post('length'));
            $start  = $this->pregRepn($this->input->post('start'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $trend   = $this->mod_warning_dozer->get_fwd_distance_f3($sn, $length, $start);
            foreach ($trend as $field){
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['date'] = $this->viewDate($field->date);
                $row['time'] = date("H:i A", strtotime($field->date));
                $row['fwd_distance_f3'] = floatval($field->fwd_distance_f3);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_warning_dozer->count_all_fwd_distance_f3($sn),
                "recordsFiltered" => $this->mod_warning_dozer->count_filtered_fwd_distance_f3($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }


        // CHART
        public function chart_engine_oil_temperature($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $output  = array();
            $trend_eot = $this->mod_warning_dozer->get_data_engine_oil_temperature($sn);
            list($rowmastervar) = $this->mod_warning_dozer->fetch_data_mastervar('engoiltemp');
            foreach ($trend_eot as $row) {
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

        public function chart_fuel_rate($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $mastervar  = $this->mod_warning_dozer->fetch_data_mastervar('fuelrate');
            $trend_fuel = $this->mod_warning_dozer->get_data_fuel_rate($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_fuel as $row) {
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

        public function chart_transmission_oil_temperature($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $mastervar = $this->mod_warning_dozer->fetch_data_mastervar('tmoiltemp');
            $trend_tot = $this->mod_warning_dozer->get_data_tot($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_tot as $row) {
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

        public function chart_engine_coolant_temperature($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $mastervar = $this->mod_warning_dozer->fetch_data_mastervar('cooltemp');
            $trend_ect = $this->mod_warning_dozer->get_data_ect($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_ect as $row) {
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

        public function chart_blow_by_pressure($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $mastervar = $this->mod_warning_dozer->fetch_data_mastervar('blowbypress');
            $trend_bbp = $this->mod_warning_dozer->get_data_bbp($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_bbp as $row) {
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

        public function chart_boost_pressure($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $mastervar = $this->mod_warning_dozer->fetch_data_mastervar('boostpress');
            $trend_bp  = $this->mod_warning_dozer->get_data_bp($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_bp as $row) {
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

        public function chart_transmain_press_max($sn){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend  = $this->mod_warning_dozer->get_data_transmain_pressure_max($sn);
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
                    'date'       => $row->date,
                    'transmain_pressure_max' => round($realval, 2),
                    'critical'   => $rowmastervar->criticalValue,
                    'caution'    => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function chart_transmain_press_avg($sn){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend  = $this->mod_warning_dozer->get_data_transmain_pressure_avg($sn);
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
                    'date'       => $row->date,
                    'transmain_pressure_avg' => round($realval, 2),
                    'critical'   => $rowmastervar->criticalValue,
                    'caution'    => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function chart_operating_time($sn){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend  = $this->mod_warning_dozer->get_data_operating_time($sn);
            foreach ($trend as $row) {
                $output[] = array(
                    'date'      => $row->date,
                    'opr_time' => round(floatval($row->opr_time), 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_dozing_time($sn){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend  = $this->mod_warning_dozer->get_data_dozing_time($sn);
            foreach ($trend as $row) {
                $output[] = array(
                    'date' => $row->date,
                    'dozing_time' => round(floatval($row->dozing_time), 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_ripping_time($sn){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend  = $this->mod_warning_dozer->get_data_ripping_time($sn);
            foreach ($trend as $row) {
                $output[] = array(
                    'date' => $row->date,
                    'ripping_time' => round(floatval($row->ripping_time), 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_fwd_distance_f1($sn){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend  = $this->mod_warning_dozer->get_data_fwd_distance_f1($sn);
            foreach ($trend as $row) {
                $output[] = array(
                    'date' => $row->date,
                    'fwd_distance_f1' => round(floatval($row->fwd_distance_f1), 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_fwd_distance_f2($sn){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend  = $this->mod_warning_dozer->get_data_fwd_distance_f2($sn);
            foreach ($trend as $row) {
                $output[] = array(
                    'date' => $row->date,
                    'fwd_distance_f2' => round(floatval($row->fwd_distance_f2), 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_fwd_distance_f3($sn){
            $output  = array();
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend  = $this->mod_warning_dozer->get_data_fwd_distance_f3($sn);
            foreach ($trend as $row) {
                $output[] = array(
                    'date' => $row->date,
                    'fwd_distance_f3' => round(floatval($row->fwd_distance_f3), 2)
                );
            }
            echo json_encode($output);
        }

    }
?>