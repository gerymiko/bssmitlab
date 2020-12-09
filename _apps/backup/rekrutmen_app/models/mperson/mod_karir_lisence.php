<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_lisence extends CI_Model {
		var $column_order  = array('b.city_name', 'a.plisence_type', 'a.plisence_number', 'a.plisence_keluaran', 'a.plisence_date_start', 'a.plisence_date_end');
		var $column_search = array('b.city_name', 'a.plisence_type', 'a.plisence_number', 'a.plisence_keluaran', 'a.plisence_date_start', 'a.plisence_date_end'); 
		var $order         = array('a.plisence_id' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query($people_id){
	    	$this->db->select('a.plisence_id, a.people_id, b.city_name, a.plisence_type, a.plisence_number, a.plisence_keluaran, a.plisence_date_start, a.plisence_date_end, a.plisence_file');
	        $this->db->from('people_lisence a');
	        $this->db->join('WEB_1.dbo.city b', 'a.plisence_keluaran = b.city_id', 'inner');
	        $this->db->where('a.people_id', $people_id);
	        $this->db->not_like('a.plisence_type', 'IJAZAH', 'both');
	        $this->db->not_like('a.plisence_type', 'KK', 'both');
	 
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

	    function get_datatables($people_id){
	        $this->_get_datatables_query($people_id);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered($people_id){
	        $this->_get_datatables_query($people_id);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all($people_id){
	    	$this->db->select('a.people_id, b.city_name, a.plisence_type, a.plisence_number, a.plisence_keluaran, a.plisence_date_start, a.plisence_date_end, a.plisence_file');
	    	$this->db->from('people_lisence a');
	        $this->db->join('WEB_1.dbo.city b', 'a.plisence_keluaran = b.city_id', 'inner');
	        $this->db->where('a.people_id', $people_id);
	        $this->db->not_like('a.plisence_type', 'IJAZAH', 'both');
	    	return $this->db->count_all_results();
	    }

	    function check_lisence($people_id){
	    	$query = $this->db->select('plisence_type')
	    					->from('people_lisence')
	    					->where('people_id', $people_id)
	    					->like('plisence_type', 'SIM', 'after')
	    					->get()
	    					->result_array();
	    	return $query;
	    }

	    function list_lisence($people_id){
	    	$query = $this->db->select('a.plisence_id, a.people_id, b.city_name, a.plisence_type, a.plisence_number, a.plisence_keluaran, a.plisence_date_start, a.plisence_date_end, a.plisence_file')
	    					->from('people_lisence a')
	    					->join('WEB_1.dbo.city b', 'a.plisence_keluaran = b.city_id', 'inner')
	    					->where('a.people_id', $people_id)
	    					->not_like('a.plisence_type', 'IJAZAH', 'both')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function save_add_sim($sim_data){
			$this->db->insert('people_lisence', $sim_data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function save_upload_lisence($plisence_id, $lisence_data){
			$this->db->where('plisence_id', $plisence_id);
	    	$this->db->update('people_lisence', $lisence_data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function get_file_lisence($plisence_id){
			$query = $this->db->select('plisence_id,plisence_file')
					->from('people_lisence')
					->where('plisence_id', $plisence_id)
					->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
		}

	}
?>