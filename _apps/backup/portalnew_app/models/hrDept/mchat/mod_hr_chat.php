<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_chat extends CI_Model {

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function add_message($message, $nickname, $guid)
		{
			$data = array(
				'message'	=> (string) $message,
				'nickname'	=> (string) $nickname,
				'guid'		=> (string)	$guid,
				'timestamp'	=> time(),
			);
			  
			$this->db->insert('chat', $data);
		}
	 
		function get_messages($timestamp){
			$this->db->where('timestamp >', $timestamp);
			$this->db->order_by('timestamp', 'DESC');
			$this->db->limit(10); 
			$query = $this->db->get('messages');
			
			return array_reverse($query->result_array());
		}
	}
?>