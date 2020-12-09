<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysaccount extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') !== 'WEB_KARIR') {
                redirect('https://web.binasaranasukses.com/karir');
            }
            $this->load->model([
                'mlogin/mod_karir_login',
                'mglobal/mod_karir_global',
                'mperson/mod_karir_person',
                'mperson/mod_karir_address',
                'mperson/mod_karir_education',
                'mperson/mod_karir_lisence',
                'mperson/mod_karir_skill',
                'mperson/mod_karir_job'
            ]);
            $this->output->enable_profiler(false);
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,@]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9-_.:]/','', $number);
            return $result;
        }

        public function index(){
            $people_id = $this->session->userdata('people_id');
        	$data = array(
                'sheader'      => 'pages/ext/header',
                'sfooter'      => 'pages/ext/footer',
                'menu'         => 'pages/account/grid/vmenu',
                'content'      => 'pages/account/dash/vtab_account',
                'footer'       => 'pages/account/grid/vfooter',
                'count_people_skill' => count($this->mod_karir_skill->get_people_skill($people_id)),

                'dperson'      => $this->mod_karir_person->detail_personal($people_id),
                'cijazah'      => $this->mod_karir_education->check_ijazah($people_id),

                'kota'         => $this->mod_karir_global->getCity(),
                'list_jabatan' => $this->mod_karir_global->list_jabatan()
        	);
        	$this->load->view('pages/account/index', $data);
        }

        public function photo_profile($id){
            $people_id   = $this->encrypt->decode($id);
            $getFilename = $this->mod_karir_person->get_photo($people_id);
            $lokasi      = dirname("E:\\").'/images/karir/upload/';
            $filename    = $lokasi.'/'.urldecode($getFilename->people_photo);
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

        public function logout(){
            $people_id = $this->session->userdata('people_id');
            $data      = array( 'is_login' => '0' );
            $this->mod_karir_login->changeStatusLogin($people_id, $data);
            $this->session->unset_userdata('username');
            session_destroy();
            redirect('home');
        }

        public function save_edit_bio(){
            $people_id = $this->input->post('people_id');
            $databio = array(
                'people_firstname'   => $this->pregReps($this->input->post('people_firstname')),
                'people_middlename'  => $this->pregReps($this->input->post('people_middlename')), 
                'people_lastname'    => $this->pregReps($this->input->post('people_lastname')),
                'people_birth_place' => $this->pregRepn($this->input->post('people_birth_place')),
                'people_birth_date'  => $this->pregRepn(date("Y-m-d", strtotime($this->input->post('people_birth_date')))),
                'people_religion'    => $this->pregReps($this->input->post('people_religion')),
                'people_email'       => $this->pregRepn($this->input->post('people_email')),
                'people_phone'       => $this->pregRepn($this->input->post('people_phone')),
                'people_mobile'      => $this->pregRepn($this->input->post('people_mobile')),
                'people_blood_type'  => $this->pregReps($this->input->post('people_blood_type')),
                'people_height'      => $this->pregRepn($this->input->post('people_height')),
                'people_weight'      => $this->pregRepn($this->input->post('people_weight')),
            );
            $update_bio = $this->mod_karir_person->update_bio($people_id, $databio);
            if ($update_bio) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        public function save_add_photo(){
            $people_id = $this->session->userdata('people_id');

            if ( ! empty($_FILES)){
                $config = array(
                    'upload_path'   => dirname("E:\\").'/images/karir/upload/profile/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => '6144',
                    'file_name'     => 'BSS-PROFIL-'.date('YmdHis').'-'.$people_id
                );
                if( ! $this->upload->initialize($config)){
                    $error = array('error' => $this->upload->display_errors());
                    echo "Error";
                }

                if(isset($_FILES['file']['name'])){
                    if($this->upload->do_upload('file')){
                        $filephoto = $this->upload->data();
                        $config = array(
                            'image_library'  => 'gd2',
                            'source_image'   => dirname("E:\\").'/images/karir/upload/profile/'.$filephoto['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => TRUE,
                            'max_size'       => '6144',
                            'quality'        => '30%',
                            'width'          => 300,
                            'height'         => 300,
                            'new_image'      => dirname("E:\\").'/images/karir/upload/profile/'.$filephoto['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $getphoto = $this->mod_karir_person->get_photo($people_id);

                        if(isset($_FILES['file']['name'])) {
                            if(file_exists(dirname("E:\\").'/images/karir/upload/'.$getphoto->people_photo) && $getphoto->people_photo && $getphoto->people_photo  !== "default/300.png")
                            unlink(dirname("E:\\").'/images/karir/upload/'.$getphoto->people_photo);

                            $photo_data = array(
                                'people_photo'       => 'profile/'.$filephoto['file_name'],
                                'people_update_date' => date("Y-m-d H:i:s")
                            );
                            $update_photo = $this->mod_karir_person->update_photo($people_id, $photo_data);
                            if ($update_photo) {
                                echo "true";
                            } else {
                                echo "false";
                            }
                        }
                    } else { echo "Error"; }
                } else { echo "Error"; }
            } else { echo "Error"; }
        } 

    }
?>