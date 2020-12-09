<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_choose_site extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function list_site(){
	    	$datax = array('status_active' => 1);
			$query = $this->db->select('id, code, name, status_active')
				->from('mst_site')
				->where($datax)
				->get()
				->result();
			return $query;
		}
	}
?>