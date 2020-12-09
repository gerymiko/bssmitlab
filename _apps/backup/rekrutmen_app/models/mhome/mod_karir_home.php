<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_home extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function loker(){
	    	$query = $this->db->select('lowongan_status')
	    					->from('lowongan')
	    					->where('lowongan_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function user(){
	    	$query = $this->db->select('active')
	    					->from('people')
	    					->where('active', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function pelamar(){
	    	$query = $this->db->select('pelamar_status')
	    					->from('pelamar')
	    					->where('pelamar_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function jabatan(){
	    	$query = $this->db->select('status_jabatan')
	    					->from('web_jabatan')
	    					->where('status_jabatan', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	}
?>