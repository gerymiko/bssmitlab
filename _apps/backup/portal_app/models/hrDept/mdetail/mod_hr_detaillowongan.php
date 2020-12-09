<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_detaillowongan extends CI_Model {

	    function __construct() {
	        parent::__construct();
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
	    	$query = $this->db->from('lowongan a')
	    					->join('syarat_required b', 'a.lowongan_id = b.lowongan_id', 'INNER')
	    					->join('msyarat c', 'b.syarat_id = c.syarat_id', 'INNER')
	    					->where('a.lowongan_id', $lowongan_id)
	    					->where('b.syaratreq_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	}
?>