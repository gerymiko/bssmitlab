<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_pre_election extends CI_Model {

		var $column_order  = array('a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'f.jabatan_alias', 'c.patient_m_number', 'c.patient_m_status', 'c.patient_m_type', 'd.mcu_r_status', 'd.mcu_r_document', 'c.patient_m_created_at', 'c.patient_m_description', 'c.patient_m_updated_at', 'c.patient_m_date');
		var $column_search = array('a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'f.jabatan_alias', 'c.patient_m_number', 'c.patient_m_status', 'c.patient_m_type', 'd.mcu_r_status', 'd.mcu_r_document', 'c.patient_m_created_at', 'c.patient_m_description', 'c.patient_m_updated_at', 'c.patient_m_date');
		var $order = array('c.patient_m_date' => 'ASC');

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

	    private function _get_datatables_query(){
	  //   	if($this->input->post('people_firstname')){
			// 	$this->db->like('a.people_firstname', $this->input->post('people_firstname'));
			// }
			// if($this->input->post('people_middlename')){
			// 	$this->db->like('a.people_middlename', $this->input->post('people_middlename'));
			// }
			// if($this->input->post('people_lastname')){
			// 	$this->db->like('a.people_lastname', $this->input->post('people_lastname'));
			// }
			// if($this->input->post('jabatan_alias')){
			// 	$this->db->like('d.jabatan_alias', $this->input->post('jabatan_alias'));
			// }
			// if($this->input->post('registrant_kode')){
			// 	$this->db->like('a.registrant_kode', $this->input->post('registrant_kode'));
			// }
	    	$this->db->distinct();
	    	$this->db->select('a.people_id, a.people_fullname, f.jabatan_alias, c.patient_m_number, b.pelamar_id, c.patient_m_status, c.patient_m_type, d.mcu_r_status, d.mcu_r_document, c.patient_m_created_at, c.patient_m_description, c.patient_m_updated_at, c.patient_m_date');
	    	$this->db->from('people a');
	    	$this->db->join('pelamar b', 'a.people_id = b.people_id', 'INNER');
	    	$this->db->join('WEB.dbo.patient_mcu c', 'b.pelamar_id = c.pelamar_id', 'INNER');
	    	$this->db->join('WEB.dbo.mcu_result d', 'c.patient_m_id = d.patient_m_id', 'LEFT');
	    	$this->db->join('WEB.dbo.clinic e', 'c.clinic_id = e.clinic_id', 'INNER');
	    	$this->db->join('lowongan f', 'b.lowongan_id = f.lowongan_id', 'INNER');
	    	$this->db->where('d.mcu_r_status IS NOT NULL');
	        $i = 0;
	        foreach ($this->column_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else { $this->db->or_like($item, $this->pregReps($_POST['search']['value'])); }
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

	    function get_datatables($length, $start){
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

	    function check_status($people_id){
	    	$query = $this->db->select('people_id')
				->from('agreement')
				->where('people_id', $people_id)
				->get();
	    	if ($query->num_rows() > 0){
	            return $query->row();
	    	} else { return false; }
	    }
	}
?>