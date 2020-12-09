<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_pengguna extends CI_Model {

		var $column_order  = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'a.people_email', 'a.people_gender', 'c.city_name', 'a.people_mobile', 'a.people_reg_date', 'a.people_birth_date', 'a.people_phone');
		var $column_search = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'a.people_email', 'a.people_gender', 'c.city_name', 'a.people_mobile', 'a.people_reg_date', 'a.people_birth_date', 'a.people_phone'); 
		var $order         = array('a.people_reg_date' => 'DESC');

	    function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
	        if($this->input->post('people_firstname')){
				$this->db->like('a.people_firstname', $this->input->post('people_firstname'));
			}
			if($this->input->post('people_middlename')){
				$this->db->like('a.people_middlename', $this->input->post('people_middlename'));
			}
			if($this->input->post('people_lastname')){
				$this->db->like('a.people_lastname', $this->input->post('people_lastname'));
			}
			if($this->input->post('people_email')){
				$this->db->like('a.people_email', $this->input->post('people_email'));
			}
			if($this->input->post('people_mobile')){
				$this->db->like('a.people_mobile', $this->input->post('people_mobile'));
			}
			if($this->input->post('domisili')){
				$this->db->like('c.city_name', $this->input->post('domisili'));
			}
			
			$this->db->distinct();
			$select = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'a.people_email', 'a.people_gender', 'c.city_name', 'a.people_mobile', 'a.people_reg_date', 'a.people_birth_date', 'a.people_phone', 
				'COUNT(d.pelamar_id) AS total_lamar');

			$this->db->select($select);
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'INNER');
			$this->db->join('WEB_1.dbo.city c', 'b.city_id = c.city_id', 'INNER');
			$this->db->join('pelamar d', 'a.people_id = d.people_id', 'LEFT');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('a.active', 1);
			$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, a.people_email, a.people_gender, c.city_name, a.people_mobile, a.people_reg_date, a.people_birth_date, a.people_phone');
	 
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
	    	$this->db->distinct();
	    	$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, a.people_email, a.people_gender, c.city_name, a.people_mobile, a.people_reg_date, a.people_birth_date, a.people_phone, COUNT(d.pelamar_id) AS total_lamar');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'INNER');
			$this->db->join('WEB_1.dbo.city c', 'b.city_id = c.city_id', 'INNER');
			$this->db->join('pelamar d', 'a.people_id = d.people_id', 'LEFT');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('a.active', 1);
			$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, a.people_email, a.people_gender, c.city_name, a.people_mobile, a.people_reg_date, a.people_birth_date, a.people_phone');
	    	return $this->db->count_all_results();
	    }

	}
?>