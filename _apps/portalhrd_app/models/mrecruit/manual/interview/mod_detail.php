<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_detail extends CI_Model{

		function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number){ 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function detail_people_and_interview($id){
	    	$datax = array('b.id' => $this->pregRepn($id));
	    	$query = $this->db->from('pmanual_applicant a')
					->join('pmanual_interview b', 'a.people_id = b.people_id', 'inner')
					->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'inner')
					->where($datax)
					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_interview($id){
	    	$datax = array('a.id' => $this->pregRepn($id) );
	    	$array = array(0, 1, 2, 4);
	    	$query = $this->db->select('a.people_id, a.id, a.KodeJB, a.berkas, a.hrdteknis, a.teori, a.praktek, a.mcu, a.interview_status, a.interview_desc, b.berkas_date, b.berkas_pic, b.berkas_periksa, b.berkas_status, b.berkas_conclusion, b.berkas_conclusion_desc, b.berkas_description, b.berkas_reference, c.hrdteknis_date, c.hrd_pic, c.teknis_pic, c.hrdteknis_status, c.hrdteknis_conclusion, c.hrdteknis_conclusion_desc, c.hrdteknis_description, c.hrdteknis_reference, d.teori_date, d.teori_pic, d.teori_score, d.teori_status, d.teori_conclusion, d.teori_conclusion_desc, d.teori_description, d.teori_reference, e.praktek_date, e.praktek_pic, e.score1, e.score2, e.score3, e.score4, e.score5, e.praktek_status, e.praktek_conclusion, e.praktek_conclusion_desc, e.praktek_description, e.praktek_reference, f.mcu_date, f.mcu_result, f.mcu_conclusion, f.mcu_conclusion_desc, f.mcu_description ')
				->from('pmanual_interview a')
				->join('seleksi_berkas b', 'a.id = b.id', 'left')
				->join('seleksi_hrd_teknis c', 'a.id = c.id', 'left')
				->join('seleksi_teori d', 'a.id = d.id', 'left')
				->join('seleksi_praktek e', 'a.id = e.id', 'left')
				->join('seleksi_mcu f', 'a.id = f.id', 'left')
				->where($datax)
				->where_in('a.interview_status', $array)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	}
?>