<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_skill extends CI_Model {
		var $column_order  = array('b.skill_name', 'c.Nama');
		var $column_search = array('b.skill_name', 'c.Nama'); 
		var $order         = array('b.skill_name' => 'ASC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function get_skill($people_id, $data){
	    	$query = $this->db->from('jabatan_skill_bridge a, skill s, web_jabatan l')
	    					->where('a.skill_id = s.skill_id')
	    					->where('l.KodeJB = a.KodeJB')
	    					->where('l.KodeJB', $data)
	    					->where('s.skill_id NOT IN(SELECT skill_id FROM people_skill WHERE people_id = \''.$people_id.'\')')
	    					->order_by('s.skill_name ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function get_people_skill($people_id){
	    	$query = $this->db->from('people_skill')
	    					->where('people_id', $people_id)
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function save_add_skill($data){
	    	$datax = array( 
				'people_id'      => $data['people_id'],
				'skill_reg_date' => date("Y-m-d H:i:s"),
				'skill_id'       => $data['skill_id'],
				'KodeJB'         => $data['KodeJB']
	    	);
			$this->db->insert('people_skill', $datax);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    private function _get_datatables_query($people_id){
	    	$this->db->select('a.pskill_id, a.skill_id, b.skill_status, a.people_id, b.skill_name, c.Nama');
	        $this->db->from('people_skill a');
	        $this->db->join('skill b', 'a.skill_id = b.skill_id AND b.skill_status = 1', 'inner');
	        $this->db->join('web_jabatan c', 'a.KodeJB = c.KodeJB AND c.status_jabatan = 1', 'inner');
	        $this->db->where('a.people_id', $people_id);
	 
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
	    	$this->db->select('a.pskill_id, a.skill_id, b.skill_status, a.people_id, b.skill_name, c.Nama');
	        $this->db->from('people_skill a');
	        $this->db->join('skill b', 'a.skill_id = b.skill_id AND b.skill_status = 1', 'inner');
	        $this->db->join('web_jabatan c', 'a.KodeJB = c.KodeJB AND c.status_jabatan = 1', 'inner');
	        $this->db->where('a.people_id', $people_id);
	    	return $this->db->count_all_results();
	    }

	    function delete_skill($pskill_id){
	    	$datax = array( 'pskill_id' => $pskill_id );
	    	$this->db->where($datax);
			$this->db->delete('people_skill');
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	}
?>