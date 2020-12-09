<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Sysforum extends CI_Controller {

        function __construct() {
            parent::__construct();
            if ($this->session->userdata('id_user') == null && $this->session->userdata('username') == "") {
                redirect('home');
            }
            $this->load->model(['mforum/Mod_forum']);
        }

        private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function viewDate($date){
            return $result = date("l, d m Y", strtotime($date));
        }

        private static function serverDate($date){
            return $result = date("Y-m-d", strtotime($date));
        }

        private static function substrwords($text, $maxchar, $end='...') {
            if (mb_strlen($text) > $maxchar || $text == '') {
                $words  = preg_split('/\s/', $text);      
                $output = '';
                $i      = 0;
                while (1) {
                    $length = mb_strlen($output)+mb_strlen($words[$i]);
                    if ($length > $maxchar) {
                        break;
                    } else {
                        $output .= " " . $words[$i];
                        ++$i;
                    }
                }
                $output .= $end;
            } else {
                $output = $text;
            }
            return $output;
        }

        public function index(){
            $data = array(
                'header'   => 'pages/ext/header',
                'footer'   => 'pages/ext/footer',
                'menu'     => 'pages/pmenu/menu',
                'content'  => 'pages/pforum/forum',
                'category' => $this->mod_forum->question_basedon_category(),
                'allcategory' => $this->mod_forum->count_all_question(),
            );
        	$this->load->view('pages/pindex/index', $data);
        }

        public function add_question(){
            $dataCate = array(
                'dcate' => $this->mod_forum->list_category()
            );
            $this->load->view('pages/pforum/add', $dataCate);
        }

        public function edit_question($id){
            $id = $this->my_encryption->decode($this->pregReps($id));
            $dataQuest = array(
                'dquest' => $this->mod_forum->detail_question($id),
                'dcate'  => $this->mod_forum->list_category()
            );
            $this->load->view('pages/pforum/edit', $dataQuest);
        }

        public function detail_question($id){
            $id = $this->my_encryption->decode($this->pregReps($id));
            $dataQuest = array(
                'dquest'  => $this->mod_forum->detail_question($id),
                'danswer' => $this->mod_forum->detail_answer($id),
            );
            $this->load->view('pages/pforum/detail', $dataQuest);
        }

        public function edit_answer($id){
            $id = $this->my_encryption->decode($this->pregReps($id));
            $dataAnswer = array(
                'danswer' => $this->mod_forum->get_detail_answer($id),
            );
            $this->load->view('pages/pforum/edit_answer', $dataAnswer);
        }

        // END OF VIEW FUNCTION ----------------- //

        public function table_forum(){
            $data   = array();
            $start  = $this->pregRepn($this->input->post('start'));
            $length = $this->pregRepn($this->input->post('length'));
            if ($start == null || $length == null || $start == "" || $length == ""){ show_404();exit(); }
            $question = $this->mod_forum->get_datatables($length, $start);
            foreach ($question as $field){
                $start++;
                $btnEditShow   = ($field->id_user == $this->session->userdata('id_user')) ? '<button type="button" class="genric-btn info circle small padbtn" data-tooltip="ubah" onclick="btn_edit_question(\''.$this->my_encryption->encode($field->id_quest).'\')"><i class="fas fa-pen f10 nomargin"></i></button>': '';
                $btnDeleteShow = ($field->id_user == $this->session->userdata('id_user')) ? '<button type="button" class="genric-btn danger-border circle small padbtn" data-tooltip="hapus" onclick="removeQuest(\''.$this->my_encryption->encode($field->id_quest).'\', \''.$field->askedby.'\');"><i class="fas fa-times nomargin"></i></button>': '';
                $row             = array();
                $row['no']       = $start;
                $row['question'] = '
                        <div class="blog_details">
                            <a class="hand" onclick="btn_detail_question(\''.$this->my_encryption->encode($field->id_quest).'\')">
                                <h5>'.$field->quest_title.'</h5>
                            </a>
                            <div class="pull-right">
                                '.$btnEditShow.' '.$btnDeleteShow.'
                            </div>
                            <p>'.$this->substrwords($field->quest_desc, 200).'</p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="far fa-calendar-alt"></i> '.id_date($field->timestamp_quest, 'l, d M Y H:i A').'</a></li>
                                <li><a href="#"><i class="far fa-comments"></i> '.$field->total_answer.' komentar</a></li>
                                <li><a href="#"><i class="fas fa-user"></i> '.$field->askedby.'</a></li>
                                <li><a href="#"><i class="fas fa-layer-group"></i> '.$field->name_cate.'</a></li>
                            </ul>
                        </div>
                ';
                $data[]          = $row;
            };
            $output = array(
                "draw"            => $this->pregRepn($this->input->post('draw')),
                "recordsTotal"    => $this->mod_forum->count_all(),
                "recordsFiltered" => $this->mod_forum->count_filtered(),
                "data"            => $data,
            );
            echo json_encode($output);
        }

        public function get_answer($id){
            $id      = $this->my_encryption->decode($this->pregReps($id));
            $getData = $this->mod_forum->detail_answer($id);

            $data    = array();
            $no = 0;
            foreach ($getData as $field) {
                $change = ($field->id_user == $this->session->userdata('id_user')) ? '<button type="button" class="genric-btn info circle small padbtn" data-tooltip="ubah" onclick="btn_edit_answer(\''.$this->my_encryption->encode($field->id_answer).'\')"><i class="fas fa-pen f10 nomargin"></i></button>' : '';
                $delete = ($field->id_user == $this->session->userdata('id_user')) ? '<button type="button" class="genric-btn danger-border circle small padbtn f13" data-tooltip="hapus" onclick="btn_delete_answer(\''.$this->my_encryption->encode($field->id_answer).'\', \''.$this->my_encryption->encode($field->id_quest).'\')"><i class="fas fa-times nomargin"></i></button>' : '';
                $no++;
                $row            = array();
                $row['no']      = '<i class="fas fa-user-circle text-blue f30"></i>';
                $row['answer']  = $field->answer;
                $row['name']    = $field->answeredby;
                $row['date']    = id_date($field->timestamp_answer, 'l, d M Y H:i A');
                $row['status']  = ($field->status_answer == 1) ? '<i class="fas fa-check-circle"></i> Terverifikasi' : '';
                $row['change']  = $change;
                $row['delete']  = $delete;
                $data[]         = $row;
            }
            echo json_encode($data);
        }

        public function get_count_answer($id){
            $id      = $this->my_encryption->decode($this->pregReps($id));
            $getData = $this->mod_forum->count_answer($id);
            echo json_encode($getData);
        }

        public function save_add_question(){
            $dataQuest = array(
                'id_user'         => $this->my_encryption->decode($this->pregReps($this->input->post('iDx'))),
                'id_cate'         => $this->pregRepn($this->input->post('category')),
                'quest_title'     => $this->pregReps($this->input->post('title')),
                'quest_desc'      => $this->pregReps($this->input->post('description')),
                'askedby'         => $this->pregReps($this->input->post('name')),
                'timestamp_quest' => date("Y-m-d H:i:s"),
                'total_answer'    => 0,
                'status_quest'    => 1,
                'isDelete'        => 0
            );
            $saveQuest = $this->mod_forum->insert_data('question', $dataQuest);
            if ($saveQuest == true) {
                echo "success";
            } else {
                echo "error";
                exit();
            }
        }

        public function save_edit_question(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('dataform')[0]['value'])); 
            $dataQuest = array(
                'id_cate'         => $this->pregRepn($this->input->post('dataform')[4]['value']),
                'quest_title'     => $this->pregReps($this->input->post('dataform')[2]['value']),
                'quest_desc'      => $this->input->post('editorData'),
                'timestamp_quest' => date("Y-m-d H:i:s")
            );
            $editQuest = $this->mod_forum->edit_data('id_quest', $id, 'question', $dataQuest);
            if ($editQuest == true) {
                echo "success";
            } else {
                echo "error";
                exit();
            }
        }

        public function save_delete_question(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id'))); 
            $dataQuest = array( 'isDelete' => 1 );
            $deleteQuest = $this->mod_forum->edit_data('id_quest', $id, 'question', $dataQuest);
            if ($deleteQuest == true) {
                echo "success";
            } else {
                echo "error";
                exit();
            }
        }

        public function save_add_answer(){
            if ($this->input->post('editorData') == "") {
                echo "error";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('dataform')[0]['value']));
            $dataAnswer = array(
                'id_quest'         => $id,
                'id_user'          => $this->session->userdata('id_user'),
                'answeredby'       => $this->pregReps($this->input->post('dataform')[1]['value']),
                'timestamp_answer' => date("Y-m-d H:i:s"),
                'isDelete'         => 0,
                'status_answer'    => 0,
                'answer'           => $this->input->post('editorData')
            );
            $saveAnswer = $this->mod_forum->insert_data('answer', $dataAnswer);
            if ($saveAnswer == true){
                $getTotalAnswer = $this->mod_forum->count_answer($id);
                $dataCount = array(
                    'total_answer' => $getTotalAnswer
                );
                $saveTotal = $this->mod_forum->edit_data('id_quest', $id, 'question', $dataCount);
                echo "success";
            } else {
                echo "error";
                exit();
            }
        }

        public function save_edit_answer(){
            if ($this->input->post('NewAnswer') == "") {
                echo "error";
                exit();
            }
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('dataform')[0]['value']));
            $dataAnswer = array(
                'timestamp_answer' => date("Y-m-d H:i:s"),
                'answer'           => $this->input->post('NewAnswer')
            );
            $saveAnswer = $this->mod_forum->edit_data('id_answer', $id, 'answer', $dataAnswer);
            if ($saveAnswer == true){
                echo "success";
            } else {
                echo "error";
                exit();
            }
        }

        public function save_delete_answer(){
            $id = $this->my_encryption->decode($this->pregReps($this->input->post('id')));
            $idx = $this->my_encryption->decode($this->pregReps($this->input->post('idx')));
            $dataAnswer = array(
                'timestamp_answer' => date("Y-m-d H:i:s"),
                'isDelete'         => 1
            );
            $deleteAnswer = $this->mod_forum->edit_data('id_answer', $id, 'answer', $dataAnswer);
            if ($deleteAnswer == true){
                $getTotalAnswer = $this->mod_forum->count_answer($idx);
                $dataCount = array(
                    'total_answer' => $getTotalAnswer
                );
                $saveTotal = $this->mod_forum->edit_data('id_quest', $idx, 'question', $dataCount);
                echo "success";
            } else {
                echo "error";
                exit();
            }
        }
    }
?>