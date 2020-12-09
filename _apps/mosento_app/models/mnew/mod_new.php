<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_new extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    function downtime_ex($tahun, $nokontrak){
			$query = $this->db->select('JamDowntime')
				->from('DowntimeInternet')
				->where('YEAR(Tanggal)', $tahun)
				->where('KodeVendor', $nokontrak)
				->get()
				->row();
			return $query;
		}

		function kontrak(){
			$query = $this->db->select('nama_perusahaan, no_kontrak, site')
				->from('Kontrak')
				->where('status', 'AKTIF')
				->group_by('nama_perusahaan, no_kontrak, site')
				->get()
				->result();
			return $query;
		}

		function downtime1(){
			$query = $this->db->select('YEAR(a.Tanggal) tahun')
				->from('DowntimeInternet a')
				->join('Kontrak b', 'a.KodeVendor = b.no_kontrak')
				->where('b.status', 'aktif')
				->group_by('YEAR(a.Tanggal)')
				->get()
				->result();
			return $query;
		}


	}
?>