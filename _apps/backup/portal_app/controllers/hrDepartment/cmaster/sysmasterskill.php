<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmasterskill extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmaster/mod_hr_masterskill', 'mod_master']);
            $this->dtf_default = date("Y-m-d H:i:s");
        }

        public function table_master_skill(){
            $master_skill = $this->mod_hr_masterskill->get_datatables();
            $data         = array();
            $no           = $this->input->post('start');

            foreach ($master_skill as $field) {
                $jabatan = ($field->Nama == null) ? "Seluruh Jabatan" : $field->Nama;
                $status  = ($field->skill_status == 1) ? "Aktif" : "Non-Aktif";
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->skill_name;
                $row[]  = $jabatan;
                $row[]  = $status;
                $row[]  = ' 
                            <button type="button" class="btn btn-blue btn-xs" data-toggle="modal" data-target="#modal-edit-skill" data-skill_id="'.$field->skill_id.'" data-skill_name="'.$field->skill_name.'" data-status="'.$field->skill_status.'" data-jabatan="'.$jabatan.'" id="ubah'.$no.'">
                                <i class="fa fa-edit"></i>
                            </button>';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_masterskill->count_all(),
                 "recordsFiltered" => $this->mod_hr_masterskill->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function master_skill(){
            $data = array(
                'sheader'       => 'pages/ext/sheader',
                'sfooter'       => 'pages/ext/sfooter',
                'totalskill'    => $this->mod_hr_masterskill->totalskill(),
                'totalskillall' => $this->mod_hr_masterskill->count_all(),
                'listjabatan'   => $this->mod_master->list_jabatan(),
            );
            $this->load->view('pages/hr/vmaster/master_skill', $data);
        }

        public function addmaster_skill(){
            $jabatan    = $this->input->post('KodeJB');
            $skillinput = $this->input->post('skill_name');

            for ($i = 0; $i < count($skillinput); $i++) :
                $reform_two = str_replace(" ", "-", $skillinput);
                $skill = array(
                    'skill_name'   => $skillinput[$i],
                    'skill_alias'  => strtolower($reform_two[$i]),
                    'skill_status' => 1,
                    'date_create'  => $this->dtf_default
                );
               $insertskill = $this->mod_hr_masterskill->addmasterskill($skill);
            endfor;

            $query = $this->db->select('skill_id')->from('skill')->where('date_create', $this->dtf_default)->get()->result();

            foreach ($query as $row) {
                $skillbridge = array(
                    'skill_id' => $row->skill_id,
                    'KodeJB'   => $jabatan
                );
                $insertskillbridge = $this->mod_hr_masterskill->addmasterskillbridge($skillbridge);
            }
                
            if($insertskill == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function edit_skill(){
            $reform         = str_replace(" ", "-", $this->input->post('skill_name'));
            $skill_id       = $this->input->post('skill_id');
            $users_id       = $this->session->userdata('users_id');
            $users_username = $this->session->userdata('username');
            $users_fullname = $this->session->userdata('fullname');

            $data = array(
                'skill_name'   => $this->input->post('skill_name'),
                'skill_alias'  => strtolower($reform),
                'skill_status' => $this->input->post('skill_status')
            );
            $updateskill = $this->mod_hr_masterskill->update_skill($skill_id, $data);

            $datos = array(
                'logs_tanggal'    => date('Y-m-d H:i:s'),
                'logs_ip'         => $this->input->ip_address(),
                'logs_modul'      => 'SECTION',
                'logs_aktifitas'  => 'UPDATE',
                'logs_keterangan' => 'Merubah data skill '.$this->input->post('skill_name'),
                'logs_user_id'    => $users_id,
                'logs_username'   => $users_username,
                'logs_user_name'  => $users_fullname,
                'logs_website'    => 'BSS PORTAL'
            );
            $this->mod_hr_masterskill->insertLogs($datos);

            if ($updateskill == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>