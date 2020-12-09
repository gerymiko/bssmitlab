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

	    function getList_karyawan() {
	    	$query = $this->hrd->select('a.Nama as NaKar, b.Nama as jabatan, a.NIK, c.Nama as FOH')
	    		->from('TKaryawan a')
	    		->join('WEB_RECRUITMENT.dbo.web_jabatan b', 'a.KodeJB = b.KodeJB', 'inner')
	    		->join('tfoh c', 'a.KodeFOH = c.KodeFOH', 'inner')
	    		->where('a.AKTIF', 0)
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
			$query = $this->hrd->select('a.Nama, a.NIK, b.Nama as jabatan, c.Nama as departemen, a.KodeST, d.Nama as FOH')
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

		function count_submission_staff(){
			$datax = array('sts' => 1);
			$query = $this->db->from('TPengajuan_tiket')
							->where($datax)
							->count_all_results();
			return $query;
		}

		function count_submission_vendor(){
			$datax = array('sts' => 2);
			$query = $this->db->from('TPengajuan_tiket')
							->where($datax)
							->count_all_results();
			return $query;
		}

		function count_opsional_vendor(){
			$datax = array('a.sts' => 3, 'b.sts_opsi' => 1);
			$query = $this->db->from('TPengajuan_tiket a')
							->join('TOpsi_tiket b', 'a.nodoc = b.nodoc', 'inner')
							->where($datax)
							->count_all_results();
			return $query;
		}

		function count_ordered_ticket(){
			$datax = array('a.sts' => 0);
			$query = $this->db->from('TPengajuan_tiket a')
							->join('TOrdered_tiket b', 'a.nodoc = b.nodoc', 'inner')
							->where($datax)
							->count_all_results();
			return $query;
		}
	}
?>