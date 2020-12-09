<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmasterpic extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmaster/mod_hr_masterpic', 'mod_master']);
        }

        public function table_master_pic(){
            $master_pic = $this->mod_hr_masterpic->get_datatables();
            $data       = array();
            $no         = $this->input->post('start');

            foreach ($master_pic as $field) {
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->pic_name;
                $row[]  = $field->pic_email;
                $row[]  = $field->pic_mobile;
                $row[]  = '<a href="#" class="btn btn-blue btn-xs" id="pdf'.$no.'">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="#" class="btn btn-red btn-xs" id="pdf'.$no.'">
                                <i class="fa fa-trash"></i>
                            </a>
                            ';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_masterpic->count_all(),
                 "recordsFiltered" => $this->mod_hr_masterpic->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function master_pic(){
            $data = array(
                'sheader'          => 'pages/ext/sheader',
                'sfooter'          => 'pages/ext/sfooter',
                'listpic'          => $this->mod_master->list_users(),
                'tahapanrekrut'    => $this->mod_hr_masterpic->tahapanrekrut(),
            );
            $this->load->view('pages/hr/vmaster/master_pic', $data);
        }

        public function addmaster_pic(){
            $users_id = $this->input->post('users_id');
            $rsinput  = $this->input->post('rs_id');

            $cekdatapicexistmpic   = $this->mod_hr_masterpic->cekdatapicexistmpic($users_id);
            $cekdatapicexistbridge = $this->mod_hr_masterpic->cekdatapicexistbridge($users_id);

            $getdatausers = $this->mod_hr_masterpic->getdatausers($users_id);
            $getdatapic   = $this->mod_hr_masterpic->getdatapic($users_id);
            
            $getsteppic   = $this->mod_hr_masterpic->getsteppic($users_id); //tanda tanya

            if ($cekdatapicexistmpic == null) {
                $datampic = array(
                    'user_id'    => $getdatausers->users_id,
                    'pic_name'   => $getdatausers->users_fullname,
                    'pic_mobile' => $getdatausers->users_mobile,
                    'pic_email'  => $getdatausers->users_email,
                    'pic_status' => 1
                );
                $insertdatampic = $this->mod_hr_masterpic->addmasterpic($datampic);

                $pic_id = $this->db->insert_id();
            
                for ($i = 0; $i < count($rsinput); $i++) {
                    $bridgestep = array(
                        'rs_id'             => $rsinput[$i],
                        'pic_id'            => $pic_id,
                        'bridge_p_r_status' => 1
                    );
                   $insertbridgestep = $this->mod_hr_masterpic->addmasterpicbridgestep($bridgestep);
                }

                if($insertdatampic == true){
                    echo "Success";
                } else {
                    echo "Error";
                }
            } elseif ($cekdatapicexistmpic !== null && $cekdatapicexistbridge == null) {

                for ($i = 0; $i < count($rsinput); $i++) {
                    $bridgestep = array(
                        'rs_id'             => $rsinput[$i],
                        'pic_id'            => $getdatapic->pic_id,
                        'bridge_p_r_status' => 1
                    );
                   $insertbridgestep = $this->mod_hr_masterpic->addmasterpicbridgestep($bridgestep);
                }

                if($insertbridgestep == true){
                    echo "Success";
                } else {
                    echo "Error";
                }
            } elseif ($cekdatapicexistmpic !== null && $cekdatapicexistbridge !== null) {
                $getpic_id = $this->mod_hr_masterpic->getpicid($users_id);
                $pic_id    = $getpic_id->pic_id;

                $dataoff      = array('bridge_p_r_status' => 0);

                $delbefore = $this->mod_hr_masterpic->delbeforedata($pic_id, $dataoff);

                $dataon      = array('bridge_p_r_status' => 1);

                for ($i = 0; $i < count($rsinput); $i++) {
                    $bridgestep = array(
                        'rs_id'             => $rsinput[$i],
                        'bridge_p_r_status' => 1
                    );
                   $insertbridgestep = $this->mod_hr_masterpic->addmasterpicbridgestep($bridgestep);
                }

                // foreach($getsteppic as $k=>$v) {
                //     $row[$k] = $v['rs_id'];
                // }
                
                // $count1 = count($row);
                // $count2 = count($rsinput);

                // $comparearray1 = array_diff($row, $rsinput);
                // $comparearray2 = array_diff($rsinput, $row);

                // $data1 = array('bridge_p_r_status' => 0);
                // $data2 = array('bridge_p_r_status' => 1); 

                // if ($count2 > $count1) {
                //     $usearray = $comparearray2;
                //     $usedata  = $data2;
                // } else {
                //     $usearray = $comparearray1;
                //     $usedata  = $data1;
                // }

                // for ($i=0; $i < count($usearray) ; $i++) {                           
                //     $delexistdata = $this->mod_hr_masterpic->delexistdata($pic_id, $usedata, $usearray[$i]);
                // }

                if($delexistdata == true){
                    echo "Success";
                } else {
                    echo "Error";
                }
            }
        }

        public function getStepSelection(){
            $data    = $this->input->post('users_id');
            $getstep = $this->mod_hr_masterpic->getStepSelection($data);

            $tahapanrekrut = $this->mod_hr_masterpic->tahapanrekrut();

            echo '<div name="users_id" id="tahapanseleksi">';
                        foreach ($tahapanrekrut as $row) {
                            echo '
                                <div class="checkbox" style="padding-left: 0px" >
                                    <label>
                                        <input name="rs_id[]" 
                            ';

                            foreach ($getstep as $key) {
                                if ($key->rs_name == $row->rs_name){
                                    echo 'checked';
                                    break;
                                }
                            }

                            echo ' type="checkbox" value="'.$row->rs_id.'" >
                                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    </label>
                                    <label style="padding-left: 10px">'.$row->rs_name.'</label>
                                </div>
                            ';
                        }
            echo '</div>';
        }

    }
?>