<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysdepartment extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('users_id') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
                redirect('http://web.binasaranasukses.com/portal');
            }
            $this->load->model(['hrDept/mdepartment/mod_hr_department']);
        }

        function department(){
            $data   = array(
                'sheader'         => 'pages/ext/sheader',
                'sfooter'         => 'pages/ext/sfooter',
                'totalDepartemen' => $this->mod_hr_department->count_all()
            );
            $this->load->view('pages/hr/vdepartment/department',$data);
        }

        public function table_department(){
            $level_id   = $this->session->userdata('level_id');
            $department = $this->mod_hr_department->get_datatables();
            $data       = array();
            $no         = $this->input->post('start');

            foreach ($department as $field) {
                $status = ($field->department_status == 1) ? "Aktif" : "Non-Aktif";
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->KodeDP;
                $row[]  = $field->Nama;
                $row[]  = $status;
                $row[]  = ' <button data-toggle="modal" data-target="#modal-edit-dept" class="btn btn-info btn-xs" id="ubah'.$no.'" data-kodedp="'.$field->KodeDP.'" data-kodepakai="'.$field->KodeDP.'" data-nama="'.$field->Nama.'" data-status="'.$field->department_status.'">
                                <i class="fa fa-edit"></i>
                            </button>
                                ';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_hr_department->count_all(),
                 "recordsFiltered" => $this->mod_hr_department->count_filtered(),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function add_department(){
            $data = array(
                'KodeDP'            => $this->input->post('KodeDP'),
                'Nama'              => $this->input->post('Nama'),
                'department_status' => 1
            );
            $insertdept = $this->mod_hr_department->add_department($data);
            if ($insertdept == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function edit_department(){
            $KodeDP = $this->input->post('KodeDP');
            $data = array(
                'Nama'              => $this->input->post('Nama'),
                'department_status' => $this->input->post('department_status')
            );
            $updatedept = $this->mod_hr_department->edit_department($KodeDP, $data);
            if ($updatedept == true) {
                echo "Success";
            } else {
                echo "Error";
            }
        }
    }
?>