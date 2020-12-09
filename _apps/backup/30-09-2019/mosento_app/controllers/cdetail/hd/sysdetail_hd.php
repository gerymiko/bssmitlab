<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdetail_hd extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mdetail/hd/mod_detail_hd']);
        }

        private static function pregReps($string){ 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number){ 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function unit($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => 'pages/ptopbar/vtopbar',
                'content' => 'pages/pdetail/hd/vdetail_hd',
                'detail_hd' => $this->mod_detail_hd->get_detail_hd($sn),
                'site_unit' => $this->mod_detail_hd->get_unit_hd($sn),
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_warning_unit($sn){
            $sn           = $this->my_encryption->decode($this->pregReps($sn));
            $warning_unit = $this->mod_detail_hd->get_warning_unit($sn);
            $data         = array();
            $no           = $this->pregRepn($this->input->post('start'));

            foreach ($warning_unit as $field){
                if (date("d-m-Y", strtotime($field->tgl)) == date("d-m-Y") ) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->tgl)).' '.$today_notif;
                $row['time']     = date("H:i A", strtotime($field->tgl));
                $row['messages'] = $field->ket;
                $row['mensaje']  = (strpos($field->ket, 'CRITICAL') == true) ? 'CRITICAL' : 'NONE';
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_warning_unit($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_warning_unit($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_engine_oil_temperature($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $eot  = $this->mod_detail_hd->get_eot($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_oil();
            list($rowmastervar) = $mastervar;

            foreach ($eot as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->engoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->engoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->engoiltemp);
                }
                $no++;
                $row                = array();
                $row['no']          = $no;
                $row['date']        = date("d-m-Y", strtotime($field->date));
                $row['time']        = date("H:i A", strtotime($field->date));
                $row['temperature'] = $realval;
                $data[]             = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_eot($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_eot($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_fuel_rate($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $fuel_rate  = $this->mod_detail_hd->get_fuel_rate($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar  = $this->mod_detail_hd->get_data_mastervar_fuel();
            list($rowmastervar) = $mastervar;

            foreach ($fuel_rate as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->fuelrate) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->fuelrate) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->fuelrate);
                }
                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['fuel']     = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_fuel_rate($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_fuel_rate($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_transmission_oil_temperature($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $tot  = $this->mod_detail_hd->get_tot($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_tot();
            list($rowmastervar) = $mastervar;

            foreach ($tot as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->tmoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->tmoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->tmoiltemp);
                }
                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['tmoiltemp'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_tot($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_tot($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_engine_coolant_temperature($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $ect  = $this->mod_detail_hd->get_ect($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_ect();
            list($rowmastervar) = $mastervar;

            foreach ($ect as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->cooltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->cooltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->cooltemp);
                }
                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['cooltemp'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_ect($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_ect($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_blow_by_pressure($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $bbp  = $this->mod_detail_hd->get_bbp($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_bbp();
            list($rowmastervar) = $mastervar;

            foreach ($bbp as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->blowbypress) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->blowbypress) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->blowbypress);
                }

                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['blowbypress'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_bbp($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_bbp($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_boost_pressure($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $bp   = $this->mod_detail_hd->get_bp($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_bp();
            list($rowmastervar) = $mastervar;

            foreach ($bp as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->boostpress) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->boostpress) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->boostpress);
                }

                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['boostpress'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_bp($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_bp($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_travel_speed($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $ts   = $this->mod_detail_hd->get_ts($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_ts();
            list($rowmastervar) = $mastervar;

            foreach ($ts as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travelspeed) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travelspeed) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travelspeed);
                }

                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['travelspeed'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_ts($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_ts($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_engine_speed($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $es   = $this->mod_detail_hd->get_es($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_es();
            list($rowmastervar) = $mastervar;

            foreach ($es as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->enginespeed) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->enginespeed) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->enginespeed);
                }

                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['enginespeed'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_es($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_es($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_front_brake($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $fb   = $this->mod_detail_hd->get_fb($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_fb();
            list($rowmastervar) = $mastervar;

            foreach ($fb as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->frontbrake) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->frontbrake) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->frontbrake);
                }

                $no++;
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['frontbrake'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_fb($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_fb($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_rear_brake($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $rb   = $this->mod_detail_hd->get_rb($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_rb();
            list($rowmastervar) = $mastervar;

            foreach ($rb as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->rearbrake) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->rearbrake) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->rearbrake);
                }

                $no++;
                $row              = array();
                $row['no']        = $no;
                $row['date']      = date("d-m-Y", strtotime($field->date));
                $row['time']      = date("H:i A", strtotime($field->date));
                $row['rearbrake'] = $realval;
                $data[]           = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_rb($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_rb($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_oil_pressure_min($sn){
            
            $sn      = $this->my_encryption->decode($this->pregReps($sn));
            $oil_min = $this->mod_detail_hd->get_oil_min($sn);
            $data    = array();
            $no      = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_oil_min();
            list($rowmastervar) = $mastervar;

            foreach ($oil_min as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->oilplomin) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->oilplomin) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->oilplomin);
                }

                $no++;
                $row           = array();
                $row['no']     = $no;
                $row['date']   = date("d-m-Y", strtotime($field->date));
                $row['time']   = date("H:i A", strtotime($field->date));
                $row['oilpressmin'] = $realval / 100;
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_oil_min($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_oil_min($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_oil_pressure_max($sn){
            $sn                 = $this->my_encryption->decode($this->pregReps($sn));
            $oil_max            = $this->mod_detail_hd->get_oil_max($sn);
            $data               = array();
            $no                 = $this->pregRepn($this->input->post('start'));
            $mastervar          = $this->mod_detail_hd->get_data_mastervar_oil_max();
            list($rowmastervar) = $mastervar;
            foreach ($oil_max as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->oilpmax) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->oilpmax) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->oilpmax);
                }
                $no++;
                $row           = array();
                $row['no']     = $no;
                $row['date']   = date("d-m-Y", strtotime($field->date));
                $row['time']   = date("H:i A", strtotime($field->date));
                $row['oilpressmax'] = $realval / 100;
                $data[]        = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_hd->count_all_oil_max($sn),
                "recordsFiltered" => $this->mod_detail_hd->count_filtered_oil_max($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_oil_temperature($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_oil();
            $trend_eot = $this->mod_detail_hd->get_data_engine_oil_temperature($sn);

            // $category = array();
            // $category['name'] = 'date';
             
            // $series1 = array();
            // $series1['name'] = 'temp';
             
            // $series2 = array();
            // $series2['name'] = 'critical';
             
            // $series3 = array();
            // $series3['name'] = 'caution';



            $result = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_eot as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->engoiltemp) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->engoiltemp) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->engoiltemp);
                }

                // $category['data'][] = $row->date;
                // $series1['data'][]  = round($realval, 2);
                // $series2['data'][]  = $rowmastervar->criticalValue;
                // $series3['data'][]  = $rowmastervar->cautionValue;

                $result[] = array(
                    'date'     => $row->date,
                    'temp'     => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            // array_push($result, $category);
            // array_push($result, $series1);
            // array_push($result, $series2);
            // array_push($result, $series3);
            echo json_encode($result);
            // print json_encode($result, JSON_NUMERIC_CHECK);
        }

        public function chart_fuel_rate($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));

            $mastervar  = $this->mod_detail_hd->get_data_mastervar_fuel();
            $trend_fuel = $this->mod_detail_hd->get_data_fuel_rate($sn);
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

            $mastervar = $this->mod_detail_hd->get_data_mastervar_tot();
            $trend_tot = $this->mod_detail_hd->get_data_tot($sn);
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

            $mastervar = $this->mod_detail_hd->get_data_mastervar_ect();
            $trend_ect = $this->mod_detail_hd->get_data_ect($sn);
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

            $mastervar = $this->mod_detail_hd->get_data_mastervar_bbp();
            $trend_bbp = $this->mod_detail_hd->get_data_bbp($sn);
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
                    'date'     => $row->date,
                    'blowbypress' => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function chart_boost_pressure($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_bp();
            $trend_bp  = $this->mod_detail_hd->get_data_bp($sn);
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
                    'date'     => $row->date,
                    'boostpress' => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function chart_travel_speed($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_ts();
            $trend_ts  = $this->mod_detail_hd->get_data_ts($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_ts as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->travelspeed) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->travelspeed) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->travelspeed);
                }
                $output[] = array(
                    'date'     => $row->date,
                    'travelspeed' => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function chart_engine_speed($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_es();
            $trend_es  = $this->mod_detail_hd->get_data_es($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_es as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->enginespeed) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->enginespeed) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->enginespeed);
                }
                $output[] = array(
                    'date'     => $row->date,
                    'enginespeed' => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function chart_front_brake($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_fb();
            $trend_fb  = $this->mod_detail_hd->get_data_fb($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_fb as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->frontbrake) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->frontbrake) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->frontbrake);
                }
                $output[] = array(
                    'date'     => $row->date,
                    'frontbrake' => round($realval, 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function chart_rear_brake($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));

            $mastervar = $this->mod_detail_hd->get_data_mastervar_rb();
            $trend_rb  = $this->mod_detail_hd->get_data_rb($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_rb as $row) {
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

        public function chart_oil_press_min($sn){
            $sn           = $this->my_encryption->decode($this->pregReps($sn));
            $mastervar    = $this->mod_detail_hd->get_data_mastervar_oil_min();
            $trend_oilmin = $this->mod_detail_hd->get_data_oil_press_min($sn);
            $output       = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_oilmin as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->oilplomin) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->oilplomin) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->oilplomin);
                }
                $output[] = array(
                    'date'      => $row->date,
                    'oilplomin' => round(($realval / 100), 2),
                    'critical'  => $rowmastervar->criticalValue,
                    'caution'   => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function chart_oil_press_max($sn){
            $sn           = $this->my_encryption->decode($this->pregReps($sn));
            $mastervar    = $this->mod_detail_hd->get_data_mastervar_oil_max();
            $trend_oilmax = $this->mod_detail_hd->get_data_oil_press_max($sn);
            $output       = array();
            list($rowmastervar) = $mastervar;

            foreach ($trend_oilmax as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->oilpmax) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->oilpmax) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->oilpmax);
                }
                $output[] = array(
                    'date'     => $row->date,
                    'oilpmax'  => round(($realval / 100), 2),
                    'critical' => $rowmastervar->criticalValue,
                    'caution'  => $rowmastervar->cautionValue
                );
            }
            echo json_encode($output);
        }

        public function createXLS() {
            $fileName = 'data-warning-hd-'.date("Ymdhis").'.xlsx';  

            $this->load->library('excel');
            $sn = "J30094";
            $empInfo = $this->mod_detail_hd->get_data_rb($sn);
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            // set Header
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Email');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'DOB');
            $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Contact_No');       
            // set Row
            $rowCount = 2;
            foreach ($empInfo as $element) {
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['first_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['last_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['email']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['dob']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['contact_no']);
                $rowCount++;
            }
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save(ROOT_UPLOAD_IMPORT_PATH.$fileName);
            // download file
            header("Content-Type: application/vnd.ms-excel");
            redirect(HTTP_UPLOAD_IMPORT_PATH.$fileName);        
        }

    }
?>