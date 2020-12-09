<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_global extends CI_Model {

		private $web; //WEB
		private $web1; //WEB_1

		function __construct() {
	        parent::__construct();
			$this->web  = $this->load->database('ext', TRUE); //WEB
			$this->web1 = $this->load->database('ext3', TRUE); //WEB_1
	        $this->load->database();
	    }

	    function certificate_autocomplete($certificate_name){
		    $this->db->like('certificate_name', $certificate_name , 'both');
		    $this->db->order_by('certificate_name', 'ASC');
		    $this->db->limit(10);
		    return $this->db->get('mcertificate')->result();
		}

		function list_jabatan_autocomplete($list_jabatan){
		    $this->db->like('Nama', $list_jabatan , 'both');
		    $this->db->order_by('Nama', 'ASC');
		    $this->db->limit(10);
		    return $this->db->get('web_jabatan')->result();
		}

	    function getCity() {
	    	$query = $this->web1->from('city')
	    					->order_by('city_name ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function getProvince() {
	    	$query = $this->web1->select('b.province_name')
	    					->from('city a')
	    					->join('province b', 'a.province_id = b.province_id', 'inner')
	    					->group_by('b.province_name')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function getEducation(){
	        $query = $this->db->from('meducation_type')
	        				->where('edutype_status', 1)
	        				->order_by('edutype_id ASC')
	       					->get()
	       					->result();
	       	return $query;
	    }

	    function getMajor(){
	    	$query = $this->db->from('mjurusan')
	        				->where('major_status',1)
	       					->get() 
	       					->result();
	       	return $query;
	    }

	    function getSector(){
	    	$query = $this->db->from('mbidang')
	        				->where('sector_status', 1)
	       					->get()
	       					->result();
	       	return $query;
	    }

	    function getMajorSelf($major){
	        $query = $this->db->from('mjurusan')
	        				->where('major_id', $major)
	        				->where('major_status',1)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getEduSelf($jenjang){
	        $query = $this->db->from('meducation_type')
	        				->where('edutype_id', $jenjang)
	        				->where('edutype_status',1)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityBorn($bplace){
	        $query = $this->web1->from('city')
	        				->where('city_id', $bplace)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityAddKTP($kotaktp){
	        $query = $this->web1->from('city')
	        				->where('city_id', $kotaktp)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityAddDOM($kotadom){
	        $query = $this->web1->from('city')
	        				->where('city_id', $kotadom)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityCollage($edukota){
	        $query = $this->web1->from('city')
	        				->where('city_id', $edukota)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function list_jabatan(){
	    	$query = $this->db->select('a.KodeJB, a.KodeDP, a.Nama as jabatan, a.status_jabatan, b.Nama')
	    					->from('web_jabatan a')
	    					->join('web_departement b', 'a.KodeDP = b.KodeDP', 'INNER')
	    					->where('status_jabatan', 1)
	    					->group_by('a.KodeJB, a.KodeDP, a.Nama, a.status_jabatan, b.Nama')
	    					->order_by('jabatan ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function list_certificate(){
	    	$query = $this->db->from('mcertificate')
	    					->where('certificate_status', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }

	}
?>