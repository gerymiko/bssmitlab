<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_modulecfg extends CI_Model {

		var $col_order_modulecfg  = array(null,'a.id', 'a.name', 'a.description', 'a.alias', 'a.status_active');
		var $col_search_modulecfg = array('a.name'); 
		var $order_modulecfg      = array('a.status_active' => 'DESC');

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

	    private function _get_module_config(){
	    	$this->db->select('a.id, a.name, a.description, a.alias, a.status_active');
	        $this->db->from('mst_system_module a');
	        $this->db->join('mst_system b', 'a.id_system = b.id AND b.id = 3 AND a.isDelete = 0', 'inner');
	        $i = 0;
	        foreach ($this->col_search_modulecfg as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_modulecfg) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_modulecfg[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_modulecfg)){
				$order = $this->order_modulecfg;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_module_config($length, $start){
	        $this->_get_module_config();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_module_config(){
	        $this->_get_module_config();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_module_config(){
	    	$this->_get_module_config();
	        return $this->db->count_all_results();
	    }

	    function list_system(){
	    	$query = $this->db->select('id, name, status_active')
	    		->from('mst_system')
	    		->get()
	    		->result();
	    	return $query;
	    }

	}
?>