<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sysexport_warning_exca extends CI_Controller {

   function __construct(){
      parent::__construct();
      if ($this->session->userdata('nik') == null || $this->session->userdata('tipeapp') != 'MOSENTO') {
         redirect('login');
      }
      $this->load->model(['mdetail/exca/mod_detail_exca']);
      $this->load->library("excel");
   }

   private static function pregReps($string){ 
      $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
      return $result;
   }

   private static function pregRepn($number){ 
      $result = preg_replace('/[^0-9]/','', $number);
      return $result;
   }

   function export($sn, $date_start, $date_end){
      $sn         = $this->my_encryption->decode($this->pregReps($sn));
      $dateStart  = date('Y-m-d', strtotime($date_start));
      $dateEnd    = date('Y-m-d', strtotime($date_end));
      $trend_data = $this->mod_detail_exca->fetch_data_trend($sn, $dateStart, $dateEnd);

      $obj = new PHPExcel();

      $objWorkSheet0  = $obj->createSheet(0);
      $objWorkSheet1  = $obj->createSheet(1);
      $objWorkSheet2  = $obj->createSheet(2);
      $objWorkSheet3  = $obj->createSheet(3);
      $objWorkSheet4  = $obj->createSheet(4);
      $objWorkSheet5  = $obj->createSheet(5);
      $objWorkSheet6  = $obj->createSheet(6);

      $objWorkSheet0->getStyle('A1:C1')->getFont()->setBold(true);
      $objWorkSheet1->getStyle('A1:C1')->getFont()->setBold(true);
      $objWorkSheet2->getStyle('A1:C1')->getFont()->setBold(true);
      $objWorkSheet3->getStyle('A1:C1')->getFont()->setBold(true);
      $objWorkSheet4->getStyle('A1:C1')->getFont()->setBold(true);
      $objWorkSheet5->getStyle('A1:C1')->getFont()->setBold(true);
      $objWorkSheet6->getStyle('A1:C1')->getFont()->setBold(true);

      $tcolumn0 = array('Date', 'Time', 'Description');
      $tcolumn1 = array('Date', 'Time', 'Temperatures (DegC)');
      $tcolumn2 = array('Date', 'Time', 'Rate (liter / Hour)');
      $tcolumn3 = array('Date', 'Time', 'Temperatures (DegC)');
      $tcolumn4 = array('Date', 'Time', 'Temperatures (DegC)');
      $tcolumn5 = array('Date', 'Time', 'Pressure (mmAq)');
      $tcolumn6 = array('Date', 'Time', 'Pressure (mmHg)');

      // WARNING
      $column0    = 0;
      $excel_row0 = 2;
      foreach($tcolumn0 as $field){
         $objWorkSheet0->setCellValueByColumnAndRow($column0, 1, $field);
         $column0++;
      }
      $warning_data = $this->mod_detail_exca->fetch_data_warning($sn, $dateStart, $dateEnd);
      foreach($warning_data as $row){
         $objWorkSheet0->setCellValueByColumnAndRow(0, $excel_row0, date('d-m-Y', strtotime($row->tgl)))->getColumnDimension('A')->setAutoSize(true);
         $objWorkSheet0->setCellValueByColumnAndRow(1, $excel_row0, date('H:i:s', strtotime($row->tgl)))->getColumnDimension('B')->setAutoSize(true);
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
      list($rowmaster1) = $this->mod_detail_exca->fetch_data_mastervar('engoiltemp');
      foreach ($trend_data as $row){
         if ($rowmaster1->operation == 'multiplication') {
            $valuse1 = (floatval($row->engoiltemp) * floatval($rowmaster1->value));
         } elseif ($rowmaster1->operation == 'division') {
            $valuse1 = (floatval($row->engoiltemp) / floatval($rowmaster1->value));
         } else {
            $valuse1 = floatval($row->engoiltemp);
         }
         $objWorkSheet1->setCellValueByColumnAndRow(0, $excel_row1, date('d-m-Y', strtotime($row->date)))->getColumnDimension('A')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(1, $excel_row1, date('H:i:s', strtotime($row->date)))->getColumnDimension('B')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(2, $excel_row1, $valuse1)->getColumnDimension('C')->setAutoSize(true);
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
      list($rowmaster2) = $this->mod_detail_exca->fetch_data_mastervar('fuelrate');
      foreach ($trend_data as $row){
         if ($rowmaster2->operation == 'multiplication') {
            $valuse2 = (floatval($row->fuelrate) * floatval($rowmaster2->value));
         } elseif ($rowmaster2->operation == 'division') {
            $valuse2 = (floatval($row->fuelrate) / floatval($rowmaster2->value));
         } else {
            $valuse2 = floatval($row->fuelrate);
         }
         $objWorkSheet2->setCellValueByColumnAndRow(0, $excel_row2, date('d-m-Y', strtotime($row->date)))->getColumnDimension('A')->setAutoSize(true);
         $objWorkSheet2->setCellValueByColumnAndRow(1, $excel_row2, date('H:i:s', strtotime($row->date)))->getColumnDimension('B')->setAutoSize(true);
         $objWorkSheet2->setCellValueByColumnAndRow(2, $excel_row2, $valuse2)->getColumnDimension('C')->setAutoSize(true);
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
      list($rowmaster3) = $this->mod_detail_exca->fetch_data_mastervar('tmoiltemp');
      foreach ($trend_data as $row){
         if ($rowmaster3->operation == 'multiplication') {
            $valuse3 = (floatval($row->tmoiltemp) * floatval($rowmaster3->value));
         } elseif ($rowmaster3->operation == 'division') {
            $valuse3 = (floatval($row->tmoiltemp) / floatval($rowmaster3->value));
         } else {
            $valuse3 = floatval($row->tmoiltemp);
         }
         $objWorkSheet3->setCellValueByColumnAndRow(0, $excel_row3, date('d-m-Y', strtotime($row->date)))->getColumnDimension('A')->setAutoSize(true);
         $objWorkSheet3->setCellValueByColumnAndRow(1, $excel_row3, date('H:i:s', strtotime($row->date)))->getColumnDimension('B')->setAutoSize(true);
         $objWorkSheet3->setCellValueByColumnAndRow(2, $excel_row3, $valuse3)->getColumnDimension('C')->setAutoSize(true);
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
      list($rowmaster4) = $this->mod_detail_exca->fetch_data_mastervar('cooltemp');
      foreach ($trend_data as $row){
         if ($rowmaster4->operation == 'multiplication') {
            $valuse4 = (floatval($row->cooltemp) * floatval($rowmaster4->value));
         } elseif ($rowmaster4->operation == 'division') {
            $valuse4 = (floatval($row->cooltemp) / floatval($rowmaster4->value));
         } else {
            $valuse4 = floatval($row->cooltemp);
         }
         $objWorkSheet4->setCellValueByColumnAndRow(0, $excel_row4, date('d-m-Y', strtotime($row->date)))->getColumnDimension('A')->setAutoSize(true);
         $objWorkSheet4->setCellValueByColumnAndRow(1, $excel_row4, date('H:i:s', strtotime($row->date)))->getColumnDimension('B')->setAutoSize(true);
         $objWorkSheet4->setCellValueByColumnAndRow(2, $excel_row4, $valuse4)->getColumnDimension('C')->setAutoSize(true);
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
      list($rowmaster5) = $this->mod_detail_exca->fetch_data_mastervar('blowbypress');
      foreach ($trend_data as $row){
         if ($rowmaster5->operation == 'multiplication') {
            $valuse5 = (floatval($row->blowbypress) * floatval($rowmaster5->value));
         } elseif ($rowmaster5->operation == 'division') {
            $valuse5 = (floatval($row->blowbypress) / floatval($rowmaster5->value));
         } else {
            $valuse5 = floatval($row->blowbypress);
         }
         $objWorkSheet5->setCellValueByColumnAndRow(0, $excel_row5, date('d-m-Y', strtotime($row->date)))->getColumnDimension('A')->setAutoSize(true);
         $objWorkSheet5->setCellValueByColumnAndRow(1, $excel_row5, date('H:i:s', strtotime($row->date)))->getColumnDimension('B')->setAutoSize(true);
         $objWorkSheet5->setCellValueByColumnAndRow(2, $excel_row5, $valuse5)->getColumnDimension('C')->setAutoSize(true);
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
      list($rowmaster6) = $this->mod_detail_exca->fetch_data_mastervar('blowbypress');
      foreach ($trend_data as $row){
         if ($rowmaster6->operation == 'multiplication') {
            $valuse6 = (floatval($row->blowbypress) * floatval($rowmaster6->value));
         } elseif ($rowmaster6->operation == 'division') {
            $valuse6 = (floatval($row->blowbypress) / floatval($rowmaster6->value));
         } else {
            $valuse6 = floatval($row->blowbypress);
         }
         $objWorkSheet6->setCellValueByColumnAndRow(0, $excel_row6, date('d-m-Y', strtotime($row->date)))->getColumnDimension('A')->setAutoSize(true);
         $objWorkSheet6->setCellValueByColumnAndRow(1, $excel_row6, date('H:i:s', strtotime($row->date)))->getColumnDimension('B')->setAutoSize(true);
         $objWorkSheet6->setCellValueByColumnAndRow(2, $excel_row6, $valuse6)->getColumnDimension('C')->setAutoSize(true);
         $excel_row6++;
      }
      $objWorkSheet6->setTitle('Boost Pressure');

      // EXPORT
      $filename = 'Exca_Warning_Data_'.date("Ymd_His").'.xls';
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'"');
      header("Content-Description: File Transfer");
      header('Cache-Control: max-age=0');

      $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
      $objWriter->save('php://output');

   }
}