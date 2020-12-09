<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysleave extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('NIK') == null || $this->session->userdata('tipeapp') != 'HR_USER') {
                redirect('syslogin');
            }
            $this->load->model(['mglobal/mod_hr_global', 'mleave/mod_leave']);
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

        private static function dateDiff($date1, $date2){
            $date1_ts = strtotime($date1);
            $date2_ts = strtotime($date2);
            $diff     = $date2_ts - $date1_ts;
            return round($diff / 86400 + 1);
        }

        private static function dateEast($date){
           return $result = date("d-m-Y", strtotime($date));
        }

        private static function dateWest($date){
           return $result = date("Y-m-d", strtotime($date));
        }

        public function index(){
            $nik  = $this->pregRepn($this->session->userdata('NIK'));
        	$data = array(
                'header'        => 'pages/ext/header',
                'footer'        => 'pages/ext/footer',
                'sidebar'       => 'pages/psidebar/vsidebar',
                'content'       => 'pages/pleave/vleave',
                'list_karyawan' => $this->mod_hr_global->getList_karyawan($nik),
                'list_site'     => $this->mod_hr_global->getList_site(),
                'dkaryawan'     => $this->mod_hr_global->getDetail_karyawan($nik),
                'dperiode'      => $this->mod_leave->getDetail_periode($nik),
                'dcutikaryawan' => $this->mod_leave->getDetail_cutiKaryawan($nik)
        	);
        	$this->load->view('pages/pindex/uindex', $data);
        }

        public function table_history_cuti(){
            $nik          = $this->pregRepn($this->session->userdata('NIK'));
            $history_cuti = $this->mod_leave->get_history_cuti($nik);
            $data         = array();
            $no           = $this->pregRepn($this->input->post('start'));

            foreach ($history_cuti as $field) {

                if ($field->CutiThn == 0 || $field->CutiThn == '' || $field->CutiThn == null) {
                    $cuti_tahunan = 0;
                } else {
                    $cuti_tahunan = 3;
                }

                if ($field->Periode1 == null || $field->Periode1 == '') {
                    $periode1 = "-";
                } else {
                    $periode1 = $this->dateEast($field->Periode1);
                }

                if ($field->periode2 == null || $field->periode2 == '') {
                    $periode2 = "-";
                } else {
                    $periode2 = $this->dateEast($field->periode2);
                }

                $getPenegasanCuti = $this->mod_leave->getPenegasanCuti($field->nopengajuancuti);
                $nopengajuancuti  = substr(str_replace("/", "", $field->nopengajuancuti), 5);
                $total_cuti       = intval($field->selama) + intval($cuti_tahunan);  

                $nopengajuan = str_replace("/", "-", $field->nopengajuancuti);

                $petugas    = $this->mod_leave->getPetugasPengganti($field->nopengajuancuti);   
                $jobpending = $this->mod_leave->getJobPending($field->nopengajuancuti);

                if ($getPenegasanCuti !== false ) {
                    $btnPenegasan = '<button class="btn btn-xs btn-warning btn-flat">'.$getPenegasanCuti->Nodoc.'</button>';
                    $btnDelete    = '-';
                    $btnChange    = '-';
                } else {

                    if ($field->jnscuti == "Cuti Rooster") {
                        $modal   = "rooster";
                        $onclick = "editrooster(this)";
                    } elseif ($field->jnscuti == "Cuti Besar") {
                        $modal   = "besar";
                        $onclick = "editgreatleave(this)";
                    } else {
                        $modal   = "lahir";
                        $onclick = "editgivebirth(this)";
                    }

                    $btnPenegasan = 'Belum Terbit';
                    $btnDelete    = '<a class="btn btn-xs btn-danger btn-flat" onClick="delete_cuti('.$nopengajuancuti.')"><i class="far fa-trash-alt"></i></a>';
                    $btnChange    = '<button class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#modal-edit-'.$modal.'" data-backdrop="static" data-keyboard="false" data-nodoc="'.$field->nopengajuancuti.'" data-tgl_awal="'.$this->dateEast($field->tanggal_mulai).'" data-selama="'.$field->selama.'" data-tgl_akhir="'.$this->dateEast($field->tanggal_akhir).'" data-tgl_kerja="'.$this->dateEast($field->tanggal_bekerja).'" data-total_cuti="'.$total_cuti.'" data-id="'.$nopengajuan.'" data-cutitahunan="'.$cuti_tahunan.'" onclick="'.$onclick.'" data-site="'.$field->kodest.'" ><i class="far fa-edit"></i></button>';
                }

                $no++;
                $row                 = array();
                $row['no']           = $no;
                $row['nopengajuan']  = $field->nopengajuancuti;
                $row['tglpengajuan'] = array(
                    'tgl'      => $this->dateEast($field->tanggal),
                    'sort_tgl' => strtotime( $this->dateEast($field->tanggal) )
                );
                $row['selama']       = $field->selama;
                $row['cutitahunan']  = $cuti_tahunan;
                $row['tglmulai']     = $this->dateEast($field->tanggal_mulai);
                $row['tglakhir']     = $this->dateEast($field->tanggal_akhir);
                $row['tglmasuk']     = $this->dateEast($field->tanggal_bekerja);
                $row['jnscuti']      = $field->jnscuti;
                $row['periode1']     = $periode1;
                $row['periode2']     = $periode2;
                $row['btnpenegasan'] = $btnPenegasan;
                $row['btnaction']    = $btnChange.' '.$btnDelete;
                $row['ptgs']         = $petugas;
                $row['jobpending']   = $jobpending;
                $data[]              = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_leave->count_all_history_cuti($nik),
                "recordsFiltered" => $this->mod_leave->count_filtered_history_cuti($nik),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_job_pending($nopengajuan){
            $nopengajuan = str_replace("-", "/", $nopengajuan);
            $job_pending = $this->mod_leave->get_job_pending($nopengajuan);
            $data        = array();
            $no          = $this->pregRepn($this->input->post('start'));

            foreach ($job_pending as $field) {

                $no++;
                $row               = array();
                $row['keterangan'] = $field->keterangan;
                $row['action']     = '<button type="button" class="btn btn-xs btn-danger" data-tipe="'.$field->KodeCT.'" data-nodoc="'.$nopengajuan.'" data-idx="'.$field->idx.'" onClick="deteleJP(this);"><i class="fas fa-times"></i></button>';
                $data[]            = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_leave->count_all_job_pending($nopengajuan),
                "recordsFiltered" => $this->mod_leave->count_filtered_job_pending($nopengajuan),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_cuti_rooster(){
            $nik              = $this->pregRepn($this->session->userdata('NIK'));
            $getStatusCutiNow = $this->mod_leave->getStatusCutiRooster($nik);
            if ($getStatusCutiNow !== false ) {
                echo 'onprogress';
                exit();
            }

            $cthn = $this->input->post('CutiThn');
            if ($cthn != '3' && $cthn != '0') {
                echo 'error 1';
                exit();
            }
            
            $total_cuti = $this->input->post('total_cuti');
            $date1      = $this->dateWest($this->input->post('tgl_awal'));
            $date2      = $this->dateWest($this->input->post('tgl_akhir'));
            $dateDiff   = intval($this->dateDiff($date1, $date2));

            if (intval($total_cuti) !== $dateDiff) {
                echo 'error 2';
                exit();
            }

            $periode1_awal  = $this->input->post('pcuti1_awal');
            $periode1_akhir = $this->input->post('pcuti1_akhir');
            
            $periode2_awal  = $this->input->post('pcuti2_awal');
            $periode2_akhir = $this->input->post('pcuti2_akhir');

            $tperiode = $this->input->post('periode_cuti');

            if ($tperiode == "p1") {
                $periode1 = $this->dateWest($periode1_awal);
                $periode2 = $this->dateWest($periode1_akhir);
            } else {
                $periode1 = $this->dateWest($periode2_awal);
                $periode2 = $this->dateWest($periode2_akhir);
            }

            $getAN      = $this->mod_leave->getATNpengajuan_cuti();
            $autonumber = $getAN->AutoNumber;

            $dataCuti = array(
                'nopengajuancuti' => $autonumber,
                'tanggal'         => date("Y-m-d"),
                'nik'             => $nik,
                'selama'          => $this->pregRepn($this->input->post('selama')), 
                'tanggal_mulai'   => $this->dateWest($this->input->post('tgl_awal')), 
                'tanggal_akhir'   => $this->dateWest($this->input->post('tgl_akhir')),
                'tanggal_bekerja' => $this->dateWest($this->input->post('tgl_kerja')),
                'validasi'        => 0,
                'kodest'          => $this->input->post('site'),
                'batal'           => 0,
                'KodeCT'          => '001',
                'Periode1'        => $periode1,
                'periode2'        => $periode2,
                'CutiThn'         => $cthn
            );
            $save_rooster = $this->mod_leave->insert('tpengajuancuti', $dataCuti);

            $nik = $this->pregRepn($this->input->post('ptgs_pengganti'));
            for ($i = 0; $i < count($nik); $i++) {
                $dataPtgs = array(
                    'nopengajuancuti' => $autonumber,
                    'idx'   => $i,
                    'nik'   => $nik[$i],
                    'nama'  => $this->mod_leave->getEmployeeName($nik[$i])->Nama
                );
                $save_ptgs_rooster = $this->mod_leave->insert('tpengajuancuti_pengganti', $dataPtgs);
            }

            $outstanding_tugas = $this->input->post('outstanding_tugas');
            for ($i = 0; $i < count($outstanding_tugas); $i++) {
                $dataTgs = array(
                    'nopengajuancuti' => $autonumber,
                    'idx'             => $i,
                    'keterangan'      => $outstanding_tugas[$i]
                );
                $save_jp_rooster = $this->mod_leave->insert('tpengajuancuti_jobpending', $dataTgs);
            }

            if ($save_rooster == true && $save_ptgs_rooster == true && $save_jp_rooster == true) {
                echo "Success";
            }  
        }

        public function save_edit_rooster(){
            $nopengajuan = $this->input->post('nodoc');
            $total_cuti  = $this->input->post('total_cuti_edit');
            $cthn        = $this->input->post('CutiThn_edit');
            if ($cthn != 3 && $cthn != 0) {
                echo 'error';
                exit();
            }
            
            $date1      = $this->dateWest($this->input->post('tgl_awal_edit'));
            $date2      = $this->dateWest($this->input->post('tgl_akhir_edit'));
            $dateDiff   = intval($this->dateDiff($date1, $date2));
            if (intval($total_cuti) !== $dateDiff) {
                echo 'error';
                exit();
            }

            $periode1_awal  = $this->input->post('pcuti1_awal_edit');
            $periode1_akhir = $this->input->post('pcuti1_akhir_edit');
            
            $periode2_awal  = $this->input->post('pcuti2_awal_edit');
            $periode2_akhir = $this->input->post('pcuti2_akhir_edit');
            
            $tperiode       = $this->input->post('periode_cuti_edit');

            if ($tperiode == "p1e") {
                $periode1 = $this->dateWest($periode1_awal);
                $periode2 = $this->dateWest($periode1_akhir);
            } else {
                $periode1 = $this->dateWest($periode2_awal);
                $periode2 = $this->dateWest($periode2_akhir);
            }

            $dataCuti = array(
                'selama'          => $this->pregRepn($this->input->post('selama_edit')), 
                'tanggal_mulai'   => $this->dateWest($this->input->post('tgl_awal_edit')), 
                'tanggal_akhir'   => $this->dateWest($this->input->post('tgl_akhir_edit')),
                'tanggal_bekerja' => $this->dateWest($this->input->post('tgl_kerja_edit')),
                'validasi'        => 0,
                'kodest'          => $this->input->post('site_edit'),
                'batal'           => 0,
                'KodeCT'          => '001',
                'Periode1'        => $periode1,
                'periode2'        => $periode2,
                'CutiThn'         => $cthn
            );
            $save_rooster = $this->mod_leave->edit_pengajuan($nopengajuan, $dataCuti);

            $nikptgs           = $this->input->post('ptgs_pengganti_edit');
            $delete_ptgs_first = $this->mod_leave->delete_petugas_pengganti($nopengajuan);
            for ($i = 0; $i < count($nikptgs); $i++) {
                $dataPtgs = array(
                    'nopengajuancuti' => $nopengajuan,
                    'idx'             => $i,
                    'nik'             => $nikptgs[$i],
                    'nama'            => $this->mod_leave->getEmployeeName($nikptgs[$i])->Nama
                );
                $save_ptgs = $this->mod_leave->insert('tpengajuancuti_pengganti', $dataPtgs);
            }

            $outstanding_tugas = $this->input->post('jobpending_rooster_edit');
            $getIdx            = $this->mod_leave->getIdxJobPending($nopengajuan);
            $idx               = $getIdx->idx + 1;
            if ( count($outstanding_tugas) > 0 ) {
                for ($i = 0; $i < count($outstanding_tugas); $i++) {
                    $dataTgs = array(
                        'nopengajuancuti' => $nopengajuan,
                        'idx'             => $idx++,
                        'keterangan'      => $outstanding_tugas[$i]
                    );
                    $save_outstanding_job = $this->mod_leave->insert('tpengajuancuti_jobpending', $dataTgs);
                }
            } else {
                $save_outstanding_job = true;
            }
            
            if ($save_rooster == true && $save_ptgs == true && $save_outstanding_job == true) {
                echo "Success";
            }
        }

        public function save_cuti_besar(){

            if ( $this->pregRepn($this->input->post('selama2')) > 25 ) {
                echo "error";
                exit();
            }

            $getAN      = $this->mod_leave->getATNpengajuan_cuti();
            $autonumber = $getAN->AutoNumber;

            $dataCuti = array(
                'nopengajuancuti' => $autonumber,
                'tanggal'         => date("Y-m-d"),
                'nik'             => $this->pregRepn($this->session->userdata('NIK')),
                'selama'          => $this->pregRepn($this->input->post('selama2')), 
                'tanggal_mulai'   => $this->dateWest($this->input->post('tgl_awal2')), 
                'tanggal_akhir'   => $this->dateWest($this->input->post('tgl_akhir2')),
                'tanggal_bekerja' => $this->dateWest($this->input->post('tgl_kerja2')),
                'validasi'        => 0,
                'kodest'          => $this->input->post('site2'),
                'batal'           => 0,
                'KodeCT'          => '002',
                'Periode1'        => null,
                'periode2'        => null,
                'CutiThn'         => null
            );
            $save_5th = $this->mod_leave->insert('tpengajuancuti', $dataCuti);

            $nik = $this->pregRepn($this->input->post('ptgs_pengganti2'));
            for ($i = 0; $i < count($nik); $i++) {
                $dataPtgs = array(
                    'nopengajuancuti' => $autonumber,
                    'idx'  => $i,
                    'nik'  => $nik[$i],
                    'nama' => $this->mod_leave->getEmployeeName($nik[$i])->Nama
                );
                $save_ptgs_5th = $this->mod_leave->insert('tpengajuancuti_pengganti', $dataPtgs);
            }

            $outstanding_tugas = $this->input->post('outstanding_tugas2');
            for ($i = 0; $i < count($outstanding_tugas); $i++) {
                $dataTgs = array(
                    'nopengajuancuti' => $autonumber,
                    'idx'        => $i,
                    'keterangan' => $outstanding_tugas[$i]
                );
                $save_jp_5th = $this->mod_leave->insert('tpengajuancuti_jobpending', $dataTgs);
            }

            if ($save_5th == true && $save_ptgs_5th == true && $save_jp_5th == true) {
                echo "Success";
            }
        }

        public function save_edit_cutibesar(){
            if ( $this->pregRepn($this->input->post('selama2_edit')) > 25 ) {
                echo "error";
                exit();
            }

            $nopengajuan = $this->input->post('nodoc');

            $dataCuti = array(
                'selama'          => $this->pregRepn($this->input->post('selama2_edit')), 
                'tanggal_mulai'   => $this->dateWest($this->input->post('tgl_awal2_edit')), 
                'tanggal_akhir'   => $this->dateWest($this->input->post('tgl_akhir2_edit')),
                'tanggal_bekerja' => $this->dateWest($this->input->post('tgl_kerja2_edit')),
                'validasi'        => 0,
                'kodest'          => $this->input->post('site2_edit'),
                'batal'           => 0,
                'KodeCT'          => '002',
                'Periode1'        => null,
                'periode2'        => null,
                'CutiThn'         => null
            );
            $save_5th = $this->mod_leave->edit_pengajuan($nopengajuan, $dataCuti);

            $nik = $this->pregRepn($this->input->post('ptgs_pengganti2_edit'));
            $delete_ptgs_first = $this->mod_leave->delete_petugas_pengganti($nopengajuan);
            for ($i = 0; $i < count($nik); $i++) {
                $dataPtgs = array(
                    'nopengajuancuti' => $nopengajuan,
                    'idx'  => $i,
                    'nik'  => $nik[$i],
                    'nama' => $this->mod_leave->getEmployeeName($nik[$i])->Nama
                );
                $save_ptgs_5th = $this->mod_leave->insert('tpengajuancuti_pengganti', $dataPtgs);
            }

            $outstanding_tugas = $this->input->post('outstanding_tugas2_edit_5th');
            $getIdx = $this->mod_leave->getIdxJobPending($nopengajuan);
            $idx    = $getIdx->idx + 1;
            if (count($outstanding_tugas) > 0 ) {
                for ($i = 0; $i < count($outstanding_tugas); $i++) {
                    $dataTgs = array(
                        'nopengajuancuti' => $nopengajuan,
                        'idx'        => $idx++,
                        'keterangan' => $outstanding_tugas[$i]
                    );
                    $save_jp_5th = $this->mod_leave->insert('tpengajuancuti_jobpending', $dataTgs);
                }
            } else {
                $save_jp_5th = true;
            }
            

            if ($save_5th == true && $save_ptgs_5th == true && $save_jp_5th == true) {
                echo "Success";
            }
        }

        public function save_cuti_melahirkan(){

            if ( $this->pregRepn($this->input->post('selama3')) > 45 ) {
                echo "error";
                exit();
            }

            $getAN      = $this->mod_leave->getATNpengajuan_cuti();
            $autonumber = $getAN->AutoNumber;

            $dataCuti = array(
                'nopengajuancuti' => $autonumber,
                'tanggal'         => date("Y-m-d"),
                'nik'             => $this->pregRepn($this->session->userdata('NIK')),
                'selama'          => $this->pregRepn($this->input->post('selama3')), 
                'tanggal_mulai'   => $this->dateWest($this->input->post('tgl_awal3')), 
                'tanggal_akhir'   => $this->dateWest($this->input->post('tgl_akhir3')),
                'tanggal_bekerja' => $this->dateWest($this->input->post('tgl_kerja3')),
                'validasi'        => 0,
                'kodest'          => $this->input->post('site3'),
                'batal'           => 0,
                'KodeCT'          => '003',
                'Periode1'        => null,
                'periode2'        => null,
                'CutiThn'         => null
            );
            $save_birth = $this->mod_leave->insert('tpengajuancuti', $dataCuti);

            $nik = $this->pregRepn($this->input->post('ptgs_pengganti3'));
            for ($i = 0; $i < count($nik); $i++) {
                $dataPtgs = array(
                    'nopengajuancuti' => $autonumber,
                    'idx'  => $i,
                    'nik'  => $nik[$i],
                    'nama' => $this->mod_leave->getEmployeeName($nik[$i])->Nama
                );
                $save_ptgs_birth = $this->mod_leave->insert('tpengajuancuti_pengganti', $dataPtgs);
            }

            $outstanding_tugas = $this->input->post('outstanding_tugas3');
            for ($i = 0; $i < count($outstanding_tugas); $i++) {
                $dataTgs = array(
                    'nopengajuancuti' => $autonumber,
                    'idx'        => $i,
                    'keterangan' => $outstanding_tugas[$i]
                );
                $save_jp_birth = $this->mod_leave->insert('tpengajuancuti_jobpending', $dataTgs);
            }

            if ($save_birth == true && $save_ptgs_birth == true && $save_jp_birth == true) {
                echo "Success";
            }
        }

        public function save_edit_cutimelahirkan(){

            if ( $this->pregRepn($this->input->post('selama3_edit')) > 45 ) {
                echo "error";
                exit();
            }

            $nopengajuan = $this->input->post('nodoc');
            $dataCuti = array(
                'selama'          => $this->pregRepn($this->input->post('selama3_edit')), 
                'tanggal_mulai'   => $this->dateWest($this->input->post('tgl_awal3_edit')), 
                'tanggal_akhir'   => $this->dateWest($this->input->post('tgl_akhir3_edit')),
                'tanggal_bekerja' => $this->dateWest($this->input->post('tgl_kerja3_edit')),
                'validasi'        => 0,
                'kodest'          => $this->input->post('site3_edit'),
                'batal'           => 0,
                'KodeCT'          => '003',
                'Periode1'        => null,
                'periode2'        => null,
                'CutiThn'         => null
            );
            $save_birth = $this->mod_leave->edit_pengajuan($nopengajuan, $dataCuti);

            $nik = $this->pregRepn($this->input->post('ptgs_pengganti3_edit'));
            $delete_ptgs_first = $this->mod_leave->delete_petugas_pengganti($nopengajuan);
            for ($i = 0; $i < count($nik); $i++) {
                $dataPtgs = array(
                    'nopengajuancuti' => $nopengajuan,
                    'idx'  => $i,
                    'nik'  => $nik[$i],
                    'nama' => $this->mod_leave->getEmployeeName($nik[$i])->Nama
                );
                $save_ptgs_birth = $this->mod_leave->insert('tpengajuancuti_pengganti', $dataPtgs);
            }

            $outstanding_tugas = $this->input->post('outstanding_tugas3_edit');
            $getIdx = $this->mod_leave->getIdxJobPending($nopengajuan);
            $idx    = $getIdx->idx + 1;
            if (count($outstanding_tugas) > 0 ) {
                for ($i = 0; $i < count($outstanding_tugas); $i++) {
                    $dataTgs = array(
                        'nopengajuancuti' => $nopengajuan,
                        'idx'        => $idx++,
                        'keterangan' => $outstanding_tugas[$i]
                    );
                    $save_jp_birth = $this->mod_leave->insert('tpengajuancuti_jobpending', $dataTgs);
                }
            } else {
                $save_jp_birth = true;
            }

            if ($save_birth == true && $save_ptgs_birth == true && $save_jp_birth == true) {
                echo "Success";
            }
        }

        public function delete_cuti(){
            $nopengajuancuti = $this->input->post('nopengajuancuti');
            $gdate           = substr($nopengajuancuti, 0,8);
            $gnumber         = substr($nopengajuancuti, 8);
            $nopengajuan     = 'CT/BSS/'.$gdate.'/'.$gnumber;
            $data            = array('batal' => 1);
            $delete_cuti     = $this->mod_leave->delete_cuti($nopengajuan, $data);
            echo json_encode($delete_cuti);
        } 

        public function delete_job_pending(){
            $nodoc     = $this->input->post('nodoc');
            $idx       = $this->input->post('idx');
            $delete_jp = $this->mod_leave->delete_job_pending($nodoc, $idx);
            echo json_encode($delete_jp);
        }

        public function getPtgscuti($nopengajuan){
            $nopengajuan = str_replace("-", "/", $nopengajuan);
            $getPtgscuti = $this->mod_leave->getPetugasPengganti($nopengajuan);
            echo json_encode($getPtgscuti);
        }

    }
?>