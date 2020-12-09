<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_lamaran extends CI_Model {

		var $column_order  = array('b.jabatan_alias','a.tgl_melamar', 'a.keterangan_gagal', 'a.pelamar_status');
		var $column_search = array('b.jabatan_alias','a.tgl_melamar', 'a.keterangan_gagal', 'a.pelamar_status'); 
		var $order         = array('a.tgl_melamar' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private function _get_datatables_query($people_id){
	    	$this->db->select('a.pelamar_id, b.jabatan_alias, a.tgl_melamar, a.keterangan_gagal, a.pelamar_status, b.lowongan_status');
			$this->db->from('pelamar a');
	        $this->db->join('lowongan b', 'a.lowongan_id = b.lowongan_id', 'INNER');
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
	    	$this->db->select('b.jabatan_alias, a.tgl_melamar, a.keterangan_gagal, a.pelamar_status, b.lowongan_status');
			$this->db->from('pelamar a');
	        $this->db->join('lowongan b', 'a.lowongan_id = b.lowongan_id', 'inner');
	        $this->db->where('a.people_id', $people_id);
	    	return $this->db->count_all_results();
	    }

	    function cek_pelamar($data){
	    	$datax = array(
				'people_id'      => $data['people_id'],
				'lowongan_id'    => $data['lowongan_id'],
				'pelamar_status' => 1
	    	);
	    	$query = $this->db->select('people_id, lowongan_id, pelamar_status')
	    					->from('pelamar')
	    					->where($data)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
	    }

	    function check_duplicate_pelamar($people_id, $lowongan_id){
	    	$datax = array(
				'people_id'      => $people_id,
				'lowongan_id'    => $lowongan_id,
				'pelamar_status' => 1
	    	);
	    	$query = $this->db->select('people_id, lowongan_id, pelamar_status')
	    					->from('pelamar')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row();
	       	} else { return false; }
	    }

	    function getParameter_pelamar($people_id){
	    	$datax = array('people_id' => $people_id);
	    	$query = $this->db->select('freshgraduate, completed_photo, completed_skill, completed_berkas_ijazah, completed_sertifikat')
	    					->from('mparameter')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row();
	       	} else { return false; }
	    }

	    function getParameter_pjv($people_id){
	    	$datax = array('people_id' => $people_id);
	    	$query = $this->db->from('parameter_job_vacancy')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row();
	       	} else { return false; }
	    }

	    function getskill_pelamar($people_id) {
	    	$query = $this->db->select('b.skill_id')
    						->from('people_skill a')
    						->join('skill b', 'a.skill_id = b.skill_id', 'inner')
    						->join('web_jabatan c', 'a.KodeJB = c.KodeJB', 'inner')
    						->where('a.people_id', $people_id)
    						->get();
    		if($query->num_rows() > 0 ) {
	            return $query->result_array(); 
	       	} else { return 0; }
	    }

	    function getskill_required($lowongan_id){
	    	$query = $this->db->select('b.skill_id')
    						->from('lowongan a')
    						->join('skill_required b', 'a.lowongan_id = b.lowongan_id', 'inner')
    						->where('a.lowongan_id', $lowongan_id)
    						->get();
    		if($query->num_rows() > 0 ) {
	            return $query->result_array(); 
	       	} else { return 0; }
	    }

	    function getsertifikat_pelamar($people_id) {
	    	$query = $this->db->select('b.certificate_id')
    						->from('people_certificate a')
    						->join('mcertificate b', 'a.certificate_id = b.certificate_id', 'inner')
    						->where('a.people_id', $people_id)
    						->not_like('pcertificate_type', 'PENGALAMAN', 'both')
    						->get();
    		if($query->num_rows() > 0 ) {
	            return $query->result_array(); 
	       	} else { return 0; }
	    }

	    function getsertifikat_required($lowongan_id){
	    	$query = $this->db->select('b.certificate_id')
    						->from('lowongan a')
    						->join('certificate_required b', 'a.lowongan_id = b.lowongan_id', 'inner')
    						->where('a.lowongan_id', $lowongan_id)
    						->get();
    		if($query->num_rows() > 0 ) {
	            return $query->result_array(); 
	       	} else { return 0; }
	    }

	    function geteducation_pelamar($people_id) {
	    	$query = $this->db->select('b.edutype_id')
    						->from('people_education a')
    						->join('meducation_type b', 'a.edutype_id = b.edutype_id', 'inner')
    						->where('a.people_id', $people_id)
    						->get();
    		if($query->num_rows() > 0 ) {
	            return $query->result_array(); 
	       	} else { return 0; }
	    }

	    function geteducation_required($lowongan_id){
	    	$datax = array('a.lowongan_id'=> $lowongan_id);
	    	$query = $this->db->select('b.edutype_id')
    						->from('lowongan a')
    						->join('edu_required b', 'a.lowongan_id = b.lowongan_id', 'inner')
    						->where($datax)
    						->get();
    		if($query->num_rows() > 0 ) {
	            return $query->result_array(); 
	       	} else { return 0; }
	    }

	    function cek_total_melamar($people_id){
	    	$datax = array('pelamar_status' => 1, 'people_id' => $people_id);
	    	$query = $this->db->from('pelamar')
	    					->where($datax)
	    					->count_all_results();
	    	return $query;
	    }

	    function tahap_rekrutmen_1(){
	    	$query = $this->db->select('rs_id, rs_alias')
	    					->from('recruitment_step')
	    					->where('rs_order', 4)
	    					->limit(1)
	    					->get()
	    					->result_array();
	    	return $query;
	    }

	    function tahap_rekrutmen_2(){
	    	$query = $this->db->select('rs_id, rs_alias')
	    					->from('recruitment_step')
	    					->where('rs_status', 1)
	    					->order_by('rs_order ASC')
	    					->limit(4)
	    					->get()
	    					->result_array();
	    	return $query;
	    }

	    function notifikasi_pelamar($id){
	        $query = $this->db->select('pelamar_id, people_firstname, people_middlename, people_lastname, p.registrant_kode, wj.Nama, c.city_name as domisili')
							->from('people p')
							->join('pelamar plm', 'p.people_id = plm.people_id', 'inner')
							->join('lowongan l', 'l.lowongan_id = plm.lowongan_id', 'inner')
							->join('web_jabatan wj', 'wj.KodeJB = l.KodeJB', 'inner')
							->join('people_address pa', 'p.people_id = pa.people_id', 'inner')
							->join('WEB_1.dbo.city c', 'pa.city_id = c.city_id', 'inner')
							->where('paddress_type', 'DOMISILI')
							->where("pelamar_id", $id)
							->order_by('pelamar_id', 'desc')
							->limit(1)
							->get();
	        if ($query->num_rows() > 0) {
	            return $query->row();
	        } else { return false; }
	    }

	    function check_schedule_pelamar($people_id, $pelamar_id){
	    	$datax = array(
				'people_id'  => $people_id,
				'pelamar_id' => $pelamar_id
	    	);
	    	$query = $this->db->select('pelamar_id')
	    					->from('schedule')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return 0; }
		}

	    function insert_all($table, $data) {
	        $result = $this->db->insert($table, $data);
	    	if ($result) return $this->db->insert_id();
	    	return false;
	    }

	    function insert_qualified($dataQualified) {
			$this->db->insert('kualifikasi', $dataQualified);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function update_pjv_lamaran($people_id, $dataParameter2){
	    	$dataid = array( 'people_id' => $people_id );
			$this->db->where($dataid);
	    	$this->db->update('parameter_job_vacancy', $dataParameter2);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function insert_pjv_lamaran($dataParameter2) {
			$this->db->insert('parameter_job_vacancy', $dataParameter2);
			return ($this->db->affected_rows() != 1 ) ? false:true;
		}

		function delete_application($pelamar_id){
	    	$datax = array('pelamar_id' => $pelamar_id);
	    	$datay = array(
				'keterangan_gagal' => 'Membatalkan Lamaran',
				'tgl_update'       => date("Y-m-d H:i:s"),
				'pelamar_status'   => 0
	    	);
			$this->db->where($datax);
	    	$this->db->update('pelamar', $datay);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}
	}
?>