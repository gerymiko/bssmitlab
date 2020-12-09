<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Systod extends CI_Controller{

        function __construct(){
            parent::__construct();
            if ($this->session->userdata('idu') == null && $this->session->userdata('nik') == null){
                redirect('login');
            } else {
                $this->accessRights = $this->mod_global->get_access_rights($this->session->userdata('idu'), $this->uri->segment(3), $this->pregReps('master_prod_tod'));
                if ($this->accessRights==null) {
                    show_404('', false);
                } elseif ($this->accessRights!=null && $this->accessRights->site != $this->uri->segment(3) || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('logout');
                } elseif ($this->accessRights!=null && $this->accessRights->readx != 1 || $this->accessRights->status_active != 1) {
                    $pesan = array('type' => '', 'title' => '', 'message' => '<i class="fas fa-exclamation-circle f40 margin10 text-red"></i><br>You do not have authority to access the page.');
                    $this->session->set_flashdata('pesan', $pesan);
                    redirect('page/welcome/'.$this->accessRights->site);
                }
            }
            $this->load->model(['mst/mtod/mod_tod']);
        }

        private static function pregReps($string){
            return $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
        }

        private static function pregRepn($number){
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("d-m-Y H:i:s", strtotime($date));
        }

        private static function viewTime($date){
            return $result = date("H:i:s", strtotime($date));
        }

        public function master_tod($site){
            $data = array(
                'header'  => 'pages/ext/header',
                'footer'  => 'pages/ext/footer',
                'menu'    => $this->mod_global->menu($this->accessRights->id_user, $site),
                'content' => 'pages/mst/ptod/vtod',
                'accessRights' => $this->accessRights,
                'list_site' => $this->mod_global->list_site(),
                'list_param_hdr' => $this->mod_tod->list_param_hdr($site),
                'list_tod_foreman' => $this->mod_tod->list_tod_foreman($site),
                'css_script' => array(
                    '<link rel="stylesheet" type="text/css" href="'.site_url().'../bssmitlab/_assets/global/select2/select2.min.css"/>'
                ),
                'js_script' => array(
                    '<script type="text/javascript" src="'.site_url().'../bssmitlab/_assets/global/select2/select2.full.min.js"></script>'
                ),
            );
            $this->load->view('pages/pindex/index', $data);
        }

        public function table_produksi_parameter_hdr($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_tod->get_data_produksi_parameter_hdr($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-inspection" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row           = array();
                $row['no']     = $start;
                $row['nama']   = $field->nama;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_tod->count_all_produksi_parameter_hdr($site),
                "recordsFiltered" => $this->mod_tod->count_filtered_produksi_parameter_hdr($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function table_produksi_parameter_sub($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_tod->get_data_produksi_parameter_sub($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit-param-sub" data-tooltip="Edit" data-id_param_sub="'.$this->my_encryption->encode($field->id).'" data-parameter_hdr="'.$field->nama_hdr.'" data-parameter_sub="'.$field->nama_sub.'" data-nilai_param_sub="'.$field->score.'" data-standard_sub="'.$field->standard.'" data-status_sub="'.$field->status_sub.'"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row               = array();
                $row['no']         = $start;
                $row['nama_hdr']   = $field->nama_hdr;
                $row['nama_sub']   = $field->nama_sub;
                $row['score']      = $field->score;
                $row['standard']   = $field->standard;
                $row['status_sub'] = ($field->status_sub == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action']     = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_tod->count_all_produksi_parameter_sub($site),
                "recordsFiltered" => $this->mod_tod->count_filtered_produksi_parameter_sub($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_param_sub($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_mst_tod_foreman' => $this->pregReps($this->input->post('id_parameter_hdr')),
                'nama' => $this->pregReps($this->input->post('parameter_sub')),
                'score' => floatval($this->pregReps($this->input->post('nilai_param_sub'))),
                'standard' => floatval($this->pregReps($this->input->post('standard_sub')))
            );
            $Save = $this->mod_global->insert_all('mst_produksi_parameter_sub', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data parameter sub Name : '.$this->pregReps($this->input->post('parameter_sub')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_param_sub($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_param_sub')));
            $data = array(
                'nama' => $this->pregReps($this->input->post('parameter_sub')),
                'score' => floatval($this->pregReps($this->input->post('nilai_param_sub'))),
                'standard' => floatval($this->pregReps($this->input->post('standard_sub'))),
                'status_active' => $this->pregRepn($this->input->post('status_sub'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_produksi_parameter_sub', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data parameter sub Name ID : '.$id.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function table_produksi_parameter_sub_dictionary($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_tod->get_data_produksi_parameter_sub_dictionary($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit-param-sub-dictionary" data-tooltip="Edit" data-id_param_sub_dictionary="'.$this->my_encryption->encode($field->id).'" data-tod_foreman="'.$field->isi.'" data-parameter_sub_dictionary="'.$field->nama.'" data-uom="'.$field->uom.'" data-keterangan_sub_dictionary="'.$field->keterangan.'" data-status_jenis_dictionary="'.$field->status_jenis.'" data-jenis_dictionary="'.$field->jenis.'" data-status_sub_dictionary="'.$field->status_active.'"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['nama_hdr'] = $field->nama_hdr;
                $row['isi']  = $field->isi;
                $row['nama'] = $field->nama;
                $row['uom']  = $field->uom;
                $row['keterangan'] = $field->keterangan;
                $row['status_jenis'] = $field->status_jenis;
                $row['jenis'] = $field->jenis;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_tod->count_all_produksi_parameter_sub_dictionary($site),
                "recordsFiltered" => $this->mod_tod->count_filtered_produksi_parameter_sub_dictionary($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_param_sub_dictionary($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_mst_tod_foreman' => $this->pregReps($this->input->post('id_mst_tod_foreman')),
                'nama' => $this->pregReps($this->input->post('parameter_sub_dictionary')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Save = $this->mod_global->insert_all('mst_produksi_parameter_sub_dictionary', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data parameter sub dictionary Name : '.$this->pregReps($this->input->post('parameter_sub_dictionary')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_param_sub_dictionary($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_param_sub_dictionary')));
            $data = array(
                'nama' => $this->pregReps($this->input->post('parameter_sub_dictionary')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_active' => $this->pregRepn($this->input->post('status_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_produksi_parameter_sub_dictionary', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data parameter sub dictionary ID : '.$id.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function table_produksi_parameter_score($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_tod->get_data_produksi_parameter_score($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-default" data-toggle="modal" data-target="#modal-edit-param-score" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['isi']  = $field->isi.' ('.$field->nama_hdr.')';
                $row['nama'] = $field->nama;
                $row['nilai']  = $field->nilai;
                $row['keterangan'] = $field->keterangan;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_tod->count_all_produksi_parameter_score($site),
                "recordsFiltered" => $this->mod_tod->count_filtered_produksi_parameter_score($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_param_score($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_mst_tod_foreman' => $this->pregReps($this->input->post('id_mst_tod_foreman')),
                'nama' => $this->pregReps($this->input->post('parameter_param')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Save = $this->mod_global->insert_all('mst_produksi_parameter_sub_dictionary', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data parameter sub dictionary Name : '.$this->pregReps($this->input->post('parameter_sub_dictionary')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_param_score($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_param_sub_dictionary')));
            $data = array(
                'nama' => $this->pregReps($this->input->post('parameter_sub_dictionary')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_active' => $this->pregRepn($this->input->post('status_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_produksi_parameter_sub_dictionary', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data parameter sub dictionary ID : '.$id.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function table_produksi_parameter_score_dtl($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_tod->get_data_produksi_parameter_score_dtl($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['isi']  = $field->isi;
                $row['nama_score']  = $field->nama_score;
                $row['model_unit'] = $field->model_unit;
                $row['batas_atas']  = $field->batas_atas;
                $row['batas_bawah'] = $field->batas_bawah;
                $row['opsi'] = $field->opsi;
                $row['keterangan'] = $field->keterangan;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_tod->count_all_produksi_parameter_score_dtl($site),
                "recordsFiltered" => $this->mod_tod->count_filtered_produksi_parameter_score_dtl($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_param_score_dtl($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_mst_tod_foreman' => $this->pregReps($this->input->post('id_mst_tod_foreman')),
                'nama' => $this->pregReps($this->input->post('parameter_param')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Save = $this->mod_global->insert_all('mst_produksi_parameter_sub_dictionary', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data parameter sub dictionary Name : '.$this->pregReps($this->input->post('parameter_sub_dictionary')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_param_score_dtl($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_param_sub_dictionary')));
            $data = array(
                'nama' => $this->pregReps($this->input->post('parameter_sub_dictionary')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_active' => $this->pregRepn($this->input->post('status_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_produksi_parameter_sub_dictionary', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data parameter sub dictionary ID : '.$id.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function table_tod_foreman($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_tod->get_data_tod_foreman($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['nama'] = $field->nama_sub.' ('.$field->nama_hdr.')';
                $row['isi']  = $field->isi;
                $row['scanning']  = $field->jumlah_scanning;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_tod->count_all_tod_foreman($site),
                "recordsFiltered" => $this->mod_tod->count_filtered_tod_foreman($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_param_foreman($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_mst_tod_foreman' => $this->pregReps($this->input->post('id_mst_tod_foreman')),
                'nama' => $this->pregReps($this->input->post('parameter_param')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Save = $this->mod_global->insert_all('mst_produksi_parameter_sub_dictionary', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data parameter sub dictionary Name : '.$this->pregReps($this->input->post('parameter_sub_dictionary')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_param_foreman($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_param_sub_dictionary')));
            $data = array(
                'nama' => $this->pregReps($this->input->post('parameter_sub_dictionary')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_active' => $this->pregRepn($this->input->post('status_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_produksi_parameter_sub_dictionary', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data parameter sub dictionary ID : '.$id.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function table_tod_foreman_schedule($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_tod->get_data_tod_foreman_schedule($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['isi'] = $field->isi.' ('.$field->nama_hdr.')';
                $row['urut']  = $field->urut;
                $row['jam_mulai_ds']  = $this->viewTime($field->jam_mulai_ds);
                $row['jam_selesai_ds']  = $this->viewTime($field->jam_selesai_ds);
                $row['jam_mulai_ns']  = $this->viewTime($field->jam_mulai_ns);
                $row['jam_selesai_ns']  = $this->viewTime($field->jam_selesai_ns);
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_tod->count_all_tod_foreman_schedule($site),
                "recordsFiltered" => $this->mod_tod->count_filtered_tod_foreman_schedule($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_param_schedule($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_mst_tod_foreman' => $this->pregReps($this->input->post('id_mst_tod_foreman')),
                'nama' => $this->pregReps($this->input->post('parameter_param')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Save = $this->mod_global->insert_all('mst_produksi_parameter_sub_dictionary', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data parameter sub dictionary Name : '.$this->pregReps($this->input->post('parameter_sub_dictionary')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_param_schedule($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_param_sub_dictionary')));
            $data = array(
                'nama' => $this->pregReps($this->input->post('parameter_sub_dictionary')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_active' => $this->pregRepn($this->input->post('status_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_produksi_parameter_sub_dictionary', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data parameter sub dictionary ID : '.$id.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function table_corrective_action($site){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404('',false);exit(); }
            $getdata = $this->mod_tod->get_data_corrective_action($length, $start, $site);
            foreach ($getdata as $field){
                if ($this->accessRights->id_level == 1) {
                    $btn = '<button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-edit-" data-tooltip="Edit"><i class="fas fa-pen f10"></i></button>';
                } else {
                    $btn = '<button class="btn btn-xs btn-default" data-tooltip="Unauthority"><i class="fas fa-user-slash"></i></button>';
                }
                $start++;
                $row         = array();
                $row['no']   = $start;
                $row['nama_hdr']  = $field->nama_hdr;
                $row['tod'] = $field->isi;
                $row['actions'] = $field->action;
                $row['jenis']  = $field->jenis;
                $row['nama_score']  = $field->nama_score;
                $row['status'] = ($field->status_active == 1 ) ? '<span class="text-green">Aktif</span>' : '<span class="text-red">Tidak Aktif</span>';
                $row['action'] = $btn;
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_tod->count_all_corrective_action($site),
                "recordsFiltered" => $this->mod_tod->count_filtered_corrective_action($site),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_corrective_action($site){
            if ($this->accessRights->createx == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $data = array(
                'id_mst_tod_foreman' => $this->pregReps($this->input->post('id_mst_tod_foreman')),
                'nama' => $this->pregReps($this->input->post('parameter_param')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Save = $this->mod_global->insert_all('mst_produksi_parameter_sub_dictionary', $data);
            if ($Save == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Add data parameter sub dictionary Name : '.$this->pregReps($this->input->post('parameter_sub_dictionary')).', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }

        public function save_edit_corrective_action($site){
            if ($this->accessRights->updatex == 0 || $this->accessRights->status_active == 0){
                echo "unauthority";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id_param_sub_dictionary')));
            $data = array(
                'nama' => $this->pregReps($this->input->post('parameter_sub_dictionary')),
                'uom' => $this->pregReps($this->input->post('uom')),
                'keterangan' => $this->pregReps($this->input->post('keterangan_sub_dictionary')),
                'status_active' => $this->pregRepn($this->input->post('status_sub_dictionary')),
                'status_jenis' => $this->pregReps($this->input->post('status_jenis_dictionary')),
                'jenis' => $this->pregReps($this->input->post('jenis_dictionary'))
            );
            $Edit = $this->mod_global->edit_all('id', $id, 'mst_produksi_parameter_sub_dictionary', $data);
            if ($Edit == true ) {
                $dataLog = array(
                    'id_user'    => $this->accessRights->id_user,
                    'id_module'  => $this->accessRights->id_module,
                    'logs'       => 'Changes data parameter sub dictionary ID : '.$id.', onsite : '.$site,
                    'ip_address' => $this->input->ip_address()
                );
                $saveLog = $this->mod_global->insert_all('mst_user_log', $dataLog);
                if ($saveLog == true) {
                    echo "Success";
                } else {
                    echo "ErrorLog";exit();
                }
            } else {
                echo "ErrorMod";exit();
            }
        }
    }
?>