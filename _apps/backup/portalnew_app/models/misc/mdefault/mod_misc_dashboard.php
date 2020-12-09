<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_misc_dashboard extends CI_Model {

		private $hrd; 
		private $web1;

	    function __construct() {
	        parent::__construct();
	        $this->hrd  = $this->load->database('ext2', TRUE);
			$this->web1 = $this->load->database('ext3', TRUE);
			$this->date = date("Y-m-d");
	        $this->load->database();
	    }

	    function count_all_admin_tdy(){
	        $this->web1->from('users a');
			$this->web1->join('users_level b', 'a.level_id = b.level_id', 'inner');
			$this->web1->like('a.date_create', $this->date , 'after');
	    	return $this->web1->count_all_results();
	    }

	    function count_all_admin(){
	    	$this->web1->select('a.level_id,a.bssID,a.users_fullname,a.users_email,a.users_mobile,a.users_username, a.date_create, b.level_name, a.users_status, a.is_login');
	        $this->web1->from('users a');
			$this->web1->join('users_level b', 'a.level_id = b.level_id', 'inner');
	    	return $this->web1->count_all_results();
	    }

	    function count_all_level(){
	    	$query = $this->web1->from('users_level')
	    						->where('level_status', 1)
	    						->count_all_results();
	    	return $query;
	    }

	    function count_all_section(){
	    	$query = $this->web1->from('section')
	    						->where('section_status', 1)
	    						->count_all_results();
	    	return $query;
	    }
	}
?>