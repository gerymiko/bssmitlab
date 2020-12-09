<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysjabatan extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mjabatan/mod_hr_jabatan']);
            // $this->output->enable_profiler(true);
        }

        function jabatan(){
            $data = array(
                'sheader'      => 'pages/ext/sheader',
                'sfooter'      => 'pages/ext/sfooter',
                'totalJabatan' => $this->mod_hr_jabatan->count_all(),
                'listdept'     => $this->mod_hr_jabatan->list_dept(),
                'listjabatan'  => $this->mod_hr_jabatan->getJabatan(),
            );
            $this->load->view('pages/hr/vjabatan/jabatan',$data);
        }

        public function table_jabatan(){
            $jabatan = $this->mod_hr_jabatan->get_datatables();
            $data    = array();
            $no      = $this->input->post('start');

            foreach ($jabatan as $field) {
                $status = ($field->status_jabatan == 1) ? "Aktif" : "Non-Aktif";

                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->KodeDP;
                $row[]  = $field->KodeJB;
                $row[]  = $field->Nama;
                $row[]  = $status;
                $row[]  = ' <button data-toggle="modal" data-target="#modal-edit-jabatan" class="btn btn-red btn-xs" id="ubah'.$no.'" data-kodedp="'.$field->KodeDP.'" data-kodepake="'.$field->KodeJB.'" data-kodejb="'.$field->KodeJB.'" data-nama="'.$field->Nama.'" data-status="'.$field->status_jabatan.'">
                                <i class="fa fa-edit"></i>
                            </button>
                            ';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_jabatan->count_all(),
                 "recordsFiltered" => $this->mod_hr_jabatan->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function add_jabatan(){
            $data = array(
                'KodeDP' => $this->input->post('KodeDP'),
                'KodeJB' => $this->input->post('KodeJB'),
                'Nama'   => $this->input->post('Nama'),
                'status_jabatan' => 1,
            );
            $insertjb = $this->mod_hr_jabatan->add_jabatan($data);
            if ($insertjb == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function edit_jabatan(){
            $KodeJB = $this->input->post('KodeJB');
            $data = array(
                'KodeDP'         => $this->input->post('KodeDP'),
                'Nama'           => $this->input->post('Nama'),
                'status_jabatan' => $this->input->post('status_jabatan')
            );
            $updatejab = $this->mod_hr_jabatan->edit_jabatan($KodeJB, $data);
            if ($updatejab == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function get_tahapantes(){
            $KodeJB  = $this->input->post('jabatan');
            $getstep = $this->mod_hr_jabatan->get_tahapantes($KodeJB);

            $tahapanrekrut = $this->mod_hr_jabatan->tahapanrekrut();

            echo '<div name="jabatan" id="tahapantes">';
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

        public function simpan_tahapanseleksi(){
            $KodeJB  = $this->input->post('jabatan');
            $rsinput = $this->input->post('rs_id');

            $getstepjabatan = $this->mod_hr_jabatan->getstep(); 

            $row = array();

            foreach($getstepjabatan as $k => $v) {
                array_push($row, $v['rs_id']);
            }

            $comparearray1 = array_values(array_diff($row, $rsinput));            

            for ($i = 0; $i < count($rsinput); $i++) {
                $bridgestep = array(
                    'bridge_j_r_status' => 1
                );
                $updatejrstep = $this->mod_hr_jabatan->update_jrstep($KodeJB, $bridgestep, $rsinput[$i]);
            }

            for ($z = 0; $z < count($comparearray1); $z++) {
                $bridgestepnew = array(
                    'bridge_j_r_status' => 0, 
                );
                $updatejrstepnew = $this->mod_hr_jabatan->update_jrstepnew($KodeJB, $bridgestepnew, $comparearray1[$z]);
            }

            if($updatejrstep == true && $updatejrstepnew == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>