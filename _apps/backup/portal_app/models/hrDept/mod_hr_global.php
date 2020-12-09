<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_global extends CI_Model {

		private $web1;

		function __construct(){
	        parent::__construct();
	        $this->web1 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

		function city_autocomplete($domisili){
		    $this->web1->like('city_name', $domisili , 'both');
		    $this->web1->order_by('city_name', 'ASC');
		    $this->web1->limit(10);
		    return $this->web1->get('city')->result();
		}

		function dpeople($people_id){
	    	$this->db->list_fields('
	    		people');
	    	$this->db->from('people');
	    	$this->db->where('people_id', $people_id);
	    	$query = $this->db->get();
	        if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function kirimsmspeserta($data){
			$this->db->insert('schedule', $data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		// function kirimsmspeserta($data){
		// 	$result     = $this->db->get_where('schedule', array('pelamar_id' => $data['pelamar_id'], 'rs_id' => $data['rs_id']));
		// 	$inDatabase = (bool)$result->num_rows();

		//     if (!$inDatabase){
		//         $this->db->insert('schedule', $data);
		// 		return ($this->db->affected_rows() != 1 ) ? false:true;
		//     }
		// }

		function detailuser($users){
			$query = $this->web1->select('a.users_fullname, b.level_name')
								->from('users a')
								->join('users_level b', 'a.level_id = b.level_id', 'inner')
								->where('users_id', $users)
								->get();
			if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
		}
	}
?>