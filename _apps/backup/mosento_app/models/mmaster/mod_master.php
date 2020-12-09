<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_master extends CI_Model {

		var $col_order_var  = array(null, 'a.nama', 'a.alias', 'a.cautionValue', 'a.criticalValue');
		var $col_search_var = array('a.nama'); 
		var $order_var      = array('a.nama' => 'ASC');

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

	    private function _get_variable(){
	    	$datax = array('smr', 'date');
	    	$this->db->select('a.nama, a.alias, a.jenistrans, a.cautionValue, a.criticalValue, a.greaterLess, b.code, b.ket, b.value, b.operation, b.status');
	        $this->db->from('tmasterVar a');
	        $this->db->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner');
	        $this->db->where_not_in('a.nama', $datax);
	 
	        $i = 0;
	     
	        foreach ($this->col_search_var as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->col_search_var) - 1 == $i) $this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->col_order_var[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order_var)){
				$order = $this->order_var;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_variable(){
	        $this->_get_variable();
	        if($this->pregReps($_POST['length']) != -1)
	        $this->db->limit($this->pregReps($_POST['length']), $this->pregReps($_POST['start']));
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_variable(){
	        $this->_get_variable();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all_variable(){
	    	$datax = array('smr', 'date');
	    	$this->db->select('a.nama, a.alias, a.jenistrans, a.cautionValue, a.criticalValue, a.greaterLess, b.code, b.ket, b.value, b.operation, b.status');
	        $this->db->from('tmasterVar a');
	        $this->db->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner');
	        $this->db->where_not_in('a.nama', $datax);
	        return $this->db->count_all_results();
	    }

	    function edit_variable($id, $data){
			$this->db->where('alias', $id);
			$this->db->update('tmasterVar', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function edit_satuan($id, $data){
			$this->db->where('code', $id);
			$this->db->update('tsatuan', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

	}
?>