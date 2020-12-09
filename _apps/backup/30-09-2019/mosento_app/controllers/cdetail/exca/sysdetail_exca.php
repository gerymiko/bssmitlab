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
            $sn     = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $warning_unit = $this->mod_detail_exca->get_warning_unit($sn, $length, $start);

            foreach ($warning_unit as $field){
                if (date("d-m-Y", strtotime($field->tgl)) == date("d-m-Y") ) {
                    $today_notif = '<span class="label label-success">Today</span>';
                } else {
                    $today_notif = '';
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
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
            $sn     = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $eot  = $this->mod_detail_exca->get_eot($sn, $length, $start);

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
                $start++;
                $row             = array();
                $row['no']       = $start;
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
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $fuel_rate  = $this->mod_detail_exca->get_fuel_rate($sn, $length, $start);

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
                $start++;
                $row             = array();
                $row['no']       = $start;
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
            $sn     = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $tot    = $this->mod_detail_exca->get_tot($sn, $length, $start);

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
                $start++;
                $row              = array();
                $row['no']        = $start;
                $row['date']      = date("d-m-Y", strtotime($field->date));
                $row['time']      = date("H:i A", strtotime($field->date));
                $row['tmoiltemp'] = $realval;
                $data[]           = $row;
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
            $sn     = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $ect  = $this->mod_detail_exca->get_ect($sn, $length, $start);

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
                $start++;
                $row             = array();
                $row['no']       = $start;
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
            $sn     = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $bbp  = $this->mod_detail_exca->get_bbp($sn, $length, $start);

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

                $start++;
                $row             = array();
                $row['no']       = $start;
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
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $bp   = $this->mod_detail_exca->get_bp($sn, $length, $start);

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

                $start++;
                $row             = array();
                $row['no']       = $start;
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

        public function table_pump_front_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $pfpmax   = $this->mod_detail_exca->get_pfpmax($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('pumpF_press_max');

            foreach ($pfpmax as $field){
                if ($rowmastervar->operation == 'multiplication'){
                    $realval = (floatval($field->pumpF_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division'){
                    $realval = (floatval($field->pumpF_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pumpF_press_max);
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['pumpF_press_max'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_pfpmax($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_pfpmax($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_pump_rear_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $prpmax   = $this->mod_detail_exca->get_prpmax($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('pumpR_press_max');

            foreach ($prpmax as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pumpR_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pumpR_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pumpR_press_max);
                }
                $start++;
                $row             = array();
                $row['no']       = $start;
                $row['date']     = date("d-m-Y", strtotime($field->date));
                $row['time']     = date("H:i A", strtotime($field->date));
                $row['pumpR_press_max'] = $realval;
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_prpmax($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_prpmax($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_swing_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $swing   = $this->mod_detail_exca->get_swing($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('swing_press_max');

            foreach ($swing as $field){
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
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['swing'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_swing($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_swing($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_g1pump_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $g1pump   = $this->mod_detail_exca->get_g1pump($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('g1pump_press_max');

            foreach ($g1pump as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->g1pump_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->g1pump_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->g1pump_press_max);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['g1pump'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_g1pump($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_g1pump($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_g2pump_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $g2pump   = $this->mod_detail_exca->get_g2pump($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('g2pump_press_max');

            foreach ($g2pump as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->g2pump_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->g2pump_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->g2pump_press_max);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['g2pump'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_g2pump($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_g2pump($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_pto_temp_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $pto_temp_max   = $this->mod_detail_exca->get_pto_temp_max($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('pto_temp_max');

            foreach ($pto_temp_max as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pto_temp_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pto_temp_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pto_temp_max);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['pto_temp_max'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_pto_temp_max($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_pto_temp_max($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_pto_temp_min($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $pto_temp_min   = $this->mod_detail_exca->get_pto_temp_min($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('pto_temp_min');

            foreach ($pto_temp_min as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->pto_temp_min) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->pto_temp_min) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->pto_temp_min);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['pto_temp_min'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_pto_temp_min($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_pto_temp_min($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_arm_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $arm_ppc_on   = $this->mod_detail_exca->get_arm_ppc_on($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('arm_ppc_on');

            foreach ($arm_ppc_on as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->arm_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->arm_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->arm_ppc_on);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['arm_ppc_on'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_arm_ppc_on($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_arm_ppc_on($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_bucket_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $bucket_ppc_on   = $this->mod_detail_exca->get_bucket_ppc_on($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('bucket_ppc_on');

            foreach ($bucket_ppc_on as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->bucket_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->bucket_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->bucket_ppc_on);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['bucket_ppc_on'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_bucket_ppc_on($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_bucket_ppc_on($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_boom_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $boom_ppc_on   = $this->mod_detail_exca->get_boom_ppc_on($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('boom_ppc_on');

            foreach ($boom_ppc_on as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->boom_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->boom_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->boom_ppc_on);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['boom_ppc_on'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_boom_ppc_on($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_boom_ppc_on($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_swing_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $swing_ppc_on   = $this->mod_detail_exca->get_swing_ppc_on($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('swing_ppc_on');

            foreach ($swing_ppc_on as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->swing_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->swing_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->swing_ppc_on);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['swing_ppc_on'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_swing_ppc_on($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_swing_ppc_on($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_travel_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $travel_ppc_on   = $this->mod_detail_exca->get_travel_ppc_on($sn, $length, $start);

            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('travel_ppc_on');

            foreach ($travel_ppc_on as $field){
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($field->travel_ppc_on) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($field->travel_ppc_on) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($field->travel_ppc_on);
                }
                $start++;
                $row          = array();
                $row['no']    = $start;
                $row['date']  = date("d-m-Y", strtotime($field->date));
                $row['time']  = date("H:i A", strtotime($field->date));
                $row['travel_ppc_on'] = $realval;
                $data[]       = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_detail_exca->count_all_travel_ppc_on($sn),
                "recordsFiltered" => $this->mod_detail_exca->count_filtered_travel_ppc_on($sn),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        // CHART
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

        public function chart_pump_front_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_pfpmax  = $this->mod_detail_exca->get_data_pfpmax($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('pumpF_press_max');

            foreach ($trend_pfpmax as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pumpF_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pumpF_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pumpF_press_max);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'pumpF_press_max' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_pump_rear_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_prpmax  = $this->mod_detail_exca->get_data_prpmax($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('pumpR_press_max');

            foreach ($trend_prpmax as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pumpR_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pumpR_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pumpR_press_max);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'pumpR_press_max' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_swing_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_swing  = $this->mod_detail_exca->get_data_swing($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('swing_press_max');

            foreach ($trend_swing as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->swing_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->swing_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->swing_press_max);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'swing_press_max' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_g1pump_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_g1pump  = $this->mod_detail_exca->get_data_g1pump($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('g1pump_press_max');

            foreach ($trend_g1pump as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->g1pump_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->g1pump_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->g1pump_press_max);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'g1pump_press_max' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_g2pump_pressure_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_g2pump  = $this->mod_detail_exca->get_data_g2pump($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('g2pump_press_max');

            foreach ($trend_g2pump as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->g2pump_press_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->g2pump_press_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->g2pump_press_max);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'g2pump_press_max' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_pto_temp_max($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_pto_temp_max  = $this->mod_detail_exca->get_data_pto_temp_max($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('pto_temp_max');

            foreach ($trend_pto_temp_max as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pto_temp_max) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pto_temp_max) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pto_temp_max);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'pto_temp_max' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_pto_temp_min($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_pto_temp_min  = $this->mod_detail_exca->get_data_pto_temp_min($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('pto_temp_min');

            foreach ($trend_pto_temp_min as $row) {
                if ($rowmastervar->operation == 'multiplication') {
                    $realval = (floatval($row->pto_temp_min) * floatval($rowmastervar->value));
                } elseif ($rowmastervar->operation == 'division') {
                    $realval = (floatval($row->pto_temp_min) / floatval($rowmastervar->value));
                } else {
                    $realval = floatval($row->pto_temp_min);
                }
                $output[] = array(
                    'date'       => $row->date,
                    'pto_temp_min' => round($realval, 2),
                    'critical'   => round($rowmastervar->criticalValue, 2),
                    'caution'    => round($rowmastervar->cautionValue, 2)
                );
            }
            echo json_encode($output);
        }

        public function chart_arm_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_arm_ppc_on  = $this->mod_detail_exca->get_data_arm_ppc_on($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('arm_ppc_on');

            foreach ($trend_arm_ppc_on as $row) {
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

        public function chart_bucket_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_bucket_ppc_on  = $this->mod_detail_exca->get_data_bucket_ppc_on($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('bucket_ppc_on');

            foreach ($trend_bucket_ppc_on as $row) {
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

        public function chart_boom_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_boom_ppc_on  = $this->mod_detail_exca->get_data_boom_ppc_on($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('boom_ppc_on');

            foreach ($trend_boom_ppc_on as $row) {
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

        public function chart_swing_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_swing_ppc_on  = $this->mod_detail_exca->get_data_swing_ppc_on($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('swing_ppc_on');

            foreach ($trend_swing_ppc_on as $row) {
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

        public function chart_travel_ppc_on($sn){
            $sn = $this->my_encryption->decode($this->pregReps($sn));
            $trend_travel_ppc_on  = $this->mod_detail_exca->get_data_travel_ppc_on($sn);
            $output  = array();
            list($rowmastervar) = $this->mod_detail_exca->fetch_data_mastervar('travel_ppc_on');

            foreach ($trend_travel_ppc_on as $row) {
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