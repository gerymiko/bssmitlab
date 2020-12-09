<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysexport_hd extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregReps('detail_payload'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active !== 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/site');
                } elseif ($this->accessRights!=null && $this->accessRights->export != 1 || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('menu/dashboard/'.$this->accessRights->site);
                }
            }
            $this->load->model(['mpayload/hd/mod_payload_hd']);
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

        function export_payload($site){
            $sn         = $this->my_encryption->decode($this->pregReps($this->uri->segment(4)));
            $dateStart  = $this->viewDate($this->pregReps($this->uri->segment(5)));
            $dateEnd    = $this->viewDate($this->pregReps($this->uri->segment(6)));
            $trend_data = $this->mod_payload_hd->fetch_data_trend($sn, $dateStart, $dateEnd, $site);

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

            $tcolumn0 = array('Date', 'Time', 'Description');
            $tcolumn1 = array('Date', 'Time', 'Temperatures (DegC)');
            $tcolumn2 = array('Date', 'Time', 'Rate (liter / Hour)');
            $tcolumn3 = array('Date', 'Time', 'Temperatures (DegC)');
            $tcolumn4 = array('Date', 'Time', 'Temperatures (DegC)');
            $tcolumn5 = array('Date', 'Time', 'Pressure (mmAq)');
            $tcolumn6 = array('Date', 'Time', 'Pressure (mmHg)');
            $tcolumn7 = array('Date', 'Time', 'Measure (Km / Hour)');
            $tcolumn8 = array('Date', 'Time', 'Measure (Rpm)');
            $tcolumn9 = array('Date', 'Time', 'Pressure (mPa)');
            $tcolumn10 = array('Date', 'Time', 'Pressure (mPa)');
            $tcolumn11 = array('Date', 'Time', 'Pressure (mPa)');
            $tcolumn12 = array('Date', 'Time', 'Pressure (mPa)');

            // WARNING
            $column0    = 0;
            $excel_row0 = 2;
            foreach($tcolumn0 as $field){
                $objWorkSheet0->setCellValueByColumnAndRow($column0, 1, $field);
                $column0++;
            }
            $warning_data = $this->mod_payload_hd->fetch_data_warning($sn, $dateStart, $dateEnd, $site);
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
            list($rowmaster1) = $this->mod_payload_hd->fetch_data_mastervar('engoiltemp');
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
            list($rowmaster2) = $this->mod_payload_hd->fetch_data_mastervar('fuelrate');
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
            list($rowmaster3) = $this->mod_payload_hd->fetch_data_mastervar('tmoiltemp');
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
            list($rowmaster4) = $this->mod_payload_hd->fetch_data_mastervar('cooltemp');
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
            list($rowmaster5) = $this->mod_payload_hd->fetch_data_mastervar('blowbypress');
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
            list($rowmaster6) = $this->mod_payload_hd->fetch_data_mastervar('blowbypress');
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

            // Travel Speed
            $column7    = 0;
            $excel_row7 = 2;
            foreach($tcolumn7 as $field){
                $objWorkSheet7->setCellValueByColumnAndRow($column7, 1, $field);
                $column7++;
            }
            list($rowmaster7) = $this->mod_payload_hd->fetch_data_mastervar('travelspeed');
            foreach ($trend_data as $row){
                if ($rowmaster7->operation == 'multiplication') {
                    $values7 = (floatval($row->travelspeed) * floatval($rowmaster7->value));
                } elseif ($rowmaster7->operation == 'division') {
                    $values7 = (floatval($row->travelspeed) / floatval($rowmaster7->value));
                } else {
                    $values7 = floatval($row->travelspeed);
                }
                $objWorkSheet7->setCellValueByColumnAndRow(0, $excel_row7, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet7->setCellValueByColumnAndRow(1, $excel_row7, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet7->setCellValueByColumnAndRow(2, $excel_row7, $values7)->getColumnDimension('C')->setAutoSize(true);
                $excel_row7++;
            }
            $objWorkSheet7->setTitle('Travel Speed');

            // Engine Speed
            $column8    = 0;
            $excel_row8 = 2;
            foreach($tcolumn8 as $field){
                $objWorkSheet8->setCellValueByColumnAndRow($column8, 1, $field);
                $column8++;
            }
            list($rowmaster8) = $this->mod_payload_hd->fetch_data_mastervar('enginespeed');
            foreach ($trend_data as $row){
                if ($rowmaster8->operation == 'multiplication') {
                    $values8 = (floatval($row->enginespeed) * floatval($rowmaster8->value));
                } elseif ($rowmaster8->operation == 'division') {
                    $values8 = (floatval($row->enginespeed) / floatval($rowmaster8->value));
                } else {
                    $values8 = floatval($row->enginespeed);
                }
                $objWorkSheet8->setCellValueByColumnAndRow(0, $excel_row8, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet8->setCellValueByColumnAndRow(1, $excel_row8, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet8->setCellValueByColumnAndRow(2, $excel_row8, $values8)->getColumnDimension('C')->setAutoSize(true);
                $excel_row8++;
            }
            $objWorkSheet8->setTitle('Engine Speed');

            // Front Brake
            $column9    = 0;
            $excel_row9 = 2;
            foreach($tcolumn9 as $field){
                $objWorkSheet9->setCellValueByColumnAndRow($column9, 1, $field);
                $column9++;
            }
            list($rowmaster9) = $this->mod_payload_hd->fetch_data_mastervar('frontbrake');
            foreach ($trend_data as $row){
                if ($rowmaster9->operation == 'multiplication') {
                    $values9 = (floatval($row->frontbrake) * floatval($rowmaster9->value));
                } elseif ($rowmaster9->operation == 'division') {
                    $values9 = (floatval($row->frontbrake) / floatval($rowmaster9->value));
                } else {
                    $values9 = floatval($row->frontbrake);
                }
                $objWorkSheet9->setCellValueByColumnAndRow(0, $excel_row9, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet9->setCellValueByColumnAndRow(1, $excel_row9, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet9->setCellValueByColumnAndRow(2, $excel_row9, $values9)->getColumnDimension('C')->setAutoSize(true);
                $excel_row9++;
            }
            $objWorkSheet9->setTitle('Front Brake');

            // Rear Brake
            $column10    = 0;
            $excel_row10 = 2;
            foreach($tcolumn10 as $field){
                $objWorkSheet10->setCellValueByColumnAndRow($column10, 1, $field);
                $column10++;
            }
            list($rowmaster10) = $this->mod_payload_hd->fetch_data_mastervar('rearbrake');
            foreach ($trend_data as $row){
                if ($rowmaster10->operation == 'multiplication') {
                    $values10 = (floatval($row->rearbrake) * floatval($rowmaster10->value));
                } elseif ($rowmaster10->operation == 'division') {
                    $values10 = (floatval($row->rearbrake) / floatval($rowmaster10->value));
                } else {
                    $values10 = floatval($row->rearbrake);
                }
                $objWorkSheet10->setCellValueByColumnAndRow(0, $excel_row10, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet10->setCellValueByColumnAndRow(1, $excel_row10, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet10->setCellValueByColumnAndRow(2, $excel_row10, $values10)->getColumnDimension('C')->setAutoSize(true);
                $excel_row10++;
            }
            $objWorkSheet10->setTitle('Rear Brake');

            // Engine Oil Press Lo Min
            $column11    = 0;
            $excel_row11 = 2;
            foreach($tcolumn11 as $field){
                $objWorkSheet11->setCellValueByColumnAndRow($column11, 1, $field);
                $column11++;
            }
            list($rowmaster11) = $this->mod_payload_hd->fetch_data_mastervar('oilpressmin');
            foreach ($trend_data as $row){
                if ($rowmaster11->operation == 'multiplication') {
                    $values11 = (floatval($row->oilplomin) * floatval($rowmaster11->value));
                } elseif ($rowmaster11->operation == 'division') {
                    $values11 = (floatval($row->oilplomin) / floatval($rowmaster11->value));
                } else {
                    $values11 = floatval($row->oilplomin);
                }
                $objWorkSheet11->setCellValueByColumnAndRow(0, $excel_row11, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet11->setCellValueByColumnAndRow(1, $excel_row11, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet11->setCellValueByColumnAndRow(2, $excel_row11, $values11)->getColumnDimension('C')->setAutoSize(true);
                $excel_row11++;
            }
            $objWorkSheet11->setTitle('Engine Oil Press Lo Min');

            // Oil Pressure Maximal
            $column12    = 0;
            $excel_row12 = 2;
            foreach($tcolumn12 as $field){
                $objWorkSheet12->setCellValueByColumnAndRow($column12, 1, $field);
                $column12++;
            }
            list($rowmaster12) = $this->mod_payload_hd->fetch_data_mastervar('oilpressmax');
            foreach ($trend_data as $row){
                if ($rowmaster12->operation == 'multiplication') {
                    $values12 = (floatval($row->oilpmax) * floatval($rowmaster12->value));
                } elseif ($rowmaster12->operation == 'division') {
                    $values12 = (floatval($row->oilpmax) / floatval($rowmaster12->value));
                } else {
                    $values12 = floatval($row->oilpmax);
                }
                $objWorkSheet12->setCellValueByColumnAndRow(0, $excel_row12, $this->viewDate($row->date))->getColumnDimension('A')->setAutoSize(true);
                $objWorkSheet12->setCellValueByColumnAndRow(1, $excel_row12, $this->viewTime($row->date))->getColumnDimension('B')->setAutoSize(true);
                $objWorkSheet12->setCellValueByColumnAndRow(2, $excel_row12, $values12)->getColumnDimension('C')->setAutoSize(true);
                $excel_row12++;
            }
            $objWorkSheet12->setTitle('Oil Pressure Maximal');

            // EXPORT
            $filename = 'HD_Warning_Data_'.date("Ymd_His").'.xls';
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$filename.'"');
            header("Content-Description: File Transfer");
            header('Cache-Control: max-age=0');

            $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
            $objWriter->save('php://output');
        }
    }
?>