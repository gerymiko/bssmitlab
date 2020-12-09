<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysxpertise extends CI_Controller {

        function __construct() {
            parent::__construct();
            // if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
            //     redirect('http://web.binasaranasukses.com/portal');
            // }
            if ($this->session->userdata('username') == NULL) {
                redirect('http://bss.com/rekrutmen');
            }
            $this->load->model(['mperson/mod_karir_skill', 'mglobal/mod_karir_global']);
            $this->output->enable_profiler(false);
        }

        public function get_skill(){
            $people_id = $this->session->userdata('people_id');
            $data      = $this->input->post('skill');
            $getskill  = $this->mod_karir_skill->get_skill($people_id, $data);
            
            echo '<div name="skill_id" id="skill">';
                if ($getskill) {
                    $no = 0;
                    foreach ($getskill as $row) {
                        $no++;
                        echo '<input name="skill_id[]" class="checkbox-style required" id="skill-list'.$no.'" type="checkbox" value='.$row->skill_id.'> ';
                        echo '<label for="skill-list'.$no.'" class="checkbox-style-3-label">'.$row->skill_name.'</label><br />';
                    }
                } else {
                    echo '<label style="color: #000;">Maaf data belum di input oleh admin kami.</label>';
                }
            echo '</div>';
        }

        public function save_add_skill(){
            $people_id = $this->session->userdata('people_id');
            for ($i = 0; $i < count($this->input->post('skill_id')); $i++) {
                $data = array(
                    'people_id'      => $people_id,
                    'skill_id'       => $this->input->post('skill_id')[$i],
                    'KodeJB'         => $this->input->post('KodeJB'),
                    'skill_reg_date' => date("Y-m-d H:i:s")
                );
                $result = $this->mod_karir_skill->save_add_skill($data);
            }
            if ($result) {
                echo "true";
            } else {
                echo "false";
            }

            // $data_skill = array('completed_skill' => 1);
            // $result = $this->mod_crud->update_skill_parameter($people_id, $data);
            // if ($result == true) :
            //     $this->session->set_flashdata('msg4',"Data berhasil ditambahkan");
            //     redirect('dashboard');
            // else :
            //     $this->session->set_flashdata('msg4',"Data gagal disimpan. Mohon cek kembali.");
            //     redirect('dashboard');
            // endif;
        }

        public function table_skill(){
            $people_id = $this->session->userdata('people_id');
            $skill     = $this->mod_karir_skill->get_datatables($people_id);
            $data      = array();
            $no        = $this->input->post('start');

            foreach ($skill as $field) {
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->Nama;
                $row[]  = $field->skill_name;
                $row[]  = '<button class="btn btn-xs" type="button" onclick="delete_skill('.$field->pskill_id.');">
                                <i class="fa fa-times"></i>
                            </button>
                            ';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_karir_skill->count_all($people_id),
                 "recordsFiltered" => $this->mod_karir_skill->count_filtered($people_id),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        public function delete_skill(){
            $pskill_id = $this->input->post('pskill_id');
            $delete_skill = $this->mod_karir_skill->delete_skill($pskill_id);
            echo json_encode($delete_skill);
        } 

    }
?>