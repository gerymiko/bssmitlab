<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysapproved extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_TIKET_VENDOR') {
                redirect('syslogin');
            }
            $this->load->model([ 'mglobal/mod_hr_global', 'mapproved/mod_approved' ]);
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

        private static function rupiah($angka){
            $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
            return $hasil_rupiah;
        }

        private static function clockIndo($time){
            return date("H:i:s", strtotime($time));
        }

        function ticket_approved(){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/papproved/vapproved_ticket',
            );
            $this->load->view('pages/pindex/vindex', $data);
        }

        public function table_ticket_approved(){
            $ticket_approved = $this->mod_approved->get_ticket_approved();
            $data            = array();
            $no              = $this->pregRepn($this->input->post('start'));

            foreach ($ticket_approved as $field) {
                $no++;
                $row = array();

                if ($field->sts_opsi == 2) {
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
                $row['price']        = $this->rupiah($field->price_opsi);
                $row['status']       = $status;
                $row['noktp']        = $this->pregRepn($field->NoKTP);
                $row['type']         = $field->tipe;
                $row['action']       = '
                    <button class="btn btn-sm btn-danger btn-flat text-center" data-toggle="modal" data-target="#booking-modal" data-nik="'.$field->nik.'" data-nodoc="'.$field->nodoc.'" data-karyawan="'.$field->Nama.'" data-depart_city="'.$field->flight_from.'" data-arrival_city="'.$field->flight_to.'" data-depart_time="'.$depart_time.'" data-arrival_time="'.$arrival_time.'" data-airline="'.$field->airline_name.'" data-price="'.$this->rupiah($field->price_opsi).'" data-depart_date="'.$flight_date.'"><b><em>BOOKING</em></b></button>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_approved->count_all_ticket_approved(),
                "recordsFiltered" => $this->mod_approved->count_filtered_ticket_approved(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_booking_ticket(){
            $nodoc    = $this->pregReps($this->input->post('nodoc'));
            $noticket = str_replace("/", "-", $nodoc);
            $getInfoBefore = $this->mod_approved->getInfoTicketBefore($nodoc);

            if ( $this->clockIndo($getInfoBefore->depart_time) == $this->clockIndo($this->input->post('depart_time')) && $this->clockIndo($getInfoBefore->arrival_time) == $this->clockIndo($this->input->post('arrival_time')) ) {
                $desc = "Sesuai dengan pesanan";
            } else {
                $desc = "Perubahan jadwal penerbangan";
            }

            if ( ! empty($_FILES)){
                $config = array(
                    'upload_path'   => dirname("D:\\").'/images/tiket/',
                    'allowed_types' => 'pdf',
                    'max_size'      => '6144',
                    'file_name'     => $noticket
                );

                if( ! $this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error 1";
                }

                if(isset($_FILES['file_ticket']['name'])){
                    if($this->upload->do_upload('file_ticket')){
                        $filename = $this->upload->data();
                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   => dirname("D:\\").'/images/tiket/'.$filename['file_name'],
                            'allowed_types' => 'jpg|png|jpeg',
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => TRUE,
                            'max_size'       => '6144',
                            'quality'        => '50%',
                            'new_image'      => dirname("D:\\").'/images/tiket/'.$filename['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        if(isset($_FILES['file_ticket']['name'])) {         
                           $data = array(
                                'nodoc'         => $nodoc,
                                'final_airline' => $this->pregReps($this->input->post('airline')),
                                'depart_city'   => $this->pregReps($this->input->post('depart_city')),
                                'arrival_city'  => $this->pregReps($this->input->post('arrival_city')),
                                'depart_time'   => $this->clockIndo($this->input->post('depart_time')),
                                'arrival_time'  => $this->clockIndo($this->input->post('arrival_time')),
                                'final_price'   => substr($this->pregRepn($this->input->post('price')), 0),
                                'desc'          => $desc,
                                'noticket'      => $noticket,
                                'file'          => $filename['file_name'],
                                'reg_date'      => date("Y-m-d H:i:s")
                            );
                            $result = $this->mod_approved->save_booking_ticket($data);
                            if ($result == true) {
                                $dataopsi = array('sts_opsi' => 0);
                                $update_opsi = $this->mod_approved->clear_option_ticket($nodoc, $dataopsi);
                                if ($update_opsi == true) {
                                    $datafiling =  array('sts' => 4);
                                    $update_filing = $this->mod_approved->update_submission_ticket($nodoc, $datafiling);
                                    if ($update_filing == true) {
                                        echo "Success";
                                    } else {
                                        echo "Error Submission";
                                    }
                                } else {
                                    echo "Error Opsi";
                                }
                            } else {
                                echo "Error Save";
                            }
                        }
                    } else { echo "Error 3"; }
                } else { echo "Error 4"; }
            } else { echo "Error 5"; }
        }

    }
?>