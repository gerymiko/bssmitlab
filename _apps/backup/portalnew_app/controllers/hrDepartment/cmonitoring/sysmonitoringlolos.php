<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmonitoringlolos extends CI_Controller {

        private $filename = "import_data";

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmonitoring/mod_hr_pelamar_monitor_lolospeserta', 'mod_master']);
            $this->date_only_def  = date("Y-m-d");
        }

        function pelamar_monitor_lolospeserta(){
            $data = array(
                'listjabatan' => $this->mod_master->list_jabatan(),
                'lowongan'    => $this->mod_master->getlowongan_aktif()
            );
            $this->load->view('pages/hr/vmonitoring/pelamar_monitor_lolospeserta', $data);
        }

        public function table_monitor_lolospeserta(){
            $monitor_lolospeserta = $this->mod_hr_pelamar_monitor_lolospeserta->get_datatables();
            $data         = array();
            $no           = $this->input->post('start');
            
            foreach ($monitor_lolospeserta as $field) {
                if ($field->status == 1) {
                    $btn_dis = "";
                } else {
                    $btn_dis = "hidden";
                }

                $no++;

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->jabatan;
                $row[]  = $field->nama;
                $row[]  = $field->keterangan;
                $row[]  = date("d/m/Y H:i:s", strtotime($field->date_reg));
                $row[]  = $status = ($field->status == 1) ? "Aktif" : "Non-Aktif";
                $row[]  = ' <a class="btn btn-xs btn-primary"><i class="fa fa-pencil-alt"></i></a>
                            <a class="btn btn-xs btn-red '.$btn_dis.'"><i class="fa fa-times"></i></a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_pelamar_monitor_lolospeserta->count_all(),
                "recordsFiltered" => $this->mod_hr_pelamar_monitor_lolospeserta->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_insert_lolos_csv(){
            if(!empty($_FILES['csv_file']['name'])){
                $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
                fgetcsv($file_data);
                while($row = fgetcsv($file_data)){
                    $data[] = array(
                        'nama'       => $row[0],
                        'keterangan' => $row[1],
                        'KodeJB'     => $row[2],
                        'status'     => 1
                    );
                }
                echo json_encode($data);
            }
        }

        public function save_insert_lolos_manual(){
            $data = array(
                'KodeJB'     => $this->input->post('KodeJB'), 
                'nama'       => $this->input->post('nama'), 
                'keterangan' => $this->input->post('keterangan'),
                'date_reg'   => date("Y-m-d H:i:s"), 
                'status'     => 1
            );
            $insert_manual = $this->mod_hr_pelamar_monitor_lolospeserta->save_insert_lolos_manual($data);
            if($insert_manual == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        // public function form(){
        //     $data = array();

        //     if(isset($_POST['preview'])){
        //         $upload = $this->mod_hr_pelamar_monitor_lolospeserta->upload_file($this->filename);

        //         if($upload['result'] == "success"){
        //             include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        //             $csvreader = PHPExcel_IOFactory::createReader('CSV');
        //             $loadcsv   = $csvreader->load('csv/'.$this->filename.'.csv');
        //             $sheet     = $loadcsv->getActiveSheet()->getRowIterator();

        //             $data['sheet'] = $sheet; 
        //         } else {
        //             $data['upload_error'] = $upload['error'];
        //         }
        //     }

        //     $this->load->view('form', $data);
        // }

        public function import(){
            include APPPATH.'third_party/PHPExcel/PHPExcel.php';

            $csvreader = PHPExcel_IOFactory::createReader('CSV');
            $loadcsv   = $csvreader->load('csv/'.$this->filename.'.csv');
            $sheet     = $loadcsv->getActiveSheet()->getRowIterator();

            $data = array();
            $numrow = 1;
            foreach($sheet as $row){
                if($numrow > 1){
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(false);

                    $get = array();
                    foreach ($cellIterator as $cell) {
                        array_push($get, $cell->getValue());
                    }

                    $nama       = $get[0];
                    $keterangan = $get[1];
                    $KodeJB     = $get[2];

                    array_push($data, array(
                        'nama'       =>$nama,
                        'keterangan' =>$keterangan,
                        'KodeJB'     =>$KodeJB,
                        'status'     =>1,
                        'date_reg'   => date("Y-m-d H:i:s")
                    ));
                }

                $numrow++;
            }
            $result = $this->mod_hr_pelamar_monitor_lolospeserta->insert_multiple($data);
            if ($result) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>