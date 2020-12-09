<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_forgot extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function check_email($email){
	    	$datax = array('people_email' => $email);
	    	$query = $this->db->select('people_email, username')
	    				->from('people')
	    				->where($datax)
	    				->get();
	    	if ($query->num_rows() > 0){
				return $query->row();
			} else { return false; }
	    }

	    function insert_passgen($data){
			$this->db->insert('password_generator', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function change_password($keys){
			$row['pwdgen_status'] = 0;
			$expireDate = date('Y-m-d', strtotime(date('Y-m-d').' + 1 days'));
			$datax = array(
				'pwdgen_web'      	=> 'https://web.binasaranasukses.com/karir',
				'pwdgen_password'	=> $keys,
				'pwdgen_expired <=' => $expireDate
			);

			$query = $this->db->where($datax)
							->where('pwdgen_status', 1)
							->order_by('pwdgen_id DESC')
							->limit(1)
							->get('password_generator');
			if ($query->num_rows() > 0) {
				$this->db->where('pwdgen_id', $query->row()->pwdgen_id)->update('password_generator', $row);
				$pwdgen_users = $query->row()->pwdgen_users;
				$where = array( 'username' => $pwdgen_users ); 
				$data['password'] = $keys;
				$this->db->where($where)->update('people', $data);
				return true;
			} else {
				return false;
			}
		}

	}
?>