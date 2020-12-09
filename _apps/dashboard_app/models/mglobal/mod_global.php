<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_global extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function insert_batch($table, $data) {
	        $query = $this->db->insert_batch($table, $data);
	        if($query > 0){ $result = true;
		    } else { $result = false; }
			return $result;
	    }

	    function edit_all($field, $id, $table, $data){
			$this->db->where($field, $id);
			$this->db->update($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

	    function get_detailed_user($id_user){
	    	$datax = array('a.id_user' => $this->pregRepn($id_user), 'a.status_active' => 1,  );
	    	$query = $this->db->from('master_user a')
	    		->join('master_level_dtl b', 'a.idx = b.idx AND b.status_active = 1', 'inner')
	    		->join('master_level_hdr c', 'b.id_level = c.id_level AND c.status_active = 1', 'inner')
	    		->where($datax)
	    		->get();
	    	if ($query->num_rows() > 0){
	            return $query->row();
	    	} else { return false; }
	    }

	    function menu($id_user, $site){
	    	$datax = array('b.id_user' => $this->pregRepn($id_user), 'b.site' => $this->pregReps($site), 'd.id_system' => 1);
	    	$query = $this->db->select('b.id_module, c.alias, c.name, d.id_system, c.type, c.icon, c.urut')
	    		->from('master_user a')
	    		->join('master_user_module b', 'a.id_user = b.id_user AND b.status_active = 1', 'inner')
	    		->join('master_system_module c', 'b.id_module = c.id_module AND c.status_active = 1 AND c.isdelete = 0', 'inner')
	    		->join('master_system d', 'c.id_system = d.id_system AND d.status_active = 1', 'inner')
	    		->where($datax)
	    		->order_by('c.urut ASC')
	    		->get()
	    		->result();
	    	return $query;
	    }

	    function get_access_rights($id_user, $site, $module){
	    	$datax = array('a.id_user' => $this->pregRepn($id_user), 'a.site' => $this->pregReps($site), 'b.name' => $this->pregReps($module));
	    	$query = $this->db->select('a.id_user, a.site, e.id_level, c.idx, d.name as position, c.nik, a.status_active, a.id_module, b.alias, b.name as module_name, a.createx, a.readx, a.updatex, a.deletex, a.importx')
	    		->from('master_user_module a')
	    		->join('master_system_module b', 'a.id_module = b.id_module AND b.status_active = 1 AND b.isdelete = 0', 'inner')
	    		->join('master_user c', 'c.id_user = a.id_user', 'inner')
	    		->join('master_level_dtl d', 'd.idx = c.idx AND c.status_active = 1', 'inner')
	    		->join('master_level_hdr e', 'e.id_level = d.id_level AND d.status_active = 1', 'inner')
	    		->where($datax)
	    		->get();
    		if($query->num_rows() > 0 ){
	            return $query->row();
	    	} else { return false; }
	    }

	    function list_site(){
			$query = $this->db->select('id_site, code, name, status_active')
				->from('master_site')
				->order_by('code ASC')
				->get()
				->result();
			return $query;
		}

	}
?>