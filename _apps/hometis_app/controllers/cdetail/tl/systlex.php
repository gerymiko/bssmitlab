<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Systlex extends CI_Controller {

   function __construct(){
      parent::__construct();
      $this->load->model(['mdetail/tl/mod_detail_tl', 'mglobal/mod_global']);
      if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null) {
          redirect('logisisse');
      } else {
         $changePass = $this->mod_global->get_change_password($this->session->userdata('id_user'));
         if ($changePass == 'false') {
            redirect('menu/site');
         } else {
            $getAccess = $this->mod_global->get_status_access($this->session->userdata('id_user'), $this->uri->segment(3));
            $accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), '2');
            $resultSite = $this->in_multiarray($this->uri->segment(3), $getAccess, "site");
            $resultModule = $this->in_multiarray("2", $getAccess, "id_module");
            if ($resultSite == false) {
               $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have the authority to access the page.');
                   $this->session->set_flashdata('pesan', $pesan);
               redirect('menu/site');
            } elseif ($resultModule == false) {
               $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have the authority to access the page.');
               $this->session->set_flashdata('pesan', $pesan);
               redirect('menu/dashboard/'.$this->uri->segment(3));
            } elseif ($this->accessRights!=null && $this->accessRights->export !== 1 || $this->accessRights->status_active !== 1) {
               $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access to export data.');
               $this->session->set_flashdata('pesan', $pesan);
               redirect('menu/dashboard/'.$this->uri->segment(3));
            }
         }
      }
      $this->load->library("excel");
   }

   private static function pregReps($string) { 
      return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
   }

   private static function pregRepn($number) { 
      return $result = preg_replace('/[^0-9]/','', $number);
   }

   function export($site){
      $sn         = $this->my_encryption->decode($this->uri->segment(4));
      $dateStart  = date('Y-m-d', strtotime($this->uri->segment(5)));
      $dateEnd    = date('Y-m-d', strtotime($this->uri->segment(6)));
      $trend_data = $this->mod_detail_tl->fetch_data_trend($site, $sn, $dateStart, $dateEnd);
      $obj = new PHPExcel();
      $objWorkSheet1  = $obj->createSheet(1);
      $objWorkSheet1->getStyle('A1:J1')->getFont()->setBold(true);
      $tcolumn1 = array('No', 'Unit Number', 'Type', 'Status', 'Time Start', 'Time End', 'HM Start', 'HM End', 'HM Total', 'Site');
      $column1    = 0;
      $excel_row1 = 2;
      foreach($tcolumn1 as $field){
         $objWorkSheet1->setCellValueByColumnAndRow($column1, 1, $field);
         $column1++;
      }
      $no = 0;
      foreach ($trend_data as $row){
         $no++;
         $hmtotal = floatval($row->hm_end_decimal) - floatval($row->hm_start_decimal);
         $objWorkSheet1->setCellValueByColumnAndRow(0, $excel_row1, $no)->getColumnDimension('A')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(1, $excel_row1, $row->no_unit)->getColumnDimension('B')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(2, $excel_row1, $row->name)->getColumnDimension('C')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(3, $excel_row1, $row->status_engine)->getColumnDimension('D')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(4, $excel_row1, $row->time_start)->getColumnDimension('E')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(5, $excel_row1, $row->time_end)->getColumnDimension('F')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(6, $excel_row1, $row->hm_start_decimal)->getColumnDimension('G')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(7, $excel_row1, $row->hm_end_decimal)->getColumnDimension('H')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(8, $excel_row1, $hmtotal)->getColumnDimension('H')->setAutoSize(true);
         $objWorkSheet1->setCellValueByColumnAndRow(9, $excel_row1, $row->site)->getColumnDimension('I')->setAutoSize(true);
         $excel_row1++;
      }
      $objWorkSheet1->setTitle('Detail Genset TL');
      // EXPORT
      $filename = 'Detail_Genset_TL_'.date("Ymd_His").'.xls';
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'.$filename.'"');
      header("Content-Description: File Transfer");
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
      $objWriter->save('php://output');
   }
}