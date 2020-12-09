<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysmastersertifikat extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mmaster/mod_hr_mastersertifikat', 'mod_master']);
            $this->dtf_default = date("Y-m-d H:i:s");
        }

        public function table_master_sertifikat(){
            $master_sertifikat = $this->mod_hr_mastersertifikat->get_datatables();
            $data              = array();
            $no                = $this->input->post('start');

            foreach ($master_sertifikat as $field) {

                $jabatan = ($field->Nama == null) ? "Seluruh Jabatan" : $field->Nama;
                $status  = ($field->certificate_status == 1) ? "Aktif" : "Non-Aktif";
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->certificate_name;
                $row[]  = $jabatan;
                $row[]  = $status;
                $row[]  = '
                           <button type="button" class="btn btn-blue btn-xs" data-toggle="modal" data-target="#modal-edit-certificate" data-id="'.$field->certificate_id.'" data-name="'.$field->certificate_name.'" data-status="'.$field->certificate_status.'" data-jabatan="'.$jabatan.'" id="ubah'.$no.'">
                                <i class="far fa-edit"></i>
                            </button>
                        ';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_mastersertifikat->count_all(),
                 "recordsFiltered" => $this->mod_hr_mastersertifikat->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function master_sertifikat(){
            $data = array(
                'sheader'            => 'pages/ext/sheader',
                'sfooter'            => 'pages/ext/sfooter',
                'totalsertifikat'    => $this->mod_hr_mastersertifikat->totalsertifikat(),
                'totalsertifikatall' => $this->mod_hr_mastersertifikat->count_all(),
                'listjabatan'        => $this->mod_master->list_jabatan(),
            );
            $this->load->view('pages/hr/vmaster/master_sertifikat', $data);
        }

        public function addmaster_sertifikat(){
            $jabatan         = $this->input->post('KodeJB');
            $sertifikatinput = $this->input->post('certificate_name');

            for ($i = 0; $i < count($sertifikatinput); $i++) {
                $sertifikat = array(
                    'certificate_name'     => $sertifikatinput[$i],
                    'certificate_reg_date' => $this->dtf_default,
                    'certificate_status'   => 1
                );
               $insertsertifikat = $this->mod_hr_mastersertifikat->addmastersertifikat($sertifikat);
            }

            $query = $this->db->select('certificate_id')->from('mcertificate')->where('certificate_reg_date', $this->dtf_default)->get()->result();

            foreach ($query as $row) {
                $sertifikatbridge = array(
                    'KodeJB'         => $jabatan,
                    'certificate_id' => $row->certificate_id
                );
                $insertsertifikatbridge = $this->mod_hr_mastersertifikat->addmastersertifikatbridge($sertifikatbridge);
            }

            if($insertsertifikat == true){
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function edit_sertifikat(){
            $certificate_id = $this->input->post('certificate_id');
            $users_id       = $this->session->userdata('users_id');
            $users_username = $this->session->userdata('username');
            $users_fullname = $this->session->userdata('fullname');

            $reform = str_replace(" ", "-", $this->input->post('certificate_name'));

            $data = array(
                'certificate_name'        => $this->input->post('certificate_name'),
                'certificate_alias'       => strtolower($reform),
                'certificate_update_date' => $this->dtf_default,
                'certificate_status'      => $this->input->post('certificate_status')
            );
            $updatesertifikat = $this->mod_hr_mastersertifikat->update_sertifikat($certificate_id, $data);

            $datos = array(
                'logs_tanggal'    => $this->dtf_default,
                'logs_ip'         => $this->input->ip_address(),
                'logs_modul'      => 'SECTION',
                'logs_aktifitas'  => 'UPDATE',
                'logs_keterangan' => 'Merubah data syarat dengan ID : '.$certificate_id,
                'logs_user_id'    => $users_id,
                'logs_username'   => $users_username,
                'logs_user_name'  => $users_fullname,
                'logs_website'    => 'BSS PORTAL'
            );
            $this->mod_hr_mastersertifikat->insertLogs($datos);

            if ($updatesertifikat == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>