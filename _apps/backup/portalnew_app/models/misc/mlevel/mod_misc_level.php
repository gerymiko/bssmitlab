<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_misc_level extends CI_Model {

		private $web1;

	    function __construct() {
	        parent::__construct();
			$this->web1 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

	    function list_level(){
	    	$query = $this->web1->from('users_level')
	    						->get()
	    						->result();
	    	return $query;
	    }
	}
?>