<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_module extends CI_Model {

		var $col_order  = array(null, 'a.name');
		var $col_search = array('a.name'); 
		var $order      = array('a.urut' => 'ASC');

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
	    	$datax = array();
	    	$this->db->select('a.id_module, a.id_system, a.name as module_name, b.name as system_name, a.alias, a.description, a.status_active, b.description as desc_system, a.type, a.icon, a.urut');
	        $this->db->from('master_system_module a');
	        $this->db->join('master_system b', 'a.id_system = b.id_system AND b.status_active = 1 AND a.isdelete = 0', 'inner');
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

	    function list_system(){
			$query = $this->db->select('id_system, code, name, description, status_active')
				->from('master_system')
				->get()
				->result();
			return $query;
		}

	}
?>