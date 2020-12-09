<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_job extends CI_Model {
		var $column_order  = array('pjobhistory_company', 'c.Nama');
		var $column_search = array('pjobhistory_company', 'c.Nama'); 
		var $order         = array('pjobhistory_company' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function get_people_job($people_id){
	    	$query = $this->db->from('people_job_history')
	    					->where('people_id', $people_id)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    private function _get_datatables_query($people_id){
	        $this->db->from('people_job_history');
	        $this->db->where('people_id', $people_id);
	        $this->db->where('pjobhistory_status', 1);
	 
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
	    	$this->db->from('people_job_history');
	        $this->db->where('people_id', $people_id);
	        $this->db->where('pjobhistory_status', 1);
	    	return $this->db->count_all_results();
	    }

	    function update_job($id, $data){
			$this->db->where('pjobhistory_id', $id);
	    	$this->db->update('people_job_history', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function delete_job($id, $data){
			$this->db->where('pjobhistory_id', $id);
	    	$this->db->update('people_job_history', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function get_file($id){
			$query = $this->db->select('pjobhistory_file')
							->from('people_job_history')
							->where('pjobhistory_id', $id)
							->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return FALSE; }

		}

		function save_upload_job($pjobhistory_id, $job_data){
			$this->db->where('pjobhistory_id', $pjobhistory_id);
	    	$this->db->update('people_job_history', $job_data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function save_add_job($data){
			$this->db->insert('people_job_history', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }


	}
?>