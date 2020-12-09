<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_variable extends CI_Model {

		var $col_order  = array(null, 'a.nama', 'a.alias', 'a.cautionValue', 'a.criticalValue');
		var $col_search = array('a.nama'); 
		var $order      = array('a.nama' => 'ASC');

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

	    private function _get_data(){
	    	$datax = array('smr', 'date');
	    	$this->db->select('a.nama, a.alias, a.jenistrans, a.cautionValue, a.criticalValue, a.greaterLess, b.code, b.ket, b.value, b.operation, b.status_active');
	        $this->db->from('tmasterVar a');
	        $this->db->join('tsatuan b', 'a.jenistrans = b.jenistrans', 'inner');
	        $this->db->where_not_in('a.nama', $datax);
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

	    function get_data($length, $start){
	        $this->_get_data();
	        if($this->pregReps($length) != -1) {
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_data();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }

	    function count_all(){
	    	$this->_get_data();
	        return $this->db->count_all_results();
	    }

	}
?>