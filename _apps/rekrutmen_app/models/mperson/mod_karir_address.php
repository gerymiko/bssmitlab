<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_address extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

		function detail_address_ktp($people_id){
			// $datax = array(
			// 	'a.people_id'     => $people_id,
			// 	'a.paddress_type' => 'KTP'
			// );
	    	$query = $this->db->from('people_address a')
		    		->join('WEB_1.dbo.city b', 'a.city_id = b.city_id', 'inner')
		    		->where('a.people_id',$people_id)
		    		->where('a.paddress_type', 'KTP')
		    		->get();		
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return FALSE; }
	    }

	    function detail_address_domisili($people_id){
	  //   	$datax = array(
			// 	'a.people_id'     => $people_id,
			// 	'a.paddress_type' => 'DOMISILI'
			// );
	    	$query = $this->db->from('people_address a')
		    		->join('WEB_1.dbo.city b', 'a.city_id = b.city_id', 'inner')
		    		->where('a.people_id',$people_id)
		    		->where('a.paddress_type', 'DOMISILI')
		    		->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return FALSE; }
	    }

	    function update_address1($paddress_id, $data){
	    	$dataid = array('paddress_id' => $paddress_id);
			$this->db->where($dataid);
	    	$this->db->update('people_address', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function update_address2($paddress_id, $data){
			$dataid = array('paddress_id' => $paddress_id);
			$this->db->where($dataid);
	    	$this->db->update('people_address', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

	}
?>