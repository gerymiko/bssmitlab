<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syslisence extends CI_Controller {

        function __construct() {
            parent::__construct();
            // if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
            //     redirect('http://web.binasaranasukses.com/portal');
            // }
            if ($this->session->userdata('username') == NULL) {
                redirect('http://bss.com/rekrutmen');
            }
            $this->load->model(['mperson/mod_karir_lisence', 'mglobal/mod_karir_global']);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

        public function table_lisence(){
            $people_id = $this->session->userdata('people_id');
            $lisence   = $this->mod_karir_lisence->get_datatables($people_id);
            $data      = array();
            $no        = $this->input->post('start');

            foreach ($lisence as $field) {

                $tgl_end            = date("d-m-Y", strtotime($field->plisence_date_end));
                $dateend            = ($tgl_end == "01-01-1970") ? "-" : $tgl_end;
                $stberkas           = ($field->plisence_file == NULL) ? "Belum diunggah" : "Sudah diunggah";
                $btn_disable_upload = ($field->plisence_file == NULL) ? "" : "disabled";
                $btn_disable_show   = ($field->plisence_file !== NULL) ? "" : "disabled";

                $id = $this->encrypt->encode($field->plisence_id);

                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = $field->plisence_type;
                $row[]  = '
                    <b>Nomor</b> : '.$field->plisence_number.'<br>
                    <b>Kota</b> : '.$field->city_name.'<br>
                    <b>Tgl Terbit</b> : '.date("d-m-Y", strtotime($field->plisence_date_start)).'<br>
                    <b>Berlaku S/d</b> : '.$dateend.'
                ';
                $row[]  = $stberkas;
                $row[]  = '
                    <button class="btn nomargin noradius '.$btn_disable_upload.'" data-toggle="modal" data-target="#unggahBerkas" data-id="'.$field->plisence_id.'" data-tipe="'.$field->plisence_type.'">Unggah</button>
                    <button class="btn btn-danger nomargin noradius '.$btn_disable_show.'" data-toggle="modal" data-src="'.site_url().'lisence/show/'.$id.'" data-target="#showLisence">Lihat</button>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_karir_lisence->count_all($people_id),
                "recordsFiltered" => $this->mod_karir_lisence->count_filtered($people_id),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_add_sim(){
            $people_id = $this->session->userdata('people_id');
            if (isset($_FILES)){
                $config = array(
                    'upload_path'   => dirname("D:\\").'/images/karir/upload/berkas/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => '6144',
                    'file_name'     => 'BSS-SIM-'.date('Ymd').'-'.$people_id
                );

                if( ! $this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error 1";
                }

                if ($this->input->post('plisence_keluaran_sim') == 0 || $this->input->post('plisence_type_sim') == "Pilih") {
                    echo "Error 0";
                    exit();
                }

                if(isset($_FILES['file_add_sim']['name'])){

                    if($this->upload->do_upload('file_add_sim')){
                        $filename = $this->upload->data();

                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   => dirname("D:\\").'/images/karir/upload/berkas/'.$filename['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => TRUE,
                            'max_size'       => '6144',
                            'quality'        => '40%',
                            'new_image'      => dirname("D:\\").'/images/karir/upload/berkas/'.$filename['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        if(isset($_FILES['file_add_sim']['name'])) {
                            $sim_data = array(
                                'people_id'           => $people_id,
                                'plisence_type'       => $this->pregReps($this->input->post('plisence_type_sim')),
                                'plisence_number'     => $this->pregRepn($this->input->post('plisence_number_sim')),
                                'plisence_keluaran'   => $this->pregRepn($this->input->post('plisence_keluaran_sim')),
                                'plisence_date_start' => date("Y-m-d", strtotime($this->input->post('plisence_date_start_sim'))),
                                'plisence_date_end'   => date("Y-m-d", strtotime($this->input->post('plisence_date_end_sim'))),
                                'plisence_file'       => 'berkas/'.$filename['file_name'],
                                'plisence_reg_date'   => date("Y-m-d H:i:s")
                            );
                            $insert_sim = $this->mod_karir_lisence->save_add_sim($sim_data);

                            if ($insert_sim) {
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

        public function save_upload_lisence(){
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
                    echo "Error";
                }

                if(isset($_FILES['file_lisence']['name'])){
                    if($this->upload->do_upload('file_lisence')){
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

                        if(isset($_FILES['file_lisence']['name'])){
                            $plisence_id  = $this->input->post('plisence_id');
                            $lisence_data = array(
                                'plisence_file'        => 'berkas/'.$filename['file_name'],
                                'plisence_update_date' => date("Y-m-d H:i:s")
                            );
                            $insert_lisence = $this->mod_karir_lisence->save_upload_lisence($plisence_id, $lisence_data);
                            if ($insert_lisence) {
                                echo "Success";
                            } else {
                                echo "Error";
                            }
                        }
                    } else {
                        echo "Error";
                    }
                } else {
                    echo "Error";
                }
            } else {
                echo "Error";
            }
        }

        public function show_lisence($id){
            $plisence_id = $this->encrypt->decode($id);
            $getFilename = $this->mod_karir_lisence->get_file_lisence($plisence_id);
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