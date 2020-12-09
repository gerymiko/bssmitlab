<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_ulogin extends CI_Model {

		private $hrd;

		function __construct() {
	        parent::__construct();
	        $this->hrd  = $this->load->database('hrd', TRUE);
	        $this->load->database();
	    }

	    function check_login($nik){
	    	$query = $this->hrd->select('NIK, AKTIF, Nama')
	    					->from('TKaryawan')
	    					->where('AKTIF', 0)
	    					->where('NIK', $nik)
	    					->limit(1)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row_array(); 
	       	} else { return false; }
	    }


	}
?>