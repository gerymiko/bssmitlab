<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syseducation extends CI_Controller {

        function __construct() {
            parent::__construct();
            // if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
            //     redirect('http://web.binasaranasukses.com/portal');
            // }
            if ($this->session->userdata('username') == NULL) {
                redirect('http://bss.com/rekrutmen');
            }
            $this->load->model([
                'mglobal/mod_karir_global',
                'mperson/mod_karir_education',
            ]);
            $this->output->enable_profiler(false);
        }


        public function save_edit_eduformal(){
            $id   = $this->input->post('peducation_id');
            $data = array(
                'edutype_id'      => $this->input->post('edutype_id'),
                'edu_name'        => $this->input->post('edu_name'),
                'edu_jurusan'     => $this->input->post('edu_jurusan'),
                'edu_place'       => $this->input->post('edu_place'),
                'edu_tahun_lulus' => date("Y-m-d", strtotime($this->input->post('edu_tahun_lulus'))),
                'edu_keterangan'  => $this->input->post('edu_keterangan'),
                'edu_update_date' => date("Y-m-d H:i:s")
            );
            $update_eduformal = $this->mod_karir_education->save_edit_eduformal($id, $data);

            $edu_tahun_lulus = date("Y-m-d", strtotime($this->input->post('edu_tahun_lulus')));
            if((strtotime($edu_tahun_lulus)) > (strtotime("-1 years"))){
                $people_id         = $this->session->userdata('people_id');
                $st_data           = array( 'freshgraduate' => 1 );
                $update_freshgrade = $this->mod_karir_education->save_edit_freshgrade($people_id, $st_data);
            } else {
                $people_id         = $this->session->userdata('people_id');
                $st_data           = array( 'freshgraduate' => 0 );
                $update_freshgrade = $this->mod_karir_education->save_edit_freshgrade($people_id, $st_data);
            }

            if ($update_eduformal == TRUE) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function table_informal(){
            $people_id = $this->session->userdata('people_id');
            $informal  = $this->mod_karir_education->get_datatables($people_id);
            $data      = array();
            $no        = $this->input->post('start');

            foreach ($informal as $field) {
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->informaledu_name;
                $row[]  = $field->informaledu_tempat;
                $row[]  = date("d-m-Y", strtotime($field->informaledu_dari)).' S/d '.date("d-m-Y", strtotime($field->informaledu_sampai));
                $row[]  = $field->informaledu_keterangan;
                $row[]  = '<button class="btn btn-xs" type="button" data-toggle="modal" data-target="#editInformal" data-id="'.$field->informaledu_id.'" data-nama="'.$field->informaledu_name.'" data-tempat="'.$field->informaledu_tempat.'" data-dari="'.date("d-m-Y", strtotime($field->informaledu_dari)).'" data-sampai="'.date("d-m-Y", strtotime($field->informaledu_sampai)).'" data-keterangan="'.$field->informaledu_keterangan.'">
                                <i class="fa fa-pencil-alt f10"></i>
                            </button>
                            <button class="btn btn-xs btn-default" type="button" onclick="delete_informal('.$field->informaledu_id.');">
                                <i class="fa fa-times red"></i>
                            </button>
                            ';
                $data[] = $row;
            };
            $output = array(
                 "draw"            => $this->input->post('draw'),
                 "recordsTotal"    => $this->mod_karir_education->count_all($people_id),
                 "recordsFiltered" => $this->mod_karir_education->count_filtered($people_id),
                 "data"            => $data,
            );
            echo json_encode($output);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9-_.:]/','', $number);
            return $result;
        }

        public function save_add_informal(){
            $data = array(
                'people_id'              => $this->pregRepn($this->session->userdata('people_id')),
                'informaledu_name'       => $this->pregReps($this->input->post('informaledu_name')),
                'informaledu_tempat'     => $this->pregReps($this->input->post('informaledu_tempat')),
                'informaledu_dari'       => date("Y-m-d", strtotime($this->pregRepn($this->input->post('informaledu_dari')))),
                'informaledu_sampai'     => date("Y-m-d", strtotime($this->pregRepn($this->input->post('informaledu_sampai')))),
                'informaledu_keterangan' => $this->pregReps($this->input->post('informaledu_keterangan')),
                'informaledu_reg_date'   => date("Y-m-d H:i:s"),
                'informaledu_status'     => 1
            );
            $insert_informal = $this->mod_karir_education->save_add_informal($data);
            if ($insert_informal == TRUE) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function save_edit_informal(){
            $id   = $this->input->post('informaledu_id');
            $data = array(
                'informaledu_name'        => $this->pregReps($this->input->post('informaledu_name')),
                'informaledu_tempat'      => $this->pregReps($this->input->post('informaledu_tempat')),
                'informaledu_dari'        => date("Y-m-d", strtotime($this->pregRepn($this->input->post('informaledu_dari')))),
                'informaledu_sampai'      => date("Y-m-d", strtotime($this->pregRepn($this->input->post('informaledu_sampai')))),
                'informaledu_keterangan'  => $this->pregReps($this->input->post('informaledu_keterangan')),
                'informaledu_update_date' => date("Y-m-d H:i:s")
            );
            $update_informal = $this->mod_karir_education->save_edit_informal($id, $data);
            if ($update_informal == TRUE) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function delete_informal(){
            $id   = $this->input->post('informaledu_id');
            $data = array( 'informaledu_status' => 0, 'informaledu_update_date' => date("Y-m-d H:i:s") );
            $delete_informal = $this->mod_karir_education->delete_informal($id, $data);
            echo json_encode($delete_informal);
        }

        public function save_add_ijazah(){
            $people_id = $this->session->userdata('people_id');
            if ( ! empty($_FILES)){
                $config = array(
                    'upload_path'   => dirname("D:\\").'/images/karir/upload/berkas/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => '6144',
                    'file_name'     => 'BSS-DOCS-'.date('Ymd').'-'.$people_id
                );

                if( ! $this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error 1";
                }

                if(isset($_FILES['file_ijazah']['name'])){
                    if($this->upload->do_upload('file_ijazah')){
                        $filename = $this->upload->data();

                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   => dirname("D:\\").'/images/karir/upload/berkas/'.$filename['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => TRUE,
                            'max_size'       => '6144',
                            'quality'        => '50%',
                            'new_image'      => dirname("D:\\").'/images/karir/upload/berkas/'.$filename['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $cijazah = $this->mod_karir_education->check_ijazah($people_id);

                        if($cijazah->plisence_type !== NULL){
                            if(isset($_FILES['file_ijazah']['name'])) {
                                $ijazah_data = array(
                                    'plisence_number'     => $this->pregReps($this->input->post('plisence_number_ijazah')),
                                    'plisence_keluaran'   => $this->pregRepn($this->input->post('plisence_keluaran_ijazah')),
                                    'plisence_date_start' => date("Y-m-d", strtotime($this->pregRepn($this->input->post('plisence_date_start_ijazah')))),
                                    'plisence_file'       => 'berkas/'.$filename['file_name'],
                                    'plisence_reg_date'   => date("Y-m-d H:i:s")
                                );
                                $update_ijazah = $this->mod_karir_education->save_edit_ijazah($people_id, $ijazah_data);

                                $param_ijazah = array( 'completed_berkas_ijazah' => 1 );
                                $update_param = $this->mod_karir_education->save_edit_param_ijazah($people_id, $param_ijazah);

                                if ($update_ijazah && $update_param) {
                                    echo "Success";
                                } else {
                                    echo "Error 2";
                                }
                            }
                        } else {
                           $ijazah_data = array(
                                'people_id'           => $people_id,
                                'plisence_type'       => 'IJAZAH',
                                'plisence_number'     => $this->pregReps($this->input->post('plisence_number_ijazah')),
                                'plisence_keluaran'   => $this->pregRepn($this->input->post('plisence_keluaran_ijazah')),
                                'plisence_date_start' => date("Y-m-d", strtotime($this->pregRepn($this->input->post('plisence_date_start_ijazah')))),
                                'plisence_file'       => 'berkas/'.$filename['file_name'],
                                'plisence_reg_date'   => date("Y-m-d H:i:s")
                            );
                            $update_ijazah = $this->mod_karir_education->save_add_ijazah($ijazah_data);

                            $param_ijazah = array( 'completed_berkas_ijazah' => 1 );
                            $update_param = $this->mod_karir_education->save_edit_param_ijazah($people_id, $param_ijazah);

                            if ($update_ijazah && $update_param) {
                                echo "Success";
                            } else {
                                echo "Error 2";
                            }
                        }
                    } else {
                        echo "Error 3";
                    }
                } else {
                    echo "Error 4";
                }
            } else {
                echo "Error 5";
            }
        }

        public function table_ijazah(){
            $people_id = $this->session->userdata('people_id');
            $ijazah    = $this->mod_karir_education->get_ijazah($people_id);
            $data      = array();
            $no        = $this->input->post('start');

            foreach ($ijazah as $field) {
                $status = ($field->plisence_file == NULL) ? "Belum diunggah" : "Sudah diunggah";
                if ($field->plisence_file == NULL ) {
                    $btn_upload = "";
                    $btn_view   = "disabled";
                } else {
                    $btn_upload = "disabled";
                    $btn_view   = "";
                }
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = ucwords($field->edu_name);
                $row[]  = $status;
                $row[]  = '
                            <button class="btn btn-sm btn-primary nomargin noradius" '.$btn_upload.' data-toggle="modal" data-target="#unggahIjazah">Unggah</button>
                            <button class="btn btn-sm btn-danger nomargin noradius" '.$btn_view.' data-toggle="modal" data-target="#showIjazah">Lihat</button>
                        ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_karir_education->count_all_ijazah($people_id),
                "recordsFiltered" => $this->mod_karir_education->count_filtered_ijazah($people_id),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function show_ijazah(){
            $people_id   = $this->session->userdata('people_id');
            $getFilename = $this->mod_karir_education->check_ijazah($people_id);
            $lokasi      = dirname("D:\\").'/images/karir/upload';
            $filename    = $lokasi.'/'.urldecode($getFilename->plisence_file);
            header('Content-Description: File Transfer');
            header('Content-Type: application/file');
            header('Content-Disposition: attachment; filename='.basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filename));
            header("Last-Modified: ".date ("D, d M Y H:i:s", filemtime($filename))." GMT");
            ob_clean();
            flush();
            readfile($filename);
            exit;
        }

    }
?>