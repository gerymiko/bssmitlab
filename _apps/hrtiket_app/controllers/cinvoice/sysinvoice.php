<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysinvoice extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'HR_TIKET') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global', 'minvoice/mod_invoice']);
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function rupiah($angka){
            return $result = "Rp " . number_format($angka,0,',','.');
        }

        private static function dateIndo($date){
            return $result = date("d-m-Y", strtotime($date));
        }

        private static function timeIndo($time){
            return $result = date("H:i:s", strtotime($time));
        }

        public function index(){
        	$data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'sidebar' => 'pages/psidebar/vsidebar',
                'content' => 'pages/pinvoice/vinvoice'
        	);
        	$this->load->view('pages/pindex/tindex', $data);
        }

        public function save_invoice_ticket(){
            $nopengajuan = $this->input->post('nodoc');

            $getAN = $this->mod_invoice->getATNpengajuan_dana();
            $autonumber = $getAN->AutoNumber;

            $dataInv = array(
                'NoPD'        => $autonumber,
                'Tanggal'     => date("Y-m-d"),
                'Jam'         => date("H:i:s"),
                'JNS'         => 1,
                'Oleh'        => $this->pregRepn($this->input->post('nik')),
                'NIK'         => $this->pregRepn($this->input->post('nik')),
                'User_KodeDP' => $this->input->post('kodedp'),
                'User_KodeJB' => $this->input->post('kodejb'),
                'KodeDP'      => $this->input->post('kodedp'),
                'Nominal'     => $this->pregRepn($this->input->post('total')),
                'keterangan'  => $this->input->post('desc'),
                'KodeST'      => $this->input->post('site'),
                'Batal'       => 0,
                'TTD'         => 0,
                'SubTotal'    => $this->pregRepn($this->input->post('total')),
                'PPNPrs'      => 0,
                'PPN'         => 0,
                'PPHJNS'      => 0,
                'PPHPrs'      => 0,
                'PPH'         => 0,
                'KodeCRC'     => 'IDR',
                'Materai'     => 0,
                'Diskon'      => 0,
                'IKodeST'     => $this->input->post('site')
            );
            $save_pengajuan_dana = $this->mod_invoice->insert_finance('TPengajuanDana', $dataInv);
            if ($save_pengajuan_dana == true) {
                $dataDoc = array( 'NoPD' => $autonumber );
                $updateTicket = $this->mod_invoice->edit_pengajuan('TOrdered_tiket', $nopengajuan, $dataDoc);

                $dataPDana = array(
                    'NoPD'     => $autonumber,
                    'nik'      => $this->pregRepn($this->input->post('nik')),
                    'sts_dn'   => 1,
                    'inv_date' => date("Y-m-d H:i:s")
                );
                $save_PDana_status = $this->mod_invoice->insert_ticket('TPDana_status', $dataPDana);

                if ($updateTicket == true && $save_PDana_status == true) {
                    $dataPengajuanTicket = array( 'sts' => 0 );
                    $updatePTicket = $this->mod_invoice->edit_pengajuan('TPengajuan_tiket', $nopengajuan, $dataPengajuanTicket);
                    if ($updatePTicket == true) {
                        echo "Success";
                    } else {
                        echo "Error";
                        exit();
                    }
                } else {
                    echo "Error";
                    exit();
                }
            }
        }

        public function table_invoice_ticket(){
            $invoice_ticket = $this->mod_invoice->get_invoice_ticket();
            $data          = array();
            $no            = $this->pregRepn($this->input->post('start'));

            foreach ($invoice_ticket as $field) {
                $no++;
                    $row                 = array();
                    $row['no']           = $no;
                    $row['nodoc']        = $field->NoPD;
                    $row['nodoc_ticket'] = $field->nodoc;
                    $row['invoice_date'] = array(
                            'tgl'       => $this->dateIndo($field->inv_date),
                            'sort_date' => strtotime($field->inv_date)
                    );
                    $row['nik']          = $field->nik;
                    $row['name']         = $field->Nama;
                    $row['site']         = $field->KodeST;
                    $row['keterangan']   = $field->Keterangan;
                    $row['price']        = $this->rupiah($field->SubTotal);
                    $row['status']       = 'Proses';
                    $row['button']       = '<a onclick="bayar();" class="btn btn-danger btn-sm"><em>BELUM DIBAYAR</em></a>';
                    $row['flight_date']  = $this->dateIndo($field->flight_date);
                    $row['flight_from']  = $field->depart_city;
                    $row['flight_to']    = $field->arrival_city;
                    $row['depart_time']  = $this->timeIndo($field->depart_time);
                    $row['arrival_time'] = $this->timeIndo($field->arrival_time);
                    $row['airline_name'] = $field->final_airline;
                    $row['ticket_price'] = $this->rupiah($field->final_price);
                    $row['trans_price']  = $this->rupiah($field->transport_funds);
                    $row['cons_price']   = $this->rupiah($field->consump_funds);
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_invoice->count_all_invoice_ticket(),
                "recordsFiltered" => $this->mod_invoice->count_filtered_invoice_ticket(),
                "data"            => $data,
            );
            echo json_encode($output);
        }


    }
?>