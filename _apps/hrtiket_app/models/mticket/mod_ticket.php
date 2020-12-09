<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_ticket extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregRepn($number) { 
	        $result = preg_replace('/[^0-9]/','', $number);
	        return $result;
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9 -.]/','', $string);
            return $result;
        }

        function getNodocTicket() {
			date_default_timezone_set('Asia/Makassar');
			$date = date("ymd");

			$this->db->select_max('nodoc','id_max',true);
			$q  = $this->db->get('TPengajuan_tiket');
			
			$id = "";
			if($q->num_rows()>0){
				foreach($q->result() as $k){
					$idmaks = substr($k->id_max, 16, 5);
					$tgl    = substr($k->id_max, 9, 6);
					if ($tgl == $date) {
						$tmp = ((int)$idmaks)+1;
						$id  = sprintf("%05s", $tmp);
					}else{
						$id = "00001";		
					}
				}
			} else { $id = "00000"; }
			return "PTKD/SMD/".$date."/".$id;
	    }

	    function save_order_ticket_official($data){
			$this->db->insert('TPengajuan_tiket', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function check_ticket_order($nik){
	    	$datax = array('nik' => $this->pregRepn($nik), 'sts' => 1, 'tipe' => 'Dinas');
	    	$query = $this->db->from('TPengajuan_tiket')
	    					->where($datax)
	    					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	}
?>