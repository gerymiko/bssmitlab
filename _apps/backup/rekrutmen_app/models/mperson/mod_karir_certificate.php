<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_certificate extends CI_Model {
		var $column_order  = array('pcertificate_name, pcertificate_validity');
		var $column_search = array('pcertificate_name'); 
		var $order         = array('pcertificate_name' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_certificate_query($people_id){
	        $this->db->from('people_certificate');
	        $this->db->where('people_id', $people_id);
	        $this->db->where('pcertificate_type IS NULL');

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

	    function get_certificate($people_id){
	        $this->_get_certificate_query($people_id);
	        if($_POST['length'] != -1)
	        $this->db->limit($_POST['length'], $_POST['start']);
	        $query = $this->db->get();
	        return $query->result();
	    }

	    function count_filtered_certificate($people_id){
	        $this->_get_certificate_query($people_id);
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_certificate($people_id){
	    	$this->db->from('people_certificate');
	        $this->db->where('people_id', $people_id);
	        $this->db->where('pcertificate_type IS NULL');
	    	return $this->db->count_all_results();
	    }

	    function get_file_certificate($pcertificate_id){
			$query = $this->db->select('pcertificate_id, pcertificate_file')
					->from('people_certificate')
					->where('pcertificate_id', $pcertificate_id)
					->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
		}

		function getCertificate_name($pcertificate_name){
			$query = $this->db->select('certificate_name')
					->from('mcertificate')
					->where('certificate_id', $pcertificate_name)
					->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
		}

		function save_add_certificate($data){
			$this->db->insert('people_certificate', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function delete_certificate($pcertificate_id){
	    	$datax = array( 'pcertificate_id' => $pcertificate_id );
	    	$this->db->where($datax);
			$this->db->delete('people_certificate');
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	}
?>