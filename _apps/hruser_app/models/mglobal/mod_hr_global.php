<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_hr_global extends CI_Model {

		private $web1;
		private $hrd;

		function __construct() {
	        parent::__construct();
			$this->web1 = $this->load->database('web1', TRUE);
			$this->hrd  = $this->load->database('hrd', TRUE);
	        $this->load->database();
	    }

	    function getCity() {
	    	$query = $this->web1->from('city')
				->order_by('city_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function getAirport() {
	    	$query = $this->db->from('master_airport')
	    		->where('status', 1)
				->order_by('city_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function getAirline() {
	    	$query = $this->db->from('master_airline')
	    		->where('status', 1)
				->order_by('airline_name ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function getList_karyawan($nik) {
	    	$datax = array('a.AKTIF' => 0);
	    	$query = $this->hrd->select('a.Nama as NaKar, b.Nama as jabatan, a.NIK, c.Nama as FOH')
	    		->from('TKaryawan a')
	    		->join('WEB_RECRUITMENT.dbo.web_jabatan b', 'a.KodeJB = b.KodeJB', 'inner')
	    		->join('tfoh c', 'a.KodeFOH = c.KodeFOH', 'inner')
	    		->where($datax)
	    		->where_not_in('a.NIK', $nik)
				->order_by('NaKar ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function getList_site() {
	    	$query = $this->hrd->from('tsite')
	    		->where('AKTIF', 0)
				->order_by('Nama ASC')
				->get()
				->result();
	    	return $query;
	    }

	    function getDetail_karyawan($nik){
	    	$datax = array('a.NIK' => $nik, 'a.AKTIF' => 0);
			$query = $this->hrd->select('a.Nama, a.NIK, b.Nama as jabatan, c.Nama as departemen, a.KodeST, d.Nama as POH')
							->from('TKaryawan a')
							->join('WEB_RECRUITMENT.dbo.web_jabatan b', 'a.KodeJB = b.KodeJB', 'inner')
							->join('WEB_RECRUITMENT.dbo.web_departement c', 'b.KodeDP = c.KodeDP', 'inner')
							->join('tfoh d', 'a.KodeFOH = d.KodeFOH', 'inner')
							->where($datax)
							->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}
	}
?>