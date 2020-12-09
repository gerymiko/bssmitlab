<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysfiling extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('NIK') == null || $this->session->userdata('tipeapp') != 'HR_USER') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global','mticket/mod_ticket']);
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
                'content' => 'pages/pticket/pfiling/vfiling'
        	);
        	$this->load->view('pages/pindex/uindex', $data);
        }

        public function table_ticket_filing(){
            $nik           = $this->pregRepn($this->session->userdata('NIK'));
            $ticket_filing = $this->mod_ticket->get_ticket_filing($nik);
            $data          = array();
            $no            = $this->pregRepn($this->input->post('start'));

            foreach ($ticket_filing as $field) {
                $no++;
                $row    = array();
                $noticket = str_replace("/", "-", $field->nodoc);

                if ($field->sts == 1) {
                    $status     = 'Pengajuan';
                    $btn_tiket  = '';
                    $btn_cancel = '<button class="btn btn-sm btn-danger btn-flat text-center"><b><em>BATALKAN</em></b></button>';
                } elseif ($field->sts == 2 || $field->sts == 3 || $field->sts == 4) {
                    $status     = "Dalam Proses";
                    $btn_tiket  = "-";
                    $btn_cancel = "-";
                } else {
                    $status     = "Disetujui";
                    $btn_tiket  = '<a href="'.site_url().'syslink/download_tiket/'.$noticket.'" download class="btn btn-sm btn-warning btn-flat btn-block"><i class="fas fa-cloud-download-alt"></i> <b><em>TIKET</em></b></a>';
                    $btn_cancel = "";
                }

                if ($field->jam_pergi == null) {
                    $jam_pergi = $field->depart_time;
                } elseif ($field->depart_time !== $field->jam_pergi) {
                    $jam_pergi = $field->jam_pergi;
                } else {
                    $jam_pergi = $field->depart_time;
                }

                if ($field->jam_tiba == null) {
                    $jam_tiba = $field->arrival_time;
                } elseif ($field->arrival_time !== $field->jam_tiba) {
                    $jam_tiba = $field->jam_tiba;
                } else {
                    $jam_tiba = $field->arrival_time;
                }

                if ($field->final_price == null) {
                    $harga = $field->price;
                } elseif ($field->price !== $field->final_price) {
                    $harga = $field->final_price;
                } else {
                    $harga = $field->price;
                }

                if ($field->jenis == 1) {
                    $jenis_tiket = "Tiket Pergi";
                } else {
                    $jenis_tiket = "Tiket Pulang";
                }

                $desc = ($field->desc == null) ? "-" : $field->desc;
 
                $row['no']              = $no;
                $row['nodoc']           = $field->nodoc;
                $row['nik']             = $field->nik;
                $row['name']            = $field->Nama;
                $row['site']            = $field->KodeST;
                $row['transport_funds'] = $this->rupiah($field->transport_funds);
                $row['consump_funds']   = $this->rupiah($field->consump_funds);
                $row['subtotal']        = $this->rupiah( intval($harga) + intval($field->transport_funds) + intval($field->consump_funds) );
                $row['submission_date'] = date("d-m-Y", strtotime($field->flight_date));
                $row['flight_date']     = date("d-m-Y", strtotime($field->req_date));
                $row['flight_from']     = $field->flight_from;
                $row['flight_to']       = $field->flight_to;
                $row['depart_time']     = date("h:i A", strtotime($jam_pergi));
                $row['arrival_time']    = date("h:i A", strtotime($jam_tiba));
                $row['airline_name']    = $field->airline_name;
                $row['flight_price']    = $this->rupiah($harga);
                $row['status']          = $status;
                $row['type']            = $field->tipe;
                $row['descript']        = ($field->desc == null ) ? '-' : $field->desc;
                $row['jenis']           = $jenis_tiket;
                $row['action']          = $btn_cancel.' '.$btn_tiket;
                $data[]                 = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_ticket->count_all_ticket_filing($nik),
                "recordsFiltered" => $this->mod_ticket->count_filtered_ticket_filing($nik),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }

?>