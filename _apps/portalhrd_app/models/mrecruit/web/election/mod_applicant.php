<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_applicant extends CI_Model {

		var $column_order  = array(null, 'e.freshgraduate', 'd.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'c.tgl_melamar');
		var $column_search = array('a.people_fullname','e.freshgraduate', 'd.jabatan_alias', 'a.registrant_kode', 'g.city_name', 'c.tgl_melamar'); 
		var $order = array('c.tgl_melamar' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function detail_applicant($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id) );
	    	$query = $this->db->from('people a')
				->join('WEB_1.dbo.city b', 'a.people_birth_place = b.city_id', 'INNER')
				->where($datax)
				->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_addr_hometown($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.paddress_type' => 'KTP' );
	    	$query = $this->db->from('people_address a')
				->join('WEB_1.dbo.city b', 'a.city_id = b.city_id', 'INNER')	    	
				->where($datax)
				->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_addr_domicile($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.paddress_type' => 'DOMISILI' );
	    	$query = $this->db->from('people_address a')
				->join('WEB_1.dbo.city b', 'a.city_id = b.city_id', 'INNER')	    	
				->where($datax)
				->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_eduformal($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id) );
	    	$query = $this->db->from('people_education a')
				->join('WEB_1.dbo.city b', 'a.edu_place = b.city_id AND a.edu_status = 1', 'INNER')
				->join('meducation_type c', 'a.edutype_id = c.edutype_id AND c.edutype_status = 1', 'INNER')
				->join('mjurusan d', 'a.edu_jurusan = d.major_id AND d.major_status = 1', 'INNER')
				->where($datax)
				->order_by('a.edutype_id DESC')
				->limit(1)
				->get()
				->result();
	        return $query;
	    }

	    function detail_eduinformal($id){
	    	$datax = array( 'people_id' => $this->pregRepn($id), 'informaledu_status' => 1 );
	    	$query = $this->db->from('people_informal_education')
	    		->where($datax)
				->get()
				->result();
	        return $query;
	    }

	    function detail_lisence($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id) );
	    	$like = array('KK', 'IJAZAH');
	    	$query = $this->db->from('people_lisence a')
				->join('WEB_1.dbo.city b', 'a.plisence_keluaran = b.city_id', 'INNER')
				->where($datax)
				->where_not_in('a.plisence_type', $like)
				->get()
				->result();
	        return $query;
	    }

	    function detail_status($id){
	    	$datax = array( 'people_id' => $this->pregRepn($id) );
	    	$query = $this->db->from('people_status')
				->where($datax)
				->get();
	        if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function detail_experiance($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id), 'a.pjobhistory_status' => 1 );
	    	$query = $this->db->from('people_job_history a')
				->join('mbidang b', 'a.pjobhistory_bidang = b.sector_id', 'INNER')
				->where($datax)
				->get();
	        return $query->result();
	    }

	    function detail_question($id){
	    	$datax = array( 'a.people_id' => $this->pregRepn($id) );
	    	$query = $this->db->from('people_answer a')
				->join('recruitment_question b', 'a.recquest_id = b.recquest_id', 'INNER')
				->where($datax)
				->get();
	        return $query->result();
	    }

	    private function _get_datatables_query(){
	    	$cond = $this->pregReps($this->input->post('freshgraduate'));
	    	if($cond == ""){
	    		$this->db->or_not_like('e.freshgraduate', '3');
	    	}
	    	if ($cond == "1") {
				$this->db->where('e.freshgraduate', 1);
			} 
			if ($cond == "0" ) {
				$this->db->where('e.freshgraduate', 0);
			}
	        if($this->pregReps($this->input->post('people_fullname'))){
				$this->db->like('a.people_fullname', $this->pregReps($this->input->post('people_fullname')), 'both');
			}
			if($this->pregReps($this->input->post('KodeJB'))){
				$this->db->like('d.KodeJB', $this->pregReps($this->input->post('KodeJB')));
			}
			if($this->pregReps($this->input->post('domisili'))){
				$this->db->like('g.city_name', $this->pregReps($this->input->post('domisili')));
			}
			// $cond2 = $this->pregReps($this->input->post('status_interview'));
	  //   	if($cond2 == ""){
	  //   		$this->db->or_not_like('e.freshgraduate', '3');
	  //   	}
	  //   	if ($cond2 == "1") {
			// 	$this->db->where('e.freshgraduate', 1);
			// } 
			// if ($cond2 == "0" ) {
			// 	$this->db->where('e.freshgraduate', 0);
			// }
			$this->db->distinct();
			$arrayField = array('a.people_id', 'a.people_firstname', 'a.people_middlename', 'a.people_lastname', 'e.freshgraduate', 'a.people_birth_date', 'd.jabatan_alias', 'a.registrant_kode', 'a.people_gender', 'g.city_name', 'b.city_id', 'c.tgl_melamar', 'c.pelamar_id', 'a.people_fullname', 'a.people_mobile');
			// $array = array(1, 2);
			$this->db->select($arrayField);
	        $this->db->from('people a');
			$this->db->join('people_address b', 'a.people_id = b.people_id', 'inner');
			$this->db->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 1', 'inner');
			$this->db->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner');
			$this->db->join('mparameter e', 'a.people_id = e.people_id', 'inner');
			$this->db->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner');
			$this->db->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner');
			$this->db->join('schedule h', 'c.pelamar_id = h.pelamar_id AND h.schedule_status = 2', 'LEFT');
			$this->db->where('b.paddress_type', 'DOMISILI');
			// $this->db->where_in('h.schedule_status', $array);
			$this->db->group_by($arrayField);
	 
	        $i = 0;
	        foreach ($this->column_search as $item){
	            if($this->pregReps($_POST['search']['value'])){
	                if($i===0){
	                    $this->db->group_start(); 
	                    $this->db->like($item, $this->pregReps($_POST['search']['value']));
	                } else {
	                    $this->db->or_like($item, $this->pregReps($_POST['search']['value']));
	                }
	                if(count($this->column_search) - 1 == $i) 
	                	$this->db->group_end(); 
	            }
	            $i++;
	        }
	        if(isset($_POST['order'])){
				$this->db->order_by($this->pregReps($this->column_order[$_POST['order']['0']['column']]), $this->pregReps($_POST['order']['0']['dir']));
			} else if(isset($this->order)){
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
	    }

	    function get_applicant($length, $start){
	        $this->_get_datatables_query();
	        if($this->pregReps($length) != -1){
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered(){
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all(){
	    	$this->_get_datatables_query();
	    	return $this->db->count_all_results();
	    }

	    function status_pelamar($pelamar_id){
	    	$datax = array( 'a.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('b.schedule_msg')
				->from('pelamar a')
				->join('schedule b', 'a.pelamar_id = b.pelamar_id AND a.pelamar_status = 1', 'inner')
				->where($datax)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_sms_kspm($pelamar_id){
	    	$datax = array( 'c.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('a.people_id, a.people_firstname')
        		->from('people a')
				->join('people_address b', 'a.people_id = b.people_id', 'inner')
				->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 1', 'inner')
				->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner')
				->join('mparameter e', 'a.people_id = e.people_id', 'inner')
				->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
				->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner')
				->join('bridge_jabatan_rstep h', 'd.KodeJB = h.KodeJB AND h.rs_id = 5 AND h.bridge_j_r_status = 1', 'inner')
				->where('b.paddress_type', 'DOMISILI')
				->where($datax)
 				->group_by('a.people_id, a.people_firstname')
 				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_sms_teori($pelamar_id){
	    	$datax = array( 'c.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('a.people_id, a.people_firstname')
        		->from('people a')
				->join('people_address b', 'a.people_id = b.people_id', 'inner')
				->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 1', 'inner')
				->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner')
				->join('mparameter e', 'a.people_id = e.people_id', 'inner')
				->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
				->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner')
				->join('bridge_jabatan_rstep h', 'd.KodeJB = h.KodeJB AND h.rs_id = 3 AND h.bridge_j_r_status = 1', 'inner')
				->where('b.paddress_type', 'DOMISILI')
				->where($datax)
 				->group_by('a.people_id, a.people_firstname')
 				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_sms_teknis($pelamar_id){
	    	$datax = array( 'c.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('a.people_id, a.people_firstname')
        		->from('people a')
				->join('people_address b', 'a.people_id = b.people_id', 'inner')
				->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 1', 'inner')
				->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner')
				->join('mparameter e', 'a.people_id = e.people_id', 'inner')
				->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
				->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner')
				->join('bridge_jabatan_rstep h', 'd.KodeJB = h.KodeJB AND h.rs_id = 2 AND h.bridge_j_r_status = 1', 'inner')
				->where('b.paddress_type', 'DOMISILI')
				->where($datax)
 				->group_by('a.people_id, a.people_firstname')
 				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_sms_praktek($pelamar_id){
	    	$datax = array( 'c.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('a.people_id, a.people_firstname')
        		->from('people a')
				->join('people_address b', 'a.people_id = b.people_id', 'inner')
				->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 1', 'inner')
				->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner')
				->join('mparameter e', 'a.people_id = e.people_id', 'inner')
				->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
				->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner')
				->join('bridge_jabatan_rstep h', 'd.KodeJB = h.KodeJB AND h.rs_id = 4 AND h.bridge_j_r_status = 1', 'inner')
				->where('b.paddress_type', 'DOMISILI')
				->where($datax)
 				->group_by('a.people_id, a.people_firstname')
 				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_sms_mcu($pelamar_id){
	    	$datax = array( 'c.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('a.people_id, a.people_firstname')
        		->from('people a')
				->join('people_address b', 'a.people_id = b.people_id', 'inner')
				->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 1', 'inner')
				->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner')
				->join('mparameter e', 'a.people_id = e.people_id', 'inner')
				->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
				->join('WEB_1.dbo.city g', 'b.city_id = g.city_id', 'inner')
				->join('bridge_jabatan_rstep h', 'd.KodeJB = h.KodeJB AND h.rs_id = 6 AND h.bridge_j_r_status = 1', 'inner')
				->where('b.paddress_type', 'DOMISILI')
				->where($datax)
 				->group_by('a.people_id, a.people_firstname')
 				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_sent_sms_kspm($pelamar_id){
	    	$datax = array( 'a.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('b.schedule_msg')
				->from('pelamar a')
				->join('schedule b', 'a.pelamar_id = b.pelamar_id AND a.pelamar_status = 1', 'inner')
				->where($datax)
				->like('b.schedule_msg', 'kspm', 'both')
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_sent_sms_teknis($pelamar_id){
	    	$datax = array( 'a.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('b.schedule_msg')
				->from('pelamar a')
				->join('schedule b', 'a.pelamar_id = b.pelamar_id AND a.pelamar_status = 1', 'inner')
				->where($datax)
				->like('b.schedule_msg', 'teknis', 'both')
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_sent_sms_teori($pelamar_id){
	    	$datax = array( 'a.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('b.schedule_msg')
				->from('pelamar a')
				->join('schedule b', 'a.pelamar_id = b.pelamar_id AND a.pelamar_status = 1', 'inner')
				->where($datax)
				->like('b.schedule_msg', 'teori', 'both')
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_sent_sms_praktek($pelamar_id){
	    	$datax = array( 'a.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('b.schedule_msg')
				->from('pelamar a')
				->join('schedule b', 'a.pelamar_id = b.pelamar_id AND a.pelamar_status = 1', 'inner')
				->where($datax)
				->like('b.schedule_msg', 'praktek', 'both')
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function status_sent_sms_mcu($pelamar_id){
	    	$datax = array( 'a.pelamar_id' => $this->pregRepn($pelamar_id) );
	    	$query = $this->db->select('b.schedule_msg')
				->from('pelamar a')
				->join('schedule b', 'a.pelamar_id = b.pelamar_id AND a.pelamar_status = 1', 'inner')
				->where($datax)
				->like('b.schedule_msg', 'mcu', 'both')
	    		->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function applicant_qualify($pelamar_id){
	    	$datax = array( 'c.pelamar_id' => $this->pregRepn($pelamar_id) );
			$query = $this->db->select('c.pelamar_id')
        		->from('people a')
				->join('people_address b', 'a.people_id = b.people_id', 'inner')
				->join('pelamar c', 'a.people_id = c.people_id AND c.pelamar_status = 1', 'inner')
				->join('lowongan d', 'c.lowongan_id = d.lowongan_id', 'inner')
				->join('mparameter e', 'a.people_id = e.people_id', 'inner')
				->join('parameter_job_vacancy f', 'a.people_id = f.people_id', 'inner')
				->join('WEB_1.dbo.city g', 'b.city_id = g.city_id')
				->join('kualifikasi h', 'c.pelamar_id = h.pelamar_id')
				->where('b.paddress_type', 'DOMISILI')
				->where('h.kualifikasi_dt', 1)
				->where('h.kualifikasi_skill', 1)
				->where('h.kualifikasi_sertifikat', 1)
				->where('h.kualifikasi_last_edu', 1)
				->where($pelamar_id)
				->group_by('c.pelamar_id')
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function get_clinic_address($id){
	    	$datax = array('clinic_id' => $this->pregRepn($id), 'clinic_status' => 1 );
	    	$query = $this->db->select('clinic_address')
				->from('WEB.dbo.clinic')
				->where($datax)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	}
?>