<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_site extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function list_site(){
	    	$datax = array('AKTIF' => 0);
	    	$query = $this->db->select('KodeST, Nama, AKTIF')
	    		->from('HRD.dbo.tsite')
	    		->where($datax)
	    		->get()
	    		->result();
	    	return $query;
	    }
	}
?>
