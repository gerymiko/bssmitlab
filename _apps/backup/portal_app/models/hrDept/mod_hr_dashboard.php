<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_dashboard extends CI_Model {

		private $web1;

		var $column_order  = array('users_fullname','users_status');
		var $column_search = array('users_fullname','users_status'); 
		var $order         = array('users_fullname' => 'ASC');
		
	    function __construct() {
	        parent::__construct();
	        $this->web1 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

	    function getregisteredusertoday() {
	    	$date = date("Y-m-d");
	    	$this->db->list_fields('people');
			$this->db->from('people');
			$this->db->where('people_reg_date', $date);
			return $this->db->count_all_results();
	    }

	    function getpelamartoday() {
	    	$date = date("Y-m-d");
	    	$this->db->list_fields('pelamar');
			$this->db->from('pelamar');
			$this->db->where('CAST(tgl_melamar AS DATE)=', $date);
			$this->db->where('pelamar_status', 1);
			return $this->db->count_all_results();
	    }

	    function getsectiontoday() {
	    	$date = date("Y-m-d");
	    	$this->web1->list_fields('section');
			$this->web1->from('section');
			$this->web1->where('section_date', $date);
			return $this->web1->count_all_results();
	    }

	    function getregisteredusertotal() {
	    	$this->db->list_fields('people');
			$this->db->from('people');
			return $this->db->count_all_results();
	    }

	    function getpelamartotal() {
	    	$sub = $this->db->distinct()
							->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar')
	        				->from('people a')
							->join('people_address b', 'a.people_id = b.people_id', 'inner')
							->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 1', 'inner')
							->join('lowongan d', 'c.lowongan_id = d.lowongan_id AND d.lowongan_status = 1', 'inner')
							->join('mparameter e', 'a.people_id = e.people_id', 'inner')
							->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
							->join('WEB_1.dbo.city g', 'b.city_id = g.city_id')
							->where('b.paddress_type', 'DOMISILI')
	    					->count_all_results();
	    	return $sub;
	    }

	    function getlowongantotal() {
	    	$this->db->list_fields('lowongan');
			$this->db->from('lowongan');
			$this->db->where('lowongan_status', 1);
			return $this->db->count_all_results();
	    }

	    function getlowongantotalnonaktif() {
	    	$this->db->list_fields('lowongan');
			$this->db->from('lowongan');
			$this->db->where('lowongan_status', 0);
			return $this->db->count_all_results();
	    }

	    function getdepartementotal() {
	    	$this->db->list_fields('web_departement');
			$this->db->from('web_departement');
			return $this->db->count_all_results();
	    }

	    function getjabatantotal() {
	    	$this->db->list_fields('web_jabatan');
			$this->db->from('web_jabatan');
			return $this->db->count_all_results();
	    }

	    function getlokernewtoday() {
	    	$date = date("Y-m-d");
	    	$this->db->list_fields('lowongan');
			$this->db->from('lowongan');
			$this->db->where('CAST(date_create AS DATE)=', $date);
			return $this->db->count_all_results();
	    }

	    function getpelamargagaltoday() {
	    	$date = date("Y-m-d");
	    	$this->db->list_fields('pelamar');
			$this->db->from('pelamar');
			$this->db->where('CAST(tgl_update AS DATE)=', $date);
			$this->db->where('pelamar_status', 0);
			$this->db->like('keterangan_gagal', 'Gagal');
			return $this->db->count_all_results();
	    }

	    function getinterviewtoday() {
	    	$date = date("Y-m-d");
	    	$step = array("1","2","5");
	    	$sub = $this->db->select('people_id')
	    					->from('schedule')
	    					->where('schedule_status', 2)
	    					->where('CAST(schedule_date AS DATE)=', $date)
	    					->where_in('rs_id', $step)
	    					->group_by('people_id')
	    					->count_all_results();
	    	return $sub;
	    }

	    function gettesteoritoday() {
	    	$date = date("Y-m-d");
	    	$step = array("3");
	    	$sub = $this->db->select('people_id')
	    					->from('schedule')
	    					->where('schedule_status', 2)
	    					->where('CAST(schedule_date AS DATE)=', $date)
	    					->where_in('rs_id', $step)
	    					->group_by('people_id')
	    					->count_all_results();
	    	return $sub;
	    }

	    function gettespraktektoday() {
	    	$date = date("Y-m-d");
	    	$step = array("4");
	    	$sub = $this->db->select('people_id')
	    					->from('schedule')
	    					->where('schedule_status', 2)
	    					->where('CAST(schedule_date AS DATE)=', $date)
	    					->where_in('rs_id', $step)
	    					->group_by('people_id')
	    					->count_all_results();
	    	return $sub;
	    }

	    function getmcutoday() {
	    	$date = date("Y-m-d");
	    	$step = array("6");
	    	$sub = $this->db->select('people_id')
	    					->from('schedule')
	    					->where('schedule_status', 2)
	    					->where('CAST(schedule_date AS DATE)=', $date)
	    					->where_in('rs_id', $step)
	    					->group_by('people_id')
	    					->count_all_results();
	    	return $sub;
	    }

	    function getfgtotal() {
	    	$this->db->distinct();
			$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('pelamar c', 'a.people_id = c.people_id', 'inner');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'inner');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('d.lowongan_status', 1);
			$this->db->where('c.pelamar_status', 1);
			$this->db->where('e.freshgraduate', 1);
			return $this->db->count_all_results();
	    }

	    function getqualifytotal() {
	    	$sub = $this->db->distinct()
						->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, c.tgl_melamar')
	        			->from('people a')
						->join('pelamar c', 'a.people_id = c.people_id', 'inner')
						->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner')
						->join('mparameter e', 'a.people_id = e.people_id', 'inner')
						->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
						->join('kualifikasi h', 'c.pelamar_id = h.pelamar_id', 'inner')
						->where('d.lowongan_status', 1)
						->where('c.pelamar_status', 1)
						->where('h.kualifikasi_dt', 1)
						->where('h.kualifikasi_skill', 1)
						->where('h.kualifikasi_sertifikat', 1)
						->where('h.kualifikasi_last_edu', 1)
	    				->count_all_results();
	    	return $sub;
	    }

	    function getnotqualifytotal() {
	    	$sub = $this->db->distinct()
							->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar')
	        				->from('people a')
							->join('people_address b', 'a.people_id = b.people_id', 'inner')
							->join('pelamar c', 'a.people_id = c.people_id', 'inner')
							->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner')
							->join('mparameter e', 'a.people_id = e.people_id', 'inner')
							->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
							->join('WEB_1.dbo.city g', 'b.city_id = g.city_id')
							->join('kualifikasi h', 'c.pelamar_id = h.pelamar_id')
							->where('b.paddress_type', 'DOMISILI')
							->where('d.lowongan_status', 1)
							->where('c.pelamar_status', 1)
							->where('(h.kualifikasi_dt = 0 OR h.kualifikasi_skill = 0 OR h.kualifikasi_sertifikat = 0 OR h.kualifikasi_last_edu = 0)')
	    					->count_all_results();
	    	return $sub;
	    }

	    function getpelamargagaltotal() {
	    	$this->db->distinct();
			$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar, c.pelamar_id, c.keterangan_gagal');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('pelamar c', 'a.people_id = c.people_id', 'inner');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'inner');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('c.pelamar_status', 0);
			$this->db->not_like('c.keterangan_gagal', 'membatalkan', 'both');
			$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar, c.pelamar_id, c.keterangan_gagal');
			return $this->db->count_all_results();
	    }

	    private function _get_datatables_query(){
			$this->web1->select('users_fullname,is_login');
	        $this->web1->from('users');
			$this->web1->where('is_login', 1);
	 		$this->web1->where('users_status', 1);

	        $i = 0;
	     
	        foreach ($this->column_search as $item){
	            if($_POST['search']['value']){
	                if($i===0){
	                    $this->web1->group_start(); 
	                    $this->web1->like($item, $_POST['search']['value']);
	                } else {
	                    $this->web1->or_like($item, $_POST['search']['value']);
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->web1->group_end(); 
	            }
	            $i++;
	        }

	        if(isset($_POST['order'])){
				$this->web1->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} else if(isset($this->order)){
				$order = $this->order;
				$this->web1->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_datatables(){
	        $this->_get_datatables_query();
	        if($_POST['length'] != -1)
	        $this->web1->limit($_POST['length'], $_POST['start']);
	        $query = $this->web1->get();
	        return $query->result();
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->web1->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->web1->select('users_fullname,is_login');
	        $this->web1->from('users');
			$this->web1->where('is_login', 1);
	 		$this->web1->where('users_status', 1);
	    	return $this->web1->count_all_results();
	    }

	}
?>