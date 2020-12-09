<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_forum extends CI_Model{

		var $column_order  = array(null, 'a.quest_title');
		var $column_search = array('a.quest_title'); 
		var $order         = array('a.timestamp_quest' => 'DESC');

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
	    }

	    private static function pregRepn($number){ 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function insert_data($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function edit_data($field, $id, $table, $data){
			$this->db->where($field, $this->pregRepn($id));
			$this->db->update($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

	    private function _get_datatables_query(){
	    	if( $this->pregReps($this->input->post('stitle')) ){
				$this->db->like('a.quest_title', $this->pregReps($this->input->post('stitle')), 'both');
			}
			$datax = array( 'a.isDelete' => 0 );
			$this->db->select('a.id_quest, a.id_user, a.timestamp_quest, a.quest_title, a.quest_desc, a.status_quest, a.total_answer, a.askedby, b.name_cate');
	        $this->db->from('question a');
	        $this->db->join('category b', 'a.id_cate = b.id_cate AND b.isDelete = 0', 'inner');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->column_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
	        	$this->db->order_by($this->pregReps($this->column_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_datatables($length, $start){
	        $this->_get_datatables_query();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->_get_datatables_query();
	    	return $this->db->count_all_results();
	    }

	    function detail_question($id){
	    	$datax = array( 'a.id_quest' => $this->pregRepn($id), 'a.isDelete' => 0 );
	    	$query = $this->db->select('a.id_quest, a.id_user, a.timestamp_quest, a.quest_title, a.quest_desc, a.status_quest, a.total_answer, a.askedby, b.id_answer, b.answer, b.status_answer, b.timestamp_answer, b.answeredby')
	    		->from('question a')
	    		->join('answer b', 'a.id_quest = b.id_quest', 'left')
				->where($datax)
				->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_answer($id){
	    	$datax = array( 'a.id_quest' => $this->pregRepn($id), 'a.isDelete' => 0, 'b.isDelete' => 0 );
	    	$query = $this->db->select('a.id_quest, b.id_user, a.timestamp_quest, a.quest_title, a.quest_desc, a.status_quest, a.total_answer, a.askedby, b.id_answer, b.answer, b.status_answer, b.timestamp_answer, b.answeredby')
	    		->from('question a')
	    		->join('answer b', 'a.id_quest = b.id_quest', 'left')
				->where($datax)
				->get()
				->result();
			return $query;
	    }

	    function get_detail_answer($id){
	    	$datax = array( 'id_answer' => $this->pregRepn($id), 'isDelete' => 0, );
	    	$query = $this->db->from('answer')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function count_answer($id){
	    	$datax = array( 'id_quest' => $this->pregRepn($id), 'isDelete' => 0 );
	    	$query = $this->db->select('id_quest')
	    		->from('answer')
				->where($datax)
				->count_all_results();
			return $query;
	    }

	    function question_basedon_category(){
	    	$datax = array( 'a.isDelete' => 0, 'b.isDelete' => 0 );
	    	$query = $this->db->select('b.name_cate, COUNT(a.id_cate) as countQuest')
	    		->from('question a')
	    		->join('category b', 'a.id_cate = b.id_cate', 'left')
	    		->where($datax)
	    		->group_by('b.name_cate')
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function count_all_question(){
	    	$datax = array( 'isDelete' => 0 );
	    	$query = $this->db->select('id_quest')
	    		->from('question')
	    		->where($datax)
	    		->count_all_results();
	    	return $query;
	    }

	    function list_category(){
	    	$datax = array('isDelete' => 0);
	    	$query = $this->db->select('id_cate, name_cate')
	    		->from('category')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }

	}
?>