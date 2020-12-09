<?php defined('BASEPATH') OR exit('No direct script access allowed');

   class Syspanex extends CI_Controller {

      function __construct(){
         parent::__construct();
         $this->load->model(['mpanel/mod_panel', 'mglobal/mod_global']);
         if ($this->session->userdata('id_user') == null && $this->session->userdata('NIK') == null) {
             redirect('logisisse');
         } else {
            $changePass = $this->mod_global->get_change_password($this->session->userdata('id_user'));
            if ($changePass == 'false') {
               redirect('choose/site');
            } else {
               $accessRights = $this->mod_global->get_access_rights($this->session->userdata('id_user'), $this->uri->segment(3), $this->pregRepn(1));
               if ($accessRights==null){
                        show_404();exit();
               } elseif ($accessRights==null && $accessRights->site !== $this->uri->segment(3) && $accessRights->status_active !== 1) {
                  $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                      $this->session->set_flashdata('pesan', $pesan);
                      redirect('choose/site');
               } elseif ($accessRights==null && $accessRights->read == 0){
                  $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                      $this->session->set_flashdata('pesan', $pesan);
                      redirect('choose/site');
               } elseif ($accessRights==null && $accessRights->export == 0){
                  $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have access to export data.');
                  $this->session->set_flashdata('pesan', $pesan);
                  redirect('menu/dashboard/'.$this->uri->segment(3));
               }
            }
         }
         $this->load->library("excel");
      }

      private static function pregRepn($number) { 
         return $result = preg_replace('/[^0-9]/','', $number);
      }

      function export_tl($site){
         $trend_data = $this->mod_panel->fetch_data_tl($site);
         $obj = new PHPExcel();
         $objWorkSheet1  = $obj->createSheet(1);
         $objWorkSheet1->getStyle('A1:F1')->getFont()->setBold(true);
         $tcolumn1 = array('No', 'Unit Number', 'Hull Number', 'Status Engine', 'Last HM', 'Site');
         $column1    = 0;
         $excel_row1 = 2;
         foreach($tcolumn1 as $field){
            $objWorkSheet1->setCellValueByColumnAndRow($column1, 1, $field);
            $column1++;
         }
         $no = 0;
         foreach ($trend_data as $row){
            $no++;
            $objWorkSheet1->setCellValueByColumnAndRow(0, $excel_row1, $no)->getColumnDimension('A')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(1, $excel_row1, $row->no_unit)->getColumnDimension('B')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(2, $excel_row1, $row->no_lambung)->getColumnDimension('C')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(3, $excel_row1, $row->status_engine)->getColumnDimension('D')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(4, $excel_row1, $row->hm_end_decimal)->getColumnDimension('H')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(5, $excel_row1, $site)->getColumnDimension('I')->setAutoSize(true);
            $excel_row1++;
         }
         $objWorkSheet1->setTitle('Genset TL');
         // EXPORT
         $filename = 'Genset_TL_'.date("Ymd_His").'.xls';
         header('Content-Type: application/vnd.ms-excel');
         header('Content-Disposition: attachment;filename="'.$filename.'"');
         header("Content-Description: File Transfer");
         header('Cache-Control: max-age=0');
         $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
         $objWriter->save('php://output');
      }

      function export_of($site){
         $trend_data = $this->mod_panel->fetch_data_of($site);
         $obj = new PHPExcel();
         $objWorkSheet1  = $obj->createSheet(1);
         $objWorkSheet1->getStyle('A1:F1')->getFont()->setBold(true);
         $tcolumn1 = array('No', 'Unit Number', 'Hull Number', 'Status Engine', 'Last HM', 'Site');
         $column1    = 0;
         $excel_row1 = 2;
         foreach($tcolumn1 as $field){
            $objWorkSheet1->setCellValueByColumnAndRow($column1, 1, $field);
            $column1++;
         }
         $no = 0;
         foreach ($trend_data as $row){
            $no++;
            $objWorkSheet1->setCellValueByColumnAndRow(0, $excel_row1, $no)->getColumnDimension('A')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(1, $excel_row1, $row->no_unit)->getColumnDimension('B')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(2, $excel_row1, $row->no_lambung)->getColumnDimension('C')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(3, $excel_row1, $row->status_engine)->getColumnDimension('D')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(4, $excel_row1, $row->hm_end_decimal)->getColumnDimension('H')->setAutoSize(true);
            $objWorkSheet1->setCellValueByColumnAndRow(5, $excel_row1, $site)->getColumnDimension('I')->setAutoSize(true);
            $excel_row1++;
         }
         $objWorkSheet1->setTitle('Genset OFFICE');
         // EXPORT
         $filename = 'Genset_OFFICE_'.date("Ymd_His").'.xls';
         header('Content-Type: application/vnd.ms-excel');
         header('Content-Disposition: attachment;filename="'.$filename.'"');
         header("Content-Description: File Transfer");
         header('Cache-Control: max-age=0');
         $objWriter = PHPExcel_IOFactory::createWriter($obj, 'Excel5');
         $objWriter->save('php://output');
      }
   }

?>