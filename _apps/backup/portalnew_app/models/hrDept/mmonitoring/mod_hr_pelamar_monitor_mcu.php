<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class mod_hr_pelamar_monitor_mcu extends CI_Model {

		var $column_order  = array('a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'b.freshgraduate' , 'c.schedule_date', 'e.jabatan_alias', 'f.city_name');
		var $column_search = array('a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'b.freshgraduate' , 'c.schedule_date', 'e.jabatan_alias', 'f.city_name'); 
		var $order         = array('c.schedule_date' => 'DESC');

	    function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
			$this->db->distinct();
			$this->db->select('a.people_firstname, a.people_middlename, a.people_lastname, b.freshgraduate , c.schedule_date, f.city_name, e.jabatan_alias');
	        $this->db->from('people a');
			$this->db->join('mparameter b', 'a.people_id = b.people_id', 'INNER');
			$this->db->join('schedule c', 'a.people_id = c.people_id', 'INNER');
			$this->db->join('pelamar d', 'a.people_id = d.people_id', 'INNER');
			$this->db->join('lowongan e', 'd.lowongan_id = e.lowongan_id', 'INNER');
			$this->db->join('WEB_1.dbo.city f', 'c.schedule_location = f.city_id', 'INNER');
			$this->db->join('parameter_job_vacancy g', 'd.people_id = g.people_id AND d.lowongan_id = g.lowongan_id', 'INNER');
			$this->db->where('c.rs_id', 6);
			$this->db->where('data',1);
			$this->db->where('interview_kspm',1);
			$this->db->where('interview_teknis',1);
			$this->db->where('interview_hrd',1);
			$this->db->where('tes_teori',1);
			$this->db->where('tes_praktek',1);
			$this->db->group_by('a.people_firstname, a.people_middlename, a.people_lastname, b.freshgraduate , c.schedule_date, f.city_name, e.jabatan_alias');
	 
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
	    	$this->db->select('a.people_firstname, a.people_middlename, a.people_lastname, b.freshgraduate, c.schedule_date, f.city_name, e.jabatan_alias');
	        $this->db->from('people a');
			$this->db->join('mparameter b', 'a.people_id = b.people_id', 'INNER');
			$this->db->join('schedule c', 'a.people_id = c.people_id', 'INNER');
			$this->db->join('pelamar d', 'a.people_id = d.people_id', 'INNER');
			$this->db->join('lowongan e', 'd.lowongan_id = e.lowongan_id', 'INNER');
			$this->db->join('WEB_1.dbo.city f', 'c.schedule_location = f.city_id', 'INNER');
			$this->db->join('parameter_job_vacancy g', 'd.people_id = g.people_id AND d.lowongan_id = g.lowongan_id', 'INNER');
			$this->db->where('c.rs_id', 6);
			$this->db->where('data',1);
			$this->db->where('interview_kspm',1);
			$this->db->where('interview_teknis',1);
			$this->db->where('interview_hrd',1);
			$this->db->where('tes_teori',1);
			$this->db->where('tes_praktek',1);
			$this->db->group_by('a.people_firstname, a.people_middlename, a.people_lastname, b.freshgraduate , c.schedule_date, f.city_name, e.jabatan_alias');
	    	return $this->db->count_all_results();
	    }
	}
?>