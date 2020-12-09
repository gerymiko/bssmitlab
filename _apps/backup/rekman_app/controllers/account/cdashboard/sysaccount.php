<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysaccount extends CI_Controller {

        function __construct() {
            parent::__construct();
            // if ($this->session->userdata('username') == null || $this->session->userdata('tipeapp') != 'WEB_PORTAL') {
            //     redirect('http://web.binasaranasukses.com/portal');
            // }
            if ($this->session->userdata('username') == NULL) {
                redirect('http://bss.com/rekrutmen');
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

        public function index(){
            $people_id = $this->session->userdata('people_id');
        	$data = array(
                'sheader'      => 'pages/ext/header',
                'sfooter'      => 'pages/ext/footer',
                'menu'         => 'pages/account/grid/vmenu',
                'content'      => 'pages/account/dash/vdash',
                'footer'       => 'pages/account/grid/vfooter',
                'count_people_skill' => count($this->mod_karir_skill->get_people_skill($people_id)),
                'count_people_job'   => count($this->mod_karir_job->get_people_job($people_id)),

                'dperson'      => $this->mod_karir_person->detail_personal($people_id),
                
                
                'cijazah'      => $this->mod_karir_education->check_ijazah($people_id),
                
                'plisence'     => $this->mod_karir_lisence->check_lisence($people_id),
                'list_lisence' => $this->mod_karir_lisence->list_lisence($people_id),

                'kota'         => $this->mod_karir_global->getCity(),
                'list_jabatan' => $this->mod_karir_global->list_jabatan(),
                'list_edu'     => $this->mod_karir_global->getEducation(),
                'sector'       => $this->mod_karir_global->getSector(),
                'major'        => $this->mod_karir_global->getMajor(),
                'list_certificate' => $this->mod_karir_global->list_certificate(),

        	);
        	$this->load->view('pages/account/index', $data);
        }

        public function tab2(){
            $people_id = $this->session->userdata('people_id');
            $data = array(
                'daddktp' => $this->mod_karir_address->detail_address_ktp($people_id),
                'dadddom' => $this->mod_karir_address->detail_address_domisili($people_id),
                'kota'    => $this->mod_karir_global->getCity()
            );
            $this->load->view('pages/account/dash/vtab_2', $data);
        }

        public function tab3(){
            $people_id = $this->session->userdata('people_id');
            $data = array(
                'dedufor'   => $this->mod_karir_education->detail_edu_formal($people_id),
                'deduinfor' => $this->mod_karir_education->detail_edu_informal($people_id),
                'kota'      => $this->mod_karir_global->getCity()
            );
            $this->load->view('pages/account/dash/vtab_3', $data);
        }

        public function photo_profile(){
            $people_id   = $this->session->userdata('people_id');
            $getFilename = $this->mod_karir_person->get_photo($people_id);
            $lokasi      = dirname("D:\\").'/images/karir/upload/';
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

        public function get_certificate(){
            if (isset($_GET['term'])) {
                $result = $this->mod_karir_global->certificate_autocomplete($_GET['term']);
                if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->certificate_name;
                    echo json_encode($arr_result);
                }
            }
        }

        public function logout(){
            $people_id = $this->session->userdata('people_id');
            $data      = array( 'is_login' => '0' );
            $this->mod_karir_login->changeStatusLogin($people_id, $data);
            $this->session->unset_userdata('username');
            session_destroy();
            redirect('syshome');
        }

        private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9-_.:]/','', $number);
            return $result;
        }

        public function save_edit_bio(){
            $people_id = $this->input->post('people_id');
            $databio = array(
                'people_firstname'   => $this->pregReps($this->input->post('people_firstname')),
                'people_middlename'  => $this->pregReps($this->input->post('people_middlename')), 
                'people_lastname'    => $this->pregReps($this->input->post('people_lastname')),
                'people_birth_place' => $this->pregRepn($this->input->post('people_birth_place')),
                'people_birth_date'  => $this->pregRepn(date("Y-m-d", strtotime($this->input->post('people_birth_date')))),
                'people_gender'      => $this->pregReps($this->input->post('people_gender')),
                'people_religion'    => $this->pregReps($this->input->post('people_religion')),
                'people_phone'       => $this->pregRepn($this->input->post('people_phone')),
                'people_mobile'      => $this->pregRepn($this->input->post('people_mobile')),
                'people_citizen'     => $this->pregReps($this->input->post('people_citizen')),
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
                    'upload_path'   => dirname("D:\\").'/images/karir/upload/profile/',
                    'allowed_types' => 'jpg|png|jpeg',
                    'max_size'      => '6144',
                    'file_name'     => 'BSS-PROFIL-'.date('Ymd').'-'.$people_id
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
                            'source_image'   => dirname("D:\\").'/images/karir/upload/profile/'.$filephoto['file_name'],
                            'create_thumb'   => FALSE,
                            'maintain_ratio' => TRUE,
                            'max_size'       => '6144',
                            'quality'        => '30%',
                            'width'          => 300,
                            'height'         => 300,
                            'new_image'      => dirname("D:\\").'/images/karir/upload/profile/'.$filephoto['file_name']
                        );
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();

                        $getphoto = $this->mod_karir_person->get_photo($people_id);

                        if(isset($_FILES['file']['name'])) {
                            if(file_exists(dirname("D:\\").'/images/karir/upload/'.$getphoto->people_photo) && $getphoto->people_photo && $getphoto->people_photo  !== "default/300.png")
                            unlink(dirname("D:\\").'/images/karir/upload/'.$getphoto->people_photo);

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
    }
?>