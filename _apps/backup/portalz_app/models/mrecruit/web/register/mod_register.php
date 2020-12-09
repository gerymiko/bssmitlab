<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_register extends CI_Model {

		var $column_order  = array(null, 'a.people_fullname', 'a.people_gender', 'c.city_name', 'a.people_email', 'a.people_phone', 'a.people_mobile', 'a.people_reg_date');
		var $column_search = array('a.people_fullname, c.city_name'); 
		var $order         = array('a.people_reg_date' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9 _.@]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_datatables_query(){
	        if($this->pregReps($this->input->post('people_fullname'))){
				$this->db->like('a.people_fullname', $this->pregReps($this->input->post('people_fullname')), 'both');
			}
			if($this->pregReps($this->input->post('people_email'))){
				$this->db->like('a.people_email', $this->pregReps($this->input->post('people_email')), 'both');
			}
			if($this->pregRepn($this->input->post('people_mobile'))){
				$this->db->like('a.people_mobile', $this->pregReps($this->input->post('people_mobile')), 'both');
			}
			if($this->pregReps($this->input->post('domisili'))){
				$this->db->like('c.city_name', $this->pregReps($this->input->post('domisili')), 'both');
			}
			
			$this->db->distinct();
			$select = array('a.people_id', 'a.people_fullname', 'a.people_email', 'a.people_gender', 'c.city_name', 'a.people_mobile', 'a.people_reg_date', 'a.people_birth_date', 'a.people_phone', 'COUNT(d.pelamar_id) AS total_lamar');
			$this->db->select($select);
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'INNER');
			$this->db->join('WEB_1.dbo.city c', 'b.city_id = c.city_id', 'INNER');
			$this->db->join('pelamar d', 'a.people_id = d.people_id', 'LEFT');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('a.active', 1);
			$this->db->group_by('a.people_id, a.people_fullname, a.people_email, a.people_gender, c.city_name, a.people_mobile, a.people_reg_date, a.people_birth_date, a.people_phone, pelamar_id');
	 
	        $i = 0;
	        foreach ($this->column_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->column_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_register($length, $start){
	        $this->_get_datatables_query();
	        if($this->pregReps($length) != -1){
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->_get_datatables_query();
	    	return $this->db->count_all_results();
	    }
	}
?>