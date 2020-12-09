<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syskirimsmspraktek extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/kirimsms/mod_kirimsms_praktek', 'hrDept/mod_hr_global', 'hrDept/mod_hr_sms', 'mod_master']);
        }

        public function table_kirimsms_praktek(){
            $pelamar_praktek = $this->mod_kirimsms_praktek->get_datatables();
            $data            = array();
            $no              = $this->input->post('start');

            foreach ($pelamar_praktek as $field) {
                $pelamar_id      = $field->pelamar_id;
                $status_kirimsms = $this->mod_kirimsms_praktek->status_kirimsms($pelamar_id);

                if ($status_kirimsms == true) {
                    $statuskirimsms = '<p class="green">Pesan telah dikirim</p>';
                    $disabled = 'disabled';
                } else {
                    $statuskirimsms = 'Pesan belum dikirim';
                    $disabled = '';
                }

                $no++;
                $dateborn = $field->people_birth_date;    
                $date     = new DateTime($dateborn);
                $now      = new DateTime();
                $interval = $date->diff($now);
                $usia     = $interval->format("%y Tahun");

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
                                <input type='checkbox' name='people_id' ".$disabled." id='people_id' value='".$field->people_id."'>
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
                "recordsTotal"    => $this->mod_kirimsms_praktek->count_all(),
                "recordsFiltered" => $this->mod_kirimsms_praktek->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function kirimsms_praktek(){
            $data = array(
                'sheader'             => 'pages/ext/sheader',
                'sfooter'             => 'pages/ext/sfooter',
                'city'                => $this->mod_master->city(),
                'pic_praktek'         => $this->mod_kirimsms_praktek->pic_praktek(),
                'totalPelamarPraktek' => $this->mod_kirimsms_praktek->count_all()
            );
            $this->load->view('pages/hr/kirimsms/kirimsms_praktek', $data);
        }

        public function kirimsmspelamar(){
            $data          = array();
            $konten        = array();
            $people_id     = explode(',',$this->input->post('people_id'));
            $pelamar_id    = explode(',',$this->input->post('pelamar_id'));
            $people_mobile = explode(',',$this->input->post('people_mobile'));
            $temp          = count($people_id);
            
            $sub1       = $this->input->post('schedule_date1'); //date
            $date       = date("Y-m-d", strtotime($sub1)); //date reformat
            
            $sub2       = $this->input->post('schedule_date2'); //time
            $str1       = substr($sub2,0,5);
            $str2       = substr($sub2,8,10);
            $timesms    = $str1.$str2;

            $dateuse    = date("d-m-Y", strtotime($date)); //date reformat
            
            $search1    = ' AM';
            $search2    = ' PM';
            
            $time1      = str_replace($search1, '', $sub2);
            $time2      = str_replace($search2, '', $sub2);

            if (strpos($sub2, $search1)) {
                $timeuse = $time1;
            } else {
                $timeuse = $time2;
            }

            $pic_praktek   = $this->input->post('pic_praktek');
            $rs_id        = $this->input->post('rs_id');
            $cekstatuspic = $this->mod_kirimsms_praktek->cekstatuspic($pic_praktek, $rs_id);
            $getmsg       = $this->mod_kirimsms_praktek->getcontentmsg();
            $location     = $this->input->post('schedule_location');
            $lokasi       = $this->mod_master->city_id($location);

            for($i=0; $i < $temp; $i++){
                if($people_id[$i]!= '') {
                    $getname    = $this->mod_master->getnamepeople($people_id[$i]);
                    
                    $msgcontent = $getmsg->doc_content;
                    $target     = ["--nama--", "--tgl--", "--jam--", "--site--"];
                    $replace    = [ucfirst($getname->people_firstname), $dateuse, $timesms, $lokasi->city_name];
                    $content    = str_replace($target, $replace, $msgcontent);

                    $data[] = array(
                        'pelamar_id'        => $pelamar_id[$i],
                        'people_id'         => $people_id[$i],
                        'rs_id'             => $rs_id,
                        'bridge_p_r_id'     => $cekstatuspic->bridge_p_r_id,
                        'schedule_msg'      => $content,
                        'schedule_location' => $location,
                        'schedule_date'     => $date.' '.$timeuse,
                        'schedule_status'   => 2,
                    );
                    $insertstatus = $this->mod_hr_global->kirimsmspeserta($data[$i]);

                    $konten[] = array(
                        'NOM' => $people_mobile[$i],
                        'MSG' => $content
                    );
                    $sendsms = $this->mod_hr_sms->sendsms($konten[$i]);
                }
            }

            if($insertstatus == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>