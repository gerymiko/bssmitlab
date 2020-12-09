<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysoption extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'HR_TIKET') {
                redirect('syslogin');
            }
            $this->load->model([ 'moption/mod_option', ]);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,\/]/','', $string);
            return $result;
        }

        private static function removeSlash($string) { 
            $result = str_replace("/", "-", $string);
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

        private static function convertTime($time, $format = '%2d:%2d') {
            if ($time < 1) {
                return;
            }
            $hours   = floor($time / 60);
            $minutes = ($time % 60);
            return sprintf($format, $hours, $minutes);
        }

        public function ticket_option(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/poption/voption_ticket',
            );
            $this->load->view('pages/pindex/tindex', $data);
        }

        public function table_ticket_option(){
            $ticket_option = $this->mod_option->get_ticket_option();
            $data          = array();
            $no            = $this->pregRepn($this->input->post('start'));

            foreach ($ticket_option as $field) {
                $no++;
                $row = array();

                if ($field->sts == 1) {
                    $status = "Pengajuan";
                } elseif ($field->sts == 3) {
                    $status = "Opsi Vendor";
                } else {
                    $status = "Disetujui";
                }

                $check_sts = $this->mod_option->check_status_option($field->nodoc);
                if ($check_sts == true) {
                    $sts_tiket = "Sudah Dipilih";
                } else {
                    $sts_tiket = "Belum Dipilih";
                }

                $depart_time  = date("h:i A", strtotime($field->depart_time));
                $arrival_time = date("h:i A", strtotime($field->arrival_time));
                $flight_date  = date("d-m-Y", strtotime($field->flight_date));
                $submission_date = date("d-m-Y", strtotime($field->req_date));

                $nodoc = $this->removeSlash($field->nodoc);

                $row['no']              = $no;
                $row['nodoc']           = $field->nodoc;
                $row['nik']             = $field->nik;
                $row['name']            = $field->Nama;
                $row['submission_date'] = $submission_date;
                $row['flight_date']     = $flight_date;
                $row['flight_from']     = $field->flight_from;
                $row['flight_to']       = $field->flight_to;
                $row['depart_time']     = $depart_time;
                $row['arrival_time']    = $arrival_time;
                $row['airline_name']    = $field->airline_name;
                $row['price']           = $this->rupiah($field->price);
                $row['status']          = '<b>'.$status.'</b>';
                $row['sts_tiket']       = $sts_tiket;
                $row['type']            = $field->tipe;
                $row['button']          = '
                    <a class="btn btn-sm btn-warning btn-flat text-center" href="'.site_url().'coption/sysoption/detail_option/'.$nodoc.'"><b><em>LIHAT OPSI</em></b></a>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_option->count_all_ticket_option(),
                "recordsFiltered" => $this->mod_option->count_filtered_ticket_option(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function detail_option($nodoc){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/poption/vdetail_option',
            );
            $this->load->view('pages/pindex/tindex', $data);
        }

        public function table_detail_ticket_option($nodoc){
            $nodoc = str_replace("-", "/", $nodoc);
            $dticket_option = $this->mod_option->get_detail_ticket_option($nodoc);
            $data          = array();
            $no            = $this->pregRepn($this->input->post('start'));

            foreach ($dticket_option as $field) {
                if ($field->sts_opsi == 1) {
                    $status = "Belum Dipilih";
                    $btn_chosen = "";
                } else {
                    $status = "Tiket Dipilih";
                    $btn_chosen = "disabled";
                }

                $time1 = strtotime($field->depart_time);
                $time2 = strtotime($field->arrival_time);
                $duration = round(abs($time2 - $time1) / 60,2);

                $no++;
                $row = array();

                $depart_time  = date("h:i A", strtotime($field->depart_time));
                $arrival_time = date("h:i A", strtotime($field->arrival_time));

                $row['no']           = $no;
                $row['nodoc']        = $field->nodoc;
                $row['nik']          = $field->nik;
                $row['name']         = $field->Nama;
                $row['airline_name'] = $field->airline_name;
                $row['depart_time']  = $depart_time;
                $row['arrival_time'] = $arrival_time;
                $row['duration']     = $this->convertTime($duration, '%2dh %2dm');
                $row['price']        = array(
                    'display' => $this->rupiah($field->price_opsi),
                    'sort'    => $field->price_opsi
                );
                $row['status']       = $status;
                $row['button']       = '
                    <button class="btn btn-sm btn-warning btn-flat text-center" '.$btn_chosen.' data-toggle="modal" data-target="#ticket-selected-modal" data-id="'.$field->id.'" data-nodoc="'.$field->nodoc.'" data-nik="'.$field->nik.'" data-karyawan="'.$field->Nama.'" data-depart_time="'.$depart_time.'" data-arrival_time="'.$arrival_time.'" data-airline="'.$field->airline_name.'" data-price="'.$this->rupiah($field->price_opsi).'"><b><em>PILIH</em></b></button>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_option->count_all_detail_ticket_option($nodoc),
                "recordsFiltered" => $this->mod_option->count_filtered_detail_ticket_option($nodoc),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_ticket_selected(){
            $nodoc     = $this->input->post('nodoc');
            $check_sts = $this->mod_option->check_status_option($nodoc);
            if ($check_sts == true) {
                echo "2";
                exit();
            }

            $id = $this->input->post('id');
            $data = array(
                'sts_opsi' => 2
            );
            $result = $this->mod_option->save_ticket_selected($id, $data);
            if ($result == true) {
                echo "1";
            } else {
                echo "Error";
            }
        }
    }
?>