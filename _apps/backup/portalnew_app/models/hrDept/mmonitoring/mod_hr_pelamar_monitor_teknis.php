<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class mod_hr_pelamar_monitor_teknis extends CI_Model {

		var $column_order  = array('z.people_firstname', 'z.people_middlename', 'z.people_lastname', 'z.schedule_date', 'g.pic_name', 'z.jabatan_alias', 'h.city_name', 'i.freshgraduate');
		var $column_search = array('z.people_firstname', 'z.people_middlename', 'z.people_lastname', 'z.schedule_date', 'g.pic_name', 'z.jabatan_alias', 'h.city_name', 'i.freshgraduate'); 
		var $order         = array('z.schedule_date' => 'DESC');

	    function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
	    	$cond = $this->input->post('interview_teknis');
	    	if($cond == ""){
	    		$this->db->or_not_like('x.interview_teknis', '3');
	    	}
	    	if ($cond == "2") {
				$this->db->where('x.interview_teknis', 2);
			} 
			if ($cond == "1" ) {
				$this->db->where('x.interview_teknis', 1);
			}
			if($this->input->post('bulan')){
				$this->db->where('DATEPART(MONTH, z.schedule_date) = '.$this->input->post('bulan').'');
			}
			if($this->input->post('lowongan')){
				$this->db->where('z.lowongan_id = '.$this->input->post('lowongan').'');
			}

			$this->db->distinct();
			$this->db->select('z.people_firstname, z.people_middlename, z.people_lastname, z.schedule_date, g.pic_name, z.jabatan_alias, z.pelamar_id, x.interview_teknis, h.city_name, i.freshgraduate, z.people_id, z.registrant_kode, z.lowongan_id');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT DISTINCT
								a.people_id,
								e.pelamar_id,
								c.lowongan_id,
								c.lowongan_status,
								a.people_firstname,
								a.people_middlename,
								a.people_lastname,
								e.rs_id,
								e.bridge_p_r_id,
								e.schedule_date,
								c.jabatan_alias,
								e.schedule_location,
								a.registrant_kode
							FROM
								people a
							INNER JOIN pelamar b ON a.people_id = b.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							INNER JOIN schedule e ON b.pelamar_id = e.pelamar_id AND e.rs_id = 2) z', 'x.lowongan_id = z.lowongan_id AND x.people_id = z.people_id', 'INNER');
			$this->db->join('bridge_pic_rstep f', 'z.bridge_p_r_id = f.bridge_p_r_id', 'INNER');
			$this->db->join('mpic g', 'f.pic_id = g.pic_id', 'INNER');
			$this->db->join('WEB_1.dbo.city h', 'z.schedule_location = h.city_id', 'INNER');
			$this->db->join('mparameter i', 'z.people_id = i.people_id', 'INNER');
	 
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
			$this->db->select('z.people_firstname, z.people_middlename, z.people_lastname, z.schedule_date, g.pic_name, z.jabatan_alias, z.pelamar_id, x.interview_teknis, h.city_name, i.freshgraduate');
	        $this->db->from('parameter_job_vacancy x');
	        $this->db->join('(SELECT DISTINCT
								a.people_id,
								e.pelamar_id,
								c.lowongan_id,
								c.lowongan_status,
								a.people_firstname,
								a.people_middlename,
								a.people_lastname,
								e.rs_id,
								e.bridge_p_r_id,
								e.schedule_date,
								c.jabatan_alias,
								e.schedule_location
							FROM
								people a
							INNER JOIN pelamar b ON a.people_id = b.people_id AND b.pelamar_status = 1
							INNER JOIN lowongan c ON b.lowongan_id = c.lowongan_id AND c.lowongan_status = 1
							INNER JOIN schedule e ON b.pelamar_id = e.pelamar_id AND e.rs_id = 2) z', 'x.lowongan_id = z.lowongan_id AND x.people_id = z.people_id', 'INNER');
			$this->db->join('bridge_pic_rstep f', 'z.bridge_p_r_id = f.bridge_p_r_id', 'INNER');
			$this->db->join('mpic g', 'f.pic_id = g.pic_id', 'INNER');
			$this->db->join('WEB_1.dbo.city h', 'z.schedule_location = h.city_id', 'INNER');
			$this->db->join('mparameter i', 'z.people_id = i.people_id', 'INNER');
	    	return $this->db->count_all_results();
	    }

	    function update_statuspelamar($pelamar_id, $data) {
			$this->db->where('pelamar_id',$pelamar_id);
			$this->db->update('pelamar',$data);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}
	}
?>