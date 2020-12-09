<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_fault extends CI_Model {

		var $table            = 'fault';
		var $col_order_fault  = array(null, 'nolambung', 'count');
		var $col_search_fault = array('nolambung', 'ket'); 
		var $order_fault      = array('fromJam' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_fault_unit(){

	        $this->db->from($this->table);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_fault as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_fault) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_fault[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_fault)){
				$order = $this->order_fault;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_fault_unit(){
	        $this->_get_fault_unit();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_fault_unit(){
	        $this->_get_fault_unit();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_fault_unit(){
	    	$this->db->from($this->table);
        	return $this->db->count_all_results();
	    }

	    function count_all_fault_unit_today(){
	    	$datax = array('fromJam' => ''.date("Y-m-d").'');
	    	$query = $this->db->select('fromJam')
	    			->from('fault')
	        		->like($datax)
	        		->count_all_results();
	    	return $query;
	    }

	}
?>