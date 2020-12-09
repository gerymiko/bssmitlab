<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysordered extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'HR_TIKET') {
                redirect('syslogin');
            }
            $this->load->model([ 'mordered/mod_ordered', ]);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,\/]/','', $string);
            return $result;
        }

        private static function dateIndo($date) { 
            return $result = date("d-m-Y", strtotime($date));
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        private static function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
            return $hasil_rupiah;
        }

        public function ticket_ordered(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/pordered/vordered_ticket',
            );
            $this->load->view('pages/pindex/tindex', $data);
        }

        public function table_ticket_ordered(){
            $ticket_ordered = $this->mod_ordered->get_ticket_ordered();
            $data = array();
            $no   = $this->pregRepn($this->input->post('start'));

            foreach ($ticket_ordered as $field) {
                $no++;
                $row = array();

                if ($field->sts == 4) {
					$status = "Terpesan";
                }

				if ($field->jam_pergi == null) {
                    $jam_pergi = $field->depart_time;
                } elseif ($field->depart_time !== $field->jam_pergi) {
                    $jam_pergi = $field->jam_pergi;
                } else {
                    $jam_pergi = $field->depart_time;
                }

                if ($field->arrival_time == null) {
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
				$desc      = ($field->desc == null) ? "-" : $field->desc;
                
                if ($field->tipe == "Cuti") {
                    $getAkomodation = $this->mod_ordered->getAkomodationCuti($field->flight_to, $field->KodeST);
                } else {
                    $getAkomodation = $this->mod_ordered->getAkomodationDinas($field->site_asal, $field->site_tujuan);
                }

                $total_price = intval($harga) + intval($getAkomodation->uang_transport / 2) + intval($getAkomodation->uang_makan / 2);
                
                $row['no']           = $no;
                $row['nodoc']        = $field->nodoc;
                $row['flight_date']  = $this->dateIndo($field->flight_date);
                $row['flight_from']  = $field->flight_from;
                $row['flight_to']    = $field->flight_to;
                $row['jam_pergi']    = date("h:i A", strtotime($jam_pergi));
                $row['jam_tiba']     = date("h:i A", strtotime($jam_tiba));
                $row['airline_name'] = $field->airline_name;
                $row['harga']        = $this->rupiah($harga);
                $row['status']       = '<b>'.$status.'</b>';
                $row['desc']         = $field->desc;
                $row['nama']         = $field->Nama;
                $row['nik']          = $field->nik;
                $row['tipe']         = $field->tipe;
                $row['site']         = $field->KodeST;
                $row['action']       = '
                    <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#ticket-invoice-modal" data-dana_trans="'.$this->rupiah($getAkomodation->uang_transport / 2).'" data-dana_kons="'.$this->rupiah($getAkomodation->uang_makan / 2).'" data-nik="'.$field->nik.'" data-nodoc="'.$field->nodoc.'" data-karyawan="'.$field->Nama.'" data-price="'.$this->rupiah($harga).'" data-total="'.$this->rupiah($total_price).'" data-site="'.$field->KodeST.'" data-kodedp="'.$field->KodeDP.'" data-kodejb="'.$field->KodeJB.'" data-desc="Pembelian tiket '.$field->tipe.' an '.$field->Nama.' dari '.$field->flight_from.' ke '.$field->flight_to.' tanggal '.$this->dateIndo($field->flight_date).' ">SETUJUI</button>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_ordered->count_all_ticket_ordered(),
                "recordsFiltered" => $this->mod_ordered->count_filtered_ticket_ordered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }


    }
?>