<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_profile extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function getData_user($nik){
			$query = $this->db->select('a.nik, a.nama, a.email, a.kodest, b.Nama as site, a.username, a.phone, a.last_ip, a.register_date, a.update_date, a.jabatan')
				->from('mos_user a')
				->join('HRD.dbo.tsite b', 'a.kodest = b.KodeST', 'inner')
				->where('a.nik', $nik)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function get_user($nik){
			$query = $this->db->select('a.nik, a.nama, a.email, a.kodest, b.Nama as site, a.phone, a.jabatan')
				->from('mos_user a')
				->join('HRD.dbo.tsite b', 'a.kodest = b.KodeST', 'inner')
				->where('a.nik', $nik)
				->get()
				->result();
			return $query;
		}

		function edit_data($nik, $data){
			$this->db->where('nik', $nik);
			$this->db->update('mos_user', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function edit_recovery($nik, $data){
			$this->db->where('nik', $nik);
			$this->db->update('mos_user_recovery', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function check_recovery_data($nik){
			$query = $this->db->select('nik, email, phone')
				->from('mos_user_recovery')
				->where('nik', $nik)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

	}
?>