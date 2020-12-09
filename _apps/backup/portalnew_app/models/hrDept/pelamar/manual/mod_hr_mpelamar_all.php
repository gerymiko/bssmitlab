<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_mpelamar_all extends CI_Model {

		var $column_order  = array(null, 'a.people_id', ' a.tgl_melamar', 'a.people_noreg', 'a.people_fullname');
		var $column_search = array('a.people_id', 'a.people_noreg', 'a.people_fullname'); 
		var $order         = array('a.tgl_melamar' => 'DESC');

	    function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 -.]/','', $string);
            return $result;
        }

	    private function _get_datatables_query(){
	    	$cond = $this->input->post('conclusion_search');
	    	if($cond == ""){
	    		$this->db->or_not_like('b.conclusion', 4);
	    	}
	    	if ($cond == "0" ) {
				$this->db->where('b.conclusion', 0);
			}
	    	if ($cond == "1") {
				$this->db->where('b.conclusion', 1);
			}
			if ($cond == "2" ) {
				$this->db->where('b.conclusion', 2);
			}
			if ($cond == "3" ) {
				$this->db->where('b.conclusion', 3);
			}
			$people_fullname = $this->pregReps($this->input->post('people_fullname'));
			$people_noreg    = $this->pregReps($this->input->post('people_noreg'));
			$people_position = $this->pregReps($this->input->post('people_position'));
			$site            = $this->pregReps($this->input->post('site_search'));

	        if( $people_fullname ){
				$this->db->like('a.people_fullname', $people_fullname, 'both');
			}
			if( $people_noreg ){
				$this->db->where('a.people_noreg', $people_noreg);
			}
			if( $people_position ){
				$this->db->like('c.Nama', $people_position, 'both');
			}
			if( $site ){
				$this->db->where('b.interview_site', $site);
			}
			$this->db->select('a.people_id, a.tgl_melamar, a.people_noreg, a.people_fullname, a.reg_date, e.edutype_name, a.people_mobile, a.people_birth_place, a.people_birth_date, b.trainer_nik, b.interview_date, b.interview_site, b.score_teori, b.score_practice1, b.score_practice2, b.score_practice3, b.score_practice4, b.score_practice5, b.conclusion, b.conclusion_ket, b.reference, b.interview_status, c.Nama as jabatan, b.KodeJB, b.praktek_date, b.KodeJB, a.people_gender, b.teori_date, b.hrd_nik, b.teori_nik ');
	        $this->db->from('people_manual a');
			$this->db->join('interview_manual b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'inner');
			$this->db->join('meducation_type e', 'a.people_education = e.edutype_id AND e.edutype_status = 1', 'inner');
			$this->db->where('a.people_status', 1);
	 
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

	    function get_datatables(){
	        $this->_get_datatables_query();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
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

	    function getRecruitmentID() {
			date_default_timezone_set('Asia/Makassar');
			$date = date("ymd");
			
			$this->db->select_max('people_noreg','id_max',true);
			$q    = $this->db->get('people_manual');
			
			$id   = "";
			if($q->num_rows()>0){
				foreach($q->result() as $k){
					$idmaks = substr($k->id_max, 20, 3);
					$tgl = substr($k->id_max, 13, 4);
					if ($tgl == $date) {
						$tmp  = ((int)$idmaks)+1;
						$id   = sprintf("%05s", $tmp);
					} else {
						$id = "001";		
					}
				}
			} else { $id = "000"; }
			return "BSS-MRECRUIT-".$date."-".$id;
	    }

	    function insert_into_people($table, $data) {
			$execute = $this->db->insert($table, $data);
	        if($execute){
	        	return $this->db->insert_id();
	        } else { return false; }
	    }

	    function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function insert_batch($table, $data) {
	        $query = $this->db->insert_batch($table, $data);
	        if($query > 0){
		       $result = true;
		    } else {
		        $result = false;
		    }
			return $result;
	    }

	    function check_duplicate_pelamar($noktp){
	    	$datax = array('a.lisence_number' => $noktp, 'a.lisence_type' => 'KTP', 'b.people_status' => 1);
	    	$query = $this->db->from('people_lisence_manual a')
	    					->join('people_manual b', 'a.people_id = b.people_id', 'inner')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function delete_pelamar($people_id, $data){
			$this->db->where('people_id', $people_id);
			$this->db->update('people_manual', $data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function edit_interview($people_id, $data){
			$this->db->where('people_id', $people_id);
			$this->db->update('interview_manual', $data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function get_last_interview_data($people_id){
			$datax = array( 'a.people_id' => $people_id );
	    	$query = $this->db->select('a.people_id, b.people_status, a.score_teori, a.score_practice1, a.score_practice2, a.score_practice3, a.score_practice4, a.score_practice5, a.trainer_nik, a.interview_date, a.praktek_date, a.interview_site, a.KodeJB, a.conclusion, a.conclusion_ket, a.reference, a.reg_date, a.update_date, a.interview_status, b.tgl_melamar, a.teori_date, a.hrd_nik, a.teori_nik')
	    					->from('interview_manual a')
	    					->join('people_manual b', 'a.people_id = b.people_id AND b.people_status = 1', 'inner')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
		}

	}
?>