<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmastersyarat extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmaster/mod_hr_mastersyarat', 'mod_master']);
            $this->dtf_default = date("Y-m-d H:i:s");
        }

        public function table_master_syarat(){
            $master_syarat = $this->mod_hr_mastersyarat->get_datatables();
            $data          = array();
            $no            = $this->input->post('start');

            foreach ($master_syarat as $field) {

                $jabatan = ($field->Nama == null) ? "Seluruh Jabatan" : $field->Nama;
                $status  = ($field->syarat_status == 1) ? "Aktif" : "Non-Aktif";
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->syarat_name;
                $row[]  = $jabatan;
                $row[]  = $status;
                $row[]  = '
                            <button type="button" class="btn btn-blue btn-xs" data-toggle="modal" data-target="#modal-edit-syarat" data-id="'.$field->syarat_id.'" data-name="'.$field->syarat_name.'" data-status="'.$field->syarat_status.'" data-jabatan="'.$jabatan.'" id="ubah'.$no.'">
                                <i class="fa fa-edit"></i>
                            </button>';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_hr_mastersyarat->count_all(),
                "recordsFiltered" => $this->mod_hr_mastersyarat->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function master_syarat(){
            $data = array(
                'sheader'     => 'pages/ext/sheader',
                'sfooter'     => 'pages/ext/sfooter',
                'listjabatan' => $this->mod_master->list_jabatan(),
            );
            $this->load->view('pages/hr/vmaster/master_syarat', $data);
        }

        public function addmaster_syarat(){
            $jabatan     = $this->input->post('KodeJB');
            $syaratinput = $this->input->post('syarat_name');

            for ($i = 0; $i < count($syaratinput); $i++) {
                $syarat = array(
                    'syarat_name'     => $syaratinput[$i],
                    'syarat_reg_date' => $this->dtf_default,
                    'syarat_status'   => 1
                );
               $insertsyarat = $this->mod_hr_mastersyarat->addmastersyarat($syarat);
            }

            $query = $this->db->select('syarat_id')->from('msyarat')->where('syarat_reg_date', $this->dtf_default)->get()->result();

            foreach ($query as $row) {
                $syaratbridge = array(
                    'KodeJB'    => $jabatan,
                    'syarat_id' => $row->syarat_id
                );
                $insertsyaratbridge = $this->mod_hr_mastersyarat->addmastersyaratbridge($syaratbridge);
            }

            if($insertsyarat == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function edit_syarat(){
            $syarat_id      = $this->input->post('syarat_id');
            $users_id       = $this->session->userdata('users_id');
            $users_username = $this->session->userdata('username');
            $users_fullname = $this->session->userdata('fullname');

            $data = array(
                'syarat_name'        => $this->input->post('syarat_name'),
                'syarat_update_date' => $this->dtf_default,
                'syarat_status'      => $this->input->post('syarat_status')
            );
            $updatesyarat = $this->mod_hr_mastersyarat->update_syarat($syarat_id, $data);

            $datos = array(
                'logs_tanggal'    => $this->dtf_default,
                'logs_ip'         => $this->input->ip_address(),
                'logs_modul'      => 'SECTION',
                'logs_aktifitas'  => 'UPDATE',
                'logs_keterangan' => 'Merubah data syarat dengan ID : '.$syarat_id,
                'logs_user_id'    => $users_id,
                'logs_username'   => $users_username,
                'logs_user_name'  => $users_fullname,
                'logs_website'    => 'BSS PORTAL'
            );
            $this->mod_hr_mastersyarat->insertLogs($datos);

            if ($updatesyarat == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>