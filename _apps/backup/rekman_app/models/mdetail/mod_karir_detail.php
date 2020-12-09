<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_detail extends CI_Model {

		private $web; //WEB
		private $web1; //WEB_1

		function __construct() {
	        parent::__construct();
			$this->web  = $this->load->database('ext', TRUE); //WEB
			$this->web1 = $this->load->database('ext3', TRUE); //WEB_1
	        $this->load->database();
	    }

	    function detailoker($lowongan_id){
	    	$query = $this->db->from('lowongan a')
	    					->join('web_departement b', 'a.KodeDP = b.KodeDP', 'INNER')
	    					->where('lowongan_id', $lowongan_id)
	    					->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function detail_edureq($lowongan_id){
	    	$query = $this->db->from('lowongan a')
	    					->join('edu_required b', 'a.lowongan_id = b.lowongan_id', 'INNER')
	    					->join('meducation_type c', 'b.edutype_id = c.edutype_id', 'INNER')
	    					->where('a.lowongan_id', $lowongan_id)
	    					->where('b.edureq_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_skillreq($lowongan_id){
	    	$query = $this->db->from('lowongan a')
	    					->join('skill_required b', 'a.lowongan_id = b.lowongan_id', 'INNER')
	    					->join('skill c', 'b.skill_id = c.skill_id', 'INNER')
	    					->where('a.lowongan_id', $lowongan_id)
	    					->where('b.skillreq_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_syaratreq($lowongan_id){
	    	$query = $this->db->select('a.lowongan_id, c.syarat_id, c.syarat_name, c.syarat_status')
	    					->from('lowongan a')
	    					->join('syarat_required b', 'a.lowongan_id = b.lowongan_id AND b.syaratreq_status = 1', 'INNER')
	    					->join('msyarat c', 'b.syarat_id = c.syarat_id AND c.syarat_status = 1', 'INNER')
	    					->where('a.lowongan_id', $lowongan_id)
	    					->order_by('b.syaratreq_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function detail_certreq($lowongan_id){
			$query = $this->db->select("c.certificate_name")
							->from("lowongan AS a")
							->join("certificate_required AS b", "a.lowongan_id = b.lowongan_id")
							->join("mcertificate AS c", "b.certificate_id = c.certificate_id")
							->where("a.lowongan_id", $lowongan_id)
							->get()
							->result();
			return $query;
		}

		function other_jobs(){
			$query = $this->db->select("jabatan_alias,lowongan_id")
							->from("lowongan")
							->where("lowongan_status", 1)
							->order_by("lowongan_id", "random")
							->limit(5)
							->get()
							->result();
			return $query;
		}
	}
?>

