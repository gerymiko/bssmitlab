<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysexport_dozer extends CI_Controller{

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
                } elseif ($this->accessRights!=null && $this->accessRights->export !== 1 || $this->accessRights->status_active !== 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                }
            }
            $this->load->model(['mwarning/dozer/mod_warning_dozer']);
            $this->load->library("excel");
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

        private static function viewTime($time){
            return $result = date("H:i:s", strtotime($time));
        }

        function export($site){
            $sn         = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $dateStart  = $this->viewDate($this->pregReps($this->uri->segment(5)));
            $dateEnd    = $this->viewDate($this->pregReps($this->uri->segment(6)));
            $trend_data = $this->mod_warning_dozer->fetch_data_trend($sn, $dateStart, $dateEnd, $site);

            $obj = new PHPExcel();

            $objWorkSheet0  = $obj->createSheet(0);
            $objWorkSheet1  = $obj->createSheet(1);
            $objWorkSheet2  = $obj->createSheet(2);
            $objWorkSheet3  = $obj->createSheet(3);
            $objWorkSheet4  = $obj->createSheet(4);
            $objWorkSheet5  = $obj->createSheet(5);
            $objWorkSheet6  = $obj->createSheet(6);
            $objWorkSheet7  = $obj->createSheet(7);
            $objWorkSheet8  = $obj->createSheet(8);
            $objWorkSheet9  = $obj->createSheet(9);
            $objWorkSheet10 = $obj->createSheet(10);
            $objWorkSheet11 = $obj->createSheet(11);
            $objWorkSheet12 = $obj->createSheet(12);
            $objWorkSheet13 = $obj->createSheet(13);
            $objWorkSheet14 = $obj->createSheet(14);
            $objWorkSheet15 = $obj->createSheet(15);
            $objWorkSheet16 = $obj->createSheet(16);
            $objWorkSheet17 = $obj->createSheet(17);
            $objWorkSheet18 = $obj->createSheet(18);
            $objWorkSheet19 = $obj->createSheet(19);
            $objWorkSheet20 = $obj->createSheet(20);
            $objWorkSheet21 = $obj->createSheet(21);
            $objWorkSheet22 = $obj->createSheet(22);
            $objWorkSheet23 = $obj->createSheet(23);
            $objWorkSheet24 = $obj->createSheet(24);
            $objWorkSheet25 = $obj->createSheet(25);
            $objWorkSheet26 = $obj->createSheet(26);

            $objWorkSheet0->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet1->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet2->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet3->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet4->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet5->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet6->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet7->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet8->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet9->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet10->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet11->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet12->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet13->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet14->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet15->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet16->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet17->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet18->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet19->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet20->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet21->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet22->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet23->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet24->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet25->getStyle('A1:C1')->getFont()->setBold(true);
            $objWorkSheet26->getStyle('A1:C1')->getFont()->setBold(true);

            $tcolumn0 = array('Date', 'Time', 'Description');
            $tcolumn1 = array('Date', 'Time', 'Temperatures (DegC)');
            $tcolumn2 = array('Date', 'Time', 'Rate (liter / Hour)');
            $tcolumn3 = array('Date', 'Time', 'Temperatures (DegC)');
            $tcolumn4 = array('Date', 'Time', 'Temperatures (DegC)');
            $tcolumn5 = array('Date', 'Time', 'Pressure (mmAq)');
            $tcolumn6 = array('Date', 'Time', 'Pressure (mmHg)');
            $tcolumn7 = array('Date', 'Time', 'Second (Sec)');
            $tcolumn8 = array('Date', 'Time', 'Second (Sec)');
            $tcolumn9 = array('Date', 'Time', 'Second (Sec)');
            $tcolumn10 = array('Date', 'Time', 'Second (Sec)');
            $tcolumn11 = array('Date', 'Time', 'Second (Sec)');
            $tcolumn12 = array('Date', 'Time', 'KM/hour');
            $tcolumn13 = array('Date', 'Time', 'KM/hour');
            $tcolumn14 = array('Date', 'Time', 'KM/hour');
            $tcolumn15 = array('Date', 'Time', 'KM/hour');
            $tcolumn16 = array('Date', 'Time', 'KM/hour');
            $tcolumn17 = array('Date', 'Time', 'KM/hour');
            $tcolumn18 = array('Date', 'Time', 'Hour');
            $tcolumn19 = array('Date', 'Time', 'Hour');
            $tcolumn20 = array('Date', 'Time', 'Hour');
            $tcolumn21 = array('Date', 'Time', 'Hour');
            $tcolumn22 = array('Date', 'Time', 'Hour');
            $tcolumn23 = array('Date', 'Time', 'Hour');
            $tcolumn24 = array('Date', 'Time', 'DegC');
            $tcolumn25 = array('Date', 'Time', 'DegC');
            $tcolumn26 = array('Date', 'Time', 'DegC');

            // WARNING
            $column0    = 0;
            $excel_row0 = 2;
            foreach($tcolumn0 as $field){
                $objWorkSheet0->setCellValueByColumnAndRow($column0, 1, $field);
                $column0++;
            }
            $warning_data = $this->mod_warning_dozer->fetch_data_warning($sn, $dateStart, $dateEnd, $site);
            foreach($warning_data as $row){
                $objWorkSheet0->setCellValueByColumnAndRow(0, $excel_row0, $this->viewDate($row->tgl))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet0->setCellValueByColumnAndRow(1, $excel_row0, $this->viewTime($row->tgl))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet0->setCellValueByColumnAndRow(2, $excel_row0, $row->ket)->getColumnDimension('C')->setAutoSize(true);
                $excel_row0++;
            }
            $objWorkSheet0->setTitle('Warning Status');

            // Engine Oil Temperatures
            $column1    = 0;
            $excel_row1 = 2;
            foreach($tcolumn1 as $field){
                $objWorkSheet1->setCellValueByColumnAndRow($column1, 1, $field);
                $column1++;
            }
            list($rowmaster1) = $this->mod_warning_dozer->fetch_data_mastervar('engoiltemp');
            foreach ($trend_data as $row){
                if ($rowmaster1->operation == 'multiplication') {
                    $values1 = (floatval($row->engoiltemp) * floatval($rowmaster1->value));
                } elseif ($rowmaster1->operation == 'division') {
                    $values1 = (floatval($row->engoiltemp) / floatval($rowmaster1->value));
                } else {
                    $values1 = floatval($row->engoiltemp);
                }
                $objWorkSheet1->setCellValueByColumnAndRow(0, $excel_row1, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet1->setCellValueByColumnAndRow(1, $excel_row1, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet1->setCellValueByColumnAndRow(2, $excel_row1, $values1)->getColumnDimension('C')->setAutoSize(true);
                $excel_row1++;
            }
            $objWorkSheet1->setTitle('Engine Oil Temperatures');

            // Fuel Rate
            $column2    = 0;
            $excel_row2 = 2;
            foreach($tcolumn2 as $field){
                $objWorkSheet2->setCellValueByColumnAndRow($column2, 1, $field);
                $column2++;
            }
            list($rowmaster2) = $this->mod_warning_dozer->fetch_data_mastervar('fuelrate');
            foreach ($trend_data as $row){
                if ($rowmaster2->operation == 'multiplication') {
                    $values2 = (floatval($row->fuelrate) * floatval($rowmaster2->value));
                } elseif ($rowmaster2->operation == 'division') {
                    $values2 = (floatval($row->fuelrate) / floatval($rowmaster2->value));
                } else {
                    $values2 = floatval($row->fuelrate);
                }
                $objWorkSheet2->setCellValueByColumnAndRow(0, $excel_row2, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet2->setCellValueByColumnAndRow(1, $excel_row2, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet2->setCellValueByColumnAndRow(2, $excel_row2, $values2)->getColumnDimension('C')->setAutoSize(true);
                $excel_row2++;
            }
            $objWorkSheet2->setTitle('Fuel Rate');

            // Transmission Oil Temperature
            $column3    = 0;
            $excel_row3 = 2;
            foreach($tcolumn3 as $field){
                $objWorkSheet3->setCellValueByColumnAndRow($column3, 1, $field);
                $column3++;
            }
            list($rowmaster3) = $this->mod_warning_dozer->fetch_data_mastervar('tmoiltemp');
            foreach ($trend_data as $row){
                if ($rowmaster3->operation == 'multiplication') {
                    $values3 = (floatval($row->tmoiltemp) * floatval($rowmaster3->value));
                } elseif ($rowmaster3->operation == 'division') {
                    $values3 = (floatval($row->tmoiltemp) / floatval($rowmaster3->value));
                } else {
                    $values3 = floatval($row->tmoiltemp);
                }
                $objWorkSheet3->setCellValueByColumnAndRow(0, $excel_row3, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet3->setCellValueByColumnAndRow(1, $excel_row3, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet3->setCellValueByColumnAndRow(2, $excel_row3, $values3)->getColumnDimension('C')->setAutoSize(true);
                $excel_row3++;
            }
            $objWorkSheet3->setTitle('Transmission Oil Temperature');

            // Engine Coolant Temperature
            $column4    = 0;
            $excel_row4 = 2;
            foreach($tcolumn4 as $field){
                $objWorkSheet4->setCellValueByColumnAndRow($column4, 1, $field);
                $column4++;
            }
            list($rowmaster4) = $this->mod_warning_dozer->fetch_data_mastervar('cooltemp');
            foreach ($trend_data as $row){
                if ($rowmaster4->operation == 'multiplication') {
                    $values4 = (floatval($row->cooltemp) * floatval($rowmaster4->value));
                } elseif ($rowmaster4->operation == 'division') {
                    $values4 = (floatval($row->cooltemp) / floatval($rowmaster4->value));
                } else {
                    $values4 = floatval($row->cooltemp);
                }
                $objWorkSheet4->setCellValueByColumnAndRow(0, $excel_row4, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet4->setCellValueByColumnAndRow(1, $excel_row4, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet4->setCellValueByColumnAndRow(2, $excel_row4, $values4)->getColumnDimension('C')->setAutoSize(true);
                $excel_row4++;
            }
            $objWorkSheet4->setTitle('Engine Coolant Temperature');

            // Blow By Pressure
            $column5    = 0;
            $excel_row5 = 2;
            foreach($tcolumn5 as $field){
                $objWorkSheet5->setCellValueByColumnAndRow($column5, 1, $field);
                $column5++;
            }
            list($rowmaster5) = $this->mod_warning_dozer->fetch_data_mastervar('blowbypress');
            foreach ($trend_data as $row){
                if ($rowmaster5->operation == 'multiplication') {
                    $values5 = (floatval($row->blowbypress) * floatval($rowmaster5->value));
                } elseif ($rowmaster5->operation == 'division') {
                    $values5 = (floatval($row->blowbypress) / floatval($rowmaster5->value));
                } else {
                    $values5 = floatval($row->blowbypress);
                }
                $objWorkSheet5->setCellValueByColumnAndRow(0, $excel_row5, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet5->setCellValueByColumnAndRow(1, $excel_row5, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet5->setCellValueByColumnAndRow(2, $excel_row5, $values5)->getColumnDimension('C')->setAutoSize(true);
                $excel_row5++;
            }
            $objWorkSheet5->setTitle('Blow By Pressure');

            // Boost Pressure
            $column6    = 0;
            $excel_row6 = 2;
            foreach($tcolumn6 as $field){
                $objWorkSheet6->setCellValueByColumnAndRow($column6, 1, $field);
                $column6++;
            }
            list($rowmaster6) = $this->mod_warning_dozer->fetch_data_mastervar('blowbypress');
            foreach ($trend_data as $row){
                if ($rowmaster6->operation == 'multiplication') {
                    $values6 = (floatval($row->blowbypress) * floatval($rowmaster6->value));
                } elseif ($rowmaster6->operation == 'division') {
                    $values6 = (floatval($row->blowbypress) / floatval($rowmaster6->value));
                } else {
                    $values6 = floatval($row->blowbypress);
                }
                $objWorkSheet6->setCellValueByColumnAndRow(0, $excel_row6, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet6->setCellValueByColumnAndRow(1, $excel_row6, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet6->setCellValueByColumnAndRow(2, $excel_row6, $values6)->getColumnDimension('C')->setAutoSize(true);
                $excel_row6++;
            }
            $objWorkSheet6->setTitle('Boost Pressure');

            // Transmission Main Pressure Maximal
            $column7    = 0;
            $excel_row7 = 2;
            foreach($tcolumn7 as $field){
                $objWorkSheet7->setCellValueByColumnAndRow($column7, 1, $field);
                $column7++;
            }
            list($rowmaster7) = $this->mod_warning_dozer->fetch_data_mastervar('transmain_pressure_max');
            foreach ($trend_data as $row){
                if ($rowmaster7->operation == 'multiplication') {
                    $values7 = (floatval($row->transmain_pressure_max) * floatval($rowmaster7->value));
                } elseif ($rowmaster7->operation == 'division') {
                    $values7 = (floatval($row->transmain_pressure_max) / floatval($rowmaster7->value));
                } else {
                    $values7 = floatval($row->transmain_pressure_max);
                }
                $objWorkSheet7->setCellValueByColumnAndRow(0, $excel_row7, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet7->setCellValueByColumnAndRow(1, $excel_row7, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet7->setCellValueByColumnAndRow(2, $excel_row7, $values7)->getColumnDimension('C')->setAutoSize(true);
                $excel_row7++;
            }
            $objWorkSheet7->setTitle('Transmission Main Pressure Max');

            // Transmission Main Pressure Average
            $column8    = 0;
            $excel_row8 = 2;
            foreach($tcolumn8 as $field){
                $objWorkSheet8->setCellValueByColumnAndRow($column8, 1, $field);
                $column8++;
            }
            list($rowmaster8) = $this->mod_warning_dozer->fetch_data_mastervar('transmain_pressure_avg');
            foreach ($trend_data as $row){
                if ($rowmaster8->operation == 'multiplication') {
                    $values8 = (floatval($row->transmain_pressure_avg) * floatval($rowmaster8->value));
                } elseif ($rowmaster8->operation == 'division') {
                    $values8 = (floatval($row->transmain_pressure_avg) / floatval($rowmaster8->value));
                } else {
                    $values8 = floatval($row->transmain_pressure_avg);
                }
                $objWorkSheet8->setCellValueByColumnAndRow(0, $excel_row8, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet8->setCellValueByColumnAndRow(1, $excel_row8, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet8->setCellValueByColumnAndRow(2, $excel_row8, $values8)->getColumnDimension('C')->setAutoSize(true);
                $excel_row8++;
            }
            $objWorkSheet8->setTitle('Transmission Main Pressure Avg');

            // Operating Time
            $column9    = 0;
            $excel_row9 = 2;
            foreach($tcolumn9 as $field){
                $objWorkSheet9->setCellValueByColumnAndRow($column9, 1, $field);
                $column9++;
            }
            foreach ($trend_data as $row){
                $objWorkSheet9->setCellValueByColumnAndRow(0, $excel_row9, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet9->setCellValueByColumnAndRow(1, $excel_row9, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet9->setCellValueByColumnAndRow(2, $excel_row9, $row->opr_time)->getColumnDimension('C')->setAutoSize(true);
                $excel_row9++;
            }
            $objWorkSheet9->setTitle('Operating Time');

            // Dozing Time
            $column10    = 0;
            $excel_row10 = 2;
            foreach($tcolumn10 as $field){
                $objWorkSheet10->setCellValueByColumnAndRow($column10, 1, $field);
                $column10++;
            }
            foreach ($trend_data as $row){
                $objWorkSheet10->setCellValueByColumnAndRow(0, $excel_row10, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet10->setCellValueByColumnAndRow(1, $excel_row10, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet10->setCellValueByColumnAndRow(2, $excel_row10, $row->dozing_time)->getColumnDimension('C')->setAutoSize(true);
                $excel_row10++;
            }
            $objWorkSheet10->setTitle('Dozing Time');

            // ripping Time
            $column11    = 0;
            $excel_row11 = 2;
            foreach($tcolumn11 as $field){
                $objWorkSheet11->setCellValueByColumnAndRow($column11, 1, $field);
                $column11++;
            }
            foreach ($trend_data as $row){
                $objWorkSheet11->setCellValueByColumnAndRow(0, $excel_row11, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet11->setCellValueByColumnAndRow(1, $excel_row11, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet11->setCellValueByColumnAndRow(2, $excel_row11, $row->ripping_time)->getColumnDimension('C')->setAutoSize(true);
                $excel_row11++;
            }
            $objWorkSheet11->setTitle('Ripping Time');

            // Forward Distance @F1
            $column12    = 0;
            $excel_row12 = 2;
            foreach($tcolumn12 as $field){
                $objWorkSheet12->setCellValueByColumnAndRow($column12, 1, $field);
                $column12++;
            }
            list($rowmaster12) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f1');
            foreach ($trend_data as $row){
                if ($rowmaster12->operation == 'multiplication') {
                    $values12 = (floatval($row->fwd_distance_f1) * floatval($rowmaster12->value));
                } elseif ($rowmaster12->operation == 'division') {
                    $values12 = (floatval($row->fwd_distance_f1) / floatval($rowmaster12->value));
                } else {
                    $values12 = floatval($row->fwd_distance_f1);
                }
                $objWorkSheet12->setCellValueByColumnAndRow(0, $excel_row12, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet12->setCellValueByColumnAndRow(1, $excel_row12, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet12->setCellValueByColumnAndRow(2, $excel_row12, $values12)->getColumnDimension('C')->setAutoSize(true);
                $excel_row12++;
            }
            $objWorkSheet12->setTitle('Forward Distance @F1');

            // Forward Distance @F2
            $column13    = 0;
            $excel_row13 = 2;
            foreach($tcolumn13 as $field){
                $objWorkSheet13->setCellValueByColumnAndRow($column13, 1, $field);
                $column13++;
            }
            list($rowmaster13) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f2');
            foreach ($trend_data as $row){
                if ($rowmaster13->operation == 'multiplication') {
                    $values13 = (floatval($row->fwd_distance_f2) * floatval($rowmaster13->value));
                } elseif ($rowmaster13->operation == 'division') {
                    $values13 = (floatval($row->fwd_distance_f2) / floatval($rowmaster13->value));
                } else {
                    $values13 = floatval($row->fwd_distance_f2);
                }
                $objWorkSheet13->setCellValueByColumnAndRow(0, $excel_row13, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet13->setCellValueByColumnAndRow(1, $excel_row13, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet13->setCellValueByColumnAndRow(2, $excel_row13, $values13)->getColumnDimension('C')->setAutoSize(true);
                $excel_row13++;
            }
            $objWorkSheet13->setTitle('Forward Distance @F2');

            // Forward Distance @F3
            $column14    = 0;
            $excel_row14 = 2;
            foreach($tcolumn14 as $field){
                $objWorkSheet14->setCellValueByColumnAndRow($column14, 1, $field);
                $column14++;
            }
            list($rowmaster14) = $this->mod_warning_dozer->fetch_data_mastervar('fwd_distance_f3');
            foreach ($trend_data as $row){
                if ($rowmaster14->operation == 'multiplication') {
                    $values14 = (floatval($row->fwd_distance_f3) * floatval($rowmaster14->value));
                } elseif ($rowmaster14->operation == 'division') {
                    $values14 = (floatval($row->fwd_distance_f3) / floatval($rowmaster14->value));
                } else {
                    $values14 = floatval($row->fwd_distance_f3);
                }
                $objWorkSheet14->setCellValueByColumnAndRow(0, $excel_row14, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet14->setCellValueByColumnAndRow(1, $excel_row14, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet14->setCellValueByColumnAndRow(2, $excel_row14, $values14)->getColumnDimension('C')->setAutoSize(true);
                $excel_row14++;
            }
            $objWorkSheet14->setTitle('Forward Distance @F3');

            // Reverse Distance @R1
            $column15    = 0;
            $excel_row15 = 2;
            foreach($tcolumn15 as $field){
                $objWorkSheet15->setCellValueByColumnAndRow($column15, 1, $field);
                $column15++;
            }
            list($rowmaster15) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r1');
            foreach ($trend_data as $row){
                if ($rowmaster15->operation == 'multiplication') {
                    $values15 = (floatval($row->rvs_distance_r1) * floatval($rowmaster15->value));
                } elseif ($rowmaster15->operation == 'division') {
                    $values15 = (floatval($row->rvs_distance_r1) / floatval($rowmaster15->value));
                } else {
                    $values15 = floatval($row->rvs_distance_r1);
                }
                $objWorkSheet15->setCellValueByColumnAndRow(0, $excel_row15, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet15->setCellValueByColumnAndRow(1, $excel_row15, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet15->setCellValueByColumnAndRow(2, $excel_row15, $values15)->getColumnDimension('C')->setAutoSize(true);
                $excel_row15++;
            }
            $objWorkSheet15->setTitle('Reverse Distance @R1');

            // Reverse Distance @R2
            $column16    = 0;
            $excel_row16 = 2;
            foreach($tcolumn16 as $field){
                $objWorkSheet16->setCellValueByColumnAndRow($column16, 1, $field);
                $column16++;
            }
            list($rowmaster16) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r2');
            foreach ($trend_data as $row){
                if ($rowmaster16->operation == 'multiplication') {
                    $values16 = (floatval($row->rvs_distance_r2) * floatval($rowmaster16->value));
                } elseif ($rowmaster16->operation == 'division') {
                    $values16 = (floatval($row->rvs_distance_r2) / floatval($rowmaster16->value));
                } else {
                    $values16 = floatval($row->rvs_distance_r2);
                }
                $objWorkSheet16->setCellValueByColumnAndRow(0, $excel_row16, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet16->setCellValueByColumnAndRow(1, $excel_row16, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet16->setCellValueByColumnAndRow(2, $excel_row16, $values16)->getColumnDimension('C')->setAutoSize(true);
                $excel_row16++;
            }
            $objWorkSheet16->setTitle('Reverse Distance @R2');

            // Reverse Distance @R3
            $column17    = 0;
            $excel_row17 = 2;
            foreach($tcolumn17 as $field){
                $objWorkSheet17->setCellValueByColumnAndRow($column17, 1, $field);
                $column17++;
            }
            list($rowmaster17) = $this->mod_warning_dozer->fetch_data_mastervar('rvs_distance_r3');
            foreach ($trend_data as $row){
                if ($rowmaster17->operation == 'multiplication') {
                    $values17 = (floatval($row->rvs_distance_r3) * floatval($rowmaster17->value));
                } elseif ($rowmaster17->operation == 'division') {
                    $values17 = (floatval($row->rvs_distance_r3) / floatval($rowmaster17->value));
                } else {
                    $values17 = floatval($row->rvs_distance_r3);
                }
                $objWorkSheet17->setCellValueByColumnAndRow(0, $excel_row17, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet17->setCellValueByColumnAndRow(1, $excel_row17, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet17->setCellValueByColumnAndRow(2, $excel_row17, $values17)->getColumnDimension('C')->setAutoSize(true);
                $excel_row17++;
            }
            $objWorkSheet17->setTitle('Reverse Distance @R3');

            // Travel Time @F1
            $column18    = 0;
            $excel_row18 = 2;
            foreach($tcolumn18 as $field){
                $objWorkSheet18->setCellValueByColumnAndRow($column18, 1, $field);
                $column18++;
            }
            list($rowmaster18) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f1');
            foreach ($trend_data as $row){
                if ($rowmaster18->operation == 'multiplication') {
                    $values18 = (floatval($row->travel_time_f1) * floatval($rowmaster18->value));
                } elseif ($rowmaster18->operation == 'division') {
                    $values18 = (floatval($row->travel_time_f1) / floatval($rowmaster18->value));
                } else {
                    $values18 = floatval($row->travel_time_f1);
                }
                $objWorkSheet18->setCellValueByColumnAndRow(0, $excel_row18, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet18->setCellValueByColumnAndRow(1, $excel_row18, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet18->setCellValueByColumnAndRow(2, $excel_row18, $values18)->getColumnDimension('C')->setAutoSize(true);
                $excel_row18++;
            }
            $objWorkSheet18->setTitle('Travel Time @F1');

            // Travel Time @F2
            $column19    = 0;
            $excel_row19 = 2;
            foreach($tcolumn19 as $field){
                $objWorkSheet19->setCellValueByColumnAndRow($column19, 1, $field);
                $column19++;
            }
            list($rowmaster19) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f2');
            foreach ($trend_data as $row){
                if ($rowmaster19->operation == 'multiplication') {
                    $values19 = (floatval($row->travel_time_f2) * floatval($rowmaster19->value));
                } elseif ($rowmaster19->operation == 'division') {
                    $values19 = (floatval($row->travel_time_f2) / floatval($rowmaster19->value));
                } else {
                    $values19 = floatval($row->travel_time_f2);
                }
                $objWorkSheet19->setCellValueByColumnAndRow(0, $excel_row19, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet19->setCellValueByColumnAndRow(1, $excel_row19, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet19->setCellValueByColumnAndRow(2, $excel_row19, $values19)->getColumnDimension('C')->setAutoSize(true);
                $excel_row19++;
            }
            $objWorkSheet19->setTitle('Travel Time @F2');

            // Travel Time @F3
            $column20    = 0;
            $excel_row20 = 2;
            foreach($tcolumn20 as $field){
                $objWorkSheet20->setCellValueByColumnAndRow($column20, 1, $field);
                $column20++;
            }
            list($rowmaster20) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_f3');
            foreach ($trend_data as $row){
                if ($rowmaster20->operation == 'multiplication') {
                    $values20 = (floatval($row->travel_time_f3) * floatval($rowmaster20->value));
                } elseif ($rowmaster20->operation == 'division') {
                    $values20 = (floatval($row->travel_time_f3) / floatval($rowmaster20->value));
                } else {
                    $values20 = floatval($row->travel_time_f3);
                }
                $objWorkSheet20->setCellValueByColumnAndRow(0, $excel_row20, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet20->setCellValueByColumnAndRow(1, $excel_row20, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet20->setCellValueByColumnAndRow(2, $excel_row20, $values20)->getColumnDimension('C')->setAutoSize(true);
                $excel_row20++;
            }
            $objWorkSheet20->setTitle('Travel Time @F3');

            // Travel Time @R1
            $column21    = 0;
            $excel_row21 = 2;
            foreach($tcolumn21 as $field){
                $objWorkSheet21->setCellValueByColumnAndRow($column21, 1, $field);
                $column21++;
            }
            list($rowmaster21) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r1');
            foreach ($trend_data as $row){
                if ($rowmaster21->operation == 'multiplication') {
                    $values21 = (floatval($row->travel_time_r1) * floatval($rowmaster21->value));
                } elseif ($rowmaster21->operation == 'division') {
                    $values21 = (floatval($row->travel_time_r1) / floatval($rowmaster21->value));
                } else {
                    $values21 = floatval($row->travel_time_r1);
                }
                $objWorkSheet21->setCellValueByColumnAndRow(0, $excel_row21, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet21->setCellValueByColumnAndRow(1, $excel_row21, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet21->setCellValueByColumnAndRow(2, $excel_row21, $values21)->getColumnDimension('C')->setAutoSize(true);
                $excel_row21++;
            }
            $objWorkSheet21->setTitle('Travel Time @R1');

            // Travel Time @R2
            $column22    = 0;
            $excel_row22 = 2;
            foreach($tcolumn22 as $field){
                $objWorkSheet22->setCellValueByColumnAndRow($column22, 1, $field);
                $column22++;
            }
            list($rowmaster22) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r2');
            foreach ($trend_data as $row){
                if ($rowmaster22->operation == 'multiplication') {
                    $values22 = (floatval($row->travel_time_r2) * floatval($rowmaster22->value));
                } elseif ($rowmaster22->operation == 'division') {
                    $values22 = (floatval($row->travel_time_r2) / floatval($rowmaster22->value));
                } else {
                    $values22 = floatval($row->travel_time_r2);
                }
                $objWorkSheet22->setCellValueByColumnAndRow(0, $excel_row22, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet22->setCellValueByColumnAndRow(1, $excel_row22, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet22->setCellValueByColumnAndRow(2, $excel_row22, $values22)->getColumnDimension('C')->setAutoSize(true);
                $excel_row22++;
            }
            $objWorkSheet22->setTitle('Travel Time @R2');

            // Travel Time @R3
            $column23    = 0;
            $excel_row23 = 2;
            foreach($tcolumn23 as $field){
                $objWorkSheet23->setCellValueByColumnAndRow($column23, 1, $field);
                $column23++;
            }
            list($rowmaster23) = $this->mod_warning_dozer->fetch_data_mastervar('travel_time_r2');
            foreach ($trend_data as $row){
                if ($rowmaster23->operation == 'multiplication') {
                    $values23 = (floatval($row->travel_time_r2) * floatval($rowmaster23->value));
                } elseif ($rowmaster23->operation == 'division') {
                    $values23 = (floatval($row->travel_time_r2) / floatval($rowmaster23->value));
                } else {
                    $values23 = floatval($row->travel_time_r2);
                }
                $objWorkSheet23->setCellValueByColumnAndRow(0, $excel_row23, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet23->setCellValueByColumnAndRow(1, $excel_row23, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet23->setCellValueByColumnAndRow(2, $excel_row23, $values23)->getColumnDimension('C')->setAutoSize(true);
                $excel_row23++;
            }
            $objWorkSheet23->setTitle('Travel Time @R3');

            // Pitch Angle Max
            $column24    = 0;
            $excel_row24 = 2;
            foreach($tcolumn24 as $field){
                $objWorkSheet24->setCellValueByColumnAndRow($column24, 1, $field);
                $column24++;
            }
            list($rowmaster24) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_max');
            foreach ($trend_data as $row){
                if ($rowmaster24->operation == 'multiplication') {
                    $values24 = (floatval($row->pitch_angle_max) * floatval($rowmaster24->value));
                } elseif ($rowmaster24->operation == 'division') {
                    $values24 = (floatval($row->pitch_angle_max) / floatval($rowmaster24->value));
                } else {
                    $values24 = floatval($row->pitch_angle_max);
                }
                $objWorkSheet24->setCellValueByColumnAndRow(0, $excel_row24, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet24->setCellValueByColumnAndRow(1, $excel_row24, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet24->setCellValueByColumnAndRow(2, $excel_row24, $values24)->getColumnDimension('C')->setAutoSize(true);
                $excel_row24++;
            }
            $objWorkSheet24->setTitle('Pitch Angle Max');

            // Pitch Angle Average
            $column25    = 0;
            $excel_row25 = 2;
            foreach($tcolumn25 as $field){
                $objWorkSheet25->setCellValueByColumnAndRow($column25, 1, $field);
                $column25++;
            }
            list($rowmaster25) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_avg');
            foreach ($trend_data as $row){
                if ($rowmaster25->operation == 'multiplication') {
                    $values25 = (floatval($row->pitch_angle_avg) * floatval($rowmaster25->value));
                } elseif ($rowmaster25->operation == 'division') {
                    $values25 = (floatval($row->pitch_angle_avg) / floatval($rowmaster25->value));
                } else {
                    $values25 = floatval($row->pitch_angle_avg);
                }
                $objWorkSheet25->setCellValueByColumnAndRow(0, $excel_row25, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet25->setCellValueByColumnAndRow(1, $excel_row25, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet25->setCellValueByColumnAndRow(2, $excel_row25, $values25)->getColumnDimension('C')->setAutoSize(true);
                $excel_row25++;
            }
            $objWorkSheet25->setTitle('Pitch Angle Average');

            // Pitch Angle Min
            $column25    = 0;
            $excel_row25 = 2;
            foreach($tcolumn25 as $field){
                $objWorkSheet25->setCellValueByColumnAndRow($column25, 1, $field);
                $column25++;
            }
            list($rowmaster25) = $this->mod_warning_dozer->fetch_data_mastervar('pitch_angle_min');
            foreach ($trend_data as $row){
                if ($rowmaster25->operation == 'multiplication') {
                    $values25 = (floatval($row->pitch_angle_min) * floatval($rowmaster25->value));
                } elseif ($rowmaster25->operation == 'division') {
                    $values25 = (floatval($row->pitch_angle_min) / floatval($rowmaster25->value));
                } else {
                    $values25 = floatval($row->pitch_angle_min);
                }
                $objWorkSheet25->setCellValueByColumnAndRow(0, $excel_row25, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet25->setCellValueByColumnAndRow(1, $excel_row25, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet25->setCellValueByColumnAndRow(2, $excel_row25, $values25)->getColumnDimension('C')->setAutoSize(true);
                $excel_row25++;
            }
            $objWorkSheet25->setTitle('Pitch Angle Min');


            // EXPORT
            $filename = 'Dozer_Warning_Data_'.date("Ymd_His").'.xls';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header("Content-Description: File Transfer");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
            $objWriter->save('php://output');

        }

    }
?>