<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_person extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function detail_personal($people_id){
	    	$datax = array('people_id' => $people_id);
	    	$query = $this->db->from('people a')
					->join('WEB_1.dbo.city b', 'a.people_birth_place = b.city_id', 'INNER')
					->where($datax)
					->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return FALSE; }
	    }

		function detail_lisence($people_id){
			$datax = array('people_id' => $people_id);
			$query = $this->db->from('people_lisence a')
					->join('WEB_1.dbo.city b', 'a.plisence_keluaran = b.city_id', 'INNER')
					->where($datax)
					->not_like('a.plisence_type', 'IJAZAH', 'both')
					->get()
					->result();
	    	return $query;
		}

		function update_bio($people_id, $data){
			$datax = array('people_id' => $people_id);
			$datay = array(
				'people_firstname'   => $data['people_firstname'],
                'people_middlename'  => $data['people_middlename'], 
                'people_lastname'    => $data['people_lastname'],
                'people_birth_place' => $data['people_birth_place'],
                'people_birth_date'  => $data['people_birth_date'],
                'people_gender'      => $data['people_gender'],
                'people_religion'    => $data['people_religion'],
                'people_phone'       => $data['people_phone'],
                'people_mobile'      => $data['people_mobile'],
                'people_citizen'     => $data['people_citizen'],
                'people_blood_type'  => $data['people_blood_type'],
                'people_height'      => $data['people_height'],
                'people_weight'      => $data['people_weight'],
                'people_update_date' => date("Y-m-d H:i:s")
			);
			$this->db->where($datax);
	    	$this->db->update('people', $datay);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function get_photo($people_id) {
	    	$query = $this->db->from('people')
					->where('people_id', $people_id)
					->limit(1)
					->get();	
            if($query->num_rows() > 0 ) {
	            return $query->row(); 
            } else { return false; }
	    }

		function update_photo($people_id, $photo_data) {
			try {
				$this->db->where('people_id', $people_id)->limit(1)->update('people', $photo_data);
				return true;
			} catch(Exception $e) {
				return $e;
			}
		}

	}
?>