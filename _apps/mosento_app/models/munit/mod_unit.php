<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_unit extends CI_Model {

		var $col_order  = array(null, 'unit', 'type_unit', 'serialnumber', 'nolambung', 'lastupdate', 'status');
		var $col_search = array('nolambung', 'unit', 'serialnumber', 'nolambung'); 
		var $order      = array('type_unit' => 'ASC');

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

	    private function _get_unit(){
	    	$datax = array('isDelete' => 0);
	        $this->db->from('unit');
	        $this->db->where($datax);
	        $i = 0;
	        foreach ($this->col_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit($length, $start){
	        $this->_get_unit();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_unit();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all(){
	    	$this->_get_unit();
        	return $this->db->count_all_results();
	    }
	}
?>