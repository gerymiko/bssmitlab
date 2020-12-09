<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_daftar extends CI_Model {

		private $web; 
		private $web1; 
		private $hrd;

		function __construct() {
	        parent::__construct();
			$this->web  = $this->load->database('ext', TRUE); 
			$this->web1 = $this->load->database('ext3', TRUE);
			$this->hrd  = $this->load->database('ext2', TRUE); 
	        $this->load->database();
	    }

	    function checkAvailUser($username){
	    	$datax = array(
	    		'username' => $username
	    	);
	    	$query = $this->db->select('username')
	    					->from('people')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return true; 
	       	} else { return false; }
		}

		function checkAvailKTP($idCard){
			$datax = array('plisence_number' => $idCard);
			$this->db->where($datax); 
			$query = $this->db->get('people_lisence');   
			if($query->num_rows() > 0 ) {
	            return true; 
	       	} else { return false; }
		}

		function cekKondisiKTP($ktpexist){
			$query = $this->db->select('plisence_number')
							->from('people_lisence')
							->where($ktpexist)
							->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function getCityKTP($ktpkota){
	        $query = $this->web1->from('city')
	        				->where('city_id', $ktpkota)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityLisSIMA($simAkota){
	        $query = $this->web1->from('city')
	        				->where('city_id', $simAkota)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityLisSIMB1($simB1kota){
	        $query = $this->web1->from('city')
	        				->where('city_id', $simB1kota)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityLisSIMB2($simB2kota){
	        $query = $this->web1->from('city')
	        				->where('city_id', $simB2kota)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityLisSIMB2U($simB2Ukota){
	        $query = $this->web1->from('city')
	        				->where('city_id', $simB2Ukota)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityLisSIMC($simCkota){
	        $query = $this->web1->from('city')
	        				->where('city_id', $simCkota)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getCityLisSIMD($simDkota){
	        $query = $this->web1->from('city')
	        				->where('city_id', $simDkota)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getQuestionRec(){
	    	$query = $this->db->select('recquest_id, recquest_question, recquest_group, front_show')
	    					->from('recruitment_question')
	    					->where('front_show', 1)
	    					->get()
	    					->result();
	    	return $query;
	    }
	    
	    function getSectorSelf1($sector1){
	        $query = $this->db->from('mbidang')
	        				->where('sector_id', $sector1)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getSectorSelf2($sector2){
	        $query = $this->db->from('mbidang')
	        				->where('sector_id', $sector2)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getSectorSelf3($sector3){
	        $query = $this->db->from('mbidang')
	        				->where('sector_id', $sector3)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function getSectorSelf4($sector4){
	        $query = $this->db->from('mbidang')
	        				->where('sector_id', $sector4)
	       					->get();
	       	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    // SIMPAN REGISTRASI

	    function getPeopleID() {
	    	$this->db->select_max('people_id','id_max',true);
			$q = $this->db->get('people');

	        if($q->num_rows()>0){
	            foreach($q->result() as $k){
	                $tmp = ((int)$k->id_max)+1;
	                $id  = sprintf("%1s", $tmp);
	            }
	        } else {
	            $id = "0";
	        }
	        return $id;
	    }

	    function getRecruitmentID() {
			date_default_timezone_set('Asia/Makassar');
			$date = date("ymd");
			
			$this->db->select_max('registrant_kode','id_max',true);
			$q    = $this->db->get('people');
			
			$id   = "";
			if($q->num_rows()>0){
				foreach($q->result() as $k){
					$idmaks = substr($k->id_max, 19, 5);
					$tgl = substr($k->id_max, 12, 6);
					if ($tgl == $date) {
						$tmp  = ((int)$idmaks)+1;
						$id   = sprintf("%05s", $tmp);
					}else{
						$id   = "00001";		
					}
				}
			} else {
				$id   = "00000";
			}
			return "BSS-RECRUIT-".$date."-".$id;
	    }

	    function checkBlackList(){
	    	$query = $this->hrd->select('b.NIK, b.Nama, b.NoKTP')
	    					->from('TBlackList AS a')
	    					->join('TKaryawan AS b', 'a.NIK = b.NIK', 'INNER')
	    					->get()
	    					->result_array();
	    	return $query;
	    }

	    function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function insert_json_in_db($json_people) {
	    	// var_dump($json_people);
	    	$this->db->insert('people', $json_people);
	    	if ($this->db->affected_rows() > 0) {
	    		return $this->db->insert_id();
	    	} else {
	    		return false;
	    	}
	    }

	     // Pengerjaan export to pdf est 7-5-2018 75% =COUNTIFS('2018'!$E$2:$F$99;RESUME!$A3;'2018'!$E$2:$E$99;RESUME!B$2)

	    function insert_into_people($table, $json_people) {
			$execute = $this->db->insert($table, $json_people);
	        if($execute){
	        	return $this->db->insert_id();
	        } else { return false; }
	    }

	    function insert_question($table, $data) {
	        $this->db->insert_batch($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }


	}
?>