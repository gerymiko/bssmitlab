<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Syscertificate extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') !== 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
            }
            $this->load->model([
                'mglobal/mod_karir_global',
                'mperson/mod_karir_certificate'
            ]);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9-:]/','', $number);
            return $result;
        }

        public function tab_certificate(){
            $people_id = $this->session->userdata('people_id');
            $data = array(
				'list_certificate' => $this->mod_karir_global->list_certificate(),
				'kota'             => $this->mod_karir_global->getCity(),
            );
            $this->load->view('pages/account/dash/vtab_certificate', $data);
        }

        public function table_certificate(){
            $people_id   = $this->session->userdata('people_id');
            $certificate = $this->mod_karir_certificate->get_certificate($people_id);
            $data        = array();
            $no          = $this->input->post('start');

            foreach ($certificate as $field) {
                $berlaku    = date("Y-m-d H:i:s", strtotime($field->pcertificate_validity));
                $validity   = ($field->pcertificate_validity == null || $field->pcertificate_validity == $berlaku) ? "Jangka Panjang" : date("d-M-y", strtotime($field->pcertificate_validity));

                if ($field->pcertificate_validity == null || $field->pcertificate_validity == $berlaku) {
                    $keterangan = "Jangka Panjang";
                } elseif ($berlaku <= date("Y-m-d")) {
                    $keterangan = "Kadaluarsa";
                } else {
                    $keterangan = "Aktif";
                }

                $id = $this->encrypt->encode($field->pcertificate_id);

                if ($field->pcertificate_file == NULL ) {
                    $btn_view = "disabled";
                } else {
                    $btn_view = "";
                }
                $no++;
                $row    = array();
                $row[]  = $no;
                $row[]  = ucwords($field->pcertificate_name);
                $row[]  = $validity;
                $row[]  = $keterangan;
                $row[]  = ' 
                    <button class="btn btn-xs" type="button" onclick="delete_certificate('.$field->pcertificate_id.');">
                        <i class="fa fa-times red"></i>
                    </button>
                    <button class="btn btn-xs btn-primary" '.$btn_view.' data-toggle="modal" data-target="#showCertificate" data-src="'.site_url().'account/show_certificate/'.$id.'" >Lihat</button> ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_karir_certificate->count_all_certificate($people_id),
                "recordsFiltered" => $this->mod_karir_certificate->count_filtered_certificate($people_id),
                "data"            => $data
            );
            echo json_encode($output);
        }

        public function show_certificate($id){
            $pcertificate_id = $this->encrypt->decode($id);
            $getFilename     = $this->mod_karir_certificate->get_file_certificate($pcertificate_id);
            $lokasi          = dirname("E:\\").'/images/karir/upload';
            $filename        = $lokasi.'/'.urldecode($getFilename->pcertificate_file);
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

        public function save_add_certificate(){
            $people_id          = $this->session->userdata('people_id');
            $certificate_tipe   = $this->pregReps($this->input->post('certificate_id'));
            $pcertificate_type  = $this->pregReps($this->input->post('pcertificate_type'));
            $pcertificate_name1 = $this->pregRepn($this->input->post('pcertificate_name1'));

            if ($pcertificate_name1 == 0) {
                echo "Error";
                exit();
            }

            if ($certificate_tipe == "available") {
                $pcertificate_name = $this->pregReps($this->input->post('pcertificate_name1'));
            } else {
                $pcertificate_name = $this->pregReps($this->input->post('pcertificate_name2'));
            }

            if ($pcertificate_type == 2) {
                $pcertificate_validity = date("Y-m-d", strtotime($this->pregRepn($this->input->post('pcertificate_validity'))));
            } else {
                $pcertificate_validity = null;
            }

            if (isset($_FILES)){
                $config = array(
                    'upload_path'   => dirname("E:\\").'/images/karir/upload/berkas/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => '6144',
                    'file_name'     => 'BSS-DOCS-'.date('YmdHis').'-'.$people_id
                );

                if( ! $this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error 1";
                }

                if(isset($_FILES['pcertificate_file']['name'])){

                    if($this->upload->do_upload('pcertificate_file')){
                        $filename = $this->upload->data();

                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   => dirname("E:\\").'/images/karir/upload/berkas/'.$filename['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => TRUE,
                            'max_size'       => '6144',
                            'quality'        => '40%',
                            'new_image'      => dirname("E:\\").'/images/karir/upload/berkas/'.$filename['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();                        

                        if ($certificate_tipe == "available") {
                            $getCertificate_name = $this->mod_karir_certificate->getCertificate_name($pcertificate_name);
                            $data = array(
                                'people_id'             => $people_id,
                                'certificate_id'        => $pcertificate_name,
                                'pcertificate_name'     => $getCertificate_name->certificate_name,
                                'pcertificate_validity' => $pcertificate_validity,
                                'pcertificate_reg_date' => date("Y-m-d H:i:s"),
                                'pcertificate_file'     => 'berkas/'.$filename['file_name']
                            );
                            $insertCertificate = $this->mod_karir_certificate->save_add_certificate($data);
                            if ($insertCertificate == true) {
                                echo "Success";
                            } else {
                                echo "Erorr Saving 1";
                            }
                        } else {
                            $data = array(
                                'certificate_id'        => 0,
                                'people_id'             => $people_id,
                                'pcertificate_name'     => $pcertificate_name,
                                'pcertificate_validity' => $pcertificate_validity,
                                'pcertificate_reg_date' => date("Y-m-d H:i:s"),
                                'pcertificate_file'     => 'berkas/'.$filename['file_name']
                            );
                            $insertCertificate = $this->mod_karir_certificate->save_add_certificate($data);
                            if ($insertCertificate == true) {
                                echo "Success";
                            } else {
                                echo "Erorr Saving 2";
                            }
                        }
                    } else { echo "Error 3"; }
                } else { echo "Error 4"; }
            } else { echo "Error 5"; }
        }

        public function delete_certificate(){
            $pcertificate_id    = $this->pregRepn($this->input->post('pcertificate_id'));
            $getFile            = $this->mod_karir_certificate->get_file_certificate($pcertificate_id);
            
            if(file_exists(dirname("E:\\").'/images/karir/upload/'.$getFile->pcertificate_file))
                unlink(dirname("E:\\").'/images/karir/upload/'.$getFile->pcertificate_file);

            $delete_certificate = $this->mod_karir_certificate->delete_certificate($pcertificate_id);
            
            echo json_encode($delete_certificate);
        } 

    }
?>