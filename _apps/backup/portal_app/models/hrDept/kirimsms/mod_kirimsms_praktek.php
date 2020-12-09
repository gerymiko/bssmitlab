<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_kirimsms_praktek extends CI_Model {

		var $column_order = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'b.city_id', 'c.tgl_melamar');
	    var $column_search = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'b.city_id', 'c.tgl_melamar'); 
	    var $order         = array('c.tgl_melamar' => 'DESC');

	    function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query(){
	    	$cond = $this->input->post('freshgraduate');
	    	if($cond == ""){
	    		$this->db->or_not_like('e.freshgraduate', '2');
	    	}
	    	if ($cond == "1") {
				$this->db->where('e.freshgraduate', 1);
			} 
			if ($cond == "0" ) {
				$this->db->where('e.freshgraduate', 0);
			}
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
			$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar, c.pelamar_id, a.people_mobile');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('pelamar c', 'a.people_id = c.people_id', 'inner');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'inner');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner');
			$this->db->join('bridge_jabatan_rstep h', 'd.KodeJB = h.KodeJB', 'inner');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('d.lowongan_status', 1);
			$this->db->where('c.pelamar_status', 1);
	 		$this->db->where('h.rs_id', 4);
	 		$this->db->where('h.bridge_j_r_status', 1);
	 		$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar, c.pelamar_id, a.people_mobile');

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
			$this->db->select('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar, c.pelamar_id, a.people_mobile');
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('pelamar c', 'a.people_id = c.people_id', 'inner');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'inner');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner');
			$this->db->join('bridge_jabatan_rstep h', 'd.KodeJB = h.KodeJB', 'inner');
			$this->db->where('b.paddress_type', 'DOMISILI');
			$this->db->where('d.lowongan_status', 1);
			$this->db->where('c.pelamar_status', 1);
	 		$this->db->where('h.rs_id', 4);
	 		$this->db->where('h.bridge_j_r_status', 1);
	 		$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar, c.pelamar_id, a.people_mobile');
	    	return $this->db->count_all_results();
	    }

	    function status_kirimsms($pelamar_id){
	    	$query = $this->db->select('b.schedule_msg')
	    						->from('pelamar a')
	    						->join('schedule b', 'a.pelamar_id = b.pelamar_id AND a.pelamar_status = 1', 'inner')
	    						->where('a.pelamar_id', $pelamar_id)
	    						->like('b.schedule_msg', 'praktek', 'both')
	    						->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function pic_praktek(){
	    	$query = $this->db->select('a.pic_id, a.pic_name')
	    					->from('mpic a')
	    					->join('bridge_pic_rstep b', 'a.pic_id = b.pic_id', 'INNER')
	    					->where('b.rs_id', 4)
	    					->group_by('a.pic_id, a.pic_name')
	    					->order_by('a.pic_name')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function cekstatuspic($pic_praktek, $rs_id){
	    	$query = $this->db->select('bridge_p_r_id')
	    					->from('bridge_pic_rstep')
	    					->where('pic_id', $pic_praktek)
	    					->where('rs_id', $rs_id)
	    					->where('bridge_p_r_status', 1)
	    					->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function getcontentmsg(){
	    	$query = $this->db->select('doc_content')
	    					->from('WEB_1.dbo.docTemplate')
	    					->where('doc_temp_id', 5)
	    					->where('doc_type', 'SMS')
	    					->where('doc_web', 'BSS KARIR')
	    					->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }
	}
?>