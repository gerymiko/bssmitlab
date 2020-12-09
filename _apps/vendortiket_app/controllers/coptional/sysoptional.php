<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysoptional extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_TIKET_VENDOR') {
                redirect('syslogin');
            }
            $this->load->model([ 'mglobal/mod_hr_global', 'moptional/mod_optional', 'msubvendor/mod_subvendor' ]);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 \/]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

        private static function removeSlash($string) { 
            $result = str_replace("/", "-", $string);
            return $result;
        }

        private static function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
            return $hasil_rupiah;
        }

        public function save_optional_ticket(){
			$nodoc = $this->pregReps($this->input->post('nodoc'));
			$data  = array(
                'nodoc'        => $nodoc,
                'airline_code' => $this->pregReps($this->input->post('airline_code1')),
                'depart_time'  => date("H:i:s", strtotime($this->input->post('depart_time1'))),
                'arrival_time' => date("H:i:s", strtotime($this->input->post('arrival_time1'))),
                'price_opsi'   => $this->pregRepn($this->input->post('price1')),
                'sts_opsi'     => 1
        	);

            $data2  = array(
                'nodoc'        => $nodoc,
                'airline_code' => $this->pregReps($this->input->post('airline_code2')),
                'depart_time'  => date("H:i:s", strtotime($this->input->post('depart_time2'))),
                'arrival_time' => date("H:i:s", strtotime($this->input->post('arrival_time2'))),
                'price_opsi'   => $this->pregRepn($this->input->post('price2')),
                'sts_opsi'     => 1
            );

            $data3  = array(
                'nodoc'        => $nodoc,
                'airline_code' => $this->pregReps($this->input->post('airline_code3')),
                'depart_time'  => date("H:i:s", strtotime($this->input->post('depart_time3'))),
                'arrival_time' => date("H:i:s", strtotime($this->input->post('arrival_time3'))),
                'price_opsi'   => $this->pregRepn($this->input->post('price3')),
                'sts_opsi'     => 1
            );

        	if ($this->input->post('depart_time1') !== null || $this->input->post('arrival_time1') !== '') {
        		$result = $this->mod_optional->save_optional_ticket($data);
        		if ($result == true) {
                    if ($this->input->post('depart_time2') !== null || $this->input->post('depart_time2') !== '') {
                        $result = $this->mod_optional->save_optional_ticket($data2);
                    }

                    if ($this->input->post('depart_time3') !== null || $this->input->post('depart_time3') !== '' || $this->input->post('arrival_time3') !== null || $this->input->post('arrival_time3') !== '') {
                        $result = $this->mod_optional->save_optional_ticket($data3);
                    }

					$data_sts   = array( 'sts' => 3 );
					$update_sts = $this->mod_optional->update_sts_ticket($nodoc, $data_sts);
        			if ($update_sts == true) {
        				echo "1";
        			} else {
        				echo "Error";
        			}
        		} else {
        			echo "Error";
        		}
        	}
        }

        function ticket_optional(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/poptional/voptional_ticket',
            );
            $this->load->view('pages/pindex/vindex', $data);
        }

        public function table_ticket_optional(){
            $ticket_option = $this->mod_optional->get_ticket_option();
            $data          = array();
            $no            = $this->pregRepn($this->input->post('start'));

            foreach ($ticket_option as $field) {
                $no++;
                $row = array();

                if ($field->sts == 1) {
                    $status = "Pengajuan";
                } elseif ($field->sts == 3) {
                    $status = "Opsi";
                } else {
                    $status = "Disetujui";
                }

                $check_sts = $this->mod_optional->check_status_option($field->nodoc);
                if ($check_sts == true) {
                    $sts_tiket = "Sudah Dipilih";
                } else {
                    $sts_tiket = "Belum Dipilih";
                }

                $depart_time  = date("h:i A", strtotime($field->depart_time));
                $arrival_time = date("h:i A", strtotime($field->arrival_time));
                $flight_date  = date("d-m-Y", strtotime($field->flight_date));
                $req_date     = date("d-m-Y", strtotime($field->req_date));

                $nodoc = $this->removeSlash($field->nodoc);

                $row['no']           = $no;
                $row['nodoc']        = $field->nodoc;
                $row['nik']          = $field->nik;
                $row['name']         = $field->Nama;
                $row['req_date']     = $req_date;
                $row['flight_date']  = $flight_date;
                $row['flight_from']  = $field->flight_from;
                $row['flight_to']    = $field->flight_to;
                $row['depart_time']  = $depart_time;
                $row['arrival_time'] = $arrival_time;
                $row['airline_name'] = $field->airline_name;
                $row['price']        = $this->rupiah($field->price);
                $row['status']       = $sts_tiket;
                $row['type']         = $field->tipe;
                $row['action']       = '
                    <a class="btn btn-sm btn-danger btn-flat text-center" href="'.site_url().'coptional/sysoptional/detail_optional/'.$nodoc.'"><b><em>LIHAT OPSI</em></b></a>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_optional->count_all_ticket_option(),
                "recordsFiltered" => $this->mod_optional->count_filtered_ticket_option(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

         public function detail_optional($nodoc){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/poptional/vdetail_optional',
            );
            $this->load->view('pages/pindex/vindex', $data);
        }

        public function table_detail_ticket_optional($nodoc){
            $nodoc = str_replace("-", "/", $nodoc);
            $dticket_option = $this->mod_optional->get_detail_ticket_option($nodoc);
            $data          = array();
            $no            = $this->pregRepn($this->input->post('start'));

            foreach ($dticket_option as $field) {
                if ($field->sts_opsi == 1) {
                    $status = "Belum Dipilih";
                    $btn_chosen = "";
                } else {
                    $status = "Tiket Disetujui";
                    $btn_chosen = "disabled";
                }

                $no++;
                $row = array();

                $depart_time  = date("h:i A", strtotime($field->depart_time));
                $arrival_time = date("h:i A", strtotime($field->arrival_time));

                $row[]  = $no;
                $row[]  = $field->nodoc;
                $row[]  = $field->nik;
                $row[]  = $field->Nama;
                $row[]  = $field->airline_name;
                $row[]  = $depart_time;
                $row[]  = $arrival_time;
                $row[]  = $this->rupiah($field->price_opsi);
                $row[]  = $status;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_optional->count_all_detail_ticket_option($nodoc),
                "recordsFiltered" => $this->mod_optional->count_filtered_detail_ticket_option($nodoc),
                "data"            => $data,
            );
            echo json_encode($output);
        }

    }
?>