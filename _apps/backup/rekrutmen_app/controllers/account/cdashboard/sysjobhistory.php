<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysjobhistory extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') != 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
            }
            $this->load->model([
                'mglobal/mod_karir_global',
                'mperson/mod_karir_job',
            ]);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9-_.:]/','', $number);
            return $result;
        }

        public function tab_experience(){
            $people_id = $this->session->userdata('people_id');
            $data = array(
                'count_people_job' => count($this->mod_karir_job->get_people_job($people_id)),
                'sector'           => $this->mod_karir_global->getSector()
            );
            $this->load->view('pages/account/dash/vtab_experience', $data);
        }

        public function table_job(){
            $people_id  = $this->session->userdata('people_id');
            $jobhistory = $this->mod_karir_job->get_datatables($people_id);
            $data       = array();
            $no         = $this->input->post('start');

            foreach ($jobhistory as $field) {

                if ($field->pjobhistory_file == NULL) {
                    $btn_upload   = "";
                    $btn_show     = "hidden";
                    $notif_upload = "<button class='btn btn-xs btn-danger'><i>Berkas belum diunggah</i></button>";
                } else {
                    $btn_upload   = "hidden";
                    $btn_show     = "";
                    $notif_upload = "";
                }

                $id = $this->encrypt->encode($field->pjobhistory_id);

                $date1    = new DateTime($field->pjobhistory_thn_start);
                $date2    = new DateTime($field->pjobhistory_thn_end);
                $interval = $date1->diff($date2);

                if ($field->sector_name == "Pilih") {
                    $sector_name = '<button class="btn btn-xs btn-default"><i>Bidang perusahaan belum dipilih</i></button>';
                } else {
                    $sector_name = '<span class="t300 black">'.$field->sector_name.'</span>';
                }
        
                $no++;
                $row    = array();
                $row[]  = '
                    <div class="panel-body noradius">
                        <div class="row">
                            <div class="col-sm-10">
                                <h5 class="nobottommargin ls3">'.strtoupper($field->pjobhistory_company).' - '.$sector_name.'</h5>
                                <p class="notopmargin black ls2"><b>'.ucwords($field->pjobhistory_jabatan_akhir).'</b></p>
                                <p class="notopmargin"><small>'.date("d-M-Y", strtotime($field->pjobhistory_thn_start)).' S/d '.date("d-M-Y", strtotime($field->pjobhistory_thn_end)).' ( '.$interval->format('%y Tahun %m Bulan').' )</small></p>
                                <p class="notopmargin">'.$notif_upload.'</p>
                            </div>
                            <div class="col-sm-2">
                                <div class="">
                                    <button class="btn btn-xs btn-default" type="button" onclick="delete_job('.$field->pjobhistory_id.');">
                                        <i class="fa fa-times red"></i>
                                    </button>
                                    <button class="btn btn-xs btn-primary" type="button" data-toggle="modal" data-target="#editJob" data-id="'.$field->pjobhistory_id.'" data-company="'.$field->pjobhistory_company.'" data-jabatan_awal="'.$field->pjobhistory_jabatan_awal.'" data-jabatan_akhir="'.$field->pjobhistory_jabatan_akhir.'" data-bidang="'.$field->pjobhistory_bidang.'" data-gaji="'.$field->pjobhistory_gaji_akhir.'" data-reason="'.$field->pjobhistory_reason.'" data-thn_start="'.date("d-m-Y", strtotime($field->pjobhistory_thn_start)).'" data-thn_end="'.date("d-m-Y", strtotime($field->pjobhistory_thn_end)).'">
                                        <i class="fa fa-pencil-alt f10"></i>
                                    </button>
                                    <button class="btn btn-xs '.$btn_upload.'" type="button" data-toggle="modal" data-target="#unggahJob" data-id="'.$field->pjobhistory_id.'" data-company="'.$field->pjobhistory_company.'">
                                        <i class="fa fa-paperclip"></i> Unggah
                                    </button>
                                    <button class="btn btn-xs '.$btn_show.'" type="button" data-toggle="modal" data-target="#showJobfile" data-src="'.base_url().'account/cdashboard/sysjobhistory/show_exp/'.$id.'" data-name="'.$field->pjobhistory_company.'">
                                        <i class="fa fa-eye"></i> Lihat
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
                $data[] = $row;
            };
            $output = array(
                "draw"            => $this->input->post('draw'),
                "recordsTotal"    => $this->mod_karir_job->count_all($people_id),
                "recordsFiltered" => $this->mod_karir_job->count_filtered($people_id),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function save_edit_job(){
            $id        = $this->input->post('pjobhistory_id');
            $dates     = abs(strtotime($this->input->post('pjobhistory_thn_start')) - strtotime($this->input->post('pjobhistory_thn_end')));
            $masakerja = floor($dates / (365*60*60*24));

            $data = array(
                'pjobhistory_company'       => $this->pregReps($this->input->post('pjobhistory_company')),
                'pjobhistory_bidang'        => $this->pregRepn($this->input->post('pjobhistory_bidang')), 
                'pjobhistory_jabatan_awal'  => $this->pregReps($this->input->post('pjobhistory_jabatan_awal')),
                'pjobhistory_jabatan_akhir' => $this->pregReps($this->input->post('pjobhistory_jabatan_akhir')),
                'pjobhistory_thn_start'     => date("Y-m-d", strtotime($this->input->post('pjobhistory_thn_start'))),
                'pjobhistory_thn_end'       => date("Y-m-d", strtotime($this->input->post('pjobhistory_thn_end'))),
                'pjobhistory_gaji_akhir'    => $this->pregRepn($this->input->post('pjobhistory_gaji_akhir')),
                'pjobhistory_reason'        => $this->pregReps($this->input->post('pjobhistory_reason')),
                'pjobhistory_lama'          => $masakerja,
                'pjobhistory_update_date'   => date("Y-m-d"),
            );
            $update_job = $this->mod_karir_job->update_job($id, $data);
            if ($update_job == TRUE) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function delete_job(){
            $id         = $this->input->post('pjobhistory_id');
            $data       = array( 'pjobhistory_status' => 0 );
            $delete_job = $this->mod_karir_job->delete_job($id, $data);

            $file = $this->mod_karir_job->get_file($id);

            if(file_exists(dirname("E:\\").'/images/upload/'.$file->pjobhistory_file) && $file->pjobhistory_file !== NULL)
                            unlink(dirname("E:\\").'/images/karir/upload/'.$file->pjobhistory_file);

            echo json_encode($delete_job);
        }

        public function save_upload_job(){
            $people_id = $this->session->userdata('people_id');
            if ( ! empty($_FILES)){
                $config = array(
                    'upload_path'   => dirname("E:\\").'/images/karir/upload/berkas/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'file_name'     => 'BSS-DOCS-'.date('YmdHis').'-'.$people_id
                );
                if( ! $this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error";
                }
                if(isset($_FILES['file_job']['name'])){
                    if($this->upload->do_upload('file_job')){
                        $gbr = $this->upload->data();

                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   => dirname("E:\\").'/images/karir/upload/berkas/'.$gbr['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => TRUE,
                            'max_size'       => '6048',
                            'quality'        => '50%',
                            'new_image'      => dirname("E:\\").'/images/karir/upload/berkas/'.$gbr['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        if(isset($_FILES['file_job']['name'])){
                            $pjobhistory_id  = $this->input->post('pjobhistory_id');
                            $job_data = array(
                                'pjobhistory_file'        => 'berkas/'.$gbr['file_name'],
                                'pjobhistory_update_date' => date("Y-m-d H:i:s")
                            );
                            $update_job_file = $this->mod_karir_job->save_upload_job($pjobhistory_id, $job_data);
                            if ($update_job_file) {
                                echo "Success";
                            } else {
                                echo "Error Save";
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

        public function save_add_job(){
            $people_id = $this->session->userdata('people_id');
            if ( ! empty($_FILES)){
                $config = array(
                    'upload_path'   => dirname("E:\\").'/images/karir/upload/berkas/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'file_name'     => 'BSS-JOB-'.date('YmdHis').'-'.$people_id
                );

                if( ! $this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error Init";
                }

                if(isset($_FILES['file_job_upload']['name'])){
                    if($this->upload->do_upload('file_job_upload')){
                        $gbr = $this->upload->data();

                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   => dirname("E:\\").'/images/karir/upload/berkas/'.$gbr['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => TRUE,
                            'max_size'       => '6048',
                            'quality'        => '50%',
                            'new_image'      => dirname("E:\\").'/images/karir/upload/berkas/'.$gbr['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        if(isset($_FILES['file_job_upload']['name'])){

                            $date1    = new DateTime(date("Y-m-d", strtotime($this->input->post('pjobhistory_thn_start_add'))));
                            $date2    = new DateTime(date("Y-m-d", strtotime($this->input->post('pjobhistory_thn_end_add'))));
                            $interval = $date1->diff($date2);

                            $data = array(
                                'people_id'                 => $people_id,
                                'pjobhistory_company'       => $this->pregReps($this->input->post('pjobhistory_company_add')),
                                'pjobhistory_bidang'        => $this->pregRepn($this->input->post('pjobhistory_bidang_add')),
                                'pjobhistory_lama'          => $interval->format('%y Tahun %m Bulan'),
                                'pjobhistory_jabatan_awal'  => $this->pregReps($this->input->post('pjobhistory_jabatan_awal_add')),
                                'pjobhistory_jabatan_akhir' => $this->pregReps($this->input->post('pjobhistory_jabatan_akhir_add')),
                                'pjobhistory_thn_start'     => date("Y-m-d", strtotime($this->input->post('pjobhistory_thn_start_add'))),
                                'pjobhistory_thn_end'       => date("Y-m-d", strtotime($this->input->post('pjobhistory_thn_end_add'))),
                                'pjobhistory_gaji_akhir'    => $this->pregRepn($this->input->post('pjobhistory_gaji_akhir_add')),
                                'pjobhistory_reason'        => $this->pregReps($this->input->post('pjobhistory_reason_add')),
                                'pjobhistory_status'        => 1,
                                'pjobhistory_file'          => 'berkas/'.$gbr['file_name'],
                                'pjobhistory_reg_date'      => date("Y-m-d H:i:s")
                            );

                            $insert_job_file = $this->mod_karir_job->save_add_job($data);
                            if ($insert_job_file == true) {
                                echo "Success";
                            } else { 
                                echo "Error Save"; 
                            }
                        }
                    } else { echo "Error 1"; }
                } else { echo "Error 2"; }
            } else { echo "Error 3"; }
        }

        public function show_exp($id){
            $id          = $this->encrypt->decode($id);
            $getFilename = $this->mod_karir_job->get_file($id);
            $lokasi      = dirname("E:\\").'/images/karir/upload';
            $filename    = $lokasi.'/'.urldecode($getFilename->pjobhistory_file);
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