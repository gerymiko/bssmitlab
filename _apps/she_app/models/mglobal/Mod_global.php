<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_global extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->AGM = $this->load->database('AGM', TRUE);
	        $this->MJS = $this->load->database('MSJ', TRUE);
	        $this->MAS = $this->load->database('MAS', TRUE);
	        $this->KUP = $this->load->database('KUP', TRUE);
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9 _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function list_karyawan($site){
	    	if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} elseif ($site == "MAS") {
	    		$queryx = $this->MAS;
	    	} elseif ($site == "KUP") {
	    		$queryx = $this->KUP;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
			$query = $queryx->select('NIK, Nama')
				->from('SHE.dbo.vKaryawan')
				->order_by('Nama ASC')
				->get()
				->result();
			return $query;
		}

	    function list_site(){
	    	if ($site == "AGM") {
	    		$queryx = $this->AGM;
	    	} else {
	    		$queryx = $this->MJS;
	    	}
			$query = $queryx->select('id_site, code, name, status_active')
				->from('TMasterSite')
				->order_by('code ASC')
				->get()
				->result();
			return $query;
		}

	}
?>