<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdetail_exca extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
                redirect('login');
            }
            $this->load->model(['mdetail/exca/mod_detail_exca']);
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
                'content' => 'pages/pdetail/exca/vdetail_exca',
                'detail_exca' => $this->mod_detail_exca->get_detail_exca($sn),
                'site_unit'   => $this->mod_detail_exca->get_unit_exca($sn)
        	);
        	$this->load->view('pages/pindex/index', $data);
        }

        public function table_warning_unit($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $sn = $this->pregReps($sn);
            $warning_unit = $this->mod_detail_exca->get_warning_unit($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

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
                "recordsTotal"    => $this->mod_detail_exca->count_all_warning_unit($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_warning_unit($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_engine_oil_temperature($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $eot  = $this->mod_detail_exca->get_eot($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_exca->get_data_mastervar_oil();
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
                $row             = array();
                $row['no']       = $no;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['temperature'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_eot($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_eot($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_fuel_rate($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $fuel_rate  = $this->mod_detail_exca->get_fuel_rate($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar  = $this->mod_detail_exca->get_data_mastervar_fuel();
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
                "recordsTotal"    => $this->mod_detail_exca->count_all_fuel_rate($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_fuel_rate($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_transmission_oil_temperature($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $tot  = $this->mod_detail_exca->get_tot($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_exca->get_data_mastervar_tot();
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
                "recordsTotal"    => $this->mod_detail_exca->count_all_tot($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_tot($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_engine_coolant_temperature($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $ect  = $this->mod_detail_exca->get_ect($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_exca->get_data_mastervar_ect();
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
                "recordsTotal"    => $this->mod_detail_exca->count_all_ect($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_ect($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_blow_by_pressure($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $bbp  = $this->mod_detail_exca->get_bbp($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_exca->get_data_mastervar_bbp();
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
                "recordsTotal"    => $this->mod_detail_exca->count_all_bbp($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_bbp($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_boost_pressure($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $bp   = $this->mod_detail_exca->get_bp($sn);
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            $mastervar = $this->mod_detail_exca->get_data_mastervar_bp();
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
                "recordsTotal"    => $this->mod_detail_exca->count_all_bp($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_bp($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function chart_engine_oil_temperature($sn){
            
            $sn = $this->my_encryption->decode($this->pregReps($sn));

            $mastervar = $this->mod_detail_exca->get_data_mastervar_oil();
            $trend_eot = $this->mod_detail_exca->get_data_engine_oil_temperature($sn);
            $output  = array();
            list($rowmastervar) = $mastervar;

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

            $mastervar  = $this->mod_detail_exca->get_data_mastervar_fuel();
            $trend_fuel = $this->mod_detail_exca->get_data_fuel_rate($sn);
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

            $mastervar = $this->mod_detail_exca->get_data_mastervar_tot();
            $trend_tot = $this->mod_detail_exca->get_data_tot($sn);
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

            $mastervar = $this->mod_detail_exca->get_data_mastervar_ect();
            $trend_ect = $this->mod_detail_exca->get_data_ect($sn);
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

            $mastervar = $this->mod_detail_exca->get_data_mastervar_bbp();
            $trend_bbp = $this->mod_detail_exca->get_data_bbp($sn);
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

            $mastervar = $this->mod_detail_exca->get_data_mastervar_bp();
            $trend_bp  = $this->mod_detail_exca->get_data_bp($sn);
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

    }
?>