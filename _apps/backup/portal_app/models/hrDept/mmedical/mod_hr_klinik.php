<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_klinik extends CI_Model {

		var $column_order  = array('a.clinic_name', 'a.clinic_address', 'a.clinic_telp', 'a.clinic_price', 'a.clinic_status', 'b.city_name');
		var $column_search = array('a.clinic_name', 'a.clinic_address', 'a.clinic_telp', 'a.clinic_price', 'a.clinic_status', 'b.city_name');
		var $order         = array('a.clinic_name' => 'ASC');

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
	        $this->db->from('clinic a');
			$this->db->join('WEB_1.dbo.city b', 'a.city_id = b.city_id', 'INNER');
	 
	        $i = 0;
	     
	        foreach ($this->column_search as $item){
	            if($_POST['search']['value']){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $_POST['search']['value']);
	                } else {
	                    $this->db->or_like($item, $_POST['search']['value']);
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_datatables(){
	        $this->_get_datatables_query();
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->db->from('clinic a');
			$this->db->join('WEB_1.dbo.city b', 'a.city_id = b.city_id', 'INNER');
	    	return $this->db->count_all_results();
	    }
	    
	}
?>