<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysubvendor extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_TIKET_VENDOR') {
                redirect('syslogin');
            }
            $this->load->model([ 'mglobal/mod_hr_global', 'msubvendor/mod_subvendor', ]);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
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
                'airline' => $this->mod_hr_global->getAirline(),
            );
            $this->load->view('pages/pindex/vindex', $data);
        }

        public function table_ticket_filing_bss(){
            $ticket_filing_bss = $this->mod_subvendor->get_ticket_filing_bss();
            $data          = array();
            if(isset($_POST['start']) && isset($_POST['draw'])) {   
                $no = $this->pregRepn($this->input->post('start'));
            } else { 
                die(); 
            }
            

            foreach ($ticket_filing_bss as $field) {
                $no++;
                $row = array();

                if ($field->sts == 1) {
                    $status = "Pengajuan";
                } elseif ( $field->sts == 2 ) {
                    $status = "Pesan Tiket";
                } elseif ( $field->sts == 3 ) {
                    $status = "Opsi";
                } else {
                    $status = "Disetujui";
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
                $row['status']       = $status;
                $row['action']       = '
                    <button class="btn btn-sm btn-danger btn-flat text-center ls2" data-toggle="modal" data-target="#opsi-modal" data-nodoc="'.$field->nodoc.'" data-nik="'.$field->nik.'" data-karyawan="'.$field->Nama.'" data-depart_city="'.$field->flight_from.'" data-arrival_city="'.$field->flight_to.'" data-depart_date="'.$flight_date.'" data-depart_time="'.$depart_time.'" data-arrival_time="'.$arrival_time.'" data-airline_name="'.$field->airline_name.'"><b><em>OPSIONAL</em></b></button>
                ';
                $row['type']         = $field->tipe;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_subvendor->count_all_ticket_filing_bss(),
                "recordsFiltered" => $this->mod_subvendor->count_filtered_ticket_filing_bss(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>