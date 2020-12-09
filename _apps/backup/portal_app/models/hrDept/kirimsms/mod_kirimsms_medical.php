<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_kirimsms_medical extends CI_Model {

		private $web1;
		private $web;

		var $column_order  = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'b.city_id', 'c.tgl_melamar');
		var $column_search = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'b.city_id', 'c.tgl_melamar'); 
		var $order         = array('c.tgl_melamar' => 'DESC');

	    function __construct(){
	        parent::__construct();
			$CI         =& get_instance();
			$this->web  = $this->load->database('ext', TRUE, TRUE);
			$CI->web    =& $this->web;
			$this->web1 = $this->load->database('ext3', TRUE);
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
	 		$this->db->where('f.interview_kspm', 1);
	 		$this->db->where('f.interview_teknis', 1);
	 		$this->db->where('f.interview_hrd', 1);
	 		$this->db->where('f.tes_teori', 1);
	 		$this->db->where('f.tes_praktek', 1);
	 		$this->db->where('h.rs_id', 6);
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
	 		$this->db->where('f.interview_kspm', 1);
	 		$this->db->where('f.interview_teknis', 1);
	 		$this->db->where('f.interview_hrd', 1);
	 		$this->db->where('f.tes_teori', 1);
	 		$this->db->where('f.tes_praktek', 1);
	 		$this->db->where('h.rs_id', 6);
	 		$this->db->where('h.bridge_j_r_status', 1);
	 		$this->db->group_by('a.people_id, a.people_firstname, a.people_middlename, a.people_lastname, e.freshgraduate, a.people_birth_date, d.jabatan_alias, a.registrant_kode, g.city_name, b.city_id, c.tgl_melamar, c.pelamar_id, a.people_mobile');
	    	return $this->db->count_all_results();
	    }

	    function status_kirimsms($pelamar_id){
	    	$query = $this->db->select('a.pelamar_id, b.schedule_msg')
	    					->from('pelamar a')
    						->join('schedule b', 'a.pelamar_id = b.pelamar_id AND a.pelamar_status = 1', 'inner')
    						->where('a.pelamar_id', $pelamar_id)
    						->like('b.schedule_msg', 'MCU', 'both')
	    					->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function getcontentmsg(){
	    	$query = $this->db->select('doc_content')
	    					->from('WEB_1.dbo.docTemplate')
	    					->where('doc_temp_id', 6)
	    					->where('doc_type', 'SMS')
	    					->where('doc_web', 'BSS KARIR')
	    					->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    public function get_mcu_number($cari){
	        $hasil = $this->web->like('patient_m_number', $cari)->order_by('patient_m_id', 'desc')->limit(1)->get('WEB.dbo.patient_mcu');
	        if ($hasil->num_rows() > 0) {
	            return $hasil->row();
	        } else {
	            return false;
	        }
	    }

	    function get_clinic($clinic_id){
	    	$query = $this->web->from('WEB.dbo.clinic')
    						->where('clinic_status',1)
    						->where('clinic_id',$clinic_id)
    						->get();
	    	if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function update_status_pjv($jv_id, $pjv){
	    	$this->db->where('jv_id',$jv_id);
			$this->db->update('parameter_job_vacancy',$pjv);
			return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

	    function update_site($pelamar_id, $site){
	    	$this->db->where('pelamar_id',$pelamar_id);
			$this->db->update('pelamar',$site);
			return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

	    function getPJVPelamar($pelamar_id){
	    	$query = $this->db->from('pelamar a')
	    					->join('lowongan c', 'a.lowongan_id = c.lowongan_id AND c.lowongan_status = 1', 'INNER')
	    					->join('parameter_job_vacancy b', 'a.people_id = b.people_id AND a.pelamar_status = 1 AND b.lowongan_id = c.lowongan_id', 'INNER')
	    					->where('a.pelamar_id', $pelamar_id)
	    					->where('interview_kspm',1)
	    					->where('interview_hrd',1)
	    					->where('interview_teknis',1)
	    					->where('tes_teori',1)
	    					->where('tes_praktek',1)
	    					->get();
	    	if($query->num_rows() > 0 ):
	            return $query->row(); 
	       	else: return null;
	        endif;
	    }

	    function insertpasienmcu($pasien){
			$this->web->insert('patient_mcu', $pasien);
			return ($this->web->affected_rows() != 1 ) ? false:true;
		}

	}
?>