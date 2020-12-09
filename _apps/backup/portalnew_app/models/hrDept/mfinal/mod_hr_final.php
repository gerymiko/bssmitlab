<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_final extends CI_Model {

		private $web;

		var $column_order  = array('a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'a.registrant_kode', 'c.Nama AS jabatan', 'd.Nama AS dept', 'b.agreement_ktp', 'b.agreement_created', 'b.agreement_status');
		var $column_search = array('a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'a.registrant_kode', 'c.Nama AS jabatan', 'd.Nama AS dept', 'b.agreement_ktp', 'b.agreement_created', 'b.agreement_status');
		var $order         = array('b.agreement_created' => 'DESC');

	    function __construct() {
	        parent::__construct();
	        $this->web  = $this->load->database('ext', TRUE);
	        $this->load->database();
	    }

	    private function _get_datatables_query(){	
	    	if($this->input->post('people_firstname')){
				$this->db->like('a.people_firstname', $this->input->post('people_firstname'), 'BOTH');
			}
			if($this->input->post('people_middlename')){
				$this->db->like('a.people_middlename', $this->input->post('people_middlename', 'BOTH'));
			}
			if($this->input->post('people_lastname')){
				$this->db->like('a.people_lastname', $this->input->post('people_lastname'), 'BOTH');
			}
			if($this->input->post('jabatan_alias')){
				$this->db->like('d.jabatan_alias', $this->input->post('jabatan_alias'), 'BOTH');
			}
			if($this->input->post('registrant_kode')){
				$this->db->like('a.registrant_kode', $this->input->post('registrant_kode'), 'BOTH');
			}
			if($this->input->post('bulan')){
				$this->db->where('DATEPART(MONTH, b.agreement_created) = '.$this->input->post('bulan').'');
			}
	    	$this->db->distinct();
	    	$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, a.registrant_kode, c.Nama AS jabatan, d.Nama AS dept, b.agreement_ktp, b.agreement_created, b.agreement_status');
	    	$this->db->from('people a');
	    	$this->db->join('agreement b', 'a.people_id = b.people_id', 'INNER');
	    	$this->db->join('web_jabatan c', 'b.agreement_position = c.KodeJB AND c.status_jabatan = 1', 'INNER');
	    	$this->db->join('web_departement d', 'c.KodeDP = d.KodeDP AND d.department_status = 1', 'INNER');
	 
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
	    	$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, c.Nama AS posisi, d.Nama AS Dept, b.agreement_ktp, b.agreement_created, b.agreement_status');
	    	$this->db->from('people a');
	    	$this->db->join('agreement b', 'a.people_id = b.people_id', 'INNER');
	    	$this->db->join('web_jabatan c', 'b.agreement_position = c.KodeJB AND c.status_jabatan = 1', 'INNER');
	    	$this->db->join('web_departement d', 'c.KodeDP = d.KodeDP AND d.department_status = 1', 'INNER');
	    	return $this->db->count_all_results();
	    }
	    
	}
?>