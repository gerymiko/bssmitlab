<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_unit extends CI_Model {

		var $table           = 'unit';
		var $col_order_unit  = array(null, 'unit', 'type_unit');
		var $col_search_unit = array('nolambung', 'unit', 'serialnumber', 'nolambung'); 
		var $order_unit      = array('type_unit' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_unit(){
	    	$datax = array('isDelete' => 0);
	        $this->db->from($this->table);
	        $this->db->where($datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_unit as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_unit) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_unit[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_unit)){
				$order = $this->order_unit;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_unit(){
	        $this->_get_unit();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_unit(){
	        $this->_get_unit();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_unit(){
	    	$datax = array('isDelete' => 0 );
	        $this->db->from($this->table);
	        $this->db->where($datax);
        	return $this->db->count_all_results();
	    }

	    function edit_unit($sn, $data){
			$this->db->where('serialnumber', $this->pregReps($sn) );
			$this->db->update('unit', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function check_unit($sn){
	    	$datax = array( 'serialnumber' => $this->pregReps($sn) );
	    	$query = $this->db->select('serialnumber, status, isDelete')
	    			->from('unit')
	        		->where($datax)
	        		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
	    }
	}
?>