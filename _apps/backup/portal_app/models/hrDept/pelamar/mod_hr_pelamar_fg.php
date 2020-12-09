<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_pelamar_fg extends CI_Model {

		var $column_order  = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'c.freshgraduate', 'a.people_birth_date', 'f.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'b.city_id', 'd.tgl_melamar');
		var $column_search = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'c.freshgraduate', 'a.people_birth_date', 'f.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'b.city_id', 'd.tgl_melamar');
		var $order         = array('d.tgl_melamar' => 'DESC');

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
			if($this->input->post('jabatan_alias')){
				$this->db->like('d.jabatan_alias', $this->input->post('jabatan_alias'));
			}
			if($this->input->post('registrant_kode')){
				$this->db->like('a.registrant_kode', $this->input->post('registrant_kode'));
			}
			if($this->input->post('domisili')){
				$this->db->like('g.city_name', $this->input->post('domisili'));
			}

			$this->db->distinct();
			$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, c.freshgraduate, a.people_birth_date, f.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, d.tgl_melamar');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'INNER');
			$this->db->join('mparameter c', 'b.people_id = c.people_id', 'INNER');
			$this->db->join('pelamar d', 'c.people_id = d.people_id', 'LEFT OUTER');
			$this->db->join('parameter_job_vacancy e', 'd.lowongan_id = e.lowongan_id', 'LEFT OUTER');
			$this->db->join('lowongan f', 'e.lowongan_id = f.lowongan_id', 'LEFT OUTER');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'INNER');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('c.freshgraduate', 1);
			$this->db->where('d.pelamar_status', 1);
			$this->db->where('f.lowongan_status', 1);
			$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, c.freshgraduate, a.people_birth_date, f.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, d.tgl_melamar');
	 
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
			$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, c.freshgraduate, a.people_birth_date, f.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, d.tgl_melamar');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'INNER');
			$this->db->join('mparameter c', 'b.people_id = c.people_id', 'INNER');
			$this->db->join('pelamar d', 'c.people_id = d.people_id', 'LEFT OUTER');
			$this->db->join('parameter_job_vacancy e', 'd.lowongan_id = e.lowongan_id', 'LEFT OUTER');
			$this->db->join('lowongan f', 'e.lowongan_id = f.lowongan_id', 'LEFT OUTER');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'INNER');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('c.freshgraduate', 1);
			$this->db->where('d.pelamar_status', 1);
			$this->db->where('f.lowongan_status', 1);
			$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, c.freshgraduate, a.people_birth_date, f.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, d.tgl_melamar');
	    	return $this->db->count_all_results();
	    }
	}
?>