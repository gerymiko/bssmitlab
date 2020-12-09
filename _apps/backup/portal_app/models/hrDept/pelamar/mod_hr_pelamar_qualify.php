<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_pelamar_qualify extends CI_Model {

		var $column_order  = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'b.city_id', 'c.tgl_melamar');
		var $column_search = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'b.city_id', 'c.tgl_melamar'); 
		var $order         = array('c.tgl_melamar' => 'DESC');

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
			$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('pelamar c', 'a.people_id = c.people_id', 'inner');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'inner');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id');
			$this->db->join('kualifikasi h', 'c.pelamar_id = h.pelamar_id');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('d.lowongan_status', 1);
			$this->db->where('c.pelamar_status', 1);
			$this->db->where('h.kualifikasi_dt', 1);
			$this->db->where('h.kualifikasi_skill', 1);
			$this->db->where('h.kualifikasi_sertifikat', 1);
			$this->db->where('h.kualifikasi_last_edu', 1);
			$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar');

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

		public function get_datatables(){
			$this->_get_datatables_query();
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}

		public function count_filtered(){
			$this->_get_datatables_query();
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function count_all(){
			$this->db->distinct();
			$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('pelamar c', 'a.people_id = c.people_id', 'inner');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'inner');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id');
			$this->db->join('kualifikasi h', 'c.pelamar_id = h.pelamar_id');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('d.lowongan_status', 1);
			$this->db->where('c.pelamar_status', 1);
			$this->db->where('h.kualifikasi_dt', 1);
			$this->db->where('h.kualifikasi_skill', 1);
			$this->db->where('h.kualifikasi_sertifikat', 1);
			$this->db->where('h.kualifikasi_last_edu', 1);
			$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar');
			return $this->db->count_all_results();
		}

	}
?>