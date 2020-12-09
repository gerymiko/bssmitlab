<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syskirimsmsmedical extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/kirimsms/mod_kirimsms_medical', 'hrDept/mod_hr_global', 'hrDept/mod_hr_sms', 'mod_master']);
        }

        public function table_kirimsms_medical(){
            $pelamar_medical = $this->mod_kirimsms_medical->get_datatables();
            $data            = array();
            $no              = $this->input->post('start');

            foreach ($pelamar_medical as $field) {
                $pelamar_id      = $field->pelamar_id;
                $status_kirimsms = $this->mod_kirimsms_medical->status_kirimsms($pelamar_id);

                if ($status_kirimsms == true) {
                    $statuskirimsms = '<p class="green">Pesan telah dikirim</p>';
                    $disabled = 'disabled';
                } else {
                    $statuskirimsms = 'Pesan belum dikirim';
                    $disabled = '';
                } 

                $no++;
                $dateborn  = $field->people_birth_date;    
                $date      = new DateTime($dateborn);
                $now       = new DateTime();
                $interval  = $date->diff($now);
                $usia      = $interval->format("%y Tahun");
                
                $condition = ($field->freshgraduate == 0) ? '<i class="fa fa-minus red"></i>' : '<i class="fa fa-check green"></i>';
                $nama      = ucfirst($field->people_firstname).' '.$field->people_middlename.' '.$field->people_lastname;

                $tglamar = date("Y-m-d", strtotime($field->tgl_melamar));
                if ($tglamar == date("Y-m-d")) {
                    $new = " <span class='badge badge-secondary badge-roundless'>Baru</span>";
                } else {
                    $new = "";
                }

                $row    = array();
                $row[]  = $no;
                $row[]  = $field->people_id;
                $row[]  = "
                        <div class='checkbox'>
                            <label>
                                <input type='checkbox' ".$disabled." name='people_id' id='people_id' value='".$field->people_id."'>
                                <span class='cr'><i class='cr-icon glyphicon glyphicon-ok'></i></span>
                            </label>
                        </div>
                        <input type='hidden' name='people_name' id='people_name' class='people_name' value='".$field->people_firstname." ".$field->people_middlename." ".$field->people_lastname."'>
                        <input type='hidden' name='pelamar_id' id='pelamar_id' value='".$field->pelamar_id."'>
                        <input type='hidden' name='people_mobile' id='people_mobile' value='".$field->people_mobile."'>
                        ";
                $row[]  = $nama.$new;
                $row[]  = $condition;
                $row[]  = $usia;
                $row[]  = $field->jabatan_alias;
                $row[]  = $field->registrant_kode;
                $row[]  = $field->city_name;
                $row[]  = date("d/m/Y", strtotime($field->tgl_melamar));
                $row[]  = $statuskirimsms;
                $row[]  = ' <a onClick="ajax_load(\''.site_url().'detailPeople/'.$field->people_id.'/'.$field->registrant_kode.'\')" class="btn btn-warning btn-xs" id="detail'.$no.'">
                                <i class="fa fa-user"></i>
                            </a>
                            <a target="_blank" href="'.site_url().'downloadPdf/'.$field->people_id.'" class="btn btn-primary btn-xs" id="pdf'.$no.'">
                                <i class="fa fa-file-pdf"></i>
                            </a>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_kirimsms_medical->count_all(),
                "recordsFiltered" => $this->mod_kirimsms_medical->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function kirimsms_medical(){
            $data = array(
                'sheader'         => 'pages/ext/sheader',
                'sfooter'         => 'pages/ext/sfooter',
                'site'            => $this->mod_master->site(),
                'city'            => $this->mod_master->city(),
                'klinik'          => $this->mod_master->clinic(),
                'totalPelamarMcu' => $this->mod_kirimsms_medical->count_all()
            );
            $this->load->view('pages/hr/kirimsms/kirimsms_medical', $data);
        }

        public function kirimsmspelamar(){
            $data          = array();
            $konten        = array();
            $people_id     = explode(',',$this->input->post('people_id'));
            $pelamar_id    = explode(',',$this->input->post('pelamar_id'));
            $people_mobile = explode(',',$this->input->post('people_mobile'));
            $total         = count($people_id);
            
            $sub1          = $this->input->post('schedule_date1'); //date
            $date          = date("Y-m-d", strtotime($sub1)); //date reformat
            
            $sub2          = $this->input->post('schedule_date2'); //time
            $str1          = substr($sub2,0,5);
            $str2          = substr($sub2,8,10);
            $timesms       = $str1.$str2;
            
            $dateuse       = date("d-m-Y", strtotime($date)); //date reformat
            
            $search1       = ' AM';
            $search2       = ' PM';
            
            $time1         = str_replace($search1, '', $sub2);
            $time2         = str_replace($search2, '', $sub2);

            if (strpos($sub2, $search1)) {
                $timeuse = $time1;
            } else {
                $timeuse = $time2;
            }

            $rs_id     = $this->input->post('rs_id');
            $getmsg    = $this->mod_kirimsms_medical->getcontentmsg();
            $location  = $this->input->post('clinic_name');

            $clinic_id = $this->input->post('klinik');
            $alamat    = $this->input->post('alamat');
            $address   = "";
            
            $getclinic = $this->mod_kirimsms_medical->get_clinic($clinic_id);

            for($i=0; $i < $total; $i++){
                if($people_id[$i] != '') {
                    $getname = $this->mod_master->getnamepeople($people_id[$i]);
                    $ped     = date('ymd', strtotime($timeuse));
                    $number  = $this->mod_kirimsms_medical->get_mcu_number('BSS-MCU-'.$ped);
                    if ($number) {
                        $temps  = substr($number->patient_m_number, 14);
                        $tempid = $temps + 1;
                        $id_mcu = 'BSS-MCU-'.$ped.str_pad($tempid, 3, "0", STR_PAD_LEFT);
                    } else {
                        $id_mcu = 'BSS-MCU-'.$ped.'001';
                    }
                    
                    $msgcontent = $getmsg->doc_content;
                    $target     = ["--nama--", "--noreg--","--tgl--", "--jam--", "--klinik--", "--alamat--"];
                    $replace    = [ucfirst($getname->people_firstname), $id_mcu, $dateuse, $timesms, $getclinic->clinic_name, $address];
                    $content    = str_replace($target, $replace, $msgcontent);
                    
                    $getPJV     = $this->mod_kirimsms_medical->getPJVPelamar($pelamar_id[$i]);
                    $jv_id      = $getPJV->jv_id;

                    $data = array(
                        'pelamar_id'        => $pelamar_id[$i],
                        'people_id'         => $people_id[$i],
                        'rs_id'             => $rs_id,
                        'bridge_p_r_id'     => 0,
                        'schedule_msg'      => $content,
                        'schedule_location' => $this->input->post('city_id'),
                        'schedule_date'     => $date.' '.$timeuse,
                        'schedule_status'   => 2,
                    );
                    $insertstatus = $this->mod_hr_global->kirimsmspeserta($data);

                    $konten[]     = array('NOM' => $people_mobile[$i], 'MSG' => $content);
                    $sendsms      = $this->mod_hr_sms->sendsms($konten[$i]);
                    
                    $pjv[]        = array('mcu' => 2);
                    $updatestatus = $this->mod_kirimsms_medical->update_status_pjv($jv_id, $pjv[$i]);

                    $pasien = array(
                        'clinic_id'            => $getclinic->clinic_id,
                        'pelamar_id'           => $pelamar_id[$i],
                        'patient_m_number'     => $id_mcu,
                        'patient_m_date'       => date("Y-m-d", strtotime($timeuse)),
                        'patient_m_type'       => 'karir',
                        'patient_m_status'     => 1,
                        'patient_m_created_at' => date("Y-m-d H:i:s"),
                        'patient_m_created_by' => $this->session->userdata('username')
                    );
                    $insertpasien = $this->mod_kirimsms_medical->insertpasienmcu($pasien);

                    $site = array(
                        'KodeST' => $this->input->post('KodeST')
                    );
                    $updatesite = $this->mod_kirimsms_medical->update_site($pelamar_id[$i], $site);

                }
            }

            if($insertstatus == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function getaddressclinic(){
            $clinic_id  = $this->input->post('caddress');
            $getaddress = $this->mod_kirimsms_medical->get_clinic($clinic_id);

            echo '
                <div class="form-group">
                    <label><strong>Alamat :</strong></label>
                    <textarea rows="3" name="alamat" class="form-control">'.$getaddress->clinic_address.'</textarea>
                </div>
            ';
        }
    }
?>