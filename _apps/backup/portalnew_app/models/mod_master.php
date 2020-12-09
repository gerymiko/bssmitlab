<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_master extends CI_Model {

		private $web;
		private $hrd;
		private $web1;

	    function __construct() {
	        parent::__construct();
			$CI         =& get_instance();
			$this->web  = $this->load->database('ext', TRUE, TRUE);
			$CI->web    =& $this->web;
			$this->hrd  = $this->load->database('ext2', TRUE);
			$this->web1 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

	    function site(){
	    	$query = $this->web1->from('Site')
	    					->where('StatusST', 1)
	    					->order_by('KodeST ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function city(){
	    	$query = $this->web1->select('city_id,province_id,city_name,city_alias,date_create,city_status')
	    					->from('city')
	    					->order_by('city_name')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function city_id($location){
	    	$query = $this->web1->select('city_name')
	    					->from('city')
	    					->where('city_id', $location)
	    					->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function clinic(){
	    	$query = $this->web->from('WEB.dbo.clinic')
	    					->where('clinic_status',1)
	    					->order_by('clinic_name')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function getnamepeople($people_id){
	    	$query = $this->db->select('people_firstname')
	    					->from('people')
	    					->where('people_id', $people_id)
	    					->get();
	    	if ($query->num_rows() > 0) :
	            return $query->row();
	        else : return false; 
	        endif;
	    }

	    function pic(){
	    	$query = $this->db->select('pic_id,user_id,pic_name,pic_mobile,pic_email,pic_imei,pic_phone_type,pic_status')
	    					->from('mpic')
	    					->where('pic_status', 1)
	    					->order_by('pic_name ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function list_jabatan(){
	    	$query = $this->db->select('a.KodeJB, a.KodeDP, a.Nama as jabatan, a.status_jabatan, b.Nama')
	    					->from('web_jabatan a')
	    					->join('web_departement b', 'a.KodeDP = b.KodeDP', 'INNER')
	    					->where('status_jabatan', 1)
	    					->group_by('a.KodeJB, a.KodeDP, a.Nama, a.status_jabatan, b.Nama')
	    					->order_by('jabatan ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function list_users(){
	    	$this->web1->list_fields('users');
	    	$this->web1->from('users');
	    	$this->web1->where('users_status', 1);
	    	$this->web1->order_by('users_fullname ASC');
	    	$query = $this->web1->get();
	    	return $query->result();
	    }

	    function list_karyawan(){
	    	$query = $this->hrd->select('NIK, Nama, Telp, Email')
	    						->from('TKaryawan')
	    						->where('AKTIF',0)
	    						->order_by('Nama ASC')
	    						->get()
	    						->result();
	    	return $query;
	    }

	    function list_karyawan_perJB(){
	    	$datax = array('DTC', 'HRD', 'KRD');
	    	$query = $this->hrd->select('a.NIK, a.Nama, a.Telp, a.Email, b.Nama as jabatan')
	    						->from('TKaryawan a')
	    						->join('WEB_RECRUITMENT.dbo.web_jabatan b', 'a.KodeJB = b.KodeJB AND a.AKTIF = 0', 'inner')
	    						->where_in('b.KodeDP', $datax)
	    						->order_by('a.Nama ASC')
	    						->get()
	    						->result();
	    	return $query;
	    }

	    function list_trainer_perJB(){
	    	$datax = array('HRD025','HRD026','PRD013','PRD014','PRD015','PRD027');
	    	$query = $this->hrd->select('a.NIK, a.Nama, a.Telp, a.Email, b.Nama as jabatan')
	    						->from('TKaryawan a')
	    						->join('WEB_RECRUITMENT.dbo.web_jabatan b', 'a.KodeJB = b.KodeJB AND a.AKTIF = 0', 'inner')
	    						->where_in('b.KodeJB', $datax)
	    						->order_by('a.Nama ASC')
	    						->get()
	    						->result();
	    	return $query;
	    }

	    function getlowongan_aktif(){
	    	$query = $this->db->select('lowongan_id, jabatan_alias')
	    					->from('lowongan')
	    					->where('lowongan_status', 1)
	    					->order_by('jabatan_alias ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	    function education(){
	    	$query = $this->db->from('meducation_type')
	    					->where('edutype_status', 1)
	    					->order_by('edutype_id ASC')
	    					->get()
	    					->result();
	    	return $query;
	    }

	}
?>
