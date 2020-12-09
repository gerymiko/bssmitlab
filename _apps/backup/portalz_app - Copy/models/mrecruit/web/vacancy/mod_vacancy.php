<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_vacancy extends CI_Model {

		var $column_order = array('a.lowongan_id', 'a.kode_lowongan', 'b.Nama', 'a.jabatan_alias', 'a.jml_rekrut', 'a.tgl_open');
	    var $column_search = array('a.lowongan_id', 'a.kode_lowongan', 'b.Nama', 'a.jabatan_alias', 'a.jml_rekrut', 'a.tgl_open'); 
	    var $order         = array('a.lowongan_status' => 'DESC');

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	        return $result;
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private function _get_datatables_query(){
	    	$cond = $this->input->post('lowongan_status');
	    	if($cond == ""){
	    		$this->db->or_not_like('a.lowongan_status', '2');
	    	}
	    	if ($cond == "1") {
				$this->db->where('a.lowongan_status', 1);
			} 
			if ($cond == "0" ) {
				$this->db->where('a.lowongan_status', 0);
			}
			$this->db->select('a.lowongan_id, a.kode_lowongan, b.Nama, a.jabatan_alias, a.jml_rekrut, a.tgl_open, , a.tgl_close, a.lowongan_status, a.KodeJB, a.KodeDP, a.min_salary, a.max_salary, a.jenis_kelamin, a.edu_jurusan, a.experience, a.experience_subject, a.min_usia, a.max_usia');
	        $this->db->from('lowongan a');
			$this->db->join('web_departement b', 'a.KodeDP = b.KodeDP AND b.department_status = 1', 'inner');
	 
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

	    function get_vacancy($length, $start){
	       	$this->_get_datatables_query();
	        if($this->pregReps($length) != -1){
	        	$this->db->limit($this->pregReps($length), $this->pregReps($start));
		        $query = $this->db->get();
		        return $query->result();
	        }
	    }

	    function count_filtered_vacancy(){
	        $this->_get_datatables_query();
	        $query = $this->db->get();
	        return $query->num_rows();
	    }
	 
	    function count_all_vacancy(){
	    	$this->_get_datatables_query();
	    	return $this->db->count_all_results();
	    }

	    function vacancy_active() {
            $query = $this->db->select('lowongan_id')->from('lowongan')
                ->where('lowongan_status', 1)
                ->count_all_results();
            return $query;
        }

        function vacancy_not_active() {
            $query = $this->db->select('lowongan_id')->from('lowongan')
                ->where('lowongan_status', 0)
                ->count_all_results();
            return $query;
        }

        function vacancy_registered() {
            $query = $this->db->select('lowongan_id')->from('lowongan')
                ->count_all_results();
            return $query;
        }

        function list_jabatan(){
        	$datax = array('a.status_jabatan' => 1, 'b.department_status' => 1);
	    	$query = $this->db->select('a.KodeJB, a.KodeDP, a.Nama as jabatan, b.Nama as departemen, a.status_jabatan')
				->from('web_jabatan a')
				->join('web_departement b', 'a.KodeDP = b.KodeDP', 'INNER')
				->where($datax)
				->group_by('a.KodeJB, a.KodeDP, a.Nama, a.status_jabatan, b.Nama')
				->order_by('jabatan ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function check_vacancy($kodeJB){
	    	$whereCondition = $array = array('KodeJB' => $kodeJB);
			$this->db->where($whereCondition); 
			$query = $this->db->get('lowongan');   
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	    	} else { return false; }
		}

		function syarat_wajiblist(){
			$datax = array('a.syarat_status' => 1, 'b.KodeJB' => '0');
	    	$query = $this->db->from('msyarat a')
				->join('bridge_jabatan_syarat b', 'a.syarat_id = b.syarat_id', 'INNER')
                ->where($datax)
                ->get()
                ->result();
            return $query;
	    }

	    function getSkill($kodeJB){
	    	$datax = array('c.KodeJB' => $this->pregReps($kodeJB), 'b.skill_status' => 1);
	    	$query = $this->db->from('jabatan_skill_bridge a, skill b, web_jabatan c')
                ->where('a.skill_id = b.skill_id')
                ->where('c.KodeJB = a.KodeJB')
                ->where($datax)
                ->order_by('skill_name ASC')
                ->get()
                ->result();
            return $query;
	    }

	    function getSyarat($kodeJB){
	    	$datax = array('c.KodeJB' => $this->pregReps($kodeJB), 'b.syarat_status' => 1);
	    	$query = $this->db->from('bridge_jabatan_syarat a, msyarat b, web_jabatan c')
                ->where('a.syarat_id = b.syarat_id')
                ->where('c.KodeJB = a.KodeJB')
                ->where($datax)
                ->order_by('b.syarat_id ASC')
                ->get()
                ->result();
            return $query;
	    }

	    function getSertifikat($kodeJB){
	    	$datax = array('c.KodeJB' => $this->pregReps($kodeJB), 'b.certificate_status' => 1);
	    	$query = $this->db->from('bridge_jabatan_certificate a, mcertificate b, web_jabatan c')
                ->where('a.certificate_id = b.certificate_id')
                ->where('c.KodeJB = a.KodeJB')
                ->where($datax)
                ->order_by('b.certificate_name ASC')
                ->get()
                ->result();
            return $query;
	    }

		function get_jabatan_name($kodeJB){
			$datax = array('KodeJB' => $this->pregReps($kodeJB));
			$query = $this->db->select('Nama')
				->from('web_jabatan')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
			} else { return false; }
		}

		function detail_vacancy($lowongan_id){
			$datax = array('a.lowongan_id' => $this->pregRepn($lowongan_id));
			$query = $this->db->select('a.KodeJB, a.KodeDP, a.jabatan_alias, a.lowongan_id, a.lowongan_status, a.job_desc, b.Nama as departemen, a.min_usia, a.max_usia, a.min_salary, a.max_salary, a.tgl_open, a.tgl_close, a.edu_jurusan, a.experience_subject, a.experience, a.jml_rekrut, a.jenis_kelamin, a.kode_lowongan, a.date_create')
				->from('lowongan a')
				->join('web_departement b', 'a.KodeDP = b.KodeDP', 'INNER')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
			} else { return false; }
		}

		function detail_education($lowongan_id){
			$datax = array('lowongan_id' => $this->pregRepn($lowongan_id));
			$query = $this->db->from('edu_required')
				->where($datax)
				->get()
				->result();
			return $query;
		}

		function master_education(){
			$datax = array('edutype_status' => 1);
			$query = $this->db->from('meducation_type')
                ->where($datax)
                ->get()
            	->result();
			return $query;
		}

		function master_skillumum(){
	    	$query = $this->db->from('skill')
				->where('skill_status', 1)
				->where('skill_id IN (1,2,3,4,5,108,109,110,111,112,113,114)')
				->order_by('skill_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function detail_skill($lowongan_id){
	    	$datax = array('lowongan_id' => $this->pregRepn($lowongan_id), 'skillreq_status' => 1);
	    	$query = $this->db->from('skill_required')
				->where($datax)
				->get()
				->result();
	    	return $query;
	    }

	    function master_skillreq($kodejb){
	    	$datax = array('b.KodeJB' => $this->pregReps($kodejb), 'a.skill_status' => 1);
	    	$query = $this->db->from('skill a')
				->join('jabatan_skill_bridge b', 'a.skill_id = b.skill_id', "INNER")
				->where('a.skill_id NOT IN (1,2,3,4,5,108,109,110,111,112,113,114)')
				->where($datax)
				->order_by('a.skill_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function master_sertifikatumum(){
	    	$query = $this->db->from('mcertificate')
				->where('certificate_status', 1)
				->where('certificate_id IN (1,2)')
				->order_by('certificate_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function detail_sertifikat($lowongan_id){
	    	$datax = array('lowongan_id' => $this->pregRepn($lowongan_id), 'certificatereq_status' => 1);
	    	$query = $this->db->from('certificate_required')
				->where($datax)
				->get()
				->result();
	    	return $query;
	    }

	    function master_sertifikatreq($kodejb){
	    	$datax = array('b.KodeJB' => $this->pregReps($kodejb), 'a.certificate_status' => 1);
	    	$query = $this->db->from('mcertificate a')
				->join('bridge_jabatan_certificate b', 'a.certificate_id = b.certificate_id', 'INNER')
				->where('a.certificate_id NOT IN (1,2)')
				->where($datax)
				->order_by('a.certificate_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function master_syaratumum(){
	    	$query = $this->db->from('msyarat')
				->where('syarat_status', 1)
				->where('syarat_id IN (1,2,3,4,5,6,7,8,9)')
				->order_by('syarat_id ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function detail_syaratumum($lowongan_id){
	    	$datax = array('lowongan_id' => $this->pregRepn($lowongan_id), 'syaratreq_status' => 1);
	    	$query = $this->db->from('syarat_required')
				->where('syaratreq_status',1)
				->where($datax)
				->get()
				->result();
	    	return $query;
	    }

	    function master_syaratreq($kodejb){
	    	$datax = array('b.KodeJB' => $this->pregReps($kodejb), 'a.syarat_status' => 1);
	    	$query = $this->db->from('msyarat a')
				->join('bridge_jabatan_syarat b', 'a.syarat_id = b.syarat_id', 'INNER')
				->where($datax)
				->order_by('a.syarat_id ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function detail_edureq($lowongan_id){
	    	$datax = array('a.lowongan_id' => $this->pregRepn($lowongan_id), 'b.edureq_status' => 1);
	    	$query = $this->db->from('lowongan a')
				->join('edu_required b', 'a.lowongan_id = b.lowongan_id', 'INNER')
				->join('meducation_type c', 'b.edutype_id = c.edutype_id', 'INNER')
				->where($datax)
				->get()
				->result();
	    	return $query;
	    }

	    function detail_skillreq($lowongan_id){
	    	$datax = array('a.lowongan_id' => $this->pregRepn($lowongan_id), 'b.skillreq_status' => 1);
	    	$query = $this->db->from('lowongan a')
				->join('skill_required b', 'a.lowongan_id = b.lowongan_id', 'INNER')
				->join('skill c', 'b.skill_id = c.skill_id', 'INNER')
				->where($datax)
				->get()
				->result();
	    	return $query;
	    }

	    function detail_syaratreq($lowongan_id){
	    	$datax = array('a.lowongan_id' => $this->pregRepn($lowongan_id), 'b.syaratreq_status' => 1);
	    	$query = $this->db->from('lowongan a')
				->join('syarat_required b', 'a.lowongan_id = b.lowongan_id', 'INNER')
				->join('msyarat c', 'b.syarat_id = c.syarat_id', 'INNER')
				->where($datax)
				->get()
				->result();
	    	return $query;
	    }

	    function insert_get_id($data){
			if($this->db->insert('lowongan', $data)){
				return $this->db->insert_id();
            }
            return false; 
		}

		function insert_all($table, $data){
			$this->db->insert($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

		function edit_extra_all($field, $id, $table, $data){
			$this->db->where($field, $id);
			$this->db->update($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

		function delete_extra_all($field, $id, $table) {
			$this->db->where($field, $id);
	        $this->db->delete($table);
	        return ($this->db->affected_rows() != 1 ) ? false:true;
	    }

	}
?>