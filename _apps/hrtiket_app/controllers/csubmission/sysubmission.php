<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysubmission extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'HR_TIKET') {
                redirect('syslogin');
            }
            $this->load->model([ 'msubmission/mod_submission', ]);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,\/]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
            return $hasil_rupiah;
        }

        public function index(){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/psubmission/vsubmission',
        	);
        	$this->load->view('pages/pindex/tindex', $data);
        }

        public function table_ticket_submission(){
            $ticket_submission = $this->mod_submission->get_ticket_submission();
            $data          = array();
            $no            = $this->pregRepn($this->input->post('start'));

            foreach ($ticket_submission as $field) {
                $no++;
                $row = array();

                if ($field->status == 1) {
                    $status = "Pengajuan";
                } elseif( $field->status == 2 ) {
                    $status = "Proses Vendor";
                } else {
                    $status = "Disetujui";
                }

                $depart_time  = date("h:i A", strtotime($field->depart_time));
                $arrival_time = date("h:i A", strtotime($field->arrival_time));
                $flight_date  = date("d-m-Y", strtotime($field->flight_date)); 

                $row[]  = $no;
                $row[]  = $field->nodoc;
                $row[]  = $field->nik;
                $row[]  = $field->Nama;
                $row[]  = $flight_date;
                $row[]  = $field->flight_from;
                $row[]  = $field->flight_to;
                $row[]  = $depart_time;
                $row[]  = $arrival_time;
                $row[]  = $field->airline_name;
                $row[]  = $this->rupiah($field->price);
                $row[]  = $status;
                $row[]  = $field->tipe;
                $row[]  = '
                    <button class="btn btn-sm btn-warning btn-flat text-center" data-toggle="modal" data-target="#request-vendor-modal" data-nodoc="'.$field->nodoc.'" data-nik="'.$field->nik.'" data-karyawan="'.$field->Nama.'" data-depart_time="'.$depart_time.'" data-arrival_time="'.$arrival_time.'" data-depart_city="'.$field->flight_from.'" data-arrival_city="'.$field->flight_to.'" data-airline="'.$field->airline_name.'" data-depart_date="'.$flight_date.'"><b><em>KE VENDOR</em></b></button>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_submission->count_all_ticket_submission(),
                "recordsFiltered" => $this->mod_submission->count_filtered_ticket_submission(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_order_ticket_vendor(){
            $nodoc = $this->pregReps($this->input->post('nodoc'));
            $data = array(
                'sts'        => 2,
                'req_update' => date("Y-m-d H:i:s")
            );
            $result = $this->mod_submission->save_order_ticket_vendor($nodoc, $data);
            if ($result == true) {
                echo "1";
            } else {
                echo "Error";
            }
        }

        public function submission_vendor(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/psubvendor/vsubvendor',
            );
            $this->load->view('pages/pindex/tindex', $data);
        }

        public function table_ticket_submission_vendor(){
            $ticket_submission_vendor = $this->mod_submission->get_ticket_submission_vendor();
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($ticket_submission_vendor as $field) {
                $no++;
                $row = array();

                if ($field->sts == 1) {
                    $status = "Pengajuan";
                } elseif( $field->sts == 2 ) {
                    $status = "Proses Vendor";
                } else {
                    $status = "Disetujui";
                }

                if ($field->jenis == 1) {
                    $jenis_tiket = "Tiket Pergi";
                } else {
                    $jenis_tiket = "Tiket Pulang";
                }

                $depart_time  = date("h:i A", strtotime($field->depart_time));
                $arrival_time = date("h:i A", strtotime($field->arrival_time));
                $flight_date  = date("d-m-Y", strtotime($field->flight_date)); 

                $row['no']           = $no;
                $row['nodoc']        = $field->nodoc;
                $row['nik']          = $field->nik;
                $row['name']         = $field->Nama;
                $row['flight_date']  = $flight_date;
                $row['flight_from']  = $field->flight_from;
                $row['flight_to']    = $field->flight_to;
                $row['depart_time']  = $depart_time;
                $row['arrival_time'] = $arrival_time;
                $row['airline_name'] = $field->airline_name;
                $row['price']        = $this->rupiah($field->price);
                $row['status']       = '<b>'.$status.'</b>';
                $row['type']         = $field->tipe;
                $row['jenis_tiket']  = $jenis_tiket;
                $row['nodoc_ref']    = $field->nodoc_ref;
                $data[]              = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_submission->count_all_ticket_submission_vendor(),
                "recordsFiltered" => $this->mod_submission->count_filtered_ticket_submission_vendor(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>