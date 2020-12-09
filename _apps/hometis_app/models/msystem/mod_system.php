<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_system extends CI_Model {

		var $col_order_system  = array(null,'code', 'name', 'status_active');
		var $col_search_system = array('name'); 
		var $order_system      = array('status_active' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private function _get_system(){
	    	$this->db->select('id, code, name, description, status_active');
	        $this->db->from('mst_system');
	        $i = 0;
	        foreach ($this->col_search_system as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_system) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_system[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_system)){
				$order = $this->order_system;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_system($length, $start){
	        $this->_get_system();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_system(){
	        $this->_get_system();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_system(){
	    	$this->_get_system();
	        return $this->db->count_all_results();
	    }

	    function get_system_registered($code){
	    	$datax = array('code' => $this->pregReps($code) );
			$query = $this->db->select('id, code, name, description, status_active')
				->from('mst_system')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }
	}
?>