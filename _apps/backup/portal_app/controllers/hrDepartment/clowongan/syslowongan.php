<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslowongan extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mlowongan/mod_hr_lowongan','hrDept/mod_hr_dashboard', 'mod_master','hrDept/mod_hr_global']);
        }

        public function table_lowongan_all(){
            $lowongan_all = $this->mod_hr_lowongan->get_datatables();
            $data         = array();
            $no           = $this->input->post('start');

            foreach ($lowongan_all as $field) {
                $status = ($field->lowongan_status == 1) ? "BUKA" : "TUTUP";

                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->lowongan_id;
                $row[]  = $field->kode_lowongan;
                $row[]  = $field->Nama;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->jml_rekrut;
                $row[]  = date_indo($field->tgl_open);
                $row[]  = $status;
                $row[]  = ' <a onClick="ajax_load(\''.site_url().'detailLowongan/'.$field->lowongan_id.'/'.strtolower($field->kode_lowongan).'\')" class="btn btn-primary btn-xs" id="detail'.$no.'">
                                <i class="fa fa-search"></i>
                            </a>
                            <a onClick="ajax_load(\''.site_url().'editLowongan/'.$field->lowongan_id.'/'.strtolower($field->KodeJB).'\');" class="btn btn-orange btn-xs" id="ubah'.$no.'">
                                <i class="far fa-edit"></i>
                            </a>
                            <a onClick="nonaktifloker('.$field->lowongan_id.')" class="nonaktif btn btn-red btn-xs" id="hapus'.$no.'">
                                <i class="far fa-minus-square"></i>
                            </a>
                            ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_lowongan->count_all(),
                "recordsFiltered" => $this->mod_hr_lowongan->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function lowongan(){
            $data = array(
                'sheader'          => 'pages/ext/sheader',
                'sfooter'          => 'pages/ext/sfooter',
                'city'             => $this->mod_master->city(),
                'listjabatan'      => $this->mod_master->list_jabatan(),
                'lowonganaktif'    => $this->mod_hr_dashboard->getlowongantotal(),
                'lowongannonaktif' => $this->mod_hr_dashboard->getlowongantotalnonaktif(),
                'totalLoker'       => $this->mod_hr_lowongan->count_all(),
            );
            $this->load->view('pages/hr/vlowongan/lowongan', $data);
        }
        
        public function add_lowongan(){
            $users = $this->session->userdata('users_id');
            $data = array(
                'sheader'     => 'pages/ext/sheader',
                'sfooter'     => 'pages/ext/sfooter',
                'listjabatan' => $this->mod_master->list_jabatan(),
                'msyarat'     => $this->mod_hr_lowongan->syarat_wajiblist(),
                'detailuser'  => $this->mod_hr_global->detailuser($users),
            );
            $this->load->view('pages/hr/vlowongan/add_lowongan', $data);
        }

        public function edit_lowongan($lowongan_id){
            $KodeJB = $this->uri->segment(3);
            $users  = $this->session->userdata('users_id');
            $data = array(
                'sheader'     => 'pages/ext/sheader',
                'sfooter'     => 'pages/ext/sfooter',
                'detailuser'  => $this->mod_hr_global->detailuser($users),
                'listjabatan' => $this->mod_master->list_jabatan(),
                'msyarat'     => $this->mod_hr_lowongan->syarat_wajiblist(),
                'dloker'      => $this->mod_hr_lowongan->detail_loker($lowongan_id),
                'deduc'       => $this->mod_hr_lowongan->detail_education($lowongan_id),
                'meduc'       => $this->mod_hr_lowongan->master_education(),
                
                'mskillumum'  => $this->mod_hr_lowongan->master_skillumum(),
                'dskillumum'  => $this->mod_hr_lowongan->detail_skillumum($lowongan_id),
                'mskillreq'   => $this->mod_hr_lowongan->master_skillreq($KodeJB),
                'dskillreq'   => $this->mod_hr_lowongan->detail_skillreq($lowongan_id),
                
                'msertumum'   => $this->mod_hr_lowongan->master_sertifikatumum(),    
                'dsertumum'   => $this->mod_hr_lowongan->detail_sertifikatumum($lowongan_id),
                'msertreq'    => $this->mod_hr_lowongan->master_sertifikatreq($KodeJB),
                'dsertreq'    => $this->mod_hr_lowongan->detail_sertifikatreq($lowongan_id),
                
                'msyaratumum' => $this->mod_hr_lowongan->master_syaratumum(),    
                'dsyaratumum' => $this->mod_hr_lowongan->detail_syaratumum($lowongan_id),
                'msyaratreq'  => $this->mod_hr_lowongan->master_syaratreq($KodeJB),
                'dsyaratreq'  => $this->mod_hr_lowongan->detail_syaratreq($lowongan_id),
            );
            $this->load->view('pages/hr/vlowongan/edit_lowongan', $data);
        }

        public function nonaktifloker($lowongan_id){
            $lowongan_id       = $this->input->post('lowongan_id');
            $data              = array('lowongan_status' => 0);
            $updatestatusloker = $this->mod_hr_lowongan->update_statusloker($lowongan_id, $data);
            echo json_encode($updatestatusloker);
        } 

        public function getSkill(){
            $data     = $this->input->post('skill');
            $getskill = $this->mod_hr_lowongan->getSkill($data);

            echo '<div name="skill_id" id="skill">';
                    if ($getskill) {
                        foreach ($getskill as $row) {
                            echo '<div class="checkbox" style="padding-left: 0px">
                                        <label>
                                            <input name="skill_id[]" type="checkbox" value="'.$row->skill_id.'">
                                            <span class="cr" style="border: 1px solid #FFF;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        </label>
                                        <label style="padding-left: 10px">'.$row->skill_name.'</label>
                                    </div>';
                        }
                    } else {
                        echo '<label>Tidak ada data skill yang sesuai dengan jabatan ini</label>';
                    }
            echo '</div>';
        }

        public function getSertifikat(){
            $data          = $this->input->post('sertifikat');
            $getsertifikat = $this->mod_hr_lowongan->getSertifikat($data);

            echo '<div name="certificate_id" id="sertifikat">';
                    if ($getsertifikat) {
                        foreach ($getsertifikat as $row) {
                            echo '<div class="checkbox" style="padding-left: 0px">
                                        <label>
                                            <input name="certificate_id[]" type="checkbox" value="'.$row->certificate_id.'">
                                            <span class="cr" style="border: 1px solid #FFF;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        </label>
                                        <label style="padding-left: 10px">'.$row->certificate_name.'</label>
                                    </div>';
                        }
                    } else {
                        echo '<label>Tidak ada data sertifikat yang sesuai dengan jabatan ini</label>';
                    }
            echo '</div>';
        }

        public function getSyarat(){
            $data      = $this->input->post('syarat');
            $getsyarat = $this->mod_hr_lowongan->getSyarat($data);

            echo '<div name="syarat_id" id="syarat">';
                    if ($getsyarat) {
                        foreach ($getsyarat as $row) {
                            echo '<div class="checkbox" style="padding-left: 0px">
                                        <label>
                                            <input name="syarat_id[]" type="checkbox" value="'.$row->syarat_id.'">
                                            <span class="cr" style="border: 1px solid #FFF;"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                        </label>
                                        <label style="padding-left: 10px">'.$row->syarat_name.'</label>
                                    </div>';
                        }
                    } else {
                        echo '<label>Tidak ada data syarat yang sesuai dengan jabatan ini</label>';
                    }
            echo '</div>';
        }

        public function checkloker(){
            $loker  = $this->input->post('jabatan_alias');
            $query  = $this->mod_hr_lowongan->checkloker($loker); 
            $status = "true";
            if($query):
               echo $status = "false";
            else :             
                echo $status; 
            endif;
        }

        public function addlowongan_new(){

            $jabatan         = $this->input->post('jabatan_alias'); //KodeJB
            $getjabatanalias = $this->mod_hr_lowongan->getjabatanalias($jabatan); //jabatan_alias

            $mingaji         = $this->input->post('min_salary');
            $maxgaji         = $this->input->post('max_salary');
            $exp             = $this->input->post('experience');
            $edulist         = $this->input->post('edutype_id');
            $daftarskill     = $this->input->post('skill_id');
            $certificatelist = $this->input->post('certificate_id');
            $syaratlist      = $this->input->post('syarat_id');

            $min_salary = (empty($mingaji)) ? 0 : $mingaji;
            $max_salary = (empty($maxgaji)) ? 0 : $maxgaji;
            $experience = (empty($exp)) ? 0 : $exp;
            
            $cekeksisloker = $this->mod_hr_lowongan->cekeksisloker($jabatan);

            if ($jabatan == $cekeksisloker->KodeJB) {
                echo "Error";
                exit();
            }

            $data = array(
                'KodeJB'             => $this->input->post('KodeJB'),
                'KodeDP'             => $this->input->post('KodeDP'),
                'kode_lowongan'      => $this->input->post('kode_lowongan'),
                'jabatan_alias'      => strtoupper($getjabatanalias->Nama),
                'jenis_kelamin'      => $this->input->post('jenis_kelamin'),
                'min_usia'           => $this->input->post('min_usia'),
                'max_usia'           => $this->input->post('max_usia'),
                'min_salary'         => $min_salary,
                'max_salary'         => $max_salary,
                'experience'         => $experience,
                'experience_subject' => $this->input->post('experience_subject'),
                'edu_jurusan'        => $this->input->post('edu_jurusan'),
                'jml_rekrut'         => $this->input->post('jml_rekrut'),
                'tgl_open'           => $this->input->post('tgl_open'),
                'tgl_close'          => $this->input->post('tgl_close'),
                'job_desc'           => $this->input->post('job_desc'),
                'date_create'        => $this->dtf_default,
                'lowongan_status'    => 1
            );
            $insertloker = $this->mod_hr_lowongan->addlowongan_new($data);

            $lowongan_id = $this->db->insert_id();

            for ($i = 0; $i < count($edulist); $i++) :
               $edu = array(
                    'edutype_id'    => $edulist[$i],
                    'lowongan_id'   => $lowongan_id,
                    'edureq_status' => 1
                );
               $insertedu = $this->mod_hr_lowongan->addedureqloker($edu);
            endfor;

            for ($i = 0; $i < count($daftarskill); $i++) :
               $skill = array(
                    'skill_id'      => $daftarskill[$i],
                    'lowongan_id'   => $lowongan_id,
                    'skillreq_status' => 1
                );
               $insertskill = $this->mod_hr_lowongan->addskillreqloker($skill);
            endfor;

            for ($i = 0; $i < count($certificatelist); $i++) :
               $certificate = array(
                    'certificate_id'        => $certificatelist[$i],
                    'lowongan_id'           => $lowongan_id,
                    'certificatereq_status' => 1
                );
               $insertcertificate = $this->mod_hr_lowongan->addcertificatereqloker($certificate);
            endfor;

            for ($i = 0; $i < count($syaratlist); $i++) :
                $syarat = array(
                    'syarat_id'        => $syaratlist[$i],
                    'lowongan_id'      => $lowongan_id,
                    'syaratreq_status' => 1
                );
               $insertsyarat = $this->mod_hr_lowongan->addsyaratreqloker($syarat);
            endfor;

            if($insertloker == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function simpan_editlowongan(){
            $lowongan_id     = $this->input->post('lowongan_id');
            $jabatan         = $this->input->post('jabatan_alias');
            $mingaji         = $this->input->post('min_salary');
            $maxgaji         = $this->input->post('max_salary');
            $exp             = $this->input->post('experience');
            $edulist         = $this->input->post('edutype_id');
            $daftarskill     = $this->input->post('skill_id');
            $certificatelist = $this->input->post('certificate_id');
            $syaratlist      = $this->input->post('syarat_id');

            $min_salary = (empty($mingaji)) ? 0 : $mingaji;
            $max_salary = (empty($maxgaji)) ? 0 : $maxgaji;
            $experience = (empty($exp)) ? 0 : $exp;

            $data = array(
                'KodeJB'             => $this->input->post('KodeJB'),
                'KodeDP'             => $this->input->post('KodeDP'),
                'kode_lowongan'      => $this->input->post('kode_lowongan'),
                'jabatan_alias'      => strtoupper($jabatan),
                'jenis_kelamin'      => $this->input->post('jenis_kelamin'),
                'min_usia'           => $this->input->post('min_usia'),
                'max_usia'           => $this->input->post('max_usia'),
                'min_salary'         => $min_salary,
                'max_salary'         => $max_salary,
                'experience'         => $experience,
                'experience_subject' => $this->input->post('experience_subject'),
                'edu_jurusan'        => $this->input->post('edu_jurusan'),
                'jml_rekrut'         => $this->input->post('jml_rekrut'),
                'tgl_open'           => $this->input->post('tgl_open'),
                'tgl_close'          => $this->input->post('tgl_close'),
                'job_desc'           => $this->input->post('job_desc'),
                'date_create'        => date("Y-m-d H:i:s"),
                'lowongan_status'    => $this->input->post('lowongan_status'),
            );
            $insertloker = $this->mod_hr_lowongan->simpan_editlowongan($lowongan_id, $data);

            $deletedu  = $this->mod_hr_lowongan->delete_edureqloker($lowongan_id);
            for ($i = 0; $i < count($edulist); $i++) :
               $edu = array(
                    'edutype_id'    => $edulist[$i],
                    'lowongan_id'   => $lowongan_id,
                    'edureq_status' => 1
                );
               $insertedu = $this->mod_hr_lowongan->addedureqloker($edu);
            endfor;

            $deleteskill  = $this->mod_hr_lowongan->delete_skillreqloker($lowongan_id);
            for ($i = 0; $i < count($daftarskill); $i++) :
               $skill = array(
                    'skill_id'      => $daftarskill[$i],
                    'lowongan_id'   => $lowongan_id,
                    'skillreq_status' => 1
                );
               $insertskill = $this->mod_hr_lowongan->addskillreqloker($skill);
            endfor;

            $deletesert  = $this->mod_hr_lowongan->delete_sertreqloker($lowongan_id);
            for ($i = 0; $i < count($certificatelist); $i++) :
               $certificate = array(
                    'certificate_id'        => $certificatelist[$i],
                    'lowongan_id'           => $lowongan_id,
                    'certificatereq_status' => 1
                );
               $insertcertificate = $this->mod_hr_lowongan->addcertificatereqloker($certificate);
            endfor;

            $deletesyar  = $this->mod_hr_lowongan->delete_syareqloker($lowongan_id);    
            for ($i = 0; $i < count($syaratlist); $i++) :
                $syarat = array(
                    'syarat_id'        => $syaratlist[$i],
                    'lowongan_id'      => $lowongan_id,
                    'syaratreq_status' => 1
                );
                
                $insertsyarat = $this->mod_hr_lowongan->addsyaratreqloker($syarat);
            endfor;
            
            // && $insertedu == true && $insertskill == true && insertcertificate == true && insertsyarat == true

            if($insertloker == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

    }
?>