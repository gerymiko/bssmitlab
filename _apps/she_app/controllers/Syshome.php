<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syshome extends CI_Controller {

        function __construct(){
            parent::__construct();
            $this->load->model(['mhome/mod_home']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9-_.]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private function validateDate($date, $format = 'Y-m-d'){
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) === $date;
        }

        // function base64ToImage() {
        //     $get = $this->dm->get_by_where('SHE.dbo.SAP_inspeksi_dtl_1', "no_dok = 'SAP/MSJ/1007533/20200810/101421'");
        //     foreach ($get as $row) {
        //         if ($row->file_before != null) {
        //             $file = fopen("../../../img_she/"."before_".str_replace("/", "", $row->no_dok).str_replace("/", "", $row->kode_itm).".jpg", "wb");

        //             fwrite($file, base64_decode($row->file_before));
        //             fclose($file);
        //         }
        //         if ($row->file_after != null) {
        //             $file = fopen("../../../img_she/"."after_".str_replace("/", "", $row->no_dok).str_replace("/", "", $row->kode_itm).".jpg", "wb");

        //             fwrite($file, base64_decode($row->file_after));
        //             fclose($file);
        //         }
        //     }
        // }

        public function reports_she($site){
            $data = array(
                'header' => 'pages/ext/header',
                'footer' => 'pages/ext/footer',
                'content' => 'pages/phome/vhome',
                'list_karyawan' => $this->mod_global->list_karyawan($site),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/select.dataTables.min.css"/>',
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dt_plugin/select/dataTables.select.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/dragscroll/dragscroll.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/she/vendor/bs-datatables/js/paginationSelect/select.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/moment/moment.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/bs-daterangepicker/daterangepicker.min.js"></script>',
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function search_result($site){
            $data = array(
                'startdate' => $this->uri->segment(4), 
                'enddate'   => $this->uri->segment(5),
                'inspektor' => $this->uri->segment(6)
            );
            $this->load->view('pages/presult/vresult', $data);
        }

        public function table_result($site){
            $startdate = date("Y-m-d", strtotime($this->uri->segment(4)));
            $enddate   = date("Y-m-d", strtotime($this->uri->segment(5)));
            $inspektor = $this->pregRepn($this->uri->segment(6));
            if ($this->validateDate($startdate) == false && $this->validateDate($enddate) == false) {
                echo "error date";exit();
            }
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_home->get_data_result($length, $start, $site, $startdate, $enddate, $inspektor);
            foreach ($getdata as $field){
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['nodoc'] = $field->no_dok;
                $row['tanggal'] = $field->tanggal;
                $row['judul_inspeksi'] = $field->judul_inspeksi;
                $row['departemen'] = $field->departemen;
                $row['nama'] = $field->nama;
                $row['lokasi'] = $field->lokasi;
                $row['inspektor'] = $field->inspektor;
                $row['jam'] = $field->jam;
                $row['shift'] = $field->shift;
                $row['nik_validasi'] = $field->nik_validasi;
                $row['nama_validasi'] = $field->nama_validasi;
                $row['tanggal_validasi'] = $field->tanggal_validasi;
                $row['action'] = '<button class="btn btn-sm btn-danger" onclick="detail(\''.$field->no_dok.'\')">Detail</button>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_home->count_all_result($site, $startdate, $enddate, $inspektor),
                "recordsFiltered" => $this->mod_home->count_filtered_result($site, $startdate, $enddate, $inspektor),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function detail_result($nodoc){
            $data = array( 'nodocx' => $this->uri->segment(4) );
            $this->load->view('pages/presult/vdetail', $data);
        }

        public function table_detail_result($site){
            $nodocx = $this->uri->segment(4);
            $nodoc = str_replace('-', '/', $nodocx);
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_home->get_data_detail_result($length, $start, $site, $nodoc);
            foreach ($getdata as $field){
                if ($field->file_before != null) {
                    $file_before = fopen("../../../img_she/"."before_".str_replace("/", "", $field->no_dok).str_replace("/", "", $field->kode_itm).".jpg", "wb");

                    fwrite($file_before, base64_decode($field->file_before));
                    fclose($file_before);
                }
                if ($field->file_after != null) {
                    $file_after = fopen("../../../img_she/"."after_".str_replace("/", "", $field->no_dok).str_replace("/", "", $field->kode_itm).".jpg", "wb");

                    fwrite($file_after, base64_decode($field->file_after));
                    fclose($file_after);
                }
                $start++;
                $row       = array();
                $row['no'] = $start;
                $row['nodoc'] = $field->no_dok;
                $row['tanggal'] = $field->tanggal;
                $row['judul_inspeksi'] = $field->judul_inspeksi;
                $row['departemen'] = $field->departemen;
                $row['nama'] = $field->nama;
                $row['lokasi'] = $field->lokasi;
                $row['inspektor'] = $field->inspektor;
                $row['jam'] = $field->jam;
                $row['shift'] = $field->shift;
                $row['item'] = $field->item;
                $row['kode_bahaya'] = $field->kode_bahaya;
                $row['ya_tidak'] = $field->ya_tidak;
                $row['temuan'] = $field->temuan;
                $row['perbaikan'] = $field->perbaikan;
                $row['keterangan'] = $field->keterangan;
                $row['nik_close'] = $field->nik_close;
                $row['tgl_close'] = $field->tgl_close;
                $row['kode_itm'] = $field->kode_itm;
                $row['item_tambahan'] = $field->item_tambahan;
                $row['file_before'] = $file_before;
                $row['file_after'] = $file_after;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_home->count_all_detail_result($site, $nodoc),
                "recordsFiltered" => $this->mod_home->count_filtered_detail_result($site, $nodoc),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>