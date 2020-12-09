<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_masterskill extends CI_Model {

		private $web1;

		var $column_order  = array('a.skill_name', 'a.skill_id', 'c.Nama', 'a.skill_status');
		var $column_search = array('a.skill_name', 'a.skill_id', 'c.Nama', 'a.skill_status'); 
		var $order         = array('c.Nama' => 'ASC');

	    function __construct() {
	        parent::__construct();
	        $this->web1 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
			$this->db->select('a.skill_name, a.skill_id, c.Nama, a.skill_status');
	        $this->db->from('skill a');
			$this->db->join('jabatan_skill_bridge b', 'a.skill_id = b.skill_id', 'INNER');
			$this->db->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'LEFT OUTER');
	 
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
	    	$this->db->select('a.skill_name, a.skill_id, c.Nama, a.skill_status');
	        $this->db->from('skill a');
			$this->db->join('jabatan_skill_bridge b', 'a.skill_id = b.skill_id', 'INNER');
			$this->db->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'LEFT OUTER');
	    	return $this->db->count_all_results();
	    }

	    function totalskill(){
	    	$query = $this->db->select('c.Nama, COUNT(*) AS total')
	    					->from('skill a')
	    					->join('jabatan_skill_bridge b', 'a.skill_id = b.skill_id', 'INNER')
	    					->join('web_jabatan c', 'b.KodeJB = c.KodeJB', 'LEFT OUTER')
	    					->where('a.skill_status', 1)
	    					->order_by('c.Nama')
	    					->group_by('c.Nama')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function addmasterskill($skill){
	    	if($this->db->insert('skill', $skill)){
				return $this->db->insert_id();
            }
            return false;
		}

		function addmasterskillbridge($skillbridge){
			$this->db->insert('jabatan_skill_bridge', $skillbridge);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function update_skill($skill_id,$data){
			$this->db->where('skill_id', $skill_id);
			$this->db->update('skill', $data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function insertLogs($datos){
	    	$this->web1->insert('web_logs', $datos);
			return ($this->web1->affected_rows() != 1 ) ? false:true;
	    }
		
	}
?>