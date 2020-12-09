<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_detail extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function detail_applicant($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.people_status' => 1 );
	    	$query = $this->db->from('pmanual_applicant a')
	    		->join('meducation_type b', 'a.people_education = b.edutype_id', 'inner')
				->where($datax)
				->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_address($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.people_status' => 1 );
	    	$query = $this->db->from('pmanual_applicant a')
	    		->join('pmanual_address b', 'a.people_id = b.people_id', 'inner')
				->where($datax)
				->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_lisence($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.people_status' => 1, 'b.lisence_status' => 1 );
	    	$query = $this->db->from('pmanual_applicant a')
	    		->join('pmanual_lisence b', 'a.people_id = b.people_id', 'inner')
				->where($datax)
				->get()
				->result();
			return $query;
	    }

	    function detail_experience($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.people_status' => 1, 'b.exp_status' => 1 );
	    	$query = $this->db->from('pmanual_applicant a')
	    		->join('pmanual_experience b', 'a.people_id = b.people_id', 'inner')
				->where($datax)
				->get()
				->result();
			return $query;
	    }

	    function detail_skill($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.people_status' => 1, 'b.skill_status' => 1 );
	    	$query = $this->db->from('pmanual_applicant a')
	    		->join('pmanual_skill b', 'a.people_id = b.people_id', 'inner')
				->where($datax)
				->get()
				->result();
			return $query;
	    }

	    function history_interview($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.people_status' => 1 );
	    	$array = array(0, 4);
	    	$query = $this->db->select('a.people_id, b.id, c.Nama as jabatan, b.interview_status, b.interview_site, b.tahap, b.tgl_melamar, b.interview_desc')
	    		->from('pmanual_applicant a')
	    		->join('pmanual_interview b', 'a.people_id = b.people_id', 'inner')
	    		->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'inner')
				->where($datax)
				->where_in($array)
				->get()
				->result();
			return $query;
	    }

	}
?>