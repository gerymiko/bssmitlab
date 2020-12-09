<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_global extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

	    function edit_all($field, $id, $table, $data){
			$this->db->where($field, $id);
			$this->db->update($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

		function get_change_password($id){
			$datax = array('id_user' => $this->pregRepn($id), 'logs' => 'Change Password');
			$query = $this->db->from('mos_user_log')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return 'false'; }
		}

		function get_access_rights($id_user, $site, $module){
	    	$datax = array('a.id_user' => $this->pregRepn($id_user), 'a.site' => $this->pregReps($site), 'b.name' => $this->pregReps($module));
	    	$query = $this->db->select('a.id_user, a.site, c.id_level, c.nik, a.status_active, a.id_module, b.name as module_name, a.create, a.read, a.update, a.delete, a.export, a.import')
	    		->from('mos_user_module a')
	    		->join('mos_system_module b', 'a.id_module = b.id_module AND b.status_active = 1 AND b.isdelete = 1', 'inner')
	    		->join('mos_user c', 'a.id_user = c.id_user', 'inner')
	    		->where($datax)
	    		->get();
    		if($query->num_rows() > 0 ){
	            return $query->row();
	    	} else { return false; }
	    }

	    function menu($id_user, $site){
	    	$datax = array('b.id_user' => $this->pregRepn($id_user), 'b.site' => $this->pregReps($site));
	    	$query = $this->db->select('b.id_module, c.alias, c.name, d.id_system, c.type')
	    		->from('mos_user a')
	    		->join('mos_user_module b', 'a.id_user = b.id_user AND b.status_active = 1', 'inner')
	    		->join('mos_system_module c', 'b.id_module = c.id_module AND c.status_active = 1 AND c.isdelete = 1', 'inner')
	    		->join('mos_system d', 'c.id_system = d.id_system AND d.status_active = 1', 'inner')
	    		->where($datax)
	    		->order_by('c.alias ASC')
	    		->get()
	    		->result();
	    	return $query;

	    }

	}
?>