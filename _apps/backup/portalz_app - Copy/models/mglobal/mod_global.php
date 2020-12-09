<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_global extends CI_Model {

		private $web1;
		private $hrd;

		function __construct() {
	        parent::__construct();
	        $this->web1 = $this->load->database('web1', TRUE);
	        $this->hrd = $this->load->database('hrd', TRUE);
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function insert_web1($table, $data) {
	        $this->web1->insert($table, $data);
	        return ($this->web1->affected_rows() != 1 ) ? false : true;
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

	    function list_site(){
	    	$datax = array('StatusST' => 1);
	    	$query = $this->web1->from('Site')
				->where($datax)
				->order_by('KodeST ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function list_pic(){
	    	$datax = array('HRD', 'PRD', 'DTC', 'KRD');
	    	$query = $this->hrd->select('a.NIK, a.Nama, a.Telp, a.Email, b.Nama as jabatan')
				->from('TKaryawan a')
				->join('WEB_REKRUTMEN.dbo.web_jabatan b', 'a.KodeJB = b.KodeJB AND a.AKTIF = 0', 'inner')
				->where_in('b.KodeDP', $datax)
				->order_by('a.Nama ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function list_grade(){
	    	$datax = array('edutype_status' => 1);
	    	$query = $this->db->from('meducation_type')
				->where($datax)
				->order_by('edutype_id ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function list_city(){
	    	$query = $this->web1->select('a.city_id, a.province_id, a.city_name, b.province_name')
				->from('city a')
				->join('province b', 'a.province_id = b.province_id', 'inner')
				->order_by('a.city_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function get_city($id){
	    	$datax = array('a.city_id' => $this->pregRepn($id));
	    	$query = $this->web1->select('a.city_id, a.province_id, a.city_name, b.province_name')
				->from('city a')
				->join('province b', 'a.province_id = b.province_id', 'inner')
				->where($datax)
				->order_by('a.city_name ASC')
				->get();
			if ($query->num_rows() > 0){
	            return $query->row();
	    	} else { return false; }
	    }

	    function list_pic_web(){
	    	$query = $this->db->select('pic_id, user_id, pic_name, pic_mobile, pic_email, pic_phone_type, pic_status')
				->from('mpic')
				->where('pic_status', 1)
				->order_by('pic_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function list_clinic(){
	    	$datax = array('clinic_status' => 1);
	    	$query = $this->db->from('WEB.dbo.clinic')
				->where($datax)
				->get()
	    		->result();
	    	return $query;
	    }
	}
?>