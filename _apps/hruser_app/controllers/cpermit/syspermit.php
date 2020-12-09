<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syspermit extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('NIK') == null || $this->session->userdata('tipeapp') != 'HR_USER') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global', 'mpermit/mod_permit', 'mleave/mod_leave']);
        }

        private static function pregReps($string) { 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number) { 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function dateEast($date){
           return $result = date("d-m-Y", strtotime($date));
        }

        private static function dateWest($date){
           return $result = date("Y-m-d", strtotime($date));
        }

        private static function dateDiff($date1, $date2) {
            $date1_ts = strtotime($date1);
            $date2_ts = strtotime($date2);
            $diff = $date2_ts - $date1_ts;
            return round($diff / 86400 + 1);
        }

        public function index(){
            $nik  = $this->pregRepn($this->session->userdata('NIK'));
        	$data = array(
                'header'         => 'pages/ext/header',
                'footer'         => 'pages/ext/footer',
                'sidebar'        => 'pages/psidebar/vsidebar',
                'content'        => 'pages/ppermit/vpermit',
                'list_site'      => $this->mod_hr_global->getList_site(),
                'dkaryawan'      => $this->mod_hr_global->getDetail_karyawan($nik),
                'list_opermit'   => $this->mod_permit->getOfficial_permit(),
                'list_unopermit' => $this->mod_permit->getUnofficial_permit(),
                'dperiode'       => $this->mod_leave->getDetail_periode($nik),
        	);
        	$this->load->view('pages/pindex/uindex', $data);
        }

        public function table_history_permit(){
            $nik            = $this->pregRepn($this->session->userdata('NIK'));
            $history_permit = $this->mod_permit->get_history_permit($nik);
            $data           = array();
            $no             = $this->pregRepn($this->input->post('start'));

            foreach ($history_permit as $field) {

                if ($field->permohonan == 1) {
                    $modal = "official";
                } else {
                    $modal = "unofficial";
                }

                $no++;
                $row                 = array();
                $row['no']           = $no;
                $row['nopengajuan']  = $field->nopengajuanizin;
                $row['tglpengajuan'] = array(
                    'tgl'      => $this->dateEast($field->tanggal),
                    'sort_tgl' => strtotime( $this->dateEast($field->tanggal) )
                );
                $row['selama']       = $field->selama;
                $row['tglmulai']     = $this->dateEast($field->tanggal_mulai);
                $row['tglakhir']     = $this->dateEast($field->tanggal_akhir);
                $row['katizin']      = $field->permohonan_ket;
                $row['jnsizin']      = $field->jnsizin;
                $row['periode']      = ( $field->periode  == null ) ? "-" : $this->dateEast($field->periode);
                $row['keterangan']   = $field->keterangan;
                $row['periodeCT']    = $field->CTTahunan;
                $row['action']    	 = '
										<button id="btn_change_permit" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#modal-edit-'.$modal.'" data-backdrop="static" data-keyboard="false" data-nopengajuan="'.$field->nopengajuanizin.'" data-tgl_awal="'.$this->dateEast($field->tanggal_mulai).'" data-selama="'.$field->selama.'" data-tgl_akhir="'.$this->dateEast($field->tanggal_akhir).'" data-site="'.$field->kodest.'" data-tgl_masuk="'.date("d-m-Y", strtotime($field->tanggal_akhir . ' +1 day')).'" data-desc="'.$field->keterangan.'" data-jenis="'.$field->KodeIzin.$field->selama.'"><i class="far fa-edit"></i></button>
										<a class="btn btn-xs btn-danger btn-flat" onClick="delete_izin()"><i class="far fa-trash-alt"></i></a>
                ';
                $data[]              = $row;
            };

            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_permit->count_all_history_permit($nik),
                "recordsFiltered" => $this->mod_permit->count_filtered_history_permit($nik),
                "data"            => $data,
            );
            echo json_encode($output);
        }        

        public function save_official_permit(){
			$nik        = $this->pregRepn($this->session->userdata('NIK'));

            // $getStatusIzinNow = $this->mod_permit->getStatusIzin($nik);

			$kodepermit = $this->input->post('opermit_type');
			$kodeizin   = substr($kodepermit, 0, 5);
			$selama 	= substr($kodepermit, 5);

			$tglmulai = $this->dateWest($this->input->post('otgl_awal'));
			$tglakhir = $this->dateWest($this->input->post('otgl_akhir'));
			$dateDiff = intval($this->dateDiff($tglmulai, $tglakhir));

			$getDetailIzin = $this->mod_permit->getDetailIzin($kodeizin);

			if($getDetailIzin->lama != $dateDiff){
				echo "Error";
				exit();
			}

            $getAN      = $this->mod_permit->getATNpengajuan_izin();
            $autonumber = $getAN->AutoNumber;

            $dataIzin = array(
                'nopengajuanizin' => $autonumber,
                'tanggal'         => date("Y-m-d"),
                'nik'             => $nik,
                'selama'          => $dateDiff,
                'tanggal_mulai'   => $tglmulai, 
                'tanggal_akhir'   => $tglakhir,
                'permohonan'      => 1,
                'permohonan_ket'  => 'Izin Resmi',
                'kodest'          => $this->input->post('osite_ir'),
                'keterangan'      => $this->pregReps($this->input->post('odesc')),
                'KodeIzin'		  => $kodeizin
            );
            $save_izin = $this->mod_permit->insert_pengajuan('tpengajuanizin', $dataIzin);
            if ($save_izin == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function save_edit_official_permit(){
            $nopengajuan = $this->input->post('nopengajuan_edit');
            $kodepermit  = $this->input->post('opermit_type_edit');
            $kodeizin    = substr($kodepermit, 0, 5);
            $tglmulai    = $this->dateWest($this->input->post('otgl_awal_edit'));
            $tglakhir    = $this->dateWest($this->input->post('otgl_akhir_edit'));
            $dateDiff    = intval($this->dateDiff($tglmulai, $tglakhir));
            $getDetailIzin = $this->mod_permit->getDetailIzin($kodeizin);

            if($getDetailIzin->lama != $dateDiff){
                echo "Error";
                exit();
            }

            $dataIzin = array(
                'selama'          => $dateDiff,
                'tanggal_mulai'   => $tglmulai, 
                'tanggal_akhir'   => $tglakhir,
                'kodest'          => $this->input->post('osite_ir_edit'),
                'keterangan'      => $this->pregReps($this->input->post('odesc_edit')),
                'KodeIzin'        => $kodeizin
            );
            $save_edit_izin = $this->mod_permit->edit_pengajuan($nopengajuan, $dataIzin);
            if ($save_edit_izin == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function save_unofficial_permit(){
            $nik        = $this->pregRepn($this->session->userdata('NIK'));

            $kodepermit = $this->input->post('unopermit_type');
            $kodeizin   = substr($kodepermit, 0, 5);
            $selama     = substr($kodepermit, 5);

            $tglmulai = $this->dateWest($this->input->post('unotgl_awal'));
            $tglakhir = $this->dateWest($this->input->post('unotgl_akhir'));
            $dateDiff = intval($this->dateDiff($tglmulai, $tglakhir));

            $getDetailIzin = $this->mod_permit->getDetailIzin($kodeizin);

            if($getDetailIzin->lama != $dateDiff){
                echo "Error";
                exit();
            }

            $periode1_akhir = $this->input->post('pcuti1_akhir');
            
            $periode2_akhir = $this->input->post('pcuti2_akhir');

            $tperiode = $this->input->post('periode_cuti');

            if ($tperiode == "p1") {
                $periode2 = $this->dateWest($periode1_akhir);
            } else {
                $periode2 = $this->dateWest($periode2_akhir);
            }

            $getAN      = $this->mod_permit->getATNpengajuan_izin();
            $autonumber = $getAN->AutoNumber;

            $dataIzin = array(
                'nopengajuanizin' => $autonumber,
                'tanggal'         => date("Y-m-d"),
                'nik'             => $nik,
                'selama'          => $dateDiff,
                'tanggal_mulai'   => $tglmulai, 
                'tanggal_akhir'   => $tglakhir,
                'permohonan'      => 2,
                'permohonan_ket'  => 'Izin Tidak Resmi',
                'kodest'          => $this->input->post('unosite_ir'),
                'keterangan'      => $this->pregReps($this->input->post('unodesc')),
                'KodeIzin'        => $kodeizin,
                'Periode'         => $periode2,
            );
            
            $save_izin = $this->mod_permit->insert_pengajuan('tpengajuanizin', $dataIzin);
            if ($save_izin == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

    }
?>